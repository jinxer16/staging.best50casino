<?php global $wpalchemy_media_access;
$prefix = 'casino_custom_meta_';
$software = array();
$args = array(
    'numberposts' => -1,
    'post_type'   => 'kss_softwares',
    'post_status' => array('publish', 'pending', 'draft', 'future', 'private')
);
$softwares = get_all_posts('kss_softwares' );
foreach($softwares as $key){
    if (get_post_meta($key,'software_custom_meta_livecasino', true) && !get_post_meta($key,'software_custom_meta_rng', true)){
        $live_software[$key] = '(L)'.get_the_title($key);
    }elseif (get_post_meta($key,'software_custom_meta_rng', true) && !get_post_meta($key,'software_custom_meta_livecasino', true)){
        $software[$key]=get_the_title($key);
    }elseif(get_post_meta($key,'software_custom_meta_rng', true) && get_post_meta($key,'software_custom_meta_livecasino', true)){
        $live_software[$key] = '(L)'.get_the_title($key);
        $software[$key]=get_the_title($key);
    }else{
        $software[$key]=get_the_title($key);
    }
}
asort($live_software);
asort($software);?>
<div class="d-flex flex-wrap">
<!--    <div class="col-4 p-3">-->
<!--        <label class="mb-0">Why choose</label>-->
<!--        <p class="mb-0">-->
<!--            --><?php //$mb->the_field($prefix.'why_play'); ?>
<!--            <textarea class="w-100" type="text" rows="5" name="--><?php //$metabox->the_name($prefix.'why_play'); ?><!--" value="">--><?php //$metabox->the_value($prefix.'why_play'); ?><!--</textarea>-->
<!--        </p>-->
<!--    </div>-->
    <div class="col-4 p-3">
        <label class="mb-0">Pros</label>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'pros'); ?>
            <textarea class="w-100" type="text" rows="5" name="<?php $metabox->the_name($prefix.'pros'); ?>" value=""><?php $metabox->the_value($prefix.'pros'); ?></textarea>
        </p>
    </div>
    <div class="col-4 p-3">
        <label class="mb-0">Cons</label>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'why_not_play'); ?>
            <textarea class="w-100" type="text" rows="5" name="<?php $metabox->the_name($prefix.'why_not_play'); ?>" value=""><?php $metabox->the_value($prefix.'why_not_play'); ?></textarea>
        </p>
    </div>
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1">Software</h4>
        <div class="d-flex flex-wrap">
            <?php $mb->the_field($prefix.'softwares', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
            <?php
            foreach ($software as $bm=>$name) { ?>
                <p class="mb-1 d-flex mr-1" style="width:12%">
                    <input type="checkbox" name="<?php $mb->the_name(); ?>"
                       value="<?= $bm; ?>" <?php $mb->the_checkbox_state($bm); ?>/><label class="w-80"><?= $name; ?></label>
                </p>
            <?php } ?>

        </div>
    </div>
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1">Live Software</h4>
        <div class="d-flex flex-wrap">
            <?php $mb->the_field($prefix.'live_softwares', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
            <?php
            foreach ($live_software as $bm=>$name) { ?>
                <p class="mb-1 d-flex mr-1" style="width:12%">
                    <input type="checkbox" name="<?php $mb->the_name(); ?>"
                           value="<?= $bm; ?>" <?php $mb->the_checkbox_state($bm); ?>/><label class="w-80"><?= $name; ?></label>
                </p>
            <?php } ?>

        </div>
    </div>
    <div class="col-6 p-3">
        <h4 class="text-white bg-primary p-1">Platforms</h4>
        <div class="d-flex flex-wrap">
            <?php $mb->the_field($prefix.'platforms', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
            <?php
            $platforms = [
                'android' => 'Android',
                'apple' => 'iPhone',
                'windows' => 'Windows Phone',
                'download' => 'Desktop App',
            ];
            foreach ($platforms as $bm=>$name) { ?>
                <p class="mb-1 d-flex" style="width:25%">
                    <input type="checkbox" name="<?php $mb->the_name(); ?>"
                           value="<?= $bm; ?>" <?php $mb->the_checkbox_state($bm); ?>/><label class="w-80"><?= $name; ?></label>
                </p>
            <?php } ?>
        </div>
    </div>
    <div class="col-6 p-3">
        <h4 class="text-white bg-primary p-1">Payout (RTP)</h4>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'payout'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                   value="<?php $mb->the_value(); ?>"/>
        </p>
    </div>
    <div class="col-4 p-3 d-flex align-items-center">
        <label class="mb-0">Loyalty</label>
            <?php $mb->the_field($prefix.'loyalty'); ?>
        <?php print_r(get_post_meta($post->ID,$prefix.'loyalty',true));?>
            <input type="checkbox" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
    </div>
    <div class="col-4 p-3 d-flex align-items-center">
        <label class="mb-0">VIP</label>
            <?php $mb->the_field($prefix.'vip'); ?>
            <input type="checkbox" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
    </div>
    <div class="col-4 p-3 d-flex align-items-center">
        <label class="mb-0">Exclusive Bonuses for Best50</label>
            <?php $mb->the_field($prefix.'exclusive'); ?>
            <input type="checkbox" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
    </div>
    <div class="col-4 p-3 d-flex align-items-center">
        <label class="mb-0">Live Casino</label>
            <?php $mb->the_field($prefix.'live_casino'); ?>
            <input type="checkbox" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
    </div>
    <div class="col-4 p-3 d-flex align-items-center">
        <label class="mb-0">Mobile App</label>
            <?php $mb->the_field($prefix.'mobile_casino'); ?>
            <input type="checkbox" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
    </div>
    <div class="col-4 p-3 d-flex align-items-center">
        <label class="mb-0">Progressive Jackpot</label>
            <?php $mb->the_field($prefix.'prog_jackpot'); ?>
            <input type="checkbox" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
    </div>
    <div class="col-4 p-3">
        <h4 class="text-white bg-primary p-1">Affiliate Link for Shortcodes</h4>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'affiliate_link'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                   value="<?php $mb->the_value(); ?>"/>
        </p>
    </div>
    <div class="col-4 p-3">
        <h4 class="text-white bg-primary p-1">Affiliate Link for Review</h4>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'affiliate_link_review'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                   value="<?php $mb->the_value(); ?>"/>
        </p>
    </div>
    <div class="col-4 p-3">
        <h4 class="text-white bg-primary p-1">Affiliate Link for Bonus Page</h4>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'affiliate_link_bonus'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                   value="<?php $mb->the_value(); ?>"/>
        </p>
    </div>
</div>
