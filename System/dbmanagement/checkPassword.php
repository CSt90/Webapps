<?php 
    session_start();
    include '../db_connect_conf.php';
    
    if (isset($_POST['upass'])){
        $pass = mysqli_real_escape_string($conn, $_POST['upass']);
        $lose = "hispalms aresweaty";
        $yourself = "kneesweak armsareheavy";
        $md5pass = md5($lose.$pass.$yourself); 
        $stored_pws = mysqli_query($conn, "SELECT * FROM users");
        if(@mysqli_num_rows($stored_pws)>0){
            while($row = mysqli_fetch_assoc($stored_pws)){
                if($row['uPass'] == $md5pass)
                    echo 'Password match';
            }
        }
    }
    else
        echo "Something went wrong. Try again";
?>