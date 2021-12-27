    jQuery(document).ready(function() {

        jQuery( function() {
            jQuery( ".mini-sort" ).sortable({
                update: function(event, ui) {
                    // console.log($(this).attr('id'));
                    updateCustomShortcode(jQuery(this).attr('data-attribute'));
                },
            });
            jQuery( ".mini-sort" ).disableSelection();
        } );
        updateCustomShortcode = function(id=''){
            var attrs = '';
            jQuery('.form-table select').each(function(){
                if(jQuery(this).attr('data-attribute') === 'specific_ratings'){
                    if ( jQuery('select[data-attribute="sort_by"]').val() === 'special_popular'){
                        if(jQuery(this).val() !== '') attrs = attrs + ' ' + jQuery(this).attr('data-attribute') + '="' + jQuery(this).val() + '"';
                    }else{
                        // alert('In order to sort by specific ratings, you must choose "Specific Rating" option on Sort By selection');
                    }
                }else if(jQuery(this).attr('data-attribute') === 'cat_in'){
                    if(jQuery(this).val() !== '' && jQuery(this).val() !== 'all') attrs = attrs + ' ' + jQuery(this).attr('data-attribute') + '="' + jQuery(this).val() + '"';
                }else{
                    if(jQuery(this).val() !== '') attrs = attrs + ' ' + jQuery(this).attr('data-attribute') + '="' + jQuery(this).val() + '"';
                }
            });

            jQuery('.form-table input[type="text"]').each(function(){
                if(jQuery(this).val() !== '' && jQuery(this).attr('data-attribute')) attrs = attrs + ' ' + jQuery(this).attr('data-attribute') + '="' + jQuery(this).val() + '"';
            });

            jQuery('.form-table input[type="checkbox"].checkbox').each(function(){
                if(jQuery(this).attr('checked')) attrs = attrs + ' ' + jQuery(this).attr('data-attribute') + '="' + jQuery(this).val() + '"';
            });

            jQuery('.form-table .multicheck').each(function(){
                mVal = jQuery(this).find('input[type="checkbox"]:checked').map(function () {return this.value;}).get().join(",");
                if(mVal !== '') attrs = attrs + ' ' + jQuery(this).attr('data-attribute') + '="' + mVal + '"';
            });
            // jQuery('.form-table ul.mini-sort').each(function(){
            //     console.log(jQuery(this).attr('data-attribute'));
            if ( (jQuery('select[data-attribute="sort_by"]').val() === 'custom' && id==='custom_cas_order') || ((jQuery('select[data-attribute="3rd_column_icons"]').val() === 'dep' ||jQuery('select[data-attribute="3rd_column_icons"]').val() === 'wit' )&& id==='pay_order')){
                jQuery('ol.mini-sort[data-attribute="'+id+'"]').find('li').each(function(){
                    // alert (jQuery(this).text());
                    mVal += ',' + jQuery(this).attr('data-id');
                });
                mVal = mVal.substring(1);
                if(mVal != '') attrs = attrs + ' ' + jQuery('ol.mini-sort[data-attribute="'+id+'"]').attr('data-attribute') + '="' + mVal + '"';
            }
            // });


            if (document.body.classList.contains('post-type-posts_shortcodes')){
                jQuery('input#meta_result').val('[posts'+attrs+']');
            }else{
                jQuery('input#meta_result').val('[table'+attrs+']');
            }

        }

        jQuery('.form-table select').change(updateCustomShortcode);
        jQuery('.form-table input[type="checkbox"]').change(updateCustomShortcode);
        jQuery('.form-table input[type="text"]').blur(updateCustomShortcode);
        updateCustomShortcode();
    });