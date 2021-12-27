<?php
add_action( 'add_meta_boxes_comment', 'comment_add_meta_box' );
function comment_add_meta_box()
{
    add_meta_box( 'my-comment-title', __( 'Commentors meta' ), 'comment_meta_box_info','comment', 'normal', 'high' );
}

function comment_meta_box_info( $comment )
{
    $title = get_comment_meta( $comment->comment_ID, 'gender', true );
    $country = get_comment_meta( $comment->comment_ID, 'country', true );
    ?>
    <p>
        <label for="gender"><?php _e( 'Commentors Gender' ); ?></label>
        <input type="text" name="gender" value="<?php echo esc_attr( $title ); ?>"  class="widefat" />
    </p>

    <p>
        <label for="country"><?php _e( 'Commentors Country' ); ?></label>
        <input type="text" name="country" value="<?php echo esc_attr( $country ); ?>"  class="widefat" />
    </p>
    <?php
}
add_action( 'edit_comment', 'comment_edit_function' );
$post_id = isset($_GET["c"]) ? $_GET["c"] : "";

function comment_edit_function( $post_id )
{
    if( isset( $_POST['gender'] ) )
        update_comment_meta( $post_id, 'gender', esc_attr( $_POST['gender'] ) );

    if( isset( $_POST['country'] ) )
        update_comment_meta( $post_id, 'country', esc_attr( $_POST['country'] ) );
}