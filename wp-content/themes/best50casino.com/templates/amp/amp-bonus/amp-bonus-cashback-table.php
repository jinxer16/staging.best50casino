
<?php $sectionHeadingState = get_post_meta($post->ID,'bonus_custom_meta_heading_state_cash',true);


if (get_post_meta($post->ID,"bonus_custom_meta_vip_cashback",true) !=''){
?>
<div class="shadow-box d-flex flex-wrap mt-20p w-100" style="border: 1px solid #8e8e8e94;">
    <?php
    if ($sectionHeadingState == ''){
    $sectionHeadingState = 'span';
}
$sectionHeading = get_post_meta($post->ID,'bonus_custom_meta_heading_cash',true);
if (!empty($sectionHeading)){
    ?>
    <<?php echo $sectionHeadingState; ?> class="p-5p text-left font-weight-bold mb-5p" ><i class="fa fa-user"></i> <?=$sectionHeading?></<?=$sectionHeadingState?>>
    <?php
}?>
 <div class="w-100 pr-5p pl-5p text-justify">
     <?php
     $theContent = get_post_meta($post->ID, "bonus_custom_meta_vip_cashback", true);
     $theContent = ampizeImages($theContent);
     echo apply_filters('the_content', $theContent); ?>
 </div>
</div>
    <?php
}
$meta =get_post_meta($post->ID,"glb_vip", true);
if (isset($meta) && !empty($meta)){?>
    <amp-list height="150" layout="fixed-height"
              src="https://www.best50casino.com/wp-content/themes/best50casino.com/templates/amp/amp-casino/json/bonus/bonus-info.php?country=AMP_GEO(ISOCountry)&id=<?= $bookieid; ?>"
              binding="no">
        <template type="amp-mustache">
            {{#vip_cashback.length}}
            <div class="table-responsive w-100">
                <div class="w-100" style="border: 1px solid #84838394;">
                    <div class="d-flex flex-wrap text-12">
                        <span class="text-dark pt-10p text-left pl-7p pb-10p font-weight-bold text-center pb-10p numeric w-33">Status</span>
                        <span class="text-dark pt-10p pb-10p font-weight-bold text-center pb-10p numeric w-33">Cashback</span>
                        <span class="text-dark pt-10p pb-10p font-weight-bold text-center pb-10p numeric w-33">Maximum Bonus</span>
                    </div>
                    <div class="d-flex flex-wrap">
                        {{#vip_cashback}}
                        <div class="font-weight-bold w-100 promo d-flex flex-wrap p-5p text-12 cashbackcolor"
                             style="box-shadow: 0 1px 2px #828586bf; color: #797979">
                            <span class="text-left w-33 p-5p"> {{level}}</span>
                            <span class="text-center w-33 p-5p"> {{experience}}</span>
                            <span class="text-center w-33 p-5p"> {{cashback}}</span>
                        </div>
                        {{/vip_cashback}}
                    </div>
                </div>
            </div>
            {{/vip_cashback.length}}
        </template>
    </amp-list>
    <?php
}
?>

