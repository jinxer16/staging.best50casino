<?php

//security
defined('ABSPATH') or die('You\'re not supposed to be here.');
class CasinoSharkcodes
{
    private $casinos;
    private $args;
    private $geoCountry;
    private $geoPremiumCasinos;
    private $sortorder;

    /**
     * @return mixed
     */
    public function getSortorder()
    {
        return $this->sortorder;
    }

    /**
     * @param mixed $sortorder
     */
    public function setSortorder($sortorder)
    {
        $this->sortorder = $sortorder;
    }

    /**
     * @param mixed $casinos
     */
    public function setCasinos($casinos)
    {
        $this->casinos = $casinos;
    }

    /**
     * @return mixed
     */
    public function getCasinos()
    {
        return $this->casinos;
    }

    /**
     * @param mixed $args
     */
    public function setArgs($args)
    {
        $this->args = $args;
    }

    /**
     * @return mixed
     */
    public function getArgs()
    {
        return $this->args;
    }

    /**
     * @param mixed $geoCountry
     */
    public function setGeoCountry($geoCountry)
    {
        $this->geoCountry = $geoCountry;
    }

    /**
     * @return mixed
     */
    public function getGeoCountry()
    {
        return $this->geoCountry;
    }

    /**
     * @return mixed
     */
    public function getGeoPremiumCasinos()
    {
        return $this->geoPremiumCasinos;
    }

    /**
     * @param mixed $geoPremiumCasinos
     */
    public function setGeoPremiumCasinos($geoPremiumCasinos)
    {
        $this->geoPremiumCasinos = $geoPremiumCasinos;
    }
    public function __construct($args)
    {
        $this->clearFiltersAndSetArgs($args);
        $this->setupGeo();//DONE
        $sorting = $this->sortQuery($args['sort_by']);//DONE
        $this->setSortorder($args['sortorder']);
        $this ->getPostsQuery($sorting);//DONE
        $this->removeHidden(); //DONE
        if(isset($this->args['offset_csn']) || isset($this->args['cho_csn'])) $this->applyChoice();//DONE
        if(!isset($this->args['country_specific']))  $this->applyGeo(); //disableGEO και accepts players form δεν πάνε μαζί ποια
        $this->applyFilters();
        $this->limitAndPagination();//DONE

//        $this->clearFilters($args);

    }

    private function setupGeo(){
        if(isset($this->args['country_specific'])){
            $this->setGeoCountry($this->args['country_specific']);
        }else{
//            if(current_user_can('administrator')){
//                print_r($GLOBALS['countryISO']);
//            }
            $this->setGeoCountry($GLOBALS['countryISO']);
        }
    }

    private function clearFiltersAndSetArgs($args){
        foreach ($args as $key=>$value){
            if(is_null($value) || $value == '')
                unset($args[$key]);
        }
        $this->setArgs($args);
    }

