<?php

class side_geo_articles extends WP_Widget
{

    public function __construct()
    {
        parent::__construct(
            'widget_side_articles_geo',
            _x( 'Side Geo Articles', 'Side Geo Articles' ),
            [ 'description' => __( 'Display an hot posts from country on sidebar.' ) ]
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
        <div class="side-articles-geo mb-10p">
       <?php
        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Most-Read Articles by Country' );
        $limit = isset( $instance['limit'] ) ? $instance['limit'] : false;
        
       echo $args['before_widget']; ?>
            <?php if ( $title ) {
        echo $args['before_title'] . $title . $args['after_title'];
        }
        $countryISO = $GLOBALS['countryISO'];
        $localIso =  $GLOBALS['visitorsISO'] ; //Αν η χωρα ειναι ενεργοποιημενη
        $feautred = WordPressSettings::getFeaturedFrontpage();

        $tabsArray = [
            array($feautred['article_1_id'],$feautred['article_1_image'],$feautred['article_1_subtitle']),
            array($feautred['article_2_id'],$feautred['article_2_image'],$feautred['article_2_subtitle']),
        ];
            $i = 0;
        foreach ($tabsArray as $row) {
            if ($limit == 1){
                if(++$i > 1) break;
            }
            ?>
             <style>
                    [class="overf-h z-0 bg-cover lazy-background bg-grow linear visible <?=$row[0];?>"] {
                        background: url('<?php echo $row[1]; ?>') no-repeat center center;
                        background-size: cover;
                    }
                </style>
            <?php
            ?>
            <div class="shadow mb-10p position-relative p-0 overflow-hidden br-5 bg-grow-parent">
                <div class="overf-h z-0 bg-cover lazy-background bg-grow linear visible <?=$row[0];?>" style="height:203px;">
                </div>
                <a href="<?= get_the_permalink($row[0]); ?>"
                   class="position-absolute top-0 w-100 h-100  d-flex flex-column  bg-shadow">
                    <span class="text-yellow font-weight-bold text-uppercase text-18 pl-10p pt-10p w-100"><?= get_the_title($row[0]); ?></span>
                    <span class="text-white pt-3p pl-10p  text-16 w-100"><?= $row[2] ?></span>
                </a>
            </div>
            <?php
        }
        ?>
</div>
<?php
    }

    public function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['limit'] = isset( $new_instance['limit'] ) ? (bool) $new_instance['limit'] : false;

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_side_articles_geo']) )
            delete_option('widget_side_articles_geo');

        return $instance;
    }

    public function flush_widget_cache()
    {
        wp_cache_delete('widget_side_articles_geo', 'widget');
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
        $limit = isset( $instance['limit'] ) ? (bool) $instance['limit'] : false;
        ?>
<table class="mb-2">
    <tr class="mb-1">
        <td>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><strong><?php _e( 'Title:' ) ?></strong></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>"/>
        </td>
    </tr>
    <tr class="mb-1 mt-2">
        <td>
        <input class="checkbox" type="checkbox"<?php checked( $limit ); ?> id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" />
        <label class="checkbox-inline" for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Limit to one article?' ); ?></label>
        </td>
    </tr>
</table>
        <?php
    }

}

add_action( 'widgets_init', function ()
{
    register_widget( 'side_geo_articles' );
});
