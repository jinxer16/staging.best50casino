<?php
namespace ThirstyAffiliates_Pro\Models;

use ThirstyAffiliates_Pro\Abstracts\Abstract_Main_Plugin_Class;

use ThirstyAffiliates_Pro\Interfaces\Model_Interface;

use ThirstyAffiliates_Pro\Helpers\Plugin_Constants;
use ThirstyAffiliates_Pro\Helpers\Helper_Functions;

// Data Models
use ThirstyAffiliates\Models\Affiliate_Link;

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Model that houses the logic of all metaboxes registered in the plugin.
 *
 * @since 1.0.0
 */
class Metaboxes implements Model_Interface {

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

    /**
     * Property that holds the currently loaded thirstylink post.
     *
     * @since 1.0.0
     * @access private
     */
    private $_thirstylink;




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
     * Get thirstylink Affiliate_Link object.
     *
     * @since 1.0.0
     * @access private
     *
     * @param int $post_id Thirstylink post id.
     * @return Affiliate_Link object.
     */
    private function get_thirstylink_post( $post_id ) {

        if ( is_object( $this->_thirstylink ) && $this->_thirstylink->get_id() == $post_id )
            return $this->_thirstylink;

        return $this->_thirstylink = new Affiliate_Link( $post_id );
    }

    /**
     * Register metaboxes
     *
     * @since 1.0.0
     * @since 1.2.2 Remove metaboxes registration for thirstylink post type.
     * @access public
     */
    public function register_metaboxes() {

        // autolinker
        if ( get_option( 'tap_enable_autolinker' , 'yes' ) === 'yes' ) {

            add_meta_box(
                'tap-disable-autolinker-metabox',
                __( 'Disable ThirstyAffiliates Autolinker', 'thirstyaffiliates-pro' ),
                array( $this , 'disable_autolinker_metabox' ),
                get_option( 'tap_autolink_post_types' , array( 'post' , 'page' ) ),
                'side',
                'low'
            );
        }
    }

    /**
     * Register TAP normal metaboxes.
     *
     * @since 1.2.2
     * @access public
     */
    public function register_ta_normal_metaboxes( $metaboxes ) {

        $tap_metaboxes = array();

        // autolinker
        if ( get_option( 'tap_enable_autolinker' , 'yes' ) === 'yes' ) {

            $tap_metaboxes[] = array(
                'id'       => 'tap-autolink-keywords-metabox',
                'title'    => __( 'Autolink Keywords', 'thirstyaffiliates-pro' ),
                'cb'       => array( $this , 'autolink_keywords_metabox' ),
                'sort'     => 30,
                'priority' => 'default'
            );
        }

        // geolocation
        if ( get_option( 'tap_enable_geolocation' , 'yes' ) === 'yes' ) {

            $tap_metaboxes[] = array(
                'id'       => 'tap-geolocation-urls-metabox',
                'title'    => __( 'Geolocation URLs', 'thirstyaffiliates-pro' ),
                'cb'       => array( $this , 'geolocation_urls_metabox' ),
                'sort'     => 40,
                'priority' => 'default'
            );
        }

        // link scheduler
        if ( get_option( 'tap_enable_link_scheduler' , 'yes' ) === 'yes' ) {

            $tap_metaboxes[] = array(
                'id'       => 'tap-link-scheduler-metabox',
                'title'    => __( 'Link Scheduler', 'thirstyaffiliates-pro' ),
                'cb'       => array( $this , 'link_scheduler_metabox' ),
                'sort'     => 50,
                'priority' => 'default'
            );
        }

        return array_merge( $metaboxes , $tap_metaboxes );
    }

    /**
     * Register TAP side metaboxes.
     *
     * @since 1.2.2
     * @access public
     */
    public function register_ta_side_metaboxes( $metaboxes ) {

        $tap_metaboxes = array();

        // link health
        if ( get_option( 'tap_enable_link_health_checker' , 'yes' ) === 'yes' ) {

            $tap_metaboxes[] = array(
                'id'       => 'tap-link-health-metabox-side',
                'title'    => __( 'Link Health', 'thirstyaffiliates-pro' ),
                'cb'       => array( $this , 'link_health_metabox' ),
                'sort'     => 20,
                'priority' => 'high'
            );
        }

        return array_merge( $metaboxes , $tap_metaboxes );
    }

