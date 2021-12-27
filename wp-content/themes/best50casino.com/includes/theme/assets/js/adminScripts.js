jQuery(document).ready(function($){

    var dest_selector;
    var media_window = wp.media({
        title: 'Add Media',
        library: {type: 'image'},
        multiple: false,
        button: {text: 'Add'}
    });

    media_window.on('select', function () {
        var first = media_window.state().get('selection').first().toJSON();
        $(dest_selector).val(first.url);
        $(dest_selector+'_preview img').attr('src',first.url);
        dest_selector = null; // reset
    });

    function esc_selector(selector) {
        return selector.replace(/(:|\.|\[|\]|,)/g, "\\$1");
    }

    $('.my_meta_control').on('click', '.add-logo-button', function (e) {
        e.preventDefault();
        dest_selector = esc_selector($(this).data('dest-selector')); // set
        media_window.open();
    });
    jQuery('.select2-field').select2();
    $( ".sortable" ).sortable();
    $( ".sortable" ).disableSelection();
});
