<?php
namespace ThirstyAffiliates_Pro\Models\SLMW;

use ThirstyAffiliates_Pro\Abstracts\Abstract_Main_Plugin_Class;

use ThirstyAffiliates_Pro\Interfaces\Model_Interface;
use ThirstyAffiliates_Pro\Interfaces\Activatable_Interface;
use ThirstyAffiliates_Pro\Interfaces\Deactivatable_Interface;

use ThirstyAffiliates_Pro\Helpers\Plugin_Constants;
use ThirstyAffiliates_Pro\Helpers\Helper_Functions;

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Model that houses the logic of updating the plugin.
 *
 * @since 1.0.0
 */
class Update implements Model_Interface , Deactivatable_Interface {

    /*
    |--------------------------------------------------------------------------
    | Class Properties
    |--------------------------------------------------------------------------
    */

    /**
     * Property that holds the single main instance of Update.
     *
     * @since 1.0.0
     * @access private
     * @var Update
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
     * @return Update
     */
    public static function get_instance( Abstract_Main_Plugin_Class $main_plugin , Plugin_Constants $constants , Helper_Functions $helper_functions ) {

        if ( !self::$_instance instanceof self )
            self::$_instance = new self( $main_plugin , $constants , $helper_functions );

        return self::$_instance;

    }

	/**
	 * Hijack the WordPress 'set_site_transient' function for 'update_plugins' transient.
	 * So now we don't have our own cron to check for updates, we just rely on when WordPress check updates for plugins and themes,
	 * and if WordPress does then sets the 'update_plugins' transient, then we hijack it and check for our own plugin update.
	 *
	 * @since 1.2.3
	 * @access public
	 *
	 * @param array $update_plugins Update plugins data.
	 */
    public function update_check( $update_plugins ) {

        /**
         * Function wp_update_plugins calls set_site_transient( 'update_plugins' , ... ) twice, yes twice
         * so we need to make sure we are on the last call before checking plugin updates
         * the last call will have the checked object parameter
         */
        if ( isset( $update_plugins->checked ) )
            $this->ping_for_new_version(); // Check plugin for updates

        /**
         * We try to inject plugin update data if it has any
         * This is to fix the issue about plugin info appearing/disappearing
         * when update page in WordPress is refreshed
         */
        $result = $this->inject_plugin_update(); // Inject new update data if there are any

        if ( $result && isset( $update_plugins->response ) && is_array( $update_plugins->response ) && !array_key_exists( $result[ 'key' ] , $update_plugins->response ) )
            $update_plugins->response[ $result[ 'key' ] ] = $result[ 'value' ];

        return $update_plugins;

    }

    /**
     * Ping plugin for new version. Ping static file first, if indeed new version is available, trigger update data request.
     *
     * @since 1.0.0
	 * @since 1.2.3 Refactor codebase to adapt to being called now on set_site_transient.
     * @access public
     */
    public function ping_for_new_version() {

		if ( get_option( Plugin_Constants::OPTION_LICENSE_ACTIVATED ) !== 'yes' ) {

			delete_option( Plugin_Constants::OPTION_UPDATE_DATA );
			return;

		}

		if ( get_option( Plugin_Constants::OPTION_RETRIEVING_UPDATE_DATA ) === 'yes' )
			return;

        $update_data = get_option( Plugin_Constants::OPTION_UPDATE_DATA );

        if ( $update_data ) {

            if ( isset( $update_data->download_url ) ) {

                $file_headers = @get_headers( $update_data->download_url );

				if ( strpos( $file_headers[ 0 ] , '404' ) !== false ) {

                    delete_option( Plugin_Constants::OPTION_UPDATE_DATA ); // For some reason the update url is not valid anymore, delete the update data.
					$update_data = null;

				}

            } else {

				delete_option( Plugin_Constants::OPTION_UPDATE_DATA ); // For some reason the update url is not valid anymore, delete the update data.
				$update_data = null;

			}

        }

        /**
         * Even if the update data is still valid, we still go ahead and do static json file ping.
         * The reason is on WooCommerce 3.3.x , it seems WooCommerce do not regenerate the download url every time you change the downloadable zip file on WooCommerce store.
         * The side effect is, the download url is still valid, points to the latest zip file, but the update info could be outdated coz we check that if the download url
         * is still valid, we don't check for update info, and since the download url will always be valid even after subsequent release of the plugin coz WooCommerce is reusing the url now
         * then there will be a case our update info is outdated. So that is why we still need to check the static json file, even if update info is still valid.
         */

        $option = array(
            'timeout' => 10 , //seconds coz only static json file ping
            'headers' => array( 'Accept' => 'application/json' )
        );

        $response = wp_remote_retrieve_body( wp_remote_get( apply_filters( 'tap_plugin_new_version_ping_url' , Plugin_Constants::STATIC_PING_FILE ) , $option ) );

        if ( !empty( $response ) ) {

            $response = json_decode( $response );

            if ( !empty( $response ) && property_exists( $response , 'version' ) ) {

				$installed_version = get_option( Plugin_Constants::INSTALLED_VERSION );

				if ( ( !$update_data && version_compare( $response->version , $installed_version , '>' ) ) ||
				     ( $update_data && version_compare( $response->version , $update_data->latest_version , '>' ) ) ) {

                    update_option( Plugin_Constants::OPTION_RETRIEVING_UPDATE_DATA , 'yes' );

                    // Fetch software product update data
                    $this->_fetch_software_product_update_data( get_option( Plugin_Constants::OPTION_ACTIVATION_EMAIL ) , get_option( Plugin_Constants::OPTION_LICENSE_KEY ) , home_url() );

                    delete_option( Plugin_Constants::OPTION_RETRIEVING_UPDATE_DATA );

                }

            }

        }

    }

