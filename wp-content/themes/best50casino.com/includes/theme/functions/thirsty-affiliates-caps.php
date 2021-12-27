<?php
//add_action( 'init', 'thirsty_new_caps', 10, 2 );
///**
// * Modify registered post type capabilities
// *
// * @param string $post_type Registered post type name.
// * @param array $args Array of post type parameters.
// */
//function thirsty_new_caps() {
//    global $wp_post_types;
//    $newCaps = [
//        'edit_post'          => 'edit_thirstylink',
//        'read_post'          => 'read_thirstylink',
//        'delete_post'        => 'delete_thirstylink',
//        'delete_posts'        => 'delete_thirstylinks',
//        'edit_posts'         => 'edit_thirstylinks',
//        'edit_others_posts'  => 'edit_others_thirstylinks',
//        'publish_posts'      => 'publish_thirstylinks',
//        'read_private_posts' => 'read_private_thirstylinks',
//        'create_posts'       => 'edit_thirstylinks',
//        "delete_private_posts" => "delete_private_thirstylinks",
//        "delete_published_posts" => "delete_published_thirstylinks",
//        "delete_others_posts" => "delete_others_thirstylinks",
//        "edit_private_posts" => "edit_private_thirstylinks",
//        "edit_published_posts" => "edit_published_thirstylinks",
//    ];
//
//    $wp_post_types['thirstylink']->capability_type = 'thirstylink';
//    $caps = $wp_post_types['thirstylink']->cap;
//    $caps = (array)$caps;
//    $caps = $newCaps;
//    $wp_post_types['thirstylink']->cap = (object)$caps;
//    $role = get_role( 'administrator' );
//    foreach ($caps as $defCap => $specCap){
//        $role->add_cap( $specCap );
//    }
//}