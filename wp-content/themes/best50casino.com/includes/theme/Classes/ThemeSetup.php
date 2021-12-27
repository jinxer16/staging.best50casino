<?php
/**
 * Created by PhpStorm.
 * User: Panos
 * Date: 31/5/2019
 * Time: 12:41 μμ
 */

class ThemeSetup
{
    public function __construct()
    {
        global $pagenow;
        if ($pagenow == 'user-new.php' || $pagenow == 'user-edit.php' || $pagenow == 'post.php' ) {
            $this->addAdminScript('bootjs1', 'https://code.jquery.com/jquery-3.3.1.min.js');
        }

        $this->addAdminScript('bootjs2', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js');
        $this->addAdminScript('bootjs3', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js');
        $this->addAdminScript('jqueryUI', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js');
//        $this->addAdminScript('sorttable', 'https://dbrink.github.io/sorttable/jquery.sorttable.js');
        $this->addAdminScript('sorttable', '/wp-content/themes/best50casino.com/includes/theme/editor-buttons/sorttable.js');
        $this->addAdminScript('adminScripts', '/wp-content/themes/best50casino.com/includes/theme/assets/js/adminScripts.js?v=3');
        $this->includeFiles();
        $this->addSupport('title-tag')
            ->addSupport('custom-logo')
            ->addSupport('post-thumbnails')
            ->addSupport('customize-selective-refresh-widgets')
            ->addSupport('post-formats', [
                'video', 'gallery' ])
            ->addSupport('html5', [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
				'category-thumbnails'
            ])
            ->removeActions();
        $this->addActions();
        $this->removeSupport('automatic-feed-links');
        $this->addAdminStyle('wpalchemy-metabox', '/wp-content/themes/best50casino.com/includes/theme/Metaboxes/style.css');
        $this->addAdminStyle('bootcss', '/wp-content/themes/best50casino.com/includes/theme/assets/css/adminStyles.min.css');
        $this->addAdminStyle('fontawesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
//        $this->addAdminStyle('admincss', '/wp-content/themes/best50casino.com/includes/theme/assets/css/adminStyles.js');

        $this->addPostTypes();
        $this->addTxonomies();
        $this->addFilters();

        $metaboxes = new MetaBoxesSetup;
        $sharkodeMetaboxes = new SharkCodeMetaboxesSetup;



    }
    private function actionAfterSetup($function)
    {
        add_action('after_setup_theme', function() use ($function) {
            $function();
        });
    }
    private function actionAdminEnqueueScripts($function)
    {
        add_action('admin_enqueue_scripts', function() use ($function){
            $function();
        });
    }
    private function actionEnqueueScripts($function)
    {
        add_action('enqueue_scripts', function() use ($function){
            $function();
        });
    }
    private function includeFiles(){
        require_once 'PostTypesSetup.php';
        require_once TEMPLATEPATH . '/includes/plugins/wpalchemy/MetaBox.php';
        require_once TEMPLATEPATH . '/includes/plugins/wpalchemy/MediaAccess.php';
        require_once TEMPLATEPATH . '/includes/theme/Settings/Classes/BonusTable.php';
        require_once TEMPLATEPATH . '/includes/theme/Settings/Classes/WordPressSettings.php';
        require_once TEMPLATEPATH . '/includes/theme/Settings/Classes/WordPressMenu.php';
        require_once TEMPLATEPATH . '/includes/theme/Settings/Classes/WordPressSubMenu.php';
        require_once TEMPLATEPATH . '/includes/theme/Settings/Classes/WordPressMenuTab.php';
        require_once TEMPLATEPATH . '/includes/theme/Settings/Classes/SettingsSetup.php';
        require_once TEMPLATEPATH . '/includes/theme/Settings/Classes/GeoAds.php';
        require_once TEMPLATEPATH . '/includes/theme/Settings/Classes/GeoAdsCasino.php';
        require_once TEMPLATEPATH . '/includes/theme/Settings/Classes/GeoAdsTemplates.php';
        require_once TEMPLATEPATH . '/includes/theme/Settings/Classes/Featured.php';
        require_once TEMPLATEPATH . '/includes/theme/Settings/Classes/Premium.php';
        require_once TEMPLATEPATH . '/includes/theme/Settings/settings-helpers.php';
        require_once TEMPLATEPATH . '/includes/theme/functions/wheel-of-fortune/wheel-post-type.php';
        require_once TEMPLATEPATH . '/includes/theme/functions/wheel-of-fortune/wheel.php';
        require_once TEMPLATEPATH . '/includes/theme/functions/wheel-of-fortune/fortune-shortcode.php';
        require_once 'MetaBoxesSetup.php';
        require_once 'SharkCodeMetaboxesSetup.php';
//        require_once TEMPLATEPATH . '/includes/theme/votes/UserVotes.php';
//        require_once TEMPLATEPATH . '/includes/theme/Members-and-Roles/UserSwitch.php';
//        require_once TEMPLATEPATH . '/includes/theme/Members-and-Roles/roles-users-helper.php';
//        require_once TEMPLATEPATH . '/includes/theme/Shortcodes/anchors.php';
        require_once 'Roles.php';
        $files = glob( get_template_directory() . '/includes/theme/functions/*.php' );
        foreach ( $files as $file ) {
            include $file;
        }
        $files = glob( get_template_directory() . '/includes/theme/functions/casino-comparison/*.php' );
        foreach ( $files as $file ) {
            include $file;
        }
        $files = glob( get_template_directory() . '/includes/theme/functions/votes/*.php' );
        foreach ( $files as $file ) {
            include $file;
        }
        $files = glob( get_template_directory() . '/includes/theme/functions/login-register/*.php' );
        foreach ( $files as $file ) {
            include $file;
        }
        $files = glob( get_template_directory() . '/includes/theme/Shortcodes/*.php' );
        foreach ( $files as $file ) {
            include $file;
        }
//        require_once TEMPLATEPATH . '/includes/theme/Settings/DataTransfers.php';
//        require_once TEMPLATEPATH . '/includes/theme/editor-buttons/table-button.php';
//        require_once TEMPLATEPATH . '/includes/theme/Members-and-Roles/Login.php';
        global $themeSettings;
        $themeSettings = new SettingsSetup();
        $userVotes = new userVotes();
//        wp_enqueue_editor();
    }

    private function removeActions()
    {
        $this->actionAfterSetup(function() {

        });
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
        // Display the links to the extra feeds such as category feeds
        remove_action( 'wp_head', 'feed_links_extra', 3 );
        // Display the links to the general feeds: Post and Comment Feed
        remove_action( 'wp_head', 'feed_links', 2 );
        // Display the link to the Really Simple Discovery service endpoint, EditURI link
        remove_action( 'wp_head', 'rsd_link' );
        // Display the link to the Windows Live Writer manifest file.
        remove_action( 'wp_head', 'wlwmanifest_link' );
        // index link
        remove_action( 'wp_head', 'index_rel_link' );
        // prev link
        remove_action( 'wp_head', 'parent_post_rel_link', 10 );
        // start link
        remove_action( 'wp_head', 'start_post_rel_link', 10 );
        // Display relational links for the posts adjacent to the current post.
        remove_action( 'wp_head', 'adjacent_posts_rel_link', 10 );
        // Display the XHTML generator that is generated on the wp_head hook, WP version
        remove_action('wp_head', 'wp_generator');

    }
    private function addActions()
    {
        add_action( 'init', [$this,'register_menus'] );
//        if(!current_user_can('manage-options')){
//            add_action( 'admin_menu', function(){
////            remove_submenu_page( 'bookmakers-main-menu', 'users-managment' );
////            remove_menu_page( 'themes.php' );
////            remove_menu_page( 'tools.php' );
////            remove_menu_page( 'options-general.php' );
//            }, 999 );
//        }
//
        add_action( 'widgets_init', function(){
            if (function_exists('register_sidebar')) {
                $before_widget =  '<div id="%1$s" class="widget %2$s">';
                $after_widget  =  '</div><!--widget-->';

                $before_title  =  '<span class="star">';
                $after_title   =  '</span>';
                // register sidebars
                register_sidebar(array(
                    'name' => 'Header Ad',
                    'id'   => 'header-ad-area',
                    'description'   => 'Place for header Ad',
                    'before_widget' => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
                ));
                register_sidebar(array(
                    'name' => 'Left Skin Ad',
                    'id'   => 'left-skin-ad-area',
                    'description'   => 'Place for left skin Ad',
                    'before_widget' => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
                ));
                register_sidebar(array(
                    'name' => 'Right Skin Ad',
                    'id'   => 'right-skin-ad-area',
                    'description'   => 'Place for right skin Ad',
                    'before_widget' => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
                ));
                register_sidebar(array(
                    'name' => 'Bottom Skin Ad',
                    'id'   => 'bottom-skin-ad-area',
                    'description'   => 'Place for bottom skin Ad',
                    'before_widget' => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
                ));
                register_sidebar(array(
                    'name' => 'Main Sidebar',
                    'id'   => 'main-sidebar',
                    'description'   => 'Place for Main (right) sidebar widgets',
                    'before_widget' => '<div id="%1$s" class="widget %2$s desktop-large desktop-medium desktop-small">' , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
                ));
                register_sidebar(array(
                    'name' => 'Secondary Sidebar',
                    'id'   => 'secondary-sidebar',
                    'description'   => 'Place for Secondary (left) sidebar widgets',
                    'before_widget' => '<div id="%1$s" class="widget %2$s desktop-large desktop-medium desktop-small">' , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
                ));
                register_sidebar(array(
                    'name' => 'Main Sidebar (Για σελίδες που δεν θέλουμε καζίνο στην κορυφή)',
                    'id'   => 'main-sidebar-2',
                    'description'   => 'Place for Main (right) sidebar 2 widgets',
                    'before_widget' => '<div id="%1$s" class="widget %2$s desktop-large desktop-medium desktop-small">' , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
                ));
                register_sidebar(array(
                    'name' => 'Left Sidebar για σελίδα με Φρουτάκια',
                    'id'   => 'left-for-slots',
                    'description'   => 'Place for Left Sidebar για σελίδα με Φρουτάκια',
                    'before_widget' => '<div id="%1$s" class="widget %2$s">' , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
                ));
            }
        } );
    }
    public function register_menus(){
        register_nav_menus(
            array(
                'main-menu' => __( 'Main Menu' ),
                'main-menu-r' => __( 'Main Menu (right)' ),
                'main-menu-m' => __( 'Mobile Menu' ),
                'main-menu-burger' => __( 'Burger Menu' ),
                'sub-menu' => __( 'Sub Menu' ),
                'anchor-menu' => __( 'Anchor Menu' ),
                'footer-menu' => __( 'Footer Menu 1' ),
                'footer-menu-2' => __( 'Footer Menu 2' ),
                'footer-menu-3' => __( 'Footer Menu 3' ),
                'footer-menu-top' => __( 'Footer Menu 4' ),
            )
        );
    }
    private function checkToEnable($getCheck) {
        return empty($getCheck['our_code']);
    }
    private function extraCheckToEnable($getCheck) {
        return empty($getCheck['our_extra_code']);
    }
    private function addFilters()
    {
        add_filter('use_block_editor_for_post', '__return_false');
        add_filter( 'xmlrpc_enabled', '__return_false' );
        add_filter( 'wp_headers', 'disable_x_pingback' );
        function disable_x_pingback( $headers ) {
            unset( $headers['X-Pingback'] );

            return $headers;
        }
//        add_filter( 'template_include', array($this, 'custom_template_include') );
        add_action( 'init', 'b50c_kss_casino_post_type_rest_support', 25 );
        add_action( 'init', 'b50c_bc_bonus_post_type_rest_support', 25 );
        add_action( 'init', 'b50c_kss_transactions_post_type_rest_support', 25 );
        add_action( 'init', 'b50c_kss_softwares_post_type_rest_support', 25 );

        function b50c_kss_casino_post_type_rest_support() {
            global $wp_post_types;
            $post_type_name = 'kss_casino';
            if( isset( $wp_post_types[ $post_type_name ] ) ) {
                $wp_post_types[$post_type_name]->show_in_rest = true;
                // Optionally customize the rest_base or controller class
                $wp_post_types[$post_type_name]->rest_base = $post_type_name;
                $wp_post_types[$post_type_name]->rest_controller_class = 'WP_REST_Posts_Controller';
            }
        }
        function b50c_bc_bonus_post_type_rest_support() {
            global $wp_post_types;
            $post_type_name = 'bc_bonus';
            if( isset( $wp_post_types[ $post_type_name ] ) ) {
                $wp_post_types[$post_type_name]->show_in_rest = true;
                // Optionally customize the rest_base or controller class
                $wp_post_types[$post_type_name]->rest_base = $post_type_name;
                $wp_post_types[$post_type_name]->rest_controller_class = 'WP_REST_Posts_Controller';
            }
        }
        function b50c_kss_transactions_post_type_rest_support() {
            global $wp_post_types;
            $post_type_name = 'kss_transactions';
            if( isset( $wp_post_types[ $post_type_name ] ) ) {
                $wp_post_types[$post_type_name]->show_in_rest = true;
                // Optionally customize the rest_base or controller class
                $wp_post_types[$post_type_name]->rest_base = $post_type_name;
                $wp_post_types[$post_type_name]->rest_controller_class = 'WP_REST_Posts_Controller';
            }
        }
        function b50c_kss_softwares_post_type_rest_support() {
            global $wp_post_types;
            $post_type_name = 'kss_softwares';
            if( isset( $wp_post_types[ $post_type_name ] ) ) {
                $wp_post_types[$post_type_name]->show_in_rest = true;
                // Optionally customize the rest_base or controller class
                $wp_post_types[$post_type_name]->rest_base = $post_type_name;
                $wp_post_types[$post_type_name]->rest_controller_class = 'WP_REST_Posts_Controller';
            }
        }
        add_action( 'rest_api_init', function () {
//            register_rest_field( 'kss_casino', 'all_meta', array(
//                'get_callback' => function( $post_arr ) {
//                    $ret = get_post_meta( $post_arr['id'] );
//                    return $ret;
//                },
//            ) );
            register_rest_field( 'kss_casino', 'bonus_id', array(
                'get_callback' => function( $post_arr, $attr, $request ) {
                    if ($this->checkToEnable($request)) {
                        return '';
                    }
                    return get_post_meta( get_post_meta( $post_arr['id'], 'casino_custom_meta_bonus_page', true ), 'bonus_custom_meta_bonus_offer', true );
                },
            ) );
//            register_rest_field( 'kss_casino', 'bonus_page', array(
//                'get_callback' => function( $post_arr ) {
//                    return get_post_meta( $post_arr['id'], 'casino_custom_meta_bonus_page', true );
//                },
//            ) );
            register_rest_field( 'kss_casino', 'cs', array(
                'get_callback' => function( $post_arr, $attr, $request ) {
                    if ($this->checkToEnable($request)) {
                        return '';
                    }
                    $ret = array();
                    $csNames = WordPressSettings::getAvailableCSChannels();
                    foreach($csNames as $cs) {
                        $opt = get_post_meta( $post_arr['id'], 'casino_custom_meta_'.strtolower(str_replace(' ', '_', $cs)).'_option',true);
                        $details = get_post_meta( $post_arr['id'], 'casino_custom_meta_'.strtolower(str_replace(' ', '_', $cs)).'option_det',true);
                        if (!empty($opt) || !empty($details)) {
                            $ret[strtolower(str_replace(' ', '_', $cs))] = array('opt'=>$opt,'det'=>$details);
                        }
                    }
                    return $ret;
                },
            ) );
            register_rest_field( 'kss_casino', 'extra_data', array(
                'get_callback' => function( $post_arr, $attr, $request ) {
                    if ($this->extraCheckToEnable($request)) {
                        return '';
                    }
                    $ret = array('soft'=>array(),'trans'=>array(),);
                    $allSoftwares = get_posts(array('post_type'=>'kss_softwares', 'fields'=>'ids', 'post_status' => array('publish','draft'), 'numberposts'=>-1,));
                    $allPayments = get_posts(array('post_type'=>'kss_transactions', 'fields'=>'ids', 'post_status' => array('publish','draft'), 'numberposts'=>-1,));
                    foreach($allSoftwares as $postItem) {
                        $live = get_post_meta( $postItem, 'software_custom_meta_livecasino', true );

                        $ret['soft'][$postItem] = array('title'=>get_the_title($postItem), 'slug'=>get_post_field( 'post_name', $postItem), 'live_meta'=>$live, 'id'=>$postItem);
                    }
                    foreach($allPayments as $postItem) {
                        $ret['trans'][$postItem] = array('title'=>get_the_title($postItem), 'slug'=>get_post_field( 'post_name'), 'id'=>$postItem);
                    }
                    return $ret;
                },
            ) );
            register_rest_field( 'kss_casino', 'cur_acc', array(
                'get_callback' => function( $post_arr, $attr, $request ) {
                    if ($this->checkToEnable($request)) {
                        return '';
                    }
                    $ret = array();
                    $currencies =WordPressSettings::getAvailableCurrencies();
                    $curr = get_post_meta( $post_arr['id'], 'casino_custom_meta_cur_acc',true);
                    foreach($curr as $cur) {
                        if (!(empty($currencies[$cur]))) {
                            $ret[] = $currencies[$cur];
                        }
                    }
                    return $ret;
                },
            ) );
            register_rest_field( 'kss_casino', 'lang_sup_site', array(
                'get_callback' => function( $post_arr, $attr, $request ) {
                    if ($this->checkToEnable($request)) {
                        return '';
                    }
                    $ret = array();
                    $languages = WordPressSettings::getAvailableLanguages();
                    $lang = get_post_meta( $post_arr['id'], 'casino_custom_meta_lang_sup_site',true);
                    foreach($lang as $language) {
                        if (!(empty($languages[$language]))) {
                            $ret[] = $languages[$language];
                        }
                    }
                    return $ret;
                },
            ) );
            register_rest_field( 'kss_casino', 'lang_sup_cs', array(
                'get_callback' => function( $post_arr, $attr, $request ) {
                    if ($this->checkToEnable($request)) {
                        return '';
                    }
                    $ret = array();
                    $languages = WordPressSettings::getAvailableCSLanguages();
                    $lang = get_post_meta( $post_arr['id'], 'casino_custom_meta_lang_sup_cs',true);
                    foreach($lang as $language) {
                        if (!(empty($languages[$language]))) {
                            $ret[] = $languages[$language];
                        }
                    }
                    return $ret;
                },
            ) );
            register_rest_field( 'kss_casino', 'dep_options', array(
                'get_callback' => function( $post_arr, $attr, $request ) {
                    if ($this->checkToEnable($request)) {
                        return '';
                    }
                    $ret = array();
                    $pay = get_post_meta( $post_arr['id'], 'casino_custom_meta_dep_options',true);
                    foreach($pay as $payment) {
                        $pay_min_dep = get_post_meta( $post_arr['id'], 'casino_custom_meta_'.$payment.'_min_dep',true);
                        $pay_max_dep = get_post_meta( $post_arr['id'], 'casino_custom_meta_'.$payment.'_max_dep',true);
                        $pay_dep_time = get_post_meta( $post_arr['id'], 'casino_custom_meta_'.$payment.'_dep_time',true);
                        foreach (array('min_dep'=>$pay_min_dep,'max_dep'=>$pay_max_dep,'dep_time'=>$pay_dep_time) as $key=>$val) {
                            if (!(empty($val))) {
                                $ret[$payment][$key] = $val;
                            }
                        }
                    }
                    return $ret;
                },
            ) );
            register_rest_field( 'kss_casino', 'withd_options', array(
                'get_callback' => function( $post_arr, $attr, $request ) {
                    if ($this->checkToEnable($request)) {
                        return '';
                    }
                    $ret = array();
                    $wit = get_post_meta( $post_arr['id'], 'casino_custom_meta_withd_options',true);
                    foreach($wit as $withdraw) {
                        $pay_min_wit = get_post_meta( $post_arr['id'], 'casino_custom_meta_'.$withdraw.'_min_wit',true);
                        $pay_max_wit = get_post_meta( $post_arr['id'], 'casino_custom_meta_'.$withdraw.'_max_wit',true);
                        $pay_wit_time = get_post_meta( $post_arr['id'], 'casino_custom_meta_'.$withdraw.'_wit_time',true);
                        foreach (array('min_wit'=>$pay_min_wit,'max_wit'=>$pay_max_wit,'wit_time'=>$pay_wit_time) as $key=>$val) {
                            if (!(empty($val))) {
                                $ret[$withdraw][$key] = $val;
                            }
                        }
                    }
                    return $ret;
                },
            ) );
            register_rest_field( 'kss_casino', 'license_country', array(
                'get_callback' => function( $post_arr, $attr, $request ) {
                    if ($this->checkToEnable($request)) {
                        return '';
                    }
                    $ret = array();
                    foreach (get_post_meta( $post_arr['id'], 'casino_custom_meta_license_country', true ) as $country) {
                        $ret[] = get_the_title($country);
                    }
                    return $ret;
                },
            ) );
            register_rest_field( 'kss_casino', 'gimme_meta', array(
                'get_callback' => function( $post_arr, $attr, $request ) {
                    if ($this->checkToEnable($request)) {
                        return '';
                    }
                    $activeCountries = WordPressSettings::getCountryEnabledSettings();
                    $activeCountriesWithNames = WordPressSettings::getCountryEnabledSettingsWithNames();
                    $prefix = 'casino_custom_meta_';
                    $filledCountries = get_post_meta($post->ID, $prefix . 'bonus_contries_filled', true) ? get_post_meta($post->ID, $prefix . 'bonus_contries_filled', true) : [];
                    $ret = array();
                    $allMeta = get_metadata('post', $post_arr['id']);
                    $fieldsToRead = array(
//                        step metaboxes
                        'step1_1','step1_2','step2_1','step2_2','step3_1','step3_2',
//                        review_section metaboxes
//                        'h1','h2_screenshot','h2_ratings','heading_state_lic','heading_lic','banking',
//                        'heading_state_pay','heading_pay','payments_text','heading_state_slot','heading_slot','li_mo',
//                        'heading_state_live','heading_live','ot_in','note','heading_state_mob','heading_mob','mobile',
//                        'heading_state_games','heading_games','sl_ga',
//                        rtp metaboxes
//                        'slots_rtp','roulette_rtp','blackjack_rtp','tableGames_rtp','videoPoker_rtp','scratchCards_rtp',
//                        'arcadeGames_rtp',
//                      casino ratings metaboxes
//                        'reli_rat','paym_op','payo_spe','playo_rat','expo_rat','slot_rat','jack_rat','prov_rat',
//                        'otg_rat','mob_rat','live_rat','cust_rat','bank_rat','overq_rat','game_rat',
                            'sum_rating',
//                        'bonus_rating',
//                        casino header metaboxes
//                        'custom_cta','custom_header','custom_promo_desc','comp_banner','comp_screen_1','comp_screen_2',
//                        'comp_screen_3','comp_mobi_screen_1',
//                        cs to be done

//                        general metaboxes
                        'why_play','pros','why_not_play','softwares','live_softwares',
//                        'platforms','payout','loyalty',
//                        'vip','exclusive','live_casino','mobile_casino','prog_jackpot','affiliate_link',
//                        'affiliate_link_review','affiliate_link_bonus','affiliate_link_free_spins',
//                        'affiliate_link_no_depo','slots_nbr','slots_rating',
                        'games','live_games',
//                        identity metaboxes
                        'com_url','com_off_name','com_head','com_estab','comun_hours','auditing',
//                        ,'license_country'
//                        payments metaboxes
                        'min_dep','min_withd',
//                        'dep_options','dep_options_strict',
                        //transactions .$transactionDI. '_min_dep','_max_dep','_dep_time' ???
//                        'with_options_strict',
                        //$validTransactions ???
                        'wallets_transfer_time','cards_transfer_time','bank_transfer_time',
//                        special metaboxes
//                        'text_slots_link','url_slots_link','text_offers_news_link','url_offers_news_link','cta_bonus',
//                        'bonus_page',
//                        geo metaboxes
                        'rest_countries',
//                        'lang_sup_site','lang_sup_cs','cur_acc',
//                        faq metaboxes
//                        hide metaboxes
                        'hidden','flaged',
//                        images metaboxes
                        'bg_color',
//                        'sidebar_icon','trans_logo','rat_bg','mbapp_bg','head_img','mbapp_ticks',


                    );
                    $ret = array();
                    foreach ($fieldsToRead as $fieldName) {
                        $ret[$fieldName] = maybe_unserialize($allMeta[$prefix . $fieldName][0]);
                    }

                    return $ret;
                },
            ) );
        } );
        add_action( 'rest_api_init', function () {
//            register_rest_field( 'bc_bonus', 'all_meta', array(
//                'get_callback' => function( $post_arr ) {
//                    $ret = get_post_meta( $post_arr['id'] );
//                    return $ret;
//                },
//            ) );
            register_rest_field( 'bc_bonus', 'gimme_meta', array(
                'get_callback' => function( $post_arr, $attr, $request ) {
                    if ($this->checkToEnable($request)) {
                        return '';
                    }
                    $activeCountries = WordPressSettings::getCountryEnabledSettings();
                    $activeCountriesWithNames = WordPressSettings::getCountryEnabledSettingsWithNames();
                    $prefix = 'bs_custom_meta_';
                    $filledCountries = get_post_meta($post->ID, $prefix . 'bonus_contries_filled', true) ? get_post_meta($post->ID, $prefix . 'bonus_contries_filled', true) : [];
                    $ret = array();
                    $allMeta = get_metadata('post', $post_arr['id']);
                    $fieldsToRead = array('exclusive','no_bonus','no_bonus_code','top_up_cta','wag_s','wag_d','wag_b','bc_perc',
                        'promo_amount','cta_for_top_2','cta_for_top','bc_code','sp_terms_link','sp_terms','min_dep',
                        'nodep','rewards_type','cashback_type','spins_type','bonus_type','_is_vip','_is_no_dep',
                        '_is_free_spins','first_cta','second_cta','kss_transactions'
                    );
                    foreach ($activeCountriesWithNames as $iso => $name) {
                        if(isset($casinoRestrictions[$iso])){continue;}
                        $ret[$iso] = array();
                        foreach ($fieldsToRead as $fieldName) {
                            $ret[$iso][$fieldName] = $allMeta[$iso . $prefix . $fieldName][0];
                        }
                    }
                    return $ret;
                },
            ) );
        } );
        add_action( 'rest_api_init', function () {
            register_rest_field( 'kss_softwares', 'live_meta', array(
                'get_callback' => function( $post_arr, $attr, $request ) {
                    if ($this->checkToEnable($request)) {
                        return '';
                    }
                    return get_post_meta( $post_arr['id'], 'software_custom_meta_livecasino', true );
                },
            ) );
        } );
    }
    /**
     * Allows templates for Custom Post Type to be in a separate folder
     *
     * @link https://wordpress.org/support/topic/custom-post-type-templates-and-custom-directory-locaiton
     */
    private function custom_template_include( $template ) {

        $custom_template_location = '/templates/';
        $custom_single_template_location = 'post-templates/';
        $custom_page_template_location = 'page-templates/';
        $custom_archive_template_location = 'archive-templates/';

        if ( get_post_type() ) {
            if (is_archive()) :
                if (file_exists(get_stylesheet_directory() . $custom_template_location.$custom_archive_template_location . 'archive-' . get_post_type() . '.php')) {
                    return get_stylesheet_directory() . $custom_template_location.$custom_archive_template_location . 'archive-' . get_post_type() . '.php';
                }
            endif;
            if ( is_single() ) :
                if ( file_exists( get_stylesheet_directory() . $custom_template_location.$custom_single_template_location . 'single-' . get_post_type() . '.php' ) ) {
                    return get_stylesheet_directory() . $custom_template_location.$custom_single_template_location . 'single-' . get_post_type() . '.php';
                }
            endif;
            if(is_page()):
                if ( file_exists( get_stylesheet_directory() . $custom_template_location.$custom_page_template_location . 'page-' . get_post_type() . '.php' ) ) {
                    return get_stylesheet_directory() . $custom_template_location.$custom_page_template_location . 'page-' . get_post_type() . '.php';
                }
            endif;
        }

        return $template;
    }

    private function addPostTypes()
    {
        $postTypesArray = [ //Args = Singular, Plural, post_type name,  Slug, Visibility, supports
            ['Casino', 'Casinos', 'kss_casino', 'casino', true, ['title', 'editor', 'excerpt', 'custom-fields', 'thumbnail','page-attributes', 'comments','revisions', 'author'], array('casino','casinos'),['post_tag', 'category', 'casino'] ,'casino'],
            ['Bonus Page', 'Bonus Pages', 'bc_bonus_page','bonus-page', true, ['title', 'editor', 'excerpt', 'custom-fields', 'thumbnail','page-attributes', 'comments' ,'revisions'], 'post', ['post_tag', 'casino' ], ''],
            ['Country', 'Countries', 'bc_countries','countries', true, ['title', 'editor', 'excerpt', 'custom-fields', 'thumbnail','page-attributes', 'comments', 'revisions'], 'post', ['post_tag', 'casino']],
            ['Casino Game', 'Casino Games', 'kss_games', 'casinogames', true, ['title', 'editor', 'excerpt', 'custom-fields', 'thumbnail','page-attributes', 'comments','revisions'], 'post', ['post_tag', 'casino']],
            ['Guide', 'Guides', 'kss_guides','guides', true, ['title', 'editor', 'excerpt', 'custom-fields', 'thumbnail','page-attributes', 'comments', 'revisions'], 'post',['post_tag', 'casino']],
            ['New', 'Casino News', 'kss_news','news', true, ['title', 'editor', 'excerpt', 'custom-fields', 'thumbnail','page-attributes', 'comments' , 'revisions'], 'post', ['post_tag','casino']],
            ['Promotion', 'Promotions', 'bc_offers','promotions', false, ['title', 'excerpt', 'custom-fields', 'thumbnail','page-attributes', 'comments','revisions'],'post', ['post_tag', 'casino']],
            ['Provider', 'Providers', 'kss_softwares','providers', true, ['title', 'editor', 'excerpt', 'custom-fields', 'thumbnail','page-attributes', 'comments','revisions' ],'post', ['post_tag', 'casino']],
            ['Slot', 'Slots', 'kss_slots','slots', true, ['title', 'editor', 'excerpt', 'custom-fields', 'thumbnail','page-attributes', 'comments','revisions'],'post', ['post_tag', 'slot']],
            ['Payment Method', 'Payment Methods', 'kss_transactions','payment-methods', true, ['title', 'editor', 'excerpt', 'custom-fields', 'thumbnail','page-attributes', 'comments','revisions'],'post', ['post_tag', 'casino']],
            ['Crypto', 'Cryptos', 'kss_crypto','crypto-casinos', true, ['title', 'editor', 'excerpt', 'custom-fields', 'thumbnail','page-attributes', 'comments','revisions'],'post', ['post_tag', 'casino']],
            ['Bonus', 'Bonuses', 'bc_bonus','bonus', false, ['title', 'excerpt', 'custom-fields', 'thumbnail','page-attributes', 'comments','revisions'],'post', ['post_tag', 'casino']],
            ['Banner', 'Banners', 'best50_ad','best50_ad', false, ['title', 'excerpt', 'custom-fields','page-attributes', 'comments'],'post', ['post_tag', 'category', 'Bookmaker']],
            ['License', 'License', 'license','license', true, ['title', 'editor', 'thumbnail', 'revisions'], array('license','licenses'), ['post_tag']],
            ['Pop Ups', 'Pop Ups', 'pop_ups','pop_ups', false, ['title','custom-fields'],'post', []],
            ['Casino Sharkcode', 'Casino Sharkcodes', 'nc_shortcodes','nc_shortcodes', false, ['title'],'post', []],
            ['Posts Sharkcode', 'Posts Sharkcodes', 'posts_shortcodes','posts_shortcodes', false, ['title'],'post', []],
            ['Games Sharkcode', 'Games Sharkcodes', 'games_shortcodes','games_shortcodes', false, ['title'],'post', []],
            ['Promotions Sharkcode', 'Promotions Sharkcodes', 'promo_shortcodes','promo_shortcodes', false, ['title'],'post', []],
            ['Slot Sharkcode', 'Slot Sharkcodes', 'slot_shortcodes','slot_shortcodes', false, ['title'],'post', []],
            ['Player\'s Review', 'Player\'s Reviews', 'player_review','players-reviews', false, ['editor', 'thumbnail'], array('player_review','player_reviews'), []],
            ['Table Tabs', 'Table Tabs', 'table_tabs', 'table_tabs', false, ['title','custom-fields', 'revisions'], array('table_tab','table_tabs'),[]],
        ];
        foreach($postTypesArray as $postTypeArgs){
            $postType = new PostTypesSetup;
            $postType->insertPostType($postTypeArgs);
        }
    }

    private function addTxonomies(){ //Args = Singular, Plural, post_type name,  Slug, Visibility, supports (Relevant postType)
        $TaxonomiesArray = [
            ['Promotion Type', 'Promotion Types', 'promotions-type', 'promotions-type', false, ['bc_offers']],
            ['Bonus Type', 'Bonus Types', 'bonus-types', 'betbonus', false, ['bc_bonus']],
            ['Guides Category', 'Guides Categories', 'cat-guides', 'cate-guides', false, ['page','kss_guides']],
//            ['Boookmakers Shortcodes Category', 'Boookmakers Shortcodes Categories', 'foxcode_category', 'foxcode_category', true, ['foxcode']],
//            ['Payment Type', 'Payment Types', 'payment_type', 'payment_type', true, ['payment']],
//            ['Guides Type', 'Guides Types', 'guide_type', 'guide_type', true, ['guide']],
        ];
        foreach($TaxonomiesArray as $TaxonomyArgs){
            $postType = new PostTypesSetup;
            $postType->insertTaxonomy($TaxonomyArgs);
        }
    }

    public function addSupport($feature, $options = null)
    {
        $this->actionAfterSetup(function() use ($feature, $options) {
            if ($options){
                add_theme_support($feature, $options);
            } else {
                add_theme_support($feature);
            }
        });
        return $this;
    }

    public function addAdminStyle($handle,  $src = '',  $deps = array(), $ver = false, $media = 'all')
    {
        $this->actionAdminEnqueueScripts(function() use ($handle, $src, $deps, $ver, $media){
            wp_enqueue_style($handle,  $src,  $deps, $ver, $media);
        });
        return $this;
    }
    public function addAdminScript($handle,  $src = '',  $deps = array(), $ver = false, $in_footer = false)
    {
        $this->actionAdminEnqueueScripts(function() use ($handle, $src, $deps, $ver, $in_footer){
            wp_enqueue_script($handle,  $src,  $deps, $ver, $in_footer);
        });
        return $this;
    }


    public function removeSupport($feature)
    {
        $this->actionAfterSetup(function() use ($feature){
            remove_theme_support($feature);
        });
        return $this;
    }
    public function addImageSize($name, $width = 0, $height = 0, $crop = false)
    {
        $this->actionAfterSetup(function() use ($name, $width, $height, $crop){
            add_image_size($name, $width, $height, $crop);
        });
        return $this;
    }
    public function removeImageSize($name)
    {
        $this->actionAfterSetup(function() use ($name){
            remove_image_size($name);
        });
        return $this;
    }
    public function addStyle($handle)
    {
        $this->actionEnqueueScripts(function() use ($handle){
            wp_enqueue_style($handle);
            wp_register_style($handle);
        });
        return $this;
    }
    public function addScript($handle)
    {
        $this->actionEnqueueScripts(function() use ($handle){
            wp_enqueue_script($handle);
            wp_register_script($handle);
        });
        return $this;
    }
    public function removeStyle($handle)
    {
        $this->actionEnqueueScripts(function() use ($handle){
            wp_dequeue_style($handle);
            wp_deregister_style($handle);
        });
        return $this;
    }
    public function removeScript($handle)
    {
        $this->actionEnqueueScripts(function() use ($handle){
            wp_dequeue_script($handle);
            wp_deregister_script($handle);
        });
        return $this;
    }
    public function addNavMenus($locations = array())
    {
        $this->actionAfterSetup(function() use ($locations){
            register_nav_menus($locations);
        });
        return $this;
    }
    public function addNavMenu($location, $description)
    {
        $this->actionAfterSetup(function() use ($location, $description){
            register_nav_menu($location, $description);
        });
        return $this;
    }
    public function removeNavMenu($location){
        $this->actionAfterSetup(function() use ($location){
            unregister_nav_menu($location);
        });
        return $this;
    }
}