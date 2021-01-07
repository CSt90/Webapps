<?php
include 'db_connect_conf.php';
include 'exDate.php';
$deads = 0;
if (isset($_GET['pt'])) {
    $supplier = mysqli_real_escape_string($conn, $_GET['pt']);
    $sup = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `supplierName` FROM supplier WHERE `supplierID`=$supplier"));
    $sup = @$sup['supplierName'];
    $where = " WHERE supplier=$supplier";
    if ($supplier == 0) {
        $where = "";
    }
    if (isset($_GET['deads'])){
        $deads = $_GET['deads'];
        if ($deads==0){
            $where .= " AND `datediff`.`days`>0";
            $exDates = mysqli_query($conn, "SELECT * FROM expdates 
                                            JOIN `datediff` 
                                            ON `expdates`.`entryID` = `datediff`.`exID` 
                                            $where
                                            ORDER BY `deliDate`");
        }
        else{
            $exDates = mysqli_query($conn, "SELECT * FROM expdates $where ORDER BY `deliDate`");
        }
    }
    else{
        $exDates = mysqli_query($conn, "SELECT * FROM expdates $where ORDER BY `deliDate`");
    }    
}
$suppliers = mysqli_query($conn, "SELECT * FROM supplier ORDER BY `supplierName`");

if (isset($_GET['date']) && trim($_GET['date'])!==''){
    $deli_date = mysqli_real_escape_string($conn, date('Y-m-d', strtotime($_GET['date'])));    
    if (isset($_GET['deads'])){
        $deads = $_GET['deads'];
        if ($deads==0){
            $exDates = mysqli_query($conn, "SELECT * FROM expdates 
                                            JOIN `datediff` 
                                            ON `expdates`.`entryID` = `datediff`.`exID` 
                                            WHERE `deliDate`='$deli_date' 
                                            AND `datediff`.`days`>0
                                            ORDER BY `deliDate`");
        }
        else{
            $exDates = mysqli_query($conn, "SELECT * FROM expdates WHERE `deliDate`='$deli_date' ORDER BY `deliDate`");
        }
    }
    else{
        $exDates = mysqli_query($conn, "SELECT * FROM expdates WHERE `deliDate`='$deli_date' ORDER BY `deliDate`");
    }
}

if (isset($_GET['docid']) && trim($_GET['docid']) !== '') {
    $doc_id = mysqli_real_escape_string($conn, $_GET['docid']);    
    if (isset($_GET['deads'])){
        $deads = $_GET['deads'];
        if ($deads==0){
            $exDates = mysqli_query($conn, "SELECT * FROM expdates 
                                            JOIN `datediff` 
                                            ON `expdates`.`entryID` = `datediff`.`exID` 
                                            WHERE `docID`=$doc_id 
                                            AND `datediff`.`days`>0
                                            ORDER BY `deliDate`");
        }
        else{
            $exDates = mysqli_query($conn, "SELECT * FROM expdates WHERE `docID`=$doc_id ORDER BY `deliDate`");
        }
    }
    else{
        $exDates = mysqli_query($conn, "SELECT * FROM expdates WHERE `docID`=$doc_id ORDER BY `deliDate`");
    }
}

$color = '';
$fontColor = '';

function rowColor($days){ 
    $days = @intval($days);
    $color = '';
    if ($days > 62) {
        $color = 'white';
        $fontColor = 'black';
    } elseif ($days < 0) {
        $color = 'black';
        $fontColor = 'white';
    } elseif ($days <= 31) {
        $color = '#FF6F47';
        $fontColor = 'black';
    } elseif ($days <= 62) {
        $color = '#FFB744';
        $fontColor = 'black';
    }
    return array($color, $fontColor);
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
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
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
            <h2 class="tableTitle">Λήξεις</h2>
            <div class="filterContainer">
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
                <div class="filter" id="change_sup"><img src="img/down2_icon.png" alt="Filter by Supplier"></div>
            </div>
            <div class="filterContainer">
                <input type="text" class="docid" name="docid" value="" placeholder="Αρ. Παραστατικού">
                <div class="filter" id="change_docid"><img src="img/down2_icon.png" alt="Filter by Document ID"></div>
            </div>
            <div class="filterContainer">
                <input type="text" class="datepicker" name="del_date" value="" placeholder="Ημ/νία Παραλαβής" autocomplete="off">
                <div class="filter" id="change_date"><img src="img/down2_icon.png" alt="Filter by Date"></div>
            </div>
            <!-- <input type="checkbox" class="combi_check" id="combi" name="combi">
            <label class='combi_label' for="combi">Συνδυαστική αναζήτηση</label> -->
            <div class="checkWrapper">
                <input type="checkbox" class="combi_check" id="deads" name="deads" <?php echo( $deads == 1 ? "checked" : '' )?>>
                <label class='combi_label' for="deads">Εμφάνιση ληγμένων</label>
            </div>
        </div>
        <div class="tableWrapper">            
            <?php $j = 0;
            if (!isset($exDates) || @mysqli_num_rows($exDates) == 0){
                echo '<div class="noRes"> Δε βρέθηκαν αποτελέσματα </div>';
            }
            if (@mysqli_num_rows($exDates) > 0) {
            ?>
                <table id="dates" border-collapse="collapse">
                    <col style="width:2%">
                    <col style="width:3%">
                    <col style="width:3%">
                    <col style="width:31%">
                    <col style="width:1%">
                    <col style="width:9%">
                    <col style="width:1%">
                    <col style="width:2%">
                    <col style="width:2%">
                    <thead class="thead">
                        <th></th>
                        <th>Κ.Κ.</th>
                        <th>Ημ/νία λήξης</th>
                        <th>Προιόν</th>
                        <th>Τεμάχια</th>
                        <th>Ημ/νία Παραλαβής</th>
                        <th>Αρ. Παρ/κού</th>
                        <th colspan=2></th>
                    </thead>
            <?php
                $colors = rowColor($conn, $exDates);
                while ($i = mysqli_fetch_array($exDates)) {
                    // map to item array
                    $id = $i['entryID'];
                    $exD = $i['expDate'];
                    $itName = $i['itemName'];
                    $pop = ($i['itemPopulation'] ? $i['itemPopulation'] : '-');
                    $delidate = $i['deliDate'];
                    $docid = ($i['docID'] ? $i['docID'] : '-');

                    $expiration_days = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `days` FROM datediff WHERE exID=$id"));
                    $days = $expiration_days['days'];
                    $colors = rowColor($days);
                    $color = $colors[0];
                    $fontColor = $colors[1];
            ?>
                    <tr class="row<?php echo ($j + 1) ?>">
                        <td <?php echo "style='background-color:$color; color:$fontColor'" ?>><?php echo ($j + 1) ?></td>
                        <td <?php echo "style='background-color:$color; color:$fontColor'" ?>>
                            <div class="entry_id"><?php echo $id ?></div>
                        </td>
                        <td <?php echo "style='background-color:$color; color:$fontColor'" ?>><input type="date" name="exdate[]" class="exdate" value="<?php echo $exD ?>" disabled <?php echo "style='color:$fontColor'" ?>></td>
                        <td <?php echo "style='background-color:$color; color:$fontColor'" ?>><input type="text" name="item[]" class="item" value="<?php echo $itName ?>" disabled <?php echo "style='color:$fontColor'" ?>></td>
                        <td <?php echo "style='background-color:$color; color:$fontColor'" ?>><input type="text" name="volume[]" class="volume" value="<?php echo $pop ?>" disabled <?php echo "style='color:$fontColor'" ?>></td>
                        <td <?php echo "style='background-color:$color; color:$fontColor'" ?>><input type="date" name="del_date[]" class="delivery_date" value="<?php echo $delidate ?>" disabled <?php echo "style='color:$fontColor'" ?>></td>
                        <td <?php echo "style='background-color:$color; color:$fontColor'" ?>><input type="text" name="docid[]" class="document_id" value="<?php echo $docid ?>" disabled <?php echo "style='color:$fontColor'" ?>></td>
                        <td><div class="edit"></div></td>
                        <td><div class="del"></div></td>
                    </tr>
            <?php $j++;
                } ?>
                </table>
            <?php
            } ?>
        </div>
        <div class="add"><img src="img/add_icon2.png" alt="add"></div>
    </form>
</body>

</html>

<?php
    mysqli_close($conn);
?>