<?php global $wpalchemy_media_access;
$prefix = 'casino_custom_meta_';
$restrictedCountries = WordPressSettings::getAvailableRestrictedCountries();
$currencies =WordPressSettings::getAvailableCurrencies();
$lanuages = WordPressSettings::getAvailableLanguages();
$CSlanuages = WordPressSettings::getAvailableCSLanguages();?>
<div class="d-flex flex-wrap">
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1">Restricted Countries</h4>
        <div class="d-flex flex-wrap">
            <div class="col-12">
                <label for="selectall">Select all</label>
                <input id='selectall' type="checkbox" checked="true">
            </div>
            <?php $mb->the_field($prefix.'rest_countries', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
            <?php
            foreach ($restrictedCountries as $key=>$value) { ?>
                <p class="mb-1 d-flex mr-1" style="width:12%">
                    <input type="checkbox" class="restricted_countries" name="<?php $mb->the_name(); ?>"
                           value="<?= $key ?>" <?php $mb->the_checkbox_state($key); ?>/><label class="w-80"><?=ucwords($value)?></label>
                </p>
            <?php } ?>

        </div>
    </div>
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1">Currencies Accepted</h4>
        <div class="d-flex flex-wrap">
            <?php $mb->the_field($prefix.'cur_acc', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
            <?php
            foreach ($currencies as $key=>$value) { ?>
                <p class="mb-1 d-flex mr-1" style="width:12%">
                    <input type="checkbox" name="<?php $mb->the_name(); ?>"
                           value="<?= $key ?>" <?php $mb->the_checkbox_state($key); ?>/><label class="w-80"><?=$value?></label>
                </p>
            <?php } ?>

        </div>
    </div>
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1">Language Supported (Site)</h4>
        <div class="d-flex flex-wrap">
            <?php $mb->the_field($prefix.'lang_sup_site', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
            <?php
            foreach ($lanuages as $key=>$value) { ?>
                <p class="mb-1 d-flex mr-1" style="width:12%">
                    <input type="checkbox" name="<?php $mb->the_name(); ?>"
                           value="<?= $key ?>" <?php $mb->the_checkbox_state($key); ?>/><label class="w-80"><?=$value?></label>
                </p>
            <?php } ?>

        </div>
    </div><div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1">Language Supported (CS)</h4>
        <div class="d-flex flex-wrap">
            <?php $mb->the_field($prefix.'lang_sup_cs', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
            <?php
            foreach ($CSlanuages as $key=>$value) { ?>
                <p class="mb-1 d-flex mr-1" style="width:12%">
                    <input type="checkbox" name="<?php $mb->the_name(); ?>"
                           value="<?= $key ?>" <?php $mb->the_checkbox_state($key); ?>/><label class="w-80"><?=$value?></label>
                </p>
            <?php } ?>

        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function($) {
        $('#selectall').change(function () {
            if ($(this).prop('checked')) {
                $('.restricted_countries').prop('checked', true);
            } else {
                $('.restricted_countries').prop('checked', false);
            }
        });
    });
</script>