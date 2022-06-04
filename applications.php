<?php
   include 'db_connect_conf.php';
 ?>

 <!DOCTYPE html>
 <html>
    <head>
       <meta charset="utf-8">
       <title> Applications</title>
       <link rel="stylesheet" type="text/css" href="css/applications.css">
       <script src="js/jquery-3.1.0.min.js"></script>
       <script src="js/applications.js"></script>
       <script src="js/filterTable.js"></script>
       <link href="bootstrap411/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
      <div class="page-title">
         <h3> Αιτήσεις </h3>
         <input type="text" id="filterTable" onkeyup="applyFilter()" placeholder="Φίλτρο">
         <a href="students.php" target="_blank">Πίνακας μαθητών >></a>
      </div>
      <div class="table-wrapper">
         <table class="table table-striped table-hover">
            <thead class="thead-light" id="table-header">
               <tr>
                  <th scope="col" width="8%"># Αίτησης</th>
                  <th scope="col">Ον/μο μαθητή</th>
                  <th scope="col">Γλώσσα</th>
                  <th scope="col">Τάξη</th>
                  <th scope="col">Τμήμα</th>
                  <th scope="col">Ημ/νία εγγραφής</th>
                  <th scope="col" colspan="2" class="center">Ενέργειες</th>
               </tr>
            </thead>
            <tbody>
               <?php
                  $application = mysqli_query($conn, "SELECT * FROM application");
                  if(mysqli_num_rows($application)>0){
                     while($a = mysqli_fetch_assoc($application)){
                        $stID = $a['studentID'];
                        $langID = $a['apLang'];
                        $st = mysqli_fetch_assoc(mysqli_query($conn, "SELECT stFname, stLname FROM students WHERE studentID=$stID"));
                        $lang = mysqli_fetch_assoc(mysqli_query($conn, "SELECT langName FROM langs WHERE langID=$langID"));
                        $st = $st['stLname']." ".$st['stFname'];
                        $lang = $lang['langName'];
                        echo "
                           <tr>
                              <th scope='row'>".$a['applicationID']."</th>
                              <td>".$st."</td>
                              <td>".$lang."</td>
                              <td>".$a['stClass']."</td>
                              <td>".$a['stDept']."</td>
                              <td>".date('d/m/Y', strtotime($a['apDate']))."</td>
                              <td class='edittd'><a href='viewApplication.php?apID=".$a['applicationID']."'>Προβολή/Επεξεργασία</a></td>
                              <td class='deltd'><a href='#'>Διαγραφή</a></td>
                           </tr>
                        ";
                     }
                  }
               ?>
            </tbody>
         </table>
      </div>
      <table class="table" id="single-row">
         <tr class="bg-success link" onclick="location.href='newApplication.php'" id="new-application">
            <th scope="row" class="white" width="8%">+</th>
            <th class="center white">Νέα αίτηση</th>
         </tr>
      </table>
    </body>
 </html>
 <script src="bootstrap411/js/bootstrap.min.js"></script>

 <?php
   mysqli_close($conn);
  ?>
