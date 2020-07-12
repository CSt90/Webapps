<?php
include '../db_connect_conf.php';

 //get search term
$searchTerm = $_GET['term'];

//get matched data from table
$query = mysqli_query($conn, "SELECT HName FROM hotel WHERE HName LIKE '%".$searchTerm."%' ORDER BY idHotel ASC");
while ($row = mysqli_fetch_assoc($query)) {
	$data[] = $row['HName'];
}

//return json data
echo json_encode($data);
?>