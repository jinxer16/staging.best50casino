jQuery(document).ready(function() {
    jQuery("#contextual-help-link").click(function () {
        jQuery("#contextual-help-wrap").css("cssText", "display: block !important;");
    });
    jQuery("#show-settings-link").click(function () {
        jQuery("#screen-options-wrap").css("cssText", "display: block !important;");
    });
    jQuery( function() {
        jQuery( ".default-casino_sort" ).sortable({
            update: function(event, ui) {
                    var mVal ='';
                    var inputID = jQuery(this).attr('data-id');
                    // console.log(inputID);
                    jQuery(this).find('li').each(function(){
                        //alert (jQuery(this).text());
                        if(jQuery(this).css('display') != 'none' && !jQuery(this).hasClass('(Draft)')) {
                            // console.log(jQuery(this).attr('data-id'));
                            mVal += ',' + jQuery(this).attr('data-id');
                        }
                    });
                     mVal = mVal.substring(1);
                    if(mVal != '') {
                        jQuery('input#'+inputID).val(mVal);
                    }
             //
            },
			start: function(event, ui){
			},
            create: function(event, ui){
                var mVal ='';
                var inputID = jQuery(this).attr('data-id');
                // console.log(inputID);
                jQuery(this).find('li').each(function(){
                    if(jQuery(this).css('display') != 'none' && !jQuery(this).hasClass('(Draft)')){
                        // console.log(jQuery(this).attr('data-id'));
                        mVal += ',' + jQuery(this).attr('data-id');
                    }
                    //alert (jQuery(this).text());

                });
                mVal = mVal.substring(1);
                if(mVal != '') {
                    jQuery('input#'+inputID).val(mVal);
                }

            },
        });
        jQuery( ".default-casino_sort" ).disableSelection();

    } );
    jQuery( function() {
        jQuery( ".default-payment_sort" ).sortable({
            update: function(event, ui) {
                var mVal ='';
                var inputID = jQuery(this).attr('data-id');
                // console.log(inputID);
                jQuery(this).find('li').each(function(){
                    if(jQuery(this).css('display') != 'none') {
                        mVal += ',' + jQuery(this).attr('data-id');
                    }
                });
                mVal = mVal.substring(1);
                if(mVal != '') {
                    jQuery('input#'+inputID).val(mVal);
                }
                //
            },
            start: function(event, ui){
            },
            create: function(event, ui){
                var mVal ='';
                var inputID = jQuery(this).attr('data-id');
                // console.log(inputID);
                jQuery(this).find('li').each(function(){
                    if(jQuery(this).css('display') != 'none'){
                        // console.log(jQuery(this).attr('data-id'));
                        mVal += ',' + jQuery(this).attr('data-id');
                    }
                    //alert (jQuery(this).text());

                });
                mVal = mVal.substring(1);
                if(mVal != '') {
                    jQuery('input#'+inputID).val(mVal);
                }

            },
        });
        jQuery( ".default-casino_sort" ).disableSelection();

    } );
} );
jQuery(document).ready(function() {
    jQuery( function() {jQuery( ".sortable" ).sortable({
        update: function(event, ui) {
            var field_id = jQuery(this).attr("data-field");
            var field_iso = field_id.replace('promo_order','');
            updateInput(field_id,field_iso );
        },
        connectWith: ".connectedSortable",
        placeholder: "placeholder"}).disableSelection();
    } );

    updateInput = function(id, iso){
        var mVal = "";
        jQuery(".form-table ul#sortable22-"+iso).each(function(){
            jQuery(this).find("li").each(function(){
                mVal += jQuery(this).attr("data-id") + ",";
            });
        });
        // alert(id);
        jQuery("input#"+id).val(mVal.slice(0,-1));
    }
});
jQuery(document).ready(function() {

	jQuery(".ratings").blur(function () {
		var total = 0,
			valid_labels = 0,
			average;

		jQuery('.ratings:not(#casino_custom_meta_sum_rating)').each(function () {
			// Retrieve input value
			// .innerHTML only retrieves the info between the HTML tags, and is
			// a non-jQuery call.  The jQuery version is .html(), but you want
			// .val() with no parameters, which gets the current input value
			var val = parseFloat(jQuery(this).val(), 10);

			//Test if it is a valid number with built-in isNaN() function
			if (!isNaN(val)) {
                if(jQuery(this).attr('id') == 'casino_custom_meta_license_rating' || jQuery(this).attr('id') == 'casino_custom_meta_site_rating' ){
                    val = val*2.5;
                }else if(jQuery(this).attr('id') == 'casino_custom_meta_games_rating'|| jQuery(this).attr('id') == 'casino_custom_meta_withdrawal_rating'){
                    val = val*1.5;
                }else if(jQuery(this).attr('id') == 'casino_custom_meta_offers_rating'){
                    val = val*2;
                }
				valid_labels += 1;
				total += val;
			}
		});

		// Calculate the average
		// Note: This is done inside the keyup handler
		// When it is outside, it is only calculated once when the page loads
        var finalVal = total / 10;
		jQuery('#casino_custom_meta_sum_rating').val(finalVal.toFixed(2));
	})
});
jQuery(document).ready( function($) {


	$('.multicheck-item.anchor-multicheck input').each(function( index ) {
		if(!$(this).is(':checked')){
			$('.postbox-container div#offer-text-'+$(this).val()).hide();
		}
	});
	$('.multicheck-item.anchor-multicheck input').click(function() {
		$('div#offer-text-'+$(this).val()).toggle();
	});
	$('.multicheck-item.simple-multi input').each(function( index ) {
		if($(this).is(':checked')){
			$('div#offer-text-'+$(this).val().split(' ').join('_').split('\'').join('_')+' tr.disableable').hide();
		}
	});
	$('.multicheck-item.simple-multi input').click(function() {
		$('div#offer-text-'+$(this).val().split(' ').join('_')+' .disableable').toggle();
	});

    $('#promo_custom_meta_valid_all').click(function(){
        if ($(this).is(':checked')){
            $('input#promo_custom_meta_valid_on').each(function( index ) {
                $(this).prop('checked', true);
            });
        }else{
            $('input#promo_custom_meta_valid_on').each(function( index ) {
                $(this).prop('checked', false);
            });
        }

    });

    // jQuery(function($) {
    //     $( ".event-date-id" ).datepicker({ dateFormat: 'yy-mm-dd' });
    //     // $( ".event-date-id" ).datepicker({ dateFormat: 'dd-mm-yy' });
    // });
    // $("input.event-date-id").on("keyup change", function(){
    //     var a = prompt("Enter the time as hh:mm", "23:59");
    //     var date = $(this).val();
    //     $("input.event-date-id").val(date + " " + a)
    // });

});
function media_upload(button_class) {
    var _custom_media = true,
        _orig_send_attachment = wp.media.editor.send.attachment;

    $('body').on('click', button_class, function(e) {
        var button_id ='#'+$(this).attr('id');
        var self = $(button_id);
        var send_attachment_bkp = wp.media.editor.send.attachment;
        var button = $(button_id);
        var id = button.attr('id').replace('_button', '');
        var myName = $(this).attr('name').replace('custom_media_button_', '');
        _custom_media = true;
        wp.media.editor.send.attachment = function(props, attachment){
            if ( _custom_media  ) {
                $('.custom_media_id_'+myName).val(attachment.id);
                $('.custom_media_url_'+myName).val(attachment.url);
                $('.custom_media_image_'+myName).attr('src',attachment.url).css('display','block');
            } else {
                return _orig_send_attachment.apply( button_id, [props, attachment] );
            }
        }
        wp.media.editor.open(button);
        return false;
    });
}
media_upload('.custom_media_button');

// Material Select Initialization
/* $(document).ready(function() {
    $('.mdb-select').material_select();
}); */
