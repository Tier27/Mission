<?php 
$fields = array(
	"name" => "Name",
	"company" => "Company",
	"lanes" => "Lanes",
	"bowlers" => "Bowlers", 
	"phone" => "Phone",
	"email" => "Email",
	//"balance-paid" => "Paid", 
	"balance" => "Due", 
	"created" => "Created",
	"modified" => "Modified",
	"status" => "Status",
	"made_by" => "Creator",
	//"notes" => "Notes", 
); 
?>
<div id="reservation-closeup">
<div class="container">
<div class="row">
<?php foreach( $fields as $field => $display ) : ?>
<div class="col-md-1 <?php echo $field; ?> key"><?php echo $display; ?></div>
<?php endforeach; ?>
</div>
<div class="row">
<?php foreach( $fields as $field => $display ) : ?>
<div class="col-md-1 <?php echo $field; ?> value"><?php echo $display; ?></div>
<?php endforeach; ?>
</div>
</div>
<table class="hide">
<tr>
<?php foreach( $fields as $field => $display ) : ?>
<th class="<?php echo $field; ?> key"><?php echo $display; ?></th>
<?php endforeach; ?>
</tr>
<tr>
<?php foreach( $fields as $field => $display ) : ?>
<td class="<?php echo $field; ?> value"><?php echo $display; ?></td>
<?php endforeach; ?>
</tr>
<?php foreach( $fields as $field => $display ) : continue; ?>
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
	left: 0px;
	background: white;
	width: 100%;
	border: solid 1px black;
}
</style>
<script>
</script>
