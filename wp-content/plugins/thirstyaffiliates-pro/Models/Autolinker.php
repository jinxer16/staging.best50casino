<?php
namespace ThirstyAffiliates_Pro\Models;

use ThirstyAffiliates_Pro\Abstracts\Abstract_Main_Plugin_Class;

use ThirstyAffiliates_Pro\Interfaces\Model_Interface;
use ThirstyAffiliates_Pro\Interfaces\Activatable_Interface;
use ThirstyAffiliates_Pro\Interfaces\Initiable_Interface;

use ThirstyAffiliates_Pro\Helpers\Plugin_Constants;
use ThirstyAffiliates_Pro\Helpers\Helper_Functions;

// Data Models
use ThirstyAffiliates\Models\Affiliate_Link;

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Model that houses the logic for the Autolinker module.
 *
 * @since 1.0.0
 */
class Autolinker implements Model_Interface , Activatable_Interface , Initiable_Interface {

    /*
    |--------------------------------------------------------------------------
    | Class Properties
    |--------------------------------------------------------------------------
    */

    /**
     * Property that holds the single main instance of Settings_Extension.
     *
     * @since 1.0.0
     * @access private
     * @var Settings_Extension
     */
    private static $_instance;

    /**
     * Model that houses all the plugin constants.
     *
     * @since 1.0.0
     * @access private
     * @var Plugin_Constants
     */
    private $_constants;

    /**
     * Property that houses all the helper functions of the plugin.
     *
     * @since 1.0.0
     * @access private
     * @var Helper_Functions
     */
    private $_helper_functions;




    /*
    |--------------------------------------------------------------------------
    | Class Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Class constructor.
     *
     * @since 1.0.0
     * @access public
     *
     * @param Abstract_Main_Plugin_Class $main_plugin      Main plugin object.
     * @param Plugin_Constants           $constants        Plugin constants object.
     * @param Helper_Functions           $helper_functions Helper functions object.
     */
    public function __construct( Abstract_Main_Plugin_Class $main_plugin , Plugin_Constants $constants , Helper_Functions $helper_functions ) {

        $this->_constants        = $constants;
        $this->_helper_functions = $helper_functions;

        $main_plugin->add_to_all_plugin_models( $this );

    }

    /**
     * Ensure that only one instance of this class is loaded or can be loaded ( Singleton Pattern ).
     *
     * @since 1.0.0
     * @access public
     *
     * @param Abstract_Main_Plugin_Class $main_plugin      Main plugin object.
     * @param Plugin_Constants           $constants        Plugin constants object.
     * @param Helper_Functions           $helper_functions Helper functions object.
     * @return Settings_Extension
     */
    public static function get_instance( Abstract_Main_Plugin_Class $main_plugin , Plugin_Constants $constants , Helper_Functions $helper_functions ) {

        if ( !self::$_instance instanceof self )
            self::$_instance = new self( $main_plugin , $constants , $helper_functions );

        return self::$_instance;

    }

