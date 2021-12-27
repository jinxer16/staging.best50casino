<?php


namespace SettingsSpace;


class GeoAdsTemplates
{
    public function __construct()
    {

    }

    public static function printCountryList($style=null,$casinoID=null){
        ob_start();
        if($style=='compact'){
            $width = 'w-9';
            $preName = '';
            $function = '';
        }else{
            $width = 'w-49';
            $preName = 'Ads for ';
            $function = 'onclick="loadGeoAds(this)"';
        }?>
        <div class="nav nav-pills p-1" id="listCountries" role="tablist" aria-orientation="vertical">
            <?php
            $options = \WordPressSettings::getCountryEnabledSettingsWithNames();
            foreach ($options as $isoOrID=>$name) {
                if($style=='compact'){
                    $href='href="#v-pills-'.$casinoID.'-'.$isoOrID.'"';
                }else{
                    $href='';
                }
                ?>
                <a data-country="<?=$isoOrID?>"
                   <?=$function?>
                   <?=$href?>
                   class="<?=$width?> p-5p nav-link searchme country"
                   data-filter="<?=$name?>" id="v-pills-<?=$isoOrID?>-tab"
                   data-toggle="pill" href="#v-pills-<?=$isoOrID?>"
                   role="tab"
                   aria-controls="v-pills-<?=$isoOrID?>"
                   aria-selected="false"
                   data-settingsType="countries">
                        <img src="<?=get_template_directory_uri().'/assets/flags/'.$isoOrID?>.svg" width="20" class="ml-1 mr-1">
                    <?=$preName?><b><?=ucwords($name)?></b></a>
                <?php
            } ?>
        </div>
        <?php
        return ob_get_clean();
    }
    public static function printTabs($options){
        ob_start();
        ?>
        <div class="tab-content" id="v-pills-tabContent">
            <?php
            foreach ($options as $isoOrID=>$name) { ?>
                <div class="tab-pane fade" id="v-pills-<?=$isoOrID?>" role="tabpanel" aria-labelledby="v-pills-<?=$isoOrID?>-tab">
                    <h4 class="bg-dark mt-1 text-white p-1"><?=ucwords($name)?></h4>
                    <div class="tab-content">

                    </div>
                </div>
                <?php
            } ?>
        </div>
        <?
        return ob_get_clean();
    }
    public static function printCasinoList(){
        ob_start();?>
        <div class="nav nav-pills p-1" id="listCountries" role="tablist" aria-orientation="vertical">
            <?php
            $options = get_all_publishedWithNames('kss_casino');
            foreach ($options as $isoOrID=>$name) { ?>
                <a data-country="<?=$isoOrID?>"
                   onclick="loadGeoAds(this)"
                   class="w-49 p-5p nav-link searchme country"
                   data-filter="<?=$name?>" id="v-pills-<?=$isoOrID?>-tab"
                   data-toggle="pill" href="#v-pills-<?=$isoOrID?>"
                   role="tab"
                   aria-controls="v-pills-<?=$isoOrID?>"
                   aria-selected="false"
                   data-settingsType="casino">
                    Ads for <b><?=ucwords($name)?></b></a>
                <?php
            } ?>
        </div>
        <?php
        return ob_get_clean();
    }
}