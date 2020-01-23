<?php

   include 'db_connect_conf.php';

   $apID = $_POST['apid'];
   $application = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM application WHERE applicationID=$apID"));
   $stID = $application['studentID'];
   $student = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM students WHERE studentID=$stID"));
   $stPar = $student['stParVal'];
   $fatID = '';
   $motID = '';
   $parID = '';

   if ($stPar == 1) {
      $fatID = $student['stFath'];
      $motID = $student['stMoth'];
   }
   elseif ($stPar == 2) {
      $fatID = $student['stFath'];
   }
   elseif ($stPar == 3) {
      $motID = $student['stMoth'];
   }
   elseif ($stPar == 4) {
      $parID = $student['stParent'];
   }
   // echo "student name: ".$student['stLname']." ".$student['stFname'];

   $update_Ap = "UPDATE application SET ";
   $update_St = "UPDATE students SET ";
   $update_Fat = "UPDATE father SET ";
   $update_Mot = "UPDATE mother SET ";
   $update_Par = "UPDATE parent SET ";

   $app_arr = array();
   $st_arr = array();
   $fat_arr = array();
   $mot_arr = array();
   $par_arr = array();

   if (isset($_POST['lang'])) {
      $lang = $_POST['lang'];
      array_push($app_arr, "apLang=$lang");
   }

   if (isset($_POST['class'])) {
      $class = $_POST['class'];
      array_push($app_arr, "stClass='$class'");
   }

   if (isset($_POST['dept'])) {
      $dept = $_POST['dept'];
      array_push($app_arr, "stDept='$dept'");
   }

   if (isset($_POST['schyear'])) {
      $schyear = $_POST['schyear'];
      array_push($app_arr, "stSchYear='$schyear'");
   }

   if (isset($_POST['date'])) {
      $date = str_replace('/', '-', $_POST['date']);
      $date = date('Y-m-d', strtotime($date));
      array_push($app_arr, "apDate='$date'");
   }

   if (isset($_POST['note'])) {
      $note = $_POST['note'];
      array_push($app_arr, "stNotes='$note'");
   }

   $update_Ap .= join($app_arr, ", ")." WHERE applicationID=$apID";
   echo "\n".$update_Ap."\n";

   if (isset($_POST['lName'])) {
      $lName = $_POST['lName'];
      array_push($st_arr, "stLname='$lName'");
   }

   if (isset($_POST['fName'])) {
      $fName = $_POST['fName'];
      array_push($st_arr, "stFname='$fName'");
   }

   if (isset($_POST['sex'])) {
      $sex = $_POST['sex'];
      array_push($st_arr, "stSex=$sex");
   }

   if (isset($_POST['lName'])) {
      $lName = $_POST['lName'];
      array_push($st_arr, "stLname='$lName'");
   }

   if (isset($_POST['bplace'])) {
      $bplace = $_POST['bplace'];
      array_push($st_arr, "stBirthPlace='$bplace'");
   }

   if (isset($_POST['bdate'])) {
      $bdate = str_replace('/', '-', $_POST['bdate']);
      $bdate = date('Y-m-d', strtotime($bdate));
      array_push($st_arr, "stBirthDate='$bdate'");
   }

   if (isset($_POST['ctznship'])) {
      $ctznship = $_POST['ctznship'];
      array_push($st_arr, "stCitizenship='$ctznship'");
   }

   if (isset($_POST['sel-gr-class'])) {
      $grclass = $_POST['sel-gr-class'];
      array_push($st_arr, "stGRClass=$grclass");
   }

   if (isset($_POST['school'])) {
      $school = $_POST['school'];
      array_push($st_arr, "stSchool='$school'");
   }

   if (isset($_POST['addr'])) {
      $addr = $_POST['addr'];
      array_push($st_arr, "stAddress='$addr'");
   }

   if (isset($_POST['school'])) {
      $school = $_POST['school'];
      array_push($st_arr, "stSchool='$school'");
   }

   if (isset($_POST['phone1'])) {
      $phone1 = $_POST['phone1'];
      array_push($st_arr, "stPhone1='$phone1'");
   }

   if (isset($_POST['phone2'])) {
      $phone2 = $_POST['phone2'];
      array_push($st_arr, "stPhone2='$phone2'");
   }

   if (isset($_POST['phone3'])) {
      $phone3 = $_POST['phone3'];
      array_push($st_arr, "stPhone3='$phone3'");
   }

   if (isset($_POST['chronic'])) {
      $chronic = $_POST['chronic'];
      array_push($st_arr, "stChron='$chronic'");
   }

   if (isset($_POST['diff'])) {
      $diff = $_POST['diff'];
      array_push($st_arr, "stDiff='$diff'");
   }

   $update_St .= join($st_arr, ", ")." WHERE studentID=$stID";
   echo "\n".$update_St."\n";


   //echo "POST array: ";
   print_r($_POST);
   //echo json_encode($_POST);
   // echo $_POST['dept'];

 ?>
