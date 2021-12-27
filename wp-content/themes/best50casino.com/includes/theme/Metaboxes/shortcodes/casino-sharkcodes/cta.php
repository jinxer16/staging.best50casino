<?php global $wpalchemy_media_access;?>
<div class="d-flex flex-wrap form-table">
    <div class="col-4 p-3">
        <h4 class="text-white bg-primary p-1">Title for CTA Column</h4>
        <p class="mb-0">
            <?php $mb->the_field('cta_col_title'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" data-attribute="cta_col_title"/>
        </p>
    </div>
    <div class="col-2 p-3">
        <h4 class="text-white bg-primary p-1">CTA</h4>
        <?php $layout = ['sign_up' => __('Sign Up', 'nomimacasino'), 'visit' => __('Visit', 'nomimacasino'), 'play_now' => __('Play Now', 'nomimacasino'), 'bonus' => 'Get Bonus', 'review' => __('Review')];?>
        <p class="mb-0">
            <?php $mb->the_field('cta'); ?>
            <select name="<?php $mb->the_name(); ?>" data-attribute="cta" class="w-100">
                <?php foreach ($layout as $key=>$value){ ?>
                    <option value="<?=$key?>" <?php $mb->the_select_state($key); ?>><?=$value?></option>
                <?php } ?>
            </select>
        </p>
    </div>
</div>