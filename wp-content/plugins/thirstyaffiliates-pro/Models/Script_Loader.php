<?php
namespace ThirstyAffiliates_Pro\Models;

use ThirstyAffiliates_Pro\Abstracts\Abstract_Main_Plugin_Class;

use ThirstyAffiliates_Pro\Interfaces\Model_Interface;

use ThirstyAffiliates_Pro\Helpers\Plugin_Constants;
use ThirstyAffiliates_Pro\Helpers\Helper_Functions;

use ThirstyAffiliates_Pro\Models\Third_Party_Integrations\Amazon\Amazon;

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Script_Loader implements Model_Interface {

    /*
    |--------------------------------------------------------------------------
    | Class Properties
    |--------------------------------------------------------------------------
    */

    /**
     * Property that holds the single main instance of Bootstrap.
     *
     * @since 1.0.0
     * @access private
     * @var Bootstrap
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
     * Property that houses the AZON model.
     *
     * @since 1.0.0
     * @access private
     * @var Amazon
     */
    private $_azon;

    /**
     * Property that houses the Guided_Tour model.
     *
     * @since 1.0.0
     * @access private
     * @var Guided_Tour
     */
    private $_guided_tour;




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
     * @param Amazon                     $amazon           Azon model.
     */
    public function __construct( Abstract_Main_Plugin_Class $main_plugin , Plugin_Constants $constants , Helper_Functions $helper_functions , Amazon $amazon , Guided_Tour $guided_tour ) {

        $this->_constants        = $constants;
        $this->_helper_functions = $helper_functions;
        $this->_azon             = $amazon;
        $this->_guided_tour      = $guided_tour;

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
     * @param Amazon                     $amazon           Azon model.
     * @return Bootstrap
     */
    public static function get_instance( Abstract_Main_Plugin_Class $main_plugin , Plugin_Constants $constants , Helper_Functions $helper_functions , Amazon $amazon , Guided_Tour $guided_tour ) {

        if ( !self::$_instance instanceof self )
            self::$_instance = new self( $main_plugin , $constants , $helper_functions , $amazon , $guided_tour );

        return self::$_instance;

    }

    /**
     * Load backend js and css scripts.
     *
     * @since 1.0.0
     * @access public
     *
     * @param string $handle Unique identifier of the current backend page.
     */
    public function load_backend_scripts( $handle ) {

        $screen = get_current_screen();

        $post_type = get_post_type();
        if ( !$post_type && isset( $_GET[ 'post_type' ] ) )
            $post_type = $_GET[ 'post_type' ];

        if ( $screen->base === "toplevel_page_tap-settings" ) {

            wp_enqueue_style( 'chosen' , $this->_constants->JS_ROOT_URL() . 'lib/chosen/chosen.min.css' , array() , Plugin_Constants::VERSION , 'all' );

            wp_enqueue_script( 'chosen', $this->_constants->JS_ROOT_URL() . 'lib/chosen/chosen.jquery.min.js' , array( 'jquery' ) , Plugin_Constants::VERSION , true );

        } elseif ( $screen->base == 'thirstylink_page_thirsty-settings' ) {

            wp_enqueue_style( 'tap_settings_css' , $this->_constants->CSS_ROOT_URL() . 'admin/tap-settings.css' , array( 'ta_settings_css' ) , Plugin_Constants::VERSION , 'all' );

            wp_enqueue_script( 'tap_settings_js', $this->_constants->JS_ROOT_URL() . 'app/tap-settings.js', array( 'jquery' , 'ta_settings_js' ), Plugin_Constants::VERSION , true );

        } elseif ( $screen->base == 'post' && $post_type == Plugin_Constants::AFFILIATE_LINKS_CPT ) {

            wp_enqueue_style( 'tap-edit-affiliate-link' , $this->_constants->CSS_ROOT_URL() . 'admin/tap-edit-affiliate-link.css' , array() , Plugin_Constants::VERSION , 'all' );

            if ( get_option( 'tap_enable_geolocation' , 'yes' ) === 'yes' || get_option( 'tap_enable_autolinker' , 'yes' ) ) {

                wp_enqueue_style( 'selectize' , $this->_constants->JS_ROOT_URL() . 'lib/selectize/selectize.css' , array() , Plugin_Constants::VERSION , 'all' );
                wp_enqueue_style( 'selectize-default' , $this->_constants->JS_ROOT_URL() . 'lib/selectize/selectize.default.css' , array() , Plugin_Constants::VERSION , 'all' );

                wp_enqueue_script( 'selectize', $this->_constants->JS_ROOT_URL() . 'lib/selectize/selectize.min.js' , array( 'jquery' ) , Plugin_Constants::VERSION , true );
            }

            if ( get_option( 'tap_enable_link_scheduler' , 'yes' ) === 'yes' ) {

                wp_enqueue_style( 'jquery-ui-styles' );
                wp_enqueue_style( 'tap-jquery-ui-styles' , 'http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.min.css' , array() , '1.11.4' , 'all' );
                wp_enqueue_script( 'jquery-ui-core' );
                wp_enqueue_script( 'jquery-ui-datepicker' );
            }

        } elseif ( $screen->base == 'thirstylink_page_amazon' ) {

            wp_enqueue_style( 'ta-amazon-css'  , $this->_constants->JS_ROOT_URL() . 'app/amazon/dist/amazon.css' , array() , 'all' );
            wp_enqueue_script( 'ta-amazon-js'  , $this->_constants->JS_ROOT_URL() . 'app/amazon/dist/amazon.js'  , array() , true );
            wp_localize_script( 'ta-amazon-js' , 'ta_amazon_args' , array(
                'azon_link_data'                                 => $this->_azon->get_azon_link_data(),
                'nonce_amazon_product_advertisement_api_search' => wp_create_nonce( 'tap_amazon_product_advertisement_api_search' ),
                'nonce_amazon_table_visible_columns'            => wp_create_nonce( 'tap_set_amazon_table_visible_columns' ),
                'nonce_set_last_used_search_endpoint'           => wp_create_nonce( 'tap_set_last_used_search_endpoint' ),
                'nonce_import_link'                             => wp_create_nonce( 'tap_import_link' ),
                'nonce_delete_amazon_imported_link'             => wp_create_nonce( 'tap_delete_amazon_imported_link' ),
                'option_amazon_columns_data'                    => get_option( Plugin_Constants::AMAZON_TABLE_COLUMNS ),
                'option_hide_empty_priced_products'             => get_option( 'tap_hide_products_with_empty_price' ),
                'option_redirect_type'                          => get_option( 'ta_link_redirect_type' ),
                'option_no_follow'                              => get_option( 'ta_no_follow' ),
                'option_new_window'                             => get_option( 'ta_new_window' ),
                'option_import_images'                          => get_option( 'tap_azon_import_images' ),
                'i18n_no_data_available'                        => __( 'No Data Available' , 'thirstyaffiliates-pro' ),
                'i18n_please_input_search_terms'                => __( 'Please input search terms' , 'thirstyaffiliates-pro' ),
                'i18n_failed_to_perform_search'                 => __( 'Failed to perform product search' , 'thirstyaffiliates-pro' ),
                'i18n_import'                                   => __( 'Import' , 'thirstyaffiliates-pro' ),
                'i18n_quick_import'                             => __( 'Quick Import' , 'thirstyaffiliates-pro' ),
                'i18n_filter_results'                           => __( 'Filter Results:' , 'thirstyaffiliates-pro' ),
                'i18n_link_name'                                => __( 'Link Name:' , 'thirstyaffiliates-pro' ),
                'i18n_link_url'                                 => __( 'Link URL:' , 'thirstyaffiliates-pro' ),
                'i18n_link_protocol_required'                   => __( 'http:// or https:// is required' , 'thirstyaffiliates-pro' ),
                'i18n_no_follow_link'                           => __( 'No Follow Link' , 'thirstyaffiliates-pro' ),
                'i18n_open_link_new_tab'                        => __( 'Open Link In New Tab' , 'thirstyaffiliates-pro' ),
                'i18n_redirection_type'                         => __( 'Redirection Type:' , 'thirstyaffiliates-pro' ),
                'i18n_301_permanent'                            => __( '301 Permanent' , 'thirstyaffiliates-pro' ),
                'i18n_302_temporary'                            => __( '302 Temporary' , 'thirstyaffiliates-pro' ),
                'i18n_307_temporary_alternative'                => __( '307 Temporary (Alternative)' , 'thirstyaffiliates-pro' ),
                'i18n_import_images'                            => __( 'Import Images:' , 'thirstyaffiliates-pro' ),
                'i18n_import_link'                              => __( 'Import Link' , 'thirstyaffiliates-pro' ),
                'i18n_small'                                    => __( 'Small' , 'thirstyaffiliates-pro' ),
                'i18n_medium'                                   => __( 'Medium' , 'thirstyaffiliates-pro' ),
                'i18n_large'                                    => __( 'Large' , 'thirstyaffiliates-pro' ),
                'i18n_import_as_affiliate_link'                 => __( 'Import as Affiliate Link' , 'thirstyaffiliates-pro' ),
                'i18n_cancel'                                   => __( 'Cancel' , 'thirstyaffiliates-pro' ),
                'i18n_failed_to_import_link'                    => __( 'Failed to import product as an affiliate link' , 'thirstyaffiliates-pro' ),
                'i18n_imported_as_affiliated_link'              => __( 'Imported as an Affiliate Link' , 'thirstyaffiliates-pro' ),
                'i18n_edit'                                     => __( 'Edit' , 'thirstyaffiliates-pro' ),
                'i18n_visit'                                    => __( 'Visit' , 'thirstyaffiliates-pro' ),
                'i18n_delete'                                   => __( 'Delete' , 'thirstyaffiliates-pro' ),
                'i18n_confirm_delete_link'                      => __( 'Are you sure you want to delete this affiliate link?' , 'thirstyaffiliates-pro' ),
                'i18n_yes'                                      => __( 'Yes' , 'thirstyaffiliates-pro' ),
                'i18n_failed_delete_link'                       => __( 'Failed to delete imported affiliate link' , 'thirstyaffiliates-pro' ),
                'i18n_quick_importing'                          => __( 'Importing' , 'thirstyaffiliates-pro' ),
                'i18n_bulk_actions'                             => __( 'Bulk Actions' , 'thirstyaffiliates-pro' ),
                'i18n_delete_imported_link'                     => __( 'Delete Imported Link' , 'thirstyaffiliates-pro' ),
                'i18n_apply'                                    => __( 'Apply' , 'thirstyaffiliates-pro' ),
                'i18n_confirm_bulk_delete'                      => __( 'Are you sure you want to remove the selected imported links?' , 'thirstyaffiliates-pro' )
            ) );

        } elseif ( $screen->base == 'admin' && isset( $_GET[ 'import' ] ) && ( $_GET[ 'import' ] == 'tap_csv_importer' || $_GET[ 'import' ] == 'tap_csv_exporter' ) ) {

            wp_enqueue_style( 'tap-import-export-css'  , $this->_constants->CSS_ROOT_URL() . 'admin/tap-import-export.css' , array() , 'all' );

        } elseif ( $screen->id == 'thirstylink_page_thirsty-reports' ) {

            wp_dequeue_script( 'ta_reports_js' );

            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_style( 'ta_advanced_reports_css' , $this->_constants->CSS_ROOT_URL() . 'admin/tap-advanced-reports.css' , array( 'jquery-ui-styles' , 'ta_reports_css' ) , Plugin_Constants::VERSION , 'all' );

            if ( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] === 'geolocation' ) {

                wp_enqueue_style( 'jqvmap' , $this->_constants->JS_ROOT_URL() . 'lib/jqvmap/jqvmap.min.css' , array() , Plugin_Constants::VERSION , 'all' );

                wp_enqueue_script( 'jqvmap' , $this->_constants->JS_ROOT_URL() . 'lib/jqvmap/jquery.vmap.min.js' , array( 'jquery' ) , Plugin_Constants::VERSION , true );
                wp_enqueue_script( 'jqvmap_world' , $this->_constants->JS_ROOT_URL() . 'lib/jqvmap/jquery.vmap.world.js' , array( 'jquery' , 'jqvmap' ) , Plugin_Constants::VERSION , true );

            } elseif ( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] === 'stats_table' ) {

            } elseif ( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] === 'keyword_report' ) {

                wp_enqueue_style( 'jquery_tiptip' , ThirstyAffiliates()->helpers[ 'Plugin_Constants' ]->CSS_ROOT_URL() . 'lib/jquery-tiptip/jquery-tiptip.css' , array() , Plugin_Constants::VERSION , 'all' );
                wp_enqueue_style( 'selectize' , $this->_constants->JS_ROOT_URL() . 'lib/selectize/selectize.css' , array() , Plugin_Constants::VERSION , 'all' );
                wp_enqueue_style( 'selectize-default' , $this->_constants->JS_ROOT_URL() . 'lib/selectize/selectize.default.css' , array() , Plugin_Constants::VERSION , 'all' );

                wp_enqueue_script( 'jquery_tiptip' , ThirstyAffiliates()->helpers[ 'Plugin_Constants' ]->JS_ROOT_URL() . 'lib/jquery-tiptip/jquery.tipTip.min.js' , array( 'jquery' ) , Plugin_Constants::VERSION , true );
                wp_enqueue_script( 'selectize', $this->_constants->JS_ROOT_URL() . 'lib/selectize/selectize.min.js' , array( 'jquery' ) , Plugin_Constants::VERSION , true );

            } elseif ( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] === 'link_health_report' ) {

                wp_enqueue_style( 'jquery_tiptip' , ThirstyAffiliates()->helpers[ 'Plugin_Constants' ]->CSS_ROOT_URL() . 'lib/jquery-tiptip/jquery-tiptip.css' , array() , Plugin_Constants::VERSION , 'all' );
                wp_enqueue_style( 'slmw_vex_css'             , $this->_constants->JS_ROOT_URL() . 'lib/vex/vex.css'             , array() , 'all' );
                wp_enqueue_style( 'slmw_vex_theme_plain_css' , $this->_constants->JS_ROOT_URL() . 'lib/vex/vex-theme-plain.css' , array() , 'all' );

                wp_enqueue_script( 'jquery_tiptip' , ThirstyAffiliates()->helpers[ 'Plugin_Constants' ]->JS_ROOT_URL() . 'lib/jquery-tiptip/jquery.tipTip.min.js' , array( 'jquery' ) , Plugin_Constants::VERSION , true );
                wp_enqueue_script( 'slmw_vex_js' , $this->_constants->JS_ROOT_URL() . 'lib/vex/vex.combined.min.js' , array( 'jquery' ) , true );
                wp_add_inline_script( 'slmw_vex_js' , 'vex.defaultOptions.className = "vex-theme-plain"' , 'after' );

            } else {

                wp_enqueue_script( 'tap_reports_js' , $this->_constants->JS_ROOT_URL() . 'app/tap-reports.js' , array( 'jquery' , 'jquery-ui-core' , 'jquery-ui-datepicker' , 'wp-color-picker' ) , Plugin_Constants::VERSION , true );
                wp_localize_script( 'tap_reports_js' , 'tap_reports_args' , array(
                    'i18n_invalid_affiliate_link' => __( 'Invalid affiliate link selected.' , 'thirstyaffiliates-pro' ),
                    'i18n_invalid_category'       => __( 'Invalid category selected.' , 'thirstyaffiliates-pro' ),
                    'i18n_invalid_report_name'    => __( 'Please enter a valid report name' , 'thirstyaffiliates-pro' ),
                    'i18n_invalid_sel_report'     => __( 'Please select a valid saved report' , 'thirstyaffiliates-pro' ),
                    'general_report_label'        => __( 'General' , 'thirstyaffiliates-pro' ),
                    'general_report_slug'         => __( 'All links' , 'thirstyaffiliates-pro' ),
                    'delete_report_warning'       => __( 'Are you sure you want to delete the selected report?' , 'thirstyaffiliates-pro' )
                ) );

            }

        } elseif ( $screen->id === 'edit-tap-event-notification' ) {

            wp_enqueue_style( 'tap_event_notification' , $this->_constants->JS_ROOT_URL() . 'app/event-notification/dist/event-notification.css' , array() , 'all' );

            wp_enqueue_script( 'tap_event_notification' , $this->_constants->JS_ROOT_URL() . 'app/event-notification/dist/event-notification.js' , array() , true );

        }

        if ( $screen->base === 'thirstylink_page_thirsty-settings' && isset( $_GET[ 'tab' ] ) && in_array( $_GET[ 'tab' ] , array( 'tap_slmw_settings_section' , 'ta_help_settings' ) ) ) {

            wp_enqueue_style( 'slmw_vex_css'             , $this->_constants->JS_ROOT_URL() . 'lib/vex/vex.css'             , array() , 'all' );
            wp_enqueue_style( 'slmw_vex_theme_plain_css' , $this->_constants->JS_ROOT_URL() . 'lib/vex/vex-theme-plain.css' , array() , 'all' );

            wp_enqueue_script( 'slmw_vex_js' , $this->_constants->JS_ROOT_URL() . 'lib/vex/vex.combined.min.js' , array( 'jquery' ) , true );
            wp_add_inline_script( 'slmw_vex_js' , 'vex.defaultOptions.className = "vex-theme-plain"' , 'after' );

            if ( $_GET[ 'tab' ] === 'tap_slmw_settings_section' ) {

                wp_enqueue_script( 'tap_slmw_js' , $this->_constants->JS_ROOT_URL() . 'app/tap-slmw-license.js' , array() , true );
                wp_localize_script( 'tap_slmw_js' , 'slmw_args' , array(
                    'nonce_activate_license'            => wp_create_nonce( 'tap_activate_license' ),
                    'i18n_activate_license'             => __( 'Activate License' , 'thirstyaffiliates-pro' ),
                    'i18n_activating_license'           => __( 'Activating. Please wait...' , 'thirstyaffiliates-pro' ),
                    'i18n_please_fill_activation_creds' => __( 'Please fill in activation email and license key' , 'thirstyaffiliates-pro' ),
                    'i18n_failed_to_activate_license'   => __( 'Failed to activated license. Server error occurred on ajax request. Please contact support.' , 'thirstyaffiliates-pro' )
                ) );
            }

        } elseif ( $screen->id === 'edit-thirstylink' ) {

            wp_enqueue_style( 'jquery_tiptip' , ThirstyAffiliates()->helpers[ 'Plugin_Constants' ]->CSS_ROOT_URL() . 'lib/jquery-tiptip/jquery-tiptip.css' , array() , Plugin_Constants::VERSION , 'all' );
            wp_enqueue_style( 'tap_affiliate_link_list' , $this->_constants->CSS_ROOT_URL() . 'admin/tap-affiliate-link-list.css' , array() , Plugin_Constants::VERSION , 'all' );
            wp_enqueue_script( 'jquery_tiptip' , ThirstyAffiliates()->helpers[ 'Plugin_Constants' ]->JS_ROOT_URL() . 'lib/jquery-tiptip/jquery.tipTip.min.js' , array( 'jquery' ) , Plugin_Constants::VERSION , true );
            wp_enqueue_script( 'tap_affiliate_link_list' , $this->_constants->JS_ROOT_URL() . 'app/tap-affiliate-link-list.js' , array( 'jquery' ) , Plugin_Constants::VERSION , true );

        }

        if ( get_option( 'ta_guided_tour_status' ) != 'open' && get_option( 'tap_guided_tour_status' ) == 'open' && array_key_exists( $screen->id , $this->_guided_tour->get_screens() ) ) {

            wp_enqueue_style( 'tap-guided-tour_css' , $this->_constants->CSS_ROOT_URL() . 'admin/tap-guided-tour.css' , array( 'wp-pointer' ) , Plugin_Constants::VERSION , 'all' );
            wp_enqueue_script( 'tap-guided-tour_js' , $this->_constants->JS_ROOT_URL() . 'app/tap-guided-tour.js' , array( 'wp-pointer' , 'thickbox' ) , Plugin_Constants::VERSION , true );

            wp_localize_script( 'tap-guided-tour_js',
                'tap_guided_tour_params',
                array(
                    'actions'  => array( 'close_tour' => 'tap_close_guided_tour' ),
                    'nonces'   => array( 'close_tour' => wp_create_nonce( 'tap-close-guided-tour' ) ),
                    'screen'   => $this->_guided_tour->get_current_screen(),
                    'screenid' => $screen->id,
                    'height'   => 640,
                    'width'    => 640,
                    'texts'    => array(
                                     'btn_prev_tour'  => __( 'Previous', 'thirstyaffiliates-pro' ),
                                     'btn_next_tour'  => __( 'Next', 'thirstyaffiliates-pro' ),
                                     'btn_close_tour' => __( 'Close', 'thirstyaffiliates-pro' ),
                                     'btn_start_tour' => __( 'Yes, Show Quick Tour', 'thirstyaffiliates-pro' )
                                 ),
                    'urls'     => array( 'ajax' => admin_url( 'admin-ajax.php' ) ),
                    'post'     => isset( $post ) && isset( $post->ID ) ? $post->ID : 0
                )
            );
        }


    }

    /**
     * Load frontend js and css scripts.
     *
     * @since 1.0.0
     * @since 1.2.0 Remove GCT script
     * @access public
     */
    public function load_frontend_scripts() {

        global $post, $wp;

    }

    /**
     * Execute plugin script loader.
     *
     * @since 1.0.0
     * @access public
     */
    public function run () {

        add_action( 'admin_enqueue_scripts' , array( $this , 'load_backend_scripts' ) , 11 , 1 );
    }

}
