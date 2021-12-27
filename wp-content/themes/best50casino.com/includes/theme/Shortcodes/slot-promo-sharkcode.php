<?php
function slot_promotions_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'slot' => '',
        ), $atts, 'slot_promo');
    $casinoQuery = null;
    if ($atts['slot'] !== 'all' && isset($atts['slot']) ) {
        $casinoQuery = array(
            array(
                'key' => 'slots',
                'compare' => 'LIKE',
                'value' => serialize($atts['slot']),

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
        'posts_per_page' => 999,
        'orderby' => 'meta_value_num',
        'meta_key' => 'promo_custom_meta_end_offer',
        'order' => 'ASC',
        'suppress_filters' => true,
        'meta_query' => array(
            'relation' => 'AND',
            $casinoQuery,
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
    $query_promos = get_posts($query_casino);
    $ret = '';
    if(!empty($query_promos)){
        $ret .= '<span class="star shortcode-star mb-10p">'.get_the_title().' Promotions</span>
            <div class="mb-10p">';
        foreach ($query_promos as $promoID) {

            $casinoMainID = get_post_meta($promoID, 'promo_custom_meta_casino_offer', true);
                if (get_post_meta($promoID, 'promo_custom_meta_valid_all', true) || count(get_post_meta($promoID, 'promo_custom_meta_valid_on', true)) > 1) {
                    $offerEndTime = get_post_meta($promoID, 'promo_custom_meta_end_offer', true);
                }
            $restrictedat = get_post_meta($promoID,'restrictedat',true);
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


            $validat = get_post_meta($promoID,'validat',true);
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

                $bonusPage = get_post_meta($casinoMainID, 'casino_custom_meta_bonus_page', true);
                if (!in_array($GLOBALS['countryISO'], get_post_meta($casinoMainID, 'casino_custom_meta_rest_countries', true)) && get_post_meta((int)$promoID, 'promo_custom_meta_end_offer', true) >= $dttest  && $isrestricted !== 'restricted' && $onlyshow !== 'restricted') {
                    $colClass = 'p-5p border shadow-primary';
                    $wrapClass ='pb-0';
                    $ret .= '<div class="promo-wrapper-page ' . $colClass . '">';
                    $ret .= '   <div class="sigle-promo-wrapper-page text-left d-flex flex-wrap justify-content-between pt-5p '.$wrapClass.' align-items-center mb-3p w-100" style="border-bottom: 1px solid #d7dcdf;">';
                    $ctaLink = get_post_meta($casinoMainID, 'casino_custom_meta_affiliate_link_bonus', true);
                    $ret .= '<div class="col-lg-2 col-xl-2 col-md-2 col-6 order-1 casino-logos align-self-start p-0 p-sm-5p" ><img class="h-auto w-100 img-fluid" loading="lazy" src="'.get_the_post_thumbnail_url($casinoMainID).'"></div>';
                    $TCs = get_post_meta($promoID, 'promo_custom_meta_tcs', true) ? get_post_meta($promoID, 'promo_custom_meta_tcs', true) : '';
                    $ret .= '<div class="col-lg-8 col-xl-8 col-md-8 mt-sm-5p col-12 order-3 order-xl-2 order-lg-2 casino-promo-text"><b style="display:block;font-size: 16px;color: #03898f;margin-top: -6px;">' . get_the_title($promoID) . '</b>' . get_post_meta($promoID, 'promo_custom_meta_promo_content', true) . '<a style="margin-left:2px;text-align:center;font-weight:500" class="d-xl-none d-lg-none d-md-none d-block" href="' . $ctaLink . '" target="_blank" rel="nofollow">Get Promo</a><a href="'.get_the_permalink($bonusPage).'" style="display:block;opacity: 0.5;font-style: italic;color: grey;" class="text-12">' . get_the_title($casinoMainID) . ' Bonus</a> </div>';
                    $ctaTxt = get_post_meta($promoID, 'promo_custom_meta_cta', true) ? get_post_meta($promoID, 'promo_custom_meta_cta', true) : 'Claim Offer';
                    $ret .= '<div class="col-lg-2 col-xl-2 col-md-2 col-6 order-2 order-md-3 order-lg-3 order-xl-3 casino-cta" style="padding:0; align-self: baseline;"><div class="visible-xs d-xl-none d-lg-none d-md-none d-block">' . get_the_title($casinoMainID) . '</div><div class="expiration"><span class="text-medium text-12"><i class="fa fa-clock-o" aria-hidden="true"></i> Expires in: </span><span data-title="Countddown" class="countdown font-weight-bold text-14" data-time="' . $offerEndTime . '"></span></div><a class="btn cta-table bumper" data-casinoid="'.$casinoMainID.'" data-country="'.$localIso.'" href="' . $ctaLink . '" target="_blank" rel="nofollow" style="width: 100%;text-decoration:none;">' . $ctaTxt . '</a></div>';
                    $ret .= '  <div class="col-12 order-4 bg-yellowish child-row d-md-block d-lg-block d-xl-block d-flex align-items-center" id="child-row-'.$promoID.'"><a href="' . $ctaLink . '" target="_blank" rel="nofollow" style="display:block;font-style: italic;color: grey;text-decoration:none;" class="text-12 text-center w-sm-90">' . $TCs . '</a><i class="pl-1 fa fa-close close-x d-block d-md-none d-xl-none d-lg-none  text-dark" data-id="child-row-'.$promoID.'"></i></div>';
                    $ret .= '   </div>';
                    $ret .= '</div>';
                }

        }
        $ret .= '</div>';
    }
    wp_reset_postdata();
    return $ret;
}
add_shortcode('slot_promo', 'slot_promotions_shortcode');