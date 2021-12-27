<?php
function slots_shortcode($atts){
    $atts = shortcode_atts(
        array(
            'layout' => 'sample',
            'break' => '',
            'sort_by' => 'default',
            'rtp' => '',
            'limit' => '-1',
            'title' => '',
            'slot_offset' => '',
            'label' => '',
            'platform' => '',
            'casino' => '',
            'casino_or' => '',
            'slot_category' => '',
            'themes' => '',
            'paylines' => '',
            'slot_not_in' => '',
            'slot_in' => '',
        ), $atts, 'slots' ) ;


    
    $query_slots = SlotsSharkodes::returnSlots($atts);

    $countryISO = $GLOBALS['countryISO'];
    $localIso =  $GLOBALS['visitorsISO']; //Αν η χωρα ειναι ενεργοποιημενη    $countryISO = $GLOBALS['countryISO'];
    $themeSettings = get_option('countries_enable_options');
    $isCountryEnabled = in_array($countryISO, $themeSettings['enabled_countries_iso'][0]) ? true : false;
    /*************************************** DEFAULT LAYOUT ********************************************/
    if ( 'default' == $atts['layout'] ){
        $ret = ' <div id="options" class="navbar-collapse collapse filter-options">
					<div class="option-set" data-group="type">
						<div class="button-group js-radio-button-group" data-filter-group="label">
							<button class="btn btn-default is-checked" data-filter="">Show All</button>
							<button class="btn btn-default" data-filter=".Netent">Netent</button>
							<button class="btn btn-default" data-filter=".Novomatic">Novomatic</button>
							<button class="btn btn-default" data-filter=".Microgaming">Microgaming</button>
							<button class="btn btn-default" data-filter=".EGT">EGT</button>
							<button class="btn btn-default" data-filter=".ELK.Studios">ELK Studios</button>
						</div>
					</div> 
				</div>
						
						<div class="isotope" >
							<div class="cont" >';
        if( !empty($query_slots) ):
            foreach ( $query_slots as $slots ) {
                $score = get_post_meta($slots, 'slot_custom_meta_slot_value', true)/20;
                $casino = get_post_meta($slots, 'slot_custom_meta_slot_main_casino' , true);
                $ret .= '<div class="'.$atts['break'].' element-item '.implode(" ", get_post_meta($slots, 'slot_custom_meta_label', true )).' '.get_post_meta($slots, 'slot_custom_meta_slot_software' , true).'" data-category="transition">';
                $ret .= '        		<section class="containerz">';
                $ret .= '					<div class="card">';
                $ret .= '						<div class="front">';
                $ret .= '		<a class="text-decoration-none" href="'. get_the_permalink($slots).'">';
                $ret .= '			<figure>';
                $ret .= '								<img loading="lazy" src="'.get_the_post_thumbnail_url($slots).'" alt="'.get_the_title($slots).'">';
                if ( get_post_meta($slots, 'slot_custom_meta_label' , true) ) {
                    if ( in_array( 'LEGEND' , get_post_meta($slots, 'slot_custom_meta_label' , true)) ){
                        $ret .= '						<div class="ribbon hot"><span>Legend</span></div>';
                    }elseif ( in_array( 'BEST' , get_post_meta($slots, 'slot_custom_meta_label' , true)) ){
                        $ret .= '						<div class="ribbon premium"><span>Best</span></div>';
                    }elseif ( in_array( 'NEW' , get_post_meta($slots, 'slot_custom_meta_label' , true)) ){
                        $ret .= '						<div class="ribbon new"><span>New</span></div>';
                    }
                }
                $page = get_post_meta($slots, 'slot_custom_meta_slot_software' , true);
                $imge_id = get_image_id_by_link(get_post_meta($page, 'casino_custom_meta_sidebar_icon', true));
                $ret .= '				<span class="software"><img class="attachment-sidebar-medium size-sidebar-medium" loading="lazy" src="'. wp_get_attachment_image_url($imge_id).'" alt="'.get_the_title($page).' width="30"></span>';
                $ret .= '			</figure>';
                $ret .= '			<span class="name">'. get_the_title($slots).'</span>';
                $ret .= '				<span class="rating">';
                $ret .= '					<span class="star-rating">'.$score.'</span>';
                $ret .= '				</span>';
                $ret .= '		</a>';
                $ret .= '	</div>';
                $ret .= '						<div class="back">';
                $ret .= '							<table>';
                $ret .= '										<tr>';
                $ret .= '											<td>Wheels:</td><td>'.get_post_meta($slots, 'slot_custom_meta_slot_wheels', true).'</td>';
                $ret .= '										</tr>';
                $ret .= '										<tr>';
                $ret .= '											<td>Slot Type:</td><td>';
                if ( 'Video' == get_post_meta($slots, 'slot_custom_meta_classic_video', true) ) {
                    $ret .= '												<span class="icon-video-camera lazy-background  tooltip-span" data-toggle="tooltip" title="Video"></span>';
                }else{
                    $ret .= '												<span class="icon-slots lazy-background  tooltip-span" data-toggle="tooltip" title="Classic"></span>';
                };
                if (get_post_meta($slots, 'slot_custom_meta_jackpot_option', true)) {
                    $ret .= '														, <span class="icon-jackpot lazy-background tooltip-span" data-toggle="tooltip" title="Jackpot"></span>';
                }else{
                    $ret .= '';
                };
                if (get_post_meta($slots, 'slot_custom_meta_3d_option', true)) {
                    $ret .= '														, <span class="icon-3d_rotation  tooltip-span" data-toggle="tooltip" title="3D Slot"></span>';
                }else{
                    $ret .= '';
                };
                $ret .= '													</td>';
                $ret .= '										</tr>';
                $ret .= '										<tr>';
                $ret .= '											<td>Paylines:</td><td>'.get_post_meta($slots, 'slot_custom_meta_slot_paylines', true).'</td>';
                $ret .= '										</tr>';
                $ret .= '										<tr>';
                $ret .= '											<td>RTP:</td><td>'.get_post_meta($slots, 'slot_custom_meta_rtp_perc', true).'</td>';
                $ret .= '										</tr>';
                $ret .= '										<tr>';
                $ret .= '											<td>Free Spins:</td><td>';
                if ( get_post_meta($slots, 'slot_custom_meta_free_spins_option', true)) {
                    $ret .= '														Yes';
                }else{
                    $ret .= '														No';
                };
                $ret .= '										</td></tr>';
                $ret .= '										<tr>';
                $ret .= '											<td>Bonus Rounds:</td><td>';
                if ( get_post_meta($slots, 'slot_custom_meta_bonus_rounds_option', true)) {
                    $ret .= 'Yes';
                }else{
                    $ret .= 'No';
                };
                $ret .= '										</td></tr>';
                $ret .= '									</table>';
                $ret .= '									<a href="'.get_post_meta($casino, 'casino_custom_meta_affiliate_link', true).'" rel="nofollow" class="btn btn_tiny btn_yellow text-decoration-none cta play_button bumper" data-casinoid="'.$casino.'" data-country="'.$localIso.'">Play Now</a>';
                $ret .= '								</div>';
                $ret .= '							</div>';
                $ret .= '						</section>';
                $ret .= '						<span class="offer-info" onclick="flip()"><i class="fa fa-info"></i><i class="fa fa-times"></i></span>';
                $ret .= '			</div>';
            }
        endif;
        wp_reset_postdata();
        $ret .= '</div>
						</div>';

    }elseif( 'sample' == $atts['layout'] ) {
        $ret = '<div class="inner_row more_games mb-10p">';
        $ret .= '	<div class="">';
        $ret .= '		<span class="star slots">' . $atts['title'] . '</span>';
        $ret .= '		<div class="game_wrapper d-flex flex-wrap">';
        if (!empty($query_slots)):
            foreach ($query_slots as $slots) {
                $score = get_post_meta($slots, 'slot_custom_meta_slot_value', true) / 20;
                $casino = get_post_meta($slots, 'slot_custom_meta_slot_main_casino', true);
                $widthClass = $atts['break']=='small' ? 'w-24' : 'w-32';
                $ret .= '			<div class="' . $widthClass . ' element-item revealOnScroll" data-animation="zoomIn" data-category="transition">';
                $ret .= '        		<section class="containerz">';
                $ret .= '					<div class="card">';
                $ret .= '						<div class="front">';
                $ret .= '							<a class="text-decoration-none" href="' . get_the_permalink($slots) . '">';
                $ret .= '							<figure class="m-0">';
                $ret .= '								<img loading="lazy" src="' . get_the_post_thumbnail_url($slots) . '" alt="' . get_the_title($slots) . '">';
                if (get_post_meta($slots, 'slot_custom_meta_label', true)) {
                    if (in_array('LEGEND', get_post_meta($slots, 'slot_custom_meta_label', true))) {
                        $ret .= '								<div class="ribbon hot"><span>Legend</span></div>';
                    } elseif (in_array('BEST', get_post_meta($slots, 'slot_custom_meta_label', true))) {
                        $ret .= '								<div class="ribbon premium"><span>Best</span></div>';
                    } elseif (in_array('NEW', get_post_meta($slots, 'slot_custom_meta_label', true))) {
                        $ret .= '								<div class="ribbon new"><span>New</span></div>';
                    }
                }
                $page = get_post_meta($slots, 'slot_custom_meta_slot_software', true);
                $imge_id = get_post_meta($page, 'casino_custom_meta_sidebar_icon', true);
                $ret .= '<span class="software"><img class="attachment-sidebar-medium size-sidebar-medium" src="' .$imge_id . '" alt="' . get_the_title($page) . '" loading="lazy" width="30"></span>';
//	$ret .= '					<span class="software"><img width="30" height="30" class="attachment-sidebar-medium size-sidebar-medium" src="'. wp_get_attachment_image_url($imge_id, 'sidebar-medium').'" alt="'.get_the_title($page->ID).'></span>';

                //$ret .= '								<span class="software">'. get_the_post_thumbnail($page->ID, 'sidebar-medium').'</span>';
                $ret .= '							</figure>';
                $ret .= '							<span class="name">' . get_the_title($slots) . '</span>';
                $ret .= '							<span class="rating">';
                $ret .= '								<span class="star-rating">' . $score . '</span>';
                $ret .= '							</span>';
                $ret .= '							</a>';
                $ret .= '						</div>';
                $ret .= '						<div class="back">';
                $ret .= '							<table class="w-100 tetx-14">';
                $ret .= '										<tr>';
                $ret .= '											<td>Wheels:</td><td>' . get_post_meta($slots, 'slot_custom_meta_slot_wheels', true) . '</td>';
                $ret .= '										</tr>';
                $ret .= '										<tr>';
                $ret .= '											<td>Slot Type:</td><td class="d-flex">';
                if ('Video' == get_post_meta($slots, 'slot_custom_meta_classic_video', true)) {
                    $ret .= '<span class="icon-video-camera lazy-background tooltip-span" data-toggle="tooltip" title="Video"></span>';
                } else {
                    $ret .= '<span class="icon-slots lazy-background tooltip-span" data-toggle="tooltip" title="Classic"></span>';
                };
                if (get_post_meta($slots, 'slot_custom_meta_jackpot_option', true)) {
                    $ret .= ', <span class="icon-jackpot lazy-background tooltip-span" data-toggle="tooltip" title="Jackpot"></span>';
                } else {
                    $ret .= '';
                }
                if (get_post_meta($slots, 'slot_custom_meta_3d_option', true)) {
                    $ret .= ', <span class="icon-3d_rotation tooltip-span" data-toggle="tooltip" title="3D Slot"></span>';
                } else {
                    $ret .= '';
                }
                $ret .= '													</td>';
                $ret .= '										</tr>';
                $ret .= '										<tr>';
                $ret .= '											<td>Paylines:</td><td>' . get_post_meta($slots, 'slot_custom_meta_slot_paylines', true) . '</td>';
                $ret .= '										</tr>';
                $ret .= '										<tr>';
                $ret .= '											<td>RTP:</td><td>' . get_post_meta($slots, 'slot_custom_meta_rtp_perc', true) . '</td>';
                $ret .= '										</tr>';
                $ret .= '										<tr>';
                $ret .= '											<td>Free Spins:</td><td>';
                if (get_post_meta($slots, 'slot_custom_meta_free_spins_option', true)) {
                    $ret .= '														Yes';
                } else {
                    $ret .= '														No';
                };
                $ret .= '										</td></tr>';
                $ret .= '										<tr>';
                $ret .= '											<td>Bonus Rounds:</td><td>';
                if (get_post_meta($slots, 'slot_custom_meta_bonus_rounds_option', true)) {
                    $ret .= 'Yes';
                } else {
                    $ret .= 'No';
                };
                $ret .= '										</td></tr>';
                $ret .= '									</table>';
                $ret .= '									<a href="' . get_post_meta($casino, 'casino_custom_meta_affiliate_link', true) . '" rel="nofollow" class="btn btn_tiny btn_yellow cta text-decoration-none d-block font-weight-bold play_button bumper" data-casinoid="' . $casino . '" data-country="' . $localIso . '">Play in Casino</a>';
                $ret .= '								</div>';
                $ret .= '							</div>';
                $ret .= '						</section>';
                $ret .= '						<span class="offer-info"><i class="fa fa-info mt-3p"></i><i class="fa fa-times"></i></span>';
                $ret .= '			</div>';
            }
        endif;
        wp_reset_postdata();
        $ret .= '		</div>';
        $ret .= '	</div>';
        $ret .= '</div>';



    }elseif( 'sidebar' == $atts['layout'] ){
        $ret = '<div class="top_casinos_list games">';
        $ret .= '			<ul class="nav nav-pills">';
        $ret .= '				<li class="active"><a href="#slot_table-1" data-toggle="tab">Play for Free</a></li>';
        $ret .= '				<li><a href="#slot_table-2" data-toggle="tab">Play with Real Money</a></li>';
        $ret .= '			</ul>';	$ret .= ' <div class="tab-content clearfix">';
        $ret .= '			<div class="tab-pane active" id="slot_table-1">';
        $ret .= '				<ul>';
        if( !empty($query_slots) ):
            foreach ( $query_slots as $slots ) {
                $ret .= '				<li>';
                $ret .= '					<div class="el">';
                $ret .= '						<a href="'.get_the_permalink($slots).'" title="Permalink to '.get_the_title($slots).'" rel="bookmark">'.get_the_post_thumbnail($slots, 'sidebar-lg').'</a>';
                $ret .= '					</div>';
                $ret .= '					<div class="el"><div class="casino_details">';
                $ret .= '						<a href="'.get_the_permalink($slots).'">'.get_the_title($slots).'</a>';
                //								$softwa_ = get_page_by_title(get_post_meta($slots, 'slot_custom_meta_slot_software' , true), OBJECT, 'kss_softwares');
                //$ret .= '						<img class="img-responsive" src="'.get_the_post_thumbnail_url($softwa_->ID, 'shortcode-small').'" alt="'.$softwa_->post_name.'" data-toggle="tooltip" title="'.$softwa_->post_name.'">';
                //$ret .= '						<span class="software">'.get_post_meta($slots ,'slot_custom_meta_slot_software', true).'</span>';
                $ret .= '					</div></div>';
                $ret .= '					<div class="el"><a href="'.get_the_permalink($slots).'" class="btn btn_tiny btn_black play_button">Demo</a></div>';
                $ret .= '				</li>';
            }
        endif;
        wp_reset_postdata();
        $ret .= '			</ul>';
        $ret .= '			</div>';
        $ret .= '			<div class="tab-pane" id="slot_table-2">';
        $ret .= '				<ul>';
        if( !empty($query_slots) ):
            foreach ( $query_slots as $slots ) {
                $ret .= '				<li>';
                $ret .= '					<div class="el">';
                $ret .= '						<a href="'.get_the_permalink($slots).'" title="Permalink to '.get_the_title($slots).'" rel="bookmark">'.get_the_post_thumbnail($slots, 'sidebar-lg').'</a>';
                $ret .= '					</div>';
                $ret .= '					<div class="el"><div class="casino_details">';
                $ret .= '						<a href="'.get_the_permalink($slots).'">'.get_the_title($slots).'</a>';
                //								$softwa_ = get_page_by_title(get_post_meta($slots, 'slot_custom_meta_slot_software' , true), OBJECT, 'kss_softwares');
                //$ret .= '						<img class="img-responsive" src="'.get_the_post_thumbnail_url($softwa_->ID, 'shortcode-small').'" alt="'.$softwa_->post_name.'" data-toggle="tooltip" title="'.$softwa_->post_name.'">';

                //$ret .= '						<span class="software">'.get_post_meta($slots ,'slot_custom_meta_slot_software', true).'</span>';
                $ret .= '					</div></div>';
                $page = get_post_meta($slots, 'slot_custom_meta_slot_main_casino' , true);
                $ret .= '					<div class="el"><a href="'.get_post_meta($page ,'casino_custom_meta_affiliate_link', true).'" class="btn btn_tiny btn_yellow play_button btn_border bumper" data-casinoid="'.$page.'" data-country="'.$localIso.'">VISIT</a></div>';
                $ret .= '				</li>';
            }
        endif;
        wp_reset_postdata();
        $ret .= '				</ul>';
        $ret .= '			</div>';	$ret .= '		</div>';
        $ret .= '		</div>';
    }elseif( 'power-page' == $atts['layout'] ){
        $ret = '<div class="isotope" >';
        //$ret .= '	<div class="cont" >';
        if( !empty($query_slots) ):

            foreach($query_slots as $slots)
                $score = get_post_meta($slots, 'slot_custom_meta_slot_value', true)/20;
                $post_id = $slots;
                $casino = get_post_meta($post_id, 'slot_custom_meta_slot_main_casino' , true);
                if(get_post_meta($post_id, 'slot_custom_meta_label', true )){
                    $meta_label = implode(" ", get_post_meta($post_id, 'slot_custom_meta_label', true ));
                }
                $jackpot_option = get_post_meta($post_id, 'slot_custom_meta_jackpot_option', true) ? 'Jackpot' : '' ;
                $vid_clas_option = get_post_meta($post_id, 'slot_custom_meta_classic_video', true);
                $three_d_option = get_post_meta($post_id, 'slot_custom_meta_3d_option', true) ? '3D' : '' ;
                $rtp = get_post_meta($post_id, 'slot_custom_meta_rtp_perc', true);
                $rtpFilter = (int)str_replace("%","",$rtp) >= 95 ? 'bestRTP' : '';
                if(get_post_meta($post_id, 'slot_custom_meta_slot_theme', true )){
                    $theme = implode(" ", get_post_meta($post_id, 'slot_custom_meta_slot_theme', true ));
                }
                $ret .= '		<div class="'.$atts['break'].' element-item '.$meta_label.' '.$rtpFilter.' '.get_post_meta($post_id, 'slot_custom_meta_slot_software' , true).' '.$jackpot_option.' '.$vid_clas_option.' '.$three_d_option.' '.$theme.'" data-filter="'.get_post_meta($post_id, 'slot_custom_meta_slot_software' , true).' '.$meta_label.' '.$rtpFilter.' '.$jackpot_option.' '.$vid_clas_option.' '.$three_d_option.' '.$theme.'" data-category="transition">';
                $ret .= '        		<section class="containerz">';
                $ret .= '					<div class="card">';
                $ret .= '						<div class="front">';
                $ret .= '			<a href="'.get_the_permalink().'">';
                $ret .= '				<figure>';
                $ret .= '								<img loading="lazy" src="'.get_the_post_thumbnail_url($slots).'" alt="'.get_the_title($slots).'">';
                if ( get_post_meta($slots, 'slot_custom_meta_label' , true) ) {
                    if ( in_array( 'LEGEND' , get_post_meta($slots, 'slot_custom_meta_label' , true)) ){
                        $ret .= '						<div class="ribbon hot"><span>Legend</span></div>';
                    }elseif ( in_array( 'BEST' , get_post_meta($slots, 'slot_custom_meta_label' , true)) ){
                        $ret .= '						<div class="ribbon premium"><span>Best</span></div>';
                    }elseif ( in_array( 'NEW' , get_post_meta($slots, 'slot_custom_meta_label' , true)) ){
                        $ret .= '						<div class="ribbon new"><span>New</span></div>';
                    }
                }
                $page = get_page_by_title(get_post_meta($post_id, 'slot_custom_meta_slot_software' , true), OBJECT, 'kss_softwares');
                $imge_id = get_image_id_by_link(get_post_meta($page, 'casino_custom_meta_sidebar_icon', true));
                $ret .= '				<span class="software">'. wp_get_attachment_image($imge_id, 'sidebar-medium', "", array("alt"=>get_the_title($page))).'</span>';
                //$ret .= '					<span class="software">'.get_the_post_thumbnail($page->ID, 'sidebar-medium').'</span>';
                $ret .= '				</figure>';
                $ret .= '				<span class="name">'.get_the_title($post_id).'</span>';
                $ret .= '							<span class="rating">';
                $ret .= '								<span class="star-rating">'.$score.'</span>';
                $ret .= '							</span>';
                $ret .= '							</a>';
                $ret .= '						</div>';
                $ret .= '						<div class="back">';
                $ret .= '							<table>';
                $ret .= '										<tr>';
                $ret .= '											<td>Wheels:</td><td>'.get_post_meta($post_id, 'slot_custom_meta_slot_wheels', true).'</td>';
                $ret .= '										</tr>';
                $ret .= '										<tr>';
                $ret .= '											<td>Slot Type:</td><td>';
                if ( 'Video' == get_post_meta($post_id, 'slot_custom_meta_classic_video', true) ) {
                    $ret .= '												<span class="icon-video-camera lazy-background tooltip-span" data-toggle="tooltip" title="Video"></span>';
                }else{
                    $ret .= '												<span class="icon-slots lazy-background tooltip-span" data-toggle="tooltip" title="Classic"></span>';
                }
                if (get_post_meta($post_id, 'slot_custom_meta_jackpot_option', true)) {
                    $ret .= '														, <span class="icon-jackpot lazy-background tooltip-span" data-toggle="tooltip" title="Jackpot"></span>';
                }else{
                    $ret .= '';
                }
                if (get_post_meta($post_id, 'slot_custom_meta_3d_option', true)) {
                    $ret .= '														, <span class="icon-3d_rotation tooltip-span" data-toggle="tooltip" title="3D Slot"></span>';
                }else{
                    $ret .= '';
                }
                $ret .= '													</td>';
                $ret .= '										</tr>';
                $ret .= '										<tr>';
                $ret .= '											<td>Paylines:</td><td>'.get_post_meta($post_id, 'slot_custom_meta_slot_paylines', true).'</td>';
                $ret .= '										</tr>';
                $ret .= '										<tr>';
                $ret .= '											<td>RTP:</td><td>'.$rtp.'</td>';
                $ret .= '										</tr>';
                $ret .= '										<tr>';
                $ret .= '											<td>Free Spins:</td><td>';
                if ( get_post_meta($post_id, 'slot_custom_meta_free_spins_option', true)) {
                    $ret .= '														Yes';
                }else{
                    $ret .= '														No';
                }
                $ret .= '										</td></tr>';
                $ret .= '										<tr>';
                $ret .= '											<td>Bonus Rounds:</td><td>';
                if ( get_post_meta($post_id, 'slot_custom_meta_bonus_rounds_option', true)) {
                    $ret .= 'Yes';
                }else{
                    $ret .= 'No';
                }
                $ret .= '										</td></tr>';
                $ret .= '									</table>';
                $ret .= '									<a href="'.get_post_meta($casino, 'casino_custom_meta_affiliate_link', true).'" rel="nofollow" class="btn btn_tiny btn_yellow cta play_button bumper" data-casinoid="'.$casino.'" data-country="'.$localIso.'" >Play in Casino</a>';
                $ret .= '								</div>';
                $ret .= '							</div>';
                $ret .= '						</section>';
                $ret .= '						<span class="offer-info" onclick="flip()"><i class="fa fa-info"></i><i class="fa fa-times"></i></span>';
                $ret .= '			</div>';


        endif;

        wp_reset_postdata();
        //$ret .= '	</div>';
        $ret .= '</div>';
    }
    return $ret;

}

add_shortcode('slots','slots_shortcode');
?>