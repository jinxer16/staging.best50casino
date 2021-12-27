function getAjax(){
    let ajax = { "ajax_url" : "https://\/www.best50casino.com\/wp-admin\/admin-ajax.php" };
    if (window.location.hostname === 'localhost') {
        ajax["ajax_url"] = "https://\/localhost/dev.best50casino.com\/wp-admin\/admin-ajax.php";
    }
    return ajax;
}

jQuery(document).ready(function ($) {


    jQuery("#repeater button").on("click", function (event) {
        event.preventDefault();
    });
    jQuery("#repeater").createRepeater({
        showFirstItemToDefault: true,
    });
    //Search field auto complete
    jQuery(".searchField").on("keyup", function() {
        var value = jQuery(this).val().toLowerCase(); // value to search
        var target = jQuery(this).attr('data-targetID');
        // var fitlers = jQuery(this).attr('data-filter').toLowerCase();
        jQuery(target).filter(function() {
            jQuery(this).toggle($(this).data("filter").toLowerCase().indexOf(value) > -1);
        });
    });

    $('#countryFilters select').change(function() {
        // Initialize criteria string
        var criteria = '';
        // Set value for all selector
        var showAll = true;

        // Iterate over all criteriaSelectors
        $('#countryFilters select').each(function(){
            // Get value
            var val = $(this).children(':selected').val();
            // Check if this limits our results
            if(val !== 'all'){
                // Append selector to criteria
                criteria += '.' + $(this).attr('id') + '_' + val;
                // We don't want to show all results anymore
                showAll = false;
            }
        });
        // Check if results are limited somehow
        if(showAll){
            // No criterias were set so show all
            $('.country').show();
        } else {
            // Hide all items
            $('.country').hide();
            // Show the ones that were selected
            $(criteria).show();
        }

    });
    //
    $('.form-table').on('click','.media-upload',function(e) {
        e.preventDefault();
        var target = '';

        var mediaUploader;
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            }, multiple: false });
        // mediaUploader.off();
        mediaUploader.on('select', function() {
            target = e.target.attributes[0].nodeValue;
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('input[name="'+target+'"]').val(attachment.url);
            $('div[data-source="'+target+'"]').html('<img src="'+attachment.url+'" class="img-responsive" style="max-height: 90px;">');
        });
        mediaUploader.open();
    });
    //toggle script/image src for ad preview
    $('.form-table').on('click', '.image-option-on', function(){
        var thisID = $(this).attr('name');
       if($(this).prop( "checked" )){
           var thisImgSrc = $('input[name="'+thisID.replace("img_on", "image")+'"]').val();
           $(this).closest('.imArow').find('.image-preview').empty().html('<img src="'+thisImgSrc+'" class="img-responsive" style="max-height: 90px;">');
       }else{
           var thisScriptSrc = $('textarea[name="'+thisID.replace("img_on", "script")+'"]').text();
           $(this).closest('.imArow').find('.image-preview').empty().html(thisScriptSrc);
       }
    });
    $('.form-table').on('change', '.script-field, .image-field', function(event){
        var thisID = $(this).attr('name');
        var thisValue = $(this).val();
        if($(this).hasClass('script-field') && !$(this).closest('.imArow').find('.image-option-on').prop( "checked" )){
            if(thisValue.indexOf("document.write") >= 0){
                $(this).closest('.imArow').find('.image-preview').empty().text(thisValue);
                $(this).css('border','1px solid red');
            }else {
                $(this).closest('.imArow').find('.image-preview').empty().html(thisValue);
            }
        }else{
            $(this).closest('.imArow').find('.image-preview').empty().html('<img src="'+thisValue+'" class="img-responsive" style="max-height: 90px;">');
        }
    });
    $('.form-table').on('click', '.addNew', function(event){
        event.preventDefault();
        var target = $(this).closest('.imArow');
        var clone = target.clone();

        // clone.find("div.addNew").css('background', 'red');
        target.find("button.addNew").prop('disabled', true);
        clone.find("button.addNew").remove();
        clone.prepend("<button onclick=\"removeRepeaterField(this)\" class=\"removeOne mr-1 btn btn-danger btn-sm\">Remove</button>");
        clone.find("label:first-of-type").append(' 2');
        var textNewName = clone.find("input:text").attr('name').replace('[image]', '[image2]');
        clone.find("input:text").attr('name',textNewName).attr('id',textNewName);
        clone.find("input.media-upload").attr('data-id',textNewName);
        var textareaNewName = clone.find("textarea").attr('name').replace('[script]', '[script2]');
        clone.find("textarea").attr('name',textareaNewName).attr('id',textareaNewName);
        var checkNewName = clone.find("input:checkbox").attr('name').replace('[img_on]', '[img_on2]');
        clone.find("input:checkbox").attr('name',checkNewName).attr('id',checkNewName);
        var toggleNewName = clone.find("a[data-toggle=\"collapse\"]").attr('href').concat('2');
        clone.find("a[data-toggle=\"collapse\"]").attr('href',toggleNewName);
        var previewNewName = clone.find("div.image-preview").attr('id').concat('2');
        var previewNewSource = clone.find("div.image-preview").attr('data-source').replace('[image]', '[image2]');
        clone.find("div.image-preview").attr('id',previewNewName);
        clone.find("div.image-preview").attr('data-source',previewNewSource).html("");
        clone.find("textarea, input:text").val("");
        clone.find("input:checkbox").removeAttr('checked');
        target.after(clone);
    });

});
function removeRepeaterField($this){
    if(jQuery($this).hasClass('removeOne')){
        jQuery($this).closest('.imArow').prev().find("button.addNew").removeAttr("disabled");
        jQuery($this).closest('.imArow').remove();
    }else if(jQuery($this).hasClass('removeRole')){
        jQuery($this).closest('div.rowRole').css("background", "red");

    }else{
        event.preventDefault();
        jQuery($this).parents('.items').remove();
    }
}
jQuery(function() {

    var sortableIn = 0;
    jQuery( ".sortable_list" ).sortable({
        connectWith: ".connectedSortable",
        /*stop: function(event, ui) {
            var item_sortable_list_id = $(this).attr('id');
            console.log(ui);
            //alert($(ui.sender).attr('id'))
        },*/
        receive: function(event, ui) {
            sortableIn = 1;
            // alert("dropped on = "+this.id); // Where the item is dropped
            // alert("sender = "+ui.sender[0].id); // Where it came from
            // alert("item = "+ui.item[0].innerHTML); //Which item (or ui.item[0].id)
        },
        update: function(event, ui){
            sortableIn = 1;
            var changedList = this.id;
            var order = jQuery(this).sortable('toArray').toString();
            jQuery('input[data-target="'+changedList+'"]').attr("value",order );
    },
        over: function(event, ui)
        {
            sortableIn = 1;
        },
        out: function(event, ui)
        {
            // console.log(ui); // Where it came from
            if (ui.sender[0].className.indexOf('connectedSortable') > -1) {
                // console.log(ui); // Where it came from
                sortableIn = 0;
            }
        },
        beforeStop: function(event, ui)
        {

            if (sortableIn == 0)
            {
                ui.item.remove();
            }
        }
    }).disableSelection();
    // jQuery('.connectedSortable').on('sortout', function(event, ui){
    //     ui.item.remove();
    // })



});
function saveCountrySettings(e,$this){
    var ajax = getAjax();
    var thisButton = jQuery($this);
    var countries=[];
    var selectedPosts={};
    jQuery('input[data-option="'+thisButton.attr('data-settings-id')+'_iso"]:checked').each(function () {
        countries.push(jQuery(this).attr('data-country'));
    });
    if(thisButton.attr('data-settings-id')==='enabled_countries') {
        jQuery('select[data-option="enabled_countries_page"]').each(function () {
            if (jQuery(this).val() !== "") {
                var country = jQuery(this).attr('data-country');
                var post = jQuery(this).val();
                selectedPosts[country] = post;
            }
        });
    }
    jQuery.ajax({
        type: 'POST',
        url: ajax.ajax_url,
        data: { countries:countries, selectedPosts:selectedPosts, settingsID:thisButton.attr('data-settings-id'), action : 'saveCountrySettings' },
        dataType: 'html',
        success: function(data){
            thisButton.after('<div id="update-notification">'+data+'</div>').fadeIn(750,'linear',function(){
                    setTimeout(function(){
                        jQuery('#update-notification').fadeOut(750,'linear');
                    }, 2000);
            });
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        },
        complete: function(){
        }
    });
}
function saveDataPanelSettings(e,$this){
    var thisButton = jQuery($this);
    var nameOfSetting = thisButton.attr('data-settings-id');
    var typeOfSetting = thisButton.attr('data-settings-type');
    var settings={};
    if(thisButton.attr('data-settings-type').indexOf("image") >= 0 ){
        jQuery('input[name="'+nameOfSetting+'[]"').each(function () {
            var code = jQuery(this).val();
            var fullName = jQuery('input[name="'+nameOfSetting+'['+code+'][fullname]"').val();
            var img = jQuery('input[name="'+nameOfSetting+'['+code+'][image]"').val();
            settings[code]={fullname:fullName, image:img};
        });
    }else{
        jQuery('input[name="'+nameOfSetting+'[]"').each(function () {
            var code = jQuery(this).val();
            var fullName = jQuery('input[name="'+nameOfSetting+'['+code+'][fullname]"').val();
            settings[code]=fullName;
        });
    }
    var ajax = getAjax();
    jQuery.ajax({
        type: 'POST',
        url: ajax.ajax_url,
        data: { settingsData:settings,settingsID:nameOfSetting,  action : 'saveDataPanelSettings' },
        dataType: 'html',
        success: function(data){
            thisButton.after('<div id="update-notification">'+data+'</div>').fadeIn(750,'linear',function(){
                    setTimeout(function(){
                        jQuery('#update-notification').fadeOut(750,'linear');
                    }, 2000);
            });
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        },
        complete: function(){
        }
    });
}
function saveFeaturedSettings(e,$this){
    var thisButton = jQuery($this);
    var nameOfSetting = thisButton.attr('data-settings-id');
    var code = thisButton.attr('data-settingsCountry');
    var settings={};
    settings['featured'] = jQuery('select[name="featured-options-'+code+'[featured]"]').val();
    for (var i = 1; i < 5; i++) {
        settings['featured_'+i+'_id'] = jQuery('select[name="featured-options-'+code+'[featured_'+i+'_id]"]').val();
        settings['featured_'+i+'_label'] = jQuery('select[name="featured-options-'+code+'[featured_'+i+'_label]"]').val();
    }
    for (var i = 1; i < 3; i++) {
        settings['article_'+i+'_id'] = jQuery('select[name="featured-options-'+code+'[article_'+i+'_id]"]').val();
        settings['article_'+i+'_subtitle'] = jQuery('input[name="featured-options-'+code+'[article_'+i+'_subtitle]"]').val();
        settings['article_'+i+'_image'] = jQuery('input[name="featured-options-'+code+'[article_'+i+'_image]"]').val();
    }
    var ajax = getAjax();
    jQuery.ajax({
        type: 'POST',
        url: ajax.ajax_url,
        data: { settingsData:settings,settingsID:nameOfSetting,code:code,  action : 'saveFeatured' },
        dataType: 'html',
        success: function(data){
            thisButton.after('<div id="update-notification">'+data+'</div>').fadeIn(750,'linear',function(){
                    setTimeout(function(){
                        jQuery('#update-notification').fadeOut(750,'linear');
                    }, 2000);
            });
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        },
        complete: function(){
        }
    });
}
function savePremiumSettings(e,$this){
    var thisButton = jQuery($this);
    var postType = thisButton.attr('data-type');
    var code = thisButton.attr('data-settingsCountry');
    var settings={};
    var ids = jQuery('input[name="premium-'+postType+'-'+code+'[ids]"]').val();
    var premium = postType === 'transactions' || postType === 'softwares'  ? null : jQuery('input[name="premium-'+postType+'-'+code+'[premium]"]').val();
    var ajax = getAjax();
    jQuery.ajax({
        type: 'POST',
        url: ajax.ajax_url,
        data: { ids:ids,premium:premium,code:code,postType:postType,  action : 'savePremium' },
        dataType: 'html',
        success: function(data){
            thisButton.after('<div id="update-notification">'+data+'</div>').fadeIn(750,'linear',function(){
                    setTimeout(function(){
                        jQuery('#update-notification').fadeOut(750,'linear');
                    }, 2000);
            });
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        },
        complete: function(){
        }
    });
}

