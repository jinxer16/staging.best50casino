<?php
function single_table_games($atts){

$atts = shortcode_atts(
array(
'popular' => '',
), $atts, 'games-table' ) ;

$game_args = array( // A QUERY that initializes the default (all) IDS
    'post_type'      => array('kss_games'),
    'post_status'    => array('publish', 'draft'),
    'no_found_rows' => true,
    'fields' => 'ids',
    'update_post_term_cache' => false,
    'posts_per_page' => 500,

);
$cache_key = 'games_shark';
    if (false === ( $query_games = wp_cache_get( $cache_key ) )){
        $query_games = get_posts( $game_args );
        wp_cache_set( $cache_key, $query_games, 'games_shark', DAY_IN_SECONDS );
    }
$themeSettings = get_option('countries_enable_options');
$isCountryEnabledISO = in_array($GLOBALS['countryISO'] , $themeSettings['enabled_countries_iso'][0]) ? $GLOBALS['countryISO'] : 'glb';
    $localIso =  $GLOBALS['visitorsISO']; //Αν η χωρα ειναι ενεργοποιημενη
$ret  = '<div class="table-responsive single-table-games gamestable">';
    $ret .= '<table class="table table-striped d-flex flex-wrap d-md-table d-lg-table d-xl-table table-condensed w-100 medium" id="'.uniqid().'">';
    $ret .= '<thead class="casinohead">';
            $ret .= '<tr class="">';
                $ret .= '<th class="widget2-heading text-left p-4p d-table-cell  w-auto font-weight-bold">Casino Games</th>';
                $ret .= '<th class="widget2-heading text-center p-4p font-weight-bold d-table-cell w-auto">Guide</th>';
                $ret .= '<th class="widget2-heading text-center p-4p d-table-cell w-auto font-weight-bold">Demo</th>';
                $flagISO = $localIso != 'nl' ?$localIso : 'eu';
                $ret .= '<th class="widget2-heading text-center p-4p d-table-cell w-auto font-weight-bold">'.get_flags( '', '',$flagISO ).' Casinos</th>';
                 $ret .= '<th scope="col" colspan="2" class="widget2-heading text-left p-4p d-table-cell w-auto"  style="text-align:left!important;"><div class="d-flex justify-content-between font-weight-bold">Best Casino<div class="switch-wrapper font-weight-normal"><small>Ratings</small><label class="switch"><input type="checkbox"><span class="slider round"></span></label><small>Bonus</small></div></div></th>';

            $ret .= '</tr>';
        $ret .= '</thead>';
        $ret .= '<tbody>';

        foreach ($query_games as $game) {
            $gameName = implode('',get_post_meta($game, 'games_custom_meta_game_categ', true));
//            $cas = (int)get_casino_first($gameName);
            $cas = get_post_meta($game, $isCountryEnabledISO.'games_custom_meta_games_main_casino' , true);
            $casinoBonusPage = get_post_meta($cas, 'casino_custom_meta_bonus_page', true);
            $bonusName = get_post_meta($casinoBonusPage, 'bonus_custom_meta_bonus_offer', true);
            $bonusISO = get_bonus_iso($casinoBonusPage);
            $bonusCTA = get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_cta_for_top', true);
            $bonusCTA2 = get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_cta_for_top_2', true);
            $ret .= '<tr class="w-sm-100 d-xl-table-row d-lg-table-row d-md-table-row d-flex flex-wrap mb-sm-10p">';
            $ret .= '<td  style="vertical-align: middle;" class="game-name w-sm-40 text-sm-13 text-left pt-5p pt-sm-10p pl-5p pl-sm-0 pb-sm-15p pr-5p pr-sm-0"><img width="20" height="20" loading="lazy" src="'.get_post_meta($game, 'games_custom_meta_icon', true).'">   <a href="'.get_post_meta($game, 'games_custom_meta_link_1', true).'" style="margin-left:5px;font-weight: 500;">'.ucwords(str_replace("Stud ", "",$gameName)).'</a></td>';
                if(get_post_meta($game, 'games_custom_meta_link_1', true)){
                    $ret .= '<td style="vertical-align: middle;" class="game-guide pt-5p pt-sm-15p pl-5p pl-sm-0 pb-sm-15p pr-5p pr-sm-0 text-center w-sm-20"><a class="" href="'.get_post_meta($game, 'games_custom_meta_link_1', true).'"><img src="'.get_template_directory_uri().'/assets/images/svg/guide.svg'.'" width="20" height="20" loading="lazy"></a></td>';
                }else{
                    $ret .= '<td style="vertical-align: middle;" class="game-guide pt-5p pt-sm-15p pl-5p pl-sm-0 pb-sm-15p pr-5p pr-sm-0 text-center w-sm-20 disabledRow"><img src="'.get_template_directory_uri().'/assets/images/svg/guide.svg'.'" loading="lazy" width="20" height="20"></td>';
                }
                if(get_post_status($game) == 'draft'){
                    $ret .= '<td style="vertical-align: middle;" class="game-demo pt-5p pt-sm-15p pl-5p pl-sm-0 pb-sm-15p pr-5p pr-sm-0 text-center w-sm-20 disabledRow"><img src="'.get_template_directory_uri().'/assets/images/svg/demo.svg'.'" loading="lazy" width="20" height="20"></td>';
                }else{
                    $ret .= '<td style="vertical-align: middle;" class="game-demo pt-5p pt-sm-15p pl-5p pl-sm-0 pb-sm-15p pr-5p pr-sm-0 text-center w-sm-20"><a class="" href="'.get_the_permalink($game).'"><img src="'.get_template_directory_uri().'/assets/images/svg/demo.svg'.'"  width="20" height="20"></a></td>';
                }
            $ret .= '<td style="vertical-align: middle;" class="game-guide pt-5p pt-sm-15p pl-5p pl-sm-0 pb-sm-15p pr-5p pr-sm-0 text-center w-sm-20"><a href="'.get_post_meta($game, 'games_custom_meta_link_1', true).'">'.get_nmr_casinos('games',$gameName).'</a></td>';
            $ret .= '<td style="padding: 5px 5px; vertical-align: middle;" class="game-casino pl-0 pb-0 w-sm-100"><div class="d-flex justify-content-center w-sm-100 flex-wrap flex-lg-wrap flex-xl-wrap flex-md-wrap align-self-center"><a class="m-auto w-sm-10 w-15 pl-2p" href="'.get_the_permalink($cas).'"><img  width="40" height="40" src="'.get_post_meta($cas,'casino_custom_meta_sidebar_icon',true).'" loading="lazy" class="img-fluid"></a><div class="rating-toggle w-85  d-flex d-lg-flex d-md-flex d-xl-flex flex-column align-items-center text-center justify-content-center ">'.get_the_title($cas).'<span class="company-rating">'.get_rating($cas, "own").'</span></div><div class="bonus-toggle w-85 w-sm-90 align-items-center text-center justify-content-center"><a href="'.get_post_meta($cas, 'casino_custom_meta_affiliate_link' , true).'" class="font-weight-bold text-white">'.$bonusCTA.'</a><span class="text-12">'. $bonusCTA2 .'</span></div></div></td>';
            $ret .= '<td style="padding: 5px 5px; vertical-align: middle;" class="game-call pl-0 pb-0 w-sm-100"><a class="btn btn_yellow text-decoration-none btn_large bumper d-block mx-auto w-sm-70 mb-sm-10p"  data-casinoid="'.$cas.'" data-country="'.$isCountryEnabledISO.'" href="'.get_post_meta($cas, 'casino_custom_meta_affiliate_link' , true).'" rel="nofollow" target="_blank">Visit</a></td>';
            $ret .= '</tr>';
        }

    wp_reset_postdata();
        $ret .= '</tbody>';
    $ret .= '</table>';
$ret .= '</div>';



return $ret;
}

add_shortcode('games-table','single_table_games');