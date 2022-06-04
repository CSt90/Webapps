<?php

   if(isset($_POST['fID'])){
      include 'db_connect_conf.php';
      $fID = $_POST['fID'];
      $query = mysqli_query($conn, "SELECT * FROM father WHERE fatherID = $fID");

      if (@mysqli_num_rows($query) == 1) {
         $fData = mysqli_fetch_assoc($query);
         $fData = join($fData, '|');
         echo $fData;
      }
   }

 ?>
