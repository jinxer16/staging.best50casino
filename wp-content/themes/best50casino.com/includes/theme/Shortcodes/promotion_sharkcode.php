<?php
function promotions_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'layout' => '',
            'cat_in' => '',
            'casino' => '',
            'exclusive' => '',
            'limit' => 999
        ), $atts, 'promo');
    $casinoQuery = null;
    if ($atts['layout'] == 'sidebar') {
        $stickyQuery = array(
            'relation' => 'OR',
            array(
                'key' => 'promo_custom_meta_stick_side',
                'compare' => 'EXISTS',
            ),
            array(
                'key' => 'promo_custom_meta_stick_side',
                'value' => 'on',
                'compare' => 'LIKE',
            )
        );
    } elseif ($atts['layout'] == 'page') {
        $stickyQuery = array(
            'relation' => 'OR',
            array(
                'key' => 'promo_custom_meta_stick_page',
                'compare' => 'EXISTS',
            ),
            array(
                'key' => 'promo_custom_meta_stick_page',
                'value' => 'on',
                'compare' => 'LIKE',
            )
        );
    }
    $taxQuery = null;
    if ($atts['cat_in'] != 'all' && isset($atts['casino'])) {
        $taxQuery = [[
                'taxonomy' => 'promotions-type',
                'field' => 'term_id',
                'terms' => array($atts['cat_in']),
//                'operator' => 'IN',
     ]];
    }
    if ($atts['cat_in'] != 'all' && !isset($atts['casino'])) {
        $taxQuery = [[
            'taxonomy' => 'promotions-type',
            'field' => 'term_id',
            'terms' => array($atts['cat_in']),
//            'operator' => 'IN',
        ]];
    }
    $casinoQuery = null;
    if ($atts['casino'] != 'all' && isset($atts['casino']) ) {
        $casinoQuery = array(
            array(
                'key' => 'promo_custom_meta_casino_offer',
                'compare' => 'LIKE',
                'value' => $atts['casino'],

            )
        );
    }
    $exclusivequery = null;
    if ($atts['exclusive'] === 'on' && isset($atts['exclusive']) ) {
        $exclusivequery = array(
            array(
                'key' => 'offer_exclusive',
                'compare' => 'LIKE',
                'value' => 'on',
            )
        );
    }

    $countryISO = $GLOBALS['countryISO'];
    $countryName = $GLOBALS['countryName'];
    $localIso = $GLOBALS['visitorsISO'];
    $dttest = date('Y-m-d H:i');
    $todayDay = date('l');
    $query_casino = array( // A QUERY that initializes the default (all) IDS
        'post_type' => array('bc_offers'),
        'post_status' => array('publish'),
        'fields' => 'ids',
        'posts_per_page' => $atts['limit'],
        'orderby' => 'meta_value_num',
        'meta_key' => 'promo_custom_meta_end_offer',
        'order' => 'ASC',
        'suppress_filters' => true,
        'tax_query' => $taxQuery,
        'meta_query' => array(
            'relation' => 'AND',
//            $stickyQuery,
            $casinoQuery,
            $exclusivequery,
            array( // Μεγαλύτερη ημ/νία από σήμερα και επιλεγμένη την σημερινή μέρα
                array(
                    'relation' => 'AND',
                    array(
                        'key' => 'promo_custom_meta_valid_on',
                        'compare' => 'LIKE',
                        'value' => $todayDay,
                    ),
                    array(
                        'key' => 'promo_custom_meta_valid_on',
                        'compare' => 'EXISTS',
                    ),
                )
            )
        ),
    );
    $query_casinos = get_posts($query_casino);
    $ret = '';

        if ($atts['layout'] == 'sidebar') {
            $numberOPosts = count($query_casinos);
            $ret .= '<span class="star">Today’s Casino Promotions</span> ';
            $ret .= '<ul class="list-unstyled">';
            foreach ($query_casinos as $casinosID) {
                if (get_post_meta($casinosID, 'promo_custom_meta_valid_all', true) || count(get_post_meta($casinosID, 'promo_custom_meta_valid_on', true)) > 1) {

                    $offerEndTime = get_post_meta($casinosID, 'promo_custom_meta_end_offer', true);

                }
                $casinoMainID = get_post_meta($casinosID, 'promo_custom_meta_casino_offer', true);
                $bonusPage = get_post_meta($casinoMainID, 'casino_custom_meta_bonus_page', true);



                $casinoMainID = get_post_meta($casinosID, 'promo_custom_meta_casino_offer', true);

                $casinoBonusPageObject = get_post_meta($casinoMainID, 'casino_custom_meta_bonus_page', true);
                if (@!in_array($GLOBALS['countryISO'], get_post_meta($casinoMainID, 'casino_custom_meta_rest_countries', true)) && get_post_meta((int)$casinosID, 'promo_custom_meta_end_offer', true) >= $dttest) {
                    $ret .= '   <li class="d-flex flex-column p-10p border-bottom border-dark" style="line-height:1.55;">';
                    $ret .= '<div class=" d-flex justify-content-between align-items-center">';
                    $ret .= '<img width="40" height="40" src="' . get_post_meta($casinoMainID, 'casino_custom_meta_sidebar_icon', true) . '" loading="lazy" class="img-fluid rounded-circle" alt="' . get_the_title($casinoMainID) . '">';
                    $ret .= '<a class="text-center" style="width: 86%;line-height:1.55;" href="' . get_the_permalink($casinoBonusPageObject) . '#offers"><u>' . get_the_title(get_post_meta($casinosID, 'promo_custom_meta_casino_offer', true)) . ' Bonus:</u></a>';
                    $ret .= '       <span data-title="Countddown" class="countdown w-25 bg-secondary font-weight-bold text-center text-12 p-5p" data-time="' . $offerEndTime . '"></span>';
                    $ret .= '</div>';
                    $ret .= '<a class="text-primary" href="' . get_the_permalink($casinoBonusPageObject) . '#offers" style="line-height:1.55;">' . get_the_title($casinosID) . '</a>';
                    $ret .= '   </li>';
                }
            }
            $ret .= '</ul>';
        }elseif ($atts['layout'] === 'calendar') {
            $ret .='<div class="w-100 p-10p d-flex justify-content-start flex-wrap" id="">
            <div class="row m-0 pt-2 pb-3 d-flex flex-row justify-content-start  w-100">';

            $countposts =0;
            foreach ($query_casinos as $counterID) {
                $casID = get_post_meta($counterID, 'promo_custom_meta_casino_offer', true);
                $restrictedat = get_post_meta($counterID,'restrictedat',true);
                $isrestricted='';
                if (isset($restrictedat) && is_array($restrictedat)){
                    if (!in_array($localIso,$restrictedat)){
                        $isrestricted = 'restricted';
                    }else{
                        $isrestricted = 'no';
                    }
                }else{
                    $isrestricted = 'no';
                }


                $validat = get_post_meta($counterID,'validat',true);
                $onlyshow='';
                if (isset($validat) && is_array($validat)){
                    if (in_array($localIso,$validat)){
                        $onlyshow = 'show';
                    }else{
                        $onlyshow = 'restricted';
                    }
                }else{
                    $onlyshow = 'show';
                }
                if (@!in_array($countryISO, get_post_meta($casID, 'casino_custom_meta_rest_countries', true)) && get_post_meta((int)$counterID, 'promo_custom_meta_end_offer', true) >= $dttest && $isrestricted !== 'restricted' && $onlyshow !== 'restricted') {
                    $countposts++;
                }
            }
            $classboxes='';
            if ($countposts < 3 || $countposts & 1){
                $classboxes = 'oddboxes';
            }else{
                $classboxes = 'evenboxes';
            }
            foreach ($query_casinos as $offerID) {
                if (get_post_meta($offerID, 'promo_custom_meta_valid_all', true) || count(get_post_meta($offerID, 'promo_custom_meta_valid_on', true)) > 1) {
                    //            if (!in_array($todayDay, get_post_meta($casinosID, 'promo_custom_meta_valid_on', true))){
                    $offerEndTime = get_post_meta($offerID, 'promo_custom_meta_end_offer', true);
                }
                $casID = get_post_meta( $offerID, 'promo_custom_meta_casino_offer', true);
                $title = get_the_title($offerID);
                $restrictedat = get_post_meta($counterID,'restrictedat',true);
                $isrestricted='';
                if (isset($restrictedat) && is_array($restrictedat)){
                    if (in_array($localIso,$restrictedat)){
                        $isrestricted = 'restricted';
                    }else{
                        $isrestricted = 'no';
                    }
                }else{
                    $isrestricted = 'no';
                }


                $validat = get_post_meta($counterID,'validat',true);
                $onlyshow='';
                if (isset($validat) && is_array($validat)){
                    if (in_array($localIso,$validat)){
                        $onlyshow = 'show';
                    }else{
                        $onlyshow = 'restricted';
                    }
                }else{
                    $onlyshow = 'show';
                }
                $tcs = get_post_meta($offerID,'promo_custom_meta_tcs',true);
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
                $ctaLink = get_post_meta($casID, 'promo_custom_meta_cta_aff', true) ? get_post_meta($casID, 'promo_custom_meta_cta_aff', true) :  get_post_meta($casID, 'casino_custom_meta_affiliate_link_bonus', true);
//                $ret .= style_offer($offerID);

                if (!in_array($GLOBALS['countryISO'], get_post_meta($casID, 'casino_custom_meta_rest_countries', true)) && get_post_meta((int)$offerID, 'promo_custom_meta_end_offer', true) >= $dttest && $isrestricted !== 'restricted' && $onlyshow !== 'restricted') {
                    $ret .='    <div class="w-sm-100 mt-10p mb-10p d-flex w-md-50 position-relative offer-box-calendar p-0 '.$classboxes.' ">
        <div class="ribbon home 5"><span class="ribbonclass-exclusive">'.$promotype[0]->name.'</span></div>
        <div class="offer-inner-box d-flex mx-auto offer-box-shadow" style="border-radius: 5px; ">
            <div class="offer-front d-flex flex-column" style="border-radius: 5px;">
                <div class="head-offer d-flex flex-column mb-10p">
                    <div class="offer-front-image w-70 mx-auto rounded" style="">
                        <a href="'.$ctaLink.'" target="_blank" rel="nofollow" class="text-decoration-none">
                            <img alt="'.$title.'" loading="lazy" class="img-fluid mx-auto d-block align-self-center" style="border-radius:5px;max-height: 70px;" src="'.$casinoimage.'">
                        </a>
                    </div>
                    <div class="d-flex w-100 align-self-center mb-10p justify-content-center" style="color: gold;">'.$htmlrating.'</div>
                    <div class="offer-front-info-title text-center mb-sm-5p mt-sm-5p pb-5p pt-5p pl-5p pr-5p" style="background: #212d33;">
                        <a href="'.$ctaLink.'" target="_blank" rel="nofollow" class="text-decoration-none text-center d-flex" style="width: 100%;height: 100%;">
                            <span class="d-none font-weight-bold text-uppercase text-white d-sm-none d-md-none d-lg-block d-xl-block text-center textoffers p-reduced" style="text-shadow:0 2px black;font-size: 16px;margin: auto;">'.$title.'</span>
                            <span class=" d-block font-weight-bold text-uppercase text-white d-sm-block d-md-block d-lg-none d-xl-none text-center textoffers text-15 p-reduced" style="text-shadow:0 2px black;font-size: 14px;margin: auto;">'.$title.'</span>
                        </a>
                    </div>
                </div>
                <div class="offer-front-info w-100 d-flex flex-wrap justify-content-center">
                    <span class="text-decoration-none text-white d-block mx-auto w-100 text-14 p-5p w-100"><span class="pr-2p" style="color: #dfb405;">More Info:</span>'.wp_trim_words( get_post_meta($offerID,'promo_custom_meta_promo_content',true), $num_words = 12, $more = null ).' </span>
                </div>
                <div class="info-offer mt-auto mb-10p d-flex justify-content-center">
                    <div class="offer-front-info w-70 d-flex flex-column justify-content-center">
                        <a rel="nofollow" target="_blank" href="'.$ctaLink.'" class="text-decoration-none text-dark d-block mx-auto  w-100 text-14 p-10p liquidbtn font-weight-bold rounded offer-button up w-75" style="color: black !important;background: linear-gradient(#ffcd00, #c5a007);">CLAIM OFFER <i class="fa fa-angle-right" aria-hidden="true"></i> </a>
                    </div>
                </div>
                <small class="d-block text-center w-100" style="font-size: 7px;color:#ffffffa6;padding: 4px;">'.$tcs.'</small>
            </div>
        </div>
    </div>';
                    }
                }
            wp_reset_postdata();
            $ret .='</div></div>';
        }
        elseif ($atts['layout'] === 'page') {

            foreach ($query_casinos as $casinosID) {

                if (get_post_meta($casinosID, 'promo_custom_meta_valid_all', true) || count(get_post_meta($casinosID, 'promo_custom_meta_valid_on', true)) > 1) {

                    $offerEndTime = get_post_meta($casinosID, 'promo_custom_meta_end_offer', true);

                }
                $casinoMainID = get_post_meta($casinosID, 'promo_custom_meta_casino_offer', true);
                $bonusPage = get_post_meta($casinoMainID, 'casino_custom_meta_bonus_page', true);
                if (!in_array($GLOBALS['countryISO'], get_post_meta($casinoMainID, 'casino_custom_meta_rest_countries', true)) && get_post_meta((int)$casinosID, 'promo_custom_meta_end_offer', true) >= $dttest) {
                    $colClass = get_post_type(get_the_ID())== 'bc_bonus_page'? 'p-5p border shadow-primary' : '';
                    $wrapClass = get_post_type(get_the_ID())== 'bc_bonus_page'? 'pb-0' : 'pb-5p';
                    $ret .= '<div class="promo-wrapper-page ' . $colClass . '">';
                    $ret .= '   <div class="sigle-promo-wrapper-page text-left d-flex flex-wrap justify-content-between pt-5p '.$wrapClass.' align-items-center mb-3p w-100" style="border-bottom: 1px solid #d7dcdf;">';
                    $ctaLink = get_post_meta($casinosID, 'promo_custom_meta_cta_aff', true) ? get_post_meta($casinosID, 'promo_custom_meta_cta_aff', true) :  get_post_meta($casinoMainID, 'casino_custom_meta_affiliate_link_bonus', true);
                    $casinoBonusPage = get_post_meta($casinoMainID, 'casino_custom_meta_bonus_page', true);
                    $ret .= '<div class="col-lg-2 col-xl-2 col-md-2 col-6 order-1 casino-logos align-self-start p-0 p-sm-5p" ><img class="h-auto w-100 img-fluid" loading="lazy" src="'.get_the_post_thumbnail_url($casinoMainID).'"></div>';
                    $TCs = get_post_meta($casinosID, 'promo_custom_meta_tcs', true) ? get_post_meta($casinosID, 'promo_custom_meta_tcs', true) : '';
                    $ret .= '<div class="col-lg-8 col-xl-8 col-md-8 mt-sm-5p col-12 order-3 order-xl-2 order-lg-2 casino-promo-text"><b style="display:block;font-size: 16px;color: #03898f;margin-top: -6px;">' . get_the_title($casinosID) . '</b>' . get_post_meta($casinosID, 'promo_custom_meta_promo_content', true) . '<a style="margin-left:2px;text-align:center;font-weight:500" class="d-xl-none d-lg-none d-md-none d-block" href="' . $ctaLink . '" target="_blank" rel="nofollow">Get Promo</a><a href="'.get_the_permalink($bonusPage).'" style="display:block;opacity: 0.5;font-style: italic;color: grey;" class="text-decoration-none text-12">' . get_the_title($casinoMainID) . ' Bonus</a> </div>';
                    $ctaTxt = get_post_meta($casinosID, 'promo_custom_meta_cta', true) ? get_post_meta($casinosID, 'promo_custom_meta_cta', true) : 'Claim Offer';
                    $ret .= '<div class="col-lg-2 col-xl-2 col-md-2 col-6 order-2 order-md-3 order-lg-3 order-xl-3 casino-cta" style="padding:0; align-self: baseline;"><div class="visible-xs d-xl-none d-lg-none d-md-none d-block">' . get_the_title($casinoMainID) . '</div><div class="expiration"><span class="text-medium text-12"><i class="fa fa-clock-o" aria-hidden="true"></i> Expires in: </span><span data-title="Countddown" class="countdown font-weight-bold text-14" data-time="' . $offerEndTime . '"></span></div><a class="btn cta-table bumper text-decoration-none" data-casinoid="'.$casinoMainID.'" data-country="'.$localIso.'" href="' . $ctaLink . '" target="_blank" rel="nofollow" style="width: 100%;">' . $ctaTxt . '</a></div>';
                    $ret .= '  <div class="col-12 order-4 bg-yellowish child-row d-md-block d-lg-block d-xl-block d-flex align-items-center" id="child-row-'.$casinosID.'"><a href="' . $ctaLink . '" target="_blank" rel="nofollow" style="display:block;font-style: italic;color: grey;" class="text-12 text-center w-sm-90 text-decoration-none">' . $TCs . '</a><i class="pl-1 fa fa-close close-x d-block d-md-none d-xl-none d-lg-none  text-dark" data-id="child-row-'.$casinosID.'"></i></div>';
                    $ret .= '   </div>';
                    $ret .= '</div>';
                }
            }
            wp_reset_postdata();

        } elseif ($atts['layout'] == 'power-page') {
            $ret .= '<div class="promo-wrapper-page">';
            foreach ($query_casinos as $casinosID) {
                if (get_post_meta($casinosID, 'promo_custom_meta_valid_all', true) || count(get_post_meta($casinosID, 'promo_custom_meta_valid_on', true)) > 1) {
                    //            if (!in_array($todayDay, get_post_meta($casinosID, 'promo_custom_meta_valid_on', true))){
                    $offerEndTime = get_post_meta($casinosID, 'promo_custom_meta_end_offer', true);
                }
                $casinoMainID = get_post_meta($casinosID, 'promo_custom_meta_casino_offer', true);
                if (!in_array($GLOBALS['countryISO'], get_post_meta($casinoMainID, 'casino_custom_meta_rest_countries', true)) && get_post_meta((int)$casinosID, 'promo_custom_meta_end_offer', true) >= $dttest) {

                    $bonusPage = get_post_meta($casinoMainID, 'casino_custom_meta_bonus_page', true);
                    $ctaLink = get_post_meta($casinosID, 'promo_custom_meta_cta_aff', true) ? get_post_meta($casinosID, 'promo_custom_meta_cta_aff', true) : get_post_meta($casinosID, 'casino_custom_meta_affiliate_link_bonus', true);
                    $ret .= '   <div class="sigle-promo-wrapper-page text-left d-flex flex-wrap justify-content-between pt-5p pb-5p align-items-center mb-3p w-100" style="border-bottom: 1px solid #d7dcdf;">';
                    $ret .= '<div class="col-lg-2 col-xl-2 col-6 order-1 casino-logos align-self-start p-0 p-sm-5p" ><img class="h-auto w-100 img-fluid" loading="lazy" src="'.get_the_post_thumbnail_url($casinoMainID).'"></div>';
                    $TCs = get_post_meta($casinosID, 'promo_custom_meta_tcs', true) ? get_post_meta($casinosID, 'promo_custom_meta_tcs', true) : '';
                    $ret .= '<div class="col-lg-8 col-xl-8 mt-sm-5p col-12 order-3 order-xl-2 order-lg-2 casino-promo-text text-13"><b style="display:block;font-size: 16px;color: #03898f;margin-top: -6px;">' . get_the_title($casinosID) . '</b>' . get_post_meta($casinosID, 'promo_custom_meta_promo_content', true) . '<a style="margin-left:2px;text-align:center;font-weight:500" class="d-xl-none d-lg-none d-block text-decoration-none" href="' . $ctaLink . '" target="_blank" rel="nofollow">Get Promo</a><a href="'.get_the_permalink($bonusPage).'" style="display:block;opacity: 0.5;font-style: italic;color: grey;" class="text-12 text-decoration-none">' . get_the_title($casinoMainID) . ' Bonus</a> </div>';
                    $ctaTxt = get_post_meta($casinosID, 'promo_custom_meta_cta', true) ? get_post_meta($casinosID, 'promo_custom_meta_cta', true) : 'Claim Offer';
                    $ret .= '<div class="col-lg-2 col-xl-2 col-6 order-2 order-lg-3 order-xl-3 casino-cta" style="padding:0; align-self: baseline;"><div class="visible-xs d-xl-none d-lg-none d-block">' . get_the_title($casinoMainID) . '</div><div class="expiration"><span class="text-medium text-12"><i class="fa fa-clock-o" aria-hidden="true"></i> Expires in: </span><span data-title="Countddown" class="countdown font-weight-bold" data-time="' . $offerEndTime . '"></span></div><a class="btn cta-table bumper text-decoration-none" data-casinoid="'.$casinoMainID.'" data-country="'.$localIso.'" href="' . $ctaLink . '" target="_blank" rel="nofollow" style="width: 100%;">' . $ctaTxt . '</a></div>';
                    $ret .= '  <div class="col-12 order-4 bg-yellowish  child-row d-lg-block d-xl-block d-flex align-items-center" id="child-row-'.$casinosID.'"><a href="' . $ctaLink . '" target="_blank" rel="nofollow" style="display:block;font-style: italic;color: grey;" class="text-12 text-center w-sm-90 text-decoration-none">' . $TCs . '</a><i class="pl-1 fa fa-close close-x d-block d-xl-none d-lg-none  text-dark" data-id="child-row-'.$casinosID.'"></i></div>';
                    $ret .= '   </div>';
                }
            }
            $ret .= '</div>';
        }
    wp_reset_postdata();
    return $ret;
}

add_shortcode('promo', 'promotions_shortcode');

?>