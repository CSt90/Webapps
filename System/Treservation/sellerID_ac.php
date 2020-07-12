<?php
include '../db_connect_conf.php';

 //get search term
$searchTerm = $_GET['term'];
$resOfficeID = $_GET['resofficeid'];

//get matched data from table
$query = mysqli_query($conn, "SELECT SName FROM seller WHERE SName LIKE '%".$searchTerm."%' AND SOffice = $resOfficeID ORDER BY idSeller ASC");
while ($row = mysqli_fetch_assoc($query)) {
	$data[] = $row['SName'];
}

//return json data
echo json_encode($data);
?>