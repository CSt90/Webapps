<?php
    session_start();
    include '../db_connect_conf.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Invoices</title>
        <link rel="stylesheet" type="text/css" href="css/invoice.css">
        <script src="../jsq/jquery-3.1.0.min.js"></script>
        <script src="../jqui/jquery-ui.min.js"></script>
        <script src="js/filterExcs.js"></script>
    </head>
    <body>
		<div id='filters-area'>
			<div id='home-logo' ><a href='../home.php'></a></div>
			<div id='excFilter'>
				<label for='filterField'> Filter by excursion </label>
				<input type="text" id="filterField" onkeyup="applyFilter()" placeholder="Excursion..">
			</div>
			</br>
			<div id='voucherRange'>
				<span id='rangeTitle'> Voucher number range </span>
				<div id='rangeFields'>
					<label for='voucherRangeMin'> Min: </label>
					<input type="text" id="voucherRangeMin" placeholder="First">
					<label for='voucherRangeMax'> Max: </label>
					<input type="text" id="voucherRangeMax" placeholder="Last">
					<button id='applyFilter' onclick="rangeFilter()"> Show </button>
				</div>
			</div>
		</div>
		<div id='slider-footer'>
			<div id='filters-slider'> &#x21ea </div>
		</div>
        <?php
            $check=array('resno' => 0, 'resid' => 0, 'voucher' => 0, 'lastname' => 0, 'adults' => 0, 'kids' => 0,  'infants' => 0, 'hotel' => 0, 'room' => 0, 'paid' => 0, 'seller' => 0, 'excursion' => 0, 'excursionDate' => 0, 'ppoint' => 0, 'ptime' => 0, 'lang' => 0, 'nat' => 0, 'resDate' => 0, 'pob' => 0, 'noshow' => 0, 'crate' => 0, 'ctype' => 0, 'comm' => 0);
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
                    $OName = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM office WHERE idOffice = '$idOffice'"));
                    $office = $OName['OName'];
                    echo "<span id='ititle'>Reservations made by <span id='oname'>$office</span> from <span id='fdate'>$fromDate</span> until <span id='tdate'>$toDate</span></span>";

                    $from = date("Y-m-d", strtotime($fromDate));
                    $until = date("Y-m-d", strtotime($toDate));
                    $invoice = mysqli_query($conn, "SELECT * FROM reservations WHERE ResDate>='$from' AND ResDate<='$until' AND ReservationOfficeID=$idOffice");
                    if (isset($_GET['columns'])){
                        if (is_array($_GET['columns'])){
                            foreach ($_GET['columns'] as $col){
                                $check[$col] = 1;
                            }
                        }
                    }
                    else
                        echo 'not set';
                    if(mysqli_num_rows($invoice)>0){
        ?>
<!--                    <div id='invoice-wrapper'>-->
                        <table id='itable'>
                            <tr id='Cnames'>
                                <?php echo ($check['resno'] == 1) ? "<td> Reservation No</td>" : "" ?>
                                <?php echo ($check['resid'] == 1) ? "<td> Reservation ID</td>" : "" ?>
                                <?php echo ($check['voucher'] == 1) ? "<td> Voucher </td>" : "" ?>
                                <?php echo ($check['lastname'] == 1) ? "<td> Last Name </td>" : "" ?>
                                <?php echo ($check['adults'] == 1) ? "<td> Adults </td>" : "" ?>
                                <?php echo ($check['kids'] == 1) ? "<td> Kids </td>" : "" ?>
                                <?php echo ($check['infants'] == 1) ? "<td> Infants </td>" : "" ?>
                                <?php echo ($check['hotel'] == 1) ? "<td> Hotel </td>" : "" ?>
                                <?php echo ($check['room'] == 1) ? "<td> Room </td>" : "" ?>
                                <?php echo ($check['seller'] == 1) ? "<td> Seller </td>" : "" ?>
                                <?php echo ($check['excursion'] == 1) ? "<td> Excursion </td>" : "" ?>
                                <?php echo ($check['excursionDate'] == 1) ? "<td> Excursion Date </td>" : "" ?>
                                <?php echo ($check['ppoint'] == 1) ? "<td> Pickup Point </td>" : "" ?>
                                <?php echo ($check['ptime'] == 1) ? "<td> Pickup Time </td>" : "" ?>
                                <?php echo ($check['lang'] == 1) ? "<td> Language </td>" : "" ?>
                                <?php echo ($check['nat'] == 1) ? "<td> Nationality </td>" : "" ?>
                                <?php echo ($check['resDate'] == 1) ? "<td> Reservation Date </td>" : "" ?>
                                <?php echo ($check['pob'] == 1) ? "<td> POB </td>" : "" ?>
                                <?php echo ($check['noshow'] == 1) ? "<td> Noshow </td>" : "" ?>
                                <?php echo ($check['paid'] == 1) ? "<td> Paid </td>" : "" ?>
                                <?php echo ($check['crate'] == 1) ? "<td> Commission Rate </td>" : "" ?>
                                <?php echo ($check['comm'] == 1) ? "<td> Commission </td>" : "" ?>
                            </tr>
        <?php
                        $i = 0; $adults = 0; $kids = 0; $aPrice = 0; $kPrice = 0; //$commission_per = $OName['Commission'];
                        $amount = 0; $commission_amt = 0; $endTotal = 0; $res_total = 0; $res_commission = 0; //
                        while($row = mysqli_fetch_assoc($invoice)){
                            $t_idHotel = $row['HotelID'];
                            $hotel = mysqli_fetch_assoc(mysqli_query($conn, "SELECT HName FROM hotel WHERE idHotel = $t_idHotel"));
                            $t_idExc = $row['ExcursionID'];
                            $exc = mysqli_fetch_assoc(mysqli_query($conn, "SELECT EName FROM excursion WHERE idExcursion = $t_idExc"));
                            $EName = $exc['EName'];
                            $t_pp = $row['Pickup'];
                            $pp = mysqli_fetch_assoc(mysqli_query($conn, "SELECT PPoint FROM pickup WHERE idPickup = $t_pp"));
                            $adults += $row['Adults'];
                            $kids += $row['Kids'];
                            $aPrice += $row['AdultPrice'];
                            $kPrice += $row['KidPrice'];
                            $res_total = number_format($row['Adults'] * $row['AdultPrice'] + $row['Kids'] * $row['KidPrice'], 2);
                            if($OName['CType'] == '€') //if Gramvoussa
                                //$res_commission = number_format($OName[$EName] * $row['Adults'] + ($OName[$EName]/2) * $row['Kids'], 2); //$office['Imbros']
                                $res_commission = number_format($res_total-$OName[$EName], 2);
                                //$res_commission = 5.00 * $row['Adults'] + 2.50 * $row['Kids']; //5e commission for Gramvoussa
                            else if($OName['CType'] == '%')
                                //$res_commission = number_format($res_total * $commission_per * 0.01, 2); //
                                $res_commission = number_format($res_total * $OName[$EName] * 0.01, 2);
                            else if ($OName['CType'] == '-')
                                $res_commission = 0;
                            $commission_amt += $res_commission;
                            $amount += $res_total;
                            $i++;
        ?>
                            <tr>
                                <?php echo ($check['resno'] == 1) ? "<td><p>". $i ."</p></td>" : "" ?>
                                <?php echo ($check['resid'] == 1) ? "<td class='c1'><p>". $row['idReservations'] ."</p></td>" : "" ?>
                                <?php echo ($check['voucher'] == 1) ? "<td class='c2'><p>" .$row['VoucherNo']." </p></td>" : "" ?>
                                <?php echo ($check['lastname'] == 1) ? "<td class='c3'><p>" .$row['LastName']." </p></td>" : "" ?>
                                <?php echo ($check['adults'] == 1) ? "<td class='c4'><p>" .$row['Adults']." </p></td>" : "" ?>
                                <?php echo ($check['kids'] == 1) ? "<td class='c5'><p>" .$row['Kids']." </p></td>" : "" ?>
                                <?php echo ($check['infants'] == 1) ? "<td class='c6'><p>" .$row['Infants']." </p></td>" : "" ?>
                                <?php echo ($check['hotel'] == 1) ? "<td class='c7'><p>" .$hotel['HName']." </p></td>" : "" ?>
                                <?php echo ($check['room'] == 1) ? "<td class='c8'><p>" .$row['RoomNo']." </p></td>" : "" ?>
                                <?php echo ($check['seller'] == 1) ? "<td class='c9'><p>" .$row['SellerID']." </p></td>" : "" ?>
                                <?php echo ($check['excursion'] == 1) ? "<td class='c10'><p>" .$EName." </p></td>" : "" ?>
                                <?php echo ($check['excursionDate'] == 1) ? "<td class='c11'><p>" .date('d-m-Y', strtotime($row['ExDate']))." </p></td>" : "" ?>
                                <?php echo ($check['ppoint'] == 1) ? "<td class='c12'><p>" .$pp['PPoint']." </p></td>" : "" ?>
                                <?php echo ($check['ptime'] == 1) ? "<td class='c13'><p>" .$row['PTime']." </p></td>" : "" ?>
                                <?php echo ($check['lang'] == 1) ? "<td class='c14'><p>" .$row['Language']." </p></td>" : "" ?>
                                <?php echo ($check['nat'] == 1) ? "<td class='c15'><p>" .$row['Nationality']." </p></td>" : "" ?>
                                <?php echo ($check['resDate'] == 1) ? "<td class='c16'><p>" .date('d-m-Y', strtotime ($row['ResDate']))." </p></td>" : "" ?>
                                <?php echo ($check['pob'] == 1) ? "<td class='c17'><p>" .$row['POBamt']." </p></td>" : "" ?>
                                <?php echo ($check['noshow'] == 1) ? "<td class='c18'><p>" .($row['Noshow']=="0" ? "&#x2718;" : " ")." </p></td>" : "" ?>
                                <?php echo ($check['paid'] == 1) ? "<td class='c19'><p>" .$res_total." € </p> </td>" : "" ?>
                                <?php echo ($check['crate'] == 1) ? "<td class='c20'><p>" .$OName[$EName]." ".$OName['CType']." </p> </td>" : "" ?>
                                <?php echo ($check['comm'] == 1) ? "<td class='c21' style='color: #d20707'><p>" .$res_commission." € </p> </td>" : "" ?>
                            </tr>
        <?php
                        }
                        //$commission_amt = number_format($amount * $commission_per * 0.01, 2);
                        $endTotal = $amount - $commission_amt;
        ?>
                        </table>
                        <div id='totals'>
                            <div id='totals-left'>
                                <div class='totals-row'>
                                    <span class='total-label' id='total-res'>Total reservations</span>
                                    <div class='total-num'><?php echo $i ?></div>
                                </div>
                                <div class='totals-row'>
                                    <span class='total-label' id='total-adults'>Total adults</span>
                                    <div class='total-num'><?php echo $adults ?></div>
                                </div>
                                <div class='totals-row'>
                                    <span class='total-label' id='total-kids'>Total kids</span>
                                    <div class='total-num'><?php echo $kids ?></div>
                                </div>
                            </div>
                            <div id='totals-right'>
                                <div class='totals-row'>
                                    <span class='total-label' id='total-amount'>Total amount</span>
                                    <div class='total-num'><?php echo number_format($amount, 2). " €" ?></div>
                                </div>
                                <div class='totals-row'>
<!--
                                    <span class='total-label' id='commission_per'>Commission (%)</span>
                                    <div class='total-num'><?php echo number_format($commission_per, 2). " %" ?></div>
-->
                                </div>
                                <div class='totals-row'>
                                    <span class='total-label' id='commission_amt'>Commission (€)</span>
                                    <div class='total-num' style='color: #d20707'><?php echo number_format($commission_amt, 2). " €" ?></div>
                                </div>
                            </div>

                        </div>
                        <div class='totals-row' id='endtotal' style='font-size:20px'>
                            <span class='total-label' id='end-total'>End total</span>
                            <div class='total-num' style='color: #ab1a1a'><?php echo number_format($endTotal, 2). " €" ?></div>
                        </div>
<!--                    </div>-->
        <?php
                    }
                    else
                        echo "<br>No reservations from this office for the selected period.";
                }
                else{
                    echo 'Incorrect Date "From" ';
                }
            }
        ?>
    </body>
</html>
