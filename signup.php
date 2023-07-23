



<?php
include("database.php");
include("./html/signup.html");

    $username = null;
    $email = null;
    $pass = null;
    
    if(isset($_POST["submit"])){
        $username = $_POST["username"];
        $email = $_POST["email"];
        $pass = $_POST["password"]; 
        
        
        $flag = false;
        echo $flag; 

     //$username = filter_input(INPUT_POST,"usermame",FILTER_SANITIZE_SPECIAL_CHARS);
    // $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL);
    // $pass = filter_input(INPUT_POST,"usermame",FILTER_SANITIZE_SPECIAL_CHARS);

    
    $pass = password_hash($pass,PASSWORD_DEFAULT);


    $que = "INSERT INTO `users` (`username`,`email`,`pass`) VALUES ('$username','$email','$pass')";

    
       
        
    
    if(!mysqli_query($conn,$que)){
        echo "User already exists";
    }else{
        mysqli_query($conn,$que);
        $flag = true;
    }   
    echo $flag;

    if($flag == true){
        echo '<script type="text/javascript">
        window.location = "./login.php"
    </script>';

    }
    mysqli_close($conn);
        
    }

   
?>