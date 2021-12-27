<?php
function casino_review_shortcode($atts){
	//$companies = '';
	//$ret='';
	$type_of_sorting = 'Ολα';
	$atts = shortcode_atts( 
	array(	
		'popular' => '',
	), $atts, 'casino_r' ) ;
	
	global $post;
	$casino_pros = explode ('|', get_post_meta($post->ID, 'book_prons' , true) );
	$casino_cons = explode ('|', get_post_meta($post->ID, 'book_cons' , true) );
	$summary = explode ('|', get_post_meta($post->ID, 'casino_custom_meta_summary_rat', true));
	foreach ( get_post_custom($post->ID) as $key => $value ) {
			if (strpos($key, 'rating') !== false && strpos($key, 'as_rating') == false ){
			$casino_rating[$key]=$value[0];
			$total_rating=$total_rating+$value[0];
			}
		}
		$avg_rating = round(($total_rating/10))/2;		
		//$avg_rating = $total_rating/10;
		$avg_ones = substr($avg_rating,0,1) ;
		$avg_tenths = substr($avg_rating,2) ;
		$ten = 10;
	
	
	for ( $star_counter = 1; $star_counter <= 5; $star_counter++ ) {
		if ( $star_counter <= $avg_ones[$key] ) {
		$rets .= '<i class="fa fa-star"></i>';
		}elseif($avg_tenths[$key] == 5 && $star_counter > $avg_ones[$key] && !$half_casted){
		$rets .= '<i class="fa fa-star-half-o"></i>';
		$half_casted=true;
		}else {
		$rets .= '<i class="fa fa-star-o"></i>';
		} 	
	}
	
	//<span class="lektiko-rating">'.$total_rating.'%</span><span class="one_half"><h3>Σύνοψη</h3></span>
	
	$right_image = wp_get_attachment_image_src( get_post_meta($post->ID, 'right_sidebar_cbanner_img', true), 'full');	
	$inline_image = wp_get_attachment_image_src( get_post_meta($post->ID, 'inline_cbanner_img', true), 'full');
	$casino_logo = get_the_post_thumbnail($post->ID, 'full');
	
	$ret  = '<div class="casino-review-content">';
	$ret .= '<div class="casino-logo">'.$casino_logo.'</div>';
	$ret .= '<div class="lektiko">
		<div class="lektiko-1 pros-inline-hor">
			
			<span id="number"><h3>'.$total_rating.'/100</h3></span>
			<div class="stars">'.$rets.'</div>
			<span class="why-play">Γιατί να Παίξεις:</span>
			<ul>';
				foreach ($summary as $sum){
					$ret .= '<li>'.$sum.'</li>';
				}
		$ret .= '</ul>
		</div>
	</div>
	<div class="lektiko-cta"><a href="'.get_post_meta($post->ID, 'affiliate_url_for_cta', true).'">ΠΑΙΞΕ ΝΟΜΙΜΑ</a></div>';
	
	
		$ret .= '<div class="review-add">';
				if (get_post_meta($post->ID,'right_sidebar_cbanner_show',true) == 'script'){
								if (get_post_meta($post->ID, 'right_sidebar_cbanner_script', true)) {
									$ret.= get_post_meta($post->ID,'right_sidebar_cbanner_script',true);
								}	
							}else{
								if (get_post_meta($post->ID, 'right_sidebar_cbanner_img', true)) {
								$ret .=	'<a href="'.get_post_meta($post_id,'right_sidebar_cbanner_url',true).'" target="_blank" rel="nofollow">
								<img src="'.$right_image[0].'" alt="image"  srcset="'.$right_image[0].' 620w,'.$right_image[0].'300w" sizes="(max-width: 620px) 100vw, 620px" height="207" width="620">
									</a>';
						  }
							}
			$ret .=	'</div>';
	
 	$ret .= '<div class="identity">
					<table>
					<tbody>
						<tr>
							<th>Ιστοσελίδα</th>
						</tr>
						<tr>
							<td>
								<a href="'.get_post_meta($post->ID, 'affiliate_url_for_cta', true).'" target="_blank" rel="nofollow">'.str_replace("https://","",get_post_meta($post->ID, 'casino_custom_meta_com_url', true)).'</a>
							</td>
						</tr>
						<tr>
							<th>Ιδιοκτήτης</th>
						</tr>
						<tr>
							<td>'.get_post_meta($post->ID, str_replace('kss_', '', $post->post_type).'_custom_meta_com_off_name' , true).'</td>
						</tr>
						<tr>
							<th>Διεύθυνση</th>
						</tr>
						<tr>
							<td>'.get_post_meta($post->ID, str_replace('kss_', '', $post->post_type).'_custom_meta_com_head' , true).'</td>
						</tr>
						<tr>
							<th>Iδρύθηκε</th>
						</tr>
						<tr>
							<td>'.get_post_meta($post->ID, str_replace('kss_', '', $post->post_type).'_custom_meta_com_estab' , true).'</td>
						</tr>';
						$casino_license = get_post_meta($post->ID, str_replace('kss_', '', $post->post_type).'_custom_meta_license_country');
						foreach ($casino_license as $option) {
							if ($option) { 
						$ret .= '<tr>
							<th>Αδειοδότηση</th>
						</tr>
						<tr>
							<td>'.implode(", ", $option);}}
							$ret.= '</td>
						</tr>
						<tr>
							<th>Ελληνικό Τμήμα</th></tr>
						<tr><td>';if (get_post_meta($post->ID, str_replace('kss_', '', $post->post_type).'_custom_meta_gr_dep', true)) { $ret .= 'Ναι';}else{ $ret .= 'Όχι';}
							$ret .= '</td>
						</tr>';
						
						if (get_post_meta($post->ID, str_replace('kss_', '', $post->post_type).'_custom_meta_comun_hours', true)) { 
						$ret .= '<tr>
							<th>Ωράριο Λειτουργίας</th></tr>
						<tr><td>'.get_post_meta($post->ID, str_replace('kss_', '', $post->post_type).'_custom_meta_comun_hours', true);} $ret.='</td>
						</tr>';
						$casino_comun_methods = get_post_meta($post->ID, str_replace('kss_', '', $post->post_type).'_custom_meta_comun_methods');
						foreach ($casino_comun_methods as $option) {
						if ($option) { 
						$ret .= '<tr>
							<th>Τρόποι Επικοινωνίας</th></tr>
						<tr><td>'.implode(", ", $option);}}
							$ret .= '</td>
						</tr>';
						
						if (get_post_meta($post->ID, str_replace('kss_', '', $post->post_type).'_custom_meta_comun_email', true)) { 
						$ret .= '<tr>
							<th>Email</th></tr>
						<tr><td>'.get_post_meta($post->ID, str_replace('kss_', '', $post->post_type).'_custom_meta_comun_email', true);} $ret .='</td>
						</tr>';
						
						 if (get_post_meta($post->ID, str_replace('kss_', '', $post->post_type).'_custom_meta_comum_tel', true)) { 
						$ret .= '<tr>
							<th>Τηλέφωνο Επικοινωνίας</th></tr>
						<tr><td>'.get_post_meta($post->ID, str_replace('kss_', '', $post->post_type).'_custom_meta_comum_tel', true);} $ret .= '</td>
						</tr>
					</tbody>
					</table>
			</div>';
			
	$ret .= '</div>'; //end of casino-review-content
	
	
	return $ret;
}
	
	add_shortcode('casino_r','casino_review_shortcode');
?>