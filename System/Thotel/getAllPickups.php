<?php
    session_start();
    include '../db_connect_conf.php';
    
    $PPoint = $_POST['pp'];
    $selected = '';
    
    $q = 'SELECT idPickup, PPoint FROM pickup';
    $res = mysqli_query($conn, $q);
    echo "<select id='drop_pickup' value='-1' required><option value=''>Pickup Point</option>";
    echo "<option value='0'>(no pickup point)</option>";
    while($row = mysqli_fetch_array($res)) {
        if ($row['PPoint'] == $PPoint)
            $selected = 'selected';
        else
            $selected = '';
        echo "<option value=".$row['idPickup']." ".$selected.">".$row['PPoint']."</option>";
    }
    echo "</select>";
?>