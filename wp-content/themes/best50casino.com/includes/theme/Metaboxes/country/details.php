<?php global $wpalchemy_media_access;
$prefix = 'countries_custom_meta_';

if (!get_option('oldsettingsSetForCountryMeta')) {
    $metaPartZ2 = [
        $prefix . 'icon', $prefix . 'sd_txt'];
    $endCasinoMetaZ2 = [
        '_countries_meta_fields' => $metaPartZ2,
    ];
    foreach (get_all_posts('bc_countries') as $postID) {
        foreach ($endCasinoMetaZ2 as $key => $value) {
            $ret = update_post_meta($postID, $key, $value);
        }
    }
    update_option('oldsettingsSetForCountryMeta', true);
}
?>
<div class="d-flex flex-wrap my_meta_control">
    <div class="col-6 p-3">
        <h4 class="mb-1 text-white bg-primary p-1">Country Icon</h4>
        <?php $mb->the_field($prefix . 'icon'); ?>
        <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>"
               value="<?php $mb->the_value(); ?>" class="mr-1 w-100"/>
        <button data-dest-selector="#<?php $mb->the_name(); ?>" class="btn btn-info btn-sm btn-block add-logo-button">
            Add Image
        </button>
        <img src="<?php $mb->the_value(); ?>" width="80" class="mr-1">
    </div>
    <div class="col-6 p-3">
        <h4 class="mb-1 text-white bg-primary p-1">Sidebar Widget Text</h4>
        <p class="mb-1">
            <?php $mb->the_field($prefix . 'sd_txt'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                   value="<?php $mb->the_value(); ?>"/>
        </p>
    </div>

</div>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        var dest_selector;
        var media_window = wp.media({
            title: 'Add Media',
            library: {type: 'image'},
            multiple: false,
            button: {text: 'Add'}
        });
        media_window.on('select', function () {
            var first = media_window.state().get('selection').first().toJSON();
            jQuery(dest_selector).val(first.url);
            dest_selector = null; // reset
        });

        function esc_selector(selector) {
            return selector.replace(/(:|\.|\[|\]|,)/g, "\\$1");
        }

        $('.my_meta_control').on('click', '.add-logo-button', function (e) {
            e.preventDefault();
            dest_selector = esc_selector($(this).data('dest-selector')); // set
            media_window.open();
        });
    });
</script>
