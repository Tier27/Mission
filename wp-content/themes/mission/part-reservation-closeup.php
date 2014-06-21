<?php 
$fields = array(
	"name" => "Name",
	"company" => "Company",
	"lanes" => "Lanes",
	"bowlers" => "Bowlers", 
	"phone" => "Phone",
	"email" => "Email",
	"balance-paid" => "Paid", 
	"balance" => "Due", 
	"created" => "Created",
	"status" => "Status",
	"made_by" => "Created by",
	"notes" => "Notes", 
); 
?>
<div id="reservation-closeup">
<table>
<?php foreach( $fields as $field => $display ) : ?>
<tr class="<?php echo $field; ?>">
<td class="key"><?php echo $display; ?></td>
<td class="value"></td>
</tr>
<?php endforeach; ?>
</table>
</div>
<style>
#reservation-closeup {
	position: fixed;
	bottom: 0px;
	right: 0px;
	background: white;
	height: 300px;
	width: 200px;
	border: solid 1px black;
}
</style>
<script>
/*
jQuery(function($){
	var $wind = $('#reservation-closeup');
	$wind.hide();
	var fields = new Array("name", "company", "lanes", "bowlers", "phone", "email", "balance-paid", "balance", "created", "status", "made_by", "notes");
	var $res;
	$('.reservation').mouseover(function(){
		$res = $(this);
		$.each(fields, function(index, value){
			console.log(value);
			$wind.find('.' + value).find('.value').html($res.find('.' + value).html());
		});
		$wind.show();
	}).mouseout(function(){
		$wind.hide();
	});
});
*/
</script>
