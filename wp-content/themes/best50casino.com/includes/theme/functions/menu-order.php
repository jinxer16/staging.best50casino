<?php
// Rearrange the admin menu
// See: http://codex.wordpress.org/Plugin_API/Filter_Reference/menu_order
function custom_menu_order($menu_ord) {
    if (!$menu_ord) return true;
    return array(
        'index.php', // Dashboard
        'best50-main-menu',
        'helping-panel',
        'separator1', // First separator
        'edit.php?post_type=page', // Pages
        'edit.php?post_type=kss_news', // Οδηγοί
        'edit.php?post_type=kss_guides', // Οδηγοί
        'edit.php?post_type=bc_offers', // Προσφορές
        'edit.php?post_type=bc_bonus', // Προσφορές
        'edit.php?post_type=bc_bonus_page', // Προσφορές
        'upload.php', // Media
        'edit.php?post_type=thirstylink', //Aff
        'advanced-ads',
        'edit.php?post_type=kss_casino', // Custom type three
        'edit.php?post_type=bc_countries', // Custom type three
        'edit.php?post_type=kss_slots', // Custom type four
        'edit.php?post_type=kss_games', // Paixnidia
        'edit.php?post_type=kss_softwares',//Software
        'edit.php?post_type=kss_transactions',//Synallages
        'edit.php?post_type=kss_crypto',//Synallages
        'edit.php?post_type=nc_shortcodes', //Shortcode Casino
        'edit.php?post_type=slot_shortcodes', //Shortcode Slots
        'edit.php?post_type=games_shortcodes',//Shortcode Paixnidia
        'edit.php?post_type=sl_ga_shortcodes',//Shortcode ID
        'edit.php?post_type=posts_shortcodes',//Shortcode Posts
        'edit.php', // Posts
        'layerslider',
        'themes.php', // Appearance
        'separator2', // Second separator
        'link-manager.php', // Links
        'edit-comments.php', // Comments
        'plugins.php', // Plugins
        'users.php', // Users
        'tools.php', // Tools
        'options-general.php', // Settings
        'separator-last', // Last separator
    );

}
add_filter('custom_menu_order', 'custom_menu_order'); // Activate custom_menu_order
add_filter('menu_order', 'custom_menu_order');

function revcon_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Posts (not Used)';
    $submenu['edit.php'][5][0] = 'Posts (not Used)';
}
add_action( 'admin_menu', 'revcon_change_post_label' );



// add icon class for each menu item
class SH_Arrow_Walker_Nav_Menu extends Walker_Nav_Menu {

    private $menuID;

    /**
     * @param mixed $menuID
     */
    public function setMenuID($menuID)
    {
        $this->menuID = $menuID;
    }

    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        if('main-menu-r' == $args->theme_location && $depth == 2){
            $output .='<span class="arrow"><i class="fa fa-caret-down"></i></span>';
        }
        $output .= "\n$indent<ul class=\"sub-menu-main list-typenone\">\n";
    }



    function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {
        $this->setMenuID(uniqid( 'submenu-' ));
        if($args->theme_location == 'main-menu-burger' || $args->theme_location == 'anchor-menu'){
            $title = $item->title;
            $permalink = $item->url;
            $icon = get_post_meta($item->ID,'_custom_menu_icon',true);
            if(get_post_meta($item->ID,'_menu_header',true)==1){
                $output .= "<li class='" .  implode(" ", $item->classes) . " li-title w-100'>";
                if($permalink){
                    $output .= '<a href="'.$permalink.'" class="menu-link star main-menu-link text-white no-hover star text-whitte bg-dark text-sm-13 pl-5p ml-0p mb-0p h-100 text-left w-100 d-block" style="white-space: pre-wrap;">';
                    $output .= $title;
                    $output .= '</a>';
                }else{
                    $output .= '<div class="menu-link star main-menu-link text-white star text-whitte bg-dark text-sm-13 pl-5p  mb-0p h-100 text-left w-100 d-block" style="white-space: pre-wrap;">';
                    $output .= $title;
                    $output .= '</div>';
                }

            }else{
                $output .= "<li class='w-100 text-left" .  implode(" ", $item->classes) . "'>";
                $output .= '<a href="'.$permalink.'" class="pl-0 text-decoration-none ml-0p m-0p text-14 text-sm-13 text-dark">';
                if ( strpos($_SERVER['REQUEST_URI'], '/?amp' ) !=false ) {
                    $output .= !empty($icon) ? '<amp-img src="'.$icon.'" width="18" height="18" class="img-fluid mr-5p"></amp-img>'.$title:$title;
                }else{
                    $output .= !empty($icon) ? '<img src="'.$icon.'" loading="lazy" width="25" class="img-fluid mr-5p">'.$title:$title;
                }
                $output .= '</a>';
            }
        }else{
            $output .= $output;
        }
    }
}

