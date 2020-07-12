<?php
include '../db_connect_conf.php';
if (isset($_POST['exID'])){
	$exID = $_POST['exID'];
	$EPrice = mysqli_fetch_assoc(mysqli_query($conn, "SELECT EPrice FROM excursion WHERE idExcursion ='$exID'"));
	echo $EPrice['EPrice'];
}

?>