    private function getPostsQuery($sorting){
        if(isset($this->args['sort_by']) && !in_array($this->args['sort_by'],['bs_custom_meta_nodep','bs_custom_meta_exclusive','premium','premium_only','custom','bs_custom_meta_promo_amount','bs_custom_meta_bc_perc','bs_custom_meta_wag_b','bs_custom_meta_cashback_type'])) {
            // Get any existing copy of our transient data
            if (false === ($query_casinoss = get_transient('query_casinos-'.$this->args['sort_by'].'-'.$this->sortorder.'-'.$this->geoCountry))) {
                // It wasn't there, so regenerate the data and save the transient
                $query_casinos = array( // A QUERY that initializes the default (all) IDS
                    'post_type' => array('kss_casino'),
                    'post_status' => array('publish'),
                    //'no_found_rows' => true,
                    'update_post_term_cache' => false,
                    'posts_per_page' => 999,
                    'fields' => 'ids',
                    'orderby' => $sorting[0],
                    'meta_key' => $sorting[1],
                    'order' => $this->sortorder,
                    'meta_query' => [$sorting[2]]
                );
                $query_casinoss = new WP_Query($query_casinos);
                set_transient('query_casinos-'.$this->args['sort_by'].'-'.$this->sortorder.'-'.$this->geoCountry, $query_casinoss, 60 * 60 * 12);
            }
            $this->setCasinos($query_casinoss->posts);
        }elseif($this->args['sort_by'] ==='premium' || !isset($this->args['sort_by'])){
            $premiumCasino = \WordPressSettings::getPremiumCasino($this->geoCountry,'premium');
            $allCasinos = \WordPressSettings::getPremiumCasino($this->geoCountry,'order');
            $premiumCasino = explode(",",$premiumCasino);
            $allCasinos = explode(",",$allCasinos);
            $this->setGeoPremiumCasinos($premiumCasino);
            $this->setCasinos($allCasinos);
        }elseif($this->args['sort_by'] ==='premium_only'){
            $premiumCasino = \WordPressSettings::getPremiumCasino($this->geoCountry,'premium');
            $premiumCasino = explode(",",$premiumCasino);
            $this->setGeoPremiumCasinos($premiumCasino);
            $this->setCasinos($premiumCasino);
        }elseif ($this->args['sort_by'] === 'custom'){
            $casino = explode(",",$this->args['custom_cas_order']);
            $this->setCasinos($casino);
        }else{
            $allCasinos = \WordPressSettings::getPremiumCasino($this->geoCountry,'order');
            $premiumCasino = explode(",",$allCasinos);
            $localArray = [];
            $globalArray = [];
            foreach ($premiumCasino as $casinoID){
//                $bonuspageID = get_post_meta($casinoID,'casino_custom_meta_bonus_page',true);
//                $bonusID = get_post_meta($bonuspageID,'bonus_custom_meta_bonus_offer',true);
                $possibleNoBonus = get_post_meta($casinoID,$this->geoCountry.'casino_custom_meta_no_bonus',true);
                if($possibleNoBonus==1)continue;
                $bonusAvailability = get_post_meta($casinoID,'casino_custom_meta_bonus_contries_filled',true);
                $iso = in_array($this->geoCountry,$bonusAvailability) ? $this->geoCountry:'glb';
//                $iso = in_array($this->geoCountry,$bonusAvailability) && $this->args['sort_by']=='bs_custom_meta_exclusive'? $this->geoCountry:'glb';
                $meta = str_replace('bs', 'casino', $this->args['sort_by']);
                $key = get_post_meta($casinoID,$iso.$meta,true);
                if($this->args['sort_by'] === 'bs_custom_meta_promo_amount'){
                    $key = str_replace([',', '.'],'',$key);
                    if(strpos($key, '$') !== false || strpos($key, '€')){
                        if(strpos($key, '$')){
                            $key = str_replace(['$','€'],'',$key);
                            $key = intval($key);
                            $key=0.8527*$key;
                        }else{
                            $key = str_replace(['$','€'],'',$key);
                            $key = intval($key);
                        }
                        if($key!=0){
                            $globalArray[$casinoID] = $key;
                        }
                    }else{
                        $key = str_replace(['₹','£',
                            'AUD','CAD','NZD','BRL',
                            'DKK','HUF','MYR','NOK',
                            'PLN','SGD','IDR','ZAR',
                            'THB','SEK','CHF','UAH',
                            'CZK','BGN','R','UD'],'',$key);
                        $key = intval($key);
                        if($key!=0) {
                            $localArray[$casinoID] = $key;
                        }
                    }

                }elseif($this->args['sort_by'] === 'bs_custom_meta_bc_perc' || $this->args['sort_by'] === 'bs_custom_meta_cashback_type'){
                    $key = rtrim($key, '%');
                    $key = intval($key);
                    $customArray[$casinoID] = $key;
                }elseif($this->args['sort_by'] === 'bs_custom_meta_wag_b'){
                    $key = str_replace('x','',$key);
                    $key = intval($key);
                    $customArray[$casinoID] = $key;
                }elseif($this->args['sort_by'] === 'bs_custom_meta_exclusive'){
                    if($key === 'on'){
                        $key = 1;
                    }else{
                        $key = 0;
                    }

                }
                $customArray[$casinoID] = $key;

            }

            $SortArray = $this->sortorder;
            if ($SortArray === 'DESC'){
                arsort($customArray);
                arsort($globalArray);
                arsort($localArray);
            }else{
                asort($customArray);
                asort($globalArray);
                asort($localArray);
            }
//            if(current_user_can('administrator')){
//                    echo '<pre>';
//                    print_r($globalArray);
//                echo '--------------------';
//                    print_r($localArray);
//                    echo '</pre>';
//            }
            if(!empty($globalArray) || !empty($localArray)){
                if(!empty($localArray)){
                    foreach ($localArray as $cadID=>$price){
                        $ret[] = $cadID;
                    }
                }
                if(!empty($globalArray)){
                    foreach ($globalArray as $cadID=>$price){
                        $ret[] = $cadID;
                    }
                }

            }else{
                foreach ($customArray as $casID=>$value) {
                    $ret[] = $casID;
                }
            }


            $this->setCasinos($ret);
        }
    }


