<?php
/**
 * Add custom fields to menu item
 *
 * This will allow us to play nicely with any other plugin that is adding the same hook
 *
 * @param  int $item_id
 * @params obj $item - the menu item
 * @params array $args
 */
function menu_custom_fields( $item_id, $item ) {
    wp_nonce_field( 'custom_menu_icon_nonce', '_custom_menu_icon_nonce_name' );
    $custom_menu_icon = get_post_meta( $item_id, '_custom_menu_icon', true );
    $menuheader = get_post_meta( $item_id, '_menu_header', true );
    ?>
​
    <input type="hidden" name="custom-menu-meta-nonce" value="<?php echo wp_create_nonce( 'custom-menu-meta-name' ); ?>" />
​
    <div class="field-custom_menu_icon description-wide" style="margin: 5px 0;">
        <div class="bg-primary text-white w-100 pl-5p">Menu Item Meta</div>
        <br />
​
        <input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />
​
        <div class="logged-input-holder my_meta_control">
            <div class="d-flex align-items-center">
                <input type="checkbox" id="menu-header-for-<?php echo $item_id ;?>" name="menu_header[<?php echo $item_id ;?>]"
                    value="1" <?php echo checked($menuheader,1,false); ?> class="mr-1"/>
                <label for="menu_header[<?php echo $item_id ;?>]">Is this a header?</label>
            </div>
            <br />
            <div class="d-flex align-items-center">
                <div class="image-preview mr-1 col-2"
                     id="custom-menu-meta-for-<?php echo $item_id ;?>_preview">
                    <?php if (isset($custom_menu_icon)) { ?>
                        <img width="25"
                             src="<?php echo $custom_menu_icon ?>"
                             class="img-fluid"
                             loading="lazy"
                             style="max-height: 90px;">
                    <?php } ?>
                </div>
                <input type="text" id="custom-menu-meta-for-<?php echo $item_id ;?>" name="custom_menu_icon[<?php echo $item_id ;?>]"
                       value="<?php echo esc_attr( $custom_menu_icon ); ?>" class="mr-1 w-100"/>
                <button data-dest-selector="#custom-menu-meta-for-<?php echo $item_id ;?>" class="btn btn-info btn-sm btn-block add-logo-button">
                    Add Image
                </button>
            </div>
        </div>
​
    </div>
​
    <?php
}
add_action( 'wp_nav_menu_item_custom_fields', 'menu_custom_fields', 10, 2 );
/**
 * Save the menu item meta
 *
 * @param int $menu_id
 * @param int $menu_item_db_id
 */
function custom_menu_nav_update( $menu_id, $menu_item_db_id ) {

    // Verify this came from our screen and with proper authorization.
    if ( ! isset( $_POST['_custom_menu_icon_nonce_name'] ) || ! wp_verify_nonce( $_POST['_custom_menu_icon_nonce_name'], 'custom_menu_icon_nonce' ) ) {
        return $menu_id;
    }

    if ( isset( $_POST['custom_menu_icon'][$menu_item_db_id]  ) ) {
        $sanitized_data = sanitize_text_field( $_POST['custom_menu_icon'][$menu_item_db_id] );
        update_post_meta( $menu_item_db_id, '_custom_menu_icon', $sanitized_data );
    } else {
        delete_post_meta( $menu_item_db_id, '_custom_menu_icon' );
    }
    if ( isset( $_POST['menu_header'][$menu_item_db_id]  ) ) {
        $sanitized_data =  $_POST['menu_header'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_menu_header', $sanitized_data );
    } else {
        delete_post_meta( $menu_item_db_id, '_menu_header' );
    }
}
add_action( 'wp_update_nav_menu_item', 'custom_menu_nav_update', 10, 2 );

/**
 * Displays text on the front-end.
 *
 * @param string   $title The menu item's title.
 * @param WP_Post  $item  The current menu item.
 * @return string
 */
function add_icon_on_menu_title( $title, $item ) {

    if( is_object( $item ) && isset( $item->ID ) ) {

        $custom_menu_icon = get_post_meta( $item->ID, '_custom_menu_icon', true );

        if ( ! empty( $custom_menu_icon ) ) {
            $title = '<img src="'.$custom_menu_icon.'" loading="lazy" class="mr-5p img-fluid" width="25" height="25">'.$title;
        }
    }
    return $title;
}
add_filter( 'nav_menu_item_title', 'add_icon_on_menu_title', 10, 2 );