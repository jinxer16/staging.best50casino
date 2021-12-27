(function() {
    tinymce.PluginManager.add('add_table', function( editor, url ) {
        function createColorPickAction() {
            var colorPickerCallback = editor.settings.color_picker_callback;

            if (colorPickerCallback) {
                return function() {
                    var self = this;

                    colorPickerCallback.call(
                        editor,
                        function(value) {
                            self.value(value).fire('change');
                        },
                        self.value()
                    );
                };
            }
        }
        function tableExists(){
            return !!$('#selectTable-preview-body table').length;
        }
        function colorExists(){
            return !!$('#selectCellsColour-inp').val();
        }
        function givePropAndActivate(btnID){
            if(!tableExists()) {alert('Select Table please');return false;}
            var testClass = btnID;
            var el = $('#'+btnID);
            if(el.hasClass('active')){
                el.removeClass('active');
                if(btnID.indexOf("-color") < 0 || btnID.indexOf("-reset") < 0) $('#selectTable-preview-body table').removeClass(testClass);
            }else{
                if(btnID.indexOf("-color") > 0 || btnID.indexOf("-reset") > 0) $('#coloriseCell-body div, div#tableHeight-body div').removeClass('active');
                el.addClass('active');
                if(btnID.indexOf("-color") < 0 || btnID.indexOf("-reset") < 0) $('#selectTable-preview-body table').addClass(testClass);
            }
        }
        function placeOnPreview(ret2,ret3){
            var Editor = editor.getContentAreaContainer().lastChild.contentDocument;
            var selectedTableID = $('#selectTable-inp').val();
            var parentClass='';
            var parentStyle='';
            var previewArea =  $('#selectTable-preview-body');
            if($(Editor).find('table#'+selectedTableID).parent().is('div')){
                parentClass=  $(Editor).find('table#'+selectedTableID).parent().attr('class');
                parentStyle=  $(Editor).find('table#'+selectedTableID).parent().attr('style');
            }
            parentClass = parentClass.indexOf("table-responsive") >= 0 ? parentClass : parentClass + ' table-responsive';
            arr =  $.unique(parentClass.split(' '));
            parentClass = arr.join(" ");
            previewArea.empty();
            previewArea.html('<div class="'+parentClass+'" style="'+parentStyle+'">'+ret2[selectedTableID]+'</div>');

            var selectedTable = $('#selectTable-preview-body table');
            var tableClass=  selectedTable.attr('class');
            tableClass = tableClass.indexOf("table table-bordered") >= 0 ? tableClass + ' ui-sortable' : tableClass + ' table table-bordered ui-sortable';
            arr =  $.unique(tableClass.split(' '));
            tableClass = arr.join(" ");
            selectedTable.attr('class', tableClass);
            var helperHeader = '<tr class="headerrow ui-sortable">';
            selectedTable.find('tbody tr:first-of-type td').each(function(i){
                helperHeader += '<th class=""><div class="">COL '+(i+1)+'<div class=""></div></div></th>';
            });
            helperHeader += '</tr>';
            var target = $('#'+selectedTableID+' thead').length ? 'thead' : 'tbody';
            selectedTable.find(target).prepend(helperHeader);
            // $('#selectTable-preview-body').html('<div class="table-responsive">'+ret2[selectedTable]+'</div>');
            $('#'+selectedTableID+' tbody').sortable();
            $('#'+selectedTableID).sorttable({
                placeholder: 'placeholder',
            }).disableSelection();
        }
        function paintOrDisable(area,type,id){
            var $id = $('#'+id);
            if(!colorExists() && type == 'color') {if(!tableExists()){return false;}alert('Select Color please');$id.removeClass('active');return false;}
            var table = $('#selectTable-preview-body table');
            var color = type=='color' ? $('#selectCellsColour-inp').val(): 'none';
            if ($id.hasClass('active')) {
                table.addClass('pointer');
                table.off('click');
                table.on('click', 'td,th', function () {
                    var textarea;
                    switch (area){
                        case 'cell':
                            textarea = $(this);
                            textarea.css('background', color);
                            break;
                        case 'row':
                            textarea = $(this).parent('tr');
                            textarea.find('td,th').each(function(){
                                $(this).css( 'background', color );
                            });
                            break;
                        case 'column':
                            textarea = $(this).parent('tr');
                            var columnNo = $(this).index();
                            $(this).closest("table").find('tr').each(function(){
                                $(this).find("td:nth-child(" + (columnNo+1) + ")")
                                    .css("background", color);
                            });
                            break;
                    }
                });
            }else{
                table.removeClass('pointer');
                table.off('click');
            }
        }
        editor.addButton( 'add_table', {
            title: 'Edit Tables on Editor',
            icon: 'book-btn dashicons-before dashicons-buddicons-replies',
            onclick: function() {
                // var test = editor.getContentAreaContainer().lastChild.id;
                var test2 = editor.getContentAreaContainer().lastChild.contentDocument;
                var tableData ;
                var ret = [];
                var ret2 = [];
                var ret3 = [];
                $(test2).find("table").each(function(index,item){
                    if(!$(this).attr('id')){
                        var noTrs = $(this).find('tr').length;
                        var noTds = $(this).find('td').length;
                        $(this).attr('id', 'edit-table-'+(index+1)+'-'+noTrs+'-'+noTds);
                    }
                    var tableID = $(this).attr('id');
                    var data = {};
                    data.text = 'Table '+(index+1);
                    data.value = tableID;
                    ret2[tableID] = $(this).prop('outerHTML');
                    ret3[tableID] = $(this);
                    ret.push(data);
                });

                editor.windowManager.open( {
                    width: 1080,
                    height: 840,
                    resizable : true,
                    multiline : true,
                    title: 'Edit the Tables',
                    classes: 'table-edit-modal table-edit-modal',
                    body: [
                        {
                            type   : 'combobox',
                            name   : 'selectTable',
                            label  : 'Select the Table you want to edit:',
                            id     : 'selectTable',
                            values : ret,
                        },
                        {
                            type   : 'button',
                            name   : 'selextTablButton',
                            text   : 'Press to preview table',
                            width  : 20,
                            onclick: function(){
                                placeOnPreview(ret2, ret3);
                                // $('#'+selectedTable+' tbody td').resizable();
                            }
                        },
                        {
                            type   : 'colorbox',  // colorpicker plugin MUST be included for this to work
                            id   : 'selectCellsColour',
                            label  : 'colorbox',
                            layout: 'flex',
                            onaction: createColorPickAction(),
                        },
                        {
                            type   : 'buttongroup',
                            name   : 'coloriseCell',
                            id : 'coloriseCell',
                            label  : 'Press HERE and then to the cell you want to fill with color',
                            items  : [
                                { text: 'Color Cell', id: 'cell-color', onclick: function(e){
                                        givePropAndActivate(e.control._id);
                                        paintOrDisable('cell','color',e.control._id);
                                    }
                                },
                                { text: 'Color Row', id: 'row-color', onclick: function(e){
                                        givePropAndActivate(e.control._id);
                                        paintOrDisable('row','color' ,e.control._id);
                                    }
                                },
                                { text: 'Color Column', id: 'column-color', onclick: function(e){
                                        givePropAndActivate(e.control._id);
                                        paintOrDisable('column','color' ,e.control._id);
                                    }
                                },
                                { text: 'Reset Cell', id: 'cell-reset', onclick: function(e){
                                        givePropAndActivate(e.control._id);
                                        paintOrDisable('cell', 'reset',e.control._id);
                                    }
                                },
                                { text: 'Reset Row', id: 'row-reset', onclick: function(e){
                                        givePropAndActivate(e.control._id);
                                        paintOrDisable('row', 'reset',e.control._id);
                                    }
                                },
                                { text: 'Reset Column', id: 'column-reset', onclick: function(e){
                                        givePropAndActivate(e.control._id);
                                        paintOrDisable('column', 'reset',e.control._id);
                                    }
                                },
                            ]
                        },
                        {
                            type   : 'buttongroup',
                            name   : 'tableProperties',
                            id : 'tableProperties',
                            label  : 'Choose the properties of the table',
                            items  : [
                                { text: 'Table Striped', class: 'btn btn-primary btn-sm', id: 'table-striped', onclick: function(e) {givePropAndActivate(e.control._id);} },
                                { text: 'Table Bordered', class: 'btn btn-primary btn-sm', id: 'table-bordered', onclick: function(e) {givePropAndActivate(e.control._id);} },
                                { text: 'Table Hover', class: 'btn btn-primary btn-sm', id: 'table-hover', onclick: function(e) {givePropAndActivate(e.control._id);} },
                                { text: 'Table Borderless', class: 'btn btn-primary btn-sm', id: 'table-borderless', onclick: function(e) {givePropAndActivate(e.control._id);} },
                                { text: 'Table Small', class: 'btn btn-primary btn-sm', id: 'table-sm', onclick: function(e) {givePropAndActivate(e.control._id);} },
                            ]
                        },
                        {
                            type   : 'buttongroup',
                            name   : 'tableHeight',
                            id : 'tableHeight',
                            label  : 'Choose Max Height of Table (pick the last row that will be visible)',
                            items  : [
                                { text: 'Choose Max height', class: 'btn btn-primary btn-sm', id: 'last-shown-color', onclick: function(e) {
                                    givePropAndActivate(e.control._id);
                                    $('#selectTable-preview-body table').on('click', 'td', function () {
                                        var index = $(this).parent('tr').index();

                                        var selectedTableID = $('#selectTable-inp').val();
                                        var targetTable = $('#selectTable-preview-body #' + selectedTableID);
                                        var target = !!$('#selectTable-preview-body #' + selectedTableID + ' thead').length;
                                        var heightTable;
                                        if (target) heightTable = $('#selectTable-preview-body #' + selectedTableID + ' thead tr:nth-of-type(2)').outerHeight();
                                        for (let i = 0; i <= index; i++) {
                                            heightTable = heightTable + $('#selectTable-preview-body #' + selectedTableID + ' tbody tr:nth-of-type(' + (i+1) + ')').outerHeight();
                                        }
                                        targetTable.parent('div').css('max-height', heightTable);
                                        targetTable.parent('div').css('overflow-y', 'scroll');
                                    });
                                    }
                                },
                                { text: 'Reset Max height', class: 'btn btn-primary btn-sm', id: 'shown-reset', onclick: function(e) {
                                        givePropAndActivate(e.control._id);
                                        var selectedTableID = $('#selectTable-inp').val();
                                        var targetTable = $('#selectTable-preview-body #' + selectedTableID);
                                        $('#selectTable-preview-body table').off('click');
                                        targetTable.parent('div').css('max-height', 'initial');
                                        targetTable.parent('div').css('overflow-y', 'unset');

                                    }
                                },
                            ]
                        },
                        {
                            width: 620,
                            type   : 'container',
                            name   : 'selectTable-preview',
                        // label  : 'Preview',
                            id : 'selectTable-preview',
                            html   : ''
                        },


                    ],

                    onsubmit: function( e ) {
                        $('#selectTable-preview-body table').off('click');
                        var finalTable = $('#selectTable-preview-body table');
                        var selectedTableID = $('#selectTable-inp').val();
                        $('#'+selectedTableID).sorttable("disable");
                        $('#'+selectedTableID+" tbody").sortable("disable");
                        $('#selectTable-preview-body table tr.headerrow').remove();
                        $('#selectTable-preview-body table, #selectTable-preview-body table tbody').removeClass('ui-sortable');
                        $('#selectTable-preview-body table tr').removeClass('ui-sortable-handle');
                        $('#selectTable-preview-body table').off();
                        $('#selectTable-preview-body table').find("*").off();;

                        var Editor = editor.getContentAreaContainer().lastChild.contentDocument;
                        var retTable = $('#selectTable-preview-body div');
                        var parentClass='';
                        if($(Editor).find('table#'+selectedTableID).parent().is('div')){

                            $(Editor).find('table#'+selectedTableID).parent().replaceWith(retTable);
                        }else{
                            $(Editor).find('table#'+selectedTableID).replaceWith(retTable);
                        }
                    }
                }
                );
            }

        });
    });
})();
