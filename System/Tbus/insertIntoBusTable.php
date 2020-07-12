<?php
	session_start();
	include '../db_connect_conf.php';
	
	//if (is_numeric($_POST['idBus']) && is_numeric($_POST['Seats']) && $_POST['idBus']>0 && $_POST['Seats']>0){
	if (is_numeric($_POST['Seats']) && $_POST['Seats']>0){
		//$idBus = $_POST['idBus'];
		$Seats = mysqli_real_escape_string($conn, $_POST['Seats']);
		
		$q1 = mysqli_query($conn, "SELECT count(Seats) FROM BUS WHERE Seats='$Seats'") or die(mysqli_error($conn));
		$r1 = mysqli_fetch_assoc($q1);
		$duplicate_finder = intval($r1['count(Seats)']);
		if ($duplicate_finder==0)
			$BName = $Seats;
		else if ($duplicate_finder>0)
			$BName = $Seats.'('.($duplicate_finder+1).')';
		
		$query = "INSERT INTO bus(BName, Seats) VALUES('$BName', '$Seats')";		
		$result = mysqli_query($conn, $query) or die (mysqli_error($conn));
		//mysqli_query($conn, "ALTER TABLE bus_assignment ADD `bus_$BName` INT(2)  NOT NULL DEFAULT '01' after ExcursionDate") or die (mysqli_error($conn));
		header('Location: viewBusTable.php');
	}
	else
		header('Location: viewBusTable.php?error=Invalid seats number!');

	mysqli_close($conn); //Make sure to close out the database connection
?>