function savefilterPromos(e,$this){
    e.preventDefault();
    var thisButton = jQuery($this);
    var postType = thisButton.attr('data-type');
    var code = thisButton.attr('data-settingsCountry');
    var day = thisButton.attr('data-day');
    var category = thisButton.attr('data-category');
    var settings={};
    var ids = jQuery('input[name="premium-'+postType+'-'+category+'-'+day+'-'+code+'[ids]"]').val();
    var premium =  jQuery('input[name="premium-'+postType+'-'+category+'-'+day+'-'+code+'[premium]"]').val();
    var ajax = getAjax();
    jQuery.ajax({
        type: 'POST',
        url: ajax.ajax_url,
        data: { ids:ids,premium:premium,code:code,postType:postType,category:category,day:day ,action : 'savePremiumPromoAjax' },
        dataType: 'html',
        success: function(data){
            thisButton.after('<div id="update-notification">'+data+'</div>').fadeIn(750,'linear',function(){
                setTimeout(function(){
                    jQuery('#update-notification').fadeOut(750,'linear');
                }, 2000);
            });
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        },
        complete: function(){
        }
    });
}

function ResetfilterPromos(e,$this){
    e.preventDefault();
    var thisButton = jQuery($this);
    var postType = thisButton.attr('data-type');
    var code = thisButton.attr('data-settingsCountry');
    var day = thisButton.attr('data-day');
    var category = thisButton.attr('data-category');
    var ajax = getAjax();
    jQuery.ajax({
        type: 'POST',
        url: ajax.ajax_url,
        data: {code:code,postType:postType,category:category,day:day ,action : 'ResetPromoFilters' },
        dataType: 'html',
        success: function(data){
            thisButton.after('<div id="update-notification">'+data+'</div>').fadeIn(750,'linear',function(){
                setTimeout(function(){
                    jQuery('#update-notification').fadeOut(750,'linear');
                }, 2000);
            });
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        },
        complete: function(){
        }
    });
}

