<?php global $wpalchemy_media_access;
$prefix = 'casino_custom_meta_';
$ratingsMeta = [
    'Slots'=>$prefix.'slots_rtp',
    'Roulette'=>$prefix.'roulette_rtp',
    'Blackjack'=>$prefix.'blackjack_rtp',
    'Table Games'=>$prefix.'tableGames_rtp',
    'Video Poker'=>$prefix.'videoPoker_rtp',
    'Scratch Cards'=>$prefix.'scratchCards_rtp',
    'Arcade Games'=>$prefix.'arcadeGames_rtp'
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
                         data-options='{"range":"min","min":0,"max":100,"step":0.01}'>
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
            };

            $this.slider(options);
        });
    });
</script>