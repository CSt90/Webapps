<?php
	session_start();
	include '../db_connect_conf.php';
	
	if (is_numeric($_POST['idDriver']) && is_string($_POST['DName']) && $_POST['idDriver']>0){
		$idDriver = mysqli_real_escape_string($conn, $_POST['idDriver']);
		$DName = mysqli_real_escape_string($conn, $_POST['DName']);
		
		$query = "INSERT INTO driver VALUES('$idDriver', '$DName')";
		
		$result = mysqli_query($conn, $query) or die (mysqli_error($conn));
		header('Location: viewDriverTable.php');
	}
	else
		header('Location: viewDriverTable.php?error=Invalid values!');

	mysqli_close($conn); //Make sure to close out the database connection
?>