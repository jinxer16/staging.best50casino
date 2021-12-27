<?php
function add_last_nav_item($items, $args) {
    if ($args->theme_location == 'main-menu') {
//        $items = '<button type="button" class="navbar-toggle myNavbar visible-md"><i class="fa fa-bars" aria-hidden="true"></i></button>'.$items;
        return $items;
    }elseif($args->theme_location == 'main-menu-r'){
        $homelink = get_search_form(false);
        $items .= '<li class="header-search-wrapper text-center ml-15p  w-auto float-none d-flex align-self-center" style="height: 44px;" id="search-icon">                    
                  <a href="#search-main" data-toggle="collapse" class="collapsed"><i class="fa fa-search text-white text-center mt-15p cursor-point d-block"  data-toggle="tooltip"  data-placement="bottom" title="Search"></i></a>
                  <div id="search-main" class="search-form-main collapse">'.$homelink.'</div>
               </li>';
        $items .= '<li id="contact-icon" class="align-self-center d-flex ml-5p" style="height: 44px;"><a href="'.get_site_url().'/contact/"><i class="fa fa-comments-o mt-15p text-white text-center d-block  cursor-point align-self-center" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Contact"></i></a></li>';
        return $items;
    }elseif($args->theme_location == 'main-menu-m'){
        $homelink = get_search_form(false);
        $items .= '<li id="contact-icon" class="align-self-center d-flex pl-3p ml-5p mt-0p" ><a href="'.get_site_url().'/contact/" style="padding:0 3px;"><i class="fa fa-comments-o text-white text-center  d-block  cursor-point" aria-hidden="true"  data-toggle="tooltip" data-placement="bottom" title="Contact"></i></a></li>';
        return $items;
    }
    return $items;
}
add_filter( 'wp_nav_menu_items', 'add_last_nav_item', 10, 2 );