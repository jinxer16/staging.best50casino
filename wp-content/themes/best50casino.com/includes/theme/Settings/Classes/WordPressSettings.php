<?php
/**
 * Created by PhpStorm.
 * User: Panos
 * Date: 6/6/2019
 * Time: 11:34 πμ
 * https://www.ibenic.com/creating-wordpress-menu-pages-oop/#examples
 */

abstract class WordPressSettings
{
    /**
     * ID of the settings
     * @var string
     */
    public $settings_id = '';
    /**
     * Tabs for the settings page
     * @var array
     */
    public $tabs = array(
        'general' => 'General');
    /**
     * Settings from database
     * @var array
     */
    protected $settings = array();
    /**
     * Array of fields for the general tab
     * array(
     *    'tab_slug' => array(
     *        'field_name' => array(),
     *        ),
     *    )
     * @var array
     */
    protected $fields = array();
    /**
     * Data gotten from POST
     * @var array
     */
    protected $posted_data = array();

    public function __construct()
    {
        $themeSettings = new SettingsSetup();
    }
    /**
     * Get the Country's Continent
     * @return array [country] => [Continent]
     */
    public function getCountryContinent() //TODO Check if valid
    {
        $url = TEMPLATEPATH . '/includes/theme/Settings/CountriesContinents.json';
        $request = file_get_contents($url);
        $countriesContinents = json_decode($request, true);

        $continentsArray = [];
        foreach ($countriesContinents as $key => $item) {
            foreach ($item as $code => $name) {
                $continentsArray[$code] = $key;
            }
        };
        return $continentsArray;
    }
    /**
     * Get the Available Currencies
     * @return Array [main] => Language
     *          images => ['language'=>'image']
     */
    public static function getAvailableCurrencies() //Checked Valid
    {
        $genOptions = get_option('review-currencies');
        return $genOptions;
    }

    /**
     * Get the Available Currencies
     * @return Array [] => CS Channel name
     */
    public static function getAvailableCSChannels() //Checked Valid
    {
        $genOptions = get_option('cs-channels') ? get_option('cs-channels') : ['Email', 'Phone', 'Callback', 'Skype', 'Viber', 'Live Chat', 'Video Chat', 'Web Message', 'Twitter', 'Facebook', 'Instagram'];
        return $genOptions;
    }

    /**
     * Get Featured
     * @return Array [main] => Language
     *          images => ['language'=>'image']
     */
    public static function getFeaturedFrontpage() //Checked Valid
    {
        $genOptions = get_option('featured-options-'.$GLOBALS['countryISO']);
        return $genOptions;
    }

    /**
     * Get Featured
     * @return Array [] => geoAds
     *          leftskin => ['lskin'=>'image','lskin'=>'script','lskin'=>'affurl','lskin'=>'imgon']
     */
    public static function getGeoSkins() //Checked Valid
    {
        $genOptions = get_option('geoAds-'.$GLOBALS['countryISO']);
        return $genOptions;
    }

    /**
     * Get the Available Web Languages
     * @return Array [iso] => name
     *
     */
    public static function getAvailableLanguages() ///Checked Valid
    {
        $genOptions = get_option('web-languages');
        return $genOptions;
    }
    /**
     * Get the Available CS Languages
     * @return Array [iso] => name
     *
     */
    public static function getAvailableCSLanguages() ///Checked Valid
    {
        $genOptions = get_option('cs-languages');
        return $genOptions;
    }

    /**
     * Get the country name by ISO (NOT THE ACTIVE NEITHER RESTRICTED, INSTEAD ALL THE COUNTRIES)
     * @return Array [iso] => name
     *
     */
    public static function getCountriesWithIDandName() ///Checked Valid
    {
        $url = TEMPLATEPATH . '/includes/theme/Settings/countriesArray.json';
        $request = file_get_contents($url);
        $countriesArray = json_decode($request, true);
        return $countriesArray;
    }

    /**
     * Get the Available Countries for Restriction
     * @return array [country] => countryName
     */
    public static function getAvailableRestrictedCountries()  //CHECKED VALID
    {
        $url = TEMPLATEPATH . '/includes/theme/Settings/countriesArray.json';
        $request = file_get_contents($url);
        $countriesArray = json_decode($request, true);
        $genOptions = get_option('restricted-countries_iso');
        foreach ($genOptions as $country => $setting) {
            $enabledCountries[$country] = $countriesArray[$country];
        }
        asort($enabledCountries);
        return $enabledCountries;
    }

    /**
     * Get the Regional settings
     * @return true/false
     */
    public static function isCountryActive($countryCode) //CHECKED VALID
    {
        $activecountries = WordPressSettings::getCountryEnabledSettings();
        return isset($activecountries[$countryCode]) && $activecountries[$countryCode] == true ? true : false;
    }

    /**
     * Get the Enabled Countries settings,
     * @return Array [country] => true if enabled, nothing if not
     */
    public static function getCountryEnabledSettings() //CHECKED VALID
    {
        $enabledCountries = get_option('enabled_countries_iso');
        return $enabledCountries;
    }
    /**
     * Get the Slot Themes,
     * @return Array [themeID] => themeName
     */
    public static function getSlotThemes() //CHECKED VALID
    {
        $enabledCountries = get_option('slot-themes');
        return $enabledCountries;
    }

    /**
     * Get the Enabled Countries settings,
     * @return Array [country] => post_id
     */
    public static function getCountryEnabledSettingsPosts() //CHECKED VALID
    {
        $enabledCountries = get_option('enabled_countries_page');
        return $enabledCountries;
    }
    /**
     * Get the Enabled Countries settings,
     * @return Array [country] => true if enabled, nothing if not
     */
    public static function getCountryEnabledSettingsWithNames() //CHECKED VALID
    {
        $url = TEMPLATEPATH . '/includes/theme/Settings/countriesArray.json';
        $request = file_get_contents($url);
        $countriesArray = json_decode($request, true);
        $settringsCountries = get_option('enabled_countries_iso');
        foreach ($settringsCountries as $country=>$value) {
            $enabledCountries[$country] = $countriesArray[$country];
        }
        return $enabledCountries;
    }

    /**
     * Get the Premium Bookies
     * @return Mixed    [order] => id,id,...
     * [premium] => id,id,...
     * $type country/region
     *
     */
    public static function getPremiumCasino($countryCode = "glb", $type = 'premium') //CHECKED valid
    {
        $genOptions = get_option('premium-casino-'.$countryCode);
        if($type=='premium'){
            $premiumBook = $genOptions['premium'];
        }elseif($type=='order'){
            $premiumBook = $genOptions['ids'];
        }elseif($type=='all'){
            $premiumBook = $genOptions;
        }
        return $premiumBook;
    }

    /**
     * Get the Premium Promotions
     * @return Mixed    [order] => id,id,...
     * [premium] => id,id,...
     * $type country/region
     *
     */
    public static function getPremiumPromotions($countryCode = "glb", $type = 'premium') //CHECKED valid
    {
        $genOptions = get_option('premium-promotions-'.$countryCode);
        if($type=='premium'){
            $premiumBook = explode(",",$genOptions['premium']);
        }elseif($type=='order'){
            $premiumBook = explode(",",$genOptions['ids']);
        }elseif($type=='all'){
            $premiumBook = $genOptions;
        }
        return $premiumBook;
    }

    /**
     * Get the Premium Bookies
     * @return Array    [] => id,id,...
     *
     * $type country/region
     *
     */
    public static function getPremiumPayments($countryCode = "glb") //CHECKED valid
    {
        $genOptions = get_option('premium-transactions-'.$countryCode);
        return $genOptions;
    }

    /**
     * Get the Premium Bookies
     * @return Array    [] => id,id,...
     *
     * $type country/region
     *
     */
    public static function getPremiumProviders($countryCode = "glb") //CHECKED valid
    {
        $genOptions = get_option('premium-softwares-'.$countryCode);
        return $genOptions ? $genOptions : get_option('premium-softwares-glb');
    }

    /**
     * Get the Geo Ads
     * @return Array   if isset
     *                   'top' => image=> if isset,script=>if isset ,img_on=> if isset ,image2=> if isset,script2=> if isset,img_on2=>if isset
     *                   'side' => same
     *                   'lskin' => same
     *                   'rskin' => same
     */
    public static function getGeoAds($countryCode = "-", $bookID = "DefaultBook") //TODO To be developed
    {
       // $genOptions = get_option('geo-ads');
        //$geoAds = $genOptions['geo-ads-settings'][$bookID][$countryCode];
        $geoAds = get_option('geoAds-'.$bookID.'-'.$countryCode);
		return $geoAds;
    }

    /**
     * Get the settings from the database
     * @return void
     */
    public function init_settings()
    {
        $this->settings = (array)get_option($this->settings_id);
        foreach ($this->fields as $tab_key => $tab) {

            foreach ($tab as $name => $field) {

                if (isset($this->settings[$name])) {
                    $this->fields[$tab_key][$name]['default'] = $this->settings[$name];
                }

            }
        }
    }

    /**
     * Save settings from POST
     * @return [type] [description]
     */
    public function save_settings()
    {

        $this->posted_data = $_POST;
//        print_r($_POST);

        if (empty($this->settings)) {
            $this->init_settings();
        }
        foreach ($this->fields as $tab => $tab_data) {

            foreach ($tab_data as $name => $field) {

                $this->settings[$name] = $this->{'validate_' . $field['type']}($name);

            }
        }
        update_option($this->settings_id, $this->settings);
    }

