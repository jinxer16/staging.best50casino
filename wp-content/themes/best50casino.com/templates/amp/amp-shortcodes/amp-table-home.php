<amp-list height="800"
          layout="fixed-height"
          src="https://www.best50casino.com/wp-content/themes/best50casino.com/templates/amp/amp-shortcodes/json/amp-casino-list.php?country=AMP_GEO(ISOCountry)&id=<?= $post->ID ?>&shortcodeType=home&atts=<?=htmlentities($matches[0][0])?>"
          binding="no"
             class="list-striped">
    <template type="amp-mustache">
        <div class="p-5p w-100 d-flex flex-wrap align-items-center justify-content-center border border-light-grey mb-5p">
             <div class="w-50 d-flex">
                 <a href="{{permalink}}" class="w-100 text-center">
                 <amp-img width="90" height="60" class="rounded-5"
                          src="{{img}}"></amp-img>
                 </a>
             </div>
            <div class="w-50 text-center text-13">
                {{name}}
            </div>
            <div class="w-50 text-center d-flex flex-column">
                <span class="text-primary text-13">{{rating.number}}</span>
                <span class="text-secondary">
                    <amp-img width="10" height="10"
                             src="{{rating.star1}}"></amp-img>
                    <amp-img width="10" height="10"
                             src="{{rating.star2}}"></amp-img>
                    <amp-img width="10" height="10"
                             src="{{rating.star3}}"></amp-img>
                    <amp-img width="10" height="10"
                             src="{{rating.star4}}"></amp-img>
                    <amp-img width="10" height="10"
                             src="{{rating.star5}}"></amp-img>
                </span>
                <a class="text-primary text-13" href="{{permalink}}">Review</a>
            </div>
            <div class="w-50 text-center">
                <a class="btn bg-yellow p-10p pl-35p pr-35p font-weight-bold" href="" rel="nofollow" target="_blank">Play Now</a>
            </div>
        </div>
    </template>
</amp-list>
