<?php $sectionHeadingState = get_post_meta($post->ID,'casino_custom_meta_heading_state_live',true);
if ($sectionHeadingState == ''){
    $sectionHeadingState = 'span';
}
$sectionHeading = get_post_meta($post->ID,'casino_custom_meta_heading_live',true);
if (!empty($sectionHeading)){
    ?>
    <a id="<?=$anchorsids[4]?>" class="position-relative text-decoration-none" style="top: -70px;"></a>
    <<?=$sectionHeadingState?> class="widget2-new-heading text-18 pt-6p pb-6p pl-10p pr-10p font-weight-bold mb-5p w-100 d-block mt-0p text-whitte text-left"><?=$sectionHeading?></<?=$sectionHeadingState?>>
    <?php
}
?>
<div class="flex-wrap d-flex shadow-box p-5p">
    <div class="w-100 d-flex flex-column">
        <div class="w-100 float-left text-left">
         <amp-img width="120" height="120" class="img-fluid float-right m-7p" style="max-height: 160px;" src="/wp-content/themes/best50casino.com/assets/images/gifroul-min.png"></amp-img>
          <?php
            $theContent = get_post_meta($post->ID, "casino_custom_meta_ot_in", true);
            $theContent = ampizeImages($theContent);
            echo apply_filters('the_content', $theContent); ?>
        </div>
    </div>
</div>