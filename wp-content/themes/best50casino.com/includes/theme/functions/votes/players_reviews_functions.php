<?php
add_action('save_post', 'update_player_review_rating_on_save', 111, 3);
function update_player_review_rating_on_save($post_id, $post, $update = "")
{
    if($post->post_type=='player_review'){
        $posts = get_posts(array('numberposts' => -1, 'fields' => 'ids', 'post_type' => 'player_review',
            'post_status' => array('publish'),
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => 'review_casino',
                    'value' => $post->review_casino,
                    'compare' => 'LIKE',
                ),
            )
        ));
        $playersReviewRatingSum = 0;
        $count = 0;
        foreach ($posts as $reviewrating) {
            if (get_post_meta($reviewrating, 'review_casino', true) == $post->review_casino) {
                $count++;
                $playersReviewRatingSum = $playersReviewRatingSum + get_post_meta($reviewrating, 'review_rating', true);
            }
        };
        if($count > 0 && $post->review_casino){
            $playersReviewRatingSum =$playersReviewRatingSum/$count;
            update_post_meta($post->review_casino,'user_rating_number',$playersReviewRatingSum);
            update_post_meta($post->review_casino,'user_rating_count',$count);
            $ret = 'Review for <b>'.get_the_title($post->review_casino).'</b> have been Updated. Total Reviews: <b>'.$count.'</b> with average score: <b>'.$playersReviewRatingSum.'</b>';
            add_option('my_notice_text', $ret);
        }
    }
}

add_action('admin_notices', 'my_admin_notices');
function my_admin_notices()
{
    // If a notice exists then echo it as a notice.
    if (get_option('my_notice_text')) {
        echo "<div class=\"notice update-nag is-dismissible\">" . get_option('my_notice_text') . "</div>";
        delete_option('my_notice_text');
    }
}

add_action(
    'admin_head-edit.php',
    'edit_player_review_change_title_in_list'
);
function edit_player_review_change_title_in_list()
{
    add_filter(
        'the_title',
        'player_review_construct_new_title',
        100,
        2
    );
}

function player_review_construct_new_title($title, $id)
{
    if (get_post_type($id) != 'player_review') {
        return $title;
    } else {
        $content = get_the_content($id);
        $title = wp_trim_words($content, 15);
        return $title;
    }
}
add_filter( 'manage_player_review_posts_columns', 'set_custom_edit_player_review_columns' );
add_action( 'manage_player_review_posts_custom_column' , 'custom_player_review_column', 10, 2 );
function set_custom_edit_player_review_columns($columns) {
    $columns['review_casino'] = __( 'Casino' );
    $columns['score'] = __( 'Score' );
    return $columns;
}
function custom_player_review_column( $column, $post_id ) {
    switch ( $column ) {
        case 'review_casino' :
            $ret = get_post_meta( $post_id , 'review_casino' , true ) ? get_the_title(get_post_meta( $post_id , 'review_casino' , true )) : '';
            echo '<b>'.$ret.'</b>';
            break;
        case 'score' :
            $ret = get_post_meta( $post_id , 'review_rating' , true ) ? get_post_meta( $post_id , 'review_rating' , true ) : 'No Score';
            echo '<b>'.$ret.'</b>';
            break;
    }
}
function getReviewsOfCasino($casinoID,$limit=3)
{
//    $providers = get_post_meta($casinoID,'software_id',true);
//    var_dump($providers);
    $args = [
        'post_type' => ['player_review'],
        'post_status' => ['publish'],
        'posts_per_page' => $limit,
        'fields' => 'ids',
        'suppress_filters' => true,
        'meta_query' => [
            [
                'key' => 'review_casino',
                'value' => $casinoID,
//                'compare' => 'LIKE',
            ],
        ],
    ];
    return get_posts($args);
}