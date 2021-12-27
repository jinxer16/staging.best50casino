<div class="section-withdrawls mt-10p mb-10p">
    <?php $sectionHeadingState = get_post_meta($post->ID, 'casino_custom_meta_heading_state_pay', true);
    if ($sectionHeadingState == '') {
        $sectionHeadingState = 'span';
    }
    $sectionHeading = get_post_meta($post->ID, 'casino_custom_meta_heading_pay', true);
    if (!empty($sectionHeading)){
    ?>
    <a id="<?=$anchorsids[2]?>" class="position-relative text-decoration-none" style="top: -70px;"></a>
    <<?= $sectionHeadingState ?> class="widget2-new-heading text-18 pt-6p pb-6p pl-10p pr-10p font-weight-bold mb-5pw-100 d-block mt-0p text-whitte text-left"><?= $sectionHeading ?></<?= $sectionHeadingState ?>>
<?php
}
$availableMeans = get_post_meta($post->ID, 'casino_custom_meta_dep_options', true);
$leftdepo = ceil(count($availableMeans) / 6);

$availableMeanswith = get_post_meta($post->ID, 'casino_custom_meta_withd_options', true);
$leftwith = ceil(count($availableMeans) / 6);

?>
<amp-state id="items">
    <script type="application/json">
        []
    </script>
</amp-state>
<amp-selector class="tabs-with-selector" role="tablist"
              on="select:myTabPanels.toggle(index=event.targetOption, value=true)" keyboard-select-mode="focus">
    <div class="text-13 font-weight-normal pr-15p pl-15p pt-7p pb-7p mb-0p w-100 d-block text-center pointer"
         id="depo-tab" role="tab" aria-controls="depotab" option="0" selected>Deposit Methods
    </div>
    <div class="text-13 font-weight-normal pr-15p pl-15p pt-7p pb-7p mb-0p w-100 d-block text-center pointer"
         id="with-tab" role="tab" aria-controls="withtab" option="1">Withdrawals Options
    </div>
</amp-selector>

