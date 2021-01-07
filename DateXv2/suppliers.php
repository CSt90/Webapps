<?php
include 'db_connect_conf.php';

$suppliers = mysqli_query($conn, "SELECT* FROM `supplier`");


?>

<!DOCTYPE html>
<html lang="el-GR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="js/jQuery.js"></script>
    <script src="jqui/jquery-ui.min.js"></script>
    <script src="js/home.js"></script>
    <script src="js/dateForm.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="jqui/jquery-ui.theme.min.css"> -->
    <link rel="stylesheet" href="jqui/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="jqui/jquery-ui.min.css">
    <link rel="stylesheet" href="styles/suppliers.css">
    <link rel="stylesheet" href="styles/sidebar.css">
    <title>DateX - Προμηθευτές</title>
</head>

<body>
    <?php include 'sidebar.html' ?>
    <div class="pageΗeader">
        <h2 class="tableTitle">Προμηθευτές</h2>
        <h2 class="addSupplierBtn">+ Νέος προμηθευτής</h2>
    </div>
    <div class="tableWrapper">
        <table id='suppliers'>
            <col style="width:2%">
            <col style="width:5%">
            <col style="width:41%">
            <col style="width:1%">
            <col style="width:1%">
            <thead class="thead">
                <th></th>
                <th>Κ.Κ.</th>
                <th>Προμηθευτής</th>
                <th> </th>
                <th> </th>
            </thead>
            <?php
            if (@mysqli_num_rows($suppliers) > 0) {
                $j = 1;
                while ($i = mysqli_fetch_array($suppliers)) {
                    $id = $i['supplierID'];
                    $sName = $i['supplierName'];
            ?>
                    <tr class="row<?php echo $j ?>">
                        <td><?php echo $j ?></td>
                        <td class="supplier_id"><?php echo $id ?></td>
                        <td><input type="text" size="50" class="supplier_name" value="<?php echo $sName ?>" disabled></td>
                        <td><div class="edit"></div></td>
                        <td><div class="del"></div></td>
                    </tr>


            <?php
                    $j++;
                }
            }

            ?>
        </table>
    </div>
</body>

</html>

<?php
    mysqli_close($conn);
?>