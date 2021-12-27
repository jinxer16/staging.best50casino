<?php
namespace ThirstyAffiliates_Pro\Helpers;

use ThirstyAffiliates_Pro\Abstracts\Abstract_Main_Plugin_Class;

use GeoIp2\Database\Reader as MaxMindReader;
use GeoIp2\WebService\Client as MaxMindClient;

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Model that houses all the helper functions of the plugin.
 *
 * 1.0.0
 */
class Helper_Functions {

    /*
    |--------------------------------------------------------------------------
    | Class Properties
    |--------------------------------------------------------------------------
    */

    /**
     * Property that holds the single main instance of Helper_Functions.
     *
     * @since 1.0.0
     * @access private
     * @var Helper_Functions
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
     * @param Abstract_Main_Plugin_Class $main_plugin Main plugin object.
     * @param Plugin_Constants           $constants   Plugin constants object.
     */
    public function __construct( Abstract_Main_Plugin_Class $main_plugin , Plugin_Constants $constants ) {

        $this->_constants = $constants;

        $main_plugin->add_to_public_helpers( $this );

    }

    /**
     * Ensure that only one instance of this class is loaded or can be loaded ( Singleton Pattern ).
     *
     * @since 1.0.0
     * @access public
     *
     * @param Abstract_Main_Plugin_Class $main_plugin Main plugin object.
     * @param Plugin_Constants           $constants   Plugin constants object.
     * @return Helper_Functions
     */
    public static function get_instance( Abstract_Main_Plugin_Class $main_plugin , Plugin_Constants $constants ) {

        if ( !self::$_instance instanceof self )
            self::$_instance = new self( $main_plugin , $constants );

        return self::$_instance;

    }




    /*
    |--------------------------------------------------------------------------
    | Helper Functions
    |--------------------------------------------------------------------------
    */

    /**
     * Write data to plugin log file.
     *
     * @since 1.0.0
     * @access public
     *
     * @param mixed Data to log.
     */
    public function write_debug_log( $log )  {

        error_log( "\n[" . current_time( 'mysql' ) . "]\n" . $log . "\n--------------------------------------------------\n" , 3 , $this->_constants->LOGS_ROOT_PATH() . 'debug.log' );

    }

    /**
     * Check if current user is authorized to manage the plugin on the backend.
     *
     * @since 1.0.0
     * @access public
     *
     * @param WP_User $user WP_User object.
     * @return boolean True if authorized, False otherwise.
     */
    public function current_user_authorized( $user = null ) {

        // Array of roles allowed to access/utilize the plugin
        $admin_roles = apply_filters( 'ucfw_admin_roles' , array( 'administrator' ) );

        if ( is_null( $user ) )
            $user = wp_get_current_user();

        if ( $user->ID )
            return count( array_intersect( ( array ) $user->roles , $admin_roles ) ) ? true : false;
        else
            return false;

    }

    /**
     * Returns the timezone string for a site, even if it's set to a UTC offset
     *
     * Adapted from http://www.php.net/manual/en/function.timezone-name-from-abbr.php#89155
     *
     * Reference:
     * http://www.skyverge.com/blog/down-the-rabbit-hole-wordpress-and-timezones/
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Valid PHP timezone string
     */
    public function get_site_current_timezone() {

        // if site timezone string exists, return it
        if ( $timezone = get_option( 'timezone_string' ) )
            return $timezone;

        // get UTC offset, if it isn't set then return UTC
        if ( 0 === ( $utc_offset = get_option( 'gmt_offset', 0 ) ) )
            return 'UTC';

        return $this->convert_utc_offset_to_timezone( $utc_offset );

    }

