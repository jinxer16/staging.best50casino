<header class="headerbar bg-dark w-100 position-sticky top-0 p-0 d-flex align-items-center">
    <div class="site-name">
        <a class="" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <amp-img class="mt-5p" src="<?php echo get_template_directory_uri().'/assets/images/best50casino-logo.svg';?>" alt="Best50Casino.com" height="20" width="160"></amp-img>
        </a>
    </div>
    <?php $user = wp_get_current_user();
    if($user->ID != 0 || $user->ID != null) : ?>
        <a href="<?=site_url()?>/profile" class="btn menubtns bg-secondary border-0 d-flex text-decoration-none rounded-5 text-sm-13  font-weight-bold p-7p text-14 text-dark" style="margin: 0 3px;"><i class="fa fa-address-card pr-5p pt-4p"></i> PROFILE</a>
        <a  role="button" on="tap:AMP.setState({ hideLogout: false })" class="btn menubtns bg-whitte border-0 d-flex text-decoration-none rounded-5 text-sm-13  font-weight-bold p-7p text-14 text-dark" style="margin: 0 6px;"><i class="fa fa-user pr-5p pt-4p"></i> LOGOUT</a>
    <?php else:
        ?>
        <a  role="button" on="tap:AMP.setState({ hideLogin: false })" class="btn menubtns bg-whitte border-0 d-flex text-decoration-none rounded-5 text-sm-13  font-weight-bold p-7p text-14 text-dark" style="margin: 0 2px;"><i class="fa fa-user pr-5p pt-4p"></i> LOGIN</a>
        <a role="button" on="tap:AMP.setState({ hideRegister: false })" rel="nofollow" class="btn bg-secondary border-0  menubtns menubtn-regi rounded-5 text-decoration-none font-weight-bold  text-sm-13 d-flex p-7p text-14 text-dark" style="margin: 0 10px;">REGISTER <i class="fa fa-arrow-circle-right pl-5p pt-4p"></i></a>
    <?php
    endif;?>
</header>

<div hidden [hidden]="hideLogin" class="w-100 position-fixed bottom-1 overflow-hidden menu-burger bottom-0" style="top: 11%;z-index: 1050;">
    <div class="w-90 m-auto" style="z-index: 1006;">
        <div class="position-absolute modal-content top-0 w-90"  style="z-index: 2;">
            <div class="bg-primary text-center text-whitte text-15 w-100 pl-5p pb-7p pt-7p position-sticky top-0 d-flex justify-content-between align-items-center">
                Sign in
                <i class="fa fa-times-circle mr-10p" role="button" tabindex="2" on="tap:AMP.setState({ hideLogin: true })"></i>
            </div>
            <div class="modal-body bg-whitte text-black p-10p">
                <form id="loginform-best" method="post" action-xhr="<?php echo site_url().'/wp-content/themes/best50casino.com/templates/amp/amp-common/amp-login-handler.php'?>" target="_top" custom-validation-reporting="as-you-go">

                    <fieldset class="border-0">
                    <div class="form-group mb-15p">
                        <label for="UserName" class="mb-5p">Username</label>
                        <input type="text" class="form-control d-block w-100 form-control-sm" id="UserName" name="UserName" placeholder="Username">
                        <span visible-when-invalid="valueMissing" validation-for="UserName"></span>
                    </div>
                    <div class="form-group mb-15p">
                        <label for="inputPassword" class="mb-5p">Password</label>
                        <input type="password" class="form-control d-block w-100 form-control-sm" id="inputPassword" name="inputPassword" placeholder="Password">
                        <span visible-when-invalid="valueMissing" validation-for="inputPassword"></span>
                    </div>
                    <div class="form-group mb-15p">
                        <input name="rememberMe" type="checkbox" id="rememberMe" value="forever">
                        <label for="rememberMe">Remember me</label>
                    </div>

                    <input type="submit" class="bg-primary rounded-5 border-0 text-whitte p-10p w-100 loginBtn" value="LOGIN">

                    </fieldset>
                    <div class="d-flex flex-column align-items-center pt-5p text-13 ">
                        <span>Forgot your password;</span>
                        <a id="btn-user-forgot" class="btn-transp p-0" role="button" on="tap:AMP.setState({ hideForgot: false,hideLogin: true })">Reset password</a>
                    </div>

                    <div submit-success>
                        <template type="amp-mustache">
                            <div class="mb-0p text-center text-sm-13">{{{output_message}}}</div>
                        </template>
                    </div>
                    <div submit-error>
                        <template type="amp-mustache">
                            <p class="text-center text-success">{{output_message}}</p>
                        </template>
                    </div>
                </form>

        </div>
            <div class="w-100 d-flex bg-whitte justify-content-center align-items-center" style="border-top: 1px solid #dee2e6;">
                <p class="mb-0">Not a member;
                    <a  id="btn-user-register" class="btn-transp mb-0p p-0p" role="button" on="tap:AMP.setState({ hideRegister: false,hideLogin: true })">Register</a>
                </p>
            </div>
    </div>
