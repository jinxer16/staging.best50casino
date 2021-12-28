<?php
function table_cta_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'layout' => '', // horizontal, vertical, full, sidebar
            'limit' => 500,
            'offset_nbr' => '',
            'offset_csn' => '',
            'cho_csn' => '',
            'title' => '',
            'sort_by' => '',
            'sortorder' => '',
            'specific_ratings' => '',
            'custom_cas_order' => '',
            'pay_order' => '',
            '2nd_col_title' => '',
            '2nd_column_list' => '',
            '3rd_col_title' => '',
            '3rd_column' => '',
            '3rd_column_icons' => '',
            'cta' => '',
            'cta_col_title' => '',
            'software' => '', //FILTRA
            'live_software' => '',
            'deposit' => '',
            'withdrawal' => '',
            'live_video' => '',
            'mobile' => '',
            'mob_plat' => '',
            'lang_sup_site' => '',
            'lang_sup_cs' => '',
            'games' => '',
            'live_games' => '',
            'cur_acc' => '',
            'license_country' => '',
            'license_country_or' => '',
            'year_est' => '',
            'country_specific' => '',
            'exc_filter' => false,
            'cat_in' => '', //Δεν είναι ακριβώς φίλτρο καζί αλλά ποιο Bonus να δείχνει
            'cat_in_filter' => '', //Δεν είναι ακριβώς φίλτρο καζί αλλά ποιο Bonus να δείχνει
            'audit' => '',
            'tabs_id' => '',
            'extra_row' => '',
            'aj' => 0
        ), $atts, 'table');


    /* *********************************************
   A QUERY that initializes the default (all) IDS
   ********************************************* */
    $countryISO = $GLOBALS['countryISO'];
    $localIso =  $GLOBALS['visitorsISO']; //Αν η χωρα ειναι ενεργοποιημενη

    global $post;
    $postid = $post->ID;

    if ($atts['country_specific']) {
        $countryISO = $atts['country_specific'];
        $localIso = $atts['country_specific'];
        $bonusISO = $atts['country_specific'];
    }

    $casinos = CasinoSharkcodes::returnBookies($atts);
    $allCasinos = $casinos['casinos'];
    $premiumCasinos = $casinos['onlyPremium'];

    $exclusiveMobileString = '<span  style="top: 0;left: 0;width: 30px;height: 30px;background: #990d0d;border-radius: 100px 0 0 0;-moz-border-radius: 100px 0 0 0;-webkit-border-radius: 0 0 100px 0;z-index: 9;padding: 13px 3px 10px 10px;color: #990d0d;" class="d-flex justify-content-end font-weight-bold text-center text-12 position-absolute d-lg-none d-xl-none"><i class="fa fa-star position-absolute  text-white"  aria-hidden="true" style="right: 9px;top: 3px; font-size: 17px;"></i></span>';
    $ret = '';
    $unique = uniqid();
    if (!empty($atts['tabs_id'])){
        $ret .=  filters_shortcodes($atts['tabs_id'],$atts,$postid,$unique);

    }

    if ('home' === $atts['layout']) {
        $ret .= '<div class="inner_row more_games '.$unique.' mb-15p' . $atts['layout'] . '">';
        $ret .= '	<div class="">';
        if ($atts['title'] && empty($atts['tabs_id']) && $atts['aj']==0) {
            $ret .= '		<div class="star shortcode-star d-block  border-0 mb-0 pt-5p h-auto position-relative text-center">';
            $ret .= '<span class="hidden-md hidden-xs d-none d-md-inline-block d-lg-inline-block d-xl-inline-block" style="position: absolute;left: 5px;top: 2px;">
                         <span class="sort-icon secure">Secure</span>';
            $ret .= '<span class="sort-icon trusted">Trusted</span>';
            $ret .= '<span class="sort-icon verified">Verified</span>
                        </span>';
            $flagISO = $localIso != 'nl' ? $localIso : 'eu';
            $ret .= get_flags('', '', $flagISO, 25, array('style' => 'padding-right:5px;padding-bottom: 3px;'));
            $ret .= $atts['title'];
            $ret .= '	</div>';
        }
        $ret .= '		<div class="table-responsive">';
        $ret .= '		<table class="table table-striped d-flex flex-wrap d-md-table d-lg-table d-xl-table table-condensed mb-0 text-center medium align-middle p-5p"  id="' . uniqid() . '">';
        if (empty($atts['tabs_id']) && $atts['aj']==0) {
            $ret .= '			<thead class="casinohead">';
            $ret .= '				<tr>';
            $ret .= '					<th scope="col" class="inline-hor-logo widget2-heading align-middle p-2p numeric d-table-cell w-auto"></th>';
            $ret .= '					<th scope="col" class="bonus-code widget2-heading align-middle numeric p-2p d-table-cell  w-auto">Casino</th>';
            $ret .= '					<th scope="col"  class="bonus widget2-heading align-middle numeric p-2p d-table-cell w-auto" >Bonus</th>';
            $ret .= '					<th scope="col"  class="rating widget2-heading align-middle numeric p-2p d-table-cell w-auto" >Info</th>';
            $ret .= '					<th scope="col"  class="inline-hor-cta widget2-heading align-middle p-2p d-table-cell numeric w-auto">' . $atts['cta_col_title'] . '</th>';
            $ret .= '				</tr>';
            $ret .= '			</thead>';
        }
        $ret .= '			<tbody>';
        $i = 0;
        if ($allCasinos):
            $jk = 0;
            foreach ($allCasinos as $casinoID) {
                        $isCasinoPremium = in_array($casinoID, $premiumCasinos);
                        $i = $isCasinoPremium ? '<span><img src="https://www.best50casino.com/wp-content/uploads/2018/05/favicon.png" loading="lazy" width="17" height="17" alt="premium" data-toggle="tooltip" title="Premium" ></span>' : '';
                        //$ret .= '					<td class="nmbt">'.$ribbon.''.$i.'</td>';
                         $resttricted =  get_post_meta($casinoID, 'casino_custom_meta_rest_countries', true);
                        if (is_array($resttricted) && in_array($countryISO,$resttricted)) {
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
                            $geoBonusArgs = is_country_enabled($casinoID, 'kss_casino');
                            $affiLink = $geoBonusArgs['aff_sc'];
                            $bonusCTA = $geoBonusArgs['bonusText']['cta-top'];
                            $bonusCTA2 = $geoBonusArgs['bonusText']['FlagText'];
                            $bonusCode ='';
                            if ( $geoBonusArgs['bonusCode'] !== 'No Code Required'){
                                $bonusCode =  '<br><small>Bonus Code: ' . $geoBonusArgs['bonusCode'] . '</small>';
                            }
                            $isBonusExclusive = $geoBonusArgs['isExclusive'] ? '<div class="exclusive-inline d-none d-xl-block d-lg-block"><i class="fa fa-star" aria-hidden="true"></i><span>Exclusive Bonus</span></div>' : '';
                            $isBonusExclusiveMobile = $geoBonusArgs['isExclusive']  ? $exclusiveMobileString : '';
                            //$simpleTCs = get_post_meta($bonusObject, $localIso . 'bs_custom_meta_sp_terms_radio', true) ? 'T&C\'s Apply' : '';
                            $advancedTCs = $geoBonusArgs['bonusText']['terms'] ?: '';
                            // $TCS = get_post_meta($bonusObject, $localIso . 'bs_custom_meta_sp_terms_link', true) ? $advancedTCs . '<i class="fa fa-caret-down expand-tcs" data-id="' . $bonusObject . '"></i>' : $simpleTCs;
                            $TCS = !get_post_meta($casinoID, $countryISO . 'casino_custom_meta_sp_terms_link', true) ? $advancedTCs : '<a href="' . get_post_meta($casinoID, $countryISO . 'casino_custom_meta_sp_terms_link', true) . '" target="_blank" rel="nofollow" class="text-9 text-grey text-italic text-center">' . $advancedTCs . '</a>';
                        }
                        if ($jk > 15) {
                            $trClass .= " hidden-row";
                            $trStyle = ' style="display:none;"';
                            $ret .= '				<tr class="parent-row text-sm-13 w-100 position-relative mb-lg-0 mb-xl-0 mb-5p ' . $trClass . '" ' . $trStyle . '>';
                        }else{
                            $ret .= '<tr class="parent-row text-sm-13 w-100 position-relative mb-lg-0 mb-xl-0 mb-5p">';
                        }
                        $wagering = '';
                        $turnoverD = $geoBonusArgs['bonusText']['right-turnover-d'];
                        $turnoverB = $geoBonusArgs['bonusText']['right-turnover-b'];
                        $turnoverS = $geoBonusArgs['bonusText']['right-turnover-s'];
                        if ($turnoverD === $turnoverB && $turnoverD) {

                            $wagering = '<div style="width:100%;"><i class="fa fa-credit-card" aria-hidden="true" data-toggle="tooltip" title="Deposit" style="color:#29bf29;padding-right:1px;"></i> + <i class="fa fa-gift" aria-hidden="true" data-toggle="tooltip" title="Bonus" style="color:#2da9f6;padding-left:3px;padding-right:1px;font-size: 1.3em;"></i> x' . $turnoverD . '</div>';
                            $wagering .= $turnoverS ? '<div style="width:100%;"><i class="fa fa-refresh" aria-hidden="true" data-toggle="tooltip" title="Spins" style="color:orange;padding-left:3px;padding-right:1px;"></i> x' . $turnoverS . '</div>' : '';
                        } else {
                            $zipiti = $turnoverD && $turnoverB ? '2' : '1';
                            $widthszip = 100 / $zipiti;
                            $wagering .= $turnoverD ? '<div style="width:' . $widthszip . '%;"><i class="fa fa-credit-card" aria-hidden="true" data-toggle="tooltip" title="Deposit" style="color:#29bf29;padding-right:1px;"></i> x' . $turnoverD . '</div>' : '';
                            $wagering .= $turnoverB ? '<div style="width:' . $widthszip . '%;"><i class="fa fa-gift" aria-hidden="true" data-toggle="tooltip" title="Bonus" style="color:#2da9f6;padding-left:3px;padding-right:1px;font-size: 1.3em;"></i> x' . $turnoverB . '</div>' : '';
                            $wagering .= $turnoverS ? '<div style="width:100%;"><i class="fa fa-refresh" aria-hidden="true" data-toggle="tooltip" title="Spins" style="color:orange;padding-left:3px;padding-right:1px;"></i> x' . $turnoverS . '</div>' : '';
                        }
                        if (!$wagering) {
                            $wagering = 'None';
                        }
                        // $ret .= '					<td class="inline-hor-logo ' . $bonusISO . ' logo-tab"  data-title="Casino" ><a href="' . get_permalink($casinoID) . '">' . get_the_post_thumbnail($casinoID, 'shortcode') . '' . $i . '</a></td>';
                if (wp_is_mobile()){
                    $ret .= '					<td class="inline-hor-logo w-sm-32 order-1 border-0 white-no-wrap align-self-center position-relative pb-2p pl-10p pl-md-0  pr-0 pt-5p align-middle' . $bonusISO . ' logo-tab"  data-title="Casino" >' . $isBonusExclusiveMobile . '<a href="' . get_permalink($casinoID) . '"><img src="' . get_the_post_thumbnail_url($casinoID, 'book_logo_mob') . '" width="95" height="65" loading="lazy" class="attachment-shortcode size-shortcode wp-post-image">' . $i . '</a></td>';
                }else{
                    $ret .= '					<td class="inline-hor-logo w-sm-32 order-1 border-0 white-no-wrap align-self-center position-relative pb-2p pl-10p pl-md-0  pr-0 pt-5p align-middle' . $bonusISO . ' logo-tab"  data-title="Casino" >' . $isBonusExclusiveMobile . '<a href="' . get_permalink($casinoID) . '"><img src="' . get_the_post_thumbnail_url($casinoID, 'book_logo') . '" width="110" height="80" loading="lazy" class="attachment-shortcode size-shortcode wp-post-image">' . $i . '</a></td>';
                }
                        $ret .= '					<td class="rating position-relative white-no-wrap  pb-2p order-4 w-sm-30 border-0 align-self-center  pt-5p pl-10p pl-md-0 pr-0 align-middle"  style="vertical-align: middle;" data-title="info-tab">' . get_rating($casinoID, 'numbers') . '<a class="text-decoration-none d-xl-block d-lg-block d-none" href="' . get_the_permalink($casinoID) . '">'.get_the_title($casinoID).'</a></td>';

                        $ret .= '					<td class="bonus position-relative pb-2p d-flex flex-column align-self-center justify-content-center border-0 order-2 d-md-table-cell w-sm-65 pt-5p pl-10p pl-md-0 pr-0  align-middle"   data-title="Bonus"><a  href="'. get_permalink($casinoID) .'" class="text-primary text-decoration-none d-block d-lg-none d-xl-none">' . get_the_title($casinoID) . '</a><span class="font-weight-bold text-primary text-17 d-block"><a class="font-weight-bold text-decoration-none" ' . $btnDisable . ' href="' . $affiLink . '" target="_blank"  rel="nofollow">' . $bonusCTA . '</a></span><span class="text-medium text-12">' . $bonusCTA2 . '</span>' . $isBonusExclusive . '    </td>';
                $ret .= '					<td class="bonus-code position-relative  d-none d-md-table-cell pb-2p pt-0p pl-0 pr-5p border-0 align-middle"  style="vertical-align: middle;" data-title=""><span>' . $wagering . '</span>' . $bonusCode . '</td>';

                $ret .= '					<td class="inline-hor-cta position-relative  pb-2p w-sm-70 border-0 align-self-center order-5 pl-10p pl-md-0 pr-0 pt-5p align-middle"  data-title="' . $atts['cta_col_title'] . '">' . create_cta_button($casinoID, $atts['cta'], $btnDisable, $countryISO,$atts['cat_in']) . '</td>';
                        $ret .= '				</tr>';
                        if ($TCS) $ret .= '<tr id="child-row-' . $jk . '" class="pt-0 child-row ' . $trClass . '" ' . $trStyle . '><td colspan="5" class="d-flex bg-yellowish d-xl-table-cell d-lg-table-cell w-100 align-items-center"><p class="w-sm-95 position-relative white-space-initial text-10 text-grey text-italic text-center mb-0">' . $TCS . '</p><i class="pl-1 w-xs-10 fa fa-close close-x d-xl-none d-lg-none text-secondary" data-id="child-row-' . $jk . '"></i></td></tr>';

                        $jk = $jk + 1;
            }


            wp_reset_postdata();
        endif;
        $ret .= '';
        $ret .= '';
        $ret .= '';

        $ret .= '			</tbody>';
        $ret .= '		</table>';
        if ($jk > 15) {
            $ret .= '<div id="alal" class="btn btn-border border-primary show-more-rows mb-20 text-center w-100 noshadow" data-showr="off">Show More Casinos</div>';
        }
        $ret .= '		</div>';
        $ret .= '</div>';
        $ret .= '</div>';
        }

    elseif ('default' === $atts['layout']) { //////////////////////////////////////////////////////////////// DEFAULT ////////////////////////////////////////////////////////
        //$ret = print_r(get_casino_order());
        $ret .= '<div class="inner_row more_games '.$unique.' mb-15p' . $atts['layout'] . '">';
        $ret .= '	<div class="">';
        if ($atts['title'] && empty($atts['tabs_id']) && $atts['aj']==0 ) {
            $ret .= '		<div class="star shortcode-star d-block  border-0 mb-0 pt-5p h-auto position-relative text-center">';
            $ret .= '<span class="hidden-md hidden-xs d-none d-md-inline-block d-lg-inline-block d-xl-inline-block" style="position: absolute;left: 5px;top: 4px;">
                         <span class="sort-icon secure">Secure</span>';
            $ret .= '<span class="sort-icon trusted">Trusted</span>';
            $ret .= '<span class="sort-icon verified">Verified</span>
                        </span>';
            $flagISO = $localIso != 'nl' ? $localIso : 'eu';
            $ret .= get_flags('', '', $flagISO, 25, array('style' => 'padding-right:5px;padding-bottom: 3px;')) . $atts['title'] . '</div>';
        }
        $ret .= '		<div class="table-responsive">';
        $ret .= '		<table class="table   d-flex flex-wrap d-md-table d-lg-table d-xl-table table-condensed mb-0 text-center medium align-middle p-5p"  id="' . uniqid() . '">';
        if (empty($atts['tabs_id']) && $atts['aj']===0) {
            $ret .= '			<thead class="casinohead">';
            $ret .= '				<tr>';
            $ret .= '				   <th scope="col" class="inline-hor-logo widget2-heading align-middle p-2p numeric d-table-cell w-auto">Casino</th>';
            $ret .= '					 <th scope="col"  class="bonus widget2-heading align-middle numeric p-2p d-table-cell w-auto" >' . $atts['2nd_col_title'] . '</th>';
            $ret .= '					<th scope="col"  class="info-tab widget2-heading align-middle numeric p-2p d-table-cell w-auto" >' . $atts['3rd_col_title'] . '</th>';
            $ret .= '					   <th scope="col"  class="rating widget2-heading align-middle numeric p-2p d-table-cell w-auto" >Rating</th>';
            $ret .= '					 <th scope="col"  class="inline-hor-cta widget2-heading align-middle p-2p d-table-cell numeric w-auto">' . $atts['cta_col_title'] . '</td>';
            $ret .= '				</tr>';
            $ret .= '			</thead>';
        }
        $ret .= '			<tbody>';
        $i = 0;
        if ($allCasinos):
            $jk = 0;
            foreach ($allCasinos as $casinoID) {
                $resttricted = get_post_meta($casinoID, 'casino_custom_meta_rest_countries', true);
                if ($jk < $atts['limit'] && !in_array($countryISO,$resttricted)) {
                    $isCasinoPremium = in_array($casinoID, $premiumCasinos);
                    $i = $isCasinoPremium ? '<span><img src="https://www.best50casino.com/wp-content/uploads/2018/05/favicon.png" loading="lazy" width="17" height="17" alt="premium" data-toggle="tooltip" title="Premium" ></span>' : '';
                    //$ret .= '					<td class="nmbt">'.$ribbon.''.$i.'</td>';
                    if (is_array($resttricted) && in_array($countryISO, $resttricted)) {
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

                        $geoBonusArgs = is_country_enabled($casinoID, 'kss_casino');
                        $affiLink = $geoBonusArgs['aff_sc'];
                        $bonusCTA = $geoBonusArgs['bonusText']['cta-top'];
                        $bonusCTA2 = $geoBonusArgs['bonusText']['FlagText'];
                        $extraFilter = false;
                        $catfilter = false;
                        $bonusCode ='';
                        if ( $geoBonusArgs['bonusCode'] !== 'No Code Required'){
                            $bonusCode =  '<br><small>Bonus Code: ' . $geoBonusArgs['bonusCode'] . '</small>';
                        }
                        $isBonusExclusive = $geoBonusArgs['isExclusive'] ? '<div class="exclusive-inline d-none d-xl-block d-lg-block"><i class="fa fa-star" aria-hidden="true"></i><span>Exclusive Bonus</span></div>' : '';
                        $advancedTCs = $geoBonusArgs['bonusText']['terms'] ?: '';
                        $TCS = !get_post_meta($casinoID, $countryISO . 'casino_custom_meta_sp_terms_link', true) ? $advancedTCs : '<a href="' . get_post_meta($casinoID, $countryISO . 'casino_custom_meta_sp_terms_link', true) . '" target="_blank" rel="nofollow" class="text-9 text-grey text-italic text-center">' . $advancedTCs . '</a>';

                        if ($atts['cat_in']) {
                            $extraFilter = true;
                            $bonustypes = $geoBonusArgs['bonusText']['left-billboard'];
                            if ($bonustypes) {
                                foreach ($bonustypes as $term) {
                                    if ($atts['cat_in'] === $term && current_user_can('administrator')) {
                                        $catfilter = true;
                                    }
                                }
                            }
                        }
                    }
                    if ($jk > 15) {
                        $trClass .= " hidden-row";
                        $trStyle = ' style="display:none;"';
                    }else{
                        $trClass .= "";
                        $trStyle = '';
                    }

                    if (($extraFilter && $catfilter) || (!$extraFilter && !$catfilter)) {
                        $ret .= '				<tr class="parent-row text-sm-13 w-100 position-relative mb-lg-0 mb-xl-0 mb-5p ' . $trClass . '" ' . $trStyle . '>';
                        $ret .= '					<td class="inline-hor-logo w-sm-32 order-1 border-0 white-no-wrap align-self-center position-relative p-sm-5p pb-2p pl-10p pl-md-0  pr-0 pt-5p align-middle ' . $bonusISO . ' logo-tab"  data-title="Casino" ><a href="' . get_permalink($casinoID) . '"><img src="' . get_the_post_thumbnail_url($casinoID, 'shortcode') . '" loading="lazy" class="attachment-shortcode size-shortcode wp-post-image">' . $i . '</a></td>';

                        $ret .= '					<td class="bonus position-relative pb-2p white-no-wrap d-flex flex-column flex-xl-wrap flex-lg-wrap align-self-center justify-content-center border-0 pl-sm-5 order-2 d-md-table-cell w-sm-65 pt-5p pl-10p pl-md-0 pr-0  align-middle"   data-title="' . $atts['2nd_col_title'] . '"><span class="text-primary text-17 font-weight-bold"><a ' . $btnDisable . ' href="' . $affiLink . '" target="_blank" rel="nofollow" class="text-decoration-none">' . $bonusCTA . '</a></span><br><span class="text-12">' . $bonusCTA2 . '</span>' . $isBonusExclusive . '    </td>';
                        $ret .= '					<td class="info-tab border-0 w-20 order-3 w-sm-100 p-sm-5p pb-2p  pl-md-0 pr-0 pt-5p " data-title=""  style="vertical-align: middle;"><span class="text-12 align-items-center justify-content-between p-3p text-left w-sm-100 d-flex flex-row flex-md-column flex-lg-column flex-xl-column ">' . create_column($casinoID, $atts['3rd_column'], $atts['3rd_column_icons'], $countryISO, $atts['pay_order']) . '</span></td>';

                        //$ret .= '					<td class="pros"  data-title=""><span class="text-medium">'.get_the_title($casinos).'</span>'.$bonusCode.'</td>';
                        $ret .= '					<td class="rating position-relative white-no-wrap  pb-2p order-4 w-sm-30 border-0 align-self-center  pt-5p pl-10p pl-md-0 pr-0 align-middle"  data-title="' . $atts['3rd_col_title'] . '">' . get_rating($casinoID, 'numbers') . '<a class="text-decoration-none" href="' . get_the_permalink($casinoID) . '">Review</a></td>';
                        $ret .= '					<td class="inline-hor-cta position-relative  pb-2p w-sm-70 border-0 align-self-center order-5 pl-10p pl-md-0 pr-0 pt-5p align-middle"  data-title="' . $atts['cta_col_title'] . '">' . create_cta_button($casinoID, $atts['cta'], $btnDisable, $countryISO,$atts['cat_in']) . '</td>';
                        $ret .= '				</tr>';
                        if ($TCS) $ret .= '<tr id="child-row-' . $jk . '" class="pt-0 child-row ' . $trClass . '" ' . $trStyle . '><td colspan="5" class="d-flex d-lg-table-cell d-xl-table-cell bg-yellowish w-100 align-items-center"><p class="w-sm-95 position-relative white-space-initial text-10 text-grey text-italic text-center mb-0 pt-2 pb-2">' . $TCS . '</p><i class="pl-1 w-xs-10 fa fa-close close-x d-xl-none d-block d-lg-none visible-xs text-secondary" data-id="child-row-' . $jk . '"></i></td></tr>';
                        $jk = $jk + 1;
                    }
                }
            }

        endif;
        wp_reset_postdata();
        $ret .= '';
        $ret .= '';
        $ret .= '';

        $ret .= '			</tbody>';
        $ret .= '		</table>';
        if ($jk > 15) {
            $ret .= '<div id="alal" class="btn btn-border border-primary show-more-rows mb-20 text-center w-100 noshadow" data-showr="off">Show More Casinos</div>';
        }
        $ret .= '		</div>';
        $ret .= '</div>';
        $ret .= '</div>';
    }

    elseif ('default_2' === $atts['layout']) { //////////////////////////////////////////////////////////////// DEFAULT 2 ////////////////////////////////////////////////////////
        $ret .= '<div class="inner_row more_games '.$unique.' mb-15p ' . $atts['layout'] . '">';
        $ret .= '	<div class="">';
        if ($atts['title'] && empty($atts['tabs_id']) && $atts['aj'] === 0) {
            if ($atts['exc_filter'] === "true") {
                $ret .= '		<div class="star shortcode-star ext-filter flex-column flex-md-row flex-lg-row flex-xl-row" style="display:flex;justify-content: space-between; align-items: center">';
                $ret .= '<span class="hidden-md hidden-xs d-none d-lg-block  d-xl-block pl-5p" style="">
                         <span class="sort-icon secure">Secure</span>';
                $ret .= '<span class="sort-icon trusted">Trusted</span>';
                $ret .= '<span class="sort-icon verified">Verified</span>
                        </span>';
                $flagISO = $localIso !== 'nl' ? $localIso : 'eu';
                $ret .= '<span>' . get_flags('', '', $flagISO, 25, array('style' => 'padding-left:5px;padding-bottom: 3px;')) . $atts['title'] . '</span>';
                $ret .= '<div class="pull-right mb-0 mr-5">
                            <p class="mb-0 text-13"><label class="m-0" id="label-exclusive" style="font-weight:normal;"><span>Show only Exclusive Bonuses</span>
                                    <input style="vertical-align: middle;margin:0px !important;" data-shownex="off" type="checkbox" name="exclusive-bonus" id="exclusive-bonus"></label></p>

                        </div>';
                $ret .= '</div>';
            } else {
                $ret .= '		<div class="star shortcode-star">';
                $ret .= '<span class="hidden-xs d-none d-lg-block  d-xl-block " style="position: absolute;left: 5px;top: -2px;">
                         <span class="sort-icon secure">Secure</span>';
                $ret .= '<span class="sort-icon trusted">Trusted</span>';
                $ret .= '<span class="sort-icon verified">Verified</span>
                        </span>';
                $flagISO = $localIso !== 'nl' ? $localIso : 'eu';
                $ret .= '<span>' . get_flags('', '', $flagISO, 25, array('style' => 'padding-right:5px;padding-bottom: 3px;')) . $atts['title'] . '</span>';
                $ret .= '</div>';
            }

        }
        $ret .= '		<div class="table-responsive">';
        $ret .= '		<table class="table table-condensed mb-0 medium table_3"  id="' . uniqid() . '">';
        if (empty($atts['tabs_id']) && $atts['aj']==0) {
            $ret .= '			<thead class="casinohead">';
            $ret .= '				<tr>';
            $ret .= '						<th scope="col" class="inline-hor-logo widget2-heading align-middle p-2p numeric d-table-cell w-auto"></th>';
            $ret .= '					<th scope="col" class="inline-hor-logo widget2-heading align-middle p-2p numeric d-table-cell w-auto">Casino</th>';
            $ret .= '					 <th scope="col"  class="bonus widget2-heading align-middle numeric p-2p d-table-cell w-auto" >' . $atts['2nd_col_title'] . '</th>';
            $wageringTitle = $atts['cat_in'] == '48' ? 'FDB Wagering' : 'Wagering';
            $ret .= '					<th class="wag widget2-heading align-middle p-2p numeric d-table-cell w-auto">' . $wageringTitle . '</th>';
            $ret .= '					<th class="rating widget2-heading align-middle numeric p-2p d-table-cell w-auto">' . $atts['3rd_col_title'] . '</th>';
            $ret .= '					<th class="inline-hor-cta widget2-heading align-middle numeric p-2p d-table-cell w-auto">' . $atts['cta_col_title'] . '</th>';
            $ret .= '				</tr>';
            $ret .= '			</thead>';
        }
        $ret .= '			<tbody>';
        $i = 0;
        if ($allCasinos):
            $jk = 0;
            foreach ($allCasinos as $casinoID) {
                $resttricted= get_post_meta($casinoID, 'casino_custom_meta_rest_countries', true);
                if ($jk <= $atts['limit'] && !in_array($countryISO,$resttricted)) {
                    $isCasinoPremium = in_array($casinoID, $premiumCasinos);
                    $i = $isCasinoPremium ? '<span><img src="https://www.best50casino.com/wp-content/uploads/2018/05/favicon.png" loading="lazy" width="17" height="17" alt="premium" data-toggle="tooltip" title="Premium" ></span>' : '';

                    if (in_array($countryISO, $resttricted)) {
                        $trClass = 'disabledRow';
                        $btnDisable = 'disabled';
                        $affiLink = 'javascript:void(0)';
                        $li1 = 'No ' . get_flags('', '', $GLOBALS['countryISO']) . ' Players Accepted';
                        $li2 = '';
                        $li3 = '';
                        $bonusCTA2 = '';
                        $TCS = '';
                        $isBonusExclusive = '';
                        $wagering = '-';
                    } else {
                        $trClass = 'enableRow';
                        $btnDisable = '';
                        $geoBonusArgs = is_country_enabled($casinoID, 'kss_casino');
                        $affiLink = $geoBonusArgs['aff_sc'];
                        $bonusCTA = $geoBonusArgs['bonusText']['cta-top'];
                        $bonusCTA2 = $geoBonusArgs['bonusText']['FlagText'];
                        $bonusCode ='';
                        if ( $geoBonusArgs['bonusCode'] !== 'No Code Required'){
                            $bonusCode =   $geoBonusArgs['bonusCode'];
                        }
                        $isBonusExclusive = $geoBonusArgs['isExclusive'] ? '<div class="exclusive-inline d-none d-xl-block d-lg-block"><i class="fa fa-star" aria-hidden="true"></i><span>Exclusive Bonus</span></div>' : '';
                        $advancedTCs = $geoBonusArgs['bonusText']['terms'] ?: '';
                        $TCS = !get_post_meta($casinoID, $countryISO . 'casino_custom_meta_sp_terms_link', true) ? $advancedTCs : '<a href="' . get_post_meta($casinoID, $countryISO . 'casino_custom_meta_sp_terms_link', true) . '" target="_blank" rel="nofollow" class="text-9 text-grey text-italic text-center">' . $advancedTCs . '</a>';
                        $extraFilter = false;
                        $catfilter = false;

                        $bonusISO = get_bonus_iso($casinoID);
                        $filters =
                            array(
                                '67' => 'casino_custom_meta_bc_code',
                                '56' => 'casino_custom_meta__is_free_spins',
                                '50' => 'casino_custom_meta__is_live_bonus',
                                '48' => 'casino_custom_meta__is_no_dep',
                                '49' => 'casino_custom_meta__is_reload_bonus',
                                '54' => 'casino_custom_meta__is_vip',
                                '47' => 'casino_custom_meta__is_welcome_bonus',
                                '53' => 'casino_custom_meta__is_mobile_bonus',
                            );

                        if ($atts['cat_in']) {
                            $extraFilter = true;
                            foreach ($filters as $k => $v) {
                                    if ($k === '67' && $k === $atts['cat_in']){
                                        $meta = get_post_meta($casinoID, $bonusISO.$v, true);
                                        if (empty($meta)) {
                                            $catfilter = true;
                                        }
                                    }else{
                                        if ($k === $atts['cat_in']) {
                                            echo $bonusISO.$v;
                                            echo get_post_meta($casinoID,$bonusISO.'casino_custom_meta_is_no_dep',true);
                                            $meta = get_post_meta($casinoID, $bonusISO . $v, true);
                                            if (isset($meta)) {
                                                $catfilter = true;
                                            }
                                        }
                                    }
                                }
                        }


                        $wagering = '';
                        $turnoverD = $geoBonusArgs['bonusText']['right-turnover-d'];
                        $turnoverB = $geoBonusArgs['bonusText']['right-turnover-b'];
                        $turnoverS = $geoBonusArgs['bonusText']['right-turnover-s'];

                        if ($turnoverD === $turnoverB && $turnoverD) {

                            $wagering = '<div style="width:100%;"><i class="fa fa-credit-card" aria-hidden="true" data-toggle="tooltip" title="Deposit" style="color:#29bf29;padding-right:1px;"></i> + <i class="fa fa-gift" aria-hidden="true" data-toggle="tooltip" title="Bonus" style="color:#2da9f6;padding-left:3px;padding-right:1px;font-size: 1.3em;"></i> x' . $turnoverD . '</div>';
                            $wagering .= $turnoverS ? '<div style="width:100%;"><i class="fa fa-refresh" aria-hidden="true" data-toggle="tooltip" title="Spins" style="color:orange;padding-left:3px;padding-right:1px;"></i> x' . $turnoverS . '</div>' : '';
                        } else {
                            $zipiti = $turnoverD && $turnoverB ? '2' : '1';
                            $widthszip = 100 / $zipiti;
                            $wagering .= $turnoverD ? '<div style="width:' . $widthszip . '%;"><i class="fa fa-credit-card" aria-hidden="true" data-toggle="tooltip" title="Deposit" style="color:#29bf29;padding-right:1px;"></i> x' . $turnoverD . '</div>' : '';
                            $wagering .= $turnoverB ? '<div style="width:' . $widthszip . '%;"><i class="fa fa-gift" aria-hidden="true" data-toggle="tooltip" title="Bonus" style="color:#2da9f6;padding-left:3px;padding-right:1px;font-size: 1.3em;"></i> x' . $turnoverB . '</div>' : '';
                            $wagering .= $turnoverS ? '<div style="width:100%;"><i class="fa fa-refresh" aria-hidden="true" data-toggle="tooltip" title="Spins" style="color:orange;padding-left:3px;padding-right:1px;"></i> x' . $turnoverS . '</div>' : '';
                        }
                        if (!$wagering) {
                            $wagering = '-';
                        }
                        $extraListItem1 = explode(",", get_post_meta($casinoID, 'casino_custom_meta_why_play', true));
                        if ($atts['2nd_column_list'] === "bonus") {
                            if ($atts['cat_in'] == "48") {
                                $li2 = $bonusCTA2 ?: $extraListItem1[2];
                                $li1 = str_replace("+ ", "", $bonusCTA2 ?: $extraListItem1[0]);

                            } else {
                                $li1 = $bonusCTA ?: $extraListItem1[2];
                                $li2 = $bonusCTA2 ?: $extraListItem1[0];

                            }
                            if ($geoBonusArgs['isExclusive'] && $atts['cat_in'] !== '67') {
                                $li3 = '<span>Exclusive Bonus</span>';
                                $exc = " exc";
                                $excClass = "exclusive";
                            } else {
                                $li3 = $bonusCode ?: $extraListItem1[1];
                                $exc = $bonusCode ? 'bonus-exclusive-class' : "";
                                $excClass = "not-exclusive";
                            }
                        } elseif ($atts['2nd_column_list'] === "why") {
                            $li1 = $extraListItem1[0];
                            $li2 = $extraListItem1[1];
                            $li3 = $extraListItem1[2];
                        }
                    }
                    if ($jk > 15) {
                        $trClass .= " hidden-row";
                        $trStyle = ' style="display:none;"';
                    }else{
                        $trClass .= " not-hidden";
                        $trStyle = '';
                    }
                    if (($extraFilter && $catfilter) || (!$extraFilter && !$catfilter)) {
                        $ret .= '				<tr class="parent-row text-sm-13 w-100 position-relative mb-lg-0 mb-xl-0 mb-5p ' . $trClass . ' ' . $excClass . '" ' . $trStyle . '>';
                        //$ret .= '					<td class="nmbt">'.$ribbon.''.$i.'</td>';
                        $ret .= '					<td class="inline-hor-logo w-sm-32 w-20 order-1 border-0 white-no-wrap align-self-center position-relative p-sm-5p pb-2p pl-10p pl-md-0  pr-0 pt-5p align-middle ' . $bonusISO . ' logo-tab"  data-title="Casino" ><a href="' . get_permalink($casinoID) . '"><img src="' . get_the_post_thumbnail_url($casinoID, 'shortcode') . '" loading="lazy" class="attachment-shortcode size-shortcode wp-post-image">' . $i . '</a></td>';
                        $ret .= '					<td class="casino-title text-center w-20 d-none d-md-table-cell d-lg-table-cell d-xl-table-cell border-0 p-sm-5p pb-2p pl-0 pl-md-0 pr-0 pt-5p" style="vertical-align: middle"  data-title="casino"><span><a class="text-decoration-none" href="' . get_the_permalink($casinoID) . '">' . get_the_title($casinoID) . ' Bonus</a></span></td>';
                        $ret .= '					<td class="bonus position-relative pb-2p white-no-wrap d-flex flex-wrap align-self-center justify-content-start border-0 pl-sm-5 order-2 d-md-table-cell w-sm-65 pt-5p pl-10p pl-md-0 pr-0  align-middle" data-title="' . $atts['2nd_col_title'] . '"><ul class="billboard-list bonus-table-list text-sm-13 mt-0 mb-0 pl-0 list-typenone" style="white-space: nowrap;text-align: left;"><li class="text-primary font-weight-bold text-17 " style="list-style: none"><a ' . $btnDisable . ' href="' . $affiLink . '" target="_blank" rel="nofollow" class="text-decoration-none">' . $li1 . '</a></li><li style="list-style: none">' . $li2 . '</li><li style="list-style: none" class="' . $exc . '">' . $li3 . '</li></ul></td>';
                        $ret .= '					<td class="wag border-0 w-20 p-sm-0p d-table-cell d-md-table-cell d-lg-table-cell d-xl-table-cell order-3 w-sm-100 pt-sm-5p pb-sm-5p white-no-wrap text-center"  data-title="Bonus" style="white-space: nowrap; vertical-align: middle;">';
                        $ret .= '
                        <span class="text-medium align-items-lg-start pt-sm-0 align-items-md-start align-items-xl-start align-items-center text-sm-12 text-16 justify-content-between p-3p text-left w-sm-100 d-flex flex-row flex-md-column flex-lg-column flex-xl-column">
                        <span class="column-text w-40 text-center">
                        <a class="text-decoration-none d-xl-none d-lg-none d-md-none d-block" style="font-size: 15px;" href="'.$affiLink.'" target="_blank" rel="nofollow">
                      '.get_the_title($casinoID).'
                        </a>
                        </span>
                        <div class="w-100 w-sm-60 d-flex flex-column text-center">
                        '.$wagering.'
                        </div>
                        </span>';
					    $ret .='</td>';
                        $ret .= '					<td class="rating position-relative white-no-wrap  w-20 pb-2p text-center order-4 w-sm-30 border-0 align-self-center  pt-5p pl-10p pl-md-0 pr-0 align-middle"  data-title="' . $atts['3rd_col_title'] . '">' . get_rating($casinoID, 'numbers') . '</td>';
                        $ret .= '					<td class="inline-hor-cta  position-relative text-center  pb-2p w-sm-70 border-0 align-self-center order-5 pl-10p pl-md-0 pr-0 pt-5p align-middle"  data-title="' . $atts['cta_col_title'] . '">' . create_cta_button($casinoID, $atts['cta'], $btnDisable, $countryISO,$atts['cat_in']) . '</td>';
                        $ret .= '				</tr>';
                        if ($TCS) $ret .= '<tr id="child-row-' . $jk . '" class="pt-0 child-row ' . $trClass . '" ' . $trStyle . '><td colspan="6" class="d-xl-table-cell d-lg-table-cell d-flex align-items-center bg-yellowish bg-xs-none w-100 f-xs-center"><p class="w-sm-95 position-relative white-space-initial text-10 text-grey text-italic text-center mb-0">' . $TCS . '</p><i class="pl-1  fa fa-close close-x d-xl-none d-lg-none visible-xs d-block text-secondary" data-id="child-row-' . $jk . '"></i></td></tr>';
                        $jk = $jk + 1;
                    }
                }
            }
        endif;
        wp_reset_postdata();
        $ret .= '';
        $ret .= '';
        $ret .= '';

        $ret .= '			</tbody>';
        $ret .= '		</table>';
  
        if ($jk > 15) {
            $ret .= '<div id="alal" class="btn btn-border border-primary show-more-rows mb-20 text-center w-100 noshadow" data-showr="off">Show More Casinos</div>';
        }
        $ret .= '		</div>';
        $ret .= '</div>';
        $ret .= '</div>';
    }

    elseif ('default_3' === $atts['layout']) {
        $priorityFilter =null;

        if ($atts['pay_order'] !=='') $priorityFilter = $atts['pay_order'];
        $ret .= '<div class="inner_row more_games '.$unique.' mb-15p ' . $atts['layout'] . '">';
        $ret .= '	<div class="">';
        if ($atts['title'] && empty($atts['tabs_id']) && $atts['aj'] === 0) {
            $ret .= '		<div class="star shortcode-star d-block  border-0 mb-0 pt-5p h-auto position-relative text-center">';
            $ret .= '<span class="hidden-md hidden-xs d-none d-md-inline-block d-lg-inline-block d-xl-inline-block" style="position: absolute;left: 5px;top: 4px;">
                         <span class="sort-icon secure">Secure</span>';
            $ret .= '<span class="sort-icon trusted">Trusted</span>';
            $ret .= '<span class="sort-icon verified">Verified</span>
                        </span>';
            $flagISO = $localIso != 'nl' ? $localIso : 'eu';
            $ret .= get_flags('', '', $flagISO, 25, array('style' => 'padding-right:5px;padding-bottom: 3px;')) . $atts['title'] . '</div>';
        }
        $ret .= '		<div class="table-responsive table_3 " >';
        $ret .= '		<table class="table d-flex flex-wrap d-md-table d-lg-table d-xl-table table-condensed mb-0 text-center medium align-middle p-5p" id="' . uniqid() . '">';
        if (empty($atts['tabs_id']) && $atts['aj'] === 0) {
            $ret .= '			<thead class="casinohead">';
            $ret .= '				<tr>';
            $ret .= '                    <th scope="col" class="inline-hor-logo widget2-heading align-middle p-2p numeric d-table-cell w-auto"></th>';
            $ret .= '					    <th scope="col" class="bonus-code widget2-heading align-middle numeric p-2p d-table-cell w-auto">Casino</th>';
            $ret .= '					<th scope="col"  class="bonus widget2-heading align-middle numeric p-2p d-table-cell w-auto" >' . $atts['2nd_col_title'] . '</th>';
            $ret .= '					<th scope="col"  class="info-tab widget2-heading align-middle numeric p-2p d-table-cell w-auto" >' . $atts['3rd_col_title'] . '</th>';
            $ret .= '				  <th scope="col"  class="rating widget2-heading align-middle numeric p-2p d-table-cell w-auto" >Rating</th>';
            $ret .= '					   <th scope="col"  class="inline-hor-cta widget2-heading align-middle p-2p d-table-cell numeric w-auto">' . $atts['cta_col_title'] . '</td>';
            $ret .= '				</tr>';
            $ret .= '			</thead>';
        }
        $ret .= '			<tbody>';
        $i = 0;
        if ($allCasinos):
            $jk = 0;
            foreach ($allCasinos as $casinoID) {
                    $isCasinoPremium = in_array($casinoID, $premiumCasinos);
                    $i = $isCasinoPremium ? '<span><img src="https://www.best50casino.com/wp-content/uploads/2018/05/favicon.png" loading="lazy" width="17" height="17" alt="premium" data-toggle="tooltip" title="Premium" ></span>' : '';
                    $resttricted = get_post_meta($casinoID, 'casino_custom_meta_rest_countries', true);
                if (is_array($resttricted) && in_array($countryISO, $resttricted)) {
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
                        $geoBonusArgs = is_country_enabled($casinoID, 'kss_casino');
                        $affiLink = $geoBonusArgs['aff_sc'];
                        $bonusCTA = $geoBonusArgs['bonusText']['cta-top'];
                        $bonusCTA2 = $geoBonusArgs['bonusText']['FlagText'];
                        $bonusCode = '';
                        if ($geoBonusArgs['bonusCode'] !== 'No Code Required') {
                            $bonusCode = '<br><small>Bonus Code: ' . $geoBonusArgs['bonusCode'] . '</small>';
                        }
                        $isBonusExclusive = $geoBonusArgs['isExclusive'] ? '<div class="exclusive-inline d-none d-xl-block d-lg-block"><i class="fa fa-star" aria-hidden="true"></i><span>Exclusive Bonus</span></div>' : '';
                        $isBonusExclusiveMobile = $geoBonusArgs['isExclusive'] ? $exclusiveMobileString : '';
                        $advancedTCs = $geoBonusArgs['bonusText']['terms'] ?: '';
                        $TCS = !get_post_meta($casinoID, $countryISO . 'casino_custom_meta_sp_terms_link', true) ? $advancedTCs : '<a href="' . get_post_meta($casinoID, $countryISO . 'casino_custom_meta_sp_terms_link', true) . '" target="_blank" rel="nofollow" class="text-9 text-grey text-italic text-center">' . $advancedTCs . '</a>';
                        $extraFilter = false;
                        $catfilter = false;
                        if ($atts['cat_in']) {
                            $extraFilter = true;
                            $bonustypes = $geoBonusArgs['bonusText']['left-billboard'];
                            if ($bonustypes) {
                                foreach ($bonustypes as $term) {
                                    if ($atts['cat_in'] === $term && current_user_can('administrator')) {
                                        $catfilter = true;
                                    }
                                }
                            }
                        }
                    }
                        if ($jk > 15) {
                        $trClass .= " hidden-row";
                        $trStyle = ' style="display:none;"';
                    }else{
                        $trClass .= "";
                        $trStyle = '';
                    }
                    if (($extraFilter && $catfilter) || (!$extraFilter && !$catfilter)) {
                        $ret .= '				<tr  class="parent-row text-sm-13 w-100 position-relative mb-lg-0 mb-xl-0 mb-5p ' . $trClass . '" ' . $trStyle . '>';
                        $ret .= '					<td class="inline-hor-logo w-sm-32 w-15 order-1 border-0 white-no-wrap align-self-center position-relative p-sm-5p pb-2p pl-10p pl-md-0  pr-0 pt-5p align-middle ' . $bonusISO . ' logo-tab"  data-title="Casino" >' . $isBonusExclusiveMobile . '<a href="' . get_permalink($casinoID) . '"><img src="' . get_the_post_thumbnail_url($casinoID, 'shortcode') . '" loading="lazy" class="attachment-shortcode size-shortcode wp-post-image">' . $i . '</a></td>';
                        if($atts['sort_by'] === 'rating'){
                            $ret .= '					<td class="rating position-relative white-no-wrap  pb-2p order-4 w-sm-30 border-0 align-self-center  pt-5p pl-md-0 pr-0 align-middle"  data-title="' . $atts['3rd_col_title'] . '">' . get_rating($casinoID, 'numbers') . '</td>';
                        }else{
                            $ret .= '			    <td class="bonus-code position-relative w-15 d-none d-md-table-cell pb-2p pt-0p pl-0 border-0 pr-5p align-middle"   style="vertical-align: middle;" data-title=""><span ><a class="text-decoration-none" style="display:block;" href="' . get_the_permalink($casinoID) . '">' . get_the_title($casinoID) . '</a></span>' . $bonusCode . '</td>';
                        }
                        $ret .= '<td class="bonus position-relative pb-2p white-no-wrap d-flex flex-column flex-xl-wrap flex-lg-wrap align-self-center justify-content-center border-0 pl-sm-5 order-2 d-md-table-cell w-sm-65 pt-5p pl-10p pl-md-0 pr-0  align-middle"  style="vertical-align: middle;"  data-title="' . $atts['2nd_col_title'] . '">';
                    if ($atts['3rd_column'] === 'fast_payout'){
                        $ret .= '<a class=" text-dark font-weight-bold d-block d-xl-none d-lg-none text-decoration-none" style="font-size:15px;"  href="'.get_the_permalink($casinoID).'">'.get_the_title($casinoID).'</a>';
                    }
                   if ($atts['3rd_column'] === 'year'){
                            $ret .=  '<span class="d-block d-md-none w-100 d-lg-none d-xl-none">Founded: ' . get_post_meta($casinoID, 'casino_custom_meta_com_estab', true) . '</span>';
                   }
                   if ($atts['3rd_column'] === 'launched'){
                            $ret .='<span class="d-block d-md-none w-100 d-lg-none d-xl-none">Launched: ' . get_the_date('m/Y',$casinoID).'</span>';
                   }
                   if($atts['3rd_column'] === 'rtp') {
                            $ret .= '<span class="d-block d-md-none w-100 d-lg-none d-xl-none">Games Payout: ' . get_post_meta($casinoID, 'casino_custom_meta_payout', true) . '</span>';
                   }
                    $ret .= '<span class=" text-primary text-17 font-weight-bold  d-block">
					<a ' . $btnDisable . ' href="' . $affiLink . '" target="_blank" rel="nofollow" class="text-decoration-none">' . $bonusCTA . '</a>
					</span><span class="text-12">' . $bonusCTA2 . '</span>' . $isBonusExclusive . '    
					</td>';
                        $ret .= '					<td  style="vertical-align: middle" class="info-tab border-0 order-3 w-sm-100 pt-3p pl-10p pr-0 pb-3p" data-title=""><span class="text-medium align-items-lg-start align-items-md-start align-items-xl-start align-items-center text-12 justify-content-between p-3p text-left w-sm-100 d-flex flex-row flex-md-column flex-lg-column flex-xl-column">' . create_column($casinoID, $atts['3rd_column'], $atts['3rd_column_icons'], $countryISO, $priorityFilter) . '</span></td>';

                        //$ret .= '					<td class="pros"  data-title=""><span class="text-medium">'.get_the_title($casinos).'</span>'.$bonusCode.'</td>';
                        if($atts['sort_by'] === 'rating'){
                            $ret .= '			    <td class="bonus-code position-relative w-15 d-none d-md-table-cell pb-2p pt-0p pl-0 border-0 pr-5p align-middle"   style="vertical-align: middle;" data-title=""><span ><a class="text-decoration-none" style="display:block;" href="' . get_the_permalink($casinoID) . '">' . get_the_title($casinoID) . '</a></span>' . $bonusCode . '</td>';
                        }else{
                            $ret .= '					<td class="rating position-relative white-no-wrap  pb-2p order-4 w-sm-30 border-0 align-self-center  pt-5p pl-md-0 pr-0 align-middle"  data-title="' . $atts['3rd_col_title'] . '">' . get_rating($casinoID, 'numbers') . '</td>';
                        }
                        $ret .= '					<td class="inline-hor-cta position-relative  pb-2p w-sm-70 border-0 align-self-center order-5 pl-10p pl-md-0 pr-0 pt-5p align-middle"  data-title="' . $atts['cta_col_title'] . '">' . create_cta_button($casinoID, $atts['cta'], $btnDisable, $countryISO,$atts['cat_in']) . '</td>';
                        $ret .= '				</tr>';
                        if ($TCS) $ret .= '<tr id="child-row-' . $jk . '" class="pt-0 child-row ' . $trClass . '" ' . $trStyle . '><td colspan="6" class="d-flex d-xl-table-cell d-lg-table-cell align-items-center p-2p bg-yellowish  w-100 "><p class="w-sm-95 position-relative white-space-initial text-10 text-grey text-italic text-center mb-0 ">' . $TCS . '</p><i class="pl-1 d-block d-xl-none d-lg-none fa fa-close close-x visible-xs text-secondary" data-id="child-row-' . $jk . '"></i></td></tr>';
                        $jk = $jk + 1;
                    }
            }
        endif;
        wp_reset_postdata();
        $ret .= '';
        $ret .= '';
        $ret .= '';
        $ret .= '			</tbody>';
        $ret .= '		</table>';
        if ($jk > 15) {
            $ret .= '<div id="alal" class="btn btn-border border-primary show-more-rows mb-20 text-center w-100 noshadow" data-showr="off">Show More Casinos</div>';
        }
        $ret .= '		</div>';
        $ret .= '</div>';
        $ret .= '</div>';
    }elseif ('default_4' == $atts['layout']) { //////////////////////////////////////////////////////////////// DEFAULT 2 ////////////////////////////////////////////////////////
        $ret = '<div class="inner_row more_games '.$unique.' mb-15p ' . $atts['layout'] . '">';
        $ret .= '	<div class="">';
        if ($atts['title'] && empty($atts['tabs_id']) && $atts['aj']==0) {
            $ret .= '		<div class="star shortcode-star d-block  border-0 mb-0 pt-5p h-auto position-relative text-center">';
            $ret .= '<span class="hidden-md hidden-xs d-none d-md-inline-block d-lg-inline-block d-xl-inline-block" style="position: absolute;left: 5px;top: 4px;">
                         <span class="sort-icon secure">Secure</span>';
            $ret .= '<span class="sort-icon trusted">Trusted</span>';
            $ret .= '<span class="sort-icon verified">Verified</span>
                        </span>';
            $flagISO = $localIso != 'nl' ? $localIso : 'eu';
            $ret .= get_flags('', '', $flagISO, 25, array('style' => 'padding-right:5px;padding-bottom: 3px;')) . $atts['title'] . '</div>';
        }
        $ret .= '		<div class="table-responsive">';
        $ret .= '		<table class="table table-condensed mb-0 medium"  id="' . uniqid() . '">';
        if (empty($atts['tabs_id']) && $atts['aj']==0) {
            $ret .= '			<thead class="casinohead">';
            $ret .= '				<tr>';
            $ret .= '				 <th scope="col" class="inline-hor-logo widget2-heading align-middle p-2p numeric d-table-cell w-auto">Casino</th>';
            $ret .= '				 <th scope="col"  class="bonus widget2-heading align-middle numeric p-2p d-table-cell w-auto" >' . $atts['2nd_col_title'] . '</td>';
            $ret .= '					<th scope="col" class="wag  widget2-heading align-middle numeric p-2p d-table-cell w-autoc">Wagering</th>';
            $ret .= '				  <th scope="col"  class="rating widget2-heading align-middle numeric p-2p d-table-cell w-auto" >' . $atts['3rd_col_title'] . '</td>';
            $ret .= '					  <th scope="col"  class="inline-hor-cta widget2-heading align-middle p-2p d-table-cell numeric w-auto">' . $atts['cta_col_title'] . '</td>';
            $ret .= '				</tr>';
            $ret .= '			</thead>';
        }
        $ret .= '			<tbody>';
        $i = 0;
        if ($allCasinos):
            $jk = 0;
            foreach ($allCasinos as $casinoID) {
                $isCasinoPremium = in_array($casinoID, $premiumCasinos);
                $i = $isCasinoPremium ? '<span><img src="https://www.best50casino.com/wp-content/uploads/2018/05/favicon.png" loading="lazy" width="17" height="17" alt="premium" data-toggle="tooltip" title="Premium" ></span>' : '';
                    if (in_array($countryISO, get_post_meta($casinoID, 'casino_custom_meta_rest_countries', true))) {
                        $trClass = 'disabledRow';
                        $btnDisable = 'disabled';
                        $affiLink = 'javascript:void(0)';
                        $li1 = 'No ' . get_flags('', '', $GLOBALS['countryISO']) . ' Players Accepted';
                        $li2 = '';
                        $li3 = '';
                        $bonusCTA2 = '';
                        $TCS = '';
                        $isBonusExclusive = '';
                        $wagering = '-';
                    } else {
                        $trClass = 'enableRow';
                        $btnDisable = '';
                        $geoBonusArgs = is_country_enabled($casinoID, 'kss_casino');
                        $affiLink = $geoBonusArgs['aff_sc'];
                        $bonusCTA = $geoBonusArgs['bonusText']['cta-top'];
                        $bonusCTA2 = $geoBonusArgs['bonusText']['FlagText'];
                        $bonusCode ='';
                        if ( $geoBonusArgs['bonusCode'] !== 'No Code Required'){
                            $bonusCode =  '<br><small>Bonus Code: ' . $geoBonusArgs['bonusCode'] . '</small>';
                        }
                        $isBonusExclusive = $geoBonusArgs['isExclusive'] ? '<div class="exclusive-inline d-none d-xl-block d-lg-block"><i class="fa fa-star" aria-hidden="true"></i><span>Exclusive Bonus</span></div>' : '';
                        $advancedTCs = $geoBonusArgs['bonusText']['terms'] ?: '';
                        $TCS = !get_post_meta($casinoID, $countryISO . 'casino_custom_meta_sp_terms_link', true) ? $advancedTCs : '<a href="' . get_post_meta($casinoID, $countryISO . 'casino_custom_meta_sp_terms_link', true) . '" target="_blank" rel="nofollow" class="text-9 text-grey text-italic text-center">' . $advancedTCs . '</a>';
                        $extraFilter = false;
                        $catfilter = false;
                        if ($atts['cat_in']) {
                            $extraFilter = true;
                            $bonustypes = $geoBonusArgs['bonusText']['left-billboard'];
                            foreach ($bonustypes as $term) {
                                if ($atts['cat_in'] === $term && current_user_can('administrator')) {
                                    $catfilter = true;
                                }
                            }
                        }

                        $wagering = '';
                        $turnoverD = $geoBonusArgs['bonusText']['right-turnover-d'];
                        $turnoverB = $geoBonusArgs['bonusText']['right-turnover-b'];
                        $turnoverS = $geoBonusArgs['bonusText']['right-turnover-s'];


                        if ($turnoverD == $turnoverB && $turnoverD) {
                            $wagering = '<div style="width:100%;"><i class="fa fa-credit-card" aria-hidden="true" data-toggle="tooltip" title="Deposit" style="color:#29bf29;padding-right:1px;"></i> + <i class="fa fa-gift" aria-hidden="true" data-toggle="tooltip" title="Bonus" style="color:#2da9f6;padding-left:3px;padding-right:1px;font-size: 1.3em;"></i> x' . $turnoverD . '</div>';
                            $wagering .= $turnoverS ? '<div style="width:100%;"><i class="fa fa-refresh" aria-hidden="true" data-toggle="tooltip" title="Spins" style="color:orange;padding-left:3px;padding-right:1px;"></i> x' . $turnoverS . '</div>' : '';
                        } else {
                            $zipiti = $turnoverD && $turnoverB ? '2' : '1';
                            $widthszip = 100 / $zipiti;
                            $wagering .= $turnoverD ? '<div style="width:' . $widthszip . '%;"><i class="fa fa-credit-card" aria-hidden="true" data-toggle="tooltip" title="Deposit" style="color:#29bf29;padding-right:1px;"></i> x' . $turnoverD . '</div>' : '';
                            $wagering .= $turnoverB ? '<div style="width:' . $widthszip . '%;"><i class="fa fa-gift" aria-hidden="true" data-toggle="tooltip" title="Bonus" style="color:#2da9f6;padding-left:3px;padding-right:1px;font-size: 1.3em;"></i> x' . $turnoverB . '</div>' : '';
                            $wagering .= $turnoverS ? '<div style="width:100%;"><i class="fa fa-refresh" aria-hidden="true" data-toggle="tooltip" title="Spins" style="color:orange;padding-left:3px;padding-right:1px;"></i> x' . $turnoverS . '</div>' : '';
                        }
                        if (!$wagering) {
                            $wagering = '-';
                        }

                        $extraListItem1 = explode(",", get_post_meta($casinoID, 'casino_custom_meta_why_play', true));

                        if ($atts['2nd_column_list'] === "bonus") {
                            $li1 = $bonusCTA ?: $extraListItem1[2];
                            $li2 = $bonusCTA2 ?: $extraListItem1[0];
                            if ($geoBonusArgs['isExclusive']) {
                                $li3 = '<span>Exclusive Bonus</span>';
                                $exc = " exc";
                            } else {
                                $li3 = $bonusCode ?: $extraListItem1[1];
                                $exc = "";
                            }

                        } elseif ($atts['2nd_column_list'] === "why") {
                            $li1 = $extraListItem1[0];
                            $li2 = $extraListItem1[1];
                            $li3 = $extraListItem1[2];
                        }
                    }

                    if ($jk > 15) {
                        $trClass .= " hidden-row";
                        $trStyle = ' style="display:none;"';
                    }else{
                        $trClass .= "";
                        $trStyle = '';
                    }

                    if (($extraFilter && $catfilter) || (!$extraFilter && !$catfilter)) {
                        $ret .= '				<tr class="parent-row text-sm-13 w-100 position-relative mb-lg-0 mb-xl-0 mb-5p ' . $trClass . '"' . $trStyle . '">';
                        //$ret .= '					<td class="nmbt">'.$ribbon.''.$i.'</td>';
                        $ret .= '					<td class="inline-hor-logo w-sm-32 order-1 border-0 white-no-wrap align-self-center position-relative p-sm-5p pb-2p pl-10p pl-md-0  pr-0 pt-5p align-middle ' . $bonusISO . ' logo-tab"  data-title="Casino" ><a href="' . get_permalink($casinoID) . '"><img src="' . get_the_post_thumbnail_url($casinoID, 'shortcode') . '" loading="lazy" class="attachment-shortcode text-decoration-none size-shortcode wp-post-image">' . $i . '</a></td>';
                        $ret .= '					<td class="bonus position-relative pb-2p white-no-wrap d-flex flex-wrap align-self-center justify-content-center  text-center border-0 pl-sm-5 order-2 d-md-table-cell w-sm-65 pt-5p pl-10p pl-md-0 pr-0  align-middle" data-title="' . $atts['2nd_col_title'] . '">
					
					<ul class="billboard-list mt-0 mb-0 pl-0 bonus-table-list" style="white-space: nowrap;">
					<li class="font-weight-bold text-primary text-17 list-typenone">
					<a ' . $btnDisable . ' href="' . $affiLink . '" target="_blank" class="text-decoration-none" rel="nofollow">' . $li1 . '</a>
					</li>
					<li>' . $li2 . '</li
					<li class="' . $exc . '">' . $li3 . '</li>
					</ul>
					</td>';
                        $ret .= '					<td class="wag border-0 order-3 pt-sm-0 pb-sm-0 w-100 white-no-wrap text-center" style="vertical-align: middle;"  data-title="Bonus" >' . $wagering . '</td>';
                        $ret .= '					<td class="rating position-relative white-no-wrap border-0 text-center  pb-2p order-4 w-sm-30 border-0 align-self-center  pt-5p pl-10p pl-md-0 pr-0 align-middle" data-title="' . $atts['3rd_col_title'] . '">' . get_rating($casinoID, 'numbers') . '<a class="text-decoration-none" class="" href="' . get_the_permalink($casinoID) . '">Info</a></td>';
                        $ret .= '					<td class="inline-hor-cta position-relative pb-2p w-sm-70 border-0 align-self-center order-5 pl-10p pl-md-0 pr-0 pt-5p align-middle"  data-title="' . $atts['cta_col_title'] . '">' . create_cta_button($casinoID, $atts['cta'], $btnDisable, $countryISO,$atts['cat_in']) . '</td>';
                        $ret .= '				</tr>';
                        if ($TCS){
                        $ret .= '<tr id="child-row-' . $jk . '" class="pt-0 child-row ' . $trClass . '" ' . $trStyle . '><td colspan="5" class="d-flex bg-yellowish align-items-center d-xl-table-cell d-lg-table-cell p-2p w-100 f-xs-center"><p class="w-sm-95 position-relative white-space-initial text-10 text-grey text-italic text-center mb-0 ">' . $TCS . '</p><i class="pl-1 d-xl-none d-lg-none d-block fa fa-close close-x visible-xs text-secondary" data-id="child-row-' . $jk . '"></i></td></tr>';
                        }
                        $jk = $jk + 1;
                    }
                }
        endif;
        wp_reset_postdata();
        $ret .= '';
        $ret .= '';
        $ret .= '';

        $ret .= '			</tbody>';
        $ret .= '		</table>';
        if ($jk > 15) {
            $ret .= '<div id="alal" class="btn btn-border border-primary show-more-rows mb-20 text-center w-100 noshadow" data-showr="off">Show More Casinos</div>';
        }
        $ret .= '		</div>';
        $ret .= '</div>';
        $ret .= '</div>';
    }

    elseif ('line' === $atts['layout']) {
        if ($allCasinos):
            $jk = 0;
            foreach ($allCasinos as $casinoID) {
                if ($jk <= $atts['limit'] && !in_array($countryISO, get_post_meta($casinoID, 'casino_custom_meta_rest_countries', true))) {

                    $casino_score = get_post_meta($casinoID, 'casino_custom_meta_sum_rating', true) * 10;
                    $casino_cons = explode(',', get_post_meta($casinoID, 'casino_custom_meta_why_play', true));
                    $ret .= '<div class="row more_games d-flex flex-wrap text-center ml-0 mr-0 mt-0 mt-sm-5p mb-5p  p-0 text-20 align-items-center game-cta short-game" style="background: #f0f0f0;">';
                    $ret .= '<div class="col-lg-2 pl-0 pr-0 col-md-2 col-sm-4 col-6 casino  pl-sm-15 pr-sm-15">';
                    $ret .= '   <a class="" href="' . get_the_permalink($casinoID) . '"><img class="img-fluid rounded-5 m-2p" loading="lazy" src="' . get_the_post_thumbnail_url($casinoID) . '" alt="' . get_the_title($casinoID) . '" ></a>';
                    $ret .= '</div>';
                    $ret .= '<div class="col-lg-8 col-md-10 col-sm-8 col-9 pros-list d-none d-xl-block d-lg-block">';
                    $ret .= '   <span class="text-17 font-weight-bold" style="color: #03898E;">Why you should choose ' . str_replace(" Casino", "", get_the_title($casinoID)) . ' Casino:</span>';
                    $ret .= '   <ul class="check-list  mb-10p mt-0 text-left list-typenone text-14 pl-10p">';
                    foreach ($casino_cons as $pros) {
                        $ret .= '            <li class="w-50 text-left pl-20p position-relative list-typenone float-left">' . $pros . '</li>';
                    }
                    $ret .= '   </ul>';
                    $ret .= '</div>';
                    $ret .= '<div class="col-lg-2 col-md-12 col-sm-12 col-6 pl-0 pr-0 casino">';
                    $ret .= '    <div class="d-block d-lg-none d-xl-none font-weight-bold" style="font-size:16px;">' . get_the_title($casinoID) . '</div>';
                    $ret .= '   <div class="ratings mb-2p visible-xs d-xl-none d-lg-none d-block"><div class="star-rating"><span class="position-absolute h-100 overflow-hidden m-0" style="top:0; left:0;width: ' . $casino_score . 'px;"></span></div></div>';
                    $ret .= '    <a data-casinoid="' . $casinoID . '" data-country="' . $localIso . '" href="' . get_post_meta($casinoID, 'casino_custom_meta_affiliate_link', true) . '" rel="nofollow" class="btn btn_tiny btn_yellow cta play_button bumper text-decoration-none d-block font-weight-bold">VISIT</a>';
                    $ret .= '</div>';
                    $ret .= '</div>';
                    $jk = $jk + 1;
                }
            }
        endif;
        wp_reset_postdata();
    }
    elseif ('horizontal' === $atts['layout']) { //////////////////////////////////////////////////////////////// WITH TEXT ////////////////////////////////////////////////////////
        if ($allCasinos):
            $marginBottom = (count($allCasinos)>= 5) ? 'style="margin-bottom:10px;"' : '';
            $centeredClass = (count($allCasinos) >= 2) ? '' : 'j-center';
            $colClass = get_post_meta(get_the_ID(), 'posts_no_sidebar', true) ? '3' : '4';
            if ($atts['title']) {
                $flagISO = $localIso != 'nl' ? $localIso : 'eu';
                $ret .= '	<span class="star shortcode-star-2 font-weight-bold text-17">' . get_flags('', '', $flagISO, 25, array('style' => 'padding-right:5px;padding-bottom: 3px;')) . $atts['title'] . '</span>';
            }
            $ret .= '<div class="row inner-row horizontal-inline d-flex flex-wrap mb-10p premium-casinos ' . $centeredClass . '">';

            $jk = 0;
            foreach ($allCasinos as $casinoID) {
                $resttricted =  get_post_meta($casinoID, 'casino_custom_meta_rest_countries', true);
                if ($jk < $atts['limit'] && !in_array($countryISO,$resttricted)) {
                    $casinoName = get_the_title($casinoID);
                    if (is_array($resttricted) && in_array($countryISO,$resttricted)) {
                        $trClass = 'disabledRow';
                        $btnDisable = 'disabled';
                        $affiLink = 'javascript:void(0)';
                        $bonusTop = 'No ' . get_flags('', '', $GLOBALS['countryISO']) . ' Players Accepted';
                        $TCs = null;
                        $bonus2 = null;
                        $bonusCategoryName = null;
                    } else {
                        $trClass = 'enableRow';
                        $btnDisable = '';
                        $geoBonusArgs = is_country_enabled($casinoID, 'kss_casino');
                        $affiLink = $geoBonusArgs['aff_sc'];
                        $bonusCTA = $geoBonusArgs['bonusText']['cta-top'];
                        $bonusCTA2 = $geoBonusArgs['bonusText']['FlagText'];
                        $bonusCode = '';
                        if ($geoBonusArgs['bonusCode'] !== 'No Code Required') {
                            $bonusCode = '<br><small>Bonus Code: ' . $geoBonusArgs['bonusCode'] . '</small>';
                        }
                        $isBonusExclusive = $geoBonusArgs['isExclusive'] ? '<div class="exclusive-inline d-none d-xl-block d-lg-block"><i class="fa fa-star" aria-hidden="true"></i><span>Exclusive Bonus</span></div>' : '';
                        $isBonusExclusiveMobile = $geoBonusArgs['isExclusive'] ? $exclusiveMobileString : '';
                        $advancedTCs = $geoBonusArgs['bonusText']['terms'] ?: '';
                        $TCS = !get_post_meta($casinoID, $countryISO . 'casino_custom_meta_sp_terms_link', true) ? $advancedTCs : '<a href="' . get_post_meta($casinoID, $countryISO . 'casino_custom_meta_sp_terms_link', true) . '" target="_blank" rel="nofollow" class="text-9 text-grey text-italic text-center">' . $advancedTCs . '</a>';

                        $bonustypes = $geoBonusArgs['bonusText']['left-billboard'];

                    }


                    $ret .= '	<div class="col-lg-' . $colClass . ' col-md-' . $colClass . ' premium-item col-sm-' . $colClass . ' col-xs-12 casino ' . $trClass . '" ' . $marginBottom . '>';
                     $withExc = $geoBonusArgs['isExclusive'] ? ' withExc' : '' ;
                    $ret .= '		<div class="wraping d-flex flex-wrap  d-xl-block d-lg-block  text-center' . $withExc . '" >';
                    //$ret  .= '			<a href="'.get_the_permalink($casinos).'" <i class="fa fa-info" aria-hidden="true" title="" style="z-index:9;font-size: 14px;color: #fff;border: 2px solid;padding: 2px 6px;position: absolute;border-radius: 50%;right: 6px;top: 6px;"></i></a>';
                    $LogoUrl = get_the_post_thumbnail_url($casinoID);
                    $ret .= '			<a class="casino-logos w-sm-40 order-1" href="' . get_the_permalink($casinoID) . '">
                    <figure class="m-0">
                    <img style="width: 100% !important;" src="'.$LogoUrl.'" loading="lazy">';
                    if ($geoBonusArgs['isExclusive']) {
                        $ret .= '<div class="ribbon hot"><span>Exclusive</span></div>';
                    }
                    $ret .= '</figure></a>';
                    $ret .= '				<div class="company-rating backed order-3 order-md-2 w-sm-40 mb-0 mb-sm-0 p-5p">';
                    $ret .= get_rating($casinoID, "own");
                    $ret .= '				</div>';
                    $ret .= '				<div class="promo-details-wrap w-sm-60 order-2 order-md-3">';
                    if (in_array($countryISO, get_post_meta($casinoID, 'casino_custom_meta_rest_countries', true))) {
                        $ret .= '				<div class="promo-details-amount mt-2p mb-5p text-17" style="color: #03898f;">';
                        $ret .= $bonusCTA;
                        $ret .= '              </div>';
                    } else {
                        $ret .= '				<div class="promo-details-amount mt-5p mb-5p text-17 " style="color: #03898f;">';
//                        get_flags('', '', $localIso, 25, array('class' => 'd-none d-lg-block d-xl-block')) . '  ' .
                        $ret .=  $bonusCTA;
                        $ret .= '              </div>';
                    }

                    if ($bonusCTA2) {
                        $ret .= '				<div class="promo-details-amount-sub"><i>';
                        $ret .= $bonusCTA2;
                        $ret .= '				</i></div>';
                    }
                    $ret .= '				<div class="promo-details-type mt-5p mb-10p">';
                    $ret .= $bonustypes[0];
                    $ret .= '                  </div>';
//                    if ($TCS) {
//                        $ret .= '<span class="tcs-2 visible-xs">' . $TCS . '</span>';
//                    }

                    $ret .= '			    </div>';

                    if ($GLOBALS['countryISO'] === 'gb') {
                        $cta = 'PLAY';
                    } else {
                        $cta = 'PLAY NOW';
                    }
                    $ret .= '			<a class="' . $btnDisable . ' btn order-5 w-sm-50 w-md-100 cta-table btn_yellow cta font-weight-bold text-decoration-none catholic-cta bumper" data-casinoid="' . $casinoID . '" data-country="' . $localIso . '"  href="' . $affiLink . '" target="_blank" rel="nofollow">' . $cta . '</a>';
                    if ($TCS) {
                        $ret .= '<span class="tcs-2 w-100 d-block text-center mt-10p" style="order: 6;">' . $TCS . '</span>';
                    }
                    $ret .= '	    </div>';
                    $ret .= '	</div>';
                    $jk = $jk + 1;
                }
            }
            $ret .= '</div>';
        endif;

    }
    elseif ('sidebar_3' === $atts['layout']) { //////////////////////////////////////////////////////////////// Sidebar Hover (3) ////////////////////////////////////////////////////////
        if ($allCasinos):
            $j = 0;
            $ret = '<div class="this hidden-xs d-none d-xl-block d-lg-block widget mb-10p">';
            $ret .= '	<span class="star">' . $atts['title'];
            $flagISO = $localIso !== 'nl' ? $localIso : 'eu';
            $ret .= get_flags('', '', $flagISO, 25, array('style' => 'padding-left:5px;padding-bottom: 3px;'));
            $ret .= '</span>';
            $ret .= '		<div class="top10 top10--hp">';
            $ret .= '			<ul>';

            foreach ($allCasinos as $casinoID) {
                if ($j <= 7 && !in_array($countryISO, get_post_meta($casinoID, 'casino_custom_meta_rest_countries', true))) {
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
                        $geoBonusArgs = is_country_enabled($casinoID, 'kss_casino');
                        $affiLink = $geoBonusArgs['aff_sc'];
                        $bonusCTA = $geoBonusArgs['bonusText']['cta-top'];
                        $bonusCTA2 = $geoBonusArgs['bonusText']['FlagText'];
                        $bonusCode = '';
                        if ($geoBonusArgs['bonusCode'] !== 'No Code Required') {
                            $bonusCode = '<br><small>Bonus Code: ' . $geoBonusArgs['bonusCode'] . '</small>';
                        }
                        $isBonusExclusive = $geoBonusArgs['isExclusive'] ? '<div class="exclusive-inline d-none d-xl-block d-lg-block"><i class="fa fa-star" aria-hidden="true"></i><span>Exclusive Bonus</span></div>' : '';
                        $isBonusExclusiveMobile = $geoBonusArgs['isExclusive'] ? $exclusiveMobileString : '';
                        $advancedTCs = $geoBonusArgs['bonusText']['terms'] ?: '';
                        $TCS = !get_post_meta($casinoID, $countryISO . 'casino_custom_meta_sp_terms_link', true) ? $advancedTCs : '<a href="' . get_post_meta($casinoID, $countryISO . 'casino_custom_meta_sp_terms_link', true) . '" target="_blank" rel="nofollow" class="text-9 text-grey text-italic text-center">' . $advancedTCs . '</a>';
                    }

                    $ret .= '				<li class="top10__item position-relative">';

                    $ret .= '					<span class="top10__link">';
                    $ret .= '						<a class="top10_link_a" href="' . get_the_permalink($casinoID) . '">';
                    $ret .= '<img src="' . get_the_post_thumbnail_url($casinoID, 'sidebar-lg') . '" class="img-responsive top10__img" loading="lazy" alt="' . get_the_title($casinos) . '">';
                    $ret .= '							<div class="top10__name"><span class="text-primary text-bold">' . $bonusCTA . '</span>';
                    $ret .= '							<span class="text-13">' . $bonusCTA2 . '</span></div>';
//
                    $ret .= '						</a>';
                    $ret .= $isBonusExclusiveMobile;
                    $ret .= '						<a class="top10__visit bumper" data-casinoid="' . $casinoID . '" data-country="' . $localIso . '"  href="' . get_post_meta($casinos, "casino_custom_meta_affiliate_link", true) . '"  rel="nofollow" target="_blank">Visit</a>';
                    $ret .= '					</span>';


                    if ($TCS) $ret .= '<div class="text-10 text-grey text-italic text-center bg-faded child-row-side pt-5 pb-5">' . $TCS . '</div>';
                    $ret .= '				</li>';
                    $j = $j + 1;
                }
            }
        endif;
        $ret .= '			</ul>';

        $ret .= '		</div>';
        $ret .= '</div>';
    }elseif ('payments' === $atts['layout']) { //////////

        $ret .= '<div class="inner_row more_games mb-15p ' . $atts['layout'] . '">';
        $ret .= '	<div class="">';
        if ($atts['title']) {
            if ($atts['exc_filter'] == "true") {
                $ret .= '		<div class="star shortcode-star ext-filter flex-column flex-md-row flex-lg-row flex-xl-row" style="display:flex;justify-content: space-between; align-items: center">';
                $ret .= '<span class="hidden-md hidden-xs d-none d-lg-block  d-xl-block pl-5p" style="">
                         <span class="sort-icon secure">Secure</span>';
                $ret .= '<span class="sort-icon trusted">Trusted</span>';
                $ret .= '<span class="sort-icon verified">Verified</span>
                        </span>';
                $flagISO = $localIso != 'nl' ? $localIso : 'eu';
                $ret .= '<span>' . get_flags('', '', $flagISO, 25, array('style' => 'padding-left:5px;padding-bottom: 3px;')) . $atts['title'] . '</span>';
                $ret .= '<div class="pull-right mb-0 mr-5">
                            <p class="mb-0 text-13"><label class="m-0" id="label-exclusive" style="font-weight:normal;"><span>Show only Exclusive Bonuses</span>
                                    <input style="vertical-align: middle;margin:0px !important;" data-shownex="off" type="checkbox" name="exclusive-bonus" id="exclusive-bonus"></label></p>

                        </div>';
                $ret .= '</div>';
            } else {
                $ret .= '		<div class="star shortcode-star">';
                $ret .= '<span class="hidden-xs d-none d-lg-block  d-xl-block " style="position: absolute;left: 5px;top: -2px;">
                         <span class="sort-icon secure">Secure</span>';
                $ret .= '<span class="sort-icon trusted">Trusted</span>';
                $ret .= '<span class="sort-icon verified">Verified</span>
                        </span>';
                $flagISO = $localIso !== 'nl' ? $localIso : 'eu';
                $ret .= '<span>' . get_flags('', '', $flagISO, 25, array('style' => 'padding-right:5px;padding-bottom: 3px;')) . $atts['title'] . '</span>';
                $ret .= '</div>';
            }

            $ret .= '<div class="d-flex flex-wrap w-100 mt-5p">';
            $payments = WordPressSettings::getPremiumPayments($GLOBALS['countryISO']);
            $pieces = explode(",", $payments);
            $sliced_array = array_slice($pieces, 0, 6);
            $i = 0;
            $len = count($sliced_array);
            foreach ($sliced_array as $paymentid){
                $image_id = get_post_meta($paymentid, 'casino_custom_meta_sidebar_icon', true);
                $title = get_the_title($paymentid);

                if ($atts['deposit'] == $paymentid){
                    $activeclass ='activefilter' ;
                }else{
                    $activeclass= '';
                }
                $count = strlen($title);
                if($count > 9){
                    $titleShort = substr($title, 0, 8);
                }else{
                    $titleShort= null;
                }

                ob_start();?>
                <a class="p-10p border-trans text-decoration-none filtersheadings <?php echo $activeclass;?>"  data-title="<?php echo get_the_title($paymentid);?>"   data-id="<?=$paymentid?>" onclick="filter_payments(event,this)">
                    <div class="d-flex flex-wrap">
                        <div class="w-100 w-sm-100 d-flex flex-wrap align-self-center ">
                            <img class="w-20 img-fluid float-right" style="width: 44px"  loading="lazy" src="<?php echo $image_id;?>">
                              <?php
                              if ($titleShort){
                                 echo '<span data-toggle="tooltip" title="'.$title.'" class="w-80 text-14 text-sm-13 titlefilter align-self-center pl-5p"> '.$titleShort.'</span>';
                              }else{
                                  echo '<span class="w-80 align-self-center text-14 text-sm-13 pl-5p titlefilter"> '.$title.'</span>';
                              }
                              ?>
                        </div>
                    </div>
                </a>
                <?php
                $output = ob_get_contents();
                ob_end_clean();
                $ret .= $output;
            }

            $ret .= '</div>';
        }
        $ret .= '		<div class="table-responsive mt-5p">';
        $ret .= '		<table class="table table-condensed mb-0 medium table_3"  id="' . uniqid() . '">';
        $ret .= '			<thead class="casinohead">';
        $ret .= '				<tr>';
        $ret .= '						<th scope="col" class="inline-hor-logo widget2-heading align-middle p-2p numeric d-table-cell w-auto"></th>';
        $ret .= '					<th scope="col" class="inline-hor-logo widget2-heading align-middle p-2p numeric d-table-cell w-auto">Casino</th>';
        $ret .= '					 <th scope="col"  class="bonus widget2-heading align-middle numeric p-2p d-table-cell w-auto" >' . $atts['2nd_col_title'] . '</th>';
        $wageringTitle = $atts['cat_in'] == '48' ? 'FDB Wagering' : 'Wagering';
        $ret .= '					<th class="wag widget2-heading align-middle p-2p numeric d-table-cell w-auto"> Min Dep - Max With </th>';
        $ret .= '					<th class="rating widget2-heading align-middle numeric p-2p d-table-cell w-auto">' . $atts['3rd_col_title'] . '</th>';
        $ret .= '					<th class="inline-hor-cta widget2-heading align-middle numeric p-2p d-table-cell w-auto">' . $atts['cta_col_title'] . '</th>';
        $ret .= '				</tr>';
        $ret .= '			</thead>';
        $ret .= '			<tbody>';
        $i = 0;
        if ($allCasinos):
            $jk = 0;

            foreach ($allCasinos as $casinoID) {
                if ($jk <= $atts['limit'] && !in_array($countryISO, get_post_meta($casinoID, 'casino_custom_meta_rest_countries', true))) {
//                    if(current_user_can('administrator')){
//                        print_r($casinoID.'<br>');
//                    }
                    $isCasinoPremium = in_array($casinoID, $premiumCasinos);
                    $i = $isCasinoPremium ? '<span><img src="https://www.best50casino.com/wp-content/uploads/2018/05/favicon.png" loading="lazy" width="17" height="17" alt="premium" data-toggle="tooltip" title="Premium" ></span>' : '';

                    if (in_array($countryISO, get_post_meta($casinoID, 'casino_custom_meta_rest_countries', true))) {
                        $trClass = 'disabledRow';
                        $btnDisable = 'disabled';
                        $affiLink = 'javascript:void(0)';
                        $li1 = 'No ' . get_flags('', '', $GLOBALS['countryISO']) . ' Players Accepted';
                        $li2 = '';
                        $li3 = '';
                        $bonusCTA2 = '';
                        $TCS = '';
                        $isBonusExclusive = '';
                        $wagering = '-';
                    } else {
                        $trClass = 'enableRow';
                        $btnDisable = '';

                        $geoBonusArgs = is_country_enabled($casinoID, 'kss_casino');
                        $affiLink = $geoBonusArgs['aff_sc'];
                        $bonusCTA = $geoBonusArgs['bonusText']['cta-top'];
                        $bonusCTA2 = $geoBonusArgs['bonusText']['FlagText'];
                        $bonusCode ='';
                        if ( $geoBonusArgs['bonusCode'] !== 'No Code Required'){
                            $bonusCode = $geoBonusArgs['bonusCode'];
                        }
                        $isBonusExclusive = $geoBonusArgs['isExclusive'] ? '<div class="exclusive-inline d-none d-xl-block d-lg-block"><i class="fa fa-star" aria-hidden="true"></i><span>Exclusive Bonus</span></div>' : '';
                        $advancedTCs = $geoBonusArgs['bonusText']['terms'] ?: '';
                        $TCS = !get_post_meta($casinoID, $countryISO . 'casino_custom_meta_sp_terms_link', true) ? $advancedTCs : '<a href="' . get_post_meta($casinoID, $countryISO . 'casino_custom_meta_sp_terms_link', true) . '" target="_blank" rel="nofollow" class="text-9 text-grey text-italic text-center">' . $advancedTCs . '</a>';
                        $extraFilter = false;
                        $catfilter = false;
                        if ($atts['cat_in']) {
                            $extraFilter = true;
                            $bonustypes = $geoBonusArgs['bonusText']['left-billboard'];
                            foreach ($bonustypes as $term) {
                                if ($atts['cat_in'] === $term && current_user_can('administrator')) {
                                    $catfilter = true;
                                }
                            }
                        }

//                        $with = get_post_meta($casinoID, 'casino_custom_meta_' . $atts['deposit'] . '_max_wit', true);
                        $with = get_post_meta($casinoID, 'casino_custom_meta_min_dep', true);
//                        $dep = get_post_meta($casinoID, 'casino_custom_meta_' . $atts['deposit'] . '_min_dep', true);
                        $dep = get_post_meta($casinoID, 'casino_custom_meta_min_withd', true);

                        $depositwith ='<div style="width:100%;"><i class="fas fa-money-bill-wave" aria-hidden="true" data-toggle="tooltip" title="Minimum Deposit" style="color:#299cbf;padding-right:1px;"></i>  ' . $with . '</div>';
                        $depositwith .='<div style="width:100%;"><i class="fa fa-credit-card" aria-hidden="true" data-toggle="tooltip" title="Maximum Withdrawal" style="color:#29bf29;padding-right:1px;"></i>  ' . $dep . '</div>';


                        $extraListItem1 = explode(",", get_post_meta($casinoID, 'casino_custom_meta_why_play', true));
                        if ($atts['2nd_column_list'] === "bonus") {
                            if ($atts['cat_in'] == "48") {
                                $li2 = $bonusCTA ? $bonusCTA : $extraListItem1[2];
                                $li1 = str_replace("+ ", "", $bonusCTA2 ? $bonusCTA2 : $extraListItem1[0]);

                            } else {
                                $li1 = $bonusCTA ? $bonusCTA : $extraListItem1[2];
                                $li2 = $bonusCTA2 ? $bonusCTA2 : $extraListItem1[0];

                            }
                            if ($geoBonusArgs['isExclusive'] && $atts['cat_in'] !== '67') {
                                $li3 = '<span>Exclusive Bonus</span>';
                                $exc = " exc";
                                $excClass = "exclusive";
                            } else {
                                $li3 = $bonusCode ? $bonusCode : $extraListItem1[1];
                                $exc = $bonusCode ? 'bonus-exclusive-class' : "";
                                $excClass = "not-exclusive";
                            }
                        } elseif ($atts['2nd_column_list'] == "why") {
                            $li1 = $extraListItem1[0];
                            $li2 = $extraListItem1[1];
                            $li3 = $extraListItem1[2];
                        }
                    }
                    if ($jk > 15) {
                        $trClass .= " hidden-row";
                        $trStyle = ' style="display:none;"';
                    }else{
                        $trClass .= "";
                        $trStyle = '';
                    }
                    if (($extraFilter && $catfilter) || (!$extraFilter && !$catfilter)) {
                        $ret .= '				<tr class="parent-row text-sm-13 w-100 position-relative mb-lg-0 mb-xl-0 mb-5p ' . $trClass . ' ' . $excClass . '" ' . $trStyle . '>';
                        //$ret .= '					<td class="nmbt">'.$ribbon.''.$i.'</td>';
                        $ret .= '					<td class="inline-hor-logo w-sm-32 w-20 order-1 border-0 white-no-wrap align-self-center position-relative p-sm-5p pb-2p pl-10p pl-md-0  pr-0 pt-5p align-middle ' . $bonusISO . ' logo-tab"  data-title="Casino" ><a href="' . get_permalink($casinoID) . '"><img src="' . get_the_post_thumbnail_url($casinoID, 'shortcode') . '" loading="lazy" class="attachment-shortcode text-decoration-none size-shortcode wp-post-image">' . $i . '</a></td>';
                        $ret .= '					<td class="casino-title text-center w-20 d-none d-md-table-cell d-lg-table-cell d-xl-table-cell border-0 p-sm-5p pb-2p pl-0 pl-md-0 pr-0 pt-5p" style="vertical-align: middle"  data-title="casino"><span class="">' . get_the_title($casinoID) . '</span></td>';
                        $ret .= '					<td class="bonus position-relative pb-2p white-no-wrap d-flex flex-wrap align-self-center justify-content-start border-0 pl-sm-5 order-2 d-md-table-cell w-sm-65 pt-5p pl-10p pl-md-0 pr-0  align-middle" data-title="' . $atts['2nd_col_title'] . '"><ul class="billboard-list bonus-table-list text-sm-13 mt-0 mb-0 pl-0 list-typenone" style="white-space: nowrap;text-align: left;"><li class="text-primary font-weight-bold text-17 " style="list-style: none"><a ' . $btnDisable . ' href="' . $affiLink . '" target="_blank" rel="nofollow" class="text-decoration-none">' . $li1 . '</a></li><li style="list-style: none">' . $li2 . '</li><li style="list-style: none" class="' . $exc . '">' . $li3 . '</li></ul></td>';
                        $ret .= '					<td class="wag border-0 w-20 d-none d-md-table-cell d-lg-table-cell d-xl-table-cell order-3 w-sm-100 pt-sm-5p pb-sm-5p white-no-wrap text-center"  data-title="Min-Dep - Max-With" style="white-space: nowrap; vertical-align: middle;">' . $depositwith . '</td>';
                        $ret .= '					<td class="rating position-relative white-no-wrap  w-20 pb-2p text-center order-4 w-sm-30 border-0 align-self-center  pt-5p pl-10p pl-md-0 pr-0 align-middle"  data-title="' . $atts['3rd_col_title'] . '">' . get_rating($casinoID, 'numbers') . '<a class="text-decoration-none" href="' . get_the_permalink($casinoBonusPage) . '">Info</a></td>';
                        $ret .= '					<td class="inline-hor-cta  position-relative text-center  pb-2p w-sm-70 border-0 align-self-center order-5 pl-10p pl-md-0 pr-0 pt-5p align-middle"  data-title="' . $atts['cta_col_title'] . '">' . create_cta_button($casinoID, $atts['cta'], $btnDisable, $countryISO,$atts['cat_in']) . '</td>';
                        $ret .= '				</tr>';
                        if ($TCS) $ret .= '<tr id="child-row-' . $jk . '" class="pt-0 child-row ' . $trClass . '" ' . $trStyle . '><td colspan="6" class="d-xl-table-cell d-lg-table-cell d-flex align-items-center bg-yellowish bg-xs-none w-100 f-xs-center"><p class="w-sm-95 position-relative white-space-initial text-10 text-grey text-italic text-center mb-0">' . $TCS . '</p><i class="pl-1  fa fa-close close-x d-xl-none d-lg-none visible-xs d-block text-secondary" data-id="child-row-' . $jk . '"></i></td></tr>';
                        $jk = $jk + 1;
                    }
                }
            }
        endif;
        wp_reset_postdata();
        $ret .= '';
        $ret .= '';
        $ret .= '';

        $ret .= '			</tbody>';
        $ret .= '		</table>';
        $ret .= '<div id="alal" class="btn btn-border border-primary mb-20 text-center w-100 noshadow" data-showr="off">
         <a class="text-decoration-none" href="'.get_the_permalink($atts['deposit']).'"> Show All Casinos with <span class="font-weight-bold">'.get_the_title($atts['deposit']).'</span></a>
         </div>';
        $ret .= '</div>';
        $ret .= '</div>';
        $ret .= '</div>';

    } elseif ('countries' === $atts['layout']) {
        $priorityFilter =null;
        if ($atts['pay_order']) $priorityFilter = $atts['pay_order'];
        $ret .= '<div class="inner_row more_games mb-15p ' . $atts['layout'] . '">';
        $ret .= '	<div class="">';
        if ($atts['title']) {
            $ret .= '		<div class="star shortcode-star d-block  border-0 mb-0 pt-5p h-auto position-relative text-center">';
            $ret .= '<span class="hidden-md hidden-xs d-none d-md-inline-block d-lg-inline-block d-xl-inline-block" style="position: absolute;left: 5px;top: 0px;">
                         <span class="sort-icon secure">Secure</span>';
            $ret .= '<span class="sort-icon trusted">Trusted</span>';
            $ret .= '<span class="sort-icon verified">Verified</span>
                        </span>';
            $flagISO = $localIso !== 'nl' ? $localIso : 'eu';
            $ret .= get_flags('', '', $flagISO, 25, array('style' => 'padding-right:5px;padding-bottom: 3px;')) . $atts['title'] . '</div>';
        }
        $ret .= '		<div class="table-responsive table_3 " >';
        $ret .= '		<table class="table d-flex flex-wrap d-md-table d-lg-table d-xl-table table-condensed mb-0 text-center medium align-middle p-5p" id="' . uniqid() . '">';
        $ret .= '			<thead class="casinohead">';
        $ret .= '				<tr>';
        $ret .= '                    <th scope="col" class="inline-hor-logo widget2-heading align-middle p-2p numeric d-table-cell w-auto"></th>';
        $ret .= '					    <th scope="col" class="bonus-code widget2-heading align-middle numeric p-2p d-table-cell w-auto">Casino</th>';
        $ret .= '					<th scope="col"  class="bonus widget2-heading align-middle numeric p-2p d-table-cell w-auto" >' . $atts['2nd_col_title'] . '</th>';
        $ret .= '					<th scope="col"  class="info-tab widget2-heading align-middle numeric p-2p d-table-cell w-auto" >' . $atts['3rd_col_title'] . '</th>';
        $ret .= '				  <th scope="col"  class="rating widget2-heading align-middle numeric p-2p d-table-cell w-auto" >Rating</th>';
        $ret .= '					   <th scope="col"  class="inline-hor-cta widget2-heading align-middle p-2p d-table-cell numeric w-auto">' . $atts['cta_col_title'] . '</td>';
        $ret .= '				</tr>';
        $ret .= '			</thead>';
        $ret .= '			<tbody>';
        $i = 0;
        if ($allCasinos):
            $jk = 0;
            foreach ($allCasinos as $casinoID) {
                $isCasinoPremium = in_array($casinoID, $premiumCasinos);
                $i = $isCasinoPremium ? '<span><img src="https://www.best50casino.com/wp-content/uploads/2018/05/favicon.png"  loading="lazy" width="17" height="17" alt="premium" data-toggle="tooltip" title="Premium" ></span>' : '';
                $resttricted = get_post_meta($casinoID, 'casino_custom_meta_rest_countries', true);
                if (is_array($resttricted) && in_array($countryISO, $resttricted)) {
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

                    $geoBonusArgs = is_country_enabled($casinoID, 'kss_casino');
                    $affiLink = $geoBonusArgs['aff_sc'];
                    $bonusCTA = $geoBonusArgs['bonusText']['cta-top'];
                    $bonusCTA2 = $geoBonusArgs['bonusText']['FlagText'];
                    $bonusCode = '';
                    if ($geoBonusArgs['bonusCode'] !== 'No Code Required') {
                        $bonusCode = '<br><small>Bonus Code: ' . $geoBonusArgs['bonusCode'] . '</small>';
                    }
                    $isBonusExclusive = $geoBonusArgs['isExclusive'] ? '<div class="exclusive-inline d-none d-xl-block d-lg-block"><i class="fa fa-star" aria-hidden="true"></i><span>Exclusive Bonus</span></div>' : '';
                    $isBonusExclusiveMobile = $geoBonusArgs['isExclusive'] ? $exclusiveMobileString : '';
                    $advancedTCs = $geoBonusArgs['bonusText']['terms'] ?: '';
                    $TCS = !get_post_meta($casinoID, $countryISO . 'casino_custom_meta_sp_terms_link', true) ? $advancedTCs : '<a href="' . get_post_meta($casinoID, $countryISO . 'casino_custom_meta_sp_terms_link', true) . '" target="_blank" rel="nofollow" class="text-9 text-grey text-italic text-center">' . $advancedTCs . '</a>';
                    $extraFilter = false;
                    $catfilter = false;
                    if ($atts['cat_in']) {
                        $extraFilter = true;
                        $bonustypes = $geoBonusArgs['bonusText']['left-billboard'];
                        foreach ($bonustypes as $term) {
                            if ($atts['cat_in'] === $term && current_user_can('administrator')) {
                                $catfilter = true;
                            }
                        }
                    }

                }

                if ($jk > 15) {
                        $trClass .= " hidden-row";
                        $trStyle = ' style="display:none;"';
                    }else{
                        $trClass .= "";
                        $trStyle = '';
                    }
                    if (($extraFilter && $catfilter) || (!$extraFilter && !$catfilter)) {
                        $ret .= '				<tr  class="parent-row text-sm-13 w-100 position-relative mb-lg-0 mb-xl-0 mb-5p ' . $trClass . '" ' . $trStyle . '>';
                        $ret .= '					<td class="inline-hor-logo w-sm-32 w-15 order-1 border-0 white-no-wrap align-self-center position-relative p-sm-5p pb-2p pl-10p pl-md-0  pr-0 pt-5p align-middle ' . $bonusISO . ' logo-tab"  data-title="Casino" >' . $isBonusExclusiveMobile . '<a href="' . get_permalink($casinoID) . '"><img src="' . get_the_post_thumbnail_url($casinoID, 'shortcode') . '" loading="lazy" class="attachment-shortcode text-decoration-none size-shortcode wp-post-image">' . $i . '</a></td>';
                        $ret .= '					<td class="bonus-code position-relative w-15 d-none d-md-table-cell pb-2p pt-0p pl-0 border-0 pr-5p align-middle"   style="vertical-align: middle;" data-title=""><span >' . get_the_title($casinoID) . '</span>' . $bonusCode . '</td>';
                        $ret .= '					<td class="bonus position-relative pb-2p white-no-wrap d-flex flex-column flex-xl-wrap flex-lg-wrap align-self-center justify-content-center border-0 pl-sm-5 order-2 d-md-table-cell w-sm-65 pt-5p pl-10p pl-md-0 pr-0  align-middle"  style="vertical-align: middle;"  data-title="' . $atts['2nd_col_title'] . '"><span class=" text-primary text-17 font-weight-bold  d-block"><a ' . $btnDisable . ' href="' . $affiLink . '" target="_blank" rel="nofollow" class="text-decoration-none">' . $bonusCTA . '</a></span><span class="text-12">' . $bonusCTA2 . '</span>' . $isBonusExclusive . '    </td>';
                        $ret .= '					<td  style="vertical-align: middle" class="info-tab border-0 order-3 w-sm-100 pt-3p pl-10p pr-0 pb-3p" data-title=""><span class="text-medium align-items-lg-start align-items-md-start align-items-xl-start align-items-center text-12 justify-content-between p-3p text-left w-sm-100 d-flex flex-row flex-md-column flex-lg-column flex-xl-column">' . create_column($casinoID, $atts['3rd_column'], $atts['3rd_column_icons'], $countryISO, $priorityFilter) . '</span></td>';

                        //$ret .= '					<td class="pros"  data-title=""><span class="text-medium">'.get_the_title($casinos).'</span>'.$bonusCode.'</td>';
                        $ret .= '					<td class="rating position-relative white-no-wrap  pb-2p order-4 w-sm-30 border-0 align-self-center  pt-5p pl-md-0 pr-0 align-middle"  data-title="' . $atts['3rd_col_title'] . '">' . get_rating($casinoID, 'numbers') . '<a class="text-decoration-none" style="display:block;" href="' . get_the_permalink($casinoID) . '">Review</a></td>';
                        $ret .= '					<td class="inline-hor-cta position-relative  pb-2p w-sm-70 border-0 align-self-center order-5 pl-10p pl-md-0 pr-0 pt-5p align-middle"  data-title="' . $atts['cta_col_title'] . '">' . create_cta_button($casinoID, $atts['cta'], $btnDisable, $countryISO,$atts['cat_in']) . '</td>';
                        $ret .= '				</tr>';
                        if ($TCS) $ret .= '<tr id="child-row-' . $jk . '" class="pt-0 child-row ' . $trClass . '" ' . $trStyle . '><td colspan="6" class="d-flex d-xl-table-cell d-lg-table-cell align-items-center p-2p bg-yellowish  w-100 "><p class="w-sm-95 position-relative white-space-initial text-10 text-grey text-italic text-center mb-0 ">' . $TCS . '</p><i class="pl-1 d-block d-xl-none d-lg-none fa fa-close close-x visible-xs text-secondary" data-id="child-row-' . $jk . '"></i></td></tr>';
                        $jk = $jk + 1;
                    }
            }
        endif;
        wp_reset_postdata();
        $ret .= '';
        $ret .= '';
        $ret .= '';
        $ret .= '			</tbody>';
        $ret .= '		</table>';

        $countries =  WordPressSettings::getCountryEnabledSettingsPosts();
        $countryid =  isset($countries[$GLOBALS['countryISO']]) ? $countries[$GLOBALS['countryISO']] :false;

        if ( $countryid != false && get_post_status($countryid) == 'publish') {
            $ret .= '<div id="alal" class="btn btn-border border-primary mb-20 text-center w-100 noshadow" data-showr="off">
             <a class="text-decoration-none" href="' . get_the_permalink($countryid) . '">Show All Casinos in <span class="font-weight-bold">' . $GLOBALS['countryName'] . '</span></a>
             </div>';
        }
        $ret .= '		</div>';
        $ret .= '</div>';
        $ret .= '</div>';
    }
    elseif ('providers' === $atts['layout']) { //////////

        $ret .= '<div class="inner_row more_games mb-15p ' . $atts['layout'] . '">';
        $ret .= '	<div class="">';
        if ($atts['title']) {
            if ($atts['exc_filter'] == "true") {
                $ret .= '		<div class="star shortcode-star ext-filter flex-column flex-md-row flex-lg-row flex-xl-row" style="display:flex;justify-content: space-between; align-items: center">';
                $ret .= '<span class="hidden-md hidden-xs d-none d-lg-block  d-xl-block pl-5p" style="">
                         <span class="sort-icon secure">Secure</span>';
                $ret .= '<span class="sort-icon trusted">Trusted</span>';
                $ret .= '<span class="sort-icon verified">Verified</span>
                        </span>';
                $flagISO = $localIso != 'nl' ? $localIso : 'eu';
                $ret .= '<span>' . get_flags('', '', $flagISO, 25, array('style' => 'padding-left:5px;padding-bottom: 3px;')) . $atts['title'] . '</span>';
                $ret .= '<div class="pull-right mb-0 mr-5">
                            <p class="mb-0 text-13"><label class="m-0" id="label-exclusive" style="font-weight:normal;"><span>Show only Exclusive Bonuses</span>
                                    <input style="vertical-align: middle;margin:0px !important;" data-shownex="off" type="checkbox" name="exclusive-bonus" id="exclusive-bonus"></label></p>

                        </div>';
                $ret .= '</div>';
            } else {
                $ret .= '		<div class="star shortcode-star">';
                $ret .= '<span class="hidden-xs d-none d-lg-block  d-xl-block " style="position: absolute;left: 5px;top: -2px;">
                         <span class="sort-icon secure">Secure</span>';
                $ret .= '<span class="sort-icon trusted">Trusted</span>';
                $ret .= '<span class="sort-icon verified">Verified</span>
                        </span>';
                $flagISO = $localIso != 'nl' ? $localIso : 'eu';
                $ret .= '<span>' . get_flags('', '', $flagISO, 25, array('style' => 'padding-right:5px;padding-bottom: 3px;')) . $atts['title'] . '</span>';
                $ret .= '</div>';
            }

            $ret .= '<div class="d-flex flex-wrap w-100 mt-5p">';
            $providers = WordPressSettings::getPremiumProviders($GLOBALS['countryISO']);
            $pieces = explode(",", $providers);
            $sliced_array = array_slice($pieces, 0, 6);
            $i = 0;
            $len = count($sliced_array);
            foreach ($sliced_array as $paymentid){
                $image_id = get_post_meta($paymentid, 'casino_custom_meta_sidebar_icon', true);
                $title = get_the_title($paymentid);

                if ($atts['software'] == $paymentid){
                    $activeclass ='activefilter' ;
                }else{
                    $activeclass= '';
                }
                $count = strlen($title);
                if($count > 16){
                    $titleShort = substr($title, 0, 16);
                }else{
                    $titleShort= null;
                }

                ob_start();?>
                <a class="p-10p border-trans text-decoration-none filtersheadings <?=$activeclass?>"  data-title="<?=get_the_title($paymentid);?>"   data-id="<?=$paymentid?>" onclick="filter_providers(event,this)">
                    <div class="d-flex flex-wrap">
                        <div class="w-100 w-sm-100 d-flex flex-wrap align-self-center ">
                            <img class="w-20 img-fluid float-right" style="width: 44px"  loading="lazy" src="<?= $image_id;?>">
                            <?php
                            if ($titleShort){
                                echo '<span data-toggle="tooltip" title="'.$title.'" class="w-80 text-14 titlefilter text-sm-13 align-self-center pl-5p"> '.$titleShort.'</span>';
                            }else{
                                echo '<span class="w-80 align-self-center text-14 text-sm-13 pl-5p titlefilter"> '.$title.'</span>';
                            }
                            ?>
                        </div>
                    </div>
                </a>
                <?php
                $output = ob_get_contents();
                ob_end_clean();
                $ret .= $output;
            }

            $ret .= '</div>';
        }
        $ret .= '		<div class="table-responsive mt-5p">';
        $ret .= '		<table class="table table-condensed mb-0 medium table_3"  id="' . uniqid() . '">';
        $ret .= '			<thead class="casinohead">';
        $ret .= '				<tr>';
        $ret .= '						<th scope="col" class="inline-hor-logo widget2-heading align-middle p-2p numeric d-table-cell w-auto"></th>';
        $ret .= '					<th scope="col" class="inline-hor-logo widget2-heading align-middle p-2p numeric d-table-cell w-auto">Casino</th>';
        $ret .= '					 <th scope="col"  class="bonus widget2-heading align-middle numeric p-2p d-table-cell w-auto" >' . $atts['2nd_col_title'] . '</th>';
        $ret .= '					<th class="wag widget2-heading align-middle p-2p numeric d-table-cell w-auto"> Rng/Live </th>';
        $ret .= '					<th class="rating widget2-heading align-middle numeric p-2p d-table-cell w-auto">' . $atts['3rd_col_title'] . '</th>';
        $ret .= '					<th class="inline-hor-cta widget2-heading align-middle numeric p-2p d-table-cell w-auto">' . $atts['cta_col_title'] . '</th>';
        $ret .= '				</tr>';
        $ret .= '			</thead>';
        $ret .= '			<tbody>';
        $i = 0;
        if ($allCasinos):
            $jk = 0;

            foreach ($allCasinos as $casinoID) {
                if ($jk <= $atts['limit'] && !in_array($countryISO, get_post_meta($casinoID, 'casino_custom_meta_rest_countries', true))) {
//                    if(current_user_can('administrator')){
//                        print_r($casinoID.'<br>');
//                    }
                    $isCasinoPremium = in_array($casinoID, $premiumCasinos);
                    $i = $isCasinoPremium ? '<span><img src="https://www.best50casino.com/wp-content/uploads/2018/05/favicon.png" loading="lazy" width="17" height="17" alt="premium" data-toggle="tooltip" title="Premium" ></span>' : '';

                    if (in_array($countryISO, get_post_meta($casinoID, 'casino_custom_meta_rest_countries', true))) {
                        $trClass = 'disabledRow';
                        $btnDisable = 'disabled';
                        $affiLink = 'javascript:void(0)';
                        $li1 = 'No ' . get_flags('', '', $GLOBALS['countryISO']) . ' Players Accepted';
                        $li2 = '';
                        $li3 = '';
                        $bonusCTA2 = '';
                        $TCS = '';
                        $isBonusExclusive = '';
                        $wagering = '-';
                    } else {
                        $trClass = 'enableRow';
                        $btnDisable = '';
                        $geoBonusArgs = is_country_enabled($casinoID, 'kss_casino');
                        $affiLink = $geoBonusArgs['aff_sc'];
                        $bonusCTA = $geoBonusArgs['bonusText']['cta-top'];
                        $bonusCTA2 = $geoBonusArgs['bonusText']['FlagText'];
                        $bonusCode = '';
                        if ($geoBonusArgs['bonusCode'] !== 'No Code Required') {
                            $bonusCode = $geoBonusArgs['bonusCode'];
                        }
                        $isBonusExclusive = $geoBonusArgs['isExclusive'] ? '<div class="exclusive-inline d-none d-xl-block d-lg-block"><i class="fa fa-star" aria-hidden="true"></i><span>Exclusive Bonus</span></div>' : '';
                        $isBonusExclusiveMobile = $geoBonusArgs['isExclusive'] ? $exclusiveMobileString : '';
                        $advancedTCs = $geoBonusArgs['bonusText']['terms'] ?: '';
                        $TCS = !get_post_meta($casinoID, $countryISO . 'casino_custom_meta_sp_terms_link', true) ? $advancedTCs : '<a href="' . get_post_meta($casinoID, $countryISO . 'casino_custom_meta_sp_terms_link', true) . '" target="_blank" rel="nofollow" class="text-9 text-grey text-italic text-center">' . $advancedTCs . '</a>';
                        $extraFilter = false;
                        $catfilter = false;
                        if ($atts['cat_in']) {
                            $extraFilter = true;
                            $bonustypes = $geoBonusArgs['bonusText']['left-billboard'];
                            if ($bonustypes) {
                                foreach ($bonustypes as $term) {
                                    if ($atts['cat_in'] === $term && current_user_can('administrator')) {
                                        $catfilter = true;
                                    }
                                }
                            }
                        }


                        $extraListItem1 = explode(",", get_post_meta($casinoID, 'casino_custom_meta_why_play', true));
                        if ($atts['2nd_column_list'] === "bonus") {
                            if ($atts['cat_in'] === "48") {
                                $li2 = $bonusCTA ? $bonusCTA : $extraListItem1[2];
                                $li1 = str_replace("+ ", "", $bonusCTA2 ? $bonusCTA2 : $extraListItem1[0]);

                            } else {
                                $li1 = $bonusCTA ? $bonusCTA : $extraListItem1[2];
                                $li2 = $bonusCTA2 ? $bonusCTA2 : $extraListItem1[0];

                            }
                            if ($geoBonusArgs['isExclusive'] && $atts['cat_in'] != '67') {
                                $li3 = '<span>Exclusive Bonus</span>';
                                $exc = " exc";
                                $excClass = "exclusive";
                            } else {
                                $li3 = $bonusCode ? $bonusCode : $extraListItem1[1];
                                $exc = $bonusCode ? 'bonus-exclusive-class' : "";
                                $excClass = "not-exclusive";
                            }
                        } elseif ($atts['2nd_column_list'] === "why") {
                            $li1 = $extraListItem1[0];
                            $li2 = $extraListItem1[1];
                            $li3 = $extraListItem1[2];
                        }
                    }
                    if ($jk > 15) {
                        $trClass .= " hidden-row";
                        $trStyle = ' style="display:none;"';
                    }else{
                        $trClass .= "";
                        $trStyle = '';
                    }
                            if( get_post_meta($atts['software'],'software_custom_meta_rng' ,true) && get_post_meta($atts['software'],'software_custom_meta_livecasino' ,true) ){
                                $rng = '
                             <span class="d-md-none d-lg-none d-xl-none d-block text-dark mx-auto">RNG/Live</span>
                            <img data-toggle="tooltip" title="RNG"src="'.get_template_directory_uri().'/assets/images/svg/rng.svg'.'" width="20" height="20" loading="lazy"> | <img data-toggle="tooltip" title="Live" src="'.get_template_directory_uri().'/assets/images/svg/dealer_menu_icon.svg'.'" width="20" height="20" loading="lazy">
                           ';
                            }elseif(get_post_meta($atts['software'],'software_custom_meta_rng' ,true) && !get_post_meta($atts['software'],'software_custom_meta_livecasino' ,true)){
                                $rng = '<span class="d-md-none d-lg-none d-xl-none d-block text-dark mx-auto">RNG/Live</span>
                            <img data-toggle="tooltip" title="RNG" src="'.get_template_directory_uri().'/assets/images/svg/rng.svg'.'" width="20" height="20" loading="lazy" class=" d-block mx-auto">';
                            }
                            elseif(!get_post_meta($atts['software'],'software_custom_meta_rng' ,true) && get_post_meta($atts['software'],'software_custom_meta_livecasino' ,true)){
                                $ret .= '
                                <span class="d-md-none d-lg-none d-xl-none d-block text-dark mx-auto">RNG/Live</span>
                                <img data-toggle="tooltip" title="Live" src="'.get_template_directory_uri().'/assets/images/svg/dealer_menu_icon.svg'.'" width="20" height="20" loading="lazy" class="d-block mx-auto">';
                               }else{
                                $ret .= 'No Info';
                            }
                        $ret .= '				<tr class="parent-row text-sm-13 w-100 position-relative mb-lg-0 mb-xl-0 mb-5p ' . $trClass . ' ' . $excClass . '" ' . $trStyle . '>';
                        //$ret .= '					<td class="nmbt">'.$ribbon.''.$i.'</td>';
                        $ret .= '					<td class="inline-hor-logo w-sm-32 w-20 order-1 border-0 white-no-wrap align-self-center position-relative p-sm-5p pb-2p pl-10p pl-md-0  pr-0 pt-5p align-middle ' . $bonusISO . ' logo-tab"  data-title="Casino" ><a href="' . get_permalink($casinoID) . '"><img src="' . get_the_post_thumbnail_url($casinoID, 'shortcode') . '" loading="lazy" class="attachment-shortcode size-shortcode text-decoration-none wp-post-image">' . $i . '</a></td>';
                        $ret .= '					<td class="casino-title text-center w-20 d-none d-md-table-cell d-lg-table-cell d-xl-table-cell border-0 p-sm-5p pb-2p pl-0 pl-md-0 pr-0 pt-5p" style="vertical-align: middle"  data-title="casino"><span class=""><a class="text-decoration-none" href="' . get_the_permalink($casinoID) . '">' . get_the_title($casinoID).'</a></span></td>';
                        $ret .= '					<td class="bonus position-relative pb-2p white-no-wrap d-flex flex-wrap align-self-center justify-content-start border-0 pl-sm-5 order-2 d-md-table-cell w-sm-65 pt-5p pl-10p pl-md-0 pr-0  align-middle" data-title="' . $atts['2nd_col_title'] . '"><ul class="billboard-list bonus-table-list text-sm-13 mt-0 mb-0 pl-0 list-typenone" style="white-space: nowrap;text-align: left;"><li class="text-primary font-weight-bold text-17 " style="list-style: none"><a ' . $btnDisable . ' href="' . $affiLink . '" target="_blank" rel="nofollow" class="text-decoration-none">' . $li1 . '</a></li><li style="list-style: none">' . $li2 . '</li><li style="list-style: none" class="' . $exc . '">' . $li3 . '</li></ul></td>';
                        $ret .= '					<td class="wag border-0 w-20 d-none d-md-table-cell d-lg-table-cell d-xl-table-cell order-3 w-sm-100 pt-sm-5p pb-sm-5p white-no-wrap text-center"  data-title="Rng/Live" style="white-space: nowrap; vertical-align: middle;">' . $rng . '</td>';
                        $ret .= '					<td class="rating position-relative white-no-wrap  w-20 pb-2p text-center order-4 w-sm-30 border-0 align-self-center  pt-5p pl-10p pl-md-0 pr-0 align-middle"  data-title="' . $atts['3rd_col_title'] . '">' . get_rating($casinoID, 'numbers') . '</td>';
                        $ret .= '					<td class="inline-hor-cta  position-relative text-center  pb-2p w-sm-70 border-0 align-self-center order-5 pl-10p pl-md-0 pr-0 pt-5p align-middle"  data-title="' . $atts['cta_col_title'] . '">' . create_cta_button($casinoID, $atts['cta'], $btnDisable, $countryISO,$atts['cat_in']) . '</td>';
                        $ret .= '				</tr>';
                        if ($TCS) $ret .= '<tr id="child-row-' . $jk . '" class="pt-0 child-row ' . $trClass . '" ' . $trStyle . '><td colspan="6" class="d-xl-table-cell d-lg-table-cell d-flex align-items-center bg-yellowish bg-xs-none w-100 f-xs-center"><p class="w-sm-95 position-relative white-space-initial text-10 text-grey text-italic text-center mb-0">' . $TCS . '</p><i class="pl-1  fa fa-close close-x d-xl-none d-lg-none visible-xs d-block text-secondary" data-id="child-row-' . $jk . '"></i></td></tr>';
                        $jk = $jk + 1;

                }
            }
        endif;
        wp_reset_postdata();
        $ret .= '';
        $ret .= '';
        $ret .= '';

        $ret .= '			</tbody>';
        $ret .= '		</table>';
        if ( get_post_status ( $atts['software'] ) === 'publish' ) {
        $ret .= '<div id="alal" class="btn btn-border border-primary mb-20 text-center w-100 noshadow" data-showr="off">   
         <a class="text-decoration-none" href="'.get_the_permalink($atts['software']).'"> Show All Casinos with <span class="font-weight-bold">'.get_the_title($atts['software']).'</span></a>
         </div>';
        }
        $ret .= '</div>';
        $ret .= '</div>';
        $ret .= '</div>';

        $morepayments = array_slice($pieces,6);

        $ret .= '<h2 class="content-title mb-10p mt-10p">More Providers</h2>';
        $ret .= ' <div class="d-flex flex-wrap w-100">';
        foreach ($morepayments as $providerid) {
            if (get_post_status($providerid) === 'publish'){
                $image_id = get_post_meta($providerid, 'casino_custom_meta_sidebar_icon', true);
                $title = get_the_title($providerid);
                $count = strlen($title);
                if($count > 16){
                    $titleShort = substr($title, 0, 16);
                }else{
                    $titleShort= null;
                }
            $ret .= ' <a class="p-10p border-trans payment-box text-decoration-none ml-2p mt-1p mb-1p mr-2p"  href="'.get_the_permalink($providerid).'">';
            $ret .= ' <div class="d-flex flex-wrap">';
            $ret .= ' <div class="w-100 w-sm-100 d-flex flex-wrap align-self-center">';
            $ret .= '<img class="w-15 img-fluid float-right" style="width: 44px" loading="lazy" src="'.$image_id.'">';
                if ($titleShort) {
                    $ret .=  '<span data-toggle="tooltip" title="' . $title . '" class="w-85 text-14 text-sm-13 align-self-center pl-5p"> ' . $titleShort . '</span>';
                } else {
                    $ret .=  '<span class="w-85 align-self-center text-14 text-sm-13 pl-5p"> ' . $title . '</span>';
                }
                $ret .= '</div>';
                $ret .= '</div>';
                $ret .= '</a>';
            }}
        $ret .= '</div>';
    }

    return $ret;
}
add_shortcode('table', 'table_cta_shortcode');

