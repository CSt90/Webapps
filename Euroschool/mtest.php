<?php
if (isset($_POST['mlName']) && trim($_POST['mlName'])!='') { //mother
   $mlName = $_POST['mlName'];
   array_push($mother_fields, "`mLname`");
   array_push($m_val, "'$mlName'");
   array_push($m_update, "mLname='$mlName'");
}

if (isset($_POST['mfName']) && trim($_POST['mfName'])!='') { //mother
   $mfName = $_POST['ffName'];
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
if (mysqli_num_rows($mot_exist) == 1) {
   $mot = mysqli_fetch_assoc($mot_exist);
   $motID = $mot['motherID'];
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
   }
}
array_push($st_update, "stMoth=$motID");

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

if (isset($_POST['pIDno']) && trim($_POST['pIDno'])!='') { //parent
   $pIDno = $_POST['pIDno'];
   $pIDno_q = "AND pIDno = '$pIDno'";
   array_push($parent_fields, "`mIDno`");
   array_push($p_val, "'$pIDno'");
   array_push($p_update, "pIDno='$pIDno'");
}
else {
   $pIDno = "";
}

$par_exist = mysqli_query($conn, "SELECT * FROM parent WHERE pLname = '$plName' AND pFname = '$pfName' $pOccup_q $pIDno_q");
echo "SELECT * FROM parent WHERE pLname = '$plName' AND pFname = '$pfName' $pOccup_q $pIDno_q </br>";
if (mysqli_num_rows($par_exist) == 1) {
   $par = mysqli_fetch_assoc($par_exist);
   $parID = $par['parentID'];
}
else {
   $par_new = mysqli_query($conn, "SELECT MAX(parentID) AS maxid FROM parent");
   if(mysqli_num_rows($par_new) == 1){
      $parID = mysqli_fetch_assoc($par_new);
      $parID = intval($parID['maxid'])+1;
      $m_insert = "";
      echo "max parid is $parID</br>";
      array_push($parent_fields, "`parentID`");
      array_push($m_val, "'$parID'");
   }
}
array_push($st_update, "stParent=$parID");
 ?>
