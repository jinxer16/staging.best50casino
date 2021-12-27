<?php
/**
 * Created by PhpStorm.
 * User: Panos
 * Date: 31/7/2019
 * Time: 11:59 πμ
 */

function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function add_image_responsive_class($class){
    return $class . ' img-fluid';
}
add_filter('get_image_tag_class','add_image_responsive_class');
add_action( 'after_setup_theme', 'wpdocs_theme_setup' );
function wpdocs_theme_setup()
{
    add_image_size('book_logo', '340', '170', true);
    add_image_size('book_logo_mob', '95', '65', true);
    add_image_size('book_thumb', '102', '34', true);
    add_image_size('bk485_300', '485', '300', true);

}

add_filter( 'admin_post_thumbnail_html', 'show_hide_featured_image', 10, 2 ); //same as before
function show_hide_featured_image( $myhtml, $post_id ) {
    global $post;

    $meta = get_post_meta( $post_id, 'hide_featured', true ); // get the current value
    if ($meta){
        $checked = 'checked="checked"';
    }elseif(!$meta){
        $checked = ' ';
    }

    $selects = '<input type="checkbox" name="hide_featured" id="hide_featured" '.$checked.' />';

    //create the return html, with the selects created before
    return $myhtml .= $meta.'Hide Featured Image  
                ' . $selects . '
        ';
}

function bh_custom_image_sizes_choose( $sizes ) {

    $custom_sizes = array(
        'book_logo' => '340px 170px',
        'book_thumb' => '102px 34px',
        'book_logo_mob' => '95px 65px',
    );

    return array_merge( $sizes, $custom_sizes );
}

add_filter( 'image_size_names_choose', 'bh_custom_image_sizes_choose' );


function set_background( $image_path, $echo = true ) {

    $html  = 'style="background-image:url(';
    $html .= $image_path;
    $html .= ')"';
    if($echo != true){
        return $html;
    }else{
        echo $html;
    }
}

function get_image_id_by_link($link){
    global $wpdb;
    $link = preg_replace('/-\d+x\d+(?=\.(jpg|jpeg|png|gif|svg)$)/i', '', $link);
    return $wpdb->get_var("SELECT ID FROM {$wpdb->posts} WHERE BINARY guid='$link'");
}
// get image id
function getImageId($image_url) {
    global $wpdb;
    $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
    return $attachment[0];
}
add_action('save_post', 'save_featured', 10, 3);
//
function save_featured($post_ID, $post, $update) {
    if(isset($_POST['hide_featured'])){
        update_post_meta( $post_ID, 'hide_featured','on' );
    }else{
        delete_post_meta( $post_ID, 'hide_featured' ); // get the current value
    }
    return true;
}