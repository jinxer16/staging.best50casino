<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="google-site-verification" content="ien7pSov3at7tp_9UJ-C9hj11Ks3iRqEGo1HzY5APTE" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-125571475-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-125571475-1');
    </script>
    <meta name="author" content="best50casino.com" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="robots" content="index, follow" />

    <link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicon.png">

    <style type="text/css">
        <?php include('assets/css/bootstrap.min.css'); ?>
    </style>
    <style type="text/css">
        <?php include('style.css'); ?>
    </style>
    <style type="text/css" media="screen and (max-width:1365px)">
        <?php include('style-resp.css'); ?>
    </style>

    <?php wp_head();?>

</head>
<body>
<nav class="navbar" style="background: #212d33;">
    <div class="container">
        <div class="row">
            <a class="navbar-brand col-12" style="float:none;height:auto;" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img class="img-fluid" src="<?php echo get_template_directory_uri().'/assets/images/best50casino-logo.svg';?>" alt="Best50Casino.com" width="600" style="margin: 0 auto;">
            </a>
        </div>
        <div class="divide-nav"></div>
    </div>
</nav>
<div id="body">
    <div class="container">
        <div class="row content text-center" style="min-height:300px;">
            <p>We are Sorry</p>
            <p>Best50casino is not available in <?=$geocountry['state_prov']?>, <?=$geocountry['country_name']?></p>
        </div>
    </div>
</div>

</body><!--  div ends -->

</html>
