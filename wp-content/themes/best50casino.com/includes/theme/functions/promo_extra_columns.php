<?php
// Add the custom columns to the offer post type:



add_filter( 'manage_bc_offers_posts_columns', 'set_custom_edit_bc_offers_columns' );

function set_custom_edit_bc_offers_columns($columns) {
    unset( $columns['tags'] );
    unset( $columns['comments'] );
    unset( $columns['date'] );
    $columns['offers_bookie'] = __( 'Casino' );
    $columns['countdown'] = __( 'Countdown' );
    $columns['promotion_days'] = __( 'Valid On' );
    $columns['promo_type']  = 'Promotion Type';
//    $columns['author'] = __( 'Author' );
    $columns['exclusive'] = __( 'Exclusive' );
    $columns['visible_only'] = __( 'Visible only' );
    $columns['date'] = __( 'Date' );
    return $columns;
}
add_filter( 'manage_edit-bc_offers_sortable_columns', 'set_sortable_offer_columns' );
function set_sortable_offer_columns( $columns )
{
    $columns['offers_bookie'] = 'offers_bookie';
    $columns['exclusive'] = 'exclusive';
    $columns['countdown'] = 'countdown';
    return $columns;
}

// Add the data to the custom columns for the book post type:
add_action( 'manage_bc_offers_posts_custom_column' , 'custom_offer_column', 10, 2 );
function custom_offer_column( $column, $post_id ) {
    switch ( $column ) {

        case 'offers_bookie' :
            echo '<b>'.get_the_title(get_post_meta( $post_id , 'promo_custom_meta_casino_offer' , true )).'</b>';
            break;

        case 'exclusive' :
            if (get_post_meta( $post_id , 'offer_exclusive' , true ) === 'on'){
                echo 'YES';
            }else{
                echo 'NO';
            }
            break;

        case 'visible_only' :
            $visibleAt = get_post_meta($post_id,'validat',true);
            if ( !empty( $visibleAt ) ) {
                $ret ='';

                $countries = WordPressSettings::getCountryEnabledSettingsWithNames();

                foreach ($visibleAt as $iso){
                    $ret .= $countries[$iso].', ';
                }
                echo substr($ret, 0, -2);
            }else{
                _e( 'No Promotion Restrictions' );
            }
            break;


        case 'promo_type' :
            $promotype = get_the_terms( $post_id, 'promotions-type' );
            echo '<p class="text-primary">';
            foreach ($promotype as $promocat){
                echo  $promocat->name.' ';
            }
           echo '</p>';
            break;


        case 'countdown' :
            $endTime = new DateTime(get_post_meta( $post_id , 'promo_custom_meta_end_offer' , true ));
            $nowTime = new DateTime('now');
            if ($nowTime > $endTime){
                echo '<p class="text-danger">The offer has Expired</p>';
            }else{
                $since_end = $endTime->diff($nowTime);
                echo '<p class="text-success">The offer expires in: '.$since_end->days.' Days, '.$since_end->h.' Hours </p>';
//                and '.$since_start->i.' minutes
            }
            break;


        case 'promotion_days' :
            $promodays = get_post_meta( $post_id, 'promo_custom_meta_valid_on',true);
            $alldays = get_post_meta( $post_id , 'promo_custom_meta_valid_all' , true );
            if ($alldays === 'on'){
                echo '<p class="text-primary">Daily</p>';
            }else{
                echo '<p class="text-primary">';
                foreach ($promodays as $days){
                    echo $days .' ';
                }
                echo '</p>';
            }

            break;

    }
}

if ( is_admin() ) add_filter('pre_get_posts', 'offer_filter_admin_pages');

