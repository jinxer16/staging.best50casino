<?php $sectionHeadingState = get_post_meta($post->ID,'bonus_custom_meta_heading_state_code',true);
if ($sectionHeadingState == ''){
    $sectionHeadingState = 'span';
}
$sectionHeading = get_post_meta($post->ID,'bonus_custom_meta_heading_code',true);
if (!empty($sectionHeading)){
    ?>
    <a id="bonus-code" class="position-relative text-decoration-none" style="top: -70px;"></a>
    <<?php echo $sectionHeadingState; ?> class="widget2-new-heading mb-5p w-100 d-block mt-0 pt-5p pb-5p pr-7p pl-7p  font-weight-bold text-whitte text-left" id=""><?=$sectionHeading?></<?=$sectionHeadingState?>>
    <?php
}
?>

<div class="flex-wrap d-flex shadow-box p-5p" id="">
 <span class="w-100 text-justify">
 <?php echo apply_filters('the_content', get_post_meta($post->ID,"bonus_custom_meta_promo_code",true)); ?>
 </span>
</div>
    <amp-list  height="350" layout="fixed-height"
               src="https://www.best50casino.com/wp-content/themes/best50casino.com/templates/amp/amp-casino/json/bonus/bonus-info.php?country=AMP_GEO(ISOCountry)&id=<?= $bookieid; ?>"
               binding="no">
    <template type="amp-mustache">
        <div class="flex-wrap d-flex shadow-box p-5p" id="">
            <div class="d-flex flex-wrap w-100 rounded">
                <div class="w-33 bg-yellow text-dark text-center font-weight-bold p-10p d-block m-auto" style="border-top-left-radius:12px;border-right: 1px solid black;"><i class="fa fa-bolt d-inline-block text-17"></i> One Click</div>
                <div class="w-33 bg-gray-light text-center p-10p font-weight-bold d-block m-auto" style="border-right: 1px solid black;"><i class="fa fa-mobile d-inline-block text-17"></i> By Phone</div>
                <div class="w-33 bg-gray-light text-center font-weight-bold p-10p d-block m-auto" style="border-top-right-radius:12px;"><i class="fa fa-envelope d-inline-block text-17"></i> By Mail</div>

                <div class="w-100 d-flex flex-column p-10p bg-dark">
                    <div class="bg-whitte w-80 d-block mx-auto p-7p" style="border-radius: 5px;">
                        <span class="font-weight-bold">{{countryinfo.name}}<i class="fa fa-angle-down text-17 mt-5p float-right"></i></span>
                    </div>
                    <div class="bg-whitte w-80 mt-10p d-block mx-auto p-7p" style="border-radius: 5px;">

                        <span class="font-weight-bold bg-primary text-whitte p-5p">{{0.bonusCode}}<i class="fa fa-angle-down text-17 mt-5p float-right"></i></span>
                    </div>
                    <div class="bg-whitte w-80 mt-10p d-block mx-auto p-7p" style="border-radius: 5px;">
                        <span class="font-weight-bold"> {{countryinfo.symbol}}{{countryinfo.code}}({{countryinfo.currname}})<i class="fa fa-angle-down text-17 mt-5p float-right"></i></span>
                    </div>

                    <a class="btn btn bg-yellow text-17 w-80 d-block p-10p mx-auto mt-10p text-decoration-none text-black btn_large rounded font-weight-bold" rel="nofollow">REGISTER</a>

                </div>
            </div>
    <div class="d-flex flex-column w-100 mt-5p steps-bonus">
        <div class="d-flex flex-wrap w-100 mt-3p"><div class="w-10 d-block m-auto p-5p"><span class="stepper text-whitte font-weight-bold d-inline-block mr-5p text-center">1</span></div><div class="w-80 bg-gray-light d-block m-auto p-7p text-13 font-weight-bold">Create your personal account by clicking on the registration button</div> </div>
        <div class="d-flex flex-wrap w-100 mt-3p"><div class="w-10 d-block p-5p m-auto"><span class="stepper text-whitte font-weight-bold d-inline-block mr-5p text-center">2</span></div><div class="w-80 bg-gray-light d-block m-auto p-7p text-13 font-weight-bold">Provide the casino with your personal details</div> </div>
        <div class="d-flex flex-wrap w-100 mt-3p"><div class="w-10 d-block p-5p m-auto"><span class="stepper text-whitte font-weight-bold d-inline-block mr-5p text-center">3</span></div><div class="w-80 bg-gray-light d-block m-auto p-7p text-13 font-weight-bold">Enter any of the casino's available promo codes,or Best50casino's exclusive code in the corresponding field</div> </div>
        <div class="d-flex flex-wrap w-100 mt-3p"><div class="w-10 d-block p-5p m-auto"><span class="stepper text-whitte font-weight-bold d-inline-block mr-5p text-center">4</span></div><div class="w-80 bg-gray-light d-block m-auto p-7p text-13 font-weight-bold">Complete the registration process and claim your bonus</div> </div>
        <a class="btn bumper bg-yellow text-17 text-center w-60 d-block p-10p mx-auto mt-10p text-decoration-none btn_large roundbutton font-weight-bold  text-black"  data-casinoid="<?php echo $post->ID; ?>" data-country="{{0.ISO}}"  href="{{0.aff_bo}}" rel="nofollow" target="_blank">
            <span>GET THIS BONUS <i class="fa fa-angle-right"></i></span>
        </a>
    </div>
        </div>
    </template>
    </amp-list>

