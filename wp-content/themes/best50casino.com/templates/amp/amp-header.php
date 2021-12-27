<!doctype html>
<html ⚡  lang="en-us">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicon.png">
    <link rel="preload" as="script" href="https://cdn.ampproject.org/v0.js">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
    <script async custom-element="amp-accordion" src="https://cdn.ampproject.org/v0/amp-accordion-0.1.js"></script>
    <script async custom-element="amp-bind" src="https://cdn.ampproject.org/v0/amp-bind-0.1.js"></script>
    <script async custom-element="amp-geo" src="https://cdn.ampproject.org/v0/amp-geo-0.1.js"></script>
    <script async custom-element="amp-animation" src="https://cdn.ampproject.org/v0/amp-animation-0.1.js"></script>
    <script async custom-element="amp-position-observer" src="https://cdn.ampproject.org/v0/amp-position-observer-0.1.js"></script>
    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-element="amp-access" src="https://cdn.ampproject.org/v0/amp-access-0.1.js"></script>
    <script async custom-element="amp-user-notification" src="https://cdn.ampproject.org/v0/amp-user-notification-0.1.js"></script>
    <!-- Import `amp-selector` component in the header which we'll use to implement the tab switching. -->
    <script async custom-element="amp-selector" src="https://cdn.ampproject.org/v0/amp-selector-0.1.js"></script>
    <script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
    <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
    <!-- ## Setup -->
    <!--
      We use `amp-list` for retrieving latest data from the server.
    -->
    <script async custom-element="amp-list" src="https://cdn.ampproject.org/v0/amp-list-0.1.js"></script>
    <!-- We use `amp-mustache` as a templating for `amp-list` -->
    <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
    <!-- Import other AMP Extensions here -->

    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

    <link rel="canonical" href="<?=wp_get_canonical_url($post->ID)?>">
    <title><?php echo str_replace(array("'", "\"", "&quot;", "\n"), '',get_post_meta($post->ID, '_yoast_wpseo_title', true)) ?:  str_replace(array("'", "\"", "&quot;", "\n"), '',get_the_title($post->ID)); ?></title>
    <meta property="og:title" content="<?php echo str_replace(array("'", "\"", "&quot;", "\n"), '',get_post_meta($post->ID, '_yoast_wpseo_title', true)) ?:  str_replace(array("'", "\"", "&quot;", "\n"), '',get_the_title($post->ID)); ?>"/>
    <meta name="description" content="<?php echo str_replace('"', '', get_post_meta($post->ID, '_yoast_wpseo_metadesc', true)) ?: str_replace('"', '', get_the_excerpt($post->ID)) ?>"/>
    <meta name="og:description" content="<?php echo str_replace('"', '', get_post_meta($post->ID, '_yoast_wpseo_metadesc', true)) ?: str_replace('"', '', get_the_excerpt($post->ID)) ?>"/>
    <?php
    if (is_singular('kss_casino')){
    $rating = get_post_meta($post->ID, 'casino_custom_meta_sum_rating', true);
    }elseif(is_singular('bc_bonus_page')){
    $rating = get_post_meta($post->ID, 'bonus_custom_meta_rat_ovrl', true);
    }
    if (is_singular('kss_casino') || is_singular('bc_bonus_page')){
    ?>
 <script type="application/ld+json"> {"@context": "http://schema.org","@type": "Review","itemReviewed": {"@type": "CreativeWorkSeries","name": "<?=get_the_title()?>"},"reviewRating":{"@type":"AggregateRating","ratingValue":<?=round($rating,1)?>,"ratingCount":1,"bestRating":10,"worstRating":1},"author": {"@type": "Organization","name": "Best50casino.com" }}</script>
   <?php
    }
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
    <style amp-custom>
        <?php include 'wp-content/themes/best50casino.com/assets/css/amp.css'; ?>
    </style>
</head>
<body <?php body_class(); ?>>