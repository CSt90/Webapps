<?php
include 'db_connect_conf.php';

if (isset($_POST['sup']) && isset($_POST['docid'])) {
    $supplier = $_POST['sup'];

    if ($supplier == 0){
        $where = "";
    }
    else{
        $where = " supplier=$supplier AND";
    }
    
    $docid = $_POST['docid'];
    $exDates = mysqli_query($conn, "SELECT * FROM expdates WHERE $where docID=$docid ORDER BY `deliDate`");
}

$j = 0;
$sup = '';
if (@mysqli_num_rows($exDates) > 0) {
	
    while ($i = mysqli_fetch_array($exDates)) {
		if($i['supplier'] !== $sup){
			$supplierName = $i['supplier'];
			$supplierName = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `supplierName` FROM supplier WHERE `supplierID`=$sup" ));
			$supplierName = $sup['supplierName'];
			echo "<tr class='supplier_row'><td colspan='9'>$supplierName</td></tr>";
		}
        $id = $i['entryID'];
        $exD = $i['expDate'];
        $itName = $i['itemName'];
        $pop = $i['itemPopulation'];
        $delidate = $i['deliDate'];
        $docid = $i['docID'];
        echo "<tr class='row".($j + 1)."'>
            <td>".($j + 1)."</td>
            <td><div class='entry_id'>$id</div></td>
            <td><input type='date' name='exdate[]' class='exdate' value='$exD' disabled></td>
            <td><input type='text' name='item[]' class='item' value='$itName' disabled></td>
            <td><input type='text' name='volume[]' class='volume' value='$pop' disabled></td>
            <td><input type='date' name='del_date[]' class='delivery_date' value='$delidate' disabled></td>
            <td><input type='text' name='docid[]' class='document_id' value='$docid' disabled></td>
            <td><span class='edit'>Επεξεργασία</span></td>
            <td><span class='del'>Διαγραφή</span></td>
        </tr>";
     $j++;
    }
}
