<?php
// SETTINGS CONFIGURATION

//HELPER FUNCTIONS
function make_quick_setting($title, $slug, $affects, $type, $description)
{
	return array("title" => $title,
				"slug" => $slug,
				"affects" => $affects,
				"type" => $type,
				"description" => $description);
}

function make_advanced_group($title, $fields)
{
	return array("title"=>$title,"fields"=>$fields);
}

function make_setting($title, $slug, $type, $description="", $pre="", $post=";}")
{
	return array(
    "title" => $title,
		"slug" => $slug,
		"type" => $type,
		"description" => $description,
		"pre" => $pre,
		"post" => $post
  );
}

//END HELPER FUNCTIONS
$gambling_options = array();

$gambling_options[] = make_advanced_group("Sidebar Widgets Word Replacements", array(
	make_setting("Change 'Read Review' to:", "widget1-rreview", "text", "Enter the word to replace 'Read Review' in the top rated brokers widget"),

make_setting("Change 'Visit' to:", "widget2-visit", "text", "Enter the word to replace 'Visit' in the featured brokers widget"),

make_setting("Change 'Review' to:", "widget2-review", "text", "Enter the word to replace 'Review' in the featured brokers widget"),

make_setting("Change 'Payout' to:", "widget2-payout", "text", "Enter the word to replace 'Payout' in the featured brokers widget"),

make_setting("Change 'Min Account Size' to:", "widget2-acc", "text", "Enter the word to replace 'Min Account Size' in the featured brokers widget"),

make_setting("Change 'Demo' to:", "widget2-demo", "text", "Enter the word to replace 'Demo' in the featured brokers widget"),

make_setting("Change 'Read Review' to:", "widget2-rr", "text", "Enter the word to replace 'Read Review' in the featured brokers widget"),

make_setting("Change 'Overall Rating' to:", "widget2-rate", "text", "Enter the word to replace 'Overall Rating' in the featured brokers widget"),

make_setting("Change 'Read Review' to:", "widget3-review", "text", "Enter the word to replace 'Read Review' in the featured broker widget"),

make_setting("Change 'Open Account' to:", "widget3-open", "text", "Enter the word to replace 'Open Account' in the featured broker widget"),

make_setting("Change 'Review' to:", "widget4-review", "text", "Enter the word to replace 'Review' in the site review listings widget"),

));

$gambling_options[] = make_advanced_group("Author Bio and Author Page", array(
	make_setting("Change 'More About' to:", "author-morea", "text", "Enter the word to replace 'More About' in the author bio on the bottom of the posts page"),

make_setting("Change 'View Posts' to:", "author-posts", "text", "Enter the word to replace 'View Posts' in the author bio on the bottom of the posts page"),

make_setting("Change 'Visit Website' to:", "author-vistweb", "text", "Enter the word to replace 'View Website' in the author bio on the bottom of the posts page"),

make_setting("Change 'About' to:", "authorpage-about", "text", "Enter the word to replace 'About' on the author page."),

make_setting("Change 'Full Name' to:", "authorpage-name", "text", "Enter the word to replace 'Full Name' on the author page."),

make_setting("Change 'Website' to:", "authorpage-web", "text", "Enter the word to replace 'Website' on the author page."),

make_setting("Change 'More Info' to:", "authorpage-info", "text", "Enter the word to replace 'More Info' on the author page."),

make_setting("Change 'Posts by' to:", "authorpage-postsby", "text", "Enter the word to replace 'Posts by' on the author page.")

));


