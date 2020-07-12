<?php // change all to mysqli format
	session_start();
	include '../db_connect_conf.php';
	
	$exc = $_POST['exc'];
	$date = mysqli_real_escape_string($conn, date("Y-m-d", strtotime($_POST['sdate'])));
	$total_passengers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT (sum(Adults)+sum(Kids))AS sum FROM reservations WHERE ExcursionID='$exc' AND ExDate='$date'"));
	$total_seats = mysqli_fetch_assoc(mysqli_query($conn, "SELECT sum(buses.Seats) AS tseats FROM (SELECT DISTINCT `BusID`, bus.Seats FROM `bus_assignment` INNER JOIN bus WHERE `ExcursionID`=$exc AND `ExcursionDate`='$date' AND bus.idBus=bus_assignment.BusID) AS buses"));
	$available = $total_seats['tseats'] - $total_passengers['sum'];
	if ($available>0)
		echo $available;
	else
		echo 'Unknown. No buses assigned for this excursion yet';
?>