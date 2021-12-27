<?php
/**
 * Created by PhpStorm.
 * User: Panos
 * Date: 6/6/2019
 * Time: 12:18 μμ
 */

class SettingsSetup
{
    public function __construct()
    {

        $this->addSettings();
        add_action('admin_enqueue_scripts', function () {
            global $pagenow;
            if ($pagenow != 'admin.php') {
                return;
            }
            wp_enqueue_media();
            wp_enqueue_script('repeaterScripts', '/wp-content/themes/best50casino.com/includes/theme/Settings/repeater.js');
            wp_enqueue_script('settingsScripts', '/wp-content/themes/best50casino.com/includes/theme/Settings/settingsScripts.min.js?v=19');
            wp_enqueue_script('bonusScripts', '/wp-content/themes/best50casino.com/assets/js/bonus.min.js');
            wp_enqueue_script('customRepeaterScripts', '/wp-content/themes/best50casino.com/includes/theme/Settings/repeater_custom.js');
            wp_enqueue_script('UserSettingsScripts', '/wp-content/themes/best50casino.com/includes/theme/Settings/usersSettingsScritps.js');
            wp_enqueue_style('settingsStyles', '/wp-content/themes/best50casino.com/includes/theme/Settings/SettingsStyles.css?v=4');
        });
        add_action('wp_ajax_saveCountrySettings', array($this, 'saveCountrySettings'));
        add_action('wp_ajax_saveDataPanelSettings', array($this, 'saveDataPanelSettings'));
        add_action('wp_ajax_savePremium', array($this, 'savePremium'));
        add_action('wp_ajax_saveFeatured', array($this, 'saveFeatured'));
    }
    public function saveCountrySettings()
    {
        $postedActivecountries = $_POST['countries'];
        $settingsID = $_POST['settingsID'];
        $activeCountries = array_fill_keys($postedActivecountries,1);
        ksort($activeCountries);
        $countriesUpdated = update_option($settingsID.'_iso',$activeCountries);
        $ret = '<div class="d-flex">';
        $ret .= $countriesUpdated ? '<span class="bg-success ml-1 p-2 rounded-10">Countries Updated</span>':'<span class="bg-warning ml-1 p-2 rounded-10">Countries Not Updated</span>';
        if($settingsID=='enabled_countries'){
            $postedActivePosts =  $_POST['selectedPosts'];
            ksort($postedActivePosts);
            $postsUpdated = update_option('enabled_countries_page',$postedActivePosts);
            $ret .= $postsUpdated ? '<span class="bg-success ml-1 p-2 rounded-10">Posts Updated</span>':'<span class="bg-warning ml-1 p-2 rounded-10">Posts Not Updated</span>';
        }
        $ret .= '</div>';
        echo $ret;
        die ();
    }
    public function saveDataPanelSettings()
    {
        $settingsData = $_POST['settingsData'];
        $settingsID = $_POST['settingsID'];
        $settingsUpdated = update_option($settingsID,$settingsData);

        $ret = '<div class="d-flex">';
        $ret .= $settingsUpdated ? '<span class="bg-success ml-1 p-2 rounded-10">Countries Updated</span>':'<span class="bg-warning ml-1 p-2 rounded-10">Countries Not Updated</span>';
        $ret .= '</div>';
        echo $ret;
        die ();
    }
    function savePremium()
    {
        $ids = $_POST['ids'];
        $postType = $_POST['postType'];
        $premium = $postType == 'transactions' || $postType == 'softwares' ? null : $_POST['premium'];
        $iso = $_POST['code'];
        $settingsUpdated = SettingsSpace\Premium::savePremium($ids,$premium,$iso,$postType);
        $ret = '<div class="d-flex">';
        $ret .= $settingsUpdated ? '<span class="bg-success ml-1 p-2 rounded-10">Settings Updated</span>':'<span class="bg-warning ml-1 p-2 rounded-10">Settings Not Updated</span>';
        $ret .= '</div>';
        echo $ret;
        die ();
    }
    function saveFeatured()
    {
        $settingsData = $_POST['settingsData'];
        $settingsID = $_POST['settingsID'];
        $iso = $_POST['code'];
        $settingsUpdated = SettingsSpace\Featured::saveFeatured($settingsData,$iso);
        $ret = '<div class="d-flex">';
        $ret .= $settingsUpdated ? '<span class="bg-success ml-1 p-2 rounded-10">Settings Updated</span>':'<span class="bg-warning ml-1 p-2 rounded-10">Settings Not Updated</span>';
        $ret .= '</div>';
        echo $ret;
        die ();
    }



