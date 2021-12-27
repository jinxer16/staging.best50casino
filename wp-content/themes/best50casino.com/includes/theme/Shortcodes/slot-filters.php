<?php
function slots_filters_shortcode($atts){
    $atts = shortcode_atts(
        array(
            'layout' => 'sample',
        ), $atts, 'slots_filters') ;
    $prem_themes = array(
        '7s' => __('777', 'bet-o-shark'),
        'fruits' => __('Fruits', 'bet-o-shark'),
        'pharaoh' => __('Pharaoh', 'bet-o-shark'),
        'mythology' => __('Mythology', 'bet-o-shark'),
        'africa' => __('Africa', 'bet-o-shark'),
        'sport' => __('Sports', 'bet-o-shark'),
        'music' => _('Music'),
        'movies' => __('Movies', 'bet-o-shark'),
        'anc_greece' => __('Ancient Greece', 'bet-o-shark'),
    );
    $themes = array(
        'wild_west' => __('Wild West', 'bet-o-shark'),
        'east' => __('East', 'bet-o-shark'),
        'anc_rome' => __('Ancient Rome', 'bet-o-shark'),
        'comics' => __('Comics', 'bet-o-shark'),
        'women' => __('Women', 'bet-o-shark'),
        'crime' => __('Crime', 'bet-o-shark'),
        'sci_fi' => __('Sci-Fi', 'bet-o-shark'),
        'jungle' => __('Jungle', 'bet-o-shark'),
        'animals' => __('Animals', 'bet-o-shark'),
        'sea' => __('Sea', 'bet-o-shark'),
        'treasures' => __('Treasures', 'bet-o-shark'),
        'magic' => __('Magic', 'bet-o-shark'),
        'marvel' => __('Marvel', 'bet-o-shark'),
        'fairy_tales' => __('Fairytales', 'bet-o-shark'),
        'buterfly' => __('Butterflies', 'bet-o-shark'),
        'stones' => __('Gemstones', 'bet-o-shark'),

    );

    $softs = get_posts(array('post_type'=>'kss_softwares', 'posts_per_page' => -1 , 'post_status'    => array('publish'), 'order' => 'ASC', ));
    $ret = '
<div id="options2" class="d-block d-lg-none d-xl-none mobile-filters mb-10">
    <div id="" class="nav navbar-nav menu-games-mobile m-0 d-flex flex-row flex-nowrap align-items-center justify-content-between justify-content-md-start pt-5p pb-10p pl-0 pr-2p overflow-x-auto overflow-y-hidden text-nowrap bg-dark" data-group="type">
        <a id="all-slots" class="menu-item active button btn pt-7p pb-7p pl-15p pr-15p text-15 font-weight-bold text-dark bg-grey mt-0 mb-0 mr-2p ml-2p rounded-pill border-0" data-filter="*">All</a>
        <a href="#special-mobile" id="" class="menu-item pt-7p pb-7p pl-10p pr-10p text-15 font-weight-bold text-dark bg-grey mt-0 mb-0 mr-2p ml-2p rounded-pill border-0" data-toggle="collapse">Special Filters</a>
        <a href="#softwares-mobile" class="menu-item pt-7p pb-7p pl-10p pr-10p text-15 font-weight-bold text-dark bg-grey mt-0 mb-0 mr-2p ml-2p rounded-pill border-0" data-toggle="collapse">Providers</a>
        <a  href="#themes-mobile" class="menu-item pt-7p pb-7p pl-10p pr-10p text-15 font-weight-bold text-dark bg-grey mt-0 mb-0 mr-2p ml-2p rounded-pill border-0" data-toggle="collapse">Themes</a>
    </div>
    <div id="special-mobile" class="nav navbar-nav button-group submenu-games-mobile-special m-0 flex-row flex-nowrap align-items-center justify-content-between pt-5p pb-10p pl-0 pr-2p overflow-x-auto overflow-y-hidden text-nowrap bg-dark collapse" data-group="type3">
        <button id="" class="menu-item button btn pt-7p pb-7p pl-15p pr-15p text-15 font-weight-bold text-dark bg-grey mt-0 mb-0 mr-2p ml-2p rounded-pill border-0" data-filter="LEGEND">LEGEND</button>
        <button id="" class="menu-item button btn pt-7p pb-7p pl-15p pr-15p text-15 font-weight-bold text-dark bg-grey mt-0 mb-0 mr-2p ml-2p rounded-pill border-0" data-filter="BEST">BEST</button>
        <button id="" class="menu-item button btn pt-7p pb-7p pl-15p pr-15p text-15 font-weight-bold text-dark bg-grey mt-0 mb-0 mr-2p ml-2p rounded-pill border-0" data-filter="bestRTP">Best Payout</button>
        <button id="" class="menu-item button btn pt-7p pb-7p pl-15p pr-15p text-15 font-weight-bold text-dark bg-grey mt-0 mb-0 mr-2p ml-2p rounded-pill border-0" data-filter="Classic">Classic</button>
        <button id="" class="menu-item button btn pt-7p pb-7p pl-15p pr-15p text-15 font-weight-bold text-dark bg-grey mt-0 mb-0 mr-2p ml-2p rounded-pill border-0" data-filter="Video">Video</button>
        <button id="" class="menu-item button btn pt-7p pb-7p pl-15p pr-15p text-15 font-weight-bold text-dark bg-grey mt-0 mb-0 mr-2p ml-2p rounded-pill border-0" data-filter="3D">3D</button>
        <button id="" class="menu-item button btn pt-7p pb-7p pl-15p pr-15p text-15 font-weight-bold text-dark bg-grey mt-0 mb-0 mr-2p ml-2p rounded-pill border-0" data-filter="Jackpot">Jackpot</button>
    </div>
    <div  id="softwares-mobile" class="nav navbar-nav button-group submenu-games-mobile-softwares m-0 collapse flex-row flex-nowrap align-items-center justify-content-between pt-5p pb-10p pl-0 pr-2p overflow-x-auto overflow-y-hidden text-nowrap bg-dark" data-group="type2">';
    foreach ($softs as $software){
        $title = $software->post_title;
        if ('Play\'n Go' == $software->post_title){
            $class = "Play\'n.Go";
        }else{
            $class = str_replace(' ', '.', $software->post_title);
        }
        $ret .= '<button id="" class="menu-item button btn pt-7p pb-7p pl-15p pr-15p text-15 font-weight-bold text-dark bg-grey mt-0 mb-0 mr-2p ml-2p rounded-pill border-0" data-filter="'.$class.'">'.$title.'</button>';
    }
    $ret .='</div>';
    $ret .= '<div  id="themes-mobile" class="nav navbar-nav button-group submenu-games-mobile-themes m-0 flex-row flex-nowrap align-items-center justify-content-between pt-5p pb-10p pl-0 pr-2p overflow-x-auto overflow-y-hidden text-nowrap bg-dark collapse" data-group="type4" >';
    foreach ($prem_themes as $key => $value) {
        $ret .= '<button id="" class="menu-item button btn pt-7p pb-7p pl-15p pr-15p text-15 font-weight-bold text-dark bg-grey mt-0 mb-0 mr-2p ml-2p rounded-pill border-0" data-filter="' . $key . '">' . $value . '</button>';
    }
    $ret .='</div>

</div>';
    return $ret;
}
add_shortcode('slots_filters','slots_filters_shortcode');
?>