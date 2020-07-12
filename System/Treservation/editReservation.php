<?php // change all to mysqli format

	include '../db_connect_conf.php';
	if (isset($_GET['error']))
		$error = $_GET['error']; ?>
<script src="../jsq/jquery-3.1.0.min.js"></script>
<?php
	if (isset($_GET['resid'])){
		$idReservations = mysqli_real_escape_string($conn, $_GET['resid']);
		$fetchres = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM Reservations WHERE idReservations = '$idReservations'"));

		$tempp = $fetchres['Pickup']; $temph = $fetchres['HotelID']; $tempo = $fetchres['ReservationOfficeID']; //$temps = $fetchres['SellerID'];
		$ppointq = mysqli_query($conn, "SELECT PPoint FROM pickup WHERE idPickup = '$tempp'");
		$ppoint = mysqli_fetch_array($ppointq);
		$hnameq = mysqli_query($conn, "SELECT HName FROM hotel WHERE idHotel = '$temph'");
		$hname = mysqli_fetch_array($hnameq);
		$resoffq = mysqli_query($conn, "SELECT OName FROM office WHERE idOffice = '$tempo'");
		$resoff = mysqli_fetch_array($resoffq);
//		$selq = mysqli_query($conn, "SELECT SName FROM seller WHERE idSeller = '$temps'");
//		$sel = mysqli_fetch_array($selq);

		$exc = $fetchres['ExcursionID'];
		$dat = date("d-m-Y", strtotime($fetchres['ExDate']));
		$vouch = $fetchres['VoucherNo'];
		$pt = $fetchres['PTime'];
		$pp = $ppoint['PPoint'];
		$lname = $fetchres['LastName'];
      $phone = $fetchres['Phone'];
      $email = $fetchres['Email'];
		$hotel = $hname['HName'];
		$room = $fetchres['RoomNo'];
		$lang = $fetchres['Language'];
		$nat = $fetchres['Nationality'];
		$adults = intval($fetchres['Adults']);
		$a_price = floatval($fetchres['AdultPrice']);
		$kids = intval($fetchres['Kids']);
		$k_price = floatval($fetchres['KidPrice']);
		$infants = intval($fetchres['Infants']);
		$pob_amt = floatval($fetchres['POBamt']);
		$res_office = $fetchres['ReservationOfficeID'];
		//$seller = $fetchres['SellerID'];
		$res_date = date("d-m-Y", strtotime($fetchres['ResDate']));
	}
?>

<html>

<head><meta charset="UTF-8">
<title>Change Reservation</title>
</head>

<link rel="stylesheet" type="text/css" href="css/addReserv.css">
<script src="../jqui/jquery-ui.min.js"></script>
<link type="text/css" rel="stylesheet" href="../qtip/jquery.qtip.min.css">
<link rel="stylesheet" type="text/css" href="../jqui/jquery-ui.css">
<script type="text/javascript" src="../qtip/jquery.qtip.min.js"></script>
<!--<script src="jquery-ui.min.js"></script>-->

