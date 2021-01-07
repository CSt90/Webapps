<?php 
    include 'db_connect_conf.php';

    // print_r($_POST);
    $exDates = array();
    $items = array();
    $volumes = array();
    $dDates = array();
    $dmy = array();

    // ASSIGN FORM SUBMITTED VALUES INTO ARRAYS
	$exDates = $_POST['exdate'];

	//REGARDING items, ITEM NAME STRING MUST BE ESCAPED
	foreach($_POST['item'] as $item_input){
		if(isset($item_input)){
			echo $item_input."</br>";
			array_push($items, mysqli_real_escape_string($conn, $item_input));
		}
	}

    //$items = $_POST['item'];
    $volumes = $_POST['volume'];
    $dDate = date('Y-m-d', strtotime($_POST['del_date'])); //dates must be of type Y-m-d
	$docid = trim($_POST['docid']);

    if (isset($_POST['pt']))
        $pt = $_POST['pt'];
    
    $dead = 0;
    $today = date('Y-m-d');

    for ($i=0; $i<50; $i++){
        //REMOVE THE EMPTY LINES OF THE TABLE
        if (trim($exDates[$i]) === "" && trim($items[$i]) === "" && trim($volumes[$i]) === ""){
            unset($exDates[$i]);
            unset($items[$i]);
            unset($volumes[$i]);
        }
        //REFORMAT DATES INTO MySQL FORMAT YYYY-MM-DD
        else{
            // $dmy = explode('/', $exDates[$i]);
            // SPLIT DATE INPUT BY - OR / CHARACTER
            $dmy = preg_split("/(-|\/)/", $exDates[$i], -1, PREG_SPLIT_NO_EMPTY);
            // IF INPUT LOOKS LIKE D/M/Y
            if (sizeof($dmy) == 3){
                print_r($dmy);
                $year = $dmy[2]+2000;
                $month = $dmy[1];
                if (strlen($month) === 1){
                    $month ='0'.$month;
                }
                $day = $dmy[0];
                if (strlen($day) === 1){
                    $day = '0'.$day;
                }
                $exDates[$i] = $year . '-' . $month . '-' . $day;
                echo ($exDates[$i].'</br>');
            }
            //  IF INPUT LOOKS LIKE M/Y
            elseif(sizeof($dmy) == 2){
                print_r($dmy);
                $year = $dmy[1] + 2000;
                $month = $dmy[0];
                $day = date('t', strtotime("$month/1/$year"));
                if (strlen($month) === 1) {
                    $month = '0' . $month;
                }
                $exDates[$i] = $year . '-' . $month . '-' . $day;
                echo ($exDates[$i] . '</br>');
            }
        }
    }

    // RESET ARRAY KEYS
    $exDates = array_values($exDates);
    $items = array_values($items);
    $volumes = array_values($volumes);

    $inserts = sizeof($exDates);

    // BUILD UP THE INSERT QUERIES BASED ON THE SUBMITTED VALUES
    for($i=0; $i<$inserts; $i++){
        $query = "INSERT INTO `expdates` (";
        $values = " VALUES(";
        if (trim($exDates[$i]) !== ""){
            $query .= "`expDate`,";
            $values .= "'$exDates[$i]',";
        }
        else {
            if ($exDates[$i] < $today) {
                $dead = 1;
                $query .= "`dead`,";
                $values .= "$dead,";
            }
        }
        if (trim($items[$i]) !== ""){
            $query .= "`itemName`,";
            $values .= "'$items[$i]',";
        }
        if (trim($volumes[$i]) !== "" && is_numeric($volumes[$i])){
            $query .= "`itemPopulation`,";
            $values .= "$volumes[$i],";
        }
        if (trim($dDate) !== ""){
            $query .= "`deliDate`,";
            $values .= "'$dDate',";
        }
        $values .= "$pt, $docid)";
        $query .= "`supplier`, `docID`) $values";
        // echo $query;
        mysqli_query($conn, $query) or die(mysqli_error($conn));
    }
    header('Location: home.php');
?>