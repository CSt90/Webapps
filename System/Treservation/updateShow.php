<?php
	session_start();
	include '../db_connect_conf.php';
	
	if(isset($_POST['noshow'])){
		if ($_POST['noshow'] == 'x')
			$show = 0;
		else
			$show = 1;
		$resid = mysqli_real_escape_string($conn, $_POST['resid']);
		mysqli_query($conn, "UPDATE reservations SET Noshow = '$show' WHERE idReservations = '$resid'");
		print_r(1);
	}
	else
		echo "Error";
	
	mysqli_close($conn);
?>