<?php
/* Template Name: Payments Parent */
?>
<?php get_header(); ?>
<body <?php body_class(); ?> >
<?php include(locate_template('common-templates/main-menu.php', false, false)); ?>
<?php include(locate_template('common-templates/sub-menu.php', false, false)); ?>
<div class="container body-bg">
    <div class="col-12 page-bg page-shadow">
        <?php
        get_template_part("templates/mobile_head_gadgets");
?>
        <div class="d-flex flex-wrap w-100">
            <?php echo apply_filters('the_content', get_the_content($post->ID)); ?>
        <?php

        $payments = WordPressSettings::getPremiumPayments($GLOBALS['countryISO']);
//        print_r($payments);
        $pieces = explode(",", $payments);
        $sliced_array = array_slice($pieces, 0, 6);
        $morepayments = array_slice($pieces,6);
        $i = 0;

        foreach ($sliced_array as $paymentid){
            $image_id = get_post_meta($paymentid, 'casino_custom_meta_sidebar_icon', true);
        if ($i == 0) {
            ?>
            <a class="w-30 p-10p border-trans filtersheadings activefilter" data-title="<?=get_the_title($paymentid);?>"  onclick="filter_payments(event,this)" data-id="<?=$paymentid?>">
                <div class="d-flex flex-wrap">
                    <div class="w-30 d-flex align-self-center ">
                      <img class="img-fluid float-right" loading="lazy" style="width: 44px"  src="<?= $image_id;?>">
                        <span class="">
                              <?=get_the_title($paymentid);?>
                        </span>
                    </div>
                    <div class="w-70 align-self-center">
                        <?=get_nmr_casinos('payments',$paymentid)?>
                        <img data-toggle="tooltip" title="Deposit Available"  src="/wp-content/themes/best50casino.com/assets/images/svg/deposit.svg" width="25" height="25" loading="lazy" class="mr-20p m-sm-0p"> |
                        <img  data-toggle="tooltip" title="Withdrawal Available" src="/wp-content/themes/best50casino.com/assets/images/svg/withdrawal.svg" width="25" height="25" loading="lazy" class="ml-20p m-sm-0p">
                        <?=get_nmr_casinos('payments2',$paymentid);?>
                    </div>
                </div>
            </a>
            <?php
        }else{
            ?>
            <a class="w-30 p-10p border-trans filtersheadings"  data-title="<?=get_the_title($paymentid);?>" onclick="filter_payments(event,this)" data-id="<?=$paymentid?>">
                <div class="d-flex flex-wrap">
                    <div class="w-20 d-flex">
                        <img class="img-fluid float-right" style="width: 44px" loading="lazy" src="<?= $image_id;?>">
                        <?=get_the_title($paymentid);?>
                    </div>
                    <div class="w-80">
                        <?=get_nmr_casinos('payments',$paymentid)?>
                        <img data-toggle="tooltip" title="Deposit Available"  loading="lazy" src="/wp-content/themes/best50casino.com/assets/images/svg/deposit.svg" width="25" height="25" class="mr-20p m-sm-0p"> |
                        <img  data-toggle="tooltip" title="Withdrawal Available" loading="lazy" src="/wp-content/themes/best50casino.com/assets/images/svg/withdrawal.svg" width="25" height="25" class="ml-20p m-sm-0p">
                        <?=get_nmr_casinos('payments2',$paymentid);?>
                    </div>
                </div>
            </a>
            <?php
        }
        ?>
        <?php
        }

        do_shortcode('[table layout="payments" sort_by="premium" cat_in="48" 2nd_column_list="bonus" cta="sign_up"  title="Exclusive Casino No Deposit Bonuses" 2nd_col_title="Bonus" 3rd_col_title=" Rating"]');
        do_shortcode('[table layout="default_2" sort_by="premium" cat_in="48" 2nd_column_list="bonus" cta="sign_up"  title="Exclusive Casino No Deposit Bonuses" 2nd_col_title="Bonus" 3rd_col_title=" Rating"]');


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

        foreach ($morepayments as $game) {
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
            $ret .= '<td style="vertical-align: middle;" class="game-guide text-center pt-5p pt-sm-15p pl-0 pb-sm-15p pr-5p pr-sm-0 w-sm-40">'.get_nmr_casinos('payments',$game).' <img data-toggle="tooltip" title="Deposit Available" src="'.get_template_directory_uri().'/assets/images/svg/deposit.svg'.'" loading="lazy" width="25" height="25" class="mr-20p m-sm-0p"> | <img  data-toggle="tooltip" title="Withdrawal Available" src="'.get_template_directory_uri().'/assets/images/svg/withdrawal.svg'.'" width="25" height="25" loading="lazy" class=" ml-20p m-sm-0p"> '.get_nmr_casinos('payments2',$game).'</td>';
            $ret .= '<td style="padding: 5px 5px; vertical-align: middle;" class="game-casino pl-0 pb-0 w-sm-100"><div class="d-flex justify-content-center w-sm-100 flex-wrap align-self-center"><a class="m-auto w-sm-10 w-15 pl-2p" href="'.get_the_permalink($cas).'"><img  width="40" height="40" src="'.get_post_meta($cas,'casino_custom_meta_sidebar_icon',true).'" loading="lazy" class="img-fluid"></a><div class="rating-toggle w-85 d-flex d-lg-flex d-md-flex d-xl-flex flex-column align-items-center text-center justify-content-center ">'.get_the_title($cas).'<span class="company-rating">'.get_rating($cas, "own").'</span></div><div class="bonus-toggle w-85 w-sm-90 align-items-center text-center justify-content-center"><a href="'.get_post_meta($cas, 'casino_custom_meta_affiliate_link' , true).'" class="font-weight-bold text-white">'.$bonusCTA.'</a><span class="text-12">'. $bonusCTA2 .'</span></div></div></td>';
            $ret .= '<td style="padding: 5px 5px; vertical-align: middle;" class="game-call pl-0 pb-0 w-sm-100"><a class="btn btn_yellow btn_large bumper d-block mx-auto w-sm-70 mb-sm-10p"  data-casinoid="'.$cas.'" data-country="'.$countryISO.'" href="'.get_post_meta($cas, 'casino_custom_meta_affiliate_link' , true).'" rel="nofollow" target="_blank">Visit</a></td>';
            $ret .= '</tr>';
        }

        wp_reset_postdata();
        $ret .= '</tbody>';
        $ret .= '</table>';
        $ret .= '</div>';


        echo $ret;
        ?>


        </div>



    </div>
</div>
<?php get_footer(); ?>
