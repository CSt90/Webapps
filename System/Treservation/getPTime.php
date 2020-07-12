<?php
include '../db_connect_conf.php';

if (isset($_POST['ppoint']) && isset($_POST['exc_name'])){ //exc_name
	$ppoint = mysqli_real_escape_string($conn, $_POST['ppoint']);// after that, get the PPointGroup from pickup table, and then based on that and the excursion,
	//fetch the pickup time from PTime table
	$exc = $_POST['exc_name'];
	$group = mysqli_fetch_array(mysqli_query($conn, "SELECT PPointGroup FROM pickup WHERE PPoint = '$ppoint'"));
	$query = "SELECT `".$exc."` FROM ptime WHERE PPointGroup = '$group[0]'";
	$ptime = mysqli_fetch_assoc(mysqli_query($conn, $query));
	echo $ptime[$exc];//$ptime[$exc];
}
else
	echo 'shit';
?>