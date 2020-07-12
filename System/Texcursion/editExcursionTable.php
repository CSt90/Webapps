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
			if (isset($_POST['newVal']) && isset($_POST['oldVal']) && is_string($_POST['newVal']) && $_POST['newVal']!=''){
				$newVal = mysqli_real_escape_string($conn, $_POST['newVal']); //EName
                $oldVal = mysqli_real_escape_string($conn, $_POST['oldVal']); 
				$query = "UPDATE excursion SET EName = '$newVal' WHERE idExcursion = '$pk'";
				$result = mysqli_query($conn, $query) or die (mysqli_error($conn));
                mysqli_query($conn, "ALTER TABLE ptime CHANGE `$oldVal` `$newVal` VARCHAR(5)");
                mysqli_query($conn, "ALTER TABLE office CHANGE `$oldVal` `$newVal` DECIMAL(10, 2)");
				$response['er'] = 'success';
				$response['msg'] = '';
			}
			else{
				$response['er'] = 'error';
				$response['msg'] = 'Excursion name is not correct. Try again';
			}
		}
		else if ($cell == 'c2'){
			if (isset($_POST['newVal']) && is_array($_POST['newVal']) && $_POST['newVal']!=''){
				$newVal = $_POST['newVal']; //EDays
				$query = "UPDATE excursion SET Mon = '$newVal[0]', Tue = '$newVal[1]', Wed = '$newVal[2]', Thu = '$newVal[3]', Fri = '$newVal[4]', Sat = '$newVal[5]', Sun = '$newVal[6]' WHERE idExcursion = '$pk'";
				$result = mysqli_query($conn, $query) or die (mysqli_error($conn));
				$response['er'] = 'success';
				$response['msg'] = '';
			}
			else{
				$response['er'] = 'error';
				$response['msg'] = 'Excursion days are not correct. Try again';
			}
		}
        else if ($cell == 'c3'){
			if (isset($_POST['newVal']) && is_string($_POST['newVal']) && $_POST['newVal']!=''){
				$newVal = mysqli_real_escape_string($conn, $_POST['newVal']); //StartTime
				$query = "UPDATE excursion SET StartTime = '$newVal' WHERE idExcursion = '$pk'";
				$result = mysqli_query($conn, $query) or die (mysqli_error($conn));
				$response['er'] = 'success';
				$response['msg'] = '';
			}
			else{
				$response['er'] = 'error';
				$response['msg'] = 'Excursion price is not correct. Try again '.$gettype($_POST['newVal']);
			}
		}
        else if ($cell == 'c4'){
			if (isset($_POST['newVal']) && is_string($_POST['newVal']) && $_POST['newVal']!=''){
				$newVal = mysqli_real_escape_string($conn, $_POST['newVal']); //EndTime
				$query = "UPDATE excursion SET EndTime = '$newVal' WHERE idExcursion = '$pk'";
				$result = mysqli_query($conn, $query) or die (mysqli_error($conn));
				$response['er'] = 'success';
				$response['msg'] = '';
			}
			else{
				$response['er'] = 'error';
				$response['msg'] = 'Excursion price is not correct. Try again '.$gettype($_POST['newVal']);
			}
		}
		else if ($cell == 'c5'){
			if (isset($_POST['newVal']) && is_numeric($_POST['newVal']) && $_POST['newVal']!='' && $_POST['newVal']>=0){
				$newVal = mysqli_real_escape_string($conn, $_POST['newVal']); //EPrice
				$query = "UPDATE excursion SET EPrice = '$newVal' WHERE idExcursion = '$pk'";
				$result = mysqli_query($conn, $query) or die (mysqli_error($conn));
				$response['er'] = 'success';
				$response['msg'] = '';
			}
			else{
				$response['er'] = 'error';
				$response['msg'] = 'Excursion price is not correct. Try again '.$gettype($_POST['newVal']);
			}
		}
	}
	mysqli_close($conn);
	echo json_encode($response); //sends $response[] to jquery ajax
?>