    /**
     * Display "Autolink Keywords" metabox
     *
     * @since 1.0.0
     * @access public
     *
     * @param WP_Post $post Affiliate link WP_Post object.
     */
    public function autolink_keywords_metabox( $post ) {

        $thirstylink                      = $this->get_thirstylink_post( $post->ID );
        $global_autolink_inside_heading   = get_option( 'tap_autolink_inside_heading' ) == 'yes' ? 'yes' : 'no';
        $global_autolink_random_placement = get_option( 'tap_autolink_random_placement' ) == 'yes' ? 'yes' : 'no';

        include_once( $this->_constants->VIEWS_ROOT_PATH() . 'metaboxes/view-autolink-keywords-metabox.php' );
    }

    /**
     * Display "Geolocation URLs" metabox
     *
     * @since 1.0.0
     * @access public
     *
     * @param WP_Post $post Affiliate link WP_Post object.
     */
    public function disable_autolinker_metabox( $post ) {

        $post_autolinker_meta = get_post_meta( $post->ID , 'thirstyData' , true );
        $disable_autolinker   = isset( $post_autolinker_meta[ 'autolinker' ][ 'disableAutolinker' ] ) ? $post_autolinker_meta[ 'autolinker' ][ 'disableAutolinker' ] : '';

        include_once( $this->_constants->VIEWS_ROOT_PATH() . 'metaboxes/view-disable-autolinker-metabox.php' );
    }

    /**
     * Display "Autolink Keywords" metabox
     *
     * @since 1.0.0
     * @access public
     *
     * @param WP_Post $post Affiliate link WP_Post object.
     */
    public function geolocation_urls_metabox( $post ) {

        $thirstylink   = $this->get_thirstylink_post( $post->ID );
        $geolinks      = $thirstylink->get_prop( 'geolocation_links' );
        $countries     = $this->_helper_functions->get_available_countries( $geolinks );
        $all_countries = $this->_helper_functions->get_all_countries();

        include_once( $this->_constants->VIEWS_ROOT_PATH() . 'metaboxes/view-geolocation-urls-metabox.php' );
    }

    /**
     * Save additional post meta when saved on the Affiliate Link editor.
     *
     * @since 1.1.0
     * @since 1.2.0 Added code to display button as "regenerate" when the used service is different with the currently active one.
     * @since 1.3.0 Added support for FirebaseDL. Refactored code and moved complex logic to its own helper function.
     * @access public
     *
     * @param WP_Post $post Affiliate link WP_Post object.
     */
    public function url_shortener_field( $post ) {

        $active_service       = get_option( 'tap_url_shortener_service' , 'bitly' );
        $thirstylink          = $this->get_thirstylink_post( $post->ID );
        $shortened_url        = $thirstylink->get_prop( 'shortened_url' );
        $cloaked_url          = $thirstylink->get_prop( 'permalink' );
        $button_text          = $shortened_url ? sprintf( __( 'Regenerate Short URL with %s' , 'thirstyaffiliates-pro' ) , $active_service ) : __( 'Generate Short URL' , 'thirstyaffiliates-pro' );
        $shortener_api_option = $this->_helper_functions->get_url_shortener_api_option( $active_service );
        $service_used         = $this->_helper_functions->detect_url_shortener_service_used( $shortened_url );
        $is_api_active        = (bool) get_option( $shortener_api_option );

        if ( get_option( 'tap_enable_url_shortener' , 'yes' ) !== 'yes' || ( ! $is_api_active && ! $shortened_url ) || ! $thirstylink->get_prop( 'destination_url' ) )
            return;

        // If active service is firebase, then we should also check for the dynamic link domain option.        
        if ( $active_service === 'firebasedl' && ! get_option( 'tap_firebase_dynamic_link_domain' ) )
            $is_api_active = false;

        include_once( $this->_constants->VIEWS_ROOT_PATH() . 'metaboxes/view-url-shortener-field.php' );
    }

    /**
     * Display "Link Scheduler" metabox
     *
     * @since 1.2.0
     * @access public
     *
     * @param WP_Post $post Affiliate link WP_Post object.
     */
    public function link_scheduler_metabox( $post ) {

        $thirstylink = $this->get_thirstylink_post( $post->ID );

        // global setting values
        $global_before_start_redirect_url = get_option( 'tap_global_before_start_redirect_url' );
        $global_link_expire_redirect_url  = get_option( 'tap_global_after_expire_redirect_url' );

        include_once( $this->_constants->VIEWS_ROOT_PATH() . 'metaboxes/view-link-scheduler-metabox.php' );
    }

