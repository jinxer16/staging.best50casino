<?php
namespace ThirstyAffiliates_Pro\Models\SLMW;

use ThirstyAffiliates_Pro\Abstracts\Abstract_Main_Plugin_Class;

use ThirstyAffiliates_Pro\Interfaces\Model_Interface;

use ThirstyAffiliates_Pro\Helpers\Plugin_Constants;
use ThirstyAffiliates_Pro\Helpers\Helper_Functions;

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Model that houses the logic of Software License Manager plugin integration settings.
 * 
 * @since 1.0.0
 */
class Settings implements Model_Interface {

    /*
    |--------------------------------------------------------------------------
    | Class Properties
    |--------------------------------------------------------------------------
    */

    /**
     * Property that holds the single main instance of Settings.
     *
     * @since 1.0.0
     * @access private
     * @var Settings
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
     * @return Settings
     */
    public static function get_instance( Abstract_Main_Plugin_Class $main_plugin , Plugin_Constants $constants , Helper_Functions $helper_functions ) {

        if ( !self::$_instance instanceof self )
            self::$_instance = new self( $main_plugin , $constants , $helper_functions );

        return self::$_instance;

    }

    /**
     * Register slmw settings section.
     *
     * @since 1.0.0
     * @access public
     *
     * @param array $settings_sections Array of settings sections.
     * @return array Filtered array of settings sections.
     */
    public function register_slmw_settings_section( $settings_sections ) {

        if ( array_key_exists( 'tap_slmw_settings_section' , $settings_sections ) )
            return $settings_sections;

        $settings_sections[ 'tap_slmw_settings_section' ] = array(
            'title' => __( 'License' , 'thirstyaffiliates-pro' ),
            'desc'  => sprintf( __( 'Enter the activation email and the license key given to you after purchasing ThirstyAffiliates Pro. You can find this information by logging into your <a href="%1$s" target="_blank">My Account</a> on our website or in the purchase confirmation email sent to your email address.' , 'thirstyaffiliates-pro' ) , "https://thirstyaffiliates.com/my-account" )
        );

        return $settings_sections;

    }

    /**
     * Register amazon settings section options.
     *
     * @since 1.0.0
     * @access public
     *
     * @param array $settings_section_options Array of options per settings sections.
     * @return array Filtered array of options per settings sections.
     */
    public function register_slmw_settings_section_options( $settings_section_options ) {

        if ( array_key_exists( 'tap_slmw_settings_section' , $settings_section_options ) )
            return $settings_section_options;

        $settings_section_options[ 'tap_slmw_settings_section' ] = apply_filters(
            'tap_slmw_settings_section_options' ,
            array(
                array(
                    'id'    => 'tap_slmw_activation_email',
                    'title' => __( 'Activation Email' , 'thirstyaffiliates-pro' ),
                    'desc'  => '',
                    'type'  => 'text',
                ),
                array(
                    'id'    => 'tap_slmw_license_key',
                    'title' => __( 'License Key' , 'thirstyaffiliates-pro' ),
                    'desc'  => '',
                    'type'  => 'text',
                )
            ) 
        );

        return $settings_section_options;

    }




    /*
    |--------------------------------------------------------------------------
    | Implemented Interface Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Execute plugin script loader.
     *
     * @since 1.0.0
     * @access public
     * @implements ThirstyAffiliates\Interfaces\Model_Interface
     */
    public function run () {
    
        add_filter( 'ta_settings_option_sections' , array( $this , 'register_slmw_settings_section' ) );
        add_filter( 'ta_settings_section_options' , array( $this , 'register_slmw_settings_section_options' ) );
        
    }

}