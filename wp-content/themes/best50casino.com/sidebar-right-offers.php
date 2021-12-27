<?php if (get_post_meta($post->ID, 'bonus_custom_meta_title_guide', true)) { ?>
    <h4 class="main-title bonus-page-title" id="guide"><?php echo get_post_meta($post->ID, 'bonus_custom_meta_title_guide', true); ?></h4>
<?php } ?>

<?php if (get_post_meta($post->ID, 'bonus_custom_meta_txt_guide', true)) { ?>
    <?php $offers = explode("|" , get_post_meta($post->ID, 'bonus_custom_meta_txt_guide', true)); ?>
    <?php $i = 0; ?>
    <?php foreach ($offers as $offer){ ?>
        <?php $i += 1; ?>
        <div class="guide-wrapper d-flex "><div class="step-mbr"><?php echo $i; ?></div><div class="step"><?php echo $offer; ?></div></div>
    <?php } ?>
<?php } ?>


<a href="<?php echo $ctaLink; ?>" target="_blank" rel="nofollow" class="btn cta-table catholic-cta cta-review bumper" data-casinoid="<?php echo $bookieid; ?>" data-country="<?php echo $countryISO?>" <?php echo $ctaFunction; ?> style="text-transform: unset;width: 100%;margin: 10px 0 20px;padding: 10px;">Join <?php echo get_the_title($bookieid); ?></a>

<div class="bookmakers-reminder">
    <div class="col-sm-12">
        <div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/help.png" alt="Customer Support">
            <div class="head">Customer Support</div><p>Best50Casino’s CS team is available on a daily basis. We are here to help you deal with any problem you might face. Shoot us an email over at <a href="mailto:support@best50casino.com">support@best50casino.com</a>.
        </div>
    </div>
    <div class="col-sm-12">
        <div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cookies.png" alt="Cookies Deletion">
            <div class="head">Delete Cookies</div><p>Make sure to delete your cookies before signing up with an online casino. This helps the system understand that you’ve registered on the casino through Best50Casino, and ensures there won’t be any confusion with your previous visits to the operator. Learn how to delete your cookies here.</p>
        </div>
    </div>
    <div class="col-sm-12">
        <div>
            <div class="msg-quote"><i class="fas fa-quote-left"></i></div>
            <div class="head">Message from Best50Casino Team</div><p>All of us here at Best50Casino owe you a big “Thank you” for choosing our portal to register at any of the online casinos presented on the site. This way you enjoy all the benefits each operator offers, but also let us intervene in case of a dispute.</p>
        </div>
    </div>
</div>