<?php
add_action('after_setup_theme','userRoles');
function userRoles(){
    update_option('roles_are_set',false);
    $roles_set = get_option('roles_are_set');
    if(!$roles_set){
        add_role('limitedEditor', 'Νέος Συντάκτης', array(
            'read'         => true,
            'edit_posts'   => true,
            'upload_files' => true,
            'edit_pages'   => true,
            'read_private_pages'   => true,
            'edit_private_pages'   => true,
            'delete_pages'   => true,
//            'publish_pages' => true,
//            'edit_published_posts' => true,
//            'edit_published_pages' => true,
//            'publish_posts' => true
        ));
        update_option('roles_are_set',true);
    }
}
function modify_limitedEditor_role() {
    $role = get_role( 'limitedEditor' );
    $role->add_cap( 'edit_pages' );
    $role->add_cap( 'edit_published_pages' );
    $role->add_cap( 'edit_others_pages' );
    $role->add_cap( 'edit_others_posts' );
    $role->add_cap( 'edit_published_posts' );
    $role->add_cap( 'manage_options' );
    $role->add_cap( 'publish_posts' );
    $role->add_cap( 'create_posts' );
    $role->add_cap( 'delete_posts' );
    $role->add_cap( 'delete_private_posts' );
    $role->add_cap( 'delete_others_posts' );
    $role->add_cap( 'delete_published_posts' );
    $role->add_cap( 'edit_theme_options' );
//    $role->add_cap( 'edit_kss_casino' );
//    $role->add_cap( 'edit_published_kss_casino' );
//    $role->add_cap( 'edit_others_kss_casino' );

    $role->add_cap( 'read_casino' );
    $role->add_cap( 'edit_casino' );
    $role->add_cap( 'edit_published_casino' );
    $role->add_cap( 'edit_others_casino' );
    $role->add_cap( 'edit_casinos' );
    $role->add_cap( 'edit_published_casinos' );
    $role->add_cap( 'edit_others_casinos' );
    $role->add_cap( 'create_o' );
    $role->add_cap( 'read_o' );
    $role->add_cap( 'edit_o' );
    $role->add_cap( 'edit_published_o' );
    $role->add_cap( 'edit_others_o' );
    $role->add_cap( 'edit_p' );
    $role->add_cap( 'edit_published_p' );
    $role->add_cap( 'edit_others_p' );
    $role->add_cap( 'publish_p' );
    $role->add_cap( 'publish_o' );
//    $role->add_cap( 'edit_kss_news' );
//    $role->add_cap( 'edit_published_kss_news' );
//    $role->add_cap( 'edit_others_kss_news' );
//
//    $role->add_cap( 'edit_bc_bonus_page' );
//    $role->add_cap( 'edit_published_bc_bonus_page' );
//    $role->add_cap( 'edit_others_bc_bonus_page' );
//
//    $role->add_cap( 'edit_bc_bonus' );
//    $role->add_cap( 'edit_published_bc_bonus' );
//    $role->add_cap( 'edit_others_bc_bonus' );
//
//
//    $role->add_cap( 'edit_kss_softwares' );
//    $role->add_cap( 'edit_published_kss_softwares' );
//    $role->add_cap( 'edit_others_kss_softwares' );
//
//    $role->add_cap( 'edit_kss_transactions' );
//    $role->add_cap( 'edit_published_kss_transactions' );
//    $role->add_cap( 'edit_others_kss_transactions' );
//
//    $role->add_cap( 'edit_bc_offers' );
//    $role->add_cap( 'edit_published_bc_offers' );
//    $role->add_cap( 'edit_others_bc_offers' );
}
add_action( 'admin_init', 'modify_limitedEditor_role');


add_action( 'admin_init', 'bh_menu_pages_remove' );

function bh_menu_pages_remove() {
    if ( current_user_can( 'limitedEditor' ) ) {

//        if( current_user_can( 'contributor' ) ){
//            remove_menu_page( 'edit.php?post_type=tipster' );
//            add_filter( 'list_terms_exclusions', 'categories_for_special_lists', 10, 2 ); //κρύβει τα βασικά categories (για ανθρώπους που θέλουμε να γράφουν άρθρα και να ανήκους σε περιορισμένες κατηγορίες)
//        }
        remove_menu_page( 'tools.php' );
        remove_menu_page( 'upload.php' );
        remove_menu_page( 'index.php' );
        remove_menu_page( 'edit-comments.php' );
        remove_menu_page( 'edit.php' );
        remove_menu_page( 'edit.php?post_type=page' );
        remove_menu_page( 'edit.php?post_type=kss_guides' );
//        remove_menu_page( 'edit.php?post_type=bc_offers' );
//        remove_menu_page( 'edit.php?post_type=bc_bonus' );
//        remove_menu_page( 'edit.php?post_type=bc_bonus_page' );
        remove_menu_page( 'edit.php?post_type=thirstylink' );
        remove_menu_page( 'edit.php?post_type=bc_countries' );
        remove_menu_page( 'edit.php?post_type=acf-field-group' );
//        remove_menu_page( 'edit.php?post_type=kss_slots' );
//        remove_menu_page( 'edit.php?post_type=kss_games' );
//        remove_menu_page( 'edit.php?post_type=kss_softwares' );
//        remove_menu_page( 'edit.php?post_type=kss_transactions' );
//        remove_menu_page( 'edit.php?post_type=nc_shortcodes' );
//        remove_menu_page( 'edit.php?post_type=slot_shortcodes' );
//        remove_menu_page( 'edit.php?post_type=games_shortcodes' );
//        remove_menu_page( 'edit.php?post_type=sl_ga_shortcodes' );
//        remove_menu_page( 'edit.php?post_type=posts_shortcodes' );
        remove_menu_page( 'edit.php?post_type=best50_ad' );
//        remove_menu_page( 'edit.php?post_type=promo_shortcodes' );
        remove_menu_page( 'wpcf7' );
        remove_menu_page( 'shortcodes-ultimate' );
        remove_meta_box('show-hide-sidebar','kss_news','side');
    }
}