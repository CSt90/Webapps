<?php // change all to mysqli format
	
include '../db_connect_conf.php';

$ex = $_POST['ex'];
$date = $_POST['date'];
$dbdate = date("Y-m-d", strtotime($_POST['date']));
$lname = $_POST['lname'];
$voucher = $_POST['voucher'];// ask if it is necessary
$hname = $_POST['hotel'];
$room = $_POST['room'];

$hotel = mysqli_fetch_assoc(mysqli_query($conn, "SELECT idHotel FROM hotel WHERE HName = '$hname'"));
$hotelID = $hotel['idHotel'];

$res = mysqli_fetch_assoc(mysqli_query($conn, "SELECT idReservations FROM reservations WHERE ExcursionID = '$ex' AND ExDate = '$dbdate' AND LastName = '$lname' AND HotelID = '$hotelID' AND RoomNo = '$room'"));//AND VoucherNo = '$voucher' 
$url = "editReservation.php?resid=".$res['idReservations'];
echo $url;

mysqli_close($conn);
?>