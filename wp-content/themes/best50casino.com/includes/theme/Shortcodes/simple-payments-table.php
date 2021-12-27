<?php

function simple_payments_table($atts){

    $atts = shortcode_atts(
        array(
            'popular' => '',
        ), $atts, 'pay-table' ) ;

    $game_args = array( // A QUERY that initializes the default (all) IDS
        'post_type'      => array('kss_transactions'),
        'post_status'    => array('publish', 'draft'),
        'no_found_rows' => true,
        'update_post_term_cache' => false,
        'fields' => 'ids',
        'posts_per_page' => 500,
        'orderby' => array(
            'title'      => 'ASC',
            'post_status' => 'ASC'
        )
    );
    $filter = function() {
        return 'post_status DESC';
    };
    //add_filter('posts_orderby', $filter);
    $cache_key = 'pay_shark';
    if (false === ( $query_games = wp_cache_get( $cache_key ) )){
        $query_games = get_posts( $game_args );
        wp_cache_set( $cache_key, $query_games, 'pay_shark', DAY_IN_SECONDS );
    }
   // remove_filter('posts_orderby', $filter);

    $countryISO = $GLOBALS['countryISO'];
    $localIso =  $GLOBALS['visitorsISO']; //Αν η χωρα ειναι ενεργοποιημενη

    $ret  = '<div class="table-responsive single-table-games paymentstable">';
        $ret .= '<table class="table table-striped d-flex flex-wrap d-md-table d-lg-table d-xl-table table-condensed w-100 medium" id="'.uniqid().'">';
            $ret .= '<thead class="casinohead">';
                $ret .= '<tr class="">';
                    $ret .= '<th scope="col" class="widget2-heading text-left p-4p d-table-cell  w-auto font-weight-bold">Payment</th>';
                    $ret .= '<th scope="col" class="widget2-heading text-center p-4p font-weight-bold d-table-cell w-auto">Guide</th>';
                    //$ret .= '<th class="widget2-heading text-center"><b>'.get_flags( '', '', $GLOBALS['countryISO']).' Deposits</b></th>';
                    $ret .= '<th scope="col" class="widget2-heading text-center p-4p d-table-cell w-auto font-weight-bold">'.get_flags( '', '', $localIso).' Casino Available</th>';
                    $ret .= '<th scope="col" colspan="2" class="widget2-heading text-left p-4p d-table-cell w-auto"  style="text-align:left!important;"><div class="d-flex justify-content-between font-weight-bold">Best Casino<div class="switch-wrapper font-weight-normal"><small>Ratings</small><label class="switch"><input type="checkbox"><span class="slider round"></span></label><small>Bonus</small></div></div></th>';
                $ret .= '</tr>';
            $ret .= '</thead>';
            $ret .= '<tbody>';

                foreach ($query_games as $game) {
                    $cas = get_post_meta($game, $countryISO.'transactions_custom_meta_main_casino' , true);
                    $casinoBonusPage = get_post_meta($cas, 'casino_custom_meta_bonus_page', true);
                    $bonusName = get_post_meta($casinoBonusPage, 'bonus_custom_meta_bonus_offer', true);
                    $bonusISO = get_bonus_iso($casinoBonusPage);
                    $bonusCTA = get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_cta_for_top', true);
                    $bonusCTA2 = get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_cta_for_top_2', true);
                    $ret .= '<tr class="w-sm-100 d-xl-table-row d-lg-table-row d-md-table-row d-flex flex-wrap mb-sm-10p">';
                        $ret .= '<td align="middle" style="vertical-align: middle;" class="pay-name-logo text-left pt-5p pt-sm-15p pl-0 pb-sm-15p pr-5p pr-sm-0 w-sm-50"><img width="40" height="40" class="img-fluid" alt="'.get_the_title($game).'" loading="lazy" src="'.get_post_meta($game, 'casino_custom_meta_sidebar_icon', true).'"> '.get_the_title($game).'</td>';
                        if(get_post_status($game) == 'draft'){
                            $ret .= '<td align="middle" style=" vertical-align: middle;" class="game-guide pt-5p pt-sm-15p pl-0 pb-sm-15p pr-5p pr-sm-0 text-center w-sm-10 disabledRow"><img src="'.get_template_directory_uri().'/assets/images/svg/guide.svg'.'" width="20" height="20" loading="lazy"></td>';
                        }else{
                            $ret .= '<td style="vertical-align: middle;" class="game-guide text-center pt-5p pt-sm-15p pb-sm-15p pr-5p pl-0 pr-sm-0 w-sm-10"><a class="" href="'.get_the_permalink($game).'"><img src="'.get_template_directory_uri().'/assets/images/svg/guide.svg'.'" width="20" height="20" loading="lazy"></a></td>';
                        }
                       // $ret .= '<td style="padding: 5px 3px;" class="game-guide">'.get_nmr_casinos('payments',get_the_title($game)).'</td>';
                        $ret .= '<td style="vertical-align: middle;" class="game-guide text-center pt-5p pt-sm-15p pl-0 pb-sm-15p pr-5p pr-sm-0 w-sm-40">'.get_nmr_casinos('payments',$game).' <img data-toggle="tooltip" title="Deposit Available" src="'.get_template_directory_uri().'/assets/images/svg/deposit.svg'.'" width="25" height="25" loading="lazy" class="mr-20p m-sm-0p"> | <img  data-toggle="tooltip" title="Withdrawal Available" src="'.get_template_directory_uri().'/assets/images/svg/withdrawal.svg'.'" width="25" height="25" loading="lazy" class="ml-20p m-sm-0p"> '.get_nmr_casinos('payments2',$game).'</td>';
                        $ret .= '<td style="padding: 5px 5px; vertical-align: middle;" class="game-casino pl-0 pb-0 w-sm-100"><div class="d-flex justify-content-center w-sm-100 flex-wrap align-self-center"><a class="m-auto w-sm-10 w-15 pl-2p" href="'.get_the_permalink($cas).'"><img  width="40" height="40" loading="lazy" src="'.get_post_meta($cas,'casino_custom_meta_sidebar_icon',true).'" class="img-fluid"></a><div class="rating-toggle w-85 d-flex d-lg-flex d-md-flex d-xl-flex flex-column align-items-center text-center justify-content-center ">'.get_the_title($cas).'<span class="company-rating">'.get_rating($cas, "own").'</span></div><div class="bonus-toggle w-85 w-sm-90 align-items-center text-center justify-content-center"><a href="'.get_post_meta($cas, 'casino_custom_meta_affiliate_link' , true).'" class="font-weight-bold text-white">'.$bonusCTA.'</a><span class="text-12">'. $bonusCTA2 .'</span></div></div></td>';
                        $ret .= '<td style="padding: 5px 5px; vertical-align: middle;" class="game-call pl-0 pb-0 w-sm-100"><a class="btn btn_yellow btn_large bumper d-block mx-auto w-sm-70 mb-sm-10p"  data-casinoid="'.$cas.'" data-country="'.$countryISO.'" href="'.get_post_meta($cas, 'casino_custom_meta_affiliate_link' , true).'" rel="nofollow" target="_blank">Visit</a></td>';
                    $ret .= '</tr>';
                }

            wp_reset_postdata();
            $ret .= '</tbody>';
        $ret .= '</table>';
    $ret .= '</div>';


    return $ret;
}

