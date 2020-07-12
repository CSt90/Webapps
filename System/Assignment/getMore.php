<?php
	session_start();
	include '../db_connect_conf.php';
	
	if(isset($_POST['date']))
		$dat = $_POST['date'];
	
	if (isset($_POST['exc']))
		$exc = $_POST['exc'];
	
	$more = array();
	$excdate = date("Y-m-d", strtotime($dat));
	$excursion = mysqli_fetch_assoc(mysqli_query($conn, "SELECT idExcursion FROM excursion WHERE EName='$exc'"));
	$exc = $excursion['idExcursion'];
	$query = mysqli_query($conn, "SELECT Drivers, Guides, BANotes FROM bus_assignment WHERE ExcursionID='$exc' AND ExcursionDate='$excdate'");
	
	$row = 0;
	$drivers = '';
	$guides = '';
	if(mysqli_num_rows($query)>0){
		while($dg =  mysqli_fetch_assoc($query)){
			//$drivers = '|'.$dg['DriverID'].'|';
			if (trim($dg['BANotes']) != '')
				$notes = $dg['BANotes'];
			else
				$notes = '';
			if ($dg['Drivers'] != NULL && trim($dg['Drivers']) != ''){
				/* if($row >= 1){
					$drivers .= ', ';
				} */		
				$drivers = $dg['Drivers'];
				//$d = mysqli_fetch_assoc(mysqli_query($conn, "SELECT DName FROM driver WHERE idDriver='$driver'"));
				//$drivers .= $d['DName'];
			}
			else
				$drivers = '';
			if($dg['Guides'] != NULL && trim($dg['Guides']) != ''){
				/* if($row >= 1){
					$guides .= ', ';
				} */
				$guides = $dg['Guides'];
				//$g = mysqli_fetch_assoc(mysqli_query($conn, "SELECT GName FROM guide WHERE idGuide='$guide'"));
				//$guides .= $g['GName'];
			}
			else
				$guides = '';
			$row++;
		}
	}
	else{
		$drivers = '';
		$guides = '';
		$notes = '';
	}
	$more['drv'] = $drivers;//array_push($more, $drivers);
	$more['gd'] = $guides; //array_push($more, $guides);
	$more['not'] = $notes;
	
	echo (json_encode($more));
	mysqli_close($conn);
?>
