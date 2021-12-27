<?php

function register_posttype_wheel()
{

    $labels = array(
        'name' => 'Wheel of fortune',
        'singular_name' => 'Wheel',
        'add_new' => 'Νέο Wheel',
        'add_new_item' => 'Νέο Wheel',
        'edit_item' => 'Επεξεργασία Wheel',
        'new_item' => 'Νέο Wheel',
        'all_items' => 'Όλα τα Wheel',
        'view_item' => 'Προβολή Wheel',
        'search_items' => 'Αναζήτηση στα Wheel',
        'not_found' => 'Δεν βρέθηκαν Wheel',
        'not_found_in_trash' => 'Δεν βρέθηκαν Wheel στα Διεγραμμένα',
        'parent_item_colon' => '',
        'menu_name' => 'Wheel of fortune'

    );
    $args = array(
        'labels' => $labels,
        'public' => false,
        'publicly_queryable' => false,//false,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => false,
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title'),
        'menu_icon' => get_template_directory_uri() . '/includes/theme/functions/wheel-of-fortune/assets/images/wheelmenu.png',
    );
    register_post_type('fortune-wheel', $args);
}
add_action( 'init', 'register_posttype_wheel' );