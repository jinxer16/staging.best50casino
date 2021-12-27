<nav class="navbar bg-dark position-sticky top-0 p-0" style="z-index: 1000;" id="site-nav">
    <div class="container">
        <div class="row ">
            <div  class="d-flex flex-row pb-7p pl-sm-10p pt-sm-10p pr-md-10p pl-md-10p pr-sm-10p pt-10p pb-sm-10p w-100 align-items-center justify-content-center">
                <?php if(has_nav_menu( 'main-menu-burger' )){ ?>
                    <div class="d-xl-flex d-lg-flex d-md-flex d-none d-sm-none position-absolute flex-row burger-i">
                        <button type="button" class="navbar-toggle myNavbar pl-20p"><i class="fa fa-bars" aria-hidden="true"></i></button>
                    </div>
                <?php } ?>
                <a class="navbar-brand des d-block align-self-center justicy-content-center" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img class="img-responsive" src="<?php echo get_template_directory_uri().'/assets/images/best50casino-logo.svg';?>" alt="Best50Casino.com" width="260">
                </a>
                <div class="navbar-collapse text-center m-0 p-0 d-none d-lg-block" id="myNavbar" >
                    <?php
                    create_bootstrap_menu('main-menu');
//                    wp_nav_menu( array( onmouseout="toggleMenu('','out')"
//                        'depth' => 2,
//                        'container' => false,
//                        'menu_class' => 'nav navbar-nav d-flex flex-row m-0 p-0 justify-content-start list-typenone align-items-stretch position-relative w-100 float-none',
//                        'theme_location'    => "main-menu", // (string) Theme location to be used. Must be registered with register_nav_menu() in order to be selectable by the user.
//                    ) );
                    ?>
                </div>
                <?php if (!is_user_logged_in()) : ?>
                <button type="button" data-toggle="modal" data-target="#modalSignIn" class="btn menubtns bg-white d-flex  font-weight-bold p-7p text-14 text-dark" style="margin: 0 2px;"><i class="fas fa-user pr-5p pt-4p"></i> Login</button>
                    <button type="button" data-toggle="modal" data-target="#modalRegister"  rel="nofollow" class="btn bg-secondary menubtns menubtn-regi font-weight-bold d-flex p-7p text-14 text-dark" style="margin: 0 10px;"> Register <i class="fas fa-arrow-circle-right pl-5p pt-4p"></i></button>
                <?php
                else :
                    ?>
                    <a href="<?=site_url()?>/profile" rel="nofollow" class="btn bg-secondary menubtns  font-weight-bold d-flex p-7p text-14 text-dark" style="margin: 0 4px;"><i class="fas fa-address-card pr-5p pt-4p"></i>PROFILE</a>
                    <button type="button" data-toggle="modal" data-target="#logout-modal"  class="btn menubtns bg-white d-flex  font-weight-bold p-7p text-14 text-dark" id="LogoutBtn" style="margin: 0 2px;"><i class="fas fa-user pr-5p pt-4p"></i> LOGOUT</button>
                <?php
                endif;
                ?>
            </div>
        </div>
    </div>

</nav>