    /**
     * Link health metabox.
     *
     * @since 1.2.0
     * @since 1.3.0 Moved link health status content to a separate view file.
     * @access public
     *
     * @param WP_Post $post Affiliate link WP_Post object.
     */
    public function link_health_metabox( $post ) {

        $thirstylink   = $this->get_thirstylink_post( $post->ID );
        $link_id       = $thirstylink->get_id();
        $status        = $thirstylink->get_prop( 'link_health_status' );
        $last_checked  = $thirstylink->get_prop( 'link_health_last_checked' );
        $status_markup = $this->_helper_functions->display_link_health_status( $status , $last_checked , false );

        include_once( $this->_constants->VIEWS_ROOT_PATH() . 'metaboxes/view-link-health-metabox.php' );
    }

    /**
     * Save additional post meta when saved on the Affiliate Link editor.
     *
     * @since 3.0.0
     * @access public
     *
     * @param Affiliate_Link $thirstylink Affilaite Link post object.
     * @param int            $post_id               Affiliate link post ID.
     */
    public function save_affiliate_link_meta( $thirstylink , $post_id ) {

        // autolinker metas
        if ( get_option( 'tap_enable_autolinker' , 'yes' ) === 'yes' ) {

            $thirstylink->set_prop( 'autolink_keyword_list' , sanitize_text_field( $_POST[ 'tap_autolink_keyword_list' ] ) );
            $thirstylink->set_prop( 'autolink_keyword_limit' , (int) sanitize_text_field( $_POST[ 'tap_autolink_keyword_limit' ] ) );
            $thirstylink->set_prop( 'autolink_inside_heading' , sanitize_text_field( $_POST[ 'tap_autolink_inside_heading' ] ) );
            $thirstylink->set_prop( 'autolink_random_placement' , sanitize_text_field( $_POST[ 'tap_autolink_random_placement' ] ) );
        }

        // link scheduler metas
        if ( get_option( 'tap_enable_link_scheduler' , 'yes' ) === 'yes' ) {

            $thirstylink->set_prop( 'link_start_date' , sanitize_text_field( $_POST[ 'ta_link_start_date' ] ) );
            $thirstylink->set_prop( 'link_expire_date' , sanitize_text_field( $_POST[ 'ta_link_expire_date' ] ) );
            $thirstylink->set_prop( 'before_start_redirect' , esc_url_raw( $_POST[ 'ta_before_start_redirect' ] ) );
            $thirstylink->set_prop( 'after_expire_redirect' , esc_url_raw( $_POST[ 'ta_after_expire_redirect' ] ) );
        }
    }

    /**
     * Save post.
     *
     * @since 1.0.0
     * @access public
     *
     * @param int $post_id Affiliate link post ID.
     */
    public function save_post( $post_id ) {

        if ( ! isset( $_POST[ '_disable_autolinker_nonce' ] ) || ! wp_verify_nonce( $_POST['_disable_autolinker_nonce'], 'ta_disable_autolinker_nonce' ) )
            return;

        // Note: we are replicating the format on V2 as we are not able to migrate this data currently.
        $autolinker_post_meta = array(
            'autolinker' => array(
                'disableAutolinker' => isset( $_POST[ 'tap_disable_autolinker' ] ) ? 'on' : '',
            )
        );

        update_post_meta( $post_id , 'thirstyData' , $autolinker_post_meta );
    }




    /*
    |--------------------------------------------------------------------------
    | Implemented Interface Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Execute model.
     *
     * @implements ThirstyAffiliates_Pro\Interfaces\Model_Interface
     *
     * @since 1.0.0
     * @access public
     */
    public function run() {

        add_filter( 'ta_register_normal_metaboxes' , array( $this , 'register_ta_normal_metaboxes' ) );
        add_filter( 'ta_register_side_metaboxes' , array( $this , 'register_ta_side_metaboxes' ) );

        add_action( 'add_meta_boxes' , array( $this , 'register_metaboxes' ) , 20 );
        add_action( 'ta_urls_metabox_urls_fields' , array( $this , 'url_shortener_field' ) , 10 );
        add_action( 'ta_save_affiliate_link_post' , array( $this , 'save_affiliate_link_meta' ) , 10 , 2 );
        add_action( 'save_post' , array( $this , 'save_post' ) );
    }

}
