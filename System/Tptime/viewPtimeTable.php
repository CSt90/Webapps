<?php // change all to mysqli format

	include '../db_connect_conf.php';
	if (isset($_GET['error']))
		$error = $_GET['error'];
?>

<html>

<head><meta charset="UTF-8">
<title>Pickup Times table</title>
</head>

<link rel="stylesheet" type="text/css" href="../css/simpleTablePage.css">
<script src="../jsq/jquery-3.1.0.min.js"></script>
<script src="../jsq/submitAndBg.js"></script>
<script src="js/ptimeDelete.js"></script>
<script src="js/pTimeEditCell.js"></script>

<body>
	<div id='home-logo' ><a href='../home.php'></a></div>
	<img id='bg' src='../background/waves_beach.jpg'>
	<h2 id='page-title'> All pickup times </h2>
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
	$ENames = array();
    $excs = array();//
    $r0 = mysqli_query($conn, "SELECT EName FROM excursion");//
    while($r = mysqli_fetch_assoc($r0))//
        array_push($excs, $r['EName']);//
	$qPT = "SELECT * FROM ptime";  //You don't need a ; like you do in SQL
    /*$ptExcs= mysqli_query($conn, $qPT);
	for($i = 1; $i<=mysqli_num_rows($ptExcs); $i++)
		array_push($ENames, mysqli_field_name($ptExcs, $i));
	$num_of_excs = $i;
    $excursions = array_intersect($ENames, $excs);*/

	$query = "SELECT * FROM ptime";  //You don't need a ; like you do in SQL
	$result = mysqli_query($conn, $query);
	$max = mysqli_fetch_assoc(mysqli_query($conn, "SELECT MAX(PTimeID) AS max FROM ptime"));

	echo "<div class='table_container'>
            <table id='pTtable'>"; // start a table tag in the HTML
	echo "<tr id='Cnames'>
			<td class='empty_cell'></td>
			<td> Pickup point area </td>";
	$i=1;
	foreach($excs as $e)
		echo "<td id=ppgroup".($i++)."> ".$e." </td>";
			"<td class='empty_cell'></td>
		  </tr>";
	$first=false;
	if(@mysqli_num_rows($result)>0){ //throws warning if table is empty - @<function> hides it
		while($row = mysqli_fetch_array($result)){ //Creates a loop to loop through results
			echo "<tr>";
			if($first===true){
				echo"<td class='deleteCell'>
						<div class='deleteDiv' onmouseover='showDelRow(this.parentNode.parentNode)' onmouseout='hideDelRow(this.parentNode.parentNode)' onclick='deleteRow(this.parentNode.parentNode)'> &#8210 </div>
					</td>";
				echo"<td class='c1'><p>" . $row['PTimeID'] . "</p></td>";
				$i=2;
				foreach($excs as $e)
					echo "<td class=c".($i++)."><p>".$row[$e]."</p></td>";
			}
			else{
				echo"<td class='empty_cell'></td>";
				echo"<td class='c1'><p> Direction </p></td>";
				$i=2;
				foreach($excs as $e)
					echo "<td id=class=c".($i++)."><p>".(($row[$e]==='1') ? "West" : "East")."</p></td>";
				$first=true;
			}
			echo"<td class='empty_cell'></td>
			</tr>"; //$row['index'] the index here is a field name
		}
	}

	//the add new table entry button shows up as a table field with full table width marked by '+'
	//colspan='<num of columns>' to give full table width
	//echo "<tr><td id='add' colspan=".mysqli_num_rows(mysqli_query($conn, 'DESCRIBE bus'))."><a href='#'><div class='opBtn'> + </div></a></td></tr>";
	$tableCols = mysqli_num_rows(mysqli_query($conn, 'DESCRIBE pickup'));
?>
			<tr id='add_new'>
				<form id='add1' action='insertIntoPickupTable.php' method='post'>
					<td class='empty_cell'></td> <!-- 'delete-button' column -->
					<td class='last_row_cell'>
						<input type='text' name='PTimeID' id='txtcell' value = '<?php print_r((int)($max['max']+1)) ?>' style='text-align:center'>
					</td>
<?php
	foreach($excs as $e)
				echo"<td class='last_row_cell'>
						<input type='text' name='".$e."ptime' id='txtcell'>
					</td>";
?>
					<td class='submit_cell'>
						<div id='add'>
							<button type='submit' id='submit'> + </button>
						</div>
					</td>
				</form>
			</tr>
		</table>
    </div>
</body>

<?php
	mysqli_close($conn); //Make sure to close out the database connection
	function mysqli_field_name($result, $field_offset)
    {
/* 		print_r($result);
		print_r($field_offset); */
        $properties = mysqli_fetch_field_direct($result, $field_offset);
        return is_object($properties) ? $properties->name : false;
    }
?>
</html>
