<?php
	session_start();
	include '../db_connect_conf.php';
	
	$error = 'Invalid commission!';
	
	if (is_numeric($_POST['idOffice']) && is_string($_POST['OName']) && $_POST['idOffice']>0){ //&& is_numeric($_POST['Commission'])//$_POST['Excursion']>0 maybe ppoint not attached to excursion
		$idOffice = mysqli_real_escape_string($conn, $_POST['idOffice']);
		$OName = mysqli_real_escape_string($conn, $_POST['OName']);
		
		$query = "INSERT INTO office(idOffice, OName) VALUES('$idOffice', '$OName')"; //, '$Commission'
		
		$result = mysqli_query($conn, $query);
		if ($result)
			header('Location: viewOfficeTable.php');
		else // or die (mysqli_error($conn));
			header('Location: viewOfficeTable.php?error='.mysqli_error($conn));
	}
	else{
		if (!is_numeric($_POST['Commission']))
			header('Location: viewOfficeTable.php?error=Commission must be a number!');
		else
			header('Location: viewOfficeTable.php?error='.$error);
	}

	mysqli_close($conn); //Make sure to close out the database connection
?>