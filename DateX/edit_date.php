<?php
    include 'db_connect_conf.php';

    print_r($_POST);

        // Array(
        //     [id] => 4
        //     [ex_date] => 2020-04-02
        //     [item] => malakia no3 opkisoinosd ndoidi sd os dnoishdh  siojd
        //     [amt] => 1 **
        //     [deli_date] => 2019-10-01
        //     [doc_id] => 11 **
        // )
        // ** must be validated
        
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $ex_date = mysqli_real_escape_string($conn, $_POST['ex_date']);
    $item = mysqli_real_escape_string($conn, $_POST['item']);
    $amt = mysqli_real_escape_string($conn, $_POST['amt']);
    $deli_date = mysqli_real_escape_string($conn, $_POST['deli_date']);
    $doc_id = mysqli_real_escape_string($conn, $_POST['doc_id']);
        
    // VALIDATE INPUT
    
    if($amt !== ''){
        if (!is_numeric($amt)){
            $amt = 'NULL';
        }
    }

    if ($doc_id !== '') {
        if (!is_numeric($doc_id)) {
            $doc_id = 'NULL';
        }
    }

    $arr = array($id, $ex_date, $item, $amt, $deli_date, $doc_id);
    print_r($arr);

    $query = "UPDATE expdates SET expDate='$ex_date', itemName='$item', itemPopulation=$amt, deliDate='$deli_date', docID=$doc_id WHERE entryID=$id";
    echo $query;
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    mysqli_close($conn);

?>
