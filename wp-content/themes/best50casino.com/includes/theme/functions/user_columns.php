<?php
function new_modify_user_table( $column ) {
    $column['visitorsISO'] = 'Visitor\'s Country' ;
    $column['user_registered'] = 'Registration Date';
    return $column;
}
add_filter( 'manage_users_columns', 'new_modify_user_table' );

function new_modify_user_table_row( $val, $column_name, $user_id ) {
    switch ($column_name) {
        case 'visitorsISO' :
            return get_user_meta( $user_id, 'visitorsISO', true) ? get_user_meta( $user_id, 'visitorsISO', true) : "-";
        case 'user_registered' :
            $udata = get_userdata( $user_id );
            return date("d/m/Y",strtotime($udata->user_registered));
        default:
    }
    return $val;
}
add_filter( 'manage_users_custom_column', 'new_modify_user_table_row', 10, 3 );


function my_set_sortable_columns( $columns )
{
    $columns['visitorsISO'] = 'visitorsISO';
    $columns['user_registered'] = 'user_registered';
    return $columns;
}
add_filter( 'manage_users_sortable_columns', 'my_set_sortable_columns' );

function my_sort_custom_column_query( $query )
{
    global $pagenow;
    if (!is_admin() || 'users.php' != $pagenow) return false;
    $top = $_GET['visitorsISO'] ? $_GET['visitorsISO'] : null;
    if (!empty($top) OR !empty($bottom))
    {
        if($top=='-'){
            $meta_query = array (array (
                'key' => 'visitorsISO',
                'compare' => 'NOT EXISTS', // see note above
            ));
        }elseif($top=='all'){
            $meta_query = array(
                'relation' => 'OR',
                array(
                    'key' => 'visitorsISO',
                    'compare' => 'NOT EXISTS', // see note above
                ),
                array(
                    'key' => 'visitorsISO',
                ),
            );
        }else{
            $meta_query = array(
                'relation' => 'AND',
                array(
                    'key' => 'visitorsISO',
                    'compare' => 'EXISTS', // see note above
                ),
                array(
                    'key' => 'visitorsISO',
                    'value' => $top,
                    'compare' => 'LIKE'
                ),
            );
        }
        // change the meta query based on which option was chosen

        $query->set('meta_query', $meta_query);
    }

    $orderby = $query->get( 'orderby' );
    if ( 'visitorsISO' == $orderby ) {
        $meta_query = array(
            'relation' => 'OR',
            array(
                'key' => 'visitorsISO',
                'compare' => 'NOT EXISTS', // see note above
            ),
            array(
                'key' => 'visitorsISO',
            ),
        );
        $query->set( 'meta_query', $meta_query );
        $query->set( 'orderby', 'meta_value' );
    }
    if ( 'user_registered' == $orderby ) {
        $query->set( 'orderby', 'user_registered' );
    }
}
add_action( 'pre_get_users', 'my_sort_custom_column_query' );


add_action('restrict_manage_users', 'userISOFilter');

function userISOFilter($which)
{
    if($which=='bottom') return false;
    $url = TEMPLATEPATH . '/includes/theme/Settings/countriesArray.json';
    $request = file_get_contents($url);
    $countriesArray = json_decode($request, true);
    // template for filtering
    $top = $_GET['visitorsISO'] ? $_GET['visitorsISO'] : null;
    $st = '<select name="visitorsISO" style="float:none;margin-left:10px;"><option value="all">%s</option>%s</select>';
    $options = '<option value="-">No Country</option>';
    foreach ($countriesArray as $iso=>$name) {
        // generate options
        $options .= '<option value="'.$iso.'" '.($top==$iso ?'selected':'').'>'.ucwords($name).'</option>';
    }
    // combine template and options
    $select = sprintf( $st, __( 'All Countries' ), $options );

    // output <select> and submit button
    echo $select;
    submit_button(__( 'Filter' ), null, $which, false);
}