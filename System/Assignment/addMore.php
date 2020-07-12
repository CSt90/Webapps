<?php
	session_start();
	include '../db_connect_conf.php';
	
	$error = array();
	
	if (isset($_POST['date']))
		$date = date('Y-m-d', strtotime($_POST['date']));
	
	//$assignmentExists = 0;
	if(isset($_POST['exc'])){
		$excname = $_POST['exc'];
		$exc = mysqli_fetch_assoc(mysqli_query($conn, "SELECT idExcursion FROM excursion WHERE EName='$excname'"));
		$excid = $exc['idExcursion'];
		$checkAssignment = mysqli_query($conn, "SELECT * FROM bus_assignment WHERE ExcursionID='$excid' AND ExcursionDate='$date'");
	}
	
	if(isset($_POST['drivers']))
		$d = $_POST['drivers'];
	
	if (isset($_POST['guides']))
		$g = $_POST['guides'];
	
	if (isset($_POST['notes']))
		$notes = $_POST['notes'];
	
	if (isset($_POST['changed']))
		$ch = $_POST['changed'];
	
	if($ch[0] == 1){
		$v_i_drv = "Drivers"; //query part for insert inside VALUES()
		$i_drv = "'".$d."'";
		$q_drv = "Drivers='$d'"; //query part for update after SET
		if($ch[1] == 1 || $ch[2] == 1){
			$q_drv .= ', '; //append after driver part of query if not only drivers are to update
			$v_i_drv .= ', '; //append after driver part of query if not only drivers are to insert
			$i_drv .= ', ';
		}
	}
	else{
		$q_drv = "";
		$v_i_drv = "";
		$i_drv = "";
	}
	
	if($ch[1] == 1){
		$v_i_g = "Guides"; //query part for insert inside VALUES()
		$i_g = "'".$g."'";
		$q_g = "Guides='$g'"; //query part for update after SET
		if ($ch[2] == 1){
			$q_g .= ', '; //append after guide part of query if not only guides are to update
			$v_i_g .= ', '; //append after guide part of query if not only guides are to insert
			$i_g .= ', ';
		}
	}
	else{
		$q_g = "";
		$v_i_g = "";
		$i_g = "";
	}
	
	if($ch[2] == 1){
		$v_i_notes = "BANotes"; //query part for insert inside VALUES()
		$i_notes = "'".$notes."'";
		$q_notes = "BANotes='$notes'"; //query part for update after SET
	}
	else{
		$q_notes = "";
		$v_i_notes = "";
		$i_notes = '';
	}
	
	if (mysqli_num_rows($checkAssignment) > 0){
		/* while($r = mysqli_fetch_assoc($checkAssignment)){
			$assignmentExists++;
		} */
		$a = mysqli_fetch_assoc($checkAssignment);
		$aid = $a['AssignmentID'];
		
		if($ch != [0, 0, 0]){
			mysqli_query($conn, "UPDATE bus_assignment SET $q_drv $q_g $q_notes WHERE AssignmentID = '$aid'");
			if(mysqli_affected_rows($conn) > 0)
				print_r(1);
			else
				print_r(0);
		}
		
	}
	else{
		if($ch != [0, 0, 0]){
			mysqli_query ($conn, "INSERT INTO bus_assignment(ExcursionID, ExcursionDate, $v_i_drv$v_i_g$v_i_notes) VALUES($excid, '$date', $i_drv$i_g$i_notes)");//mysqli_query ($conn, "INSERT INTO bus_assignment(ExcursionID, ExcursionDate, $v_i_drv$v_i_g$v_i_notes) VALUES($excid, '$date', $i_drv$i_g$i_notes)");
			if(mysqli_affected_rows($conn) > 0)
				print_r(1);
			else
				print_r(mysqli_error($conn));
		}
		//mysqli_query("INSERT INTO bus_assignment($i_drv $i_g $i_notes) VALUES('$d', '$d', '$notes')");
	}	
	mysqli_close($conn);
?>