function saveSingleSettings(e,$this){
    var thisButton = jQuery($this);
    var nameOfSetting = thisButton.attr('data-settings-id');
    var settings=[];
    jQuery('input[name="'+nameOfSetting+'"]').each(function () {
        if (jQuery(this).val() !== "") {
            var setting = jQuery(this).val();
            settings.push(setting);
        }
    });
    var ajax = getAjax();
    jQuery.ajax({
        type: 'POST',
        url: ajax.ajax_url,
        data: { settingsData:settings,settingsID:nameOfSetting,  action : 'saveDataPanelSettings' },
        dataType: 'html',
        success: function(data){
            thisButton.after('<div id="update-notification">'+data+'</div>').fadeIn(750,'linear',function(){
                    setTimeout(function(){
                        jQuery('#update-notification').fadeOut(750,'linear');
                    }, 2000);
            });
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        },
        complete: function(){
        }
    });
}
function saveSettings(e,$this){
    e.preventDefault();
    var ajax = getAjax();
    var thisButton = jQuery($this);
    if(thisButton.attr('data-settings-id')==='slot-themes' || thisButton.attr('data-settings-id')==='review-currencies' || thisButton.attr('data-settings-id')==='web-languages' || thisButton.attr('data-settings-id')=== 'cs-languages'){
        saveDataPanelSettings(e,$this);
        return true;
    }else if(thisButton.attr('data-settings-id') === 'enabled_countries' || thisButton.attr('data-settings-id')==='restricted-countries'){
        saveCountrySettings(e,$this);
        return true;
    }else if(thisButton.attr('data-settings-id')==='featured'){
        saveFeaturedSettings(e,$this);
        return true;
    }else if(thisButton.attr('data-settings-id')==='premium'){
        savePremiumSettings(e,$this);
        return true;
    }else if(thisButton.attr('data-settings-id')==='cs-channels'){
        saveSingleSettings(e,$this);
        return true;
    }else {
        var settingsType = jQuery($this).attr('data-settingsType');
        if(settingsType==='casino'){
            var positionsArray = ['lskin', 'rskin'],
                input = {},
                btnMessage = jQuery($this).text(),
                settingscountry = jQuery($this).attr('data-settingscountry'),
                settingscasino = jQuery($this).attr('data-settingscasino');
            jQuery.each(positionsArray, function (index, item) {
                input[item + '_image'] = jQuery('input[id="geoAds-'+settingscasino+'-' + settingscountry + '[' + item + '][image]"]').val();
                input[item + '_script'] = jQuery('textarea[id="geoAds-'+settingscasino+'-'+ settingscountry + '[' + item + '][script]"]').val();
                input[item + '_affiliate'] = jQuery('input[id="geoAds-'+settingscasino+'-'+ settingscountry + '[' + item + '][aff_url]"]').val();
                input[item + '_img_on'] = jQuery('input[id="geoAds-'+settingscasino+'-' + settingscountry + '[' + item + '][img_on]"]').is(":checked") ? '1' : null;
            });
        }else if(settingsType==='countries'){
            var positionsArray = ['lsidebar', 'rsidebar', 'lskin', 'rskin'],
                input = {},
                btnMessage = jQuery($this).text(),
                settingscountry = jQuery($this).attr('data-settingscountry'),
                settingscasino = null;
            jQuery.each(positionsArray, function (index, item) {
                input[item + '_image'] = jQuery('input[id="geoAds-' + settingscountry + '[' + item + '][image]"]').val();
                input[item + '_script'] = jQuery('textarea[id="geoAds-'+ settingscountry + '[' + item + '][script]"]').val();
                input[item + '_affiliate'] = jQuery('input[id="geoAds-'+ settingscountry + '[' + item + '][aff_url]"]').val();
                input[item + '_img_on'] = jQuery('input[id="geoAds-' + settingscountry + '[' + item + '][img_on]"]').is(":checked") ? '1' : null;
            });
        }
        jQuery($this).text('Saving...');
        jQuery.ajax({
            type: 'GET',
            url: ajax.ajax_url,
            data: {settingscountry: settingscountry,settingscasino:settingscasino, input: input, action: 'saveAdSettings'},
            dataType: 'html',
            success: function (data) {
                jQuery($this).text('Settings Saved');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            },
            complete: function () {
                jQuery($this).text(btnMessage);
            }
        });
    }
}

