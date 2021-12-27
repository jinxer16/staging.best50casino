<?php
/* Template Name: sitemap */
?>
<?php get_header(); ?>
<body <?php body_class(); ?> >
<?php include(locate_template('common-templates/main-menu.php', false, false)); ?>
<?php include(locate_template('common-templates/sub-menu.php', false, false)); ?>
<div class="container body-bg">
    <div class="col-12 page-bg page-shadow">
        <?php
        get_template_part("templates/mobile_head_gadgets");
        ?>
<article class="col-12" id="post-<?php the_ID(); ?>" <?php post_class(); ?>
	<div class="entry-content col-12">
        <h1 class="star pl-15p"><?= the_title()?></h1>
		<div id="sitemap" class="col-12 main d-flex flex-wrap">
						<div class="sitemap col-lg-3 col-sm-6">
							<h2 class="widget2-heading"><?php echo 'Slots'; ?></h2>
							<ul id="sitemap-pages"><?php create_list('kss_slots'); ?></ul>
						</div>

						<div class="sitemap col-lg-3 col-sm-6">
							<h2 class="widget2-heading"><?php _e('Pages','tie'); ?></h2>
							<ul id="sitemap-pages"><?php wp_list_pages('title_li='); ?></ul>
						</div> <!-- end .sitemap col -->

						<div class="sitemap col-lg-3 col-sm-6">
							<h2 class="widget2-heading"><?php echo 'Providers'; ?></h2>
							<ul id="sitemap-pages"><?php create_list('kss_softwares'); ?></ul>
						</div>

						<div class="sitemap col-lg-3 col-sm-6">
							<h2 class="widget2-heading"><?php echo 'Casinos'; ?></h2>
							<ul id="sitemap-pages"><?php create_list('kss_casino'); ?></ul>
						</div>

						<div class="sitemap col-lg-3 col-sm-6">
							<h2 class="widget2-heading"><?php echo 'News'; ?></h2>
							<ul id="sitemap-pages"><?php create_list('kss_news'); ?></ul>
						</div>

						<div class="sitemap col-lg-3 col-sm-6">
							<h2 class="widget2-heading"><?php echo 'Payment Methods'; ?></h2>
							<ul id="sitemap-pages"><?php create_list('kss_transactions'); ?></ul>
						</div>

						<div class="sitemap col-lg-3 col-sm-6">
							<h2 class="widget2-heading"><?php echo 'Casino Games'; ?></h2>
							<ul id="sitemap-pages"><?php create_list('kss_games'); ?></ul>
						</div>

						<div class="sitemap col-lg-3 col-sm-6">
							<h2 class="widget2-heading"><?php echo 'Guides'; ?></h2>
							<ul id="sitemap-pages"><?php create_list('kss_guides'); ?></ul>
						</div>
						<div class="sitemap col-lg-3 col-sm-6">
							<h2 class="widget2-heading"><?php echo 'Countries'; ?></h2>
							<ul id="sitemap-pages"><?php create_list('bc_countries'); ?></ul>
						</div>

                        <div class="sitemap col-lg-3 col-sm-6">
                            <h2 class="widget2-heading"><?php echo 'Promotions'; ?></h2>
                            <ul id="sitemap-pages"><?php create_list('kss_offers'); ?></ul>
                        </div>


        </div> <!-- end #sitemap -->
	</div><!-- .entry-content -->

</article><!-- #post-## -->
    </div>
</div>
<?php get_footer(); ?>