    /**
     * Conver UTC offset to timezone.
     *
     * @since 1.2.0
     * @access public
     *
     * @param float/int/string $utc_offset UTC offset.
     * @return string valid PHP timezone string
     */
    public function convert_utc_offset_to_timezone( $utc_offset ) {

        // adjust UTC offset from hours to seconds
        $utc_offset *= 3600;

        // attempt to guess the timezone string from the UTC offset
        if ( $timezone = timezone_name_from_abbr( '' , $utc_offset , 0 ) )
            return $timezone;

        // last try, guess timezone string manually
        $is_dst = date( 'I' );

        foreach ( timezone_abbreviations_list() as $abbr )
            foreach ( $abbr as $city )
                if ( $city[ 'dst' ] == $is_dst && $city[ 'offset' ] == $utc_offset )
                    return $city[ 'timezone_id' ];

        // fallback to UTC
        return 'UTC';

    }

    /**
     * Get all user roles.
     *
     * @since 1.0.0
     * @access public
     *
     * @global WP_Roles $wp_roles Core class used to implement a user roles API.
     *
     * @return array Array of all site registered user roles. User role key as the key and value is user role text.
     */
    public function get_all_user_roles() {

        global $wp_roles;
        return $wp_roles->get_names();

    }

    /**
     * Check validity of a save post action.
     *
     * @since 1.0.0
     * @access private
     *
     * @param int    $post_id   Id of the coupon post.
     * @param string $post_type Post type to check.
     * @return bool True if valid save post action, False otherwise.
     */
    public function check_if_valid_save_post_action( $post_id , $post_type ) {

        if ( get_post_type() != $post_type || empty( $_POST ) || wp_is_post_autosave( $post_id ) || wp_is_post_revision( $post_id ) || !current_user_can( 'edit_page' , $post_id ) )
            return false;
        else
            return true;

    }

    /**
     * Retrieve all countries in the system, return an associative array
     *
     * @since 1.0.0
     * @access public
     *
     * @return array an associative array of (country code => country name)
     */
    public function get_all_countries( $geolinks = array() ) {

        $xml_file = $this->_constants->PLUGIN_DIR_PATH() . 'countryList.xml';

        if ( ! function_exists( 'simplexml_load_file' ) || ! file_exists( $xml_file ) )
            return array();

        $countries     = array();
        $xml_countries = simplexml_load_file( $xml_file );

        if ( empty( $xml_countries ) )
            return array();

        foreach ( $xml_countries->{ 'country' } as $country ) {

			$code               = (string) $country->{ 'code' };
			$name               = (string) $country->{ 'name' };
			$countries[ $code ] = $name;
		}

        // remove the countries that have been registered in a geolink
        if ( ! empty( $geolinks ) ) {

            $used_countries = array();

            foreach ( $geolinks as $key => $geolink ) {

                $countries      = explode( ',' , $key );
                $used_countries = array_merge( $used_countries , $countries );
            }

            foreach ( $used_countries as $used_country )
                unset( $countries[ $used_country ] );
        }

        return $countries;
    }

    /**
     * Retrieve all available countries that has not yet been used in the geolinks.
     *
     * @since 1.0.0
     * @access public
     *
     * @param array $geolinks List of geolocation links meta.
     * @return array an associative array of (country code => country name)
     */
    public function get_available_countries( $geolinks ) {

        $used_countries = array();
        $countries = $this->get_all_countries();

        if ( ! is_array( $geolinks ) || empty( $geolinks ) )
            return $countries;

        foreach ( $geolinks as $key => $geolink ) {

            $geo_countries  = explode( ',' , $key );
            $used_countries = array_merge( $used_countries , $geo_countries );
        }

        foreach ( $used_countries as $used_country )
            unset( $countries[ $used_country ] );

        return $countries;
    }

