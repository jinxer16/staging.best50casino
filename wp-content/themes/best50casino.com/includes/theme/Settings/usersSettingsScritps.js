jQuery(document).ready(function ($) {
    $('input[id="role-management[newrole][new-name]"]').on("keyup", function(){
        var from = "αάβγδεέζηήθιίκλμνξοόπρσςτυύφχψωώ";
        var to   = "aavgdeeziitiiklmnsooprsstuufxsoo";
        var name = jQuery(this).val();
        var slug = jQuery(this).val().replace(/^\s+|\s+$/g, ''); // trim
        var str = slug.toLowerCase();
        for (var i=0, l=from.length ; i<l ; i++) {
            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
        }
        str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
            .replace(/\s+/g, '_') // collapse whitespace and replace by -
            .replace(/-+/g, '_'); // collapse dashes
        $(this).attr("name","role-management["+str+"][new-name]");

        $(this).parent("div").children("ul").each(function( index ) {
            $(this).children("li").each(function( index ) {
                    var dataID =  $(this).children("input").attr("id").split("newrole");
                    var dataName =  $(this).children("input").attr("name").split("newrole");
                console.log(dataName[0]+"=>"+dataName[1])
                $(this).children("input").attr("name","");
                $(this).children("input").attr("name",dataID[0]+str+dataID[1]);
                // $(this).text(str);
            });
        });
    });
})
function removeRoleField($this){
    var role = jQuery($this).attr('data-delete');
    var ajax = {"ajax_url":"https://\/www.best50casino.com\/wp-admin\/admin-ajax.php"};
    jQuery($this).html('Deleting...');
    var roleRow = jQuery($this).closest('.roleRow');
    $.ajax({
        type: 'GET',
        url: ajax.ajax_url,
        data: { role: role, action : 'delete_role' },
        dataType: 'html',
        success: function(data){
            jQuery($this).html('Bye...');
            // jQuery(this).closest('.roleRow').remove();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        },
        complete: function(){
            $this.closest('.roleRow').remove();
        }
    });
}