<?php


namespace SettingsSpace;


class Premium
{
    public $countryISO;
    private $translatedCountries;
    private $oldSettings;
    private $settings;
    private $postType;

    /**
     * @return mixed
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * @return mixed
     */
    public function getPostType()
    {
        return $this->postType;
    }

    /**
     * @param mixed $postType
     */
    public function setPostType($postType)
    {
        $this->postType = $postType;
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

    public function __construct($args,$postType)
    {
        wp_enqueue_script('sortableJS', '/wp-content/themes/best50casino.com/includes/theme/Metaboxes/jquery-ui-1-12-1.js');
        wp_enqueue_style('sortableCSS', '/wp-content/themes/best50casino.com/includes/theme/Metaboxes/jquery-ui.css');
        $this->setCountryISO($args);
        $this->setPostType($postType);
        $translatedCountries = \WordPressSettings::getCountryEnabledSettingsWithNames();
        $this->setTranslatedCountries($translatedCountries);
        $this->setSettings(get_option('premium-'.$this->postType.'-' . $this->countryISO));
//        update_option('oldsettingsSetForCasino', false);
        if (get_option('oldsettingsSetForCasino')==false && $this->postType=='casino') {
            $this->setOldSettings(get_option('default_casino_options'));
            foreach ($this->translatedCountries as $iso => $name) {
                $newOption = [];
                $newOption['ids'] = $this->oldSettings['default_casinos_id' . $iso]['ids'];
                $premiumArray = explode(',',$this->oldSettings['default_casinos_id' . $iso]['ids']);
                $premium2= array_slice($premiumArray, 0, $this->oldSettings['default_casinos_id' . $iso]['premium']);
                $newOption['premium'] = implode(',',$premium2);
                update_option('premium-casino-' . $iso, $newOption);
            }
            update_option('oldsettingsSetForCasino', true);
        }
//        update_option('oldsettingsSetForPayments', false);

        if (get_option('oldsettingsSetForPayments')==false && $this->postType=='transactions') {
            $this->setOldSettings(get_option('payment_options_page'));
            foreach ($this->translatedCountries as $iso => $name) {
                $newOption = [];
                $newOption = $this->oldSettings['payment_id' . $iso]['ids'];
                update_option('premium-'.$this->postType.'-' . $iso, $newOption);
            }
            update_option('oldsettingsSetForPayments', true);
        }
//        update_option('oldsettingsSetForPromotions', false);
        if (get_option('oldsettingsSetForPromotions')==false && $this->postType=='promotions') {
            $this->setOldSettings(get_option('promo_options_page'));
            foreach ($this->translatedCountries as $iso => $name) {
                $newOption = [];
                $newOption['ids'] = $this->oldSettings['promo_order' . $iso];
                $newOption['premium'] = $this->oldSettings['promo_order' . $iso];
                update_option('premium-'.$this->postType.'-' . $iso, $newOption);
            }
            update_option('oldsettingsSetForPromotions', true);
        }
    }


    private function saveButton()
    {
        $ret = '<button href="javascript:void(0)" class="btn btn-sm btn-secondary" data-settings-id="premium" data-type="'.$this->postType.'" data-settingsCountry="' . $this->countryISO . '" onclick="saveSettings(event,this)">Save options for <b>' . ucwords($this->translatedCountries[$this->countryISO]) . '</b></button>';
        return $ret;
    }


    private function featuredCasino()
    {
        $casinos = get_all_valid_casino($this->countryISO,'draft');
        $premiumCasinoSettings = $this->settings['premium'];
        $premiumCasinoSettingsArray = isset($premiumCasinoSettings) ? explode(',',$premiumCasinoSettings) : [];
        $orderCasinoSetings = $this->settings['ids'];
        $orderCasinoSetingsArray = isset($orderCasinoSetings) ? explode(',',$orderCasinoSetings) : [];
        $orderCasinoSetingsArray = array_map('intval', $orderCasinoSetingsArray);
        $finalCasinos = !empty($orderCasinoSetingsArray) ? $orderCasinoSetingsArray : $casinos;
        if(!empty($orderCasinoSetingsArray))$finalCasinos = array_merge($finalCasinos,array_diff($casinos,$orderCasinoSetingsArray));
        ob_start();?>
        <div class="w-100 mb-5p">
            <label for="" class="d-block text-center bg-secondary mb-2p border-bottom border-primary p-4p"><b>Premium Order
                    Casino</b></label>
            <ol class="w-80 mb-5p sortable_bookie_list ui-sortable" name="premium-<?=$this->postType?>-<?= $this->countryISO ?>[]" id="premium-<?=$this->postType?>-<?= $this->countryISO ?>" ><!--style="columns: 2;-webkit-columns: 2;-moz-columns: 2;"-->
                <?php foreach ($finalCasinos as $casinoID) {
                    $current_status = get_post_status ( $casinoID );
                    if(false === $current_status || $current_status == 'trash') continue;
                    $restricted = get_post_meta((int)$casinoID, 'casino_custom_meta_rest_countries', true);
                    if (is_array($restricted)) $restrictedFliped = array_flip($restricted);
                    if (!isset($restrictedFliped[$this->countryISO])) {
                        $checked = in_array($casinoID, $premiumCasinoSettingsArray) ? 'checked="checked"' : "";
                        if (get_post_status($casinoID) === 'draft') { ?>
                            <li id="<?= $casinoID ?>" data-value="<?= $casinoID ?>"
                                class="bg-warning w-90"><?= get_the_title($casinoID) ?></li>
                        <?php } else {
                            if (!get_post_meta($casinoID, 'casino_custom_meta_hidden', true) && !get_post_meta($casinoID, 'casino_custom_meta_flaged', true)) { ?>
                                <li <?= $checked ?> class="p-1 w-90" id="<?= $casinoID ?>"
                                    data-value="<?= $casinoID ?>"><?= get_the_title($casinoID) ?><input <?= $checked ?>
                                                                                                        class="m-0 float-right"
                                                                                                        type="checkbox"
                                                                                                        value="1"/></li>
                            <?php } else {
                                ?>
                                <li class="p-1 bg-danger w-90" id="<?= $casinoID ?>"
                                    data-value="<?= $casinoID ?>"><?= get_the_title($casinoID) ?> (Hidden or
                                    Flagged)<input <?= $checked ?> class="m-0 float-right" type="checkbox" value="1"/>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    <?php }
                }?>
            </ol>
            <input type="hidden"
                   class="form-control form-control-sm"
                   data-target="premium-<?=$this->postType?>-<?= $this->countryISO ?>[ids]"
                   name="premium-<?=$this->postType?>-<?= $this->countryISO ?>[ids]"
                   value="<?php echo isset($this->settings['ids']) ? $this->settings['ids'] : "" ?>"/>
            <input type="hidden"
                   class="form-control form-control-sm"
                   data-target="premium-<?=$this->postType?>-<?= $this->countryISO ?>[premium]"
                   name="premium-<?=$this->postType?>-<?= $this->countryISO ?>[premium]"
                   value="<?php echo isset($this->settings['premium']) ? $this->settings['premium'] : "" ?>"/>
        </div>
        <?php
        return ob_get_clean();
    }

    private function navTabsdays($firstfilter,$secondfilter,$typefilter)
    {
        $daysArray = array('All','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
        $ret = '<style>.nav-tabs .nav-link.active{font-weight: bolder;background-color: #44c6b7;}.nav-tabs .nav-link {
    border: 1px solid #e3e3e3;}</style>';
        $ret .= '<div style="margin-bottom: 10px;">';
        $ret .= '<ul class="nav nav-tabs" role="tablist">';
        $counter = 0;
        $codi = $this->countryISO;

        foreach ($daysArray as $day ) {
             if ($typefilter ==='promotype'){
                $btnClass = $day == $secondfilter ? 'active' : '';
            }else{
                $btnClass = $day == $firstfilter ? 'active' : '';
            }

            $ret .= '<li class="nav-item">
                <a class="' . $btnClass . ' nav-link navdays text-dark"
                   data-toggle="tab"
                   data-by="day"
                   data-country="'.$codi.'"
                   data-type="'.$day.'"
                   id="'. $codi . '-' .$day. '-tab' . '"
                   href="#'. $codi . '-' .$day. '" role="tab"
                   aria-controls="' . $codi . '-' .$day. '"
                   onclick="filterPremiumPromo(event,this)">' . $day . '</a>
            </li>';
            $counter += 1;
        }
        $ret .= '</ul>';
        $ret .= '</div>';
        return $ret;
    }
    private function navTabsPromotypes($firstfilter,$secondfilter,$typefilter)
    {
        $terms = get_terms([
            'taxonomy' => 'promotions-type',
            'hide_empty' => false,
        ]);
        $codi = $this->countryISO;
         if ($typefilter ==='promotype'){
                $btnClass = 'all' === $firstfilter ? 'active' : '';
            }else{
                $btnClass = 'all' === $secondfilter ? 'active' : '';
            }
        $ret = '<style>.nav-tabs .nav-link.active{font-weight: bolder;background-color: #44c6b7;}.nav-tabs .nav-link {
    border: 1px solid #e3e3e3;}</style>';
        $ret .= '<div style="margin-bottom: 10px;">';
        $ret .= '<ul class="nav nav-tabs" role="tablist">';
        $ret .= '<li class="nav-item ">
                <a class="'.$btnClass.' nav-link navpromos text-dark"
                   data-toggle="tab"
                   data-by="promotype"
                   data-country="'.$codi.'"
                   data-type="all"
                   id="'. $codi . '-alltypes-tab' . '"
                   href="#'. $codi . '-alltypes-tab' . '" role="tab"
                   aria-controls="'. $codi . '-alltypes-tab' . '"
                   aria-selected="true" onclick="filterPremiumPromo(event,this)">All Types</a>
            </li>';
        $counter = 0;

        foreach ($terms as $promotype) {
             if ($typefilter ==='promotype'){
                $btnClass = $promotype->slug == $firstfilter ? 'active' : '';
            }else{
                $btnClass = $promotype->slug == $secondfilter ? 'active' : '';
            }
            $ret .= '<li class="nav-item">
                <a class="' . $btnClass . ' nav-link text-dark navpromos"
                   data-toggle="tab"
                   data-by="promotype"
                   data-type="'.$promotype->slug.'"
                   data-country="'.$codi.'"
                   id="'. $codi . '-' .$promotype->slug. '-tab' . '"
                   href="#'. $codi . '-' .$promotype->slug. '" role="tab"
                   aria-controls="' . $codi . '-' .$promotype->slug. '" onclick="filterPremiumPromo(event,this)">' . $promotype->name . '</a>
            </li>';
            $counter += 1;
        }
        $ret .= '</ul>';
        $ret .= '</div>';
        return $ret;
    }

    private function featuredPromotions()
    {
        $dt = date('Y-m-d H:i');

        $promos = get_all_posts('bc_offers');
        $premiumCasino = \WordPressSettings::getPremiumCasino($this->countryISO,'premium');
        $premiumCasino = str_replace(" ","",$premiumCasino);
        $premiumCasino = explode(",",$premiumCasino);
        $premiumPromoSettings = $this->settings['premium'];
        $premiumPromoSettingsArray = isset($premiumPromoSettings) ? explode(',',$premiumPromoSettings) : [];
        $orderPromoSetings = $this->settings['ids'];
        $orderPromoSetingsArray = isset($orderPromoSetings) ? explode(',',$orderPromoSetings) : [];
        $orderPromoSetingsArray = array_map('intval', $orderPromoSetingsArray);
        $finalPromos = !empty($orderPromoSetingsArray) ? $orderPromoSetingsArray : $promos;
        if(!empty($orderPromoSetingsArray))$finalPromos = array_merge($finalPromos,array_diff($promos,$orderPromoSetingsArray));

        ob_start();
        echo $this->navTabsPromotypes('all',null,'promotype');
        echo $this->navTabsdays('All',null,'days');
        ?>

        <div class="w-100 mb-5p">
            <label for="" class="d-block text-center bg-secondary mb-2p border-bottom border-primary p-4p"><b>Premium Order Promotions</b></label>
            <ol class="w-80 mb-5p sortable_bookie_list ui-sortable" name="premium-<?=$this->postType?>-<?= $this->countryISO ?>[]" id="premium-<?=$this->postType?>-<?= $this->countryISO ?>" ><!--style="columns: 2;-webkit-columns: 2;-moz-columns: 2;"-->
                <?php foreach ($finalPromos as $promoID) {
                    $casinoID = get_post_meta($promoID,'promo_custom_meta_casino_offer',true);
                    $exlusive = get_post_meta((int)$promoID,'offer_exclusive',true);
                    $restricted = get_post_meta((int)$casinoID, 'casino_custom_meta_rest_countries', true);
                    $restrictedat = get_post_meta($promoID,'restrictedat',true);
                    $isrestricted='';
                    if (isset($restrictedat) && is_array($restrictedat)){
                        if (!in_array($this->countryISO,$restrictedat)){
                            $isrestricted = 'restricted';
                        }else{
                            $isrestricted = 'no';
                        }
                    }else{
                        $isrestricted = 'no';
                    }


                    $validat = get_post_meta($promoID,'validat',true);
                    $onlyshow='';
                    if (isset($validat) && is_array($validat)){
                        if (in_array($this->countryISO,$validat)){
                            $onlyshow = 'show';
                        }else{
                            $onlyshow = 'restricted';
                        }
                    }else{
                        $onlyshow = 'show';
                    }


                    if (is_array($restricted)) $restrictedFliped = array_flip($restricted);
                    $promoEndTime = get_post_meta( (int)$promoID , 'promo_custom_meta_end_offer' , true );


                    $date1=strtotime($dt);
                    $date2=strtotime($promoEndTime);
                    $diff = abs($date2 - $date1);
                    $years = floor($diff / (365*60*60*24));
                    $months = floor(($diff - $years * 365*60*60*24)/ (30*60*60*24));
                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                    $hours = floor(($diff - $years * 365*60*60*24- $months*30*60*60*24 - $days*60*60*24)/ (60*60));
                    $minutes = floor(($diff - $years * 365*60*60*24- $months*30*60*60*24 - $days*60*60*24- $hours*60*60)/ 60);
                    if($date2 < $date1){
                        $timeEpapsed ='<span style="color:#ff464d;">(Promo Expired)</span>';
                    }else{
                        $timeEpapsed ='<span style="color:#06551f;">(' .$days.'D '.$hours.'H '.$minutes.'m)</span>';
                    }
                    if (!isset($restrictedFliped[$this->countryISO]) && $promoEndTime >= $dt && $isrestricted !== 'restricted' && $onlyshow !== 'restricted') {
                        $checked = in_array($promoID, $premiumPromoSettingsArray) ? 'checked="checked"' : "";
                        $exclu='';
                        if ($exlusive === 'on'){
                            $exclu='<b class="float-right" style="color: red">Exclusive</b>';
                        }
                        if(in_array($casinoID,$premiumCasino)){ ?>
                            <li <?= $checked ?> class="p-1 w-90" id="<?= $promoID ?>" data-value="<?= $promoID ?>"><b class="mr-5p">(<i class="fa fa-star mr-3p text-secondary"></i> <?=get_the_title($casinoID)?>)</b><?= get_the_title($promoID) ?><b class="ml-5p"><?=$timeEpapsed?></b><?=$exclu?></li>
                            <?php
                        }elseif (!get_post_meta($casinoID, 'casino_custom_meta_hidden', true) && !get_post_meta($casinoID, 'casino_custom_meta_flaged', true)) { ?>
                            <li <?= $checked ?> class="p-1 w-90" id="<?= $promoID ?>" data-value="<?= $promoID ?>"><b class="mr-5p">(<?=get_the_title($casinoID)?>)</b><?= get_the_title($promoID) ?><b class="ml-5p"><?=$timeEpapsed?></b><?=$exclu?></li>
                        <?php } else {
                            continue ?>
<!--                            <li class="p-1 bg-danger w-90" id="--><?//= $promoID ?><!--"-->
<!--                                data-value="--><?//= $promoID ?><!--"><b class="mr-5p">(--><?//=get_the_title($casinoID)?><!--)</b>--><?//= get_the_title($promoID) ?><!-- (Hidden or-->
<!--                                Flagged)<input --><?//= $checked ?><!-- class="m-0 float-right" type="checkbox" value="1"/>-->
<!--                            </li>-->
                        <?php } ?>

                    <?php }
                }?>
            </ol>
            <input type="hidden"
                   class="form-control form-control-sm"
                   data-target="premium-<?=$this->postType?>-<?= $this->countryISO ?>[ids]"
                   name="premium-<?=$this->postType?>-<?= $this->countryISO ?>[ids]"
                   value="<?php echo isset($this->settings['ids']) ? $this->settings['ids'] : "" ?>"/>
            <input type="hidden"
                   class="form-control form-control-sm"
                   data-target="premium-<?=$this->postType?>-<?= $this->countryISO ?>[premium]"
                   name="premium-<?=$this->postType?>-<?= $this->countryISO ?>[premium]"
                   value="<?php echo isset($this->settings['premium']) ? $this->settings['premium'] : "" ?>"/>
        </div>
        <?php
        return ob_get_clean();
    }

    private function dofilterPromos($country,$firstfilter,$secondfilter,$typefilter)
    {
        $dt = date('Y-m-d H:i');
        if ($typefilter === 'promotype'){
            if ($firstfilter === 'all'){
                $promotypefilter =null;
            }else{
                $promotypefilter = array(
                      array(
                     'taxonomy' => 'promotions-type',
                     'field' => 'slug',
                     'terms' => $firstfilter
                     )
                 );
            }
            if ($secondfilter === 'All'){
                 $dayfilter = null;
            }else{
                 $dayfilter = array(
                    array(
                     'key' => 'promo_custom_meta_valid_on',
                     'value' =>  $secondfilter,
                     'compare' => 'LIKE'
                    )
                );
            }
        }else{
             if ($firstfilter === 'All'){
                $dayfilter = null;
            }else{
                 $dayfilter = array(
                    array(
                     'key' => 'promo_custom_meta_valid_on',
                     'value' =>  $firstfilter,
                     'compare' => 'LIKE'
                    )
                 );
            }
             if ($secondfilter === 'all'){
                 $promotypefilter=null;
             }else{
                   $promotypefilter = array(
                    array(
                     'taxonomy' => 'promotions-type',
                     'field' => 'slug',
                     'terms' => $secondfilter
                     )
                   );
             }
        }

        $query_casino = array(
            'post_type' => array('bc_offers'),
            'post_status' => array('publish'),
            'posts_per_page' => 999,
            'fields' => 'ids',
            'order' => 'ASC',
            'suppress_filters' => true,
             'tax_query' => array(
                'relation' => 'AND',
                $promotypefilter
            ),
            'meta_query' => array(
                'relation' => 'AND',
                 $dayfilter,
            ),
        );


        $promos = get_posts($query_casino);

        $premiumCasino = \WordPressSettings::getPremiumCasino($country,'premium');
        $premiumCasino = str_replace(" ","",$premiumCasino);
        $premiumCasino = explode(",",$premiumCasino);
        if ($typefilter === 'promotype') {
            $premiumPromoSettings = get_option('premium-promotions-'.$firstfilter.'-'.$secondfilter.'-' . $country)['ids'];
        } else{
            $premiumPromoSettings = get_option('premium-promotions-'.$secondfilter.'-'.$firstfilter.'-' . $country)['ids'];
        }
        $orderPromoSetingsArray = isset($premiumPromoSettings) ? explode(',',$premiumPromoSettings) : [];
        $orderPromoSetingsArray = array_map('intval', $orderPromoSetingsArray);
        $finalPromos = !empty($orderPromoSetingsArray) ? $orderPromoSetingsArray : $promos;
        if(!empty($orderPromoSetingsArray))$finalPromos = array_merge($finalPromos,array_diff($promos,$orderPromoSetingsArray));

        ob_start();
//        echo \Premium::navTabsdays();
//
        echo $this->navTabsPromotypes($firstfilter,$secondfilter,$typefilter);
        echo $this->navTabsdays($firstfilter,$secondfilter,$typefilter);
        ?>

        <div class="w-100 mb-5p">
            <label for="" class="d-block text-center bg-secondary mb-2p border-bottom border-primary p-4p"><b>Premium Order Promotions</b></label>
            <?php   if ($typefilter === 'promotype') {
                ?>
            <ol class="w-80 mb-5p sortable_bookie_list ui-sortable" name="premium-promotions-<?=$firstfilter?>-<?=$secondfilter?>-<?= $country?>[]" id="premium-promotions-<?=$firstfilter?>-<?=$secondfilter?>-<?= $country?>" ><!--style="columns: 2;-webkit-columns: 2;-moz-columns: 2;"-->
                <?php
             }else{
                ?>
            <ol class="w-80 mb-5p sortable_bookie_list ui-sortable" name="premium-promotions-<?=$secondfilter?>-<?=$firstfilter?>-<?= $country?>[]" id="premium-promotions-<?=$secondfilter?>-<?=$firstfilter?>-<?= $country?>" ><!--style="columns: 2;-webkit-columns: 2;-moz-columns: 2;"-->
                <?php
             }
                 foreach ($finalPromos as $promoID) {
                    $casinoID = get_post_meta($promoID,'promo_custom_meta_casino_offer',true);

                    $restrictedat = get_post_meta($promoID,'restrictedat',true);
                    $isrestricted='';
                    if (isset($restrictedat) && is_array($restrictedat)){
                        if (!in_array($country,$restrictedat)){
                            $isrestricted = 'restricted';
                        }else{
                            $isrestricted = 'no';
                        }
                    }else{
                        $isrestricted = 'no';
                    }


                    $validat = get_post_meta($promoID,'validat',true);
                    $onlyshow='';
                    if (isset($validat) && is_array($validat)){
                        if (in_array($country,$validat)){
                            $onlyshow = 'show';
                        }else{
                            $onlyshow = 'restricted';
                        }
                    }else{
                        $onlyshow = 'show';
                    }

                    $promoEndTime = get_post_meta( (int)$promoID , 'promo_custom_meta_end_offer' , true );
                     $exlusive = get_post_meta($promoID,'offer_exclusive',true);
                    $date1=strtotime($dt);
                    $date2=strtotime($promoEndTime);
                    $diff = abs($date2 - $date1);
                    $years = floor($diff / (365*60*60*24));
                    $months = floor(($diff - $years * 365*60*60*24)/ (30*60*60*24));
                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                    $hours = floor(($diff - $years * 365*60*60*24- $months*30*60*60*24 - $days*60*60*24)/ (60*60));
                    $minutes = floor(($diff - $years * 365*60*60*24- $months*30*60*60*24 - $days*60*60*24- $hours*60*60)/ 60);
                    if($date2 < $date1){
                        $timeEpapsed ='<span style="color:#ff464d;">(Promo Expired)</span>';
                    }else{
                        $timeEpapsed ='<span style="color:#06551f;">(' .$days.'D '.$hours.'H '.$minutes.'m)</span>';
                    }
                    if (!in_array($country, get_post_meta($casinoID, 'casino_custom_meta_rest_countries', true)) && $promoEndTime >= $dt && $isrestricted !== 'restricted' && $onlyshow !== 'restricted') {
//                        $checked = in_array($promoID, $premiumPromoSettingsArray) ? 'checked="checked"' : "";
                        $exclu='';
                        if ($exlusive === 'on'){
                            $exclu='<b class="float-right" style="color: red">Exclusive</b>';
                        }
                        if(in_array($casinoID,$premiumCasino)){ ?>
                            <li  class="p-1 w-90" id="<?= $promoID ?>" data-value="<?= $promoID ?>"><b class="mr-5p">(<i class="fa fa-star mr-3p text-secondary"></i> <?=get_the_title($casinoID)?>)</b><?= get_the_title($promoID) ?><b class="ml-5p"><?=$timeEpapsed?></b><?=$exclu?></li>
                            <?php
                        }elseif (!get_post_meta($casinoID, 'casino_custom_meta_hidden', true) && !get_post_meta($casinoID, 'casino_custom_meta_flaged', true)) { ?>
                            <li  class="p-1 w-90" id="<?= $promoID ?>" data-value="<?= $promoID ?>"><b class="mr-5p">(<?=get_the_title($casinoID)?>)</b><?= get_the_title($promoID) ?><b class="ml-5p"><?=$timeEpapsed?></b><?=$exclu?></li>
                        <?php } else {
                            continue ?>
                            <!--                            <li class="p-1 bg-danger w-90" id="--><?//= $promoID ?><!--"-->
                            <!--                                data-value="--><?//= $promoID ?><!--"><b class="mr-5p">(--><?//=get_the_title($casinoID)?><!--)</b>--><?//= get_the_title($promoID) ?><!-- (Hidden or-->
                            <!--                                Flagged)<input --><?//= $checked ?><!-- class="m-0 float-right" type="checkbox" value="1"/>-->
                            <!--                            </li>-->
                        <?php } ?>

                    <?php }
                }?>
            </ol>
            <?php
                    if ($typefilter === 'promotype') {
                        ?>
                        <input type="hidden"
                               class="form-control form-control-sm"
                               data-target="premium-promotions-<?=$firstfilter?>-<?=$secondfilter?>-<?= $country?>[ids]"
                               name="premium-promotions-<?=$firstfilter?>-<?=$secondfilter?>-<?= $country?>[ids]"
                               value="<?php echo $premiumPromoSettings['ids']?>"/>
                        <input type="hidden"
                               class="form-control form-control-sm"
                               data-target="premium-promotions-<?=$firstfilter?>-<?=$secondfilter?>-<?= $country?>[premium]"
                               name="premium-promotions-<?=$firstfilter?>-<?=$secondfilter?>-<?= $country?>[premium]"
                               value="<?php echo isset($this->settings['premium']) ? $this->settings['premium'] : "" ?>"/>
                        <?php
                    }else{
                        ?>
                        <input type="hidden"
                               class="form-control form-control-sm"
                               data-target="premium-promotions-<?=$secondfilter?>-<?=$firstfilter?>-<?= $country?>[ids]"
                               name="premium-promotions-<?=$secondfilter?>-<?=$firstfilter?>-<?= $country?>[ids]"
                               value="<?php echo $premiumPromoSettings['ids'] ?>"/>
                        <input type="hidden"
                               class="form-control form-control-sm"
                               data-target="premium-promotions-<?=$secondfilter?>-<?=$firstfilter?>-<?= $country?>[premium]"
                               name="premium-promotions-<?=$secondfilter?>-<?=$firstfilter?>-<?= $country?>[premium]"
                               value="<?php echo isset($this->settings['premium']) ? $this->settings['premium'] : "" ?>"/>
                        <?php
                    }
            ?>

        </div>
        <div class="d-flex flex-wrap mb-10p border-bottom border-primary">
        <?php
        if ($typefilter === 'promotype') {
            echo '<button href="javascript:void(0)" class="btn btn-sm btn-secondary" data-settings-id="premium" data-type="' . $this->postType . '" data-settingsCountry="' . $country . '" data-day="' . $secondfilter . '" data-category=' . $firstfilter . ' onclick="savefilterPromos(event,this)">Save options for <b>' . ucwords($this->translatedCountries[$country]) . '</b></button>';
        }else{
            echo '<button href="javascript:void(0)" class="btn btn-sm btn-secondary" data-settings-id="premium" data-type="' . $this->postType . '" data-settingsCountry="' . $country . '" data-day="' . $firstfilter . '" data-category=' . $secondfilter . ' onclick="savefilterPromos(event,this)">Save options for <b>' . ucwords($this->translatedCountries[$country]) . '</b></button>';
        }
        if ($typefilter === 'promotype') {
            echo '<button href="javascript:void(0)" class="btn btn-sm text-dark" style="background:#f3eaea;margin-left:15px;" data-settings-id="premium" data-type="' . $this->postType . '" data-settingsCountry="' . $country . '" data-day="' . $secondfilter . '" data-category=' . $firstfilter . ' onclick="ResetfilterPromos(event,this)">Reset options for <b>' . ucwords($this->translatedCountries[$country]) . '</b></button>';
        }else{
            echo '<button href="javascript:void(0)" class="btn btn-sm text-dark" style="background:#f3eaea;margin-left:15px;" data-settings-id="premium" data-type="' . $this->postType . '" data-settingsCountry="' . $country . '" data-day="' . $firstfilter . '" data-category=' . $secondfilter . ' onclick="ResetfilterPromos(event,this)">Reset options for <b>' . ucwords($this->translatedCountries[$country]) . '</b></button>';
        }
        ?>
        </div>
        <?php
        return ob_get_clean();
    }

    private function featuredTransactions()
    {
        $casinos = get_all_posts(['kss_transactions','kss_crypto']);
        $orderCasinoSetings = $this->settings;
        $orderCasinoSetingsArray = isset($orderCasinoSetings) ? explode(',',$orderCasinoSetings) : [];
        $orderCasinoSetingsArray = array_map('intval', $orderCasinoSetingsArray);
        $finalCasinos = !empty($orderCasinoSetingsArray) ? $orderCasinoSetingsArray : $casinos;
        if(!empty($orderCasinoSetingsArray))$finalCasinos = array_merge($finalCasinos,array_diff($casinos,$orderCasinoSetingsArray));
        ob_start();?>
        <div class="w-100 mb-5p">
            <label for="" class="d-block text-center bg-secondary mb-2p border-bottom border-primary p-4p"><b>Premium Order
                    Casino</b></label>
            <ol class="w-80 mb-5p sortable_bookie_list ui-sortable" name="premium-<?=$this->postType?>-<?= $this->countryISO ?>[]" id="premium-<?=$this->postType?>-<?= $this->countryISO ?>" ><!--style="columns: 2;-webkit-columns: 2;-moz-columns: 2;"-->
                <?php foreach ($finalCasinos as $casinoID) {
                        if (get_post_status($casinoID) === 'draft') { ?>
                            <li id="<?= $casinoID ?>" data-value="<?= $casinoID ?>"
                                class="bg-warning w-90"><?= get_the_title($casinoID) ?></li>
                        <?php } else { ?>
                                <li class="p-1 w-90" id="<?= $casinoID ?>"
                                    data-value="<?= $casinoID ?>"><?= get_the_title($casinoID) ?></li>

                        <?php } ?>
                    <?php
                }?>
            </ol>
            <input type="hidden"
                   class="form-control form-control-sm"
                   data-target="premium-<?=$this->postType?>-<?= $this->countryISO ?>[ids]"
                   name="premium-<?=$this->postType?>-<?= $this->countryISO ?>[ids]"
                   value="<?php echo isset($this->settings) ? $this->settings : "" ?>"/>
        </div>
        <?php
        return ob_get_clean();
    }
    private function featuredSoftwares()
    {
        $casinos = get_all_posts('kss_softwares');
        $orderCasinoSetings = $this->settings;
        $orderCasinoSetingsArray = isset($orderCasinoSetings) ? explode(',',$orderCasinoSetings) : [];
        $orderCasinoSetingsArray = array_map('intval', $orderCasinoSetingsArray);
        $finalCasinos = !empty($orderCasinoSetingsArray) ? $orderCasinoSetingsArray : $casinos;
        if(!empty($orderCasinoSetingsArray))$finalCasinos = array_merge($finalCasinos,array_diff($casinos,$orderCasinoSetingsArray));
        ob_start();?>
        <div class="w-100 mb-5p">
            <label for="" class="d-block text-center bg-secondary mb-2p border-bottom border-primary p-4p"><b>Premium Order
                    Providers</b></label>
            <ol class="w-80 mb-5p sortable_bookie_list ui-sortable" name="premium-<?=$this->postType?>-<?= $this->countryISO ?>[]" id="premium-<?=$this->postType?>-<?= $this->countryISO ?>" ><!--style="columns: 2;-webkit-columns: 2;-moz-columns: 2;"-->
                <?php foreach ($finalCasinos as $casinoID) {
                    if (get_post_status($casinoID) === 'draft') { ?>
                        <li id="<?= $casinoID ?>" data-value="<?= $casinoID ?>"
                            class="bg-warning w-90"><?= get_the_title($casinoID) ?></li>
                    <?php } else { ?>
                        <li class="p-1 w-90" id="<?= $casinoID ?>"
                            data-value="<?= $casinoID ?>"><?= get_the_title($casinoID) ?></li>
                    <?php } ?>
                    <?php
                }?>
            </ol>
            <input type="hidden"
                   class="form-control form-control-sm"
                   data-target="premium-<?=$this->postType?>-<?= $this->countryISO ?>[ids]"
                   name="premium-<?=$this->postType?>-<?= $this->countryISO ?>[ids]"
                   value="<?php echo isset($this->settings) ? $this->settings : "" ?>"/>
        </div>
        <?php
        return ob_get_clean();
    }
    private function buildOptions()
    {
        $ret = '<div class="d-flex flex-wrap mb-10p border-bottom border-primary">';
        $func = 'featured'.$this->postType;
        $ret .= $this->$func();
        $ret .= $this->saveButton();
        $ret .= '</div>';
        return $ret;
    }
    public static function savePremium($ids,$premium,$iso,$postType)
    {
        if($postType ==='casino' || $postType ==='promotions'){
            $settings['ids']=str_replace(" ","",$ids);
            $settings['premium']=str_replace(" ","",$premium);
        }elseif($postType ==='transactions' || $postType ==='softwares'){
            $settings=str_replace(" ","",$ids);
        }
        $save = update_option('premium-'.$postType.'-' . $iso, $settings);
        return $save ? true : false;
    }

    public static function savePremiumPromos($ids,$premium,$iso,$postType,$category,$day)
    {
        $settings['ids']=str_replace(" ","",$ids);
        $settings['premium']=str_replace(" ","",$premium);
        $save = update_option('premium-'.$postType.'-'.$category.'-'.$day.'-' . $iso, $settings);
        return $save ? true : false;
    }
    public static function FilterPremiumBy($country,$firstfilter,$secondfilter,$typefilter)
    {
        $instance = new Premium($country,'promotions');
        return $instance->dofilterPromos($country,$firstfilter,$secondfilter,$typefilter);
    }
    public static function loadPremium($args,$postType)
    {
        $instance = new Premium($args,$postType);
        return $instance->buildOptions();
    }
}