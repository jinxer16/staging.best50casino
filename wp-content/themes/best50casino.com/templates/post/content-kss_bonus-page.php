<?php get_header(); ?>
<?php
$bookieid = get_post_meta($post->ID, 'bonus_custom_meta_bookie_offer', true);
$countryISO = $GLOBALS['countryISO'];
$localIso =  $GLOBALS['visitorsISO']; //
$bonusISO = get_bonus_iso($post->ID);
$bonusName = get_post_meta($post->ID, 'bonus_custom_meta_bonus_offer', true);
$geoBonusArgs = is_country_enabled($bonusName,$bookieid,'bc_bonus');
$bookiename = get_the_title($bookieid);
//Αν η χωρα ειναι ενεργοποιημενη    $countryISO = $GLOBALS['countryISO'];
$offerList = explode( ",", get_post_meta($bookieid, 'casino_custom_meta_why_play', true));
 $image_id = get_post_meta($bookieid, 'casino_custom_meta_comp_screen_1', true);
 $image = wp_get_attachment_image_src($bookieid, 'thumb-230', true);
 $logo = get_post_meta($bookieid, 'casino_custom_meta_trans_logo', true);
$imge_id = getImageId(get_post_meta($bookieid, 'casino_custom_meta_sidebar_icon', true));

$ctaLink = $geoBonusArgs['aff_bo'];
$ctaFunction = $geoBonusArgs['ctaFunction'] ;

$countriesEnabledArray = \WordPressSettings::getCountryEnabledSettings();
$thisISO = WordPressSettings::isCountryActive($countryISO);
$premiumCasinosstring = WordPressSettings::getPremiumCasino($countryISO,'premium');

