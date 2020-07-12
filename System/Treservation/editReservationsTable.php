<?php
	session_start();
	include '../db_connect_conf.php';
		
	$ex = $_POST['dropdown'];
	$ex_date = mysqli_real_escape_string($conn, date("Y-m-d", strtotime($_POST['ExDate'])));
	$voucher = mysqli_real_escape_string($conn, $_POST['VoucherNo']);
	$ptime = mysqli_real_escape_string($conn, $_POST['PTime']);
	$ppoint = mysqli_real_escape_string($conn, $_POST['PPoint']);
	$pp = mysqli_fetch_assoc(mysqli_query($conn, "SELECT idPickup FROM pickup WHERE PPoint = '$ppoint'"));
	$ppID = $pp['idPickup']; //insert this
	
	$lname = mysqli_real_escape_string($conn, $_POST['LastName']);
    $phone = mysqli_real_escape_string($conn, $_POST['Phone']);
    $email = mysqli_real_escape_string($conn, $_POST['Email']);
	$hotel = mysqli_real_escape_string($conn, $_POST['Hotel']);
	$hot = mysqli_fetch_assoc(mysqli_query($conn, "SELECT idHotel FROM hotel WHERE HName = '$hotel'"));
	$hotelID = $hot['idHotel'];	//insert this
	
	$room = mysqli_real_escape_string($conn, $_POST['RoomNumber']);
	$lang = mysqli_real_escape_string($conn, $_POST['Lang']);
	$nat = mysqli_real_escape_string($conn, $_POST['Nat']);
	$adults = mysqli_real_escape_string($conn, $_POST['Adults']);
	$a_price = mysqli_real_escape_string($conn, $_POST['AdultPrice']);
	$kids = mysqli_real_escape_string($conn, $_POST['Kids']);
	$k_price = mysqli_real_escape_string($conn, $_POST['KidPrice']);
	$infants = mysqli_real_escape_string($conn, $_POST['Infants']);
	$pob_amt = mysqli_real_escape_string($conn, $_POST['POB_amt']);
	$res_id = $_POST['res_id'];
	if($pob_amt>0)
		$pob = 1; //insert this
	else
		$pob = 0; //insert this
	$res_office = $_POST['dropdown_office'];
//	$seller = mysqli_real_escape_string($conn, $_POST['SellerName']);
//	$sel = mysqli_fetch_assoc(mysqli_query($conn, "SELECT idSeller FROM seller WHERE SName = '$seller'"));
//	$sellerID = $sel['idSeller']; //insert this
	
	$resdate = mysqli_real_escape_string($conn, date("Y-m-d", strtotime($_POST['ResDate'])));
	//$inquery = "UPDATE reservations(`ExcursionID`, `ExDate`, `Pickup`, `PTime`, `LastName`, `Adults`, `AdultPrice`, `Kids`, `KidPrice`, `Infants`, `Language`, `Nationality`, `VoucherNo`, `ResDate`, `HotelID`, `RoomNo`, `ReservationOfficeID`, `SellerID`, `POB`, `POBamt`) values('$ex', '$ex_date', '$ppID', '$ptime', '$lname', '$adults', '$a_price', '$kids', '$k_price', '$infants', '$lang', '$nat', '$voucher', '$resdate', '$hotelID', '$room', '$res_office', '$sellerID', '$pob', '$pob_amt')";
	$upquery = "UPDATE reservations SET `ExcursionID`='$ex',`ExDate`='$ex_date',`Pickup`='$ppID',`PTime`='$ptime',`LastName`='$lname', Phone='$phone', Email='$email', `Adults`='$adults',`AdultPrice`='$a_price',`Kids`='$kids',`KidPrice`='$k_price',`Infants`='$infants',`Language`='$lang',`Nationality`='$nat',`VoucherNo`='$voucher',`ResDate`='$resdate',`HotelID`='$hotelID',`RoomNo`='$room',`ReservationOfficeID`='$res_office',`POB`='$pob',`POBamt`='$pob_amt' WHERE idReservations = '$res_id'";
	mysqli_query($conn, $upquery) or die(print_r(mysqli_error($conn)));
	mysqli_close($conn);
	header('Location: viewResList.php?ex='.$ex.'&date='.$_POST['ExDate']);
?>