    /**
     * Convert geolinks old format to new format
     *
     * @since 1.0.0
     * @access public
     *
     * @param array $old_geolinks Geolinks old format.
     * @return array Geolinks new format.
     */
    public function convert_geolinks_old_to_new_format( $old_geolinks ) {

        $temp_geolinks  = array();
        $geolinks       = array();
        $country_clones = array();
        $keys           = array();

        // seperate the geolinks with actual urls from the clone ones.
        foreach ( $old_geolinks as $country => $destination ) {

            if ( filter_var( $destination , FILTER_VALIDATE_URL ) === FALSE )
                $country_clones[ $country ] = $destination;
            else {

                $temp_geolinks[ $country ] = array(
                    'countries'       => array( $country ),
                    'destination_url' => $destination
                );
            }

        }

        // assign cloned countries to $temp_geolinks country data
        foreach ( $country_clones as $country => $cloned_country )
            $temp_geolinks[ $cloned_country ][ 'countries' ][] = $country;

        // generate key for each geolink and add to $geolinks array list
        foreach ( $temp_geolinks as $country => $data ) {

            $key              = trim( implode( ',' , $data[ 'countries' ] ) );
            $geolinks[ $key ] = $data[ 'destination_url' ];
        }

        return $geolinks;
    }

    /**
     * Get geolocation country (two character country code).
     *
     * @since 1.0.0
     * @access private
     *
     * @param string $ip_address IP address (IPv4 format only).
     * @return string Two character country code.
     */
    public function get_geolocation_country_by_ip( $ip_address ) {

        require_once( $this->_constants->PLUGIN_DIR_PATH() . 'MaxMind/autoload.php' );

        $maxmind_db_type      = get_option( 'tap_geolocations_maxmind_db' );
        $maxmind_db_file      = get_option( 'tap_geolocations_maxmind_mmdb_file' );
        $maxmind_web_api_user = get_option( 'tap_geolocations_maxmind_api_userid' );
        $maxmind_web_api_pass = get_option( 'tap_geolocations_maxmind_api_key' );

        if ( ! filter_var( $ip_address , FILTER_VALIDATE_IP , FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE ) ) {

            $country_code = 'Invalid IPv4 address.';

        } elseif ( $maxmind_db_type === 'premium' && is_file( $maxmind_db_file ) ) {

            // Load the MaxMind Database Reader API
            try {
                $reader       = new MaxMindReader( $maxmind_db_file );
                $record       = $reader->country( $ip_address );
                $country_code = $record->country->isoCode;
            } catch ( \Exception $e ) {
                $country_code = 'Invalid IPv4 address.';
            }

        } elseif ( $maxmind_db_type === 'web_service' && $maxmind_web_api_user && $maxmind_web_api_pass ) {

            // Load the MaxMind Web Service API
            try {
    			$client       = new MaxMindClient( $maxmind_web_api_user , $maxmind_web_api_pass );
    			$record       = $client->country( $ip_address );
    			$country_code = $record->country->isoCode;
    		} catch ( \Exception $e ) {
    			$countryCode = 'Invalid IPv4 address.';
    		}

        } else {

            $maxmind_db_file = $this->_constants->TA_UPLOADS_DIR() . $this->get_geolite2_country_mmdb_file();

            // Load the MaxMind Database Reader API
            try {
                $reader       = new MaxMindReader( $maxmind_db_file );
                $record       = $reader->country( $ip_address );
                $country_code = $record->country->isoCode;
            } catch ( \Exception $e ) {
                $country_code = 'Invalid IPv4 address.';
            }
        }

        // DEFAULT BEHAVIOUR: if we can't get the country code return false
        if ( ! $country_code || $country_code == 'Invalid IPv4 address.' )
            return;

        // Return the two character country code
        return $country_code;
    }

    /**
     * Get source Geolite2-Country.mmdb file from uploads dir
     *
     * @since 1.0.0
     * @access private
     *
     * @return string Geolite2-Country.mmdb file path.
     */
    public function get_geolite2_country_mmdb_file() {

        $dir = $this->_constants->TA_UPLOADS_DIR();

        foreach ( scandir( $dir ) as $file ) {
            $filex = explode( '.' , $file );
            if ( $filex[1] == 'mmdb' && is_file( $dir . $file ) )
                return $file;
        }

        return;
    }

