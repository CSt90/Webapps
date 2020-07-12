<?php // change all to mysqli format
	include 'db_connect_conf.php';

	// homepage has next date by default and then a dropdown to select tomorrow's excursion
	// then a button up top that sends you to the office management page
?>

<html>

<head><meta charset="UTF-8">
<title>Home</title>
</head>

<script src="jsq/jquery-3.1.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="jqui/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="home.css">
<link rel="stylesheet" type="text/css" href="home-popup.css">
<link rel="stylesheet" type="text/css" href="css/side_links.css">

<script src="jqui/jquery-ui.min.js"></script>
<body>
	<img  id='bg' src='background/waves_beach.jpg'></img>
	<div id='custom-popup' style='visibility:hidden;'>
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
	<a id='home-logo' alt='bus-logo' href='home.php'><img src='buslogo.png' width='100' height='77'></a>
	<div id='links'>
		<!--<div id='newResBtn' title='Add new reservation'></div><!--button-->
		<button class="hamburger" type="button"><!-- https://jonsuh.com/hamburgers/ -->
		  <span class="hamburger-box hamburger--arrowturn">
			<span class="hamburger-inner"></span>
		  </span>
		</button>

		<ul class='select_table'>
			<li id='newResBtn' title='Add new reservation'></li>
			<li title='Buses'><a href='Tbus/viewBusTable.php' target='_blank' ></a></li>
			<li title='Pickups'><a href='Tpickup/viewPickupTable.php' target='_blank' ></a></li>
			<li title='Hotels'><a href='Thotel/viewHotelTable.php' target='_blank' ></a></li>
			<li title='Offices'><a href='Toffice/viewOfficeTable.php' target='_blank' ></a></li>
			<li title='Excursions'><a href='Texcursion/viewExcursionTable.php' target='_blank' ></a></li>
			<li title='Reservations'><a href='Treservation/viewReservationsTable.php' target='_blank' ></a></li>
			<li title='Drivers'><a href='Tdriver/viewDriverTable.php' target='_blank' ></a></li>
			<li title='Sellers'><a href='Tseller/viewSellerTable.php' target='_blank' ></a></li>
			<li title='Guides'><a href='#' target='_blank' ></a></li> <!-- Tguide/viewGuideTable.php -->
			<li title='Assign busses to excursions'><a href='Assignment/busManagement.php' target='_blank' ></a></li>
			<li title='Make pickup list'><a href='PickupList/viewPickupList.php' target='_blank'></a></li>
            <li title='Pickup times'><a href='Tptime/viewPtimeTable.php' target='_blank'></a></li>
<!--            <li title='Backup'><a href='backup.php'></a></li>-->
		</ul>
		<!--<div id='assignmentBtn' title='assign busses to excursions'></div>-->
	</div>
	<div id='administrationBtn'>
		<ul id='submenulist' class='inactive'>
			<li> <span>Invoices</span></li>
			<li> <span>Delete Reservations</span> </li>
			<li> <span>Backup</span></li>
			<li> <span>Restore</span></li>
		</ul>
	</div><!--button-->
	<span id='mid-title'>  Select excursion </span>
	<div id='ex-sel'>
		<div id='dropdown'>
			<?php
				$query = 'SELECT idExcursion, EName FROM excursion';
				$result = mysqli_query($conn, $query);
				echo "<select id='drop' name='dropdown' value='' required><option value='-1'>Excursion</option>";
				while($r = mysqli_fetch_array($result)) {
				  echo "<option value=".$r['idExcursion'].">".$r['EName']."</option>";
				}
				echo "</select>";
			?>
		</div>
		<div id='cal'>
			<input type='text' name='ExDate' id='datepicker' required/>
		</div>
		<a href='#' id='gobtn' title="See reservations">Go</a>
	</div>
	<div id='lower-mid-btns'>
		<div id='today-btn' title="Open today's excursions in new tabs">Today</div>
		<div id='tomorrow-btn' title="Open tomorrow's excursions in new tabs">Tomorrow</div><!--this is a button that potentially opens all resLists for tomorrow in tabs-->
	</div>
	<div class="today">
		<div id='today-day' style='display:inline-block; margin-left:0%; margin-bottom:-20%'><?php echo  date('l').', &nbsp;'?></div>
		<div id='today-date' style='display:inline-block;'><?php echo date('d-m-Y')?></div>
	</div>	
	<?php
		$tom = strtotime("tomorrow");
	?>
	<div id='tomorrow-date' style='visibility:hidden; height:15px;'><?php echo date('d-m-Y', $tom)?></div>
</body>
<script src="popup.js"></script>
<script src="home.js"></script>
<script src="jsq/side_links.js"></script>
</html>
<?php mysqli_close($conn); ?>
