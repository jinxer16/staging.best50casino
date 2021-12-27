<div id="recommended-notification" class="sample-notification">
    <i class="fa fa-times-circle position-absolute text-20 right-m-5 top-m-5 z-100" on="tap:my-notification.dismiss"></i>
    <amp-list height="905" layout="fixed-height" src="https://www.best50casino.com/wp-content/themes/best50casino.com/templates/amp/amp-common/comparison-json.php?type=casinolist&country=AMP_GEO(ISOCountry)&id=<?= $post->ID ?>" binding="no">
        <template type="amp-mustache">
            <ul class="list-unstyled bg-white p-0p d-flex flex-wrap">
                {{#all}}
                <li class="text-dark text-13 p-5p w-50 pointer" on="tap:sidebar2.toggleVisibility,AMP.setState({ srcUrl: '/wp-content/themes/best50casino.com/templates/amp/amp-common/comparison-json.php?side=1&type=casinoComparison&country=AMP_GEO(ISOCountry)&id={{id}}'})">{{name}}</li>
                {{/all}}
            </ul>
        </template>
    </amp-list>
</div>