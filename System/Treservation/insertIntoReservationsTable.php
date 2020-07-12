<?php
	session_start();
	include '../db_connect_conf.php';
		
	$ex = $_POST['dropdown'];
	$ex_date = mysqli_real_escape_string($conn, date("Y-m-d", strtotime($_POST['ExDate'])));
	$voucher = mysqli_real_escape_string($conn, $_POST['VoucherNo']); //should this be unique?
	$ptime = mysqli_real_escape_string($conn, $_POST['PTime']);
	$ppoint = mysqli_real_escape_string($conn, $_POST['PPoint']);
	$pp = mysqli_fetch_assoc(mysqli_query($conn, "SELECT idPickup FROM pickup WHERE PPoint = '$ppoint'"));
	$ppID = $pp['idPickup']; //insert this
    if(!$ppID){
        $pIDmax = mysqli_fetch_assoc(mysqli_query($conn, "SELECT max(idPickup) AS max FROM pickup"));
        $ppID = $pIDmax['max']+10;
        echo "<span>Pickup ID: '.$ppID.'</span><br>";
        mysqli_query($conn, "INSERT INTO pickup(idPickup, PPoint) values($ppID, '$ppoint')");
    }
	
	$lname = mysqli_real_escape_string($conn, $_POST['LastName']);
    $phone = mysqli_real_escape_string($conn, $_POST['Phone']);
    $email = mysqli_real_escape_string($conn, $_POST['Email']);
	$hotel = mysqli_real_escape_string($conn, $_POST['Hotel']); //from addReservation
	$hot = mysqli_fetch_assoc(mysqli_query($conn, "SELECT idHotel FROM hotel WHERE HName = '$hotel'"));
	$hotelID = $hot['idHotel'];	//insert this
    if(!$hotelID){
        $hIDmax = mysqli_fetch_assoc(mysqli_query($conn, "SELECT max(idHotel) AS max FROM hotel"));
        $hotelID = $hIDmax['max']+100;
        echo "<span>Hotel ID: '.$hotelID.'</span><br>";
        mysqli_query($conn, "INSERT INTO hotel(idHotel, HName) values($hotelID, '$hotel')");
    }
	
	$room = mysqli_real_escape_string($conn, $_POST['RoomNumber']);
	$lang = mysqli_real_escape_string($conn, $_POST['Lang']);
	$nat = mysqli_real_escape_string($conn, $_POST['Nat']);
	$adults = mysqli_real_escape_string($conn, $_POST['Adults']);
	$a_price = mysqli_real_escape_string($conn, $_POST['AdultPrice']);
	$kids = mysqli_real_escape_string($conn, $_POST['Kids']);
	$k_price = mysqli_real_escape_string($conn, $_POST['KidPrice']);
	$infants = mysqli_real_escape_string($conn, $_POST['Infants']);
	$pob_amt = mysqli_real_escape_string($conn, $_POST['POB_amt']);
	if($pob_amt>0)
		$pob = 1; //insert this
	else
		$pob = 0; //insert this
	$res_office = $_POST['dropdown_office'];
	//$seller = mysqli_real_escape_string($conn, $_POST['SellerName']);
	//$sel = mysqli_fetch_assoc(mysqli_query($conn, "SELECT idSeller FROM seller WHERE SName = '$seller'"));
	//$sellerID = mysqli_real_escape_string($conn, $_POST['SellerName']); //$sel['idSeller']; //insert this
	
	$resdate = mysqli_real_escape_string($conn, date("Y-m-d", strtotime($_POST['ResDate'])));
	//make sure reservation does not exist already before inserting
	$chquery = mysqli_query($conn, "SELECT idReservations FROM reservations WHERE ExcursionID='$ex' AND ExDate='$ex_date' AND Pickup='$ppID' AND PTime='$ptime' AND LastName='$lname' AND Phone='$phone' AND Email='$email' AND Adults='$adults' AND AdultPrice='$a_price' AND Kids='$kids' AND KidPrice='$k_price' AND Infants='$infants' AND Language='$lang' AND Nationality='$nat' AND VoucherNo='$voucher' AND HotelID='$hotelID' AND HotelName='$hotel' AND RoomNo='$room' AND ReservationOfficeID='$res_office' AND POB='$pob' AND POBamt='$pob_amt'"); //AND ResDate='$resdate' AND SellerID='$sellerID' 
	if (mysqli_num_rows($chquery)>0){
		echo "Reservation already exists. Go back and try again";
		echo "</br><button onclick='history.go(-1);'>Back </button></br>";
		//header('Refresh:10; location: viewResList.php?ex='.$ex.'&date='.$_POST['ExDate']);
	}
	else{
		$inquery = "INSERT INTO reservations(`ExcursionID`, `ExDate`, `Pickup`, `PTime`, `LastName`, `Phone`, `Email`, `Adults`, `AdultPrice`, `Kids`, `KidPrice`, `Infants`, `Language`, `Nationality`, `VoucherNo`, `ResDate`, `HotelID`, `HotelName`, `RoomNo`, `ReservationOfficeID`, `POB`, `POBamt`) values('$ex', '$ex_date', '$ppID', '$ptime', '$lname', '$phone', '$email', '$adults', '$a_price', '$kids', '$k_price', '$infants', '$lang', '$nat', '$voucher', '$resdate', '$hotelID', '$hotel', '$room', '$res_office', '$pob', '$pob_amt')";
		mysqli_query($conn, $inquery) or die('Something went wrong. Try again'. mysqli_error($conn));
		header('location: viewResList.php?ex='.$ex.'&date='.$_POST['ExDate']);
	}	
	mysqli_close($conn);
	echo '<span>Excursion ID: '.$ex.'</span><br>';
	echo '<span>Excursion date: '.$ex_date.'</span><br>';
	echo '<span>Voucher: '.$voucher.'</span><br>';
	echo '<span>PTime: '.$ptime.'</span><br>';
	echo '<span>PPoint: '.$ppoint.'</span><br>';
	echo '<span>PPointID: '.$ppID.'</span><br>';
	echo '<span>Last Name: '.$lname.'</span><br>';
	echo '<span>Hotel: '.$hotel.'</span><br>';
	echo '<span>HotelID: '.$hotelID.'</span><br>';
    echo '<span>HotelName: '.$hotel.'</span><br>';
	echo '<span>Room: '.$room.'</span><br>';
	echo '<span>Lang: '.$lang.'</span><br>';
	echo '<span>Nat: '.$nat.'</span><br>';
	echo '<span>Adults: '.$adults.'</span><br>';
	echo '<span>Adult Price: '.$a_price.'</span><br>';
	echo '<span>Kids: '.$kids.'</span><br>';
	echo '<span>Kid Price: '.$k_price.'</span><br>';
	echo '<span>Infants: '.$infants.'</span><br>';
	echo '<span>POB: '.$pob.' POB Amount: '.$pob_amt.'</span><br>';
	echo '<span>Res. office: '.$res_office.'</span><br>';
	echo '<span>Res. Date: '.$resdate.'</span><br>';	
?>