$gambling_options[] = make_advanced_group("In Post Broker Table Word Replacement", array(

 make_setting("Change 'Open Account' to:", "replace-head-visit", "text", "Enter the word to replace 'Open Account' in the heading and row of the shortcode broker comparison table"),

make_setting("Change 'US Traders' to:", "replace-head-usa", "text", "Enter the word to replace 'US Traders' in the heading of the shortcode broker comparison table"),

make_setting("Change 'Payout' to:", "replace-head-options", "text", "Enter the word to replace 'Payout' in the heading and row of the shortcode broker comparison table"),

make_setting("Change 'Min Deposit' to:", "replace-head-mindep", "text", "Enter the word to replace 'Min Deposit' in the heading and row of the shortcode broker comparison table"),

make_setting("Change 'Bonus' to:", "replace-head-bonus", "text", "Enter the word to replace 'Bonus' in the heading of the shortcode broker comparison table"),

make_setting("Change 'Review' to:", "replace-head-review1", "text", "Enter the word to replace 'Review' in the heading and the link in the shortcode broker comparison table"),

make_setting("Change 'Broker' to:", "replace-head-site", "text", "Enter the word to replace 'Broker' in the heading of the shortcode broker comparison table"),

make_setting("Change 'Visit Broker' to:", "replace-head-vbroker", "text", "Enter the word to replace 'Vist Broker' in the shortcode broker comparison table button"),

make_setting("Change 'Info' to:", "replace-head-info", "text", "Enter the word to replace 'Info' in the heading of the shortcode broker comparison table"),

make_setting("Change 'Read Review' to:", "replace-head-reviewread", "text", "Enter the word to replace 'Read Review' in the row of the shortcode broker comparison table"),

make_setting("Change 'Assets' to:", "replace-head-reviewassets", "text", "Enter the word to replace 'Assets' in the row of the shortcode broker comparison table"),

make_setting("Change 'Demo Account' to:", "replace-head-demoacc", "text", "Enter the word to replace 'Demo Account' in the row of the shortcode broker comparison table"),

make_setting("Change 'Min Account Size' to:", "replace-head-minacc", "text", "Enter the word to replace 'Min Account Size' in the heading and row of the shortcode broker comparison table"),

make_setting("Change 'Leverage' to:", "replace-head-lev", "text", "Enter the word to replace 'Leverage' in the heading and row of the shortcode broker comparison table"),

make_setting("Change 'Spread' to:", "replace-head-spread", "text", "Enter the word to replace 'Spread' in the heading and row of the shortcode broker comparison table"),

make_setting("Change 'Demo' to:", "replace-head-vdemo", "text", "Enter the word to replace 'Demo' link in the row of the shortcode broker comparison table"),

make_setting("Change 'Open' to:", "replace-head-open", "text", "Enter the word to replace 'Open' link in the row of the shortcode broker comparison table"),

make_setting("Change 'Rating' to:", "replace-head-rate", "text", "Enter the word to replace 'Rating' in the heading of the shortcode broker comparison table")

));

$gambling_options[] = make_advanced_group("In Post Featured Site Word Replacement", array(
	make_setting("Change 'Visit Broker' to:", "featured-visitchange", "text", "Enter the word to replace 'Visit Broker' in the featured broker in post area")

));

$gambling_options[] = make_advanced_group("Excerpts Shortocde Word Replacement", array(
	make_setting("Change 'more' to:", "ex-more", "text", "Enter the word to replace 'more' at the bottom of the excerpt list"),
       make_setting("Change 'topics' to:", "ex-topics", "text", "Enter the word to replace 'topics' at the bottom of the excerpt list")
));


