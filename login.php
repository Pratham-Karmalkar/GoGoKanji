<?php
include("database.php");
include("./html/login.html");

$username = null;
$pass = null;
$flag = false;

if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $pass = $_POST["password"];    
    $flag = true;
}

       
    
    if($flag == true){
        $getuser = $conn->prepare('SELECT `pass` FROM `users` WHERE `username` = ?');
        $getuser->bind_param('s', $username);
        $getuser->execute();
        $userdata = $getuser->get_result();
        $row = $userdata->fetch_array(MYSQLI_ASSOC);
    
    
        error_reporting(E_ERROR | E_PARSE);
        if(password_verify($pass,$row["pass"])){
            
        $getuserID = $conn->prepare('SELECT `id`,`username` FROM `users` WHERE `username` = ?');
        $getuserID->bind_param('s', $username);
        $getuserID->execute();
        $userdatawithID = $getuserID->get_result();
        $row = $userdatawithID->fetch_array(MYSQLI_ASSOC);
            
            session_start();
            $_SESSION["user_id"] = $row["id"];        
            $_SESSION["username"] = $row["username"];  
            header("Location: index.php")      ;
        }
        else{
            echo "invalid pass";
        }
    }




?>