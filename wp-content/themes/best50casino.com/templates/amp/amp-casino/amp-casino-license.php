<?php $sectionHeadingState = get_post_meta($post->ID,'casino_custom_meta_heading_state_lic',true);
if ($sectionHeadingState == ''){
    $sectionHeadingState = 'span';
}
$sectionHeading = get_post_meta($post->ID,'casino_custom_meta_heading_lic',true);
if (!empty($sectionHeading)){
    ?>
    <a id="<?=$anchorsids[1]?>" class="position-relative text-decoration-none" style="top: -70px;"></a>
    <<?=$sectionHeadingState?> class="widget2-new-heading text-18 pt-6p pb-6p pl-10p pr-10p font-weight-bold mb-5p w-100 d-block mt-0p text-whitte text-left"><?=$sectionHeading?></<?=$sectionHeadingState?>>
    <?php
}
?>
<div class="flex-wrap d-flex shadow-box p-5p">
    <div class="w-100 text-justify d-flex flex-column">
        <amp-img width="176" height="160" class="img-fluid d-block mx-auto" style="max-height: 160px;" src="/wp-content/themes/best50casino.com/assets/images/secure-2.png"></amp-img>

        <div class="float-left text-left">
            <?php
            $theContent = get_post_meta($post->ID, "casino_custom_meta_banking", true);
            $theContent = ampizeImages($theContent);
            echo apply_filters('the_content', $theContent); ?>
        </div>
    </div>
</div>