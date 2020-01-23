<?php
   include 'db_connect_conf.php';
 ?>

 <!DOCTYPE html>
 <html>
    <head>
       <meta charset="utf-8">
       <title> Πίνακας μαθητών </title>
       <link rel="stylesheet" type="text/css" href="css/students.css">
       <script src="js/jquery-3.1.0.min.js"></script>
       <!-- <script src="js/students.js"></script> -->
       <script src="js/filterTable.js"></script>
       <link href="bootstrap411/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>

      <div class="page-title">
         <h3> Μαθητές </h3>
         <input type="text" id="filterTable" onkeyup="applyFilter()" placeholder="Φίλτρο">
         <a href="students.php" target="_blank" style="visibility:hidden">Πίνακας μαθητών >></a>
      </div>
      <div class="table-wrapper">
         <table class="table table-striped table-hover">
            <thead class="thead-light" id="table-header">
               <tr>
                  <th scope="col">Α/Α</th>
                  <th scope="col">Ον/μο μαθητή</th>
                  <th scope="col">Ον/μο πατέρα</th>
                  <th scope="col">Ον/μο μητέρας</th>
                  <th scope="col">Ον/μο κηδεμόνα</th>
                  <th scope="col">Διεύθυνση</th>
                  <th scope="col">Τηλ. κατοικίας</th>
                  <th scope="col">Τηλ. πατέρα</th>
                  <th scope="col">Τηλ. μητέρας</th>
                  <th scope="col">Τηλ. κηδεμόνα</th>
               </tr>
            </thead>
            <tbody>
               <?php
                  $students = mysqli_query($conn, "SELECT * FROM students");
                  if(mysqli_num_rows($students)>0){
                     $i=0;
                     while($s = mysqli_fetch_assoc($students)){
                        $stID = $s['studentID'];
                        $st = $s['stLname']." ".$s['stFname'];
                        $stFath = $s['stFath'];
                        if ($stFath != '' && ($s['stParVal']==1 || $s['stParVal']==2)) {
                           $f = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM father WHERE fatherID=$stFath"));
                           $f = $f['fLname']." ".$f['fFname'];
                        }
                        else {
                           $f = '-';
                        }
                        $stMoth = $s['stMoth'];
                        if ($stMoth != '' && ($s['stParVal']==1 || $s['stParVal']==3)) {
                           $m = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM mother WHERE motherID=$stMoth"));
                           $m = $m['mLname']." ".$m['mFname'];
                        }
                        else {
                           $m = '-';
                        }
                        $stParent = $s['stParent'];
                        if ($stParent != '' && $s['stParVal']==4) {
                           $p = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM parent WHERE parentID=$stParent"));
                           $pPhone = array();
                           if($p['pPhone1'] != ''){
                              array_push($pPhone, $p['pPhone1']);
                           }
                           if($p['pPhone2'] != ''){
                              array_push($pPhone, $p['pPhone2']);
                           }
                           if($p['pPhone3'] != ''){
                              array_push($pPhone, $p['pPhone3']);
                           }
                           $pPhone = join($pPhone, ", ");
                           $p = $p['pLname']." ".$p['pFname'];
                        }
                        else {
                           $p = '-';
                           $pPhone = '-';
                        }
                        echo "
                        <tr>
                           <th scope='row'>".$i."</th>
                           <td>".$st."</td>
                           <td>".$f."</td>
                           <td>".$m."</td>
                           <td>".$p."</td>
                           <td>".($s['stAddress'] != '' ? $s['stAddress'] : '-')."</td>
                           <td>".$s['stPhone1']."</td>
                           <td>".($s['stPhone2'] != '' ? $s['stPhone2'] : '-')."</td>
                           <td>".($s['stPhone3'] != '' ? $s['stPhone3'] : '-')."</td>
                           <td>".$pPhone."</td>
                        </tr>";
                        $i++;
                     }
                  }
               ?>
            </tbody>
         </table>
      </div>
    </body>
 </html>
 <script src="bootstrap411/js/bootstrap.min.js"></script>
 <script type="text/javascript">
    $('#filterTable').on('focus', function(){
      $(this).attr('placeholder', '');
   });
   $('#filterTable').on('focusout', function(){
     $(this).attr('placeholder', 'Φίλτρο');
  });
 </script>

 <?php
   mysqli_close($conn);
  ?>
