<?php global $wpalchemy_media_access;
$prefix = 'software_custom_meta_';
if (!get_option('oldsettingsSetForProvMeta')) {
    $metaPartZ3 = [$prefix . 'rng',$prefix . 'casino_rating',$prefix . 'slot_rating',$prefix . 'livecasino',
        $prefix . 'soft_cat',$prefix . 'seo_title', $prefix . 'available_slots'];

    $endCasinoMetaZ3 = [
        '_software_info_meta_fields'=>$metaPartZ3,
    ];
    foreach (get_all_posts('kss_softwares') as $postID) {
        foreach ($endCasinoMetaZ3 as $key=>$value){
            $ret = update_post_meta($postID,$key,$value);
        }
    }
    update_option('oldsettingsSetForProvMeta', true);
}
?>
<div class="d-flex flex-wrap">
    <div class="col-3 p-0">
        <label class="mb-0">RNG</label>
        <?php $mb->the_field($prefix.'rng'); ?>
        <input type="checkbox" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
    </div>
    <div class="col-3 p-0">
        <label class="mb-0">Live Casino</label>
        <?php $mb->the_field($prefix.'livecasino'); ?>
        <input type="checkbox" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
    </div>
    <div class="col-3 p-1">
        <label class="mb-0">Provider's Rating</label>
        <?php $mb->the_field($prefix.'casino_rating'); ?>
        <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="mr-1 w-100"/>
    </div>
    <div class="col-3 p-1">
        <label class="mb-0">Provider's Slot Rating</label>
        <?php $mb->the_field($prefix.'slot_rating'); ?>
        <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="mr-1 w-100"/>
    </div>
    <div class="col-3 p-1"></div>
    <div class="col-3 p-1"></div>
    <div class="col-3 p-1">
        <label class="mb-0">SEO Title</label>
        <?php $mb->the_field($prefix.'seo_title'); ?>
        <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="mr-1 w-100"/>
    </div>
    <div class="col-3 p-1">
        <label class="mb-0">Number of Available Slots</label>
        <?php $mb->the_field($prefix.'available_slots'); ?>
        <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="mr-1 w-100"/>
    </div>
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