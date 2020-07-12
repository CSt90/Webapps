<?php // change all to mysqli format

	include '../db_connect_conf.php';
	if (isset($_GET['error']))
		$error = $_GET['error'];
?>

<html>

<head><meta charset="UTF-8">
<title>Office table</title>
</head>

<link rel="stylesheet" type="text/css" href="../css/simpleTablePage.css">
<script src="../jsq/jquery-3.1.0.min.js"></script>
<script src="../jsq/submitAndBg.js"></script>
<script src="js/officeDeleteAndEdit.js"></script>
<body>
	<div id='home-logo' ><a href='../home.php'></a></div>
	<img id='bg' src='../background/waves_beach.jpg'>
	<h2 id='page-title'> All reservation offices </h2>
	<div id='message_boxes'>
		<div id="editsuccessbox" style="display:none;"><img id="editsuccessV" src="../msgicon/bluetick.png" height="32" width="32">
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
    $num_of_excs = 0;
    while($r = mysqli_fetch_assoc($r0)){//
        array_push($excs, $r['EName']);
        $num_of_excs++;
    }//
    $query = "SELECT * FROM office";  //You don't need a ; like you do in SQL
    $result = mysqli_query($conn, $query);
	/*for($i = 4; $i<=mysqli_num_rows($result); $i++)
		array_push($ENames, mysqli_field_name($result, $i));
	$num_of_excs = $i;
    $excursions = array_intersect($ENames, $excs);
	 print_r($excursions);*/

	echo "<div class='table_container'>
			<table id='otable'>"; // start a table tag in the HTML

	echo "<tr id='Cnames' style='background-color:mediumaquamarine'>
			<td class='empty_cell'></td>
			<td colspan=3 > Offices </td>
			<td colspan=".($num_of_excs)." > Commission per excursion </td>
		  </tr>
        <tr id='Cnames'>
			<td class='empty_cell'></td>
			<td> Office ID </td>
			<td > Office </td>
			<td> € / % </td>";
    $left_border = "style='border-left:1px solid #ddd'";
    foreach ($excs as $e){
        echo "<td ".$left_border."> ".$e." </td>";
        $left_border = '';
    }
    echo "<td class='empty_cell'></td>
        </tr>";
	$max = 0;
	if(@mysqli_num_rows($result)>0){ //throws warning if table is empty - @<function> hides it
		while($row = mysqli_fetch_array($result)){ //Creates a loop to loop through results
            if($row['idOffice'] >= $max)
                $max = $row['idOffice'];
			echo "<tr>
				<td class='deleteCell'>
					<div class='deleteDiv' onmouseover='showDelRow(this.parentNode.parentNode)' onmouseout='hideDelRow(this.parentNode.parentNode)' onclick='deleteRow(this.parentNode.parentNode)'> &#8210 </div>
				</td>
				<td class='c0'><p>" . $row['idOffice'] . "</p></td>
				<td class='c1'><p>" . $row['OName'] . "</p></td>
				<td class='ctype'><p>" . ($row['CType'] != NULL ? $row['CType'] : '-'). "</p></td>";
                $class = 2;
                $left_border = "style='border-left:1px solid #999'";
                foreach ($excs as $e){
                    echo "<td class='c".$class++."'".$left_border."><p>" . $row[$e]. "</p></td>";
                    $left_border = '';
                }
                echo "<td class='empty_cell'></td>
			</tr>"; //$row['index'] the index here is a field name
		}
	}

	//the add new table entry button shows up as a table field with full table width marked by '+'
	//colspan='<num of columns>' to give full table width
	//echo "<tr><td id='add' colspan=".mysqli_num_rows(mysqli_query($conn, 'DESCRIBE bus'))."><a href='#'><div class='opBtn'> + </div></a></td></tr>";
	$tableCols = mysqli_num_rows(mysqli_query($conn, 'DESCRIBE office'));
?>

			<tr id='add_new'>
				<form id='add1' action='insertIntoOfficeTable.php' method='post'>
					<td class='empty_cell'></td>
					<td class='last_row_cell'>
						<input type='text' name='idOffice' id='txtcell' value = '<?php print_r((int)($max+1)) ?>' style='text-align:center'>
					</td>
					<td class='last_row_cell'>
						<input type='text' name='OName' id='txtcell'>
					</td>
<?php			echo"<td colspan=".($num_of_excs+1)." class='last_row_cell'></td>" ?>
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
