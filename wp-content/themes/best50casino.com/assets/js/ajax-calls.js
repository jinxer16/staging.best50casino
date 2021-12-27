// jQuery(document).ready(function() {
// 	//$("select#promo_shortcode_meta_cat_in").click(function(){
// 		jQuery.ajax({
// 			type: 'GET',
// 			url: ajaxscripts.ajax_url,
// 			data: {  action : 'select_refresh' },
// 			dataType: 'html',
// 			success: function(data){
// 				$("select#promo_shortcode_meta_cat_in").html(data);
//                // updateCustomShortcode();
// 			},
// 			  error: function (xhr, ajaxOptions, thrownError) {
// 				// alert(xhr.responseText);
// 				// alert(thrownError);
// 			}
// 		});
// 	//});
// });
jQuery(document).ready(function() {
    // var ajaxscripts = {"ajax_url":"\/wp-admin\/admin-ajax.php"};
    // jQuery("button.tester").on("click", function(event){
    //     var linkHref = $(this).attr('href');
    //     var casinoid = $(this).data('casinoid');
    //     var country = $(this).data('country');
    //     var patt = new RegExp("/goto/");
    //     var res = patt.test(linkHref);
    //     if(!res){
    //         // var newWindow = window.open(linkHref, '_blank');
    //         // const head = '<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><meta NAME="robots" content="noindex, nofollow"><title>Best50casino.com</title><link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" type="text/css" href="https://www.best50casino.com/wp-content/themes/best50casino/assets/css/font-awesome.min.css "/><link rel="shortcut icon" type="image/png" href="https://www.best50casino.com/wp-content/themes/best50casino/assets/images/favicon.png"><style>.loader {border: 16px solid #f3f3f329; /* Light grey */border-top: 16px solid #03898f; /* Blue */border-bottom: 16px solid #03898f; /* Blue */border-radius: 50%;width: 120px;height: 120px;animation: spin 2s linear infinite;margin-bottom:20px;margin: 0 auto 20px auto;}@keyframes spin {0% { transform: rotate(0deg); }100% { transform: rotate(360deg); }}@media (max-width:576px){h1{font-size: 22px !important;}.wrapper{}.promo-details-amount {font-size: 26px !important;}.bonus-box{width: 100% !important;font-size: 20px !important;padding: 10px !important;}}</style></head>';
    //         // var body = '<body style="width:100%;background: url(https://www.best50casino.com/wp-content/themes/best50casino/assets/images/exit-page-bg.jpg) no-repeat;background-size: cover;">';
    //         // body += '<div class="container" >';
    //         // body += '<div class="row">';
    //         // body += '    <div class="redirect col-xs-12 text-center">';
    //         // body += '        <img src="https://www.best50casino.com/wp-content/themes/best50casino/assets/images/best50casino-logo.svg" alt="best50casino.com" width="400" style="margin: 60px auto 0;" class="img-responsive"/>';
    //         // body += '            <h1 style="font-size:32px;font-weight:600;color:white;">Thank you for visiting best50casino.com</h1>';
    //         // body += '            <div class="bonus-box" style="margin: 0 0 20px 0;display: flex;justify-content: center;flex-direction: column;width: -moz-max-content;width: max-content;margin: 0 auto;color: white;font-size: 30px;padding: 40px;border: 2px solid #ffcb00;">';
    //         //
    //         // body += '            </div>';
    //         // body += '          <div class="loader">';
    //         // body += '            </div>';
    //         // body += '            <p style="font-size:18px;"><a style="color:#ffcd00;" href="' +linkHref+ '" rel="nofollow">You are being redirected to the website...</a></p>';
    //         // body += '   </div>';
    //         // body += '</div>';
    //         // body += '</div>';
    //         // // body += '<script>setTimeout(function(){window.location = "'+linkHref+'";}, 4000 );</script>';
    //         // body += '</body>';
    //
    //         // newWindow.document.head.innerHTML = head;
    //         // newWindow.document.body.innerHTML = body;
    //         // // document.body.innerHTML = body;
    //         // newWindow.document.body.style.background = "url(https://www.best50casino.com/wp-content/themes/best50casino/assets/images/exit-page-bg.jpg)";
    //         // newWindow.document.body.style.width = "100%";
    //
    //
    //         $.ajax({
    //             type: 'GET',
    //             data: { action : 'testAjax', link : linkHref, casinoid: casinoid, country: country },
    //             url: ajaxscripts.ajax_url,
    //             dataType: 'html',
    //             success: function(result){
    //                 jQuery(".test-test").html(result);
    //             },
	// 		    error: function (xhr, ajaxOptions, thrownError) {
    //                 console.log(xhr.responseText);
    //                 console.log(thrownError);
    //             }
    //         });
    //     }
    // })
    jQuery("a.bumper").on("click", function(event){
        var linkHref = $(this).attr('href');
        var casinoid = $(this).data('casinoid');
        var country = $(this).data('country');
        var patt = new RegExp("/goto/");
        var res = patt.test(linkHref);
        if(res){
            event.preventDefault();
            var newWindow = window.open(linkHref, '_blank');
            $.ajax({
                type: 'GET',
                data: { action : 'bumper_page', link : linkHref, casinoid: casinoid, country: country },
                url: ajaxscripts.ajax_url,
                dataType: 'html',
                success: function(result){
                    newWindow.document.open();
                    // var x = newWindow.document.getElementsByClassName("bonus-box");
                    // x[0].innerHTML = result;
                    newWindow.document.write(result);
                    newWindow.document.close();
                    newWindow.focus();
                    // console.log(result);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.responseText);
                    console.log(thrownError);
                }
            });
        }
    })
});
