<div id="lasssNavbar" class="thin-scroll">
    <a href="javascript:void(0)" class="closebtn">&times;</a>
    <a class="sidelogo mb-10p" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="img-responsive" loading="lazy" src="<?php echo get_template_directory_uri().'/assets/images/best50casino-logo.svg';?> " alt="Best50Casino.com"></a>
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