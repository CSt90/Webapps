<?php
	session_start();
	include '../db_connect_conf.php';
    if (isset($_POST['HName']))
        $HName = mysqli_real_escape_string($conn, $_POST['HName']);
    if (isset($_POST['HArea']))
        $HArea = mysqli_real_escape_string($conn, $_POST['HArea']);
    else
        $HArea = '';
    if (isset($_POST['HPhone']))
        $HPhone = mysqli_real_escape_string($conn, $_POST['HPhone']);
    else
        $HPhone = '';
	 if(isset($_POST['prevhotelID']))
	 	$hprev = mysqli_real_escape_string($conn, $_POST['prevhotelID']);
	 else // if hprev is not set, the new hotel is meant to be the new 1st hotel on the list
	 	$hprev = 1;
	 if(isset($_POST['nexthotelID']))
		 $hnext = mysqli_real_escape_string($conn, $_POST['nexthotelID']);
	 else{ // if hnext is not set, it means that the new hotel is meant to be the new last hotel on the list.
	   $lastID = mysqli_fetch_assoc(mysqli_query($conn, "SELECT max(idHotel) AS max FROM `hotel`"));
	   $hnext = 1000*intval(($lastID['max']+1000)/1000); // get the next thousand after the max ID. E.g. if max ID=67866 then lastID=68000
	 }
    if (isset($_POST['notes']))
        $notes = mysqli_real_escape_string($conn, $_POST['notes']);
    else
        $notes = '';

	if ($hprev && $hnext && isset($_POST['dropdown-pickupW']) && isset($_POST['dropdown-pickupE']) && $_POST['dropdown-pickupW'] > -1 && $_POST['dropdown-pickupE'] > -1){
		$idHotel = intval(($hprev+$hnext)/2);
		echo $idHotel;
		$PPWest = $_POST['dropdown-pickupW'];
		$PPEast = $_POST['dropdown-pickupE'];
      $q = mysqli_query($conn, "INSERT INTO `hotel`(`idHotel`, `HArea`, `HName`, `HPhone`, `PPWest`, `PPEast`, `notes`) VALUES('$idHotel', '$HArea', '$HName', '$HPhone', '$PPWest', '$PPEast', '$notes')");
      if ($q == false){
          $error = mysqli_error($conn);
          echo mysqli_error($conn);
          header('Location: viewHotelTable.php?error='.$error);
      }
      else //success
          header('Location: viewHotelTable.php');
    header('Location: viewHotelTable.php');
	}
	else{
        $error = 'Something went wrong. Try again';
		header('Location: viewHotelTable.php?error='.$error);
	}

	mysqli_close($conn); //Make sure to close out the database connection
?>
