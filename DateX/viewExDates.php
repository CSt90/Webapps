<?php
include 'db_connect_conf.php';
if (isset($_GET['pt'])) {
    $supplier = $_GET['pt'];
    $sup = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `supplierName` FROM supplier WHERE `supplierID`=$supplier"));
    $sup = @$sup['supplierName'];
    $where = " WHERE supplier=$supplier";
    if ($supplier == 0) {
        $where = "";
    }
    $exDates = mysqli_query($conn, "SELECT * FROM expdates $where ORDER BY `deliDate`");
}
$suppliers = mysqli_query($conn, "SELECT * FROM supplier ORDER BY `supplierName`");

if (isset($_GET['date']) && trim($_GET['date'])!==''){
    $deli_date = date('Y-m-d', strtotime($_GET['date']));
    $exDates = mysqli_query($conn, "SELECT * FROM expdates WHERE `deliDate`='$deli_date' ORDER BY `deliDate`");
}

if (isset($_GET['docid']) && trim($_GET['docid']) !== '') {
    $doc_id = $_GET['docid'];
    $exDates = mysqli_query($conn, "SELECT * FROM expdates WHERE `docID`=$doc_id ORDER BY `deliDate`");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="js/jQuery.js"></script>
    <script src="jqui/jquery-ui.min.js"></script>
    <script src="js/viewExDates.js"></script>
    <!-- <link rel="stylesheet" href="jqui/jquery-ui.theme.min.css"> -->
    <link rel="stylesheet" href="jqui/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="jqui/jquery-ui.min.css">
    <link rel="stylesheet" href="styles/viewExDates.css">
    <link rel="stylesheet" href="styles/sidebar.css">
    <title>DateX - <?php echo "Λήξεις ".(isset($sup) ? $sup : ' ') ?></title>
</head>

<body>
    <?php include 'sidebar.html' ?>
    <form class="insert" action="">
        <div class="topinfo">
            <select id="supplierSelect" name="pt">
                <option value="0">Προμηθευτής</option>
                <?php
                if (@mysqli_num_rows($suppliers) > 0) {
                    while ($i = mysqli_fetch_array($suppliers)) {
                        $sID = $i['supplierID'];
                        $sName = $i['supplierName'];
                        $selected = '';
                        if (isset($supplier)) {
                            $selected = ($supplier === $sID ? 'selected' : '');
                        }
                        echo "<option value='$sID' $selected>$sName</option>";
                    }
                }
                ?>
            </select>
            <div class="filter" id="change_sup"><img src="img/down2_icon.png" alt="add"></div>
            <input type="text" class="docid" name="docid" value="" placeholder="Αρ. Παραστατικού">
            <div class="filter" id="change_docid"><img src="img/down2_icon.png" alt="add"></div>
            <input type="text" class="datepicker" name="del_date" value="" placeholder="Ημ/νία Παραλαβής" autocomplete="off">
            <div class="filter" id="change_date"><img src="img/down2_icon.png" alt="add"></div>
            <input type="checkbox" class="combi_check" name="combi_check">
            <label class='combi_label' for="combi_check">Συνδυαστική αναζήτηση</label>
        </div>
        <table id="dates" border-collapse="collapse">
            <col style="width:2%">
            <col style="width:3%">
            <col style="width:3%">
            <col style="width:31%">
            <col style="width:1%">
            <col style="width:9%">
            <col style="width:1%">
            <col style="width:1%">
            <col style="width:1%">
            <thead class="thead">
                <th></th>
                <th>Κ.Κ.</th>
                <th>Ημ/νία λήξης</th>
                <th>Προιόν</th>
                <th>Τεμάχια</th>
                <th>Ημ/νία Παραλαβής</th>
                <th>Αρ. Παρ/κού</th>
                <th> </th>
                <th> </th>
            </thead>
            <?php $j = 0;
            if (@mysqli_num_rows($exDates) > 0) {
                while ($i = mysqli_fetch_array($exDates)) {
                    $id = $i['entryID'];
                    $exD = $i['expDate'];
                    $itName = $i['itemName'];
                    $pop = $i['itemPopulation'];
                    $delidate = $i['deliDate'];
                    $docid = $i['docID'];

                    $expiration_days = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `days` FROM datediff WHERE exID=$id"));
                    $days = $expiration_days['days'];
                    $color = '';
                    if ($days > 62) {
                        $color = 'white';
                        $fontColor = 'black';
                    } elseif ($days < 0) {
                        $color = 'black';
                        $fontColor = 'white';
                    } elseif ($days <= 31) {
                        $color = '#e83838';
                        $fontColor = 'black';
                    } elseif ($days <= 62) {
                        $color = '#f5834e';
                        $fontColor = 'black';
                    }


            ?>
                    <tr class="row<?php echo ($j + 1) ?>" <?php echo "style='background-color:$color; color:$fontColor'" ?>>
                        <td><?php echo ($j + 1) ?></td>
                        <td>
                            <div class="entry_id"><?php echo $id ?></div>
                        </td>
                        <td><input type="date" name="exdate[]" class="exdate" value="<?php echo $exD ?>" disabled <?php echo "style='color:$fontColor'" ?>></td>
                        <td><input type="text" name="item[]" class="item" value="<?php echo $itName ?>" disabled <?php echo "style='color:$fontColor'" ?>></td>
                        <td><input type="text" name="volume[]" class="volume" value="<?php echo $pop ?>" disabled <?php echo "style='color:$fontColor'" ?>></td>
                        <td><input type="date" name="del_date[]" class="delivery_date" value="<?php echo $delidate ?>" disabled <?php echo "style='color:$fontColor'" ?>></td>
                        <td><input type="text" name="docid[]" class="document_id" value="<?php echo $docid ?>" disabled <?php echo "style='color:$fontColor'" ?>></td>
                        <td><span class="edit">Επεξεργασία</span></td>
                        <td><span class="del">Διαγραφή</span></td>
                    </tr>
            <?php $j++;
                }
            } ?>
        </table>
        <div class="add"><img src="img/add_icon.png" alt="add"></div>
    </form>
</body>

</html>