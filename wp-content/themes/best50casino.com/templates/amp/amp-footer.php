    <amp-analytics type="gtag" data-credentials="include">
        <script type="application/json">
            {
                "vars" : {
                    "gtag_id": "UA-125571475-1",
                    "config" : {
                        "UA-XXXXX-Y": {
                            "groups": "default"
                        }
                    }
                }
            }
        </script>
    </amp-analytics>
<footer class="container-fluid bg-dark text-whitte mt-10p" id="footer">
    <div class="container">
        <div class="row pt-10p pb-20p d-flex flex-wrap">
            <div class="widget text-whitte w-100 pl-10p pr-10p logo-footer">
                <a href="<?php echo home_url(); ?>" class="text-13  text-whitte">
                    <amp-img
                            class="img-fluid d-block w-80 mx-auto pt-10p"
                            alt="Logo"
                            src="https://www.best50casino.com/wp-content/themes/best50casino.com/assets/images/best50casino-logo.svg"
                            width="240"
                            height="29"
                            layout="responsive">
                    </amp-img>
                </a>
            </div>
        </div>
        <div class="row d-flex flex-wrap">
            <div class="widget col-lg-3 col-md-12 mb-md-2 text-sm-13 col-12">
                <div>
                    <b class="text-17 font-weight-bold mb-15p d-inline-block">Responsible Gambling</b>
                    <div class="float-right">
                        <amp-img src="<?php echo get_template_directory_uri().'/assets/images/svg/plus-18.svg'; ?>"
                                 class="" width="40" height="40">
                        </amp-img>
                    </div>
                    <p>Best50Casino is a major advocate of responsible gambling, always urging players to adopt safe online gaming practices. Visit Gamcare.org.uk for further advice and support.</p>
                </div>

            </div>

            <div class="col-12 text-center d-flex">
                <a  href="//www.dmca.com/Protection/Status.aspx?ID=c0cb54f9-a95a-41db-ac13-4b5e385a9cf9" title="DMCA.com Protection Status" class="dmca-badge mr-10p">
                    <amp-img class="" src="https://images.dmca.com/Badges/_dmca_premi_badge_5.png?ID=c0cb54f9-a95a-41db-ac13-4b5e385a9cf9" width="100" height="20"   alt="DMCA.com Protection Status">
                    </amp-img>
                </a>
                <a href="https://certify.gpwa.org/verify/en/best50casino.com/" id="GPWASeal">
                    <amp-img src="http://certify.gpwa.org/seal/en/best50casino.com/"   width="100" height="30">
                    </amp-img>
                </a>
                <a href="https://www.begambleaware.org/" target="_blank">
                    <amp-img class="mt-2p ml-5p" src="<?php echo get_template_directory_uri(); ?>/assets/images/gambleaware.png"  width="130" height="20" style="filter: invert(100%);">
                    </amp-img>
                </a>
            </div>
            <div class="col-12 text-center mt-10p border-top">
                <p class="mt-5p text-sm-13"><?php echo date("Y"); ?> &copy; Copyright Best50casino.com. <span class="d-inline-block text-whitte" >| <a href="https://www.best50casino.com/contact/" class="text-whitte">Contact Us</a></span></p>
            </div>
        </div>
    </div>
    <amp-animation id="showAnim" layout="nodisplay">
        <script type="application/json">
            {
                "duration": "300ms",
                "fill": "both",
                "iterations": "1",
                "direction": "alternate",
                "animations": [
                    {
                        "selector": "#scrollToTopButton",
                        "keyframes": [
                            { "opacity": "1", "visibility": "visible" }
                        ]
                    }
                ]
            }
        </script>
    </amp-animation>
    <!-- ... and the second one is for adding the button.-->
    <amp-animation id="hideAnim" layout="nodisplay">
        <script type="application/json">
            {
                "duration": "300ms",
                "fill": "both",
                "iterations": "1",
                "direction": "alternate",
                "animations": [
                    {
                        "selector": "#scrollToTopButton",
                        "keyframes": [
                            { "opacity": "0", "visibility": "hidden" }
                        ]
                    }
                ]
            }
        </script>
    </amp-animation>

    <div class="scrolltop bottom-20 m-0 w-100 position-fixed d-block d-sm-none" style="z-index: 1;">
        <div class="scroll bg-secondary m-0 p-7p position-absolute text-center rounded bottom-75 icon scrollToTop pointer" role="button" id="scrollToTopButton" on="tap:top.scrollTo(duration=300)"  tabindex="12" ><i class="fa ml-1p  text-25 text-whitte fa-angle-up"></i></div>
    </div>
