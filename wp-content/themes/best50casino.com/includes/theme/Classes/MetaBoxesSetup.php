<?php
/**
 * Created by PhpStorm.
 * User: Panos
 * Date: 5/6/2019
 * Time: 9:55 πμ
 */

class MetaBoxesSetup
{

    public function __construct()
    {
        $this->setMetaboxes();

    }

    public static function head_scripts_filter_func(){
        echo "<script type='text/javascript' src='".get_stylesheet_directory_uri()."/includes/theme/Settings/repeater_custom.js'></script>";
        echo "<script type='text/javascript' src='".get_stylesheet_directory_uri()."/includes/theme/Metaboxes/jquery-ui-1-12-1.js'></script>";
        echo "<link rel='stylesheet' href='//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'>";
        echo '<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />';
        echo '<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>';
    }

    public static function head_bonus_scripts_filter_func(){
        echo "<script type='text/javascript' src='".get_stylesheet_directory_uri()."/assets/js/bonus.min.js'></script>";
    }

    public function setMetaboxes(){
        global  $wpalchemy_media_access;
        $wpalchemy_media_access = new WPAlchemy_MediaAccess;
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_related_all',
            'title' => 'Related Articles of Page',
            'types' => ['post','page'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/all/related-posts-meta.php'
        ));

        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_faqs_all',
            'title' => 'Faqs of Page',
            'types' => ['post','page','kss_news','kss_transactions','kss_softwares','kss_guides', 'kss_crypto'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/casino/faqs.php'
        ));


//        $full_mb = new WPAlchemy_MetaBox(array
//        (
//            'id' => '_anchors_section',
//            'title' => 'Anchors',
//            'types' => array('kss_casino'), // added only for pages and to custom post type "events"
//            'context' => 'normal', // same as above, defaults to "normal"
//            'priority' => 'high', // same as above, defaults to "high"
//            'autosave' => TRUE,
//            'mode' => WPALCHEMY_MODE_EXTRACT,
//            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/casino/anchors.php'
//        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_steps_section',
            'title' => 'Steps',
            'types' => array('kss_casino'), // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/casino/steps.php'
        ));

        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_casino_header',
            'title' => 'Casino Header',
            'types' => ['kss_casino'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/casino/header.php'
        ));

        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_review_section',
            'title' => 'Review Section',
            'types' => array('kss_casino'), // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/casino/review-section.php'
        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_casino_template',
            'title' => 'Choose Template',
            'types' => array('kss_casino'), // added only for pages and to custom post type "events"
            'context' => 'side', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/casino/template.php'
        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_hide_slots',
            'title' => 'Hide Slots',
            'types' => array('kss_casino'), // added only for pages and to custom post type "events"
            'context' => 'side', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/casino/hide-slots.php'
        ));
//        $full_mb = new WPAlchemy_MetaBox(array
//        (
//            'id' => '_casino_ratings',
//            'title' => 'Casino Rating - OLD will be replaced in future (max 10)',
//            'types' => array('kss_casino'), // added only for pages and to custom post type "events"
//            'context' => 'normal', // same as above, defaults to "normal"
//            'priority' => 'high', // same as above, defaults to "high"
//            'autosave' => TRUE,
//            'mode' => WPALCHEMY_MODE_EXTRACT,
//            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/casino/ratings.php'
//        ));
//        $full_mb = new WPAlchemy_MetaBox(array
//        (
//            'id' => '_casino_rtps',
//            'title' => 'Casino RTPs',
//            'types' => array('kss_casino'), // added only for pages and to custom post type "events"
//            'context' => 'normal', // same as above, defaults to "normal"
//            'priority' => 'high', // same as above, defaults to "high"
//            'autosave' => TRUE,
//            'mode' => WPALCHEMY_MODE_EXTRACT,
//            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/casino/rtp.php',
//            'foot_filter' => array($this,'head_scripts_filter_func')
//        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_casino_rat_total',
            'title' => 'Casino Ratings',
            'types' => array('kss_casino'), // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/casino/ratings-casino.php',
            'foot_filter' => array($this,'head_scripts_filter_func')
        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_casino_images',
            'title' => 'Casino Images and Color',
            'types' => ['kss_casino', 'kss_transactions', 'kss_softwares', 'kss_crypto'], // added only for pages and to custom post type "events"
            'context' => 'side', // same as above, defaults to "normal"
            'priority' => 'low', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/casino/images.php'
        ));

        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_casino_cs',
            'title' => 'CS',
            'types' => ['kss_casino'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/casino/cs.php'
        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_casino_hide',
            'title' => 'Hidden/Flags',
            'types' => ['kss_casino'], // added only for pages and to custom post type "events"
            'context' => 'side', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/casino/hide.php'
        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_casino_general',
            'title' => 'Casino',
            'types' => ['kss_casino'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/casino/general.php'
        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_casino_identity',
            'title' => 'Casino Identity',
            'types' => ['kss_casino'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/casino/identity.php'
        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_casino_transactions',
            'title' => 'Payment Methods',
            'types' => ['kss_casino'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/casino/payments.php'
        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_casino_specialinfo',
            'title' => 'Slot/Articles/PromotionBonus link infos',
            'types' => ['kss_casino'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/casino/special.php'
        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_casino_geo_info',
            'title' => 'Geolocation Information',
            'types' => ['kss_casino'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/casino/geo.php'
        ));

        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_casino_bonus_details',
            'title' => 'Bonus Details',
            'types' => ['kss_casino'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/casino/bonus-details.php'
        ));

        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_casino_faqs',
            'title' => 'FAQs',
            'types' => ['kss_casino'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/casino/faqs.php'
        ));

        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_steps_section',
            'title' => 'Steps',
            'types' => array('bc_bonus_page'), // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/casino/steps.php'
        ));

        //Player's Review
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_review_details',
            'title' => 'Details for Player\'s Review',
            'types' => ['player_review'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/player-review/details.php'
        ));
        //BC_BONUS_PAGE
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_offer_details',
            'title' => 'Details for Offer',
            'types' => ['bc_bonus_page'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/bonus-page/details.php'
        ));

        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_offer_text',
            'title' => 'Sections',
            'types' => ['bc_bonus_page'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/bonus-page/sections.php'
        ));

        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_bonus_template',
            'title' => 'Choose Template',
            'types' => ['bc_bonus_page'], // added only for pages and to custom post type "events"
            'context' => 'side', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/bonus-page/template.php'
        ));

