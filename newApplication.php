<?php
   include 'db_connect_conf.php';
   $maxid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT max(applicationID)+1 AS maxid FROM application"));
   $newid = $maxid['maxid'];
 ?>

 <html>
    <head>
       <meta charset="utf-8">
       <title>New application</title>
       <link rel="stylesheet" type="text/css" href="css/newApplication.css">
       <link rel="stylesheet" type="text/css" href="jqui/jquery-ui.min.css">
       <link rel="stylesheet" type="text/css" href="jqui/jquery-ui.theme.min.css">
       <script src="js/jquery-3.1.0.min.js"></script>
       <script src="jqui/jquery-ui.min.js"></script>
       <!-- <link href="bootstrap411/css/bootstrap.min.css" rel="stylesheet"> -->
    </head>
    <body>
      <form class="application-form" action="dbAddApplication.php" method="post">
         <div class="table-wrapper-small">
            <table id="idtable">
               <thead>
                  <tr>
                     <th scope="col">No. ΑΙΤΗΣΗΣ(*)</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td> <input type="text" name="appno" class="top-table-input" value="<?php echo $newid ?>" required> </td>
                  </tr>
               </tbody>
            </table>
         </div>
         <div class="table-wrapper">
            <table id="datatable">
               <thead>
                  <tr>
                     <th scope="col">ΓΛΩΣΣΑ(*)</th>
                     <th scope="col">ΤΑΞΗ(*)</th>
                     <th scope="col">ΤΜΗΜΑ(*)</th>
                     <th scope="col">ΣΧ. ΕΤΟΣ</th>
                     <th scope="col">ΗΜΕΡΟΜΗΝΙΑ</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>
                        <select class="sel-item" name="lang" required>
                           <option value="0">Επιλέξτε</option>
                           <?php
                              $cl = mysqli_query($conn, "SELECT * FROM langs");
                              if(@mysqli_num_rows($cl)>0){
                                 while ($c = mysqli_fetch_assoc($cl)) {
                                    $val = $c['langID'];
                                    $cname = $c['langName'];
                                    echo "<option value='$val'>$cname</option>";
                                 }
                              }
                            ?>
                         </select>
                     </td>
                     <td> <input type="text" name="class" class="top-table-input" required> </td>
                     <td> <input type="text" name="dept" class="top-table-input" required> </td>
                     <td> <input type="text" name="schyear" class="top-table-input"> </td>
                     <td> <input type="text" id='date' name="date" class="top-table-input" autocomplete="off" value="<?php echo date('d/m/Y') ?>"> </td>
                  </tr>
               </tbody>
            </table>
         </div>
         <h1>ΑΙΤΗΣΗ ΕΓΓΡΑΦΗΣ</h1>
         <span class="bordered-text">Συμπληρώστε τα στοιχεία και βάλτε 'Χ' στις ανάλογες επιλογές. Όλα τα στοιχεία είναι εμπιστευτικά</span>
         <span class="input-title">ΣΤΟΙΧΕΙΑ ΕΓΓΡΑΦΟΜΕΝΟΥ ΠΑΙΔΙΟΥ</span>
         <input type="text"  id="stType" name="stType" value="new" style="display:none">
         <div class="input-container">
            <div class="form-item">
               <label for="lName">Επίθετο(*)</label>
               <div class="input-item">
                  <input type="text" class="form-text" id="lName" name="lName" required>
               </div>
            </div>
            <div class="form-item">
               <label for="fName">Όνομα(*)</label>
               <div class="input-item">
                  <input type="text" class="form-text" id="fName" name="fName" required>
               </div>
            </div>
            <div class="form-item">
               <div class="check-title">Φύλο</div>
               <div class="form-check-block">
                  <div class="form-check-item">
                     <input type="radio" class="form-check-input" id="boy" name="sex" value="1">
                     <label class="form-check-label" for="boy">ΑΓΟΡΙ</label>
                  </div>
                  <div class="form-check-item">
                     <input type="radio" class="form-check-input" id="girl" name="sex" value="0">
                     <label class="form-check-label" for="girl">ΚΟΡΙΤΣΙ</label>
                  </div>
               </div>
            </div>
            <div class="form-item">
               <label for="bplace">Τόπος γέννησης</label>
               <div class="input-item">
                  <input type="text" class="form-text" id="bplace" name="bplace">
               </div>
            </div>
            <div class="form-item">
               <label for="bdate">Ημερομηνία γέννησης(*)</label>
               <div class="input-item">
                  <input type="text" class="form-date" id="bdate" name="bdate" autocomplete="off">
               </div>
            </div>
            <div class="form-item">
               <label for="ctznship">Υπηκοότητα</label>
               <div class="input-item">
                  <input type="text" class="form-text" id="ctznship" name="ctznship">
               </div>
            </div>
            <div class="form-item">
               <label for="sel-gr-class">Τάξη ελληνικού σχολείου</label>
               <div class="select-item">
                  <select class="sel-item" name="sel-gr-class" id="sel-gr-class">
                     <option value="0">Επιλέξτε</option>
                     <?php
                        $cl = mysqli_query($conn, "SELECT * FROM grclass");
                        if(@mysqli_num_rows($cl)>0){
                           while ($c = mysqli_fetch_assoc($cl)) {
                              $val = $c['classID'];
                              $cname = $c['className'];
                              echo "<option value='$val'>$cname</option>";
                           }
                        }
                      ?>
                  </select>
               </div>
            </div>
            <div class="form-item">
               <label for="school">Σχολείο</label>
               <div class="input-item">
                  <input type="text" class="form-text" id="school"  name="school">
               </div>
            </div>
            <div class="form-item">
               <label for="addr">Διεύθυνση</label>
               <div class="input-item">
                  <input type="text" class="form-text" id="addr"  name="addr">
               </div>
            </div>
            <div class="form-item">
               <label>Τηλέφωνα</label>
               <div class="input-items">
                  <input type="text" class="form-text" id="phone1"  name="phone1">
                  <input type="text" class="form-text" id="phone2"  name="phone2">
                  <input type="text" class="form-text" id="phone3"  name="phone3">
               </div>
            </div>
         </div>
         <span class="input-title">ΣΤΟΙΧΕΙΑ ΠΑΤΕΡΑ</span>
         <div class="input-container">
            <div class="form-item">
               <label for="flName">Επίθετο</label>
               <div class="input-item">
                  <input type="text" class="form-text" id="flName" name="flName">
               </div>
            </div>
            <div class="form-item">
               <label for="ffName">Όνομα</label>
               <div class="input-item">
                  <input type="text" class="form-text" id="ffName" name="ffName">
               </div>
            </div>
            <div class="form-item">
               <label for="fOccup">Επάγγελμα</label>
               <div class="input-item">
                  <input type="text" class="form-text" id="fOccup" name="fOccup">
               </div>
            </div>
            <div class="form-item">
               <label for="fIDno">Αριθμός Δελτίου Ταυτότητας</label>
               <div class="input-item">
                  <input type="text" class="form-text" id="fIDno" name="fIDno">
               </div>
            </div>
         </div>
         <span class="input-title">ΣΤΟΙΧΕΙΑ ΜΗΤΕΡΑΣ</span>
         <div class="input-container">
            <div class="form-item">
               <label for="mlName">Επίθετο</label>
               <div class="input-item">
                  <input type="text" class="form-text" id="mlName" name="mlName">
               </div>
            </div>
            <div class="form-item">
               <label for="mfName">Όνομα</label>
               <div class="input-item">
                  <input type="text" class="form-text" id="mfName" name="mfName">
               </div>
            </div>
            <div class="form-item">
               <label for="mOccup">Επάγγελμα</label>
               <div class="input-item">
                  <input type="text" class="form-text" id="mOccup" name="mOccup">
               </div>
            </div>
            <div class="form-item">
               <label for="mIDno">Αριθμός Δελτίου Ταυτότητας</label>
               <div class="input-item">
                  <input type="text" class="form-text" id="mIDno" name="mIDno">
               </div>
            </div>
         </div>
         <span class="input-title">ΣΤΟΙΧΕΙΑ ΚΗΔΕΜΟΝΑ</span>
         <div class="input-container">
            <div class="form-item">
               <div class="check-title">Κηδεμόνας είναι</div>
               <div class="form-check-block">
                  <div class="form-check-item">
                     <input class="form-check-input" type="radio" id="par" value="par" name="par" required checked>
                     <label class="form-check-label" for="par">ΟΙ ΓΟΝΕΙΣ</label>
                  </div>
                  <div class="form-check-item">
                     <input class="form-check-input" type="radio" id="fat" value="fat" name="par" required>
                     <label class="form-check-label" for="fat">Ο ΠΑΤΕΡΑΣ</label>
                  </div>
                  <div class="form-check-item">
                     <input class="form-check-input" type="radio" id="mot" value="mot" name="par" required>
                     <label class="form-check-label" for="mot">Η ΜΗΤΕΡΑ</label>
                  </div>
                  <div class="form-check-item">
                     <input class="form-check-input" type="radio" id="other" value="other" name="par" required>
                     <label class="form-check-label" for="other">ΑΛΛΟΣ</label>
                  </div>
               </div>
            </div>
            <span class="bordered-text">(Αν οι φυσικοί γονείς δεν είναι κηδεμόνες, συμπληρώστε τα στοιχεία κηδεμόνα παρακάτω)</span>
            <div class="form-item">
               <label for="plName">Επίθετο</label>
               <div class="input-item">
                  <input type="text" class="form-text" id="plName" name="plName" disabled>
               </div>
            </div>
            <div class="form-item">
               <label for="pfName">Όνομα</label>
               <div class="input-item">
                  <input type="text" class="form-text" id="pfName" name="pfName" disabled>
               </div>
            </div>
            <div class="form-item">
               <label for="pOccup">Επάγγελμα</label>
               <div class="input-item">
                  <input type="text" class="form-text" id="pOccup" name="pOccup" disabled>
               </div>
            </div>
            <div class="form-item">
               <label for="pAddr">Διεύθυνση</label>
               <div class="input-item">
                  <input type="text" class="form-text" id="pAddr" name="pAddr" disabled>
               </div>
            </div>
            <div class="form-item">
               <label>Τηλέφωνα</label>
               <div class="input-items">
                  <input type="text" class="form-text" id="pphone1"  name="pphone1" disabled>
                  <input type="text" class="form-text" id="pphone2"  name="pphone2" disabled>
                  <input type="text" class="form-text" id="pphone3"  name="pphone3" disabled>
               </div>
            </div>
            <div class="form-item">
               <label for="pIDno">Αριθμός Δελτίου Ταυτότητας</label>
               <div class="input-item">
                  <input type="text" class="form-text" id="pIDno" name="pIDno" disabled>
               </div>
            </div>
         </div>
         <span class="input-title">ΑΔΕΡΦΙΑ</span>
         <div class="input-container" id="sibs">
            <span class="bold-q">Έχει το παιδί αδερφό ή αδερφή που φοιτά τώρα στο σχολείο μας;</span>
            <div class="form-item">
               <div class="form-check-block">
                  <div class="form-check-item">
                     <input class="form-check-input" type="radio" id="nsib" name="sib" checked>
                     <label class="form-check-label" for="ysib">ΟΧΙ</label>
                  </div>
                  <div class="form-check-item">
                     <input class="form-check-input" type="radio" id="ysib" name="sib">
                     <label class="form-check-label" for="nsib">ΝΑΙ</label>
                     <span>Φοιτά στην <input type="text" name="sibclass" value="" id="sibclass" disabled> τάξη</span>
                  </div>
               </div>
            </div>
         </div>
         <span class="input-title">ΕΙΔΙΚΑ ΣΤΟΙΧΕΙΑ</span>
         <div class="input-container">
            <div class="form-item">
               <div class="check-title">Το παιδί θα φεύγει μόνο του από το σχολείο;</div>
               <div class="form-check-block">
                  <div class="form-check-item">
                     <input class="form-check-input" type="radio" id="yleave" name="leave" checked>
                     <label class="form-check-label" for="yleave">ΝΑΙ</label>
                  </div>
                  <div class="form-check-item">
                     <input class="form-check-input" type="radio" id="nleave" name="leave">
                     <label class="form-check-label" for="nleave">ΟΧΙ</label>
                  </div>
               </div>
            </div>
            <div class="form-item">
               <label for="accomp">Αν ΟΧΙ, ποιός θα το συνοδεύει;</label>
               <div class="input-item">
                  <input type="text" class="form-text" id="accomp"  name="accomp" disabled>
               </div>
            </div>
            <div class="form-item">
               <div class="check-title">Έχει το παιδί κάποιο χρόνιο πρόβλημα υγείας;</div>
               <div class="form-check-block">
                  <div class="form-check-item">
                     <input class="form-check-input" type="radio" id="ychronic" name="chron" >
                     <label class="form-check-label" for="ychronic">ΝΑΙ</label>
                  </div>
                  <div class="form-check-item">
                     <input class="form-check-input" type="radio" id="nchronic"  name="chron" checked>
                     <label class="form-check-label" for="nchronic">ΟΧΙ</label>
                  </div>
               </div>
            </div>
            <div class="desc-item">
               <label for="chronic">Αν ΝΑΙ, περιγράψτε το παρακάτω</label>
               <div class="textarea-item">
                  <textarea class="form-textarea" cols="70" rows="3" id="chronic" name="chronic" disabled></textarea>
               </div>
            </div>
            <div class="form-item">
               <div class="check-title">Έχει διαγνωσμένη μαθησιακή δυσκολία;</div>
               <div class="form-check-block">
                  <div class="form-check-item">
                     <input class="form-check-input" type="radio" id="ydiff" name="diff" >
                     <label class="form-check-label" for="ydiff">ΝΑΙ</label>
                  </div>
                  <div class="form-check-item">
                     <input class="form-check-input" type="radio" id="ndiff"  name="diff" checked>
                     <label class="form-check-label" for="ndiff">ΟΧΙ</label>
                  </div>
               </div>
            </div>
            <div class="desc-item">
               <label for="diff">Αν ΝΑΙ, περιγράψτε την παρακάτω</label>
               <div class="textarea-item">
                  <textarea class="form-textarea" cols="70" rows="3" id="diff"  name="diff" disabled></textarea>
               </div>
            </div>
            <div class="desc-item">
               <label id="long-q" for="note">Αν θέλετε να προσθέσετε οτιδήποτε νομίζετε πως πρέπει να γνωρίζουν οι δάσκαλοι, παρακαλούμε συμπληρώστε το παρακάτω</label>
               <div class="textarea-item">
                  <textarea class="form-textarea" cols="70" rows="3" id="note"  name="note"></textarea>
               </div>
            </div>
         </div>
         <button type="submit" name="button" id="btn">Αποθήκευση</button>
      </form>
    </body>
    <script src="js/newApplication.js"></script>
 </html>
 <!-- <script src="bootstrap411/js/bootstrap.min.js"></script> -->

 <?php
   mysqli_close($conn);
  ?>
