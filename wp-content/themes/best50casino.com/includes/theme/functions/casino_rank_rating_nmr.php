<?php

function get_nmr_casinos($type = "", $slotsID = "")
{
    if ($type === 'software') {
        $key = 'casino_custom_meta_softwares';
        $key2 = 'casino_custom_meta_live_softwares';
    } elseif ($type === 'payments') {
        $key = 'casino_custom_meta_dep_options';
    } elseif ($type === 'payments2') {
        $key = 'casino_custom_meta_withd_options';
    } elseif ($type === 'countries') {
        $key = 'casino_custom_meta_countries';
    } elseif ($type === 'games') {
        $key = 'casino_custom_meta_games';
        $key2 = 'casino_custom_meta_live_games';
    }
    if (!empty($key2)) {
        $deps_atts = array( // A QUERY that initializes the default (all) IDS
            'post_type' => array('kss_casino'),
            'post_status' => array('publish'),
            'posts_per_page' => -1,
            'fields' => 'ids',
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => $key,
                    'value' => $slotsID,
                    'compare' => 'LIKE',
                ),
                array(
                    'key' => $key2,
                    'value' => $slotsID,
                    'compare' => 'LIKE',
                ),
            ),
        );
    } else {
        $deps_atts = array( // A QUERY that initializes the default (all) IDS
            'post_type' => array('kss_casino'),
            'post_status' => array('publish'),
            'posts_per_page' => 999,
            'fields'=> 'ids',
            'meta_query' => array(
                array(
                    'key' => $key,
                    'value' => $slotsID,
                    'compare' => 'LIKE',
                ),
            ),
        );
    }
    $deps = get_posts($deps_atts);
    $red = [];
    foreach ($deps as $dep) {
        //
        if (!get_post_meta($dep, 'casino_custom_meta_hidden', true) && !get_post_meta($dep, 'casino_custom_meta_flaged', true) && !in_array($GLOBALS['countryISO'], get_post_meta($dep, 'casino_custom_meta_rest_countries', true))) {
            $red[] = $dep;
        }
    }
    return count($red);
}

