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
				$newVal = mysqli_real_escape_string($conn,$_POST['newVal']); //OName
				$query = "UPDATE office SET OName = '$newVal' WHERE idOffice = '$pk'";
				$result = mysqli_query($conn, $query) or die (mysqli_error($conn));
				$response['er'] = 'success';
				$response['msg'] = '';
			}
			else{
				$response['er'] = 'error';
				$response['msg'] = 'Office name is not valid. Try again';
			}
		}
		else if ($cell != 'c1' && $cell != 'ctype'){
            $exc_no = intval(substr($cell, 1));
            $excs = mysqli_query($conn, "SELECT * FROM office");
//            $ENames = array();
//            for ($i=3; $i<20; $i++)
            $exc = mysqli_field_name($excs, $exc_no+2); //array_push($ENames, )
			if (isset($_POST['newVal']) && is_numeric($_POST['newVal']) && $_POST['newVal']!='' && $_POST['newVal']>='0'){
				$newVal = $_POST['newVal']; //Commission
				$newVal2 = str_replace(',', '.', $newVal);
				$query = "UPDATE office SET `$exc` = '$newVal2' WHERE idOffice = '$pk'";
				$result = mysqli_query($conn, $query) or die (mysqli_error($conn));
				$response['er'] = 'success';
				$response['msg'] = '';
			}
			else{
				$response['er'] = 'error';
				$response['msg'] = 'Commission rate is not correct. Try again';
			}
		}
        else if ($cell == 'ctype'){
            if (isset($_POST['newVal']) && is_string($_POST['newVal']) && $_POST['newVal']!=''){
                $newVal = mysqli_real_escape_string($conn,$_POST['newVal']);
                $query = "UPDATE office SET CType = '$newVal' WHERE idOffice = '$pk'";
                $result = mysqli_query($conn, $query) or die (mysqli_error($conn));
                $response['er'] = 'success';
                $response['msg'] = '';
            }
            else{
                $response['er'] = 'error';
                $response['msg'] = 'Commission type is not valid. Try again';
            }
        }
	}
	mysqli_close($conn);
	echo json_encode($response); //sends $response[] to jquery ajax

    function mysqli_field_name($result, $field_offset)
    {
        $properties = mysqli_fetch_field_direct($result, $field_offset);
        return is_object($properties) ? $properties->name : false;
    }
?>
