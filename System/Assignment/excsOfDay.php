<?php
	session_start();
	include '../db_connect_conf.php';
	if (isset($_POST['exdate'])){
		$date = mysqli_real_escape_string($conn, $_POST['exdate']);
		$exdate = date("Y-m-d", strtotime($date));
		$day = date("D", strtotime($date)); // day of the week for the given date
		//fetch all excursions for the day of the given date e.g. Monday
		$sqlGetExcs = mysqli_query($conn, "SELECT idExcursion, EName, StartTime, EndTime FROM excursion WHERE $day = '1'");
		//create required arrays
		$excs = array();
		$exc_names = array();
		$buses = array();
		$en = array();
		$de = array();
		$fr = array();
		$ru = array();
		$total = array();
		//row as appeared on the busManagement page e1-e6 for all 6 excs
		$rows_data = array(
			'e1' => '',
			'e2' => '',
			'e3' => '',
			'e4' => '',
			'e5' => '',
			'e6' => '',
		);
		$rd_index = 0;
		
		while($exc = mysqli_fetch_assoc($sqlGetExcs)){
			$b = '';
			$enT = 0;
			$deT = 0; 
			$frT = 0; 
			$ruT = 0; 
			array_push($excs, $exc);
			array_push($exc_names, $exc['EName']);
			$ide = $exc['idExcursion'];			
			//filter the excursions of the specified date using assignments table
			//get the buses for the selected excursion by joining bus and bus_assignment
			$sqlGetBus = mysqli_query($conn, "SELECT DISTINCT BName from bus JOIN
												(Select BusID from bus_assignment
												where ExcursionID='$ide' AND
												ExcursionDate='$exdate') as b
												on bus.idBus=b.BusID");
			while($e = mysqli_fetch_assoc($sqlGetBus))
				$b .='|'.$e['BName'].'|';
			array_push($buses, $b);
			
			//get Adults and kids per language
			$sqlGetLangs = mysqli_query($conn, "SELECT Language, Adults, Kids FROM reservations WHERE ExcursionID = '$ide' AND ExDate = '$exdate'");
			while ($l = mysqli_fetch_assoc($sqlGetLangs)){
				if ($l['Language'] == 'E'){
					$enT += ($l['Adults'] +$l['Kids']);
				}
				else if ($l['Language'] == 'D'){
					$deT += ($l['Adults'] +$l['Kids']);
				}
				else if ($l['Language'] == 'F'){
					$frT += ($l['Adults'] +$l['Kids']);
				}
				else if ($l['Language'] == 'R'){
					$ruT += ($l['Adults'] +$l['Kids']);
				}
			}
			array_push($total, $enT+$deT+$frT+$ruT);
			array_push($en, $enT);
			array_push($de, $deT);
			array_push($fr, $frT);
			array_push($ru, $ruT);
			
			$tmp = array();
			array_push($tmp, $exc_names[$rd_index], $buses[$rd_index], $en[$rd_index], $de[$rd_index], $fr[$rd_index], $ru[$rd_index], $total[$rd_index]);
			$rows_data['e'.($rd_index+1)] = $tmp;
			unset($tmp);			
			$rd_index++;
		}
		echo (json_encode($rows_data));
		mysqli_close($conn);
	}
	else
		echo "Error. Incorrect date.";
?>