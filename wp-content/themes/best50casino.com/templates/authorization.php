<?php
$folder= '/dev.best50casino.com';
$folder= '';
require_once($_SERVER['DOCUMENT_ROOT'] . $folder . '/wp-config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . $folder . '/wp-settings.php');
require_once($_SERVER['DOCUMENT_ROOT'] . $folder . '/wp-load.php');
$user =$_POST['username'];
$pass =$_POST['password'];
$returnURL = parse_url($_POST['returnurl']);
parse_str($returnURL['query']);
$creds = array(
    'user_login'    => $user,
    'user_password' => $pass,
    'remember'      => true
);
$userData = wp_authenticate( $user, $pass );
if ( is_wp_error( $userData ) ) {
    ob_start(); ?>
    <p>Invalid Usernamep</p>
    <a href="javascript:void(0);" class="btn btn-sm bg-gold-gradient-90 text-14  rounded-0" onclick="signUp(this,event,'start')">Sign Up</a>
    <a href="https://www.foxcasino.gr/wp-login.php?action=lostpassword" target="_blank" class="btn btn-sm bg-danger text-14 rounded-0">Remind Password</a>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    echo $output;
}else{
    header('AMP-Access-Control-Allow-Source-Origin: https://www.best50casino.com');
    header('Content-type: application/json');

    echo json_encode(
        array(
            'success'=>true,
            'access'=>true,
            'error'=>false
        )
    );
}
