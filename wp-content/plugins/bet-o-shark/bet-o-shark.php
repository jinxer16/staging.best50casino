<?php
	/*
	Plugin Name: Bet-o-Shark
	Description: A plugin for Betting Sites Needs. Review, Advertise made easy!
	Version: 1.0
	Plugin URI: http://weblom.gr
	Author: Saolin 
	Author URI: http://weblom.gr
	Text Domain: bet-o-shark
	Domain Path: /languages
	*/

/* require_once('meta-box.php');
require_once('functions.php');
require_once('casino.php');
require_once('bookmakers.php');
require_once('slots.php');

require_once('games.php');
require_once('news.php');
//require_once('banners.php');
require_once('guides.php');
require_once('offers.php');
require_once('software.php');
require_once('transactions.php'); */
/* require_once('includes/widgets/casino-news.php');
require_once('includes/widgets/custom-text.php');
require_once('includes/widgets/casino_book_info.php');
require_once('includes/widgets/test.php');
require_once('includes/widgets/test2.php');
require_once('includes/widgets/casino_casino_custom_menu.php');
require_once('includes/widgets/jackpots.php');
require_once('includes/widgets/casino-guides-menu.php');
require_once('includes/widgets/casino_casino_front_cta.php');
require_once('includes/widgets/casino_casino_front_inline_cta.php');
require_once('includes/widgets/casino_casino_front_inline_cta_vertical.php');
require_once('includes/widgets/casino_casino_links.php');
require_once('includes/widgets/casino_casino_recommended_play.php');
require_once('includes/widgets/casino_casino_spot.php');
require_once('includes/widgets/casino_company_more_info.php');
require_once('includes/widgets/casino_cta.php');
require_once('includes/widgets/casino_identiy.php');
require_once('includes/widgets/casino_page_nav.php');
require_once('includes/widgets/casino_payments.php');
require_once('includes/widgets/casino_pros_cons.php');
require_once('includes/widgets/casino_rating.php');
require_once('includes/widgets/casino_related.php');
require_once('includes/widgets/casino-additional-banner.php');
require_once('includes/widgets/widget-casino-review-cat-menu.php'); */
/* require_once('includes/shortcodes/casino-shortcode-cta.php');
require_once('includes/shortcodes/headings.php');
require_once('includes/shortcodes/nc-shortcodes.php');
require_once('includes/shortcodes/nc-shortcodes-metaboxes.php');
require_once('includes/shortcodes/slots-shortcodes.php');
require_once('includes/shortcodes/games-shortcodes.php');
require_once('includes/shortcodes/slots-shortcodes-metaboxes.php');
require_once('includes/shortcodes/games-shortcodes-metaboxes.php');
require_once('includes/shortcodes/posts-shortcodes.php');
require_once('includes/shortcodes/posts-shortcodes-metaboxes.php');
require_once('includes/shortcodes/sl-ga-shortcodes.php');
require_once('includes/shortcodes/sl-ga-shortcodes-metaboxes.php');
require_once('includes/shortcodes/casino-review-shortcode.php');
require_once('includes/shortcodes/shortcodes.php');
require_once('includes/shortcodes/single-slot-shortcode.php'); */
require_once('includes/gambling-options.php');


/********************************* Make plugin translation ready **************************************/
add_action( 'init', 'shark_load_textdomain' );

function shark_load_textdomain() {
  load_plugin_textdomain( 'bet-o-shark', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
} 
/********************************* END OF Make plugin translation ready *******************************/


/********************************* Add Page for Sharkcodes ********************************************/

/* function add_sharkcodes_admin_menu() {
add_menu_page( 'SharkCodes', 'SharkCodes', 'manage_options', 'bet-o-shark/includes/shortcodes/slots-shortcodes-metaboxes.php', 'myplguin_admin_page', 'dashicons-carrot', 6 );
//add_submenu_page( 'bet-o-shark/includes/shortcodes/slots-shortcodes-metaboxes.php', 'Casino Shark','Casino Shark', 'manage_options', 'bet-o-shark/includes/shortcodes/slots-shortcodes-metaboxes.php?post_type=nc_shortcodes1', NULL );
}
add_action('admin_menu', 'add_sharkcodes_admin_menu'); */




/********************************* END OF Add Page for Sharkcodes *************************************/











?>