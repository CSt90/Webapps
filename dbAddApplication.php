<?php

   if (isset($_POST['appno']) && is_numeric($_POST['appno'])) {
      include 'db_connect_conf.php';
      echo "success</br>";
      $appno = $_POST['appno'];

      $values = "VALUES()";

      $application_fields = array();
      $ap_val = array();
      $students_fields = array();
      $st_val = array();
      $st_update = array();
      $father_fields = array();
      $f_val = array();
      $f_update = array();
      $mother_fields = array();
      $m_val = array();
      $m_update = array();
      $parent_fields = array();
      $p_val = array();
      $p_update = array();

      if($_POST['stType'] == 'new'){
         $action = 'insert';
      }
      else if($_POST['stType'] == 'existing'){
         $action = 'update';
      }

      $insert_ap = "INSERT INTO application"; //this is definitely only insert
      array_push($application_fields, "`applicationID`");
      array_push($ap_val, $appno);

      $insert_st = "INSERT INTO students"; //can be insert or update
      // array_push($students_fields, "`studentID`");

      $insert_fat = "INSERT INTO father"; //can be insert or update
      // array_push($father_fields, "`fatherID`");

      $insert_mot = "INSERT INTO mother"; //can be insert or update
      // array_push($mother_fields, "`motherID`");

      $insert_par = "INSERT INTO parent"; //can be insert or update
      // array_push($parent_fields, "`parentID`");

      if (isset($_POST['lang'])) { //application
         $lang = $_POST['lang'];
         array_push($application_fields, "`apLang`");
         array_push($ap_val, "$lang");
      }

      if (isset($_POST['class'])) { //application
         $class = trim($_POST['class']);
         array_push($application_fields, "`stClass`");
         array_push($ap_val, "'$class'");
      }

      if (isset($_POST['dept'])) { //application
         $dept = trim($_POST['dept']);
         array_push($application_fields, "`stDept`");
         array_push($ap_val, "'$dept'");
      }

      if (isset($_POST['schyear']) && trim($_POST['schyear'])!='') { //application
         $schyear = trim($_POST['schyear']);
         array_push($application_fields, "`stSchYear`");
         array_push($ap_val, "'$schyear'");
      }

      if (isset($_POST['date'])  && trim($_POST['date'])!='') { //application
         $date = $_POST['date'];
         $date = str_replace('/', '-', $date);
         $date = date('Y-m-d', strtotime($date));
         echo $date."</br>";
         array_push($application_fields, "`apDate`");
         array_push($ap_val, "'$date'");
      }

      if (isset($_POST['lName'])) { //students
         $lName = trim($_POST['lName']);
         echo $lName."</br>";
         array_push($students_fields, "`stLname`");
         array_push($st_val, "'$lName'");
         array_push($st_update, "stLname='$lName'");
      }

      if (isset($_POST['fName'])) {  //students
         $fName = $_POST['fName'];
         array_push($students_fields, "`stFname`");
         array_push($st_val, "'$fName'");
         array_push($st_update, "stFname='$fName'");
      }

      if (isset($_POST['sex']) && trim($_POST['sex'])!='') { //students
         $sex = $_POST['sex'];
         array_push($students_fields, "`stSex`");
         array_push($st_val, "$sex");
         array_push($st_update, "stSex=$sex");
      }

      if (isset($_POST['bplace'])  && trim($_POST['bplace'])!='') { //students
         $bplace = $_POST['bplace'];
         array_push($students_fields, "`stBirthPlace`");
         array_push($st_val, "'$bplace'");
         array_push($st_update, "stBirthPlace='$bplace'");
      }

      if (isset($_POST['bdate'])) { //students
         $bdate = $_POST['bdate'];
         $bdate = str_replace('/', '-', $bdate);
         $bdate = date('Y-m-d', strtotime($bdate));
         array_push($students_fields, "`stBirthDate`");
         array_push($st_val, "'$bdate'");
         array_push($st_update, "stBirthDate='$bdate'");
      }

      if (isset($_POST['ctznship']) && trim($_POST['ctznship'])!='') { //students
         $ctznship = $_POST['ctznship'];
         array_push($students_fields, "`stCitizenship`");
         array_push($st_val, "'$ctznship'");
         array_push($st_update, "stCitizenship='$ctznship'");
      }

      if (isset($_POST['sel-gr-class']) && trim($_POST['sel-gr-class'])!='') { //students
         $grClass = $_POST['sel-gr-class'];
         array_push($students_fields, "`stGRClass`");
         array_push($st_val, "$grClass");
         array_push($st_update, "stGRClass='$grClass'");
      }

      if (isset($_POST['school']) && trim($_POST['school'])!='') { //students
         $school = $_POST['school'];
         array_push($students_fields, "`stSchool`");
         array_push($st_val, "'$school'");
         array_push($st_update, "stSchool='$school'");
      }

      if (isset($_POST['addr']) && trim($_POST['addr'])!='') { //students
         $addr = $_POST['addr'];
         array_push($students_fields, "`stAddress`");
         array_push($st_val, "'$addr'");
         array_push($st_update, "stAddress='$addr'");
      }

      if (isset($_POST['phone1']) && trim($_POST['phone1'])!='') { //students
         $phone1 = $_POST['phone1'];
         array_push($students_fields, "`stPhone1`");
         array_push($st_val, "$phone1");
         array_push($st_update, "stPhone1=$phone1");
      }

      if (isset($_POST['phone2']) && trim($_POST['phone2'])!='') { //students
         $phone2 = $_POST['phone2'];
         array_push($students_fields, "`stPhone2`");
         array_push($st_val, "$phone2");
         array_push($st_update, "stPhone2=$phone2");
      }

      if (isset($_POST['phone3']) && trim($_POST['phone3'])!='') { //students
         $phone3 = $_POST['phone3'];
         array_push($students_fields, "`stPhone3`");
         array_push($st_val, "$phone3");
         array_push($st_update, "stPhone3=$phone3");
      }

      if (isset($_POST['sibclass']) && trim($_POST['sibclass'])!='') { //students
         $sibClass = $_POST['sibclass'];
         array_push($students_fields, "`stSibClass`");
         array_push($st_val, "'$sibClass'");
         array_push($st_update, "stSibClass='$sibClass'");
      }

      if (isset($_POST['accomp']) && trim($_POST['accomp'])!='') { //application
         $accomp = $_POST['accomp'];
         array_push($application_fields, "`stAccomp`");
         array_push($ap_val, "'$accomp'");
      }

      if (isset($_POST['chronic']) && trim($_POST['chronic'])!='') { //students
         $chronic = $_POST['chronic'];
         array_push($students_fields, "`stChron`");
         array_push($st_val, "'$chronic'");
         array_push($st_update, "stChron='$chronic'");
      }

      if (isset($_POST['diff']) && trim($_POST['diff'])!='') { //students
         $diff = $_POST['diff'];
         array_push($students_fields, "`stDiff`");
         array_push($st_val, "'$diff'");
         array_push($st_update, "stDiff='$diff'");
      }

      if (isset($_POST['note']) && trim($_POST['note'])!='') { //application
         $note = $_POST['note'];
         array_push($application_fields, "`stNotes`");
         array_push($ap_val, "'$note'");
      }

      if(isset($_POST['par'])){
         $stParVal = $_POST['par'];
         if($stParVal == "par")
            $stParVal = 1;
         elseif ($stParVal == "fat")
            $stParVal = 2;
         elseif ($stParVal == "mot" )
            $stParVal = 3;
         else
            $stParVal = 4;
         array_push($students_fields, "`stParVal`");
         array_push($st_val, "$stParVal");
         array_push($st_update, "stParVal=$stParVal");
      }

      if(isset($_POST['par']) && ($_POST['par'] == "par" || $_POST['par'] == "fat")){
         if (isset($_POST['flName']) && trim($_POST['flName'])!='') { //father
            $flName = $_POST['flName'];
            array_push($father_fields, "`fLname`");
            array_push($f_val, "'$flName'");
            array_push($f_update, "fLname='$flName'");
         }

         if (isset($_POST['ffName']) && trim($_POST['ffName'])!='') { //father
            $ffName = $_POST['ffName'];
            array_push($father_fields, "`fFname`");
            array_push($f_val, "'$ffName'");
            array_push($f_update, "fFname='$ffName'");
         }

         if (isset($_POST['fOccup']) && trim($_POST['fOccup'])!='') { //father
            $fOccup = $_POST['fOccup'];
            $fOccup_q = "AND fOccupation = '$fOccup'";
            array_push($father_fields, "`fOccupation`");
            array_push($f_val, "'$fOccup'");
            array_push($f_update, "fOccupation='$fOccup'");
         }
         else {
            $fOccup_q = "";
         }

         if (isset($_POST['fIDno']) && trim($_POST['fIDno'])!='') { //father
            $fIDno = $_POST['fIDno'];
            $fIDno_q = "AND fIDno = '$fIDno'";
            array_push($father_fields, "`fIDno`");
            array_push($f_val, "'$fIDno'");
            array_push($f_update, "fIDno='$fIDno'");
         }
         else {
            $fIDno = "";
         }

         $fat_exist = mysqli_query($conn, "SELECT * FROM father WHERE fLname = '$flName' AND fFname = '$ffName' $fOccup_q $fIDno_q");
         echo "SELECT * FROM father WHERE fLname = '$flName' AND fFname = '$ffName' $fOccup_q $fIDno_q </br>";
         if (mysqli_num_rows($fat_exist) == 1) {
            $fat = mysqli_fetch_assoc($fat_exist);
            $fatID = $fat['fatherID'];
            $f_update = join($f_update, ",");
            $update_fat = "UPDATE father SET $f_update WHERE fatherID=$fatID";
            echo $update_fat."</br>";
            mysqli_query($conn, $update_fat) or die(mysqli_error($conn));
         }
         else {
            $fat_new = mysqli_query($conn, "SELECT MAX(fatherID) AS maxid FROM father");
            if(mysqli_num_rows($fat_new) == 1){
               $fatID = mysqli_fetch_assoc($fat_new);
               $fatID = intval($fatID['maxid'])+1;
               echo "max fatid is $fatID</br>";
               array_push($father_fields, "`fatherID`");
               array_push($f_val, "'$fatID'");
               $father_fields = join($father_fields, ",");
               $f_val = join($f_val, ",");
               $insert_fat = "INSERT INTO father($father_fields) VALUES($f_val)";
               echo $insert_fat."</br>";
               mysqli_query($conn, $insert_fat); echo(mysqli_error($conn));
            }
         }
         array_push($st_update, "stFath=$fatID");
         array_push($students_fields, "`stFath`");
         array_push($st_val, "$fatID");

         if ($_POST['par'] == "fat") {
            $pu = "f";
         }
         else {
            $pu = "fm";
         }
      }
      if(isset($_POST['par']) && ($_POST['par'] == "par" || $_POST['par'] == "mot")){
         if (isset($_POST['mlName']) && trim($_POST['mlName'])!='') { //mother
            $mlName = $_POST['mlName'];
            array_push($mother_fields, "`mLname`");
            array_push($m_val, "'$mlName'");
            array_push($m_update, "mLname='$mlName'");
         }

         if (isset($_POST['mfName']) && trim($_POST['mfName'])!='') { //mother
            $mfName = $_POST['mfName'];
            array_push($mother_fields, "`mFname`");
            array_push($m_val, "'$mfName'");
            array_push($m_update, "mFname='$mfName'");
         }

         if (isset($_POST['mOccup']) && trim($_POST['mOccup'])!='') { //mother
            $mOccup = $_POST['mOccup'];
            $mOccup_q = "AND mOccupation = '$mOccup'";
            array_push($mother_fields, "`mOccupation`");
            array_push($m_val, "'$mOccup'");
            array_push($m_update, "mOccupation='$mOccup'");
         }
         else {
            $mOccup_q = "";
         }

         if (isset($_POST['mIDno']) && trim($_POST['mIDno'])!='') { //mother
            $mIDno = $_POST['mIDno'];
            $mIDno_q = "AND mIDno = '$mIDno'";
            array_push($mother_fields, "`mIDno`");
            array_push($m_val, "'$mIDno'");
            array_push($m_update, "mIDno='$mIDno'");
         }
         else {
            $mIDno = "";
         }

         $mot_exist = mysqli_query($conn, "SELECT * FROM mother WHERE mLname = '$mlName' AND mFname = '$mfName' $mOccup_q $mIDno_q");
         echo "SELECT * FROM mother WHERE mLname = '$mlName' AND mFname = '$mfName' $mOccup_q $mIDno_q </br>";
         echo mysqli_num_rows($mot_exist);
         if (mysqli_num_rows($mot_exist) == 1) {
            $mot = mysqli_fetch_assoc($mot_exist);
            $motID = $mot['motherID'];
            $m_update = join($m_update, ",");
            $update_mot = "UPDATE mother SET $m_update WHERE motherID=$motID";
            echo $update_mot."</br>";
            mysqli_query($conn, $update_mot); echo(mysqli_error($conn));

         }
         else {
            $mot_new = mysqli_query($conn, "SELECT MAX(motherID) AS maxid FROM mother");
            if(mysqli_num_rows($mot_new) == 1){
               $motID = mysqli_fetch_assoc($mot_new);
               $motID = intval($motID['maxid'])+1;
               $m_insert = "";
               echo "max motid is $motID</br>";
               array_push($mother_fields, "`motherID`");
               array_push($m_val, "'$motID'");
               $mother_fields = join($mother_fields, ",");
               $m_val = join($m_val, ",");
               $insert_mot = "INSERT INTO mother($mother_fields) VALUES($m_val)";
               echo $insert_mot."</br>";
               mysqli_query($conn, $insert_mot); echo(mysqli_error($conn));
            }
         }
         array_push($st_update, "stMoth=$motID");
         array_push($students_fields, "`stMoth`");
         array_push($st_val, "$motID");

         if ($_POST['par'] == "mot") {
            $pu = "m";
         }
         else {
            $pu = "fm";
         }
      }
      if(isset($_POST['par']) && $_POST['par'] == "other"){
         if (isset($_POST['plName']) && trim($_POST['plName'])!='') { //parent
            $plName = $_POST['plName'];
            array_push($parent_fields, "`pLname`");
            array_push($p_val, "'$plName'");
            array_push($p_update, "pLname='$plName'");
         }

         if (isset($_POST['pfName']) && trim($_POST['pfName'])!='') { //parent
            $pfName = $_POST['pfName'];
            array_push($parent_fields, "`pFname`");
            array_push($p_val, "'$pfName'");
            array_push($p_update, "pFname='$pfName'");
         }

         if (isset($_POST['pOccup']) && trim($_POST['pOccup'])!='') { //parent
            $pOccup = $_POST['pOccup'];
            $pOccup_q = "AND pOccupation = '$pOccup'";
            array_push($parent_fields, "`pOccupation`");
            array_push($p_val, "'$pOccup'");
            array_push($p_update, "pOccupation='$pOccup'");
         }
         else {
            $pOccup_q = "";
         }

         if (isset($_POST['pAddr']) && trim($_POST['pAddr'])!='') { //parent
            $pAddr = $_POST['pAddr'];
            $pAddr_q = "AND pAddress = '$pAddr'";
            array_push($parent_fields, "`pAddress`");
            array_push($p_val, "'$pAddr'");
            array_push($p_update, "pAddress='$pAddr'");
         }
         else {
            $pAddr_q = "";
         }

         if (isset($_POST['pphone1']) && trim($_POST['pphone1'])!='') { //parent
            $pphone1 = $_POST['pphone1'];
            $pPhone1_q = "AND pPhone1 = $pphone1";
            array_push($parent_fields, "`pPhone1`");
            array_push($p_val, "$pphone1");
            array_push($p_update, "pPhone1=$pphone1");
         }
         else {
            $pPhone1_q = "";
         }

         if (isset($_POST['pphone2']) && trim($_POST['pphone2'])!='') { //parent
            $pphone2 = $_POST['pphone2'];
            $pphone2_q = "AND pPhone2 = $pphone2";
            array_push($parent_fields, "`pPhone2`");
            array_push($p_val, "$pphone2");
            array_push($p_update, "pPhone2=$pphone2");
         }

         if (isset($_POST['pphone3']) && trim($_POST['pphone3'])!='') { //parent
            $pphone3 = $_POST['pphone3'];
            $pphone3_q = "AND pPhone3 = $pphone3";
            array_push($parent_fields, "`pPhone3`");
            array_push($p_val, "$pphone3");
            array_push($p_update, "pPhone3=$pphone3");
         }

         if (isset($_POST['pIDno']) && trim($_POST['pIDno'])!='') { //parent
            $pIDno = $_POST['pIDno'];
            $pIDno_q = "AND pIDno = '$pIDno'";
            array_push($parent_fields, "`pIDno`");
            array_push($p_val, "'$pIDno'");
            array_push($p_update, "pIDno='$pIDno'");
         }
         else {
            $pIDno = "";
         }

         $par_exist = mysqli_query($conn, "SELECT * FROM parent WHERE pLname = '$plName' AND pFname = '$pfName' $pOccup_q $pAddr_q $pPhone1_q $pIDno_q");
         echo "SELECT * FROM parent WHERE pLname = '$plName' AND pFname = '$pfName' $pOccup_q $pAddr_q $pPhone1_q $pIDno_q </br>";
         if (mysqli_num_rows($par_exist) == 1) {
            $par = mysqli_fetch_assoc($par_exist);
            $parID = $par['parentID'];
            $p_update = join($p_update, ",");
            $update_par = "UPDATE parent $p_update WHERE parentID=$parID";
            echo $update_par."</br>";
            mysqli_query($conn, $update_par); echo(mysqli_error($conn));

         }
         else {
            $par_new = mysqli_query($conn, "SELECT MAX(parentID) AS maxid FROM parent");
            if(mysqli_num_rows($par_new) == 1){
               $parID = mysqli_fetch_assoc($par_new);
               $parID = intval($parID['maxid'])+1;
               $m_insert = "";
               echo "max parid is $parID</br>";
               array_push($parent_fields, "`parentID`");
               array_push($p_val, "'$parID'");
               $parent_fields = join($parent_fields, ",");
               $p_val = join($p_val, ",");
               $insert_par = "INSERT INTO parent($parent_fields) VALUES($p_val)";
               print_r($parent_fields);
               echo $insert_par."</br>";
               mysqli_query($conn, $insert_par); echo(mysqli_error($conn));
            }
         }
         array_push($st_update, "stParent=$parID");
         array_push($students_fields, "`stParent`");
         array_push($st_val, "$parID");
         $pu = "o";
      }

      $st_exist = mysqli_query($conn, "SELECT * FROM students WHERE stLname = '$lName' AND stFname = '$fName' AND stBirthDate = '$bdate'");
      echo "SELECT * FROM students WHERE stLname = '$lName' AND stFname = '$fName' AND stBirthDate = '$bdate'";
      echo "rows ".mysqli_num_rows($st_exist)."</br>";
      if (mysqli_num_rows($st_exist) > 0) {
         echo "exist</br>";
         $stID = mysqli_fetch_assoc($st_exist);
         $stID = $stID['studentID'];
         echo "existing id is $stID</br>";
      }
      else if (mysqli_num_rows($st_exist) <= 0) {
         $st_new = mysqli_query($conn, "SELECT MAX(studentID) AS maxid FROM students");
         if(mysqli_num_rows($st_new) == 1){
            $stID = mysqli_fetch_assoc($st_new);
            $stID = intval($stID['maxid'])+1;
            echo "new id is $stID</br>";
            array_push($students_fields, "`studentID`");
            array_push($st_val, "'$stID'");
         }
      }

      array_push($application_fields, "`studentID`");
      array_push($ap_val, "'$stID'");

      $application_fields = join($application_fields, ",");
      $ap_val = join($ap_val, ",");
      $insert_ap .= "($application_fields) VALUES($ap_val)";
      echo $insert_ap."</br>";
      mysqli_query($conn, $insert_ap);

      $students_fields = join($students_fields, ",");
      $st_val = join($st_val, ",");
      $st_update = join($st_update, ",");
      echo $action."</br>";
      if($action == "insert"){
         if(mysqli_num_rows($st_exist) <= 0)
            $st_q = "INSERT INTO students($students_fields) VALUES($st_val)";
         else
            $st_q = "UPDATE students SET $st_update WHERE studentID=$stID";
         if ($pu == "fm") {
            echo "UPDATE father SET studentID=$stID WHERE fatherID=$fatID"."</br>";
            mysqli_query($conn, "UPDATE father SET studentID=$stID WHERE fatherID=$fatID"); echo(mysqli_error($conn));
            echo "UPDATE mother SET studentID=$stID WHERE motherID=$motID"."</br>";
            mysqli_query($conn, "UPDATE mother SET studentID=$stID WHERE motherID=$motID"); echo(mysqli_error($conn));
         }
         elseif ($pu == "f") {
            echo "UPDATE father SET studentID=$stID WHERE fatherID=$fatID"."</br>";
            mysqli_query($conn, "UPDATE father SET studentID=$stID WHERE fatherID=$fatID"); echo(mysqli_error($conn));
         }
         elseif ($pu == "m") {
            echo "UPDATE mother SET studentID=$stID WHERE motherID=$motID"."</br>";
            mysqli_query($conn, "UPDATE mother SET studentID=$stID WHERE motherID=$motID"); echo(mysqli_error($conn));
         }
         else {
            echo "UPDATE parent SET studentID=$stID WHERE parentID=$parID"."</br>";
            mysqli_query($conn, "UPDATE parent SET studentID=$stID WHERE parentID=$parID"); echo(mysqli_error($conn));
         }
      }
      else {
         $st_q = "UPDATE students SET $st_update WHERE studentID=$stID";
      }
      echo $st_q."</br>";
      mysqli_query($conn, $st_q); echo(mysqli_error($conn));
      // echo mysqli_error($conn);
      echo '<button onclick="location.href=\'viewApplication.php?apID='.$appno.'\'">Continue</button>';
      // header("Location: viewApplication.php?apID=$appno");
      print_r($students_fields);
      die();
   }
   else {
      echo "problem";
   }

 ?>