function filterPremiumPromo(e,$this){
    e.preventDefault();
    var ajax = getAjax();

    var country = jQuery($this).attr('data-country');
    var typefilter = jQuery($this).attr('data-by');
    var firstfilter = jQuery($this).attr('data-type');

    if (typefilter === 'promotype'){
        var secondfilter = jQuery('.navdays.active').attr('data-type');
    }else{
        var secondfilter = jQuery('.navpromos.active').attr('data-type');
    }

    var target = '#v-pills-'+country;

    jQuery(target + " .tab-content").html('<div class="d-flex justify-content-center"><div class="spinner-grow  text-primary" role="status">\n' +
        '  <span class="sr-only">Loading...</span>\n' +
        '</div></div>');
    jQuery.ajax({
        type: 'GET',
        url: ajax.ajax_url,
        data: { country: country,firstfilter:firstfilter,secondfilter:secondfilter,typefilter:typefilter, action : 'filterPremiumPromoAdmin' },
        dataType: 'html',
        success: function(data){
            jQuery(target + " .tab-content").html(data);
            sortableLists(jQuery(target + " .tab-content .sortable_bookie_list"));
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        },
        complete: function(){
        }
    });
}
function loadGeoAds($this){
    var ajax = getAjax();
    var country = jQuery($this).attr('data-country');
    var settingsType = jQuery($this).attr('data-settingsType');
    var target = jQuery($this).attr('href');
    jQuery(target + " .tab-content").html('<div class="d-flex justify-content-center">\n' +
        '                                            <div class="spinner-border" role="status">\n' +
        '                                                <span class="sr-only">Loading...</span>\n' +
        '                                            </div>\n' +
        '                                        </div>');
    jQuery.ajax({
        type: 'GET',
        url: ajax.ajax_url,
        data: { country: country,settingsType:settingsType, action : 'loadAdsFields' },
        dataType: 'html',
        success: function(data){
            jQuery(target + " .tab-content").html(data);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        },
        complete: function(){
        }
    });
}
function loadFeatured($this){
    var ajax = getAjax();
    var country = jQuery($this).attr('data-country');
    var target = jQuery($this).attr('href');
    jQuery(target + " .tab-content").html('<div class="d-flex justify-content-center"><div class="spinner-grow  text-primary" role="status">\n' +
        '  <span class="sr-only">Loading...</span>\n' +
        '</div></div>');
    jQuery.ajax({
        type: 'GET',
        url: ajax.ajax_url,
        data: { country: country, action : 'loadOptions' },
        dataType: 'html',
        success: function(data){
            jQuery(target + " .tab-content").html(data);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        },
        complete: function(){
        }
    });
}
function loadPremium($this, $postType){
    var ajax = getAjax();
    var country = jQuery($this).attr('data-country');
    var target = jQuery($this).attr('href');
    jQuery(target + " .tab-content").html('<div class="d-flex justify-content-center"><div class="spinner-grow  text-primary" role="status">\n' +
        '  <span class="sr-only">Loading...</span>\n' +
        '</div></div>');
    jQuery.ajax({
        type: 'GET',
        url: ajax.ajax_url,
        data: { country: country,postType:$postType, action : 'loadPremium' },
        dataType: 'html',
        success: function(data){
            jQuery(target + " .tab-content").html(data);
            sortableLists(jQuery(target + " .tab-content .sortable_bookie_list"));

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        },
        complete: function(){
        }
    });
}
function esc_selector( selector ) {
    return selector.replace( /(:|\.|\[|\]|,)/g, "\\$1" );
}
function addImageOnSettings(e,$this){
    var dest_selector;
    var media_window = wp.media({
        title: 'Add Media',
        library: {type: 'image'},
        multiple: false,
        button: {text: 'Add'}
    });
    media_window.on('select', function() {
        var first = media_window.state().get('selection').first().toJSON();
        jQuery(dest_selector).val(first.url);
        dest_selector = null; // reset
    });
    e.preventDefault();
    dest_selector = esc_selector(jQuery($this).data('dest-selector')); // set
    media_window.open();
}
function sortableLists($list){
    jQuery( $list ).sortable({
        placeholder: "sortable-placeholder",
        create: function(event, ui){
        },
        update: function(event, ui){
            sortableIn = 1;
            var changedList = jQuery( $list ).attr('id');
            var order = jQuery(this).sortable('toArray').toString();
            var premium = "";
            jQuery('input[data-target="'+changedList+'[ids]"]').attr("value",order );

            var listitems = jQuery(this).children('li').get();
            jQuery.each(listitems, function(index, itm) {
                if(jQuery(this).find("input").is(':checked')){
                    premium += jQuery(this).attr('data-value')+',';
                }
            });
            premium = premium.replace(/,\s*$/, "");
            jQuery('input[data-target="'+changedList+'[premium]"]').attr("value",premium );
        },
    }).disableSelection();
    jQuery( ".sortable_bookie_list li input").on('click', function(){
        var thisList = jQuery(this).parents('.sortable_bookie_list');
        var listitems = thisList.children('li').get();
        var premium = "";
        jQuery.each(listitems, function(index, itm) {
            if(jQuery(this).find("input").is(':checked')){
                premium += jQuery(this).attr('data-value')+',';
            }
        });
        premium = premium.replace(/,\s*$/, "");
        jQuery('input[data-target="'+thisList.attr('id')+'[premium]"]').attr("data-value",premium );
        jQuery('input[data-target="'+thisList.attr('id')+'[premium]"]').attr("value",premium );
    });
}
function loadMetaTable(type, $this, metaType,metaName=null) { //metaName in case of standar meta where option ID and meta key is different
    var bookIDorCountryISO = $this.value ? $this.value : $this;
    if (type === 'bybook') {
        document.getElementById('bymeta').selectedIndex = 0;
        if(document.getElementById('bymeta').dataset.standar==='standar' && document.getElementById('bybook').value===''){
            loadMetaTable('bymeta',document.getElementById('bymeta').dataset.type,'standar',document.getElementById('bymeta').dataset.metaname);
            return;
        }
    } else {
        document.getElementById('bybook').selectedIndex = 0;
    }
    let loader = '<div class="spinner-border" role="status" style="margin: 20px auto;">\n' +
        '  <span class="sr-only">Loading...</span>\n' +
        '</div>';
    document.getElementById(metaType + "PanelSettingsContainer").innerHTML = loader;
    var ajax = getAjax();
    fetch(ajax.ajax_url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'
            // 'Content-Type': 'application/json'
            // 'Content-Type': 'text/html; charset=UTF-8'
        },
        credentials: 'same-origin',
        body: 'action=loadMetaTable&metaBy=' + type + '&bookIDorCountryISO=' + bookIDorCountryISO + '&metaType=' + metaType + '&metaName=' + metaName
        // body: data
    })
        .then(response => response.json())
        .then(function (data) {
            // var obj = JSON.parse(data);
            document.getElementById(metaType + "PanelSettingsContainer").innerHTML = data.asd;
            // expandTextareas();
            // RepeaterCustom();
        })
        .catch(err => {
            console.log(err);
            alert("sorry, there are no results for your search");
        });
}

