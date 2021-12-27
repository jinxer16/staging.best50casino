<?php /* Template Name: Page User Profile Template */ ?>
<?php get_header(); ?>
<body <?php body_class(); ?> >
<?php include(locate_template('common-templates/main-menu.php', false, false)); ?>
    <div class="container body-bg">
        <div class="row page-bg d-flex page-shadow pt-10p col-12 mr-0 ml-0" style="min-height: 580px;">
            <div class="w-70 d-block m-auto border w-sm-100">
                <?php
                global $current_user;
                ?>
                <span class="text-21 text-white star">My Profile</span>
                <form id="loginform-fox" class="mt-20p p-10p p-sm-5p">
                    <p class="form-username">
                        <label for="last-name"><?php _e('Username', 'profile'); ?></label>
                        <input readonly class="text-input form-control form-control-sm" name="last-name" type="text" id="last-name" value="<?php echo $current_user->user_login; ?>" />
                    </p>
                    <p class="form-email">
                        <label for="email"><?php _e('E-mail *', 'profile'); ?></label>
                        <input readonly class="text-input form-control form-control-sm" name="email" type="text" id="hiddenEmail" value="<?php echo $current_user->user_email; ?>" />
                    </p>
                    <?php
                    $datapref = get_user_meta($current_user->ID,'email_pref',true);
                    ?>
                    <div class="form-check mb-15p d-flex p-10p w-sm-100 w-70  flex-wrap">
                        <div class="w-20">
                            <div class="onoffswitch">
                                <input type="checkbox" id="one" class="onoffswitch-checkbox" name="email_pref[]" value="email-slots" <?php if(is_array($datapref)){echo (in_array('email-slots', $datapref)) ? 'checked="checked"' : ''; }?> >
                                <label class="onoffswitch-label mb-0" for="one"></label>
                            </div>
                        </div>
                        <div class="w-80 d-flex flex-wrap justify-content-center">
                            <span class="align-self-center w-80"> Notify me about new casinos</span>
                        </div>
                    </div>
                    <div class="form-check mb-15p d-flex p-10p w-sm-100 w-70  flex-wrap">
                        <div class="w-20">
                            <div class="onoffswitch">
                                <input type="checkbox" id="two" class="onoffswitch-checkbox" name="email_pref[]" value="email-spins" <?php if(is_array($datapref)){echo (in_array('email-spins', $datapref)) ? 'checked="checked"' : ''; }?> >
                                <label class="onoffswitch-label mb-0" for="two"></label>
                            </div>
                        </div>
                        <div class="w-80 d-flex flex-wrap justify-content-center">
                            <span class="align-self-center w-80"> Notify me about slots</span>
                        </div>
                    </div>
                    <div class="form-check mb-15p d-flex w-sm-100 w-70 p-10p flex-wrap">
                        <div class="w-20">
                            <div class="onoffswitch">
                                <input type="checkbox" class="onoffswitch-checkbox" id="three" name="email_pref[]" value="email-offers" <?php if(is_array($datapref)){echo (in_array('email-offers', $datapref)) ? 'checked="checked"' : ''; }?> >
                                <label class="onoffswitch-label mb-0" for="three"></label>
                            </div>
                        </div>
                        <div class="w-80 d-flex flex-wrap justify-content-center">
                            <span class="align-self-center w-80"> Notify me about casino promotions</span>
                        </div>
                    </div>
                    <div class="form-check mb-15p  w-70 w-sm-100 d-flex p-10p flex-wrap">
                        <div class="w-20">
                            <div class="onoffswitch">
                                <input type="checkbox" id="four" class="onoffswitch-checkbox" name="email_pref[]" value="email-promo" <?php if(is_array($datapref)){echo (in_array('email-promo', $datapref)) ? 'checked="checked"' : ''; }?> >
                                <label class="onoffswitch-label mb-0" for="four"></label>
                            </div>
                        </div>
                        <div class="w-80 d-flex flex-wrap justify-content-center">
                            <span class="align-self-center w-80">Notify me about casino bonuses</span>
                        </div>
                    </div>
                    <button type="button" onclick="SaveProfile(event,this)" class="btn text-white bg-primary border-0 pb-5p pt-5p font-weight-bold savedSe">Save Settings</button>
                    <div class="responsepfofile"></div>
                </form>
                <div class="errorForgot"></div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>