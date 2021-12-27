<?php 
function games_shortcode($atts){
	$atts = shortcode_atts( 
	array(
		'layout' => 'sample',
		'break' => '5',
		'sort_by' => 'default',
		'limit' => '-1',
		'title' => '', 
		'slot_offset' => '',
		'platform' => '',
		'casino' => '',
		'games_in' => '',
		'games_not_in' => '',
    ), $atts, 'games' ) ;
	
	
	/* $break = 
	 */
	
	switch ($atts['sort_by']){
		case 'default':
			$sort_by = '';
			$sort_val = '';
			break;
		case 'random':
			$sort_by = 'rand';
			$sort_val = '';
			break;
		case 'popular':
			$sort_by = 'meta_value_num';
			$sort_val = 'games_custom_meta_slot_value';
			break;
	}
	$query_array = array();
	if ($atts['platform']){
		$query_array[] = array(
            'key'     => 'games_custom_meta_slot_software',
            'value'   => $atts['platform'],
			'compare' => 'LIKE',
		);
	}
	if ($atts['casino']){
		$query_array[] = array(
            'key'     => 'games_custom_meta_slot_main_casino',
            'value'   => $atts['casino'],
			'compare' => 'LIKE',
		);
	}
	if ($atts['games_in']){
		$initas = explode(',',$atts['games_in']);
	}
	if ($atts['games_not_in']){
		$query_array[] = array(
            'key'     => 'games_custom_meta_game_categ',
            'value'   => $atts['games_not_in'],
			'compare' => 'NOT LIKE',
		);
	}
	
$query_slot = array( // A QUERY that initializes the default (all) IDS
	'post_type'      => array('kss_games'),
	'post_status'    => array('publish'),
	'posts_per_page' => $atts['limit'],
	'orderby'   => $sort_by,
	'meta_key'  => $sort_val,
	'post__in'   => $initas,
	'offset' => $atts['slot_offset'],
	'suppress_filters' => true,
	'meta_query' => array(
		'relation' => 'AND',
		$query_array
	),
);
$query_slots = new WP_Query( $query_slot ); 

/*************************************** DEFAULT LAYOUT ********************************************/
if( 'sample' == $atts['layout'] ){
	$ret = '<div class="row inner_row more_games">';
	$ret .= '	<div class="col-sm-12" style="padding-left:5px;padding-right:5px;">';
	if ($atts['title']){
		$ret .= '		<h2 class="star"><span>'.$atts['title'].'</span></h3>';
	}
		
	$ret .= '		<div class="game_wrapper">';
				if( $query_slots->have_posts() ):
					foreach ( $query_slots->posts as $slots ) {
	$ret .= '			<div class="element-item '.get_post_meta($slots->ID, 'games_custom_meta_label' , true).'" data-category="transition">';
	$ret .= '				<a href="'. get_the_permalink($slots->ID).'">';
	$ret .= '			<figure>';
	$ret .= '				<img class="game-image" src="'.get_the_post_thumbnail_url($slots->ID).'" alt="">';
							if ( get_post_meta($slots->ID, 'games_custom_meta_label' , true) == 'NEW' ){ 
	$ret .= '						<div class="ribbon new"><span>NEW</span></div>';
							}elseif ( get_post_meta($slots->ID, 'games_custom_meta_label' , true) == 'HOT' ){
	$ret .= '						<div class="ribbon hot"><span>HOT</span></div>';
							}elseif ( get_post_meta($slots->ID, 'games_custom_meta_label' , true) == 'PREMIUM' ){
	$ret .= '						<div class="ribbon premium"><span>PREMIUM</span></div>';
							} 
	$ret .= '							<span class="mobile"><i class="fa fa-mobile"></i></span>';
							$page = get_page_by_title(get_post_meta($slots->ID, 'games_custom_meta_slot_software' , true), OBJECT, 'kss_softwares');
							$imge_id = get_image_id_by_link(get_post_meta($page->ID, 'casino_custom_meta_sidebar_icon', true));
	$ret .= '				<span class="software">'. wp_get_attachment_image($imge_id, 'sidebar-40').'</span>';
	$ret .= '					</figure>';
	$ret .= '					<h3 class="name">'. get_the_title($slots->ID).'</h3>';
	$ret .= '					<div class="rating">';
	$ret .= '						<i class="fa active fa-star"></i>';
	$ret .= '						<i class="fa active fa-star"></i>';
	$ret .= '						<i class="fa active fa-star"></i>';
	$ret .= '						<i class="fa fa-star"></i>';
	$ret .= '						<i class="fa fa-star"></i>';
	$ret .= '					</div>';
	$ret .= '				</a>';
	$ret .= '			</div>';
				}
				endif;
			wp_reset_postdata();
	$ret .= '		</div>';
	$ret .= '	</div>';
	$ret .= '</div>';
}elseif( 'sidebar' == $atts['layout'] ){
	$ret = '<div class="top_casinos_list games">';
	$ret .= '		<ul class="nav nav-pills">';
	$ret .= '			<li class="active"><a href="#game_table-1"  data-toggle="tab">Play for Free</a></li>';
	$ret .= '			<li><a href="#game_table-2"  data-toggle="tab">Play for Real</a></li>';
	$ret .= '		</ul>';	$ret .= ' <div class="tab-content clearfix">';
	$ret .= '			<div class="tab-pane active" id="game_table-1">';
	$ret .= '				<ul>';
				if( $query_slots->have_posts() ):
					foreach ( $query_slots->posts as $slots ) {
	$ret .= '				<li>';
	$ret .= '					<div class="el">';
	//$ret .= '						<a href="'.get_permalink($slots->ID).'" title="Permalink to '.$slots->post_name.'" rel="bookmark">'.get_the_post_thumbnail($slots->ID, 'sidebar-lg').'</a>';
	$ret .= '						<a href="'.get_permalink($slots->ID).'" title="Permalink to '.$slots->post_name.'" rel="bookmark">'.get_post_meta($slots->ID, 'games_custom_meta_icon', true).'</a>';
	$ret .= '					</div>';
	$ret .= '					<div class="el"><div class="casino_details"><div class="game-title">'.$slots->post_title.'</div>';
	//$ret .= '						<a href="'.get_permalink($slots->ID).'">'.$slots->post_title.'</a>';
	$ret .= '							<div class="text-links-grp">'; 
	//								$softwa_ = get_page_by_title(get_post_meta($slots->ID, 'games_custom_meta_slot_software' , true), OBJECT, 'kss_softwares'); games_custom_meta_text_link_1
	//$ret .= '						<img class="img-responsive" src="'.get_the_post_thumbnail_url($softwa_->ID).'" alt="'.$softwa_->post_name.'" data-toggle="tooltip" title="'.$softwa_->post_name.'" width="30" height="30">';
	//$ret .= '						<span class="software">'.get_post_meta($slots->ID ,'games_custom_meta_slot_software', true).'</span>';
	$text_1 = get_post_meta($slots->ID, 'games_custom_meta_text_link_1', true);
	$text_2 = get_post_meta($slots->ID, 'games_custom_meta_text_link_2', true);
	if ($text_1 ){
	$ret .= '						<a href="'.get_post_meta($slots->ID, 'games_custom_meta_link_1', true).'" class="text-links">'.$text_1.'</a>';
	}
		if ($text_1 && $text_2){
			$ret .= ' | ';
		}
		if ($text_2 ){
	$ret .= '							<a href="'.get_post_meta($slots->ID, 'games_custom_meta_link_2', true).'" class="text-links">'.$text_2.'</a>';
	}
	$ret .= '					</div></div></div>';
	$ret .= '					<div class="el"><a href="'.get_permalink($slots->ID).'" class="btn btn_tiny btn_black play_button">Demo</a></div>';
	$ret .= '				</li>';
				}
				endif;
			wp_reset_postdata();
	$ret .= '			</ul>';
	$ret .= '			</div>';
	$ret .= '			<div class="tab-pane" id="game_table-2">';
	$ret .= '				<ul>';
				if( $query_slots->have_posts() ):
					foreach ( $query_slots->posts as $slots ) {
	$ret .= '				<li>';
	$ret .= '					<div class="el">';
	$ret .= '						<a href="'.get_permalink($slots->ID).'" title="Permalink to '.$slots->post_name.'" rel="bookmark">'.get_post_meta($slots->ID, 'games_custom_meta_icon', true).'</a>';
	$ret .= '					</div>';
	$ret .= '					<div class="el"><div class="casino_details"><div class="game-title">'.$slots->post_title.'</div>';
	$text_1 = get_post_meta($slots->ID, 'games_custom_meta_text_link_1', true);
	$text_2 = get_post_meta($slots->ID, 'games_custom_meta_text_link_2', true);
	if ($text_1 ){
	$ret .= '						<a href="'.get_post_meta($slots->ID, 'games_custom_meta_link_1', true).'" class="text-links">'.$text_1.'</a>';
	}
		if ($text_1 && $text_2){
			$ret .= ' | ';
		}
		if ($text_2 ){
	$ret .= '							<a href="'.get_post_meta($slots->ID, 'games_custom_meta_link_2', true).'" class="text-links">'.$text_2.'</a>';
	}
	$ret .= '					</div></div>';
								$page = get_page_by_title(get_post_meta($slots->ID, 'games_custom_meta_slot_software' , true), OBJECT, 'kss_softwares');
	$ret .= '					<div class="el"><a href="'.get_post_meta($slots->ID ,'games_custom_meta_affiliate_link', true).'" class="btn btn_tiny btn_yellow play_button">Visit</a></div>';
	$ret .= '				</li>';
				}
				endif;
			wp_reset_postdata();
	$ret .= '				</ul>';
	$ret .= '			</div>';	$ret .= '			</div>';
	$ret .= '		</div>';
}elseif( 'power-page' == $atts['layout'] ){
	$ret = '<div class="isotope" >';
	$ret .= '	<div class="cont" >';
	if( $query_slots->have_posts() ):

		while ( $query_slots->have_posts() ) : $query_slots->the_post();  
			$score = get_post_meta(get_the_id(), 'games_custom_meta_slot_value', true)/20; 
			$post_id = get_the_id();
	$ret .= '		<div class="element-item '.get_post_meta($post_id, 'games_custom_meta_label' , true).' '.get_post_meta(get_the_id(), 'games_custom_meta_slot_software' , true).'" data-category="transition">';
	$ret .= '			<a href="'.get_the_permalink().'">';
	$ret .= '				<figure>';
	$ret .= '					<img class="game-image" src="'.get_the_post_thumbnail_url().'" alt="">';
						if ( get_post_meta($post_id, 'games_custom_meta_label' , true) == 'NEW' ){
	$ret .= '							<div class="ribbon new"><span>NEW</span></div>';
						}elseif ( get_post_meta($post_id, 'games_custom_meta_label' , true) == 'HOT' ){
	$ret .= '							<div class="ribbon hot"><span>Δημοφιλή</span></div>';
						}elseif ( get_post_meta($post_id, 'games_custom_meta_label' , true) == 'PREMIUM' ){
	$ret .= '							<div class="ribbon premium"><span>BEST</span></div>';
						}
	$ret .= '					<span class="mobile"><i class="fa fa-mobile"></i></span>';
						$page = get_page_by_title(get_post_meta($post_id, 'games_custom_meta_slot_software' , true), OBJECT, 'kss_softwares'); 
	$ret .= '					<span class="software">'.get_the_post_thumbnail($page->ID).'</span>';
	$ret .= '				</figure>';
	$ret .= '				<h3 class="name">'.get_the_title($post_id).'</h3>';
	$ret .= '				<div class="rating">';
	$ret .= '					<div class="star_rating">'.$score.'</div>';
	$ret .= '				</div>';
	$ret .= '			</a>';
	$ret .= '		</div>';
		endwhile;

	endif;

	wp_reset_postdata();
	$ret .= '	</div>';
	$ret .= '</div>';
}
return $ret;

}
	
add_shortcode('games','games_shortcode');
?>