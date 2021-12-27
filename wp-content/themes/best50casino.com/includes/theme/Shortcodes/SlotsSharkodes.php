<?php

//security
defined('ABSPATH') or die('You\'re not supposed to be here.');
class SlotsSharkodes
{
    private $slots;
    private $args;

    /**
     * @return mixed
     */
    public function getslots()
    {
        return $this->slots;
    }

    /**
     * @param mixed $slots
     */
    public function setslots($slots)
    {
        $this->slots = $slots;
    }

    /**
     * @return mixed
     */
    public function getArgs()
    {
        return $this->args;
    }

    /**
     * @param mixed $args
     */
    public function setArgs($args)
    {
        $this->args = $args;
    }

    public function __construct($args)
    {
        $this->clearFiltersAndSetArgs($args);
        $sorting = $this->sortQuery($args['sort_by']);
        $this->getPostsQuery($sorting);
        if (isset($this->args['slot_in'])) $this->applyChoice();
        if (isset($this->args['slot_not_in'])) $this->applyChoice();
        $this->applyFilters();
        $this->limitAndPagination();//DONE
    }

    private function clearFiltersAndSetArgs($args)
    {
        foreach ($args as $key => $value) {
            if (is_null($value) || $value == '')
                unset($args[$key]);
        }
        $this->setArgs($args);
    }

    private function sortQuery($sort = 'default')
    {
        switch ($sort) {
            case 'default':
                $sort_by = '';
                $sort_val = '';
                $order = '';
                $query_array[] = null;
                break;
            case 'random':
                $sort_by = 'rand';
                $sort_val = '';
                $order = '';
                $query_array[] = null;
                break;
            case 'popular':
                $sort_by = 'meta_value_num';
                $sort_val = 'slot_custom_meta_slot_value';
                $order = 'DESC';
                $query_array[] = null;
                break;
            case 'rtp':
                $sort_by = 'meta_value_num';
                $sort_val = 'slot_custom_meta_rtp_perc';
                $order = 'DESC';
                $query_array[] = null;
                break;
            default:
                $sort_by = '';
                $sort_val = '';
                $order = '';
                $query_array[] = null;
        }
        return [$sort_by, $sort_val, $order, $query_array];
    }

    private function getPostsQuery($sorting)
    {
        // Get any existing copy of our transient data
        if (false === ($query_slotss = get_transient('query_slots-' . $this->args['sort_by']))) {
            // It wasn't there, so regenerate the data and save the transient
            $query_slots = array( // A QUERY that initializes the default (all) IDS
                'post_type' => array('kss_slots'),
                'post_status' => array('publish'),
                'update_post_term_cache' => false,
                'posts_per_page' => 999,
                'fields' => 'ids',
                'orderby' => $sorting[0],
                'meta_key' => $sorting[1],
                'order' => $sorting[2],
                'meta_query' => [$sorting[3]]
            );
            $query_slotss = new WP_Query($query_slots);
            set_transient('query_slots-' . $this->args['sort_by'], $query_slotss, 60 * 60 * 12);
        }
        $this->setslots($query_slotss->posts);
    }

    private function applyChoice()
    {
        $SortedSlots = $this->slots;
        if (isset($this->args['cho_csn'])) {
            $chosenSlots = explode(",", $this->args['slot_in']);
            $SortedAndChosenSlots = array_intersect($SortedSlots, $chosenSlots);
        } elseif (isset($this->args['offset_csn'])) {
            $offsetSlots = explode(",", $this->args['slot_not_in']);
            $SortedAndChosenSlots = array_diff($SortedSlots, $offsetSlots);
        }
        $this->setslots($SortedAndChosenSlots);
    }

