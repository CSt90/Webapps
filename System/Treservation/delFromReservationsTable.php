<?php
	session_start();
	include '../db_connect_conf.php';
	$idReservations = $_GET['cell'];
		
	$query = "DELETE FROM reservations WHERE idReservations='$idReservations'";
	
	$result = mysqli_query($conn, $query) or die (mysqli_error($conn));
	//header('Location: viewPickupTable.php');

	mysqli_close($conn); //Make sure to close out the database connection
?>