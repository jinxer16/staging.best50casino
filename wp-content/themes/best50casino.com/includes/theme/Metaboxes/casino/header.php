<?php global $wpalchemy_media_access;
$prefix = 'casino_custom_meta_';
$ratingsMeta = [
    $prefix.'custom_cta',
    $prefix.'custom_header',
    $prefix.'custom_promo_desc',
    $prefix.'comp_banner',
    $prefix.'comp_screen_1',
    $prefix.'comp_screen_2',
    $prefix.'comp_screen_3',
] ;
?>
<div class="d-flex flex-wrap my_meta_control">
<!--    <div class="col-4 d-flex flex-column mb-2">-->
<!--        <label class="w-100 bg-primary m-0 border-bottom text-white p-2">Custom Text Link</label>-->
<!--        <i>Custom Text Link for Casino Review Page</i>-->
<!--        --><?php //$mb->the_field($prefix.'custom_cta'); ?>
<!--        <input type="text" name="--><?php //$mb->the_name($prefix.'custom_cta'); ?><!--"-->
<!--               value="--><?php //$mb->the_value($prefix.'custom_cta'); ?><!--"/>-->
<!--    </div>-->
<!--    <div class="col-4 d-flex flex-column mb-2">-->
<!--        <label class="w-100 bg-primary m-0 border-bottom text-white p-2">Custom Header</label>-->
<!--        <i>For the Banner at Casino Review Page</i>-->
<!--        --><?php //$mb->the_field($prefix.'custom_header'); ?>
<!--        <input type="text" name="--><?php //$mb->the_name($prefix.'custom_header'); ?><!--"-->
<!--               value="--><?php //$mb->the_value($prefix.'custom_header'); ?><!--"/>-->
<!--    </div>-->
    <div class="col-6 d-flex flex-column mb-2">
        <?php $metabox->the_field($prefix.'comp_screen_1'); ?>
        <label class="w-100 bg-primary m-0 border-bottom text-white p-2">Casino Responsive Screenshot 1 (Carousel)</label>
        <p class="p-2">
            <input type="text" id="<?php $metabox->the_name(); ?>" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" class="w-100"/>
            <button data-dest-selector="#<?php $metabox->the_name(); ?>" class="btn btn-info btn-sm btn-block add-logo-button">Add Image</button>
            <img src="<?php $metabox->the_value(); ?>" width="80" class="mr-1">
        </p>
    </div>
<!--    <div class="col-4 d-flex flex-column mb-2">-->
<!--        --><?php //$metabox->the_field($prefix.'comp_screen_2'); ?>
<!--        <label class="w-100 bg-primary m-0 border-bottom text-white p-2">Casino Responsive Screenshot 2 (Carousel)</label>-->
<!--        <p class="p-2">-->
<!--            <input type="text" id="--><?php //$metabox->the_name(); ?><!--" name="--><?php //$metabox->the_name(); ?><!--" value="--><?php //$metabox->the_value(); ?><!--" class="w-100"/>-->
<!--            <button data-dest-selector="#--><?php //$metabox->the_name(); ?><!--" class="btn btn-info btn-sm btn-block add-logo-button">Add Image</button>-->
<!--            <img src="--><?php //$metabox->the_value(); ?><!--" width="80" class="mr-1">-->
<!--        </p>-->
<!--    </div>-->
<!--    <div class="col-4 d-flex flex-column mb-2">-->
<!--        --><?php //$metabox->the_field($prefix.'comp_screen_3'); ?>
<!--        <label class="w-100 bg-primary m-0 border-bottom text-white p-2">Casino Responsive Screenshot 3 (Carousel)</label>-->
<!--        <p class="p-2">-->
<!--            <input type="text" id="--><?php //$metabox->the_name(); ?><!--" name="--><?php //$metabox->the_name(); ?><!--" value="--><?php //$metabox->the_value(); ?><!--" class="w-100"/>-->
<!--            <button data-dest-selector="#--><?php //$metabox->the_name(); ?><!--" class="btn btn-info btn-sm btn-block add-logo-button">Add Image</button>-->
<!--            <img src="--><?php //$metabox->the_value(); ?><!--" width="80" class="mr-1">-->
<!--        </p>-->
<!--    </div>-->

    <div class="col-6 d-flex flex-column mb-2">
        <?php $metabox->the_field($prefix.'comp_mobi_screen_1'); ?>
        <label class="w-100 bg-primary m-0 border-bottom text-white p-2">Casino Responsive Mobile Screenshot 1 (Carousel)</label>
        <p class="p-2">
            <input type="text" id="<?php $metabox->the_name(); ?>" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" class="w-100"/>
            <button data-dest-selector="#<?php $metabox->the_name(); ?>" class="btn btn-info btn-sm btn-block add-logo-button">Add Image</button>
            <img src="<?php $metabox->the_value(); ?>" width="80" class="mr-1">
        </p>
    </div>
<!--    <div class="col-4 d-flex flex-column mb-2">-->
<!--        --><?php //$metabox->the_field($prefix.'comp_mobi_screen_2'); ?>
<!--        <label class="w-100 bg-primary m-0 border-bottom text-white p-2">Casino Responsive Mobile Screenshot 2 (Carousel)</label>-->
<!--        <p class="p-2">-->
<!--            <input type="text" id="--><?php //$metabox->the_name(); ?><!--" name="--><?php //$metabox->the_name(); ?><!--" value="--><?php //$metabox->the_value(); ?><!--" class="w-100"/>-->
<!--            <button data-dest-selector="#--><?php //$metabox->the_name(); ?><!--" class="btn btn-info btn-sm btn-block add-logo-button">Add Image</button>-->
<!--            <img src="--><?php //$metabox->the_value(); ?><!--" width="80" class="mr-1">-->
<!--        </p>-->
<!--    </div>-->
<!--    <div class="col-4 d-flex flex-column mb-2">-->
<!--        --><?php //$metabox->the_field($prefix.'comp_mobi_screen_3'); ?>
<!--        <label class="w-100 bg-primary m-0 border-bottom text-white p-2">Casino Responsive Mobile Screenshot 3 (Carousel)</label>-->
<!--        <p class="p-2">-->
<!--            <input type="text" id="--><?php //$metabox->the_name(); ?><!--" name="--><?php //$metabox->the_name(); ?><!--" value="--><?php //$metabox->the_value(); ?><!--" class="w-100"/>-->
<!--            <button data-dest-selector="#--><?php //$metabox->the_name(); ?><!--" class="btn btn-info btn-sm btn-block add-logo-button">Add Image</button>-->
<!--            <img src="--><?php //$metabox->the_value(); ?><!--" width="80" class="mr-1">-->
<!--        </p>-->
<!--    </div>-->

</div>
<script type="text/javascript">
    jQuery(document).ready(function($){
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
