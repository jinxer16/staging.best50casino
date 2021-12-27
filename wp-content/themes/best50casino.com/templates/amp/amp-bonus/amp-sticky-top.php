<div class="position-sticky bg-dark w-100" style="z-index: 9; top: 55px;" id="sticyBonus">
    <amp-list  height="60" layout="fixed-height" src="https://www.best50casino.com/wp-content/themes/best50casino.com/templates/amp/amp-casino/json/bonus/bonus-info.php?country=AMP_GEO(ISOCountry)&id=<?= $bookieid; ?>" binding="refresh">
        <template type="amp-mustache">
            <div class="d-flex flex-wrap w-100">
                <div class="w-33 pt-5p">
                    <amp-img class="img-fluid d-block w-100"
                             alt="<?php echo get_the_title($bookieid); ?>"
                             src="<?= get_post_meta($bookieid, 'casino_custom_meta_trans_logo', true);?>"
                             width="120"
                             height="50">
                    </amp-img>
                </div>
                <div class="backbutton align-self-center pt-5p w-40 d-block">
                    <a class="p-7p text-left pl-15p text-whitte position-relative text-14 font-weight-thick w-100 bg-primary text-decoration-none rounded curl-top-right show" on="tap:AMP.setState({visible: !visible})" [class]="visible ? 'hide' : 'd-inline-block p-7p text-left pl-15p text-whitte position-relative text-decoration-none font-weight-thick w-100 bg-primary rounded curl-top-right'" role="button" >View Code</a>
                    <a class="p-7p text-center position-relative font-weight-thick text-14 w-100 border-dashed bg-whitte text-decoration-none text-muted rounded hide"  [class]="visible ? 'd-inline-block p-7p text-center position-relative font-weight-thick w-100 text-decoration-none border-dashed bg-whitte text-13 text-muted rounded' : 'hide'"  on="tap:AMP.setState({visible: !visible})" role="button">{{0.bonusCode}}</a>
                </div>
                <div class="w-25 d-block pl-10p pt-5p pr-5p align-self-center">
                    <a class="btn bumper btn btn bg-yellow text-black text-17 w-100 d-block mt-7p text-decoration-none p-7p btn_large text-center roundbutton mx-auto font-weight-thick bumper"  data-casinoid="<?php echo $post->ID; ?>" data-country="{{0.ISO}}"  href="{{0.aff_bo}}"  rel="nofollow" target="_blank">
                        <span> CLAIM </span>
                    </a>
                </div>
            </div>
        </template>
    </amp-list>
</div>