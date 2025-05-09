<?php 
// PayPal configuration 
define('PAYPAL_ID', 'sb-wfbaq31503397@business.example.com'); 
define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE 
define('PAYPAL_RETURN_URL', 'https://rahultomar.com/new-jps/checkout/payment-confirmed.php'); 
define('PAYPAL_CANCEL_URL', 'https://rahultomar.com/new-jps/checkout/payment-failed.php'); 
define('PAYPAL_CURRENCY', 'USD'); 
// Change not required 
define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");
?>