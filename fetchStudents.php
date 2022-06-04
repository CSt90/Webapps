<?php

   include 'db_connect_conf.php';

   $searchTerm = $_GET['term'];
   $students = mysqli_query($conn, "SELECT * FROM students WHERE stLname LIKE '%".$searchTerm."%' OR stFname LIKE '%".$searchTerm."%' ORDER BY studentID ASC");
   $st = array();
   if(mysqli_num_rows($students)>0){
      while($stud = mysqli_fetch_assoc($students)){
         $stID = $stud['studentID'];
         $stLname = $stud['stLname'];
         $stFname = $stud['stFname'];
         $item = "$stID - $stLname $stFname";
         array_push($st, $item);
      }
   }
   else {
      array_push($st, "+ Νέος Μαθητής +");
   }
   mysqli_close($conn);
   echo json_encode($st);
 ?>
