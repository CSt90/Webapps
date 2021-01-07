<?php
    include 'db_connect_conf.php';

    $id = $_POST['id'];

    // mysqli_query($conn, "DELETE FROM expdates WHERE entryID=$id");

    echo "$id deleted";

    mysqli_close($conn);
?>