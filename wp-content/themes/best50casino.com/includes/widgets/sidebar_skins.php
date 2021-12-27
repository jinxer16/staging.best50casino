<?php
class side_geo_skins extends WP_Widget
{

    public function __construct()
    {
        parent::__construct(
            'widget_side_geo_skins',
            _x( 'Side Geo Skins', 'Side Geo Skins' ),
            [ 'description' => __( 'Display skins-banners of country on sidebar.' ) ]
        );
        $this->alt_option_name = 'widget_side_geo_skins';

        add_action( 'save_post', [$this, 'flush_widget_cache'] );
        add_action( 'deleted_post', [$this, 'flush_widget_cache'] );
        add_action( 'switch_theme', [$this, 'flush_widget_cache'] );
        add_action( 'admin_enqueue_scripts', array( $this, 'mfc_assets' ) );
    }

    public function widget( $args, $instance )
    {
        ?>
        <div class="side-banner-geo mb-10p mt-10p">
            <?php
            $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] :'';?>
            <?php if ( $title ) {
                echo $args['before_title'] . $title . $args['after_title'];
            }
            $left_place = isset( $instance['left_place'] ) ? $instance['left_place'] : false;
            $right_place = isset( $instance['right_place'] ) ? $instance['right_place'] : false;

            $geoAds= WordPressSettings::getGeoSkins();

            if ($left_place == 1){
                $geoAdsImp =$geoAds['lsidebar'];
            }else{
                $geoAdsImp =$geoAds['rsidebar'];
            }

             if ($geoAdsImp['img_on'] == 1){?>
                    <a href="<?=$geoAdsImp['aff_url'];?>">
                        <img src="<?=$geoAdsImp['image']?>" class="img-fluid">
                    </a>
                    <?php
             }else{
                   echo $geoAdsImp['script'];
              }?>
        </div>
        <?php
    }

    public function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['left_place'] = isset( $new_instance['left_place'] ) ? (bool) $new_instance['left_place'] : false;
        $instance['right_place'] = isset( $new_instance['right_place'] ) ? (bool) $new_instance['right_place'] : false;

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_side_geo_skins']) )
            delete_option('widget_side_geo_skins');

        return $instance;
    }

    public function flush_widget_cache()
    {
        wp_cache_delete('widget_side_geo_skins', 'widget');
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
        $title = isset($instance['title'])? $instance['title'] : false;
        $left = isset( $instance['left_place'] ) ? (bool) $instance['left_place'] : false;
        $right = isset( $instance['right_place'] ) ? (bool) $instance['right_place'] : false;

        ?>
        <table class="mb-2">
            <tr class="mb-1">
                <td>
                    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><strong><?php _e( 'Title:' ) ?></strong></label>
                    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>"/>
                </td>
            </tr>
            <tr class="mb-1">
                <td>
                    <label for="<?php echo $this->get_field_id( 'left_place' ); ?>"><?php _e( 'Display left banner?' ); ?></label>
                    <input class="checkbox" type="checkbox"<?php checked( $left ); ?> id="<?php echo $this->get_field_id( 'left_place' ); ?>" name="<?php echo $this->get_field_name( 'left_place' ); ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="<?php echo $this->get_field_id( 'right_place' ); ?>"><?php _e( 'Display right banner?' ); ?></label>
                    <input class="checkbox" type="checkbox"<?php checked( $right ); ?> id="<?php echo $this->get_field_id( 'right_place' ); ?>" name="<?php echo $this->get_field_name( 'right_place' ); ?>" />
                </td>
            </tr>
        </table>
        <?php
    }
}

add_action( 'widgets_init', function ()
{
    register_widget( 'side_geo_skins' );
});
