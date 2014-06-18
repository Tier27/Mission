<?php 
//$url = "http://YOUR_DOMAIN.com/direct_post.php";
//$api_login_id = '4SBU7u8rUvRe';
//$transaction_key = '54x59TSnP6SBbj4W';
//$md5_setting = '4SBU7u8rUvRe'; // Your MD5 Setting
//$amount = "5.99";
//AuthorizeNetDPM::directPostDemo($url, $api_login_id, $transaction_key, $amount, $md5_setting);
//<?php
//require_once 'anet_php_sdk/AuthorizeNet.php'; // Include the SDK you downloaded in Step 2
$api_login_id = '37M839anFv5';
$transaction_key = '6D58sy67W4U2Eehb';
$amount = "5.99";
$fp_timestamp = time();
$fp_sequence = "123" . time(); // Enter an invoice or other unique number.
$fingerprint = AuthorizeNetSIM_Form::getFingerprint($api_login_id,
  $transaction_key, $amount, $fp_sequence, $fp_timestamp)
?>

<form method='post' action="https://test.authorize.net/gateway/transact.dll">
<input type='hidden' name="x_login" value="<?php echo $api_login_id?>" />
<input type='hidden' name="x_fp_hash" value="<?php echo $fingerprint?>" />
<input type='hidden' name="x_amount" value="<?php echo $amount?>" />
<input type='hidden' name="x_fp_timestamp" value="<?php echo $fp_timestamp?>" />
<input type='hidden' name="x_fp_sequence" value="<?php echo $fp_sequence?>" />
<input type='hidden' name="x_version" value="3.1">
<input type='hidden' name="x_show_form" value="payment_form">
<input type='hidden' name="x_test_request" value="false" />
<input type='hidden' name="x_method" value="cc">
<input type='hidden' name="x_receipt_link_method" value="POST">
<input type='hidden' name="x_receipt_link_text" value="Return to MBC">
<input type='hidden' name="x_receipt_link_url" value="http://development.tier27.com/Mission">
<input type='submit' value="Click here for the secure payment form">
</form>
