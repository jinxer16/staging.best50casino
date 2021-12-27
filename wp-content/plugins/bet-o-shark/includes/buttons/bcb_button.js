(function() {
    tinymce.create('tinymce.plugins.bcb_button', {
        init : function(ed, url) {
            ed.addButton('bcb_button', {
                title : 'BonusCode Shortcode',
                image : url+'/graph.png',
                onclick : function() {
                     //ed.selection.setContent('[mylink]' + ed.selection.getContent() + '[/mylink]');
 					//tb_show('test mesage', '#TB_inline?inlineId=bcb_editor&width=300&height=200', null);
					//window.open("#TB_inline?inlineId=bcb_editor&width=300&height=200");
					jQuery('#bcb_editor').dialog({'dialogClass'   : 'wp-dialog', 'width': '400px'}).dialog('open');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('bcb_button', tinymce.plugins.bcb_button);
})();