<?php
function get_related_sg($currentID = 0, $postType = 'slot', $filterType = 'software')
{
    $metaPrefix = $postType; //slot for Slots and games for Games
    $post_type = $postType == 'slot' ? 'kss_slots' : 'kss_games';
    $limit = $postType == 'slot' ? 3 : 6;
    $soft = get_post_meta($currentID, $metaPrefix . '_custom_meta_slot_software', true);
    $query_array = array();

    if ($filterType == 'software') {
        $title = get_the_title($soft) . ' Slots';
        $query_array[] = array(
            'key' => $metaPrefix . '_custom_meta_slot_software',
            'value' => $soft,
            'compare' => 'LIKE',
        );
    } elseif ($filterType == 'best') {
        $title = 'Recommended Slots by Best50Casino';
        $query_array[] = array(
            'key' => $metaPrefix . '_custom_meta_label',
            'value' => 'BEST',
            'compare' => 'LIKE',
        );
    } else {
        $title = 'Recommended Games by Best50Casino';
    }

    $args = array(
        'post_type' => $post_type,
        'posts_per_page' => $limit,
        'post_status' => array('publish'),
        'numberposts' => $limit,
        'orderby' => 'rand',
        'post__not_in' => array($currentID),
        'meta_query' => array(
            'relation' => 'AND',
            $query_array,
        ),
    );
    $my_slot_loop = new WP_Query($args);

    $ret = '<div class=" inner_row more_games d-flex w-100 mb-10p flex-wrap">';
    $ret .= '    <div class="w-100">';
    if ($my_slot_loop->have_posts()) {
        $ret .= '<h3 class="star w-100">' . $title . '</h3>';
        $ret .= '	<div class="game_wrapper d-flex flex-wrap w-100">';
        foreach ($my_slot_loop->posts as $slots) {
            if ($postType == 'slot') {
                $casino = get_post_meta($slots->ID, $metaPrefix . '_custom_meta_slot_main_casino', true);
//                $score = get_post_meta($slots->ID, $metaPrefix . '_custom_meta_slot_value', true) / 20;
            }
            $ret .= '<div class="element-item ' . get_post_meta($slots->ID, $metaPrefix . '_custom_meta_slot_software', true) . ' " data-category="transition">';
            $ret .= '		<section class="containerz">';
            $ret .= '				<div class="card">';
            $ret .= '					<div class="front">';
            $ret .= '						<a href="' . get_the_permalink($slots->ID) . '">';
            $ret .= '							<figure class="m-0">';
            $ret .= '						<img class="game-image" loading="lazy" src="' . get_the_post_thumbnail_url($slots->ID) . '" alt="' . get_the_title($slots->ID) . '">';
            if (get_post_meta($slots->ID, $metaPrefix . '_custom_meta_label', true)) {
                if (in_array('LEGEND', get_post_meta($slots->ID, $metaPrefix . '_custom_meta_label', true))) {
                    $ret .= '    <div class="ribbon hot"><span>Legend</span></div>';
                } elseif (in_array('BEST', get_post_meta($slots->ID, $metaPrefix . '_custom_meta_label', true))) {
                    $ret .= '    <div class="ribbon premium"><span>Best</span></div>';
                } elseif (in_array('NEW', get_post_meta($slots->ID, $metaPrefix . '_custom_meta_label', true))) {
                    $ret .= '    <div class="ribbon new"><span>New</span></div>';
                }
            }
            $page = $postType == 'slot' ? get_post_meta($slots->ID, $metaPrefix . '_custom_meta_slot_software', true) : get_post_meta($slots->ID, $metaPrefix . '_custom_meta_games_main_casino', true);
//                $page = get_page_by_title(get_post_meta($slots->ID, $metaPrefix.'_custom_meta_slot_software' , true), OBJECT, 'kss_softwares');
            $imge_id = get_image_id_by_link(get_post_meta($page, 'casino_custom_meta_sidebar_icon', true));
            if ($postType == 'slot') {
                $ret .= '       <span class="software">' . wp_get_attachment_image($imge_id, 'sidebar-40', "", array("alt" => get_the_title($page)) ). '</span>';
            }
            $ret .= '							</figure>';
            if ($postType == 'slot') {
                $thisTitle = get_the_title($slots->ID);
            } else {
                $gameCat = get_post_meta($slots->ID, 'games_custom_meta_game_categ', true);
                $thisTitle = $gameCat[0];
            }
            $ret .= '							<span class="name">' . $thisTitle . '</span>';
//            if ($postType == 'slot') {
//                $ret .= '							<span class="rating">';
//                $ret .= '								<span class="star_rating">' . $score . '</span>';
//                $ret .= '							</span>';
//            }
            $ret .= '						</a>';
            $ret .= '					</div>';
            if ($postType == 'slot') {
                $ret .= '					<div class="back">';
                $ret .= '						<table>';
                $ret .= '							<tr>';
                $ret .= '								<td>Wheels:</td><td>' . get_post_meta($slots->ID, $metaPrefix . '_custom_meta_slot_wheels', true) . '</td>';
                $ret .= '							</tr>';
                $ret .= '							<tr>';
                $ret .= '								<td>Slot Type:</td><td class="d-flex">';
                if ('Video' == get_post_meta($slots->ID, $metaPrefix . '_custom_meta_classic_video', true)) {
                    $ret .= '<span class="icon-video-camera lazy-background tooltip-span" data-toggle="tooltip" title="Video"></span>';
                } else {
                    $ret .= '<span class="icon-slots lazy-background tooltip-span" data-toggle="tooltip" title="Classic"></span>';
                };
                if (get_post_meta($slots->ID, $metaPrefix . '_custom_meta_jackpot_option', true)) {
                    $ret .= ', <span class="icon-jackpot lazy-background tooltip-span" data-toggle="tooltip" title="Jackpot"></span>';
                } else {
                    $ret .= '';
                };
                if (get_post_meta($slots->ID, $metaPrefix . '_custom_meta_3d_option', true)) {
                    $ret .= ', <span class="icon-3d_rotation tooltip-span" data-toggle="tooltip" title="3D Slot"></span>';
                } else {
                    $ret .= '';
                };
                $ret .= '  </td>';
                $ret .= '							</tr>';
                $ret .= '							<tr>';
                $ret .= '								<td>Paylines:</td><td>' . get_post_meta($slots->ID, $metaPrefix . '_custom_meta_slot_paylines', true) . '</td>';
                $ret .= '							</tr>';
                $ret .= '							<tr>';
                $ret .= '								<td>RTP:</td><td>' . get_post_meta($slots->ID, $metaPrefix . '_custom_meta_rtp_perc', true) . '</td>';
                $ret .= '							</tr>';
                $ret .= '							<tr>';
                $ret .= '								<td>Free Spins:</td><td>';
                if (get_post_meta($slots->ID, $metaPrefix . '_custom_meta_free_spins_option', true)) {
                    $ret .= 'Yes';
                } else {
                    $ret .= 'No';
                }
                $ret .= '</td>';
                $ret .= '							</tr>';
                $ret .= '							<tr>';
                $ret .= '								<td>Bonus Rounds:</td><td>';
                if (get_post_meta($slots->ID, $metaPrefix . '_custom_meta_bonus_rounds_option', true)) {
                    $ret .= 'Yes';
                } else {
                    $ret .= 'No';
                }
                $ret .= '							</td>';
                $ret .= '							</tr>';
                $ret .= '						</table>';
                $ret .= '						<a href="' . get_post_meta($casino, 'casino_custom_meta_affiliate_link', true) . '" rel="nofollow" class="btn btn_tiny btn_yellow d-block w-100 font-weight-bold cta play_button">Play Now</a>';
                $ret .= '					</div>';
            }
            $ret .= '				</div>';
            $ret .= '			</section>';
            if ($postType == 'slot') {
                $ret .= '			<span class="offer-info" onclick="flip()"><i class="fa fa-info mt-3p"></i><i class="fa fa-times mt-3p"></i></span>';
            }
            $ret .= '		</div>';

        }
        $ret .= '</div>';
    }

    $ret .= '	</div>';
    $ret .= '	</div>';
    return $ret;
}