function offer_filter_admin_pages($query) {
    if( isset( $query->query_vars['post_type']) && ($query->query_vars['post_type'] === 'bc_offers')) {

        // allow the url to alter the query
        if( isset($_GET['promo_custom_meta_casino_offer']) ) {
            if($_GET['promo_custom_meta_casino_offer'] !== 'all'){
                $query->set('meta_key', 'promo_custom_meta_casino_offer');
                $query->set('meta_value', $_GET['promo_custom_meta_casino_offer']);
            }

        }
        if( isset($_GET['countdown']) ) {
            if($_GET['countdown'] !== 'all' && $_GET['countdown'] !== 'future'){
                $nowTime = new DateTime('now');
                $query->set('meta_key', 'promo_custom_meta_end_offer');
                $query->set('meta_value', $nowTime->format('Y-m-d h:m'));
                if($_GET['countdown'] === 'running'){
                    $query->set('meta_compare', '>=');
                }elseif($_GET['countdown'] === 'expired'){
                    $query->set('meta_compare', '<');
                }
                $query->query_vars['post_status']= 'publish';
            }
            if($_GET['countdown'] !== 'all' && $_GET['countdown'] === 'future'){
                $query->query_vars['post_status']= 'future';
            }
        }
        // allow the url to alter the query
        if( isset($_GET['promotions-type']) ) {

            if(!empty($_GET['promotions-type'])){
            $meta_query = (array)$query->get('tax_query');
            $meta_query[] = array(
                'taxonomy' => 'promotions-type',
                'field' => 'slug',
                'terms' => $_GET['promotions-type']
            );
            $query->set('tax_query',$meta_query);
            }
        }

        if( isset($_GET['promotion_days']) ) {
            if(!empty($_GET['promotion_days'])){
                $meta_query = (array)$query->get('meta_query');
                if($_GET['promotion_days'] === 'Daily') {
                    $meta_query[] = array(
                        'key' => 'promo_custom_meta_valid_all',
                        'value' => 'on',
                        'compare' => 'LIKE',
                    );
                }else{
                    $meta_query[] = array(
                        'key' => 'promo_custom_meta_valid_on',
                        'value' =>  $_GET['promotion_days'],
                        'compare' => 'LIKE'
                    );
                }
                $query->set('meta_query',$meta_query);
            }
        }

    }
    // return
    return $query;
}


add_action( 'load-edit.php', 'my_edit_offer_load' );

function my_edit_offer_load() {
    add_filter( 'request', 'sort_offers' );
}

function sort_offers( $vars ) {

    /* Check if we're viewing the 'movie' post type. */
    if ( isset( $vars['post_type'] ) && ('bc_offers' === $vars['post_type'])) {

        /* Check if 'orderby' is set to 'duration'. */
        if ( isset( $vars['orderby'] ) && ('countdown' === $vars['orderby'] || 'promotions-type' === $vars['orderby'] ) ) {

            $sorting = $vars['orderby'] === 'countdown' ? 'offer_ends' : 'promotions-type';
            /* Merge the query vars with our custom variables. */
            $vars = array_merge(
                $vars,
                array(
                    'meta_key' =>$sorting,
                    'orderby' => 'meta_value',
//                    'meta_query'      	=> array(
//                        array(
//                            'key'     => 'offer_ends',
//                            'value'   => date('Y/m/d H:s'),
//                            'compare' => '>=',
//                            'type'	  => 'DATE'
//                        ),
//                    ),
                )
            );
        }
    }

    return $vars;
}

function filter_offers_by_date( $query ){
    global $typenow;
    global $wp_query;
    if ( $typenow === 'bc_offers') { // Your custom post type slug
        $current_plugin = '';
        if( isset( $_GET['countdown'] ) ) {
            $current_plugin = $_GET['countdown']; // Check if option has been selected
        } ?>
        <select name="countdown" id="countdown">
            <option value="all" <?php selected( 'all', $current_plugin ); ?>><?php _e( 'All Offers'); ?></option>
            <option value="future" <?php selected( 'future', $current_plugin ); ?>><?php _e( 'Scheduled Offers'); ?></option>
            <option value="expired" <?php selected( 'expired', $current_plugin ); ?>><?php _e( 'Expired Offers'); ?></option>
            <option value="running" <?php selected( 'running', $current_plugin ); ?>><?php _e( 'Running Offers'); ?></option>
        </select>
    <?php }
}