    /**
     * Fetch software product update data.
     *
     * @since 1.0.0
     * @access public
     *
     * @param string $activation_email Activation email.
     * @param string $license_key      License key.
     * @param string $site_url         Site url.
     */
    private function _fetch_software_product_update_data( $activation_email , $license_key , $site_url ) {

        $update_check_url = add_query_arg( array(
            'activation_email' => urlencode( $activation_email ),
            'license_key'      => $license_key,
            'site_url'         => $site_url
        ) , apply_filters( 'tap_software_product_update_data_url' , Plugin_Constants::UPDATE_DATA_URL ) );

        $option = array(
            'timeout' => 30 , // seconds for worst case the server is choked and takes little longer to get update data ( this is an ajax end point )
            'headers' => array( 'Accept' => 'application/json' )
        );

        $result = wp_remote_retrieve_body( wp_remote_get( $update_check_url , $option ) );

        if ( !empty( $result ) ) {

            $result = json_decode( $result );

            if ( !empty( $result ) && $result->status === 'success' && !empty( $result->software_update_data ) )
                update_option( Plugin_Constants::OPTION_UPDATE_DATA , $result->software_update_data );
            else {

                delete_option( Plugin_Constants::OPTION_UPDATE_DATA );

                if ( !empty( $result ) && $result->status === 'fail' && isset( $result->error_key ) && $result->error_key === 'invalid_license' )
                    update_option( Plugin_Constants::OPTION_LICENSE_ACTIVATED , 'no' ); // Invalid license

            }

        }

    }

    /**
     * Inject plugin update info to plugin update details page.
     * Note, this is only triggered when there is a new update and the "View version <new version here> details" link is clicked.
     * In short, the pure purpose for this is to provide details and info the update info popup.
     *
     * @since 1.0.0
     * @access public
     *
	 * @param false|object|array $result The result object or array. Default false.
	 * @param string             $action The type of information being requested from the Plugin Install API.
     * @param object             $args   Plugin API arguments.
     * @return array Plugin update info.
     */
    public function inject_plugin_update_info( $result , $action , $args ) {

        if ( $action == 'plugin_information' && isset( $args->slug ) && $args->slug == 'thirstyaffiliates-pro' ) {

            $software_update_data = get_option( Plugin_Constants::OPTION_UPDATE_DATA );

            if ( $software_update_data ) {

                $update_info = new \StdClass;

                $update_info->name          = 'ThirstyAffiliates Pro';
                $update_info->slug          = 'thirstyaffiliates-pro';
                $update_info->version       = $software_update_data->latest_version;
                $update_info->tested        = $software_update_data->tested_up_to;
                $update_info->last_updated  = $software_update_data->last_updated;
                $update_info->homepage      = $software_update_data->home_page;
                $update_info->author        = sprintf( '<a href="%s" target="_blank">%s</a>' , $software_update_data->author_url , $software_update_data->author );
                $update_info->download_link = $software_update_data->download_url;
                $update_info->sections = array(
                    'description'  => $software_update_data->description,
                    'installation' => $software_update_data->installation,
                    'changelog'    => $software_update_data->changelog,
                    'support'      => $software_update_data->support
                );

				$update_info->icons = array(
					'1x'      => 'https://ps.w.org/thirstyaffiliates/assets/pro-icon-128x128.jpg',
					'2x'      => 'https://ps.w.org/thirstyaffiliates/assets/pro-icon-256x256.jpg',
					'default' => 'https://ps.w.org/thirstyaffiliates/assets/pro-icon-256x256.jpg'
				);

				$update_info->banners = array(
					'low'  => 'https://ps.w.org/thirstyaffiliates/assets/pro-banner-772x250.jpg',
					'high' => 'https://ps.w.org/thirstyaffiliates/assets/pro-banner-1544x500.jpg',
				);

                return $update_info;

            }

        }

        return $result;

    }

