<?php 

function single_slot_shortcode($atts){
	//$companies = '';
	//$ret='';
	$atts = shortcode_atts( 
	array(
		'layout' => 'horizontal',
		), $atts, 'sslot' ) ;
	
	global $post;
	foreach (get_the_terms($post->ID, 'f7_brands') as $term){
		$brand = $term->name;
	}
	
	$query_default = array( // A QUERY that initializes the default (all) IDS
		'post_type'      => array('kss_casino'),
		'post_status'    => array('publish'),
		'posts_per_page' => -1,
		'numberposts'	 => -1,
	);
	$query_defaults = new WP_Query( $query_default ); 
	
	foreach ($query_defaults->posts as $main_casinos){
		if ($main_casinos->post_title == get_post_meta($post->ID, 'main_casino_for_slot', true)){
			$casino_id=$main_casinos->ID;
			$casino_name=$main_casinos->post_title;
		}
		if(get_post_meta($post->ID, 'main_casino_for_slot', true) == 'None' ){
			$casino_id = 90;
		}
	}
	/* <i class="fa fa-arrows-alt" aria-hidden="true"></i>
	<i class="fa fa-mobile" aria-hidden="true"></i> */
//
	
	$ret = '<div class="slot-flash-container">';
	$ret .= '<div class="upper"><div class="rating">'.$post->post_title.'<span class="star-votes">[yasr_visitor_votes post_id='.$post->ID.' size=small allowvote=true]</span></div><div class="social"><img src="http://www.froytakia777.gr/wp-content/uploads/2017/01/share.png">[Sassy_Social_Share count="1"]</div></div>';	
	$ret .= '<div class="slot-flash-main"><div class="slot-flash-game">'.get_post_meta($post->ID,'slot_script',true).'</div>
	
	<span class="casino-top-but"><span class="casino-title">Θες να παίξεις το '.$post->post_title.' σε πλήρη οθόνη;<span class="casino-title-img"><a rel="nofollow" target="_blank" href="'.get_post_meta($post->ID,'slot_link',true).'"><i class="fa fa-arrows-alt" aria-hidden="true"></i></a></span></span>
	<span class="casino-title">Θες να παίξεις το '.$post->post_title.' σε Mobile ή Tablet;<span class="casino-title-img"><a rel="nofollow" target="_blank" href="'.get_post_meta($post->ID,'slot_link',true).'"><i class="fa fa-mobile" aria-hidden="true"></i></a></span></span>
	</span>
	<span class="slot-rel-title">Παρόμοια Φρουτάκια</span><div class="slot-flash-related"><span class="sl-related"><span>'.get_slots_list().'</span></div>';	
	$ret .= '<div class="under" style="width: 67%;"><table class="casino-table"><tr><td><a rel="nofollow" target="_blank" href="'.get_permalink( $casino_id ).'">'.get_the_post_thumbnail($casino_id, array( 200, 66)).'</a><span class="review"><a href="'.get_permalink( $casino_id ).'">Αξιολόγηση Casino</a></span></td><td><span class="promo-text"><a rel="nofollow" target="_blank" style="color: white;" href="'.get_post_meta($casino_id,'slot_script',true).'">'.get_post_meta($casino_id,'casino_custom_meta_promo_details',true).'</a></span></td><td><span class="play-real"><a href="'.get_post_meta($casino_id,'affiliate_url_for_cta',true).'">Παίξε με Πραγματικά Χρήματα!</a></span>';	
	//$ret .= '<span class="lady"><img src="http://www.froytakia777.gr/wp-content/uploads/2016/11/ladyr.png"></span>';
	$ret .= '</td></tr></table></div></div>';	
	$ret .= '</div>';	
	$ret .= '';	
	$ret .= '';	
	
	if ($atts['layout'] == 'info'){
		
		$slot_options = array();
        if( have_rows('slot_options') ) :
         while(have_rows('slot_options')) : the_row();
          array_push($slot_options, array(
            'key' => get_sub_field('key'),
            'value' => get_sub_field('value')
          ));
        endwhile; endif;
	
        if($slot_options) :
         $ret = '<div class="slot-info">
            <table class="slot-info-table"><tr><th colspan="2" id="header">Πίνακας Παιχνιδιού</th></tr>';
            foreach ($slot_options as $option) :
             $ret .= '<tr><td style="width:50%;border-right:1px solid;">'.$option["key"].'</th> <td style="width:50%">'.$option["value"].'</td></tr>';
            endforeach;
           $ret .= ' </table>
          </div>';
        endif; 

		$ret .= '';	
		$ret .= '';	
		$ret .= '';	
		$ret .= '';	
		$ret .= '';	
		$ret .= '';	
		$ret .= '';	
		$ret .= '';	
		$ret .= '';	
		$ret .= '';	
		$ret .= '';	
		$ret .= '';	
		$ret .= '';	
		$ret .= '';	
		$ret .= '';

	}
	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
	$ret .= '';	
		wp_reset_postdata();
	return $ret;
		
	
	
}
	
	add_shortcode('sslot','single_slot_shortcode');
	
	function get_slots_list() {
	$query_casino_args = array(
			'post_type'      => array('f7_slots'),
			'post_status'    => array('publish'),
			'posts_per_page' => 15,
			'numberposts'	 => -1,
			'post__not_in'	 => '',
			'orderby'        => 'rand',
			);

	$query_casino = new WP_Query( $query_casino_args );
	foreach ( $query_casino->posts as $casino ) {
		
	$shorted_companies[$casino->ID]=$casino->post_title;
	}
	if (!empty($shorted_companies)){
		$retn .=	'<ul>';
	foreach ($shorted_companies as $key=>$value){
		if (has_post_thumbnail($key)){	
				
				$retn .=	'<li><div class="slot-thumb"><a href="'.get_permalink($key).'">'.get_the_post_thumbnail($key, 'medium').'</a></div>';
				$retn .= 	'<div class="slot-title"><a href="'.get_permalink($key).'">'.get_the_title($key).'</a></div></li>';
				
		}
	}
	$retn .= '</ul>';
}else{return 'Δεν βρέθηκαν Φρουτάκια με τις επιλογές σας!';}
	return $retn;
}
?>