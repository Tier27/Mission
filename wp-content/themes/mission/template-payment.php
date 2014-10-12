<? /** Template Name: Payment **/ ?>
<?php
	if( empty($_POST) ) wp_redirect( home_url() );
?>
<?php get_header(); ?>
<?php extract( $_POST ); ?>
<?php //print_r( $_POST ); ?>
<?php $tdu = get_template_directory_uri(); ?>
<?php $pagename='event'; ?>
<link type="text/css" rel="stylesheet" href="<?php echo $tdu; ?>/css/event.css">
<link type="text/css" rel="stylesheet" href="<?php echo $tdu; ?>/css/payment.css">
<link href='http://fonts.googleapis.com/css?family=Bree+Serif' rel='stylesheet' type='text/css'>
<body>
<div class="clear"></div>

<div id="plan-event">

<div class="container">

	<h2 class="dots"><span class="dots">Bowling Information</span><div class="stripe-line"> </div></h2>
	<!--Date-->
	<div class="plan-event-contact-title">
		<p>Date:</p>
	</div>
	<div class="plan-event-contact-input bowling-output">
		<?php echo $date; ?>
	</div>
	<div class="clear"></div>

	<!--Bowlers-->
	<div class="plan-event-contact-title">
		<p>Bowlers:</p>
	</div>
	<div class="plan-event-contact-input bowling-output">
		<?php echo $bowlers; ?>
	</div>
	<div class="clear"></div>

	<!--Lanes-->
	<div class="plan-event-contact-title">
		<p>Lanes:</p>
	</div>
	<div class="plan-event-contact-input bowling-output">
		<?php echo $lanes; ?>
	</div>
	<div class="clear"></div>

	<!--Start-->
	<div class="plan-event-contact-title">
		<p>Start Time:</p>
	</div>
	<div class="plan-event-contact-input bowling-output">
		<?php echo rvFormat::military_hour($start); ?>
	</div>
	<div class="clear"></div>

	<!--Hours-->
	<div class="plan-event-contact-title">
		<p>Hours:</p>
	</div>
	<div class="plan-event-contact-input bowling-output">
		<?php echo $hours; ?>	
	</div>
	<div class="clear"></div>

	<!--Price-->
	<div class="plan-event-contact-title">
		<p>Price:</p>
	</div>
	<div class="plan-event-contact-input bowling-output">
		<?php echo $price; ?>	
	</div>
	<div class="clear"></div>

	<!--Transaction ID-->
	<span id="transaction-number-container" style="display: none">
	<div class="plan-event-contact-title">
		<p>Confirmation #:</p>
	</div>
	<div class="plan-event-contact-input bowling-output" id="transaction-number">
		<?php echo $price; ?>	
	</div>
	<div class="clear"></div>
	</span>

	<div class="alert-box" id="alert-message">
		Please fill out the payment information below in order to make your reservation.
	</div> <!--/.alert-box -->

