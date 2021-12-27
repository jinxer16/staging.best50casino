<?php
add_filter( 'posts_orderby', 'posts_orderby_meta_value_list', 10, 2 );
function posts_orderby_meta_value_list( $orderby, $query ) {
    $key = 'meta_value_list';
    if ( $key === $query->get( 'orderby' ) &&
        ( $list = $query->get( $key ) ) ) {
        global $wpdb;
        $list = "'" . implode( wp_parse_list( $list ), "', '" ) . "'";
        return "FIELD( $wpdb->postmeta.meta_value, $list )";
    }

    return $orderby;
}