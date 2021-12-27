<?php
$query_casino = array( // A QUERY that initializes the default (all) IDS
    'post_type'      => array('kss_casino'),
    'post_status'    => array('publish'),
    'no_found_rows' => true,
    'update_post_term_cache' => false,
    'posts_per_page' => 500,
    'fileds' => 'ids',
    'orderby' => 'title',
    'order'   => 'ASC',
);
$cache_key = 'casino_select';
if (false === ( $query_casinos = wp_cache_get( $cache_key ) )){
    $query_casinos = get_posts($query_casino);
    wp_cache_set( $cache_key, $query_casinos, 'casino_shark', DAY_IN_SECONDS );
}
echo '<select class="form-control sidebar-nav" id="casinoselect" onChange="redirectme()">';
echo '<option>Select Casino...</option>';
    foreach ($query_casinos as $casino){
        if ($casino !== $post->ID && !get_post_meta($casino, 'casino_custom_meta_hidden', true) && !get_post_meta($casino, 'casino_custom_meta_flaged', true) && !in_array($GLOBALS['countryISO'], get_post_meta($casino, 'casino_custom_meta_rest_countries', true))) {
            echo '<option class="" value="'.get_the_permalink($casino).'">'.get_the_title($casino->ID).'</option>';
        }
    }

echo '</select>';
echo '<script type="text/javascript">function redirectme() {window.location = document.getElementById("casinoselect").value;}</script>';