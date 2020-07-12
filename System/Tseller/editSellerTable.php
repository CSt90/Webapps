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
				$newVal = mysqli_real_escape_string($conn, $_POST['newVal']);
				$OName = "SELECT idOffice from office WHERE OName = '$newVal'";
				$Of = mysqli_query($conn, $OName);
				if ($Of){
					if (@mysqli_num_rows($Of) == 1) {
						$name = mysqli_fetch_array($Of);
						$idOffice = $name["idOffice"];
						$query = "UPDATE seller SET SOffice = '$idOffice' WHERE idSeller = '$pk'";
						$result = mysqli_query($conn, $query) or die (mysqli_error($conn));
						$response['er'] = 'success';
						$response['msg'] = '';
					}
					else{
						$response['er'] = 'error';
						$response['msg'] = 'Office "'.$newVal.'" does not exist';
					}
				}					
			}
		}
		else if ($cell == 'c2'){
			if (isset($_POST['newVal']) && is_string($_POST['newVal']) && $_POST['newVal']!=''){
				$newVal = mysqli_real_escape_string($conn, $_POST['newVal']); //SName
				$query = "UPDATE seller SET SName = '$newVal' WHERE idSeller = '$pk'";
				$result = mysqli_query($conn, $query) or die (mysqli_error($conn));
				$response['er'] = 'success';
				$response['msg'] = '';
			}
			else{
				$response['er'] = 'error';
				$response['msg'] = 'Seller name is not correct. Try again';
			}
		}
	}
	mysqli_close($conn);
	echo json_encode($response); //sends $response[] to jquery ajax
?>

