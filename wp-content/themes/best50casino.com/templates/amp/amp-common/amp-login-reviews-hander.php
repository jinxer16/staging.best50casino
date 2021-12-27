<?php
//$folder= '/dev.best50casino.com';
$folder= '';
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-settings.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
if(!empty($_POST)){

    $domain_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    header("Content-type: application/json");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Origin: ". str_replace('.', '-','https://www.best50casino.com') .".cdn.ampproject.org");
    header("AMP-Access-Control-Allow-Source-Origin: " . $domain_url);
    header("Access-Control-Expose-Headers: AMP-Access-Control-Allow-Source-Origin");
    header("Access-Control-Expose-Headers: AMP-Redirect-To, AMP-Access-Control-Allow-Source-Origin");

    $your_subject = filter_var( $_POST['comment_text'], FILTER_SANITIZE_STRING );
    $email =  $_POST['emailReview'];
    $name =  $_POST['nameReview'];
    $casinoId = intval($_POST['casinoID']);
    $rating =  ($_POST['rating']*2);
    $ipaddress = $_SERVER['REMOTE_ADDR'];

    if (!empty($your_subject) && !empty($name) && !empty($email) && !empty($casinoId)) {
        $postarr = [
            'post_title' => get_the_title($casinoId),
            'post_type' => 'player_review',
            'post_author' => $name,
            'post_status' => 'pending',
            'post_content' => $your_subject];
        $postID = wp_insert_post( $postarr,  false );
        update_post_meta($postID,'_review_details_fields',['review_rating','review_name','review_email','review_casino','review_ip','review_hidden','validat','fox_answer']);
        update_post_meta($postID,'review_rating',$rating);
        update_post_meta($postID,'review_casino',$casinoId);
        update_post_meta($postID,'review_name',$name);
        update_post_meta($postID,'review_email',$email);
        update_post_meta($postID,'review_ip',$ipaddress);
        $output_message = 'Thank you for leaving us a review.';
    }else{
        $output_message = 'Sorry, there was an error processing your message.';
    }
    $output = ['output_message' => $output_message];
    echo json_encode( $output );
    die();
}

