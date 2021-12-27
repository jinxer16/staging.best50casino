<?php $sectionHeadingState = get_post_meta($post->ID,'casino_custom_meta_heading_state_games',true);
if ($sectionHeadingState == ''){
    $sectionHeadingState = 'span';
}
$sectionHeading = get_post_meta($post->ID,'casino_custom_meta_heading_games',true);
if (!empty($sectionHeading)){
    ?>
    <a id="<?=$anchorsids[6]?>" class="position-relative text-decoration-none" style="top: -70px;"></a>
    <<?=$sectionHeadingState?> class="widget2-new-heading text-18 pt-6p pb-6p pl-10p pr-10p font-weight-bold mb-5p w-100 d-block mt-0p text-whitte text-left"><?=$sectionHeading?></<?=$sectionHeadingState?>>
    <?php
}
?>
<div class="flex-wrap d-flex shadow-box p-5p">
   <div class="w-100 text-justify">
         <?php
         $theContent = get_post_meta($post->ID, "casino_custom_meta_sl_ga", true);
         $theContent = ampizeImages($theContent);
         echo apply_filters('the_content', $theContent); ?>
 </div>
</div>