<?php
//$folder= '/dev.best50casino.com';
//$folder= '';
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-settings.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');

    $domain_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $siteurl = site_url();
    header("Content-type: application/json");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Origin: " . str_replace('.', '-', $siteurl) . ".cdn.ampproject.org");
    header("AMP-Access-Control-Allow-Source-Origin: " . $siteurl);
    header("Access-Control-Expose-Headers: AMP-Access-Control-Allow-Source-Origin");
    header("Access-Control-Expose-Headers: AMP-Redirect-To, AMP-Access-Control-Allow-Source-Origin");

    wp_clear_auth_cookie();
    wp_logout();
    $location = $_SERVER['HTTP_REFERER'];
    header("AMP-Redirect-To: ".$location);
    wp_die();



