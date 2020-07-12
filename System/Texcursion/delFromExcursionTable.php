<?php
	session_start();
	include '../db_connect_conf.php';
	$idExcursion = $_GET['cell'];
		
	$excursion_name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT EName FROM excursion WHERE idExcursion='$idExcursion'"));
	$EName = $excursion_name['EName'];
	$qO = "ALTER TABLE office DROP COLUMN `$EName`";
	$qPT = "ALTER TABLE ptime DROP COLUMN `$EName`";
	
	
	$query = "DELETE FROM excursion WHERE idExcursion='$idExcursion'";
	
	echo $EName.'</br>';
	echo $qO.'</br>';
	echo $qPT.'</br>';
	echo $query.'</br>';
	
	//$office_column = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `$EName` FROM office WHERE 1"));
	if (mysqli_query($conn, "SELECT `$EName` FROM office WHERE 1"))
		mysqli_query($conn, $qO) or die(mysqli_error($conn));
	
	//$ptime_column = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `$EName` FROM office WHERE 1"));
	if (mysqli_query($conn, "SELECT `$EName` FROM office WHERE 1"))
		mysqli_query($conn, $qPT) or die(mysqli_error($conn));
	
	//echo $office_column.'</br>';
	//echo $ptime_column.'</br>';
	
	$result = mysqli_query($conn, $query) or die (mysqli_error($conn));
	header('Location: viewExcursionTable.php');

	mysqli_close($conn); //Make sure to close out the database connection
?>