<?php
function getComparisonCardEmpty(){
    ob_start();
?>
    <div class="w-100" style="background: grey;filter: grayscale(100);">
        <img class="stamp img-fluid w-100" style="height: 140px;opacity:0.2;"
          src="/wp-content/themes/best50casino.com/assets/images/stamp_b.svg" loading="lazy">
        <div class="d-flex flex-column text-white text-center" style="background: rgb(2,1,19);
                                background: linear-gradient(90deg, rgba(2,1,19,1) 0%, rgba(47,47,55,1) 48%, rgba(0,0,0,1) 100%);">
            <span class="text-17">-</span>
            <span class="font-weight-bold text-sm-15 text-23">-</span>
        </div>
    </div>
    <div class="d-flex flex-column w-100">
        <div class="text-16 text-sm-13 text-info text-center bg-gradient-grey border-bottom border-top border-darkish p-sm-5p p-10p">
            Rating
        </div>
        <div class="text-center w-100 p-10p">
            <canvas id="rating" width="100" height="100" class="rating-circle" data-completeness="0"></canvas>
        </div>
        <div class="d-flex flex-column text-center w-100 bg-gradient-grey border-bottom border-top border-darkish">
            <span class="text-16 text-sm-13 text-info ">Bonus Percentage</span>
            <span class="font-weight-bold text-sm-15 text-21 text-dark" >-</span>
        </div>
        <div class="d-flex flex-column text-center w-100 pt-5p pb-5p">
            <span class="text-16 text-sm-13 text-info ">Minimum Deposit</span>
            <span class="font-weight-bold text-21 text-sm-15 text-dark">-</span>
        </div>
        <div class="d-flex flex-column text-center w-100 bg-gradient-grey border-bottom border-top border-darkish pt-5p pb-5p">
            <span class="text-16 text-sm-13 text-info ">Rollover</span>
            <span class="font-weight-bold text-sm-15 text-21 text-dark">-</span>
        </div>
        <div class="d-flex flex-column text-center w-100 pt-5p pb-5p" >
            <span class="text-16 text-sm-13 text-info">Apps</span>
            <span class="font-weight-bold text-sm-15 text-21 text-dark">-</span>
        </div>
    </div>
    <div class="w-100">
        <div class="d-flex flex-column text-white text-center p-sm-10p p-15p" style="background: grey;filter: grayscale(100);">
            <a class="btn bumper text-sm-13 btn bnt-disabled btn bg-yellow rounded text-15 w-90 m-auto d-block p-sm-5p p-7p btn_large  bumper font-weight-bold text-decoration-none "
               style="box-shadow: 0 5px 15px rgba(145, 92, 182, .4);" rel="nofollow" >
                Visit</a>

        </div>
    </div>
    <?php
    return ob_get_clean();
}
function getComparisonCardFilled($id){
    $casinoBonusPage = get_post_meta($id, 'casino_custom_meta_bonus_page', true);
    $bonusISO = get_bonus_iso($casinoBonusPage);
    $bonusName = get_post_meta($casinoBonusPage, 'bonus_custom_meta_bonus_offer', true);
    ob_start();
    ?>
    <div class="w-100" data-name="<?=get_the_title($id)?>">
        <a href="<?=get_the_permalink($id)?>"><img class="stamp img-fluid w-100" style="height: 140px;"
             src="<?php echo get_the_post_thumbnail_url($id); ?>"></a>
        <div class="d-flex flex-column text-white text-center" style="background: rgb(2,1,19);
                                background: linear-gradient(90deg, rgba(2,1,19,1) 0%, rgba(47,47,55,1) 48%, rgba(0,0,0,1) 100%);">
            <span class="text-17">Welcome Bonus</span>
            <span class="font-weight-bold text-sm-15 text-23"><?=get_post_meta($bonusName, $bonusISO."bs_custom_meta_promo_amount", true)?get_post_meta($bonusName, $bonusISO."bs_custom_meta_promo_amount", true):'-'?></span>
        </div>
    </div>
    <div class="d-flex flex-column w-100">
        <div class="text-16 text-sm-13 text-info text-center bg-gradient-grey border-bottom border-top border-darkish p-sm-5p p-10p">
            Rating
        </div>
        <div class="text-center w-100 p-10p">
            <canvas id="rating" width="100" height="100" class="rating-circle" data-completeness="<?php echo get_post_meta($id, 'casino_custom_meta_sum_rating', true)*10;?>"></canvas>
        </div>
        <div class="d-flex flex-column text-center w-100 bg-gradient-grey border-bottom border-top border-darkish">
            <span class="text-16 text-sm-13 text-info ">Bonus Percentage</span>
            <span class="font-weight-bold text-21 text-sm-15 text-dark" ><?=get_post_meta($bonusName, $bonusISO."bs_custom_meta_bc_perc", true)?get_post_meta($bonusName, $bonusISO."bs_custom_meta_bc_perc", true):'-';?></span>
        </div>
        <div class="d-flex flex-column text-center w-100 pt-5p pb-5p">
            <span class="text-16 text-info text-sm-13">Minimum Deposit Over</span>
            <span class="font-weight-bold text-21 text-sm-15 text-dark"><?=get_post_meta($id, 'casino_custom_meta_min_dep', true);?></span>
        </div>
        <div class="d-flex flex-column text-center w-100 bg-gradient-grey border-bottom border-top border-darkish pt-5p pb-5p">
            <span class="text-16 text-info text-sm-13">Rollover</span>
            <span class="font-weight-bold text-sm-15 text-21 text-dark">
                                <?php
                                $D = get_post_meta($bonusName, $bonusISO."bs_custom_meta_wag_d", true) ? '<i class="fa fa-credit-card" aria-hidden="true" data-toggle="tooltip" title="Deposit" style="color:#29bf29;padding-right:1px;"></i>' . get_post_meta($bonusName, $bonusISO."bs_custom_meta_wag_d", true) : '';
                                $B = get_post_meta($bonusName, $bonusISO."bs_custom_meta_wag_b", true) ? '<i class="fa fa-gift" aria-hidden="true" data-toggle="tooltip" title="Bonus" style="color:#2da9f6;padding-left:3px;padding-right:1px;font-size: 1.3em;"></i>' . get_post_meta($bonusName, $bonusISO."bs_custom_meta_wag_b", true) : '';
                                $S = get_post_meta($bonusName, $bonusISO."bs_custom_meta_wag_s", true) ? '<i class="fa fa-refresh" aria-hidden="true" data-toggle="tooltip" title="Spins" style="color:orange;padding-left:3px;padding-right:1px;"></i>' . get_post_meta($bonusName, $bonusISO."bs_custom_meta_wag_s", true) : '';
                                if (get_post_meta($bonusName, $bonusISO."bs_custom_meta_wag_d", true) == get_post_meta($bonusName, $bonusISO."bs_custom_meta_wag_b", true)) {
                                    $D = '<i class="fa fa-credit-card" aria-hidden="true" data-toggle="tooltip" title="Deposit" style="color:#29bf29;padding-right:1px;"></i> + <i class="fa fa-gift" aria-hidden="true" data-toggle="tooltip" title="Bonus" style="color:#2da9f6;padding-left:3px;padding-right:1px;font-size: 1.3em;"></i>' . get_post_meta($bonusName, $bonusISO."bs_custom_meta_wag_b", true);
                                    $B = '';
                                }
                                echo $D . '' . $B . '' . $S;
                                ?>
                            </span>
        </div>
        <div class="d-flex flex-column text-center w-100 pt-5p pb-5p" >
            <span class="text-16 text-sm-15 text-info">Apps</span>
            <?php
            $platforms = get_post_meta($id, 'casino_custom_meta_platforms', true);
            if($platforms) {
                $platformsArray = array('apple' => 'iPhone App', 'android' => 'Android App', 'windows' => 'Windows Phone App', 'download' => 'Casino Download',); ?>
                <div class="d-flex justify-content-center">
                <?php foreach ($platforms as $platform) {
                    echo '<b class="mr-15p text-20 text-sm-15 text-dark mb-0"><i class="fa fa-' . $platform . ' " aria-hidden="true"  data-toggle="tooltip" title="' . $platformsArray[$platform] . '"></i></b>';
                }
                ?>
                </div>
                <?php
            }else{
                echo "<span class=\"font-weight-bold text-21 text-sm-15 text-dark\">-</span>";
            }?>
        </div>
    </div>
    <?php $restricted =  @array_flip(get_post_meta($id, 'casino_custom_meta_rest_countries', true));
    if(isset($restricted[$GLOBALS['visitorsISO']])){
        $btnClass='disabled';
    }else{
        $btnClass='';
    }?>
    <div class="w-100">
        <div class="d-flex flex-column text-white text-center p-sm-10p p-15p" style="background: rgb(2,1,19);
                                background: linear-gradient(90deg, rgba(2,1,19,1) 0%, rgba(47,47,55,1) 48%, rgba(0,0,0,1) 100%);">
            <a class="btn bg-yellow rounded text-15 text-sm-13 p-sm-5p w-90 m-auto d-block p-7p btn_large bumper font-weight-bold text-decoration-none text-dark" <?=$btnClass?>
               style="box-shadow: 0 5px 15px rgba(145, 92, 182, .4);" href="<?=get_post_meta($id,'casino_custom_meta_affiliate_link_review',true)?>" rel="nofollow"
               target="_blank"><span>
                Visit <?= get_the_title($id); ?></span></a>

        </div>
    </div>
    <?php
    return ob_get_clean();
}
function compareCasino($id)
{
    ob_start();
    ?>
    <div class="section-comparison mb-10p d-flex flex-wrap shadow-box  mt-10p" id="compare">
        <span class="widget2-new-heading mt-20p mb-10p text-left w-100 text-left">Compare Against Other Casinos</span>
        <div class="form-row w-100 mb-10p pl-5p" style="z-index: 1;">
            <div class="mr-5p pl-5p mb-sm-10p w-sm-100 position-relative z-11">
                <div class="more-casinos w-sm-100 bg-dark text-white d-flex align-items-center p-5p rounded-5 cursor-point pr-10p" data-target="#more-casinos-list" data-toggle="collapse">
                <?php if (wp_is_mobile()){
                    ?>
                   <span class="d-flex w-100 justify-content-center"><i class="fa fa-search text-center d-block mr-5p" style="font-size: 21px !important;"></i> More Casinos</span>
                    <?php
                }else{
                    ?>
                    <i class="fa fa-search text-center d-block mr-5p" style="font-size: 32px !important;"></i> More<br>Casinos
                    <?php
                }
                ?>
                </div>
                <div class="collapse position-absolute mt-5p" id="more-casinos-list">
                    <input class="form-control form-control-sm searchField bg-dark text-white"
                           data-targetid="#listCasino .searchme" type="text" placeholder="Search Casino by Name...">
                    <?php $allCasinos = get_all_published('kss_casino'); ?>
                    <div class="d-flex flex-wrap p-5p w-100 overflow-y-scroll bg-dark" id="listCasino"
                        style="max-height: 280px;overflow-y: scroll;">
                        <?php
                        foreach ($allCasinos as $casinoID) {
                            if($casinoID!==$id) {
                                ?>
                                <div class="searchme p-5p text-white cursor-point hover-primary w-100 pickme white-no-wrap"
                                     data-filter="<?= get_the_title($casinoID) ?>"
                                     data-filterid="<?= $casinoID ?>"><?= get_the_title($casinoID) ?></div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>

            </div>
            <?php $premiumCasino = WordPressSettings::getPremiumCasino($GLOBALS['countryISO'], 'premium');
            $premiumCasino = explode(",", $premiumCasino);
                if (wp_is_mobile()) {
                    $premiumCasino = array_slice($premiumCasino, 0, 4);
                }else{
                    $premiumCasino = array_slice($premiumCasino, 0, 5);
                }
            foreach ($premiumCasino as $premID) {
                if($premID!=$id) {
                    ?>
                    <div class="border w-sm-47 compare-titles border-dark text-dark d-flex flex-column align-items-center justify-content-center p-5p rounded-5 cursor-point pickme mr-5p"
                         data-filter="<?= get_the_title($premID) ?>" data-filterid="<?= $premID ?>">
                        <i class="far fa-plus-square mr-5p"></i> <?= get_the_title($premID) ?>
                    </div>
                    <?php
                }
            } ?>
        </div>
        <div class="comparison-area container">

            <div class="row flex-wrap d-flex">
                <?php if (wp_is_mobile()){
                    ?>
                <div class="col-6 p-sm-5p comparison-position-1">
                    <?=getComparisonCardFilled($id)?>
                </div>
                <div class="col-6 p-sm-5p comparison-position-2" data-filled="false">
                    <?=getComparisonCardEmpty()?>
                </div>
                    <?php
                }else{
                    ?>
                    <div class="col-4 comparison-position-1">
                        <?=getComparisonCardFilled($id)?>
                    </div>
                    <div class="col-4 comparison-position-2" data-filled="false">
                        <?=getComparisonCardEmpty()?>
                    </div>
                      <div class="col-4 comparison-position-3" data-filled="false">
                        <?=getComparisonCardEmpty()?>
                    </div>
                  <?php
                }
              ?>

            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_action('wp_ajax_nopriv_placeCasinoInComparison', 'placeCasinoInComparison');
add_action('wp_ajax_placeCasinoInComparison', 'placeCasinoInComparison');
function placeCasinoInComparison(){
    $id = $_GET['casino'];
    $ret = getComparisonCardFilled($id);
    echo $ret;
    die();
}


function AMPgetComparisonCardEmpty($listID=null)
{
    ob_start();
    ?>
    <amp-list height="555.7"
              layout="fixed-height"
              [src]="srcUrl"
              id="<?=$listID?>"
              src="/wp-content/themes/best50casino.com/templates/amp/amp-common/comparison-json.php?type=casinoComparison&country=AMP_GEO(ISOCountry)&id=-"
              binding="no">
        <template type="amp-mustache">
            <div class="w-100 card-{{enabled}}">
                <a href="{{reviewLink}}?amp"><amp-img class="stamp img-fluid w-100" layout="responsive"
                         height="100"
                         width="150"
                         src="{{img}}"
                    ></amp-img></a>
                <div class="d-flex flex-column text-whitte text-center" style="background: rgb(2,1,19);
                                background: linear-gradient(90deg, rgba(2,1,19,1) 0%, rgba(47,47,55,1) 48%, rgba(0,0,0,1) 100%);">
                    <span class="text-12">Welcome Bonus</span>
                    <span class="font-weight-bold text-23" style="min-height: 24px;">{{bonusAmount}}</span>
                </div>
            </div>
            <div class="d-flex flex-column w-100">
                <div class="text-12 text-info text-center bg-gradient-grey border-bottom border-top border-darkish p-10p">
                    Rating
                </div>
                <div class="text-center w-100 p-10p">
                    <div class="w-100 mb-10p p-5 align-self-center circle-progress">
                        <?php
                            $sum = 0;
                            $percentageright = 0;
                            $percentageleft = 0;
                        ?>

                        <div class="progress position-relative d-block mx-auto" data-total='{{sum}}'
                             style="width: 80px; height: 80px;">
                                    <span class="progress-left left-0 position-absolute overflow-hidden h-100 w-50 top-0">
                                        <span class="progress-bar w-100 h-100 border-secondary position-absolute top-0"
                                              style="transform: rotate({{r_l}}deg);"></span>
                                        </span>
                            <span class="progress-right right-0 position-absolute overflow-hidden h-100 w-50 top-0">
                                         <span class="progress-bar w-100 h-100 border-secondary position-absolute top-0"
                                               style="transform: rotate({{r_r}}deg);"></span>
                                      </span>
                            <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center position-absolute left-0 top-0 justify-content-center">
                                <div class="d-flex flex-column text-dark valyeper position-relative  h-100  rounded-circle"
                                     style="left: 1%;width: 96%;background-color: #e8e9eb;">
                            <span class="text-center font-weight-thick mb-0 text-15"
                                  style="margin-top:30px;">{{number}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column text-center w-100 bg-gradient-grey border-bottom border-top border-darkish">
                    <span class="text-12 text-info ">Bonus Percentage</span>
                    <span class="font-weight-bold text-21 text-dark" style="min-height: 24px;">{{bonusPerc}}</span>
                </div>
                <div class="d-flex flex-column text-center w-100 pt-5p pb-5p">
                    <span class="text-12 text-info ">Minimum Deposit</span>
                    <span class="font-weight-bold text-21 text-dark">{{minDep}}</span>
                </div>
                <div class="d-flex flex-column text-center w-100 bg-gradient-grey border-bottom border-top border-darkish pt-5p pb-5p">
                    <span class="text-12 text-info ">Rollover</span>
                    <span class="font-weight-bold text-21 text-dark" style="min-height: 44px;">
                        {{#double}}
                           <i class="fa fa-credit-card" aria-hidden="true" data-toggle="tooltip" title="Deposit"
                              style="color:#29bf29;padding-right:1px;"></i> + <i class="fa fa-gift"
                                                                                 aria-hidden="true" data-toggle="tooltip" title="Bonus"
                                                                                 style="color:#2da9f6;padding-left:3px;padding-right:1px;font-size: 1.3em;"></i> {{double}} <br>
                        {{/double}}
                        {{#wag_d}}
                            <i class="fa fa-credit-card" aria-hidden="true" data-toggle="tooltip" title="Deposit" style="color:#29bf29;padding-right:1px;"></i> {{wag_d}}
                        {{/wag_d}}
                        {{#wag_b}}
                            <i class="fa fa-gift" aria-hidden="true" data-toggle="tooltip" title="Bonus"
                               style="color:#2da9f6;padding-left:3px;padding-right:1px;font-size: 1.3em;"></i> {{wag_b}}
                        {{/wag_b}}
                        {{#wag_s}}
                           <i class="fa fa-refresh" aria-hidden="true" data-toggle="tooltip" title="Spins" style="color:orange;padding-left:3px;padding-right:1px;"></i> {{wag_s}}
                        {{/wag_s}}
                    </span>
                </div>
                <div class="d-flex flex-column text-center w-100 pt-5p pb-5p">
                    <span class="text-12 text-info">Apps</span>
                    <span class="font-weight-bold text-21 text-dark">
                        {{#platforms}}
                            <b class="mr-15p text-20 text-dark mb-0"><i class="fa fa-{{code}} " aria-hidden="true"  data-toggle="tooltip" title="{{name}}"></i></b>
                        {{/platforms}}
                    </span>
                </div>
            </div>
            <div class="w-100">
                <div class="d-flex flex-column text-white text-center p-5p card-{{enabled}}" style="background: rgb(2,1,19);
                                background: linear-gradient(90deg, rgba(2,1,19,1) 0%, rgba(47,47,55,1) 48%, rgba(0,0,0,1) 100%);">
                    <a class="btn btn bg-yellow rounded text-11 text-dark w-95 m-auto d-block p-7p btn_large font-weight-bold"
                       style="box-shadow: 0 5px 15px rgba(145, 92, 182, .4);" rel="nofollow" target="_blank" href="{{aff}}">
                        {{cta}}</a>

                </div>
            </div>
        </template>
    </amp-list>
    <?php
    return ob_get_clean();
}

function AMPgetComparisonCardFilled($id)
{

    ob_start();
    ?>
    <div class="w-100" data-name="<?= get_the_title($id) ?>">
        <amp-img class="stamp img-fluid w-100" layout="responsive"
                 height="100"
                 width="150"
                 src="<?php echo get_the_post_thumbnail_url($id); ?>"></amp-img>
        <div class="d-flex flex-column text-whitte text-center" style="background: rgb(2,1,19);
                                background: linear-gradient(90deg, rgba(2,1,19,1) 0%, rgba(47,47,55,1) 48%, rgba(0,0,0,1) 100%);">
            <span class="text-12">Welcome Bonus</span>
            <amp-list height="24" layout="fixed-height" src="/wp-content/themes/best50casino.com/templates/amp/amp-common/comparison-json.php?type=comparisonData&country=AMP_GEO(ISOCountry)&id=<?= $id ?>" binding="no">
                <template type="amp-mustache">
                    <span class="font-weight-bold text-23">{{bonusAmount}}</span>
                </template>
            </amp-list>
        </div>
    </div>

    <div class="d-flex flex-column w-100">
        <div class="text-12 text-info text-center bg-gradient-grey border-bottom border-top border-darkish p-10p">
            Rating
        </div>
        <div class="text-center w-100 p-10p">
            <div class="w-100 mb-10p p-5 align-self-center circle-progress">
                <?php
                $sum = (get_post_meta($id, 'casino_custom_meta_sum_rating', true) * 10);
                if ($sum <= 50) {
                    $percentageleft = 0;
                    $percentageright = ($sum / 100 * 360);
                } else {
                    $percentageright = 180;
                    $percentageleft = (($sum - 50) / 100 * 360);
                }
                ?>

                <div class="progress position-relative d-block mx-auto" data-total='<?= $sum; ?>'
                     style="width: 80px; height: 80px;">
                                    <span class="progress-left left-0 position-absolute overflow-hidden h-100 w-50 top-0">
                                        <span class="progress-bar w-100 h-100 border-secondary position-absolute top-0"
                                              style="transform: rotate(<?= $percentageleft; ?>deg);"></span>
                                        </span>
                    <span class="progress-right right-0 position-absolute overflow-hidden h-100 w-50 top-0">
                                         <span class="progress-bar w-100 h-100 border-secondary position-absolute top-0"
                                               style="transform: rotate(<?= $percentageright; ?>deg);"></span>
                                      </span>
                    <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center position-absolute left-0 top-0 justify-content-center">
                        <div class="d-flex flex-column text-dark valyeper position-relative  h-100  rounded-circle"
                             style="left: 1%;width: 96%;background-color: #e8e9eb;">
                            <span class="text-center font-weight-thick mb-0 text-15"
                                  style="margin-top:30px;"><?= round($sum)/10; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="d-flex flex-column text-center w-100 bg-gradient-grey border-bottom border-top border-darkish">
        <span class="text-12 text-info ">Bonus Percentage</span>
        <amp-list height="24" layout="fixed-height" src="/wp-content/themes/best50casino.com/templates/amp/amp-common/comparison-json.php?type=comparisonData&country=AMP_GEO(ISOCountry)&id=<?= $id ?>" binding="no">
            <template type="amp-mustache">
                <span class="font-weight-bold text-21 text-dark">{{bonusPerc}}</span>
            </template>
        </amp-list>
    </div>
    <div class="d-flex flex-column text-center w-100 pt-5p pb-5p">
        <span class="text-12 text-info ">Minimum Deposit</span>
        <span class="font-weight-bold text-21 text-dark"><?= get_post_meta($id, 'casino_custom_meta_min_dep', true); ?></span>
    </div>
    <div class="d-flex flex-column text-center w-100 bg-gradient-grey border-bottom border-top border-darkish pt-5p pb-5p">
        <span class="text-12 text-info ">Rollover</span>
        <amp-list height="44" layout="fixed-height" src="/wp-content/themes/best50casino.com/templates/amp/amp-common/comparison-json.php?type=comparisonData&country=AMP_GEO(ISOCountry)&id=<?= $id ?>" binding="no">
            <template type="amp-mustache">
        <span class="font-weight-bold text-21 text-dark">
            {{#double}}
               <i class="fa fa-credit-card" aria-hidden="true" data-toggle="tooltip" title="Deposit"
                  style="color:#29bf29;padding-right:1px;"></i> + <i class="fa fa-gift"
                                                                     aria-hidden="true" data-toggle="tooltip" title="Bonus"
                                                                     style="color:#2da9f6;padding-left:3px;padding-right:1px;font-size: 1.3em;"></i> {{double}} <br>
            {{/double}}
            {{#wag_d}}
                <i class="fa fa-credit-card" aria-hidden="true" data-toggle="tooltip" title="Deposit" style="color:#29bf29;padding-right:1px;"></i> {{wag_d}}
            {{/wag_d}}
            {{#wag_b}}
                <i class="fa fa-gift" aria-hidden="true" data-toggle="tooltip" title="Bonus"
                   style="color:#2da9f6;padding-left:3px;padding-right:1px;font-size: 1.3em;"></i> {{wag_b}}
            {{/wag_b}}
            {{#wag_s}}
               <i class="fa fa-refresh" aria-hidden="true" data-toggle="tooltip" title="Spins" style="color:orange;padding-left:3px;padding-right:1px;"></i> {{wag_s}}
            {{/wag_s}}

        </span>
            </template>
        </amp-list>
    </div>
    <div class="d-flex flex-column text-center w-100 pt-5p pb-5p">
        <span class="text-12 text-info">Apps</span>
        <?php
        $platforms = get_post_meta($id, 'casino_custom_meta_platforms', true);
        if ($platforms) {
            $platformsArray = array('apple' => 'iPhone App', 'android' => 'Android App', 'windows' => 'Windows Phone App', 'download' => 'Casino Download',); ?>
            <div class="d-flex justify-content-center">
                <?php foreach ($platforms as $platform) {
                    echo '<b class="mr-15p text-20 text-dark mb-0"><i class="fa fa-' . $platform . ' " aria-hidden="true"  data-toggle="tooltip" title="' . $platformsArray[$platform] . '"></i></b>';
                }
                ?>
            </div>
            <?php
        } else {
            echo "<b class=\"mr-15p text-20 text-dark mb-0\"><span class=\"font-weight-bold text-21 text-dark\"><i class=\"fa fa-minus\" aria-hidden=\"true\"></i></span></b>";
        } ?>
    </div>
    <div class="w-100">
        <div class="d-flex flex-column text-white text-center p-5p" style="background: rgb(2,1,19);
                                background: linear-gradient(90deg, rgba(2,1,19,1) 0%, rgba(47,47,55,1) 48%, rgba(0,0,0,1) 100%);">
            <a class="btn bg-yellow rounded text-11 w-95 m-auto d-block text-decoration-none p-7p btn_large text-dark bumper font-weight-bold"
               style="box-shadow: 0 5px 15px rgba(145, 92, 182, .4);"
               href="<?= get_post_meta($id, 'casino_custom_meta_affiliate_link_review', true) ?>" rel="nofollow"
                target="_blank">
                <span>
                Visit <?= get_the_title($id); ?>
                </span>
            </a>
        </div>
    </div>
    <?php
    return ob_get_clean();
}