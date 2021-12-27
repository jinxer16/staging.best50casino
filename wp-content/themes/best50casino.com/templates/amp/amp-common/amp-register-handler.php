<?php
//$folder= '/dev.best50casino.com';
//$folder= '';
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-settings.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
if(!empty($_POST)){

$domain_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$siteurl = site_url();
header("Content-type: application/json");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Origin: ". str_replace('.', '-',$siteurl) .".cdn.ampproject.org");
header("AMP-Access-Control-Allow-Source-Origin: " . $siteurl);
header("Access-Control-Expose-Headers: AMP-Access-Control-Allow-Source-Origin");
header("Access-Control-Expose-Headers: AMP-Redirect-To, AMP-Access-Control-Allow-Source-Origin");

$userName = $_POST['UserNameRe'];
$userEmail = $_POST['inputEmailRe'];
$userPass = $_POST['inputPasswordRe'];
$userPasstwo = $_POST['inputPasswordReseond'];
$checkterms = $_POST['checkterms'];
$newsletterConsent = $_POST['newsletterConsent'];
$visitorsISO = $_POST['visitorsISO'];
$userdata = array(
//        'ID'                    => 0,    //(int) User ID. If supplied, the user will be updated.
    'user_pass' => $userPass,   //(string) The plain-text user password.
    'user_login' => trim($userName),   //(string) The user's login username.
    'user_nicename' => $userName,   //(string) The URL-friendly user name.
//        'user_url'              => '',   //(string) The user URL.
    'user_email' => $userEmail,   //(string) The user email address.
    'display_name' => $userName,   //(string) The user's display name. Default is the user's username.
    'nickname' => $userName,   //(string) The user's nickname. Default is the user's username.
    //'custom_avatar'         => $default_avatar, // default avatar
    'first_name' => $userName,   //(string) The user's first name. For new users, will be used to build the first part of the user's display name if $display_name is not specified.
    'last_name' => $userName,   //(string) The user's last name. For new users, will be used to build the second part of the user's display name if $display_name is not specified.
    'role' => 'visitor',   //(string) User's role.
);

// ban .ru emails
$ban_ru = array('\.ru');
if (preg_match('/(' . implode('|', $ban_ru) . ')$/i', $userEmail)) {
    $output_message = 'This mail address is banned';
    $output = ['output_message' => $output_message];
    echo json_encode( $output );
    die();
}
if (username_exists($userName)) {
    $output_message = '<span style="color: red;">Username is already in use. Try a diffrent one</span>';
    $output = ['output_message' => $output_message];
    echo json_encode( $output );
    die();
}elseif( $userPass != $userPasstwo){
    $output_message = '<span style="color: red;">Passwords do not match</span>';
    $output = ['output_message' => $output_message];
    echo json_encode( $output );
    die();
}elseif(!isset($checkterms)){
    $output_message = '<span style="color: red;">You must accept our terms to register</span>';
    $output = ['output_message' => $output_message];
    echo json_encode( $output );
    die();
}elseif (email_exists($userEmail)){
    $output_message = '<span style="color: red;">This email address is already in use. Try a diffrent one.</span>';
    $output = ['output_message' => $output_message];
    echo json_encode( $output );
    die();
}else {
    $output_message = '<span class="text-success">An activation email has been sent to your address</span>';
}

$newUserID = wp_insert_user($userdata);
// auto sign in
//    $userData = wp_signon( $creds, is_ssl() );

$user_id = $newUserID;

$email_pref = ['email-slots','email-spins','email-offers','email-promo'];
update_user_meta($user_id, 'email_pref', $email_pref);
update_user_meta($user_id, 'visitorsISO', $visitorsISO);
update_user_meta($user_id, 'newsletterConsent', $newsletterConsent);
//    if ($userNickName != 'luis' && $user_id && !is_wp_error($user_id)) {
//        wp_new_user_notification($newUserID); // send notification to admin
//    }

if ($user_id && !is_wp_error($user_id)) {
    $code = sha1($user_id . time());
    $activation_link = add_query_arg(array('key' => $code, 'user' => $user_id), site_url('login-activation'));
    add_user_meta($user_id, 'has_to_be_activated', $code, true);
    $headers = array('Content-Type: text/html; charset=UTF-8');
    $subject = 'Welcome to Best50casino.com!';
    ob_start(); ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
          xmlns:o="urn:schemas-microsoft-com:office:office">
    <head>
        <title><?=$subject?></title>
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
        <meta name="viewport" content="initial-scale=1.0">
    </head>
    <body>
    <table style="max-width:600px;margin:auto;font-family:Roboto,Arial,Helvetica,sans-serif;width:100%;border:1px solid #ccc;" border="0" cellspacing="0" cellpadding="0" align="center">
        <tbody>
        <tr>
            <td>
                <table style="max-width:600px;width:100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                    <tr>
                        <td>
                            <table style="width:100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#153141">
                                <tbody>
                                <tr>
                                    <td align="center" style="padding:10px 0;">
                                        <img src="<?=site_url()?>/wp-content/themes/best50casino.com/assets/images/best50casino-logo.png"  alt="Best50casino.com Logo" width="368" height="60" border="0">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table style="max-width:600px;margin:auto;width:100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#f5f5f6">
                    <tbody>
                    <tr>
                        <td style="color:#383838;padding:20px 20px;font-size:15px;line-height:27px">
                            <div>
                                <p>Dear <strong><?=$userName?></strong></p>
                                <p>Thank you for your registration!</p>
                                <p>To confirm your email address, please the following link: </p>
                                <p><a href="<?=$activation_link?>" class=""
                                      style="color: #15c; text-decoration: underline;background:yellow;;"><?=$activation_link?></a></p>
                                <p>In case your key doesnt work, please contact us at
                                    <strong>support@best50casino.com</strong> using the same email address you filled in the registration form
                                    .</p>
                                <p>Please be assured that we remain entirely at your disposal at all times.</p>
                                <p>The team of <strong>Best50casino</strong></p>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table style="max-width:600px;width:100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#153141">
                    <tbody>
                    <tr>
                        <td width="100%" height="20" align="center" style="color:#fff;font-size:13px;padding:8px;">@ Copyright <?php echo date("Y"); ?> | <b style="color: #ff6539;">Best50casino.com</b></td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
    </body>
    </html>
    <?php $body = ob_get_clean();
    $mailSent = wp_mail($userEmail, $subject, $body, $headers);
        if($newsletterConsent) {
            $iso = $GLOBALS['visitorsISO'];

            $mailinglistID = get_correct_mailing_list($GLOBALS['visitorsISO']);

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://api.sendinblue.com/v3/contacts",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{\"attributes\":{\"COUNTRY\":\"$iso\"},\"listIds\":[$mailinglistID],\"updateEnabled\":false,\"email\":\"$userEmail\"}",
                CURLOPT_HTTPHEADER => [
                    "accept: application/json",
                    "api-key: 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",
                    "content-type: application/json"
                ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
        }
    }
    $output = ['output_message' => $output_message];
    echo json_encode( $output );
    die();
}
    ?>