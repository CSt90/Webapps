<?php

   if(isset($_POST['mID'])){
      include 'db_connect_conf.php';
      $mID = $_POST['mID'];
      $query = mysqli_query($conn, "SELECT * FROM mother WHERE motherID = $mID");

      if (@mysqli_num_rows($query) == 1) {
         $mData = mysqli_fetch_assoc($query);
         $mData = join($mData, '|');
         echo $mData;
      }
   }

 ?>
