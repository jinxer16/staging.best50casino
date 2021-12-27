<?php global $wpalchemy_media_access;
$prefix = 'bonus_custom_meta_';
$ratingsMeta = [
    'Bonus match & Percentage'=>$prefix.'bonus_match',
    'Free Spins & Bonus Codes'=>$prefix.'free_spins',
    'Reload & loaylty promotions'=>$prefix.'loaylty',
    'Fair Terms & Conditions'=>$prefix.'fair_terms',
    'Reasonable Wagering Requirments'=>$prefix.'wagering',
    ] ;
?>
<div class="d-flex flex-wrap">
    <?php
    foreach ($ratingsMeta as $name=>$key){ ?>
        <div class="rwmb-field rwmb-slider-wrapper d-flex align-items-center w-100">
            <div class="rwmb-label" style="width: 24%;">
                <label class="m-0" for="<?= $key ?>"><?= $name ?></label>
            </div>
            <div class="rwmb-input" style="width: 75%;">
                <div class="clearfix d-flex align-items-center">
                    <div class="rwmb-slider ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
                         style="width: 50%;"
                         id="<?= $key ?>"
                         data-options='{"range":"min","min":0,"max":10,"step":0.1}'>
                        <div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min"
                             style="width: 0%;"></div>
                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"
                              style="left: 0%;"></span>
                    </div>
                    <span class="rwmb-slider-value-label ml-2" style="width: 24%;"><span>0</span></span>
                    <?php $mb->the_field($key); ?>
                    <input type="hidden" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
                </div>
            </div>
        </div>

    <?php }?>
</div>
<div class="rwmb-field rwmb-slider-wrapper d-flex align-items-center w-100">
    <div class="rwmb-label" style="width: 24%;">
        <label class="m-0  font-weight-bold" for="bonus_custom_meta_rat_ovrl">Overall</label>
    </div>
    <div class="rwmb-input" style="width: 75%;">
        <div class="clearfix d-flex align-items-center">
            <div class="rwmb-slider final-slider ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
                 style="width: 50%;"
                 id="bonus_custom_meta_rat_ovrl"
                 data-options='{"range":"min","min":0,"max":10,"step":0.01}'>
                <div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min"
                     style="width: 0%;"></div>
                <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"
                      style="left: 0%;"></span>
            </div>
            <span class="rwmb-slider-value-label ml-2" style="width: 24%;">
                <span id="bonus_custom_meta_rat_ovrl_value">0</span>
            </span>
            <?php $mb->the_field($prefix.'rat_ovrl'); ?>
            <input type="hidden" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
        </div>
    </div>
</div>
<script>
    jQuery(function ($) {
        $('.rwmb-slider').each(function () {
            var $this = $(this),
                $input = $this.siblings('input'),
                $valueLabel = $this.siblings('.rwmb-slider-value-label').find('span'),
                value = $input.val(),
                options = $this.data('options');
            if (!value) {
                value = 0;
                $input.val(0);
                $valueLabel.text('0');
            }
            else {
                $valueLabel.text(value);
            }
            // Assign field value and callback function when slide
            options.value = value;
            options.slide = function (event, ui) {
                $input.val(ui.value);
                $valueLabel.text(ui.value);
                var d = totalRating();
                $('input[name="_bonus_rtps[bonus_custom_meta_rat_ovrl]"]').val(round(d,1));
                $('.rwmb-slider#bonus_custom_meta_rat_ovrl').slider({
                    "value":d,
                    change: function(event, ui) {
                        $('span#bonus_custom_meta_rat_ovrl_value').text(round(ui.value,1));
                    }
                });
            };
            if($this.hasClass('final-slider')){
                options.disabled = true;
            }
            $this.slider(options);
        });
    });
    function round(value, precision) {
        var multiplier = Math.pow(10, precision || 0);
        return Math.round(value * multiplier) / multiplier;
    }
    function totalRating(){
        var bonusmatch = jQuery('.rwmb-input input[name="_bonus_rtps[bonus_custom_meta_bonus_match]"]').val();
        var freespins = jQuery('.rwmb-input input[name="_bonus_rtps[bonus_custom_meta_free_spins]"]').val();
        var fairterms = jQuery('.rwmb-input input[name="_bonus_rtps[bonus_custom_meta_fair_terms]"]').val();
        var loyalty = jQuery('.rwmb-input input[name="_bonus_rtps[bonus_custom_meta_loaylty]"]').val();
        var wager = jQuery('.rwmb-input input[name="_bonus_rtps[bonus_custom_meta_wagering]"]').val();
        var totalRating = 0.3*bonusmatch + 0.2*freespins + 0.2*loyalty + 0.1*fairterms + 0.2*wager;
        return totalRating;
    }
</script>