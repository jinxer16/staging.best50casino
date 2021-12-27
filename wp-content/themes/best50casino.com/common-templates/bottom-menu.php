<?php
$site = get_site_url();
$countryISO = $GLOBALS['countryISO'];
$liID = 'bonus-code';
$promotionsArray = WordPressSettings::getPremiumPromotions($countryISO, 'premium');
$date = date('Y-m-d H:i:s');
foreach ($promotionsArray as $key=>$value){ // Αν έχει λήξει αφαίρεσε το promo από τον πίνακα
if (get_post_meta((int)$value, 'promo_custom_meta_end_offer', true) < $date){
    unset( $promotionsArray[$key] );
}
}
$numberOPosts = count($promotionsArray);
?>

<div class="" id="menu-items" style="z-index: 19;position: fixed;bottom:0;height:100%;padding-bottom: 58px;">
    <div id="collapseOne" class="collapse position-fixed menu-burger w-100" data-parent="#menu-items" style="bottom: 0;max-height: 100%;overscroll-behavior: contain;overflow-y: scroll;padding-bottom: 58px;background: rgb(193, 193, 193) none repeat scroll 0 0;top: 52px;">
        <div class="bg-primary-gradient text-center text-17 w-100 p-10p pt-5p pb-5p d-flex justify-content-between align-items-center position-sticky top-0" data-toggle="collapse"
             data-target="#collapseOne" aria-expanded="false" style="z-index: 50;" aria-controls="collapseOne">
            <div class="bg-primary-gradient  rounded-circle d-flex p-5p">
                <img class="img-fluid d-block mx-auto" loading="lazy" style="width: 30px;" src="<?= get_stylesheet_directory_uri()?>/assets/images/svg/menu-mob.svg">
            </div>
            <span class="text-white">Main Menu</span>
            <i class="fa fa-times-circle text-white mr-10p"></i>
        </div>
        <?php
        wp_nav_menu( array(
            'depth' => 2,
            'container' => false,
            'menu_class' => 'nav navbar-nav',
            'theme_location'    => "main-menu-burger", // (string) Theme location to be used. Must be registered with register_nav_menu() in order to be selectable by the user.
            'walker' => new SH_Arrow_Walker_Nav_Menu(),
        ) );
        ?>
    </div>

    <div id="collapseTwo" class="collapse position-fixed menu-burger w-100" data-parent="#menu-items" style="bottom: 0;max-height: 100%;overscroll-behavior: contain;overflow-y: scroll;padding-bottom: 58px;background: rgb(193, 193, 193) none repeat scroll 0 0;top: 52px;">
        <div class="bg-primary-gradient text-center text-17 w-100 p-10p pt-5p pb-5p d-flex justify-content-between align-items-center position-sticky top-0" data-toggle="collapse"
             data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <div class="bg-primary-gradient  rounded-circle d-flex p-5p">
                <img class="img-fluid d-block mx-auto" loading="lazy" style="width: 30px;" src="https://www.best50casino.com/wp-content/uploads/2020/10/trophy-filter.svg">
            </div>
            <span class="text-white">Best Casino</span>
            <i class="fa fa-times-circle text-white mr-10p"></i>
        </div>
        <?php
        wp_nav_menu( array(
            'depth' => 2,
            'container' => false,
            'menu_class' => 'nav navbar-nav',
            'theme_location'    => "anchor-menu", // (string) Theme location to be used. Must be registered with register_nav_menu() in order to be selectable by the user.
            'walker' => new SH_Arrow_Walker_Nav_Menu(),
        ) );
        ?>
    </div>

    <div id="collapseThree" class="collapse w-100" data-parent="#menu-items" style="position: fixed;bottom: 0;max-height: 100%;overflow-y: scroll;padding-bottom: 58px;">
        <div class="bg-primary-gradient text-center text-17 w-100 p-10p pt-5p pb-5p d-flex justify-content-between align-items-center position-sticky top-0" data-toggle="collapse"
             data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            <div class="bg-primary-gradient text-white rounded-circle d-flex p-5p">
                <img class="img-fluid d-block mx-auto" loading="lazy" style="width: 30px;" src="<?= get_stylesheet_directory_uri()?>/assets/images/svg/gift-mob.svg">
            </div>
            <span class="text-white">Latest Offers</span>
            <i class="fa fa-times-circle text-white mr-10p"></i>
        </div>

        <div class="bg-white d-flex flex-wrap justify-content-around pt-5p">
            <?php

            if( $promotionsArray ):
                foreach ($promotionsArray as $key=>$value){ // Αν έχει λήξει αφαίρεσε το promo από τον πίνακα
                    if (get_post_meta((int)$value, 'promo_custom_meta_end_offer', true) < $date){
                        unset( $promotionsArray[$key] );
                    }
                }
                foreach ($promotionsArray as $casinos) {
                    if ((get_post_meta((int)$casinos, 'promo_custom_meta_valid_all', true) || in_array( $todayDay , get_post_meta((int)$casinos, 'promo_custom_meta_valid_on', true)))) {
                        $offerEndTime = get_post_meta((int)$casinos, 'promo_custom_meta_end_offer', true);
                        ?>
                        <div class="sigle-promo-wrapper text-dark w-100 d-flex flex-wrap justify-content-between align-items-center overflow-hidden p-5p mt-2p mb-2p"  style="color:#000;box-shadow: 0px 4px 5px #d5cfcf;">
                            <?php
                            $casinoMainID = get_post_meta((int)$casinos, 'promo_custom_meta_casino_offer', true);
                            $casinoBonusPage = get_post_meta($casinoMainID, 'casino_custom_meta_bonus_page', true);
                            $bonusName = get_post_meta($casinoBonusPage, 'bonus_custom_meta_bonus_offer', true);
                            ?>
                            <img width="30" height="30" src="<?php echo get_post_meta($casinoMainID, 'casino_custom_meta_sidebar_icon', true); ?>"
                                 class="img-responsive" loading="lazy" alt="<?= get_the_title($casinoMainID); ?>">
                            <a class="d-flex text-left justify-content-between" style="width: 86%;"
                               href="<?php echo get_the_permalink($casinoBonusPage) . '#offers'; ?>">
                                <b style="font-weight: 500;border-bottom: 1px solid;">  <?php echo get_the_title($casinoMainID); ?>: </b>
                                <span data-title="Countddown" class="countdown" data-time="<?php echo $offerEndTime; ?>"></span>
                            </a>
                            <a class="text-left text-dark" href="<?php echo get_the_permalink($casinoBonusPage) . '#offers'; ?>">
                                <?php echo get_the_title($casinos); ?>
                            </a>
                        </div>
                        <?php
                    }
                }
            endif;
            ?>
        </div>
    </div>

    <!--  end of menu-items -->
