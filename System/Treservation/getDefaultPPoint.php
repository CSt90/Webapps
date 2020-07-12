<?php
    session_start();
    include '../db_connect_conf.php';
    if (isset($_POST['hotel']) && isset($_POST['exc'])){
        $hname = $_POST['hotel'];
        $ename = $_POST['exc'];
        
        $dir = mysqli_fetch_array(mysqli_query($conn, "SELECT `$ename` FROM ptime LIMIT 1"));
        if ($dir[0] == 0) {//to HER
            $ppid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT PPEast FROM hotel WHERE HName = '$hname'"));
            $pp = $ppid['PPEast'];
        }
        else if ($dir[0] == 1){//to CHA
            $ppid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT PPWest FROM hotel WHERE HName = '$hname'"));
            $pp = $ppid['PPWest'];
        }
        $res = mysqli_fetch_assoc(mysqli_query($conn, "SELECT PPoint FROM pickup WHERE idPickup = '$pp'"));
        echo $res['PPoint'];
    }
?>