function filter_offers_by_promotion_type( $query ){
    global $typenow;
    global $wp_query;
    if ( $typenow === 'bc_offers') { // Your custom post type slug
        $current_plugin = '';
        if( isset( $_GET['promotions-type'] ) ) {
            $current_plugin = $_GET['promotions-type']; // Check if option has been selected
        }
        $terms = get_terms([
            'taxonomy' => 'promotions-type',
            'hide_empty' => false,
        ]);
        ?>
        <select name="promotions-type" id="promotions-type">
            <option value="" <?php selected( '', $current_plugin ); ?>><?php _e( 'All Promo Types'); ?></option>
            <?php
            foreach ($terms as $promotype){
                ?>
                   <option value="<?=$promotype->slug?>" <?php selected( $promotype->slug, $current_plugin ); ?>><?php _e( $promotype->name); ?></option>
                <?php
            }
            ?>
        </select>
    <?php }
}

function filter_offers_by_bookie( $query ){
    global $typenow;
    global $wp_query;
    if ( $typenow === 'bc_offers') { // Your custom post type slug
        $plugins = get_all_posts('kss_casino'); // Options for the filter select field
        $current_plugin = '';
        if( isset( $_GET['promo_custom_meta_casino_offer'] ) ) {
            $current_plugin = $_GET['promo_custom_meta_casino_offer']; // Check if option has been selected
        } ?>
        <select name="promo_custom_meta_casino_offer" id="promo_custom_meta_casino_offer">
            <option value="all" <?php selected( 'all', $current_plugin ); ?>><?php _e( 'All Casino'); ?></option>
            <?php foreach( $plugins as $key=>$value ) { ?>
                <option value="<?php echo esc_attr( $value ); ?>" <?php selected( $value, $current_plugin ); ?>><?php echo esc_attr( get_the_title($value) ); ?></option>
            <?php } ?>
        </select>
    <?php }
}

function filter_offers_by_days( $query ){
    global $typenow;
    global $wp_query;
    if ( $typenow === 'bc_offers') { // Your custom post type slug
        $current_plugin = '';
        if( isset( $_GET['promotion_days'] ) ) {
            $current_plugin = $_GET['promotion_days']; // Check if option has been selected
        }
        ?>
        <select name="promotion_days" id="promotion_days">
            <option value="" <?php selected( '', $current_plugin ); ?>><?php _e( 'Choose Day'); ?></option>
            <option value="Daily" <?php selected( 'Daily', $current_plugin ); ?>><?php _e( 'Daily'); ?></option>
            <option value="Monday" <?php selected( 'Monday', $current_plugin ); ?>><?php _e( 'Monday'); ?></option>
            <option value="Tuesday" <?php selected( 'Tuesday', $current_plugin ); ?>><?php _e( 'Tuesday'); ?></option>
            <option value="Wednesday" <?php selected( 'Wednesday', $current_plugin ); ?>><?php _e( 'Wednesday'); ?></option>
            <option value="Thursday" <?php selected( 'Thursday', $current_plugin ); ?>><?php _e( 'Thursday'); ?></option>
            <option value="Friday" <?php selected( 'Friday', $current_plugin ); ?>><?php _e( 'Friday'); ?></option>
            <option value="Saturday" <?php selected( 'Saturday', $current_plugin ); ?>><?php _e( 'Saturday'); ?></option>
            <option value="Sunday" <?php selected( 'Sunday', $current_plugin ); ?>><?php _e( 'Sunday'); ?></option>
        </select>
    <?php }
}

add_filter( 'restrict_manage_posts', 'filter_offers_by_bookie' );
add_filter( 'restrict_manage_posts', 'filter_offers_by_date' );
add_filter( 'restrict_manage_posts', 'filter_offers_by_promotion_type' );
add_filter( 'restrict_manage_posts', 'filter_offers_by_days' );
