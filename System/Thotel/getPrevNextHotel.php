<?php
    session_start();
    include '../db_connect_conf.php';

    $ph = $_POST['ph'];
    $q = "SELECT idHotel, HName, PPWest, PPEast FROM `hotel` WHERE HName='$ph'";
    $res = mysqli_fetch_assoc(mysqli_query($conn, $q));
    $prevID = $res['idHotel'];
    $prevName = $res['HName'];
    $ppWest = $res['PPWest'];
    $ppEast = $res['PPEast'];
    // print_r($res);
    if ($res){
      $q_nxt = "SELECT idHotel, HName FROM `hotel` WHERE idHotel>$prevID LIMIT 1";
      $res_nxt = mysqli_fetch_assoc(mysqli_query($conn, $q_nxt));
      $nxtID = $res_nxt['idHotel'];
      $nxtName = $res_nxt['HName'];
      $sendata = array(
         "prevID" => $prevID,
         "prevName" => $prevName,
         "ppWest" => $ppWest,
         "ppEast" => $ppEast,
         "nxtID" => $nxtID,
         "nxtName" => $nxtName);
       echo json_encode($sendata);
    }
    else {
       $sendata = array(
          "prevID" => "nores",
          "prevName" => "nores",
          "ppWest" => "nores",
          "ppEast" => "nores",
          "nxtID" => "nores",
          "nxtName" => "nores");
       echo json_encode($sendata);
      // print_r($res);
    }
?>
