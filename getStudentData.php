<?php

   if(isset($_POST['stID'])){
      include 'db_connect_conf.php';
      $stID = $_POST['stID'];
      $query = mysqli_query($conn, "SELECT * FROM students WHERE studentID = $stID");

      if (@mysqli_num_rows($query) == 1) {
         $stData = mysqli_fetch_assoc($query);
         $stData = join($stData, '|');
         echo $stData;
      }
   }

 ?>
