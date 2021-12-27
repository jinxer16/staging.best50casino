<?php
/**
 * Created by PhpStorm.
 * User: Panos
 * Date: 25/6/2019
 * Time: 3:41 μμ
 */

global $wpalchemy_media_access;
//delete_option('LicenseDataArrange');
if(!get_option('LicenseDataArrange')){

$licenses = ['Malta' => __('Malta', 'bet-o-shark'),
    'Montenegro' => __('Montenegro', 'bet-o-shark'),
    'Gibraltar' => __('Gibraltar'),
    'UK' => __('UK', 'bet-o-shark'),
    'Isle of Man' => 'Isle of Man',
    'Costa Rica' => __('Costa Rica', 'bet-o-shark'),
    'Curacao' => __('Curacao', 'bet-o-shark'),
    'Tasmania' => __('Tasmania', 'bet-o-shark'),
    'Antigua ' => __('Antigua ', 'bet-o-shark'),
    'Panama' => __('Panama', 'bet-o-shark'),
    'Philippines (Cagayan)' => __('Philippines (Cagayan)', 'bet-o-shark'),
    'Austria' => __('Austria', 'bet-o-shark'),
    'Belize' => __('Belize', 'bet-o-shark'),
    'Kahnawake (Canada)' => __('Kahnawake (Canada)', 'bet-o-shark'),
    'Alderney' => 'Alderney',
    'Estonia' => __('Estonia', 'bet-o-shark'),
    'Sweden' => __('Swedish Gambling Authority'),
    'Denmark' => __('Denmark'),
    'Belgium' => __('Belgium'),
//    'Other' => 'Other'
];
    foreach ($licenses as $license) {
            $post = array(
                'post_content' => '',
                'post_name' => sanitize_title($license),
                'post_title' => ucfirst($license),
                'post_status' => 'draft',
                'post_type' => 'license',
                'post_excerpt' => ''
            );
            $post_ID = wp_insert_post($post);
            update_post_meta($post_ID, 'short_title', ucfirst($license));
            update_post_meta($post_ID, 'license_scope', 'global');
            update_post_meta($post_ID, '_license_details_fields', array('short_title','license_scope'));
    }
    update_option('LicenseDataArrange',true);
}

?>
<div class="my_meta_control metabox row">
    <div class="col-4">
        <label>Short Title</label>
        <p>
            <?php $metabox->the_field('short_title'); ?>
            <input type="text" name="<?php $metabox->the_name('short_title'); ?>" value="<?php $metabox->the_value('short_title'); ?>"/>
        </p>
    </div>
    <div class="col-4">
        <label>Posts Icon</label>
        <?php $metabox->the_field('icon'); ?>
        <p class="d-flex">
            <input type="text" id="<?php $metabox->the_name(); ?>" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" class="mr-1"/>
            <img src="<?php $metabox->the_value(); ?>" width="80" class="mr-1">
            <button data-dest-selector="#<?php $metabox->the_name(); ?>" class="btn btn-primary btn-sm add-logo-button">Add Icon</button>
        </p>
    </div>
    <div class="col-12">
        <?php $metabox->the_field('license_scope'); ?>
        <select name="<?php $metabox->the_name(); ?>">
            <option value="global" <?php $metabox->the_select_state("global"); ?>>Global</option>
            <option value="local" <?php $metabox->the_select_state("local"); ?>>Local</option>
        </select>
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