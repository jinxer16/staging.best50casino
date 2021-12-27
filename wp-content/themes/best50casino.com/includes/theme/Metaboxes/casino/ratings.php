<?php if(get_post_meta($post->ID,'casino_custom_meta_template',true)!='new'){ ?>

<?php global $wpalchemy_media_access;
$prefix = 'casino_custom_meta_';
$ratingsMeta = [
        'Fairness'=>$prefix.'license_rating',
    'Payout Speed'=>$prefix.'withdrawal_rating',
    'Bonuses'=>$prefix.'offers_rating',
    'Software'=>$prefix.'site_rating',
    'B50 Quality'=>$prefix.'games_rating',
    'Total'=>$prefix.'sum_rating'
] ;
?>
<div class="d-flex flex-wrap">
    <?php
    foreach ($ratingsMeta as $name=>$key){ ?>
        <div class="col-3 d-flex flex-column">
            <label><?=$name?></label>
            <?php $mb->the_field($key); ?>
            <input type="text" name="<?php $mb->the_name($key); ?>"
                   value="<?php $mb->the_value($key); ?>" id="<?=$key?>" class="ratings"/>
        </div>
    <?php }?>
</div>
<script>
    jQuery(document).ready(function() {

        jQuery(".ratings").blur(function () {
            var total = 0,
                valid_labels = 0,
                average;

            jQuery('.ratings:not(#casino_custom_meta_sum_rating)').each(function () {
                // Retrieve input value
                // .innerHTML only retrieves the info between the HTML tags, and is
                // a non-jQuery call.  The jQuery version is .html(), but you want
                // .val() with no parameters, which gets the current input value
                var val = parseFloat(jQuery(this).val(), 10);

                //Test if it is a valid number with built-in isNaN() function
                if (!isNaN(val)) {
                    if(jQuery(this).attr('id') == 'casino_custom_meta_license_rating' || jQuery(this).attr('id') == 'casino_custom_meta_site_rating' ){
                        val = val*2.5;
                    }else if(jQuery(this).attr('id') == 'casino_custom_meta_games_rating'|| jQuery(this).attr('id') == 'casino_custom_meta_withdrawal_rating'){
                        val = val*1.5;
                    }else if(jQuery(this).attr('id') == 'casino_custom_meta_offers_rating'){
                        val = val*2;
                    }
                    valid_labels += 1;
                    total += val;
                }
            });

            // Calculate the average
            // Note: This is done inside the keyup handler
            // When it is outside, it is only calculated once when the page loads
            var finalVal = total / 10;
            jQuery('#casino_custom_meta_sum_rating').val(finalVal.toFixed(2));
        })
    });
</script>
<?php } ?>