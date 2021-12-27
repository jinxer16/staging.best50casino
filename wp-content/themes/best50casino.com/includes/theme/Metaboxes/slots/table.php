<?php global $wpalchemy_media_access;
$prefix = 'slot_custom_meta_';

$metaPartZ3 = [$prefix . 'slot_wheels',$prefix . 'slot_paylines',$prefix . 'wild_option',
    $prefix . 'scatter_option',$prefix . 'bonus_rounds_option',$prefix . 'free_spins_option',
    $prefix . 'adv_jackpot_option',$prefix . 'min_bet',$prefix . 'max_bet',
    $prefix . 'rtp_perc'];

$endCasinoMetaZ3 = [
    '_slot_table_meta_fields'=>$metaPartZ3,
];
foreach (get_all_posts('kss_slots') as $postID) {
    foreach ($endCasinoMetaZ3 as $key=>$value) {
        $ret = update_post_meta($postID, $key, $value);
    }
}?>
<div class="d-flex flex-wrap">
    <div class="col-2 p-1">
        <label class="mb-0">Wheels</label>
        <?php $mb->the_field($prefix.'slot_wheels'); ?>
        <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="mr-1 w-100"/>
    </div>
    <div class="col-2 p-1">
        <label class="mb-0">Paylines</label>
        <?php $mb->the_field($prefix.'slot_paylines'); ?>
        <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="mr-1 w-100"/>
    </div>
    <div class="col-2 p-1">
        <label class="mb-0">Min Bet</label>
        <?php $mb->the_field($prefix.'min_bet'); ?>
        <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="mr-1 w-100"/>
    </div>
    <div class="col-2 p-1">
        <label class="mb-0">Max Bet</label>
        <?php $mb->the_field($prefix.'max_bet'); ?>
        <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="mr-1 w-100"/>
    </div>
    <div class="col-2 p-1">
        <label class="mb-0">Return to Player (RTP)</label>
        <?php $mb->the_field($prefix.'rtp_perc'); ?>
        <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="mr-1 w-100"/>
    </div>
    <div class="col-2 p-1">
        <label class="mb-0">Rating</label>
        <?php $mb->the_field($prefix.'slot_value'); ?>
        <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="mr-1 w-100"/>
    </div>
    <div class="col-2 p-1 d-flex align-items-center">
        <label class="mb-0">Wild Symbol</label>
        <?php $mb->the_field($prefix.'wild_option'); ?>
        <input type="checkbox" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
    </div>
    <div class="col-2 p-1 d-flex align-items-center">
        <label class="mb-0">Scatter Symbol</label>
        <?php $mb->the_field($prefix.'scatter_option'); ?>
        <input type="checkbox" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
    </div>
    <div class="col-2 p-1 d-flex align-items-center">
        <label class="mb-0">Bonus Rounds</label>
        <?php $mb->the_field($prefix.'bonus_rounds_option'); ?>
        <input type="checkbox" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
    </div>
    <div class="col-2 p-1 d-flex align-items-center">
        <label class="mb-0">Free Spins</label>
        <?php $mb->the_field($prefix.'free_spins_option'); ?>
        <input type="checkbox" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
    </div>
    <div class="col-2 p-1 d-flex align-items-center">
        <label class="mb-0">Progressive Jackpot</label>
        <?php $mb->the_field($prefix.'adv_jackpot_option'); ?>
        <input type="checkbox" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="on"<?php $mb->the_checkbox_state('on'); ?> class="ml-1"/>
    </div>
</div>