$premiumCasinosArray =  explode(",",$premiumCasinosstring);
$isCasinoPremium = in_array($bookieid, $premiumCasinosArray);
//$premiumCasinosArray =  array_values( $premiumCasinosArray);
$numberCasinos = count($premiumCasinosArray);
if ($numberCasinos>4){
    $premiumCasinosArray = array_slice($premiumCasinosArray, 0, 4);
    $colNumber = 3;
}else{
    $colNumber = 12/$numberCasinos;
}
?>
<?php //echo get_post_meta($bonusName, 'bs_custom_meta_parent_casino', true); ?>

                <?php include(locate_template('templates/geo-parts/offer-billboard.php')); ?>
                <div class="offers-row col-12 d-flex flex-wrap">
                    <div class="col-12 col-xl-8 col-lg-8 col-md-12">
                        <div class="content-main main">

                            <?php if(get_post_meta($post->ID, 'bonus_custom_meta_shortcode', true)){
                                echo apply_filters('the_content',get_post_meta($post->ID, 'bonus_custom_meta_shortcode', true));
                            } ?>
                            <h2 class="main-title bonus-page-title" id="intro"><?php echo get_post_meta($post->ID, 'bonus_custom_meta_title_intro', true); ?></h2>
                            <?php echo get_post_meta($post->ID, 'bonus_custom_meta_intro', true); ?>
                            <?php $cta = get_post_meta($bonusName, $countryISO."bs_custom_meta_first_cta", true) ?  get_post_meta($bonusName, $countryISO."bs_custom_meta_first_cta", true) :  'Visit '. str_replace(array("https://", "http://"), "", get_post_meta($bookieid, 'casino_custom_meta_com_url', true)); ?>
                            <?php if($geoBonusArgs['restr'] != true){ ?>
                            <a class="btn  btn_yellow p-4p font-weight-bold mb-5p mt-5p small-cta sign-up shiny-btn w-50 w-sm-100  overflow-hidden d-block mx-auto position-relative align-items-center bumper" data-casinoid="<?php echo $bookieid; ?>" data-country="<?php echo $countryISO?>" <?php echo $ctaFunction; ?> href="<?php echo $ctaLink; ?>" target="_blank" rel="nofollow">
                                <?php echo get_flags( '', '', $GLOBALS['countryISO'], '20').' '.$cta; ?><i></i>
                            </a>
                            <?php
                            }else{
                            ?>
                            <a class="btn btn_yellow p-4p font-weight-bold w-sm-100 mb-5p mt-5p small-cta sign-up shiny-btn w-50  overflow-hidden d-block mx-auto position-relative align-items-center bumper" data-casinoid="<?php echo $bookieid; ?>" data-country="<?php echo $countryISO?>" <?php echo $ctaFunction; ?> href="<?php echo $ctaLink; ?>" target="_blank" rel="nofollow">
                            </a>
                            <?php
                            }
                            ?>
                            <?php if (get_post_meta($post->ID, 'bonus_custom_meta_title_bonus_code', true)) { ?>
                                <h3 class="main-title bonus-page-title" id="bonus-code"><?php echo get_post_meta($post->ID, 'bonus_custom_meta_title_bonus_code', true); ?></h3>
                            <?php } ?>
                            <?php if (get_post_meta($post->ID, 'bonus_custom_meta_txt_bonus_code', true)) { ?>
                                <?php 	echo get_post_meta($post->ID, 'bonus_custom_meta_txt_bonus_code', true); ?>
                            <?php } ?>
                            <?php $cta = get_post_meta($bonusName, $countryISO."bs_custom_meta_second_cta", true) ?  get_post_meta($bonusName, $countryISO."bs_custom_meta_second_cta", true).' '.get_post_meta($bonusName, $countryISO.'bs_custom_meta_bc_code', true) :  'Enter PROMO CODE'. get_post_meta($bonusName, $countryISO.'bs_custom_meta_bc_code', true); ?>
                            <?php if($geoBonusArgs['restr'] != true){ ?>
                            <a class="btn btn_yellow p-4p font-weight-bold w-sm-100 mb-5p mt-5p small-cta sign-up shiny-btn w-50  overflow-hidden d-block mx-auto position-relative align-items-center bumper" data-casinoid="<?php echo $bookieid; ?>" data-country="<?php echo $countryISO?>" <?php echo $ctaFunction; ?> href="<?php echo $ctaLink; ?>" target="_blank" rel="nofollow">
                                <?php echo get_flags( '', '', $GLOBALS['countryISO'], '20').' '.$cta; ?><i></i>
                            </a>
                            <?php
                            }else{
                                ?>
                                <a class="btn btn_yellow p-4p font-weight-bold w-sm-100 mb-5p mt-5p small-cta sign-up shiny-btn w-50  overflow-hidden d-block mx-auto position-relative align-items-center bumper" data-casinoid="<?php echo $bookieid; ?>" data-country="<?php echo $countryISO?>" <?php echo $ctaFunction; ?> href="<?php echo $ctaLink; ?>" target="_blank" rel="nofollow">
                                </a>
                            <?php
                            }
                            ?>
                            <?php if (get_post_meta($post->ID, 'bonus_custom_meta_title_offers', true)) { ?>
                                <h3 class="main-title bonus-page-title"  id="offers"><?php echo get_post_meta($post->ID, 'bonus_custom_meta_title_offers', true); ?></h3>
                            <?php } ?>

                            <?php if (get_post_meta($post->ID, 'bonus_custom_meta_intro_offers', true)) { ?>
                                <div class="intro" id="offers"><?php echo get_post_meta($post->ID, 'bonus_custom_meta_intro_offers', true); ?></div>
                            <?php } ?>

                            <?php if (get_post_meta($post->ID, 'bonus_custom_meta_txt_offers', true)) { ?>
                                <?php $offers = explode("|" , get_post_meta($post->ID, 'bonus_custom_meta_txt_offers', true)); ?>
                                <?php foreach ($offers as $offer){ ?>
                                    <div class="offer-wrapper"><?php echo $offer; ?></div>
                                <?php } ?>
                            <?php } ?>
                            <?php echo do_shortcode('[promo layout="page" cat_in="all" casino="'.$bookieid.'" add_casino="'.$bookieid.'"]')?>
                            <?php echo do_shortcode('[add_promo casino="'.$bookieid.'"]')?>
                            <?php if($geoBonusArgs['restr'] != true){ ?>
                            <a class="btn btn_yellow font-weight-bold p-4p mb-5p mt-5p w-sm-100 small-cta sign-up shiny-btn w-50  overflow-hidden d-block mx-auto position-relative align-items-center bumper" data-casinoid="<?php echo $bookieid; ?>" data-country="<?php echo $countryISO?>" <?php echo $ctaFunction; ?> href="<?php echo $ctaLink; ?>" target="_blank" rel="nofollow">
                                Check all <?php echo get_the_title($bookieid);?> promotions here<i></i>
                            </a>
                            <?php
                            }else{
                            ?>
                            <a class="btn btn_yellow p-4p font-weight-bold w-sm-100 mb-5p mt-5p small-cta sign-up shiny-btn w-50  overflow-hidden d-block mx-auto position-relative align-items-center bumper" data-casinoid="<?php echo $bookieid; ?>" data-country="<?php echo $countryISO?>" <?php echo $ctaFunction; ?> href="<?php echo $ctaLink; ?>" target="_blank" rel="nofollow">
                            </a>
                            <?php
                            }
                            ?>
                            <?php if (get_post_meta($post->ID, 'bonus_custom_meta_outro_offers', true)) { ?>
                                <div class="outro"><?php echo get_post_meta($post->ID, 'bonus_custom_meta_outro_offers', true); ?></div>
                            <?php } ?>
                            <div class="main-title bonus-page-title mb-5p mt-10p" id="faq" style="border-bottom: 1px solid lightgrey;">Frequently Asked Questions (FAQ)</div>

                            <?php if (get_post_meta($post->ID, 'bonus_custom_meta_faq_text', true)) { ?>
                                <?php $offers = explode("|" , get_post_meta($post->ID, 'bonus_custom_meta_faq_text', true)); ?>
                                <?php $i = 0; ?>
                                <?php foreach ($offers as $offer){ ?>
                                    <?php $i += 1; ?>
                                    <div class="faq-wrapper mt-7p"><?php echo $offer; ?></div>
                                <?php } ?>
                            <?php } ?>
                            <!--h1 class="main-title"><?php //the_title(); ?></h1-->
                            <?php //the_content(); ?>
                            <?php //$cta = get_post_meta($bonusName, $countryISO."bs_custom_meta_sticky_cta", true) ?  get_post_meta($bonusName, $countryISO."bs_custom_meta_sticky_cta", true) :  get_post_meta($bookieObject->ID, 'casino_custom_meta_cta_bonus', true); ?>
                            <?php if($geoBonusArgs['restr'] != true){ ?>
                                <div class="mobile-footer-banner-bookie d-none d-lg-block d-xl-block position-sticky overflow-hidden mb-2p w-100" style="top: 0;bottom: 3px; z-index: 100;">
                                    <div class="mega-cta-stable d-lg-flex m-0 text-white d-xl-flex flex-wrap">
                                        <div class="col-4 col-sm-2 col-md-3 cta-img no-pad"><a <?php echo $ctaFunction; ?> href="<?php echo $ctaLink; ?>" rel="nofollow" target="_blank"><img class="img-fluid" src="<?=$logo;?>" loading="lazy" alt="<?php echo get_the_title($bookieid); ?>" ></a></div>
                                        <div class="col-8 col-sm-8 col-md-6 cta-txt">
                                            <div class="promo-details-amount text-center text-17">
                                                <?php if ($geoBonusArgs['isExclusive']){echo '<div class="exclusive-inline d-block "><i class="fa fa-star" aria-hidden="true"></i>
                                                <span>Exclusive Bonus</span></div>';}?>
                                                <div class="d-flex flex-column justify-content-center">
                                                <span class="text-21" style="line-height: 1;">
                                                    <?php echo get_flags( '', '', $GLOBALS['countryISO']).'  '.get_post_meta($bonusName, $bonusISO."bs_custom_meta_cta_for_top", true); ?>
                                                </span>
                                                    <span class="promo-details-amount-sub d-inline-block text-15 pb-2p" style="line-height: 1;">
                                                    <i>
                                                <?php echo $geoBonusArgs['bonusText']['FlagText']; ?>
                                                 </i>
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-2 col-md-3 pr-0 cta-btn"><a class="btn btn btn_yellow text-17 w-sm-100 float-right d-flex justify-content-center pl-10p ml-20p w-70 p-10p btn_large font-weight-bold bumper" data-casinoid="<?php echo $bookieid; ?>" data-country="<?php echo $countryISO?>" <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">
                                                <?php if($GLOBALS['countryISO'] == 'gb' || $post->ID == '7021'){
                                                    echo "Play";
                                                }else{
                                                    echo "Play Now";
                                                }?></a></div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div> <!-- .content-inner -->
                    </div>
                    <div class="col-12 col-lg-4 col-md-12 col-xl-4">
                        <?php include(locate_template('sidebar-right-offers.php')); ?>
                        <?php //echo get_sidebar('right-offers'); ?>
                    </div>
<!-- .content -->
        <div class="clear"></div>
        <?php if($geoBonusArgs['restr'] != true){ ?>

            <div class="mobile-footer-banner-bookie position-sticky w-100 mb-2p overflow-hidden d-xl-none d-lg-none d-block" style="top: 0;bottom: 64px; z-index: 100;">
                <div class="mega-cta-stable  m-0 text-white d-flex flex-wrap">
                    <div class="col-3 col-sm-2 col-md-3 cta-img no-pad" style="color:#d7dcdf;font-size:12px;"><a <?php echo $ctaFunction; ?> href="<?php echo $ctaLink; ?>" rel="nofollow" target="_blank"> <?php echo wp_get_attachment_image($imge_id, "sidebar-60", "", array( "class" => "img-fluid mobile-image-cta", "alt" => get_the_title($post->ID))); ?></a>
                    </div>
                    <div class="col-9 text-center col-sm-8 col-md-6 cta-txt">
                        <div class="promo-details-amount">
                            <?php if ($geoBonusArgs['isExclusive']){echo '<div class="exclusive-inline d-md-block d-xl-block d-lg-block d-none"><i class="fa fa-star" aria-hidden="true"></i>
<span>Exclusive Bonus</span></div>';}?>
                            <?php echo get_flags( '', '', $GLOBALS['countryISO']).'  '.get_post_meta($bonusName, $bonusISO."bs_custom_meta_cta_for_top", true); ?>
                        </div>
                        <div class="promo-details-amount-sub pb-2p"><i>
                                <?php echo $geoBonusArgs['bonusText']['FlagText']; ?>
                            </i></div>
                    </div>
                    <div class="col-12 col-sm-2 col-md-3 pl-0 pr-0 cta-btn"><a class="btn btn_yellow btn_large w-sm-100 d-block font-weight-bold bumper mb-5p" data-casinoid="<?php echo $bookieid; ?>" data-country="<?php echo $countryISO?>" <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">
                            <?php if($GLOBALS['countryISO'] == 'gb' || $post->ID == '7021'){
                                echo "Play";
                            }else{
                                echo "Play Now";
                            }?></a></div>
                </div>
            </div>
        <?php } ?>
    </div>
<?php if($geoBonusArgs['restr'] == true){ ?>
    <?php include_once(locate_template('templates/geo-parts/premium_casinos_pop_up.php')); ?>
<?php } ?><?php
