<?php
function simple_providers_table($atts){

    $atts = shortcode_atts(
        array(
            'popular' => '',
        ), $atts, 'soft-table' ) ;

    $game_args = array( // A QUERY that initializes the default (all) IDS
        'post_type'      => array('kss_softwares'),
        'post_status'    => array('publish', 'draft'),
        'no_found_rows' => true,
        'update_post_term_cache' => false,
        'posts_per_page' => 500,
        'fields' => 'ids',
        'suppress_filters' => false,
        'orderby' => array(
//            'post_date' => 'ASC',
            'post_title'      => 'ASC',
            'post_status'      => 'DESC',
        )
    );
    $filter = function() {
        return 'post_status DESC';
    };
    add_filter('posts_orderby', $filter);
    $cache_key = 'soft_shark';
    if (false === ( $query_games = wp_cache_get( $cache_key ) )){
        $query_games = get_posts($game_args);
        wp_cache_set( $cache_key, $query_games, 'soft_shark', DAY_IN_SECONDS );
    }
    remove_filter('posts_orderby', $filter);

    $ret  = '<div class="table-responsive single-table-games gamestable">';
    $ret .= '<table class="table table-striped d-flex flex-wrap d-md-table d-lg-table d-xl-table table-condensed w-100 medium" id="'.uniqid().'">';
    $ret .= '<thead class="casinohead">';
    $ret .= '<tr class="">';
        $ret .= '<th class="widget2-heading text-left p-4p d-table-cell  w-auto font-weight-bold" style="text-align:left!important;">Providers</th>';
        $ret .= '<th class="widget2-heading text-center p-4p font-weight-bold d-table-cell w-auto">Guide</th>';
        $ret .= '<th class="widget2-heading text-center p-4p d-table-cell w-auto font-weight-bold">RNG/Live</th>';
        $ret .= '<th class="widget2-heading text-center p-4p d-table-cell w-auto font-weight-bold">'.get_flags( '', '', $GLOBALS['visitorsISO']).' Casinos</th>';
        $ret .= '<th scope="col" colspan="2" class="widget2-heading text-left p-4p d-table-cell w-auto" style="text-align:left!important;"><div class="d-flex justify-content-between font-weight-bold">Best Casino<div class="switch-wrapper font-weight-normal"><small>Ratings</small><label class="switch"><input type="checkbox"><span class="slider round"></span></label><small>Bonus</small></div></div></th>';
    $ret .= '</tr>';
    $ret .= '</thead>';
    $ret .= '<tbody>';
        foreach ($query_games as $game) {
            $cas = get_post_meta($game, $GLOBALS['countryISO'].'software_custom_meta_main_casino' , true);
            $casinoBonusPage = get_post_meta($cas, 'casino_custom_meta_bonus_page', true);
            $bonusName = get_post_meta($casinoBonusPage, 'bonus_custom_meta_bonus_offer', true);
            $bonusISO = get_bonus_iso($casinoBonusPage);
            $bonusCTA = get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_cta_for_top', true);
            $bonusCTA2 = get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_cta_for_top_2', true);
            $title = get_the_title($game);
            $count = strlen($title);
            if($count > 13){
                $titleShort = substr($title, 0, 11);
            }else{
                $titleShort= null;
            }
            $ret .= '<tr class="w-sm-100 d-xl-table-row d-lg-table-row d-md-table-row d-flex flex-wrap mb-sm-10p">';
            if($titleShort){
                $ret .= '<td style="vertical-align: middle;" class="pay-name-logo text-left  pt-sm-10p pt-5p pl-5p pl-sm-0 pb-sm-15p pr-5p pr-sm-0 w-sm-40"><img width="40" height="40" class="img-fluid" alt="'.$title.'" loading="lazy" src="'.get_post_meta($game, 'casino_custom_meta_sidebar_icon', true).'"><span data-toggle="tooltip" title="'.$title.'" class="d-inline-block d-md-none d-lg-none d-xl-none"> '.$titleShort.'...</span><span class="d-none d-xl-inline-block  d-lg-inline-block  d-md-inline-block">'.$title.'</span></td>';
            }else{
                $ret .= '<td style="vertical-align: middle;" class="pay-name-logo text-left pt-5p pt-sm-10p pl-5p pl-sm-0 pb-sm-15p pr-5p pr-sm-0 w-sm-40"><img width="40" height="40" class="img-fluid" alt="'.$title.'" loading="lazy" src="'.get_post_meta($game, 'casino_custom_meta_sidebar_icon', true).'"> '.$title.'</td>';
            }
    //            $ret .= '<td style="padding: 5px 3px;" class="game-name text-left"><img class="img-fluid" alt="'.$title.'" src="'.get_the_post_thumbnail_url($game, 'shortcode').'"> '.$title.'</td>';
                    if(get_post_status($game) == 'draft'){
                        $ret .= '<td style="vertical-align: middle;" class="game-guide d-flex flex-column d-md-table-cell d-lg-table-cell d-xl-table-cell text-center pt-5p pt-sm-15p pr-5p pl-5p pb-sm-15p pl-sm-0 pr-sm-0 w-sm-20 disabledRow">
<span class="d-md-none d-lg-none d-xl-none d-block text-dark mx-auto">Guide</span>
<img src="'.get_template_directory_uri().'/assets/images/svg/guide.svg'.'" width="20" height="20" loading="lazy" class="d-block mx-auto">
</td>';
                    }else{
                        $ret .= '<td style="vertical-align: middle;" class="game-guide d-flex flex-column d-md-table-cell d-lg-table-cell d-xl-table-cell text-center pt-5p pt-sm-15p pr-5p pl-5p pb-sm-15p pl-sm-0 pr-sm-0 w-sm-20">
                        <span class="d-md-none d-lg-none d-xl-none d-block text-dark">Guide</span>
                        <a class="" href="'.get_the_permalink($game).'">
                        <img src="'.get_template_directory_uri().'/assets/images/svg/guide.svg'.'" width="20" height="20" loading="lazy">
                        </a>
                        </td>';
                    }
                if( get_post_meta($game,'software_custom_meta_rng' ,true) && get_post_meta($game,'software_custom_meta_livecasino' ,true) ){
                    $ret .= '<td style="vertical-align: middle;" class="game-info text-center pt-5p pt-sm-15p  pr-5p pl-5p pb-sm-15p pl-sm-0 pr-sm-0 w-sm-20">
<span class="d-md-none d-lg-none d-xl-none d-block text-dark mx-auto">RNG/Live</span>
<img data-toggle="tooltip" title="RNG" src="'.get_template_directory_uri().'/assets/images/svg/rng.svg'.'" width="20" height="20" loading="lazy"> | <img data-toggle="tooltip" title="Live" loading="lazy" src="'.get_template_directory_uri().'/assets/images/svg/dealer_menu_icon.svg'.'" width="20" height="20" class="">
</td>';
                }elseif(get_post_meta($game,'software_custom_meta_rng' ,true) && !get_post_meta($game,'software_custom_meta_livecasino' ,true)){
                    $ret .= '<td style="vertical-align: middle;" class="game-info text-center pt-5p pt-sm-15p pr-5p pl-5p  pb-sm-15p pl-sm-0 pr-sm-0 w-sm-20">
<span class="d-md-none d-lg-none d-xl-none d-block text-dark mx-auto">RNG/Live</span>
<img data-toggle="tooltip" title="RNG" src="'.get_template_directory_uri().'/assets/images/svg/rng.svg'.'" width="20" height="20" loading="lazy" class="d-block mx-auto">
</td>';
                }elseif(!get_post_meta($game,'software_custom_meta_rng' ,true) && get_post_meta($game,'software_custom_meta_livecasino' ,true)){
                    $ret .= '<td style="vertical-align: middle;" class="game-info text-center pt-5p pt-sm-15p pr-5p pl-5 pb-sm-15pp pl-sm-0 pr-sm-0 w-sm-20">
<span class="d-md-none d-lg-none d-xl-none d-block text-dark mx-auto">RNG/Live</span>
<img data-toggle="tooltip" title="Live" src="'.get_template_directory_uri().'/assets/images/svg/dealer_menu_icon.svg'.'" loading="lazy" width="20" height="20" class="d-block mx-auto"></td>';
                }else{
                    $ret .= '<td style="vertical-align: middle;" class="game-info text-center pt-5p pt-sm-15p pr-5p pl-5p pb-sm-15p pl-sm-0 pr-sm-0 w-sm-20">No Info</td>';
                }
                $ret .= '<td style="padding: 5px 5px; vertical-align: middle;" class="game-guide game-guide text-center  pt-5p pt-sm-15p pl-5p pb-sm-15p pl-sm-0 pr-5p pr-sm-0 w-sm-20 d-flex flex-column d-md-table-cell d-lg-table-cell d-xl-table-cell">
<span class="d-md-none d-lg-none d-xl-none d-flex text-13 justify-content-center text-dark"> <span class="text-blue pr-2p"> '.get_nmr_casinos('software',$game).' </span> Casinos</span>
<a class="d-md-none d-lg-none d-xl-none d-block mx-auto" style="width: 20px;" href="'.get_post_meta($game, 'games_custom_meta_link_1', true).'">'.get_flags( '', '', $GLOBALS['visitorsISO']).'</a>
<a class="d-md-block d-lg-block d-xl-block d-none" href="'.get_post_meta($game, 'games_custom_meta_link_1', true).'">'.get_nmr_casinos('software',$game).'</a>
</td>';
                 $ret .= '<td style="padding: 5px 5px; vertical-align: middle;" class="game-casino pl-0 pb-0 w-sm-100"><div class="d-flex justify-content-center w-sm-100 flex-wrap flex-lg-wrap flex-xl-wrap flex-md-wrap align-self-center"><a class="m-auto w-sm-10 w-15 pl-2p" href="'.get_the_permalink($cas).'"><img  width="40" height="40" src="'.get_post_meta($cas,'casino_custom_meta_sidebar_icon',true).'" loading="lazy" class="img-fluid"></a><div class="rating-toggle w-85 d-flex d-lg-flex d-md-flex d-xl-flex flex-column align-items-center text-center justify-content-center ">'.get_the_title($cas).'<span class="company-rating">'.get_rating($cas, "own").'</span></div><div class="bonus-toggle w-85 w-sm-90 align-items-center text-center justify-content-center"><a href="'.get_post_meta($cas, 'casino_custom_meta_affiliate_link' , true).'" class="font-weight-bold text-white">'.$bonusCTA.'</a><span class="text-12">'. $bonusCTA2 .'</span></div></div></td>';
                $ret .= '<td style="padding: 5px 5px; vertical-align: middle;" class="game-call pl-0 pb-0 w-sm-100"><a class="btn btn_yellow btn_large bumper d-block mx-auto w-sm-70 mb-sm-10p"  data-casinoid="'.$cas.'" data-country="'.$GLOBALS['countryISO'].'" href="'.get_post_meta($cas, 'casino_custom_meta_affiliate_link' , true).'" rel="nofollow" target="_blank">Visit</a></td>';
            $ret .= '</tr>';
        }

    wp_reset_postdata();
    $ret .= '</tbody>';
    $ret .= '</table>';
    $ret .= '</div>';


    return $ret;
}

add_shortcode('soft-table','simple_providers_table');


function providers_initial($atts, $content="null") {
    $providers = WordPressSettings::getPremiumProviders($GLOBALS['countryISO']);
//        print_r($payments);
    $pieces = explode(",", $providers);
    $sliced_array = array_slice($pieces, 0, 1);
    if ( get_post_status ( $sliced_array[0] ) == 'publish' ) {
    $limit = 10;
    }else{
        $limit = 40;
    }
    return '<div class="providers-table-filter mb-10p mt-10p">' . do_shortcode('[table layout="providers" sort_by="premium" 2nd_column_list="bonus" cta="sign_up" limit="'.$limit.'" title="Top Casinos by Provider" 2nd_col_title="Bonus" 3rd_col_title="Rating" software="'.$sliced_array[0].'"]') . '</div>';

}

add_shortcode ("geo-providers", "providers_initial");



