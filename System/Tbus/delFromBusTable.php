<?php
	session_start();
	include '../db_connect_conf.php';
	$BName = $_GET['cell'];
		
	$query = "DELETE FROM bus WHERE BName='$BName'";	
	
	$result = mysqli_query($conn, $query) or die (mysqli_error($conn));
	//mysqli_query($conn, "ALTER TABLE bus_assignment DROP COLUMN `bus_$BName`") or die (mysqli_error($conn));
	header('Location: viewBusTable.php');

	mysqli_close($conn); //Make sure to close out the database connection
?>