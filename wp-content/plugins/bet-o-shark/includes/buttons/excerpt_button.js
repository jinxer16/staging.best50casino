(function() {
    tinymce.create('tinymce.plugins.excerpt_button', {
        init : function(ed, url) {
            ed.addButton('excerpt_button', {
                title : 'Excerpt Shortcode',
                image : url+'/excerpt.png',
                onclick : function() {
                     //ed.selection.setContent('[mylink]' + ed.selection.getContent() + '[/mylink]');
 					//tb_show('test mesage', '#TB_inline?inlineId=bcb_editor&width=300&height=200', null);
					//window.open("#TB_inline?inlineId=bcb_editor&width=300&height=200");
					jQuery('#excerpt_editor').dialog({'dialogClass'   : 'wp-dialog', 'width': '400px'}).dialog('open');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('excerpt_button', tinymce.plugins.excerpt_button);
})();