<amp-selector id="myTabPanels" class="tabpanels">
    <div id="depotab" role="tabpanel" aria-labelledby="depotab" option selected>
        <div class="d-flex flex-wrap">
            <div class="inline-hor-logo align-middle text-14  font-weight-bold text-dark p-10p text-14 numeric d-table-cell w-25"
                 style="color: #354046; background: #c7ccce;">Deposit Methods
            </div>
            <div class="inline-hor-logo align-middle text-14 font-weight-bold text-dark p-10p text-14 numeric d-table-cell w-25"
                 style="color: #354046; background: #c7ccce;">Deposit Minimum
            </div>
            <div class="inline-hor-logo align-middle text-14 font-weight-bold text-dark p-10p text-14 numeric d-table-cell w-25"
                 style="color: #354046; background: #c7ccce;">Deposit Maximum
            </div>
            <div class="inline-hor-logo align-middle text-14 font-weight-bold text-dark p-10p text-14 numeric d-table-cell w-25"
                 style="color: #354046; background: #c7ccce;">Deposit Time
            </div>
        </div>
        <amp-list height="216"
                  layout="fixed-height"
                  src="https://www.best50casino.com/wp-content/themes/best50casino.com/templates/amp/amp-casino/json/amp-payments.php?country=AMP_GEO(ISOCountry)&id=<?= $post->ID ?>&items=6&left=<?= $leftdepo ?>&type=deposits"
                  binding="refresh"
                  load-more="manual"
                  load-more-bookmark="next">
            <template type="amp-mustache">
                <div class="d-flex flex-wrap tablestripe">
                    <div class="text-center w-25 align-middle align-self-center pt-7p pb-7p">
                        <div class="d-flex flex-wrap">
                            <div class="w-40">
                                <amp-img class="img-fluid float-right" width="33" height="33" src="{{image}}"></amp-img>
                            </div>
                            <div class="w-60 m-auto text-13 text-left pl-1p">
                                {{name}}
                            </div>
                        </div>
                    </div>
                    <div class="text-center w-25 align-middle align-self-center text-13 pt-7p pb-7p">{{mindep}}</div>
                    <div class="text-center w-25 align-middle align-self-center text-13 pt-7p pb-7p">{{maxdep}}</div>
                    <div class="text-center w-25 align-middle align-self-center text-13 pt-7p pb-7p">{{deptime}}</div>
                </div>
            </template>
            <div fallback>
                FALLBACK
            </div>
            <div class="text-center" placeholder>
                <div class="text-center p-20p" style="background: aliceblue;">Loading Deposits</div>
            </div>
            <amp-list-load-more load-more-failed>
                <div class="text-center p-20p" style="background: rgba(173,0,2,0.34);">Oops something went wrong! Please refresh the page.</div>
            </amp-list-load-more>
            <amp-list-load-more load-more-end>
                <div class="text-center p-20p" style="background: aliceblue;">No More Deposit Methods</div>
            </amp-list-load-more>
        </amp-list>

    </div>
    <div id="withtab" role="tabpanel" aria-labelledby="withtab" option>
        <div class="d-flex flex-wrap">
            <div class="inline-hor-logo align-middle text-14 text-dark font-weight-bold p-10p text-14 numeric d-table-cell w-25"
                 style="color: #354046; background: #c7ccce;">Methods
            </div>
            <div class="inline-hor-logo align-middle text-14 text-dark font-weight-bold p-10p text-14 numeric d-table-cell w-25"
                 style="color: #354046; background: #c7ccce;">Minimum
            </div>
            <div class="inline-hor-logo align-middle text-14 text-dark font-weight-bold p-10p text-14 numeric d-table-cell w-25"
                 style="color: #354046; background: #c7ccce;">Maximum
            </div>
            <div class="inline-hor-logo align-middle text-14 text-dark font-weight-bold p-10p text-14 numeric d-table-cell w-25"
                 style="color: #354046; background: #c7ccce;">Payout Time
            </div>
        </div>
        <amp-list height="216"
                  layout="fixed-height"
                  src="https://www.best50casino.com/wp-content/themes/best50casino.com/templates/amp/amp-casino/json/amp-payments.php?country=AMP_GEO(ISOCountry)&id=<?= $post->ID ?>&items=6&left=<?= $leftwith ?>&type=withdrawals"
                  binding="refresh"
                  load-more="manual"
                  load-more-bookmark="nextdepo">
            <template type="amp-mustache">
                <div class="d-flex flex-wrap tablestripe">
                    <div class="text-center w-25 align-middle align-self-center pt-7p pb-7p">
                        <div class="d-flex flex-wrap">
                            <div class="w-40">
                                <amp-img class="img-fluid float-right" width="33" height="33" src="{{image}}"></amp-img>
                            </div>
                            <div class="w-60 m-auto text-left text-13 pl-1p">
                                {{name}}
                            </div>
                        </div>
                    </div>
                    <div class="text-center w-25 align-middle align-self-center text-13 pt-7p pb-7p">{{minwith}}</div>
                    <div class="text-center w-25 align-middle align-self-center text-13 pt-7p pb-7p">{{maxwith}}</div>
                    <div class="text-center w-25 align-middle align-self-center text-13 pt-7p pb-7p">{{withtime}}</div>
                </div>
            </template>
            <div fallback>
                FALLBACK
            </div>
            <div class="text-center" placeholder>
                <div class="text-center p-20p" style="background: aliceblue;">Loading Withdrawals</div>
            </div>
            <amp-list-load-more load-more-failed>
                <div class="text-center p-20p" style="background: rgba(173,0,2,0.34);">Oops something went wrong! Please refresh the page.</div>
            </amp-list-load-more>
            <amp-list-load-more load-more-end>
                <div class="text-center p-20p" style="background: aliceblue;">No More Withdrawals Methods</div>
            </amp-list-load-more>
        </amp-list>
    </div>
</amp-selector>

<div class="flex-wrap d-flex shadow-box p-5p">
    <div class="w-100 text-justify">
        <?php
        $theContent = get_post_meta($post->ID, "casino_custom_meta_payments_text", true);
        $theContent = ampizeImages($theContent);
        echo apply_filters('the_content', $theContent); ?>
    </div>
</div>
</div>