<?php global $wpalchemy_media_access;
$prefix = 'slot_custom_meta_';
if (!get_option('oldsettingsSetForSlotMeta')) {
    $metaPartZ3 = [$prefix . 'slot_script',$prefix . 'thumb_of_game',$prefix . 'thumb_of_game_mob',
                   $prefix . 'thumb_of_game_mob_gen',$prefix . 'slot_software',$prefix . 'slot_main_casino',
                   $prefix . 'label',$prefix . 'slot_theme',$prefix . 'classic_video',
                   $prefix . 'jackpot_option',$prefix . '3d_option',$prefix . 'slot_theme_rel',$prefix . 'classic_video_rel',$prefix . 'jackpot_option_rel',
                   $prefix . '3d_option_rel'];

    $endCasinoMetaZ3 = [
        '_slot_info_meta_fields'=>$metaPartZ3,
    ];
    foreach (get_all_posts('kss_slots') as $postID) {
        foreach ($endCasinoMetaZ3 as $key=>$value){
            $ret = update_post_meta($postID,$key,$value);

        }
        $provider = get_post_meta($postID, $prefix . 'slot_software', true);
        if($provider && !is_numeric($provider)){
            $page = get_page_by_title($provider, OBJECT, 'kss_softwares');
            update_post_meta($postID,$prefix . 'slot_software' ,$page->ID);
        }
        $casino = get_post_meta($postID, $prefix . 'slot_main_casino', true);
        if($casino && !is_numeric($casino)){
            $page = get_page_by_title($casino, OBJECT, 'kss_casino');
            update_post_meta($postID,$prefix . 'slot_main_casino' ,$page->ID);
        }
    }
    update_option('oldsettingsSetForSlotMeta', true);
}
?>
<div class="d-flex flex-wrap my_meta_control">
    <div class="col-12 p-0 mb-2">
        <h4 class="w-100 bg-primary m-0 border-bottom text-white p-1">Slot Script</h4>
        <div class="">
            <?php $mb->the_field($prefix.'slot_script'); ?>
            <textarea class="w-100" type="text" rows="5" name="<?php $mb->the_name(); ?>" value=""><?php $mb->the_value(); ?></textarea>
        </div>
    </div>
    <div class="col-6 p-0">
        <h4 class="mb-1 text-white bg-primary p-1">Slot Thumbnail</h4>
        <i>Instead of script in case of broken script</i>
        <?php $mb->the_field($prefix.'thumb_of_game'); ?>
        <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="mr-1 w-100"/>
        <button data-dest-selector="#<?php $mb->the_name(); ?>" class="btn btn-info btn-sm btn-block add-logo-button">Add Image</button>
        <img src="<?php $mb->the_value(); ?>" width="80" class="mr-1">
    </div>
    <div class="col-6 p-3 mb-2 d-flex flex-column align-items-start justify-content-around">
        <div>
            <label class="mb-0">Use Thumb on mobile</label>
            <?php $mb->the_field($prefix.'thumb_of_game_mob'); ?>
            <input type="checkbox" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
        </div>
        <div>
            <label class="mb-0">Use Thumb Everywhere</label>
            <?php $mb->the_field($prefix.'thumb_of_game_mob_gen'); ?>
            <input type="checkbox" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
        </div>
    </div>
    <div class="col-12 p-0"><h4 class="mb-1 text-white bg-primary p-1">Info</h4></div>
    <div class="col-2 p-0">
        <h4 class="mb-1">Provider</h4>
        <p class="mb-0">
            <?php
