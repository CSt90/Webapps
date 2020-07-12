<?php 
    session_start();
    include '../db_connect_conf.php';
    
    if (isset($_POST['oldpass'])){
        $oldpass = mysqli_real_escape_string($conn, $_POST['oldpass']);
        $lose = "hispalms aresweaty";
        $yourself = "kneesweak armsareheavy";
        $md5oldpass = md5($lose.$oldpass.$yourself);        
        $stored_pw = mysqli_fetch_assoc(mysqli_query($conn, "SELECT uPass FROM users WHERE uid=1"));
        if($stored_pw['uPass'] == $md5oldpass){
            if (isset($_POST['newpass'])){
                $newpass = mysqli_real_escape_string($conn, $_POST['newpass']);
                $md5newpass = md5($lose.$newpass.$yourself);        
                mysqli_query($conn, "UPDATE users SET uPass='$md5newpass' WHERE uid=1") or die('Something went wrong. Try again');
                echo "Password changed.";
            }
            else
                echo "Something went wrong. Try again";
        }
        else
            echo 'Password incorrect. Try again';
    }
    else
        echo "Something went wrong. Try again";    
    
?>