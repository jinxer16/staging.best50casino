<?php

add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) {

    $data = get_user_meta( $user->ID, 'email_pref', true);

    ?>
    <h3>Email preferences</h3>
    <table class="form-table">

        <tr>
            <td>
                <label for="email_slots">
                    <input type="checkbox" name="email_pref[]" value="email-slots" <?php if(is_array($data)){ echo (in_array('email-slots', $data)) ? 'checked="checked"' : ''; }?> >
                    Email me about Slots
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label for="email_spins">
                    <input type="checkbox" name="email_pref[]" value="email-spins" <?php if(is_array($data)){ echo (in_array('email-spins', $data)) ? 'checked="checked"' : ''; }?> >
                    Email me about Free Spins
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label for="email_casino">
                    <input type="checkbox" name="email_pref[]" value="email-offers"<?php if(is_array($data)){ echo (in_array('email-offers', $data)) ? 'checked="checked"' : ''; } ?> >
                    Email me about Offers
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label for="email_promo">
                    <input type="checkbox" name="email_pref[]" value="email-promo" >
                    Email me about Promotions
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label for="visitosISO">
                    <input type="text" name="visitosISO" value="<?php echo get_user_meta( $user->ID, 'visitorsISO', true);?>" readonly >
                    Visitors ISO
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label for="visitosISO">
                    <input type="text" name="registration_date" value="<?php echo $user->user_registered;?>" readonly >
                    Registration Date
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label for="newsletterConsent">
                    <input type="checkbox" name="newsletterConsent" <?php echo get_user_meta( $user->ID, 'newsletterConsent', true) ? 'checked="checked"' : '';?> readonly >
                    Newsletter Consent
                </label>
            </td>
        </tr>
    </table>
<?php }

add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {

    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
    /* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
    if( isset($_POST['email_pref']) ){
        //$data=serialize($_POST['service_name']);
        $data = $_POST['email_pref'];
        update_user_meta($user_id, 'email_pref', $data);
    }
}
