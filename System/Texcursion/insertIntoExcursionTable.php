<?php
	session_start();
	include '../db_connect_conf.php';

	$days = '0, 0, 0, 0, 0, 0, 0';

	if (is_numeric($_POST['idExcursion']) && is_string($_POST['EName']) && isset($_POST['day']) && isset($_POST['Stime']) && isset($_POST['Etime']) && isset($_POST['EPrice']) && is_string($_POST['Stime']) && is_string($_POST['Etime']) && $_POST['idExcursion']>0 && $_POST['EName']!=null && is_numeric($_POST['EPrice']) && $_POST['EPrice']>0){
		$idExcursion = mysqli_real_escape_string($conn, $_POST['idExcursion']);
		$EName = mysqli_real_escape_string($conn, $_POST['EName']);
		$EPrice = mysqli_real_escape_string($conn, $_POST['EPrice']);
    $Stime = mysqli_real_escape_string($conn, $_POST['Stime']);
    $Etime = mysqli_real_escape_string($conn, $_POST['Etime']);
		$direction = mysqli_real_escape_string($conn, $_POST['select_direction']);

		foreach($_POST['day'] as $val){
			if ($val == 1)
				$days[0] = "1";
			else if ($val == 2)
				$days[3] = "1";
			else if ($val == 3)
				$days[6] = "1";
			else if ($val == 4)
				$days[9] = "1";
			else if ($val == 5)
				$days[12] = "1";
			else if ($val == 6)
				$days[15] = "1";
			else
				$days[18] = "1";
		}
		mysqli_query($conn, "ALTER TABLE ptime ADD COLUMN `$EName` VARCHAR(5)");
    	mysqli_query($conn, "UPDATE ptime SET `$EName` = '00:00'");
		mysqli_query($conn, "UPDATE ptime SET `$EName` = $direction WHERE PPointGroup=0");
		mysqli_query($conn, "ALTER TABLE office ADD COLUMN `$EName` DECIMAL(10, 2)");
    	mysqli_query($conn, "UPDATE office SET `$EName` = '0.00'");
		$query = "INSERT INTO excursion VALUES('$idExcursion', '$EName', NULL, ".$days.", '$Stime', '$Etime', '$EPrice')";

		$result = mysqli_query($conn, $query);
		if ($result)
			header('Location: viewExcursionTable.php');
		else //or die (mysqli_error($conn));
			header('Location: viewExcursionTable.php?error='.mysqli_error($conn));
	}
	else{
		if (!is_numeric($_POST['EPrice']))
			$error = 'Error! Price must be a number!';
		else if ($_POST['EPrice']<=0)
			$error = 'Error! Price must be greater than zero!';
		else
			$error = 'Insert error! Invalid values, please try again';
		header('Location: viewExcursionTable.php?error='.$error);
	}

	mysqli_close($conn); //Make sure to close out the database connection
?>
