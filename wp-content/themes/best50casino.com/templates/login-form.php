<?php
/* Template Name: login page amp*/
?>
<?php get_header(); ?>
<body <?php body_class(); ?> >
<?php include(locate_template('common-templates/main-menu.php', false, false)); ?>
<div class="container body-bg">
    <div class="row page-bg page-shadow pt-10p">
        <div class="d-flex flex-wrap">
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 d-none d-lg-block d-xl-block sidenav">
                <?php
                dynamic_sidebar('secondary-sidebar');
                $two_col = 7;
                $two_coll = 9;
                $class="threecols";
                ?>
            </div>
            <div class="col-lg-<?php echo $two_col; ?> col-md-9 col-12 col-xs-12 text-justify main <?php echo $class; ?>">
                <form>
                    <div class="form-group">
                        <label for="UserName">Username</label>
                        <input type="text" class="form-control form-control-sm" id="UserName" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Password</label>
                        <input type="password" class="form-control form-control-sm" id="inputPassword" placeholder="Password">
                    </div>
                    <button type="submit" onclick="login(this,event)" class="btn btn-primary"  data-casino="<?=$post->ID?>">Submit</button>
                </form>
            </div><!-- #primary -->

            <div class="col-lg-3 col-md-3 col-sm-12 d-none d-lg-block d-xl-block col-xs-12 sidenav">
                <?php  dynamic_sidebar('main-sidebar');?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
