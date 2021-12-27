<?php
//if (is_singular(['kss_casino','bc_bonus_page'])) {
//    $get_id = $post->ID;
//    $amp_template = get_post_meta($get_id, 'casino_custom_meta_template', true);
//    $amp_location = get_the_permalink($get_id).'?amp';
//    if (wp_is_mobile() && $amp_template=='new') {
//        wp_redirect($amp_location);
//        exit;
//    }
//}
//?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta name="google-site-verification" content="ien7pSov3at7tp_9UJ-C9hj11Ks3iRqEGo1HzY5APTE" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="author" content="best50casino.com" />
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="robots" content="index, follow" />
<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicon.png">
<title><?php echo str_replace(array("'", "\"", "&quot;", "\n"), '',get_post_meta($post->ID, '_yoast_wpseo_title', true)) ?:  str_replace(array("'", "\"", "&quot;", "\n"), '',get_the_title($post->ID)); ?></title>
<meta property="og:title" content="<?php echo str_replace(array("'", "\"", "&quot;", "\n"), '',get_post_meta($post->ID, '_yoast_wpseo_title', true)) ?: get_the_title($post->ID); ?>"/>
<meta name="description" content="<?php echo str_replace('"', '', get_post_meta($post->ID, '_yoast_wpseo_metadesc', true)) ?: str_replace('"', '', get_the_excerpt($post->ID)) ?>"/>
<meta property="og:description" content="<?php echo str_replace('"', '', get_post_meta($post->ID, '_yoast_wpseo_metadesc', true)) ?: str_replace('"', '', get_the_excerpt($post->ID)); ?>"/>
<?php //if(is_singular(['kss_casino','bc_bonus_page']) && $amp_template ==='new'){ ?>
<!--<link rel="amphtml" href="--><?php //echo wp_get_canonical_url($post->ID); ?><!--?amp">-->
<?php
//} ?>
<link rel="canonical" href="<?php echo wp_get_canonical_url($post->ID); ?>">
<meta property="og:locale" content="en_US"/>
<meta property="og:type" content="website"/>
<meta property="og:site_name" content="best50casino.com"/>
<meta property="og:image" content="<?php echo get_the_post_thumbnail_url($post->ID, 'thumb-800'); ?>"/>
<meta property="og:image:secure_url" content="<?php echo get_the_post_thumbnail_url($post->ID, 'thumb-800'); ?>"/>
<meta property="og:url" content="<?php echo get_the_permalink($post->ID); ?>"/>
<meta name="twitter:card" content="summary_large_image"/>
<meta name="twitter:description" content="<?php echo str_replace('"', '', get_post_meta($post->ID, '_yoast_wpseo_metadesc', true)); ?>"/>
<meta name="twitter:title" content="<?php echo get_post_meta(get_the_ID(), '_yoast_wpseo_title', true) ? get_post_meta(get_the_ID(), '_yoast_wpseo_title', true) : get_the_title($post->ID); ?>"/>
<meta name="twitter:image" content="<?php echo get_the_post_thumbnail_url($post->ID); ?>"/>
<?php
$faqs = @get_post_meta($post->ID,'faqs',true) ?? false;
if ($faqs) {
$i = 0;
$len = count($faqs);
?>
<script type="application/ld+json">{
"@context": "https:\/\/schema.org","@type": "FAQPage","mainEntity": [
<?php
$to_be_replaced = array("\r\n", "\n", "\r");
$replacement = array(" ", " ", " ");
foreach ($faqs as $value) {
$stripped = str_replace('"', '', $value['answer']);
if ($i == $len - 1) {
?>
{ "@type": "Question", "name": "<?= $value['question']; ?>", "acceptedAnswer": {"@type": "Answer","text": "<p><?=str_replace($to_be_replaced, $replacement, strip_tags($stripped))?></p>"}}
<?php
}else{
?>
{"@type": "Question","name": "<?= $value['question']; ?>","acceptedAnswer": {"@type": "Answer","text": "<p><?=str_replace($to_be_replaced, $replacement, strip_tags($stripped))?></p>"}},
<?php
}
 $i++;
}
?>
]}
</script>
        <?php
}
    ?>
<style type="text/css"><?php include 'wp-content/themes/best50casino.com/assets/css/core.css'; ?></style>
<style type="text/css" media="screen and (min-width:1025px)"> <?php include 'wp-content/themes/best50casino.com/assets/css/desktop.css'; ?></style>
<style type="text/css" media="screen and (max-width:1024px) and (min-width: 476px)"> <?php include 'wp-content/themes/best50casino.com/assets/css/tablet.css'; ?></style>
<style type="text/css" media="screen and (max-width:475px)"> <?php include 'wp-content/themes/best50casino.com/assets/css/mobile.css'; ?></style>
<link rel="preconnect" href="https://maxcdn.bootstrapcdn.com">
<link rel='preconnect' href='https://www.google-analytics.com' />
<link rel='dns-prefetch' href='https://www.google-analytics.com' />
<link rel='dns-prefetch' href='https://certify.gpwa.org' />
<link rel='dns-prefetch' href='https://www.gstatic.com' />
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-PND5RB5');</script>
    <!-- End Google Tag Manager -->
</head>

<div id="overlaysite"></div>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PND5RB5"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->