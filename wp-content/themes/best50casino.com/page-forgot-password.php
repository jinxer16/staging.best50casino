<?php /* Template Name: Page Forgot password Template */ ?>
<?php get_header(); ?>
<body <?php body_class(); ?> >
<?php include(locate_template('common-templates/main-menu.php', false, false)); ?>
<div class="container body-bg">
    <div class="row page-bg d-flex page-shadow pt-10p col-12" style="min-height: 580px;">
            <div class="w-70 d-block m-auto ">
                <?php
                $email = $_GET['email'];
                $key = $_GET['key'];
                $user_data = get_user_by( 'email',$email);
                ?>
                <span class="text-dark text-21">Reset password for user <span style="color: #ff6738"><?=$user_data->user_firstname;?></span></span>
                <form id="loginform-fox" action="" class="mt-20p">
                    <input type="hidden" id="UserIDf" value="<?=$email?>">
                    <input type="hidden" id="keyFor" value="<?=$key?>">
                    <div class="form-group">
                        <input type="password" class="form-control form-control-sm" id="ResetPasone" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-sm" id="ResetPastwo" placeholder="Confirm Password">
                    </div>
                    <a onclick="updatePassword(this,event)" class="btn text-white font-weight-bold w-100 btn-primary">SUBMIT</a>
                </form>
                <div class="errorForgot"></div>
            </div>
        </div>
</div>
<?php get_footer(); ?>