function get_rating($ID = "", $own="",$rating=null){
    if ($own === "own"){
        $rating = get_post_meta((int)$ID, 'casino_custom_meta_sum_rating', true);
        $rating = is_numeric($rating) ? $rating : 0;
        $rating2 = round($rating / 2, 1);
        $ratingWhole = floor($rating2);
        $ratingDecimal = $rating2 - $ratingWhole;
        $j = 5;
        $html ='';
        for($i=0;$i<$ratingWhole;$i++){
            $j -=1 ;
            $html .= '<i class="fa fa-star" aria-hidden="true"></i>';
        }
        if($ratingDecimal != 0){
            $j -=1 ;
            $html .= '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
        }
        for($i=0;$i<$j;$i++){
            $html .= '<i class="fa fa-star-o" aria-hidden="true"></i>';
        }
        return $html;
    }elseif ($own === "this"){
        $ratingWhole = floor($rating);
        $ratingDecimal = $rating - $ratingWhole;
        $j = 5;
        $html ='';
        for($i=0;$i<$ratingWhole;$i++){
            $j -=1 ;
            $html .= '<i class="fa fa-star" aria-hidden="true"></i>';
        }
        if($ratingDecimal != 0){
            $j -=1 ;
            $html .= '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
        }
        for($i=0;$i<$j;$i++){
            $html .= '<i class="fa fa-star-o" aria-hidden="true"></i>';
        }
        return $html;
    }elseif($own === "with_text"){
        $rating = get_post_meta($ID, 'casino_custom_meta_sum_rating', true);
        $rating = is_numeric($rating) ? $rating : 0;
        $ratingWhole = floor($rating);
        $ratingDecimal = $rating - $ratingWhole;
        $j = 10;
        $ratingText='';
        if($rating >= 9.1){
            $ratingText = 'EXCELLENT '.$rating;
        }elseif($rating >= 8.001 && $rating <= 9){
            $ratingText = 'VERY GOOD '.$rating;
        }elseif($rating >= 7.001 && $rating <= 8){
            $ratingText = 'GOOD '.$rating;
        }elseif($rating >= 6.001 && $rating <= 7){
            $ratingText = 'AVERAGE '.$rating;
        }elseif($rating >= 5.001 && $rating <= 6){
            $ratingText = 'POOR '.$rating;
        }elseif($rating <= 5){
            $ratingText = 'AVOID '.$rating;
        }
        $html = $ratingText.'&nbsp;&nbsp;&nbsp;';
        for($i=0;$i<$ratingWhole;$i++){
            $j -=1 ;
            $html .= '<i class="fa fa-star" aria-hidden="true"></i>';
        }
        if($ratingDecimal != 0){
            $j -=1 ;
            $html .= '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
        }
        for($i=0;$i<$j;$i++){
            $html .= '<i class="fa fa-star-o" aria-hidden="true"></i>';
        }
        return $html;
    }elseif($own === "no_text"){
        $rating = get_post_meta($ID, 'casino_custom_meta_sum_rating', true);
        $ratingWhole = floor($rating);
        $ratingDecimal = $rating - $ratingWhole;
        $j = 10;
        $html=$rating.'&nbsp;&nbsp;&nbsp;<span class="rat-stars">';
        for($i=0;$i<$ratingWhole;$i++){
            $j -=1 ;
            $html .= '<i class="fa fa-star" aria-hidden="true"></i>';
        }
        if($ratingDecimal != 0){
            $j -=1 ;
            $html .= '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
        }
        for($i=0;$i<$j;$i++){
            $html .= '<i class="fa fa-star-o" aria-hidden="true"></i>';
        }
        $html .= '</span>';
        return $html;
    } elseif($own === "frontpage"){
        $rating = get_post_meta($ID, 'casino_custom_meta_sum_rating', true);
        $sum = $rating /2;
        $ratingWhole = floor($sum);
        $ratingDecimal = $sum - $ratingWhole;
        $j = 5;
        $html = '<span class="text-white font-weight-bold text-16">'.$rating.'/10</span>';
        $html .='<span class="rat-stars pl-10p">';
        for($i=0;$i<$ratingWhole;$i++){
            $j -=1 ;
            $html .= '<i class="fa fa-star pl-5p text-16 gold" aria-hidden="true"></i>';
        }
        if($ratingDecimal !== 0){
            $j -=1 ;
            $html .= '<i class="fa fa-star-half-o pl-5p text-16 gold" aria-hidden="true"></i>';
        }
        for($i=0;$i<$j;$i++){
            $html .= '<i class="fa fa-star pl-5p text-16 gray-color" aria-hidden="true"></i>';
        }
        $html .= '</span>';
        return $html;
    }elseif($own === "numbers"){
        $rating = get_post_meta($ID, 'casino_custom_meta_sum_rating', true);
        $rating = is_numeric($rating) ? $rating : 0;
        $rating2 = round($rating / 2, 1);

            $html = '<span class="text-primary">' . round($rating, 1) . '/10</span><div style="color: #ffcd00;font-size: 15px;">';
            $ratingWhole = floor($rating2);
            $ratingDecimal = $rating2 - $ratingWhole;
            $j = 5;
            for ($i = 0; $i < $ratingWhole; $i++) {
                $j -= 1;
                $html .= '<i class="fa fa-star" aria-hidden="true"></i>';
            }
            if ($ratingDecimal != 0) {
                $j -= 1;
                $html .= '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
            }
            for ($i = 0; $i < $j; $i++) {
                $html .= '<i class="fa fa-star-o" aria-hidden="true"></i>';
            }
            $html .= '</div>';
            return $html;
    }elseif($own === "svg"){
        $rating = get_post_meta($ID, 'casino_custom_meta_sum_rating', true);
        $rating2 = round($rating/2,1);
        $html =[];
        $ratingWhole = floor($rating2);
        $ratingDecimal = $rating2 - $ratingWhole;
        $j = 5;
        for($i=0;$i<$ratingWhole;$i++){
            $j -=1 ;
            $html[] = 'full';
        }
        if($ratingDecimal != 0){
            $j -=1 ;
            $html[]= 'half';
        }
        for($i=0;$i<$j;$i++){
            $html[]= 'empty';
        }
        return $html;
    }else{
        return do_shortcode('[yasr_visitor_votes size="small" postid="'.$ID.'"]');
    }
}



function get_rank_casino($casinoID = NULL)
{
    $visitorsCountryISO = $GLOBALS['countryISO'];
    $query_casino = array( // A QUERY that initializes the default (all) IDS
        'post_type' => array('kss_casino'),
        'post_status' => array('publish'),
        'fields' => 'ids',
        'no_found_rows' => true,
        'update_post_term_cache' => false,
        'posts_per_page' => -1,
        'orderby' => 'meta_value_num',
        'meta_key' => 'casino_custom_meta_sum_rating',
        'order' => 'DESC',
        'suppress_filters' => true,
    );
    $cache_key = 'casino_ratings' . md5($visitorsCountryISO);
    if (false === ($query_casinos = wp_cache_get($cache_key))) {
        $query_casinos = new WP_Query($query_casino);
        wp_cache_set($cache_key, $query_casinos, 'casino_shark', DAY_IN_SECONDS);
    }
    if ($query_casinos->have_posts()):
        $ret = $query_casinos->posts;
        $query_casinos->posts = array();
        foreach ($ret as $result) {
            $filetz = array_flip(get_post_meta($result, 'casino_custom_meta_rest_countries', true));
            if (isset($filetz[$visitorsCountryISO]) || !$filetz) {
                $query_casinos->posts[] = $result;
            }
        }
    endif;
    $ret = get_posts($query_casino);
    $ret_flipped = array_flip($ret);
    $ret = $ret_flipped[$casinoID] + 1;
    return $ret;
}