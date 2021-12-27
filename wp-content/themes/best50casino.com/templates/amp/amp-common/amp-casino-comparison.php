<a id="<?=$anchorsids[7]?>" class="position-relative text-decoration-none" style="top: -150px;"></a>
<div class="position-relative">
    <amp-list height="100" layout="fixed-height" src="https://www.best50casino.com/wp-content/themes/best50casino.com/templates/amp/amp-common/comparison-json.php?type=casinolist&country=AMP_GEO(ISOCountry)&id=<?= $post->ID ?>" binding="no">
        <template type="amp-mustache">
            <ul class="list-unstyled bg-white p-0p m-0p d-flex flex-wrap justify-content-around list-stripped-blue">
                {{#top}}
                <li role="button" tabindex="0" class="w-45 border border-dark text-dark d-flex flex-column align-items-center justify-content-center p-5p mt-2p mb-2p rounded-5 cursor-point pickme"
                    style="box-shadow: #868686b5 0px 0px 1px 1px;"
                    on="tap:AMP.setState({ srcUrl: 'https://www.best50casino.com/wp-content/themes/best50casino.com/templates/amp/amp-common/comparison-json.php?side=1&type=casinoComparison&country=AMP_GEO(ISOCountry)&id={{id}}'})">
                    <i class="fa fa-plus-square mr-5p"></i> {{name}}
                </li>
                {{/top}}
            </ul>
        </template>
    </amp-list>
    <div role="button" tabindex="0" class="z-98 mt-10p more-casinos bg-dark text-whitte d-flex align-items-center justify-content-center p-5p rounded-5 cursor-point"
         on="tap:sidebar2.toggleVisibility">
        <i class="fa fa-search text-center d-block mr-5p"></i> More Casinos
    </div>
    <div id="sidebar2" role="button" tabindex="0" class="position-absolute w-100 bg-whitte z-99" hidden>
        <i role="button" tabindex="0" class="fa fa-times-circle position-absolute text-20 right-m-5 top-m-5 z-100" on="tap:sidebar2.toggleVisibility"></i>
        <amp-list height="905" layout="fixed-height" src="https://www.best50casino.com/wp-content/themes/best50casino.com/templates/amp/amp-common/comparison-json.php?type=casinolist&country=AMP_GEO(ISOCountry)&id=<?= $post->ID ?>" binding="no">
            <template type="amp-mustache">
                    <ul class="list-unstyled bg-white p-0p mt-0p d-flex flex-wrap justify-content-around">
                        {{#all}}
                        <li role="button" tabindex="0" class="text-dark text-13 p-5p mt-2p mb-2p w-45 pointer text-center" style="box-shadow: #868686b5 0px 0px 1px 1px;" on="tap:sidebar2.toggleVisibility,AMP.setState({ srcUrl: '/wp-content/themes/best50casino.com/templates/amp/amp-common/comparison-json.php?side=1&type=casinoComparison&country=AMP_GEO(ISOCountry)&id={{id}}'})">{{name}}</li>
                        {{/all}}
                    </ul>
            </template>
        </amp-list>
    </div>
    <div class="comparison-area container mt-10p">

        <div class="row flex-wrap d-flex">
            <div class="col-6 comparison-position-1 p-1p">
                <?php
                if (is_singular( 'kss_casino' )) {
                    $idgiven = $post->ID;
                }elseif(is_singular( 'bc_bonus_page')){
                    $bookieid = get_post_meta($post->ID, 'bonus_custom_meta_bookie_offer', true);
                    $idgiven = $bookieid;
                }
                ?>
                <?=AMPgetComparisonCardFilled($idgiven)?>
            </div>
            <div class="col-6 comparison-position-2 p-1p position-relative" data-filled="false">
                <?=AMPgetComparisonCardEmpty('list1')?>
            </div>
        </div>
    </div>
</div>