    private function sortQuery ($sort='default'){
        switch ($sort){
            case 'random':
                $sort_by = 'rand';
                $sort_val = '';
                $query_array[] = null;
                break;
            case 'nodep':
                $sort_by = 'meta_value_num';
                $sort_val = 'nodep';
                $query_array[] = null;
                break;
            case 'casino_custom_meta_com_estab':
                $sort_by = 'meta_value_num';
                $sort_val = 'casino_custom_meta_com_estab';
                $query_array[] = null;
                break;
            case 'launch':
                $sort_by = 'publish_date';
                $sort_val = null;
                $query_array[] = null;
                break;
            case 'witspeed':
                $sort_by = 'meta_value_num';
                $sort_val = 'witspeed';
                $query_array[] = null;
                break;
            case 'highrollers':
                $sort_by = 'meta_value_num';
                $sort_val = 'highrollers';
                $query_array[] = null;
                break;
            case 'rating':
                $sort_by = 'meta_value_num';
                $sort_val = 'casino_custom_meta_sum_rating';
                $query_array[] = null;
                break;
            case 'games':
                $sort_by = 'meta_value_num';
                $sort_val = 'games';
                $query_array[] = null;
                break;
            case 'Payout':
                $sort_by = 'meta_value_num';
                $sort_val = 'Payout';
                $query_array[] = null;
                break;
            case 'spins':
                $sort_by = 'meta_value_num';
                $sort_val = 'spins';
                $query_array[] = null;
                break;
            case 'bonus':
                $sort_by = 'meta_value_num';
                $sort_val = 'bonus';
                $query_array[] = null;
                break;
            case 'jackpot':
                $sort_by = 'meta_value_num';
                $sort_val = 'jackpot';
                $query_array[] = null;
                break;
            case 'special_popular':
                $sort_by = 'meta_value_num';
                switch ($this->args['specific_ratings']) {
                    case 'bonuses':
                        $sort_val = 'casino_custom_meta_offers_rating';
                        break;
                    case 'software':
                        $sort_val = 'casino_custom_meta_site_rating';
                        break;
                    case 'B50quality':
                        $sort_val = 'casino_custom_meta_games_rating';
                        break;
                    case 'payout':
                        $sort_val = 'casino_custom_meta_withdrawal_rating';
                        break;
                    case 'fairness':
                        $sort_val = 'casino_custom_meta_license_rating';
                        break;
                }
                $query_array[] = null;
                break;
            case 'exclusive':
                $sort_by = 'meta_value_num';
                $sort_val = 'casino_custom_meta_offers_rating';
                $query_array[] = array(
                    'key' => 'casino_custom_meta_exclusive',
                    'compare' => 'EXISTS',
                );
                break;
            default:
                $sort_by = '';
                $sort_val = '';
                $query_array[] = null;
        }
        return [$sort_by, $sort_val,$query_array];
    }
    private function removeHidden(){
        $casinoss = $this->casinos;
        foreach ($casinoss as $key=>$id){
            if( get_post_meta($id,'casino_custom_meta_flaged',true) || get_post_meta($id,'casino_custom_meta_hidden',true) || get_post_status($id) != 'publish'){
                unset($casinoss[$key]);
            }
        }
        $this->setCasinos($casinoss);
    }
    private function limitAndPagination(){
        $casinoss = $this->casinos;

        $limit = $this->args['limit'];
        $page = isset($this->args['page']) ? $this->args['page'] : 1 ;
        $pageModifier = $page - 1;
        $offset = $pageModifier*5;
        $nmrOfCasinos = count($casinoss);

        if($nmrOfCasinos > $limit) {
            $balanceNumber = $nmrOfCasinos - $limit;
            $this->setCasinos(array_slice($casinoss,$offset,$limit));
        }

    }