//            $casinos = get_all_valid_casino($iso);
            $providers = get_all_posts('kss_softwares');
            $mb->the_field($prefix . 'slot_software');
            ?>
            <select name="<?php $mb->the_name(); ?>">
                <option value="">None...</option>
                <?php foreach ($providers as $providerID){ ?>
                    <option value="<?=$providerID?>" <?php $mb->the_select_state($providerID); ?>><?=get_the_title($providerID)?></option>
                <?php } ?>
            </select>
        </p>
    </div>
    <div class="col-2 p-0">
        <h4 class="mb-1">Casino</h4>
        <p class="mb-0">
            <?php
            //            $casinos = get_all_valid_casino($iso);
            $casinos = get_all_posts();
            $mb->the_field($prefix . 'slot_main_casino');
            ?>
            <select name="<?php $mb->the_name(); ?>">
                <option value="">None...</option>
                <?php foreach ($casinos as $casinoID){ ?>
                    <option value="<?=$casinoID?>" <?php $mb->the_select_state($casinoID); ?>><?=get_the_title($casinoID)?></option>
                <?php } ?>
            </select>
        </p>
    </div>
    <div class="col-4 p-0">
        <h4 class="mb-1">Label</h4>
        <div class="d-flex flex-wrap">
            <?php
            //            $casinos = get_all_valid_casino($iso);
            $labels = ['LEGEND' => 'LEGEND', 'BEST' => 'BEST', 'NEW' => 'NEW', 'Default' => 'Default'];
            $mb->the_field($prefix.'label', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI
            foreach ($labels as $label) { ?>
                <p class="mb-1 d-flex mr-1" style="width:20%">
                    <input type="checkbox" name="<?php $mb->the_name(); ?>"
                           value="<?= $label ?>" <?php $mb->the_checkbox_state($label); ?>/><label class="w-80"><?=$label?></label>
                </p>
        <?php } ?>
        </div>
    </div>
    <div class="col-1 p-0">
        <h4 class="mb-1">Jackpot</h4>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'jackpot_option'); ?>
            <input type="checkbox" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
        </p>
    </div>
    <div class="col-1 p-0">
        <h4 class="mb-1">3D</h4>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'3d_option'); ?>
            <input type="checkbox" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
        </p>
    </div>
    <div class="col-2 p-0">
        <h4 class="mb-1">Classic/Video</h4>
        <p class="mb-0">
            <?php $mb->the_field($prefix . 'classic_video'); ?>
            <select name="<?php $mb->the_name(); ?>">
                <option value="">None...</option>
                <option value="Classic" <?php $mb->the_select_state('Classic'); ?>>Classic</option>
                <option value="Video" <?php $mb->the_select_state('Video'); ?>>Video</option>
            </select>
        </p>
    </div>
    <div class="col-12 p-0">
        <h4 class="w-100 bg-primary m-0 border-bottom text-white p-1 mb-5p mt-5p">Theme</h4>
        <div class="d-flex flex-wrap">
            <?php
            //            $casinos = get_all_valid_casino($iso);
            $themes = WordPressSettings::getSlotThemes();
            $mb->the_field($prefix . 'slot_theme', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);
            foreach ($themes as $theme=>$themeName) { ?>
                <p class="mb-1 d-flex mr-1" style="width:12%">
                    <input type="checkbox" name="<?php $mb->the_name(); ?>"
                           value="<?= $theme ?>" <?php $mb->the_checkbox_state($theme); ?>/><label class="w-80"><?=$themeName?></label>
                </p>
            <?php } ?>
        </div>
    </div>
    <div class="col-12 mt-5p p-0">
        <h4 class="w-100 bg-primary m-0 border-bottom text-white p-1 mb-5p mt-5p">Related Slots (what kind of Slots to be shown under the content of the slot's page)</h4>
        <h4 class="w-100 m-0 border-bottom p-1 mb-5p mt-5p">Theme</h4>
        <div class="d-flex flex-wrap">
        <?php
        $mb->the_field($prefix . 'slot_theme_rel', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);
        foreach ($themes as $theme=>$themeName) { ?>
            <p class="mb-1 d-flex mr-1" style="width:12%">
                <input type="checkbox" name="<?php $mb->the_name(); ?>"
                       value="<?= $theme ?>" <?php $mb->the_checkbox_state($theme); ?>/><label class="w-80"><?=$themeName?></label>
            </p>
        <?php } ?>
        </div>
    </div>
    <div class="col-2 p-0">
        <h4 class="mb-1">Classic/Video</h4>
        <p class="mb-0">
            <?php $mb->the_field($prefix . 'classic_video_rel'); ?>
            <select name="<?php $mb->the_name(); ?>">
                <option value="">None...</option>
                <option value="Classic" <?php $mb->the_select_state('Classic'); ?>>Classic</option>
                <option value="Video" <?php $mb->the_select_state('Video'); ?>>Video</option>
            </select>
        </p>
    </div>
    <div class="col-1 p-0">
        <h4 class="mb-1">Jackpot</h4>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'jackpot_option_rel'); ?>
            <input type="checkbox" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
        </p>
    </div>
    <div class="col-1 p-0">
        <h4 class="mb-1">3D</h4>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'3d_option_rel'); ?>
            <input type="checkbox" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
        </p>
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