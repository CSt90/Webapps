<?php // change all to mysqli format

	include '../db_connect_conf.php';
	if (isset($_GET['error']))
		$error = $_GET['error'];
?>

<html>

<head><meta charset="UTF-8">
<title>Reservations table</title>
</head>

<link rel="stylesheet" type="text/css" href="../css/simpleTablePage.css">
<link rel="stylesheet" type="text/css" href="css/delPrompt.css">
<script src="../jsq/jquery-3.1.0.min.js"></script>
<script src="../jsq/submitAndBg.js"></script>
<script src="../jqui/jquery-ui.min.js"></script>
<script src="js/delAndEditRes.js"></script>
<link rel="stylesheet" type="text/css" href="../jqui/jquery-ui.css">
<!--<script src="js/deleteFromResTable.js"></script>-->
<html>
<body>
	<div id='confirm-prompt'>
		<div id='prompt-block'>
			<p id='prompt-q'></p>
			<div id='confirm' tabindex='-2'> Yes </div><div id='cancel' tabindex='-1'> Cancel </div>
		</div>
	</div>
	<div id='home-logo' ><a href='../home.php'></a></div>
	<img id='bg' src='../background/waves_beach.jpg'>
	<h2 id='page-title'> All reservations</h2>
	<div id='message_boxes'>
		<div id="editsuccessbox" style="display:none;">
			<img id="editsuccessV" src="../msgicon/bluetick.png" height="32" width="32">
			<span id="editsuccessmsg">Edit successful</span>
		</div>
		<?php if (isset($_GET['error']))
		echo"<div id='errorbox'>
				<img id='errorx' src='../msgicon/x2.png' alt='Error' height='32' width='32'>
				<span id='errormsg'>$error</span>
			</div>";
		?>
	</div>

<?php
	$query = "SELECT * FROM reservations";  //You don't need a ; like you do in SQL
	$result = mysqli_query($conn, $query);
?>

	<input type="text" id="filterRes" onkeyup="applyFilter()" placeholder="Search in the table..">
<?php
	echo "<div class='table_container'>
			<table id='rtable'>"; // start a table tag in the HTML

	echo "<tr id='Cnames'>
			<td class='empty_cell'></td>
			<td> Reservation ID </td>
			<td> Excursion </td>
			<td> Date </td>
			<td> PPoint </td>
			<td> PTime</td>
			<td> Last Name </td>
            <td> Phone </td>
            <td> Email </td>
			<td> Adults </td>
			<td> Adult Price </td>
			<td> Kids </td>
			<td> Kid Price </td>
			<td> Infants </td>
			<td> Voucher </td>
			<td> Reservation Date </td>
			<td> Hotel </td>
            <td> Room </td>
			<td> Office </td>
			<td> Seller </td>
			<td> Noshow </td>
			<td class='empty_cell'></td>
		  </tr>";

	if(@mysqli_num_rows($result)>0){ //throws warning if table is empty - @<function> hides it
		while($row = mysqli_fetch_array($result)){ //Creates a loop to loop through results
			$tempEx = $row['ExcursionID']; $tempp = $row['Pickup']; $temph = $row['HotelID']; $tempo = $row['ReservationOfficeID']; //$temps = $row['SellerID'];
			$tempExq = "SELECT EName FROM excursion WHERE idExcursion = $tempEx";//$row['Excursion'];
			$tempExr = mysqli_query($conn, $tempExq);
			$ex = mysqli_fetch_array($tempExr);
			$ppointq = mysqli_query($conn, "SELECT PPoint FROM pickup WHERE idPickup = '$tempp'");
			$ppoint = mysqli_fetch_array($ppointq);
			$hnameq = mysqli_query($conn, "SELECT HName FROM hotel WHERE idHotel = '$temph'");
			$hname = mysqli_fetch_array($hnameq);
			$resoffq = mysqli_query($conn, "SELECT OName FROM office WHERE idOffice = '$tempo'");
			$resoff = mysqli_fetch_array($resoffq);
			//$selq = mysqli_query($conn, "SELECT SName FROM seller WHERE idSeller = '$temps'");
			//$sel = mysqli_fetch_array($selq);

			echo "<tr>
				<td class='deleteCell'>
					<div class='deleteDiv' onmouseover='showDelRow(this.parentNode.parentNode)' onmouseout='hideDelRow(this.parentNode.parentNode)' onclick='deleteRow($(this).parent().parent())'> &#8210 </div>
				</td>
				<td class='c0'><p>" . $row['idReservations'] . "</p></td>
				<td class='c1'><p>" . $ex['EName'] . "</p></td>
				<td class='c2'><p>" . date("d-m-Y", strtotime($row['ExDate'])). "</p></td>
				<td class='c3'><p>" . $ppoint['PPoint']. "</p></td>
				<td class='c4'><p>" . $row['PTime']. "</p></td>
				<td class='c5'><p>" . $row['LastName']. "</p></td>
                <td class='c6'><p>" . $row['Phone']. "</p></td>
                <td class='c7'><p>" . $row['Email']. "</p></td>
				<td class='c8'><p>" . $row['Adults']. "</p></td>
				<td class='c9'><p>" . $row['AdultPrice']. "</p></td>
				<td class='c10'><p>" . $row['Kids']. "</p></td>
				<td class='c11'><p>" . $row['KidPrice']. "</p></td>
				<td class='c12'><p>" . $row['Infants']. "</p></td>
				<td class='c14'><p>" . $row['VoucherNo']. "</p></td>
				<td class='c15'><p>" . date("d-m-Y", strtotime($row['ResDate'])). "</p></td>
				<td class='c16'><p>" . $hname['HName']. "</p></td>
                <td class='c17'><p>" . $row['RoomNo']. "</p></td>
				<td class='c18'><p>" . $resoff['OName']. "</p></td>
				<td class='c19'><p>" . substr($row['SellerID'], 0, 3). "</p></td>
				<td class='c20' ondblclick = editShow($(this).parent())><p>" . ($row['Noshow']=="0" ? "&#x2718;" : " "). "</p></td>
				<td class='edit_cell'>
					<div class='edits' onclick=editRes($(this).parent().parent())> Edit </div>
				</td>
			</tr>"; //$row['index'] the index here is a field name
		}
	}

	//the add new table entry button shows up as a table field with full table width marked by '+'
	//colspan='<num of columns>' to give full table width
	//echo "<tr><td id='add' colspan=".mysqli_num_rows(mysqli_query($conn, 'DESCRIBE bus'))."><a href='#'><div class='opBtn'> + </div></a></td></tr>";
	$tableCols = mysqli_num_rows(mysqli_query($conn, 'DESCRIBE reservations'));
	echo "</table>
		</div>";
	//echo "<a href='addReservation.php' class='myButton'>Add reservation</a>";
	mysqli_close($conn); //Make sure to close out the database connection
?>
<script src="js/deleteFromResTable.js"></script>
<script src="js/filterRes.js"></script>
</body>
</html>