function add_specific_menu_location_atts($atts, $item, $args)
{
// check if the item is in the primary menu
    if ($args->theme_location == 'main-menu-r' || $args->theme_location == 'main-menu') {
// add the desired attributes:
        $class = "mt-0 mb-0 mr-0 position-relative text-white text-16 mainm-items pt-0p list-none";
        $atts['class'] = (!empty($atts['class'])) ? $atts['class'] . ' ' . $class : $class;
    }elseif ($args->theme_location == 'sub-menu'){
        $class = "text-center font-weight-bold pl-25p d-inline text-16 list-none";
        $atts['class'] = (!empty($atts['class'])) ? $atts['class'] . ' ' . $class : $class;
    }elseif($args->theme_location == 'main-menu-m'){
        $class = " text-white text-15 font-weight-bold text-uppercase";
        $atts['class'] = (!empty($atts['class'])) ? $atts['class'] . ' ' . $class : $class;
    }

    return $atts;
}

add_filter('nav_menu_link_attributes', 'add_specific_menu_location_atts', 10, 3);



add_action( 'admin_menu', 'pending_posts_bubble_wpse_89028', 999 );
function pending_posts_bubble_wpse_89028()
{
    global $menu;
    // Get all post types and remove Attachments from the list
    // Add '_builtin' => false to exclude Posts and Pages
    $args = array( 'publicly_queryable' => false );
    $post_types = get_post_types($args);
    //dont include it for these custom post types
    unset( $post_types['posts_shortcodes'],$post_types['page'],$post_types['games_shortcodes'],$post_types['kss_transactions'],$post_types['promo_shortcodes'],$post_types['slot_shortcodes'],$post_types['post'],$post_types['bc_countries'],$post_types['bc_bonus_page'],$post_types['kss_games'],$post_types['kss_guides'],$post_types['kss_news'],$post_types['bc_offers'],$post_types['kss_softwares'],$post_types['kss_casino'],$post_types['kss_slots'],$post_types['bc_bonus'],$post_types['best50_ad'],$post_types['license'],$post_types['nc_shortcodes']);

    foreach( $post_types as $pt )
    {
        // Count posts
        $cpt_count = wp_count_posts( $pt );

        if ( $cpt_count->draft)
        {
            // Menu link suffix, Post is different from the rest
            $suffix = ( 'post' == $pt ) ? '' : "?post_type=$pt";

            // Locate the key of
            $key = recursive_array_search_php_91365( "edit.php$suffix", $menu );

            // Not found, just in case
            if( !$key )
                return;
            // Modify menu item
            $menu[$key][0] .= sprintf(
                '<span class="update-plugins count-%1$s" style="background-color:red;color:white;padding-left:4px;"><span class="plugin-count">%1$s</span></span>',
                $cpt_count->draft
            );
        }
        if ($cpt_count->pending){
            // Menu link suffix, Post is different from the rest
            $suffix = ( 'post' == $pt ) ? '' : "?post_type=$pt";

            // Locate the key of
            $key = recursive_array_search_php_91365( "edit.php$suffix", $menu );

            // Not found, just in case
            if( !$key )
                return;
            // Modify menu item
            $menu[$key][0] .= sprintf(
                '<span class="update-plugins count-%1$s" style="background-color:red;color:white;padding-left:4px;"><span class="plugin-count">%1$s</span></span>',
                $cpt_count->pending
            );
        }
    }
}

