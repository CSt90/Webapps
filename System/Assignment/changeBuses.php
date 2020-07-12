<?php
	include '../db_connect_conf.php';
	
	if (isset($_POST['exc']) && isset($_POST['date']) && isset($_POST['idno']) && isset($_POST['buses'])){
		$ename = mysqli_real_escape_string($conn, $_POST['exc']);
		$exid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT idExcursion FROM excursion WHERE EName = '$ename'"));
		$eid = mysqli_real_escape_string($conn, $exid['idExcursion']);
		$date = mysqli_real_escape_string($conn, date("Y-m-d", strtotime($_POST['date'])));
		$busesID = array();
		$status = '';
		$out = '';
		//delete all if nobus was selected
		if($_POST['buses'][0]=='nobus'){
			mysqli_query($conn, "DELETE FROM bus_assignment WHERE ExcursionID='$eid' AND ExcursionDate='$date'");
			$status=$status."\ndeleted all associated assignments";
			$out = '-';
		}
		else{
			$excBuses = mysqli_query($conn, "SELECT BusID FROM bus_assignment WHERE ExcursionID='$eid' AND ExcursionDate='$date'");
			if (mysqli_num_rows($excBuses)<=0){ //if no buses are already assigned
				foreach($_POST['buses'] as $bus){ //just insert every selected
					mysqli_query($conn, "INSERT INTO bus_assignment(ExcursionID, ExcursionDate, BusID) VALUES('$eid', '$date', '$bus')");
					$status=$status."\ninserted ".$bus;
				}
			}
			else if (mysqli_num_rows($excBuses)>0){ //otherwise
				while($excBus = mysqli_fetch_assoc($excBuses)){			
					array_push($busesID, $excBus['BusID']); //first, push every assigned bus into an array
				}
				$combo = array_intersect($_POST['buses'], $busesID); // buses that are both selected and assigned
				$selectedAndnotAssigned = array_diff($_POST['buses'], $busesID); //buses selected but not assigned
				$assignedAndnotSelected = array_diff($busesID, $_POST['buses']); //buses assigned but not selected
				if(count($combo)>0){ //if there are buses both checked and selected
					if ($assignedAndnotSelected) //if there are assigned but not selected buses
						$tempb = array_values($assignedAndnotSelected)[0]; //get the first one
					else
						$tempb = '';
					if(mysqli_num_rows($excBuses)<=count($_POST['buses'])){ //if there are less buses assigned than checked
						foreach ($selectedAndnotAssigned as $sna){
							if ($tempb){ //as long as there are assigned but not selected buses
								//replace every one of those with a new bus that was selected but not assigned
								mysqli_query($conn, "UPDATE bus_assignment SET BusID='$sna' WHERE ExcursionID='$eid' AND ExcursionDate='$date' AND BusID = '$tempb'");
								$status=$status."\nreplaced ".$tempb." with ".$sna;
								$tempb = next($assignedAndnotSelected);
							}
							else{ //otherwise
								mysqli_query($conn, "INSERT INTO bus_assignment(ExcursionID, ExcursionDate, BusID) VALUES('$eid', '$date', '$sna')");
								$status=$status."\ninserted ".$sna; //just insert
							}
						}
					}
					else{ //if there are more buses assigned than checked
						foreach ($selectedAndnotAssigned as $sna){
							if ($tempb){//same as above
								mysqli_query($conn, "UPDATE bus_assignment SET BusID='$sna' WHERE ExcursionID='$eid' AND ExcursionDate='$date' AND BusID = '$tempb'");
								$status=$status."\nreplaced ".$tempb." with ".$sna;
								$tempb = next($assignedAndnotSelected);
							}
						}
						foreach($assignedAndnotSelected as $ans){ //but for the rest, just delete them
							mysqli_query($conn, "DELETE FROM bus_assignment WHERE BusID='$ans'");
							$status=$status."\ndeleted ".$ans;
						}
					}
				}
				else{ //nothing in common between selected and assigned buses
					$tempb = $busesID[0]; //just get the first checked
					if(mysqli_num_rows($excBuses)<=count($_POST['buses'])){ //same as line 38 and below
						foreach ($selectedAndnotAssigned as $sna){
							if ($tempb){
								mysqli_query($conn, "UPDATE bus_assignment SET BusID='$sna' WHERE ExcursionID='$eid' AND ExcursionDate='$date' AND BusID = '$tempb'");
								$status=$status."\nreplaced ".$tempb." with ".$sna;
								$tempb = next($busesID);
							}
							else{
								mysqli_query($conn, "INSERT INTO bus_assignment(ExcursionID, ExcursionDate, BusID) VALUES('$eid', '$date', '$sna')");
								$status=$status."\ninserted ".$sna;
							}
						}
					}
					else{
						foreach ($selectedAndnotAssigned as $sna){
							if ($tempb){
								mysqli_query($conn, "UPDATE bus_assignment SET BusID='$sna' WHERE ExcursionID='$eid' AND ExcursionDate='$date' AND BusID = '$tempb'");
								$status=$status."\nreplaced ".$tempb." with ".$sna;
								$tempb = next($busesID);
							}
						}
						while($tempb){
							mysqli_query($conn, "DELETE FROM bus_assignment WHERE BusID='$tempb'");
							$status=$status."\ndeleted ".$tempb;
							$tempb = next($busesID);
						}
					}
				}				
			}
			foreach($_POST['buses'] as $bid){ //now get the name of each busID in order for getBuses.js to display them
				$BName = mysqli_fetch_assoc(mysqli_query($conn, "SELECT BName FROM bus WHERE idBus='$bid'"))['BName'];
				$out = $out."|".$BName."|"; //create the new string
			}
		}
		echo $out;
		mysqli_close($conn);
	}
	else
		echo "you got a mitsake. look again";
	//echo $status; //uncomment for debugging; be sure to console log the output on getExcs.js
?>