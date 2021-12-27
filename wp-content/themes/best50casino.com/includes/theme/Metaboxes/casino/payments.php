<?php global $wpalchemy_media_access;
$prefix = 'casino_custom_meta_';?>
<div class="d-flex flex-wrap">
    <div class="col-6 p-3">
        <h4 class="text-white bg-primary p-1">Minimum Deposit</h4>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'min_dep'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                   value="<?php $mb->the_value(); ?>"/>
        </p>
    </div>
    <div class="col-6 p-3">
        <h4 class="text-white bg-primary p-1">Minimum Withdrawal</h4>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'min_withd'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                   value="<?php $mb->the_value(); ?>"/>
        </p>
    </div>
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1">Deposit Methods</h4>
        <div class="d-flex flex-wrap">
            <?php $mb->the_field($prefix.'dep_options', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
            <?php
            $payments= get_all_posts(['kss_transactions','kss_crypto']);
            asort($payments);
            foreach ($payments as $bm) { ?>
                <p class="mb-1 d-flex mr-1" style="width:12%">
                    <input type="checkbox" name="<?php $mb->the_name(); ?>"
                           value="<?= $bm; ?>" <?php $mb->the_checkbox_state($bm); ?>/><label class="w-80"><?= get_the_title($bm); ?></label>

                </p>
            <?php }
            ?>
        </div>
<!--        <h4 class="text-white bg-primary p-1 w-100">Stricted Deposits</h4>-->
<!--        <div class="d-flex flex-wrap">-->
<!--        --><?php //$mb->the_field($prefix.'dep_options_strict', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
<!--        --><?php
//        $paymentsall= get_all_posts(['kss_transactions','kss_crypto']);
//        asort($paymentsall);
//        foreach ($paymentsall as $bm) { ?>
<!--            <p class="mb-1 d-flex mr-1" style="width:12%">-->
<!--                <input type="checkbox" name="--><?php //$mb->the_name(); ?><!--"-->
<!--                       value="--><?//= $bm; ?><!--" --><?php //$mb->the_checkbox_state($bm); ?><!--/><label class="w-80">--><?//= get_the_title($bm); ?><!-- Strict </label>-->
<!--            </p>-->
<!--        --><?php //} ?>
<!--        </div>-->
    </div>
    <div class="col-12">
        <h4 class="text-white bg-primary p-1">Deposit Methods Details</h4>
        <i>After choosing a payment method from Above save post to Edit it's details</i>
        <div  class="d-flex flex-wrap">
        <?php $validTransactions = get_post_meta($post->ID,$prefix.'dep_options',true);
        if(is_array($validTransactions)){
            foreach($validTransactions as $transactionDI){
            ?>
                <div class="w-50 d-flex align-items-center">
                    <div class="w-10  m-0 border-bottom font-weight-bold p-2"><?= get_the_title($transactionDI)?></div>
                    <div class="w-30  m-0 border-bottom  p-2">
                        <?php $mb->the_field($prefix.$transactionDI.'_min_dep'); ?>
                        <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                               value="<?php $mb->the_value(); ?>" placeholder="<?= get_the_title($transactionDI)?>'s minimum deposit"/>
                    </div>
                    <div class="w-30  m-0 border-bottom p-2">
                        <?php $mb->the_field($prefix.$transactionDI.'_max_dep'); ?>
                        <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                               value="<?php $mb->the_value(); ?>" placeholder="<?= get_the_title($transactionDI)?>'s maximum deposit"/>
                    </div>
                    <div class="w-30  m-0 border-bottom p-2">
                        <?php $mb->the_field($prefix.$transactionDI.'_dep_time'); ?>
                        <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                               value="<?php $mb->the_value(); ?>" placeholder="<?= get_the_title($transactionDI)?>'s deposit time"/>
                    </div>
                </div>
            <?php
            }
        }
        ?>
        </div>
    </div>
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1">Withdrawal Methods</h4>
        <div class="d-flex flex-wrap">
            <?php $mb->the_field($prefix.'withd_options', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
            <?php
            foreach ($payments as $bm) { ?>
                <p class="mb-1 d-flex mr-1" style="width:12%">
                    <input type="checkbox" name="<?php $mb->the_name(); ?>"
                           value="<?= $bm; ?>" <?php $mb->the_checkbox_state($bm); ?>/><label class="w-80"><?= get_the_title($bm); ?></label>
                </p>
            <?php } ?>
        </div>
<!--        <h4 class="text-white bg-primary p-1">Stricted Withdrawals</h4>-->
<!--        <div class="d-flex flex-wrap">-->
<!--            --><?php //$mb->the_field($prefix.'with_options_strict', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
<!--            --><?php
//            $paymentsallwith= get_all_posts(['kss_transactions','kss_crypto']);
//            asort($paymentsallwith);
//            foreach ($paymentsallwith as $bm) { ?>
<!--                <p class="mb-1 d-flex mr-1" style="width:12%">-->
<!--                    <input type="checkbox" name="--><?php //$mb->the_name(); ?><!--"-->
<!--                           value="--><?//= $bm; ?><!--" --><?php //$mb->the_checkbox_state($bm); ?><!--/><label class="w-80">--><?//= get_the_title($bm); ?><!-- Strict </label>-->
<!--                </p>-->
<!--            --><?php //} ?>
<!---->
<!--        </div>-->
    </div>
<!--    <div class="col-12">-->
<!--        <h4 class="text-white bg-primary p-1">Withdrawal Methods Details</h4>-->
<!--        <i>After choosing a payment method from Above save post to Edit it's details</i>-->
<!--        <div  class="d-flex flex-wrap">-->
<!--            --><?php //$validTransactions = get_post_meta($post->ID,$prefix.'withd_options',true);
//            if(is_array($validTransactions) && !empty($validTransactions)){
//                foreach($validTransactions as $transactionDI){
//                    ?>
<!--                    <div class="w-50 d-flex align-items-center">-->
<!--                        <div class="w-10  m-0 border-bottom font-weight-bold p-2">--><?//= get_the_title($transactionDI)?><!--</div>-->
<!--                        <div class="w-45  m-0 border-bottom  p-2">-->
<!--                            --><?php //$mb->the_field($prefix.$transactionDI.'_min_wit'); ?>
<!--                            <input class="w-100" type="text" name="--><?php //$mb->the_name(); ?><!--"-->
<!--                                   value="--><?php //$mb->the_value(); ?><!--" placeholder="--><?//= get_the_title($transactionDI)?><!--'s minimum withdrawal"/>-->
<!--                        </div>-->
<!--                        <div class="w-45  m-0 border-bottom p-2">-->
<!--                            --><?php //$mb->the_field($prefix.$transactionDI.'_max_wit'); ?>
<!--                            <input class="w-100" type="text" name="--><?php //$mb->the_name(); ?><!--"-->
<!--                                   value="--><?php //$mb->the_value(); ?><!--" placeholder="--><?//= get_the_title($transactionDI)?><!--'s maximum withdrawal"/>-->
<!--                        </div>-->
<!--                        <div class="w-30  m-0 border-bottom p-2">-->
<!--                            --><?php //$mb->the_field($prefix.$transactionDI.'_wit_time'); ?>
<!--                            <input class="w-100" type="text" name="--><?php //$mb->the_name(); ?><!--"-->
<!--                                   value="--><?php //$mb->the_value(); ?><!--" placeholder="--><?//= get_the_title($transactionDI)?><!--'s withdrawal time"/>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    --><?php
//                }
//            }
//            ?>
<!--        </div>-->
<!--    </div>-->
    <h4 class="text-white bg-primary p-1 col-12">Withdrawal times</h4>
    <div class="col-4 p-3">
        <label class="mb-0">Ewallets</label>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'wallets_transfer_time'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                   value="<?php $mb->the_value(); ?>"/>
        </p>
    </div>
    <div class="col-4 p-3">
        <label class="mb-0">Credit/Debit Card</label>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'cards_transfer_time'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                   value="<?php $mb->the_value(); ?>"/>
        </p>
    </div>
    <div class="col-4 p-3">
        <label class="mb-0">Bank Wire</label>
        <p class="mb-0">
            <?php $mb->the_field($prefix.'bank_transfer_time'); ?>
            <input class="w-100" type="text" name="<?php $mb->the_name(); ?>"
                   value="<?php $mb->the_value(); ?>"/>
        </p>
    </div>
</div>