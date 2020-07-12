<?php
	session_start();
	include '../db_connect_conf.php';
	$idHotel = $_POST['idHotel'];
//    $group = mysqli_query($conn, "SELECT idHotel, HRow FROM hotel WHERE HRow = (SELECT HRow FROM hotel WHERE idHotel = $idHotel) LIMIT 3");
    $result = '';
//    if(mysqli_num_rows($group) < 2)
//        mysqli_query($conn, "UPDATE hotel SET HRow=HRow-1 WHERE idHotel>$idHotel");
    $result = mysqli_query($conn, "DELETE FROM hotel WHERE idHotel='$idHotel'");
    if ($result == true)
        print_r(1);
    else
        echo (mysqli_error($conn));
	mysqli_close($conn); //Make sure to close out the database connection
?>