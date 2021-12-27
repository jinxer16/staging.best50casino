<?php
function amp_mobile_redirect() {
    global  $post;
    if (is_singular(['kss_casino','bc_bonus_page'])) {
        $get_id = $post->ID;
        $amp_template = get_post_meta($get_id, 'casino_custom_meta_template', true);
        $amp_location = get_the_permalink($get_id).'?amp';
        if (wp_is_mobile() && $amp_template=='new') {
            wp_redirect($amp_location);
            exit;
        }
    }
}
//add_action('wp', 'amp_mobile_redirect');