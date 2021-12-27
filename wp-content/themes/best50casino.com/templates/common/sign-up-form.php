<?php
$casinoID ='';

if (is_singular( 'kss_casino' )) {
    $casinoID = $post->ID;
}else{
    $casinoID = get_post_meta($post->ID, 'bonus_custom_meta_bookie_offer', true);
}
//     $casinoID = get_post_meta($post->ID, 'bonus_custom_meta_bookie_offer', true);
//    $userID = get_current_user_id();
//    $name = get_user_meta( $userID, 'user_nicename' ,true );
echo reviewForm($casinoID);