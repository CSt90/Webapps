<?php
    session_start();
    include '../db_connect_conf.php';
    if (isset($_POST['voucher'])){
        $voucher = $_POST['voucher'];
        $result = mysqli_query($conn, "SELECT idReservations FROM reservations WHERE VoucherNo = $voucher");
        $res = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result) == 0){
            echo 'We\'re good';
        }
        else if(mysqli_num_rows($result) > 0){
            echo 1;
        }
    }
?>