<amp-list  height="380"
           layout="fixed-height"
           src="https://www.best50casino.com/wp-content/themes/best50casino.com/templates/amp/amp-casino/json/bonus/bonus-info.php?country=AMP_GEO(ISOCountry)&id=<?= $bookieid; ?>"
           binding="no">
<template type="amp-mustache">
<div class="widget2 side-depo">
    <span class="widget2-heading text-whitte p-7p font-weight-bold text-15 mb-2p w-100 d-block mt-0  bg-dark text-left"><?= get_the_title($bookieid);?> Casino Payments </span>
    <div class="text-left text-20 p-2p" style="background: #d2dce1;"><span>Deposit Methods</span></div>
    {{#premium_payments}}
        <div class="side-depo p-2p d-flex flex-wrap depocolor">
            <div class="d-flex flex-wrap w-60">
                <div class="w-30">
                    <amp-img width="40" height="40" class="img-fluid"  src="{{image}}"></amp-img>
                </div>
                <div class="w-70 m-auto">
                    {{name}}
                </div>
            </div>
            <div class="w-40 p-5p">
                <a class="btn bumper btn btn bg-yellow text-15 w-sm-100 d-block p-5p btn_large text-center text-black text-decoration-none rounded  bumper font-weight-bold" data-casinoid="<?php echo $post->ID; ?>" data-country="{{0.ISO}}" href="{{0.aff_bo}}" rel="nofollow" target="_blank">
                    <span>Deposit <i class="fa fa-long-arrow-right"></i></span>
                </a>
            </div>
        </div>
    {{/premium_payments}}
</div>
    </template>
</amp-list>

