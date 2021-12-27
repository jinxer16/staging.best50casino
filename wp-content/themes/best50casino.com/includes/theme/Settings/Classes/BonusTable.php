<?php


namespace SettingsSpace;


class BonusTable
{
    private $target;
    private $bookIDorCountryISO;
    private $parents;
    private $countriesArray;
    private $metaType;
    private $metaName;
    private $standarSettingsID;

    /**
     * @return mixed
     */
    public function getStandarSettingsID()
    {
        return $this->standarSettingsID;
    }

    /**
     * @param mixed $standarSettingsID
     */
    public function setStandarSettingsID($standarSettingsID)
    {
        $this->standarSettingsID = $standarSettingsID;
    }

    /**
     * @return mixed
     */
    public function getMetaName()
    {
        return $this->metaName;
    }

    /**
     * @param mixed $metaName
     */
    public function setMetaName($metaName)
    {
        $this->metaName = $metaName;
    }

    /**
     * @return mixed
     */
    public function getMetaType()
    {
        return $this->metaType;
    }

    /**
     * @param mixed $metaType
     */
    public function setMetaType($metaType)
    {
        $this->metaType = $metaType;
    }

    /**
     * @return mixed
     */
    public function getCountriesArray()
    {
        return $this->countriesArray;
    }

    /**
     * @param mixed $countriesArray
     */
    public function setCountriesArray($countriesArray)
    {
        $this->countriesArray = $countriesArray;
    }

    /**
     * @return mixed
     */
    public function getParents()
    {
        return $this->parents;
    }

    /**
     * @param mixed $parents
     */
    public function setParents($parents)
    {
        $this->parents = $parents;
    }

    /**
     * @return mixed
     */
    public function getBookIDorCountryISO()
    {
        return $this->bookIDorCountryISO;
    }

    /**
     * @param mixed $bookIDorCountryISO
     */
    public function setBookIDorCountryISO($bookIDorCountryISO)
    {
        $this->bookIDorCountryISO = $bookIDorCountryISO;
    }

    /**
     * @return mixed
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param mixed $target
     */
    public function setTarget($target)
    {
        $this->target = $target;
    }

    /**
     * BonusTable constructor.
     * @param $bonusBy
     * @param $bookIDorCountryISO
     * @param $metaType2
     * @param null $metaName
     */
    public function __construct($bonusBy, $bookIDorCountryISO, $metaType2, $metaName = null)
    {
        if ($metaName != null) $this->setMetaName($metaName);
        $this->setBookIDorCountryISO($bookIDorCountryISO);
        $this->setMetaType($metaType2);
        if ($bonusBy == 'bymeta') {
            if ($metaType2 == 'bonus') {
                $this->setTarget('countries');
            } else {
                $this->setTarget('metadata');
            }
            $this->setParents($this->listOfBooks());
        } else {
            $this->setTarget('kss_casino');
            if ($metaType2 == 'bonus') {
                $this->setParents($this->listOfCountries());
            } elseif ($metaType2 == 'dynamic') {
                $this->setParents($this->listOfMetadata());
            } elseif ($metaType2 == 'standar') {
                $settingsToKeys = [
                    'contact_languages' => 'cs-languages',
                    'contact_ways' => 'cs-channels',
                    'sports' => 'review-sports',
                    'products' => 'review-products',
                    'bet_markets' => 'additional-betting-selections',
                    'extra_services' => 'review-services',
                    'currencies' => 'review-currencies',
                    'languages' => 'web-languages'
                ];
                $this->setStandarSettingsID($settingsToKeys[$this->metaName]);
                $this->setParents($this->listOfMetadata());
            }

        }
        $url = TEMPLATEPATH . '/includes/theme/Settings/countriesArray.json';
        $request = file_get_contents($url);
        $countriesArray = json_decode($request, true);
        $this->setCountriesArray($countriesArray);
    }

    private function listOfMetadata()
    {
        if ($this->metaType == 'dynamic') {
            $dynamicOptions = get_option('dynamic-panel');
            if (isset($dynamicOptions)) {
                return $dynamicOptions['dynamic-options']['title'];
            } else {
                return [];
            }
        } elseif ($this->metaType == 'standar') {
            $standarOptions = get_option('data-panel');
            if (isset($standarOptions)) {
                $ret = $standarOptions[$this->standarSettingsID]['main'];
                asort($ret);
                return $ret;
            } else {
                return [];
            }
        }
    }

    private function listOfCountries()
    {
        $enabledCountries = \WordPressSettings::getCountryEnabledSettings();
        $bookRestrictions = get_post_meta($this->bookIDorCountryISO, 'casino_custom_meta_rest_countries', true);
        $bookRestrictions = is_array($bookRestrictions) ? array_flip($bookRestrictions) : [];
//        unset($enabledCountries['-']);
        return array_diff_key($enabledCountries, $bookRestrictions);
    }

    private function listOfBooks()
    {
        if ($this->metaType == 'payments') {
            $allBooks = get_all_posts('kss_casino');
        } else {
            $allBooks = get_all_published('kss_casino');
        }
        foreach ($allBooks as $key => $bookie) {
            $bookRestrictions = get_post_meta($bookie, 'casino_custom_meta_rest_countries', true);
            $bookRestrictions = is_array($bookRestrictions) ? array_flip($bookRestrictions) : [];
            if (isset($bookRestrictions[$this->bookIDorCountryISO])) unset($allBooks[$key]);
        }
        return $allBooks;
    }

    private function getParentName($parentKey, $parentValue)
    {
        if ($this->target == 'countries' || $this->target == 'metadata') $ret = get_the_title($parentValue);
        if ($this->target == 'kss_casino' && $this->metaType == 'bonus') $ret = ucwords($this->countriesArray[$parentKey]);
        if ($this->target == 'kss_casino' && $this->metaType == 'dynamic') $ret = $parentValue;
        return $ret;
    }

    private function getParentID($parentKey, $parentValue)
    {
        if ($this->target == 'countries' || $this->target == 'metadata') $ret = $parentValue;
        if ($this->target == 'kss_casino' && $this->metaType == 'bonus') $ret = $parentKey;
        if ($this->target == 'kss_casino' && $this->metaType == 'dynamic') $ret = $parentKey;
        return $ret;
    }

