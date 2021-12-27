<?php
// login member
add_action('wp_ajax_nopriv_loginMember', 'loginMember');
add_action('wp_ajax_loginMember', 'loginMember');
function loginMember()
{
    $user = $_POST['userName'];
    $pass = $_POST['userPass'];
    //$rememberMe = $_POST['rememberMe'];

    $creds = array(
        'user_login' => $user,
        'user_password' => $pass,
        'remember' => true
        //'remember'      => $rememberMe
    );
    $userData = wp_signon($creds, is_ssl());
    $url = home_url();

    if (is_wp_error($userData)) {
        // get the error message
        $error_string = $userData->get_error_message();
        ob_start();
        // echo the actual error message
        //echo '<div id="message" class="error"><p>' . $error_string . '</p></div>';
        echo json_encode(['success' => false, 'msg' => $error_string]);
        //die();
        $output = ob_get_contents();
        ob_end_clean();
        echo $output;
    } else {
        echo json_encode(['success' => true, 'msg' => 'success']);
    }
    die();
}
// override core function - authenticate user
add_filter('wp_authenticate_user', 'foxcasino_auth_login', 10, 2);
function foxcasino_auth_login($user, $password)
{
    $username = sanitize_user($user->user_login);
    $password = trim($password);
    if ($user == null) {
        // Only needed if all authentication handlers fail to return anything.
        $user = new WP_Error('authentication_failed', __('<strong>Error</strong> <span class="text-warning">: Invalid username or incorrect password.</span>'));
    } elseif (get_user_meta($user->ID, 'has_to_be_activated', true) != false) {
        $user = new WP_Error('activation_failed', __('<strong>Error</strong> <span class="text-warning">: Your account isnt activated. Activate your account to continue.</span>'));
    }
    $ignore_codes = array('empty_username', 'empty_password');

    if (is_wp_error($user) && !in_array($user->get_error_code(), $ignore_codes)) {
        do_action('wp_login_failed', $username);
    }

    return $user;
}

add_action('wp_ajax_signUpUse', 'signUpUse');
add_action('wp_ajax_nopriv_signUpUse', 'signUpUse');
function signUpUse()
{
    $userName = $_POST['userName'];
    $userEmail = $_POST['userEmail'];
    $userPass = $_POST['userPass'];
    $userPasstwo = $_POST['userPasstwo'];
    $newsletterConsent = $_POST['newsletterConsent'];
    $visitorsISO = $_POST['visitorsISO'];
//    $registration_date = time();
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
        echo json_encode(['success' => false, 'msg' => 'This mail address is banned']);
        die();
    }
    if (username_exists($userName)) {
        echo json_encode(['success' => false, 'msg' => 'Username is already in use. Try a diffrent one']);
        die();
    }elseif( $userPass != $userPasstwo){
        echo json_encode(['success' => false, 'msg' => 'Passwords do not match']);
        die();
    }elseif (email_exists($userEmail)) {
        echo json_encode(['success' => false, 'msg' => 'This email address is already in use. Try a diffrent one.']);
        die();
    } else {
        echo json_encode(['success' => true, 'msg' => 'success']);
    }

    $newUserID = wp_insert_user($userdata);
    // auto sign in
//    $userData = wp_signon( $creds, is_ssl() );

    $user_id = $newUserID;

    $email_pref = ['email-slots','email-spins','email-offers','email-promo'];
    update_user_meta($user_id, 'email_pref', $email_pref);
    update_user_meta($user_id, 'visitorsISO', $visitorsISO);
    update_user_meta($user_id, 'newsletterConsent', $newsletterConsent);
//    update_user_meta($user_id, 'registration_date', $registration_date);

    if ($userName != 'luis' && $user_id && !is_wp_error($user_id)) {
        wp_new_user_notification($newUserID); // send notification to admin
    }

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
                                            <img src="<?=site_url()?>/wp-content/themes/best50casino.com/assets/images/best50casino-logo.png" alt="Best50casino.com Logo" width="368" height="60" border="0">
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
            if($newsletterConsent){
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
    die();
}


