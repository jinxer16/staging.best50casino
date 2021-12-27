<?php
function subscribe_shortcode($atts){
    $atts = shortcode_atts(
        array(
            'title_text' => '',
            'title_type' => '',
        ), $atts, 'title' ) ;

    $email = isset($_GET['ms-email']);
        $ret = '';
    return $ret;
}

add_shortcode('subscribe','subscribe_shortcode');
?>