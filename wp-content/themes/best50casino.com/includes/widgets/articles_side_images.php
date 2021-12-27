<?php
/*
Plugin Name: Tab Menu
Version: 1.0
Plugin URI: http://weblom.gr
Description: Nomima Block
Author: Panagiotis Giannakouras
Author URI: http://weblom.gr
*/
// Block direct requests
if ( !defined('ABSPATH') )
    die('-1');
add_action( 'widgets_init', function(){
    register_widget( 'articles_images' );
});
class articles_images extends WP_Widget {

    /**
     * Sets up a new Navigation Menu widget instance.
     *
     * @since 3.0.0
     */
    public function __construct() {
        $widget_ops = array(
            'classname' => 'articles-images',
            'description' => __( 'Add Articles and Images' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'articles_images', __('Articles & Images'), $widget_ops );
    }

    /**
     * Outputs the content for the current Navigation Menu widget instance.
     *
     * @since 3.0.0
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Navigation Menu widget instance.
     */
    public function widget( $args, $instance ) {
        global $post;
        if($post->ID==10850)return;
        $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $article_1 = isset( $instance['article_1'] ) ? $instance['article_1'] : '';
        $article_2 = isset( $instance['article_2'] ) ? $instance['article_2'] : '';
        $article_sub1 = isset( $instance['article_sub1'] ) ? $instance['article_sub1'] : '';
        $article_sub2 = isset( $instance['article_sub2'] ) ? $instance['article_sub2'] : '';
        $ico_1 = isset( $instance['image_1'] ) ? $instance['image_1'] : '';
        $ico_2 = isset( $instance['image_2'] ) ? $instance['image_2'] : '';
        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        echo $args['before_widget'];

        if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        ?>
        <?php for ($i = 1; $i <= 2; $i++) {
            $var = 'ico_' . $i;
            $var_article = 'article_' . $i;
            $var_articleSub = 'article_sub' . $i;

            if (isset( $instance['image_'.$i] ) && isset( $instance['article_'.$i] )) { ?>
                <style>
                    [class="overf-hidden z-0 bg-cover lazy-background bg-grow linear <?=$$var_article;?> visible"] {
                        background: url('<?php echo $$var; ?>') no-repeat center center;
                        background-size: cover;
                    }
                </style>

                <div class="shadow mb-10p position-relative p-0 br-5 overflow-hidden mt-2p bg-grow-parent">
                    <div class="overf-hidden z-0 bg-cover lazy-background bg-grow linear <?=$$var_article;?>" style="height:203px;"></div>
                    <a href="<?=get_the_permalink($$var_article); ?>" class="position-absolute top-0 w-100 h-100  d-flex flex-column bg-shadow">
                        <span class="text-yellow font-weight-bold text-uppercase text-18 pl-10p pt-10p w-100"><?= get_the_title($$var_article); ?></span>
                        <span class="text-white pt-3p pl-10p  text-16 w-100"><?= $$var_articleSub ?></span>
                    </a>
                </div>
                <?php
            }
        }

        echo $args['after_widget'];
    }

    public function update( $new_instance, $old_instance ) {

        $instance = array();
        if ( ! empty( $new_instance['title'] ) ) {
            $instance['title'] = sanitize_text_field( $new_instance['title'] );
        }
        for ($i = 1; $i <= 2; $i++) {
            if ( ! empty( $new_instance['article_'.$i] ) ) {
                $instance['article_'.$i] = (int) $new_instance['article_'.$i];
            }
            if ( ! empty( $new_instance['article_sub'.$i] ) ) {
                $instance['article_sub'.$i] = sanitize_text_field($new_instance['article_sub'.$i]);
            }
            if ( ! empty( $new_instance['image_'.$i] ) ) {
                $instance['image_'.$i] = sanitize_text_field( $new_instance['image_'.$i] );
            }
        }
        return $instance;
    }


    public function flush_widget_cache()
    {
        wp_cache_delete('widget_side_image', 'widget');
    }
    public function mfc_assets()
    {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
//        wp_enqueue_script('upload', get_template_directory_uri( ) . '/assets/js/admin_scripts.min.js'); ;
        wp_enqueue_style('thickbox');
    }

    public function form( $instance ) {

        $title = isset( $instance['title'] ) ? $instance['title'] : '';
        $article_1 = isset( $instance['article_1'] ) ? $instance['article_1'] : '';
        $article_2 = isset( $instance['article_2'] ) ? $instance['article_2'] : '';
        $article_sub1 = isset( $instance['article_sub1'] ) ? $instance['article_sub1'] : '';
        $article_sub2 = isset( $instance['article_sub2'] ) ? $instance['article_sub2'] : '';
        $ico_1 = isset( $instance['image_1'] ) ? $instance['image_1'] : '';
        $ico_2 = isset( $instance['image_2'] ) ? $instance['image_2'] : '';

        $args = ['numberposts'=>-1,'fields' => 'ids', 'post_type'=>['page'],  'orderby'=>'title', 'order'=>'ASC', 'post_status' => array('publish')];
        $allPosts = get_posts($args);
        ?>
        <div class="nav-menu-widget-form-controls">
            <div class="form-group">
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ) ?></label>
                <input type="text" class="form-control widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>"/>
            </div>
            <?php for ($i=1;$i<=2;$i++){
                $var = 'ico_'.$i;
                $var_article = 'article_'.$i;
                $var_articleSub = 'article_sub'.$i;
                ?>
                <div class="form-group">
                    <label for="<?php echo $this->get_field_id( 'article_'.$i ); ?>"><?php _e( 'Article '.$i ); ?></label>
                    <select id="<?php echo $this->get_field_id( 'article_'.$i ); ?>" name="<?php echo $this->get_field_name( 'article_'.$i ); ?>" class="form-control">
                        <option value="0"><?php _e( '&mdash; Select &mdash;' ); ?></option>
                        <?php foreach ( $allPosts as $postID ) : ?>
                            <option value="<?php echo esc_attr( $postID ); ?>" <?php selected(  $$var_article, $postID ); ?>>
                                <?php echo get_the_title($postID); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="<?php echo $this->get_field_id( 'article_sub'.$i); ?>"><?php _e( 'Subtitle for Article: '.$i ) ?></label>
                    <input type="text" class="form-control widefat" id="<?php echo $this->get_field_id( 'article_sub'.$i ); ?>" name="<?php echo $this->get_field_name( 'article_sub'.$i ); ?>" value="<?php echo esc_attr($$var_articleSub); ?>"/>
                </div>
                <div class="form-group">
                    <label for="<?php echo $this->get_field_id( 'image_'.$i ); ?>"><?php _e( 'Icon '.$i.':' ) ?></label>
                    <div id="preview-<?=$i?>>"><?php if( ${"ico_$i"})echo '<img src="'. $$var.'" width="50">';?></div>
                    <input type="text" class="widefat form-control" id="<?php echo $this->get_field_id( 'image_'.$i ); ?>" name="<?php echo $this->get_field_name( 'image_'.$i ); ?>" value="<?php echo esc_attr(  $$var ); ?>"/>
                    <button data-dest-selector="#<?php echo $this->get_field_id( 'image_'.$i ); ?>" data-preview="#preview-"<?=$i?> class="btn btn-primary btn-sm add-logo-button">Add Icon</button>
                </div>
            <?php } ?>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function($){
                var dest_selector;
                var preview_selector;
                var media_window = wp.media({
                    title: 'Add Media',
                    library: {type: 'image'},
                    multiple: false,
                    button: {text: 'Add'}
                });
                media_window.on('select', function() {
                    var first = media_window.state().get('selection').first().toJSON();
                    jQuery(dest_selector).val(first.url);
                    jQuery('<img src="'+first.url+'" width="50">').appendTo(jQuery(preview_selector));
                    dest_selector = null; // reset
                    preview_selector = null; // reset
                    media_window.close();
                });
                function esc_selector( selector ) {
                    return selector.replace( /(:|\.|\[|\]|,)/g, "\\$1" );
                }
                $('.nav-menu-widget-form-controls').on('click', '.add-logo-button', function(e){
                    e.preventDefault();
                    dest_selector = esc_selector($(this).data('dest-selector')); // set
                    preview_selector = esc_selector($(this).data('preview')); // set
                    media_window.open();
                });
            });
        </script>
        <?php
    }
}