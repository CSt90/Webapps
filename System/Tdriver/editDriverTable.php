<?php
	session_start();
	include '../db_connect_conf.php';
	
	$response = array(); // needed to be done otherwise error couldn't be detected by ajax
	
	if (isset($_POST['pk']) && is_numeric($_POST['pk'])){
		$pk = $_POST['pk'];
	}
	
	if (isset($_POST['cellClass']) && is_string($_POST['cellClass'])){
		$cell = $_POST['cellClass']; //cell class
		if ($cell == 'c1'){
			if (isset($_POST['newVal']) && is_string($_POST['newVal']) && $_POST['newVal']!=''){
				$newVal = mysqli_real_escape_string($conn, $_POST['newVal']); //DName
				$query = "UPDATE driver SET dname = '$newVal' WHERE idDriver = $pk";
				$result = mysqli_query($conn, $query) or die (mysqli_error($conn));
				$response['er'] = 'success';
				$response['msg'] = '';
			}
			else{
				$response['er'] = 'error';
				$response['msg'] = 'Driver name is not correct. Try again';
			}
		}
	}
	mysqli_close($conn);
	echo json_encode($response); //sends $response[] to jquery ajax
?>