<span id="payment-container">
<form class="payment" id="payment-form">
	<h2 class="dots"><span class="dots">Payment Information</span><div class="stripe-line"> </div></h2>
	<!--First Name-->
	<div class="plan-event-contact-title">
		<p>First Name:</p>
	</div>
	<div class="plan-event-contact-input">
		<input type="text" name="first_name" placeholder="Andrew" value="<?php echo $name['first']; ?>">
	</div>
	<div class="clear"></div>

	<!--Last Name-->
	<div class="plan-event-contact-title">
		<p>Last Name:</p>
	</div>
	<div class="plan-event-contact-input">
		<input type="text" name="last_name" placeholder="Smith" value="<?php echo $name['last']; ?>">
	</div>
	<div class="clear"></div>

	<!--Company-->
	<div class="plan-event-contact-title">
		<p>Company:</p>
	</div>
	<div class="plan-event-contact-input">
		<input type="text" name="company" value="<?php echo $company; ?>">
	</div>
	<div class="clear"></div>

	<!--Phone-->
	<div class="plan-event-contact-title">
		<p>Phone:</p>
	</div>
	<div class="plan-event-contact-input">
		<input type="text" name="phone" value="<?php echo $phone; ?>">
	</div>
	<div class="clear"></div>

	<!--Email-->
	<div class="plan-event-contact-title">
		<p>Email:</p>
	</div>
	<div class="plan-event-contact-input">
		<input type="text" name="email" placeholder="example@gmail.com" value="<?php echo $email; ?>">
	</div>
	<div class="clear"></div>

	<!--Address-->
	<div class="plan-event-contact-title">
		<p>Address:</p>
	</div>
	<div class="plan-event-contact-input">
		<input type="text" name="address" placeholder="1376 17th Street">
	</div>
	<div class="clear"></div>

	<!--City-->
	<div class="plan-event-contact-title">
		<p>City:</p>
	</div>
	<div class="plan-event-contact-input">
		<input type="text" name="city" placeholder="San Francisco">
	</div>
	<div class="clear"></div>

	<!--State-->
	<div class="plan-event-contact-title">
		<p>State:</p>
	</div>
	<div class="plan-event-contact-input">
		<select name="state">
			<option value="AL">Alabama</option>
			<option value="AK">Alaska</option>
			<option value="AZ">Arizona</option>
			<option value="AR">Arkansas</option>
			<option value="CA">California</option>
			<option value="CO">Colorado</option>
			<option value="CT">Connecticut</option>
			<option value="DE">Delaware</option>
			<option value="DC">District Of Columbia</option>
			<option value="FL">Florida</option>
			<option value="GA">Georgia</option>
			<option value="HI">Hawaii</option>
			<option value="ID">Idaho</option>
			<option value="IL">Illinois</option>
			<option value="IN">Indiana</option>
			<option value="IA">Iowa</option>
			<option value="KS">Kansas</option>
			<option value="KY">Kentucky</option>
			<option value="LA">Louisiana</option>
			<option value="ME">Maine</option>
			<option value="MD">Maryland</option>
			<option value="MA">Massachusetts</option>
			<option value="MI">Michigan</option>
			<option value="MN">Minnesota</option>
			<option value="MS">Mississippi</option>
			<option value="MO">Missouri</option>
			<option value="MT">Montana</option>
			<option value="NE">Nebraska</option>
			<option value="NV">Nevada</option>
			<option value="NH">New Hampshire</option>
			<option value="NJ">New Jersey</option>
			<option value="NM">New Mexico</option>
			<option value="NY">New York</option>
			<option value="NC">North Carolina</option>
			<option value="ND">North Dakota</option>
			<option value="OH">Ohio</option>
			<option value="OK">Oklahoma</option>
			<option value="OR">Oregon</option>
			<option value="PA">Pennsylvania</option>
			<option value="RI">Rhode Island</option>
			<option value="SC">South Carolina</option>
			<option value="SD">South Dakota</option>
			<option value="TN">Tennessee</option>
			<option value="TX">Texas</option>
			<option value="UT">Utah</option>
			<option value="VT">Vermont</option>
			<option value="VA">Virginia</option>
			<option value="WA">Washington</option>
			<option value="WV">West Virginia</option>
			<option value="WI">Wisconsin</option>
			<option value="WY">Wyoming</option>
		</select>	
	</div>
	<div class="clear"></div>

	<!--Zip-->
	<div class="plan-event-contact-title">
		<p>Zip:</p>
	</div>
	<div class="plan-event-contact-input">
		<input type="text" name="zip" placeholder="94117">
	</div>
	<div class="clear"></div>

	<!--Card No.-->
	<div class="plan-event-contact-title">
		<p>Card Number:</p>
	</div>
	<div class="plan-event-contact-input">
		<input type="text" name="card-number" placeholder="XXXX-XXXX-XXXX-XXXX">
	</div>
	<div class="clear"></div>

	<!--Expiration Date-->
	<div class="plan-event-contact-title">
		<p>Expiration Date:</p>
	</div>
	<div class="plan-event-contact-input">
		<select name="expiry_month">
                <option value="01">Jan (01)</option>
                <option value="02">Feb (02)</option>
                <option value="03">Mar (03)</option>
                <option value="04">Apr (04)</option>
                <option value="05">May (05)</option>
                <option value="06">June (06)</option>
                <option value="07">July (07)</option>
                <option value="08">Aug (08)</option>
                <option value="09">Sep (09)</option>
                <option value="10">Oct (10)</option>1
                <option value="11">Nov (11)</option>
                <option value="12">Dec (12)</option>
              </select>
             <select name="expiry_year">
                <option value="14">2014</option>
                <option value="15">2015</option>
                <option value="16">2016</option>
                <option value="17">2017</option>
                <option value="18">2018</option>
                <option value="19">2019</option>
                <option value="20">2020</option>
                <option value="21">2021</option>
                <option value="22">2022</option>
                <option value="23">2023</option>
              </select>
	</div>
	<div class="clear"></div>

	<!--CVV-->
	<div class="plan-event-contact-title">
		<p>Card CVV:</p>
	</div>
	<div class="plan-event-contact-input">
		<input type="password" name="cvv" placeholder="XXX">
	</div>
	<div class="clear"></div>

	<input name="amount" class="hide" value="<?php echo number_format(str_replace('$','',$price), 2); ?>">
	<input name="action" class="hide" value="process_authorize_transaction">
	<input name="ID" class="hide" value="<?php echo $ID; ?>">
	<button type="button" name="submit" class="btn btn-default" id='submit-contact'>Submit</button>
	<br>
	<br>
	<div id="response-text" style="color: #b5121b;"></div>

</form>

</span>

</div>
<script>
var reservationID = <?php echo isset( $ID ) ? $ID : -1; ?>;
function pend_unload() {
	$.post(ajaxurl, { action: 'pend_reservation', id: <?php echo isset( $ID ) ? $ID : -1; ?> }, function(res){
	});
}
jQuery(function($) {
	$(window).bind('beforeunload', pend_unload);
});
</script>

</div>
<?php include ('F.php'); ?>
</body>
</html>
<?php get_footer(); ?>
<script>
jQuery(function($){
		$('.payment').find('button[name="submit"]').click( function() {

			var ajaxdata = {
				action:		'process_authorize_transaction',
				first_name:	$('#payment-first-name').val(),
				last_name:	$('#payment-last-name').val(),
				company:	$('#payment-company').val(),
				phone:		$('#payment-phone').val(),
				email:		$('#payment-email').val(),
				address:	$('#payment-address').val(),
				city:		$('#payment-city').val(),
				state:		$('#payment-state').val(),
				zip:		$('#payment-zip').val(),
			};
			ajaxdata = $(this).closest('form').serialize();
			global_data.ajaxdata = ajaxdata;

			$.post( ajaxurl, ajaxdata, function(res){
				res = $.parseJSON(res);
				if(res.approved == true) {
					$(window).unbind('beforeunload');
					$('#payment-container').slideUp();
					$('#transaction-number').html(res.transaction_id);
					$('#transaction-number-container').slideDown();
					$('#alert-message').html('Thank you! Your payment has been successfully processed.');
				}
				global_data.response = res;
				console.log(res.approved);
			});
		});
});
</script>
