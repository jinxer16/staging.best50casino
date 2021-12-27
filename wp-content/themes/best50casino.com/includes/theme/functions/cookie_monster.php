<?php
function wpb_lastvisit_the_title ( ) {
    $title = true;
    if ( !isset($_COOKIE['lastvisit']) ||  $_COOKIE['lastvisit'] == '' ){
        return $title;
    }
    $lastvisit = $_COOKIE['lastvisit'];
    $current_date = current_time( 'timestamp', 1);
    if ($current_date - $lastvisit <= strtotime("-1 day")){
        $title = false;
    }
    return $title;
}

// Set the lastvisit cookie

function wpb_lastvisit_set_cookie() {
    if ( is_admin() ) return;
    $current = current_time( 'timestamp', 1);
    setcookie( 'lastvisit', $current, time()+60+60*24*7, COOKIEPATH, COOKIE_DOMAIN );
}
add_action( 'init', 'wpb_lastvisit_set_cookie' );
