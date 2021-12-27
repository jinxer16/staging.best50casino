<?php

define( 'SMTP_HOST', 'smtp.zoho.eu' );  // A2 Hosting server name. For example, "a2ss10.a2hosting.com"
define( 'SMTP_AUTH', true );
define( 'SMTP_PORT', '587' );
define( 'SMTP_SECURE', 'tls' );
define( 'SMTP_USERNAME', 'support@best50casino.com' );  // Username for SMTP authentication
define( 'SMTP_PASSWORD', 'N&7sB9sICi@50' );          // Password for SMTP authentication
define( 'SMTP_FROM',     'support@best50casino.com' );  // SMTP From address
define( 'SMTP_FROMNAME', 'Best 50 Casino' );         // SMTP From name

add_action( 'phpmailer_init', 'send_smtp_email' );
function send_smtp_email( $phpmailer ) {
    $phpmailer->isSMTP();
    $phpmailer->Host       = SMTP_HOST;
    $phpmailer->SMTPAuth   = SMTP_AUTH;
    $phpmailer->Port       = SMTP_PORT;
    $phpmailer->SMTPSecure = SMTP_SECURE;
    $phpmailer->Username   = SMTP_USERNAME;
    $phpmailer->Password   = SMTP_PASSWORD;
    $phpmailer->From       = SMTP_FROM;
    $phpmailer->FromName   = SMTP_FROMNAME;
}