$gambling_options[] = make_advanced_group("Review Page Word Replacement", array(

make_setting("Change 'Overview' to:", "review-overview", "text", "Enter the words to replace 'Overview' on the review page"),

make_setting("Change 'Review' to:", "review-rev", "text", "Enter the words to replace 'Review' on the review page"),

make_setting("Change 'Read Full Review' to:", "review-fullrev", "text", "Enter the words to replace 'Read Full Review' on the review page"),

make_setting("Change 'Visit Broker' to:", "review-vbroker", "text", "Enter the words to replace 'Visit Broker' on the review page"),

make_setting("Change 'Details' to:", "review-details", "text", "Enter the words to replace 'Details' on the review page"),


make_setting("Change 'Broker' to:", "review-broker", "text", "Enter the words to replace 'Broker' on the review page"),

make_setting("Change 'Website URL' to:", "review-weburl", "text", "Enter the words to replace 'Website URL' on the review page"),

make_setting("Change 'Founded' to:", "review-founded", "text", "Enter the words to replace 'Founded' on the review page"),

make_setting("Change 'Headquarters' to:", "review-hq", "text", "Enter the words to replace 'Headquarters' on the review page"),

make_setting("Change 'Support Number' to:", "review-supportnumber", "text", "Enter the words to replace 'Support Number' on the review page"),

make_setting("Change 'Support Types' to:", "review-suptypes", "text", "Enter the words to replace 'Support Types' on the review page"),

make_setting("Change 'Languages' to:", "review-language", "text", "Enter the words to replace 'Languages' on the review page"),

make_setting("Change 'Trading Platform' to:", "review-platform", "text", "Enter the words to replace 'Trading Platform' on the review page"),

make_setting("Change 'Minimum Account Size' to:", "review-minaccsize", "text", "Enter the words to replace 'Minimum Account Size' on the review page"),

make_setting("Change 'Minimum 1st Deposit' to:", "review-mindep", "text", "Enter the words to replace 'Minimum 1st Deposit' on the review page"),

make_setting("Change 'Minimum Trade Amount' to:", "review-mintrade", "text", "Enter the words to replace 'Minimum Trade Amount' on the review page"),

make_setting("Change 'Maximium Trade Amount' to:", "review-maxtrade", "text", "Enter the words to replace 'Maximum Trade Amount' on the review page"),

make_setting("Change 'Bonus' to:", "review-bonus", "text", "Enter the words to replace 'Bonus' on the review page"),

make_setting("Change 'Payout' to:", "review-oppro", "text", "Enter the words to replace 'Payout' on the review page"),

make_setting("Change 'Leverage' to:", "review-leverage", "text", "Enter the words to replace 'Leverage' on the review page"),

make_setting("Change 'Spread' to:", "review-spread", "text", "Enter the words to replace 'Spread' on the review page"),

make_setting("Change 'Regulated' to:", "review-regulation", "text", "Enter the words to replace 'Regulated' on the review page"),

make_setting("Change 'Regulation' to:", "review-regtypes", "text", "Enter the words to replace 'Regulation' on the review page"),

make_setting("Change 'Fees' to:", "review-fee", "text", "Enter the words to replace 'Fees' on the review page"),

make_setting("Change 'Fee Info' to:", "review-feeinfo", "text", "Enter the words to replace 'Fees Info' on the review page"),

make_setting("Change 'Commissions' to:", "review-commish", "text", "Enter the words to replace 'Commissions' on the review page"),

make_setting("Change 'Commissions Info' to:", "review-commishinfo", "text", "Enter the words to replace 'Commissions Info' on the review page"),

make_setting("Change 'Free Demo Account' to:", "review-demo", "text", "Enter the words to replace 'Free Demo Account' on the review page"),

make_setting("Change 'Open Demo' to:", "review-opendemo", "text", "Enter the words to replace 'Open Demo' on the review page"),

make_setting("Change 'Account Types' to:", "review-acctypes", "text", "Enter the words to replace 'Account Types' on the review page"),

make_setting("Change 'Deposit Methods' to:", "review-depmethods", "text", "Enter the words to replace 'Deposit Methods' on the review page"),

make_setting("Change 'Withdrawal Methods' to:", "review-withmethods", "text", "Enter the words to replace 'Withdrawal Methods' on the review page"),

make_setting("Change 'Trading Methods' to:", "review-trademethods", "text", "Enter the words to replace 'Trading Methods' on the review page"),

make_setting("Change 'Types of Assets' to:", "review-assets", "text", "Enter the words to replace 'Types of Assets' on the review page"),

make_setting("Change 'Option Types' to:", "review-optiontypes", "text", "Enter the words to replace 'Option Types' on the review page"),

make_setting("Change 'Expiry Times' to:", "review-expiry", "text", "Enter the words to replace 'Expiry Times' on the review page"),

make_setting("Change 'Number of Assets' to:", "review-numassets", "text", "Enter the words to replace 'Number of Assets' on the review page"),

make_setting("Change 'Account Currency' to:", "review-currency", "text", "Enter the words to replace 'Account Currency' on the review page"),

make_setting("Change 'Trading Currency' to:", "review-trcurrency", "text", "Enter the words to replace 'Trading Currency' on the review page"),

make_setting("Change 'Scam History' to:", "review-scam", "text", "Enter the words to replace 'Scam History' on the review page"),

make_setting("Change 'US Traders Allowed' to:", "review-usacc", "text", "Enter the words to replace 'US Traders Allowed' on the review page"),

make_setting("Change 'Mobile Trading' to:", "review-mobilet", "text", "Enter the words to replace 'Mobile Trading' on the review page"),

make_setting("Change 'Tablet Trading' to:", "review-tablett", "text", "Enter the words to replace 'Tablet Trading' on the review page"),

make_setting("Change 'OVerall Score' to:", "review-score", "text", "Enter the words to replace 'Overall Score' on the review page"),

make_setting("Change 'Screenshots' to:", "review-screen", "text", "Enter the words to replace 'Screenshots' on the review page"),

make_setting("Change 'Pros' to:", "review-pro", "text", "Enter the words to replace 'Pros' on the review page"),

make_setting("Change 'Cons' to:", "review-con", "text", "Enter the words to replace 'Cons' on the review page"),

make_setting("Change 'Full Review' to:", "review-full", "text", "Enter the words to replace 'Full Review' on the review page")

));


