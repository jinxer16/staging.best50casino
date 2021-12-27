<?php include(locate_template('templates/amp/amp-menu.php', false, false)); ?>
<?php //include(locate_template('templates/amp/amp-casino/json/gr/product.php', false, false)); ?>
<?php //include(locate_template('templates/amp/amp-casino/json/gr/product.json', false, false)); ?>
<div class="container p-0p">
    <div class="row m-0p">
        <div class="col-12 p-5p">
            <?php include(locate_template('templates/amp/amp-casino/amp-casino-ratings.php', false, false)); ?>
        </div>
    </div>
    <div class="row m-0p">
        <div class="col-12 p-5p">
            <?php include(locate_template('templates/amp/amp-casino/amp-casino-profile.php', false, false)); ?>
        </div>
    </div>
    <?php include(locate_template('templates/amp/amp-casino/amp-sticky-top.php', false, false)); ?>
    <div class="row m-0p">
        <div class="col-12 p-5p">
            <?php include(locate_template('templates/amp/amp-casino/amp-casino-pros-cons.php', false, false)); ?>
        </div>
    </div>
    <div class="row m-0p">
        <div class="col-12 p-5p">
            <?php $screenshotHeading=get_post_meta($post->ID,'casino_custom_meta_h2_screenshot',true);?>
            <?php if($screenshotHeading){ ?>
                <h2 class="widget2-new-heading text-18 pt-6p pb-6p pl-10p pr-10p font-weight-bold mb-5pw-100 d-block mt-0p text-whitte text-left"><?php echo $screenshotHeading;?></h2>
            <?php } ?>
            <?php include(locate_template('templates/amp/amp-common/amp-carousel.php', false, false)); ?>
        </div>
    </div>
    <div class="row m-0p">
        <div class="col-12 p-5p">
            <?php include(locate_template('templates/amp/amp-casino/amp-casino-license.php', false, false)); ?>
        </div>
    </div>
    <div class="row m-0p">
        <div class="col-12 p-5p">
            <?php include(locate_template('templates/amp/amp-casino/amp-casino-payments.php', false, false)); ?>
        </div>
    </div>
    <div class="row m-0p">
        <div class="col-12 p-5p">
            <?php include(locate_template('templates/amp/amp-casino/amp-casino-slots.php', false, false)); ?>
        </div>
    </div>
    <div class="row m-0p">
        <div class="col-12 p-5p">
            <?php include(locate_template('templates/amp/amp-casino/amp-casino-live-casino.php', false, false)); ?>
        </div>
    </div>
    <div class="row m-0p">
        <div class="col-12 p-5p">
            <?php include(locate_template('templates/amp/amp-casino/amp-casino-note.php', false, false)); ?>
        </div>
    </div>

    <div class="row m-0p">
        <div class="col-12 p-5p">
            <?php include(locate_template('templates/amp/amp-casino/amp-casino-mobile-app.php', false, false)); ?>
        </div>
    </div>

    <div class="row m-0p">
        <div class="col-12 p-5p">
            <?php include(locate_template('templates/amp/amp-casino/amp-casino-bonus.php', false, false)); ?>
        </div>
    </div>

    <div class="row m-0p">
        <div class="col-12 p-5p">
            <?php include(locate_template('templates/amp/amp-casino/amp-casino-games.php', false, false)); ?>
        </div>
    </div>

    <div class="row m-0p">
        <div class="col-12 p-5p">
            <?php include(locate_template('templates/amp/amp-casino/amp-casino-rtp.php', false, false)); ?>
        </div>
    </div>

    <div class="row m-0p">
        <div class="col-12 p-5p">
            <span class="widget2-new-heading mb-5p w-100 d-block mt-0 pt-5p pb-5p pr-7p pl-7p  font-weight-bold text-whitte text-left">Compare <?=get_the_title($bookieid);?> against other casinos</span>
            <?php include(locate_template('templates/amp/amp-common/amp-casino-comparison.php', false, false)); ?>
        </div>
    </div>

    <div class="row m-0p">
        <div class="col-12 p-5p">
            <?php include(locate_template('templates/amp/amp-casino/amp-casino-general-info.php', false, false)); ?>
        </div>
    </div>

    <div class="row m-0p">
        <div class="col-12 p-5p">
            <?php include(locate_template('templates/amp/amp-common/amp-player-reviews.php', false, false));?>
        </div>
    </div>

    <div class="row m-0p">
        <div class="col-12 p-5p">
            <?php include(locate_template('templates/amp/amp-common/content-faqs-amp.php', false, false)); ?>
        </div>
    </div>
    <div class="row m-0p">
        <div class="col-12 p-5p">
            <?php include(locate_template('templates/amp/amp-common/amp-best-casinos.php', false, false)); ?>
        </div>
    </div>
</div>