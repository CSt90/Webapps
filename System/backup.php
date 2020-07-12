<?php
	session_start();
	include 'db_connect_conf.php';
    
//    $backupFile = $dbdatabase.'_'.date("Y-m-d-H-i-s").'.sql';
//    $command = "mysqldump -u$dbuser -p$dbpassword -h$dbhost $dbdatabase > 'C:\Users\user-PC\Desktop\'.$backupFile";
//    system($command, $result);
//    echo $result;
//    mysqli_close($conn);

//   $dbhost = 'localhost';
//   $dbuser = 'root';
//   $dbpass = '';
//   
//   $conn = mysql_connect($dbhost, $dbuser, $dbpass);
//   
//   if(! $conn ) {
//      die('Could not connect: ' . mysql_error());
//   }
    $tables = mysqli_query($conn, "SHOW TABLES");
    while($row = mysqli_fetch_array($tables)){
       $table_name = $row['Tables_in_systemdb'];
        echo $table_name;
       $backup_file  = "backup/".$table_name."_".date('d_m_Y_h_i_s').".sql";
       $sql = "SELECT * INTO OUTFILE '$backup_file' FROM $table_name";

       mysqli_select_db($conn, 'Systemdb');
       $retval = mysqli_query($conn,$sql);

       if(! $retval ) {
          die('Could not take data backup: ' . mysql_error());
       }

       echo "Backedup  data successfully\n";
    }
   
   mysql_close($conn);


//    backup_tables('localhost','root','','Systemdb');
//
///* backup the db OR just a table */
//function backup_tables($host,$user,$pass,$name,$tables = '*')
//{
//	
//	$link = mysql_connect($host,$user,$pass);
//	mysql_select_db($name,$link);
//	
//	//get all of the tables
//	if($tables == '*')
//	{
//		$tables = array();
//		$result = mysql_query('SHOW TABLES');
//		while($row = mysql_fetch_row($result))
//		{
//			$tables[] = $row[0];
//		}
//	}
//	else
//	{
//		$tables = is_array($tables) ? $tables : explode(',',$tables);
//	}
//	
//	//cycle through
//    $return = ''; //added by me
//	foreach($tables as $table)
//	{
//		$result = mysql_query('SELECT * FROM '.$table);
//		$num_fields = mysql_num_fields($result);
//		
//		$return.= 'DROP TABLE '.$table.';';
//		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
//		$return.= "\n\n".$row2[1].";\n\n";
//		
//		for ($i = 0; $i < $num_fields; $i++) 
//		{
//			while($row = mysql_fetch_row($result))
//			{
//				$return.= 'INSERT INTO '.$table.' VALUES(';
//				for($j=0; $j < $num_fields; $j++) 
//				{
//					$row[$j] = addslashes($row[$j]);
//					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
//					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
//					if ($j < ($num_fields-1)) { $return.= ','; }
//				}
//				$return.= ");\n";
//			}
//		}
//		$return.="\n\n\n";
//	}
//	
//	//save file
//	$handle = fopen('db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
//	fwrite($handle,$return);
//	fclose($handle);
//}
?>