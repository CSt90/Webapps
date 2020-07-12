<?php	  
	// EXAMPLE:	IMPORT_TABLES("localhost","user","pass","db_name", "my_baseeee.sql"); //TABLES WILL BE OVERWRITTEN
				// P.S. IMPORTANT NOTE for people who try to change/replace some strings  in SQL FILE before importing, MUST READ:  https://goo.gl/2fZDQL
// https://github.com/tazotodua/useful-php-scripts 
function IMPORT_TABLES($host,$user,$pass,$dbname, $sql_file_OR_content){
	set_time_limit(3000);
	$SQL_CONTENT = (strlen($sql_file_OR_content) > 300 ?  $sql_file_OR_content : file_get_contents($sql_file_OR_content)  );  
	$allLines = explode("\n",$SQL_CONTENT); 
	$mysqli = new mysqli($host, $user, $pass, $dbname); if (mysqli_connect_errno()){echo "Failed to connect to MySQL: " . mysqli_connect_error();} 
		$zzzzzz = $mysqli->query('SET foreign_key_checks = 0');	        preg_match_all("/\nCREATE TABLE(.*?)\`(.*?)\`/si", "\n". $SQL_CONTENT, $target_tables); foreach ($target_tables[2] as $table){$mysqli->query('DROP TABLE IF EXISTS '.$table);}         $zzzzzz = $mysqli->query('SET foreign_key_checks = 1');    $mysqli->query("SET NAMES 'utf8'");	
	$templine = '';	// Temporary variable, used to store current query
	foreach ($allLines as $line)	{											// Loop through each line
		if (substr($line, 0, 2) != '--' && $line != '') {$templine .= $line; 	// (if it is not a comment..) Add this line to the current segment
			if (substr(trim($line), -1, 1) == ';') {		// If it has a semicolon at the end, it's the end of the query
				if(!$mysqli->query($templine)){ print('Error performing query \'<strong>' . $templine . '\': ' . $mysqli->error . '<br /><br />');  }  $templine = ''; // set variable to empty, to start picking up the lines after ";"
			}
		}
	}	return 'Importing finished. Now, Delete the import file.';
}   //see also export.php 
?>

<?php
	session_start();
    include '../db_connect_conf.php';
	
	
	$target_dir = "backup_files/";
	$target_file = $target_dir . basename($_FILES["file"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$uploadOk = 1;
	}
	
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.</br></br>..</br>";
			if (file_exists($target_file)) {
				echo '</br>Restoring database..</br></br>..</br>';
				IMPORT_TABLES($dbhost,$dbuser,$dbpassword,$dbdatabase, $target_file);
				echo '</br>Database restored';
			}
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
	/* if(isset($_FILES['file'])){
		$backup_file = ob_get_contents(); //$_FILES['file'];
		//echo $_FILES['backupfile']['name'];
		print_r($backup_file);
		//file_get_contents($backup_file);
		//print_r($_FILES['backupfile']['name']);
		//IMPORT_TABLES($dbhost,$dbuser,$dbpassword,$dbdatabase, $backup_file);
	}
	else
		echo $_FILES['file']['error']; */
?>