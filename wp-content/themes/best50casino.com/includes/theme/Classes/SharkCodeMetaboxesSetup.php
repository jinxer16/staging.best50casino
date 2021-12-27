<?php



class SharkCodeMetaboxesSetup
{
    public function __construct()
    {
        $this->setMetaboxes();

    }

    public static function head_scripts_filter_func(){
        echo "<script type='text/javascript' src='".get_stylesheet_directory_uri()."/includes/theme/Metaboxes/sharkCode-metaboxes.js'></script>";
        echo "<script type='text/javascript' src='".get_stylesheet_directory_uri()."/includes/theme/Metaboxes/jquery-ui-1-12-1.js'></script>";
        echo "<link rel='stylesheet' href='".get_stylesheet_directory_uri()."/includes/theme/Metaboxes/jquery-ui.css'/>";
    }

    public function setMetaboxes()
    {
        global $wpalchemy_media_access;
        $wpalchemy_media_access = new WPAlchemy_MediaAccess;
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => ' _shortcode_results_meta',
            'title' => 'SharkCode Result',
            'types' => ['nc_shortcodes','posts_shortcodes','games_shortcodes','promo_shortcodes','slot_shortcodes'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
            'foot_filter' => array($this,'head_scripts_filter_func'),
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/shortcodes/result.php'
        ));
        //SHORTCODES////////////////////////////////////////////////////////////////////////////////////////////////
        //CASINO
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => ' _casino_shark_layout',
            'title' => 'SharkCode Layout',
            'types' => ['nc_shortcodes'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
//            'foot_filter' => array($this,'shortcodes_func'),
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/shortcodes/casino-sharkcodes/layout.php'
        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => '_casino_shark_2nd_col',
            'title' => '2nd Column',
            'types' => ['nc_shortcodes'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
//            'foot_filter' => array($this,'shortcodes_func'),
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/shortcodes/casino-sharkcodes/2nd-column.php'
        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => ' _casino_shark_3rd_col',
            'title' => '3rd Column',
            'types' => ['nc_shortcodes'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
//            'foot_filter' => array($this,'shortcodes_func'),
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/shortcodes/casino-sharkcodes/3rd-column.php'
        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => ' _casino_shark_cta',
            'title' => 'CTA Column Layout',
            'types' => ['nc_shortcodes'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
//            'foot_filter' => array($this,'shortcodes_func'),
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/shortcodes/casino-sharkcodes/cta.php'
        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => ' _casino_shark_filters',
            'title' => 'Choose Filters',
            'types' => ['nc_shortcodes'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
//            'foot_filter' => array($this,'shortcodes_func'),
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/shortcodes/casino-sharkcodes/filters.php'
        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => ' _slots_layout',
            'title' => 'SharkCode Layout',
            'types' => ['slot_shortcodes'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
//            'foot_filter' => array($this,'shortcodes_func'),
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/shortcodes/slots-sharkcodes/layout.php'
        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => ' _slots_filters',
            'title' => 'Choose Filters',
            'types' => ['slot_shortcodes'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
//            'foot_filter' => array($this,'shortcodes_func'),
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/shortcodes/slots-sharkcodes/filters.php'
        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => ' _game_layout',
            'title' => 'Choose Layout',
            'types' => ['games_shortcodes'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
//            'foot_filter' => array($this,'shortcodes_func'),
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/shortcodes/games-sharkcodes/layout.php'
        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => ' _game_filters',
            'title' => 'Choose Filters',
            'types' => ['games_shortcodes'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
//            'foot_filter' => array($this,'shortcodes_func'),
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/shortcodes/games-sharkcodes/filters.php'
        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => ' _game_layout',
            'title' => 'Choose Layout',
            'types' => ['posts_shortcodes'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
//            'foot_filter' => array($this,'shortcodes_func'),
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/shortcodes/post-sharkcodes/layout.php'
        ));
        $full_mb = new WPAlchemy_MetaBox(array
        (
            'id' => ' _game_layout',
            'title' => 'Choose Layout',
            'types' => ['promo_shortcodes'], // added only for pages and to custom post type "events"
            'context' => 'normal', // same as above, defaults to "normal"
            'priority' => 'high', // same as above, defaults to "high"
            'autosave' => TRUE,
//            'foot_filter' => array($this,'shortcodes_func'),
            'mode' => WPALCHEMY_MODE_EXTRACT,
            'template' => TEMPLATEPATH . '/includes/theme/Metaboxes/shortcodes/promotions-sharkcodes/layout.php'
        ));
    }

}