<?php

/***************************************** REMOVE SLUG FROM URLS *********************************************************/
function na_remove_slug( $post_link, $post, $leavename ) {

    if ( 'kss_slots' === $post->post_type || 'publish' !== $post->post_status ) {
        return $post_link;
    }
    switch($post->post_type){
        case 'kss_transactions':
            $post_slug = 'payment-methods';
            break;
        case 'kss_guides':
            $post_slug = 'guides';
            break;
        case 'kss_casino':
            $post_slug = 'casino';
            break;
        case 'kss_news':
            $post_slug = 'news';
            break;
        case 'kss_offers':
            $post_slug = 'promotions';
            break;
        case 'kss_softwares':
            $post_slug = 'providers';
            break;
        case 'bc_countries':
            $post_slug = 'countries';
            break;
        case 'bc_bonus':
            $post_slug = 'bonus';
            break;
        case 'bc_bonus_page':
            $post_slug = 'bonus-page';
            break;
        case 'kss_games':
            $post_slug = 'casinogames';
            break;
        default:
            $post_slug = $post->post_type;
    }


    $post_link = str_replace( '/' . $post_slug . '/', '/', $post_link );

    return $post_link;
}
add_filter( 'post_type_link', 'na_remove_slug', 10, 3 );

flush_rewrite_rules() ;
add_filter( 'query_vars', 'register_query_var' );
function register_query_var( $vars ) {
    $vars[] = 'amp';
    return $vars;
}
add_rewrite_endpoint( 'amp', EP_ALL );
function na_parse_request( $query ) {
// Get's the Current Browser URL
    global $wp;
    $current_url = add_query_arg($_SERVER['QUERY_STRING'], '', home_url( $wp->request.'/' ) );

    // Homepage AMP URL
    $front_page_amp_url = get_site_url() . "/?amp";

    // check if the current browser URL is homepage.com/amp
    if ( strcasecmp( $current_url, $front_page_amp_url ) == 0 && $query->is_main_query() )
    {

        // gets front page id
        $front_page_id = get_option( 'page_on_front' );

        // replace query id
        $query->set( 'page_id', $front_page_id );
        $query->set( 'post_type', 'page' );

        return $query;
    }
    if ( ! $query->is_main_query() || (2 != count( $query->query )  && !isset( $query->query['amp'] )) || ! isset( $query->query['page'] ) ) {
        return;
    }

    if ( ! empty( $query->query['name'] ) || ( ! empty( $query->query['name']) && isset( $wp_query->query['amp'] ))) {
        $query->set( 'post_type', array( 'post','kss_casino','kss_softwares', 'kss_news', 'kss_guides', 'kss_offers', 'kss_transactions', 'page', 'bc_countries', 'bc_bonus', 'bc_bonus_page', 'kss_games' ) );
    }
}
add_action( 'pre_get_posts', 'na_parse_request' );

add_filter( 'template_include', 'use_amp_template', 99 );

function use_amp_template( $template ) {
    global $wp_query;
    if(isset( $wp_query->query['amp'] ) && is_singular('kss_casino') ){
        $new_template = locate_template( array( '/templates/amp/amp-casino.php' ) );
        if ( '' != $new_template ) {
            return $new_template;
        }
    }
    if(isset( $wp_query->query['amp'] ) && is_singular('bc_bonus_page')){
        $new_template = locate_template( array( '/templates/amp/amp-bonus.php' ) );
        if ( '' != $new_template ) {
            return $new_template;
        }
    }
    if(isset( $wp_query->query['amp'] ) && is_home()){ //TODO remove it on live
        $new_template = locate_template( array( '/templates/amp/test.php' ) );

        if ( '' != $new_template ) {
            return $new_template;
        }
    }
    return $template;
}