// END SETTINGS CONFIGURATION

//ADMINISTRATION SCREEN
add_action('admin_menu', 'gambling_options_add_menu', 100);
function gambling_options_add_menu()
{
	add_submenu_page('design-options', 'Word Replacement', 'Word Replacement', 'update_themes', 'gambling-options', 'gambling_options_show_ui');
}

function get_gambling_options()
{
	$opc = get_option('gambling-options-settings');
	if ($opc != "") return unserialize($opc);

	return array();
}

function get_gambling_option($key)
{
	$options = get_gambling_options();
	if (array_key_exists($key, $options)) {
		return $options[$key];
	}

	return false;
}


function gambling_options_show_ui()
{

	if ($_REQUEST["action"] == "Reset to Default") {
		//delete the option
		delete_option('gambling-options-settings');
	}

	if ($_REQUEST["action"] == "save-settings") {
		$tos = $_REQUEST["gambling_options"];
		delete_option('gambling-options-settings');
		add_option('gambling-options-settings', serialize($tos));
	}

	$existing_values = @unserialize(get_option('gambling-options-settings'));

	if (!is_array($existing_values)) $existing_values = array();

	global $gambling_options;
	$gambling_options = apply_filters('gambling_options', $gambling_options);
?>
<style>
	.inside-left, .inside-right {
		width: 80%;
		margin: 0 5px 0 5px; }

	.halfpostbox { margin: 5px 0 5px 0; }

	.upload_image_button, .clear_field_button {
		width: auto !important; }

	input.farbtastic_color { width: 200px !important; }
	.farbtastic_container { display: none; }

	/*.postbox .inside { display: none; }*/
</style>
<script>
jQuery(document).ready( function() {
	jQuery('.handlediv').toggle(
		function() {
			jQuery(this).siblings('.inside').slideDown();
		},
		function() {
			jQuery(this).siblings('.inside').slideUp();
		}
	);
});
</script>
	<div class="wrap meta-box-sortables">
    	<div class="icon32" id="icon-themes"><br></div>
        <h2>Word Replacement</h2>

        <div id="poststuff">

<p>Use this page to control the translation or word replacement in your theme.  You can replace words for translation for some of the widgets and shortcodes here.</p>
<form class="form-wrap" method="post" action="?page=gambling-options">
<input type="hidden" name="action" value="save-settings" />

<div class="inside-left">
<?php
$toS = count($gambling_options);

for($j=0;$j<$toS;$j++) :
	$s = $gambling_options[$j];
	$fields = $s["fields"]; ?>

         <div class="postbox halfpostbox" id="">
            <div title="Click to toggle" class="handlediv"><br></div><h3 class="hndle"><span><?php echo $s["title"];?></span></h3>
            <div class="inside">
                    <?php
                        for ($i=0;$i<count($fields);$i++) {
                            $f = $fields[$i];
                        ?>
                            <div class="form-field form-required">
                                <?php design_do_field($f, $existing_values[$f["slug"]], "gambling_options"); ?>
                            </div>
                        <?php
                        }
                    ?>
            </div>
        </div>
<?php endfor; ?>
</div>



<div class="clear"></div>
<input type="submit" value="Save Changes" accesskey="p" tabindex="5" id="publish" class="button-primary" name="publish">
<input type="submit" name="action" value="Reset to Default" class="button-secondary">
</form>
		</div><!--poststuff-->

    </div><!--wrap-->

<?php
}




function gambling_options_admin_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('design-upload', get_bloginfo('template_url').'/includes/theme-options.js', array('jquery','media-upload','thickbox'));
	wp_register_script('farbtastic', get_bloginfo('template_url').'/includes/farbtastic/farbtastic.js');
	wp_enqueue_script('design-upload');
	wp_enqueue_script('farbtastic');

}

function gambling_options_admin_styles() {
	wp_enqueue_style('thickbox');
	wp_register_style('farbtastic', get_bloginfo('template_url')."/includes/farbtastic/farbtastic.css");
	wp_enqueue_style('farbtastic');
}

if (isset($_GET['page']) && $_GET['page'] == 'theme-options') {
	add_action('admin_print_scripts', 'gambling_options_admin_scripts');
	add_action('admin_print_styles', 'gambling_options_admin_styles');
}



//END ADMINISTRATION SCREEN



?>
