<?php function table_tabs_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'title' => '',
        ), $atts, 'scam');
    $pagesArray = array(
        'Bonuses' => '/welcome-bonus/',
        'Safety' => '/safe-casino-sites/',
        'Fast Paying' => '/instant-withdrawal-casinos/',
        'Payout' => '/online-casino-payouts/',
        'Mobile' => '/mobile/',
        'Live Casino' => '/live-dealer-casino/',
        'Software' => '/casino-software/',
//        'Payment' => '',
        'Rating' => '/online-casino-reviews/',
    );
    $subPagesArray = array(
        'Welcome Bonus' => '/welcome-bonus/',
        'Bonus Codes' => '/bonus-codes/',
        'Reload Bonus' => '/reload-bonus/',
        'No Deposit' => '/no-deposit-bonus/',
        'Free Spins' => '/free-spins/',
    );
    $ret = '<div >';
    $ret .= '<div class="widget2-heading" >Best Casinos By <div class=" d-xl-none d-lg-none d-flex  pull-right mb-0 mr-5 mr-sm-0 special-caret btn-border" style="width:20px;height:20px;" data-toggle="collapse" data-target="#demo">
                            <p class="mb-0 text-17 pl-3p"><i class="fa fa-caret-down"></i></p>
                        </div></div>';
    $ret .= '<ul class="d-flex  tabs-list flex-wrap collapse list-typenone w-100 mb-0 pl-sm-0 " id="demo" >';
    foreach($pagesArray as $title=>$uri){
        $activeClass = $_SERVER['REQUEST_URI'] == $uri? 'active' : '';
        if($title=='Bonuses' && in_array($_SERVER['REQUEST_URI'], $subPagesArray)){$activeClass =  'active' ;}
        $ret .= '<li style="list-style:none;" class="text-center border-primary btn-border w-12 w-sm-32 m-2p p-5p pointer br-5 '.$activeClass.'">';
        $ret .= '<a class="text-decoration-none" href="'.site_url().$uri.'">'.$title.'</a>';
        $ret .= '</li>';
    }

    $ret .= '</ul>';

        $ret .= '<ul class="list-typenone tabs-list flex-wrap  d-none d-xl-flex d-lg-flex w-100">';
        foreach($subPagesArray as $title=>$uri){
            $activeClass = $_SERVER['REQUEST_URI'] == $uri? 'active' : '';
            $ret .= '<li style="list-style:none;" class="text-center border-primary btn-border w-19 p-0 m-2p pointer br-5 '.$activeClass.'">';
            $ret .= '<a class="text-decoration-none" href="'.site_url().$uri.'">'.$title.'</a>';
            $ret .= '</li>';
        }
    $ret .= '</ul>';
    $ret .= '</div>';
    return $ret;
}

add_shortcode('table_tabs','table_tabs_shortcode'); ?>