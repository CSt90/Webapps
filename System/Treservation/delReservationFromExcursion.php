<?php // change all to mysqli format
	
include '../db_connect_conf.php';
if (isset($_POST['ex']) && isset($_POST['date']) && isset($_POST['lname']) && isset($_POST['hotel']) && isset($_POST['room'])){
	$ex = $_POST['ex'];
	$date = date("Y-m-d", strtotime($_POST['date']));
	$lname = $_POST['lname'];
	$hotel = $_POST['hotel'];
	$h = mysqli_fetch_array(mysqli_query($conn, "SELECT idHotel FROM Hotel WHERE HName = '$hotel'"));
	$room = $_POST['room'];
	$query = mysqli_query($conn, "SELECT idReservations FROM Reservations WHERE ExcursionID = '$ex' AND ExDate = '$date' AND LastName = '$lname' AND HotelID = '$h[0]' AND RoomNo = '$room'");
	$row = mysqli_fetch_assoc($query);
	$id = $row['idReservations'];
	mysqli_query($conn, "DELETE FROM Reservations WHERE idReservations = '$id'");
	print_r(1);
}
else{
	echo "Could not delete reservation {Excursion: ".$_POST['ex'].", Date: ".$_POST['date'].", Last Name: ".$_POST['lname'].", Hotel: ".$_POST['hotel'].", Room Number: ".$_POST['room']."}";
}
mysqli_close($conn);
?>