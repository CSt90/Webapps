<?php

?>

<html>

<head>
	<meta charset="UTF-8">
	<title>Restore Backup</title>
</head>

<script src="../jsq/jquery-3.1.0.min.js"></script>
<script src="../jqui/jquery-ui.min.js"></script>

<body>
	<div id='home-logo' ><a href='../home.php'></a></div>
<img id='bg' src='../background/waves_beach.jpg'></img>
	<form id='file-select' method='post' action='import.php' enctype='multipart/form-data'>
		<span id='instruction-span'> Select the .sql file to restore </span>
		</br>
		<div id='select-btn'>
			<label for='backupfile' id='backuplabel'> Select file </label>
			<input type='file' id='backupfile' class='empty' name='file' accept='.sql'/>
		</div>
		</br>
		<span id='selected-filename' class='empty'></span>
		<div id='restore-btn'>
			<label for='restorebtn' id='restorelabel' disabled> Restore </label>
			<button id='restorebtn' type='submit' disabled></button>
		</div>
	</form>
	<style>
		body{
			display:flex;
			font-family:Arial;
			font-size:15px;
			/* position:flex; */
			flex-direction:column;
			/*background: linear-gradient(to bottom, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0) 100%);*/
			background-position:center;
			background-repeat:no-repeat;
			background-size:cover;
			background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 1) 80%);
		}
		#bg{
			position:fixed;
			z-index:-1;
			top:0;
			left:0;
			width:100%;
			height:100%;
			opacity:0.4;
		}
		#home-logo{
			background-image: url(../menuicon/home_1b1991.png);
			background-color:#e1e1e1;
			background-size:contain;
			background-repeat: no-repeat;
			background-position: center;
			width:80px;
			height:55px;
			margin-left:0.5%;
			margin-top:0.5%;
			border-radius:2px;
			-webkit-border-radius:2px;
			-moz-border-radius:2px;
			box-shadow:0px 3px 10px 0 #d9d9d9;
			-moz-box-shadow:0px 3px 10px 0 #d9d9d9;
			-webkit-box-shadow:0px 3px 10px 0 #d9d9d9;
		}

		#home-logo:hover{
			background-image: url(../menuicon/home_bfbfc2.png);
			background-color:#000bad;
		}

		#home-logo a{
			display:block;
			width:100%;
			height:100%;
		}
		#select-btn, #restore-btn{
			display:flex; flex-direction:row;
		}
		#instruction-span{
			text-align:center;
			background-color:#000bad;
			color:white;
			border-radius:5px 5px 0 0;
		}
		#backuplabel, #restorelabel{
			background-color:#3498db;
			-moz-border-radius:3px;
			-webkit-border-radius:3px;
			border-radius:3px;
			text-align:center;
			color:#ffffff;
			font-family:Arial;
			padding:0 10px;
			margin:2% auto;
			height:5%;
			line-height:195%;
		}
		#backuplabel:hover{
			background-color:#3cb0fd;
			cursor:pointer;
		}
		#restorelabel{
			cursor:not-allowed;
		}
		#backuplabel:active,
		#restorelabel:active{
			background-color:#3498db;
		}
		#file-select{
			background-color:rgba(255, 255, 255, 0.8);
			margin-top:7%;
			width:40%;
			display:flex;
			margin:5% auto;
			flex-direction:column;
			border:1px solid #9e9e9e;
			border-radius:5px;
			box-shadow: 0 0 10px rgba(0,0,0,0.6);
			-moz-box-shadow: 0 0 35px rgba(0,0,0,0.6);
			-webkit-box-shadow: 0 0 35px rgba(0,0,0,0.6);
			-o-box-shadow: 0 0 3	5px rgba(0,0,0,0.6);

		}
		#restorebtn, #backupfile{
			margin-top:10%;
			width:0;
			height:0;
			padding:0;
			outline:none;
		}

		#restorebtn{
			visibility:hidden;
		}

		#selected-filename{
			height:3%;
			width:55%;
			text-align:center;
			margin:1px auto 15px;
			padding:5px;
			border:1px solid #3cb0fd;
			border-radius:3px;
		}
		.empty{
			visibility:hidden;
		}
		.full{
			visibility:visible;
		}
	</style>
</body>
<script>
	$('#backupfile').on('change', function(){
		file = $('#backupfile').val();
		if (file!== ''){
			$('#selected-filename').text(file.replace('C:\\fakepath\\',''));
			$('#selected-filename').attr('class', 'full');
			$('#selected-filename').css('background-color', '#eaeaea');
			$('#restorelabel').prop('disabled', false);
			$('#restorebtn').prop('disabled', false);
			$('#restorelabel').on('mouseover', function(){
				$('#restorelabel').css('background-color','#3cb0fd');
				$('#restorelabel').css('cursor','pointer');
			});
		}
		else{
			$('#selected-filename').text('');
			$('#selected-filename').attr('class', 'empty');
			$('#restorelabel').prop('disabled', true);
			$('#restorebtn').prop('disabled', true);
			$('#selected-filename').css('background-color', 'default');
			$('#restorelabel').on('mouseover', function(){
				$('#restorelabel').css('cursor','not-allowed');
				$('#restorelabel').css('background-color','#3498db');
			});
		}
	});
</script>
</html>
