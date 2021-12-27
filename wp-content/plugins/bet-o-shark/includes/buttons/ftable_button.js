(function() {
    tinymce.create('tinymce.plugins.ftable_button', {
        init : function(ed, url) {
            ed.addButton('ftable_button', {
                title : 'Featured Table Shortcode',
                image : url+'/dice.png',
                onclick : function() {
                     //ed.selection.setContent('[mylink]' + ed.selection.getContent() + '[/mylink]');
 					//tb_show('test mesage', '#TB_inline?inlineId=bcb_editor&width=300&height=200', null);
					//window.open("#TB_inline?inlineId=bcb_editor&width=300&height=200");
					jQuery('#ftable_editor').dialog({'dialogClass'   : 'wp-dialog', 'width': '400px'}).dialog('open');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('ftable_button', tinymce.plugins.ftable_button);
})();