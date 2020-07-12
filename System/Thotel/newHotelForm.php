<?php
    session_start();
    include '../db_connect_conf.php';
?>

<html>
<head><meta charset="UTF-8">
<title>Add hotel</title>
<link rel="stylesheet" type="text/css" href="css/newHotel.css">
<link rel="stylesheet" type="text/css" href="../jqui/jquery-ui.css">
<script type="text/javascript" src="../jsq/jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="../jqui/jquery-ui.min.js"></script>
</head>
<body>
   <div id='home-logo' ><a href='../home.php'></a></div>
   <img id='bg' src='../background/waves_beach.jpg'>
    <h2 id='form-title'> Add hotel </h2>
    <form id='newHotel' method='post' action='insertIntoHotelTable.php'>
       <span class="section-title">New hotel info</span>
        <div id='top-text-inputs'>
            <div id='hname' class='text-input'>
                <label for='HName-input'> Name <span class='req'> *</span></label>
                <div class="input-container">
                   <input type='text' id='HName-input' name='HName' autofocus placeholder='Type here' required>
                </div>
            </div>
            <div id='harea' class='text-input'>
                <label for='HArea-input'> Area </label>
                <div class="input-container">
                   <input type='text' id='HArea-input' name='HArea' placeholder='Type here'>
                </div>
            </div>
            <div id='hphone' class='text-input'>
                <label for='HPhone-input'> Phone </label>
                <div class="input-container">
                   <input type='text' id='HPhone-input' name='HPhone' placeholder='Type here'>
                </div>
            </div>
        </div>
        <span class="section-title">Queueing the new hotel direction West</span>
        <div id='mid-location-hotel'>
            <div id='hprev' class='text-input'>
                <label for='prevhotel'> Previous Hotel <span class='req'> *</span></label>
                <div class="input-container">
                   <input type="text" id="prevhotel" name="prevhotel" required placeholder='Type here'>
                   <input type="text" id="prevhotelID" name="prevhotelID" hidden required>
                </div>
            </div>
            <div id='hnext' class='text-input'>
                <label for='nexthotel'> Next Hotel <span class='req'> *</span></label>
                <div class="input-container">
                   <input type="text" id="nexthotel" name="nexthotel" required disabled placeholder="Filled automatically">
                   <input type="text" id="nexthotelID" name="nexthotelID" hidden required>
                </div>
            </div>
        </div>
        <span class="section-title">Hotel pickups for both directions</span>
        <div id='pickup-dropdowns'>
            <div id='pickupW-dropdown-block' class='text-input'>
                <label for='drop_pickupW'> Pickup West<span class='req'> *</span></label>
                <?php
                    $q = 'SELECT idPickup, PPoint FROM pickup';
                    $res = mysqli_query($conn, $q);
                    echo "<div class='select-container'>";
                    echo "<select id='drop_pickupW' name='dropdown-pickupW' value='-1' required><option value=''>Pickup Point</option>";
                    echo "<option value='0'>(no pickup point)</option>";
                    while($row = mysqli_fetch_array($res)) {
                      echo "<option value=".$row['idPickup'].">".$row['PPoint']."</option>";
                    }
                    echo "</select>";
                    echo "</div>";
                ?>
            </div>
            <div id='pickupE-dropdown-block' class='text-input'>
                <label for='drop_pickupE'> Pickup East<span class='req'> *</span></label>
                <?php
                    $q = 'SELECT idPickup, PPoint FROM pickup';
                    $res = mysqli_query($conn, $q);
                    echo "<div class='select-container'>";
                    echo "<select id='drop_pickupE' name='dropdown-pickupE' value='-1' required><option value=''>Pickup Point</option>";
                    echo "<option value='0'>(no pickup point)</option>";
                    while($row = mysqli_fetch_array($res)) {
                      echo "<option value=".$row['idPickup'].">".$row['PPoint']."</option>";
                    }
                    echo "</select>";
                    echo "</div>";
                ?>
            </div>
        </div>
        <span class="section-title">Notes / Additional info</span>
        <div id="bottom-section">
           <div id='notes' class='text-input'>
               <label for='notes-input'> Notes </label>
               <div class="input-container">
                  <input type='text' id='notes-input' name='notes' placeholder='Type here'>
               </div>
           </div>
        </div>
        <input type='text' id='htime_send' name='htime' style='visibility:hidden'>
        <button type="submit" id='addbtn'> Add </button>
    </form>
    <script src="js/newHotelFormActions.js"></script>
</body>
</html>
<!--  FINISHED  -->