function saveMetaTable(e, $this, metaType) {
    e.preventDefault();
    var $ajaxTable = [
        'cs-languages',
        'cs-channels',
        'review-sports',
        'review-products',
        'additional-betting-selections',
        'review-services',
        'review-currencies',
        'web-languages',
        // 'book-dynamic-meta',
        // 'helping-panel',
        // 'book-restriction-meta'
    ];
    var bymeta = document.getElementById("bymeta").value;
    var bybook = document.getElementById("bybook").value;
    var type = '';
    var BookOrIsoOrMetaID = '';
    if (bybook) {
        type = 'bybook';
        BookOrIsoOrMetaID = bybook;
    } else if (bymeta || $ajaxTable.includes(metaType)) {
        type = 'bymeta';
        BookOrIsoOrMetaID = bymeta ? bymeta : document.getElementById("bymeta").dataset.metaname;
    } else {
        console.log('None');
        return false;
    }
    var lists = jQuery('.my_meta_control.metabox');
    var settings = {};
    jQuery.each(lists, function (index, item) {
        var dataId = jQuery(item).attr('data-id');
        if (metaType==='helping-panel' || metaType==='casino-restriction-meta'|| metaType==='book-payments-meta' || $ajaxTable.includes(metaType) ){
            settings[dataId] = getAllMetaData(item, metaType,true);
        }else{
            settings[dataId] = getAllMetaData(item, metaType);
        }
    });
    var ajax = getAjax();
    var jsonSettings = JSON.stringify(settings);
    jQuery($this).text('Saving...');
    jQuery.ajax({
        type: 'POST',
        url: ajax.ajax_url,
        data: {
            settings: jsonSettings,
            type: type,
            BookOrIsoOrMetaID: BookOrIsoOrMetaID,
            metaType: metaType,
            action: 'saveMetaTable'
        }, //metatype shows if is from helping panel or from dynamic-meta panel type show if the casino SELECT is chosen or the country/meta SELECT
        dataType: 'html',
        success: function (data) {
            jQuery($this).text('Settings Saved');
            console.log(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        },
        complete: function () {
            // jQuery($this).text(btnMessage);
        }
    });

}
function switchBonusPanel($this){
    var value = $this.value;
    var sourceHTML = document.querySelector('#my_meta_control_country_'+value+' .itsAme').innerHTML;
    document.querySelector('.ItsAmeReplace .d-flex.flex-wrap').innerHTML = sourceHTML;
}
function doCheckAll($this,e,id){
    e.preventDefault();
    jQuery('input[type="checkbox"][data-check="me"][name="'+id+'[]"]').attr( "checked" , true );
}
function unCheckAll($this,e,id){
    e.preventDefault();
    jQuery('input[type="checkbox"][data-check="me"][name="'+id+'[]"]').attr( "checked" , false );
}

function copyData($this){
    var source = $this.dataset.source;
    var target = $this.dataset.target;
    if(source===target){
        alert("The Source Country is the same as the Target Country");
        return;
    }
    if(!source){
        alert("Please select Source Country");
        return;
    }if(!target){
        alert("Please select Target Country");
        return;
    }
    var txt;
    if (confirm("Are you sure you want to copy these data?")) {
        var listSource = document.getElementById("ItsAmeReplace");
        var DataToCopy = getAllMetaData(listSource, 'bonus',true);
        var listTarget = document.getElementById('my_meta_control_country_'+target);
        const keys = Object.entries(DataToCopy);
        for (const [key, value] of keys) {
            let SourceNoBonusChecked = listSource.querySelector('[name$="no_bonus"]').checked;
            let keyTarget = key.replace(source+'bs_custom', target+'bs_custom');
            if (listTarget.querySelector('[name="'+keyTarget+'"]').type && listTarget.querySelector('[name="'+keyTarget+'"]').type === 'checkbox' && !Array.isArray(value)){
                if(value){
                    listTarget.querySelector('[name="'+keyTarget+'"]').checked = true;
                }else{
                    listTarget.querySelector('[name="'+keyTarget+'"]').checked = false;
                }
            }else if(Array.isArray(value)){
                multiboxes = listTarget.querySelectorAll('[name="'+keyTarget+'"]');
                for (let i = 0; i < multiboxes.length; i++) {
                    multiboxes[i].checked = !!value.includes(multiboxes[i].value);
                    if(SourceNoBonusChecked){
                        multiboxes[i].disabled = true;
                    }
                }
            }else{
                listTarget.querySelector('[name="'+keyTarget+'"]').value = value;
            }
            const disablication = listTarget.querySelector('[name="'+keyTarget+'"]').dataset.disabled;
            if(disablication==='true' && SourceNoBonusChecked){
                listTarget.querySelector('[name="'+keyTarget+'"]').disabled = true;
            }
        }
    } else {
        return false;
    }
}
function appendLIs(list,newArraySorting){
    while (list.firstChild) {
        list.removeChild(list.lastChild);
    }
    for (let j = 0; j < newArraySorting.length; ++j) {
        var li = window.keyNamePairs['id'+newArraySorting[j]];
        list.appendChild(li);
        //     console.log( keyNamePairs[newArraySorting[j]]);
        //     keyNamePairs[newArraySorting[j]].setAttribute("onclick", "putPremiumonClick(this)");
        //     // lis+='<li class="p-1 ui-sortable-handle" id="'+newArraySorting[i]+'" data-value="'+newArraySorting[i]+'" onclick="putPremiumonClick(this)">'+keyNamePairs[newArraySorting[i]]+'</li>';
        console.log(window.keyNamePairs);
    }
}
function makeEverythingDefault(name){
    if (confirm("Are you sure you want to reset to default?")) {
        var sourceList = document.querySelector('#' + name + '\\[-\\]');
        var sourceSorting = document.querySelector('[name="' + name + '[-][order]"]').value;
        var sourceSortingArray = sourceSorting.split(",");
        var sourcePremium = document.querySelector('[name="' + name + '[-][premium]"]').value;
        var sourcePremiumArray = sourcePremium.split(",");
        var keyNamePairs = [];
        for (let i = 0; i < sourceSortingArray.length; ++i) {
            // keyNamePairs[i] = {
            //     'id' : sourceSortingArray[i],
            //    'html': sourceList.querySelector('li[data-value="'+sourceSortingArray[i]+'"]').innerHTML
            // };
            keyNamePairs['id' + sourceSortingArray[i]] = sourceList.querySelector('li[data-value="' + sourceSortingArray[i] + '"]').cloneNode(true);
        }
        window.keyNamePairs = keyNamePairs;
        var allTargets = document.querySelectorAll('[id^="premium_bookmakers_per_country"]');
        for (let i = 0; i < allTargets.length; ++i) {
            var targetSorting = '';
            var targetID = allTargets[i].id;
            if (targetID !== 'premium_bookmakers_per_country[-]') {
                targetSorting = document.querySelector('[name="' + targetID + '[order]"]').value;
                var targetSortingArray = targetSorting.split(",");
                var newArraySorting = sourceSortingArray.filter(function (n) {
                    return targetSortingArray.indexOf(n) !== -1;
                });
                var newArrayPremium = newArraySorting.filter(function (n) {
                    return sourcePremiumArray.indexOf(n) !== -1;
                });
                // document.getElementById(targetID).style.background = '#f00';
                // appendLIs(document.getElementById(targetID),newArraySorting);
                var newStringSorting = newArraySorting.join();
                var newStringPremium = newArrayPremium.join();
                // document.getElementById(targetID).replaceChild(lis, document.getElementById(targetID).childNodes[0]);
                // document.getElementById(targetID).innerHTML = lis;

                document.querySelector('[name="' + targetID + '[order]"]').value = newStringSorting;
                document.querySelector('[name="' + targetID + '[premium]"]').value = newStringPremium;
            }
        }
        document.querySelector('.button.button-primary[type="submit"][name="premium-bookmakers_save"]').click();
    }else{
        return false;
    }
}
function filterBookByMeta($this,metaName) {
    var filterValue = $this.value;
    var allBookLists = document.querySelectorAll('.w-49.searchme');
    if(!filterValue){
        for (let i = 0; i < allBookLists.length; ++i) {
            allBookLists[i].style.display="block";
        }
    }else{
        for (let i = 0; i < allBookLists.length; ++i) {
            if(!allBookLists[i].querySelector('input[name="'+metaName+'[]"][value="'+filterValue+'"]').checked){
                allBookLists[i].style.display="none";
            }else{
                allBookLists[i].style.display="block";
            }
        }
    }
}
function resetPromoOrder($list,$tabType,$this,iso){
    if (confirm("Are you sure you want to reset to default?")) {
        var tabtype = $tabType;
        var settingsType = 'offertype';
        let loader = '<div class="spinner-border" role="status" style="margin: 20px auto;">\n' +
            '  <span class="sr-only">Loading...</span>\n' +
            '</div>';

        var myList =  $this.parentNode.previousSibling.previousSibling.previousSibling.previousSibling;
        myList.innerHTML = loader;
        // $chackbox = document.querySelector('select[name="tabtype"]');
        $chackbox = document.querySelector('input[name="'+$list+'-customOrDefault"]');
        $chackbox.checked = false;
        var ajax = getAjax();
        fetch(ajax.ajax_url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'
                // 'Content-Type': 'application/json'
                // 'Content-Type': 'text/html; charset=UTF-8'
            },
            credentials: 'same-origin',
            body: 'action=resetPremium&settingsType=offertype&tabtype=' + tabtype+'&country=' + iso
            // body: data
        })
            .then(response => response.json())
            .then(function (data) {
                // var obj = JSON.parse(data);
                myList.innerHTML = data.asd;
                var elements = document.getElementsByClassName("sortable_bookie_list");
                Array.from(elements).forEach((el) => {
                    sortableLists(el);
                });
            })
            .catch(err => {
                console.log("u");
                alert("sorry, there are no results for your search");
            });
    }else{
        return false;
    }
}