    /**
     * Main function that implements the autolinker.
     *
     * @since 1.0.0
     * @access public
     *
     * @global WP_Post $post WP_Post object of currently loaded post.
     *
     * @param string $content WP_Post content.
     * @return string WP_Post content.
     */
    public function autolink_content( $content ) {

        global $post;

        // skip autolinker if $post is empty.
        if ( ! is_object( $post ) ) return $content;

        $post_autolinker_meta = get_post_meta( $post->ID , 'thirstyData' , true );
        $disable_autolinker   = isset( $post_autolinker_meta[ 'autolinker' ][ 'disableAutolinker' ] ) ? $post_autolinker_meta[ 'autolinker' ][ 'disableAutolinker' ] : '';

        if ( $disable_autolinker === 'on' )
            return $content;

        // 1.2.11: By default do not run Autolinker over feed content as it can feed validation issues
        // However, if the admin enabled this in settings, let it run.
        if ( is_feed() && get_option( 'tap_autolink_enable_feeds' ) !== 'yes' )
            return $content;

        // skip autolinker if is on archive and is setting flag is enabled
        if ( is_archive() && get_option( 'tap_autolink_disable_archives' ) === 'yes' )
            return $content;

        // skip autolinker if is on homepage and is setting flag is enabled
        if ( ( is_front_page() || is_home() ) && get_option( 'tap_autolink_disable_homepage' ) === 'yes' )
            return $content;

        // skip autolinker if its not enabled for the current post type

        $autolink_post_types = get_option( 'tap_autolink_post_types' , array( 'post' , 'pages' ) );
        if ( !is_array( $autolink_post_types ) )
            $autolink_post_types = array();

        if ( ! in_array( $post->post_type , $autolink_post_types ) )
            return $content;

        // Retrieve auto link data from cache
        $autolinker_links = get_option( 'tap_autolinker_cache' , array() );

        // If it's empty here, return because there are no autolinks to apply to the content
        if ( empty( $autolinker_links ) )
            return $content;

        // fetch global settings
        $global_keyword_limit    = get_option( 'tap_autolink_keyword_limit' , 3 );
        $global_inside_headings  = get_option( 'tap_autolink_inside_heading' );
        $global_random_placement = get_option( 'tap_autolink_random_placement' );

        foreach ( $autolinker_links as $link_id => $link_details ) {

            foreach( $link_details[ 'keyword_list' ] as $keyword ) {

                if ( empty( $keyword ) )
                    continue;

                $keyword_limit     = $link_details[ 'keyword_limit' ] !== 0 ? $link_details[ 'keyword_limit' ] : $global_keyword_limit;
                $autolink_headings = $link_details[ 'inside_headings' ] !== 'global' ? $link_details[ 'inside_headings' ] : $global_inside_headings;
                $random_placement  = $link_details[ 'random_placement' ] !== 'global' ? $link_details[ 'random_placement' ] : $global_random_placement;

                $this->prepare_keyword( $keyword );

                // Old regex
                /* $pattern = '/(?<!\pL)(' . $keyword . ')(?!\pL)(?!(?:(?!<\/?[p]?[r]?[' .
                		   ( $autolink_headings !== 'yes' ? 'h' : '') .
                		   'ae].*?>).)*<\/[p]?[r]?[' .
                		   ( $autolink_headings !== 'yes' ? 'h' : '') .
                		   'ae].*?>)(?![^<>]*>)/i'; */

                $pattern = "/<(a" . ( $autolink_headings !== "yes" ? "|h\d?" : "" ) . "|pre|script|iframe|code|applet|audio|canvas|button|textarea)(<(em|i|strong|b|span)>)?[^>]*>(?:[a-zA-Z0-9\s'\-\.,]|(?:<.*>.*<\/\1>))*(<\/(em|i|strong|b|span)>)?.*\n?<\/(a" . ( $autolink_headings !== "yes" ? "|h\d?" : "" ) . "|pre|script|iframe|code|applet|audio|canvas|button|textarea)>(*SKIP)(*FAIL)|\b(" . $keyword . ")\b(?=[^>]*(?:<|$))/isuU";

                if ( preg_match_all( $pattern , $content , $matches , PREG_OFFSET_CAPTURE) ) {
                    // If doing a random replacement, shuffle the match array to get random matches
    				if ( $random_placement === 'yes' )
    					shuffle( $matches[0] );

                    // Grab required number of matches and sort the array (in case we're shuffling)
    				$replace_matches = ( $keyword_limit > 0 ) ? array_slice( $matches[0] , 0 , $keyword_limit , true ) : $matches[0];
    				usort( $replace_matches , function( $a , $b ) {
                        return $a[1] - $b[1];
                    } );

                    $diff = 0;

                    foreach( $replace_matches as $next_match ) {

    					$next_match[1] = $next_match[1] + $diff; // Fix the offset of the match after the last replacement
                        $replacement   = do_shortcode( '[thirstylink ids="' . $link_id . '"]' . $next_match[0] . '[/thirstylink]' );
    					$content       = substr_replace( $content , $replacement , $next_match[1] , strlen( $next_match[0] ) );

    					// Add the string length difference to the next match's offset
    					// because all the string positions have moved since the first
    					// replacement.
                        $diff = $diff + strlen( $replacement ) - strlen( $next_match[0] );

                    }

                }

            }

        }

        return $content;

    }