    public function applyFilters()
    {
        $atts = $this->args;
        $SortedChosenFilteredSlots = $this->slots;
        if (isset($atts['platform']) && $atts['platform'] != null) {
            $filterValue  = strpos($this->args['platform'], ',') !== false ? explode(",",$atts['platform'] ) : [$atts['platform']];
            $SortedChosenFilteredSlots = $this->meta_filters( $SortedChosenFilteredSlots,'slot_custom_meta_slot_software', $filterValue);
        }
        if (isset($atts['casino_or']) && $atts['casino_or'] != null) {
            $filterValue  = strpos($this->args['casino_or'], ',') !== false ? explode(",",$atts['casino_or'] ) : [$atts['casino_or']];
            $SortedChosenFilteredSlots = $this->meta_filters( $SortedChosenFilteredSlots,'slot_custom_meta_slot_main_casino', $filterValue,'OR');
        }
        if (isset($atts['casino']) && $atts['casino'] != null) {
            $filterValue  = strpos($this->args['casino'], ',') !== false ? explode(",",$atts['casino'] ) : [$atts['casino']];
            $SortedChosenFilteredSlots = $this->meta_filters( $SortedChosenFilteredSlots,'slot_custom_meta_slot_main_casino', $filterValue);
        }
        if (isset($atts['slot_category']) && $atts['slot_category'] != null) {
            $filterValue  = strpos($this->args['slot_category'], ',') !== false ? explode(",",$atts['slot_category'] ) : [$atts['slot_category']];
            foreach($filterValue as $filter){
                switch ($filter){
                    case 'video':
                    case 'classic':
                        $SortedChosenFilteredSlots = $this->meta_filters( $SortedChosenFilteredSlots,'slot_custom_meta_classic_video', [ucwords($filter)]);
                        break;
                    case 'progressive':
                        $SortedChosenFilteredSlots = $this->single_meta_filters( $SortedChosenFilteredSlots,'slot_custom_meta_adv_jackpot_option', $filter);
                        break;
                    case '3d':
                        $SortedChosenFilteredSlots = $this->single_meta_filters( $SortedChosenFilteredSlots,'slot_custom_meta_3d_option', $filter);
                        break;
                }
            }

        }
        if (isset($atts['themes']) && $atts['themes'] != null) {
            $filterValue  = strpos($this->args['themes'], ',') !== false ? explode(",",$atts['themes'] ) : [$atts['themes']];
            $SortedChosenFilteredSlots = $this->meta_filters( $SortedChosenFilteredSlots,'slot_custom_meta_slot_theme', $filterValue,'OR');
        }
        if (isset($atts['label']) && $atts['label'] != null) {
            $filterValue  = strpos($this->args['label'], ',') !== false ? explode(",",$atts['label'] ) : [$atts['label']];
            $SortedChosenFilteredSlots = $this->meta_filters( $SortedChosenFilteredSlots,'slot_custom_meta_label', $filterValue,'OR');
        }
        if (isset($atts['reels']) && $atts['reels'] != null) {
            $filterValue  = strpos($this->args['reels'], ',') !== false ? explode(",",$atts['reels'] ) : [$atts['reels']];
            $SortedChosenFilteredSlots = $this->meta_filters( $SortedChosenFilteredSlots,'slot_custom_meta_slot_wheels', $filterValue);
        }
        if (isset($atts['paylines']) && $atts['paylines'] != null) {
            $SortedChosenFilteredSlots = $this->moreLessFilters( $SortedChosenFilteredSlots,'slot_custom_meta_slot_paylines', $atts['paylines']);
        }
        if (isset($atts['rtp']) && $atts['rtp'] != null) {
            $SortedChosenFilteredSlots = $this->moreLessFilters( $SortedChosenFilteredSlots,'slot_custom_meta_rtp_perc', $atts['rtp']);
        }
        $this->setslots($SortedChosenFilteredSlots);
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
    private function moreLessFilters($query = null, $filters = '', $val){
        $min = null;
        $max = null;
        if(strpos($val, '-')){
            $val = explode("-",$val);
            $min = (int)$val[0];
            $max = (int)$val[1];
        }else{
            $min = (int)$val;
            $max = null;
        }
        if (!empty($query)):
            foreach ( $query as $key=>$id) {
                $filter = get_post_meta($id,$filters,true);
                if(strpos($filter, '%')){ //for rtp
                    $filter = str_replace("%","",$filter);
                }
                $filter = (int)($filter);
                if(isset($min) && $filter < $min) unset($query[$key]);
                if(isset($max) && $filter > $max) unset($query[$key]);
            }
        endif;
        return $query;
    }
    private function limitAndPagination(){
        $finalSlots = $this->slots;
        $limit = $this->args['limit'];
        $page = isset($this->args['page']) ? $this->args['page'] : 1 ;
        $pageModifier = $page - 1;
        $offset = $pageModifier*5;
        $nmrOfCasinos = count($finalSlots);

        if($nmrOfCasinos > $limit) {
            $balanceNumber = $nmrOfCasinos - $limit;
            $this->setslots(array_slice($finalSlots,$offset,$limit));
        }
    }
    public static function returnSlots($args){
        $instance = new SlotsSharkodes($args);
        $ret = $instance->getslots();
        return $ret;
    }
}