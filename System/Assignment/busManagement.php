<?php
	session_start();
	include '../db_connect_conf.php';

	if(isset($_GET['date']))
		$dat = $_GET['date'];
?>

<html>

<head><meta charset="UTF-8">
<title>Bus Management</title>
</head>

<link rel="stylesheet" type="text/css" href="css/busManagement.css">
<link rel="stylesheet" type="text/css" href="css/assignMore.css">
<script src="../jsq/jquery-3.1.0.min.js"></script>
<script src="../jsq/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="../jqui/jquery-ui.css"></link>

<body>
	<div id='overlay'>
		<div id='popup'>
			<span id='moreClose' title='Close'> x </span>
			<form id='moreForm'>
				<span id='form-title'> Assign drivers and guides</span>
				<div id='form-top'>
					<div class='formPiece'>
						<label for='drivers'> Drivers </label>
						<input type='text' id='drivers' name='drivers' placeholder="Drivers' names"/>
					</div>
					<div class='formPiece'>
						<label for='guides'> Guides </label>
						<input type='text' id='guides' name='guides' placeholder="Guides' names"/>
					</div>
				</div>
				<div id='form-bottom'>
					<div class='formPiece'>
						<label for='notes'> Notes </label>
						<textarea id='notes' rows='3' cols='40' name='notes' placeholder='Your notes..'></textarea>
					</div>
				</div>
				<div id='more-btn'>
					<div id='submit-more-label'> Done </div> <span id='successful-submission'> &#10004 </span> <span id='unsuccessful-submission'> &#10008 </span>
				</div>
			</form>
		</div>
	</div>
	<img id='bg' src='../background/waves_beach.jpg'>
	<div class='top-container'>
		<div id='home-logo' ><a href='../home.php'></a></div>
		<div id='cal'>
			<div class='col-title'>
				<span class='info req'>Date</span>
			</div>
			<input type='text' name='ExDate' id='datepicker' value='<?php echo(isset($dat) ? $dat : "")?>' required/>
			<?php
				if(isset($dat)){
			?>
				<script type="text/javascript">
					$(document).ready(function() {
						$('#gobtn').click();
					});
				</script>
			<?php
				}
			?>
		</div>
		<a href="#" id="gobtn" title='Show all the excursions for this date'>Go</a>
	</div>
	<span id='msg'></span>
	<div id='filled-content'>
		<div id='content'>
			<div id='top-titles'>
				<span id='title1' class='title'>Excursion</span><span id='title2' class='title'>Buses</span><span id='title3' class='title'>Persons</span>
			</div>
			<div id='sub-titles'>
				<div id='clear'></div>
				<div id='langs'>
					<span id='l1' class='label'>E</span><span id='l2' class='label'>D</span><span id='l3' class='label'>F</span><span id='l4' class='label'>R</span><span id='l5' class='label'>Total</span>
				</div>
			</div>
			<div id='rest'>
				<div id='excs'>
					<div class='line'>
						<span class='count'>1.</span><span id='exc1' class='excname'> - </span>
					</div>
					<div class='line'>
						<span class='count'>2.</span><span id='exc2' class='excname'> - </span>
					</div>
					<div class='line'>
						<span class='count'>3.</span><span id='exc3' class='excname'> - </span>
					</div>
					<div class='line'>
						<span class='count'>4.</span><span id='exc4' class='excname'> - </span>
					</div>
					<div class='line'>
						<span class='count'>5.</span><span id='exc5' class='excname'> - </span>
					</div>
					<div class='line'>
						<span class='count'>6.</span><span id='exc5' class='excname'> - </span>
					</div>
				</div>
				<div id='buses'>
					<div class='line'>
						<span id='buses1' class='buslist'> - </span><a class='chng disabledBtn' id='ch1' href='#' title='Change the buses assigned to this excursion'>Change</a>
						<div id='more1' class='more disabledBtn' title='Assign more'> &#9679;&#9679;&#9679;</div>
					</div>
					<div class='line'>
						<span id='buses2' class='buslist'> - </span><a class='chng disabledBtn' id='ch2' href='#' title='Change the buses assigned to this excursion'>Change</a>
						<div id='more2' class='more disabledBtn' title='Assign more'> &#9679;&#9679;&#9679;</div>
					</div>
					<div class='line'>
						<span id='buses3' class='buslist'> - </span><a class='chng disabledBtn' id='ch3' href='#' title='Change the buses assigned to this excursion'>Change</a>
						<div id='more3' class='more disabledBtn' title='Assign more'> &#9679;&#9679;&#9679;</div>
					</div>
					<div class='line'>
						<span id='buses4' class='buslist'> - </span><a class='chng disabledBtn' id='ch4' href='#' title='Change the buses assigned to this excursion'>Change</a>
						<div id='more4' class='more disabledBtn' title='Assign more'> &#9679;&#9679;&#9679;</div>
					</div>
					<div class='line'>
						<span id='buses5' class='buslist'> - </span><a class='chng disabledBtn' id='ch5' href='#' title='Change the buses assigned to this excursion'>Change</a>
						<div id='more5' class='more disabledBtn' title='Assign more'> &#9679;&#9679;&#9679;</div>
					</div>
					<div class='line'>
						<span id='buses6' class='buslist'> - </span><a class='chng disabledBtn' id='ch6' href='#' title='Change the buses assigned to this excursion'>Change</a>
						<div id='more6' class='more disabledBtn' title='Assign more'> &#9679;&#9679;&#9679;</div>
					</div>
				</div>
				<div id='persons'>
					<div id='eng'>
						<div class='smallbox'>
							<span id='eng1' class='ppl'> - </span>
						</div>
						<div class='smallbox'>
							<span id='eng2' class='ppl'> - </span>
						</div>
						<div class='smallbox'>
							<span id='eng3' class='ppl'> - </span>
						</div>
						<div class='smallbox'>
							<span id='eng4' class='ppl'> - </span>
						</div>
						<div class='smallbox'>
							<span id='eng5' class='ppl'> - </span>
						</div>
						<div class='smallbox'>
							<span id='eng6' class='ppl'> - </span>
						</div>
					</div>

					<div id='de'>
						<div class='smallbox'>
							<span id='de1' class='ppl'> - </span>
						</div>
						<div class='smallbox'>
							<span id='de2' class='ppl'> - </span>
						</div>
						<div class='smallbox'>
							<span id='de3' class='ppl'> - </span>
						</div>
						<div class='smallbox'>
							<span id='de4' class='ppl'> - </span>
						</div>
						<div class='smallbox'>
							<span id='de5' class='ppl'> - </span>
						</div>
						<div class='smallbox'>
							<span id='de6' class='ppl'> - </span>
						</div>
					</div>

					<div id='fr'>
						<div class='smallbox'>
							<span id='fr1' class='ppl'> - </span>
						</div>
						<div class='smallbox'>
							<span id='fr2' class='ppl'> - </span>
						</div>
						<div class='smallbox'>
							<span id='fr3' class='ppl'> - </span>
						</div>
						<div class='smallbox'>
							<span id='fr4' class='ppl'> - </span>
						</div>
						<div class='smallbox'>
							<span id='fr5' class='ppl'> - </span>
						</div>
						<div class='smallbox'>
							<span id='fr6' class='ppl'> - </span>
						</div>
					</div>

					<div id='ru'>
						<div class='smallbox'>
							<span id='ru1' class='ppl'> - </span>
						</div>
						<div class='smallbox'>
							<span id='ru2' class='ppl'> - </span>
						</div>
						<div class='smallbox'>
							<span id='ru3' class='ppl'> - </span>
						</div>
						<div class='smallbox'>
							<span id='ru4' class='ppl'> - </span>
						</div>
						<div class='smallbox'>
							<span id='ru5' class='ppl'> - </span>
						</div>
						<div class='smallbox'>
							<span id='ru6' class='ppl'> - </span>
						</div>
					</div>

					<div id='tot'>
						<div class='smallbox'>
							<span id='tot1' class='ppl'> - </span>
						</div>
						<div class='smallbox'>
							<span id='tot2' class='ppl'> - </span>
						</div>
						<div class='smallbox'>
							<span id='tot3' class='ppl'> - </span>
						</div>
						<div class='smallbox'>
							<span id='tot4' class='ppl'> - </span>
						</div>
						<div class='smallbox'>
							<span id='tot5' class='ppl'> - </span>
						</div>
						<div class='smallbox'>
							<span id='tot6' class='ppl'> - </span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
				$(document).ready(function(){
				  $("#datepicker").datepicker({dateFormat : 'dd-mm-yy'});
				});
</script>
<script src="js/busManagement_actions.js"></script>
