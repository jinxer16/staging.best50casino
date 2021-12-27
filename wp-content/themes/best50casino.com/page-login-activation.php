<?php /* Template Name: Page Login activation Template */ ?>
<?php get_header(); ?>
<body <?php body_class(); ?>>
<?php include(locate_template('common-templates/main-menu.php', false, false)); ?>
<?php
$user_id = filter_input(INPUT_GET, 'user', FILTER_VALIDATE_INT, array('options' => array('min_range' => 1)));
if ($user_id) {
    // get user meta activation hash field
    $code = get_user_meta($user_id, 'has_to_be_activated', true);
    if ($code == filter_input(INPUT_GET, 'key')) {
        delete_user_meta($user_id, 'has_to_be_activated');
    }
}
$user = get_user_by( 'id', $user_id );
?>
<div class="container body-bg">
    <div class="row page-bg page-shadow pt-10p">
        <div class="d-flex flex-wrap ">
            <div class="col-lg-2-extra col-md-12 col-sm-12 col-12 col-xs-12 d-none d-md-none d-lg-block d-xl-block sidenav sidelefttablet">
                <?php
                dynamic_sidebar('secondary-sidebar');
                ?>
            </div>
            <div class="col-lg-7-extra col-md-12 col-sm-12 col-xs-12 text-justify colmain main twocols">
                <div class="w-100 mb-2p p-5p text-center text-white" style="background: linear-gradient(90deg, #03898f 0%, #0c484a 35%, #03898f 100%);">
                    <p style="" class="pl-sm-0p w-100 mb-0p mb-0 modal-heading-left titlethankyou text-21 font-weight-bold">Dear <span class="text-dark font-weight-bold"></span> Welcome to the best50Casino community</p>
                </div>
                <div class="d-flex flex-wrap w-100 bg-white">

                    <div class="w-40 d-xl-block d-lg-block d-none m-auto w-sm-100" style="background-image: url('<?= get_stylesheet_directory_uri()."/assets/images/login-thankyou.jpg"?>'); background-size: cover; background-repeat: no-repeat;height: 485px;"></div>
                    <div class="w-40 d-block  d-md-none d-lg-none d-xl-none m-auto w-sm-100" style="background-image: url('<?= get_stylesheet_directory_uri()."/assets/images/thanks-mobile.jpg"?>'); background-size: cover; background-repeat: no-repeat; height: 180px;"></div>
                    <div class="w-60 w-sm-100 d-flex flex-column subscribeheight text-dark align-self-center" style="background-color: #f7f7f7; padding-left: 10px;min-height: 350px;box-shadow: 0 -2px 16px -4px rgba(115,115,115,0.75);">
                        <div class="font-weight-bolder d-block text-primary text-center text-xl-left text-md-left text-lg-left headingcont ">
                            <span class="d-block pl-20p pl-sm-0p w-100 text-21 font-weight-bold text-primary titlethankyou">From now on</span>
                        </div>
                        <div class="pl-5p pr-5p pl-sm-0p pr-sm-0p">
                            <ul class="pl-10p pr-10p pb-2p mt-sm-0 mb-sm-0 " style="list-style-type: none; padding-inline-start: 0;">
                                <li class="d-flex flex-wrap  mb-sm-0">
                                    <img  src="<?=get_stylesheet_directory_uri()?>/assets/images/ticket.svg" style="height: 44px;" class="d-block imgSubscribed w-10 pr-20p pr-sm-5p  mx-auto img-fluid" loading="lazy">
                                    <span class="w-90 textSubs align-self-center pl-sm-10p">You will be informed about the Best Casino Bonuses</span>
                                </li>
                                <li class="d-flex flex-wrap mt-sm-0">
                                    <img  src="<?=get_stylesheet_directory_uri()?>/assets/images/hot-sale.svg" style="height: 40px;" class="d-block imgSubscribed w-10 pr-20p pr-sm-5p mx-auto img-fluid" loading="lazy">
                                    <span class="w-90 align-self-center textSubs pl-sm-10p">You will have access to Exclusive Bonuses and Free Spins</span>
                                </li>
                                <li class="d-flex flex-wrap mb-5p">
                                    <img  src="<?=get_stylesheet_directory_uri()?>/assets/images/news.svg" style="height: 40px;" class="d-block w-10 imgSubscribed pr-20p pr-sm-5p  mx-auto img-fluid" loading="lazy">
                                    <span class="w-90 textSubs align-self-center pl-sm-10p">You will be notified for the New Casinos in your country</span>
                                </li>

                                <li class="d-flex flex-wrap ">
                                    <img  src="<?=get_stylesheet_directory_uri()?>/assets/images/svg/trophy-filter.svg" style="height: 40px;" class="d-block w-10 imgSubscribed pr-20p pr-sm-5p mx-auto img-fluid" loading="lazy">
                                    <span class="w-90 textSubs align-self-center pl-sm-10p">You will learn first the Latest News in the Gambling Industry</span>
                                </li>
                            </ul>
                        </div>

                        <div class="w-100 d-block pl-sm-0p pl-20p pt-10p pb-10p pr-10p">
                            <span class="d-block w-100 text-21 font-weight-bold text-primary titlethankyou">Tell us what you are interested in</span>
                            <small class="text-muted d-block">This email preferences can be changed anytime from your profile page</small>
                            <form class="mt-5p">
                                <?php
                                $datapref = get_user_meta($user_id,'email_pref',true);
                                ?>
                                <div class="form-check mb-5p d-flex p-7p w-sm-100 w-100 flex-wrap">
                                    <div class="w-20">
                                        <div class="onoffswitch">
                                            <input type="checkbox" id="one" class="onoffswitch-checkbox" name="email_pref[]" value="email-slots" <?php if(is_array($datapref)){echo (in_array('email-slots', $datapref)) ? 'checked="checked"' : ''; }?> >
                                            <label class="onoffswitch-label mb-0" for="one"></label>
                                        </div>
                                    </div>
                                    <div class="w-80 d-flex flex-wrap justify-content-center">
                                        <span class="align-self-center w-90 textSubs"> Notify me about new casinos</span>
                                    </div>
                                </div>
                                <div class="form-check mb-5p d-flex p-7p w-sm-100 w-100 flex-wrap">
                                    <div class="w-20">
                                        <div class="onoffswitch">
                                            <input type="checkbox" id="two" class="onoffswitch-checkbox" name="email_pref[]" value="email-spins" <?php if(is_array($datapref)){echo (in_array('email-spins', $datapref)) ? 'checked="checked"' : ''; }?> >
                                            <label class="onoffswitch-label mb-0" for="two"></label>
                                        </div>
                                    </div>
                                    <div class="w-80 d-flex flex-wrap justify-content-center">
                                        <span class="align-self-center w-90 textSubs"> Notify me about slots</span>
                                    </div>
                                </div>
                                <div class="form-check mb-5p d-flex w-sm-100 w-100 p-7p flex-wrap">
                                    <div class="w-20">
                                        <div class="onoffswitch">
                                            <input type="checkbox" class="onoffswitch-checkbox" id="three" name="email_pref[]" value="email-offers" <?php if(is_array($datapref)){echo (in_array('email-offers', $datapref)) ? 'checked="checked"' : ''; }?> >
                                            <label class="onoffswitch-label mb-0" for="three"></label>
                                        </div>
                                    </div>
                                    <div class="w-80 d-flex flex-wrap justify-content-center">
                                        <span class="align-self-center w-90 textSubs"> Notify me about casino promotions</span>
                                    </div>
                                </div>
                                <div class="form-check mb-5p  w-100 w-sm-100 d-flex p-7p flex-wrap">
                                    <div class="w-20">
                                        <div class="onoffswitch">
                                            <input type="checkbox" id="four" class="onoffswitch-checkbox" name="email_pref[]" value="email-promo" <?php if(is_array($datapref)){echo (in_array('email-promo', $datapref)) ? 'checked="checked"' : ''; }?> >
                                            <label class="onoffswitch-label mb-0" for="four"></label>
                                        </div>
                                    </div>
                                    <div class="w-80 d-flex flex-wrap justify-content-center">
                                        <span class="align-self-center w-90 textSubs">Notify me about casino bonuses</span>
                                    </div>
                                </div>
                                <input type="hidden" id="hiddenEmail" value="<?=$user->user_email;?>">
                                <button type="button" onclick="SaveProfile(event,this)" class="btn text-white bg-primary border-0 pb-5p pt-5p  font-weight-bold savedSe">Save Settings</button>
                                <div class="responsepfofile"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3-extra col-xl-3-extra col-md-12 col-12 d-md-none d-lg-block d-xl-block col-sm-12 col-xs-12 sidenav">
                <?php  dynamic_sidebar('main-sidebar');?>
            </div>


        </div>
    </div>
</div>
<?php get_footer(); ?>

