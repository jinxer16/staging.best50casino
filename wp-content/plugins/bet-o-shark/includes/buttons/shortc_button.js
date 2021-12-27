(function() {
    tinymce.PluginManager.add('shortc_button', function( editor, url ) {
        editor.addButton( 'shortc_button', {
            title : 'Get Shortcode',
            image : url+'/link.png',
            onclick: function() {
                editor.insertContent('Hello World!');
            }
        });
    });
})();