<div class="modal fade right modalusers" style="top: 11%;" id="modalSignIn" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-right" role="document">
        <div class="modal-content w-80 w-sm-100">
            <div class="modal-header bg-primary p-0">
                <div class="modal-title w-100 text-white font-weight-bold p-10p" id="modalLabel">Sign In</div>
                <button type="button" class="closeModal btn-transp text-white text-21 p-5p" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-black p-10p">
                <form id="loginform-best50">
                    <div class="form-group">
                        <label for="UserName">Username</label>
                        <input type="text" class="form-control form-control-sm" id="UserName" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Password</label>
                        <input type="password" class="form-control form-control-sm" id="inputPassword" name="inputPassword" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input name="rememberMe" type="checkbox" id="rememberMe" value="forever">
                        <label for="rememberMe">Remember me</label>
                    </div>

                    <button type="submit" onclick="loginThis(this,event)" class="btn btn-primary w-100 loginBtn">LOGIN</button>

                    <div class="d-flex flex-column align-items-center pt-5p text-13 ">Forgot your password;
                        <button type="button" id="btn-user-forgot" class="btn-transp p-0" data-toggle="modal"
                                data-target="#modalForgot">Reset paswword
                        </button>
                    </div>

                </form>
                <div id="response" class="mt-5p mb-5p"></div>
            </div>

            <div class="modal-footer text-black p-5p justify-content-center">
                <p class="mb-0">Not a member;
                    <button type="button" id="btn-user-register" class="btn-transp p-0" data-toggle="modal"
                            data-target="#modalRegister">Register
                    </button>
                </p>
            </div>

        </div>
    </div>
</div>


<div class="modal fade right modalusers" id="modalForgot" style="top: 11%;" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-right" role="document">
        <div class="modal-content w-80 w-sm-100">
            <div class="modal-header bg-primary p-0">
                <div class="modal-title w-100 text-white font-weight-bold p-10p" id="modalLabel">Forgot Password</div>
                <button type="button" class="closeModal btn-transp text-white text-21 p-5p" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-black p-2 p-sm-4">
                <form id="lostpasswordform" action="" method="post">
                    <div class="form-group">
                        <label for="UserName">Email</label>
                        <input type="email" name="emailForgot" class="form-control form-control-sm" id="emailForgot" placeholder="Your Email">
                    </div>
                    <div class="ajaxload mt-10p p-10p" style="display: none;">
                        <div class="loader mx-auto" style="display: block"></div>
                    </div>
                    <div id="responseReset" class="mt-5p mb-5p p-10p"></div>
                    <button type="button" onclick="SendResetLink(event,this);" class="btn text-white bg-primary border-0 w-100 pb-5p pt-5p font-weight-bold lostpassword-button">Reset Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade right" id="logout-modal" tabindex="-1" role="dialog"
     aria-labelledby="modalLabelLogout" aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-right" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary p-0">
                <div class="modal-title w-100 text-white font-weight-bold p-10p" id="modalLabel">Logout</div>
                <button type="button" class="closeModal btn-transp text-white text-21 p-5p" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer text-center text-black d-flex flex-column align-items-center" style="text-shadow: none;">
                <span class="w-100 d-block">Are you sure you want to logout?</span>
                <div class="btns">
                <button type="button" class="btn btn-default text-black bg-light" id="modal-btn-yes" style="border: 1px solid #c1c1c1;">YES
                </button>
                <button type="button" class="btn btn-primary text-white" id="modal-btn-no">
                    NO
                </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade right modalusers" id="modalRegister" style="top: 11%;" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-right" role="document">
        <div class="modal-content w-90 w-sm-100">
            <div class="modal-header bg-primary p-0">
                <div class="modal-title w-100 text-white p-10p font-weight-bold" id="modalLabel">Register</div>
                <button type="button" class="closeModal btn-transp text-23 text-white p-5p m-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal-register-body text-black pl-15p pb-5p pt-5p pr-15p">
                <?php
                ob_start();
                ?>
                <script src="https://www.google.com/recaptcha/api.js?hl=en" async defer></script>
                    <form id="register-form">
                        <div class="form-group mb-5p">
                            <label for="UserNameRe">Username*</label>
                            <input type="text" class="form-control form-control-sm" id="UserNameRe"
                                   placeholder="johndoe12" required="true">
                        </div>
                        <div class="form-group mb-5p">
                            <label for="inputEmailRe">Email*</label>
                            <input type="email" class="form-control form-control-sm" id="inputEmailRe"
                                   aria-describedby="emailHelp" placeholder="johndoe@gmail.com" required="true">
                        </div>
                        <div class="form-group mb-5p">
                            <label for="inputPasswordRe">Password*</label>
                            <input type="password" class="form-control form-control-sm" id="inputPasswordRe"
                                   placeholder="Password" required="true">
                        </div>
                        <div class="form-group mb-5p">
                            <label for="inputPasswordReseond">Confirm Password*</label>
                            <input type="password" class="form-control form-control-sm" id="inputPasswordReseond"
                                   placeholder="Password" required="true">
                        </div>

                        <script src="https://www.google.com/recaptcha/api.js?render=6LeDDeoUAAAAABqGSHZboQs6FAug60g_k-waqo0D&lang=en"></script>

                        <script src="https://www.google.com/recaptcha/api.js?hl=en" async defer></script>

                        <div id="recaptcha" class="g-recaptcha" data-sitekey="6LeDDeoUAAAAABqGSHZboQs6FAug60g_k-waqo0D"></div>
                        <input type="hidden" id="g-recaptcha-response">
                        <span class="captcha-error text-sm-13 d-block text-danger text-18"></span>
                        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=en" async defer></script>

                        <script type="text/javascript">
                            var onloadCallback = function() {
                                console.log("grecaptcha callback");
                                grecaptcha.render('recaptcha', {
                                    'sitekey' : '6LeDDeoUAAAAABqGSHZboQs6FAug60g_k-waqo0D'
                                });
                            };
                        </script>

                        <div class="form-check mb-5p">
                            <input type="checkbox" class="form-check-input" id="checkterms">
                            <label for="checkterms" class="form-check-label"> I accept the <a class="font-weight-bold" href="/privacy-policy/">terms and conditions </a>*</label>
                        </div>
                        <div class="form-check mb-5p">
                            <input type="checkbox" class="form-check-input" id="checknewsletter">
                            <label for="checknewsletter" class="form-check-label"> I consent to receive emails about Free Spins & No Deposit Bonuses</label>
                            <input type="text" class="form-check-input" id="visitorsISO" value="<?php echo $GLOBALS['visitorsISO'];?>" hidden>
                        </div>

                        <button type="button" onclick="RegisterUser(event,this)" id="regiBtn" class="btn btn-primary signup-btn w-100">SUBMIT</button>
                    </form>
                <?php
                $output = ob_get_clean();
                echo $output;
                ?>
                <div class="ajaxload mt-10p p-10p" style="display: none;">
                    <div class="loader mx-auto" style="display: block"></div>
                </div>
                <div id="register-box" class="pl-2 pr-2 pt-2 pb-2"></div>
            </div>

            <div class="modal-footer d-flex flex-column text-center text-black p-2p">
                <p class="mb-2p"><a class="text-black btn-transp" href="/privacy-policy/">Privacy Policy</a>.</p>
            </div>
            <div class="modal-footer text-black p-2p justify-content-center">
                <p class="mb-0">Already a member?
                    <button type="button" id="btn-user-login" class="btn-signin btn-transp p-0" data-toggle="modal" data-target="#modalSignIn">Login</button>
                </p>
            </div>

        </div>
    </div>
</div>
