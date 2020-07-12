<?php
    session_start();
    include '../db_connect_conf.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Select Invoices</title>
        <link rel="stylesheet" type="text/css" href="css/selectInvoices.css">
        <link rel="stylesheet" type="text/css" href="../jqui/jquery-ui.css">
        <script src="../jsq/jquery-3.1.0.min.js"></script>
        <script src="../jqui/jquery-ui.min.js"></script>
    </head>
    <body>
		<div id='home-logo' ><a href='../home.php'></a></div>
		<img id='bg' src='../background/waves_beach.jpg'></img>
      <h2 id='form-title'> Invoice Data Selection </h2>
      <form id='get-invoice' type='get' action='invoice.php' target='_blank'>
          <span class="section-title">Select Office and Date Range</span>
          <div id='form-top-inputs'>
              <div id='office-dropdown-block'>
                 <label for='drop_office'> Office </label>
                  <?php
                      $q = 'SELECT idOffice, OName FROM office';
                      $res = mysqli_query($conn, $q);
                      echo "<div class='select-container'>";
                      echo "<select id='drop_office' name='dropdown-office' value='-1' required><option value=''>Select</option>";
                      while($row = mysqli_fetch_array($res)) {
                        echo "<option value=".$row['idOffice'].">".$row['OName']."</option>";
                      }
                      echo "</select>";
                      echo "</div>";
                  ?>
              </div>
              <!-- not required, but if not filled in, all reservations will be shown instead -->
              <div id='date-from-block' class='date-block'>
                  <label for='fromDate' id='from-date-label'> From </label>
                  <div class="input-container">
                     <input type='text' name='fromDate' id='fromDate' placeholder='Date from' required>
                  </div>
              </div>
              <div id='date-to-block' class='date-block'>
                  <label for='toDate' id='until-date-label'> Until </label>
                  <div class="input-container">
                     <input type='text' name='toDate' id='toDate'placeholder='Date to'>
                  </div>
              </div>
          </div>
          <span class="section-title">Select Additional Information</span>
          <div id='form-bottom-inputs'>
              <div id='select-columns-left'>
                  <div class='check-row'>
                      <input type="checkbox" id='chk-resno' name='columns[0]' value="resno">
                      <label for='chk-resno'>Reservation No</label>
                  </div>
                  <div class='check-row'>
                      <input type="checkbox" id='chk-resid' name='columns[1]' value="resid" checked>
                      <label for='chk-resid'>Reservation ID</label>
                  </div>
                  <div class='check-row'>
                      <input type="hidden" id='chk-voucher-hidden' name='columns[2]' value="voucher" checked>
                      <input type="checkbox" id='chk-voucher' name='columns[2]' value="voucher" checked disabled>
                      <label for='chk-voucher'>Voucher</label>
                  </div>
                  <div class='check-row'>
                      <input type="hidden" id='chk-lastname-hidden' name='columns[3]' value="lastname" checked>
                      <input type="checkbox" id='chk-lastname' name='columns[3]' value="lastname" checked disabled>
                      <label for='chk-lastname'>Last Name</label>
                  </div>
                  <div class='check-row'>
                      <input type="checkbox" id='chk-adults' name='columns[4]' value="adults" checked>
                      <label for='chk-adults'>Adults</label>
                  </div>
                  <div class='check-row'>
                      <input type="checkbox" id='chk-kids' name='columns[5]' value="kids" checked>
                      <label for='chk-kids'>Kids</label>
                  </div>
                  <div class='check-row'>
                      <input type="checkbox" id='chk-infants' name='columns[6]' value="infants">
                      <label for='chk-infants'>Infants</label>
                  </div>
                  <div class='check-row'>
                      <input type="checkbox" id='chk-hotel' name='columns[7]' value="hotel" checked>
                      <label for='chk-hotel'>Hotel</label>
                  </div>
                  <div class='check-row'>
                      <input type="checkbox" id='chk-room' name='columns[8]' value="room" checked>
                      <label for='chk-room'>Room</label>
                  </div>
                  <div class='check-row'>
                      <input type="hidden" id='chk-paid-hidden' name='columns[9]' value="paid" checked>
                      <input type="checkbox" id='chk-paid' name='columns[9]' value="paid" checked disabled>
                      <label for='chk-paid'>Paid</label>
                  </div>
                  <div class='check-row'>
                      <input type="checkbox" id='chk-seller' name='columns[10]' value="seller">
                      <label for='chk-seller'>Seller</label>
                  </div>
              </div>
              <div id='select-columns-right'>
                  <div class='check-row'>
                      <input type="hidden" id='chk-excursion-hidden' name='columns[11]' value="excursion" checked>
                      <input type="checkbox" id='chk-excursion' name='columns[11]' value="excursion" checked disabled>
                      <label for='chk-excursion'>Excursion</label>
                  </div>
                  <div class='check-row'>
                      <input type="checkbox" id='chk-excursionDate' name='columns[12]' value="excursionDate">
                      <label for='chk-excursionDate'>Excursion Date</label>
                  </div>
                  <div class='check-row'>
                      <input type="checkbox" id='chk-ppoint' name='columns[13]' value="ppoint">
                      <label for='chk-ppoint'>Pickup Point</label>
                  </div>
                  <div class='check-row'>
                      <input type="checkbox" id='chk-ptime' name='columns[14]' value="ptime">
                      <label for='chk-ptime'>Pickup Time</label>
                  </div>
                  <div class='check-row'>
                      <input type="checkbox" id='chk-lang' name='columns[15]' value="lang">
                      <label for='chk-lang'>Language</label>
                  </div>
                  <div class='check-row'>
                      <input type="checkbox" id='chk-nat' name='columns[16]' value="nat">
                      <label for='chk-nat'>Nationality</label>
                  </div>
                  <div class='check-row'>
                      <input type="checkbox" id='chk-resDate' name='columns[17]' value="resDate" checked>
                      <label for='chk-resDate'>Reservation Date</label>
                  </div>
                  <div class='check-row'>
                      <input type="checkbox" id='chk-pob' name='columns[18]' value="pob">
                      <label for='chk-resDate'>POB</label>
                  </div>
                  <div class='check-row'>
                      <input type="checkbox" id='chk-noshow' name='columns[19]' value="noshow">
                      <label for='chk-resDate'>Noshow</label>
                  </div>
                  <div class='check-row'>
                      <input type="checkbox" id='chk-crate' name='columns[20]' value="crate" checked>
                      <label for='chk-resDate'>Commission Rate</label>
                  </div>
                  <div class='check-row'>
                      <input type="checkbox" id='chk-comm' name='columns[21]' value="comm" checked>
                      <label for='chk-resDate'>Commission</label>
                  </div>
                  <!-- 'crate' => 0, 'ctype' => 0, 'comm' => 0 -->
              </div>
          </div>
          <button id='submit' type='submit'> Go </button>
      </form>
    </body>
    <script src="js/selectInvoices.js"></script>
</html>
<?php mysqli_close($conn); ?>
<!--  FINISHED  -->
