<?php
	include '../db_connect_conf.php';
	
	if (isset($_POST['exc']) && isset($_POST['date']) && isset($_POST['idno']) && isset($_POST['buses'])){
		$id = $_POST['idno'];
		//I have to get the excursion id for the $_POST['exc']=excursion name
		$ename = $_POST['exc'];
		$exid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT idExcursion FROM excursion WHERE EName = '$ename'"));
		$date = mysqli_real_escape_string($conn, date("Y-m-d", strtotime($_POST['date'])));
		$getBuses = mysqli_query($conn, "SELECT idBus, BName FROM bus where 1"); 
//                                         idBus
//										 not IN
//										 (SELECT BusID from bus_assignment 
//										 where ExcursionDate='".$date."' AND ExcursionID<>'".$exid['idExcursion']."')");
		if(mysqli_num_rows($getBuses)==0){?>
			<span class='nobuses'>No bus to assign</span>
<?php	}
		else{ ?>
			<div class='multi' id='multi<?php echo $id ?>'>
				<div class='sel' id='sel<?php echo $id ?>'>	
					<select class='dropselect' id='drop<?php echo $id ?>'>
						<option id='opsel<?php echo $id ?>'><?php echo $_POST['buses']?></option>
					</select>
					<div class='middleman'></div>
				</div>
				<div class='chklist' id='chklist<?php echo $id ?>'>
<?php			while($buses = mysqli_fetch_assoc($getBuses)){
					echo "<div class='chkline'><input type='checkbox' id='".$buses['idBus']."' for='".$buses['BName']."'/><label class='chktext' for='".$buses['idBus']."'>".$buses['BName']."</label></div>";
				}?>
				<div class='chkline'><input type='radio' id='nobus' name='nobus' value='nobus'/><label class='chktext' for='nobus'>No bus</label></div>
				</div>
			</div>
<?php	}
	}
	else{?>
		<span class='nobuses'>Select excursion first</span>
<?php
	}
?>