<?php
	session_start();
	include '../db_connect_conf.php';
	$idOffice = $_GET['cell'];
		
	$query = "DELETE FROM office WHERE idOffice='$idOffice'";
	
	$result = mysqli_query($conn, $query) or die (mysqli_error($conn));
	header('Location: viewOfficeTable.php');

	mysqli_close($conn); //Make sure to close out the database connection
?>