<?php
include 'db_connect_conf.php';

$exdates = "SELECT * FROM expdates ";
$order = " ORDER BY `supplier`, `expDate`";

if (isset($_GET['from_date']) && isset($_GET['until_date'])) {
    if (trim($_GET['from_date']) !== '' && trim($_GET['until_date']) !== '') {
        $from = date('Y-m-d', strtotime($_GET['from_date']));
        $until = date('Y-m-d', strtotime($_GET['until_date']));
        $where = "WHERE expdate>='$from' AND expdate<='$until'";
    } elseif (trim($_GET['from_date']) === '') {
        $from = '';
        $until = date('Y-m-d', strtotime($_GET['until_date']));
        $where = "WHERE expdate<='$until'";
    } elseif (trim($_GET['until_date']) === '') {
        $from = date('Y-m-d', strtotime($_GET['from_date']));
        $until = '';
        $where = "WHERE expdate>='$from'";
    } else {
        $from = '';
        $until = '';
        $where = '';
    }
	echo "php from=$from, until=$until";
}

$exdates .= $where . $order;
$dates = mysqli_query($conn, $exdates);
?>
<table id="dates" border-collapse="collapse">
    <thead class="thead">
        <th></th>
        <th>Κ.Κ.</th>
        <th>Ημ/νία λήξης</th>
        <th>Προιόν</th>
        <th></th>
    </thead>
    <?php $j = 0;
    if (@mysqli_num_rows($dates) > 0) {
        $previous_supplier = -1;
        while ($i = mysqli_fetch_array($dates)) {
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
    else {
        echo "<tr class='no_expirations'><td colspan='5'><span> Δεν υπάρχουν λήξεις για την επιλεγμένη περίοδο! </span></td></tr>";
    } ?>
</table>