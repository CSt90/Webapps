<?php
   if (isset($_POST['appID'])) {
      $appID = intval(trim($_POST['appID']));
      // echo "appID: ".$appID;
      include 'db_connect_conf.php';
      $appID = mysqli_real_escape_string($conn, $appID);
      $del_q = "DELETE FROM application WHERE applicationID=$appID";
      // mysqli_query($del_q);
      echo "DELETED application #$appID";
   }
   else {
      echo 'appID ERROR';
   }
 ?>
