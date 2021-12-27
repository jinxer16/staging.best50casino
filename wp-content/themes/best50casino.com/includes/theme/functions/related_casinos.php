<?php
function related_casinos($sort_by = '', $limit = -1, $filterType = '', $filterBy = '', $title = '', $secTitle = 'Why Choose:', $cta = 'sign_up', $post__in = '')
{
    $countryISO = $GLOBALS['countryISO'];
//    $localIso =  $GLOBALS['visitorsISO']; //Αν η χωρα ειναι ενεργοποιημενη
//    $premiumCasinos =  WordPressSettings::getPremiumCasino($countryCode = $countryISO, $type = 'premium');

    $localIso = $GLOBALS['countryISO'];
    $premiumCasinos = WordPressSettings::getPremiumCasino($localIso,'premium');
    $premiumCasinos = explode(",",$premiumCasinos);
    $sort_by = null;
    $sort_val = null;
    $order = null;
    $order = null;
    switch ($sort_by) {
        case 'default':
            $sort_by = 'meta_value_num';
            $sort_val = 'casino_custom_meta_casino_priority';
            $order = 'ASC';
            break;
        case 'random':
            $sort_by = 'rand';
            $sort_val = '';
            $order = '';
            break;
        case 'popular':
            $sort_by = 'meta_value_num';
            $sort_val = 'casino_custom_meta_sum_rating';
            $order = 'DESC';
            break;
        case 'post__in':
            $sort_by = 'post__in';
            $sort_val = '';
            $order = 'ASC';
            break;
    }
    $query_array = array();
    if ($filterType == 'game') {
        $query_array[] = [
                'key' => 'casino_custom_meta_games',
                'value' => serialize($filterBy[0]),
            'compare' => 'LIKE',
             ];
    }

    if ($filterType == 'soft') {
        $query_array[] = [
            'key' => 'casino_custom_meta_softwares',
            'value' => $filterBy[0],
            'compare' => 'LIKE',
        ];
    }
    if($post__in==null){
        $query_casino = array( // A QUERY that initializes the default (all) IDS
            'post_type' => array('kss_casino'),
            'post_status' => array('publish'),
            'posts_per_page' => $limit,
            'orderby' => $sort_by,
            'meta_key' => $sort_val,
            'order' => $order,
            'suppress_filters' => true,
            'fields' => 'ids',
            'meta_query'=>['relation' => 'AND',$query_array]
        );
    }else{
        $post__in = explode(",",$post__in);
        $query_casino = array( // A QUERY that initializes the default (all) IDS
            'post_type' => array('kss_casino'),
            'post_status' => array('publish'),
            'posts_per_page' => $limit,
            'orderby' => $sort_by,
            'meta_key' => $sort_val,
            'order' => $order,
            'post__in' => $post__in,
            'suppress_filters' => true,
            'fields' => 'ids',
            'meta_query'=>['relation' => 'AND',$query_array]
        );
    }

    $ret = '<div class="inner_row more_games">';
    $ret .= '	<div class="">';
    if ($title) {
        $ret .= '		<span class="star shortcode-star">' . $title . '</span>';
    }
    $ret .= '		<div class="table-responsive default">';
    $ret .= '		<table class="table table-striped d-flex flex-wrap d-md-table d-lg-table d-xl-table table-condensed mb-0 text-center medium align-middle p-5p" id="no-more-tables">';
    $ret .= '			<thead class="casinohead">';
    $ret .= '				<tr>';
    $ret .= '					<th scope="col" class="inline-hor-logo widget2-heading align-middle p-2p numeric d-table-cell w-auto"></th>';
    $ret .= '					<th scope="col" class="bonus-code widget2-heading align-middle numeric p-2p d-table-cell  w-auto">Casino</th>';
    $ret .= '					<th scope="col"  class="bonus widget2-heading align-middle numeric p-2p d-table-cell w-auto" >Bonus</th>';
    $ret .= '					<th scope="col"  class="rating widget2-heading align-middle numeric p-2p d-table-cell w-auto" >' . $secTitle . '</th>';
    $ret .= '					<th scope="col"  class="inline-hor-cta widget2-heading align-middle p-2p d-table-cell numeric w-auto"></th>';
    $ret .= '				</tr>';
    $ret .= '			</thead>';
    $ret .= '			<tbody class="w-100">';
    $i = 0;
    $allCasinos = get_posts($query_casino);
    foreach ($allCasinos as $casinoID) {
        if (!get_post_meta($casinoID, 'casino_custom_meta_flaged', true)) {
            $isCasinoPremium = in_array($casinoID, $premiumCasinos);
            $i = $isCasinoPremium ? '<span><img src="https://www.best50casino.com/wp-content/uploads/2018/05/favicon.png" width="17" height="17" loading="lazy" alt="premium" data-toggle="tooltip" title="Premium" ></span>' : '';
            //$ret .= '					<td class="nmbt">'.$ribbon.''.$i.'</td>';
            if (in_array($countryISO, get_post_meta($casinoID, 'casino_custom_meta_rest_countries', true))) {
                $trClass = 'disabledRow';
                $btnDisable = 'disabled';
                $affiLink = 'javascript:void(0)';
                $bonusCTA = 'No ' . get_flags('', '', $GLOBALS['countryISO']) . ' Players Accepted';
                $bonusCTA2 = '';
                $TCS = '';
                $isBonusExclusive = '';
            } else {
                $trClass = 'enableRow';
                $btnDisable = '';
                $affiLink = get_post_meta($casinoID, 'casino_custom_meta_affiliate_link', true);
                $casinoBonusPage = get_post_meta($casinoID, 'casino_custom_meta_bonus_page', true);
                $bonusName = get_post_meta($casinoBonusPage, 'bonus_custom_meta_bonus_offer', true);
                $bonusISO = get_bonus_iso($casinoBonusPage);
                $bonusRollOver = get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_rollover', true);
                $bonusOneType = get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_fst_b', true);
                $bonusOneTypeLower = strtolower($bonusOneType);
                $bonusOneDetails = get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_' . $bonusOneTypeLower . '_type', true);
                $bonusTwoType = get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_scd_b', true) != 'Choose' ? get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_scd_b', true) : '';
                $bonusTwoTypeLower = strtolower($bonusTwoType);
                $bonusTwoDetails = get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_' . $bonusTwoTypeLower . '_type', true);
                $bonusCTA = get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_cta_for_top', true);
                $bonusCTA2 = get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_cta_for_top_2', true);
                $bonusCode = get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_bc_code', true) ? '<br><span class="text-12">Bonus Code: ' . get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_bc_code', true) . '</span>' : '';
                $isBonusExclusive = get_post_meta($bonusName, $bonusISO . "bs_custom_meta_exclusive", true) ? '<div class="exclusive-inline d-none d-xl-block d-lg-block d-md-block"><i class="fa fa-star" aria-hidden="true"></i><span>Exclusive Bonus</span></div>' : '';
                //$simpleTCs = get_post_meta($bonusName, $localIso . 'bs_custom_meta_sp_terms_radio', true) ? 'T&C\'s Apply' : '';
                $advancedTCs = get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_sp_terms', true) ? get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_sp_terms', true) : '';
                // $TCS = get_post_meta($bonusName, $localIso . 'bs_custom_meta_sp_terms_link', true) ? $advancedTCs . '<i class="fa fa-caret-down expand-tcs" data-id="' . $bonusName . '"></i>' : $simpleTCs;
                $TCS = !get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_sp_terms_link', true) ? $advancedTCs : '<a href="' . get_post_meta($bonusName, $bonusISO . 'bs_custom_meta_sp_terms_link', true) . '" target="_blank" rel="nofollow">' . $advancedTCs . '</a>';
            }

            $ret .= '				<tr class="' . $trClass . ' d-flex flex-wrap d-md-table-row d-lg-table-row d-xl-table-row">';
            $ret .= '					<td class="inline-hor-logo border-0 w-15 w-sm-100 text-center white-no-wrap align-self-center position-relative pb-2p pl-md-0 w-sm-100 pr-0 pt-5p align-middle ' . $bonusISO . ' logo-tab"  data-title="Casino" ><div class="table-logo-inline-hor d-inline-block"><a href="' . get_permalink($casinoID) . '"><img src="'.get_the_post_thumbnail_url($casinoID, 'shortcode').'" loading="lazy" />' . $i . '</a></div></td>';
            $ret .= '					<td class="bonus-code position-relative text-center w-sm-100 pb-2p pt-0p pr-5p border-0 align-middle"  data-title=""><span class=""><b>' . get_the_title($casinoID) . '</b></span>' . $bonusCode . '</td>';
            $ret .= '					<td class="bonus position-relative pb-2p text-center white-no-wrap d-flex flex-column align-self-center justify-content-center border-0 w-sm-100 pt-5p pl-md-0 pr-0  align-middle"   data-title="Bonus"><span class="text-bold font-weight-bold text-18 text-primary "><a ' . $btnDisable . ' href="' . $affiLink . '" target="_blank" rel="nofollow">' . $bonusCTA . '</a></span><span class="text-12">' . $bonusCTA2 . '</span>' . $isBonusExclusive . '    </td>';
            $ret .= '					<td class="rating position-relative white-no-wrap  text-center pb-2p  w-sm-100 border-0 align-self-center  pt-5p  pl-md-0 pr-0 align-middle"  data-title="' . $secTitle . '">' . get_rating($casinoID, 'own') . '<br><a class="" href="' . get_the_permalink($casinoID) . '">Review</a><br><span class="text-small tcs" id="' . $bonusName . '">' . $TCS . '</span></td>';
            $ret .= '					<td class="inline-hor-cta position-relative text-center pb-2p w-sm-100 border-0 align-self-center pl-md-0 pr-0 pt-5p align-middle"  data-title="">' . create_cta_button($casinoID, $cta, $btnDisable) . '</td>';
            $ret .= '				</tr>';
        }
    }
    wp_reset_postdata();
    $ret .= '';
    $ret .= '';
    $ret .= '';

    $ret .= '			</tbody>';
    $ret .= '		</table>';
    $ret .= '		</div>';
    $ret .= '</div>';
    $ret .= '</div>';
    return $ret;
}
