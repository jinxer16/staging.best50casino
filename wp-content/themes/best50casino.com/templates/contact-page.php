<?php
/* Template Name: contact page */
?>
<?php get_header(); ?>
<body <?php body_class(); ?> >
<?php include(locate_template('common-templates/main-menu.php', false, false)); ?>
<?php include(locate_template('common-templates/sub-menu.php', false, false)); ?>
    <div class="container body-bg">
        <div class="row page-bg page-shadow pt-10p">
            <div class="d-flex flex-wrap">
                <div class="col-lg-9-extra col-md-push-0 col-md-12  colmain col-sm-12 col-xs-12 text-left main ">
                    <?php
                    ob_start();
                    ?>
                    <script src="https://www.google.com/recaptcha/api.js?hl=en" async defer></script>
                    <?php
                    ?>
                    <h1 id="" class="star">Contact us</h1>
                    <div class="pl-2 pr-2 d-flex flex-wrap w-100">
                        <form class="w-100 d-flex flex-wrap" onsubmit="SendMailer(this,event)">
                            <div class="form-group col-6 pl-0">
                                <label for="nameInput">Name*</label>
                                <input type="text" class="form-control form-control-sm" id="nameInput" aria-describedby="nameHelp" placeholder="Your Name (Required)" required="true">
                            </div>
                            <div class="form-group col-6 pr-0">
                                <label for="inputEmail">Email*</label>
                                <input type="email" class="form-control form-control-sm" id="inputEmail" aria-describedby="emailHelp" placeholder="Your Email (Required" required="true">
                            </div>
                            <div class="form-group w-100">
                                <label for="surNameInput">Type*</label>
                                <select class="form-control form-control-sm" id="Typeof">
                                    <option>Generic/Marketing Queries</option>
                                    <option>Support</option>
                                </select>
                            </div>
                            <div class="form-group w-100">
                                <label for="UserName">Subject*</label>
                                <input type="text" class="form-control form-control-sm" id="subject" placeholder="Subject">
                            </div>

                            <div class="form-group  w-100">
                                <textarea rows="7" cols="120" placeholder="Your message" class="w-100 form-control form-control-sm" id="message"></textarea>
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
<!--                            --><?php //new reCAPTCHA_Login_Form(); ?>
                            <button type="submit" class="btn btn-primary w-100 signup-btn">Send</button>
                        </form>
                        <span class="contact-success mt-5p text-success"></span>
                    </div>
                    <?php
                    $output = ob_get_clean();
                    echo $output;
                    ?>
                </div><!-- #primary -->

                <div class="col-lg-3-extra col-xl-3-extra col-md-12 col-sm-12 col-xs-12 d-none  d-md-none d-lg-block d-xl-block sidenav">
                    <?php  dynamic_sidebar('main-sidebar');?>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>