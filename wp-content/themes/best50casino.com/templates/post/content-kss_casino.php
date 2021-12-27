<?php
$casino_why_play = explode(',', get_post_meta($post->ID, 'casino_custom_meta_why_play', true));
$imge_id = getImageId(get_post_meta($post->ID, 'casino_custom_meta_sidebar_icon', true)); ?>

<?php $imge_id = get_image_id_by_link(get_post_meta($post->ID, 'casino_custom_meta_sidebar_icon', true)); ?>
<?php if (strpos(get_the_title($post->ID), 'Casino') !== false || strpos(get_the_title($post->ID), 'casino') !== false) {
    $titleTxt = ' Review';
} else {
    $titleTxt = ' Casino Review';
} ?>
<?php
$casinoBonusPage = get_post_meta($post->ID, 'casino_custom_meta_bonus_page', true);
$bonusName = get_post_meta($casinoBonusPage, 'bonus_custom_meta_bonus_offer', true);
$bonusISO = get_bonus_iso($casinoBonusPage);
$countryISO = $GLOBALS['countryISO'];

$localIso =  $GLOBALS['visitorsISO']; //Αν η χωρα ειναι ενεργοποιημενη
if (current_user_can('administrator')) {
    echo '$bonusISO=> '.$bonusISO.'<br>';
    echo '$countryISO=> '.$countryISO.'<br>';
    echo '$localIso=> '.$localIso.'<br>';
//if ($countryISO == 'gb' && $post->ID == '7289') {
//    header("Location: https://www.best50casino.com/uk-online-casinos/");
//    exit();
}
$image_id = get_post_meta($post->ID, 'casino_custom_meta_comp_screen_1', true);
$logo_id = get_post_meta($post->ID, 'casino_custom_meta_trans_logo', true);
$logo_idmo = getImageId(get_post_meta($post->ID, 'casino_custom_meta_trans_logo', true));
$imge_id = getImageId(get_post_meta($post->ID, 'casino_custom_meta_sidebar_icon', true));
$geoBonusArgs = is_country_enabled($bonusName,$post->ID, 'kss_casino');

 $ctaLink = $geoBonusArgs['aff_re2'];
 $ctaFunction = $geoBonusArgs['ctaFunction'];
 $offerList = explode( ",", get_post_meta($post->ID, 'casino_custom_meta_why_play', true));

 $countriesEnabledArray = \WordPressSettings::getCountryEnabledSettings();
 $thisISO = WordPressSettings::isCountryActive($countryISO);
 $premiumCasinosstring = WordPressSettings::getPremiumCasino($countryISO,'premium');

 $premiumCasinosArray =  explode(",",$premiumCasinosstring);
 $isCasinoPremium = in_array($post->ID, $premiumCasinosArray);
 //$premiumCasinosArray =  array_values( $premiumCasinosArray);
    $numberCasinos = count($premiumCasinosArray);
if ($numberCasinos>4){
    $premiumCasinosArray = array_slice($premiumCasinosArray, 0, 4);
    $colNumber = 3;
    }else{
    $colNumber = 12/$numberCasinos;
    }
    ?>
