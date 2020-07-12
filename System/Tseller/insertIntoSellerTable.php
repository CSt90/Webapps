<?php
	session_start();
	include '../db_connect_conf.php';
	
	$error = 'Invalid values';
	
	if (is_numeric($_POST['idSeller']) && is_string($_POST['SName']) && $_POST['idSeller']>0){
		$idSeller = mysqli_real_escape_string($conn, $_POST['idSeller']);
		//$SOffice = mysqli_real_escape_string($conn, $_POST['SOffice']);
		$SName = mysqli_real_escape_string($conn, $_POST['SName']);
		
//		$OName = "SELECT idOffice from office WHERE OName = '$SOffice'";
//		$Of = mysqli_query($conn, $OName);
//		if ($Of){
//			if (@mysqli_num_rows($Of) == 1) {
//				$name = mysqli_fetch_array($Of);
//				$idOffice = $name["idOffice"];
//			}
//			else
//				$idOffice = false;
//		}
//		else
//			header('Location: viewSellerTable.php?error='.mysqli_error($conn));
		
//		if ($idOffice != false)
			$query = "INSERT INTO seller VALUES('$idSeller', '$SName')";
//		else
//			$error = "Office ".$_POST['SOffice']." does not exist!";
		
		$result = mysqli_query($conn, $query);
		if ($result)
			header('Location: viewSellerTable.php');
		else // or die (mysqli_error($conn));
			header('Location: viewSellerTable.php?error='.$error);
	}
	else
        header('Location: viewSellerTable.php?error='.$error);

	mysqli_close($conn); //Make sure to close out the database connection
?>