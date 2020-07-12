<?php

/**********************************************************************
 * 	this file gets the ajax post call from <select_res_list.js>	  	  *
 * 	with the id of the selected excursion as parameter				  *
 * 	and finds the days which are not included in the excursion table  *
 * 	for the corresponding excursion. 								  *
 * 	So the days the excursion doesn't happen, are echo'd back 		  *
 * 	to the script as a string										  *
 **********************************************************************/
	include '../db_connect_conf.php';
	
	if (isset($_POST['exc'])){
		$exc = $_POST['exc'];
		$query = "SELECT Mon, Tue, Wed, Thu, Fri, Sat, Sun FROM excursion WHERE idExcursion = '$exc' ";
		$result = mysqli_query($conn, $query) or die('DB connection error');
		$exDays = '';
		if (mysqli_num_rows($result)==1){
			$r = mysqli_fetch_array($result);
			//$exDays = $r['Mon'].$r['Tue'].$r['Wed'].$r['Thu'].$r['Fri'].$r['Sat'].$r['Sun']; binary array/string
			if ($r['Sun']==0)
				$exDays = '0'; //sunday is 0 in calendar
			if ($r['Mon']==0)
				$exDays = $exDays.'1'; //monday is 1 in calendar
			if ($r['Tue']==0)
				$exDays = $exDays.'2'; //tuesday is 2 in calendar
			if ($r['Wed']==0)
				$exDays = $exDays.'3'; //etc..
			if ($r['Thu']==0)
				$exDays = $exDays.'4';
			if ($r['Fri']==0)
				$exDays = $exDays.'5';
			if ($r['Sat']==0)
				$exDays = $exDays.'6';
			echo ($exDays);
		}
		else
			die('Multiple excursions with this name');
	}
	else
		die('No excursion selected');
?>