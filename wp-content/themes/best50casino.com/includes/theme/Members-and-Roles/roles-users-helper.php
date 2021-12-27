<?php
add_action('update_option_users-management', function ($old_value, $value) {
    global $wp_roles; // All Roles
    \Geniem\Roles::load_current_roles(); // All Roles
    $useManagements = get_option('users-management'); //all role / users Options
    foreach ($useManagements['role-management'] as $role => $options) {

        if ($role != 'administrator' && $role != 'newrole') {
            // ADD NEW USER
            if (get_role($role) == null) {
                foreach ($options['can-do'] as $cap => $trash) {
                    $caps[] = $cap;
                }
                add_role($role, $options['new-name'], $caps);
            }

            //ADDING-REMOVING-CAPS
            $currentRole = get_role($role);
            $currentCaps = get_role($role)->capabilities;

            foreach ($currentCaps as $cap => $trash) {
                if (!isset($options['can-do'][$cap])) {
                    $currentRole->remove_cap($cap);
                }
            }

            foreach ($options['can-do'] as $cap => $trash) {
                if ($cap) {
                    if (!$currentRole->has_cap($cap)) {
                        $currentRole->add_cap($cap);
                    }
                }
            }
            //RENAMING NOT WORKING NEED TO ADD ACTION (init)
            $roleNewName = isset($options['new-name']) ? $options['new-name'] : '';
            if ($roleNewName != $currentRole->name && $roleNewName) {
                $wp_roles->roles[$role]['name'] = $roleNewName;
                $wp_roles->role_names[$role] = $roleNewName;
//                \Geniem\Roles::rename($role,$roleNewName);
            }


        }
    }
    foreach ($useManagements['user-cap-management'] as $user => $options) {
        if ($user != 'panos') {
            $currentUser = new WP_User($user);
            $currentCaps = $currentUser->caps;
            foreach($currentCaps as $cap=>$trash){
                if(!isset($options['can-do'][$cap])){
                    echo '<br>'.$cap;
                    $currentUser->remove_cap($cap);
                }
            }
            foreach ($options['can-do'] as $cap => $trash) {
                if ($cap) {
                    if (!$currentUser->has_cap($cap)) {
                        $currentUser->add_cap($cap);
                    }
                }
            }
        }
    }
}, 10, 2);

add_action('wp_ajax_delete_role', 'delete_role');
//add_action('wp_ajax_nopriv_delete_role', 'delete_role' );
function delete_role()
{
    try {
        $test = array('Done');
        remove_role($_GET['role']);
    } catch (Exception $e) {
        $test = array("this is the problem");
    }
    echo json_encode($test);
    die ();
}

// display custom admin notice
function go_back_to_custom_settings_after_role_setup()
{

    $screen = get_current_screen();
//    echo '<pre>';
//    print_r($screen);
//    echo '</pre>';
    if (($screen->id === 'user-edit' || $screen->id === 'user' || $screen->id === 'users') && isset($_GET['wp_http_referer']) && $_GET['wp_http_referer'] == '/www.best50casino.com/wp-admin/admin.php?page=users-management') {
        ?>

        <div class="notice update-nag is-dismissible">
            <p>
                <a href="<?php echo $_GET['wp_http_referer']; ?><?php echo isset($_GET['tab']) ? '&tab=' . $_GET['tab'] : ''; ?>">Return
                    to User Settings</a></p>
        </div>
        <?php

    }
}

add_action('admin_notices', 'go_back_to_custom_settings_after_role_setup');



add_action('wp_ajax_repeater_helper', 'repeater_helper');
//add_action('wp_ajax_nopriv_delete_role', 'delete_role' );
function repeater_helper()
{
    $postID = $_GET['id'];
    $postArray = explode(",",$_GET['in']);
    $allPayments = get_all_posts('payment');
    $restPayments = array_diff($allPayments,$postArray);
    $countries = WordPressSettings::getCountryEnabledSettingsWithNames();
    asort($countries);
    $ret  = '<tr class="items">"';
    $ret .= '    <td>';
    $ret .= '        <select class="form-control item-choice selectpicker">';
    $ret .= '        <option value="">Select Payment</option>';
        foreach($restPayments as $restPayment){
            $paymentTitle = get_post_meta($restPayment, 'short_title', true) ? get_post_meta($restPayment, 'short_title', true) : get_the_title($restPayment);
            $ret .= '        <option value="'.$restPayment.'">'.$paymentTitle.'</option>';
        }
    $ret .= '        </select>';
    $ret .= '    </td>';
    $ret .= '    <td><input type="checkbox" name="_deposit[deposit_front][]" value="REPLACEME"  disabled></td>';
    $ret .= '    <td><input type="checkbox" name="_deposit[REPLACEME_dep_available]" value="1"  disabled></td>';
    $ret .= '    <td><input type="text" name="_deposit[REPLACEME_dep_charge]" value=""  disabled></td>';
    $ret .= '    <td><input type="text" name="_deposit[REPLACEME_dep_min]" value=""  disabled></td>';
    $ret .= '    <td><input type="text" name="_deposit[REPLACEME_dep_max]" value=""  disabled></td>';
    $ret .= '    <td><input type="text" name="_deposit[REPLACEME_dep_time]" value=""  disabled></td>';
    $ret .= '    <td><input type="text" name="_deposit[REPLACEME_dep_more]" value=""  disabled></td>';
    $ret .= '    <td><input type="checkbox" name="_deposit[REPLACEME_with_available]" value="1"  disabled></td>';
    $ret .= '    <td><input type="text" name="_deposit[REPLACEME_with_charge]" value=""  disabled></td>';
    $ret .= '    <td><input type="text" name="_deposit[REPLACEME_with_min]" value=""  disabled></td>';
    $ret .= '    <td><input type="text" name="_deposit[REPLACEME_with_time]" value=""  disabled></td>';
    $ret .= '    <td><input type="text" name="_deposit[REPLACEME_with_more]" value=""  disabled></td>';
    $ret .= '    <td class="btn-group dropleft">';
    $ret .= '        <div class="btn btn-sm btn-secondary dropdown-toggle disabled"   role="button" id="dropdownMenuLinkREPLACEME" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Restrictions</div>';
    $ret .= '        <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkREPLACEME">';
    $ret .= '            <h6 class="dropdown-header">REPLACEME Restrictions per Country</h6>';
    $ret .= '            <div class="dropdown-divider"></div>';
    $ret .= '            <div style="min-width: 40rem;" class="d-flex flex-wrap p-1 dropdown-item">';
                            foreach ($countries as $code => $country) {
                                $ret .= '<div class="w-25 d-flex align-items-center">';
                                $ret .= '    <input type="checkbox" name="_deposit[REPLACEME_restrictions][]" value="'.$code.'"/>';
                                $ret .= '    <label class="m-0 ml-1">'.ucwords($country).'</label>';
                                $ret .= '</div>';
                             }
    $ret .= '            </div>';
    $ret .= '        </div>';
    $ret .= '    </td>';
    $ret .= '    <td class="pull-right repeater-remove-btn"><button class="btn btn-danger remove-btn btn-sm">Remove</button></td>';
    $ret .= '</tr>';
    echo $ret;
    die ();
}