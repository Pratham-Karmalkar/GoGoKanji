<?php
    session_start();
    ?>
    

<?php
include("database.php");
include('./html/header.html');
include("./html/post.html");
    $kanji = null;
    $desc = null;
    $username = null;
    $flag = false;
    if(isset($_POST["submit"])){
        $kanji = $_POST["post_title"];
        $desc = $_POST["post_content"];
        $username = $_SESSION["username"];
        $flag == true;
    }
   

    $q = "INSERT INTO posts(username,kanji_char,kanji_desc) VALUES('$username','$kanji','$desc')";
    $res = $conn->query($q);
    if($res != true){
       //echo mysqli_errno($conn);
   }else{
    echo '<script type="text/javascript">
    window.location = "index.php"
</script>';
       $flag = true;
   } 
   


?>