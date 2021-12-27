<?php if(get_post_meta($post->ID,'casino_custom_meta_template',true)=='new'){ ?>

<?php global $wpalchemy_media_access;
$prefix = 'casino_custom_meta_';
$ratingsMeta = [
    'Reliability'=>$prefix.'reli_rat',
    'Payment Options'=>$prefix.'paym_op',
    'Payout Speed'=>$prefix.'payo_spe',
//    'Player Opinion'=>$prefix.'playo_rat',
    'Our Experts Opinion'=>$prefix.'expo_rat',
    'Slots Rating'=>$prefix.'slot_rat',
    'Jackpots Rating'=>$prefix.'jack_rat',
    'Providers Rating'=>$prefix.'prov_rat',
    'Other Games'=>$prefix.'otg_rat',
    'Mobile'=>$prefix.'mob_rat',
    'Live Casino'=>$prefix.'live_rat',
    'Customer Support'=>$prefix.'cust_rat',
];
$finalRatings = [
    'Bank Rating'=>$prefix.'bank_rat',
    'Overal Quality'=>$prefix.'overq_rat',
    'Game Rating'=>$prefix.'game_rat',
    'Summary Rating'=>$prefix.'sum_rating'
];
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
                    <?php $mb->the_field($key) ?>
                    <input type="hidden" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
                </div>
            </div>
        </div>
    <?php }
    $casinoBonusPage = get_post_meta($post->ID, 'casino_custom_meta_bonus_page', true);
