<?php

   if(isset($_POST['oID'])){
      include 'db_connect_conf.php';
      $oID = $_POST['oID'];
      $query = mysqli_query($conn, "SELECT * FROM parent WHERE parentID = $oID");

      if (@mysqli_num_rows($query) == 1) {
         $oData = mysqli_fetch_assoc($query);
         $oData = join($oData, '|');
         echo $oData;
      }
   }

 ?>
