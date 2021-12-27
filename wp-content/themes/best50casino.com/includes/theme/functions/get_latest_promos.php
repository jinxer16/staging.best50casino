<?php
function get_latest_offers($date = null, $day = null, $all = false, $onlyIDs = false, $limit = null ,$exlusive = null,$casino = null,$categories =null)
{
if (empty($limit)) {
$limit = 999;
} // hardcoded if missing

$countryISO = $GLOBALS['countryISO'];
$localIso = $GLOBALS['visitorsISO'];
$premiumCasinos = \WordPressSettings::getPremiumCasino($localIso,'order');
$orderCasinos = explode(",",$premiumCasinos);

$exclusivequery = null;

 if ($exlusive === 'on' && isset($exlusive) ) {
        $exclusivequery = array(
            array(
                'key' => 'offer_exclusive',
                'compare' => 'LIKE',
                'value' => 'on',
            )
        );
 }
    $taxQuery = null;
    if ($categories !== 'all' && isset($casino)) {
        $taxQuery = [[
            'taxonomy' => 'promotions-type',
            'field' => 'term_id',
            'terms' => array($categories),
//                'operator' => 'IN',
        ]];
    }
    if ($categories !== 'all' && !isset($casino)) {
        $taxQuery = [[
            'taxonomy' => 'promotions-type',
            'field' => 'term_id',
            'terms' => array($categories),
//            'operator' => 'IN',
        ]];
    }
    $casinoQuery = null;
    if ($casino !== 'all' && isset($categories) ) {
        $casinoQuery = array(
            array(
                'key' => 'promo_custom_meta_casino_offer',
                'compare' => 'LIKE',
                'value' => $casino,

            )
        );
    }


$query_casino = array(
'post_type' => array('bc_offers'),
'post_status' => array('publish'),
'posts_per_page' => 999,
'fields' => 'ids',
'tax_query' => $taxQuery,
'meta_query' => array(
   'relation' => 'AND',
    $casinoQuery,
    $exclusivequery,
        array( // Μεγαλύτερη ημ/νία από σήμερα και επιλεγμένη την σημερινή μέρα
            array(
            'relation' => 'AND',
                array(
                'key' => 'promo_custom_meta_valid_on',
                'compare' => 'LIKE',
                'value' => $day,
                ),
                array(
                'key' => 'promo_custom_meta_valid_on',
                'compare' => 'EXISTS',
                ),
                array(
                'key' => 'promo_custom_meta_end_offer',
                'compare' => '>=',
                'value' => $date,
                ),
            )
        )
    ),
    'meta_key'         => 'promo_custom_meta_casino_offer',
    'orderby'          => 'meta_value_list',
    'meta_value_list'  => $orderCasinos,
    'suppress_filters' => false,
    'order' => 'ASC',
);
$allOffers = get_posts($query_casino);
    $finalArray = array();
    $dttest = date('Y-m-d H:i');
    foreach ($allOffers as $offerID) {
        if (get_post_meta($offerID, 'promo_custom_meta_valid_all', true) || count(get_post_meta($offerID, 'promo_custom_meta_valid_on', true)) > 1) {
            //            if (!in_array($todayDay, get_post_meta($casinosID, 'promo_custom_meta_valid_on', true))){
            $offerEndTime = get_post_meta($offerID, 'promo_custom_meta_end_offer', true);
        }
        $casID = get_post_meta($offerID, 'promo_custom_meta_casino_offer', true);
        $restrictedat = get_post_meta($offerID, 'restrictedat', true);
        $isrestricted = '';
        if (isset($restrictedat) && is_array($restrictedat)) {
            if (in_array($localIso, $restrictedat)) {
                $isrestricted = 'restricted';
            } else {
                $isrestricted = 'no';
            }
        } else {
            $isrestricted = 'no';
        }

        $validat = get_post_meta($offerID, 'validat', true);
        $onlyshow = '';
        if (isset($validat) && is_array($validat)) {
            if (in_array($localIso, $validat)) {
                $onlyshow = 'show';
            } else {
                $onlyshow = 'restricted';
            }
        } else {
            $onlyshow = 'show';
        }

        if (@!in_array($countryISO, get_post_meta($casID, 'casino_custom_meta_rest_countries', true)) && isset($offerEndTime) && $offerEndTime >= $dttest && $isrestricted !== 'restricted' && $onlyshow !== 'restricted') {
            $finalArray[$casID] = $offerID;
        }
    }


array_unique($finalArray);
$offers = array_slice( $finalArray, 0, 9 );
$last = count($allOffers) <= $limit;
if($onlyIDs){return array( 'offers' => $offers, 'last' => $last );}

$classboxes = 'oddboxes';

ob_start();
foreach ($offers as $offerID) {
        style_offer($offerID,$classboxes);
}

$output = ob_get_clean();
return array( 'content' => $output, 'last' => $last );
}