</div>
</div>

<div hidden [hidden]="hideLogout" class="w-100 position-fixed bottom-1 overflow-hidden menu-burger bottom-0" style="top: 11%;z-index: 1050;">
    <div class="w-90 m-auto" style="z-index: 1006;">
        <div class="position-absolute modal-content top-0 w-90"  style="z-index: 2;">
            <div class="bg-primary text-center text-whitte text-15 w-100 pl-5p pb-7p pt-7p position-sticky top-0 d-flex justify-content-between align-items-center">
                Logout
                <i class="fa fa-times-circle mr-10p" role="button" tabindex="2" on="tap:AMP.setState({ hideLogout: true })"></i>
            </div>
            <div class="modal-footer text-center p-10p bg-whitte text-black d-flex flex-column align-items-center" style="text-shadow: none;">
                <span class="w-100 d-block">Are you sure you want to logout?</span>
                <form id="logout-form" method="post" action-xhr="<?php echo site_url().'/wp-content/themes/best50casino.com/templates/amp/amp-common/amp-logout-handler.php'?>" target="_top">
                    <fieldset class="border-0">
                <div class="btns">
                    <input type="submit" class="btn p-10p text-black rounded-5 bg-light" id="modal-btn-yes" value="YES">
                    <button type="button" class="btn bg-primary p-10p border-0 text-whitte rounded-5" id="modal-btn-no">
                        NO
                    </button>
                </div>
          </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<div hidden [hidden]="hideForgot" class="w-100 position-fixed bottom-1 overflow-hidden menu-burger bottom-0" style="top: 11%;z-index: 1050;">
    <div class="w-90 m-auto" style="z-index: 1006;">
        <div class="position-absolute modal-content top-0 w-90"  style="z-index: 2;">
            <div class="bg-primary text-center text-whitte text-15 w-100 pl-5p pb-7p pt-7p position-sticky top-0 d-flex justify-content-between align-items-center">
                Forgot password
                <i class="fa fa-times-circle mr-10p" role="button" tabindex="2" on="tap:AMP.setState({ hideForgot: true })"></i>
            </div>
            <div class="modal-body bg-whitte text-black p-10p">
                <form id="loginform-best50" method="post" action-xhr="<?php echo site_url().'/wp-content/themes/best50casino.com/templates/amp/amp-common/amp-forgot-handler.php'?>" target="_top" custom-validation-reporting="as-you-go">
                    <fieldset class="border-0">
                    <div class="form-group mb-15p">
                        <label for="emailForgot" class="mb-5p">Email</label>
                        <input type="email" name="emailForgot" class="form-control d-block mt-5p w-100 form-control-sm" id="emailForgot" placeholder="example@gmail.com">
                        <span visible-when-invalid="valueMissing" validation-for="emailForgot"></span>
                        <span visible-when-invalid="typeMismatch" validation-for="emailForgot"></span>
                    </div>

                    <input type="submit" class="bg-primary rounded-5 border-0 text-whitte p-10p w-100 lostpassword-button" value="Reset Password">

                    </fieldset>
                    <div submit-success>
                        <template type="amp-mustache">
                            <p class="text-center text-success mb-0p" style="font-size: 12px;">{{output_message}}</p>
                        </template>
                    </div>
                    <div submit-error>
                        <template type="amp-mustache">
                            <p class="text-center text-success">{{output_message}}</p>
                        </template>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div hidden [hidden]="hideRegister" class="w-100 position-fixed bottom-1 overflow-hidden menu-burger bottom-0" style="top: 8%;z-index: 1050;">
    <div class="w-90 m-auto" style="z-index: 1006;">
        <div class="position-absolute modal-content top-0 w-90"  style="z-index: 2;">
            <div class="bg-primary text-center text-whitte text-15 w-100 pl-5p pb-7p pt-7p position-sticky top-0 d-flex justify-content-between align-items-center">
                Register
                <i class="fa fa-times-circle mr-10p" role="button" tabindex="2" on="tap:AMP.setState({ hideRegister: true })"></i>
            </div>
            <div class="modal-body bg-whitte text-black p-5p">
                <form id="register-best50" method="post" action-xhr="<?php echo site_url().'/wp-content/themes/best50casino.com/templates/amp/amp-common/amp-register-handler.php'?>" target="_top" custom-validation-reporting="as-you-go">
                    <fieldset class="border-0">
                    <div class="form-group mb-3p">
                        <label for="UserNameRe"class="mb-2p text-sm-13">Username*</label>
                        <input type="text" class="form-control form-control-sm d-block mt-5p w-100" id="UserNameRe" name="UserNameRe" placeholder="johndoe12" required="true">
                        <span visible-when-invalid="valueMissing" validation-for="UserNameRe"></span>
                    </div>
                    <div class="form-group mb-3p">
                        <label for="inputEmailRe" class="mb-2p text-sm-13">Email*</label>
                        <input type="email" class="form-control form-control-sm d-block mt-5p w-100" id="inputEmailRe" name="inputEmailRe" aria-describedby="emailHelp" placeholder="johndoe@gmail.com" required="true">
                        <span visible-when-invalid="valueMissing" validation-for="inputEmailRe"></span>
                        <span visible-when-invalid="typeMismatch" validation-for="inputEmailRe"></span>
                    </div>
                    <div class="form-group mb-3p">
                        <label for="inputPasswordRe" class="mb-2p text-sm-13">Password*</label>
                        <input type="password" class="form-control form-control-sm d-block mt-5p w-100" id="inputPasswordRe" name="inputPasswordRe" placeholder="Password" required="true" pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])\S{6,}">
                        <span visible-when-invalid="valueMissing" validation-for="inputPasswordRe"></span>
                        <span visible-when-invalid="patternMismatch" validation-for="inputPasswordRe">
                            Password must contain six characters or more and has at least one lowercase and one uppercase alphabetical character
                        </span>
                    </div>

                    <div class="form-group mb-3p">
                        <label for="inputPasswordReseond" class="tex-sm-13">Confirm Password*</label>
                        <input type="password" class="form-control form-control-sm d-block mt-5p w-100" id="inputPasswordReseond" name="inputPasswordReseond" placeholder="Password" required="true">
                    </div>

                    <div class="form-check mb-3p">
                            <input type="checkbox" class="form-check-input" id="checkterms" name="checkterms">
                            <label for="checkterms" class="form-check-label" style="font-size: 12px;"> I accept the <a class="font-weight-bold" href="/privacy-policy/">terms and coniditons </a>*</label>
                    </div>
                    <div class="form-check mb-5p">
                        <input type="checkbox" class="form-check-input" id="checknewsletter">
                        <label for="checknewsletter" class="form-check-label"> I consent to receive emails about Free Spins & No Deposit Bonuses</label>
                        <input type="text" class="form-check-input" id="visitorsISO" value="<?php echo $GLOBALS['visitorsISO'];?>" hidden>
                    </div>
                    <input type="submit" class="bg-primary rounded-5 border-0 text-whitte p-10p w-100 lostpassword-button" value="SUBMIT" >

                    </fieldset>

                    <div submit-success>
                        <template type="amp-mustache">
                            <div class="mb-0p text-center text-sm-13">{{{output_message}}}</div>
                        </template>
                    </div>
                    <div submit-error>
                        <template type="amp-mustache">
                            <p class="text-center text-success">{{output_message}}</p>
                        </template>
                    </div>
                </form>
            </div>
            <div class="w-100 d-flex flex-column bg-whitte justify-content-center text-10 align-items-center" style="border-top: 1px solid #dee2e6;">
                <p class="mb-2p text-center"><a class="text-black btn-transp" href="/privacy-policy/">Privacy Policy</a>.</p>
            </div>
            <div class="w-100 d-flex bg-whitte justify-content-center text-sm-13 align-items-center" style="border-top: 1px solid #dee2e6;">
               <span>Already a member?</span>
                <a  id="btn-user-register" class="btn-transp mb-0p pl-3p p-0p" role="button" on="tap:AMP.setState({ hideRegister: true,hideLogin: false })">Login</a>
            </div>
        </div>
    </div>
</div>
