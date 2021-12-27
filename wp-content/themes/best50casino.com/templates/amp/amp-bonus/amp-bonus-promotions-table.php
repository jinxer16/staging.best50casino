<?php $sectionHeadingState = get_post_meta($post->ID,'bonus_custom_meta_heading_state_promo',true);
if ($sectionHeadingState == ''){
    $sectionHeadingState = 'span';
}
$sectionHeading = get_post_meta($post->ID,'bonus_custom_meta_heading_promo',true);
if (!empty($sectionHeading)){
    ?>
    <a id="offers" class="position-relative text-decoration-none" style="top: -70px;"></a>
    <<?php echo $sectionHeadingState; ?> class="widget2-new-heading mb-5p w-100 d-block mt-0 pt-5p pb-5p pr-7p pl-7p  font-weight-bold text-whitte text-left"><?=$sectionHeading?></<?=$sectionHeadingState?>>
    <?php
}
$meta =get_post_meta($post->ID,"glb_promotions", true);
if (isset($meta) && !empty($meta)){?>
    <amp-list height="200"
              layout="fixed-height"
              src="https://www.best50casino.com/wp-content/themes/best50casino.com/templates/amp/amp-casino/json/bonus/bonus-info.php?country=AMP_GEO(ISOCountry)&id=<?= $bookieid; ?>"
              binding="no">
        <template type="amp-mustache">
            {{#promotions_table.length}}
            <div class="table-responsive w-100">
                <div class="w-100" style="border: 1px solid #84838394;">
                    <div class="d-flex flex-wrap text-12">
                        <span class="text-dark pt-7p pb-7p font-weight-bold text-center"
                              style="color: #354046; width: 36%;background: #c7ccce;">TYPE OF OFFER</span>
                        <span class="text-dark pt-7p pb-7p font-weight-bold text-center"
                              style="color: #354046;width: 36%; background: #c7ccce;">INFO</span>
                        <span class="text-dark pt-7p pb-7p font-weight-bold text-center"
                              style="color: #354046; width: 28%; background: #c7ccce;"></span>
                    </div>
                    <div class="d-flex flex-wrap text-12">
                        {{#promotions_table}}
                        <div class="font-weight-bold w-100 promo  d-flex flex-wrap text-12 p-3p"
                             style="box-shadow: 0 1px 2px #828586bf; color: #797979">
                            <span class="text-center w-40 p-5p align-self-center"
                                  style="width: 36%;"> {{type_of}}</span>
                            <span class="text-center w-40 p-5p align-self-center" style="width: 36%;"> {{info}}</span>
                            <div class="text-left w-20 align-self-center" style="width: 28%;">
                                <a class="btn bumper btn btn text-decoration-none bg-yellow text-11 w-100 d-block p-7p btn_large text-center text-black rounded mx-auto font-weight-bold bumper"
                                   data-casinoid="<?php echo $post->ID; ?>" data-country="{{0.ISO}}"
                                   href="{{button_link}}" rel="nofollow" target="_blank">
                                    <span> REVEAL CODE</span>
                                </a>
                            </div>
                        </div>
                        {{/promotions_table}}
                    </div>
                </div>
            </div>
            {{/promotions_table.length}}
        </template>
    </amp-list>
    <?php
}
?>