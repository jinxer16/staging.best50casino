<?php

class side_countries extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'widget_side_countries',
            _x( 'Side Countries', 'Side Countries' ),
            [ 'description' => __( 'Display countries on sidebar.' ) ]
        );
        $this->alt_option_name = 'widget_side_category';

        add_action( 'save_post', [$this, 'flush_widget_cache'] );
        add_action( 'deleted_post', [$this, 'flush_widget_cache'] );
        add_action( 'switch_theme', [$this, 'flush_widget_cache'] );
        add_action( 'admin_enqueue_scripts', array( $this, 'mfc_assets' ) );
    }

    public function widget( $args, $instance )
    {
        ?>
        <?php
        $countries =  WordPressSettings::getCountryEnabledSettingsPosts();
        ?>
        <span class="star">Best Casinos by Country</span>
        <ul class="mb-10p">
            <?php
            foreach ($countries as $country=>$id){?>
                <li class="li-flex li-countries d-flex align-self-center flex-wrap"><a href="<?= get_the_permalink($id) ?>">
                        <figure class="countries w-15 align-self-center align-middle m-auto">
                            <?php if (get_post_meta($id, 'countries_custom_meta_icon', true)){
                                $imge_link = get_post_meta($id, 'countries_custom_meta_icon', true);
                                $countryPostName = get_post_meta($id, 'countries_custom_meta_sd_txt', true);
                                ?>
                                <img class="img-fluid align-self-center align-middle rounded-circle " style="width: 30px; height: 30px;" loading="lazy" src="<?=$imge_link?>" alt="<?php echo $countryPostName?>">
                            <?php }else{ ?>
                                <a href="<?php get_the_permalink($id); ?>"><img src="https://bestcasino.gr/wp-content/uploads/2017/04/λογο.png" alt="" ></a>
                            <?php }	?>
                        </figure>
                        <span class="nmr_casino w-85 countriez align-self-center d-flex float-left justify-content-start align-middle align-self-center pl-10p"><?php echo $countryPostName; ?></span></a>
                </li>
            <?php }?>
        </ul>
        <?php
    }

    public function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_side_countries']) )
            delete_option('widget_side_countries');

        return $instance;
    }

    public function flush_widget_cache()
    {
        wp_cache_delete('widget_side_countries', 'widget');
    }

    public function mfc_assets()
    {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
//        wp_enqueue_script('upload', get_template_directory_uri( ) . '/assets/js/admin_scripts.min.js'); ;
        wp_enqueue_style('thickbox');
    }
    public function form( $instance )
    {

    }

}

add_action( 'widgets_init', function ()
{
    register_widget( 'side_countries' );
});
