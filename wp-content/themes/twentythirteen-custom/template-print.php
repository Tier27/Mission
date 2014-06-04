<?php //Template Name: Print

$datefield = preg_replace( '/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/', '$3-$1-$2', $_GET['date'] );
$date = new rvDate( $datefield );
?>
<table>
<tr><th></th><th>Name</th><th>Lanes</th></tr>
<?php
foreach( $date->reservations as $RID ) {
	$reservation = new rvReservation( $RID );
	$reservations[] = $reservation;
}
foreach( $date->hours as $hour ) {
?>
	<tr style="font-weight: bold; outline: solid 2px black"><td><?php echo rvFormat::military_hour( $hour ); ?></td</tr>
<?php
	foreach( $reservations as $reservation ) if( in_array( $hour, $reservation->hours ) ) {
		?><tr><td></td><td><?php echo $reservation->name; ?></td><td style="text-align: right"><?php echo count( $reservation->lanes ); ?></td></tr><?php
	}
}
?>
</table>
<style>
td { min-width: 100px; }
</style>

