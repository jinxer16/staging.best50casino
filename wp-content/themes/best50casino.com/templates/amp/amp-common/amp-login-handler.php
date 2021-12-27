<?php
//$folder= '/dev.best50casino.com';
//$folder= '';
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-settings.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
if(!empty($_POST)) {

    $domain_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $siteurl = site_url();
    header("Content-type: application/json");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Origin: " . str_replace('.', '-', $siteurl) . ".cdn.ampproject.org");
    header("AMP-Access-Control-Allow-Source-Origin: " . $siteurl);
    header("Access-Control-Expose-Headers: AMP-Access-Control-Allow-Source-Origin");
    header("Access-Control-Expose-Headers: AMP-Redirect-To, AMP-Access-Control-Allow-Source-Origin");

    $userName = $_POST['UserName'];
    $password = $_POST['inputPassword'];

    $creds = array(
        'user_login' => $userName,
        'user_password' => $password,
        'remember' => true
    );

    $userData = wp_signon($creds, is_ssl());

    $url = home_url();

    if (is_wp_error($userData)) {
        $error_string = $userData->get_error_message();
        echo json_encode(['output_message' => $error_string]);
    } else {
        $location = $_SERVER['HTTP_REFERER']."&logged_in=true";
        header("AMP-Redirect-To: ".$location);
        die();
    }
}