    public function addSettings()
    {
        $customWPMenu = new WordPressMenu(array(
            'slug' => 'best50-main-menu',
            'title' => 'Best50casino Menu',
            'desc' => 'Create Region, Enable Country, Match country with Post, Icon, ',
            'icon' => 'dashicons-welcome-widgets-menus',
            'position' => 1,
            'ajax' => true
        ));
        $customWPMenu->add_field(array(
            'name' => 'enabled_countries',
            'title' => 'Activate Geo Countries',
            'type' => 'active_countries_table',
        ));
        // Creating tab with our custom wordpress menu
        $customWPSubMenu = new WordPressSubMenu(array(
            'slug' => 'data-panel',
            'title' => 'Data Panel',
            'desc' => 'Set new entries for Review options',
            'ajax' => true
        ),
            $customWPMenu);
        $customWPSubMenu->add_field(array(
            'name' => 'web-languages',
            'title' => 'Website Languages',
            'type' => 'repeater_with_text',
            'list1' => 'languages',
        ));
        $customTab = new WordPressMenuTab(
            array(
                'slug' => 'cs-languages',
                'title' => 'CS Languages'),
            $customWPSubMenu);
        $customTab->add_field(array(
            'name' => 'cs-languages',
            'title' => 'CS Languages',
            'type' => 'repeater_with_text',
            'list1' => 'languages',
        ));
        $customTab = new WordPressMenuTab(
            array(
                'slug' => 'review-currencies',
                'title' => 'Currencies'),
            $customWPSubMenu);
        $customTab->add_field(array(
            'name' => 'review-currencies',
            'title' => 'Currencies',
            'type' => 'repeater_with_text',
            'list1' => 'currencies',
        ));
        $customTab = new WordPressMenuTab(
            array(
                'slug' => 'restricted-countries',
                'title' => 'Restricted Countries'),
            $customWPSubMenu);
        $customTab->add_field(array(
            'name' => 'restricted-countries',
            'title' => 'Restricted Countries',
            'type' => 'active_countries_table',
            'list1' => 'countries',
        ));
        $customTab = new WordPressMenuTab(
            array(
                'slug' => 'cs-channels',
                'title' => 'CS Channels'),
            $customWPSubMenu);
        $customTab->add_field(array(
            'name' => 'cs-channels',
            'title' => 'CS Channels',
            'type' => 'text',
            'list1' => 'cs-channels',
            'multi' =>true
        ));
        $customTab = new WordPressMenuTab(
            array(
                'slug' => 'slot-themes',
                'title' => 'Slot Themes'),
            $customWPSubMenu);
        $customTab->add_field(array(
            'name' => 'slot-themes',
            'title' => 'Slot Themes',
            'type' => 'repeater_with_text',
            'list1' => 'slot',
        ));


        $customWPSubMenu = new WordPressSubMenu(array(
            'slug' => 'best-menu-options',
            'title' => 'Front Page and Sidebar',
            'desc' => 'Front Page and Sidebar Featured Casiono & Articles ',
            'ajax' => true
        ),
            $customWPMenu);
        $customWPSubMenu->add_field(array(
            'name' => 'best-menu-options',
            'title' => 'Front Page and Sidebar',
            'type' => 'featured_articles',
        ));
        $customWPSubMenu = new WordPressSubMenu(array(
            'slug' => 'premium-casino',
            'title' => 'Premium Order',
            'desc' => 'Premium Order per Country',
            'tab'=>'Premium Casinos',
            'name'=>'Premium Casinos',
            'ajax' => true
        ),
            $customWPMenu);
        $customWPSubMenu->add_field(array(
            'name' => 'premium-casino',
            'title' => 'Premium Casinos per Country',
            'type' => 'sortable_list',
            'list1' => 'casino',
            'tab'=>'Premium Casinos',
        ));
        $customTab = new WordPressMenuTab(
        array(
            'slug' => 'premium-payments',
            'title' => 'Premium Payments'),
        $customWPSubMenu);
        $customTab->add_field(array(
            'name' => 'premium-payments',
            'title' => 'Premium Payments',
            'type' => 'sortable_list',
            'list1' => 'transactions',
        ));
        $customTab = new WordPressMenuTab(
            array(
                'slug' => 'premium-providers',
                'title' => 'Premium Providers'),
            $customWPSubMenu);
        $customTab->add_field(array(
            'name' => 'premium-providers',
            'title' => 'Premium Providers',
            'type' => 'sortable_list',
            'list1' => 'softwares',
        ));
        $customTab = new WordPressMenuTab(
            array(
                'slug' => 'premium-promotions',
                'title' => 'Premium Promotions'),
            $customWPSubMenu);
        $customTab->add_field(array(
            'name' => 'premium-promotions',
            'title' => 'Premium Promotions',
            'type' => 'sortable_list',
            'list1' => 'promotions',
        ));
        $WPSubMenu = new WordPressSubMenu(array(
            'slug' => 'geoAds',
            'title' => 'Custom Ads',
            'desc' => 'Set Custom Ads per Country',
            'ajax' => true
        ),
            $customWPMenu);
        $WPSubMenu->add_field(array(
            'name' => 'geoAds',
            'title' => 'Custom Ads Settings',
            'type' => 'ads_ajax',
            'list1' => 'countries'
        ));
        $customTab = new WordPressMenuTab(
            array(
                'slug' => 'casino-geoAds',
                'title' => 'Custom Ads per Casino'),
            $WPSubMenu);
        $customTab->add_field(array(
            'name' => 'casino-geoAds',
            'title' => 'Custom Ads per Casino',
            'type' => 'ads_ajax',
            'list1' => 'casino'
        ));
        $custom2WPMenu = new WordPressMenu(array(
            'slug' => 'helping-panel',
            'title' => 'Best50 Meta Panel',
            'desc' => '',
            'icon' => 'dashicons-welcome-widgets-menus',
            'position' => 1,
            'ajax' => true
        ));
        $custom2WPMenu->add_field(array(
            'name' => 'bonus-panel',
            'title' => 'Bonus Panel',
            'desc' => 'Bonus Panel',
            'type' => 'meta_panel',
            'metaType' => 'bonus',
            'innerTitle' => 'Bonus'
        ));
        $customWPSubMenu = new WordPressSubMenu(array(
            'slug' => 'casino-restriction-meta',
            'title' => 'Casino Restrictions Meta',
            'desc' => '',
            'ajax' => true
        ),
            $custom2WPMenu);
        $customWPSubMenu->add_field(array(
            'name' => 'casino-restriction-meta',
            'title' => 'Casino Restriction Meta',
            'type' => 'meta_panel',
            'metaType' => 'restrictions',
            'innerTitle' => 'Restrictions'
        ) );
    }
}