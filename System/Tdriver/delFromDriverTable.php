<?php
	session_start();
	include '../db_connect_conf.php';
	$idDriver = $_GET['cell'];
		
	$query = "DELETE FROM driver WHERE idDriver='$idDriver'";
	
	$result = mysqli_query($conn, $query) or die (mysqli_error($conn));
	header('Location: viewDriverTable.php');

	mysqli_close($conn); //Make sure to close out the database connection
?>