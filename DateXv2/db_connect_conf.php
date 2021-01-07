<?php

	ini_set( 'default_charset', 'UTF-8' );//greek chars wouldn't appear unless I used this
	//db info variables
	date_default_timezone_set('Europe/Athens');
	global $conn;
	$dbhost = 'localhost'; //may change if server/host changes. just needs the url.
	$dbuser = 'root'; //cst90
	$dbpassword = ''; //m@zdarx-8
	$dbdatabase = 'datex';

	//site-related variables

	//$sitename = 'System';
	$baseurl = 'http://localhost/DateX'; //homepage url

	//db connection functions

	/*$datab = mysql_connect($dbhost, $dbuser, $dbpassword);

	if (!$datab)
		echo "Connection failure";
	else
		echo "Successfully connected, bitch";
	$database_select = mysql_select_db($dbdatabase, $datab);*/

	$conn = new mysqli($dbhost, $dbuser, $dbpassword, $dbdatabase);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	mysqli_set_charset($conn,"utf8");
	/*else
		echo "Successfully connected, bitch";*/

?>
