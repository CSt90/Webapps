<?php
    session_start();
    include '../db_connect_conf.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Cleanup</title>
        <link rel="stylesheet" type="text/css" href="css/cleanup.css">
		<link rel="stylesheet" type="text/css" href="css/popup.css">
        <script src="../jsq/jquery-3.1.0.min.js"></script>
        <script src="../jqui/jquery-ui.min.js"></script>
        <script src="js/filterExcs.js"></script>
    </head>
    <body>
        <input type="text" id="filterExcs" onkeyup="applyFilter()" placeholder="Search in the table..">
        <?php
            if (isset($_GET['dropdown-office']) && isset($_GET['fromDate']) && is_numeric($_GET['dropdown-office'])) {
                $idOffice = $_GET['dropdown-office'];
                $fromDate = $_GET['fromDate'];
                if (DateTime::createFromFormat('d-m-Y', $fromDate) !== FALSE){ //if{..} !== false --> is date
                   if(isset($_GET['toDate'])){
                       if(DateTime::createFromFormat('d-m-Y', $_GET['toDate']) !== FALSE){
                           $toDate = $_GET['toDate'];
                       }
                       else{
                           $toDate = date('d-m-Y');
                       }
                    }
					
					$from = date("Y-m-d", strtotime($fromDate));
					$until = date("Y-m-d", strtotime($toDate));
					
					if ($idOffice != '-10'){
						$OName = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM office WHERE idOffice = '$idOffice'"));
						$office = $OName['OName'];
						echo "<span id='ititle'>Reservations made by <span id='oname'>$office</span>"; //from <span id='fdate'>$fromDate</span> until <span id='tdate'>$toDate</span></span>
						//$deleted = mysqli_query($conn, "SELECT * FROM reservations WHERE ExDate>='$fromD' AND ExDate<='$untilD' AND ReservationOfficeID=$idOffice");
						$del_q = "DELETE FROM reservations WHERE (ExDate>='$from' AND ExDate<='$until) AND ReservationOfficeID=$idOffice'";
						mysqli_query($conn, "DELETE FROM reservations WHERE (ExDate>='$from' AND ExDate<='$until') AND ReservationOfficeID=$idOffice");
						$invoice = mysqli_query($conn, "SELECT * FROM reservations WHERE (ExDate<'$from' OR ExDate>'$until') AND ReservationOfficeID=$idOffice");
					}
					else{
						echo "<span id='ititle'>Reservations made by <span id='oname'>All Offices</span>";
						$invoice = mysqli_query($conn, "SELECT * FROM reservations WHERE ExDate>='$from' AND ExDate<='$until'");
					}
                    if(mysqli_num_rows($invoice)>0){
        ?>
<!--                    <div id='invoice-wrapper'>-->
                        <table id='itable'>
                            <tr id='Cnames'>
                                <?php echo "<td> No</td>"?>
                                <?php echo "<td> Reservation ID</td>"?>
                                <?php echo "<td> Voucher </td>"?>
                                <?php echo "<td> Last Name </td>"?>
                                <?php echo "<td> Persons </td>" ?>
                                <?php echo "<td> Hotel </td>"?>
                                <?php echo "<td> Room </td>"?>
                                <?php echo "<td> Excursion </td>"?>
                                <?php echo "<td> Excursion Date </td>"?>
                                <?php echo "<td> Reservation Date </td>"?>
                            </tr>
        <?php
                        $i = 0; $persons = 0; $tpersons = 0; $kids = 0; $aPrice = 0; $kPrice = 0; //$commission_per = $OName['Commission']; 
                        $amount = 0; $commission_amt = 0; $endTotal = 0; $res_total = 0; $res_commission = 0; //
                        while($row = mysqli_fetch_assoc($invoice)){
                            $t_idHotel = $row['HotelID'];
                            $hotel = mysqli_fetch_assoc(mysqli_query($conn, "SELECT HName FROM hotel WHERE idHotel = $t_idHotel"));
                            $t_idExc = $row['ExcursionID'];
                            $exc = mysqli_fetch_assoc(mysqli_query($conn, "SELECT EName FROM excursion WHERE idExcursion = $t_idExc"));
                            $EName = $exc['EName'];
                            $tpersons += ($row['Adults'] + $row['Kids']);
							$persons = $row['Adults'] + $row['Kids'];
                            $i++;
        ?>
                            <tr>
                                <?php echo "<td><p>". $i ."</p></td>"?>
                                <?php echo "<td class='c1'><p>". $row['idReservations'] ."</p></td>"?>
                                <?php echo "<td class='c2'><p>" .$row['VoucherNo']." </p></td>"?>
                                <?php echo "<td class='c3'><p>" .$row['LastName']." </p></td>"?>
                                <?php echo "<td class='c4'><p>" .$persons." </p></td>"?>
                                <?php echo "<td class='c7'><p>" .$hotel['HName']." </p></td>"?>
                                <?php echo "<td class='c8'><p>" .$row['RoomNo']." </p></td>"?>
                                <?php echo "<td class='c10'><p>" .$EName." </p></td>"?>
                                <?php echo "<td class='c11'><p>" .date('d-m-Y', strtotime($row['ExDate']))." </p></td>"?>
                                <?php echo "<td class='c16'><p>" .date('d-m-Y', strtotime ($row['ResDate']))." </p></td>"?>                                
                            </tr>
        <?php                    
							$persons = 0;
						}
        ?>                 
                        </table>
        <?php
                    }
                    else
                        echo "<br>No reservations from this office for the selected period.";
                }
                else{
                    echo 'Incorrect Date "From" ';
                }
            }//style='visibility:hidden'
        ?>
		<div id='custom-popup' style='visibility:hidden'>
            <div id='pw-block' class='short'> <!-- change class to long when change password is clicked -->
                <div class='pw-row'>
                    <label id='pw-label' for='pw-input'> Password: </label>
                    <input class='pw-input' id='pw-input' type='password' placeholder='Type here' tabindex='-1'>
                    <a type='button' class='show-hide-chars' href='#'></a>
                </div>
                <div class='btn-row'>
                    <a class='confirm-btn' id='pw-confirm' type='button' href='#'> Confirm </a>
                    <a class='cancel-btn' id='pw-cancel' type='button' href='#'> Cancel </a>
                </div>
                <a id='change-pw-btn' type='button' href='#'> Change password </a>
                <span id='pw-status'> Password changed. </span>
                <div id='change-pw-block'>
                    <div class='pw-row'>
                        <label id='pw-label' for='pw-input'> Old password: </label>
                        <input class='pw-input' id='old-pw-input' type='password' placeholder='Type here'>
                        <a type='button' class='show-hide-chars' href='#'></a>
                    </div>
                    <div id='new-pw-row'>
                        <label id='pw-label' for='pw-input'> New password: </label>
                        <!-- type must  change to text if eye is clicked -->
                        <input class='pw-input' id='new-pw-input' title='Between 4 and 20 characters' type='password' placeholder='Type here'>
                        <a type='button' class='show-hide-chars' href='#'></a>
                    </div>
                    <div class='btn-row'>
                        <a class='confirm-btn' id='new-pw-confirm' type='button' href='#'> Confirm </a>
                        <a class='cancel-btn' id='new-pw-cancel' type='button' href='#'> Cancel </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
	<script src="js/selectInvoices.js"></script>
</html>