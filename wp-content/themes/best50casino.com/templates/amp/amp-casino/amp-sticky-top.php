<div class="position-sticky bg-dark  w-100" style="z-index: 9; top: 55px;" id="sticyBonus">
    <amp-list  height="60" layout="fixed-height" credentials="include" src="https://www.best50casino.com/wp-content/themes/best50casino.com/templates/amp/amp-casino/json/bonus/bonus-info.php?country=AMP_GEO(ISOCountry)&id=<?= $post->ID; ?>" binding="refresh">
        <template type="amp-mustache">
            <div class="d-flex flex-wrap w-100">
                <div class="w-30 {{0.ampExclusive}} position-absolute" style="bottom: 1px;  z-index: 999;left: 40%;">
                    <div class="exclusive-inline text-whitte  w-100 text-center text-11 font-weight-bold" style="background: #990d0d;"><i class="fa fa-star" aria-hidden="true"></i>
                        <span>Exclusive Bonus</span>
                    </div>
                </div>
                <div class="w-30 align-self-center">
                    <amp-img class="img-fluid d-block w-100"
                             alt="<?php echo get_the_title($post->ID); ?>"
                             src="<?= get_post_meta($post->ID, 'casino_custom_meta_trans_logo', true);?>"
                             width="100"
                             height="50">
                    </amp-img>
                </div>
                <div class="align-self-center w-50 d-block pb-5p">
                    <span class="text-whitte text-center text-13 d-flex flex-column">
                        <span class="font-weight-bold">{{0.bonusText.cta-top}}</span>
                        {{0.bonusText.FlagText}}
                    </span>
                </div>
                <div class="w-20 d-block pl-10p pr-5p align-self-center">
                    <a class="btn bumper btn btn bg-yellow text-black text-17 w-100 d-block mt-7p p-7p text-decoration-none btn_large text-center roundbutton mx-auto font-weight-thick bumper"  data-casinoid="<?php echo $post->ID; ?>" data-country="{{0.ISO}}"  href="{{0.aff_bo}}"  rel="nofollow" target="_blank">
                        <span> VISIT </span>
                    </a>
                </div>
            </div>
        </template>
    </amp-list>
</div>