add_shortcode('pay-table','simple_payments_table');




function more_payments_table($atts){

    $atts = shortcode_atts(
        array(
            'popular' => '',
        ), $atts, 'more-pay-table' ) ;


    $payments = WordPressSettings::getPremiumPayments($GLOBALS['countryISO']);
//        print_r($payments);
    $pieces = explode(",", $payments);
    $sliced_array = array_slice($pieces, 0, 6);
    $morepayments = array_slice($pieces,6);


    $countryISO = $GLOBALS['countryISO'];
    $localIso =  $GLOBALS['visitorsISO']; //Αν η χωρα ειναι ενεργοποιημενη

    $ret = '<h2 class="content-title mb-10p mt-10p">More Payments</h2>';
    $ret  .= '<div class="table-responsive single-table-games paymentstable">';
    $ret .= '<table class="table table-striped d-flex flex-wrap d-md-table d-lg-table d-xl-table table-condensed w-100 medium" id="'.uniqid().'">';
    $ret .= '<thead class="casinohead">';
    $ret .= '<tr class="">';
    $ret .= '<th scope="col" class="widget2-heading text-left p-4p d-table-cell  w-auto font-weight-bold">Payment</th>';
    $ret .= '<th scope="col" class="widget2-heading text-center p-4p font-weight-bold d-table-cell w-auto">Guide</th>';
    //$ret .= '<th class="widget2-heading text-center"><b>'.get_flags( '', '', $GLOBALS['countryISO']).' Deposits</b></th>';
    $ret .= '<th scope="col" class="widget2-heading text-center p-4p d-table-cell w-auto font-weight-bold">'.get_flags( '', '', $localIso).' Casino Available</th>';
    $ret .= '<th scope="col" colspan="2" class="widget2-heading text-left p-4p d-table-cell w-auto"  style="text-align:left!important;"><div class="d-flex justify-content-between font-weight-bold">Best Casino<div class="switch-wrapper font-weight-normal"><small>Ratings</small><label class="switch"><input type="checkbox"><span class="slider round"></span></label><small>Bonus</small></div></div></th>';
    $ret .= '</tr>';
    $ret .= '</thead>';
    $ret .= '<tbody>';

    foreach ($morepayments as $game) {
        if (get_post_status($game) == 'publish'){
        $cas = get_post_meta($game, $countryISO.'transactions_custom_meta_main_casino' , true);
        $casinoBonusPage = get_post_meta($cas, 'casino_custom_meta_bonus_page', true);
        $bonusName = get_post_meta($casinoBonusPage, 'bonus_custom_meta_bonus_offer', true);
        $bonusISO = get_bonus_iso($casinoBonusPage);
        $bonusCTA = get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_cta_for_top', true);
        $bonusCTA2 = get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_cta_for_top_2', true);
        $ret .= '<tr class="w-sm-100 d-xl-table-row d-lg-table-row d-md-table-row d-flex flex-wrap mb-sm-10p">';
        $ret .= '<td align="middle" style="vertical-align: middle;" class="pay-name-logo text-left pt-5p pt-sm-15p pl-0 pb-sm-15p pr-5p pr-sm-0 w-sm-50"><img width="40" height="40" class="img-fluid" alt="'.get_the_title($game).'" loading="lazy" src="'.get_post_meta($game, 'casino_custom_meta_sidebar_icon', true).'"> '.get_the_title($game).'</td>';
        if(get_post_status($game) == 'draft'){
            $ret .= '<td align="middle" style=" vertical-align: middle;" class="game-guide pt-5p pt-sm-15p pl-0 pb-sm-15p pr-5p pr-sm-0 text-center w-sm-10 disabledRow"><img src="'.get_template_directory_uri().'/assets/images/svg/guide.svg'.'" width="20" height="20" loading="lazy"></td>';
        }else{
            $ret .= '<td style="vertical-align: middle;" class="game-guide text-center pt-5p pt-sm-15p pb-sm-15p pr-5p pl-0 pr-sm-0 w-sm-10"><a class="" href="'.get_the_permalink($game).'"><img src="'.get_template_directory_uri().'/assets/images/svg/guide.svg'.'" width="20" height="20" loadning="lazy"></a></td>';
        }
        // $ret .= '<td style="padding: 5px 3px;" class="game-guide">'.get_nmr_casinos('payments',get_the_title($game)).'</td>';
        $ret .= '<td style="vertical-align: middle;" class="game-guide text-center pt-5p pt-sm-15p pl-0 pb-sm-15p pr-5p pr-sm-0 w-sm-40">'.get_nmr_casinos('payments',$game).' <img data-toggle="tooltip" title="Deposit Available" src="'.get_template_directory_uri().'/assets/images/svg/deposit.svg'.'" width="25" height="25" loading="lazy" class="mr-20p m-sm-0p"> | <img  data-toggle="tooltip" title="Withdrawal Available" src="'.get_template_directory_uri().'/assets/images/svg/withdrawal.svg'.'" width="25" height="25" loading="lazy" class="ml-20p m-sm-0p"> '.get_nmr_casinos('payments2',$game).'</td>';
        $ret .= '<td style="padding: 5px 5px; vertical-align: middle;" class="game-casino pl-0 pb-0 w-sm-100"><div class="d-flex justify-content-center w-sm-100 flex-wrap align-self-center"><a class="m-auto w-sm-10 w-15 pl-2p" href="'.get_the_permalink($cas).'"><img  width="40" height="40" src="'.get_post_meta($cas,'casino_custom_meta_sidebar_icon',true).'" loading="lazy" class="img-fluid"></a><div class="rating-toggle w-85 d-flex d-lg-flex d-md-flex d-xl-flex flex-column align-items-center text-center justify-content-center ">'.get_the_title($cas).'<span class="company-rating">'.get_rating($cas, "own").'</span></div><div class="bonus-toggle w-85 w-sm-90 align-items-center text-center justify-content-center"><a href="'.get_post_meta($cas, 'casino_custom_meta_affiliate_link' , true).'" class="font-weight-bold text-white">'.$bonusCTA.'</a><span class="text-12">'. $bonusCTA2 .'</span></div></div></td>';
        $ret .= '<td style="padding: 5px 5px; vertical-align: middle;" class="game-call pl-0 pb-0 w-sm-100"><a class="btn btn_yellow btn_large bumper d-block mx-auto w-sm-70 mb-sm-10p"  data-casinoid="'.$cas.'" data-country="'.$countryISO.'" href="'.get_post_meta($cas, 'casino_custom_meta_affiliate_link' , true).'" rel="nofollow" target="_blank">Visit</a></td>';
        $ret .= '</tr>';
    }
    }

    wp_reset_postdata();
    $ret .= '</tbody>';
    $ret .= '</table>';
    $ret .= '</div>';


    return $ret;
}
add_shortcode('more-pay-table','more_payments_table');



