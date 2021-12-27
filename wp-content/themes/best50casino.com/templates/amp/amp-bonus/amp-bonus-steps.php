<div class="w-100 p-5p sign-steps bg-dark d-flex flex-wrap justify-content-between align-items-center d-sm-column " style="align-self: flex-end;">
    <div class="step-wrapper d-flex flex-column pt-5p pb-5p w-100 justify-content-between align-items-center ">
        <div class="step d-flex align-items-center mb-5p pt-5p pl-10p w-100">
            <span class="rounded-circle text-dark font-bold text-30 bg-yellow  pr-15p pl-15p mr-5p ml-5p">1</span>
            <div class="ml-10p">
                <div class="font-weight-bold text-shadow text-whitte text-17"><?= get_post_meta($post->ID,"bonus_custom_meta_step1_1",true);?></div>
                <div class="text-whitte font-weight-bold text-11"><?= get_post_meta($post->ID,"bonus_custom_meta_step1_2",true);?></div>
            </div>
        </div>
        <div class="step d-flex align-items-center pl-10p pt-5p mb-5p w-100">
            <span class="rounded-circle text-dark font-bold text-30 bg-yellow  pr-15p pl-15p mr-5p ml-5p">2</span>
            <div class="ml-10p">
                <div class="font-weight-bold text-shadow text-whitte text-17"><?= get_post_meta($post->ID,"bonus_custom_meta_step2_1",true);?></div>

                <div class="text-whitte font-weight-bold text-11"><?= get_post_meta($post->ID,"bonus_custom_meta_step2_2",true);?></div>
            </div>
        </div>
        <div class="step d-flex align-items-center pl-10p pt-5p mb-5p w-100">
            <span class="rounded-circle text-dark font-bold text-30 bg-yellow  pr-15p pl-15p mr-5p ml-5p">3</span>
            <div class="ml-10p">
                <div class="font-weight-bold text-shadow text-whitte text-17"><?= get_post_meta($post->ID,"bonus_custom_meta_step3_1",true);?></div>
                <div class="text-whitte font-weight-bold text-11">
                    <?= get_post_meta($post->ID,"bonus_custom_meta_step3_2",true);?></div>
            </div>
        </div>
    </div>
    <amp-list  height="50" layout="fixed-height" credentials="include" src="https://www.best50casino.com/wp-content/themes/best50casino.com/templates/amp/amp-casino/json/bonus/bonus-info.php?country=AMP_GEO(ISOCountry)&id=<?= $bookieid; ?>" binding="no">
        <template type="amp-mustache">
    <div class="step-btn-wrapper w-100 pt-15p">
        <a class="btn bumper btn btn bg-yellow text-17 w-50 text-decoration-none mx-auto d-block text-center text-black p-10p btn_large rounded font-weight-bold bumper"  data-casinoid="<?php echo $post->ID; ?>" data-country="{{0.ISO}}"  href="{{0.aff_bo}}" rel="nofollow" target="_blank">
            <span>CLAIM BONUS</span>
        </a>
    </div>
        </template>
    </amp-list>
</div>