//        $full_mb = new WPAlchemy_MetaBox(array
//        (
//            'id' => '_bonus_rtps',
//            'title' => 'Bonus Page RTPs',
//            'types' => array('bc_bonus_page'), // added only for pages and to custom post type "events"
//            'context' => 'normal', // same as above, defaults to "normal"
//            'priority' => 'high', // same as above, defaults to "high"
//            'autosave' => TRUE,
//            'mode' => WPALCHEMY_MODE_EXTRACT,
//            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/bonus-page/rtp.php',
//            'foot_filter' => array($this,'head_scripts_filter_func')
//        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_bonus_faqs',
            'title' => 'FAQs',
            'types' => ['bc_bonus_page'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/bonus-page/faqs.php'
        ));

        //BC_BONUS
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_bonus_text',
            'title' => 'Details for Bonus',
            'types' => ['bc_bonus'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/bonus/details.php',
            'foot_filter' => array($this,'head_bonus_scripts_filter_func')
        ));
        //Countries
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_countries_meta',
            'title' => 'Country Details',
            'types' => ['bc_countries'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/country/details.php'
        ));
        //Games-transactions-providers
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_promo_casino_meta',
            'title' => 'Promoted Casino per Country',
            'types' => ['kss_games','kss_softwares','kss_transactions', 'kss_crypto'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/games-providers-payments/details.php'
        ));
        //Games
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_games_info_meta',
            'title' => 'General Info',
            'types' => ['kss_games'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/games/info.php'
        ));
        //Providers
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_software_info_meta',
            'title' => 'Provider Info',
            'types' => ['kss_softwares'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/providers/info.php'
        ));
        //Transactions
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_transactions_info_meta',
            'title' => 'Payment Method Info',
            'types' => ['kss_transactions', 'kss_crypto'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/payments/info.php'
        ));
        //NEWS
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_news_details_meta',
            'title' => 'Promo details for New\'s Article',
            'types' => ['kss_news'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/news/info.php'
        ));
        //OFFERS
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_offers_details_meta',
            'title' => 'Promo details for Offer',
            'types' => ['bc_offers'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'foot_filter' => array($this,'head_scripts_filter_func'),
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/offers/details.php'
        ));
        //SLOTS
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_slot_offline_meta',
            'title' => 'Offline Slot',
            'types' => ['kss_slots'], // added only for pages and to custom post type "events"
            'context' => 'side', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/slots/offline.php'
        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_slot_info_meta',
            'title' => 'Slot\'s General Info',
            'types' => ['kss_slots'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/slots/info.php'
        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_slot_table_meta',
            'title' => 'Slot Table',
            'types' => ['kss_slots'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/slots/table.php'
        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_sidebar',
            'title' => 'Hide Left Sidebar (2-column Layout)',
            'types' => ['post', 'page', 'kss_guides', 'kss_casino', 'kss_slots', 'kss_news', 'kss_softwares', 'kss_transactions', 'kss_offers', 'bc_countries', 'kss_crypto'], // added only for pages and to custom post type "events"
            'context' => 'side', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/all/sidebar.php'
        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_game_script',
            'title' => 'Game Script',
            'types' => ['post', 'page', 'kss_guides', 'kss_offers', 'kss_news'], // added only for pages and to custom post type "events"
            'context' => 'side', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/all/game-script.php'
        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_license_details',
            'title' => 'General Info',
            'types' => ['license'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/license/info.php'
        ));




        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_anchor_info',
            'types' => array('page','kss_transactions', 'kss_crypto', 'post', 'kss_softwares', 'kss_news','kss_guides','kss_games','bc_countries'), // added only for pages and to custom post type "events"
            'title' => 'Table of Contents',
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'exclude_template' => 'page-blackjack-calculator.php',
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/all/table-of-content.php'
        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_tabs_info',
            'types' => array('table_tabs'), // added only for pages and to custom post type "events"
            'title' => 'Tabs',
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/tabs/tabs.php',
            'foot_filter' => array($this,'head_scripts_filter_func')
        ));

        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_pop_ups_settings',
            'types' => array('pop_ups'), // added only for pages and to custom post type "events"
            'title' => 'Set-Up',
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/pop-ups/pop-ups-meta.php',
        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_select_gifts_fortune',
            'title' => 'Wheel of fortune',
            'context' => 'normal', // same as above, defaults to "normal"
            'types' => array('fortune-wheel'),
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/wheel/custom-meta-wheel.php',
        ));

    }
}