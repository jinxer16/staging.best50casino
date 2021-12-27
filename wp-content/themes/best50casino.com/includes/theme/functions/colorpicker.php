<?php
add_action( 'admin_enqueue_scripts', 'addColorPicker');

if ( ! function_exists( 'addColorPicker' ) ){
    function addColorPicker( $hook ) {
        wp_enqueue_style( 'wp-color-picker');
        wp_enqueue_script( 'wp-color-picker');
    }
}

// Changed TablePress view-edit.php edit.js class-render.php