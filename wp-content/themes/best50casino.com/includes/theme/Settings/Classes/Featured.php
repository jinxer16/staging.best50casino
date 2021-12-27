<?php


namespace SettingsSpace;


class Featured
{
    public $countryISO;
    private $translatedCountries;
    private $oldSettings;
    private $settings;

    /**
     * @return mixed
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * @param mixed $settings
     */
    public function setSettings($settings)
    {
        $this->settings = $settings;
    }

    /**
     * @return mixed
     */
    public function getTranslatedCountries()
    {
        return $this->translatedCountries;
    }

    /**
     * @param mixed $translatedCountries
     */
    public function setTranslatedCountries($translatedCountries)
    {
        $this->translatedCountries = $translatedCountries;
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
    public function getOldSettings()
    {
        return $this->oldSettings;
    }

    /**
     * @param mixed $oldSettings
     */
    public function setOldSettings($oldSettings)
    {
        $this->oldSettings = $oldSettings;
    }

    public function __construct($args)
    {
        $this->setCountryISO($args);
        $translatedCountries = \WordPressSettings::getCountryEnabledSettingsWithNames();
        $this->setTranslatedCountries($translatedCountries);
        $this->setSettings(get_option('featured-options-' . $this->countryISO));
        if (!get_option('oldsettingsSet')) {
            $this->setOldSettings(get_option('my_option_name'));
            foreach ($this->translatedCountries as $iso => $name) {
                $newOption = [];

                $newOption['article_1_id'] = $this->oldSettings['feat_art_1' . $iso];
                $newOption['article_1_image'] = $this->oldSettings['feat_art_1_img' . $iso];
                $newOption['article_1_subtitle'] = $this->oldSettings['feat_art_1_txt' . $iso];
                $newOption['article_2_id'] = $this->oldSettings['feat_art_2' . $iso];
                $newOption['article_2_image'] = $this->oldSettings['feat_art_2_img' . $iso];
                $newOption['article_2_subtitle'] = $this->oldSettings['feat_art_2_txt' . $iso];

                $newOption['featured'] = $this->oldSettings['casino_id' . $iso];
                $newOption['featured_1_id'] = $this->oldSettings['casino_id_1' . $iso];
                $newOption['featured_1_label'] = $this->oldSettings['casino_label_1' . $iso];
                $newOption['featured_2_id'] = $this->oldSettings['casino_id_2' . $iso];
                $newOption['featured_2_label'] = $this->oldSettings['casino_label_2' . $iso];
                $newOption['featured_3_id'] = $this->oldSettings['casino_id_3' . $iso];
                $newOption['featured_3_label'] = $this->oldSettings['casino_label_3' . $iso];
                $newOption['featured_4_id'] = $this->oldSettings['casino_id_4' . $iso];
                $newOption['featured_4_label'] = $this->oldSettings['casino_label_4' . $iso];
                update_option('featured-options-' . $iso, $newOption);

            }
//            echo '<pre>';
//            echo $iso;
//            print_r(get_option('featured-options-'.$iso));
//            echo '</pre>';
            update_option('oldsettingsSet', true);
        }


    }


    private function saveButton()
    {
        $ret = '<button href="javascript:void(0)" class="btn btn-sm btn-secondary" data-settings-id="featured" data-settingsCountry="' . $this->countryISO . '" onclick="saveSettings(event,this)">Save options for <b>' . ucwords($this->translatedCountries[$this->countryISO]) . '</b></button>';
        return $ret;
    }

    private function featuredCasino()
    {
        $casinos = get_all_valid_casino($this->countryISO);
        ob_start(); ?>
        <div class="w-20 mb-5p">
            <label for="" class="d-block text-center bg-secondary mb-2p border-bottom border-primary p-4p"><b>Featured
                    Casino</b></label>
            <select class="w-100 mb-5p" name="featured-options-<?= $this->countryISO ?>[featured]">
                <option value="">Select Casino...</option>
                <?php foreach ($casinos as $casinoID) { ?>
                    <option value="<?= $casinoID ?>" <?= selected($this->settings['featured'], $casinoID, false) ?>><?= get_the_title($casinoID) ?></option>
                <?php } ?>
            </select>
        </div>
        <?php
        return ob_get_clean();
    }

    private function secondaryCasinos($numberofCasino = null)
    {
        $casinos = get_all_valid_casino($this->countryISO);
        ob_start(); ?>
        <div class="w-20 mb-5p pl-5p pr-5p">
            <label for=""
                   class="d-block text-center bg-primary m-0 mb-2p border-bottom border-secondary text-white p-4p">#<?= $numberofCasino ?>
                Secondary Casino </label>
            <select class="w-100 mb-5p"
                    name="featured-options-<?= $this->countryISO ?>[featured_<?= $numberofCasino ?>_id]">
                <option value="">Select Casino...</option>
                <?php foreach ($casinos as $casinoID) { ?>
                    <option value="<?= $casinoID ?>" <?= selected($this->settings['featured_' . $numberofCasino . '_id'], $casinoID, false) ?>><?= get_the_title($casinoID) ?></option>
                <?php } ?>
            </select>
            <label for=""
                   class="d-block text-center bg-primary m-0 mb-2p border-bottom border-secondary text-white p-4p">
                #<?= $numberofCasino ?> Secondary Casino - Label</label>
            <select class="form-control" id=""
                    name="featured-options-<?= $this->countryISO ?>[featured_<?= $numberofCasino ?>_label]">
                <option value="">Choose Label...</option>
                <option value="hot" <?= selected($this->settings['featured_' . $numberofCasino . '_label'], 'hot', false) ?>>
                    Hot
                </option>
                <option value="exclusive" <?= selected($this->settings['featured_' . $numberofCasino . '_label'], 'exclusive', false) ?>>
                    Exclusive
                </option>
                <option value="new" <?= selected($this->settings['featured_' . $numberofCasino . '_label'], 'new', false) ?>>
                    New
                </option>
            </select>
        </div>
        <?php
        return ob_get_clean();
    }

    private function featuredArticles($numberofArticle = null)
    {
        $article = get_all_published(['page', 'bc_countries', 'kss_transactions', 'kss_softwares']);
        ob_start(); ?>
        <div class="w-50 mb-5p p-5p my_meta_control">
            <label for=""
                   class="d-block text-center bg-primary m-0 mb-2p border-bottom border-secondary text-white p-4p">#<?= $numberofArticle ?>
                Featured Article for Sidebar </label>
            <select class="w-100 mb-5p"
                    name="featured-options-<?= $this->countryISO ?>[article_<?= $numberofArticle ?>_id]">
                <option value="">Select Article...</option>
                <?php foreach ($article as $articleID) { ?>
                    <option value="<?= $articleID ?>" <?= selected($this->settings['article_' . $numberofArticle . '_id'], $articleID, false) ?>><?= get_the_title($articleID) ?></option>
                <?php } ?>
            </select>
            <label for=""
                   class="d-block text-center bg-primary m-0 mb-2p border-bottom border-secondary text-white p-4p">
                #<?= $numberofArticle ?> Featured Article for Sidebar - Subtitle</label>
            <input type="text" value="<?= $this->settings['article_' . $numberofArticle . '_subtitle'] ?>"
                   name="featured-options-<?= $this->countryISO ?>[article_<?= $numberofArticle ?>_subtitle]" id=""
                   class="w-100 mb-5p">
            <label for=""
                   class="d-block text-center bg-primary m-0 mb-2p border-bottom border-secondary text-white p-4p">
                #<?= $numberofArticle ?> Featured Article for Sidebar - Image</label>

            <input type="text" id="featured-options-<?= $this->countryISO ?>-article_<?= $numberofArticle ?>_image"
                   name="featured-options-<?= $this->countryISO ?>[article_<?= $numberofArticle ?>_image]"
                   value="<?= $this->settings['article_' . $numberofArticle . '_image'] ?>" class="mr-1 w-100"/>
            <button data-dest-selector="#featured-options-<?= $this->countryISO ?>-article_<?= $numberofArticle ?>_image"
                    class="btn btn-info btn-sm btn-block" onclick="addImageOnSettings(event,this)">Add Image
            </button>
            <img src="<?= $this->settings['article_' . $numberofArticle . '_image'] ?>" width="80" class="mr-1">
        </div>
        <?php return ob_get_clean();
    }

    private function buildOptions()
    {
        $ret = '<div class="d-flex flex-wrap mb-10p border-bottom border-primary">';
        $ret .= $this->featuredCasino();
        for ($i = 1; $i <= 4; $i++) {
            $ret .= $this->secondaryCasinos($i);
        }
        $ret .= '</div>';
        $ret .= '<div class="d-flex flex-wrap mb-10p border-top border-primary">';
        for ($i = 1; $i <= 2; $i++) {
            $ret .= $this->featuredArticles($i);
        }
        $ret .= '</div>';
        $ret .= $this->saveButton();
        return $ret;
    }
    public static function saveFeatured($settingsData,$iso)
    {
        $save = update_option('featured-options-' . $iso, $settingsData);
        return $save ? true : false;
    }
    public static function loadOptions($args)
    {
        $instance = new Featured($args);
        return $instance->buildOptions();
    }
}