    /**
     * Gets and option from the settings API, using defaults if necessary to prevent undefined notices.
     *
     * @param  string $key
     * @param  mixed $empty_value
     * @return mixed  The value specified for the option or a default value for the option.
     */
    public function get_option($key, $empty_value = null)
    {
        if (empty($this->settings)) {
            $this->init_settings();
        }

        // Get option default if unset.
        if (!isset($this->settings[$key])) {
            $form_fields = $this->fields;

            foreach ($this->tabs as $tab_key => $tab_title) {
                if (isset($form_fields[$tab_key][$key])) {
                    $this->settings[$key] = isset($form_fields[$tab_key][$key]['default']) ? $form_fields[$tab_key][$key]['default'] : '';

                }
            }

        }
        if (!is_null($empty_value) && empty($this->settings[$key]) && '' === $this->settings[$key]) {
            $this->settings[$key] = $empty_value;
        }
        return $this->settings[$key];
    }

    /**
     * Validate text field
     * @param  string $key name of the field
     * @return string
     */
    public function validate_text($key)
    {
        $text = $this->get_option($key);
        if (isset($this->posted_data[$key])) {
            $text = wp_kses_post(trim(stripslashes($this->posted_data[$key])));
        }
        return $text;
    }

    /**
     * Validate repeat text field
     * @param  string $key name of the field
     * @return string
     */
    public function validate_repeat_text($key)
    {
        $text = $this->get_option($key);

        if (isset($this->posted_data[$key])) {
            $text = array_unique(array_filter($this->posted_data[$key], function ($value) {
                return $value !== '';
            }));
        }
        return $text;
    }

    public function validate_repeater_with_text_and_image($key)
    {
        $saveMe = $this->get_option($key) ? $this->get_option($key) : null;

        if (isset($this->posted_data[$key])) {
            $saveMe = array();

            foreach ($this->posted_data[$key] as $fieldName => $fieldData) {
                $test = array();

                foreach ($fieldData as $key => $value) {

                    if ($value) {

                        $test[$key] = $value;
                    }
                }
                if (!empty($test)) {

                    $saveMe[$fieldName] = $test;
                }
            }
        }

//        echo '<pre>';
//        print_r($saveMe);
//        echo '</pre>';
        return $saveMe;
    }

    /**
     * Validate textarea field
     * @param  string $key name of the field
     * @return string
     */

    public function validate_textarea($key)
    {
        $text = $this->get_option($key);

        if (isset($this->posted_data[$key])) {
            $text = wp_kses(trim(stripslashes($this->posted_data[$key])),
                array_merge(
                    array(
                        'iframe' => array('src' => true, 'style' => true, 'id' => true, 'class' => true)
                    ),
                    wp_kses_allowed_html('post')
                )
            );
        }
        return $text;
    }

    /**
     * Validate WPEditor field
     * @param  string $key name of the field
     * @return string
     */
    public function validate_wpeditor($key)
    {
        $text = $this->get_option($key);

        if (isset($this->posted_data[$key])) {
            $text = wp_kses(trim(stripslashes($this->posted_data[$key])),
                array_merge(
                    array(
                        'iframe' => array('src' => true, 'style' => true, 'id' => true, 'class' => true)
                    ),
                    wp_kses_allowed_html('post')
                )
            );
        }
        return $text;
    }

    /**
     * Validate select field
     * @param  string $key name of the field
     * @return string
     */
    public function validate_select($key)
    {
        $value = $this->get_option($key);
        if (isset($this->posted_data[$key])) {
            $value = stripslashes($this->posted_data[$key]);
        }
        return $value;
    }

    /**
     * Validate radio
     * @param  string $key name of the field
     * @return string
     */
    public function validate_radio($key)
    {
        $value = $this->get_option($key);
        if (isset($this->posted_data[$key])) {
            $value = stripslashes($this->posted_data[$key]);
        }
        return $value;
    }

    /**
     * Validate checkbox field
     * @param  string $key name of the field
     * @return string
     */
    public function validate_checkbox($key)
    {
        $status = '';
        if (isset($this->posted_data[$key]) && (1 == $this->posted_data[$key])) {
            $status = '1';
        }
        return $status;
    }

    /**
     * Validate select field
     * @param  string $key name of the field
     * @return string
     */
    public function validate_active_countries_table($key)
    {

        $saveMe = $this->get_option($key) ? $this->get_option($key) : null;
        if (isset($this->posted_data[$key])) {
            $saveMe = array();
            foreach ($this->posted_data[$key] as $fieldName => $fieldData) {
                $test = array();
                foreach ($fieldData as $key => $value) {

                    if ($value) {
                        $test[$key] = $value;
                    }
                }
                if (!empty($test)) {
                    $saveMe[$fieldName] = $test;
                }
            }
        }
        return $saveMe;
    }

    public function validate_image_select_text($key)
    {

        $saveMe = $this->get_option($key) ? $this->get_option($key) : null;

        if (isset($this->posted_data[$key])) {
            foreach ($this->posted_data[$key] as $fieldName => $fieldData) {
                $test = array();
                foreach ($fieldData as $key => $value) {

                    if ($value) {
                        $test[$key] = $value;
                    }
                }
                if (!empty($test)) {
                    $saveMe[$fieldName] = $test;
                }
            }
        }

        return $saveMe;
    }

    public function validate_ads_ajax($key)
    {
        return $key;
    }
    public function validate_meta_panel($key)
    {
        return $key;
    }
    public function validate_repeater_with_text($key)
    {
        return $key;
    }



    public function validate_sortable_list($key)
    {
        return $key;
    }
    public function validate_frontpage_options($key)
    {

        return $key;
    }
    public function validate_featured_articles($key)
    {

        return $key;
    }

    /**
     * Adding fields
     * @param array $array options for the field to add
     * @param string $tab tab for which the field is
     */
    public function add_field($array, $tab = 'general')
    {
        $allowed_field_types = array(
            'text',
            'repeat_text',
            'textarea',
            'wpeditor',
            'select',
            'radio',
            'checkbox',
            'active_countries_table',
            'image_select_text',
            'sortable_list',
            'ads',
            'ads_ajax',
            'meta_panel',
            'ajax_transfers',
            'featured_articles',
            'frontpage_options',
            'repeater_with_text_and_image',
            'repeater_with_text');
        // If a type is set that is now allowed, don't add the field
        if (isset($array['type']) && $array['type'] != '' && !in_array($array['type'], $allowed_field_types)) {
            return;
        }
        $defaults = array(
            'name' => '',
            'title' => '',
            'default' => '',
            'placeholder' => '',
            'type' => 'text',
            'options' => array(),
            'desc' => '',
        );
        $array = array_merge($defaults, $array);
        if ($array['name'] == '') {
            return;
        }
        foreach ($this->fields as $tabs) {
            if (isset($tabs[$array['name']])) {
                trigger_error('There is alreay a field with name ' . $array['name']);
                return;
            }
        }
        // If there are options set, then use the first option as a default value
        if (!empty($array['options']) && $array['default'] == '' && is_array($array['options'])) {
            $array_keys = array_keys($array['options']);
            $array['default'] = $array_keys[0];
        }
        if (!isset($this->fields[$tab])) {
            $this->fields[$tab] = array();
        }
        $this->fields[$tab][$array['name']] = $array;
    }

    /**
     * Adding tab
     * @param array $array options
     */
    public function add_tab($array)
    {
        $defaults = array(
            'slug' => '',
            'title' => '');
        $array = array_merge($defaults, $array);
        if ($array['slug'] == '' || $array['title'] == '') {
            return;
        }
        $this->tabs[$array['slug']] = $array['title'];
    }

    /**
     * Rendering fields
     * @param  string $tab slug of tab
     * @return void
     */
    public function render_fields($tab)
    {
        if (!isset($this->fields[$tab])) {
            echo '<p>' . __('There are no settings on these page.', 'textdomain') . '</p>';
            return;
        }
        foreach ($this->fields[$tab] as $name => $field) {

            $this->{'render_' . $field['type']}($field);
        }
    }

    /**
     * Render text field
     * @param  string $field options
     * @return void
     */
    public function render_text($field)
    {
        extract($field);
        ?>
        <tr>
            <td colspan="3">
                <div class="d-flex"><button onClick="saveSettings(event,this)" data-settings-id="<?=$name?>" class="btn btn-primary text-white">Save Settings</button></div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="<?=$name?>"><?=$title?></label>
            </th>
            <td>
                <div class="container-fluid repeater-content">
                    <div class="row">
                        <button class="btn btn-primary btn-sm pull-right repeater-add-btn single-text mb-1">
                            Add
                        </button>
                    </div>
                    <!-- Repeater Content -->
                    <div class="repeater-rows" data-group="<?=$name?>">
                <?php if($multi){
                    $defaultOptions = array('Email', 'Phone', 'Callback', 'Skype', 'Viber', 'Live Chat', 'Video Chat', 'Web Message', 'Twitter', 'Facebook', 'Instagram' );
                    $data = get_option($name) ? get_option($name) : $defaultOptions;
                    foreach ($data as $dat) {?>
                        <div class="items d-flex row mb-1">
                            <input type="<?=$type?>" name="<?=$name?>" id="<?=$name?>"
                                   value="<?=$dat?>" placeholder="<?=$placeholder?>" data-name="repeat" class="form-control form-control-sm col-2 fullname"/>
                        </div>
                    <?php }
                }else{ ?>
                    <input type="<?php echo $type; ?>" name="<?=$name?>" id="<?=$name?>"
                           value="<?php echo $dat; ?>" placeholder="<?=$placeholder?>"/>
                    <?php if ($desc != '') {
                        echo '<p class="description">' . $desc . '</p>';
                    }
                }
                 ?>
                    </div>
                </div>
            </td>
        </tr>

        <?php
    }

