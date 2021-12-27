<?php
//$folder= '/dev.best50casino.com';
//$folder= '';
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-settings.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
if (!empty($_POST)) {

    $domain_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $siteurl = site_url();
    header("Content-type: application/json");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Origin: " . str_replace('.', '-', $siteurl) . ".cdn.ampproject.org");
    header("AMP-Access-Control-Allow-Source-Origin: " . $siteurl);
    header("Access-Control-Expose-Headers: AMP-Access-Control-Allow-Source-Origin");
    header("Access-Control-Expose-Headers: AMP-Redirect-To, AMP-Access-Control-Allow-Source-Origin");


    $email = $_POST['emailForgot'];
    $user_data = get_user_by('email', $email);
    $key = get_password_reset_key($user_data);

    $login_url = add_query_arg(array(
        'key' => $key,
        'email' => rawurlencode($user_data->user_email)
    ), site_url('forgot'));

    $headers = array(
        'From: Best50casino <support@best50casino.com>',
        'Content-type: text/html; charset=utf-8'
    );

// in headers we set content-type to text/html, so feel free to use any HTML tags
    $message = 'Click on the link to reset your password <a href="' . $login_url . '">' . $login_url . '</a>';

// WordPress default function to send emails
    wp_mail($user_data->user_email, 'Reset password Best50casino', $message, $headers);

    $output_message = 'A link has been sent to your address';
    $output = ['output_message' => $output_message];
    echo json_encode( $output );

    die();
}