    private function buildBookBonusMeta($bookID, $countryISO,$casinoID)
    {
        $image_url = $countryISO != '-' ? get_template_directory_uri() . '/assets/flags/' . $countryISO . '.svg' : get_template_directory_uri() . '/assets/flags/glb.svg';
        $prefix = 'bs_custom_meta_';
        ob_start();
        ?>
        <div style="
    display: flex;
    flex-wrap: wrap;
    padding: 10px;
">
            <div style="margin-bottom: 5px;width:33%;">
                <label class="font-weight-bold" >Exclusive</label>
                <input type="checkbox" name="<?= $countryISO.$prefix.'exclusive' ?>" value="on"
                       data-default="on"
                       data-disabled="true" <?php echo get_post_meta($bookID, $countryISO . 'bs_custom_meta_no_bonus', true) == 1 ? 'disabled' : '' ?>
                    <?php checked(get_post_meta($bookID, $countryISO.$prefix.'exclusive', true), 'on', true) ?>/>
            </div>
            <div style="margin-bottom: 5px;width:33%;">
                <label class="font-weight-bold" >No Bonus</label>
                <input type="checkbox" name="<?= $countryISO. $prefix . 'no_bonus' ?>" value="1" id="nobonus"
                       onclick="noBonus(this,'nobonus','<?php echo $countryISO; ?>')" data-country="<?= $countryISO ?>"
                    <?php checked(get_post_meta($bookID, $countryISO. $prefix . 'no_bonus', true), 1, true) ?>/>
            </div>
            <div style="margin-bottom: 5px;width:33%;">
                <label class="font-weight-bold" >No Promo Code</label>
                <input type="checkbox" name="<?= $countryISO. $prefix . 'no_bonus_code' ?>" value="1" id="nopromocode"
                       onclick="noPromoCode(this,'nopromocode','<?php echo $countryISO; ?>')"
                       data-country="<?= $countryISO ?>"
                    <?php checked(get_post_meta($bookID, $countryISO. $prefix . 'no_bonus_code', true), 1, true) ?>/>
            </div>
            <div style="margin-bottom: 5px;width:33%;">
                <label class="font-weight-bold" >Free Spins</label>
                <input type="checkbox" name="<?= $countryISO. $prefix . '_is_free_spins' ?>" value="on"
                    <?php checked(get_post_meta($bookID, $countryISO. $prefix . '_is_free_spins', true), 1, true) ?>/>
            </div>
            <div style="margin-bottom: 5px;width:33%;">
                <label class="font-weight-bold" >No Deposit</label>
                <input type="checkbox" name="<?= $countryISO. $prefix . '_is_no_dep' ?>" value="on"
                    <?php checked(get_post_meta($bookID, $countryISO. $prefix . '_is_no_dep', true), 1, true) ?>/>
            </div>
            <div style="margin-bottom: 5px;width:33%;">
                <label class="font-weight-bold" >VIP</label>
                <input type="checkbox" name="<?= $countryISO. $prefix . '_is_vip' ?>" value="on"
                    <?php checked(get_post_meta($bookID, $countryISO. $prefix . '_is_vip', true), 1, true) ?>/>
            </div>
            <div style="margin-bottom: 5px;width:50%;">
                <label class="font-weight-bold" >Bonus</label>
                <i style="display:block;font-size:10px;color: #aeaeae;">Currency in Front (€100) (appears on new Review Page #CASINO CASINO BONUS, on New Bonus Page Right CTA on billboard/can be replaced with Promotions amount)</i>
                <input type="text" name="<?= $countryISO . $prefix . 'bonus_type' ?>"
                       data-default="-"
                       data-disabled="true" <?php echo get_post_meta($bookID, $countryISO . 'bs_custom_meta_no_bonus', true) == 1 ? 'disabled' : '' ?>
                       value="<?= get_post_meta($bookID, $countryISO . $prefix . 'bonus_type', true) ?>"/>
            </div>
            <div style="margin-bottom: 5px;width:50%;">
                <label class="font-weight-bold" >Spins</label>
                <i style="display:block;font-size:10px;color: #aeaeae;">Appears nowhere</i>
                <input type="text" name="<?= $countryISO . $prefix . 'spins_type' ?>"
                       data-default="-"
                       data-disabled="true" <?php echo get_post_meta($bookID, $countryISO . 'bs_custom_meta_no_bonus', true) == 1 ? 'disabled' : '' ?>
                       value="<?= get_post_meta($bookID, $countryISO . $prefix . 'spins_type', true) ?>"/>
            </div>
            <div style="margin-bottom: 5px;width:50%;">
                <label class="font-weight-bold" >Cashback</label>
                <i style="display:block;font-size:10px;color: #aeaeae;">Only for sorting Casino Shortcodes and Tab functionality</i>
                <input type="text" name="<?= $countryISO . $prefix . 'cashback_type' ?>"
                       data-default="-"
                       data-disabled="true" <?php echo get_post_meta($bookID, $countryISO . 'bs_custom_meta_no_bonus', true) == 1 ? 'disabled' : '' ?>
                       value="<?= get_post_meta($bookID, $countryISO . $prefix . 'cashback_type', true) ?>"/>
            </div>
            <div style="width:50%;">
                <label class="font-weight-bold" >Rewards</label>
                <i style="margin-bottom: 5px;display:block;font-size:10px;color: #aeaeae;">Appears nowhere</i>
                <input type="text" name="<?= $countryISO . $prefix . 'rewards_type' ?>"
                       data-default="-"
                       data-disabled="true" <?php echo get_post_meta($bookID, $countryISO . 'bs_custom_meta_no_bonus', true) == 1 ? 'disabled' : '' ?>
                       value="<?= get_post_meta($bookID, $countryISO . $prefix . 'rewards_type', true) ?>"/>
            </div>
            <div style="width:50%;margin-bottom: 5px;">
                <label class="font-weight-bold"  style="display:block;">No Deposit</label>
                <i style="display:block;font-size:10px;color: #aeaeae;">Only for sorting Casino Shortcodes and Tab functionality</i>
                <input type="text" name="<?= $countryISO . $prefix . 'nodep' ?>"
                       data-default="-"
                       data-disabled="true" <?php echo get_post_meta($bookID, $countryISO . 'bs_custom_meta_no_bonus', true) == 1 ? 'disabled' : '' ?>
                       value="<?= get_post_meta($bookID, $countryISO . $prefix . 'nodep', true) ?>"/>
            </div>
            <div style="width:50%;margin-bottom: 5px;">
                <label class="font-weight-bold"  style="display:block;">Minimum Deposit</label>
                <input type="text" name="<?= $countryISO . $prefix . 'min_dep' ?>"
                       data-default="-"
                       data-disabled="true" <?php echo get_post_meta($bookID, $countryISO . 'bs_custom_meta_no_bonus', true) == 1 ? 'disabled' : '' ?>
                       value="<?= get_post_meta($bookID, $countryISO . $prefix . 'min_dep', true) ?>"/>
            </div>
            <div style="width:50%;margin-bottom: 5px;">
                <label class="font-weight-bold"  style="display:block;">T&C's</label>
                <input type="text" name="<?= $countryISO . $prefix . 'sp_terms' ?>"
                       data-default="-"
                       data-disabled="true" <?php echo get_post_meta($bookID, $countryISO . 'bs_custom_meta_no_bonus', true) == 1 ? 'disabled' : '' ?>
                       value="<?= get_post_meta($bookID, $countryISO . $prefix . 'sp_terms', true) ?>"/>
            </div>
            <div style="width:50%;margin-bottom: 5px;">
                <label class="font-weight-bold"  style="display:block;">T&C's Link</label>
                <input type="text" name="<?= $countryISO . $prefix . 'sp_terms_link' ?>"
                       data-default="-"
                       data-disabled="true" <?php echo get_post_meta($bookID, $countryISO . 'bs_custom_meta_no_bonus', true) == 1 ? 'disabled' : '' ?>
                       value="<?= get_post_meta($bookID, $countryISO . $prefix . 'sp_terms_link', true) ?>"/>
            </div>
            <div style="width:50%;margin-bottom: 5px;">
                <label class="font-weight-bold"  style="display:block;">Bonus Code</label>
                <input type="text" name="<?= $countryISO . $prefix . 'bc_code' ?>"
                       data-default="-"
                       data-disabled="true" <?php echo get_post_meta($bookID, $countryISO . 'bs_custom_meta_no_bonus', true) == 1 ? 'disabled' : '' ?>
                       value="<?= get_post_meta($bookID, $countryISO . $prefix . 'bc_code', true) ?>"/>
            </div>
            <div style="width:50%;margin-bottom: 5px;">
                <label class="font-weight-bold"  style="display:block;">Bonus CTA (for Bonus Page LEFT TOP)</label>
                <i style="display:block;font-size:10px;color: #aeaeae;">100% up to $500</i>
                <input type="text" name="<?= $countryISO . $prefix . 'cta_for_top' ?>"
                       data-default="-"
                       data-disabled="true" <?php echo get_post_meta($bookID, $countryISO . 'bs_custom_meta_no_bonus', true) == 1 ? 'disabled' : '' ?>
                       value="<?= get_post_meta($bookID, $countryISO . $prefix . 'cta_for_top', true) ?>"/>
            </div>
            <div style="width:50%;margin-bottom: 5px;">
                <label class="font-weight-bold"  style="display:block;">Bonus Special Details(for Bonus Page LEFT TOP)</label>
                <input type="text" name="<?= $countryISO . $prefix . 'cta_for_top_2' ?>"
                       data-default="-"
                       data-disabled="true" <?php echo get_post_meta($bookID, $countryISO . 'bs_custom_meta_no_bonus', true) == 1 ? 'disabled' : '' ?>
                       value="<?= get_post_meta($bookID, $countryISO . $prefix . 'cta_for_top_2', true) ?>"/>
            </div>
            <div style="width:50%;margin-bottom: 5px;">
                <label class="font-weight-bold"  style="display:block;">Promotion's amount</label>
                <input type="text" name="<?= $countryISO . $prefix . 'promo_amount' ?>"
                       data-default="-"
                       data-disabled="true" <?php echo get_post_meta($bookID, $countryISO . 'bs_custom_meta_no_bonus', true) == 1 ? 'disabled' : '' ?>
                       value="<?= get_post_meta($bookID, $countryISO . $prefix . 'promo_amount', true) ?>"/>
            </div>
            <div style="width:50%;margin-bottom: 5px;">
                <label class="font-weight-bold"  style="display:block;">Percentage</label>
                <input type="text" name="<?= $countryISO . $prefix . 'bc_perc' ?>"
                       data-default="-"
                       data-disabled="true" <?php echo get_post_meta($bookID, $countryISO . 'bs_custom_meta_no_bonus', true) == 1 ? 'disabled' : '' ?>
                       value="<?= get_post_meta($bookID, $countryISO . $prefix . 'bc_perc', true) ?>"/>
            </div>
            <div style="width:50%;margin-bottom: 5px;">
                <label class="font-weight-bold"  style="display:block;">Wagering Bonus (B)</label>
                <input type="text" name="<?= $countryISO . $prefix . 'wag_b' ?>"
                       data-default="-"
                       data-disabled="true" <?php echo get_post_meta($bookID, $countryISO . 'bs_custom_meta_no_bonus', true) == 1 ? 'disabled' : '' ?>
                       value="<?= get_post_meta($bookID, $countryISO . $prefix . 'wag_b', true) ?>"/>
            </div>
            <div style="width:50%;margin-bottom: 5px;">
                <label class="font-weight-bold"  style="display:block;">Wagering Bonus (D)</label>
                <input type="text" name="<?= $countryISO . $prefix . 'wag_d' ?>"
                       data-default="-"
                       data-disabled="true" <?php echo get_post_meta($bookID, $countryISO . 'bs_custom_meta_no_bonus', true) == 1 ? 'disabled' : '' ?>
                       value="<?= get_post_meta($bookID, $countryISO . $prefix . 'wag_d', true) ?>"/>
            </div>
            <div style="width:50%;margin-bottom: 5px;">
                <label class="font-weight-bold"  style="display:block;">Wagering Bonus (S)</label>
                <input type="text" name="<?= $countryISO . $prefix . 'wag_s' ?>"
                       data-default="-"
                       data-disabled="true" <?php echo get_post_meta($bookID, $countryISO . 'bs_custom_meta_no_bonus', true) == 1 ? 'disabled' : '' ?>
                       value="<?= get_post_meta($bookID, $countryISO . $prefix . 'wag_s', true) ?>"/>
            </div>
            <div style="width:50%;margin-bottom: 5px;">
                <label class="font-weight-bold"  style="display:block;">CTA text Bonus Page UP left</label>
                <input type="text" name="<?= $countryISO . $prefix . 'top_up_cta' ?>"
                       data-default="-"
                       data-disabled="true" <?php echo get_post_meta($bookID, $countryISO . 'bs_custom_meta_no_bonus', true) == 1 ? 'disabled' : '' ?>
                       value="<?= get_post_meta($bookID, $countryISO . $prefix . 'top_up_cta', true) ?>"/>
            </div>



            <div style="width:50%;margin-bottom: 5px;" class="d-flex flex-wrap">
                <label class="w-100 d-block font-weight-bold">Deposit Methods</label>
                <?php $payments = get_all_posts(['kss_transactions','kss_crypto']); ?>
                <?php $casinoPayments = get_post_meta($casinoID,'casino_custom_meta_dep_options',true); ?>
                <?php $casinoPayments = is_array($casinoPayments) ? array_flip($casinoPayments) : []; ?>
                <?php asort($payments); ?>
                <?php foreach ($payments as $payment) { if(!isset($casinoPayments[$payment]))continue;?>
                    <p class="d-flex flex-wrap align-items-center justify-content-around">
                        <label class="m-0 mr-1 font-weight-normal"><?= get_the_title($payment) ?></label>
                        <input
                            data-default="<?= $payment; ?>"
                            data-disabled="true" <?php echo get_post_meta($bookID, $countryISO . 'bs_custom_meta_no_bonus', true) == 1 ? 'disabled' : '' ?>
                            type="checkbox" name="<?= $countryISO . $prefix . 'dep_options' ?>[]"
                            value="<?= $payment; ?>" <?= is_array(get_post_meta($bookID, $countryISO . $prefix . 'dep_options', true)) ? checked(in_array($payment, get_post_meta($bookID, $countryISO . $prefix . 'dep_options', true))) : checked($payment, get_post_meta($bookID, $countryISO . $prefix . 'dep_options', true)) ?>/>
                    </p>
                <?php } ?>
            </div>
            <div style="width:50%;margin-bottom: 5px;">
                <label class="font-weight-bold" >CTA text Bonus Page sign up offer</label>
                <i style="display:block;font-size:10px;color: #aeaeae;">Bonus Terms for bonus page (appears on OLD bonus page)</i>
                <input type="text" name="<?= $countryISO . $prefix . 'first_cta' ?>"
                       data-default="-"
                       data-disabled="true" <?php echo get_post_meta($bookID, $countryISO . 'bs_custom_meta_no_bonus', true) == 1 ? 'disabled' : '' ?>
                       value="<?= get_post_meta($bookID, $countryISO . $prefix . 'first_cta', true) ?>"/>
            </div>
            <div style="width:50%;margin-bottom: 5px;">
                <label class="font-weight-bold" >CTA text Bonus Page 2nd (PROMO CODE)</label>
                <i style="display:block;font-size:10px;color: #aeaeae;">Bonus Terms for bonus page (appears on OLD bonus page)</i>
                <input type="text" name="<?= $countryISO . $prefix . 'second_cta' ?>"
                       data-default="-"
                       data-disabled="true" <?php echo get_post_meta($bookID, $countryISO . 'bs_custom_meta_no_bonus', true) == 1 ? 'disabled' : '' ?>
                       value="<?= get_post_meta($bookID, $countryISO . $prefix . 'second_cta', true) ?>"/>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    private function buildBookDynamicMeta($bookID, $countryISO)
    {
        ob_start();
        $dynamicPanel = get_option('dynamic-panel');
        if ($this->target != 'kss_casino') {
            foreach ($dynamicPanel[$this->bookIDorCountryISO]['main'] as $key) {
                ?>
                <div class="w-50 d-flex align-items-center">
                    <input type="checkbox" name="<?= $this->bookIDorCountryISO ?>[]"
                           value="<?= $key ?>" <?= checked(in_array($key, get_post_meta($bookID, $this->bookIDorCountryISO, true))) ?>/><?= $key; ?>
                </div>
                <?php
            }
        } else {
            foreach ($dynamicPanel[$countryISO]['main'] as $key) {
                ?>
                <div class="w-50 d-flex align-items-center">
                    <input type="checkbox" name="<?= $countryISO ?>[]"
                           value="<?= $key ?>" <?= checked(in_array($key, get_post_meta($bookID, $countryISO, true))) ?>/><?= $key; ?>
                </div>
                <?php
            }
        }
        return ob_get_clean();
    }

    private function buildBookStandarMeta($bookID, $countryISO)
    {
        ob_start();
        $dynamicPanel = get_option('data-panel');
        if ($this->target != 'kss_casino') {
            $loop = $dynamicPanel[$this->bookIDorCountryISO]['main'];
            asort($loop);
            foreach ($loop as $key) {
                ?>
                <div class="w-50 d-flex align-items-center <?php echo $bookID; ?>">
                    <input type="checkbox" name="<?= $countryISO ?>[]"
                           value="<?= $key ?>" <?= checked(in_array($key, get_post_meta($bookID, $this->metaName, true))) ?>/><?= $key; ?>

                </div>
                <?php
            }
        }
        return ob_get_clean();
    }

    private function buildBookPayments($bookID)
    {
        $countries = \WordPressSettings::getCountryEnabledSettingsWithNames();
        asort($countries);
        $payments = get_all_posts('payment');
        $allFields = get_post_meta($bookID, '_deposit_fields', true);
        $fieldsFron2t = get_post_meta($bookID, 'deposit_front', true) ? get_post_meta($bookID, 'deposit_front', true) : [];
        $fieldsFront = get_post_meta($bookID, 'deposit_front', true) ? get_post_meta($bookID, 'deposit_front', true) : [];
        $fieldNamesNoPrefix = ['_dep_available', '_dep_charge', '_dep_min', '_dep_max', '_dep_time', '_dep_more', '_with_available', '_with_charge', '_with_min', '_with_time', '_with_more', '_restrictions'];
        if (!empty($allFields)) {
            foreach ($allFields as $fieldName) {
                foreach ($fieldNamesNoPrefix as $noPrefix) {
                    if (strpos($fieldName, $noPrefix) !== false) {
                        $fieldID = str_replace($noPrefix, '', $fieldName);
                        if (!in_array($fieldID, $fieldsFront)) {
                            $fieldsFront[] = $fieldID;
                        }
                    }
                }
            }
        }
        ob_start();
        ?>
        <div class="my_meta_control metabox repeater-content table-responsive">
            <button class="btn btn-primary btn-sm repeater-add-btn mb-1 meta-add">
                Add
            </button>
            <table class="repeater-rows table table-sm table-striped table-bordered" data-group="_deposit"
                   data-postID="<?= $bookID ?>" data-postIN="<?php echo implode(",", $fieldsFront) ?>">
                <thead class="thead-dark">
                <tr>
                    <th>&nbsp;</th>
                    <th>f</th>
                    <th>Dep.</th>
                    <th>Dep. Charge</th>
                    <th>Min. Deposit</th>
                    <th>Max. Deposit</th>
                    <th>Pending Time</th>
                    <th>Dep. (i)</th>
                    <th>Withd.</th>
                    <th>Withd. Charge</th>
                    <th>Min. Withd.</th>
                    <th>Pending Time</th>
                    <th>Withdr. (i)</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php if ($fieldsFront) { ?>
                    <?php foreach ($fieldsFront as $pay => $ment) { ?>
                        <?php $pay = $ment; ?>
                        <tr class="items">
                            <td class="all-scroll"><?php echo get_post_meta($ment, 'short_title', true) ? get_post_meta($ment, 'short_title', true) : get_the_title($ment); ?></td>
                            <td>
                                <input type="checkbox"
                                       name="_deposit[deposit_front][]"
                                       value="<?= $ment ?>"
                                    <?php $checked = in_array($ment, $fieldsFron2t) ? 'checked' : ''; ?>
                                    <?= $checked ?>/>
                            </td>
                            <td>
                                <input type="checkbox" name="_deposit[<?= $pay . '_dep_available' ?>]"
                                       value="1" <?= checked(get_post_meta($bookID, $pay . '_dep_available', true), 1, false) ?>/>
                            </td>
                            <td>
                                <input type="text" name="_deposit[<?= $pay . '_dep_charge' ?>]"
                                       value="<?= get_post_meta($bookID, $pay . '_dep_charge', true) ?>"/>
                            </td>
                            <td>
                                <input type="text" name="_deposit[<?= $pay . '_dep_min' ?>]"
                                       value="<?php echo get_post_meta($bookID, $pay . '_dep_min', true); ?>"/>
                            </td>
                            <td>
                                <input type="text" name="_deposit[<?= $pay . '_dep_max' ?>]"
                                       value="<?= get_post_meta($bookID, $pay . '_dep_max', true) ?>"/>
                            </td>
                            <td>
                                <input type="text" name="_deposit[<?= $pay . '_dep_time' ?>]"
                                       value="<?= get_post_meta($bookID, $pay . '_dep_time', true) ?>"/>
                            </td>
                            <td>
                                <textarea class="expand" cols="7"
                                          name="_deposit[<?= $pay . '_dep_more' ?>]"><?= get_post_meta($bookID, $pay . '_dep_more', true) ?></textarea>
                            </td>
                            <td>
                                <input type="checkbox" name="_deposit[<?= $pay . '_with_available' ?>]"
                                       value="1" <?= checked(get_post_meta($bookID, $pay . '_with_available', true), 1, false) ?>/>
                            </td>
                            <td>
                                <input type="text" name="_deposit[<?= $pay . '_with_charge' ?>]"
                                       value="<?= get_post_meta($bookID, $pay . '_with_charge', true) ?>"/>
                            </td>
                            <td>
                                <input type="text" name="_deposit[<?= $pay . '_with_min' ?>]"
                                       value="<?= get_post_meta($bookID, $pay . '_with_min', true) ?>"/>
                            </td>
                            <td>
                                <input type="text" name="_deposit[<?= $pay . '_with_time' ?>]"
                                       value="<?= get_post_meta($bookID, $pay . '_with_time', true) ?>"/>
                            </td>
                            <td>
                                <textarea class="expand" cols="7"
                                          name="_deposit[<?= $pay . '_with_more' ?>]"><?= get_post_meta($bookID, $pay . '_with_more', true) ?></textarea>
                            </td>
                            <td class="pull-right repeater-remove-btn">
                                <button class="btn btn-danger remove-btn btn-sm">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else {
                    $ret = '<tr class="items">"';
                    $ret .= '    <td>';
                    $ret .= '        <select class="form-control item-choice selectpicker">';
                    $ret .= '        <option value="">Select Payment</option>';
                    foreach ($payments as $restPayment) {
                        $paymentTitle = get_post_meta($restPayment, 'short_title', true) ? get_post_meta($restPayment, 'short_title', true) : get_the_title($restPayment);
                        $ret .= '        <option value="' . $restPayment . '">' . $paymentTitle . '</option>';
                    }
                    $ret .= '        </select>';
                    $ret .= '    </td>';
                    $ret .= '    <td><input type="checkbox" name="_deposit[deposit_front][]" value="REPLACEME"  disabled></td>';
                    $ret .= '    <td><input type="checkbox" name="_deposit[REPLACEME_dep_available]" value="1"  disabled></td>';
                    $ret .= '    <td><input type="text" name="_deposit[REPLACEME_dep_charge]" value=""  disabled></td>';
                    $ret .= '    <td><input type="text" name="_deposit[REPLACEME_dep_min]" value=""  disabled></td>';
                    $ret .= '    <td><input type="text" name="_deposit[REPLACEME_dep_max]" value=""  disabled></td>';
                    $ret .= '    <td><input type="text" name="_deposit[REPLACEME_dep_time]" value=""  disabled></td>';
                    $ret .= '    <td><input type="text" name="_deposit[REPLACEME_dep_more]" value=""  disabled></td>';
                    $ret .= '    <td><input type="checkbox" name="_deposit[REPLACEME_with_available]" value="1"  disabled></td>';
                    $ret .= '    <td><input type="text" name="_deposit[REPLACEME_with_charge]" value=""  disabled></td>';
                    $ret .= '    <td><input type="text" name="_deposit[REPLACEME_with_min]" value=""  disabled></td>';
                    $ret .= '    <td><input type="text" name="_deposit[REPLACEME_with_time]" value=""  disabled></td>';
                    $ret .= '    <td><input type="text" name="_deposit[REPLACEME_with_more]" value=""  disabled></td>';
                    $ret .= '    <td class="pull-right repeater-remove-btn"><button class="btn btn-danger remove-btn btn-sm">Remove</button></td>';
                    $ret .= '</tr>';
                    echo $ret;
                } ?>
                </tbody>
            </table>
            <button class="btn btn-primary btn-sm pull-right repeater-add-btn mb-1  meta-add">
                Add
            </button>
        </div>
        <?php
        return ob_get_clean();
    }

    private function buildBookRestrictionsMeta($bookID)
    {
        ob_start();
        ?>
        <label class="font-weight-bold w-100 border-bottom text-17 h4">Restricted Countries</label>
        <ul style="columns: 4;
  -webkit-columns: 4;
  -moz-columns: 4;" class="w-100">
            <?php
            $restrictedCountries = \WordPressSettings::getAvailableRestrictedCountries();
            foreach ($restrictedCountries as $bm => $bmvalue) { ?>
                <li class="w-100 searchme" data-filter="<?= ucwords($bmvalue); ?>">
                    <div class="">
                        <input data-check="me" type="checkbox" name="casino_custom_meta_rest_countries[]"
                               value="<?= $bm; ?>"
                            <?= checked(in_array($bm, get_post_meta($bookID, 'casino_custom_meta_rest_countries', true))) ?> />
                        <?php echo \WordPressSettings::isCountryActive($bm) ? '<b>' . ucwords($bmvalue) . '</b>' : ucwords($bmvalue); ?>
                    </div>
                </li>
            <?php } ?>
        </ul>
        <button id="checkAll" onclick="doCheckAll(this,event,'casino_custom_meta_rest_countries')"
                class="pointer btn btn-sm m-2 text-white btn-dark">Check All
        </button>
        <button id="uncheckAll" onclick="unCheckAll(this,event,'casino_custom_meta_rest_countries')"
                class="pointer btn btn-sm m-2 text-white btn-warning">UnCheck All
        </button>
        <label class="font-weight-bold w-100 border-bottom text-17 h4">Allowed Countries</label>
        <ul style="columns: 4;
  -webkit-columns: 4;
  -moz-columns: 4;" class="w-100">
            <?php
            $bookActive = $this->listOfCountries();
            $restOfWorld = array_diff_key($restrictedCountries, $bookActive);
            asort($restOfWorld);
            foreach ($bookActive as $bm => $bmvalue) { ?>
                <li class="w-100 searchme" data-filter="<?= ucwords($this->countriesArray); ?>">
                    <?php echo \WordPressSettings::isCountryActive($bm) ? '<b>' . ucwords($this->countriesArray[$bm]) . '</b>' : ucwords($this->countriesArray[$bm]); ?>
                </li>
            <?php }

            foreach ($restOfWorld as $bm => $bmvalue) {
                if ($bm != '-' && strpos($bm, 'us_') === false && !in_array($bm, get_post_meta($bookID, 'casino_custom_meta_rest_countries', true))) {
                    ?>
                    <li class="w-100 searchme" <?= $bm; ?> data-filter="<?= ucwords($bmvalue); ?>">
                        <?php echo \WordPressSettings::isCountryActive($bm) ? '<b>' . ucwords($bmvalue) . '</b>' : ucwords($bmvalue); ?>
                    </li>
                <?php }
            } ?>
        </ul>

        <?php
        return ob_get_clean();
    }

    private function buildBookMeta($bookID, $countryISO)
    {
        if ($this->metaType == 'bonus') {
            $bonusPageID = get_post_meta($bookID,'casino_custom_meta_bonus_page',true);
            $bonusID = get_post_meta($bonusPageID,'bonus_custom_meta_bonus_offer',true);
            return $this->buildBookBonusMeta($bonusID, $countryISO,$bookID);
        } elseif ($this->metaType == 'dynamic') {
            return $this->buildBookDynamicMeta($bookID, $countryISO);
        } elseif ($this->metaType == 'standar') {
            return $this->buildBookStandarMeta($bookID, $countryISO);
        }
    }

    private function buildDynamicMetaOptions()
    {
        ob_start();
        $dynamicPanel = get_option('dynamic-panel');
        foreach ($dynamicPanel[$this->bookIDorCountryISO]['main'] as $key) {
            ?>
            <option value="<?= $key ?>" class="">
                <?= $key ?>
            </option>
            <?php
        }
        return ob_get_clean();
    }

    private function createTable()
    {
        ob_start(); ?>
        <div class="w-100 d-flex flex-wrap">

            <?php
            if ($this->target == 'kss_casino' && $this->metaType == 'bonus') {
                ?>
                <div class="w-100 d-flex flex-wrap">
                    <?php
                    unset($this->parents['glb']);
                    $this->parents = ['glb'=>'Global']+$this->parents;
                    foreach ($this->parents as $parentKey => $parentValue) {
                        ?>
                        <div class="searchme" data-filter="<?= $this->getParentName($parentKey, $parentValue) ?>">
                            <div class=" p-2 m-1 border border-dark"
                                 style="cursor:pointer;"
                                 onClick="jQuery('.togglable').hide();jQuery('#my_meta_control_country_<?= $parentKey ?>').toggle();document.getElementById('copyrighter').dataset.target='<?= $parentKey ?>';return false;">
                                <a class="text-dark font-weight-bold" href="#"><img
                                        src="/wp-content/themes/best50casino.com/assets/flags/<?= $parentKey ?>.svg"
                                        width="20"> <?= ucwords($parentKey) ?></a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="w-45 searchme" data-filter="<?= $this->getParentName('-', null) ?>">
                    <div class=" p-2 m-1 border border-dark text-white bg-dark"
                         style="cursor:pointer;">
                        <select class="form-control p-0"
                                onchange="document.getElementById('copyrighter').dataset.source=this.value;switchBonusPanel(this)"
                                style="line-height:21px;height:21px;font-size:0.7rem;">
                            <option value="">Select</option>

                            <?php

                            foreach ($this->parents as $parentKey => $parentValue) {
                                ?>
                                <option value="<?= $parentKey ?>"><img
                                        src="/wp-content/themes/best50casino.com/assets/flags/<?= $parentKey ?>.svg"
                                        width="20"> <?= $this->getParentName($parentKey, null) ?> (This panel will
                                    not be saved)
                                </option>

                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="ItsAmeReplace" id="ItsAmeReplace">
                        <div class="d-flex flex-wrap my_meta_control">

                        </div>
                    </div>
                </div>
                <div class="w-9 d-flex align-items-center justify-content-center">
                    <div data-source=""
                         data-target=""
                         id="copyrighter"
                         onclick="copyData(this)"
                         class="copyrighter d-flex align-items-center justify-content-center bg-dark text-white"
                         style="font-size: 30px;padding: 10px;">
                        <i class="fa fa-copy"></i>
                        <i class="fa fa-chevron-right"></i>
                    </div>
                </div>
                <div class="w-45 d-flex flex-wrap align-content-end justify-content-between">
                    <?php
                    foreach ($this->parents as $parentKey => $parentValue) {
                        ?>
                        <div class="my_meta_control metabox form-group togglable"
                             id="my_meta_control_country_<?= $parentKey ?>" style="display: none;"
                             data-id="<?= $this->getParentID($parentKey, $parentValue) ?>">
                            <div class=" p-2 m-1 border border-dark"
                                 style="cursor:pointer;">
                                <a class="text-dark font-weight-bold" href="#">
                                    <img src="/wp-content/themes/bookmakers/images/flags/<?= $parentKey ?>.svg"
                                         width="20"> <?= $this->getParentName($parentKey, $parentValue) ?></a>
                            </div>
                            <div class="itsAme">
                                <div class="d-flex flex-wrap"
                                     data-id="<?= $this->getParentID($parentKey, $parentValue) ?>">
                                    <?php
                                    echo $this->buildBookMeta($this->bookIDorCountryISO, $parentKey);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
            } elseif ($this->target == 'metadata' && $this->metaType == 'restrictions') {
                $books = get_all_published('kss_casino');
                ?>
                <div class="d-flex flex-wrap">
                    <?php
                    foreach ($books as $bookID) {
                        $bookRestrictions = get_post_meta($bookID, 'casino_custom_meta_rest_countries', true);
                        $bookRestrictions = is_array($bookRestrictions) ? array_flip($bookRestrictions) : [];
                        if (strpos($this->bookIDorCountryISO, 'us_') !== false && isset($bookRestrictions['us'])) continue;
                        if (!isset($bookRestrictions[$this->bookIDorCountryISO])) {
                            if (get_post_meta($bookID, 'casino_custom_meta_hidden', true)) {
                                ?>
                                <div class="w-24 text-danger border border-danger p-2 m-1 searchme"
                                     data-filter="<?= get_the_title($bookID) ?>"><?php echo get_the_title($bookID); ?>
                                    (hidden)
                                </div>
                                <?php
                            } else {
                                $correctISOinCaseOfUSA = strpos($this->bookIDorCountryISO, 'us_') !== false ? 'us' : $this->bookIDorCountryISO;
                                $bonusPageID = get_post_meta($bookID,'casino_custom_meta_bonus_page',true);
                                $bonusPostID = get_post_meta($bonusPageID,'bonus_custom_meta_bonus_offer',true);
                                $bonusText = get_post_meta($bonusPostID, $correctISOinCaseOfUSA . 'bs_custom_meta_cta_for_top', true) ? get_post_meta($bonusPostID, $correctISOinCaseOfUSA . 'bs_custom_meta_cta_for_top', true) : get_post_meta($bonusPostID, 'glbbs_custom_meta_cta_for_top', true) . ' (default bonus)';
                                $bonusText2 = !get_post_meta($bonusPostID, $correctISOinCaseOfUSA . 'bs_custom_meta_cta_for_top_2', true) ? get_post_meta($bonusPostID, 'glbbs_custom_meta_cta_for_top_2', true) ? get_post_meta($bonusPostID, 'glbbs_custom_meta_cta_for_top_2', true) . ' (default bonus)' : ' Empty' : get_post_meta($bonusPostID, $correctISOinCaseOfUSA . 'bs_custom_meta_cta_for_top_2', true);
                                ?>
                                <div class="w-24 text-dark border border-success p-2 m-1 searchme"
                                     data-filter="<?= get_the_title($bookID) ?>">
                                    <b><?php echo get_the_title($bookID) . '</b><br><i class="text-11">'. $bonusText . ' / Special:' . $bonusText2 . '</i>'; ?>
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>
                </div>
                <?php
            } elseif ($this->target == 'metadata' && $this->metaType == 'payments') {
//                $books = get_all_published('kss_casino');
                $url = TEMPLATEPATH . '/includes/theme/Settings/countriesArray.json';
                $request = file_get_contents($url);
                $countriesArray = json_decode($request, true);
                ?>
                <div class="w-100 d-flex flex-wrap">
                    <?php
                    foreach ($this->parents as $parentKey => $parentValue) {
                        $bookPayments = get_post_meta($parentValue, 'deposit_front', true);
                        $paymentRestrictions = get_post_meta($parentValue, $this->bookIDorCountryISO . '_restrictions', true);
                        $hiddenColor = get_post_meta($parentValue, 'casino_custom_meta_hidden', true) ? 'border-danger' : 'border-success';
                        $hiddenText = get_post_meta($parentValue, 'casino_custom_meta_hidden', true) ? ' (Hidden)' : '';
                        $hiddenColorText = get_post_meta($parentValue, 'casino_custom_meta_hidden', true) ? ' text-danger' : ' text-dark';
                        $draftColor = get_post_status($parentValue) == 'draft' ? 'border-warning' : 'border-success';
                        $draftText = get_post_status($parentValue) == 'draft' ? ' (Draft)' : '';
                        if ($paymentRestrictions) {
                            foreach ($paymentRestrictions as $paymentRestriction) {
                                $paymentRestrictionNames[] = ucwords($countriesArray[$paymentRestriction]);
                            }
                        }
                        ?>
                        <div class="w-49 searchme"
                             data-filter="<?= $this->getParentName($parentKey, $parentValue) ?>">
                            <div class=" p-2 m-1 border <?php echo $draftColor; ?> <?php echo $hiddenColor; ?>"
                                 style="cursor:pointer;"
                                 onClick="jQuery('#my_meta_control_country_<?= $parentKey ?>').toggle();return false;">
                                <a class="<?php echo $hiddenColorText; ?>"
                                   href="#"><?= $this->getParentName($parentKey, $parentValue) ?><?php echo $hiddenText; ?><?php echo $draftText; ?></a>
                            </div>
                            <div class="my_meta_control metabox form-group pl-2"
                                 id="my_meta_control_country_<?= $parentKey ?>" style="display: none;"
                                 data-id="<?= $this->getParentID($parentKey, $parentValue) ?>">

                                <b class="text-17 text-dark mb-1 mt-1"><u>Deposit</u></b><br>
                                <p class="d-flex align-items-center">
                                    <label for="_deposit[deposit_front][]" class="m-0 mr-1 text-info">Front:</label>
                                    <input type="checkbox"
                                           name="_deposit[deposit_front][]"
                                           value="<?= $this->bookIDorCountryISO ?>"
                                        <?php $checked = in_array($this->bookIDorCountryISO, $bookPayments) ? 'checked' : ''; ?>
                                        <?= $checked ?>/>
                                </p>
                                <p class="d-flex align-items-center">
                                    <label for="_deposit[<?= $this->bookIDorCountryISO . '_dep_available' ?>]"
                                           class="m-0 mr-1 text-info">Available:</label>
                                    <input type="checkbox"
                                           name="_deposit[<?= $this->bookIDorCountryISO . '_dep_available' ?>]"
                                           value="1"
                                        <?= checked(get_post_meta($parentValue, $this->bookIDorCountryISO . '_dep_available', true), 1, false) ?>/>
                                </p>
                                <p class="d-flex align-items-center justify-content-between">
                                    <label for="_deposit[<?= $this->bookIDorCountryISO . '_dep_charge' ?>]"
                                           class="m-0 mr-1 text-info">Charge:</label>
                                    <input type="text" class="w-80"
                                           name="_deposit[<?= $this->bookIDorCountryISO . '_dep_charge' ?>]"
                                           value="<?= get_post_meta($parentValue, $this->bookIDorCountryISO . '_dep_charge', true) ?>"/>
                                </p>
                                <p class="d-flex align-items-center justify-content-between">
                                    <label for="_deposit[<?= $this->bookIDorCountryISO . '_dep_min' ?>]"
                                           class="m-0 mr-1 text-info text-nowrap">Min. Dep.:</label>
                                    <input type="text" class="w-80"
                                           name="_deposit[<?= $this->bookIDorCountryISO . '_dep_min' ?>]"
                                           value="<?= get_post_meta($parentValue, $this->bookIDorCountryISO . '_dep_min', true) ?>"/>
                                </p>
                                <p class="d-flex align-items-center justify-content-between">
                                    <label for="_deposit[<?= $this->bookIDorCountryISO . '_dep_max' ?>]"
                                           class="m-0 mr-1 text-info text-nowrap">Max. Dep.:</label>
                                    <input type="text" class="w-80"
                                           name="_deposit[<?= $this->bookIDorCountryISO . '_dep_max' ?>]"
                                           value="<?= get_post_meta($parentValue, $this->bookIDorCountryISO . '_dep_max', true) ?>"/>
                                </p>
                                <p class="d-flex align-items-center justify-content-between">
                                    <label for="_deposit[<?= $this->bookIDorCountryISO . '_dep_time' ?>]"
                                           class="m-0 mr-1 text-info text-nowrap">Pend. Time:</label>
                                    <input type="text" class="w-80"
                                           name="_deposit[<?= $this->bookIDorCountryISO . '_dep_time' ?>]"
                                           value="<?= get_post_meta($parentValue, $this->bookIDorCountryISO . '_dep_time', true) ?>"
                                </p>
                                <p class="d-flex align-items-center justify-content-between">
                                    <label for="_deposit[<?= $this->bookIDorCountryISO . '_dep_more' ?>]"
                                           class="m-0 mr-1 text-info text-nowrap">Dep. Info:</label>
                                    <textarea class="w-80"
                                              name="_deposit[<?= $this->bookIDorCountryISO . '_dep_more' ?>]"><?= get_post_meta($parentValue, $this->bookIDorCountryISO . '_dep_more', true) ?></textarea>
                                </p>
                                <b class="text-17 text-dark mb-1 mt-1"><u>Withdrawal</u></b><br>
                                <p class="d-flex align-items-center">
                                    <label for="_deposit[<?= $this->bookIDorCountryISO . '_with_available' ?>]"
                                           class="m-0 mr-1 text-info">Available:</label>
                                    <input type="checkbox"
                                           name="_deposit[<?= $this->bookIDorCountryISO . '_with_available' ?>]"
                                           value="1"
                                        <?= checked(get_post_meta($parentValue, $this->bookIDorCountryISO . '_with_available', true), 1, false) ?>/>
                                </p>
                                <p class="d-flex align-items-center justify-content-between">
                                    <label for="_deposit[<?= $this->bookIDorCountryISO . '_with_charge' ?>]"
                                           class="m-0 mr-1 text-info">Charge:</label>
                                    <input type="text" class="w-80"
                                           name="_deposit[<?= $this->bookIDorCountryISO . '_with_charge' ?>]"
                                           value="<?= get_post_meta($parentValue, $this->bookIDorCountryISO . '_with_charge', true) ?>"/>
                                </p>
                                <p class="d-flex align-items-center justify-content-between">
                                    <label for="_deposit[<?= $this->bookIDorCountryISO . '_with_min' ?>]"
                                           class="m-0 mr-1 text-info text-nowrap">Min. Wit.:</label>
                                    <input type="text" class="w-80"
                                           name="_deposit[<?= $this->bookIDorCountryISO . '_with_min' ?>]"
                                           value="<?= get_post_meta($parentValue, $this->bookIDorCountryISO . '_with_min', true) ?>"/>
                                </p>
                                <p class="d-flex align-items-center justify-content-between">
                                    <label for="_deposit[<?= $this->bookIDorCountryISO . '_with_time' ?>]"
                                           class="m-0 mr-1 text-info text-nowrap">Pend. Time:</label>
                                    <input type="text" class="w-80"
                                           name="_deposit[<?= $this->bookIDorCountryISO . '_with_time' ?>]"
                                           value="<?= get_post_meta($parentValue, $this->bookIDorCountryISO . '_with_time', true) ?>"
                                </p>
                                <p class="d-flex align-items-center justify-content-between">
                                    <label for="_deposit[<?= $this->bookIDorCountryISO . '_with_more' ?>]"
                                           class="m-0 mr-1 text-info text-nowrap">Wit. Info:</label>
                                    <textarea class="w-80"
                                              name="_deposit[<?= $this->bookIDorCountryISO . '_with_more' ?>]"><?= get_post_meta($parentValue, $this->bookIDorCountryISO . '_with_more', true) ?></textarea>
                                </p>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
            } elseif ($this->target == 'kss_casino' && $this->metaType == 'restrictions') {
                ?>
                <div class="d-flex flex-wrap my_meta_control metabox" data-id="casino_custom_meta_rest_countries"
                     id="casino_custom_meta_rest_countries">
                    <?php
                    echo $this->buildBookRestrictionsMeta($this->bookIDorCountryISO);
                    ?>
                </div>
                <?php
            } elseif ($this->target == 'kss_casino' && $this->metaType == 'payments') {
                ?>
                <div class="d-flex flex-wrap my_meta_control metabox" data-id="deposit_front" id="deposit_front">
                    <?php
                    echo $this->buildBookPayments($this->bookIDorCountryISO);
                    ?>
                </div>
                <?php
            } elseif ($this->target == 'kss_casino' && $this->metaType == 'standar') {
                foreach ($this->parents as $parentKey => $parentValue) {
                    ?>
                    <div class="w-50 d-flex align-items-center my_meta_control metabox" data-id="<?= $this->metaName ?>"
                         id="<?= $this->metaName ?>">
                        <input type="checkbox" name="<?= $this->metaName ?>[]"
                               value="<?= $parentValue ?>" <?= checked(in_array($parentValue, get_post_meta($this->bookIDorCountryISO, $this->metaName, true))) ?>/><?= $parentValue; ?>

                    </div>
                    <?php
                }
            } else {
                if ($this->target == 'metadata' && $this->metaType != 'standar') {
                    ?>
                    <select class="w-100" onchange="filterBookByMeta(this,'<?= $this->bookIDorCountryISO ?>')">
                        <option value="">Filter Book By Meta Value</option>
                        <?php echo $this->buildDynamicMetaOptions(); ?>
                    </select>
                    <?php
                }

                foreach ($this->parents as $parentKey => $parentValue) {

                    ?>
                    <div class="w-49 searchme" data-filter="<?= $this->getParentName($parentKey, $parentValue) ?>">
                        <?php
                        $hiddennBOrder = ($this->target == 'countries' || $this->target == 'metadata') && get_post_meta($parentValue, 'casino_custom_meta_hidden', true) ? 'border-danger' : 'border-dark';
                        $hiddennColorText = ($this->target == 'countries' || $this->target == 'metadata') && get_post_meta($parentValue, 'casino_custom_meta_hidden', true) ? 'text-danger' : 'text-dark';

                        $hiddennText = ($this->target == 'countries' || $this->target == 'metadata') && get_post_meta($parentValue, 'casino_custom_meta_hidden', true) ? '(hidden)' : '';
                        ?>
                        <div class=" p-2 m-1 border <?php echo $hiddennBOrder; ?>"
                             style="cursor:pointer;"
                             onClick="jQuery('#my_meta_control_country_<?= $parentKey ?>').toggle();return false;">
                            <a class="<?php echo $hiddennColorText; ?>"
                               href="#"><?= $this->getParentName($parentKey, $parentValue) ?><?php echo $hiddennText; ?></a>
                        </div>
                        <div class="my_meta_control metabox form-group"
                             id="my_meta_control_country_<?= $parentKey ?>" style="display: none;"
                             data-id="<?= $this->getParentID($parentKey, $parentValue) ?>">
                            <div class="d-flex flex-wrap">
                                <?php
                                if ($this->target == 'countries') {
                                    echo $this->buildBookMeta($parentValue, $this->bookIDorCountryISO);
                                } elseif ($this->target == 'metadata') {
                                    echo $this->buildBookMeta($parentValue, $this->bookIDorCountryISO);
                                } else {
                                    echo $this->buildBookMeta($this->bookIDorCountryISO, $parentKey);
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <?php
        return ob_get_clean();
    }

    private static function savePaymentsMeta($type, $BookOrIsoOrMetaID, $settings)
    {
        if ($type == 'bybook') { // $BookOrIsoOrMetaID is bookID
            $OldFields = get_post_meta($BookOrIsoOrMetaID, '_deposit_fields', true);

            foreach ($settings as $dynamicMetaID => $dynamicMetaKeyAndValue) {

                foreach ($dynamicMetaKeyAndValue as $metaKey => $metaValue) {

                    $metaKey = str_replace('_deposit[', '', $metaKey);
                    if (strpos($metaKey, '[]') !== false) {
                        $metaKey = str_replace('][', '[', $metaKey);
                        $metaKey = str_replace('[]', '', $metaKey);
                        if (!is_array($metaValue)) $metaValue = [$metaValue];
                        $metaValue = array_filter($metaValue);
                    } else {
                        $metaKey = str_replace(']', '', $metaKey);
                    }
                    if (strpos($metaKey, 'REPLACEME') !== false) continue;
                    if ($metaValue == 'REPLACEME') continue;
                    self::insertMetaToField($BookOrIsoOrMetaID, $metaKey, '_deposit_fields');
                    self::saveMeta($BookOrIsoOrMetaID, $metaKey, $metaValue);
                    $keySaved[] = $metaKey;
                    $asd[$metaKey] = $metaValue;
                }
            }
            $tobeDeleted = array_diff($OldFields, $keySaved);
            foreach ($tobeDeleted as $ketToDelete) {
                delete_post_meta($BookOrIsoOrMetaID, $ketToDelete);
                self::removeMetaToField($BookOrIsoOrMetaID, $ketToDelete, '_deposit_fields');
            }
            return 'Done';
        } elseif ($type == 'bymeta') {
            foreach ($settings as $dynamicMetaID => $dynamicMetaKeyAndValue) { // $BookOrIsoOrMetaID is Payment ID , $dynamicMetaID is BookID
                foreach ($dynamicMetaKeyAndValue as $metaKey => $metaValue) {
                    $metaKey = str_replace('_deposit[', '', $metaKey);
                    if (strpos($metaKey, '[]') !== false) {
                        $metaKey = str_replace('][', '[', $metaKey);
                        $metaKey = str_replace('[]', '', $metaKey);
                        $oldBookDepositFront = get_post_meta($dynamicMetaID, 'deposit_front', true);
                        if ($metaValue == '' || $metaValue == null || !$metaValue) {
                            $oldBookDepositFront2 = $oldBookDepositFront ? array_diff($oldBookDepositFront, [$BookOrIsoOrMetaID]) : [];
                            $metaValue = $oldBookDepositFront2;
                        } else {
                            if (!in_array($metaValue, $oldBookDepositFront)) {
                                $oldBookDepositFront[] = $metaValue;
                                $asd = $oldBookDepositFront;
                                $metaValue = $asd;
                            }
                        }
                        if (!is_array($metaValue)) $metaValue = [$metaValue];
                        $metaValue = array_filter($metaValue);
                    } else {
                        $metaKey = str_replace(']', '', $metaKey);
                    }
                    if ($metaValue == 'REPLACEME') continue;
                    if ($metaValue == '' || $metaValue == null || !$metaValue) {
                        self::removeMetaToField($dynamicMetaID, $metaKey, '_deposit_fields');
                        delete_post_meta($dynamicMetaID, $metaKey);
                        continue;
                    }
                    self::insertMetaToField($dynamicMetaID, $metaKey, '_deposit_fields');
                    self::saveMeta($dynamicMetaID, $metaKey, $metaValue);
                }
            }

        } else {
            return 'Unknown factor';
        }
    }

    private static function enableOrDisableCountryFilled($bonusID, $country,$dynamicMetaKeyAndValue)
    {
        $bonusFilled = get_post_meta($bonusID,'bs_custom_meta_bonus_contries_filled',true);
        $bonusFilledRev = is_array($bonusFilled) ? array_flip($bonusFilled) : [];
        if(isset($bonusFilledRev[$country]))$counteryHasBonus=true;
        if($dynamicMetaKeyAndValue[$country.'bs_custom_meta_no_bonus']==1)$countryShoudntHaveBonus=true;
        if(!$dynamicMetaKeyAndValue[$country.'bs_custom_meta_cta_for_top'] || $dynamicMetaKeyAndValue[$country.'bs_custom_meta_cta_for_top']=='-')$countryShoudntHaveBonusCriteria1=true;
        if(!$dynamicMetaKeyAndValue[$country.'bs_custom_meta_cta_for_top_2'] || $dynamicMetaKeyAndValue[$country.'bs_custom_meta_cta_for_top_2']=='-')$countryShoudntHaveBonusCriteria2=true;
        if(!$dynamicMetaKeyAndValue[$country.'bs_custom_meta_promo_amount'] || $dynamicMetaKeyAndValue[$country.'bs_custom_meta_promo_amount']=='-')$countryShoudntHaveBonusCriteria3=true;
//        if(!$countryShoudntHaveBonus && (!$countryShoudntHaveBonusCriteria1 || !$countryShoudntHaveBonusCriteria2 || !$countryShoudntHaveBonusCriteria3)){
        if(!$countryShoudntHaveBonusCriteria1 || !$countryShoudntHaveBonusCriteria2 || !$countryShoudntHaveBonusCriteria3){
            if($counteryHasBonus){
                return true;
            }else{
                $bonusFilled[]=$country;
                self::insertMetaToField($bonusID, 'bs_custom_meta_bonus_contries_filled', '_bonus_text_fields');
                self::saveMeta($bonusID, 'bs_custom_meta_bonus_contries_filled', $bonusFilled);
            }
        }
//        if($countryShoudntHaveBonus || ($countryShoudntHaveBonusCriteria1 && $countryShoudntHaveBonusCriteria2 && !$countryShoudntHaveBonusCriteria3) ){
        if($countryShoudntHaveBonusCriteria1 && $countryShoudntHaveBonusCriteria2 && !$countryShoudntHaveBonusCriteria3){
            if(!$counteryHasBonus){
                return true;
            }else{
                unset($bonusFilledRev[$country]);
                $bonusFilled = array_flip($bonusFilledRev);
                self::insertMetaToField($bonusID, 'bs_custom_meta_bonus_contries_filled', '_bonus_text_fields');
                self::saveMeta($bonusID, 'bs_custom_meta_bonus_contries_filled', $bonusFilled);
            }
        }
    }

    private static function saveBonusMeta($type, $BookOrIsoOrMetaID, $settings)
    {
        $ret=[];
        if ($type == 'bybook') { // $BookOrIsoOrMetaID is bookID
            $bonusPageID = get_post_meta($BookOrIsoOrMetaID,'casino_custom_meta_bonus_page',true);
            $bonusID = get_post_meta($bonusPageID,'bonus_custom_meta_bonus_offer',true);

            foreach ($settings as $dynamicMetaID => $dynamicMetaKeyAndValue) {
                self::enableOrDisableCountryFilled($bonusID, $dynamicMetaID,$dynamicMetaKeyAndValue);
                foreach ($dynamicMetaKeyAndValue as $metaKey => $metaValue) {
                    if (strpos($metaKey, '[]') !== false) {
                        $metaKey = str_replace('[]', '', $metaKey);
                        if (!is_array($metaValue)) $metaValue = [$metaValue];
                    }

                    self::insertMetaToField($bonusID, $metaKey, '_bonus_text_fields');
                    self::saveMeta($bonusID, $metaKey, $metaValue);
                }
            }
            return 'Done';
        } elseif ($type == 'bymeta') {
            foreach ($settings as $dynamicMetaID => $dynamicMetaKeyAndValue) { // $BookOrIsoOrMetaID is country ISO , $dynamicMetaID is BookID
                $bonusPageID = get_post_meta($dynamicMetaID,'casino_custom_meta_bonus_page',true);
                $bonusID = get_post_meta($bonusPageID,'bonus_custom_meta_bonus_offer',true);
                self::enableOrDisableCountryFilled($bonusID, $BookOrIsoOrMetaID,$dynamicMetaKeyAndValue);
                foreach ($dynamicMetaKeyAndValue as $metaKey => $metaValue) {
                    if (strpos($metaKey, '[]') !== false) {
                        $metaKey = str_replace('[]', '', $metaKey);
                        if (!is_array($metaValue)) $metaValue = [$metaValue];
                    }
                    $ret[]=$dynamicMetaID;
                    self::insertMetaToField($bonusID, $metaKey, '_bonus_text_fields');
                    self::saveMeta($bonusID, $metaKey, $metaValue);
                }
            }
            return 'Done';
//            return $ret;
        } else {
            return 'Unknown factor';
        }
    }

    private static function saveDynamicMeta($type, $BookOrIsoOrMetaID, $settings)
    {
        if ($type == 'bybook') {
            foreach ($settings as $dynamicMetaID => $dynamicMetaKeyAndValue) {
                self::insertMetaToField($BookOrIsoOrMetaID, $dynamicMetaID, '_book');
                self::saveMeta($BookOrIsoOrMetaID, $dynamicMetaID, $dynamicMetaKeyAndValue);
            }
        } elseif ($type == 'bymeta') {
            foreach ($settings as $dynamicMetaID => $dynamicMetaKeyAndValue) { //$dynamicMetaID is BookID and $BookOrIsoOrMetaID is metaKey
                self::insertMetaToField($dynamicMetaID, $BookOrIsoOrMetaID, '_book_fields');
                self::saveMeta($dynamicMetaID, $BookOrIsoOrMetaID, $dynamicMetaKeyAndValue);
            }
        } else {
            return 'Unknown factor';
        }
    }

    private static function saveStandarMeta($type, $BookOrIsoOrMetaID, $settings, $metaType)
    {
        $settingsToFields = [
            'contact_languages' => '_description',
            'contact_ways' => '_description',
            'languages' => '_description',
            'sports' => '_book',
            'products' => '_book',
            'bet_markets' => '_book',
            'extra_services' => '_book',
            'currencies' => '_book'
        ];
        if ($type == 'bybook') {
            foreach ($settings as $dynamicMetaID => $dynamicMetaKeyAndValue) {
                self::insertMetaToField($BookOrIsoOrMetaID, $dynamicMetaID, $settingsToFields[$dynamicMetaID] . '_fields');
                self::saveMeta($BookOrIsoOrMetaID, $dynamicMetaID, array_filter($dynamicMetaKeyAndValue[$dynamicMetaID . '[]']));
            }
        } elseif ($type == 'bymeta') {
            foreach ($settings as $dynamicMetaID => $dynamicMetaKeyAndValue) { //$dynamicMetaID is BookID and $BookOrIsoOrMetaID is metaKey
                self::insertMetaToField($dynamicMetaID, $BookOrIsoOrMetaID, $settingsToFields[$BookOrIsoOrMetaID] . '_fields');
                self::saveMeta($dynamicMetaID, $BookOrIsoOrMetaID, array_filter($dynamicMetaKeyAndValue[$metaType . '[]']));
            }
        } else {
            return 'Unknown factor';
        }
    }

    private static function saveRestrictionsMeta($type, $BookOrIsoOrMetaID, $settings)
    {
        if ($type == 'bybook') {
            foreach ($settings as $dynamicMetaID => $dynamicMetaKeyAndValue) {
                self::insertMetaToField($BookOrIsoOrMetaID, $dynamicMetaID, '_casino_geo_info_fields');
                $data = array_filter($dynamicMetaKeyAndValue[$dynamicMetaID . '[]']);
                $data = !empty($data) ? array_filter($dynamicMetaKeyAndValue[$dynamicMetaID . '[]']) : [];
                self::saveMeta($BookOrIsoOrMetaID, $dynamicMetaID, $data);
            }
            return 'Done';
        } elseif ($type == 'bymeta') {
            return 'Nothing To Save';
        } else {
            return 'Unknown factor';
        }
    }

    private static function removeMetaToField($bookID, $metaKey, $field)
    {
        $wpAlchemyFields = get_post_meta($bookID, $field, true);
        if (in_array($metaKey, $wpAlchemyFields)) {
            $wpAlchemyFieldsNew = array_flip($wpAlchemyFields);
            unset($wpAlchemyFieldsNew[$metaKey]);
            $wpAlchemyFieldsNewest = array_flip($wpAlchemyFieldsNew);
            update_post_meta($bookID, $field, $wpAlchemyFieldsNewest);
        }
    }

    private static function insertMetaToField($bookID, $metaKey, $field)
    {
        $wpAlchemyFields = get_post_meta($bookID, $field, true);
        if (!in_array($metaKey, $wpAlchemyFields)) {
            $wpAlchemyFields[] = $metaKey;
            update_post_meta($bookID, $field, $wpAlchemyFields);
        }
    }

    public static function saveTable($metaType, $type, $BookOrIsoOrMetaID, $settings)
    {
        if ($metaType == 'helping-panel') {
            return self::saveBonusMeta($type, $BookOrIsoOrMetaID, $settings);
        } elseif ($metaType == 'book-dynamic-meta') {
            return self::saveDynamicMeta($type, $BookOrIsoOrMetaID, $settings);
        } elseif ($metaType == 'casino-restriction-meta') {
            return self::saveRestrictionsMeta($type, $BookOrIsoOrMetaID, $settings);
        } elseif ($metaType == 'book-payments-meta') {
            return self::savePaymentsMeta($type, $BookOrIsoOrMetaID, $settings);
        } else {
            return self::saveStandarMeta($type, $BookOrIsoOrMetaID, $settings, $metaType);
        }
    }

    private static function saveMeta($bookID, $metaKey, $metaValue)
    {
        $old = get_post_meta($bookID, $metaKey, true);
        $new = $metaValue;
        if (isset($new) && $new != $old) {
            update_post_meta($bookID, $metaKey, $new);
        } elseif (!isset($new) && $old) {
            delete_post_meta($bookID, $metaKey, $old);
        }

    }

    public static function loadTable($bonusBy, $bookIDorCountryISO, $metaType, $metaName = null)
    {
        $instance = new BonusTable($bonusBy, $bookIDorCountryISO, $metaType, $metaName);
        return $instance->createTable();
    }
}