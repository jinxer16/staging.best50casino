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
    register_widget( 'tab_menu' );
});
class tab_menu extends WP_Widget {

    /**
     * Sets up a new Navigation Menu widget instance.
     *
     * @since 3.0.0
     */
    public function __construct() {
        $widget_ops = array(
            'classname' => 'super-tab-menu',
            'description' => __( 'Add a navigation menu to your sidebar.' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'tab_menu', __('Tabs Menu'), $widget_ops );
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
        // Get menu
        $nav_menu = ! empty( $instance['nav_menu_1'] ) ? wp_get_nav_menu_object( $instance['nav_menu_1'] ) : false;
        $nav_menu_1 = ! empty( $instance['nav_menu_2'] ) ? wp_get_nav_menu_object( $instance['nav_menu_2'] ) : false;
        $nav_menu_3 = ! empty( $instance['nav_menu_3'] ) ? wp_get_nav_menu_object( $instance['nav_menu_3'] ) : false;
        $nav_menu_4 = ! empty( $instance['nav_menu_4'] ) ? wp_get_nav_menu_object( $instance['nav_menu_4'] ) : false;

        if ( ! $nav_menu && !$nav_menu_1 && !$nav_menu_3 && !$nav_menu_4) {
            return;
        }

        $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $title_1 = ! empty( $instance['title_1'] ) ? $instance['title_1'] : '';
        $title_2 = ! empty( $instance['title_2'] ) ? $instance['title_2'] : '';
        $title_3 = ! empty( $instance['title_3'] ) ? $instance['title_3'] : '';
        $title_4 = ! empty( $instance['title_4'] ) ? $instance['title_4'] : '';

        $ico_1 = isset( $instance['image_1'] ) ? $instance['image_1'] : '';
        $ico_2 = isset( $instance['image_2'] ) ? $instance['image_2'] : '';
        $ico_3 = isset( $instance['image_3'] ) ? $instance['image_3'] : '';
        $ico_4 = isset( $instance['image_4'] ) ? $instance['image_4'] : '';
        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        echo $args['before_widget'];

        if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        ?>
        <?php
        $nav_menu_args = array(
            'fallback_cb' => '',
            'menu'        => $nav_menu
        );
        $nav_menu_args_1 = array(
            'fallback_cb' => '',
            'menu'        => $nav_menu_1
        );
        $nav_menu_args_3 = array(
            'fallback_cb' => '',
            'menu'        => $nav_menu_3
        );
        $nav_menu_args_4 = array(
            'fallback_cb' => '',
            'menu'        => $nav_menu_4
        );

        ?>
        <div class="clearfix">
            <?php if($nav_menu){ ?>
                <?php if($title_1){ ?>
                    <div class="tb-title d-flex align-items-center justify-content-center bg-grey p-1"><span class="icon <?php echo $ico_1;?>"></span><span class="tab-title"><?php echo $title_1; ?></span></div>
                <?php } ?>
                <div class="tab-pane active" id="">
                    <?php wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $args, $instance ) ); ?>
                </div>
            <?php } ?>
            <?php if($nav_menu_1){ ?>
                <?php if($title_2){ ?>
                    <div class="tb-title d-flex align-items-center justify-content-center bg-grey p-1"><span class="icon <?php echo $ico_2;?>"></span><span class="tab-title"><?php echo $title_2; ?></span></div>
                <?php } ?>
                <div class="tab-pane" id="">
                    <?php wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args_1, $nav_menu_1, $args, $instance ) ); ?>
                </div>
            <?php } ?>
            <?php if($nav_menu_3){ ?>
                <?php if($title_3){ ?>
                    <div class="tb-title d-flex align-items-center justify-content-center bg-grey p-1"><span class="icon <?php echo $ico_3;?>"></span><span class="tab-title"><?php echo $title_3; ?></span></div>
                <?php } ?>
                <div class="tab-pane" id="">
                    <?php wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args_3, $nav_menu_3, $args, $instance ) ); ?>
                </div>
            <?php } ?>
            <?php if($nav_menu_4){ ?>
                <?php if($title_4){ ?>
                    <div class="tb-title d-flex align-items-center justify-content-center bg-grey p-1"><span class="icon <?php echo $ico_4;?>"></span><span class="tab-title"><?php echo $title_4; ?></span></div>
                <?php } ?>
                <div class="tab-pane" id="">
                    <?php wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args_4, $nav_menu_4, $args, $instance ) ); ?>
                </div>
            <?php } ?>
            <a class="catholic_link" href="<?php echo get_site_url(); ?>/casino-guides/">All Casino Guides</a>
        </div>
        <?php


        echo $args['after_widget'];
    }

    /**
     * Handles updating settings for the current Navigation Menu widget instance.
     *
     * @since 3.0.0
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        if ( ! empty( $new_instance['title_1'] ) ) {
            $instance['title_1'] = sanitize_text_field( $new_instance['title_1'] );
        }
        if ( ! empty( $new_instance['title_2'] ) ) {
            $instance['title_2'] = sanitize_text_field( $new_instance['title_2'] );
        }
        if ( ! empty( $new_instance['title_3'] ) ) {
            $instance['title_3'] = sanitize_text_field( $new_instance['title_3'] );
        }
        if ( ! empty( $new_instance['title_4'] ) ) {
            $instance['title_4'] = sanitize_text_field( $new_instance['title_4'] );
        }
        if ( ! empty( $new_instance['title'] ) ) {
            $instance['title'] = sanitize_text_field( $new_instance['title'] );
        }
        if ( ! empty( $new_instance['nav_menu_1'] ) ) {
            $instance['nav_menu_1'] = (int) $new_instance['nav_menu_1'];
        }
        if ( ! empty( $new_instance['nav_menu_2'] ) ) {
            $instance['nav_menu_2'] = (int) $new_instance['nav_menu_2'];
        }
        if ( ! empty( $new_instance['nav_menu_3'] ) ) {
            $instance['nav_menu_3'] = (int) $new_instance['nav_menu_3'];
        }
        if ( ! empty( $new_instance['nav_menu_4'] ) ) {
            $instance['nav_menu_4'] = (int) $new_instance['nav_menu_4'];
        }
        if ( ! empty( $new_instance['image_1'] ) ) {
            $instance['image_1'] = sanitize_text_field( $new_instance['image_1'] );
        }
        if ( ! empty( $new_instance['image_2'] ) ) {
            $instance['image_2'] = sanitize_text_field( $new_instance['image_2'] );
        }
        if ( ! empty( $new_instance['image_3'] ) ) {
            $instance['image_3'] = sanitize_text_field( $new_instance['image_3'] );
        }
        if ( ! empty( $new_instance['image_4'] ) ) {
            $instance['image_4'] = sanitize_text_field( $new_instance['image_4'] );
        }
        return $instance;
    }

    /**
     * Outputs the settings form for the Navigation Menu widget.
     *
     * @since 3.0.0
     *
     * @param array $instance Current settings.
     * @global WP_Customize_Manager $wp_customize
     */
    public function form( $instance ) {
        global $wp_customize;
        $title = isset( $instance['title'] ) ? $instance['title'] : '';
        $title_1 = isset( $instance['title_1'] ) ? $instance['title_1'] : '';
        $title_2 = isset( $instance['title_2'] ) ? $instance['title_2'] : '';
        $title_3 = isset( $instance['title_3'] ) ? $instance['title_3'] : '';
        $title_4 = isset( $instance['title_4'] ) ? $instance['title_4'] : '';
        $nav_menu = isset( $instance['nav_menu_1'] ) ? $instance['nav_menu_1'] : '';
        $nav_menu_1 = isset( $instance['nav_menu_2'] ) ? $instance['nav_menu_2'] : '';
        $nav_menu_3 = isset( $instance['nav_menu_3'] ) ? $instance['nav_menu_3'] : '';
        $nav_menu_4 = isset( $instance['nav_menu_4'] ) ? $instance['nav_menu_4'] : '';
        $ico_1 = isset( $instance['image_1'] ) ? $instance['image_1'] : '';
        $ico_2 = isset( $instance['image_2'] ) ? $instance['image_2'] : '';
        $ico_3 = isset( $instance['image_3'] ) ? $instance['image_3'] : '';
        $ico_4 = isset( $instance['image_4'] ) ? $instance['image_4'] : '';

        // Get menus
        $menus = wp_get_nav_menus();

        // If no menus exists, direct the user to go and create some.
        ?>
        <p class="nav-menu-widget-no-menus-message" <?php if ( ! empty( $menus ) ) { echo ' style="display:none" '; } ?>>
            <?php
            if ( $wp_customize instanceof WP_Customize_Manager ) {
                $url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
            } else {
                $url = admin_url( 'nav-menus.php' );
            }
            ?>
            <?php echo sprintf( __( 'No menus have been created yet. <a href="%s">Create some</a>.' ), esc_attr( $url ) ); ?>
        </p>
        <div class="nav-menu-widget-form-controls" <?php if ( empty( $menus ) ) { echo ' style="display:none" '; } ?>>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ) ?></label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'title_1' ); ?>"><?php _e( 'Title Left:' ) ?></label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title_1' ); ?>" name="<?php echo $this->get_field_name( 'title_1' ); ?>" value="<?php echo esc_attr( $title_1 ); ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'nav_menu_1' ); ?>"><?php _e( 'Select Menu Left:' ); ?></label>
                <select id="<?php echo $this->get_field_id( 'nav_menu_1' ); ?>" name="<?php echo $this->get_field_name( 'nav_menu_1' ); ?>">
                    <option value="0"><?php _e( '&mdash; Select &mdash;' ); ?></option>
                    <?php foreach ( $menus as $menu ) : ?>
                        <option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu, $menu->term_id ); ?>>
                            <?php echo esc_html( $menu->name ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'title_2' ); ?>"><?php _e( 'Title Right:' ) ?></label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title_2' ); ?>" name="<?php echo $this->get_field_name( 'title_2' ); ?>" value="<?php echo esc_attr( $title_2 ); ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'nav_menu_2' ); ?>"><?php _e( 'Select Menu Right:' ); ?></label>
                <select id="<?php echo $this->get_field_id( 'nav_menu_2' ); ?>" name="<?php echo $this->get_field_name( 'nav_menu_2' ); ?>">
                    <option value="0"><?php _e( '&mdash; Select &mdash;' ); ?></option>
                    <?php foreach ( $menus as $menu ) : ?>
                        <option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu_1, $menu->term_id ); ?>>
                            <?php echo esc_html( $menu->name ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'title_3' ); ?>"><?php _e( 'Title Right:' ) ?></label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title_3' ); ?>" name="<?php echo $this->get_field_name( 'title_3' ); ?>" value="<?php echo esc_attr( $title_3 ); ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'nav_menu_3' ); ?>"><?php _e( 'Select Menu Right:' ); ?></label>
                <select id="<?php echo $this->get_field_id( 'nav_menu_3' ); ?>" name="<?php echo $this->get_field_name( 'nav_menu_3' ); ?>">
                    <option value="0"><?php _e( '&mdash; Select &mdash;' ); ?></option>
                    <?php foreach ( $menus as $menu ) : ?>
                        <option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu_3, $menu->term_id ); ?>>
                            <?php echo esc_html( $menu->name ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'title_4' ); ?>"><?php _e( 'Title Right:' ) ?></label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title_4' ); ?>" name="<?php echo $this->get_field_name( 'title_4' ); ?>" value="<?php echo esc_attr( $title_4 ); ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'nav_menu_4' ); ?>"><?php _e( 'Select Menu Right:' ); ?></label>
                <select id="<?php echo $this->get_field_id( 'nav_menu_4' ); ?>" name="<?php echo $this->get_field_name( 'nav_menu_4' ); ?>">
                    <option value="0"><?php _e( '&mdash; Select &mdash;' ); ?></option>
                    <?php foreach ( $menus as $menu ) : ?>
                        <option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu_4, $menu->term_id ); ?>>
                            <?php echo esc_html( $menu->name ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </p>
            <?php if ( $wp_customize instanceof WP_Customize_Manager ) : ?>
                <p class="edit-selected-nav-menu" style="<?php if ( ! $nav_menu ) { echo 'display: none;'; } ?>">
                    <button type="button" class="button"><?php _e( 'Edit Menu' ) ?></button>
                </p>
            <?php endif; ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'image_1' ); ?>"><?php _e( 'Icon 1:' ) ?></label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'image_1' ); ?>" name="<?php echo $this->get_field_name( 'image_1' ); ?>" value="<?php echo esc_attr( $ico_1 ); ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'image_2' ); ?>"><?php _e( 'Icon 2:' ) ?></label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'image_2' ); ?>" name="<?php echo $this->get_field_name( 'image_2' ); ?>" value="<?php echo esc_attr( $ico_2 ); ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'image_3' ); ?>"><?php _e( 'Icon 3:' ) ?></label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'image_3' ); ?>" name="<?php echo $this->get_field_name( 'image_3' ); ?>" value="<?php echo esc_attr( $ico_3 ); ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'image_4' ); ?>"><?php _e( 'Icon 4:' ) ?></label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'image_4' ); ?>" name="<?php echo $this->get_field_name( 'image_4' ); ?>" value="<?php echo esc_attr( $ico_4 ); ?>"/>
            </p>
        </div>
        <?php
    }
}