add_action('wp_ajax_nopriv_send_reset_link', 'send_reset_link');
add_action('wp_ajax_send_reset_link', 'send_reset_link');
function send_reset_link()
{
    $email = $_POST['email'];
    $user_data = get_user_by( 'email',$email);
    $key = get_password_reset_key( $user_data );

    $login_url = add_query_arg( array(
        'key' => $key,
        'email' => rawurlencode( $user_data->user_email )
    ), site_url('forgot') );

    $headers = array(
        'From: Best50casino <support@best50casino.com>',
        'Content-type: text/html; charset=utf-8'
    );

    // in headers we set content-type to text/html, so feel free to use any HTML tags
    $message = 'Click on the link to reset your password <a href="' . $login_url . '">' . $login_url . '</a>';

    // WordPress default function to send emails
    wp_mail( $user_data->user_email, 'Reset password Best50casino', $message, $headers );

    echo '<span class="text-success">A link has been sent to your address</span>';

    die();
}


add_action('wp_ajax_nopriv_update_password', 'update_password');
add_action('wp_ajax_update_password', 'update_password');
function update_password()
{
    $pasword1 = $_POST['passwordone'];
    $pasword2 = $_POST['passwordtwo'];
    $key = $_POST['keyfo'];
    $login = $_POST['emailFor'];
    $user_data = get_user_by( 'email',$login);
    $user = check_password_reset_key($key, $user_data->user_login);
    $msg = '';

    if ( is_wp_error( $user ) ) {
        if ( $user->get_error_code() === 'expired_key' )
            $msg.='<span class="text-danger">Your key has expired</span>';
        else
            $msg.='<span class="text-danger">Ivalid key</span>';
    }else{
        if ( !empty($pasword1) && !empty( $pasword2 ) ) {
            if ( $pasword1 === $pasword2 ) {
                reset_password( $user_data, $pasword1 );
                $msg.='<span class="text-success">Successful change of password</span>';
            }else{
                $msg.= '<span class="text-danger">Passwords do not match</span>';
            }
        }else{
            $msg.= '<span class="text-danger">Some input field is empty</span>';
        }
    }

    echo $msg;

    die();
}

add_action('wp_ajax_nopriv_logout_user', 'logout_user');
add_action('wp_ajax_logout_user', 'logout_user');
function logout_user()
{
    //check_ajax_referer( 'ajax-logout-nonce', 'ajaxsecurity' );
    wp_clear_auth_cookie();
    wp_logout();
    wp_redirect(home_url());
    wp_die();
}


add_action('wp_ajax_nopriv_SaveprofileSettings', 'SaveprofileSettings');
add_action('wp_ajax_SaveprofileSettings', 'SaveprofileSettings');
function SaveprofileSettings()
{
    $userEmail = $_POST['userEmail'];
    $user_data = get_user_by( 'email',$userEmail);
    $array = explode(',',$_POST['emailPref']);
    if (isset($userEmail)){
        update_user_meta($user_data->ID, 'email_pref', $array);
    }

die();
}

//add_action('admin_init', 'redirect_non_admin_users');


//// activate user
//add_action('template_redirect', 'activate_user');
//function activate_user()
//{
//    if ( is_page_template( 'page-login-activation.php' ) ) {
//        $user_id = filter_input(INPUT_GET, 'user', FILTER_VALIDATE_INT, array('options' => array('min_range' => 1)));
//        if ($user_id) {
//            // get user meta activation hash field
//            $code = get_user_meta($user_id, 'has_to_be_activated', true);
//            if ($code == filter_input(INPUT_GET, 'key')) {
//                delete_user_meta($user_id, 'has_to_be_activated');
//            }
//        }
//    }
//}