</div>



<div class="position-fixed bottom-0 w-100 text-white d-block d-lg-none" id="accordion"  style="z-index: 19;">
    <div class="d-flex align-items-center justify-content-between rounded-top position-fixed bottom-0 w-100 bg-primary-gradient" style="z-index: 20; height: 58px;">
        <div class="menu-item-1 w-25 d-flex flex-column align-items-center border-right p-5p" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
            <img class="img-fluid d-block mx-auto" loading="lazy" style="width: 30px;" src="<?= get_stylesheet_directory_uri()?>/assets/images/svg/menu-mob.svg">
            <span class="menu-main-title text-12">Menu</span>
        </div>
        <div class="menu-item-2 w-25 d-flex flex-column align-items-center border-right p-5p" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <img class="img-fluid d-block mx-auto" loading="lazy" style="width: 30px;" src="https://www.best50casino.com/wp-content/uploads/2020/10/trophy-filter.svg">
            <span class="menu-main-title text-12">Bestcasino</span>
        </div>
<!--        <div class="menu-item-3 w-25 d-flex flex-column align-items-center border-right p-5p position-relative" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">-->
<!--            <span class="no-o-promo position-absolute text-white rounded-circle text-shite">--><?//=$numberOPosts?><!--</span>-->
<!--            <img class="img-fluid d-block mr-10p" loading="lazy" style="width: 35px;" src="--><?//= get_stylesheet_directory_uri()?><!--/assets/images/svg/gift-mob-christmas.svg">-->
<!--            <span class="menu-main-title text-12">Offers</span>-->
<!--        </div>-->
        <a class="menu-item-3 w-25 d-flex flex-column align-items-center border-right p-5p position-relative"  href="<?php echo get_site_url(); ?>/casino-promotions/">
            <img class="img-fluid d-block" loading="lazy" style="width: 35px;" src="<?= get_stylesheet_directory_uri()?>/assets/images/svg/gift-mob.svg">
            <span class="menu-main-title text-white text-12">Offers</span>
        </a>
        <a class="menu-item-4 w-25 d-flex flex-column align-items-center p-5p text-white" href="<?php echo get_site_url(); ?>/new-online-casinos/">
            <img class="img-fluid d-block mx-auto" loading="lazy" style="width: 30px;" src="<?= get_stylesheet_directory_uri()?>/assets/images/svg/cards.svg">
            <span class="menu-main-title text-12">New Casinos</span>
        </a>
    </div>
</div>

<!--<div id="bottomNavbar" class="d-block d-lg-none position-sticky w-100 p-5p">-->
<!--    <ul class="d-flex text-center list-typenone text-10 p-0 m-0">-->
<!--		<li id="review-casino" class="pb-5p pt-5p w-25"><a class="text-white" href="--><?php //echo get_site_url(); ?><!--/online-casino-reviews/">Casino Reviews</a></li>-->
<!--		<li id="new-casino" class="pb-5p pt-5p w-25"><a class="text-white" href="--><?php //echo get_site_url(); ?><!--/new-online-casinos/">New Casinos</a></li>-->
<!--		<li id="--><?php //echo $liID;?><!--" class="pb-5p pt-5p w-25"><a class="text-white" href="--><?php //echo get_site_url(); ?><!--/welcome-bonus/">Casino Bonuses</a></li>-->
<!--		<li id="promo-casino" class="pb-5p pt-5p w-25"><a class="text-white" href="--><?php //echo get_site_url(); ?><!--/casino-promotions/">Promotions</a><span class="no-o-promo position-absolute pt-7p pb-7p pr-10p pl-10p text-white rounded-circle text-shite">--><?php //echo $numberOPosts; ?><!--</span></li>-->
<!--	</ul>-->
<!--</div>-->