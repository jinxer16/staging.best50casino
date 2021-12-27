<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<div class="load-link-performance-report report-action" data-saved_reports="<?php echo esc_attr( json_encode( $reports ) ); ?>">

    <div class="input-wrap reports-field">
        <select id="saved-reports" name="saved_link_performance_reports">
            <option value=""><?php _e( 'Select report' , 'thirstyaffiliates-pro' ); ?></option>
            <?php foreach ( $reports as $key => $data ) : ?>
                <option value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $data[ 'report_name' ] ); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="button-wrap">
        <button type="button" class="button-primary" id="load-link-performance-report"><?php _e( 'Load Report' , 'thirstyaffiliates-pro' ); ?></button>
        <button type="button" class="button" id="delete-link-performance-report" 
            disabled data-nonce="<?php echo wp_create_nonce( 'tap_delete_link_performance_report_nonce' ); ?>">
            <?php _e( 'Delete' , 'thirstyaffiliates-pro' ); ?>
        </button>
    </div>

    <input type="hidden" name="action" value="tap_load_link_performance_report">
    <input type="hidden" name="range" value="<?php echo esc_attr( $current_range ); ?>">
    <input type="hidden" name="start_date" value="<?php echo esc_attr( $start_date ); ?>">
    <input type="hidden" name="end_date" value="<?php echo esc_attr( $end_date ); ?>">
    <?php wp_nonce_field( 'tap_load_link_performance_report_nonce' ); ?>

</div>