    /**
     * Rebuild the autolinker cache, which holds all data for keywords that needs to autolinked.
     *
     * @since 1.0.0
     * @access private
     */
    private function rebuild_cache() {

        $autolinker_cache = maybe_unserialize( get_option( 'tap_autolinker_cache' , array() ) );
        $all_links        = get_posts( array(
			'posts_per_page' => -1,
            'post_type'      => Plugin_Constants::AFFILIATE_LINKS_CPT,
            'post_status'    => 'publish',
            'fields'         => 'ids'
		) );

        foreach ( $all_links as $link_id )
            $this->rebuild_cache_single_link( $link_id , $autolinker_cache );

        // save the rebuilt cache
        update_option( 'tap_autolinker_cache' , $autolinker_cache );

        return $autolinker_cache;
    }

    /**
     * Rebuild the autolinker cache, which holds all data for keywords that needs to autolinked.
     *
     * @since 1.0.0
     * @access private
     *
     * @param int   $link_id Affiliate Link post ID.
     * @param array $autolinker_cache  Autolinker cache.
     * @return array Single link autolinker cache.
     */
    private function rebuild_cache_single_link( $link_id , &$autolinker_cache ) {

        $keyword_list = get_post_meta( $link_id , Plugin_Constants::META_DATA_PREFIX . 'autolink_keyword_list' , true );
        $keyword_list = array_map( 'trim' , explode( ',' , $keyword_list ) );

        // if keyword list is empty, then don't include it to the cache.
        if ( empty( $keyword_list ) || ! $keyword_list[0] ) {
            if ( isset( $autolinker_cache[ $link_id ] ) ) unset( $autolinker_cache[ $link_id ] );
            return;
        }

        $autolinker_cache[ $link_id ] = array(
            'keyword_list'     => $keyword_list,
            'keyword_limit'    => (int) get_post_meta( $link_id , Plugin_Constants::META_DATA_PREFIX . 'autolink_keyword_limit' , true ),
            'inside_headings'  => get_post_meta( $link_id , Plugin_Constants::META_DATA_PREFIX . 'autolink_inside_heading' , true ),
            'random_placement' => get_post_meta( $link_id , Plugin_Constants::META_DATA_PREFIX . 'autolink_random_placement' , true ),
        );
    }

    /**
     * Prepare the keyword. Make sure that there are no slahes, special characters are decoded, wptexturize, and escaped for regex characters.
     *
     * @since 1.0.0
     * @access private
     *
     * @param string $keyword Keyword to process.
     */
    private function prepare_keyword( &$keyword ) {

        $keyword     = wptexturize( wp_kses_decode_entities( htmlspecialchars_decode( stripslashes( $keyword ) , ENT_COMPAT ) ) );
        $regex_chars = array( "[" , "\\", "^", "$", ".", "|", "?", "*", "+", "(", ")", "/" );

    	foreach ( $regex_chars as $char )
    		$keyword = str_replace( $char, "\\$char", $keyword );
    }

    /**
     * Update the autolinker cache for a single link when the CPT post is saved.
     *
     * @since 1.0.0
     * @access private
     *
     * @param int $link_id Affiliate Link post ID.
     */
    public function update_autolinker_cache_on_post_save( $link_id ) {

        if ( get_post_type( $link_id ) !== Plugin_Constants::AFFILIATE_LINKS_CPT )
            return;

        $autolinker_cache = maybe_unserialize( get_option( 'tap_autolinker_cache' , array() ) );

        $this->rebuild_cache_single_link( $link_id , $autolinker_cache );
        update_option( 'tap_autolinker_cache' , $autolinker_cache );
    }

