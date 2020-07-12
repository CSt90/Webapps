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
				$newVal = mysqli_real_escape_string($conn, $_POST['newVal']); //HArea
				$query = "UPDATE hotel SET HArea = '$newVal' WHERE idHotel = '$pk'";
				$result = mysqli_query($conn, $query) or die (mysqli_error($conn));
				$response['er'] = 'success';
				$response['msg'] = '';
			}
			else{
				$response['er'] = 'error';
				$response['msg'] = 'There is something wrong about the Hotel Area. Try again';
			}
		}
		else if ($cell == 'c2'){
			if (isset($_POST['newVal']) && is_string($_POST['newVal']) && $_POST['newVal']!=''){
				$newVal = mysqli_real_escape_string($conn, $_POST['newVal']); //HName
				$query = "UPDATE hotel SET HName = '$newVal' WHERE idHotel = '$pk'";
				$result = mysqli_query($conn, $query) or die (mysqli_error($conn));
				$response['er'] = 'success';
				$response['msg'] = '';
			}
			else{
				$response['er'] = 'error';
				$response['msg'] = 'There is something wrong about Hotel Name. Try again';
			}
		}
		else if ($cell == 'c3'){
			if (isset($_POST['newVal']) && is_string($_POST['newVal']) && $_POST['newVal']!=''){
				$newVal = mysqli_real_escape_string($conn, $_POST['newVal']); //HPhone
				$query = "UPDATE hotel SET HPhone = '$newVal' WHERE idHotel = '$pk'";
				$result = mysqli_query($conn, $query) or die (mysqli_error($conn));
				$response['er'] = 'success';
				$response['msg'] = '';
			}
			else{
				$response['er'] = 'error';
				$response['msg'] = 'There is something wrong about Hotel Phone. Try again';
			}
		}
        else if ($cell == 'c4'){
			if (isset($_POST['newVal']) && is_string($_POST['newVal']) && $_POST['newVal']!=''){
				$newVal = mysqli_real_escape_string($conn, $_POST['newVal']); //HTime
				$query = "UPDATE hotel SET HTime = '$newVal' WHERE idHotel = '$pk'";
				$result = mysqli_query($conn, $query) or die (mysqli_error($conn));
				$response['er'] = 'success';
				$response['msg'] = '';
			}
			else{
				$response['er'] = 'error';
				$response['msg'] = 'There is something wrong about Hotel Time. Try again';
			}
		}
        else if ($cell == 'c5'){
			if (isset($_POST['newVal']) && is_string($_POST['newVal']) && $_POST['newVal']!=''){
				$newVal = mysqli_real_escape_string($conn, $_POST['newVal']); //HTqueue
				$query = "UPDATE hotel SET HTqueue = '$newVal' WHERE idHotel = '$pk'";
				$result = mysqli_query($conn, $query) or die (mysqli_error($conn));
				$response['er'] = 'success';
				$response['msg'] = '';
			}
			else{
				$response['er'] = 'error';
				$response['msg'] = 'There is something wrong about Hotel Time. Try again';
			}
		}
        else if($cell == 'c6'){
            if (isset($_POST['newVal']) && is_numeric($_POST['newVal']) && $_POST['newVal']>=0){
				$newVal = mysqli_real_escape_string($conn, $_POST['newVal']); //PPWest
				$query = "UPDATE hotel SET PPWest = '$newVal' WHERE idHotel = '$pk'";
				$result = mysqli_query($conn, $query) or die (mysqli_error($conn));
				$response['er'] = 'success';
				$response['msg'] = '';
			}
			else{
				$response['er'] = 'error';
				$response['msg'] = 'Pickup West is not correct. Try again';
			}
        }
        else if($cell == 'c7'){
            if (isset($_POST['newVal']) && is_numeric($_POST['newVal']) && $_POST['newVal']>=0){
				$newVal = mysqli_real_escape_string($conn, $_POST['newVal']); //PPEast
				$query = "UPDATE hotel SET PPEast = '$newVal' WHERE idHotel = '$pk'";
				$result = mysqli_query($conn, $query) or die (mysqli_error($conn));
				$response['er'] = 'success';
				$response['msg'] = '';
			}
			else{
				$response['er'] = 'error';
				$response['msg'] = 'Pickup East is not correct. Try again';
			}
        }
        else if ($cell == 'c8'){
			if (isset($_POST['newVal']) && is_string($_POST['newVal']) && $_POST['newVal']!=''){
				$newVal = mysqli_real_escape_string($conn, $_POST['newVal']); //notes
				$query = "UPDATE hotel SET notes = '$newVal' WHERE idHotel = '$pk'";
				$result = mysqli_query($conn, $query) or die (mysqli_error($conn));
				$response['er'] = 'success';
				$response['msg'] = '';
			}
			else{
				$response['er'] = 'error';
				$response['msg'] = 'Direction West indicator is not correct. Try again';
			}
		}
	}
	mysqli_close($conn);
	echo json_encode($response); //sends $response[] to jquery ajax
?>