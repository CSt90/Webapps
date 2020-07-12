<?php
	include '../db_connect_conf.php';
		
	if(isset($_POST['exc']) && isset($_POST['date'])){
		$exc = $_POST['exc'];
		if($exc>0 && strtotime($_POST['date'])!==false){ //date_create_from_format('Y-m-d', $date)!==false
			$date = mysqli_real_escape_string($conn, date("Y-m-d", strtotime($_POST['date'])));
            
            $exc_name = mysqli_fetch_assoc(mysqli_query($conn, "Select EName from excursion WHERE idExcursion = '$exc'"));
            $ename = $exc_name['EName'];
            
            $dir = mysqli_fetch_array(mysqli_query($conn, "SELECT `$ename` FROM ptime LIMIT 1"));
            $direction = '';
            if ($dir[0] == 0) //to HER
                $direction = 'DESC';
            else if ($dir[0] == 1) //to CHA
                $direction = 'ASC';
			if($ename == 'Gorges return')
				$query = "SELECT PTime, LastName, Phone, Adults, Kids, Infants, VoucherNo, Pickup, HotelID, RoomNo, Language, ReservationOfficeID, POB, POBamt FROM reservations WHERE (ExcursionID = 1 OR ExcursionID = 2 OR ExcursionID = 4) AND ExDate = '$date'  ORDER BY Pickup DESC";
			else
				$query = "SELECT PTime, LastName, Phone, Email, Adults, Kids, Infants, VoucherNo, Pickup, HotelID, RoomNo, Language, Nationality, ReservationOfficeID, POB, POBamt, Noshow FROM reservations WHERE ExcursionID = '$exc' AND ExDate = '$date'  ORDER BY Pickup, PTime ".$direction;  //You don't need a ; like you do in SQL
            $result = mysqli_query($conn, $query);
			
			if(@mysqli_num_rows($result)>0){ //throws warning if table is empty - @<function> hides it
				$i=0;
                $totalAdults=0;
                $totalKids=0;
				$totalSeats=0;
                $pobTotal=0;
                $ptimePrev='';
                $d = date('d/m/Y', strtotime($_POST['date']));
                echo "<table id='pltable'>";
                echo "<tr><td></td><td></td><td><p>EXCURSION AGENCY</p></td><td colspan='9'></td></tr>";
                echo "<tr><td></td><td></td><td><p>$ename</p></td><td></td><td></td><td></td><td><p>$d</p></td><td colspan='5'></td></tr>";
                echo "<tr class='empty-row'><td colspan='12'></td></tr>";
				while($row = mysqli_fetch_array($result)){ //Creates a loop to loop through results
					$b = '';
					$tseats = 0;
					$tempp = $row['Pickup']; $temph = $row['HotelID']; $tempo = $row['ReservationOfficeID']; //$temps = $row['SellerID'];
					$ppointq = mysqli_query($conn, "SELECT PPoint FROM pickup WHERE idPickup = '$tempp'");
					$ppoint = mysqli_fetch_array($ppointq);
					$hnameq = mysqli_query($conn, "SELECT HName FROM hotel WHERE idHotel = '$temph'");
					$hname = mysqli_fetch_array($hnameq);
                    $totalAdults+=$row['Adults'];
                    $totalKids+=$row['Kids'];
                    $pobTotal+=$row['POBamt'];

//					$resoffq = mysqli_query($conn, "SELECT OName FROM office WHERE idOffice = '$tempo'");
//					$resoff = mysqli_fetch_array($resoffq);
//					$selq = mysqli_query($conn, "SELECT SName FROM seller WHERE idSeller = '$temps'");
//					$sel = mysqli_fetch_array($selq);
//					if ($row['Noshow'] == '0'){
//						$show = 'Show';
//						$showtitle = 'Remove noshow';
//					}
//					else{
//						$show = 'Noshow';
//						$showtitle = 'Set as noshow';
//					}
                    /* if ($row['PTime'] != $ptimePrev && $i>0)
                        echo "<tr class='empty-row'><td colspan='12'></td></tr>"; */
                    
					echo "<tr>
						<td class='c1'><p>" . ($row['PTime']==$ptimePrev ? '' : $row['PTime']) . "</p></td>
						<td class='cEmpty'><p></p></td>
						<td class='c2'><p>" . strtoupper($row['LastName']).($row['Kids'] > 0 ? '('.$row['Kids'].' CHI)' : '' ).($row['Infants'] > 0 ? '('.$row['Infants'].' INF)' : '' ). "</p></td>
                        <td class='c3'><p>" . ($row['Adults']+$row['Kids']) . "</p></td>
						<td class='c4'><p>" . $row['VoucherNo']. "</p></td> 
						<td class='cEmpty'><p></p></td>						
						<td class='c5' ><p>" . strtoupper($ppoint['PPoint'] == $hname['HName'] ? $ppoint['PPoint'] : ($hname['HName'].' &#x261B '.$ppoint['PPoint'])). "</p></td>
                        <td class='c6'><p>" . $row['RoomNo']. "</p></td>
						<td class='cEmpty'><p></p></td>
                        <td class='c7'><p>" . $row['Language']. "</p></td>
                        <td class='c8'><p>" .strval($row['Phone']). "</p></td>
                        <td class='c9'><p>" . ($row['POB']>0 ? (number_format($row['POBamt'], 2)." €") : " "). "</p></td>
					</tr>"; //$row['index'] the index here is a field name
					$i+=$row['Adults']+$row['Kids'];
                    $ptimePrev = $row['PTime'];
				}// <td class='c7'><p>" . $hname['HName']. "</p></td>
                echo "<tr class='empty-row'>
                    <td colspan='12'></td>
                </tr>
                <tr>
					<td></td>
					<td></td>
                    <td class='c10' style='border-top:1px solid #888'><p> Total persons </p></td>
					<td class='c10' style='border-top:1px solid #888'><p> ".$i." </p></td>
					<td colspan=10></td>
                </tr>";
                if ($pobTotal>0)
                    echo "<tr><td class='c11' colspan='12'><p> Total POB amount: " . number_format($pobTotal, 2). " €</p></td></tr>";
				echo "</table>";
				$sqlGetBus = mysqli_query($conn, "SELECT DISTINCT BName, Seats from bus JOIN
													(Select BusID from bus_assignment
													where ExcursionID='$exc' AND
													ExcursionDate='$date') as b
													on bus.idBus=b.BusID");
				while($e = mysqli_fetch_assoc($sqlGetBus)){
					$b .='|'.$e['BName'].'|';
					$tseats += $e['Seats'];
				}
				echo "<span id='ninja-numofseats' width:0 height:0 style='visibility:hidden'>".$i."</span>";
				echo "<span id='ninja-totalseats' width:0 height:0 style='visibility:hidden'>".$tseats."</span>";
				echo "<span id='ninja-buses' width:0 height:0 style='visibility:hidden'>".$b."</span>";
			}
			else
				echo "<div id='prompt-box'><span id='error-text'>No reservations for this excursion at the selected date.</span></div>";
		}
		elseif (strtotime($_POST['date'])===false)
			echo "<div id='prompt-box'><span id='error-text'>Wrong date. Try again!!!</span></div>";
	}
	else
		echo "<div id='prompt-box'><span id='error-text'>Wrong date. Try again</span></div>";
	mysqli_close($conn);
?>