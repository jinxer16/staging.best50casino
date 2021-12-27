<?php
if (is_singular( 'kss_casino' )) { ?>
<amp-list height="340" layout="fixed-height"
          src="https://www.best50casino.com/wp-content/themes/best50casino.com/templates/amp/amp-casino/json/bonus/bonus-info.php?country=AMP_GEO(ISOCountry)&id=<?= $post->ID; ?>"
          binding="no">
    <?php
    }else{
    ?>
    <amp-list height="340"
              layout="fixed-height"
              src="https://www.best50casino.com/wp-content/themes/best50casino.com/templates/amp/amp-casino/json/bonus/bonus-info.php?country=AMP_GEO(ISOCountry)&id=<?= $bookieid; ?>"
              binding="no">
    <?php
    }
?>
<template type="amp-mustache">
<div class="widget2" id="bestCasinos">
    <span class="widget2-heading text-whitte p-7p font-weight-bold text-18 mb-2p w-100 d-block mt-0 bg-dark text-left"> Best Casinos</span>
    {{#premium_casinos}}
        <div class="p-10p d-flex flex-wrap" style="border: 1px solid #bfbfbfe0; background: #f1f1f1;">
            <div class="w-30 position-relative">
                <a class="" href="{{link}}">
                    <amp-img src="{{image}}" class="img-fluid rounded" alt="{{name}}" height="60" width="100"></amp-img>
                <div style="width: 57px; height: 62px; z-index: 1;" class="ribbon best-casino position-absolute left-0 right-0 top-0 overflow-hidden text-left {{exclusive}} 5"><span class="ribbonclass-exclusive text-10 font-weight-bold text-whitte text-center d-block position-absolute" style="background: #990d0d;line-height: 20px; transform: rotate(-45deg);-webkit-transform: rotate(-45deg); top: 3px;left: -18px;box-shadow: 0 3px 5px -3px #000;width: 57px;"><i class="fa fa-star" aria-hidden="true" style="color:#fff;font-size:11px;"></i></span></div>
                </a>
            </div>
            <div class="w-50 position-relative d-flex flex-column pt-7p text-center align-self-center">
                <span class="font-weight-bold">{{cta}}</span>
                <span class="">{{cta2}}</span>

            </div>
            <div class="w-20 align-self-center">
                <a class="btn bumper bg-yellow text-15 w-sm-100 d-block p-5p text-decoration-none btn_large rounded text-center text-black font-weight-bold"  data-casinoid="<?php echo $post->ID;?>" data-country="{{0.ISO}}"  href="{{afflink}}" rel="nofollow" target="_blank" rel="nofollow" target="_blank">
                    <span>VISIT</span></a>
            </div>
        </div>
    {{/premium_casinos}}
</div>
</template>
</amp-list>