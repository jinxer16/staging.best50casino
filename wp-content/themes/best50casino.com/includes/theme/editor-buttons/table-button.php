<?php
function add_container_button() {
    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
        return;
    if ( get_user_option('rich_editing') == 'true') {
        add_filter('mce_external_plugins', 'add_container_plugin');
        add_filter('mce_buttons', 'register_container_button');
    }
}
add_action('init', 'add_container_button');


function register_container_button($buttons) {
    array_push($buttons, "|", "add_table");
    return $buttons;
}

function add_container_plugin($plugin_array) {
    $plugin_array['add_table'] = get_template_directory_uri().'/includes/theme/editor-buttons/table-button.js'; //TODO change URL
    return $plugin_array;
}