    private function applyGeo(){
        $filterHiddenBookies = $this->casinos;
        foreach ($filterHiddenBookies as $key=>$id){
            $restricted = get_post_meta((int)$id,'casino_custom_meta_rest_countries',true);
            if (is_array($restricted)) $restrictedFliped = array_flip($restricted);
            if( isset($restrictedFliped[$GLOBALS['visitorsISO']]) ){
                unset($filterHiddenBookies[$key]);
            }
        }
        $this->setCasinos($filterHiddenBookies);
    }
    private function applyChoice(){
        $filterHiddenBookies = $this->casinos;
        if(isset($this->args['cho_csn'])){
            $chosenCasinos = explode(",",$this->args['cho_csn']);
            $filterHiddenBookies = array_intersect($filterHiddenBookies,$chosenCasinos);
        }elseif(isset($this->args['offset_csn'])){
            $offsetCasinos = explode(",",$this->args['offset_csn']);
            $filterHiddenBookies = array_diff($filterHiddenBookies,$offsetCasinos);
        }
//        return $filterHiddenBookies;
        $this->setCasinos($filterHiddenBookies);
    }
    private function meta_filters($query = null, $filters= '', $val,$logic=null){
        if (!empty($query)):
            if(is_array($val)) $wishElementsNumber = count($val);
            foreach ( $query as $key=>$id) {
                $filterMeta = get_post_meta((int)$id,$filters,true);
                if(!is_array($filterMeta) && !is_array($val)){
                    if($filterMeta != $val){
                        unset($query[$key]);
                    }
                }elseif(!is_array($filterMeta) && is_array($val)){
                    if(!in_array($filterMeta,$val)) unset($query[$key]);
                }else {
                    $commonElements = array_intersect($val, $filterMeta);
                    $commonElementsNumber = count($commonElements);
                    if ($logic == 'OR') {
                        if ($commonElementsNumber == 0 ) unset($query[$key]);
                    } else {
                        if ($commonElementsNumber == 0 || $commonElementsNumber < $wishElementsNumber) unset($query[$key]);
                    }
                }

            }
        endif;
        return $query;
    }

    private function single_meta_filters($query = null, $filters = '', $val = null){
        if (!empty($query)):
            foreach ( $query as $key=>$id) {
                $filter = get_post_meta($id,$filters,true);
                if(!$filter) unset($query[$key]);
            }
        endif;
        return $query;
    }
    private function payment_filters($query = null, $payType, $val){
        if (!empty($query)):
            foreach ( $query as $key=>$id) {
                foreach ($val as $paymentID){
                    $filterMeta = get_post_meta((int)$id,$paymentID.'_'.$payType.'_available',true);
                    if($filterMeta != 1 ||  !$filterMeta) unset($query[$key]);
                }
            }
        endif;
        return $query;
    }

    private function rating_filters($query = null, $filters = '', $val){
        if (!empty($query)):
            foreach ( $query as $key=>$id) {
                $filter = get_post_meta($id,$filters,true);
                if($val == 4){
                    if($filter >= 5) unset($query[$key]);
                }else{
                    if($filter < $val) unset($query[$key]);
                }

            }
        endif;
        return $query;
    }

    private function exclusive_bonus_filters( $query , $geoCountry ){
        if (!empty($query)):
            foreach ( $query as $key=>$id) {
                $bonusAvailableCountries = get_post_meta($id,'casino_custom_meta_bonus_contries_filled',true);
                if(!in_array($geoCountry,$bonusAvailableCountries)){
                    unset($query[$key]);
                }else{
                    $exclusiveness = get_post_meta($id,$geoCountry.'casino_custom_meta_exclusive',true);
                    if(!$exclusiveness){
                        unset($query[$key]);
                    }
                }
            }
        endif;
        return $query;
    }


