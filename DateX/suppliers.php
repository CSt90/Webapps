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
    <!-- <link rel="stylesheet" href="jqui/jquery-ui.theme.min.css"> -->
    <link rel="stylesheet" href="jqui/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="jqui/jquery-ui.min.css">
    <link rel="stylesheet" href="styles/suppliers.css">
    <link rel="stylesheet" href="styles/sidebar.css">
    <title>DateX - Προμηθευτές</title>
</head>

<body>
    <?php include 'sidebar.html' ?>
    <table id='suppliers'>
        <col style="width:2%">
        <col style="width:5%">
        <col style="width:41%">
        <col style="width:8%">
        <col style="width:8%">
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
                    <td class="edit">Επεξεργασία</td>
                    <td class="delete">Διαγραφή</td>
                </tr>


        <?php
                $j++;
            }
        }

        ?>
    </table>

</body>

</html>