<?php
add_shortcode('calendar_promos', 'cta_builder_offer_stripe');
function cta_builder_offer_stripe($atts){
    $atts = shortcode_atts( array(
        'layout' => '',
        'cta_text' => '',
        'cat_in' => '',
        'casino' => '',
        'text' => '',
        'link' => '',
        'exclusive' => '',
        'limit' => '',
        'more-function' => '',
    ), $atts );

    ob_start();
    ?>
    <div id="prosfores-kazino-calendar" class="d-flex flex-wrap bg-color-fifth mx-5p position-relative mb-15p" style="margin-top: 50px;">
        <?php for ($i = 1; $i < 5; $i++) { ?>
            <svg id="svgHolder-<?= $i ?>" class="svgHolder svgHolder-<?= $i ?> svgHolder-left" data-name="svgHolder-<?= $i ?>-lefteft" xmlns="http://www.w3.org/2000/svg" width="22" height="56" viewBox="0 0 21.96 55.96">
                <defs><style>.svgHolder<?= $i ?>{fill:#1b172d}</style></defs>
                <circle cx="10.98" cy="44.98" r="10.98" opacity=".35" fill="#095860"></circle>
                <circle class="arcleft-1" cx="10.98" cy="42.43" r="9.34"></circle>
                <circle cx="10.98" cy="10.98" r="10.98" fill="#095860" opacity=".35"></circle>
                <circle class="arcleft-1" cx="10.98" cy="12.53" r="9.34"></circle>
                <rect x="3.29" y="5.67" width="15.38" height="42.67" rx="7.69" ry="7.69" fill="#e7edf1"></rect>
                <path d="M11 5.67v42.66a7.71 7.71 0 0 0 7.69-7.69V13.36A7.71 7.71 0 0 0 11 5.67z" fill="#ced9e0"></path>
            </svg>
        <?php } ?>
        <div class="w-100 p-10p pt-10p bg-color-fifth calendar">

            <div class=" p-5p mt-5p w-100 d-flex d-lg-block position-relative">
                <ul class="calendar-dates list-unstyled bg-color-fifth d-flex rounded-10 p-10p justify-content-center justify-self-center position-relative w-100">
                    <?php for ($i = -3; $i < 4; $i++) {
                        $class = $i == 0 ? "active" : ''; ?>
                        <li class="<?= $class ?> pl-5p pr-5p text-center pointer d-flex flex-column calendar-item font-weight-bold text-white" data-exclusive="<?=$atts['exclusive']?>" data-cat="<?=$atts['cat_in']?>" data-casino="<?=$atts['casino']?>" data-date="<?=date("Y-m-d", strtotime('-' . -$i . ' days'))?>">
                            <span class="text-17 m-0"><?= date_i18n("D", strtotime('-' . -$i . ' days')) ?></span>
                            <span class="text-22 m-0 font-bold"><?= date("d", strtotime('-' . -$i . ' days')) ?></span>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="wave">
            <svg id="BottomWaves" class="BottomWavesSVG" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 1385.5 65">
                <style>.waveb0{opacity:.15;fill:#03898F}</style>
                <path class="waveb0" d="M1385.5 105H0V9.5c98.9 0 98.9 5.9 197.9 5.9 98.9 0 113.8-15.8 212.6-11.8 73.8 3 84.2 11.8 183.1 11.8 98.9 0 82.7-10.3 181.6-14.8C874-3.8 890.3 15.4 989.3 15.4c98.9 0 99.4-15.4 197.9-5.9 76.8 7.4 87.6 10.3 198.4 5.9V105z"></path>
                <path class="waveb0" d="M1385.5 105H0V33.8c35.4 5.2 31 5.9 129.9 5.9s112.1-28 219.3-11.8c107.8 16.2 248-15.5 349.2-11.1C797.2 21.1 853 48.1 979 32.3c98.2-12.3 140.6 10 234.2 16.7 87 6.2 80.8-8.6 172.4-9.3V105z"></path>
                <path d="M1385.5 52.6c-91.5.7-84.9 15.5-171.9 9.3-93.6-6.7-136-29-234.2-16.7C853.5 60.9 797.7 34 698.9 29.7c-101.2-4.5-241.4 27.3-349.2 11-107.2-16.1-120.5 11.9-219.3 17-72.3 3.7-95-5.9-130.4-11V105h1385.5V52.6z" fill="#fff"></path>
                <path d="M1385.5 62.6c-91.5.7-84.9 15.5-171.9 9.3-93.6-6.7-136-29-234.2-16.7C853.5 70.9 797.7 44 698.9 39.7c-101.2-4.5-241.4 27.3-349.2 11-107.2-16.1-120.5 11.9-219.3 17-72.3 3.7-95-5.9-130.4-11V105h1385.5V62.6z" fill="#fff"></path>
            </svg>

        </div>

        <div class="w-100 p-10p bg-fifth d-flex justify-content-start flex-wrap" id="offers-pool">
            <div class="ajaxload mt-10p m-auto p-10p" style="display: none;">
                <div class="loader mx-auto" style="display: block"></div>
            </div>

            <div class="row m-0 pt-2 pb-3 d-flex flex-row justify-content-start prosfores-list w-100" data-limit="<?php echo $atts['limit'];?>">
            <?php
            $limit = empty($atts['limit']) ? '' : ' limit="'.$atts['limit'].'"';
            $more = empty($atts['more-function']) ? '' : ' more-function="'.$atts['more-function'].'"';
            $countryISO = $GLOBALS['countryISO'];
            $localIso = $GLOBALS['visitorsISO'];

            $date = date('Y-m-d');//2021/06/03
            $timestamp = strtotime($date);
            $day = date('l', $timestamp);


            if (isset($atts['exclusive']) && $atts['exclusive'] === 'on') {
                $data = get_latest_offers($date, $day, false, true, $atts['limit'], 'on', $atts['casino'], $atts['cat_in']);
            } else {
                $data = get_latest_offers($date, $day, false, true, $atts['limit'], null, $atts['casino'], $atts['cat_in']);
            }

            $orderPromoSetingsArray = array_slice($data['offers'], 0, 9);
            $classboxes = 'oddboxes';

            foreach ($orderPromoSetingsArray as $offerID){

                $offerEndTime = get_post_meta($offerID, 'promo_custom_meta_end_offer', true);

                $casID = get_post_meta( $offerID, 'promo_custom_meta_casino_offer', true);
                $title = get_the_title($offerID);

                $tcs = get_post_meta($offerID,'promo_custom_meta_tcs',true);
                $exlusive = get_post_meta($offerID,'offer_exclusive',true);
                $casinoimage = get_post_meta($casID,'casino_custom_meta_trans_logo',true);
                $rating = round(get_post_meta($casID,'casino_custom_meta_sum_rating',true)/2,1);

                $htmlrating = "";

                if ($rating !== 0 && !empty($rating)) {
                    $ratingWhole = floor($rating);
                    $ratingDecimal = $rating - $ratingWhole;
                    $j = 5;
                    for ($i = 0; $i < $ratingWhole; $i++) {
                        $j -= 1;
                        $htmlrating .= '<i class="fa fa-star" aria-hidden="true"></i>';
                    }
                    if ($ratingDecimal != 0) {
                        $j -= 1;
                        $htmlrating .= '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
                    }
                    for ($i = 0; $i < $j; $i++) {
                        $htmlrating .= '<i class="fa fa-star-o" aria-hidden="true"></i>';
                    }
                }

                $promotype = get_the_terms( $offerID, 'promotions-type' );
                $ctaLink = get_post_meta($offerID, 'promo_custom_meta_cta_aff', true) ? get_post_meta($offerID, 'promo_custom_meta_cta_aff', true) :  get_post_meta($casID, 'casino_custom_meta_affiliate_link_bonus', true);
//                $terms = get_post_meta($page->ID, 'shortcode_short_term_text'.$iso, true) ? get_post_meta($page->ID, 'shortcode_short_term_text'.$iso, true) : get_post_meta($page->ID, 'casino_custom_meta_terms', true);
                ?>
                <div class="w-sm-100 mt-10p mb-10p d-flex w-md-50 position-relative offer-box-calendar p-0 <?=$classboxes?>">
                    <div class="ribbon home 5"><span class="ribbonclass-exclusive"><?=$promotype[0]->name?></span></div>
                    <?php
                    if ($exlusive === 'on'){
                        ?>
<!--                        <img class="position-absolute" style="right: 2px;top: 5px;width: 50px;" src="--><?//=get_stylesheet_directory_uri()?><!--/assets/images/exclusive.svg">-->
                        <div class="position-absolute text-white font-weight-bold exlupromo">EXCLUSIVE</div>
                        <?php
                    }
                    ?>
                    <div class="offer-inner-box d-flex mx-auto offer-box-shadow" style="border-radius: 5px; ">
                        <div class="offer-front d-flex flex-column" style="border-radius: 5px;">
                            <div class="head-offer d-flex flex-column mb-10p">
                                <div class="offer-front-image w-70 mx-auto rounded" style="">
                                    <a href="<?=$ctaLink?>" target="_blank" rel="nofollow" class="text-decoration-none">
                                        <img alt="<?=$title?>" loading="lazy" class="img-fluid mx-auto d-block align-self-center" style="max-width: 155px;max-height: 70px;" src="<?=$casinoimage?>">
                                    </a>
                                </div>
                                <div class="d-flex w-100 align-self-center mb-10p justify-content-center" style="color: gold;"><?=$htmlrating?></div>
                                <div class="offer-front-info-title text-center mb-sm-5p mt-sm-5p pb-5p pt-5p pl-5p pr-5p d-flex" style="background: #212d33;">
                                    <a href="<?=$ctaLink?>" target="_blank" rel="nofollow" class="text-decoration-none text-center d-flex" style="height: 100%;width: 100%;">
                                        <span class="d-none font-weight-bold text-uppercase text-white d-sm-none d-md-none d-lg-block d-xl-block text-center textoffers p-reduced" style="text-shadow:0 2px black;font-size: 16px;margin: auto;"><?=$title?></span>
                                        <span class="d-block font-weight-bold text-uppercase text-white d-sm-block d-md-block d-lg-none d-xl-none text-center textoffers text-15 p-reduced" style="text-shadow:0 2px black;font-size: 14px;margin: auto;"><?=$title?></span>
                                    </a>
                                </div>
                            </div>
                            <div class="offer-front-info w-100 d-flex flex-wrap justify-content-center">
                                <span class="text-decoration-none text-white d-block mx-auto w-100 text-14 p-5p w-100"><span class="pr-2p" style="color: #dfb405;">More Info:</span><?=wp_trim_words( get_post_meta($offerID,'promo_custom_meta_promo_content',true), $num_words = 22, $more = null )?> </span>
                            </div>
                            <div class="info-offer mt-auto mb-10p d-flex justify-content-center">
                                <div class="offer-front-info w-70 d-flex flex-column justify-content-center">
                                    <a rel="nofollow" target="_blank" href="<?=$ctaLink?>" class="text-decoration-none text-dark d-block mx-auto  w-100 text-14 p-10p liquidbtn font-weight-bold rounded offer-button up w-75" style="color: black !important;background: linear-gradient(#ffcd00, #c5a007);">CLAIM OFFER <i class="fa fa-angle-right" aria-hidden="true"></i> </a>
                                </div>
                            </div>
                            <small class="d-block text-center w-100" style="font-size: 7px;color:#ffffffa6;padding: 4px;"><?=$tcs?></small>
                        </div>
                    </div>
                </div>
                    <?php
            }
                ?>
                <div class="col-12 d-flex justify-content-center all-offers-btn offers-btn"></div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
