<?php
$bonusid = $_POST['bonusid'];
$localISO = $_POST['country'];
//$bonus = get_casino_bonus($casinoID, $localISO);
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta NAME="robots" content="noindex, nofollow">
    <title>Best50casino.com</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="/wp-content/themes/@best50casino/assets/images/favicon.png">

    <style>
        .loader {
            border: 16px solid #f3f3f329; /* Light grey */
            border-top: 16px solid #03898f; /* Blue */
            border-bottom: 16px solid #03898f; /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
            margin-bottom:20px;
            margin: 0 auto 20px auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
<body style="width:100%;background: url(/wp-content/themes/@best50casino/assets/images/exit-page-bg.jpg) no-repeat;background-size: cover;">
<div class="container" >
    <div class="row">
        <div class="redirect col-12 text-center">
            <img src="/wp-content/themes/best50casino.com/assets/images/best50casino-logo.svg" alt="best50casino.com" width="400" style="margin-top:60px;" />
                <h1 style="font-size:32px;font-weight:600;color:white;">Thank you for visiting best50casino.com</h1>
                <div class="" style="">
                    <div class="promo-details-amount" style="">
                        ' .$mainBonusText.'
                    </div>
                    <div style="border: 1px dashed red;padding: 3px 12px;margin: 10px 0;">
                            '.$bonusCode.'
                            </div>
                </div>
                <div class="loader">
                </div>
                <p style="font-size:18px;"><a style="color:#ffcd00;" href="'.$_POST["link"].'" rel="nofollow">You are being redirected to the website...</a></p>
        </div>
    </div>
</div>
<script>
    setTimeout(function(){
        window.location = "'.$_POST["link"].'";
    }, 2500 );
</script>
</body>
</html>';
