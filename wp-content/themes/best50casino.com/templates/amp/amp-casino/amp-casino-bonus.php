<amp-list height="210"
          layout="fixed-height"
          src="https://www.best50casino.com/wp-content/themes/best50casino.com/templates/amp/amp-casino/json/bonus/bonus-info.php?country=AMP_GEO(ISOCountry)&id=<?= $post->ID ?>"
          binding="no">
    <template type="amp-mustache">
        <div class="w-100 d-flex flex-wrap justify-content-center mb-10p mt-10p"
             style="background: rgb(79,174,178);background: linear-gradient(90deg, rgba(79,174,178,1) 0%, rgba(48,102,114,1) 76%, rgba(48,102,114,1) 100%);">
            <div class="w-100 d-flex pt-20p flex-column">
                <p class="text-20 font-weight-bold text-center text-whitte  mt-1p text-uppercase"><?= get_the_title($casinoBonusPage); ?></p>
                <div class="d-flex flex-wrap text-whitte bg-dark align-items-center">
                    <div class="w-10 p-5p text-center align-self-center">
                        <div class="bg-primary rounded d-flex justify-content-center gift-box">
                            <i class="fa text-24 text-white fa-gift position-relative"></i>
                        </div>
                    </div>

                    <div class="p-5p w-30 d-flex flex-column align-self-center text-center">
                        <span>BONUS</span>
                        <span class="text-center text-18 font-weight-bold"> {{0.bonusText.right-bonus}}</span>
                    </div>
                    <div class="p-5p align-self-center w-30 d-flex flex-column text-center">
                        <span class="text-center">PERCENTAGE</span>
                        <span class="text-center text-18 font-weight-bold">{{0.bonusText.right-percentage}}</span>
                    </div>
                    <div class="p-5p align-self-center w-30 d-flex flex-column text-center">
                        <span>MIN.DEPOSIT</span>
                        <span class="text-center text-18 font-weight-bold">{{0.bonusText.min-dep}}</span>
                    </div>

                </div>
            </div>
            <div class="w-100 align-self-center d-flex pt-20p pl-10p">
                <a class="btn bg-yellow text-center text-17 w-70 d-block mx-auto p-7p text-decoration-none mb-7p mt-10p btn_large text-dark roundbutton font-weight-bold bumper"
                   data-casinoid="<?php echo $post->ID; ?>"
                   data-country="{{0.ISO}}" href="{{0.aff_re2}}"
                   rel="nofollow" target="_blank"><span>
                    Claim Bonus <i class="fa fa-angle-right mt-2p"></i></span></a>
            </div>
        </div>
    </template>
</amp-list>