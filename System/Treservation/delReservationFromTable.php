<?php // change all to mysqli format
	session_start();
    include '../db_connect_conf.php';

    if (isset($_POST['resid']) && is_numeric($_POST['resid'])){
        $resid = $_POST['resid'];
        mysqli_query($conn, "DELETE FROM Reservations WHERE idReservations = '$resid'");
        print_r(1);
    }
    else{
        echo "Could not delete reservation No. $resid";
    }
    mysqli_close($conn);
?>