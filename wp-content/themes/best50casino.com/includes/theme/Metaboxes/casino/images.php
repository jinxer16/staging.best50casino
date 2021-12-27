<?php global $wpalchemy_media_access;
$prefix = 'casino_custom_meta_';?>
<div class="d-flex flex-wrap my_meta_control">
<!--    <div class="w-100 d-flex flex-wrap">-->
<!--        --><?php //$mb->the_field($prefix.'sidebar_icon'); ?>
<!--        <h4 class="w-100 bg-primary m-0 border-bottom text-white p-2">Sidebar Image (70x50)</h4>-->
<!--        <p class="p-2">-->
<!--            <input type="text" id="--><?php //$mb->the_name(); ?><!--" name="--><?php //$mb->the_name(); ?><!--" value="--><?php //$mb->the_value(); ?><!--" class="mr-1"/>-->
<!--            <button data-dest-selector="#--><?php //$mb->the_name(); ?><!--" class="btn btn-info btn-sm btn-block add-logo-button">Add Image</button>-->
<!--            <img src="--><?php //$mb->the_value(); ?><!--" width="80" class="mr-1">-->
<!--        </p>-->
<!--    </div>-->
    <div class="w-100 d-flex flex-wrap">
        <?php $metabox->the_field($prefix.'trans_logo'); ?>
        <h4 class="w-100 bg-primary m-0 border-bottom text-white p-2">Transparent Logo (290x130)</h4>
        <p class="p-2">
            <input type="text" id="<?php $metabox->the_name(); ?>" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" class="mr-1"/>
            <button data-dest-selector="#<?php $metabox->the_name(); ?>" class="btn btn-info btn-sm btn-block add-logo-button">Add Image</button>
            <img src="<?php $metabox->the_value(); ?>" width="80" class="mr-1">
        </p>
    </div>

    <div class="w-100 d-flex flex-wrap">
        <?php $metabox->the_field($prefix.'rat_bg'); ?>
        <h4 class="w-100 bg-primary m-0 border-bottom text-white p-2">Ratings Background (400x400)</h4>
        <p class="p-2">
            <input type="text" id="<?php $metabox->the_name(); ?>" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" class="mr-1"/>
            <button data-dest-selector="#<?php $metabox->the_name(); ?>" class="btn btn-info btn-sm btn-block add-logo-button">Add Image</button>
            <img src="<?php $metabox->the_value(); ?>" width="80" class="mr-1">
        </p>
    </div>

    <div class="w-100 d-flex flex-wrap">
        <?php $metabox->the_field($prefix.'mbapp_bg'); ?>
        <h4 class="w-100 bg-primary m-0 border-bottom text-white p-2">Mobile App Images (400x350)</h4>
        <p class="p-2">
            <input type="text" id="<?php $metabox->the_name(); ?>" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" class="mr-1"/>
            <button data-dest-selector="#<?php $metabox->the_name(); ?>" class="btn btn-info btn-sm btn-block add-logo-button">Add Image</button>
            <img src="<?php $metabox->the_value(); ?>" width="80" class="mr-1">
        </p>
    </div>


    <div class="w-100 d-flex flex-wrap">
        <?php $metabox->the_field($prefix.'head_img'); ?>
        <h4 class="w-100 bg-primary m-0 border-bottom text-white p-2">Slider Front Images (Background)</h4>
        <p class="p-2">
            <input type="text" id="<?php $metabox->the_name(); ?>" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" class="mr-1"/>
            <button data-dest-selector="#<?php $metabox->the_name(); ?>" class="btn btn-info btn-sm btn-block add-logo-button">Add Image</button>
            <img src="<?php $metabox->the_value(); ?>" width="80" class="mr-1">
        </p>
    </div>

    <div class="col-12 p-0">
        <h4 class="w-100 bg-primary m-0 border-bottom text-white p-2">Comma Separated pros for Mobile App</h4>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'mbapp_ticks'); ?>
            <textarea class="w-100" type="text" rows="5" name="<?php $metabox->the_name($prefix.'mbapp_ticks'); ?>" value="" placeholder=pro-1,pro-2..."><?php $metabox->the_value($prefix.'mbapp_ticks'); ?></textarea>
        </p>
    </div>


    <?php $metabox->the_field($prefix.'bg_color'); ?>
    <h2 style=""><b>Bookmaker Color</b></h2>
    <input type="text"  class="bookcolor" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>

</div>
<script type="text/javascript">

    jQuery(document).ready(function($){

        $(function () {
            $('.bookcolor').wpColorPicker();
        });


        var dest_selector;
        var media_window = wp.media({
            title: 'Add Media',
            library: {type: 'image'},
            multiple: false,
            button: {text: 'Add'}
        });
        media_window.on('select', function() {
            var first = media_window.state().get('selection').first().toJSON();
            jQuery(dest_selector).val(first.url);
            dest_selector = null; // reset
        });
        function esc_selector( selector ) {
            return selector.replace( /(:|\.|\[|\]|,)/g, "\\$1" );
        }
        $('.my_meta_control').on('click', '.add-logo-button', function(e){
            e.preventDefault();
            dest_selector = esc_selector($(this).data('dest-selector')); // set
            media_window.open();
        });
    });
</script>