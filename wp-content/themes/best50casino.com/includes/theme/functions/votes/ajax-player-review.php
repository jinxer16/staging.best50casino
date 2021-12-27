<?php
add_action('wp_ajax_addPlayerReview', 'addPlayerReview');
add_action('wp_ajax_nopriv_addPlayerReview', 'addPlayerReview');

function addPlayerReview(){
    $casinoID = $_POST['casinoID'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $ipaddress = $_SERVER['REMOTE_ADDR'];
    $postarr = [
        'post_title'=>get_the_title($casinoID).'-'.$name,
        'post_type'=>'player_review',
        'post_author'=>$name,
        'post_status'=>'pending',
        'post_content'=>$comment];
    $postID = wp_insert_post( $postarr,  false );
    update_post_meta($postID,'_review_details_fields',['review_rating','review_name','review_email','review_casino','review_ip','review_hidden','validat','fox_answer']);
    update_post_meta($postID,'review_rating',$rating);
    update_post_meta($postID,'review_name',$name);
    update_post_meta($postID,'review_casino',$casinoID);
    update_post_meta($postID,'review_email',$email);
    update_post_meta($postID,'review_ip',$ipaddress);
    echo get_the_title($postID);

    die;
}
add_action('wp_ajax_loginUser', 'loginUser');
add_action('wp_ajax_nopriv_loginUser', 'loginUser');

function loginUser(){
    $user =$_POST['userName'];
    $pass =$_POST['userPass'];
    $creds = array(
        'user_login'    => $user,
        'user_password' => $pass,
        'remember'      => true
    );
    $userData = wp_signon( $creds, is_ssl() );
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
        $userData->user_pass = null;
        echo reviewForm($userData->user_nicename,$userData->ID,$_POST['casinoID']);
    }
    die;
}
function reviewForm($casinoID){
    ?>
    <form class="d-flex flex-wrap w-100" action="">
        <div class="form-group col-12 col-xl-4 col-lg-4 col-md-4">
            <label for="nameReview">Name:</label>
            <input type="text" class="form-control" placeholder="Your name" name="nameReview" id="nameReview">
        </div>
        <div class="form-group col-12 col-xl-8 col-lg-8 col-md-8">
            <label for="emailReview">Email:</label>
            <input type="email" class="form-control" placeholder="Your Email" name="emailReview" id="emailReview">
        </div>
        <div class="form-group col-12">
            <label for="comment">Comment:</label>
            <textarea class="form-control" placeholder="Your Comment" rows="5" id="comment"></textarea>
        </div>

        <div class="p-7p col-12"><?= userVotes::vote($casinoID,'casino') ?></div>


        <button type="submit" class="btn btn-primary d-block m-10p" onclick="addPlayerReview(this,event,<?=$casinoID?>)" >Submit Review</button>
    </form>

    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

add_action('wp_ajax_signUpForm', 'signUpForm');
add_action('wp_ajax_nopriv_signUpForm', 'signUpForm');
function signUpForm(){
    ob_start();
    ?>
    <form onsubmit="signUp(this,event,'end')">
        <div class="form-group">
            <label for="nameInput">First Name*</label>
            <input type="text" class="form-control form-control-sm" id="nameInput" aria-describedby="nameHelp" placeholder="Fill your First Name" required="true">
        </div>
        <div class="form-group">
            <label for="surNameInput">Last Name*</label>
            <input type="text" class="form-control form-control-sm" id="surNameInput" aria-describedby="surNameHelp" placeholder="Fill your Last Name" required="true">
        </div>
        <div class="form-group">
            <label for="UserName">Username*</label>
            <input type="text" class="form-control form-control-sm" id="UserName" placeholder="Fill your username"required="true">
        </div>
        <div class="form-group">
            <label for="inputEmail">Email*</label>
            <input type="email" class="form-control form-control-sm" id="inputEmail" aria-describedby="emailHelp" placeholder="Συμπληρώστε το email σας" required="true">
            <small id="emailHelp" class="form-text text-muted">We will not share your information with anyone else..</small>
        </div>
        <div class="form-group">
            <label for="inputPassword">Password*</label>
            <input type="password" class="form-control form-control-sm" id="inputPassword" placeholder="Password" required="true">
        </div>
        <button type="submit" class="btn btn-primary signup-btn">Submit</button>
    </form>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    echo $output;
    die;
}
add_action('wp_ajax_signUpUser', 'signUpUser');
add_action('wp_ajax_nopriv_signUpUser', 'signUpUser');
function signUpUser(){
    $userName = $_POST['userName'];
    $userSurName = $_POST['userSurName'];
    $userNickName = $_POST['userNickName'];
    $userEmail = $_POST['userEmail'];
    $userPass = $_POST['userPass'];
    $casinoID = $_POST['casinoID'];
    $userdata = array(
//        'ID'                    => 0,    //(int) User ID. If supplied, the user will be updated.
        'user_pass'             => $userPass,   //(string) The plain-text user password.
        'user_login'            => $userNickName,   //(string) The user's login username.
        'user_nicename'         => $userNickName,   //(string) The URL-friendly user name.
//        'user_url'              => '',   //(string) The user URL.
        'user_email'            => $userEmail,   //(string) The user email address.
        'display_name'          => $userNickName,   //(string) The user's display name. Default is the user's username.
        'nickname'              => $userNickName,   //(string) The user's nickname. Default is the user's username.
        'first_name'            => $userName,   //(string) The user's first name. For new users, will be used to build the first part of the user's display name if $display_name is not specified.
        'last_name'             => $userSurName,   //(string) The user's last name. For new users, will be used to build the second part of the user's display name if $display_name is not specified.
//        'description'           => '',   //(string) The user's biographical description.
//        'rich_editing'          => '',   //(string|bool) Whether to enable the rich-editor for the user. False if not empty.
//        'syntax_highlighting'   => '',   //(string|bool) Whether to enable the rich code editor for the user. False if not empty.
//        'comment_shortcuts'     => '',   //(string|bool) Whether to enable comment moderation keyboard shortcuts for the user. Default false.
//        'admin_color'           => '',   //(string) Admin color scheme for the user. Default 'fresh'.
//        'use_ssl'               => '',   //(bool) Whether the user should always access the admin over https. Default false.
//        'user_registered'       => '',   //(string) Date the user registered. Format is 'Y-m-d H:i:s'.
//        'show_admin_bar_front'  => '',   //(string|bool) Whether to display the Admin Bar for the user on the site's front end. Default true.
        'role'                  => 'visitor',   //(string) User's role.
//        'locale'                => '',   //(string) User's locale. Default empty.

    );
    $newUserID = wp_insert_user( $userdata );
    $creds = array(
        'user_login'    => $userNickName,
        'user_password' => $userPass,
        'remember'      => true
    );
    $userData = wp_signon( $creds, is_ssl() );
    ob_start();
//    print_r($newUserID);
    echo reviewForm($userNickName,$newUserID,$casinoID);
    $output = ob_get_contents();
    ob_end_clean();
    echo $output;
    die;
}

function custom_comments( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    $comment_id = get_comment_ID();
    $comment_idget = get_comment($comment_id);
    $comment_post_id = $comment_idget->comment_post_ID ;

    $gender = get_comment_meta( $comment_id, 'gender', true );
    $genderimg = '';
    if ($gender == 'Male'){
        $genderimg = '<img class="d-inline-block pr-5p"  src="'.get_stylesheet_directory_uri().'/assets/images/figure-man-4.svg" style="height: 30px; width: 28px;" loading="lazy">';
    }elseif ($gender == 'Female'){
        $genderimg = '<img class="d-inline-block pr-5p"  src="'.get_stylesheet_directory_uri().'/assets/images/figure-woman-3.svg" style="height: 30px; width: 28px;" loading="lazy">';
    }else{
        $genderimg = '<img class="d-inline-block pr-5p"  src="'.get_stylesheet_directory_uri().'/assets/images/robot.svg" style="height: 20px; width: 22px;" loading="lazy">';
    }
    $country = get_comment_meta( $comment_id, 'country', true );
    $flag = '<img  loading="lazy" class="pb-2p" src="'.get_stylesheet_directory_uri().'/assets/flags/4x3/'.$country.'.svg" width="15px;" data-toggle="tooltip">';
    ?>

    <li <?php comment_class(); ?> class="list-typenone comment" style="padding-right: 7px;" id="comment-<?php comment_ID(); ?>">
    <div class="comment-wrap">
        <article <?php comment_class(); ?> class="comment">
            <div class="comment-body">
                <div class="author vcard position-relative">
    <span class="author-name font-weight-bold">
        <?=$genderimg;?><?php comment_author();?>
    </span>
                    <span class="position-absolute" style="right: 0; bottom: -7px;">
                        <i class="far fa-clock"></i>
        <small class="text-muted">
            <span class="date">
            <?php comment_date(); ?> /
                <?php comment_time(); ?>
            </span>
        </small> /
                <?=$flag;?>
                    </span>

                    <div class="w-100 d-flex flex-wrap">
                            <div class="w-100 w-sm-100">
                                <p class="p-3p w-100">
                                    <?php comment_text(); ?>
                                </p>
                            </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
    </li>


    <?php

        $args = array(
            'parent' => $comment_id,
            'hierarchical' => true,
        );
        $questions = get_comments($args);
        if ($questions){
            foreach ($questions as $childs){
        ?>
        <ol class="children">
        <li class="list-typenone comment even thread-even depth-2" id="comment-<?=$childs->comment_ID?>">
            <div class="comment-wrap best50com">
                <article  class="comment  odd alt thread-odd thread-alt depth-2">
                    <div class="comment-body">
                        <div class="author vcard position-relative">
                            <img src="<?=get_stylesheet_directory_uri()?>/assets/images/stamp_b.svg" class="mr-5p p-1p" width="35" height="35">
                          <span class="author-name font-weight-bold text-primary">Best50casino.com Team</span>
                            <span class="position-absolute" style="right: 0px; bottom: -7px;">
           <i class="far fa-clock"></i><small class="text-muted">
            <span class="date">
            <?php echo get_comment_date("d/m/y",$childs->comment_ID); ?> / <?php echo get_comment_time("H:i",$childs->comment_ID); ?>
            </span></small></time>
                </span>
                            <div class="w-100 d-flex flex-wrap">
                                <div class="w-100 w-sm-100">
                                    <p class="pt-3p pb-3p pl-5p pr-5p w-100">
                                        <?php echo $childs->comment_content?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </li>
                </ol>
      <?php
            }
    }
}

function CommentForm($postid){
    ?>
    <div class="col-12 text-white pl-15p pr-15p pt-7p pb-7p mb-3p" style="background: linear-gradient(90deg, #00777a 0%, #00777a 35%, #343434 100%);">
        <span class="font-weight-bold text-18 "><i class="fa fa-file-text mb-3p d-inline-block text-white"></i>  Leave us a comment</span>
    </div>
    <div class="w-100 w-sm-100 d-block mx-auto mb-sm-10p" style="background: linear-gradient(90deg, #d7dcdf 0%, #d7dcdf 35%, #d7dcdf 100%);">
    <form class="d-flex flex-wrap w-70 w-sm-100 text-white" style="" onsubmit="addCustomComment(this,event,<?=$postid?>)">
        <div class="form-group col-4 mt-10p">
            <input type="text" class="form-control" placeholder="Your name" name="nameComment" id="nameComment">
        </div>
        <div class="form-group col-8 mt-10p">
            <input type="email" class="form-control" placeholder="Your Email" name="emailComment" id="emailComment">
        </div>
        <div class="form-group col-12 d-flex flex-wrap justify-content-start">
            <span class="text-dark w-100 pl-10p text-primary font-weight-bold" id="chos">Choose Gender</span>
            <div class="input-group w-15 w-sm-33 p-5p">
                <div class="input-group-prepend ">
                    <div class="input-group-text w-100 d-flex flex-column">
                        <input type="radio" name="avatarradio"  value="Male" class="text-center d-block mx-auto" aria-label="Radio button for following text input">
                        <img src="<?php echo get_stylesheet_directory_uri() .'/assets/images/figure-man-4.svg'?>" style="height: 50px;" loading="lazy">
                        <span class="text-dark text-center pl-2p">Male</span>
                    </div>
                </div>
            </div>
            <div class="input-group w-sm-33 w-15 p-5p">
                <div class="input-group-prepend">
                    <div class="input-group-text w-100 d-flex flex-column">
                        <input type="radio" value="Female"  name="avatarradio" class="text-center d-block mx-auto" aria-label="Radio button for following text input">
                        <img src="<?php echo get_stylesheet_directory_uri() .'/assets/images/figure-woman-3.svg'?>" style="height: 50px;" loading="lazy">
                        <span class="text-dark text-center pl-2p">Female</span>
                    </div>
                </div>
            </div>
            <div class="input-group w-sm-33 w-15 p-5p">
                <div class="input-group-prepend">
                    <div class="input-group-text w-100 d-flex flex-column">
                        <input type="radio" value="other"  name="avatarradio" class="text-center d-block mx-auto" aria-label="Radio button for following text input">
                        <img class="d-block mx-auto" src="<?php echo get_stylesheet_directory_uri() .'/assets/images/robot.svg'?>" style="height: 50px; width: 40px;" loading="lazy">
                        <span class="text-dark text-center pl-2p">Other</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="form-group col-12">
            <textarea class="form-control" placeholder="Your Comment" rows="5" id="commentText"></textarea>
        </div>


        <div id="recaptcha" class="g-recaptcha  col-12" data-sitekey="6LeDDeoUAAAAABqGSHZboQs6FAug60g_k-waqo0D"></div>
        <input type="hidden" id="g-recaptcha-response">
        <span class="captcha-error w-100 text-sm-13 d-block text-danger text-18"></span>

        <script type="text/javascript">
            // Start of  recaptcha script
            function reCaptchaLazy () {

                var scriptsecond = document.createElement('script');
                scriptsecond.type = 'text/javascript';
                scriptsecond.async = true;
                scriptsecond.src = 'https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=en';
                document.getElementsByTagName('head')[0].appendChild(scriptsecond);

                var script = document.createElement('script');
                script.type = 'text/javascript';
                script.async = true;
                script.src = 'https://www.google.com/recaptcha/api.js?render=6LeDDeoUAAAAABqGSHZboQs6FAug60g_k-waqo0D&lang=en';
                document.getElementsByTagName('head')[0].appendChild(script);


            }
            document.addEventListener('readystatechange', event => {
                // When window loaded ( external resources are loaded too- `css`,`src`, etc...)
                if (event.target.readyState === "complete") {
                    setTimeout(
                        function () {
                            reCaptchaLazy();
                        }, 5000);
                }
            });
            // End of recaptcha script
            var onloadCallback = function() {
                grecaptcha.render('recaptcha', {
                    'sitekey' : '6LeDDeoUAAAAABqGSHZboQs6FAug60g_k-waqo0D'
                });
            };
        </script>

        <button type="submit" class="btn btn-primary d-block ml-10p mt-5p mb-5p sumbitComment font-weight-bold" data-agent="<?=$_SERVER['HTTP_USER_AGENT'];?>" data-country="<?=$GLOBALS['visitorsISO'];?>" data-userip="<?= $_SERVER['REMOTE_ADDR']; ?>">Submit Comment</button>
    </form>
    <span class="contact-success mt-5p text-success"></span>
    </div>
    <?php
    $total_comments =get_comments_number($postid);
    if ($total_comments >0 ){
    ?>
    <div class="w-100 text-dark d-flex flex-wrap justify-content-center mt-5p mb-15p" style="background: #03898f;">
    <ol class="comment-list mx-auto w-80 w-sm-100 mt-0 mb-10p">
        <div class="w-100">
            <div id="reply-title" class="text-white text-center mt-3p text-21 p-5p">
                <i class="fas d-inline-block fa-comments"></i> All comments <span class="comment-count"> (<?=$total_comments;?>)</span>
            </div>
        </div>

    <?php
    $args = array(
        'post_id' => $postid, // use post_id, not post_ID
        'order'=> 'ASC',
        'orderby'=> 'comment_date',
        'status' => 'approve',
        'parent'      => 0
    );
    $comments = get_comments( $args );
    wp_list_comments(array(
        'walker'            => null,
        'max_depth'         => '2',
        'style'             => 'ol',
        'callback'          => 'custom_comments',
        'end-callback'      => null,
        'type'              => 'all',
        'page'              => '',
        'per_page'          => '',
        'avatar_size'       => 30,
        'reverse_top_level' => true,
        'reverse_children'  => '',
        'format'            => 'html5', /* or html5 added in 3.6  */
        'short_ping'        => false, /* Added in 3.6 */
    ), $comments);

    ?>
    </ol>
    </div>
    <?php
    }

    $output = ob_get_contents();
    ob_end_clean();
    return $output;

}


add_action('wp_ajax_nopriv_add_custom_comment', 'add_custom_comment');
add_action('wp_ajax_add_custom_comment', 'add_custom_comment');
function add_custom_comment()
{
    $comment = $_POST['message'];
    $user_email = $_POST['userEmail'];
    $user_name = $_POST['userNickName'];
    $postID = $_POST['postID'];
    $agent = $_POST['agent'];
    $user_ip = $_POST['user_ip'];
    $userGender = $_POST['userGender'];
    $country = $_POST['country'];

    date_default_timezone_set('Europe/Athens');
    $date = date('Y-m-d G:i:s');

    $comment_type     = '';
    $comment_karma    = 0;
    $comment_approved = 0;
    global $wpdb;

    $table = $wpdb->prefix.'comments';
    $data = array('comment_post_ID'=>$postID,'comment_author' => $user_name,
        'comment_author_email' => $user_email,
        'comment_author_IP' => $user_ip,'comment_date' => $date,
        'comment_content' => $comment,'comment_karma' => $comment_karma,
        'comment_approved' => $comment_approved,'comment_agent' => $agent,
        'comment_type'=>$comment_type,'comment_parent' => '0','user_id' => '');

    $wpdb->insert($table,$data);
    $lastid = $wpdb->insert_id;

    update_comment_meta( $lastid, 'gender', $userGender );
    update_comment_meta( $lastid, 'country', $country );

    wp_update_comment_count( $postID );

    $subject = 'New Comment on Best50casino';
    $headers[] = 'Content-type: text/html; charset=UTF-8';
    $headers[]   = 'Reply-To: '.$user_name.' <'.$user_email.'>';
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
    <div style="max-width:600px;font-family:Roboto,Arial,Helvetica,sans-serif;width:100%;">
        <p>New Comment has been submitted to best50casino.com</p>
        <p>--</p>
        <p>This e-mail was sent from a contact form on Best50casino  (https://www.best50casino.com/)</p>
    </div>
    </body>
    </html>

    <?php $body = ob_get_clean();
    $mailSent = wp_mail('support@best50casino.com',"".$subject."", $body, $headers);
    die();
}