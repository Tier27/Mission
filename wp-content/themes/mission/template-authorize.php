<?php 
// Template Name: AuthorizeNet
//$reservation = new rvReservation( $_GET['ID'] );
echo 'something!';
if ( $_POST['x_response_code'] == 1 ) { 
	$reservation->update( 'status', 'paid' );
	$reservation->update( 'paid', '$' . $reservation->price );
}
$url = "http://YOUR_DOMAIN.com/direct_post.php";
$api_login_id = '37M839anFv5';
$transaction_key = '6D58sy67W4U2Eehb';
$transaction = new AuthorizeNetAIM($api_login_id, $transaction_key);
print_r( $transaction );
echo 'nothing!';
$transaction->amount = '8.99';
$transaction->card_num = '4007000000027';
$transaction->exp_date = '10/16';

/*
$response = $transaction->authorizeAndCapture();
print_r( $response );

if ($response->approved) {
  echo "<h1>Success! The test credit card has been charged!</h1>";
  echo "Transaction ID: " . $response->transaction_id;
} else {
  echo $response->error_message;
}
*/
