<?php function get_all_slots()
{
    $countryISO = $GLOBALS['countryISO'];
    $themeSettings = get_option('countries_enable_options');
    $isCountryEnabled = in_array($countryISO, $themeSettings['enabled_countries_iso'][0]) ? true : false;
    $localIso = $isCountryEnabled ? $countryISO : 'glb';
    $query_slot = array( // A QUERY that initializes the default (all) IDS
        'post_type' => array('kss_slots'),
        'post_status' => array('publish'),
        'no_found_rows' => true,
        'fields' => 'ids',
        'update_post_term_cache' => false,
        'posts_per_page' => 500,
        'orderby' => 'date',
        'order' => 'DESC',
    );
    $cache_key = 'slot_all';
    if (false === ($query_slots = wp_cache_get($cache_key))) {
        $query_slots = get_posts($query_slot);
        wp_cache_set($cache_key, $query_slots, 'slot_all', DAY_IN_SECONDS);
    }
    $ret = "";
    foreach ($query_slots as $slotsID) {
        $score = get_post_meta($slotsID, 'slot_custom_meta_slot_value', true) / 20;
        $casinoID = get_post_meta($slotsID, 'slot_custom_meta_slot_main_casino', true);
        $rtp = get_post_meta($slotsID, 'slot_custom_meta_rtp_perc', true);
        $rtpFilter = (int)str_replace("%", "", $rtp) >= 95 ? 'bestRTP' : '';
        if (get_post_meta($slotsID, 'slot_custom_meta_label', true)) {
            $meta_label = implode(" ", get_post_meta($slotsID, 'slot_custom_meta_label', true));
        }
        $jackpot_option = get_post_meta($slotsID, 'slot_custom_meta_jackpot_option', true) ? 'Jackpot' : '';
        $vid_clas_option = get_post_meta($slotsID, 'slot_custom_meta_classic_video', true);
        $three_d_option = get_post_meta($slotsID, 'slot_custom_meta_3d_option', true) ? '3D' : '';
        if (get_post_meta($slotsID, 'slot_custom_meta_slot_theme', true)) {
            $theme = implode(" ", get_post_meta($slotsID, 'slot_custom_meta_slot_theme', true));
        }
        $ret .= '		<div class=" ' . 'element-item m-2p ' . $meta_label . ' ' . $rtpFilter . ' ' . str_replace(" ", "-", get_the_title(get_post_meta($slotsID, 'slot_custom_meta_slot_software', true)) ) . ' ' . $jackpot_option . ' ' . $vid_clas_option . ' ' . $three_d_option . ' ' . $theme . '" data-filter="' . str_replace(" ", "-", get_the_title(get_post_meta($slotsID, 'slot_custom_meta_slot_software', true))) . ' ' . $meta_label . ' ' . $rtpFilter . ' ' . $jackpot_option . ' ' . $vid_clas_option . ' ' . $three_d_option . ' ' . $theme . '" data-category="transition">';
        $ret .= '        		<section class="containerz">';
        $ret .= '					<div class="card">';
        $ret .= '						<div class="front">';
        $ret .= '			<a href="' . get_the_permalink($slotsID) . '">';
        $ret .= '				<figure class="m-0">';
        $ret .= '								<img loading="lazy" src="' . get_the_post_thumbnail_url($slotsID) . '" alt="' . get_the_title($slotsID) . '">';
        if (get_post_meta($slotsID, 'slot_custom_meta_label', true)) {
            if (in_array('LEGEND', get_post_meta($slotsID, 'slot_custom_meta_label', true))) {
                $ret .= '						<div class="ribbon hot"><span>Legend</span></div>';
            } elseif (in_array('BEST', get_post_meta($slotsID, 'slot_custom_meta_label', true))) {
                $ret .= '						<div class="ribbon premium"><span>Best</span></div>';
            } elseif (in_array('NEW', get_post_meta($slotsID, 'slot_custom_meta_label', true))) {
                $ret .= '						<div class="ribbon new"><span>New</span></div>';
            }
        }
        $page = get_post_meta($slotsID, 'slot_custom_meta_slot_software', true);
        // $imge_id = get_image_id_by_link(get_post_meta($page->ID, 'casino_custom_meta_sidebar_icon', true));
        $imge_url = get_post_meta($page, 'casino_custom_meta_sidebar_icon', true);
        // $ret .= '				<span class="software">'. wp_get_attachment_image($imge_id, 'sidebar-medium', "", array("alt"=>get_the_title($page->ID))).'</span>';
        $ret .= '				<span class="software"><img src="' . $imge_url . '" loading="lazy" class="attachment-sidebar-medium size-sidebar-medium" width="30" height="30" alt="' . get_the_title($page) . '"></span>';
        //$ret .= '					<span class="software">'.get_the_post_thumbnail($page->ID, 'sidebar-medium').'</span>';
        $ret .= '				</figure>';
        $ret .= '				<span class="name">' . get_the_title($slotsID) . '</span>';
        $ret .= '							<span class="rating">';
        $ret .= '								<span class="star-rating">' . $score . '</span>';
        $ret .= '							</span>';
        $ret .= '							</a>';
        $ret .= '						</div>';
        $ret .= '						<div class="back">';
        $ret .= '							<table>';
        $ret .= '										<tr>';
        $ret .= '											<td>Wheels:</td><td>' . get_post_meta($slotsID, 'slot_custom_meta_slot_wheels', true) . '</td>';
        $ret .= '										</tr>';
        $ret .= '										<tr>';
        $ret .= '											<td>Slot Type:</td><td class="d-flex">';
        if ('Video' == get_post_meta($slotsID, 'slot_custom_meta_classic_video', true)) {
            $ret .= '												<span class="icon-video-camera lazy-background tooltip-span" data-toggle="tooltip" title="Video"></span>';
        } else {
            $ret .= '												<span class="icon-slots lazy-background tooltip-span" data-toggle="tooltip" title="Classic"></span>';
        };
        if (get_post_meta($slotsID, 'slot_custom_meta_jackpot_option', true)) {
            $ret .= '														, <span class="icon-jackpot lazy-background tooltip-span" data-toggle="tooltip" title="Jackpot"></span>';
        } else {
            $ret .= '';
        };
        if (get_post_meta($slotsID, 'slot_custom_meta_3d_option', true)) {
            $ret .= '														, <span class="icon-3d_rotation tooltip-span" data-toggle="tooltip" title="3D Slot"></span>';
        } else {
            $ret .= '';
        };
        $ret .= '													</td>';
        $ret .= '										</tr>';
        $ret .= '										<tr>';
        $ret .= '											<td>Paylines:</td><td>' . get_post_meta($slotsID, 'slot_custom_meta_slot_paylines', true) . '</td>';
        $ret .= '										</tr>';
        $ret .= '										<tr>';
        $ret .= '											<td>RTP:</td><td>' . $rtp . '</td>';
        $ret .= '										</tr>';
        $ret .= '										<tr>';
        $ret .= '											<td>Free Spins:</td><td>';
        if (get_post_meta($slotsID, 'slot_custom_meta_free_spins_option', true)) {
            $ret .= '														Yes';
        } else {
            $ret .= '														No';
        };
        $ret .= '										</td></tr>';
        $ret .= '										<tr>';
        $ret .= '											<td>Bonus Rounds:</td><td>';
        if (get_post_meta($slotsID, 'slot_custom_meta_bonus_rounds_option', true)) {
            $ret .= 'Yes';
        } else {
            $ret .= 'No';
        };
        $ret .= '										</td></tr>';
        $ret .= '									</table>';
        $ret .= '									<a href="' . get_post_meta($casinoID, 'casino_custom_meta_affiliate_link', true) . '" rel="nofollow" class="btn btn_tiny btn_yellow d-block cta play_button bumper font-weight-bold" data-casinoid="' . $casinoID . '" data-country="' . $localIso . '">Play in Casino</a>';
        $ret .= '								</div>';
        $ret .= '							</div>';
        $ret .= '						</section>';
        $ret .= '						<span class="offer-info" onclick="flip()"><i class="fa fa-info"></i><i class="fa fa-times"></i></span>';
        $ret .= '			</div>';
    }

    wp_reset_postdata();
    return $ret;
}
