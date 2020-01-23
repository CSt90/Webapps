<?php
include 'db_connect_conf.php';
if (isset($_GET['pt'])) {
   $supplier = $_GET['pt'];
}
$suppliers = mysqli_query($conn, "SELECT * FROM supplier ORDER BY `supplierName`");
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
   <link rel="stylesheet" href="styles/home.css">
   <link rel="stylesheet" href="styles/sidebar.css">
   <title>DateX + Καταχώρηση λήξεων</title>
</head>

<body>
   <?php include 'sidebar.html' ?>
   <form class="insert" action="save_dates.php" method="post">
      <div class="topinfo">
         <select id="supplierSelect" name="pt" required>
            <option value="">Προμηθευτής</option>
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
         <input type="text" class="docid" name="docid" value="" autocomplete="off">
         <input type="text" class="datepicker" name="del_date" value="" autocomplete="off">
      </div>
      <table id="dates" border-collapse="collapse">
         <thead class="thead">
            <th><button type="button" class="add_row" title='Προσθήκη γραμμής πάνω από το ενεργό κελί'>+</button></th>
            <th>Ημ/νία λήξης <button type="button" class="add_cell" id="add_date_cell" title='Προσθήκη νέου κελιού πάνω από το ενεργό κελί'>+</button> </th>
            <th>Προιόν <button type="button" class="add_cell" id="add_item_cell" title='Προσθήκη νέου κελιού πάνω από το ενεργό κελί'>+</button> </th>
            <th>Τεμάχια <button type="button" class="add_cell" id="add_amt_cell" title='Προσθήκη νέου κελιού πάνω από το ενεργό κελί'>+</button> </th>
         </thead>
         <?php for ($i = 0; $i < 50; $i++) { ?>
            <tr class="row<?php echo ($i + 1) ?>">
               <td><?php echo ($i + 1) ?></td>
               <td><input type="text" name="exdate[]" class="exdate" value=""></td> <?php //2019-10-22 format
                                                                                    ?>
               <td><input type="text" name="item[]" class="item" value=""></td>
               <td><input type="text" name="volume[]" class="volume" value=""></td>
            </tr>
         <?php } ?>
      </table>
      <div class="submit"><img src="img/save_icon.png" alt="save"></div>
      <button class="submitb" style="display:none"> </button>
   </form>
</body>

</html>