    /**
     * Delete the affiliate link on the autolinker once the post is trashed or deleted.
     *
     * @since 1.0.0
     * @access private
     *
     * @param int $link_id Affiliate Link post ID.
     */
    public function remove_link_from_autolinker_on_post_delete( $link_id ) {

        if ( get_post_type( $link_id ) !== Plugin_Constants::AFFILIATE_LINKS_CPT )
            return;

        remove_action( 'save_post' , array( $this , 'update_autolinker_cache_on_post_save' ) , 99  );

        $autolinker_cache = maybe_unserialize( get_option( 'tap_autolinker_cache' , array() ) );
        unset( $autolinker_cache[ $link_id ] );

        update_option( 'tap_autolinker_cache' , $autolinker_cache );
    }

    /**
     * AJAX rebuild autolinker cache.
     *
     * @since 1.0.0
     * @access public
     */
    public function ajax_rebuild_cache() {

        if ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX )
            $response = array( 'status' => 'fail' , 'error_msg' => __( 'Invalid AJAX call' , 'thirstyaffiliates-pro' ) );
        else {

            // clear and delete the autolinker cache option
            delete_option( 'tap_autolinker_cache' );

            // rebuild the autolinker cache
            $this->rebuild_cache();

            $response = array( 'status'  => 'success' );
        }

        @header( 'Content-Type: application/json; charset=' . get_option( 'blog_charset' ) );
        echo wp_json_encode( $response );
        wp_die();
    }




    /*
    |--------------------------------------------------------------------------
    | Implemented Interface Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Execute codes that needs to run plugin activation.
     *
     * @since 1.0.0
     * @access public
     * @implements ThirstyAffiliates_Pro\Interfaces\Activatable_Interface
     */
    public function activate() {

        // When module is disabled in the settings, then it shouldn't run the whole class.
        if ( get_option( 'tap_enable_autolinker' , 'yes' ) !== 'yes' )
            return;

        // create autolinker cache on plugin activation
        $this->rebuild_cache();
    }

    /**
     * Method that houses codes to be executed on init hook.
     *
     * @since 1.0.0
     * @access public
     * @inherit ThirstyAffiliates_Pro\Interfaces\Initiable_Interface
     */
    public function initialize() {

        // When module is disabled in the settings, then it shouldn't run the whole class.
        if ( get_option( 'tap_enable_autolinker' , 'yes' ) !== 'yes' )
            return;

        add_action( 'wp_ajax_tap_autolink_rebuild_cache' , array( $this , 'ajax_rebuild_cache' ) , 10 );
    }

    /**
     * Execute model.
     *
     * @implements ThirstyAffiliates_Pro\Interfaces\Model_Interface
     *
     * @since 1.0.0
     * @access public
     */
    public function run() {

        // When module is disabled in the settings, then it shouldn't run the whole class.
        if ( get_option( 'tap_enable_autolinker' , 'yes' ) !== 'yes' )
            return;

        add_filter( 'the_content' , array( $this , 'autolink_content' ) , 99 );
        add_action( 'save_post' , array( $this , 'update_autolinker_cache_on_post_save' ) , 99 );
        add_action( 'wp_trash_post' , array( $this , 'remove_link_from_autolinker_on_post_delete' ) );
        add_action( 'before_delete_post' , array( $this , 'remove_link_from_autolinker_on_post_delete' ) );

        // bbPress support
        add_filter( 'bbp_get_topic_content' , array( $this , 'autolink_content' ) , 99 );
    	add_filter( 'bbp_get_reply_content' , array( $this , 'autolink_content' ) , 99 );
    }

}
