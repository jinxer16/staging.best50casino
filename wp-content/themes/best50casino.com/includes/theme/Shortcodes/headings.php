<?php 
/*
Plugin Name: CTA Shortcode
Version: 1.0
Plugin URI: http://weblom.gr
Description: This plugin reads the post_id and posts a list of the prons and cons of the casino. Data come from the custom meta boxes
Author: Panagiotis Giannakouras
Author URI: http://weblom.gr
*/

function title_shortcode($atts){
	$atts = shortcode_atts( 
	array(
        'title_text' => '',
        'title_type' => '',
    ), $atts, 'title' ) ;
	
	if ( 'h1' == $atts['title_type']){
		return '<h2 class="super" style="text-align: justify;">'.esc_html( $atts['title_text'] ).'</h2>';
	}elseif ( 'h2' == $atts['title_type']){
		return '<span class="super-container"><h4 class="super-2">'.esc_html( $atts['title_text'] ).'"</h4></span>';
	}
	
	
}
	
	add_shortcode('title','title_shortcode');
	
?>