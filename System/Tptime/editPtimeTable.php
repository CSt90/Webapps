<?php
	session_start();
	include '../db_connect_conf.php';
	
	$response = array(); // needed to be done otherwise error couldn't be detected by ajax
	
	if (isset($_POST['pk']) && is_numeric($_POST['pk'])){
		$pk = mysqli_real_escape_string($conn, $_POST['pk']);
	}
	
	if (isset($_POST['cellClass'])){
		$cell = $_POST['cellClass']; //cell class
        if ($cell == 'c1'){
			if (isset($_POST['newVal']) && is_numeric($_POST['newVal']) && $_POST['newVal']!=''){
				$newVal = mysqli_real_escape_string($conn, $_POST['newVal']); //PPoint
				$query = "UPDATE pickup SET idPickup = '$newVal' WHERE idPickup = '$pk'";
				$result = mysqli_query($conn, $query);
                if($result){
                    $response['er'] = 'success';
                    $response['msg'] = '';
                }
                else {//error
                    $response['er'] = 'error';
                    $response['msg'] = 'Pickup ID '.$newVal.' already exists!'; 
                }
			}
			else{
				$response['er'] = 'error';
				$response['msg'] = mysqli_error($conn); //'Pickup point is not correct. Try again';
			}
		}
		else if ($cell == 'c2'){
			if (isset($_POST['newVal']) && is_string($_POST['newVal']) && $_POST['newVal']!=''){
				$newVal = mysqli_real_escape_string($conn, $_POST['newVal']); //PPoint
				$query = "UPDATE pickup SET PPoint = '$newVal' WHERE idPickup = '$pk'";
				$result = mysqli_query($conn, $query) or die (mysqli_error($conn));
				$response['er'] = 'success';
				$response['msg'] = '';
			}
			else{
				$response['er'] = 'error';
				$response['msg'] = 'Pickup point is not correct. Try again';
			}
		}
		else if ($cell == 'c3'){
			if (isset($_POST['newVal']) && is_numeric($_POST['newVal']) && $_POST['newVal']!=''){
				$newVal = mysqli_real_escape_string($conn, $_POST['newVal']); //PPointGroup
				$query = "UPDATE pickup SET PPointGroup = '$newVal' WHERE idPickup = '$pk'";
				$result = mysqli_query($conn, $query);// or die (mysqli_error($conn));
				$response['er'] = 'success';
				$response['msg'] = '';
			}
			else{
				$response['er'] = 'error';
				$response['msg'] = 'Pickup Point Group is not correct. Try again';
			}
		}
	}
	mysqli_close($conn);
	echo json_encode($response); //sends $response[] to jquery ajax
?>