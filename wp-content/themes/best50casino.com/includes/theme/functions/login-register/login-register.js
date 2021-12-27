
// var ajax = {"ajax_url": "https://\/dev.best50casino.com\/wp-admin\/admin-ajax.php"};
var ajax = {"ajax_url": "https://\/www.best50casino.com\/wp-admin\/admin-ajax.php"};
// var ajax = {"ajax_url": "https://\/localhost/dev.best50casino.com\/wp-admin\/admin-ajax.php"};

function loginThis($this,e,$ajax){
    e.preventDefault();
    var userName = $($this).parent().find('#UserName').val();
    var userPass = $($this).parent().find('#inputPassword').val();

    $.ajax({
        type: 'POST',
        url: ajax.ajax_url,
        data: {
            action: "loginMember",
            userName: userName,
            userPass: userPass
        },
        dataType: 'html',
        success: function (data) {
            //$("#response").html(data);

            if (data) {
                var result = jQuery.parseJSON(data);

                if (result.success == false) {
                    $("#response").addClass('text-danger text-center text-16');
                    $("#response").html(result.msg);
                }
                if (result.success == true) {
                    location.reload();
                }
            } else {
                $("#response").html(data);
            }
            //location.reload();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        },
        complete: function () {
        }
    });
    return false;
}

function SaveProfile($this,e,$ajax){

    var userEmail = $('#hiddenEmail').val();

    var sent = $.makeArray($('input[name="email_pref[]"]:checkbox:checked').map(function() { return $(this).val() }));
    // console.log(obj);
    var emailPref = sent.toString();

    $.ajax({
        type: 'POST',
        url: ajax.ajax_url,
        data: {
            action: "SaveprofileSettings",
            userEmail: userEmail,
            emailPref: emailPref,
        },
        dataType: 'html',
        success: function (data) {
            $(".responsepfofile").html('<span class="text-success text-16">Successfully changed email Preferences</span>');
            // $(".responsepfofile").html(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        },
        complete: function () {
        }
    });
    return false;
}

function emailIsValid(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
}

function passwordStrong(password) {
    var mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");
    return mediumRegex.test(password);
}

function RegisterUser($this,e,$ajax){
    var userName =  $('#UserNameRe').val();
    var userEmail =  $('#inputEmailRe').val();
    var userPass =  $('#inputPasswordRe').val();
    var newsletterConsent =  $('#checknewsletter').prop('checked') === false ? false : true;
    var userPasstwo =  $('#inputPasswordReseond').val();
    var errortext =  $("#register-box");
    var visitorsISO =  $("#visitorsISO").val();
    var captchResponse = $('#g-recaptcha-response').val();

   

    if(passwordStrong(userPass) !== true){
        errortext.addClass('text-danger text-center text-16');
        errortext.text('Password must contain six characters or more and has at least one lowercase and one uppercase alphabetical character');
        return false;
    }
    if($("#checkterms").prop('checked') === false){
        errortext.addClass('text-danger text-center text-16');
        errortext.text('You must accept your terms and conditions to register');
        return false;
    }
    if(!userName){
        $($this).parent('#register-form').find('#UserNameRe').after('<b class="text-12" style="color:red;">Please username field cannot be empty.</b>');
        return false;
    }else if(!userEmail){
        $($this).parent('#register-form').find('#inputEmailRe').after('<b class="text-12" style="color:red;">Email field cannot be empty.</b>');
        return false;
    }
    else if(!userPass){
        $($this).parent('#register-form').find('#inputPasswordRe').after('<b class="text-12" style="color:red;">Field cannot be empty.</b>');
        return false;
    }
    if(captchResponse.length === 0 ){
        $(".captcha-error").html('Please verify the captcha it cannot be empty!');
    } else {
        if (emailIsValid(userEmail) === true) {

            $(".ajaxload").show();

            $.ajax({
                type: 'POST',
                url: ajax.ajax_url,
                data: {
                    action: "signUpUse",
                    userName: userName,
                    userEmail: userEmail,
                    userPass: userPass,
                    userPasstwo: userPasstwo,
                    newsletterConsent: newsletterConsent,
                    visitorsISO: visitorsISO,
                },
                dataType: 'html',
                success: function (data) {
                    $(".ajaxload").hide();
                    var result = jQuery.parseJSON(data);
                    if (!result.success) {
                        errortext.addClass('text-danger text-center text-16');
                        errortext.html(result.msg);
                    }
                    if (result.success === true) {
                        $(".modal-register-body").html('<span class="text-success text-center">An activation email has been sent to your address</span>');
                        // window.location = "https://localhost/dev.best50casino.com/user-success";
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                },
                complete: function () {
                }
            });
        } else {
            errortext.addClass('text-danger text-center text-16');
            errortext.text('Please fill in a valid email address');
        }
    }
    return false;
}

var modalConfirm = function(callback){
    $("#btn-confirm").on("click", function(){
        $("#logout-modal").modal('show');
    });

    $("#modal-btn-yes").on("click", function(){
        callback(true);
        $("#logout-modal").modal('hide');
    });

    $("#modal-btn-no").on("click", function(){
        callback(false);
        $("#logout-modal").modal('hide');
    });
};

modalConfirm(function(confirm){
    if(confirm){
        // var ajax = {"ajax_url": "https://\/dev.best50casino.com\/wp-admin\/admin-ajax.php"};
        var ajax = {"ajax_url": "https://\/www.best50casino.com\/wp-admin\/admin-ajax.php"};
        // var ajax = {"ajax_url": "https://\/localhost/dev.best50casino.com\/wp-admin\/admin-ajax.php"};

        $.ajax({
            type: 'POST',
            url: ajax.ajax_url,
            data: { action: "logout_user" },
            dataType: 'html',
            success: function (data) {
                window.location = "https://www.best50casino.com/";
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            },
            complete: function () {
            }
        });

    }
});


function SendResetLink(e,$this,$ajax) {

    var email= $('#emailForgot').val();
    var response = $('#responseReset');

    $(".ajaxload").show();

    jQuery.ajax({
        type: 'POST',
        url: ajax.ajax_url,
        data: {
            action: "send_reset_link",
            email:email
        },
        dataType: 'html',
        beforeSend: function () {
        },
        success: function (data) {
            response.append(data);
            $(".ajaxload").hide();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            // $("#ajaxLoader").hide();
            console.log(thrownError);
        },
        complete: function (data) {
            //console.log(data);
        }
    });
}

function updatePassword(e,$this,$ajax) {

    var passwordone= $('#ResetPasone').val();
    var passwordtwo= $('#ResetPastwo').val();
    var emailFor = $('#UserIDf').val();
    var keyfo= $('#keyFor').val();

    jQuery.ajax({
        type: 'POST',
        url: ajax.ajax_url,
        data: {
            action: "update_password",
            passwordone:passwordone,
            passwordtwo:passwordtwo,
            keyfo:keyfo,
            emailFor:emailFor
        },
        dataType: 'html',
        beforeSend: function () {
        },
        success: function (data) {
            $('.errorForgot').html(data);
            //sitegames.show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            // $("#ajaxLoader").hide();
            console.log(thrownError);
        },
        complete: function (data) {
            //console.log(data);
        }
    });
}