<form id='add1' action='editReservationsTable.php' method='post'>
	<div id='top-container' class="form-containers">
		<div id='dropdown' class="text-input">
			<label class='info req' for="drop">Excursion</label>
			<?php
				$query = 'SELECT idExcursion, EName FROM excursion';
				$result = mysqli_query($conn, $query);
				echo "<div class='select-container'>";
				echo "<select id='drop' name='dropdown' value='' required><option value='-1'>Excursion</option>";
				while($r = mysqli_fetch_array($result)) {
					if ($exc == $r['idExcursion'])
						echo "<option value=".$r['idExcursion']." selected = 'selected'>".$r['EName']."</option>";
					else
						echo "<option value=".$r['idExcursion'].">".$r['EName']."</option>";
				}
				echo "</select>";
				echo "</div>";
			?>
		</div>
		<div id='cal' class="text-input">
			<label class='info req' for="datepicker">Date</label>
			<div class="input-container">
				<input type='text' name='ExDate' id='datepicker' value= '<?php echo((isset($dat))? $dat : '')?>' required/>
			</div>
		</div>
		<div id='topright' class="text-input">
			<label class='info req' for="voucher">Voucher</label>
			<div class="input-container">
				<input type='text' name='VoucherNo' id='voucher' value='<?php echo((isset($vouch))? $vouch : '')?>' required/>
			</div>
		</div>
	</div>
	<div id='mid-container' class="form-containers">
		<span class='info req'>Pickup</span>
		<div id='mid-box'>
			<div id='pp1' class="pp-input">
				<label class='info req' for="timeinput">Pickup Time</label>
				<input type='text' name='PTime' class='smalltxt' id='timeinput' value='<?php echo((isset($pt))? $pt : '')?>' required/><!-- autofilled -->
			</div>
			<div id='pp2' class="pp-input">
				<label class='info req' for="pplace-input">Pickup Place</label>
				<input type='text' name='PPoint' class='txtcell' value='<?php echo((isset($pp))? $pp : '')?>' required/>
			</div>
			<div id='pp-btn'>
				<img id='compass-img' src='../msgicon/compass-color.png' alt='compass' title="Show the closest pickup points for the selected hotel">
			</div>
		</div>
	</div>
	<div id='lower-container' class="form-containers">
		<div id='lower-left-box'>
			<div id='lower-left-content'>
				<div>
					<label class='info req' for="LastName">Last Name</label>
					<input type='text' name='LastName' id="LastName" class='txtcell' value='<?php echo((isset($lname))? $lname : '')?>'required/>
				</div>
                <div>
					<label class='info req' for="Phone">Phone</label>
					<input type='text' name='Phone' id='Phone' class='txtcell' placeholder='Up to 16 digits' value='<?php echo((isset($phone))? $phone : '')?>'/>
				</div>
                <div>
					<label class='info req' for="Email">Email</label>
					<input type='text' name='Email' id='Email' class='txtcell' placeholder='someone@example.com' value='<?php echo((isset($email))? $email : '')?>'/>
				</div>
				<div>
					<label class='info req' for="Hotel">Hotel</label>
					<input type='text' name='Hotel' id='Hotel' class='txtcell' value='<?php echo((isset($hotel))? $hotel : '')?>' required/>
				</div>
				<div>
					<label class='info req' for="RoomNumber">Room Number</label>
					<input type='text' name='RoomNumber' id='RoomNumber' class='smalltxt' value='<?php echo((isset($room))? $room : '')?>' required/>
				</div>
				<div>
					<label class='info req' for="Lang">Language</label>
					<!--<input type='text' name='Lang' class='smalltxt' required>-->
					<select name='Lang' id='Lang' class='langdrop' required>
						<option value = 'E' <?php echo((isset($lang) && $lang == 'E' )? 'selected' : '')?>>E</option>
						<option value = 'D' <?php echo((isset($lang) && $lang == 'D' )? 'selected' : '')?>>D</option>
						<option value = 'F' <?php echo((isset($lang) && $lang == 'F' )? 'selected' : '')?>>F</option>
						<option value = 'R' <?php echo((isset($lang) && $lang == 'R' )? 'selected' : '')?>>R</option>
						<option value = 'other'>Other</option>
					</select>
				</div>
				<div>
					<label class='info req' for="Nat">Nationality</label>
					<?php
                        $q = 'SELECT Country, Nat FROM nationality';
                        $res = mysqli_query($conn, $q);
                        echo "<select id='Nat' class='natdrop' name='Nat' value='-1' required><option value=''></option>";
                        while($row = mysqli_fetch_array($res)) {
                            if ($nat == $row['Nat'])
                                echo "<option value=".$row['Nat']." selected = 'selected' >".$row['Country']."</option>";
                            else
                                echo "<option value=".$row['Nat'].">".$row['Country']."</option>";
                        }
                        echo "</select>";
                    ?>
				</div>
			</div>
		</div>
		<div id='lower-right-box'>
			<div class="lower-right-containers" id="lower-right-1">
				<div class="lower-right-titles">
					<span>Persons</span>
					<span></span>
					<span>Price</span>
				</div>
				<div class="lower-right-content" id="lrc">
					<div class='row'>
						<div class="right-inputs">
							<label class='info req' for="Adults">Adults</label>
							<input type='text' name='Adults' id="Adults" class='txtcell' value='<?php echo((isset($adults))? $adults : '')?>' required/><!--cannot be 0 or empty-->
						</div>
						<span class='mul'>x</span>
						<input type='text' name='AdultPrice' class='txtcell' value='<?php echo((isset($a_price))? number_format((float)$a_price, 2) : '')?>' required/><span style='font-size:18px; margin-top:5px;'> €</span><!--cannot be 0 or empty-->
					</div>
					<div class='row'>
						<div class="right-inputs">
							<label class='info req' for="Kids">Kids</label>
							<input type='text' name='Kids' id="Kids" class='txtcell' value='<?php echo((isset($kids))? $kids : '0')?>' required/><!--can be 0 or empty-->
						</div>
						<span class='mul'>x</span>
						<input type='text' name='KidPrice' class='txtcell' value='<?php echo((isset($k_price))? number_format((float)$k_price, 2) : '')?>' /><span style='font-size:18px; margin-top:5px;'> €</span><!--can be 0 or empty-->
					</div>
					<div class='row'>
						<div class="right-inputs">
							<label class='info req' for="Infants">Infants</label>
							<input type='text' name='Infants' id="Infants" class='txtcell' value='<?php echo((isset($infants))? $infants : '0')?>' required/><!--can be 0 or empty-->
						</div>
						<span class='pob'>POB</span>
						<!--<input type='checkbox' name='POB' id='POB_check'>-->
						<input type='text' name='POB_amt' class='txtcell' value='<?php echo((isset($pob_amt))? $pob_amt : '0')?>' /><span style='font-size:18px; margin-top:5px;'> €</span><!--can be 0 or empty-->
					</div>
					<div class='row'>
						<span></span>
						<span class='total-label'>Total amount:</span><span class='total-price'>0 €</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id='bottom-container' class="form-containers">
		<div class="text-input">
			<label class='req' for="dropdown_office">Reservation Office</label>
			<!--<input type='text' name='ReservationOfficeID' class='txtcell' required>-->
			<?php
				$q = 'SELECT idOffice, OName FROM office';
				$res = mysqli_query($conn, $q);
				echo "<div class='select-container'>";
				echo "<select id='drop_office' name='dropdown_office' value='-1' required><option value=''></option>";
				while($row = mysqli_fetch_array($res)) {
					if ($res_office == $row['idOffice'])
						echo "<option value=".$row['idOffice']." selected = 'selected' >".$row['OName']."</option>";
					else
						echo "<option value=".$row['idOffice'].">".$row['OName']."</option>";

				}
				echo "</select>";
				echo "</div>";
			?>
		</div>
		<div class="text-input">
			<label class='req' for="ResDate">Reservation Date</label>
			<div id='datediv' class="input-container">
				<input type='text' name='ResDate' class='txtcell' value='<?php echo((isset($res_date))? $res_date : '')?>' /> <!--value='<?php //echo date("d-m-Y")?>'-->
			</div>
		</div>
	</div>
	<button type='submit' id='submit'> Save changes </button>
	<span id='seats-msg'>Available seats: <div id='max'></div></span>
   <input name='res_id' style='visibility:hidden' value='<?php echo $idReservations ?>'/>
</form>
<script src="js/editRes_actions.js"></script>
<script src="js/loadClosePpoints.js"></script>
<!--<script src="js/getPrice.js"></script>-->
<!--<script type="text/javascript"> totalPriceCalc();</script>-->
<script src="js/PrePostValidation.js"></script>
</html>

<?php mysqli_close($conn); ?>
