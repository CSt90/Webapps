<?php

include 'db_connect_conf.php';

$today = date('Y-m-d'); /**/

if(date('D', strtotime($today)) == 'Mon'){
	$sat = date('Y-m-d',strtotime('-2 days'));
	$sun = date('Y-m-d',strtotime('-1 days'));
	$yesterday = "`expDate`='$sat' OR `expDate`='$sun'";
}
else{
	$yest = date('Y-m-d',strtotime('-1 days'));
	$yesterday = "`expDate`='$yest'";
}

$todays_expirations = mysqli_query($conn, "SELECT * FROM `expdates` WHERE $yesterday");

include 'sidebar.html';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="js/jQuery.js"></script>
    <script src="jqui/jquery-ui.min.js"></script>
    <!-- <link rel="stylesheet" href="jqui/jquery-ui.theme.min.css"> -->
    <link rel="stylesheet" href="jqui/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="jqui/jquery-ui.min.css">
    <link rel="stylesheet" href="styles/todayExDates.css">
    <link rel="stylesheet" href="styles/sidebar.css">
    <title>DateX -</title>
</head>

<body>

    <h3 class="todays_title">Λήξεις ημέρας <?php echo date('d/m/Y', strtotime($today))?></h3>
    
    <table id="dates" border-collapse="collapse">
        <thead class="thead">
            <th></th>
            <th>Κ.Κ.</th>
            <th>Ημ/νία λήξης</th>
            <th>Προιόν</th>
            <th></th>
        </thead>
        <?php $j = 0;
    if (@mysqli_num_rows($todays_expirations) > 0) {
        $previous_supplier = -1;
        while ($i = mysqli_fetch_array($todays_expirations)) {
            $id = $i['entryID'];
            $exD = $i['expDate'];
            $itName = $i['itemName'];
            $sup = $i['supplier'];
            if ($previous_supplier !== $sup) {
                $supplier_name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT supplierName FROM supplier WHERE supplierID=$sup"));
                echo "<tr class='supplier_row' style='background-color:gainsboro'><td colspan='5'><span>" . $supplier_name['supplierName'] . "</span></td></tr>";
            }
            $previous_supplier = $sup;
            
            ?>
            <tr class="row<?php echo ($j + 1) ?>" style="background-color:white">
                <td><?php echo ($j + 1) ?></td>
                <td>
                    <div class="entry_id"><?php echo $id ?></div>
                </td>
                <td><span class="exdate"><?php echo date('d/m/Y', strtotime($exD)) ?></span></td>
                <td><span type="text" class="item"><?php echo $itName ?></span></td>
                <td></td>
            </tr>
            <?php $j++;
        }
    }
    else{
        echo "<tr class='no_expirations'><td colspan='5'><span> Δεν υπάρχουν λήξεις για σήμερα! </span></td></tr>";
    } ?>
</table>

</body>