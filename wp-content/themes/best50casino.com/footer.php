<?php echo ShowPopups(); ?>
<?php
if (get_post_type() !== 'kss_casino'){
    $query_args = array(
        'post_type' => 'fortune-wheel',
        'post_status' => 'publish',
        'fields'      => 'ids',
        'posts_per_page' => 1,
        'meta_query'    => array(
            array(
                'key'       => 'state',
                'value'     => 'on',
            )
        )
    );
    $pop = get_posts($query_args);
    if (!empty($pop)){
        echo fortuneWheel();
    }
}
?>
<footer class="container-fluid bg-dark text-white mt-1" id="footer">
    <div class="container">
        <div class="row pt-2 pb-3">
            <div class="widget col-lg-3 col-md-7 col-12 logo-footer">
                <a href="<?php echo home_url(); ?>">
                    <img class="img-fluid d-block w-sm-80 w-100 mx-auto m-xl-0 mx-lg-0 m-md-0" src="https://www.best50casino.com/wp-content/themes/best50casino.com/assets/images/best50casino-logo.svg" data-src="https://www.best50casino.com/wp-content/themes/best50casino.com/assets/images/best50casino-logo.svg" alt="Best50Casino.com">
                </a>
            </div>
        </div>
        <?php include(locate_template('common-templates/footer-menu.php', false, false)); ?>
    </div>
    <div class="scrolltop d-block d-sm-none">
        <div class="scroll rounded icon"><i class="fa fa-4x fa-angle-up"></i></div>
    </div>
</footer>


<noscript id="deferred-styles">
    <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/below.css?v=21">
</noscript>

<script>
    var loadDeferredStyles = function () {
        var addStylesNode = document.getElementById("deferred-styles");
        var replacement = document.createElement("div");
        replacement.innerHTML = addStylesNode.textContent;
        document.body.appendChild(replacement);
        addStylesNode.parentElement.removeChild(addStylesNode);
    };
    var raf = window.requestAnimationFrame || window.mozRequestAnimationFrame ||
        window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
    if (raf) raf(function () {
        window.setTimeout(loadDeferredStyles, 0);
    });
    else window.addEventListener('load', loadDeferredStyles);
    document.addEventListener("DOMContentLoaded", function() {
        var lazyVideos = [].slice.call(document.querySelectorAll("video.lazy"));

        if ("IntersectionObserver" in window) {
            var lazyVideoObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(video) {
                    if (video.isIntersecting) {
                        for (var source in video.target.children) {
                            var videoSource = video.target.children[source];
                            if (typeof videoSource.tagName === "string" && videoSource.tagName === "SOURCE") {
                                videoSource.src = videoSource.dataset.src;
                            }
                        }

                        video.target.load();
                        video.target.classList.remove("lazy");
                        lazyVideoObserver.unobserve(video.target);
                    }
                });
            });

            lazyVideos.forEach(function(lazyVideo) {
                lazyVideoObserver.observe(lazyVideo);
            });
        }
    });
    document.addEventListener("DOMContentLoaded", function () {
        const lazyLoadBackground = function () {
            var lazyBackgrounds = [].slice.call(document.querySelectorAll(".lazy-background"));

            if ("IntersectionObserver" in window) {
                let lazyBackgroundObserver = new IntersectionObserver(function (entries, observer) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add("visible");
                            lazyBackgroundObserver.unobserve(entry.target);
                        }
                    });
                });

                lazyBackgrounds.forEach(function (lazyBackground) {
                    lazyBackgroundObserver.observe(lazyBackground);
                });
            }
        }
        lazyLoadBackground();
        document.addEventListener("scroll", lazyLoadBackground);
        window.addEventListener("resize", lazyLoadBackground);
        window.addEventListener("orientationchange", lazyLoadBackground);
    });
    document.addEventListener("DOMContentLoaded", function () {
        const lazyLoad = function () {
            let lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));
            let active = false;

            if (active === false) {
                active = true;

                setTimeout(function () {
                    lazyImages.forEach(function (lazyImage) {
                        if ((lazyImage.getBoundingClientRect().top <= window.innerHeight && lazyImage.getBoundingClientRect().bottom >= 0) && getComputedStyle(lazyImage).display !== "none") {
                            lazyImage.src = lazyImage.dataset.src;
                            // lazyImage.srcset = lazyImage.dataset.srcset;
                            lazyImage.classList.remove("lazy");

                            lazyImages = lazyImages.filter(function (image) {
                                return image !== lazyImage;
                            });

                            if (lazyImages.length === 0) {
                                document.removeEventListener("scroll", lazyLoad);
                                window.removeEventListener("resize", lazyLoad);
                                window.removeEventListener("orientationchange", lazyLoad);
                            }
                        }
                    });

                    active = false;
                }, 100);
            }
        };
        lazyLoad();
        document.addEventListener("scroll", lazyLoad);
        window.addEventListener("resize", lazyLoad);
        window.addEventListener("orientationchange", lazyLoad);
    });
</script>

<!-- Google Analytics -->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','Best50ga');

    Best50ga('create', 'UA-125571475-1', 'auto', 'Best50Tracker');
    Best50ga('Best50Tracker.send', 'pageview');

    function atOnload() {
        initAnalytics();
    }
    if (window.addEventListener) window.addEventListener("load", atOnload, false);
    else if (window.attachEvent) window.attachEvent("onload", atOnload);
    else window.onload = atOnload;
    //]]>
</script>
<!-- End Google Analytics -->


<script defer async type="text/javascript"> (function() { var css = document.createElement('link'); css.href = 'https://use.fontawesome.com/releases/v5.8.1/css/all.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>
<script>
    window.FontAwesomeConfig = {
        searchPseudoElements: true
    }
</script>

<script defer src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>
<script defer type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.4/isotope.pkgd.min.js"></script>
<!--<script defer src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
<script defer type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
<script defer type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/scripts.min.js?v=69.2"></script>
<script defer type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/includes/theme/functions/votes/ajax-votes.min.js?v=30"></script>
<script defer type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/includes/theme/functions/votes/sign-up.min.js?v=32"></script>
<script defer type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/includes/theme/functions/login-register/login-register.min.js?v=15"></script>
<script defer type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/promo.min.js?v=8"></script>
<?php include( locate_template( 'common-templates/login-register-modals.php', false, false ) ); ?>
<?php if(get_post_type($post->ID) ==='kss_casino' || get_post_type($post->ID) ==='bc_bonus_page'){?>
    <link href='<?php echo get_template_directory_uri(); ?>/assets/css/below.css?v=28"' rel='stylesheet' type="text/css">
    <script defer type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/includes/theme/functions/casino-comparison/casino-comparison.min.js?v=29.1"></script>
    <?php
}?>
<script defer type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.countdown.min.js"></script>
<script type="text/javascript">window.onload = new function(){var hd = document.getElementsByTagName('head').item(0);var js = document.createElement('script'); js.setAttribute('language', 'javascript'); js.setAttribute('src', 'https://certify.gpwa.org/script/best50casino.com/'); hd.appendChild(js); return false;}</script>
<?php if (wp_is_mobile()){
get_template_part("common-templates/bottom-menu");
}
if (!wp_is_mobile()){
get_template_part("common-templates/side-menu");
}
?>
<?php //if( wpb_lastvisit_the_title ( "-1 day" ) && !$_GET['ms-email'] ){get_template_part("templates/pop-up");}?>
<?php if( get_post_type() =='kss_slots'  && $GLOBALS['countryISO']=='gb' ){get_template_part("templates/age-validation");}?>

</body>
</html>
