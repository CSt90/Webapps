<?php
	session_start();
	include 'db_connect_conf.php';
	if (isset($_POST['exdate']) && DateTime::createFromFormat('d-m-Y', $_POST['exdate']) !== FALSE){
		$date = mysqli_real_escape_string($conn, $_POST['exdate']);
		$exdate = date("Y-m-d", strtotime($date));
		$excs = array();
		$day = date("D", strtotime($date)); // day of the week for the given date
		//fetch all excursions for the day of the given date e.g. Monday
		$sqlGetExcs = mysqli_query($conn, "SELECT idExcursion FROM excursion WHERE $day = '1'");
		//print_r($excs['idExcursion']); 
		while($ex = mysqli_fetch_array($sqlGetExcs)){
			array_push($excs, $ex['idExcursion']);
		}
		echo (json_encode($excs));
		//echo $day;
	}else
		echo json_encode("Error. Incorrect date.");
	mysqli_close($conn);
?>	