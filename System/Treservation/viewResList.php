<?php // change all to mysqli format

	include '../db_connect_conf.php';
	if (isset($_GET['error']))
		$error = $_GET['error']; ?>
<script src="../jsq/jquery-3.1.0.min.js"></script>
<?php
	if (isset($_GET['ex']) && isset($_GET['date'])){
		$exc = $_GET['ex'];
		$dat = $_GET['date'];
	}
?>

<html>

<head><meta charset="UTF-8">
<title>Reservations</title>
</head>

<link rel="stylesheet" type="text/css" href="css/ResList.css">
<script src="../jsq/jquery-3.1.0.min.js"></script>
<script src="js/res_list.js"></script>
<script src="js/resEdit.js"></script>
<script src="../jqui/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="../jqui/jquery-ui.css">

<body>
<?php
/*<div id="editsuccessbox" style="display:none;"><img id="editsuccessV" src="../msgimg/bluetick.png" alt="Great Success!! Borat Approves" height="32" width="32"><span id="editsuccessmsg">Edit successful</span></div>
<div id="errorbox" style="display:none" ><img id="errorx" src="../msgimg/x2.png" alt="Error" height="32" width="32"><span id="errormsg"></span></div>*/
if ($dat){ ?>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#gobtn').click();
		});
	</script>
<?php }
?>
<div id='confirm-prompt'>
	<div id='prompt-block'>
		<p id='prompt-q'></p>
		<div id='confirm'> Yes </div><div id='cancel'> Cancel </div>
	</div>
</div>
<div id='top-container'>
	<div class='left-column'>
		<div id='home-logo' ><a href='../home.php'></a></div>
		<div id='dropdown'>
			<div class='col-title'>
				<span class='info req'>Excursion</span>
			</div>
			<?php
				/* if ($exc){
					$query = "SELECT idExcursion, FROM excursion WHERE EName = '$exc'";
					$result = mysqli_query($conn, $query);
				} */
				$query = 'SELECT idExcursion, EName FROM excursion';
				$exDays = array();
				$result = mysqli_query($conn, $query);
				echo "<select id='drop' name='dropdown' value='' required><option value='-1'>Select..</option>"; //onchange='getContent()'
				$i=0;
				while($r = mysqli_fetch_array($result)) {
					if ($exc == $r['idExcursion'])
						echo "<option value=".$r['idExcursion']." selected = 'selected'>".$r['EName']."</option>";
					else
						echo "<option value=".$r['idExcursion'].">".$r['EName']."</option>";
				}

				echo "</select>";
			?>
		</div>
		<div id='cal'>
			<div class='col-title'>
				<span class='info req'>Date</span>
			</div>
			<input type='text' name='ExDate' id='datepicker' value= '<?php echo((isset($dat))? $dat : '')?>' required/>
		</div>
<!--	<a href="#" id="gobtn" title='Show all the reservations for this excursion'>Go</a>-->
		<div id='gobtn' title='Show all the reservations for this excursion'>Go</div>
	</div>
	<div class='mid-column'>
		<a href="#" id="addRes-btn" title='Add a new reservation for this excursion' target="_blank">+</a>
	</div>
	<div class='right-column'>
		<div id='seats-right'>
			<div class='col-title'>
				<span class='info req'>Seats</span>
			</div>
			<div id='seats'>- / -</div>
		</div>
		<a href="#" id="assign" title='Go to the bus assignment page' target="_blank">Manage</a>
		<div id='buses-right'>
			<div class='col-title'>
				<span class='info req'>Buses</span>
			</div>
			<div id='buses'></div><!--up to five two-digit numbers with | as spacer-->
		</div>
	</div>
</div>

<img id='bg' src='../background/waves_beach.jpg'>
<div id='dynamic-content'><div id='prompt-box'><span id='prompt-text'>Select excursion first </span></div></div>
<script src="js/bgDel.js"></script>
</body>
</html>
<?php mysqli_close($conn); ?>