    /**
     * When wordpress fetch 'update_plugins' transient ( Which holds various data regarding plugins, including which have updates ),
     * we inject our plugin update data in, if any. It is saved on Plugin_Constants::OPTION_UPDATE_DATA option.
     * It is important we dont delete this option until the plugin have successfully updated.
     * The reason is we are hooking ( and we should do it this way ), on transient read.
     * So if we delete this option on first transient read, then subsequent read will not include our plugin update data.
     *
     * It also checks the validity of the update url. There could be edge case where we stored the update data locally as an option,
     * then later on the store, the product was deleted or any action occurred that would deem the update data invalid.
     * So we check if update url is still valid, if not, we remove the locally stored update data.
     *
     * @since 1.0.0
	 * @since 1.2.3
	 * Refactor codebase to adapt being called on set_site_transient function.
	 * We don't need to check for software update data validity as its already been checked on ping_for_new_version
	 * and this function is immediately called right after that.
     * @access public
     *
     * @param array $updates Plugin updates data.
     * @return array Filtered plugin updates data.
     */
    public function inject_plugin_update() {

        $software_update_data = get_option( Plugin_Constants::OPTION_UPDATE_DATA );

        if ( $software_update_data ) {

			$update = new \stdClass();

			$update->id          = $software_update_data->download_id;
			$update->slug        = 'thirstyaffiliates-pro';
			$update->plugin      = $this->_constants->PLUGIN_BASENAME();
			$update->new_version = $software_update_data->latest_version;
			$update->url         = Plugin_Constants::PLUGIN_SITE_URL;
			$update->package     = $software_update_data->download_url;
			$update->tested      = $software_update_data->tested_up_to;

			$update->icons = array(
				'1x'      => 'https://ps.w.org/thirstyaffiliates/assets/pro-icon-128x128.jpg',
				'2x'      => 'https://ps.w.org/thirstyaffiliates/assets/pro-icon-256x256.jpg',
				'default' => 'https://ps.w.org/thirstyaffiliates/assets/pro-icon-256x256.jpg'
			);

			$update->banners = array(
				'1x'      => 'https://ps.w.org/thirstyaffiliates/assets/pro-banner-772x250.jpg',
				'2x'      => 'https://ps.w.org/thirstyaffiliates/assets/pro-banner-1544x500.jpg',
				'default' => 'https://ps.w.org/thirstyaffiliates/assets/pro-banner-1544x500.jpg'
			);

			return array(
				'key'   => $this->_constants->PLUGIN_BASENAME(),
				'value' => $update
			);

        }

        return false;

    }

    /**
     * Delete the plugin update data after the plugin successfully updated.
     *
     * References:
     * https://stackoverflow.com/questions/24187990/plugin-update-hook
     * https://codex.wordpress.org/Plugin_API/Action_Reference/upgrader_process_complete
     *
     * @since 1.0.0
     * @access public
     *
     * @param Plugin_Upgrader $upgrader_object Plugin_Upgrader instance.
     * @param array           $options         Options.
     */
    public function after_plugin_update( $upgrader_object , $options ) {

        if ( $options[ 'action' ] == 'update' && $options[ 'type' ] == 'plugin' ) {

            foreach ( $options[ 'plugins' ] as $each_plugin ) {

                if ( $each_plugin == $this->_constants->PLUGIN_BASENAME() ) {

					delete_option( Plugin_Constants::OPTION_UPDATE_DATA );

					// Remove our own cron that checks for plugin updates, we are hijacking WordPress now
					$timestamp = wp_next_scheduled( Plugin_Constants::CRON_PING_NEW_VERSION );
					wp_unschedule_event( $timestamp , Plugin_Constants::CRON_PING_NEW_VERSION );

					wp_clear_scheduled_hook( Plugin_Constants::CRON_PING_NEW_VERSION );

                    break;

                }

            }

        }

    }




    /*
    |--------------------------------------------------------------------------
    | Implemented Interface Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Execute code base that needs to be run on plugin deactivation.
     *
     * @since 1.0.0
     * @access public
     * @implements ThirstyAffiliates\Interfaces\Deactivatable_Interface
     */
    public function deactivate() {

        delete_option( Plugin_Constants::OPTION_UPDATE_DATA ); // Delete plugin update option data

    }

    /**
     * Execute Model.
     *
     * @since 1.0.0
     * @access public
     * @implements ThirstyAffiliates\Interfaces\Model_Interface
     */
    public function run() {

		add_filter( 'pre_set_site_transient_update_plugins' , array( $this , 'update_check' ) );
        add_filter( 'plugins_api'                           , array( $this , 'inject_plugin_update_info' ) , 10 , 3);
        add_action( 'upgrader_process_complete'             , array( $this , 'after_plugin_update' ) , 10 , 2 );

    }

}
