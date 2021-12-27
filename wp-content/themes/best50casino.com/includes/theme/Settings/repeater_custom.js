jQuery(function($) {
    //Repeater Custom
    $('.repeater-content').on('click','button',function(e) {
        e.preventDefault();
        if($(this).hasClass('repeater-add-btn') && $(this).hasClass('single-text')){
            $container = $(this).closest('.repeater-content').find('.repeater-rows');
            var datagroup = $container.attr('data-group');
            var $rowToRepeat = '<input type="text" class="form-control form-control-sm col-2" data-name="repeat" name="'+datagroup+'" id="'+datagroup+'_" value="" placeholder="">';
            var clearfix = '<div class="clearfix"></div>';
            $container.append('<div class="items d-flex row mb-1" data-group="'+datagroup+'">'+$rowToRepeat+'</div>'+clearfix);
        }else if($(this).hasClass('repeater-add-btn') && !$(this).hasClass('meta-add') && !$(this).hasClass('tabs-repeater')){
            $container = $(this).closest('.repeater-content').find('.repeater-rows');
            var datagroup = $container.attr('data-group');
            if ($(this).attr('data-settings-type').indexOf("image") >= 0){
                var $containersLastCode = '<input type="text" class="form-control form-control-sm col-1 main-text" data-name="repeat" name="'+datagroup+'[]" id="'+datagroup+'_" value="" placeholder="">';
                var $containersLastText = '<input type="text" class="form-control form-control-sm col-2 fullname" data-name="repeat" name="'+datagroup+'[replaceME][fullname]" id="'+datagroup+'_" value="" placeholder="">';
                var $containersLastImg = '<input type="text" class="form-control form-control-sm mr-1 col-2 image" placeholder="Logo/Flag/Image" name="'+datagroup+'[replaceME][image]" id="'+datagroup+'[replaceME][image]" value="">';
                var $containersLastBtnImg = '<input data-id="'+datagroup+'[replaceME][image]" type="button" class="button-primary media-upload col-2" value="Insert Image">';
                var $containersLastPreview = '<div class="image-preview mr-1 col-2" id="preview'+datagroup+'replaceMEimage" data-source="web-languages[replaceME][image]"><img src="" class="img-responsive" style="max-height: 90px;"></div>';
                var $containersLastDeleteBtn = '<div class="pull-right repeater-remove-btn col-2"><button class="btn btn-danger remove-btn btn-sm">Remove</button></div>';
                var clearfix = '<div class="clearfix"></div>';
                $container.append('<div class="items d-flex row mb-1" data-group="'+datagroup+'">'+$containersLastCode+$containersLastText+$containersLastImg+$containersLastBtnImg+$containersLastPreview+$containersLastDeleteBtn+'</div>'+clearfix);
            }else{
                var $containersLastCode = '<input type="text" class="form-control form-control-sm col-1 main-text" data-name="repeat" name="'+datagroup+'[]" id="'+datagroup+'_" value="" placeholder="">';
                var $containersLastText = '<input type="text" class="form-control form-control-sm col-2 fullname" data-name="repeat" name="'+datagroup+'[replaceME][fullname]" id="'+datagroup+'_" value="" placeholder="">';
                var clearfix = '<div class="clearfix"></div>';
                $container.append('<div class="items d-flex row mb-1" data-group="'+datagroup+'">'+$containersLastCode+$containersLastText+'</div>'+clearfix);
            }
        }if($(this).hasClass('repeater-add-btn') && $(this).hasClass('tabs-repeater')){
            var type = $(this).attr('data-type');
            var dataID = $(this).attr('data-id');
            if(dataID){
                $container = $(this).closest('.repeater-content').find('#'+dataID);
            }else{
                $container = $(this).closest('.repeater-content').find('.repeater-rows.'+type);
            }

            var $rowToSource = $container.children().last();
            var $rowToRep = $rowToSource.clone(); //.html()
            var fatherName = $rowToRep.find('input.father').attr('name');
            var stringOfCurrent = fatherName.split(type+"Name_").pop();
            var numberOfCurrent = parseInt(stringOfCurrent.charAt(0));
            if(numberOfCurrent>=6){
                alert('You have reached maximum number of Tabs!')
                return;
            }
            var numberOfNext = numberOfCurrent+1;
            //resetValues
            $rowToRep.find('.select2.select2-container.select2-container--default').remove();
            //get HTML & replaceName
            var find = type+'Name_'+numberOfCurrent;
            var replace = type+'Name_'+numberOfNext;
            let re = new RegExp(find, "g");
            $rowToRep.find('.items').not(':first').remove();
            var $rowToRep = $rowToRep.html(function(index,html){
                html = html.replace(re,replace)
                if(type==='tab') {
                    var find1 = 'subtabName_'+numberOfNext;
                    var replace1 = 'subtabName_1';
                    let re1 = new RegExp(find1, "g");
                    html = html.replace(re1,replace1);
                }
                return html;
            });
            $container.append($rowToRep);
            var $rowToTarget = $container.children().last();
            $rowToTarget.find('input').val('')
            $rowToTarget.find('select option[value=""]').prop('selected',true);
            // if(!dataID){
            //     $('#details-'+replace+'_subtabs').find('.items').not(':first').remove();
            //     var subTabName = $('#details-'+replace+'_subtabs').find('.items').find('input.father').attr('name');
            //     alert(subTabName);
            // }
            jQuery('.select2-field').select2();
        }else if($(this).hasClass('repeater-add-btn') && $(this).hasClass('meta-add')){
            $container = $(this).closest('.repeater-content').find('.repeater-rows');
            var datagroup = $container.attr('data-group');
            var postID = $container.attr('data-postID');
            var postIN = $container.attr('data-postIN');
            var $this = $(this);
            var ajax = {"ajax_url":"https://\/www.best50casino.com\/wp-admin\/admin-ajax.php"};
            // var ajax = {"ajax_url":"\/www.best50casino.com\/wp-admin\/admin-ajax.php"};
            $(this).html('Adding...');
            $.ajax({
                type: 'GET',
                url: ajax.ajax_url,
                data: { id: postID, in: postIN, action : 'repeater_helper' },
                dataType: 'html',
                success: function(data){
                    $this.html('Add');
                    $container.append(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                },
                complete: function(){
                }
            });
        }else if($(this).hasClass('remove-btn')){
            if($(this).hasClass('tabs-repeater')){
                if($(this).closest('.items').closest('.repeater-rows').find('.items').length===1){
                    alert('You may not remove the last subtab!');
                    return;
                }
            }
            if (confirm("Are you sure you want to remove item?")) {
                $(this).closest('.items').remove();
            }else{
                return false;
            }
        }

    });
    $('.repeater-content').on("keyup", "input.main-text", function(){
        var datagroup = $(this).closest('.repeater-rows').attr('data-group');
        var name = jQuery(this).val();
        var slug = jQuery(this).val().replace(/^\s+|\s+$/g, ''); // trim
        var str = slug.toLowerCase();
        str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
            .replace(/\s+/g, '_') // collapse whitespace and replace by -
            .replace(/-+/g, '_'); // collapse dashes
        $(this).attr("id",datagroup+"_"+str);
        $(this).closest('.items').find('input.fullname').attr("name",datagroup+"["+str+"][fullname]" );
        $(this).closest('.items').find('input.fullname').attr("id",datagroup+"["+str+"][fullname]" );
        $(this).closest('.items').find('input.image').attr("name",datagroup+"["+str+"][image]" );
        $(this).closest('.items').find('input.image').attr("id",datagroup+"["+str+"][image]" );
        $(this).closest('.items').find('input.button-primary.media-upload').attr("data-id",datagroup+"["+str+"][image]" );
        $(this).closest('.items').find('div.image-preview').attr("id","preview"+datagroup+str+"image");
        $(this).closest('.items').find('div.image-preview').attr("data-source",datagroup+"["+str+"][image]");
        // $(this).parent("div").children("ul").each(function( index ) {
        //     $(this).children("li").each(function( index ) {
        //         var dataID =  $(this).children("input").attr("id").split("newrole");
        //         var dataName =  $(this).children("input").attr("name").split("newrole");
        //         console.log(dataName[0]+"=>"+dataName[1])
        //         $(this).children("input").attr("name","");
        //         $(this).children("input").attr("name",dataID[0]+str+dataID[1]);
        //         // $(this).text(str);
        //     });
        // });
    });
    $('.repeater-content').on("focus","select.item-choice",function(){
        $(this).val() !== '' ? $(this).data('val', $(this).val()) : $(this).data('val', 'REPLACEME');
        $(this).val() !== '' ? $(this).data('text', $("option:selected", this).text()) : $(this).data('text', 'REPLACEME');
    }).on("change", "select.item-choice", function(){
        var previous = $(this).data('val'); //old value
        var previousText = $(this).data('text');
        var newText =  $(this).val() !== '' ? $("option:selected", this).text() : 'REPLACEME' ;
        var PaymentID = $(this).val() !== '' ? $(this).val() : 'REPLACEME'; //new value
        $(this).closest('.items').find('td').each(function( index ) {
            if($(this).children().is("input")){
                var childName = $(this).children().prop("name").replace(previous,PaymentID);
                $(this).children().prop("name",childName);
                if($(this).children().attr("name") == "_deposit[deposit_front][]"){
                    $(this).children().val(PaymentID);
                }
            }else if($(this).children().is("div")){
                var child = $(this).children();
                var childNewAttr = child.hasClass('dropdown-toggle') ? child.attr("id").replace(previous,PaymentID) : child.attr("aria-labelledby").replace(previous,PaymentID);
                child.hasClass('dropdown-toggle') ? child.attr("id",childNewAttr) : child.attr("aria-labelledby",childlabel);
                if( child.hasClass('dropdown-menu')){
                    var h6 = child.find('.dropdown-header').text().replace(previousText,newText) ;
                    child.find('.dropdown-header').text(h6);
                    child.find('.dropdown-item div').each(function( index ) {
                        if($(this).children().is("input")){
                            var childName = $(this).children().attr("name").replace(previous,PaymentID);
                            $(this).children().attr("name",childName);
                        }
                    });
                }
            }
        });

        if($(this).val() !== '' ){
            $(this).closest('.items').find('td').each(function( index ) {
                if($(this).children().is("input")){
                    $(this).children().prop('disabled', false);
                }else if($(this).children().is("div")){
                    var child = $(this).children();
                    if(child.hasClass('dropdown-toggle')){
                        child.removeClass("disabled") ;
                    }
                }
            });
        }else{
            $(this).closest('.items').find('td').each(function( index ) {
                if($(this).children().is("input")){
                    $(this).children().prop('disabled', true);
                }else if($(this).children().is("div")){
                    var child = $(this).children();
                    if(child.hasClass('dropdown-toggle')){
                        child.addClass("disabled") ;
                    }
                }
            });
        }
        $(this).val() !== '' ? $(this).data('val', $(this).val()) : $(this).data('val', 'REPLACEME');
        $(this).val() !== '' ? $(this).data('text', $("option:selected", this).text()) : $(this).data('text', 'REPLACEME');
        console.log(previous);
        console.log(previousText);
    });

});
function addBonusDetails($this,e){
    var crypto_ID = $($this).val();
    if($($this).is(':checked')){
        console.log(crypto_ID);
        var ajax = {"ajax_url":"https://\/www.best50casino.com\/wp-admin\/admin-ajax.php"};
        // var ajax = {"ajax_url":"\/www.best50casino.com\/wp-admin\/admin-ajax.php"};
        $.ajax({
            type: 'GET',
            url: ajax.ajax_url,
            data: { crypto_id: crypto_ID , action : 'returnBonusRowHandler' },
            dataType: 'html',
            success: function(data){
                jQuery('.form-group.crypto-list').before(data);
                // jQuery(this).closest('.roleRow').remove();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                console.log(thrownError);
            },
            complete: function(){
                // $this.closest('.roleRow').remove();
            }
        });
    }else{
        var result = confirm("Want to delete?");
        if (result) {
            $('#cryptoRow_'+crypto_ID).remove();
        }else{
            $($this).attr( "checked" , true );
        }
    }
}