function more_payments($atts){

    $atts = shortcode_atts(
        array(
            'popular' => '',
        ), $atts, 'more-payments' ) ;


    $payments = WordPressSettings::getPremiumPayments($GLOBALS['countryISO']);
//        print_r($payments);
    $pieces = explode(",", $payments);
    $sliced_array = array_slice($pieces, 0, 6);
    $morepayments = array_slice($pieces,6);

    ob_start();
    ?>
    <h2 class="content-title mb-10p mt-10p">More Payments</h2>
    <div class="d-flex flex-wrap w-100">

<?php
    foreach ($morepayments as $paymentid){
        if (get_post_status($paymentid) == 'publish'){
        $image_id = get_post_meta($paymentid, 'casino_custom_meta_sidebar_icon', true);
        $title = get_the_title($paymentid);
        $count = strlen($title);
        if($count > 16){
            $titleShort = substr($title, 0, 16);
        }else{
            $titleShort= null;
        }

        ?>
        <a class="p-10p border-trans payment-box ml-2p mt-1p text-decoration-none mb-1p mr-2p"  href="<?= get_the_permalink($paymentid);?>">
            <div class="d-flex flex-wrap">
                <div class="w-100 w-sm-100 d-flex flex-wrap align-self-center">
                    <img class="w-15 img-fluid float-right" style="width: 44px"  loading="lazy" src="<?= $image_id;?>">
                    <?php
                    if ($titleShort){
                        echo '<span data-toggle="tooltip" title="'.$title.'" class="w-85 text-14 text-sm-13 align-self-center pl-5p"> '.$titleShort.'</span>';
                    }else{
                        echo '<span class="w-85 text-14 text-sm-13 align-self-center pl-5p"> '.$title.'</span>';
                    }
                    ?>
                </div>
            </div>
        </a>

        <?php
    }}
    ?>
    </div>
<?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;

}
add_shortcode('more-payments','more_payments');


function payment_initial($atts, $content="null") {
    $payments = WordPressSettings::getPremiumPayments($GLOBALS['countryISO']);
//        print_r($payments);
    $pieces = explode(",", $payments);
    $sliced_array = array_slice($pieces, 0, 6);
    return '<div class="pay-table-filter mb-10p mt-10p">' . do_shortcode('[table layout="payments" sort_by="premium" cat_in="48"  2nd_column_list="bonus" cta="sign_up" limit="10" title="Top Casinos by Payment Methods" 2nd_col_title="Bonus" 3rd_col_title="Rating" deposit="'.$sliced_array[0].'"]') . '</div>';
}
add_shortcode ("parent-payment", "payment_initial");

















