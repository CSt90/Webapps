<?php // change all to mysqli format

	include '../db_connect_conf.php';
	if (isset($_GET['error']))
		$error = $_GET['error'];
?>

<html>

<head><meta charset="UTF-8">
<title>Hotel table</title>
</head>

<link rel="stylesheet" type="text/css" href="../css/simpleTablePage.css">
<link rel="stylesheet" type="text/css" href="../Treservation/css/delPrompt.css">
<script src="../jsq/jquery-3.1.0.min.js"></script>
<script src="../jsq/submitAndBg.js"></script>
<script src="js/hotelDeleteAndEdit.js"></script>
<script src="js/newHotel.js"></script>

<body>
	<div id='home-logo' ><a href='../home.php'></a></div>
	<img id='bg' src='../background/waves_beach.jpg'>
	<h2 id='page-title'> Hotels </h2>
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

<div id='confirm-prompt'>
    <div id='prompt-block'>
        <p id='prompt-q'></p>
        <div id='confirm' tabindex='-2'> Yes </div><div id='cancel' tabindex='-1'> Cancel </div>
    </div>
</div>

<?php
	$query = "SELECT * FROM hotel ORDER BY idHotel, PPWest";  //You don't need a ; like you do in SQL
	$result = mysqli_query($conn, $query);

	echo "<div class='table_container'>
			<table id='htable' >"; // start a table tag in the HTML

	echo "<tr id='Cnames'>
			<td class='empty_cell'></td>
			<td> Hotel ID </td>
			<td> Area </td>
			<td class='long'> Hotel Name </td>
			<td> Phone </td>
			<td> PPoint West </td>
			<td> PPoint East </td>
			<td> Notes </td>
		  </tr>";

	if(@mysqli_num_rows($result)>0){ //throws warning if table is empty - @<function> hides it
		while($row = mysqli_fetch_array($result)){ //Creates a loop to loop through results
			$ppW = $row['PPWest'];
			$ppE = $row['PPEast'];
			$ppWname = mysqli_fetch_assoc(mysqli_query($conn, "SELECT PPoint FROM pickup WHERE idPickup='$ppW'"));
			$ppEname = mysqli_fetch_assoc(mysqli_query($conn, "SELECT PPoint FROM pickup WHERE idPickup='$ppE'"));
			echo "<tr>
				<td class='deleteCell'>
					<div class='deleteDiv' onmouseover='showDelRow(this.parentNode.parentNode)' onmouseout='hideDelRow(this.parentNode.parentNode)' onclick='deleteRow($(this).parent().parent())'> &#8210; </div>
				</td>
				<td class='c0'><p>" . $row['idHotel'] . "</p></td>
				<td class='c1'><p>" . $row['HArea'] . "</p></td>
				<td class='c2'><p>" . $row['HName'] . "</p></td>
				<td class='c3'><p>" . $row['HPhone'] . "</p></td>
				<td class='c6'><p>" . $ppWname['PPoint'] . "</p></td>
				<td class='c7'><p>" . $ppEname['PPoint'] . "</p></td>
				<td class='c8'><p>" . $row['notes'] . "</p></td>
			</tr>"; //$row['index'] the index here is a field name
		}
        echo "<tr id='newrow'>
				<td class='empty_cell'></td>
				<td colspan=10><p id='newHotel' onclick='newHotel()'> Add Hotel </p></td>
			</tr>
			</table>
		</div>";
	}

	//the add new table entry button shows up as a table field with full table width marked by '+'
	//colspan='<num of columns>' to give full table width
	//echo "<tr><td id='add' colspan=".mysqli_num_rows(mysqli_query($conn, 'DESCRIBE bus'))."><a href='#'><div class='opBtn'> + </div></a></td></tr>";
	$tableCols = mysqli_num_rows(mysqli_query($conn, 'DESCRIBE hotel'));
	mysqli_close($conn); //Make sure to close out the database connection
?>
</body>
</html>
