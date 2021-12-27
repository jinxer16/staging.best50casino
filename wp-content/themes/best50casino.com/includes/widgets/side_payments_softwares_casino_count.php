<?php
/*
Plugin Name: Casino Custom Menu
Version: 1.0
Plugin URI: http://weblom.gr
Description: This plugin reads the post_id and posts a list of the prons and cons of the casino. Data come from the custom meta boxes
Author: Panagiotis Giannakouras
Author URI: http://weblom.gr
*/

// Block direct requests
if ( !defined('ABSPATH') )
    die('-1');

add_action( 'widgets_init', function(){
    register_widget( 'kss_casino_custom_menu' );
});

/**
 * Adds My_Widget widget.
 */
class kss_casino_custom_menu extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'kss_casino_custom_menu', // Base ID
            __('Casino Side count by Menu items', 'text_domain'), // Name
            array('classname' => 'pay-softw', 'description' => __( 'Casino Custom Menu!', 'text_domain' ),) // Args
        );
    }
    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        global $post;

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Side Casino Count' );

        if ( array_key_exists('before_widget', $args) ) echo $args['before_widget'];?>
            <span class="star"><?=$title;?></span>
       			<ul class="">
        <?php if( 10 == $instance['nav_menu']){ ?>
            <?php
            $i=0;
            foreach (wp_get_nav_menu_items( $instance['nav_menu'] ) as $menu){
                $post_id = $menu->object_id;
                $post_name =get_the_title($post_id);
                ?>
                <li class="d-flex flex-wrap w-100 pl-5p pt-0p pb-5p pr10p">
                    <a class="d-flex flex-wrap w-100" href="<?php echo $menu->url; ?>">
                        <figure class="w-20 ml-10p align-self-center aligncenter mt-0 mb-0 mr-0">
                            <?php if (get_post_meta($post_id, 'casino_custom_meta_sidebar_icon', true)){
                                ?>
                                <img class="img-fluid d-block m-auto" src="<?php echo get_post_meta($post_id, 'casino_custom_meta_sidebar_icon', true);?>" loading="lazy" alt="<?php echo $post_name?> ">
                            <?php } ?>
                        </figure>
                        <span class="nmr_casino d-flex w-70 pl-20p align-self-center">
						<?php
                        echo get_nmr_casinos('software', $post_id);?>  <span class="font-weight-bold text-14 pl-5p"  style="color: #cacbce;">Casinos</span>
                            <!--a href="<?php // echo $menu->url; ?>"><?php // echo $menu->title ?></a-->
						</span>
                    </a>
                </li>
            <?php
                if (++$i == 10) break;
            }
            ?>
            </ul>

            <ul>
            <a class="catholic_link" href="<?php echo get_site_url(); ?>/casino-software/">All Providers</a>
        <?php	}elseif( 34 == $instance['nav_menu'] ){ ?>
            <?php
            $n=0;
            foreach (wp_get_nav_menu_items( $instance['nav_menu'] ) as $menu){
                $post_id = $menu->object_id;
                $post_name =get_the_title($post_id);
                ?>
                <li class="d-flex flex-wrap w-100 pl-5p pt-0p pb-5p pr10p">
                    <a class="d-flex flex-wrap w-100" href="<?php echo $menu->url; ?>">
                        <figure class="w-20 ml-10p align-self-center aligncenter mt-0 mb-0 mr-0">
                            <?php
                            if (get_post_meta($post_id, 'casino_custom_meta_sidebar_icon', true)){
                                ?>
                                <img class="img-fluid d-block m-auto" src="<?php echo get_post_meta($post_id, 'casino_custom_meta_sidebar_icon', true);?>" loading="lazy" alt="<?php echo $post_name?> ">
                            <?php }else{ ?>
                                <a href="<?php echo $menu->url; ?>"><img src="https://bestcasino.gr/wp-content/uploads/2017/04/λογο.png" loading="lazy" alt="" ></a>
                            <?php }	?>
                        </figure>
                        <span class="nmr_casino d-flex w-70 pl-20p align-self-center">
						<?php

                        echo get_nmr_casinos('payments',$post_id);?> <span class="font-weight-bold text-14 pl-5p"  style="color: #cacbce;">Casinos</span>
                            <!--a href="<?php // echo $menu->url; ?>"><?php // echo $menu->title ?></a-->
						</span></a>
                </li>
            <?php
                if (++$n == 10) break;
             }
            ?>

            </ul>

            <a class="catholic_link" href="<?php echo get_site_url(); ?>/payment-methods/">All Payments</a>
        <?php	}elseif( 46 == $instance['nav_menu'] ){?>
            <?php

            foreach (wp_get_nav_menu_items( $instance['nav_menu'] ) as $menu){?>
                <li class="li-flex li-countries d-flex align-self-center flex-wrap"><a href="<?php echo $menu->url; ?>">
                        <figure class="countries w-15 align-self-center align-middle m-auto">
                            <?php if (get_post_meta($menu->object_id, 'countries_custom_meta_icon', true)){
                                $imge_link = get_post_meta($menu->object_id, 'countries_custom_meta_icon', true);
                                $countryPostName = get_post_meta($menu->object_id, 'countries_custom_meta_sd_txt', true);
                                ?>
                                <img class="img-fluid align-self-center align-middle rounded-circle " style="width: 30px; height: 30px;" src="<?=$imge_link?>" loading="lazy" alt="<?php echo $countryPostName?>">
                            <?php }else{ ?>
                                <a href="<?php echo $menu->url; ?>"><img src="https://bestcasino.gr/wp-content/uploads/2017/04/λογο.png" alt="" ></a>
                            <?php }	?>
                        </figure>
                        <span class="nmr_casino w-85 countriez align-self-center d-flex float-left pl-10p justify-content-start align-middle align-self-center"><?php echo $countryPostName; ?>
                            <?php
                            $post_name = get_the_title($menu->object_id);
                            //echo get_nmr_casinos('countries',$post_name);?>
						<!--a href="<?php // echo $menu->url; ?>"><?php // echo $menu->title ?></a-->
						</span></a>
                </li>
            <?php
                }
            ?>
            </ul>
            <!--a class="catholic_link" href="<?php// echo get_site_url(); ?>/payments/">Full Casino List</a-->
            <?php
        } ?>



        <?php
        if ( array_key_exists('after_widget', $args) ) echo $args['after_widget'];
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['nav_menu'] = $new_instance['nav_menu'];
        $instance['link'] = $new_instance['link'];

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['kss_casino_custom_menu']) )
            delete_option('kss_casino_custom_menu');
        return $instance;
    }

    public function flush_widget_cache()
    {
        wp_cache_delete('kss_casino_custom_menu', 'widget');
    }
    public function mfc_assets()
    {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
//        wp_enqueue_script('upload', get_template_directory_uri( ) . '/assets/js/admin_scripts.min.js'); ;
        wp_enqueue_style('thickbox');
    }

    public function form( $instance ) {
        global $defaults;
        $array_def=[];
        $defaults = $array_def;
        $title = isset($instance['title'])? $instance['title'] : false;
        $cat_id = isset( $instance['nav_menu'] ) ? ( $instance['nav_menu'] ) : 1;
        // Get menus
        $menus = wp_get_nav_menus();
        $array_def = array('title' =>'', 'nav_menu' => '', 'link' => '');
        $instance = wp_parse_args( ( array ) $instance, $defaults ); ?>
        <div>
            <table style="border-bottom:2px solid grey;">
                <tr>
                    <td>
                        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><strong><?php _e( 'Title:' ) ?></strong></label>
                        <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>"/>
                    </td>
                    <td>
                        <label for="<?php echo $this->get_field_id( 'nav_menu' ); ?>"><?php _e( 'Select Menu:' ); ?></label>

                        <select id="<?php echo $this->get_field_id( 'nav_menu' ); ?>" name="<?php echo $this->get_field_name( 'nav_menu' ); ?>">
                            <option value="0"><?php _e( '&mdash; Select &mdash;' ); ?></option>
                            <?php foreach ( $menus as $menu ) : ?>
                                <option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $cat_id, $menu->term_id ); ?>>
                                    <?php echo esc_html( $menu->name ); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
            </table>
        </div>

    <?php }

}
?>