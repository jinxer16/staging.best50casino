<?php $sectionHeadingState = get_post_meta($post->ID,'casino_custom_meta_heading_state_mob',true);
if ($sectionHeadingState == ''){
    $sectionHeadingState = 'span';
}
$sectionHeading = get_post_meta($post->ID,'casino_custom_meta_heading_mob',true);
if (!empty($sectionHeading)){
    ?>
    <a id="<?=$anchorsids[5]?>" class="position-relative text-decoration-none" style="top: -70px;"></a>
    <<?=$sectionHeadingState?> class="widget2-new-heading text-18 pt-6p pb-6p pl-10p pr-10p font-weight-bold mb-5p w-100 d-block mt-0p text-whitte text-left"><?=$sectionHeading?></<?=$sectionHeadingState?>>
    <?php
}
?>
<div class="flex-wrap d-flex shadow-box p-5p">
    <div class="w-100 d-flex flex-column">
        <div class="w-100 float-left text-left">
         <amp-img width="120" height="120" class="img-fluid float-right m-7p" style="max-height: 160px;" src="/wp-content/themes/best50casino.com/assets/images/gifslots-min.png"></amp-img>
             <?php
             $theContent = get_post_meta($post->ID, "casino_custom_meta_mobile", true);
             $theContent = ampizeImages($theContent);
             echo apply_filters('the_content', $theContent); ?>
        </div>
    </div>
</div>

        <?php
        $meta = get_post_meta($post->ID, 'casino_custom_meta_mbapp_ticks', true);
            $ticksmobile = explode(",", $meta);

            if (get_post_meta($post->ID, 'casino_custom_meta_mbapp_bg', true)){
                $bgimage = get_post_meta($post->ID, 'casino_custom_meta_mbapp_bg', true);
            }else{
                $bgimage = "/wp-content/themes/best50casino.com/assets/images/default_mb.png";
            } ?>
            <span class="widget2-heading text-whitte p-7p font-weight-bold text-16 mb-2p w-100 d-block mt-0 bg-dark text-left"><?= get_the_title($post->ID);?> Mobile Casino / Mobile Apps</span>
            <div class="d-flex flex-wrap" style="height:280px; background-size:cover; background-image: url('<?=$bgimage;?>'); background-repeat: no-repeat;">
                <div class="align-self-center w-70 position-relative pl-20p">
                    <amp-img height="60" width="140"  src="<?=get_post_meta($post->ID, 'casino_custom_meta_trans_logo', true);?>" class="img-fluid pb-5p" alt="<?= get_the_title($post->ID) ?>"></amp-img>
                    <ul class="billboard-list bill-mobil list-typenone p-5p">
                        <?php foreach ($ticksmobile as $value) {
                            ?>
                            <li class="font-weight-bold mb-10p text-13 text-whitte"><?=$value?></li>
                            <?php
                        }?>
                    </ul>
                </div>
            </div>

            <amp-list  height="65"
                       layout="fixed-height"
                       src="https://www.best50casino.com/wp-content/themes/best50casino.com/templates/amp/amp-casino/json/bonus/bonus-info.php?country=AMP_GEO(ISOCountry)&id=<?= $post->ID; ?>"
                       binding="no">
                <template type="amp-mustache">
            <div class="p-10p bg-dark">
                <a class="btn bumper btn btn bg-blue text-13 w-70 d-block mx-auto p-7p btn_large text-decoration-none text-whitte rounded text-center font-weight-bold bumper" style="box-shadow: 0 5px 15px rgba(145, 92, 182, .4);"  data-casinoid="<?php echo $post->ID; ?>" data-country="{{0.ISO}}"  href="{{0.aff_re1}}" rel="nofollow" target="_blank">
                    <span>  <?php  echo "Visit ".get_the_title($post->ID)." Mobile".'<i class="fa fa-angle-right mt-4p pl-2p"></i>' ;?></span>
                </a>
            </div>
                </template>
</amp-list>