</footer>

<?php
if (is_singular( 'kss_casino' )) {
    // conditional content/code
    $meta = get_post_meta($post->ID, 'casino_custom_meta_anchors', true);
    $anchors = explode(",", $meta);
    $countryISO = $GLOBALS['countryISO'];
    $liID = 'bonus-code';
    $date = date('Y-m-d H:i:s');
    $promotionsArray = WordPressSettings::getPremiumPromotions($countryISO,'premium');
        $count=0;
        foreach ($promotionsArray as $key=>$value){ // Αν έχει λήξει αφαίρεσε το promo από τον πίνακα
          if (get_post_meta((int)$value, 'promo_custom_meta_end_offer', true) < $date){
                                        unset( $promotionsArray[$key] );
            }
        }
    $numberOPosts = count($promotionsArray);
    ?>

    <div id="bottomNavbar" class="d-block d-lg-none position-sticky p-5p bottom-0">
        <ul class="d-flex text-center list-typenone text-10 p-0 m-0">
            <li id="" class="pb-5p pt-5p w-25">
                <a class="text-whitte text-decoration-none" role="button" on="tap:AMP.setState({ hideMenu: false })"  style="border:0; background: none;">
                    <amp-img class="d-block img-fluid mx-auto" src="<?= get_stylesheet_directory_uri()?>/assets/images/svg/menu-mob.svg" width="30" height="30" alt=""></amp-img>
                    <span class="menu-main-title text-12 pt-2p">Menu</span>
                </a>
            </li>
            <div hidden [hidden]="hideMenu" class="w-100 position-fixed bottom-1 menu-burger bottom-0 top-55 " style="background: rgb(193, 193, 193) none repeat scroll 0 0;max-height: 83.9%;top: 55px">
                <div class="w-100 h-100" style="z-index: 1006;" role="button" tabindex="1" on="tap:AMP.setState({ hideMenu: true })">
                    <div class="position-absolute w-100 top-0 h-100"  style="z-index: 2;overflow-y: scroll;">
                        <div class="bg-primary text-center text-whitte text-15 w-100 p-3p position-sticky top-0 d-flex justify-content-between align-items-center">
                            <div class="bg-gold-gradient rounded-circle d-flex p-5p">
                                <amp-img class="d-block img-fluid mx-auto" src="<?= get_stylesheet_directory_uri()?>/assets/images/svg/menu-mob.svg" width="22" height="22" alt=""></amp-img>
                            </div>
                            Menu
                            <i class="fa fa-times-circle mr-10p" role="button" tabindex="2" on="tap:AMP.setState({ hideMenu: true })"></i>
                        </div>
                        <?php
                        wp_nav_menu( array(
                            'depth' => 2,
                            'container' => false,
                            'menu_class' => 'nav navbar-nav list-unstyled',
                            'theme_location'    => "main-menu-burger", // (string) Theme location to be used. Must be registered with register_nav_menu() in order to be selectable by the user.
                            'walker' => new SH_Arrow_Walker_Nav_Menu(),
                        ) );
                        ?>
                    </div>
                </div>
            </div>
            <li id="" class="pb-5p pt-5p w-25">
                <a class="text-whitte text-decoration-none pr-0 d-flex flex-column align-items-center" role="button" on="tap:AMP.setState({ hideList: false })"  style="border:0; background: none;">
                    <amp-img class="d-block img-fluid mx-auto" src="<?= get_stylesheet_directory_uri()?>/assets/images/svg/folder.svg" width="30" height="30" alt=""></amp-img>
                    <span class="menu-main-title text-12">Content</span>
                </a>
            </li>
            <div hidden [hidden]="hideList" class="w-100 position-fixed bottom-1" style="height: 100vh;">
                <div class="w-100 h-100" style="z-index: 1006;" role="button" tabindex="1" on="tap:AMP.setState({ hideList: true })">
                    <div class="position-absolute w-100 bottom-60" style="z-index: 2;">
                        <div class="bg-primary text-center text-whitte text-15 w-100 p-3p d-flex justify-content-between align-items-center">
                            <div class="bg-gold-gradient rounded-circle d-flex p-5p">
                                <amp-img class="d-block img-fluid mx-auto" src="<?= get_stylesheet_directory_uri()?>/assets/images/svg/folder.svg" width="22" height="22" alt=""></amp-img>
                            </div>
                            Content
                            <i class="fa fa-times-circle mr-10p" role="button" tabindex="2" on="tap:AMP.setState({ hideList: true })"></i>
                        </div>
                        <ul class="list-unstyled p-0 m-0  list-typenone  w-100 " >
                            <?php foreach ($anchors as $key=>$value) {
                                ?>
                                <li class="p-4p text-black list-content w-100 text-left"  role="button" tabindex="3" on="tap:AMP.setState({ hideList: false })" style="border-bottom: 1px solid #9c9c9c;"><a href="#<?=$anchorsids[$key]?>" style="text-decoration: none;" class="text-15 text-black text-decoration-none d-block"><i class="fa fa-angle-double-right text-black pl-5p pr-5p"></i><?= $value ?></a></li>
                            <?php }
                            $casinoBonusPage = get_post_meta($post->ID, 'casino_custom_meta_bonus_page', true);
                            ?>
                            <li class="p-4p w-100 text-black list-content text-left" style="border-bottom: 1px solid #9c9c9c;"><a href="<?=get_the_permalink($casinoBonusPage); ?>" class="text-15 text-black d-block"><i class="fa fa-angle-double-right text-black pl-5p pr-5p"></i>Bonus</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <li id="" class="pb-5p pt-5p w-25 position-relative">
                <span class="no-o-promo position-absolute text-whitte text-shite" style="background: red;
border-radius: 50%;
position: absolute;
right: 3px;
top: -12px;
padding: 5px 7px;
color: white;
font-weight: 500;"><?=$numberOPosts?></span>
                <a class="text-whitte text-decoration-none pr-0 d-flex flex-column align-items-center" role="button" on="tap:AMP.setState({ hideOffers: false })"  style="border:0; background: none;">
                    <amp-img class="d-block img-fluid mx-auto" src="<?= get_stylesheet_directory_uri()?>/assets/images/svg/gift-mob.svg" width="30" height="30" alt=""></amp-img>
                    <span class="menu-main-title text-12">Offers</span>
                </a>
            </li>
            <div hidden [hidden]="hideOffers" class="w-100 position-fixed bottom-1" style="height: 100vh;">
                <div class="w-100 h-100" style="z-index: 1006;" role="button" tabindex="1" on="tap:AMP.setState({ hideOffers: true })">
                    <div class="position-absolute w-100 bottom-60" style="z-index: 2;">
                        <div class="bg-primary text-center text-whitte text-15 w-100 p-3p d-flex justify-content-between align-items-center">
                            <div class="bg-gold-gradient rounded-circle d-flex p-5p">
                                <amp-img class="d-block img-fluid mx-auto" src="<?= get_stylesheet_directory_uri()?>/assets/images/svg/gift-mob.svg" width="22" height="22" alt=""></amp-img>
                            </div>
                            Latest Offers
                            <i class="fa fa-times-circle mr-10p" role="button" tabindex="2" on="tap:AMP.setState({ hideOffers: true })"></i>
                        </div>
                        <div class="bg-whitte d-flex flex-wrap justify-content-around pt-5p">
                            <?php
                            $date = date('Y-m-d H:i:s');
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
                                            <amp-img width="30" height="30" src="<?php echo get_post_meta($casinoMainID, 'casino_custom_meta_sidebar_icon', true); ?>"
                                                     class="img-responsive" alt="<?= get_the_title($casinoMainID); ?>"></amp-img>
                                            <a class="d-flex text-left justify-content-between text-decoration-none text-sm-13" style="width: 86%;"
                                               href="<?php echo get_the_permalink($casinoBonusPage) . '#offers'; ?>">
                                                <b style="font-weight: 500;border-bottom: 1px solid;">  <?php echo get_the_title($casinoMainID); ?>: </b>
                                                <span data-title="Countddown" class="countdown" data-time="<?php echo $offerEndTime; ?>"></span>
                                            </a>
                                            <a class="text-left text-dark text-sm-13 text-decoration-none" href="<?php echo get_the_permalink($casinoBonusPage) . '#offers'; ?>">
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
                </div>
            </div>
            <li id="" style="border: none;" class="pb-5p pt-5p w-25">
                <a class="text-whitte text-decoration-none" href="<?php echo get_site_url(); ?>/new-online-casinos//">
                    <amp-img class="d-block img-fluid mx-auto" src="<?= get_stylesheet_directory_uri()?>/assets/images/svg/cards.svg" width="30" height="30" alt=""></amp-img>
                    <span class="menu-main-title text-12">New Casino</span>
                </a>
            </li>
        </ul>
    </div>
    <?php
}else{
    $countryISO = $GLOBALS['countryISO'];
    $liID = 'bonus-code';
    $promotionsArray = WordPressSettings::getPremiumPromotions($countryISO,'premium');
    $count=0;
    $date = date('Y-m-d H:i:s');
    foreach ($promotionsArray as $key=>$value){ // Αν έχει λήξει αφαίρεσε το promo από τον πίνακα
        if (get_post_meta((int)$value, 'promo_custom_meta_end_offer', true) < $date){
            unset( $promotionsArray[$key] );
        }
    }
    $numberOPosts = count($promotionsArray);
    ?>
    <div id="bottomNavbar" class="d-block d-lg-none position-sticky p-5p bottom-0">
        <ul class="d-flex text-center list-typenone text-10 p-0 m-0">
            <li id="" class="pb-5p pt-5p w-25">
                <a class="text-whitte text-decoration-none" role="button" on="tap:AMP.setState({ hideMenu: false })"  style="border:0; background: none;">
                    <amp-img class="d-block img-fluid mx-auto" src="<?= get_stylesheet_directory_uri()?>/assets/images/svg/menu-mob.svg" width="30" height="30" alt=""></amp-img>
                    <span class="menu-main-title text-12 pt-2p">Menu</span>
                </a>
            </li>
            <div hidden [hidden]="hideMenu" class="w-100 position-fixed bottom-1 menu-burger bottom-0 top-55 " style="background: rgb(193, 193, 193) none repeat scroll 0 0;max-height: 83.9%;top: 55px">
                <div class="w-100 h-100" style="z-index: 1006;" role="button" tabindex="1" on="tap:AMP.setState({ hideMenu: true })">
                    <div class="position-absolute w-100 top-0 h-100"  style="z-index: 2;overflow-y: scroll;">
                        <div class="bg-primary text-center text-whitte text-15 w-100 p-3p position-sticky top-0 d-flex justify-content-between align-items-center">
                            <div class="bg-gold-gradient rounded-circle d-flex p-5p">
                                <amp-img class="d-block img-fluid mx-auto" src="<?= get_stylesheet_directory_uri()?>/assets/images/svg/menu-mob.svg" width="22" height="22" alt=""></amp-img>
                            </div>
                            Menu
                            <i class="fa fa-times-circle mr-10p" role="button" tabindex="2" on="tap:AMP.setState({ hideMenu: true })"></i>
                        </div>
                        <?php
                        wp_nav_menu( array(
                            'depth' => 2,
                            'container' => false,
                            'menu_class' => 'nav navbar-nav list-unstyled',
                            'theme_location'    => "main-menu-burger", // (string) Theme location to be used. Must be registered with register_nav_menu() in order to be selectable by the user.
                            'walker' => new SH_Arrow_Walker_Nav_Menu(),
                        ) );
                        ?>
                    </div>
                </div>
            </div>
            <li id="" class="pb-5p pt-5p w-25">
                <a class="text-whitte text-decoration-none pr-0 d-flex flex-column align-items-center" role="button" on="tap:AMP.setState({ hideList: false })"  style="border:0; background: none;">
                    <amp-img class="d-block img-fluid mx-auto" src="<?= get_stylesheet_directory_uri()?>/assets/images/svg/folder.svg" width="30" height="30" alt=""></amp-img>
                    <span class="menu-main-title text-12">Content</span>
                </a>
            </li>
            <div hidden [hidden]="hideList" class="w-100 position-fixed bottom-1" style="height: 100vh;">
                <div class="w-100 h-100" style="z-index: 1006;" role="button" tabindex="1" on="tap:AMP.setState({ hideList: true })">
                    <div class="position-absolute w-100 bottom-60" style="z-index: 2;">
                        <div class="bg-primary text-center text-whitte text-15 w-100 p-10p pt-5p pb-5p d-flex justify-content-between align-items-center">
                            <div class="bg-gold-gradient rounded-circle d-flex p-5p">
                                <span class="mobile-icons mm-6"></span>
                            </div>
                            Content
                            <i class="fa fa-times-circle mr-10p" role="button" tabindex="2" on="tap:AMP.setState({ hideList: true })"></i>
                        </div>
                        <ul  class="list-unstyled p-0 m-0  list-typenone  w-100 " >
                            <li class="p-4p text-black list-content w-100 text-left"  role="button" tabindex="3" on="tap:AMP.setState({ hideList: false })" style="border-bottom: 1px solid #9c9c9c;"><a href="#intro" style="text-decoration: none;" class="text-15 text-black d-block text-decoration-none"><i class="fa fa-angle-double-right text-black pl-5p pr-5p"></i><?php echo get_post_meta($post->ID, 'bonus_custom_meta_Tab_intro', true); ?></a></li>
                            <li class="p-4p text-black list-content w-100 text-left"  role="button" tabindex="4" on="tap:AMP.setState({ hideList: false })" style="border-bottom: 1px solid #9c9c9c;"><a href="#bonus-code" style="text-decoration: none;" class="text-15 text-black d-block text-decoration-none"><i class="fa fa-angle-double-right text-black pl-5p pr-5p"></i><?php echo get_post_meta($post->ID, 'bonus_custom_meta_Tab_bonus_code', true); ?></a></li>
                            <li class="p-4p text-black list-content w-100 text-left"  role="button" tabindex="5" on="tap:AMP.setState({ hideList: false })" style="border-bottom: 1px solid #9c9c9c;"><a href="#offers" style="text-decoration: none;" class="text-15 text-black d-block text-decoration-none"><i class="fa fa-angle-double-right text-black pl-5p pr-5p"></i><?php echo get_post_meta($post->ID, 'bonus_custom_meta_Tab_offers', true); ?></a></li>
                            <li class="p-4p text-black list-content w-100 text-left"  role="button" tabindex="6" on="tap:AMP.setState({ hideList: false })" style="border-bottom: 1px solid #9c9c9c;"><a href="#faq" style="text-decoration: none;" class="text-15 text-black d-block text-decoration-none"><i class="fa fa-angle-double-right text-black pl-5p pr-5p"></i>FAQ</a></li>
                            <li class="p-4p w-100 text-black list-content  text-left" style="border-bottom: 1px solid #9c9c9c;"><a href="<?php echo get_the_permalink($bookieid); ?>" class="text-15 text-black d-block"><i class="fa fa-angle-double-right text-black pl-5p pr-5p text-decoration-none"></i>Casino review</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <li id="" class="pb-5p pt-5p w-25 position-relative">
                <span class="no-o-promo position-absolute text-whitte text-shite position-absolute" style="background: red;
border-radius: 50%;
position: absolute;
right: 3px;
top: -12px;
padding: 5px 7px;
color: white;
font-weight: 500;"><?=$numberOPosts?></span>
                <a class="text-whitte text-decoration-none pr-0 d-flex flex-column align-items-center" role="button" on="tap:AMP.setState({ hideOffers: false })"  style="border:0; background: none;">
                    <amp-img class="d-block img-fluid mx-auto" src="<?= get_stylesheet_directory_uri()?>/assets/images/svg/gift-mob.svg" width="30" height="30" alt=""></amp-img>
                    <span class="menu-main-title text-12">Casino Bonus</span>
                </a>
            </li>
            <div hidden [hidden]="hideOffers" class="w-100 position-fixed bottom-1" style="height: 100vh;">
                <div class="w-100 h-100" style="z-index: 1006;" role="button" tabindex="1" on="tap:AMP.setState({ hideOffers: true })">
                    <div class="position-absolute w-100 bottom-60" style="z-index: 2;">
                        <div class="bg-primary text-center text-whitte text-15 w-100 p-3p d-flex justify-content-between align-items-center">
                            <div class="bg-gold-gradient rounded-circle d-flex p-5p">
                                <amp-img class="d-block img-fluid mx-auto" src="<?= get_stylesheet_directory_uri()?>/assets/images/svg/gift-mob.svg" width="22" height="22" alt=""></amp-img>
                            </div>
                            Latest Offers
                            <i class="fa fa-times-circle mr-10p" role="button" tabindex="2" on="tap:AMP.setState({ hideOffers: true })"></i>
                        </div>
                        <div class="bg-whitte d-flex flex-wrap justify-content-around pt-5p">
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
                                            <amp-img width="30" height="30" src="<?php echo get_post_meta($casinoMainID, 'casino_custom_meta_sidebar_icon', true); ?>"
                                                     class="img-fluid" alt="<?= get_the_title($casinoMainID); ?>"></amp-img>
                                            <a class="d-flex text-left justify-content-between text-decoration-none text-sm-13" style="width: 86%;"
                                               href="<?php echo get_the_permalink($casinoBonusPage) . '#offers'; ?>">
                                                <b style="font-weight: 500;border-bottom: 1px solid;">  <?php echo get_the_title($casinoMainID); ?>: </b>
<!--                                                <span data-title="Countddown" class="countdown text-sm-13 d-block text-center font-weight-bold mr-5p pt-4p pb-4p" style="width: 26%; min-width: 22%;font-size: 12px;display: block;background: #ffcd00;color: #212d33;padding: 4px 0 4px 0;margin-right: 5px;font-weight: 600;text-align: center;">--><?php //echo $offerEndTime; ?><!--</span>-->
                                            </a>
                                            <a class="text-left text-dark text-decoration-none text-sm-13" href="<?php echo get_the_permalink($casinoBonusPage) . '#offers'; ?>">
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
                </div>
            </div>
            <li id="" style="border: none;" class="pb-5p pt-5p w-25">
                <a class="text-whitte text-decoration-none" href="<?php echo get_site_url(); ?>/new-online-casinos/">
                    <amp-img class="d-block img-fluid mx-auto" src="<?= get_stylesheet_directory_uri()?>/assets/images/svg/cards.svg" width="30" height="30" alt=""></amp-img>
                    <span class="menu-main-title text-12">New Casinos</span>
                </a>
            </li>
        </ul>
    </div>
    <?php
}
?>
</body>
</html>