function get_more_offers($page = 1, $date = null, $limit = null)
{
    $now = date("Y-m-d H:i:s");
    $query_casino = array(
        'post_type' => array('bc_offers'),
        'post_status' => array('publish'),
        'posts_per_page' => $limit,
        'fields' => 'ids',
//        'orderby' => 'meta_value_num',
//        'meta_key' => $prefix.'offer_ends',
        'order' => 'ASC',
        'suppress_filters' => true,
//        'page' => $page,
        'offset' => $page * $limit,
        'meta_query' => array(
            'relation' => 'AND',
            array( // Μεγαλύτερη ημ/νία από σήμερα και επιλεγμένη την σημερινή μέρα
                array(
                    'relation' => 'AND',
                    array(
                        'key' => 'promo_custom_meta_valid_on',
                        'compare' => 'LIKE',
                        'value' => $date,
                    ),
                    array(
                        'key' => 'promo_custom_meta_valid_on',
                        'compare' => 'EXISTS',
                    ),
                    array(
                        'key' => 'promo_custom_meta_end_offer',
//                        'type' => 'date',
                        'compare' => '>=',
                        'value' => $now,
                    ),
                )
            )
        ),
    );
    $offers = get_posts($query_casino);
    $last = count($offers) < $limit;
    ob_start();
    foreach ($offers as $offerID) {
          $countryISO = $GLOBALS['countryISO'];
          $casID = get_post_meta( $offerID, 'promo_custom_meta_casino_offer', true);
        if (@!in_array($countryISO, get_post_meta($casID, 'casino_custom_meta_rest_countries', true))) {
            style_offer($offerID);
        }
    }
    $output = ob_get_clean();
    return array( 'content' => $output, 'last' => $last );
}


function style_offer($offerID,$classboxes='') {

    if (get_post_meta($offerID, 'promo_custom_meta_valid_all', true) || count(get_post_meta($offerID, 'promo_custom_meta_valid_on', true)) > 1) {
        //            if (!in_array($todayDay, get_post_meta($casinosID, 'promo_custom_meta_valid_on', true))){
        $offerEndTime = get_post_meta($offerID, 'promo_custom_meta_end_offer', true);
    }
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

    ?>

    <div class="w-sm-100 mt-10p mb-10p d-flex w-md-50 position-relative offer-box-calendar p-0 <?=$classboxes?>">
        <div class="ribbon home 5"><span class="ribbonclass-exclusive"><?=$promotype[0]->name?></span></div>
        <?php
        if ($exlusive === 'on'){
            ?>
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
                    <div class="offer-front-info-title text-center mb-sm-5p mt-sm-5p pb-5p pt-5p pl-5p pr-5p" style="background: #212d33;">
                        <a href="<?=$ctaLink?>" target="_blank" rel="nofollow" class="text-decoration-none text-center d-flex" style="height: 100%;width: 100%;">
                            <span class="d-none font-weight-bold text-uppercase text-white d-sm-none d-md-none d-lg-block d-xl-block text-center textoffers p-reduced" style="text-shadow:0 2px black;margin:auto;font-size: 16px;"><?=$title?></span>
                            <span class=" d-block font-weight-bold text-uppercase text-white d-sm-block d-md-block d-lg-none d-xl-none text-center textoffers text-15 p-reduced" style="text-shadow:0 2px black;margin:auto;font-size: 14px;"><?=$title?></span>
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
<?php }

