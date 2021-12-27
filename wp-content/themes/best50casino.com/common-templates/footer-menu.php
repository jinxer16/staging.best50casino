<div class="row d-flex flex-wrap">
    <div class="widget col-lg-3 col-md-12 mb-md-2 text-sm-13 col-12">
        <div>
            <b class="text-17 font-weight-bold mb-15p d-inline-block">Responsible Gambling</b>
            <p>Best50Casino is a major advocate of responsible gambling, always urging players to adopt safe online gaming practices. Visit Gamcare.org.uk for further advice and support.</p>
        </div>
        <div>
            <img src="<?php echo get_template_directory_uri().'/assets/images/svg/plus-18.svg'; ?>" loading="lazy" width="40" height="40">
        </div>
    </div>
    <div class="widget col-lg-2 col-md-3 col-sm-3 col-12">
        <?php
            $menu_name = 'footer-menu';
            $locations = get_nav_menu_locations();
            $menu_id = $locations[ $menu_name ];
            $menu = wp_get_nav_menu_object($menu_id);
        ?>
        <b class="w-sm-100"><?php print( $menu->name ); ?></b>
        <?php if($menu) { ?>
            <?php wp_nav_menu( array( 'theme_location' => 'footer-menu' , 'menu_class' => '', 'container' => '') ); ?>
        <?php } ?>
    </div>
    <div class="widget col-lg-2 col-md-3 col-sm-3 col-xs-12">
        <?php
            $menu_name = 'footer-menu-2';
            $locations = get_nav_menu_locations();
            $menu_id = $locations[ $menu_name ] ;
            $menu = wp_get_nav_menu_object($menu_id);
        ?>
        <b class="w-sm-100"><?php print( $menu->name ); ?></b>
        <?php if($menu) { ?>
            <?php wp_nav_menu( array( 'theme_location' => 'footer-menu-2' , 'menu_class' => '', 'container' => '') ); ?>
        <?php } ?>
    </div>
    <div class="widget col-lg-2 col-md-3 col-sm-3 col-xs-12">
        <?php
            $menu_name = 'footer-menu-3';
            $locations = get_nav_menu_locations();
            $menu_id = $locations[ $menu_name ] ;
            $menu = wp_get_nav_menu_object($menu_id);
        ?>
        <b class="w-sm-100"><?php print( $menu->name ); ?></b>
        <?php if($menu) { ?>
            <?php wp_nav_menu( array( 'theme_location' => 'footer-menu-3' , 'menu_class' => '', 'container' => '') ); ?>
        <?php } ?>
    </div>
    <div class="widget col-lg-2 col-md-3 col-sm-3 col-xs-12">
        <?php
            $menu_name = 'footer-menu-top';
            $locations = get_nav_menu_locations();
            $menu_id = $locations[ $menu_name ] ;
            $menu = wp_get_nav_menu_object($menu_id);
        ?>
        <b class="w-sm-100"><?php print( $menu->name ); ?></b>
        <?php if($menu) { ?>
            <?php wp_nav_menu( array( 'theme_location' => 'footer-menu-top' , 'menu_class' => '', 'container' => '') ); ?>
        <?php } ?>
    </div>
    <div class="col-lg-12 col-xs-12 text-center">
        <a style="margin-right:10px;" href="//www.dmca.com/Protection/Status.aspx?ID=c0cb54f9-a95a-41db-ac13-4b5e385a9cf9" title="DMCA.com Protection Status" class="dmca-badge">
            <img loading="lazy" src="https://images.dmca.com/Badges/_dmca_premi_badge_5.png?ID=c0cb54f9-a95a-41db-ac13-4b5e385a9cf9"  alt="DMCA.com Protection Status" />
        </a>
        <script src="https://images.dmca.com/Badges/DMCABadgeHelper.min.js"> </script>
        <a href="https://certify.gpwa.org/verify/en/best50casino.com/" onclick="return GPWAVerificationPopup(this)" id="GPWASeal" >
            <img src="http://certify.gpwa.org/seal/en/best50casino.com/" loading="lazy" onError="this.width=0; this.height=0;"  border="0" />
        </a>
        <a href="https://www.begambleaware.org/" target="_blank" class="mr-5p ml-5p">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/gambleaware.png" loading="lazy" style="filter: invert(100%);width:120px;"/>
        </a>
        <a href="https://www.gamstop.co.uk/" target="_blank" class="mr-5p">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/GAMSTOP.svg" loading="lazy" style="width:120px;"/>
        </a>
        <a href="https://www.gamcare.org.uk/" target="_blank" class="mr-5p">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-gamcare.svg" loading="lazy" style="width:120px;"/>
        </a>
        <div class="scrolltop d-none d-sm-block">
            <div class="scroll rounded icon"><i class="fa fa-4x fa-angle-up"></i></div>
        </div>
    </div>
    <div class="col-lg-12 col-xs-12 col-12 text-center mt-2 border-top">
        <p class="mt-1 text-sm-13"><?php echo date("Y"); ?> &copy; Copyright Best50casino.com. <span class="visible-xs" style="display: inline-block !important;">| <a href="https://www.best50casino.com/contact/" style="color:#ffffff;">Contact Us</a></span></p>
    </div>
</div>