<?php // change all to mysqli format

	include '../db_connect_conf.php';
	if (isset($_GET['error']))
		$error = $_GET['error']; ?>
<script src="../jsq/jquery-3.1.0.min.js"></script>
<?php
	if (isset($_GET['ex']) && isset($_GET['date'])){
		$exc = $_GET['ex'];
		$dat = $_GET['date'];
	}
?>

<html>

<head><meta charset="UTF-8">
<title>New Reservation</title>
</head>
<link rel="stylesheet" type="text/css" href="css/addReserv.css">
<link type="text/css" rel="stylesheet" href="../qtip/jquery.qtip.min.css">
<link rel="stylesheet" type="text/css" href="../jqui/jquery-ui.css">
<script type="text/javascript" src="../jsq/jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="../jqui/jquery-ui.min.js"></script>
<script type="text/javascript" src="../qtip/jquery.qtip.min.js"></script>
<!--<script src="jquery-ui.min.js"></script>-->

<form id='add1' action='insertIntoReservationsTable.php' method='post'>
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
				<input type='text' name='VoucherNo' id='voucher' required autofocus/>
			</div>
		</div>
	</div>
	<div id='mid-container' class="form-containers">
		<span class='info req'>Pickup</span>
		<div id='mid-box'>
			<div id='pp1' class="pp-input">
				<label class='info req' for="timeinput">Pickup Time</label>
				<input type='text' name='PTime' class='smalltxt' id='timeinput' required/><!-- autofilled -->
			</div>
			<div id='pp2' class="pp-input">
				<label class='info req' for="pplace-input">Pickup Place</label>
				<input type='text' name='PPoint' class='txtcell' id="pplace-input" required/>
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
					<input type='text' name='LastName' id="LastName" class='txtcell' required/>
				</div>
                <div>
					<label class='info req' for="Phone">Phone</label>
					<input type='text' name='Phone' id="Phone" class='txtcell' placeholder='Up to 16 digits'/>
				</div>
                <div>
					<label class='info req' for="Email">Email</label>
					<input type='text' name='Email' id="Email" class='txtcell' placeholder='someone@example.com'/>
				</div>
				<div>
					<label class='info req' for="Hotel">Hotel</label>
					<input type='text' name='Hotel' id="Hotel" class='txtcell' required/>
				</div>
				<div>
					<label class='info req' for="RoomNumber">Room Number</label>
					<input type='text' name='RoomNumber' id="RoomNumber" class='smalltxt' required/>
				</div>
				<div>
					<label class='info req' for="Lang">Language</label>
					<!--<input type='text' name='Lang' class='smalltxt' required>-->
					<select name='Lang' id="Lang"class='langdrop'>
						<option value = 'E'>E</option>
						<option value = 'D'>D</option>
						<option value = 'F'>F</option>
						<option value = 'R'>R</option>
						<option value = 'other'>Other</option>
					</select>
				</div>
				<div>
					<label class='info req' for="Nat">Nationality</label>
<!--					<input type='text' name='Nat' class='smalltxt'>-->
                    <?php
                        $q = 'SELECT Country, Nat FROM nationality';
                        $res = mysqli_query($conn, $q);
                        echo "<select class='natdrop' name='Nat' id='Nat' value='-1' required><option value=''></option>";
                        while($row = mysqli_fetch_array($res)) {
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
					<div class="row">
						<div class="right-inputs">
							<label class='info req' for="Adults">Adults</label>
							<input type='text' name='Adults' id="Adults" class='txtcell' required/><!--cannot be 0 or empty-->
						</div>
						<span class='mul'>x</span>
						<input type='text' name='AdultPrice' class='txtcell' required/><span style='font-size:18px; margin-top:5px;'> €</span><!--cannot be 0 or empty-->
					</div>
					<div class="row">
						<div class="right-inputs">
							<label class='info req' for="Kids">Kids</label>
							<input type='text' name='Kids' id="Kids" class='txtcell' value='0' required/><!--can be 0 or empty-->
						</div>
						<span class='mul'>x</span>
						<input type='text' name='KidPrice' class='txtcell'/><span style='font-size:18px; margin-top:5px;'> €</span><!--can be 0 or empty-->
					</div>
					<div class="row">
						<div class="right-inputs">
							<label class='info req' for="Infants">Infants</label>
							<input type='text' name='Infants' id="Infants" class='txtcell' value='0' required/><!--can be 0 or empty-->
						</div>
						<span class='pob'>POB</span>
						<input type='text' name='POB_amt' class='txtcell' value='0'/><span style='font-size:18px; margin-top:5px; '> €</span><!--can be 0 or empty-->
					</div>
					<div class="row">
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
			<?php
				$q = 'SELECT idOffice, OName FROM office';
				$res = mysqli_query($conn, $q);
				echo "<div class='select-container'>";
				echo "<select id='dropdown_office' name='dropdown_office' value='-1' required><option value=''></option>";
				while($row = mysqli_fetch_array($res)) {
				  echo "<option value=".$row['idOffice'].">".$row['OName']."</option>";
				}
				echo "</select>";
				echo "</div>";
			?>
		</div>
		<div class="text-input">
			<label class='req' for="ResDate">Reservation Date</label>
			<div id='datediv' class="input-container">
				<input type='text' name='ResDate' id="ResDate" class='txtcell' value='<?php echo date("d-m-Y")?>'/>
			</div>
		</div>
	</div>
	<button type='submit' id='submit'> Submit voucher </button>
	<span id='seats-msg'>Available seats: <div id='max'></div></span>
</form>
<script src="js/addRes_actions.js"></script>
<script src="js/getPrice.js"></script>
<script src="js/loadClosePpoints.js"></script>
<script src="js/PrePostValidation.js"></script>
</html>
<?php mysqli_close($conn); ?>