    /**
     * Render repeat text field
     * @param  string $field options
     * @return void
     */
    public function render_repeat_text($field)
    {
        extract($field);
//        print_r($field);
//        print_r($default[0]);
        ?>

        <tr>
            <th>
                <label for="<?=$name?>"><?=$title?></label>
            </th>
            <td>
                <div id="repeater" class="container-fluid">
                    <div class="row">
                        <button class="btn btn-primary btn-sm pull-right repeater-add-btn mb-1">
                            Add
                        </button>
                    </div>
                    <!-- Repeater Content -->
                    <?php
                    if ($default) {
                        foreach ($default as $key => $value) {
                            ?>
                            <div class="items d-flex row mb-1" data-group="<?=$name?>">
                                <input type="text" class="form-control form-control-sm col-10 " data-name="repeat"
                                       name="<?=$name?>[<?=$key?>]repeat"
                                       id="<?=$name?>_<?=$key?>" value="<?php echo $value; ?>"
                                       placeholder="<?=$placeholder?>"/>
                                <div class="pull-right repeater-remove-btn col-2">
                                    <button class="btn btn-danger remove-btn btn-sm">
                                        Remove
                                    </button>
                                </div>
                            </div>
                            <!-- Repeater Remove Btn -->

                            <div class="clearfix"></div>
                        <?php }
                    } else { ?>

                        <div class="items d-flex row mb-1" data-group="<?=$name?>">
                            <input type="text" class="form-control form-control-sm col-10" data-name="repeat"
                                   name="<?=$name?>[0]repeat"
                                   id="<?=$name?>_0" value=""
                                   placeholder="<?=$placeholder?>"/>

                            <!-- Repeater Remove Btn -->
                            <div class="pull-right repeater-remove-btn col-2">
                                <button class="btn btn-danger remove-btn btn-sm">
                                    Remove
                                </button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    <?php } ?>
                    <?php if ($desc != '') {
                        echo '<p class="description">' . $desc . '</p>';
                    } ?>

                </div>

            </td>
        </tr>

        <?php
    }

