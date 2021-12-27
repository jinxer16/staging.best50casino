<?php
/*
Plugin Name: Casino Games
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
    register_widget( 'bh_casino_games' );
});

/**
 * Adds My_Widget widget.
 */
class bh_casino_games extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'bh_casino_games', // Base ID
            __('Casino Games', 'text_domain'), // Name
            array('classname' => 'more-games-1', 'description' => __( 'Casino Games', 'text_domain' ),) // Args
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
        $title = apply_filters( 'widget_title', $instance['title']='Casino Games' );
        // Get menus
        if ( array_key_exists('before_widget', $args) ) echo $args['before_widget'];
        if ( ! empty( $title ) )
            echo $args['before_title']. $title . $args['after_title'];
        ?>
        <ul class="bc_casino_games">
            <li id="free-casino"><a class="lazy-background" href="<?php echo get_site_url(); ?>/online-slots/">Slots</a></li>
            <li id="cards-casino"><a class="lazy-background" href="<?php echo get_site_url(); ?>/blackjack-casinos/">Blackjack</a></li>
            <li id="roulette-casino"><a class="lazy-background" href="<?php echo get_site_url(); ?>/online-roulette/">Roulette</a></li>
            <li id="bingo-casino"><a class="lazy-background" href="<?php echo get_site_url(); ?>/bingo/">Bingo</a></li>
            <li id="cards-casino"><a class="lazy-background" href="<?php echo get_site_url(); ?>/baccarat/">Baccarat</a></li>
            <li id="keno-casino"><a class="lazy-background" href="<?php echo get_site_url(); ?>/keno-casinos/">Keno</a></li>
            <li id="spades-casino"><a class="lazy-background" href="<?php echo get_site_url(); ?>/video-poker/">Video Poker</a></li>
            <li id="scratch-casino"><a class="lazy-background" href="<?php echo get_site_url(); ?>/scratch-cards/">Scratch Cards</a></li>
            <li id="crabs-casino"><a class="lazy-background" href="<?php echo get_site_url(); ?>/craps-casinos/">Craps</a></li>
        </ul>
        <a class="catholic_link" href="<?php echo get_site_url(); ?>/online-casino-games/">All Casino Games</a>
        <?php
        if ( array_key_exists('after_widget', $args) ) echo $args['after_widget'];
    }
    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {	}
    public function update( $new_instance, $old_instance ) {}
}
?>