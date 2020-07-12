<?php
    session_start();
    include '../db_connect_conf.php';
    
    $ppgroup = $_POST['ppgroup'];
    //$idHotel = $_POST['idHotel'];
    $selected = '';
    
    //$q = 'SELECT HTqueue FROM hotel WHERE idHotel = $idHotel';
    //$res = mysqli_fetch_assoc(mysqli_query($conn, $q));
    echo "<select id='drop_ppgroup' value='-1' required>";
    for ($i=1; $i<=14; $i++) {
        if ($i == $ppgroup)
            $selected = 'selected';
        else
            $selected = '';
        echo "<option value=q".$i." ".$selected.">".$i."</option>";
    }
    echo "</select>";
?>