    /**
     * Display link health status.
     *
     * @since 1.2.0
     * @since 1.3.0 Update function so it will not need $thirstylink object anymore.
     * @access public
     *
     * @param string $status            Link health status.
     * @param string $last_checked_date Date link health last checked.
     * @param bool   $print             Toggle for print or return.
     */
    public function display_link_health_status( $status , $last_checked_date , $print = true ) {

        $timezone     = new \DateTimeZone( $this->get_site_current_timezone() );
        $last_checked = new \DateTime( $last_checked_date , $timezone );
        $tooltip      = $status == 'waiting' ? __( 'Not yet checked.' , 'thirstyaffiliates-pro' ) : __( 'Last checked on ' , 'thirstyaffiliates-pro' );
        $tooltip     .= $status != 'waiting' ? $last_checked->format( 'F j, Y h:i:s' ) : '';
        $statuses     = array(
            'waiting'  => __( 'waiting' , 'thirstyaffiliates-pro' ),
            'active'   => __( 'okay' , 'thirstyaffiliates-pro' ),
            'inactive' => __( 'error' , 'thirstyaffiliates-pro' ),
            'warning'  => __( 'warning' , 'thirstyaffiliates-pro' ),
            'error'    => __( 'error' , 'thirstyaffiliates-pro' ),
            'ignored'  => __( 'okay' , 'thirstyaffiliates-pro' )
        );

        $markup = '<span class="tooltip ' . $status . '" data-tip="' . $tooltip . '">' . $statuses[ $status ] . '</span>';

        if ( $print )
            echo $markup;
        else
            return $markup;
    }

    /**
     * Get Affiliate link schedule.
     * 
     * @since 1.3.0
     * @access public
     * 
     * @param Affiliate_Link $thirstylink Affiliate_Link object
     * @return mixed 'early' | 'expire' if schedule is set and depends on logic, 'true' if schedule is set and on schedule, false otherwise.
     */
    public function get_thirstylink_schedule( $thirstylink ) {

        $timezone    = new \DateTimeZone( $this->get_site_current_timezone() );
        $today       = new \DateTime( "now" , $timezone );
        $start_date  = \DateTime::createFromFormat( 'Y-m-d' , $thirstylink->get_prop( 'link_start_date' ) , $timezone );
        $expire_date = \DateTime::createFromFormat( 'Y-m-d' , $thirstylink->get_prop( 'link_expire_date' ) , $timezone );

        // NOTE: returning actual "false" value here is intended.
        if ( ! $start_date && ! $expire_date )
            return false;

        if ( is_object( $start_date ) && $today < $start_date )
            return 'early';
        elseif ( is_object( $expire_date ) && $today >= $expire_date )
            return 'expire';
        else
            return true;

        // NOTE: returning actual "false" value here is intended.
        return false;
    }

    /**
     * Get URL Shortener API option.
     * 
     * @since 1.3.0
     * @access public
     * 
     * @param string $active_service URL Shortener active service.
     * @return string Active service API option name.
     */
    public function get_url_shortener_api_option( $active_service ) {

        $shortener_api_option = '';
        switch( $active_service ) {
                
            case 'googl' :
                $shortener_api_option = 'tap_googl_api_key';
                break;
                
            case 'firebasedl' :
                $shortener_api_option = 'tap_firebase_dynamic_links_api_key';
                break;

            case 'bitly' :
            default :
                $shortener_api_option = 'tap_bitly_access_token';
                break;

        }

        return $shortener_api_option;
    }

    /**
     * Detect which URL shortener service is used for a given shortened URL.
     * 
     * @since 1.3.0
     * @param string $shortened_url Shortened URL.
     * @return string Service used to shorten URL. 
     */
    public function detect_url_shortener_service_used( $shortened_url ) {

        if ( ! $shortened_url ) return;

        if ( strpos( $shortened_url , 'app.goo.gl' ) !== false )
            return 'firebasedl';
        elseif ( strpos( $shortened_url , 'goo.gl' ) !== false )
            return 'googl';

        return 'bitly';
    }
}
