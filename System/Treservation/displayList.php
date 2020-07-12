<?php
	include '../db_connect_conf.php';
		
	if(isset($_POST['exc']) && isset($_POST['date'])){
		$exc = $_POST['exc'];
		if($exc>0 && strtotime($_POST['date'])!==false){ //date_create_from_format('Y-m-d', $date)!==false
			$date = mysqli_real_escape_string($conn, date("Y-m-d", strtotime($_POST['date'])));
			$query = "SELECT PTime, LastName, Phone, Email, Adults, Kids, Infants, VoucherNo, Pickup, HotelID, RoomNo, Language, Nationality, ReservationOfficeID, SellerID, POB, POBamt, Noshow FROM reservations WHERE ExcursionID = '$exc' AND ExDate = '$date'  ORDER BY ResDate";  //You don't need a ; like you do in SQL
			$result = mysqli_query($conn, $query);
			
			if(@mysqli_num_rows($result)>0){ //throws warning if table is empty - @<function> hides it
				echo "<div class=table_container>
					<table id='tablebig'>
					<tr id='Cnames'>
						<td class='empty_cell'></td>
						<td> PTime</td>
						<td> Last Name </td>
                        <td> Phone </td>
                        <td> Email </td>
						<td> Adults </td>
						<td> Kids </td>
						<td> Infants </td>
						<td> Voucher </td>
						<td> PPoint </td>
						<td> Hotel </td>
						<td> Room </td>
						<td> Language </td>
						<td> Nationality </td>						
						<td> Office </td>
						<td> POB </td>
                        <td> Noshow </td>
						<td class='empty_cell'></td>
					</tr>";
				$i=0;
				$totalSeats=0;
				while($row = mysqli_fetch_array($result)){ //Creates a loop to loop through results
					$b = '';
					$tseats = 0;
					$tempp = $row['Pickup']; $temph = $row['HotelID']; $tempo = $row['ReservationOfficeID']; //$temps = $row['SellerID'];
					$ppointq = mysqli_query($conn, "SELECT PPoint FROM pickup WHERE idPickup = '$tempp'");
					$ppoint = mysqli_fetch_array($ppointq);
					$hnameq = mysqli_query($conn, "SELECT HName FROM hotel WHERE idHotel = '$temph'");
					$hname = mysqli_fetch_array($hnameq);
					$resoffq = mysqli_query($conn, "SELECT OName FROM office WHERE idOffice = '$tempo'");
					$resoff = mysqli_fetch_array($resoffq);
//					$selq = mysqli_query($conn, "SELECT SName FROM seller WHERE idSeller = '$temps'");
//					$sel = mysqli_fetch_array($selq);
					if ($row['Noshow'] == '0'){
						$show = 'Show';
						$showtitle = 'Remove noshow';
					}
					else{
						$show = 'Noshow';
						$showtitle = 'Set as noshow';
					}
					echo "<tr>
						<td class='deleteCell'>
							<div class='deleteDiv' onmouseover='showDelRow(this.parentNode.parentNode)' onmouseout='hideDelRow(this.parentNode.parentNode)' onclick='deleteRow($(this).parent().parent())'> &#8210 </div>
						</td>
						<td class='c1'> <p>" . $row['PTime'] . "</p></td>
						<td class='c2'><p>" . $row['LastName']. "</p></td>
                        <td class='c3'><p>" . $row['Phone']. "</p></td>
                        <td class='c4'><p>" . $row['Email']. "</p></td>
						<td class='c5'><p>" . $row['Adults']. "</p></td>
						<td class='c6'><p>" . $row['Kids']. "</p></td>
						<td class='c7'><p>" . $row['Infants']. "</p></td>
						<td class='c8'><p>" . $row['VoucherNo']. "</p></td>
						<td class='c9'><p>" . $ppoint['PPoint']. "</p></td>
						<td class='c10'><p>" . $hname['HName']. "</p></td>
						<td class='c11'><p>" . $row['RoomNo']. "</p></td>
						<td class='c12'><p>" . $row['Language']. "</p></td>
						<td class='c13'><p>" . $row['Nationality']. "</p></td>						
						<td class='c14'><p>" . $resoff['OName']. "</p></td>
						<td class='c16'><p>" . ($row['POB']>0 ? (number_format($row['POBamt'], 2)." €") : " "). "</p></td>
                        <td class='c17'><p>" . ($row['Noshow']=="0" ? "&#x2718;" : " "). "</p></td>
						<td class='buttons_cell'>
							<div class='buttonsDiv'>
								<div class='edits' onclick=editRes($(this).parent().parent().parent())> Edit </div>
								<div class='".strtolower($show)."' title='".$showtitle."' onclick = changeNoshow($(this))> ".$show." </div>
							</div>
						</td>
					</tr>"; //$row['index'] the index here is a field name
                    //<td class='c15'><p>" . substr($row['SellerID'], 0, 3). "</p></td>
					$i+=$row['Adults']+$row['Kids'];
				}
				echo "</table>
					</div>";
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