<div class="content main col-12 <?php echo $post->post_type ?>">
    <div class="ident-mob p-5p d-lg-none d-md-none d-sm-none hidden-lg hidden-md hidden-sm  m-0">
        <div class="bg-dark text-white p-0 shadow">
            <h2 class="widget2-heading"><?php the_title(); ?><?php //echo $titleTxt; ?></h2>
            <div class="widget2-body d-flex flex-wrap p-10p ">
                <div class="review-icon w-30 align-self-center"><?php echo wp_get_attachment_image($logo_idmo, "sidebar-90", "", array("class" => "img-fluid", "alt" => get_the_title($post->ID)));
                $casinRating = round(get_post_meta($post->ID, 'casino_custom_meta_sum_rating', true) / 2, 2);
                    echo $casinRating; ?>/5.0
                </div>
                <div class="review-list pl-0 w-70 d-flex justify-content-end">
                    <ul class="check-list list-typenone">
                        <?php
                        foreach ($casino_why_play as $pros) { ?>
                            <li class="position-relative"><?php echo $pros; ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php include(locate_template('templates/geo-parts/review-billboard.php')); ?>
<?php

    if ($geoBonusArgs['restr'] == 1) {
        echo '<div class="col-12 restricted-area d-block mx-auto text-center font-weight-bold "><i class="fa text-danger fa-exclamation-triangle"></i> This casino doesn\'t accept players from ' . $GLOBALS['countryName'] . ' ' . get_flags('', '', $GLOBALS['visitorsISO']) . '</div>';
    } else {
        echo '<div class="col-12 restricted-area d-block mx-auto text-center font-weight-bold"><i class="fa text-success fa-thumbs-up"></i> This casino accepts players from ' . $GLOBALS['countryName'] . ' ' . get_flags('', '', $GLOBALS['visitorsISO']) . '</div>';
    } ?>


    <div class="casino-row" style="position: relative;">
        <div class="d-block d-sm-block d-md-none d-lg-none d-xl-none">
            <ul class="offer-anchors-mobile d-flex flex-row text-white flex-wrap align-items-center justify-content-around pl-10p pr-10p pt-2" style="width: 100%;position: relative;top: 0;z-index: 9;">
                <li><a href="#intro" class="text-white"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                <?php if($post->ID == 13946 || $post->ID == 8057){
                    ?>
                    <li><a href="#banking" class="text-white text-decoration-none">Banking</a></li>
                    <li><a href="#games-slots" class="text-white text-decoration-none">Games</a></li>
                    <li><a href="#live-mobile" class="text-white text-decoration-none">Mobile</a></li>
                <?php
                }else{ ?>
                    <li><a href="#games-slots" class="text-white text-decoration-none">Games</a></li>
                    <li><a href="#live-mobile" class="text-white text-decoration-none">Mobile</a></li>
                    <li><a href="#banking" class="text-white text-decoration-none">Banking</a></li>
                <?php } ?>
                <li><a href="#more-info" class="text-white text-decoration-none">More info</a></li>
                <li class="review-ach bg-primary"><a href="<?php echo get_the_permalink($casinoBonusPage); ?>" class="text-white text-decoration-none">Promotions</a></li>
            </ul>
        </div>
        <div class="d-none d-sm-none d-md-block d-lg-block d-xl-block">
            <ul class="offer-anchors d-flex flex-row pl-10p pr-10p pt-3" style="width: 100%;position: relative;top: 0;z-index: 9;">
                <li style="width: auto;padding-left: 15px;padding-right: 15px;"><a href="#intro" class=""><i class="fa fa-home" aria-hidden="true"></i></a></li>
                <?php if($post->ID == 13946 || $post->ID == 8057){
                    ?>
                    <li><a href="#banking" class="text-decoration-none">Banking</a></li>
                    <li><a href="#games-slots" class="text-decoration-none">Games & Slots</a></li>
                    <li><a href="#live-mobile" class="text-decoration-none">Live & Mobile</a></li>
                    <?php
                }else{ ?>
                    <li><a href="#games-slots" class="text-decoration-none">Games & Slots</a></li>
                    <li><a href="#live-mobile" class="text-decoration-none">Live & Mobile</a></li>
                    <li><a href="#banking" class="text-decoration-none">Banking</a></li>
                <?php } ?>
                <li><a href="#more-info" class="text-decoration-none">More info</a></li>
                <li class="review-ach"><a href="<?php echo get_the_permalink($casinoBonusPage); ?>" class="text-decoration-none">Promotions</a></li>
            </ul>
        </div>

    <div class="d-flex flex-row flex-wrap">
        <div class="col-lg-3 col-sm-6 order-1 order-md-1 order-lg-1 order-xl-1 left-casino">
            <?php get_sidebar('left-kss_casino'); ?>
        </div>
        <div class="col-lg-6 col-sm-12 order-2 order-md-3 order-lg-2 order-xl-2 center-casino">

            <div class="widget2 main-review">
                <span class="widget2-heading d-lg-none d-md-none d-sm-none">Identity & Games</span>
                <h2 class="widget2-heading d-none d-sm-none d-md-none d-lg-block"><?php the_title(); ?><?php //echo $titleTxt; ?></h2>
                <div class="widget2-body p-10p">
                    <div class="entry">
                        <section id="intro"><?php the_content(); ?></section>
                        <section id="games-slots"><?php echo apply_filters('the_content', get_post_meta($post->ID, 'casino_custom_meta_sl_ga', true)); ?></section>

                       <?php $posttags = get_the_tags();
                        if ($posttags) {
                            ?>
                            <ul class="tags-list">
                                <?php foreach ($posttags as $tag) {
                                    echo '<li><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></li>';
                                }
                                ?>
                            </ul>
                        <?php }?>

                        <?php if(get_post_meta($post->ID,'casino_custom_meta_hide_slots',true) != 'on'){
                            ?>
                        <div class="inner_row more_games review_slots">
                            <?php
                            if ($post->ID != '7289'){
                            $casino_soft = get_post_meta($post->ID, 'casino_custom_meta_softwares', true);
                            }
                            if(is_array($casino_soft)) {
                                $casino_softCache = implode("-", $casino_soft);
                            }
                            $args = array(
                                'post_type' => 'kss_slots',
                                'posts_per_page' => 9,
                                'post_status' => array('publish'),
                                'numberposts' => 9,
                                'no_found_rows' => true,
                                'update_post_term_cache' => false,
                                'orderby' => 'rand',
                                'meta_query' => array(
                                    array(
                                        'key' => 'slot_custom_meta_slot_software',
                                        'value' => $casino_soft,
                                        'compare' => 'IN',
                                    )
                                )
                            );
                            $cache_key = 'slot_shark'.md5($casino_softCache);
                           if (false === ( $my_slot_loop = wp_cache_get( $cache_key ) )){
                                $my_slot_loop = new WP_Query($args);
                                wp_cache_set( $cache_key, $my_slot_loop, 'slot_shark', DAY_IN_SECONDS );
                            }
                       if ($my_slot_loop->have_posts()) { ?>
                                <div class="">
                                    <h3 class="widget2-heading"><?php the_title();?> Slots</h3>
                                    <div class="game_wrapper d-flex flex-wrap">
                                        <?php
                                   foreach ($my_slot_loop->posts as $slots) {
                                            if ($slots->ID != $post->ID) {
                                                $score = get_post_meta($slots->ID, 'slot_custom_meta_slot_value', true) / 20; ?>
                                                <div class="element-item <?php echo implode(" ", get_post_meta($slots->ID, 'slot_custom_meta_label', true)) ?> <?php echo get_post_meta($slots->ID, 'slot_custom_meta_slot_software', true) ?> "
                                                     data-category="transition">
                                                    <section class="containerz">
                                                        <div class="card">
                                                            <div class="front">
                                                                <a class="text-decoration-none" href="<?php echo get_the_permalink($slots->ID); ?>">
                                                                    <figure class="m-0">
                                                                        <img loading="lazy" src="<?php echo get_the_post_thumbnail_url($slots->ID) ?>"
                                                                             alt="game-image">
                                                                        <?php if (get_post_meta($slots->ID, 'slot_custom_meta_label', true)) {
                                                                            $metaLabel = array_flip(get_post_meta($slots->ID, 'slot_custom_meta_label', true));
                                                                            if (isset($metaLabel['LEGEND'] )) { ?>
                                                                                <div class="ribbon hot">
                                                                                    <span>Legend</span></div>
                                                                            <?php } elseif (isset($metaLabel['BEST'])) {
                                                                                ?>
                                                                                <div class="ribbon premium">
                                                                                    <span>Best</span></div>
                                                                            <?php } elseif (isset($metaLabel['NEW'])) {
                                                                                ?>
                                                                                <div class="ribbon new"><span>New</span>
                                                                                </div>
                                                                            <?php }
                                                                        } ?>
                                                                        <?php $page = get_post_meta($slots->ID, 'slot_custom_meta_slot_software', true);?>
                                                                        <span class="software"><img
                                                                                    loading="lazy" src="<?php echo get_post_meta($page, "casino_custom_meta_sidebar_icon", true);?>"
                                                                                    width="30" height="30"
                                                                                    alt="<?php echo get_the_title($page); ?>"
                                                                                    data-toggle="tooltip"
                                                                                    title="<?php echo ucwords(get_the_title($page)); ?> "/></span>
                                                                    </figure>
                                                                    <span class="name"><?php echo get_the_title($slots->ID); ?> </span>
                                                                    <span class="rating">
												<span class="star_rating"><?php echo $score; ?></span>
											</span>
                                                                </a>
                                                            </div>
                                                            <div class="back">
                                                                <table class="w-100 tetx-14">
                                                                    <tr>
                                                                        <td>Wheels:</td>
                                                                        <td><?php echo get_post_meta($slots->ID, 'slot_custom_meta_slot_wheels', true); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Slot Type:</td>
                                                                        <td class="d-flex">
                                                                            <?php if ('video' == get_post_meta($slots->ID, 'slot_custom_meta_classic_video', true)) {
                                                                                echo '<span class="icon-video-camera lazy-background tooltip-span" data-toggle="tooltip" title="Video"></span>';
                                                                            } else {
                                                                                echo '<span class="icon-slots lazy-background tooltip-span" data-toggle="tooltip" title="Classic"></span>';
                                                                            };
                                                                            if (get_post_meta($slots->ID, 'slot_custom_meta_jackpot_option', true)) {
                                                                                echo ', <span class="icon-jackpot lazy-background tooltip-span" data-toggle="tooltip" title="Jackpot"></span>';
                                                                            } else {
                                                                                echo '';
                                                                            };
                                                                            if (get_post_meta($slots->ID, 'slot_custom_meta_3d_option', true)) {
                                                                                echo ', <span class="icon-3d_rotation tooltip-span" data-toggle="tooltip" title="3D Slot"></span>';
                                                                            } else {
                                                                                echo '';
                                                                            }; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Paylines:</td>
                                                                        <td><?php echo get_post_meta($slots->ID, 'slot_custom_meta_slot_paylines', true); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>RTP:</td>
                                                                        <td><?php echo get_post_meta($slots->ID, 'slot_custom_meta_rtp_perc', true);?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Free Spins:</td>
                                                                        <td><?php if (get_post_meta($slots->ID, 'slot_custom_meta_free_spins_option', true)) {
                                                                                echo 'Yes';
                                                                            } else {
                                                                                echo 'No';
                                                                            }; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Bonus Rounds:</td>
                                                                        <td><?php if (get_post_meta($slots->ID, 'slot_custom_meta_bonus_rounds_option', true)) {
                                                                                echo 'Yes';
                                                                            } else {
                                                                                echo 'No';
                                                                            }; ?></td>
                                                                    </tr>
                                                                </table>
                                                                <a href="<?php echo get_post_meta($post->ID, 'casino_custom_meta_affiliate_link_review', true);?>"
                                                                   rel="nofollow"
                                                                   class="btn btn_tiny btn_yellow cta d-block font-weight-bold play_button bumper">Play Now</a>
                                                            </div>
                                                        </div>
                                                    </section>
                                                    <span class="offer-info" onclick="flip()"><i class="fa fa-info"></i><i
                                                                class="fa fa-times mt-3p"></i></span>
                                                </div>
                                            <?php }
                                        }
                                   wp_reset_postdata();
                                        ?>
                                    </div>

                                </div>
                            <?php
                       }
                               ?>
                        </div>
                <?php
                        }
                ?>
                        <section
                                id="live-mobile"><?php echo apply_filters('the_content', get_post_meta($post->ID, 'casino_custom_meta_li_mo', true)); ?></section>
                        <section
                                id="banking"><?php echo apply_filters('the_content', get_post_meta($post->ID, 'casino_custom_meta_banking', true)); ?></section>
                        <section
                                id="more-info"><?php echo apply_filters('the_content', get_post_meta($post->ID, 'casino_custom_meta_ot_in', true)); ?></section>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-3 col-sm-6 order-3 order-md-2 order-lg-3 order-xl-3 right-casino">
            <?php get_sidebar('right-kss_casino'); ?>
            <?php //include(locate_template('sidebar-right-kss_casino.php')); ?>
        </div>
    </div>

    </div>
    <?php if($geoBonusArgs['restr'] != true){ ?>
        <div class="mobile-footer-banner-bookie d-none d-lg-block d-xl-block position-sticky overflow-hidden mb-2p w-100" style="top: 0;bottom: 3px; z-index: 100;">
            <div class="mega-cta-stable p-5p m-0 text-white d-flex flex-wrap">
                <div class="col-4 col-sm-2 col-md-4 cta-img no-pad"><a <?php echo $ctaFunction; ?> href="<?php echo $ctaLink; ?>" rel="nofollow" target="_blank"><img width="110" class="img-fluid" src="<?php echo $logo_id; ?>" alt="<?php echo get_the_title($post->ID) ; ?>" ></a></div>
                <div class="col-8 col-sm-8 col-md-4 cta-txt">
                    <div class="promo-details-amount text-center text-17">
                        <?php if (get_post_meta($bonusName, $countryISO."bs_custom_meta_no_bonus", true)!=1) { ?>
                        <?php if ($geoBonusArgs['isExclusive']){echo '<div class="exclusive-inline d-block "><i class="fa fa-star" aria-hidden="true"></i>
                            <span>Exclusive Bonus</span></div>';}?>
                        <div class="d-flex justify-content-center">
                            <span class="text-21">
                                <?php echo get_flags( '', '', $GLOBALS['countryISO']).'  '.get_post_meta($bonusName, $bonusISO."bs_custom_meta_cta_for_top", true); ?>
                            </span>
                            <span class="promo-details-amount-sub d-inline-block mt-5p ml-5p text-15">
                                <i>
                            <?php echo $geoBonusArgs['bonusText']['FlagText']; ?>
                        </i>
                            </span>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-12 col-sm-2 col-md-4 pr-0 cta-btn "><a class="btn btn btn_yellow text-17 w-sm-100 float-right d-flex justify-content-center pl-10p ml-20p w-55 p-10p btn_large font-weight-bold bumper" data-casinoid="<?php echo $post->ID; ?>" data-country="<?php echo $countryISO?>"  <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">
                        <?php if($GLOBALS['countryISO'] == 'gb' || $post->ID == '7016'){
                            echo "Play";
                        }else{
                            echo "Play Now";
                        }?></a></div>
            </div>
        </div>
    <?php } ?>
</div>
<?php if($geoBonusArgs['restr'] != true){ ?>
    <div class="mobile-footer-banner-bookie  w-100 mb-10p overflow-hidden  d-xl-none d-lg-none d-block" style="position:initial; ">
        <div class="mega-cta-stable p-5p m-0 text-white d-flex flex-wrap">
            <div class="col-3 col-sm-2 col-md-3 cta-img no-pad p-0 position-relative text-center" style="color:#d7dcdf;font-size:12px;"><a <?php echo $ctaFunction; ?> href="<?php echo $ctaLink; ?>" rel="nofollow" target="_blank"> <?php echo wp_get_attachment_image($imge_id, "sidebar-60", "", array( "class" => "img-fluid mobile-image-cta", "alt" => get_the_title($post->ID)));?></a>
            </div>
            <div class="col-8 col-sm-8 col-md-6 cta-txt text-lg-right text-xl-right text-center">
                <?php if (get_post_meta($bonusName, $countryISO."bs_custom_meta_no_bonus", true)!=1) { ?>
                <div class="promo-details-amount">
                    <?php if ($geoBonusArgs['isExclusive']){echo '<div class="exclusive-inline d-none d-md-block d-lg-block d-xl-block"><i class="fa fa-star" aria-hidden="true"></i>
<span>Exclusive Bonus</span></div>';}?>
                    <?php echo get_flags( '', '', $GLOBALS['countryISO']).'  '.get_post_meta($bonusName, $bonusISO."bs_custom_meta_cta_for_top", true); ?>
                </div>
                <div class="promo-details-amount-sub"><i>
                        <?php echo $geoBonusArgs['bonusText']['FlagText']; ?>
                    </i></div>
                <?php } ?>
            </div>
            <div class="col-12 col-sm-2 col-md-3 cta-btn"><a class="btn bumper btn btn btn_yellow text-17 w-sm-100 d-block p-5p btn_large font-weight-bold bumper"  data-casinoid="<?php echo $post->ID; ?>" data-country="<?php echo $countryISO; ?>"  <?php echo $ctaFunction; ?> href="<?php echo $ctaLink?>" rel="nofollow" target="_blank">
                    <?php if($GLOBALS['countryISO'] == 'gb' || $post->ID == '7016'){
                        echo "Play";
                    }else{
                        echo "Play Now";
                    }?></a></div>
        </div>
    </div>
<?php }?>
<?php if($geoBonusArgs['restr'] == true){ ?>
<?php include_once(locate_template('templates/geo-parts/premium_casinos_pop_up.php'));
} ?>
