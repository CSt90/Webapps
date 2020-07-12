<?php
include '../db_connect_conf.php';

 //get search term
$searchTerm = $_GET['term'];

//get matched data from table
$query = mysqli_query($conn, "SELECT PPoint FROM pickup WHERE PPoint LIKE '%".$searchTerm."%' ORDER BY idPickup ASC");
while ($row = mysqli_fetch_assoc($query)) {
	$data[] = $row['PPoint'];
}

//return json data
echo json_encode($data);
?>