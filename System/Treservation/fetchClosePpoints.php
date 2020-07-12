<?php
	session_start();
	include '../db_connect_conf.php';
	
	$hotel = mysqli_real_escape_string($conn, $_GET['hname']);
    $ename = mysqli_real_escape_string($conn, $_GET['exc']);

    $dir = mysqli_fetch_array(mysqli_query($conn, "SELECT `$ename` FROM ptime LIMIT 1"));
    $ppsel = '';
    if ($dir[0] == 0){//to HER
        $ppsel = 'PPEast';
        $hotel_ppoints = mysqli_fetch_assoc(mysqli_query($conn, "SELECT PPEast FROM Hotel WHERE HName='$hotel'"));
        $pp = $hotel_ppoints['PPEast'];
    }
    else if ($dir[0] == 1){//to CHA
        $ppsel = 'PPWest';
        $hotel_ppoints = mysqli_fetch_assoc(mysqli_query($conn, "SELECT PPWest FROM Hotel WHERE HName='$hotel'"));
        $pp = $hotel_ppoints['PPWest'];
    }

//	$hotel_ppoints = mysqli_fetch_assoc(mysqli_query($conn, "SELECT PPEast, PPWest FROM Hotel WHERE HName='$hotel'"));
//	$PPEast = $hotel_ppoints['PPEast'];
//	$PPWest = $hotel_ppoints['PPWest'];
	$close_ppoints = mysqli_query($conn, "SELECT PPoint FROM pickup WHERE PPointGroup=(SELECT PPointGroup FROM pickup where idPickup='$pp')");//OR PPointGroup=(SELECT PPointGroup FROM pickup where idPickup='$PPEast')
	while($row = mysqli_fetch_array($close_ppoints)){ ?>
		<div class='close-ppoint' onclick='setAsPpoint($(this))'><?php echo $row['PPoint'] ?></div>
<?php
	}
?>