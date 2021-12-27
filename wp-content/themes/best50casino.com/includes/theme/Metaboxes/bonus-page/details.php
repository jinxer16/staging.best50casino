<?php global $wpalchemy_media_access;
$prefix = 'bonus_custom_meta_';

if (!get_option('oldsettingsSetForBonusPageMeta')) {

$metaPartZ = [
        $prefix . 'shortcode', $prefix . 'subtlt', $prefix . 'wb_text', $prefix . 'Tab_intro',
        $prefix . 'title_intro', $prefix . 'intro', $prefix . 'Tab_bonus_code', $prefix . 'title_bonus_code',
        $prefix . 'txt_bonus_code', $prefix . 'Tab_offers', $prefix . 'title_offers', $prefix . 'intro_offers',
        $prefix . 'faq_text', $prefix . 'screeshot', $prefix . 'bookie_offer', $prefix . 'bonus_offer',
        $prefix . 'title_guide', $prefix . 'txt_guide', $prefix . 'bookie_offer',

    ];
    $endCasinoMetaZ = [
        '_offer_text_fields' => $metaPartZ,
    ];
    foreach (get_all_posts('bc_bonus_page') as $postID) {
        foreach ($endCasinoMetaZ as $key => $value) {
            $ret = update_post_meta($postID, $key, $value);
        }
        $casino = get_post_meta($postID, $prefix . 'bookie_offer', true);
        if ($casino && !is_numeric($casino)) {
            $page = get_page_by_title($casino, OBJECT, 'kss_casino');
            update_post_meta($postID, $prefix . 'bookie_offer', $page->ID);
        }
        $bonus = get_post_meta($postID, $prefix . 'bonus_offer', true);
        if ($bonus && !is_numeric($bonus)) {
            $page = get_page_by_title($bonus, OBJECT, 'bc_bonus');
            update_post_meta($postID, $prefix . 'bonus_offer', $page->ID);
        }
    }
    update_option('oldsettingsSetForBonusPageMeta', true);
}

?>
<div class="d-flex flex-wrap my_meta_control">
<!--    <div class="col-6 p-3">-->
<!--        <h4 class="mb-1 text-white bg-primary p-1">Promotion Shortcode Area</h4>-->
<!--        <p class="mb-0">-->
<!--            --><?php //$mb->the_field($prefix.'shortcode'); ?>
<!--            <textarea class="w-100" type="text" rows="5" name="--><?php //$mb->the_name(); ?><!--" value="">--><?php //$mb->the_value(); ?><!--</textarea>-->
<!--        </p>-->
<!--    </div>-->
<!--    <div class="col-6 p-3">-->
<!--        <h4 class="mb-1 text-white bg-primary p-1">Offer Subtitle</h4>-->
<!--        <p class="mb-0">-->
<!--            --><?php //$mb->the_field($prefix.'subtlt'); ?>
<!--            <textarea class="w-100" type="text" rows="5" name="--><?php //$mb->the_name(); ?><!--" value="">--><?php //$mb->the_value(); ?><!--</textarea>-->
<!--        </p>-->
<!--    </div>-->
<!--    <div class="col-6 p-3">-->
<!--        <h4 class="mb-1 text-white bg-primary p-1">Bullets</h4>-->
<!--        <p class="mb-0">-->
<!--            --><?php //$mb->the_field($prefix.'wb_text'); ?>
<!--            <textarea class="w-100" type="text" rows="5" name="--><?php //$mb->the_name(); ?><!--" value="">--><?php //$mb->the_value(); ?><!--</textarea>-->
<!--        </p>-->
<!--    </div>-->
<!--    <div class="col-6 p-3">-->
<!--        <h4 class="mb-1 text-white bg-primary p-1">Red Card/Penalty/Complaints</h4>-->
<!--        <div class="mb-0">-->
<!--            --><?php //$mb->the_field($prefix.'redcards-complaints'); ?>
<!--            --><?php //wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), $prefix.'redcards-complaints', array('wpautop' => false, 'textarea_name' => $mb->get_the_name())); ?>
<!--        </div>-->
<!--    </div>-->
    <div class="col-6 p-3">
        <h4 class="text-white bg-primary p-1">Casino</h4>
        <?php $casino = get_all_posts();
        asort($casino);?>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'bookie_offer'); ?>
            <select name="<?php $mb->the_name(); ?>">
                <option value="">None...</option>
                <?php foreach ($casino as $casinoID){ ?>
                    <option value="<?=$casinoID?>" <?php $mb->the_select_state($casinoID); ?>><?=get_the_title($casinoID)?></option>
                <?php }
                wp_reset_postdata();
                ?>
            </select>
        </p>
    </div>
    <div class="col-6 p-3">
        <h4 class="text-white bg-primary p-1">Bonus</h4>
        <?php $casino = get_all_posts('bc_bonus');
        asort($casino);?>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'bonus_offer'); ?>
            <select name="<?php $mb->the_name(); ?>">
                <option value="">None...</option>
                <?php foreach ($casino as $casinoID){ ?>
                    <option value="<?=$casinoID?>" <?php $mb->the_select_state($casinoID); ?>><?=get_the_title($casinoID)?></option>
                <?php }
                wp_reset_postdata();
                ?>
            </select>
        </p>
    </div>
<!--    <div class="col-6 p-3">-->
<!--        <h4 class="mb-1 text-white bg-primary p-1">Guide Title</h4>-->
<!--        <p class="mb-1">-->
<!--            --><?php //$mb->the_field($prefix.'title_guide'); ?>
<!--            <input class="w-100" type="text" name="--><?php //$mb->the_name(); ?><!--"-->
<!--                   value="--><?php //$mb->the_value(); ?><!--"/>-->
<!--        </p>-->
<!--    </div>-->
<!--    <div class="col-6 p-3">-->
<!--        <h4 class="mb-1 text-white bg-primary p-1">Guide Text</h4>-->
<!--        <p class="mb-0">-->
<!--            --><?php //$mb->the_field($prefix.'txt_guide'); ?>
<!--            <textarea class="w-100" type="text" rows="5" name="--><?php //$mb->the_name(); ?><!--" value="">--><?php //$mb->the_value(); ?><!--</textarea>-->
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