function recursive_array_search_php_91365( $needle, $haystack )
{
    foreach( $haystack as $key => $value )
    {
        $current_key = $key;
        if(
            $needle === $value
            OR (
                is_array( $value )
                && recursive_array_search_php_91365( $needle, $value ) !== false
            )
        )
        {
            return $current_key;
        }
    }
    return false;
}

function create_bootstrap_menu( $theme_location ) {
    if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
        $menu = get_term( $locations[$theme_location], 'nav_menu' );
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        $mainMenu = '';
        $subMenu = '';

        foreach( $menu_items as $menu_item ) {
            if( $menu_item->menu_item_parent == 0 ) {

                $parent = $menu_item->ID;

                $menu_array = array();
                foreach( $menu_items as $submenu ) {
                    if( $submenu->menu_item_parent == $parent ) {
                        $bool = true;
                        $menu_array[] = '<li id="menu-item-'.$submenu->ID.'" style="max-height: 28px;" class="w-33 d-flex align-items-start p-2p "><a class="best50-underline-from-left mt-0 mb-0 mr-0 position-relative text-white text-16 pt-0p list-none" href="' . $submenu->url . '">' . $submenu->title . '</a></li>' ."\n"; // creates li of child
                    }
                }
                if( $bool == true && count( $menu_array ) > 0 ) { // creates li parent and ul of child

                    $mainMenu .= '<li id="menu-item-'.$menu_item->ID.'" class="menu-item menu-item-has-children pointer"  onmouseover="toggleMenu(\'menu-item-'.$menu_item->ID.'\',\'in\')">' ."\n";
                    $mainMenu .= '<a href="'.$menu_item->url.'" class="best50-underline-from-left mt-0 mb-0 mr-0 position-relative text-white text-16 mainm-items pt-0p list-none" data-hover="dropdown"  aria-haspopup="true" aria-expanded="false">' . $menu_item->title . '</a>' ."\n";

                    $subMenu .= '<ul class="sub-menu d-none flex-wrap list-unstyled" id="child-menu-item-'.$menu_item->ID.'">' ."\n";
                    $subMenu .= implode( "\n", $menu_array );
                    $subMenu .= '</ul>' ."\n";

                } else {

                    $mainMenu .= '<li id="menu-item-'.$menu_item->ID.'" class="menu-item menu-item-'.$menu_item->ID.'">' ."\n"; // creates childless li
                    $mainMenu .= '<a class="mt-0 mb-0 mr-0 position-relative text-white text-16 mainm-items pt-0p list-none" href="' . $menu_item->url . '">' . $menu_item->title . '</a>' ."\n";
                }

            }

            // end <li>
            $mainMenu .= '</li>' ."\n";
        }
        ob_start(); ?>

        <ul id="menu-<?php echo $menu->slug; ?>" class="nav navbar-nav main-menu d-flex flex-row m-0 p-0 justify-content-start list-typenone align-items-stretch position-relative w-100 float-none">
            <?php echo $mainMenu; ?>
        </ul>
        <div id="subMenuWrapper" class="sub-menu-main">
            <div class="position-absolute subbed-in">
                <?php echo $subMenu; ?>
            </div>
        </div>
        <script>
            function toggleMenu(menuID,toDO){
                if(toDO==='in'){
                    var subMenuWrapper = document.getElementById("subMenuWrapper");
                    var subMenuItem = document.getElementById("child-"+menuID);
                    subMenuWrapper.classList.add("show-me");
                    x = document.querySelectorAll(".sub-menu");
                    for (var i = 0; i < x.length; i++) {
                        x[i].classList.add("d-none");
                        x[i].classList.remove("d-flex");
                    }
                    subMenuItem.classList.remove("d-none");
                    subMenuItem.classList.add("d-flex");
                }else{
                    var subMenuWrapper = document.getElementById("subMenuWrapper");
                    subMenuWrapper.classList.remove("show-me");
                    x = document.querySelectorAll(".sub-menu");
                    for (var i = 0; i < x.length; i++) {
                        x[i].classList.add("d-none");
                        x[i].classList.remove("d-flex");
                    }
                }
            }

        </script>
            <?php
    } else {
        $menu_list = '<!-- no menu defined in location "'.$theme_location.'" -->';
    }

    echo ob_get_clean();
}