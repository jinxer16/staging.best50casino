jQuery( document ).ready( function($){

    thirstyProSettings = {

        /**
         * Geolocation maxmind DB field toggle
         *
         * @since 1.0.0
         */
        geolocationMaxMindDBToggle : function() {

            $settingsBlock.on( 'change' , 'input[name="tap_geolocations_maxmind_db"]' , function() {

                $premiumDBToggle.closest( 'tr' ).hide();
                $webServiceToggle.prop( 'readonly' , true ).closest( 'tr' ).hide();

                switch ( $(this).val() ) {

                    case 'premium' :
                        $premiumDBToggle.closest( 'tr' ).show();
                        break;

                    case 'web_service' :
                        $webServiceToggle.prop( 'readonly' , false ).closest( 'tr' ).show();
                        break;

                    default :
                        break;
                }

            } ).find( 'input[name="tap_geolocations_maxmind_db"]:checked' ).trigger( 'change' );
        },

        gctCustomFunctionName : function() {

            $settingsBlock.on( 'change' , 'input[name="tap_google_click_tracking_script"]:checked' , function() {

                var tracking_script  = $(this).val(),
                    $customFuncField = $settingsBlock.find( 'input#tap_universal_ga_custom_func' );

                if ( tracking_script == 'universal_ga' ) {
                    $customFuncField.prop( 'readonly' , false ).closest( 'tr' ).show();
                } else {
                    $customFuncField.prop( 'readonly' , true ).closest( 'tr' ).hide();
                }
            }).find( 'input[name="tap_google_click_tracking_script"]:checked' ).trigger( 'change' );
        }

    };

    var $settingsBlock    = $( '.ta-settings.wrap' ),
        $premiumDBToggle  = $( '.maxmind-db-toggle' ),
        $webServiceToggle = $( '.maxmind-web-toggle' );

    // init geolocation maxmind DB field toggle
    thirstyProSettings.geolocationMaxMindDBToggle();

    thirstyProSettings.gctCustomFunctionName();
});
