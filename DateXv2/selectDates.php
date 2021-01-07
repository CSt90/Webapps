<?php
include 'db_connect_conf.php';
if (isset($_GET['pt'])) {
    $supplier = $_GET['pt'];
    $sup = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `supplierName` FROM supplier WHERE `supplierID`=$supplier"));
    $sup = $sup['supplierName'];
    $where = " WHERE supplier=$supplier";
    if ($supplier == 0) {
        $where = "";
    }
} else {
    $supplier = 0;
    $where = "";
    $sup = '';
}
$suppliers = mysqli_query($conn, "SELECT * FROM supplier ORDER BY `supplierName`");
$exDates = mysqli_query($conn, "SELECT * FROM expdates $where ORDER BY `supplier`, `expDate`");

?>

<!DOCTYPE html>
<html lang="el-GR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="js/jQuery.js"></script>
    <script src="jqui/jquery-ui.min.js"></script>
    <script src="js/selectDates.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="jqui/jquery-ui.theme.min.css"> -->
    <link rel="stylesheet" href="jqui/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="jqui/jquery-ui.min.css">
    <link rel="stylesheet" href="styles/selectDates.css">
    <link rel="stylesheet" href="styles/sidebar.css">
    <title>DateX + Λήξεις περιόδου</title>
</head>

<body>
    <div class="print">
        <img src="img/print_icon.png" alt="print">
    </div>
    <?php include 'sidebar.html' ?>
    <div class="pageTitle">
        <h2 class="titleText">Χρονικός προσδιορισμός</h2>
        <div class="titleImg"></div>
    </div>
    <form action="getExDates.php" method="get">
        <div class="topinputs">
            <input type="text" class="datepicker" name="from_date" id="from_date" value="" autocomplete="off">
            <input type="text" class="datepicker" name="until_date" id="until_date" value="" autocomplete="off">
            <div class="filter" id="get_exdates"><img src="img/down2_icon.png" alt="add"></div>
        </div>
    </form>
    </br>
    <div class="result_area"></div>
</body>

</html>