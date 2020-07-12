<?php
	session_start();
    include '../db_connect_conf.php';
	print_r(backup_Database($dbhost,$dbuser,$dbpassword,$dbdatabase));
	/* if(backup_Database($dbhost,$dbuser,$dbpassword,$dbdatabase) == false)
		echo 'Something went wrong. Try again later';
	else
		echo 'Backup completed and downloaded succesfully'; */
?>

<?php
// EXAMPLE:   EXPORT_TABLES("localhost","user","pass","db_name" );
		//optional: 5th parameter - to backup specific tables only: array("mytable1","mytable2",...)
		//optional: 6th parameter - backup filename
		// IMPORTANT NOTE for people who try to change strings in SQL FILE before importing, MUST READ:  goo.gl/2fZDQL

// https://github.com/tazotodua/useful-php-scripts
function EXPORT_TABLES($host,$user,$pass,$name,       $tables=false, $backup_name=false){
	set_time_limit(3000); $mysqli = new mysqli($host,$user,$pass,$name); $mysqli->select_db($name); $mysqli->query("SET NAMES 'utf8'");
	$queryTables = $mysqli->query('SHOW TABLES'); while($row = $queryTables->fetch_row()) { $target_tables[] = $row[0]; }	if($tables !== false) { $target_tables = array_intersect( $target_tables, $tables); }
	$content = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\nSET time_zone = \"+00:00\";\r\n\r\n\r\n!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT;\r\n!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS;\r\n!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION;\r\n!40101 SET NAMES utf8;\r\n--\r\n-- Database: `".$name."`\r\n--\r\n\r\n\r\n";
	foreach($target_tables as $table){
		if (empty($table)){ continue; }
		$result	= $mysqli->query('SELECT * FROM `'.$table.'`');  	$fields_amount=$result->field_count;  $rows_num=$mysqli->affected_rows; 	$res = $mysqli->query('SHOW CREATE TABLE '.$table);	$TableMLine=$res->fetch_row();
		$content .= "\n\n".$TableMLine[1].";\n\n";   $TableMLine[1]=str_ireplace('CREATE TABLE `','CREATE TABLE IF NOT EXISTS `',$TableMLine[1]);
		for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0) {
			while($row = $result->fetch_row())	{ //when started (and every after 100 command cycle):
				if ($st_counter%100 == 0 || $st_counter == 0 )	{$content .= "\nINSERT INTO ".$table." VALUES";}
					$content .= "\n(";    for($j=0; $j<$fields_amount; $j++){ $row[$j] = str_replace("\n","\\n", addslashes($row[$j]) ); if (isset($row[$j])){$content .= '"'.$row[$j].'"' ;}  else{$content .= '""';}	   if ($j<($fields_amount-1)){$content.= ',';}   }        $content .=")";
				//every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
				if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num) {$content .= ";";} else {$content .= ",";}	$st_counter=$st_counter+1;
			}
		} $content .="\n\n\n";
	}
	$content .= "\r\n\r\n!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT;\r\n!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS;\r\n!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION;";
	$backup_name = $backup_name ? $backup_name : 'backup_('.date('dmYHis').').sql';
	ob_get_clean(); header('Content-Type: application/octet-stream');  header("Content-Transfer-Encoding: Binary");  header('Content-Length: '. (function_exists('mb_strlen') ? mb_strlen($content, '8bit'): strlen($content)) );    header("Content-disposition: attachment; filename=\"".$backup_name."\"");
	echo $content; exit;
}      //see import.php too
?>

<?php
function backup_Database($hostName,$userName,$password,$DbName,$tables = '*')
{

  // CONNECT TO THE DATABASE
  $con = mysqli_connect($hostName,$userName,$password) or die(mysqli_error());
  mysqli_select_db($con,$DbName) or die(mysqli_error());

  mysqli_query($con, "SET NAMES 'utf8'");



  // GET ALL TABLES
  if($tables == '*')
  {
    $tables = array();
    $result = mysqli_query($con, 'SHOW TABLES');
    while($row = mysqli_fetch_row($result))
    {
      $tables[] = $row[0];
    }
  }
  else
  {
    $tables = is_array($tables) ? $tables : explode(',',$tables);
  }

  $return = 'SET FOREIGN_KEY_CHECKS=0;' . "\r\n";
  $return.= 'SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";' . "\r\n";
  $return.= 'SET AUTOCOMMIT=0;' . "\r\n";
  $return.= 'START TRANSACTION;' . "\r\n";
  $data = $return."SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\nSET time_zone = \"+00:00\";\r\n\r\n\r\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\r\n/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\r\n/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\r\n/*!40101 SET NAMES utf8mb4 */;\r\n--\r\n-- Database: `".$DbName."`\r\n--\r\n\r\n\r\n";
  echo $data;

  foreach($tables as $table)
  {
    $result = mysqli_query($con, 'SELECT * FROM '.$table) or die(mysqli_error());
    $num_fields = mysqli_num_fields($result) or die(mysqli_error());

    $data.= 'DROP TABLE IF EXISTS '.$table.';';
    $row2 = mysqli_fetch_row(mysqli_query($con, 'SHOW CREATE TABLE '.$table));
    $data.= "\n\n".$row2[1].";\n\n";

    for ($i = 0; $i<$num_fields; $i++)
    {
      while($row = mysqli_fetch_row($result))
      {
        $data.= 'INSERT INTO '.$table.' VALUES(';
        for($x=0; $x<$num_fields; $x++)
        {
          $row[$x] = addslashes($row[$x]);
		  $row[$x] = clean($con, $row[$x]); // CLEAN QUERIES
          if (isset($row[$x])) {
			$data.= '"'.$row[$x].'"' ; //
		  } else {
		  	$data.= '""';
		  }

          if ($x<($num_fields-1)) {
		  	$data.= ',';
		  }
        }  // end of the for loop 2
        $data.= ");\n";
      } // end of the while loop
    } // end of the for loop 1

    $data.="\n\n\n";
  }  // end of the foreach*/

    $data .= 'SET FOREIGN_KEY_CHECKS=1;' . "\r\n";
	$data.= 'COMMIT;';

  //SAVE THE BACKUP AS SQL FILE
  $handle = fopen('backup_('.date('dmYHis').').sql','w+');
  $backup_name = 'backup_('.date('dmYHis').').sql';
  ob_get_clean(); header('Content-Type: application/octet-stream');  header("Content-Transfer-Encoding: Binary");  header('Content-Length: '. (function_exists('mb_strlen') ? mb_strlen($data, '8bit'): strlen($data)) ); header("Content-disposition: attachment; filename=\"".$backup_name."\"");
  fwrite($handle,$data);
  fclose($handle);

   if($data)
   		return $data;
   else
		return false;
 }  // end of the function


//  CLEAN THE QUERIES
function clean($con, $str) {
	if(@isset($str)){
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysqli_real_escape_string($con, $str);
	}
	else{
		return 'NULL';
	}
}
//reservations table Noshow column has to be changed into Varchar(1) with NONE default value and NULL checked
?>