    public function render_repeater_with_text($field)
    {
        extract($field);
        switch ($list1) {
            case 'languages':
                $defaultOptions = array('Greek', 'English', 'Italian', 'German', 'Catalan', 'Dutch', 'Slovak', 'Slovenian', 'Lithuanian', 'Latvian', 'Belgian', 'Russian', 'French', 'Albanian', 'Turkish', 'Bulgarian', 'Romanian', 'Estonian', 'Croatian', 'Czech', 'Dannish', 'Hungarian', 'Iraqi', 'Polish', 'Chinese', 'Japanese', 'Portuguese', 'Serbian', 'Swedish', 'Ukranian', 'Finnish', 'Norwegian', 'Spanish', 'Indonesian', 'Vietnamese', 'Thai', 'Korean', 'Burmese', 'Hebrew', 'Arabic', 'Azerbaijani', 'Belarusian', 'Irani', 'Indian', 'Georgian', 'Kazakh', 'Macedonian', 'Malaysian', 'Brazilian', 'Taiwanese', 'Icelandic', 'Filipino', 'Malay', 'Mandarin');
                $defaultOptions = array('ua'=>'Ukranian', 'pl' => 'Polish', 'sa' => 'Arabic' ,'be' => 'Belgian','br' => 'Brazilian' ,'bg' => 'Bulgarian'  ,'cn' => 'Chinese','cz' => 'Czech','dk' => 'Danish','nl' => 'Dutch','gb' => 'English','fi' => 'Finnish','fr' => 'French','de' => 'German','gr' => 'Greek', 'id' => 'Indonesian','is' => 'Icelandic','in' => 'Indian','ir' => 'Irani','iq' => 'Iraqi','it' => 'Italian','jp' => 'Japanese','kr' => 'Korean','no' => 'Norwegian','pt' => 'Portuguese','ro' => 'Romanian','ru' => 'Russian','es' => 'Spanish','se' => 'Swedish','tr' => 'Turkish');
                break;
            case 'countries':
                $url = TEMPLATEPATH . '/includes/theme/Settings/countriesArray.json';
                $request = file_get_contents($url);
                $defaultOptions = json_decode($request, true);
                break;
            case 'currencies':
                $defaultOptions = array('ALL' => 'Albanian Lek', 'ARS' => 'Argentine Peso', 'AUD' => 'Australian Dollar', 'BGN' => 'Bulgarian Lev', 'BRL' => 'Brazilian Real', 'BRY' => 'Belarusian Ruble', 'CAD' => 'Canadian Dollar', 'CHF' => 'Swiss Franc', 'CNY' => 'Chinese Yuan', 'CZK' => 'Czech Koruna', 'DKK' => 'Danish Krone', 'EUR' => 'Euro', 'GBP' => 'British Pound', 'HKD' => 'Hong Kong Dollar', 'HUF' => 'Hungarina Forint', 'HRK' => 'Croatian Kuna', 'IDR' => 'Indonesian Rupiah', 'INR' => 'Indian Rupee', 'IQD' => 'Iraqi Dinar', 'IRR' => 'Iranian Rial', 'ISK' => 'Icelandic Krona', 'JPY' => 'Japanese Yen', 'KRW' => 'South Korean Won', 'MKD' => 'FYROM Denar', 'MXN' => 'Mexican Peso', 'NGN' => 'Nigerian Naira', 'NOK' => 'Norwegian Krone', 'PLN' => 'Polish Zloty', 'RON' => 'Romanian New Leu', 'RUB' => 'Russian Ruble', 'RSD' => 'Serbian Dinar', 'SEK' => 'Swedish Krona', 'TND' => 'Tunisian Dinar', 'TRY' => 'Turkish Lira', 'UAH' => 'Ukrainian Hryvnia', 'USD' => 'US Dollar', 'XBT' => 'Bitcoin', 'KRW' => 'Korean Won', 'MYR' => 'Malysian Ringgit', 'NZD' => 'New Zealand Dollar', 'SGD' => 'Singaporean Dollars', 'THB' => 'Thai Baht', 'HRK' => 'Kroatian Kuna', 'ZAR' => 'South African Rand', 'TWD' => 'New Taiwan Dollar', 'KZT' => 'Kazakhstani', 'KGS' => 'Kyrgyzstani', 'MDL' => 'Moldovan Leu', 'GEL' => 'Georgian Lari', 'TMT' => 'Turkmenistani Manat', 'TJS' => 'Tajikistani Somoni', 'RUP' => 'Transnistria', 'COP' => 'Colombian Peso', 'CLP' => 'Chilean Peso', 'PYG' => 'Guarani Paraguay', 'PEN' => 'New sol Peru', 'AMD' => 'Armenian Dram', 'KGS' => 'Kirgystan Som', 'AZN' => 'Azarbaijani Manat', 'UZS' => 'Uzbekistan Som', 'KZT' => 'Kazakhstan Tenge', 'CFA' => 'Central Africa Franc', 'KES' => 'Kenyan Shilling');
                $defaultOptions = array('HUF' => 'Hungarian Forint', 'IDR' => 'Indonesian Rupiah','EUR' => 'Euro','USD' => 'US dollar','AUD' => 'Australian dollar','CAD' => 'Canadian dollar','NZD' => 'New Zealand dollar','CNY' => 'Chinese Yuan Renminbi','PLN'=> 'Polish złoty', 'DKK' => 'Danish krone','JPY' => 'Japanese yen','CHF' => 'Swiss franc','NOK' => 'Norwegian krone','RUB' => 'Russian ruble','SEK' => 'Swedish krona','ARS' => 'Argentine peso','AMD' => 'Armenian dram','BOB' => 'Bolivian boliviano','BRL' => 'Brazilian real','BGN' => 'Bulgarian lev','CLP' => 'Chilean peso','COP' => 'Colombian peso','CZK' => 'Czech koruna','HKD' => 'Hong Kong dollar','INR' => 'Indian rupee','ILS' => 'Israeli new shekel','RON' => 'Romanian leu','SGD' => 'Singapore dollar','TRY' => 'Turkish lira','AED' => 'UAE dirham', 'GBP' => 'Great Britain Pounds', 'ZAR' => 'South African Rand', 'MYR'=>'Malaysian Ringgit', 'UAH'=> 'Ukrainian Ηryvnia');
                break;
            case 'slot':
                $defaultOptions = ['7s' => '777', 'wild_west' => 'Wild West',
                    'east' => 'East', 'anc_greece' => 'Ancient Greece',
                    'anc_rome' => 'Ancient Rome', 'africa' => 'Africa',
                    'comics' => 'Comics', 'women' => 'Women',
                    'crime' => 'Crime', 'sci_fi' => 'Sci-Fi',
                    'jungle' => 'Jungle', 'animals' => 'Animals',
                    'sea' => 'Sea', 'treasures' => 'Treasures',
                    'magic' => 'Magic', 'marvel' => 'Marvel',
                    'mythology' => 'Mythology', 'fairy_tales' => 'Fairytales',
                    'buterfly' => 'Butterflies', 'stones' => 'Gemstones',
                    'sport' => 'Sports', 'movies' => 'Movies',
                    'music' => _('Music'), 'pharaoh' => 'Pharaoh', 'fruits' => 'Fruits',];
                break;
        }
        if ($defaultOptions) {
            asort($defaultOptions);
        }
        if ($default) {
            asort($default['main']);

        }
        ?>
        <tr>
            <td colspan="3">
                <div class="d-flex"><button onClick="saveSettings(event,this)" data-settings-id="<?=$name?>" data-settings-type="<?=$type?>" class="btn btn-primary text-white">Save Settings</button></div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="<?=$name?>"><?=$title?></label>
            </th>
            <td>
                <div class="container-fluid repeater-content">
                    <div class="row">
                        <button class="btn btn-primary btn-sm pull-right repeater-add-btn mb-1" data-settings-type="<?=$type?>">
                            Add
                        </button>
                    </div>
                    <div class="alert alert-danger" role="alert">
                        ATTENTION, changing the ID in the 1st Column will change all data across the site, leading to possible data loss on Casino/Slot metaboxes. Please be carefull!
                    </div>
                    <!-- Repeater Content -->
                    <div class="repeater-rows" data-group="<?=$name?>">
                        <?php
                        $data = get_option($name) ? get_option($name) : $defaultOptions;
                        foreach ($data as $key => $value) {
                            if (is_array($value)){
                                $fullNameOption = $value['fullname'];
                            }else{
                                $fullNameOption = $value;
                            }
                            ?>
                            <div class="items d-flex row mb-1">
                                <input type="text" class="form-control form-control-sm col-1 main-text"
                                       data-name="repeat"
                                       name="<?=$name?>[]"
                                       id="<?=$name?>_<?=$key?>"
                                       value="<?php echo $key ? $key : ''; ?>"
                                       placeholder="<?=$placeholder?>"/>
                                <input type="text" class="form-control form-control-sm col-2 fullname"
                                       data-name="repeat"
                                       name="<?=$name?>[<?=$key?>][fullname]"
                                       id="<?=$name?>_<?php echo $key ?>"
                                       value="<?php echo $fullNameOption ? ucwords($fullNameOption) : ''; ?>"
                                       placeholder="<?=$placeholder?>"/>
                                <div class="pull-right repeater-remove-btn col-2">
                                    <button class="btn btn-danger remove-btn btn-sm">
                                        Remove
                                    </button>
                                </div>
                            </div>
                            <!-- Repeater Remove Btn -->

                            <div class="clearfix"></div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <button class="btn btn-primary btn-sm pull-right repeater-add-btn mb-1" data-settings-type="<?=$type?>">
                            Add
                        </button>
                    </div>
                    <?php if ($desc != '') {
                        echo '<p class="description">' . $desc . '</p>';
                    } ?>

                </div>

            </td>
        </tr>

        <?php
    }
    public function render_repeater_with_text_and_image($field)
    {
        extract($field);
        switch ($list1) {
            case 'languages':
                $defaultOptions = array('Greek', 'English', 'Italian', 'German', 'Catalan', 'Dutch', 'Slovak', 'Slovenian', 'Lithuanian', 'Latvian', 'Belgian', 'Russian', 'French', 'Albanian', 'Turkish', 'Bulgarian', 'Romanian', 'Estonian', 'Croatian', 'Czech', 'Dannish', 'Hungarian', 'Iraqi', 'Polish', 'Chinese', 'Japanese', 'Portuguese', 'Serbian', 'Swedish', 'Ukranian', 'Finnish', 'Norwegian', 'Spanish', 'Indonesian', 'Vietnamese', 'Thai', 'Korean', 'Burmese', 'Hebrew', 'Arabic', 'Azerbaijani', 'Belarusian', 'Irani', 'Indian', 'Georgian', 'Kazakh', 'Macedonian', 'Malaysian', 'Brazilian', 'Taiwanese', 'Icelandic', 'Filipino', 'Malay', 'Mandarin');
                $defaultOptions = array('ua'=>'Ukranian', 'pl' => 'Polish', 'sa' => 'Arabic' ,'be' => 'Belgian','br' => 'Brazilian' ,'bg' => 'Bulgarian'  ,'cn' => 'Chinese','cz' => 'Czech','dk' => 'Danish','nl' => 'Dutch','gb' => 'English','fi' => 'Finnish','fr' => 'French','de' => 'German','gr' => 'Greek', 'id' => 'Indonesian','is' => 'Icelandic','in' => 'Indian','ir' => 'Irani','iq' => 'Iraqi','it' => 'Italian','jp' => 'Japanese','kr' => 'Korean','no' => 'Norwegian','pt' => 'Portuguese','ro' => 'Romanian','ru' => 'Russian','es' => 'Spanish','se' => 'Swedish','tr' => 'Turkish');
                break;
            case 'countries':
                $url = TEMPLATEPATH . '/includes/theme/Settings/countriesArray.json';
                $request = file_get_contents($url);
                $defaultOptions = json_decode($request, true);
                break;
            case 'currencies':
                $defaultOptions = array('ALL' => 'Albanian Lek', 'ARS' => 'Argentine Peso', 'AUD' => 'Australian Dollar', 'BGN' => 'Bulgarian Lev', 'BRL' => 'Brazilian Real', 'BRY' => 'Belarusian Ruble', 'CAD' => 'Canadian Dollar', 'CHF' => 'Swiss Franc', 'CNY' => 'Chinese Yuan', 'CZK' => 'Czech Koruna', 'DKK' => 'Danish Krone', 'EUR' => 'Euro', 'GBP' => 'British Pound', 'HKD' => 'Hong Kong Dollar', 'HUF' => 'Hungarina Forint', 'HRK' => 'Croatian Kuna', 'IDR' => 'Indonesian Rupiah', 'INR' => 'Indian Rupee', 'IQD' => 'Iraqi Dinar', 'IRR' => 'Iranian Rial', 'ISK' => 'Icelandic Krona', 'JPY' => 'Japanese Yen', 'KRW' => 'South Korean Won', 'MKD' => 'FYROM Denar', 'MXN' => 'Mexican Peso', 'NGN' => 'Nigerian Naira', 'NOK' => 'Norwegian Krone', 'PLN' => 'Polish Zloty', 'RON' => 'Romanian New Leu', 'RUB' => 'Russian Ruble', 'RSD' => 'Serbian Dinar', 'SEK' => 'Swedish Krona', 'TND' => 'Tunisian Dinar', 'TRY' => 'Turkish Lira', 'UAH' => 'Ukrainian Hryvnia', 'USD' => 'US Dollar', 'XBT' => 'Bitcoin', 'KRW' => 'Korean Won', 'MYR' => 'Malysian Ringgit', 'NZD' => 'New Zealand Dollar', 'SGD' => 'Singaporean Dollars', 'THB' => 'Thai Baht', 'HRK' => 'Kroatian Kuna', 'ZAR' => 'South African Rand', 'TWD' => 'New Taiwan Dollar', 'KZT' => 'Kazakhstani', 'KGS' => 'Kyrgyzstani', 'MDL' => 'Moldovan Leu', 'GEL' => 'Georgian Lari', 'TMT' => 'Turkmenistani Manat', 'TJS' => 'Tajikistani Somoni', 'RUP' => 'Transnistria', 'COP' => 'Colombian Peso', 'CLP' => 'Chilean Peso', 'PYG' => 'Guarani Paraguay', 'PEN' => 'New sol Peru', 'AMD' => 'Armenian Dram', 'KGS' => 'Kirgystan Som', 'AZN' => 'Azarbaijani Manat', 'UZS' => 'Uzbekistan Som', 'KZT' => 'Kazakhstan Tenge', 'CFA' => 'Central Africa Franc', 'KES' => 'Kenyan Shilling');
                $defaultOptions = array('HUF' => 'Hungarian Forint', 'IDR' => 'Indonesian Rupiah','EUR' => 'Euro','USD' => 'US dollar','AUD' => 'Australian dollar','CAD' => 'Canadian dollar','NZD' => 'New Zealand dollar','CNY' => 'Chinese Yuan Renminbi','PLN'=> 'Polish złoty', 'DKK' => 'Danish krone','JPY' => 'Japanese yen','CHF' => 'Swiss franc','NOK' => 'Norwegian krone','RUB' => 'Russian ruble','SEK' => 'Swedish krona','ARS' => 'Argentine peso','AMD' => 'Armenian dram','BOB' => 'Bolivian boliviano','BRL' => 'Brazilian real','BGN' => 'Bulgarian lev','CLP' => 'Chilean peso','COP' => 'Colombian peso','CZK' => 'Czech koruna','HKD' => 'Hong Kong dollar','INR' => 'Indian rupee','ILS' => 'Israeli new shekel','RON' => 'Romanian leu','SGD' => 'Singapore dollar','TRY' => 'Turkish lira','AED' => 'UAE dirham', 'GBP' => 'Great Britain Pounds', 'ZAR' => 'South African Rand', 'MYR'=>'Malaysian Ringgit', 'UAH'=> 'Ukrainian Ηryvnia');
                break;
            case 'slot':
                $defaultOptions = ['7s' => '777', 'wild_west' => 'Wild West',
                    'east' => 'East', 'anc_greece' => 'Ancient Greece',
                    'anc_rome' => 'Ancient Rome', 'africa' => 'Africa',
                    'comics' => 'Comics', 'women' => 'Women',
                    'crime' => 'Crime', 'sci_fi' => 'Sci-Fi',
                    'jungle' => 'Jungle', 'animals' => 'Animals',
                    'sea' => 'Sea', 'treasures' => 'Treasures',
                    'magic' => 'Magic', 'marvel' => 'Marvel',
                    'mythology' => 'Mythology', 'fairy_tales' => 'Fairytales',
                    'buterfly' => 'Butterflies', 'stones' => 'Gemstones',
                    'sport' => 'Sports', 'movies' => 'Movies',
                    'music' => _('Music'), 'pharaoh' => 'Pharaoh', 'fruits' => 'Fruits',];
                break;
        }
        if ($defaultOptions) {
            asort($defaultOptions);
        }
        if ($default) {
            asort($default['main']);

        }
        ?>
        <tr>
            <td colspan="3">
                <div class="d-flex"><button onClick="saveSettings(event,this)" data-settings-id="<?=$name?>"  data-settings-type="<?=$type?>" class="btn btn-primary text-white">Save Settings</button></div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="<?=$name?>"><?=$title?></label>
            </th>
            <td>
                <div class="container-fluid repeater-content">
                    <div class="row">
                        <button class="btn btn-primary btn-sm pull-right repeater-add-btn mb-1"  data-settings-type="<?=$type?>">
                            Add
                        </button>
                    </div>
                    <!-- Repeater Content -->
                    <div class="alert alert-danger" role="alert">
                        ATTENTION, changing the ID in the 1st Column will change all data across the site. Please be carefull!
                    </div>
                    <div class="repeater-rows" data-group="<?=$name?>">
                        <?php
                        $data = get_option($name) ? get_option($name) : $defaultOptions;
                        foreach ($data as $key => $value) {
                            if (is_array($value)){
                                $imageOption = $value['image'];
                                $fullNameOption = $value['fullname'];
                            }else{
                                $imageOption = '';
                                $fullNameOption = $value;
                            }
                            ?>
                            <div class="items d-flex row mb-1">
                                <input type="text" class="form-control form-control-sm col-1 main-text"
                                       data-name="repeat"
                                       name="<?=$name?>[]"
                                       id="<?=$name?>_<?=$key?>"
                                       value="<?php echo $key ? $key : ''; ?>"
                                       placeholder="<?=$placeholder?>"/>
                                <input type="text" class="form-control form-control-sm col-2 fullname"
                                       data-name="repeat"
                                       name="<?=$name?>[<?=$key?>][fullname]"
                                       id="<?=$name?>_<?php echo $key ?>"
                                       value="<?php echo $fullNameOption ? ucwords($fullNameOption) : ''; ?>"
                                       placeholder="<?=$placeholder?>"/>
                                <input type="text"
                                       class="form-control form-control-sm mr-1 col-2 image"
                                       placeholder="Logo/Flag/Image"
                                       name="<?=$name?>[<?=$key?>][image]"
                                       id="<?=$name?>[<?=$key?>][image]"
                                       value="<?=$imageOption?>"/>
                                <input data-id="<?=$name?>[<?=$key?>][image]"
                                       type="button"
                                       class="button-primary media-upload col-2 button"
                                       value="Insert Image"/>
                                <div class="image-preview mr-1 col-2"
                                     id="preview<?=$name?><?=$key?>image"
                                     data-source="<?=$name?>[<?=$key?>][image]">
                                    <?php if (isset($imageOption)) { ?>
                                        <img
                                                src="<?=$imageOption?>"
                                                class="img-responsive"
                                                style="max-height: 90px;">
                                    <?php } ?>
                                </div>
                                <div class="pull-right repeater-remove-btn col-2">
                                    <button class="btn btn-danger remove-btn btn-sm">
                                        Remove
                                    </button>
                                </div>
                            </div>
                            <!-- Repeater Remove Btn -->

                            <div class="clearfix"></div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <button class="btn btn-primary btn-sm pull-right repeater-add-btn mb-1" data-settings-type="<?=$type?>">
                            Add
                        </button>
                    </div>
                    <?php if ($desc != '') {
                        echo '<p class="description">' . $desc . '</p>';
                    } ?>

                </div>

            </td>
        </tr>

        <?php
    }

    /**
     * Render textarea field
     * @param  string $field options
     * @return void
     */
    public function render_textarea($field)
    {
        extract($field);
        ?>

        <tr>
            <th>
                <label for="<?=$name?>"><?=$title?></label>
            </th>
            <td>
                <textarea name="<?=$name?>" id="<?=$name?>"
                          placeholder="<?=$placeholder?>"><?php echo $default; ?></textarea>
                <?php if ($desc != '') {
                    echo '<p class="description">' . $desc . '</p>';
                } ?>
            </td>
        </tr>

        <?php
    }

    /**
     * Render WPEditor field
     * @param  string $field options
     * @return void
     */
    public function render_wpeditor($field)
    {

        extract($field);
        ?>

        <tr>
            <th>
                <label for="<?=$name?>"><?=$title?></label>
            </th>
            <td>
                <?php wp_editor($default, $name, array('wpautop' => false)); ?>
                <?php if ($desc != '') {
                    echo '<p class="description">' . $desc . '</p>';
                } ?>
            </td>
        </tr>

        <?php
    }

    /**
     * Render Connetcted List
     * @param  string $field options
     * @return void
     */
    public function render_active_countries_table($field)
    {


        extract($field);
        switch ($name) {
            case 'enabled_countries':
                if (!get_option('oldSettingsForCountries')){
                    $themeSettings = get_option('countries_enable_options');
                    foreach ($themeSettings['enabled_countries_iso'][0] as $iso){
                        $newOption[$iso] = 1;
                    }
                    update_option('enabled_countries_iso', $newOption);
                    foreach ($themeSettings['enabled_countries_page']as $iso=>$post){
                        $newOption1[$iso] = $post;
                    }
                    update_option('enabled_countries_page', $newOption1);
                }
                update_option('oldSettingsForCountries', true);
//                delete_option('countries_enable_options');
                $enabledCountries = get_option('enabled_countries_iso');
                $enabledCountriesPost = get_option('enabled_countries_page');
                $PostsForCountries = get_all_published('bc_countries');
                break;
            case 'restricted-countries':
                $enabledCountries = get_option('restricted-countries_iso') ? get_option('restricted-countries_iso') : ['af' => 'Afghanistan','al' => 'Albania','dz' => 'Algeria','as' => 'American Samoa','ao' => 'Angola','ai' => 'Anguilla','ar' => 'Argentina','am' => 'Armenia','au' => 'Australia','at' => 'Austria','bh' => 'Bahrain','bd' => 'Bangladesh','by' => 'Belarus','be' => 'Belgium','bz' => 'Belize','bj' => 'Benin','bq' => 'Bonaire','ba' => 'Bosnia and Herzegovina','bw' => 'Botswana','br' => 'Brazil','bg' => 'Bulgaria','bf' => 'Burkina Faso','bi' => 'Burundi','kh' => 'Cambodia','cm' => 'Cameroon','ca' => 'Canada','cv' => 'Cape Verde','cf' => 'Central African Republic','td' => 'Chad','cl' => 'Chile','cn' => 'China','co' => 'Colombia','cr' => 'Costa Rica','hr' => 'Croatia','cu' => 'Cuba','cw' => 'Curacao','cy' => 'Cyprus','cz' => 'Czech ','cd' => 'DR Congo','dk' => 'Denmark','dj' => 'Djibouti','ec' => 'Ecuador','eg' => 'Egypt','sv' => 'El Salvador','gq' => 'Equatorial Guinea','er' => 'Eritrea','ee' => 'Estonia','et' => 'Ethiopia','fi' => 'Finland','fr' => 'France','gf' => 'French Guiana','pf' => 'French Polynesia','ga' => 'Gabon','gm' => 'Gambia','ge' => 'Georgia','de' => 'Germany','gr' => 'Greece','gl' => 'Greenland','gp' => 'Guadeloupe','gu' => 'Guam','gn' => 'Guinea','gw' => 'Guinea-bissau','gy' => 'Guyana','ht' => 'Haiti','hn' => 'Honduras','hk' => 'Hong Kong','hu' => 'Hungary','is' => 'Iceland','in' => 'India','id' => 'Indonesia','ir' => 'Iran, Islamic Republic of','iq' => 'Iraq','ie' => 'Ireland','il' => 'Israel','it' => 'Italy','ci' => 'Ivory Coast','jp' => 'Japan','jo' => 'Jordan','kz' => 'Kazakhstan','ke' => 'Kenya','kw' => 'Kuwait','la' => 'Laos','lv' => 'Latvia','lb' => 'Lebanon','ls' => 'Lesotho','lr' => 'Liberia','ly' => 'Libya','lt' => 'Lithuania','mo' => 'Macao','mk' => 'FYROM','mg' => 'Madagascar','mw' => 'Malawi','my' => 'Malaysia','mv' => 'Maldives','ml' => 'Mali','mq' => 'Martinique','mr' => 'Mauritania','yt' => 'Mayotte','mx' => 'Mexico','fm' => 'Micronesia','md' => 'Moldova','mc' => 'Monaco','mn' => 'Mongolia','me' => 'Montenegro','ms' => 'Montserrat','ma' => 'Morocco','mz' => 'Mozambique','mm' => 'Myanmar','np' => 'Nepal','nl' => 'Netherlands','nz' => 'New Zealand','ne' => 'Niger','ng' => 'Nigeria','mp' => 'N. Mariana Islands','no' => 'Norway','pk' => 'Pakistan','pa' => 'Panama','py' => 'Paraguay','pe' => 'Peru','ph' => 'Philippines','pl' => 'Poland', 'pl' => 'Poland','pt' => 'Portugal','pr' => 'Puerto Rico','re' => 'Reunion','ro' => 'Romania','ru' => 'Russian Federation','rw' => 'Rwanda','ws' => 'Samoa','sa' => 'Saudi Arabia','rs' => 'Serbia','sg' => 'Singapore','sk' => 'Slovakia','si' => 'Slovenia','so' => 'Somalia','za' => 'South Africa','kr' => 'Republic of Korea','es' => 'Spain','sd' => 'Sudan','sr' => 'Suriname','sz' => 'Swaziland','se' => 'Sweden','ch' => 'Switzerland','sy' => 'Syria','tw' => 'Taiwan','tj' => 'Tajikistan','th' => 'Thailand','tg' => 'Togo','to' => 'Tonga','tn' => 'Tunisia','tr' => 'Turkey','tm' => 'Turkmenistan','ua' => 'Ukraine','ae' => 'United Arab Emirates','gb' => 'United Kingdom','us' => 'United States','um' => 'US Minor Outlying Islands','ug' => 'Uganda','uy' => 'Uruguay','uz' => 'Uzbekistan','vu' => 'Vanuatu','ve' => 'Venezuela','vi' => 'Virgin Islands, U.S.','ye' => 'Yemen','zw' => 'Zimbabwe'];
                break;

        }
        ?>

        <tr>
            <td colspan="3">
                <div class="d-flex"><button onClick="saveSettings(event,this)" data-settings-id="<?=$name?>" class="btn btn-primary text-white">Save Countries</button></div>
            </td>
        </tr>
        <tr>
            <th></th>
            <td>
                <div class="form-row" id="countryFilters">
                    <div class="col-6">
                        <select id="continent" class="form-control form-control-sm">
                            <option value="all">Show Countries by Continent</option>
                            <?php $url = TEMPLATEPATH . '/includes/theme/Settings/CountriesContinents.json';
                            $request = file_get_contents($url);
                            $countriesContinents = json_decode($request, true);
                            foreach ($countriesContinents as $continent => $countries) { ?>
                                <option value="<?php echo str_replace(" ", "_", $continent); ?>"><?php echo ucwords($continent); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-6">
                        <select id="activated" class="form-control form-control-sm">
                            <option value="all">Show Countries</option>
                            <option value="c-enabled">Enabled Countries</option>
                            <option value="c-disabled">Disabled Countries</option>
                        </select>
                    </div>
                    <div class="col-12 mt-1">
                        <input class="form-control form-control-sm searchField" data-targetID="#listCountries .searchme"
                               type="text"
                               placeholder="Search Country by Name..">
                    </div>
                </div>
                <div class="container-fluid">

                    <?php
                    foreach ($countriesContinents as $continent => $countries) { ?>
                        <div class="row">
                            <div class="col p-0" id="listCountries">
                                <h4 class="bg-dark mt-1"><a class="d-block text-white p-1" data-toggle="collapse"
                                                            data-target="#collapse_list_<?php echo str_replace(" ", "_", $continent); ?>"
                                                            href="javascript:void(0)"
                                                            aria-expanded="true"><?php echo ucwords($continent); ?></a>
                                </h4>
                                <div class="collapse show overflow-hidden"
                                     id="collapse_list_<?php echo str_replace(" ", "_", $continent); ?>">
                                    <?php asort($countries); ?>
                                    <?php foreach ($countries as $code => $cname) { ?>
                                        <?php $status = isset($enabledCountries[$code]) ? 'c-enabled' : 'c-disabled'; ?>
                                        <div class="row">
                                            <div data-filter="<?php echo ucwords($cname); ?>" class="searchme form-inline w-100 mb-1 country border-bottom pb-1 col
                                        continent_<?php echo str_replace(" ", "_", $continent); ?> activated_<?php echo $status; ?>"
                                                 style="">
                                                <label class="mr-1 justify-content-start font-weight-bold pl-3"
                                                       style="-ms-flex: 0 0 10%;flex: 0 0 10%;max-width: 10%;"><img class="mr-1" src="<?= get_template_directory_uri()?>/assets/flags/<?=$code?>.svg" width="15"><?php echo ucwords($cname); ?></label>
                                                <input <?php echo isset($enabledCountries[$code]) ? 'checked="checked"' : ''; ?>
                                                        type="checkbox" class="form-control form-control-sm mr-1"
                                                        data-name="repeat"
                                                        data-country="<?=$code?>"
                                                        data-option="<?=$name?>_iso"
                                                        name="<?=$name?>_iso[<?=$code?>]"
                                                        id="<?=$name?>_iso[<?=$code?>]"
                                                        value="1"/>
                                                <?php if($name == 'enabled_countries'){ ?>
                                                <?php $color = isset($enabledCountriesPost[$code])? ' style="background: #a8dba4;"': '';?>
                                                    <select type="text" class="form-control form-control-sm mr-1 col-4" <?=$color?>
                                                            data-name="repeat"
                                                            data-country="<?=$code?>"
                                                            data-option="<?=$name?>_page"
                                                            name="<?=$name?>_page[<?php echo $code; ?>][post_id]">
                                                        <option value="">Select Country's Post</option>
                                                        <?php
                                                        foreach ($PostsForCountries as $post) {
                                                            echo '<option ' . selected($enabledCountriesPost[$code], $post, false) . ' value="' . $post . '">' . get_the_title($post) . '</option>';
                                                        } ?>

                                                    </select>
                            <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </td>

        </tr>
        <tr>
            <td><button onClick="saveSettings(event,this)" data-settings-id="<?=$name?>" class="btn btn-primary text-white">Save Countries</button></td>
        </tr>

        <?php

    }

    public function render_frontpage_options($field)
    {
        $defauleBook = ['DefaultBook'];
        $allBookies = get_all_published('kss_casino');
        $allBookies = array_merge($defauleBook,$allBookies);
        ?>
        <tr>
            <td>

                <div class="form-row" id="countryFilters">
                    <div class="col-4 mt-1">
                        <input class="form-control form-control-sm searchField" data-targetID="#listCountries .searchme"
                               type="text"
                               placeholder="Search Bookmaker by Name..">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 p-0">
                        <div class="nav nav-pills p-1" id="listCountries" role="tablist" aria-orientation="vertical">
                <?php
                foreach ($allBookies as $bookie) {
                    if (!get_post_meta($bookie, 'hiddenbet', true) || $bookie == 'DefaultBook') { ?>
                        <a data-book="<?=$bookie?>" onclick="loadGeoAds(this)" class="w-24 nav-link searchme" data-filter="<?=$bookie == 'DefaultBook'?$bookie:get_the_title($bookie)?>" id="v-pills-<?=$bookie?>-tab" data-toggle="pill" href="#v-pills-<?=$bookie?>" role="tab" aria-controls="v-pills-<?=$bookie?>" aria-selected="false"><?=$bookie == 'DefaultBook'?$bookie:get_the_title($bookie)?></a>
                    <?php
                    }

                } ?>
                    </div>
                </div>
                <div class="col-8">
                    <div class="tab-content" id="v-pills-tabContent">
                        <?php

                        foreach ($allBookies as $bookie) {
                            if (!get_post_meta($bookie, 'hiddenbet', true) || $bookie == 'DefaultBook') { ?>
                                <div class="tab-pane fade" id="v-pills-<?=$bookie?>" role="tabpanel" aria-labelledby="v-pills-<?=$bookie?>-tab">
                                    <h4 class="bg-dark mt-1 text-white p-1"><?=$bookie == 'DefaultBook'?$bookie:get_the_title($bookie)?></h4>
                                    <div class="tab-content">

                                    </div>
                                </div>
                            <?php

                            }
                        } ?>
                    </div>
                </div>
                </div>
            </td>
        </tr>

        <?php

    }
    public function render_featured_articles($field){
        $allActiveCountries = $this->getCountryEnabledSettingsWithNames();
        ?>
        <tr>
            <td>
                <div class="row">
                    <div class="col-4 p-0">
                        <div class="nav nav-pills p-1" id="listCountries" role="tablist" aria-orientation="vertical">
                            <?php
                            foreach ($allActiveCountries as $iso=>$name) { ?>
                                    <a data-country="<?=$iso?>" onclick="loadFeatured(this)" class="w-49 p-5p nav-link searchme" data-filter="<?=$iso?>" id="v-pills-<?=$iso?>-tab" data-toggle="pill" href="#v-pills-<?=$iso?>" role="tab" aria-controls="v-pills-<?=$iso?>" aria-selected="false"><img src="<?=get_template_directory_uri().'/assets/flags/'.$iso?>.svg" width="20" class="ml-1 mr-1"> Options for <b><?=ucwords($name)?></b></a>
                                    <?php
                            } ?>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="tab-content" id="v-pills-tabContent">
                            <?php

                            foreach ($allActiveCountries as $iso=>$name) { ?>
                                    <div class="tab-pane fade" id="v-pills-<?=$iso?>" role="tabpanel" aria-labelledby="v-pills-<?=$iso?>-tab">
                                        <h4 class="bg-dark mt-1 text-white p-1"><?=ucwords($name)?></h4>
                                        <div class="tab-content">

                                        </div>
                                    </div>
                                    <?php
                            } ?>
                        </div>
                    </div>
                </div>
            </td>
        </tr>

        <?php
    }

    public function render_meta_panel($field)
    {
        extract($field);
        $books = get_all_posts('kss_casino');
        switch ($metaType) {
            case 'dynamic':
                $metaTitle = 'Metadata';
                $dynamicOptions = get_option('dynamic-panel');
                $loop = array_flip($dynamicOptions['dynamic-options']['main']);
                $getTitle = $dynamicOptions['dynamic-options']['title'];

                break;
            case 'standar':
                $metaTitle = 'Metadata';
                $dynamicOptions = get_option('data-panel');
//                echo '<pre>';
//                print_r($dynamicOptions);
//                echo '</pre>';
                $loop = array_flip($dynamicOptions[$name]['main']);
                $getTitle = $title;
                break;
            case 'bonus':
                $metaTitle = 'Country';
                $enabledCountries = $this->getCountryEnabledSettings();
                $loop = $enabledCountries;

                $url = TEMPLATEPATH . '/includes/theme/Settings/countriesArray.json';
                $request = file_get_contents($url);
                $countriesArray = json_decode($request, true);
                $loop2 = array_diff_key($countriesArray,$loop);
                $loop=array_intersect_key($countriesArray,$loop);
                asort($loop);
                asort($loop2);
                $getTitle= $countriesArray;
                break;
            case 'restrictions':
                $metaTitle = 'Country';
                $enabledCountries = $this->getCountryEnabledSettings();
                $loop = $enabledCountries;
                $url = TEMPLATEPATH . '/includes/theme/Settings/countriesArray.json';
                $request = file_get_contents($url);
                $countriesArray = json_decode($request, true);
                $loop=array_intersect_key($countriesArray,$loop);
                asort($loop);
                $loop2 = array_diff_key($countriesArray,$loop);
                asort($loop2);
                $getTitle= $countriesArray;
                break;
            case 'payments':
                $metaTitle = 'Payment';
                $loop = get_all_posts('payment');
                break;
        }


        ?>
        <tr>
            <td colspan="3">
                <button type="submit" name="<?php echo $this->settings_id; ?>_save" class="btn btn-primary text-white" onclick="saveMetaTable(event,this,'<?=$this->settings_id?>')">
                    <?php _e( 'Save', 'textdomain' ); ?>
                </button>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-row" id="countryFilters">

                    <div class="col-3 d-flex">
                        <label for="bymeta" class="col-5 font-weight-bold"><?php echo $innerTitle; ?> By <?=$metaTitle?></label>
                        <select id="bymeta" name="bymeta" class="select2-field form-control form-control-sm" onchange="loadMetaTable('bymeta',this,'<?=$metaType?>')">
                            <option value="">Select <?=$metaTitle?>...</option>
                            <?php if($metaType=='bonus'||$metaType=='restrictions')echo '<optgroup label="Active Countries">';?>
                            <?php foreach ($loop as $iso=>$value) {
                                if($metaType!='payments'){ ?>
                                    <option value="<?=$iso?>"><?=$metaType!='dynamic'?ucwords($value):$getTitle[$iso]?></option>
                                <?php }else{
                                    $draft = 'draft' == get_post_status($value)? '(draft)' : '';
                                    $draftColor = 'draft' == get_post_status($value) ? 'bg-warning text-white' : '';
                                    ?>
                                    <option class="<?=$draftColor?>" value="<?=$value?>"><?php echo get_post_meta($value,'short_title',true)?> <?=$draft?></option>
                                <?php }
                            } ?>
                            <?php if($metaType=='bonus'||$metaType=='restrictions')echo '</optgroup>';?>
                            <?php if($metaType=='bonus'||$metaType=='restrictions'){ ?>
                                <optgroup label="Rest Countries">
                                    <?php foreach ($loop2 as $iso=>$value) { ?>
                                        <?php if(strpos($iso, 'us_') !== false){
                                            $USA[$iso] = $value;
                                            continue;
                                        } ?>
                                        <option value="<?=$iso?>"><?=isset($getTitle[$iso])?ucwords($getTitle[$iso]):ucwords($iso)?></option>
                                    <?php } ?>
                                </optgroup>
                                <optgroup label="USA">
                                    <?php foreach ($USA as $iso=>$value) { ?>
                                        <option value="<?=$iso?>"><?=isset($getTitle[$iso])?ucwords($getTitle[$iso]):ucwords($iso)?></option>
                                    <?php } ?>
                                </optgroup>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-3 d-flex">
                        <label for="bybook" class="col-5 font-weight-bold"><?php echo $innerTitle; ?> By Casino</label>
                        <select id="bybook" name="bybook" class="select2-field form-control form-control-sm" onchange="loadMetaTable('bybook',this,'<?=$metaType?>')">
                            <option value="">Select Casino...</option>
                            <?php foreach ($books as $bookID) {
                                $hidden = get_post_meta($bookID,'casino_custom_meta_hidden',true) ? '(hidden)' : '';
                                $hiddenColor = get_post_meta($bookID,'casino_custom_meta_hidden',true) ? 'bg-danger text-white' : '';
                                $draft = 'draft' == get_post_status($bookID)? '(draft)' : '';
                                $draftColor = 'draft' == get_post_status($bookID) ? 'bg-warning text-white' : '';
                                ?>
                                <option class="<?php echo $hiddenColor;?> <?php echo $draftColor;?>" value="<?=$bookID?>"><?=get_the_title($bookID)?> <?=$hidden?> <?=$draft?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-3">
                        <input class="form-control form-control-sm searchField" data-targetID=".searchme"
                               type="text"
                               placeholder="Search..">
                    </div>
                </div>
                <div class="d-flex flex-wrap" id="<?=$metaType?>PanelSettingsContainer">

                </div>
            </td>
        </tr>
        <?php
    }



    public function render_ads_ajax($field)
    {
        extract($field);
        switch ($list1) {
            case 'countries':
                $options = $this->getCountryEnabledSettingsWithNames();
                break;
            case 'casino':
                $options = get_all_publishedWithNames('kss_casino');
                break;
        }



        ?>
        <tr>
            <td>

                <div class="form-row" id="countryFilters">
                    <div class="col-4 mt-1">
                        <input class="form-control form-control-sm searchField" data-targetID="#listCountries .searchme"
                               type="text"
                               placeholder="Search Bookmaker by Name..">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 p-0">
                        <?php
                        switch ($list1) {
                            case 'countries':
                                echo \SettingsSpace\GeoAdsTemplates::printCountryList();
                                break;
                            case 'casino':
                                echo \SettingsSpace\GeoAdsTemplates::printCasinoList();
                                break;
                        }
                    ?>
                </div>
                <div class="col-8">
                    <div class="tab-content" id="v-pills-tabContent">
                        <?php echo \SettingsSpace\GeoAdsTemplates::printTabs($options);?>
                    </div>
                </div>
                </div>
            </td>
        </tr>

        <?php

    }

    public function render_image_select_text($field)
    {

        extract($field);
        $enabledCountries = $this->getCountryEnabledSettings();
        $regionsArray = $this->getRegionalSettings();
        $regions = $this->getActiveRegions();
        $PostsForCountries = get_all_published($postTypes);
        $loopedArray = $regions ? array_merge(array_flip($regions), $enabledCountries) : $enabledCountries;
        $continentsArray = $this->getCountryContinent();
        $url = TEMPLATEPATH . '/includes/theme/Settings/countriesArray.json';
        $request = file_get_contents($url);
        $countriesArray = json_decode($request, true);

        ?>


        <tr>
            <th></th>
            <td>
                <div class="form-row" id="countryFilters">
                    <div class="col-4">
                        <select id="region" class="form-control form-control-sm">
                            <option value="all">Show Countries by Region</option>
                            <?php foreach ($regions as $index) { ?>
                                <option value="<?php echo str_replace(" ", "_", $index); ?>"><?php echo $index; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-4">
                        <select id="continent" class="form-control form-control-sm">
                            <option value="all">Show Countries by Continent</option>
                            <?php $url = TEMPLATEPATH . '/includes/theme/Settings/CountriesContinents.json';
                            $request = file_get_contents($url);
                            $countriesContinents = json_decode($request, true);
                            foreach ($countriesContinents as $continent => $countries) { ?>
                                <option value="<?php echo str_replace(" ", "_", $continent); ?>"><?php echo ucwords($continent); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-4 mt-1">
                        <input class="form-control form-control-sm searchField" data-targetID="#listCountries .searchme"
                               type="text"
                               placeholder="Search Country by Name..">
                    </div>
                </div>
                <div class="container-fluid">

                    <div class="row">
                        <div class="col p-0" id="listCountries">
                            <div class="overflow-hidden"
                                 id="collapse_list_<?php echo str_replace(" ", "_", $continent); ?>">
                                <?php asort($countries); ?>
                                <?php foreach ($loopedArray as $code => $cname) { ?>
                                    <div class="row">
                                        <div data-filter="<?php echo isset($countriesArray[$code]) ? ucwords($countriesArray[$code]) : $code; ?>"
                                             class="searchme form-inline flex-nowrap w-100 mb-1 country border-bottom pb-1 col mt-1 pt-1
                                        continent_<?php echo $continentsArray[$code]; ?> region_<?php echo $regionsArray[$code]; ?>"
                                             style="">
                                            <label class="mr-1 justify-content-start font-weight-bold pl-3 col-2"
                                                   style="-ms-flex: 0 0 10%;flex: 0 0 10%;max-width: 10%;"><?php echo isset($countriesArray[$code]) ? ucwords($countriesArray[$code]) : $code; ?></label>

                                            <div class="image-preview mr-1 "
                                                 data-source="<?=$name?>[<?php echo $code; ?>][image]">
                                                <?php if (isset($default[$code]['image'])) { ?>
                                                    <img
                                                            src="<?php echo $default[$code]['image'] ?>" width="30px">
                                                <?php } ?>
                                            </div>

                                            <div class="mr-1">

                                                <input type="text" class="form-control form-control-sm mr-1"
                                                       placeholder="Logo/Flag/Image"
                                                       name="<?=$name?>[<?php echo $code; ?>][image]"
                                                       id="<?=$name?>[<?php echo $code; ?>][image]"
                                                       value="<?php echo isset($default[$code]['image']) ? $default[$code]['image'] : ''; ?>"/>
                                                <input data-id="<?=$name?>[<?php echo $code; ?>][image]"
                                                       type="button" class="button-primary media-upload"
                                                       value="Insert Image"/>
                                            </div>
                                            <?php if ($options == 'extra_fields') { ?>

                                                <div class="image-preview mr-1"
                                                     data-source="<?=$name?>[<?php echo $code; ?>][cur_image]">
                                                    <?php if (isset($default[$code]['cur_image'])) { ?>
                                                        <img src="<?php echo $default[$code]['cur_image'] ?>"
                                                             width="30px">
                                                    <?php } ?>
                                                </div>

                                                <div class="mr-1">

                                                    <input type="text" class="form-control form-control-sm mr-1"
                                                           placeholder="Currency Image"
                                                           name="<?=$name?>[<?php echo $code; ?>][cur_image]"
                                                           id="<?=$name?>[<?php echo $code; ?>][cur_image]"
                                                           value="<?php echo isset($default[$code]['cur_image']) ? $default[$code]['cur_image'] : ''; ?>"/>
                                                    <input data-id="<?=$name?>[<?php echo $code; ?>][cur_image]"
                                                           type="button" class="button-primary media-upload"
                                                           value="Insert Image"/>
                                                </div>
                                            <?php } ?>
                                            <select type="text"
                                                    class="form-control form-control-sm mr-1 col-1 align-self-baseline"
                                                    name="<?=$name?>[<?php echo $code; ?>][post_id]">
                                                <option value="">Select Link's Post</option>
                                                <?php foreach ($PostsForCountries as $post) {
                                                    echo '<option ' . selected($default[$code]['post_id'], $post, false) . ' value="' . $post . '">' . get_the_title($post) . '</option>';
                                                } ?>

                                            </select>
                                            <input type="text"
                                                   class="form-control form-control-sm mr-1 col-2 align-self-baseline"
                                                   name="<?=$name?>[<?php echo $code; ?>][phrase]"
                                                   id="<?=$name?>[<?php echo $code; ?>][phrase]"
                                                   value="<?php echo isset($default[$code]['phrase']) ? $default[$code]['phrase'] : ''; ?>"
                                                   placeholder="<?=$title?> Catch Phrase"/>
                                            <?php if ($options == 'extra_fields') { ?>
                                                <input type="text"
                                                       class="form-control form-control-sm mr-1 col-2 align-self-baseline"
                                                       name="<?=$name?>[<?php echo $code; ?>][affiliate]"
                                                       id="<?=$name?>[<?php echo $code; ?>][affiliate]"
                                                       value="<?php echo isset($default[$code]['phrase']) ? $default[$code]['affiliate'] : ''; ?>"
                                                       placeholder="<?=$title?> Affiliate URL"/>
                                                <textarea name="<?=$name?>[<?php echo $code; ?>][tcs]"
                                                          id="<?=$name?>[<?php echo $code; ?>][tcs]"
                                                          placeholder="<?=$title?> T&C\'s"><?php echo isset($default[$code]['tcs']) ? $default[$code]['tcs'] : ''; ?></textarea>
                                            <?php } ?>

                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                </div>
            </td>

        </tr>
        <tr>
            <th></th>
            <td colspan="8">

            </td>

        </tr>

        <?php

    }


    public function render_sortable_list($field)
    {
        extract($field);
        switch ($list1) {
            case 'promotions':
                $genOptions = get_option('premium-promo');
                $postType = '';
                break;
            case 'casino':
                $genOptions = get_option('premium-casino');
                break;
            case 'transactions':
                $genOptions = get_option('premium-payments');
                break;
            case 'softwares':
                $genOptions = get_option('premium-providers');
                break;

        }
        $allActiveCountries = $this->getCountryEnabledSettingsWithNames();
        $continentsArray = $this->getCountryContinent();
        ?>
        <tr>
            <td>
                <div class="form-row" id="countryFilters">
                    <div class="col-2 mt-1">
                        <input class="form-control form-control-sm searchField" data-targetID="#listCountries .searchme"
                               type="text"
                               placeholder="Search Bookmaker by Name..">
                    </div>
                    <div class="col-2 mt-1">
                        <select id="continent" class="form-control form-control-sm">
                            <option value="all">Show Countries by Continent</option>
                            <?php $url = TEMPLATEPATH . '/includes/theme/Settings/CountriesContinents.json';
                            $request = file_get_contents($url);
                            $countriesContinents = json_decode($request, true);
                            foreach ($countriesContinents as $continent => $countries) { ?>
                                <option value="<?php echo str_replace(" ", "_", $continent); ?>"><?php echo ucwords($continent); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 p-0">

                        <div class="nav nav-pills p-1" id="listCountries" role="tablist" aria-orientation="vertical">
                            <?php
                            foreach ($allActiveCountries as $iso=>$name) { ?>
                                <a data-country="<?=$iso?>" onclick="loadPremium(this,'<?=$list1?>')" class="w-49 p-5p nav-link searchme country continent_<?php echo str_replace(" ", "_", $continentsArray[$iso]); ?>" data-filter="<?=$name?>" id="v-pills-<?=$iso?>-tab" data-toggle="pill" href="#v-pills-<?=$iso?>" role="tab" aria-controls="v-pills-<?=$iso?>" aria-selected="false"><img src="<?=get_template_directory_uri().'/assets/flags/'.$iso?>.svg" width="20" class="ml-1 mr-1"> Premium for <b><?=ucwords($name)?></b></a>
                                <?php
                            } ?>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="tab-content" id="v-pills-tabContent">
                            <?php

                            foreach ($allActiveCountries as $iso=>$name) { ?>
                                <div class="tab-pane fade" id="v-pills-<?=$iso?>" role="tabpanel" aria-labelledby="v-pills-<?=$iso?>-tab">
                                    <h4 class="bg-dark mt-1 text-white p-1"><?=ucwords($name)?></h4>
                                    <div class="tab-content">

                                    </div>
                                </div>
                                <?php
                            } ?>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <?php
    }

    /**
     * Render select field
     * @param  string $field options
     * @return void
     */
    public function render_select($field)
    {
        extract($field);
        ?>

        <tr>
            <th>
                <label for="<?=$name?>"><?=$title?></label>
            </th>
            <td>
                <select name="<?=$name?>" id="<?=$name?>">
                    <?php
                    foreach ($options as $value => $text) {
                        echo '<option ' . selected($default, $value, false) . ' value="' . $value . '">' . $text . '</option>';
                    }
                    ?>
                </select>
                <?php if ($desc != '') {
                    echo '<p class="description">' . $desc . '</p>';
                } ?>
            </td>
        </tr>

        <?php
    }

    /**
     * Render radio
     * @param  string $field options
     * @return void
     */
    public function render_radio($field)
    {
        extract($field);
        ?>

        <tr>
            <th>
                <label for="<?=$name?>"><?=$title?></label>
            </th>
            <td>
                <?php
                foreach ($options as $value => $text) {
                    echo '<input name="' . $name . '" id="' . $name . '" type="' . $type . '" ' . checked($default, $value, false) . ' value="' . $value . '">' . $text . '</option><br/>';
                }
                ?>
                <?php if ($desc != '') {
                    echo '<p class="description">' . $desc . '</p>';
                } ?>
            </td>
        </tr>

        <?php
    }

    /**
     * Render checkbox field
     * @param  string $field options
     * @return void
     */
    public function render_checkbox($field)
    {
        extract($field);
        ?>

        <tr>
            <th>
                <label for="<?=$name?>"><?=$title?></label>
            </th>
            <td>
                <input <?php checked($default, '1', true); ?> type="<?php echo $type; ?>" name="<?=$name?>"
                                                              id="<?=$name?>" value="1"
                                                              placeholder="<?=$placeholder?>"/>
                <?php echo $desc; ?>
            </td>
        </tr>

        <?php
    }
}