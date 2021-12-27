<?php global $wpalchemy_media_access;?>
<div class="d-flex flex-wrap form-table">
    <div class="col-12 p-3">
        <h4 class="text-white bg-primary p-1 pointer" data-toggle="collapse" href="#country_specific">Country Specific</h4>
        <div class="multicheck panel-collapse collapse" id="country_specific" data-attribute="country_specific">
            <div class="d-flex flex-wrap ">
                <?php $mb->the_field('country_specific', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI ?>
                <?php
                $payments= WordPressSettings::getAvailableRestrictedCountries();
                asort($payments);
                foreach ($payments as $bm=>$value) { ?>
                    <p class="mb-1 d-flex mr-1" style="width:12%">
                        <input type="checkbox" name="<?php $mb->the_name(); ?>"
                               value="<?=$bm?>" <?php $mb->the_checkbox_state($bm); ?>/><label class="w-80"><?=ucwords($value)?></label>
                    </p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>