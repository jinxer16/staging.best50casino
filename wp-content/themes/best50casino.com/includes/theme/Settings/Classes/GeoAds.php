<?php
/**
 * Created by PhpStorm.
 * User: Panos
 * Date: 30/7/2019
 * Time: 11:32 πμ
 */

namespace SettingsSpace;


class GeoAds
{
    public $countryISO;
    public $positions;
    public $legitCountriesAndRegions;
    public $translationCountries;

    /**
     * @return mixed
     */
    public function getPositions()
    {
        return $this->positions;
    }

    /**
     * @param mixed $positions
     */
    public function setPositions($positions)
    {
        $this->positions = $positions;
    }

    /**
     * @return mixed
     */
    public function getCountryISO()
    {
        return $this->countryISO;
    }

    /**
     * @param mixed $countryISO
     */
    public function setCountryISO($countryISO)
    {
        $this->countryISO = $countryISO;
    }

    /**
     * @return mixed
     */
    public function getLegitCountriesAndRegions()
    {
        return $this->legitCountriesAndRegions;
    }

    /**
     * @param mixed $legitCountriesAndRegions
     */
    public function setLegitCountriesAndRegions($legitCountriesAndRegions)
    {
        $this->legitCountriesAndRegions = $legitCountriesAndRegions;
    }

    /**
     * @return mixed
     */
    public function getTranslationCountries()
    {
        return $this->translationCountries;
    }

    /**
     * @param mixed $translationCountries
     */
    public function setTranslationCountries($translationCountries)
    {
        $this->translationCountries = $translationCountries;
    }

    public function __construct($args)
    {
        $this->setCountryISO($args);
        $this->setPositions([
            'lskin' => 'Left Skin',
            'rskin' => 'Right Skin',
            'lsidebar' => 'Left Sidebar',
            'rsidebar' => 'Right Sidebar',
        ]);
        $translatedCountries = \WordPressSettings::getCountryEnabledSettingsWithNames();
        $this->setTranslationCountries($translatedCountries);
    }

    private function setAdPositions(){
        if($this->settingsType=='countries'){

        }elseif($this->settingsType=='casino'){
            $this->positions =  [
                'lskin' => 'Left Skin',
                'rskin' => 'Right Skin',
            ];
        }
    }

    private function saveButton()
    {
        $countriesArray = $this->translationCountries;
        $ret = '<button href="javascript:void(0)" class="btn btn-sm btn-secondary" data-settingsType="countries" data-settingsCountry="'.$this->countryISO.'" onclick="saveSettings(event,this)">Save Ads for '. ucwords($countriesArray[$this->countryISO]).'</button>';
        return $ret;
    }

    private function advertRow($positionID, $positionName)
    {
        $settings = get_option('geoAds-'.$this->countryISO);
        $imageValue = $settings[$positionID]['image'];
        $affValue = $settings[$positionID]['aff_url'];
        $scriptValue = $settings[$positionID]['script'];
        $img_onValue = $settings[$positionID]['img_on'];
        ob_start();?>
        <div class="d-flex form-inline imArow p-1 border-bottom border-dark  mb-1">
            <label class="justify-content-start w-10"><?=$positionName?></label>
            <div class="mr-1 d-flex flex-wrap">
                <input type="text"
                       class="form-control form-control-sm mr-1 w-50 image-field"
                       placeholder="Logo/Flag/Image"
                       name="geoAds-<?=$this->countryISO?>[<?=$positionID?>][image]"
                       id="geoAds-<?=$this->countryISO?>[<?=$positionID?>][image]"
                       value="<?=$imageValue?>"/>
                <input data-id="geoAds-<?=$this->countryISO?>[<?=$positionID?>][image]"
                       type="button"
                       class="button-primary media-upload w-25"
                       value="Insert Image"/>
                <input type="text"
                       class="form-control form-control-sm mr-1 w-100"
                       placeholder="Affiliate"
                       name="geoAds-<?=$this->countryISO?>[<?=$positionID?>][aff_url]"
                       id="geoAds-<?=$this->countryISO?>[<?=$positionID?>][aff_url]"
                       value="<?=$affValue?>"/>
            </div>
            <textarea
                name="geoAds-<?=$this->countryISO?>[<?=$positionID?>][script]"
                class="w-25 script-field"
                id="geoAds-<?=$this->countryISO?>[<?=$positionID?>][script]"
                placeholder="Script"><?=esc_html(stripslashes($scriptValue))?></textarea>
            <label class="mr-1 justify-content-start font-weight-bold pl-3">Image?</label>
            <?php $checked = $img_onValue == 1 ? 'checked' : ''; ?>
            <input <?=$checked?>
            type="checkbox"
            class="form-control form-control-sm mr-1 image-option-on"
            data-name="repeat"
            name="geoAds-<?=$this->countryISO?>[<?=$positionID?>][img_on]"
            id="geoAds-<?=$this->countryISO?>[<?=$positionID?>][img_on]"
            value="1"/>
            <a href="#preview<?=$this->countryISO?>-geoAds<?=$positionID?>image"
               data-toggle="collapse" role="button"
               aria-expanded="false">Toggle Ad</a>
        </div>
        <div class="image-preview mr-1 collapse w-100"
                 id="preview<?=$this->countryISO?>-geoAds<?=$positionID?>image"
                 data-source="geoAds-<?=$this->countryISO?>[<?=$positionID?>][image]">
            <?php
        if (isset($settings[$positionID]['img_on']) && $settings[$positionID]['img_on'] == 1 || ($imageValue && !$scriptValue)) {
            ?>
            <img src="<?=$imageValue?>" class="img-responsive" style="max-height: 90px;">
            <?php
        } else {
            if(strpos($scriptValue, 'document.write') !== false){
                esc_html($scriptValue);
            }else{
                stripslashes($scriptValue);
            }
        }
        ?>
        </div>
            <?php
        return ob_get_clean();
    }
    private function showAds(){
        $positions = $this->positions;
        $ret = '';
        foreach ($positions as $positionID=>$positionName){
            $ret .= $this->advertRow($positionID,$positionName);
        }
        return $ret;
    }
    public static function loadAds($args)
    {
        $instance = new GeoAds($args);
        $ret = $instance->showAds();
        $ret .= $instance->saveButton();
        return $ret;
    }
    public static function saveAds($settingscountry,$settingsArray)
    {
        $positionsArray = ['lsidebar','rsidebar','lskin','rskin'];
        $input = [];
        $saveData = [];
        foreach($positionsArray as $position){
           if(isset($settingsArray[$position.'_image'])) $input[$position]['image'] = $settingsArray[$position.'_image'];
           if(isset($settingsArray[$position.'_script'])) $input[$position]['script'] = $settingsArray[$position.'_script'];
           if(isset($settingsArray[$position.'_affiliate'])) $input[$position]['aff_url'] = $settingsArray[$position.'_affiliate'];
           if(isset($settingsArray[$position.'_img_on'])) $input[$position]['img_on'] = $settingsArray[$position.'_img_on'];
        }

        if(!empty($input)){
            $saveData['geoAds-'.$settingscountry] = $input;
            update_option('geoAds-'.$settingscountry, $input);
            return $input;
        }else{
            return 'Input Empty';
        }
    }

}