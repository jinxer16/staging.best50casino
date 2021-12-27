<?php

/*
	Run the bonuscode_button function when WP initialization
*/
add_action('init', 'ftable_button');

/*
	Responsible for setting up the filters so we can add the button
*/
function ftable_button()
{
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		return;
	}
	
	if ( get_user_option('rich_editing') == 'true' ) {
		add_filter( 'mce_external_plugins', 'ftable_add_plugin' );
		add_filter( 'mce_buttons', 'ftable_register_button' );
		
	}
	
	if (is_admin()) {
		//wp_enqueue_script('jquery-ui-dialog');
		wp_enqueue_style("wp-jquery-ui-dialog");
		wp_register_script('jquery-ui-cdn', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js');
		//wp_enqueue_script('jquery-ui-cdn');
		
		wp_register_style('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.0/themes/ui-lightness/jquery-ui.css');
		//wp_enqueue_style('jquery-ui');
	}
}

/*
	Add a vertical separator and a 'bcb_button' to the list of buttons
*/
function ftable_register_button( $buttons ) {
	array_push( $buttons, "|", "ftable_button" );
	return $buttons;
}

/*
	Register TinyMCE Plugin
*/
 
function ftable_add_plugin( $plugin_array ) {
   $plugin_array['ftable_button'] = plugins_url( 'buttons/ftable_button.js', __FILE__ ); 
   return $plugin_array;
}

/*
	This actually adds the html for the dialog, all html and JS needed to control the behavior should go here
*/
add_action('in_admin_footer', 'ftable_add_editor');
function ftable_add_editor()
{
		$loop = new WP_Query( array( 'post_type' =>'kss_casino', 'posts_per_page' => -1, 'orderby'=>'title' ) ); 
		$sites = $loop->posts;
	
?>
<style>.shortcode_builder_table td { padding: 4px !important; }</style>
	<div id="ftable_editor" class="shortcode_editor" title="[FeaturedTable] Builder" style="display:none;">
    	<table cellspacing=0 cellpadding=4 border=0 class="shortcode_builder_table" width="400">
 			<tr>
            	<td class="shortcode_builder_label">Site Name</td>
                <td class="shortcode_builder_value">
                	<select id="ftable_site">
                    	<option value="">[No Site]</option>
                    	<?php foreach ($sites as $site) { ?>
                        <option><?php echo get_post_meta($site->ID, '_as_roomname', true);?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
            	<td class="shortcode_builder_label">Title</td>
                <td class="shortcode_builder_value"><input id="ftable_title" /></td>
            </tr>
            <tr>
            	<td>Summary Text</td>
                <td><textarea id="ftable_body" style="width: 100%; height: 80px;"></textarea></td>
            </tr>
           
        </table>
    </div>

   <script>
	jQuery(document).ready( function() {
		
		jQuery('#ftable_editor').dialog({
			autoOpen:false,
			draggable: false,
			modal: true,
			width: 450,
			resizable: false,
			buttons: {
				Ok: function() {
					var str = '[featured ';
					
					if (jQuery('#ftable_title').val()!='') str += 'feattitle=\'' + jQuery('#ftable_title').val() + '\' '; //a normal input
					if (jQuery('#ftable_site :selected').val()!='') str += 'site=\'' + jQuery('#ftable_site :selected').val() + '\' '; //a select box
					
					str += ']';
					
					str += jQuery('#ftable_body').val() + '[/featured]';
					
					var Editor = tinyMCE.get('content');
					Editor.focus();
					Editor.selection.setContent(str);

					
					jQuery( this ).dialog( "close" );
				},
				Cancel: function() {
					jQuery( this ).dialog( "close" );
				}
			}
		});
	});
	</script>
<?php
}