    private function bonus_filters( $query , $filterValue ,$geoCountry){
        if (!empty($query)):
            foreach ( $query as $key=>$id) {

                $filters =
                    array(
                        '67' => 'casino_custom_meta_bc_code',
                        '56' => 'casino_custom_meta__is_free_spins',
                        '50' => 'casino_custom_meta__is_live_bonus',
                        '48' => 'casino_custom_meta__is_no_dep',
                        '49' => 'casino_custom_meta__is_reload_bonus',
                        '54' => 'casino_custom_meta__is_vip',
                        '47' => 'casino_custom_meta__is_welcome_bonus',
                        '53' => 'casino_custom_meta__is_mobile_bonus',
                    );

                $bonusID = [];
                foreach ($filters as $k => $v) {
                    if ($k === $filterValue){
                        if ($k === '67' && $k === $filterValue){
                            $exclusiveness = get_post_meta($id, $geoCountry.$v, true);
                            if (!empty($exclusiveness)) {
                                unset($query[$key]);
                            }
                        }else{
                            if ($k === $filterValue) {
                                $exclusiveness = get_post_meta($id, $geoCountry . $v, true);
                                if (!isset($exclusiveness)) {
                                    unset($query[$key]);
                                }
                            }
                        }
                    }
                }
            }
        endif;
        return $query;
    }
    public function applyFilters(){
        $atts = $this->args;
        $filteredGeoBookies = $this->casinos;
        if (isset($atts['live_video']) && $atts['live_video'] === 'on') {
            $filteredGeoBookies = $this->single_meta_filters($filteredGeoBookies,'casino_custom_meta_live_casino', $atts['live_video']);
        }
        if (isset($atts['mobile']) && $atts['mobile'] === 'on') {
            $filteredGeoBookies = $this->single_meta_filters($filteredGeoBookies,'casino_custom_meta_mobile_casino', $atts['mobile']);
        }
        if (isset($atts['audit']) && $atts['audit'] !== null) {
            $filterValue  = strpos($this->args['audit'], ',') !== false ? explode(",",$atts['audit'] ) : [$atts['audit']];
            $filteredGeoBookies = $this->meta_filters( $filteredGeoBookies,'casino_custom_meta_auditing', $filterValue,'OR');
        }
        if (isset($atts['software']) && $atts['software'] !== null) {
            $filterValue  = strpos($this->args['software'], ',') !== false ? explode(",",$atts['software'] ) : [$atts['software']];
            $filteredGeoBookies = $this->meta_filters( $filteredGeoBookies,'casino_custom_meta_softwares', $filterValue);
        }
        if (isset($atts['live_software']) && $atts['live_software'] !== null) {
            $filterValue  = strpos($this->args['live_software'], ',') !== false ? explode(",",$atts['live_software'] ) : [$atts['live_software']];
            $filteredGeoBookies = $this->meta_filters( $filteredGeoBookies,'casino_custom_meta_live_softwares', $filterValue);
        }
        if (isset($atts['deposit']) && $atts['deposit'] !== null) {
            $filterValue  = strpos($this->args['deposit'], ',') !== false ? explode(",",$atts['deposit'] ) : [$atts['deposit']];
            $filteredGeoBookies = $this->meta_filters( $filteredGeoBookies,'casino_custom_meta_dep_options', $filterValue);
        }
        if (isset($atts['withdraw']) && $atts['withdraw'] !== null) {
            $filterValue  = strpos($this->args['withdraw'], ',') !== false ? explode(",",$atts['withdraw'] ) : [$atts['withdraw']];
            $filteredGeoBookies = $this->meta_filters( $filteredGeoBookies,'casino_custom_meta_withd_options', $filterValue);
        }
        if (isset($atts['mob_plat']) && $atts['mob_plat'] !== null) {
            $filterValue  = strpos($this->args['mob_plat'], ',') !== false ? explode(",",$atts['mob_plat'] ) : [$atts['mob_plat']];
            $filteredGeoBookies = $this->meta_filters( $filteredGeoBookies,'casino_custom_meta_platforms', $filterValue);
        }
        if (isset($atts['lang_sup_site']) && $atts['lang_sup_site'] !== null) {
            $filterValue  = strpos($this->args['lang_sup_site'], ',') !== false ? explode(",",$atts['lang_sup_site'] ) : [$atts['lang_sup_site']];
            $filteredGeoBookies = $this->meta_filters( $filteredGeoBookies,'casino_custom_meta_lang_sup_site', $filterValue);
        }
        if (isset($atts['lang_sup_cs']) && $atts['lang_sup_cs'] !== null) {
            $filterValue  = strpos($this->args['lang_sup_cs'], ',') !== false ? explode(",",$atts['lang_sup_cs'] ) : [$atts['lang_sup_cs']];
            $filteredGeoBookies = $this->meta_filters( $filteredGeoBookies,'casino_custom_meta_lang_sup_cs', $filterValue);
        }
        if (isset($atts['cur_acc']) && $atts['cur_acc'] !== null) {
            $filterValue  = strpos($this->args['cur_acc'], ',') !== false ? explode(",",$atts['cur_acc'] ) : [$atts['cur_acc']];
            $filteredGeoBookies = $this->meta_filters( $filteredGeoBookies,'casino_custom_meta_cur_acc', $filterValue);
        }
        if (isset($atts['license_country']) && $atts['license_country'] !== null) {
            $filterValue  = strpos($this->args['license_country'], ',') !== false ? explode(",",$atts['license_country'] ) : [$atts['license_country']];
            $filteredGeoBookies = $this->meta_filters( $filteredGeoBookies,'casino_custom_meta_license_country', $filterValue);
        }
        if (isset($atts['license_country_or']) && $atts['license_country_or'] !== null) {
            $filterValue  = strpos($this->args['license_country_or'], ',') !== false ? explode(",",$atts['license_country_or'] ) : [$atts['license_country_or']];
            $filteredGeoBookies = $this->meta_filters( $filteredGeoBookies,'casino_custom_meta_license_country', $filterValue,'OR');
        }
        if (isset($atts['games']) && $atts['games'] !== null) {
            $filterValue  = strpos($this->args['games'], ',') !== false ? explode(",",$atts['games'] ) : [$atts['games']];
            $filteredGeoBookies = $this->meta_filters( $filteredGeoBookies,'casino_custom_meta_games', $filterValue);
        }
        if (isset($atts['live_games']) && $atts['live_games'] !== null) {
            $filterValue  = strpos($this->args['live_games'], ',') !== false ? explode(",",$atts['live_games'] ) : [$atts['live_games']];
            $filteredGeoBookies = $this->meta_filters( $filteredGeoBookies,'casino_custom_meta_live_games', $filterValue);
        }
        if (isset($atts['year_est']) && $atts['year_est'] !== null) {
            $filterValue  = strpos($this->args['year_est'], ',') !== false ? explode(",",$atts['year_est'] ) : $atts['year_est'];
            $filteredGeoBookies = $this->meta_filters( $filteredGeoBookies,'casino_custom_meta_com_estab', $filterValue);
        }
        if (isset($atts['cat_in_filter']) && $atts['cat_in_filter'] === 'exclusive') {
            $filteredGeoBookies = $this->exclusive_bonus_filters( $filteredGeoBookies,$this->geoCountry);
        }
        if (isset($atts['cat_in_filter']) && $atts['cat_in_filter'] !== 'exclusive') {
            $filterValue  = strpos($this->args['cat_in_filter'], ',') !== false ? explode(",",$atts['cat_in_filter'] ) : [$atts['cat_in_filter']];
            $filteredGeoBookies = $this->bonus_filters( $filteredGeoBookies,$filterValue,$this->geoCountry);
        }
        $filterCasinos = $filteredGeoBookies;
        $this->setCasinos($filterCasinos);
    }
    private function countPremium(){
        if (!$this->getGeoPremiumCasinos()){
            $premiumCasino = \WordPressSettings::getPremiumCasino($this->geoCountry,'premium');
            $premiumCasino = explode(",",$premiumCasino);
            $this->setGeoPremiumCasinos($premiumCasino);
        }
        $PremiumCasinos = $this->getGeoPremiumCasinos();
        return $PremiumCasinos;
    }
    public static function returnBookies($args){
        $instance = new CasinoSharkcodes($args);
        $ret['casinos'] = $instance->getCasinos();
        $ret['onlyPremium'] = $instance->countPremium();
        return $ret;
    }
}