//    $bonusrat = get_post_meta($casinoBonusPage, 'bonus_custom_meta_rat_ovrl', true);
    ?>
    <div class="rwmb-field rwmb-slider-wrapper d-flex align-items-center w-100">
        <div class="rwmb-label" style="width: 24%;">
            <label class="m-0  font-weight-bold" for="bonus">Bonus</label>
        </div>
        <div class="rwmb-input" style="width: 75%;">
            <div class="clearfix d-flex align-items-center">
                <div class="rwmb-slider final-slider ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
                     style="width: 50%;"
                     id="bonus"
                     data-options='{"range":"min","min":0,"max":10,"step":0.01}'>
                    <div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min"
                         style="width: 0%;"></div>
                    <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"
                          style="left: 0%;"></span>
                </div>
                <span class="rwmb-slider-value-label ml-2" style="width: 24%;"><span>0</span></span>
                <?php $mb->the_field($prefix.'bonus_rating'); ?>
                <input type="hidden" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
            </div>
        </div>
    </div>

    <?php
    $userratings = get_post_meta($post->ID, 'user_rating_number', true);
    ?>
    <div class="rwmb-field rwmb-slider-wrapper d-flex align-items-center w-100">
        <div class="rwmb-label" style="width: 24%;">
            <label class="m-0 font-weight-bold" for="playerReviews">Players Opinion(Players reviews)</label>
        </div>
        <div class="rwmb-input" style="width: 75%;">
            <div class="clearfix d-flex align-items-center">
                <div class="rwmb-slider final-slider ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
                     style="width: 50%;"
                     id="playerReviews"
                     data-options='{"range":"min","min":0,"max":10,"step":0.01}'>
                    <div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min"
                         style="width: 0%;"></div>
                    <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"
                          style="left: 0%;"></span>
                </div>
                <span class="rwmb-slider-value-label ml-2" style="width: 24%;"><span>0</span></span>
                <?php $mb->the_field($prefix.'playo_rat'); ?>
                <input type="hidden" name="<?php $mb->the_name(); ?>" value="<?=$userratings?>"/>
            </div>
        </div>
    </div>

    <?php foreach ($finalRatings as $name=>$key){ ?>
        <div class="rwmb-field rwmb-slider-wrapper d-flex align-items-center w-100">
            <div class="rwmb-label" style="width: 24%;">
                <label class="m-0 font-weight-bold" for="<?= $key ?>"><?= $name ?></label>
            </div>
            <div class="rwmb-input" style="width: 75%;">
                <div class="clearfix d-flex align-items-center">
                    <div class="rwmb-slider final-slider ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
                         style="width: 50%;"
                         id="<?= $key ?>"
                         data-options='{"range":"min","min":0,"max":10,"step":0.01}'>
                        <div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min"
                             style="width: 0%;"></div>
                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"
                              style="left: 0%;"></span>
                    </div>

                    <span class="rwmb-slider-value-label ml-2" style="width: 24%;"><span id="<?= $key ?>_value">0</span></span>
                    <?php $mb->the_field($key) ?>
                    <input type="hidden" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="col-12">
        <label>User Rating</label>
        <p>

            <?php $mb->the_field('user_rating'); ?>
            <input type="checkbox" name="<?php $mb->the_name(); ?>" value="1"<?php $mb->the_checkbox_state('1'); ?>/>
        </p>
        <i>Enable User Rating</i>
        <div class="d-flex align-items-center">
            <label class="m-0" style="width: 24%;" >Players Reviews Rating</label>
            <p style="width: 75%;">
                <?php $allPlayersReview = get_all_posts('player_review');?>
                <?php $playersReviewRatingSum = 0;?>
                <?php $count = 0;?>
                <?php foreach($allPlayersReview as $reviewrating){
                    if(get_post_meta($reviewrating,'review_casino', true) == $post->ID && get_post_status($reviewrating) == 'published'){
                        $count ++;
                        $playersReviewRatingSum = $playersReviewRatingSum + get_post_meta($reviewrating,'review_rating', true);
                    }
                };?>
                <?php $mb->the_field('user_rating_number'); ?>
                <?php if(is_null($mb->get_the_value())) $mb->meta[$mb->name] = $playersReviewRatingSum/$count; ?>
                <input style="width: 50%;" type="text" name="<?php $mb->the_name(); ?>" value="<?php echo round($mb->get_the_value(),1) ?>"
                       readonly="readonly"/>
            </p>
        </div>
        <div class="d-flex align-items-center">
            <label class="m-0" style="width: 24%;" >Number of Players Reviews</label>
            <p>
                <?php $mb->the_field('user_rating_count'); ?>
                <?php if(is_null($mb->get_the_value())) $mb->meta[$mb->name] = get_post_meta($post->ID,'user_rating_count',true)? get_post_meta($post->ID,'user_rating_count',true): $count; ?>

                <input style="width: 50%;" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"
                       readonly="readonly"/>
            </p>
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
                var a = bankingRating();
                var b = overallRating();
                var c = gamesRating();
                var d = totalRating();
                $('input[name="_casino_rat_total[casino_custom_meta_bank_rat]"]').val(round(a,1));
                $('input[name="_casino_rat_total[casino_custom_meta_overq_rat]"]').val(round(b,1));
                $('input[name="_casino_rat_total[casino_custom_meta_game_rat]"]').val(round(c,1));
                $('input[name="_casino_rat_total[casino_custom_meta_sum_rating]"]').val(round(d,1));
                $('.rwmb-slider#casino_custom_meta_bank_rat').slider( {
                    "value":a,
                    change: function(event, ui) {
                        $('span#casino_custom_meta_bank_rat_value').text(round(ui.value,1));
                    }
                });
                $('.rwmb-slider#casino_custom_meta_overq_rat').slider( {
                    "value":b,
                    change: function(event, ui) {
                        $('span#casino_custom_meta_overq_rat_value').text(round(ui.value,1));
                    }
                });
                $('.rwmb-slider#casino_custom_meta_game_rat').slider( {
                    "value":c,
                    change: function(event, ui) {
                        $('span#casino_custom_meta_game_rat_value').text(round(ui.value,1));
                    }
                });
                $('.rwmb-slider#casino_custom_meta_sum_rating').slider( {
                    "value":d,
                    change: function(event, ui) {
                        $('span#casino_custom_meta_sum_rating_value').text(round(ui.value,1));
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
    function gamesRating(){
        var slotsRating = jQuery('.rwmb-input input[name="_casino_rat_total[casino_custom_meta_slot_rat]"]').val();
        var jacksRating = jQuery('.rwmb-input input[name="_casino_rat_total[casino_custom_meta_jack_rat]"]').val();
        var provsRating = jQuery('.rwmb-input input[name="_casino_rat_total[casino_custom_meta_prov_rat]"]').val();
        var otherRating = jQuery('.rwmb-input input[name="_casino_rat_total[casino_custom_meta_otg_rat]"]').val();
        var gamesRating = 0.25*slotsRating + 0.20*jacksRating + 0.5*provsRating + 0.05*otherRating;
        return gamesRating;
    }
    function overallRating(){
        var playersOpinionRating = jQuery('.rwmb-input input[name="_casino_rat_total[casino_custom_meta_playo_rat]"]').val();
        var expertsOpinionRating = jQuery('.rwmb-input input[name="_casino_rat_total[casino_custom_meta_expo_rat]"]').val();
        var overallRating = 0.5*playersOpinionRating + 0.5*expertsOpinionRating;
        return overallRating;
    }
    function bankingRating(){
        var payoutSpeedRating = jQuery('.rwmb-input input[name="_casino_rat_total[casino_custom_meta_payo_spe]"]').val();
        var paymentsOptRating = jQuery('.rwmb-input input[name="_casino_rat_total[casino_custom_meta_paym_op]"]').val();
        var bankingRating = 0.5*payoutSpeedRating + 0.5*paymentsOptRating;
        return bankingRating;
    }
    function totalRating(){
        var bankingRatingVar = bankingRating();
        var overallRatingVar = overallRating();
        var gamesRatingVar = gamesRating();
        var reliaRating = jQuery('.rwmb-input input[name="_casino_rat_total[casino_custom_meta_reli_rat]"]').val();
        var mobilRating = jQuery('.rwmb-input input[name="_casino_rat_total[casino_custom_meta_mob_rat]"]').val();
        var liveCRating = jQuery('.rwmb-input input[name="_casino_rat_total[casino_custom_meta_live_rat]"]').val();
        var CSuppRating = jQuery('.rwmb-input input[name="_casino_rat_total[casino_custom_meta_cust_rat]"]').val();
        var BonusRating = jQuery('.rwmb-input input[name="_casino_rat_total[casino_custom_meta_bonus_rating]"]').val();
        var totalRating = 0.35*reliaRating + 0.125*bankingRatingVar + 0.125*overallRatingVar + 0.1*mobilRating + 0.1*BonusRating + 0.075*liveCRating + 0.05*CSuppRating + 0.075*gamesRatingVar;
        return totalRating;
    }
</script>
<?php
//try {
////    require get_template_directory() .'/includes/plugins/vendor/autoload.php';
//    require TEMPLATEPATH . '/includes/plugins/vendor/autoload.php';
//} catch (Exception $e) {
//    echo $e;
//}

//use PhpOffice\PhpSpreadsheet\Spreadsheet;
//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//$spreadsheet = new Spreadsheet();
//$sheet = $spreadsheet->getActiveSheet();
//
//$casinos = get_all_posts('kss_casino');
////$i=2;
//foreach ($casinos as $casinoID){
////    $sheet->setCellValue('B'.$i, get_the_title($casinoID).' Ratings');
////    $sheet->setCellValue('C1', 'Reliability');
////    $sheet->setCellValue('D1', 'Mobile');
////    $sheet->setCellValue('E1', 'Live Casino');
////    $sheet->setCellValue('F1', 'Customer Support');
////    $sheet->setCellValue('G1', 'Bonus');
////    $sheet->setCellValue('H1', 'Overall');
////    $sheet->setCellValue('I1', 'Game Rating');
////    $sheet->setCellValue('J1', 'Bank Rating');
////    $sheet->setCellValue('K1', 'OLD SUM');
////    $sheet->setCellValue('L1', 'NEW SUM');
//    $reliaRating = get_post_meta($casinoID,'casino_custom_meta_reli_rat',true);
////    $sheet->setCellValue('C'.$i, $reliaRating);
//    $mobilRating = get_post_meta($casinoID,'casino_custom_meta_mob_rat',true);
////    $sheet->setCellValue('D'.$i, $mobilRating);
//    $liveCRating = get_post_meta($casinoID,'casino_custom_meta_live_rat',true);
////    $sheet->setCellValue('E'.$i, $liveCRating);
//    $CSuppRating = get_post_meta($casinoID,'casino_custom_meta_cust_rat',true);
////    $sheet->setCellValue('F'.$i, $CSuppRating);
//    $BonusRating = get_post_meta($casinoID,'casino_custom_meta_bonus_rating',true);
////    $sheet->setCellValue('G'.$i, $BonusRating);
//    $overaRating = get_post_meta($casinoID,'casino_custom_meta_overq_rat',true);
////    $sheet->setCellValue('H'.$i, $overaRating);
//    $gamesRating = get_post_meta($casinoID,'casino_custom_meta_game_rat',true);
////    $sheet->setCellValue('I'.$i, $gamesRating);
//    $bankiRating = get_post_meta($casinoID,'casino_custom_meta_bank_rat_value',true);
////    $sheet->setCellValue('J'.$i, $bankiRating);
//    $oldsumRating = get_post_meta($casinoID,'casino_custom_meta_sum_rating',true);
////    $sheet->setCellValue('K'.$i, $oldsumRating);
//    $sumRating = 0.35*$reliaRating + 0.125*$bankiRating + 0.125*$overaRating + 0.1*$mobilRating + 0.1*$BonusRating + 0.075*$liveCRating + 0.05*$CSuppRating + 0.075*$gamesRating;
////    $sheet->setCellValue('L'.$i, $sumRating);
//            update_post_meta($casinoID,'casino_custom_meta_sum_rating',$sumRating);
////    $i++;
//}
//$writer = new Xlsx($spreadsheet);
//try {
//    $writer->save(TEMPLATEPATH.'/includes/plugins/vendor/ratings.xlsx');
// $writer->save('C:\xampp\htdocs\dev.best50casino.com\wp-content\themes\best50casino.com\includes\plugins\vendor\ratings.xlsx');
//} catch (\PhpOffice\PhpSpreadsheet\Writer\Exception $e) {
//    echo  $e;
//
//}
}
?>