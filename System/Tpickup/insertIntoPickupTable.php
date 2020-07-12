<?php
	session_start();
	include '../db_connect_conf.php';

    $ppg = mysqli_fetch_assoc(mysqli_query($conn, "SELECT max(PPointGroup) AS max FROM ptime"));
    $ppg_max = $ppg['max'];

    $error = 'Invalid values! Pickup Point Group must be a number between 1 and '.$ppg_max;

    if (isset($_POST['idPickup']) && isset($_POST['PPointGroup']) && isset($_POST['PPoint']) && is_numeric($_POST['idPickup']) && is_string($_POST['PPoint']) && is_numeric($_POST['PPointGroup']) && $_POST['idPickup']>0 && $_POST['PPointGroup']>0){ //$_POST['Excursion']>0 maybe ppoint not attached to excursion
		$idPickup = mysqli_real_escape_string($conn, $_POST['idPickup']);
		$PPoint = mysqli_real_escape_string($conn, $_POST['PPoint']);
        //$PPRow = mysqli_real_escape_string($conn, $_POST['PPRow']);
		$PPointGroup = mysqli_real_escape_string($conn, $_POST['PPointGroup']);
		//$query = "INSERT INTO pickup(idPickup, PPoint, PPointGroup) VALUES('$idPickup', '$PPoint', $PPointGroup')";
		$insert = mysqli_query($conn, "INSERT INTO pickup(idPickup, PPoint, PPointGroup) VALUES($idPickup, '$PPoint', $PPointGroup)");

		if ($insert)
			header('Location: viewPickupTable.php');
		else // or die (mysqli_error($conn));
			header('Location: viewPickupTable.php?error='.$query);
			//echo $query;
	}
	else
		//header('Location: viewPickupTable.php?error='.$error); //mysqli_error($conn) $error
		echo $_POST['idPickup'].$_POST['PPointGroup'].$_POST['PPoint'];

	mysqli_close($conn); //Make sure to close out the database connection
?>