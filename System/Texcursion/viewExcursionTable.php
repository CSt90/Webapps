<?php // change all to mysqli format

	include '../db_connect_conf.php';
	if (isset($_GET['error']))
		$error = $_GET['error'];
?>

<html>

<head><meta charset="UTF-8">
<title>Excursions table</title>
</head>

<link rel="stylesheet" type="text/css" href="../css/simpleTablePage.css">
<script src="../jsq/jquery-3.1.0.min.js"></script>
<script src="../jsq/submitAndBg.js"></script>
<script src="js/excursionDeleteAndEdit.js"></script>

<body>
	<div id='home-logo' ><a href='../home.php'></a></div>
	<img id='bg' src='../background/waves_beach.jpg'>
	<h2 id='page-title'> All excursions </h2>
	<div id='message_boxes'>
		<div id="editsuccessbox" style="display:none">
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
	$query = "SELECT * FROM excursion";  //You don't need a ; like you do in SQL
	$result = mysqli_query($conn, $query);

	echo "<table id='etable'>"; // start a table tag in the HTML

	echo "<tr id='Cnames'>
			<td class='empty_cell'></td>
			<td> Excursion ID </td>
			<td> Excursion </td>
			<td> Days </td>
      <td> Start Time </td>
      <td> End Time </td>
			<td> Price </td>
			<td> Direction </td>
			<td class='empty_cell'></td>
		  </tr>";

	$firstDay = false;
	$lastDay = false;
    $max = 0;
	if(@mysqli_num_rows($result)>0){ //throws warning if table is empty - @<function> hides it
		while($row = mysqli_fetch_array($result)){ //Creates a loop to loop through results
			$ename = $row['EName'];
			$direction = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `$ename` FROM ptime LIMIT 1"));
			$EDays="";
			if ($row['Mon']==1){
				$EDays = "|Mon| ";
			}
			if ($row['Tue']==1){
				$EDays = $EDays."|Tue| ";
			}
			if ($row['Wed']==1){
				$EDays = $EDays."|Wed| ";
			}
			if ($row['Thu']==1){
				$EDays = $EDays."|Thu| ";
			}
			if ($row['Fri']==1){
				$EDays = $EDays."|Fri| ";
			}
			if ($row['Sat']==1){
				$EDays = $EDays."|Sat| ";
			}
			if ($row['Sun']==1){
				$EDays = $EDays."|Sun|";
			}
      if($row['idExcursion'] >= $max)
          $max = $row['idExcursion'];
			$stime = date('H:i', strtotime($row['StartTime']));
      $etime = date('H:i', strtotime($row['EndTime']));
			echo "<tr>
				<td class='deleteCell'>
					<div class='deleteDiv' onmouseover='showDelRow(this.parentNode.parentNode)' onmouseout='hideDelRow(this.parentNode.parentNode)' onclick='deleteRow(this.parentNode.parentNode)'> &#8210; </div>
				</td>
				<td class='c0'><p>" . $row['idExcursion'] . "</p></td>
				<td class='c1'><p>" . $row['EName'] . "</p></td>
				<td class='c2'><p>" . $EDays . "</p></td>
        <td class='c3'><p>" . $stime . "</p></td>
        <td class='c4'><p>" . $etime . "</p></td>
				<td class='c5'><p>" . $row['EPrice'] . " €</p></td>
				<td class='c6'><p>" . ($direction[$ename] == 1 ? 'WEST' : 'EAST') . "</p></td>
				<td class='empty_cell'></td>
			</tr>"; //$row['index'] the index here is a field name
		}
	}

	//the add new table entry button shows up as a table field with full table width marked by '+'
	//colspan='<num of columns>' to give full table width
	//echo "<tr><td id='add' colspan=".mysqli_num_rows(mysqli_query($conn, 'DESCRIBE bus'))."><a href='#'><div class='opBtn'> + </div></a></td></tr>";
	$tableCols = mysqli_num_rows(mysqli_query($conn, 'DESCRIBE excursion'));
?>

	<tr id='add_new'>
		<form id='add1' action='insertIntoExcursionTable.php' method='post'>
			<td class='empty_cell'></td> <!-- 'delete-button' column -->
			<td class='last_row_cell'>
				<input type='text' name='idExcursion' id='txtcell' value = '<?php print_r((int)($max+1)) ?>' style='text-align:center'>
			</td>
			<td class='last_row_cell'>
				<input type='text' name='EName' id='txtcell'>
			</td>
			<td style='padding:0px; width:300px;' class='check last_row_cell'> <!--styling for this is done here, because jquery acts crazy removing all ids inside the tds-->
				<label class='lab'> Mon <br>
					<input type='checkbox' name='day[]' value='1' align=''>
				</label>
				<label class='lab'> Tue <br>
					<input type='checkbox' name='day[]' value='2' align=''>
				</label>
				<label class='lab'> Wed <br>
					<input type='checkbox' name='day[]' value='3' align=''>
				</label>
				<label class='lab'> Thu <br>
					<input type='checkbox' name='day[]' value='4' align=''>
				</label>
				<label class='lab'> Fri <br>
					<input type='checkbox' name='day[]' value='5' align=''>
				</label>
				<label class='lab'> Sat <br>
					<input type='checkbox' name='day[]' value='6' align=''>
				</label>
				<label class='lab'> Sun <br>
					<input type='checkbox' name='day[]' value='7' align=''>
				</label>
			</td>
			<td class='last_row_cell'>
				<input type='text' name='Stime' id='txtcell' value='00:00' style='text-align:center'>
			</td>
			<td class='last_row_cell'>
				<input type='text' name='Etime' id='txtcell' value='00:00' style='text-align:center'>
			</td>
			<td class='last_row_cell'>
				<input type='text' name='EPrice' id='txtcell' value='00.00' style='text-align:center'>
			</td>
			<td class='last_row_cell'>
				<select class="select_direction" name="select_direction" required>
					<option value=""> </option>
					<option value="1"> WEST </option>
					<option value="0"> EAST </option>
				</select>
			</td>
			<td id='submit_cell'>
				<div id='add' class='adbtn'>
					<button type='submit' id='submitbig'> + </button>
				</div>
			</td>
		</form>
	</tr>
</table>

<?php
	mysqli_close($conn); //Make sure to close out the database connection
?>
</body>
