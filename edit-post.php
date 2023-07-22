<?php
    session_start();
    include("database.php");
include('./html/header.html');
$id  = $_GET['id'];

$getuser = $conn->prepare("SELECT `username`,`kanji_char`,`kanji_desc`,`post-created-on` FROM posts WHERE post_id =     ?");
$getuser->bind_param('s', $id);
$getuser->execute();
$userdata = $getuser->get_result();
$row = $userdata->fetch_array(MYSQLI_ASSOC);


    ?>
    

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Text Prompt and Text Area Example</title>
    <style>
     body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #e2e2e2;
}

header {
    background-color: #e2e2e2;
    color: #fff;
    padding: 20px;
}

header h1 {
    margin: 0;
}

nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

nav li {
    display: inline-block;
    margin-right: 20px;
}

nav a {
    color: #fff;
    text-decoration: none;
}

main {
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
}

.post-form {
    background-color: #303030;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;
}

.post-form h2 {
    color: #ffffff;
}

.post-form form {
    display: flex;
    flex-direction: column;
}

.post-form label {
    font-weight: bold;
    margin-top: 10px;
}

.post-form input,
.post-form textarea {
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.post-form input[type="submit"] {
    background-color: #0066cc;
    color: #fff;
    border: none;
    cursor: pointer;
    font-size: 16px;
    padding: 10px;
    border-radius: 5px;
}

.post-form input[type="submit"]:hover {
    background-color: #0052a3;
}

/* Responsive styles */
@media (max-width: 600px) {
    header h1 {
        font-size: 24px;
    }
}

    </style>
</head>
<body>
    <main>
        <div class="post-form">
            <h2>Edit Post</h2>
            <form action=<?php echo "edit-post.php?id=$id";?> method="post">
                <label for="post_title" style="color: #ccc;" >Kanji:</label>
                <input type="text" id="post_title" name="post_title" required placeholder="Enter the Kanji here" value=<?php echo "{$row["kanji_char"]}";?>>
                
                <label for="post_content" style="color: #ccc;">Post Content:</label>
                <textarea id="post_content" name="post_content" rows="8" required  placeholder="Describe the Kanji here"><?php echo "{$row["kanji_desc"]}";?>
                </textarea>
                
                <input type="submit" value="Submit Post" name="edit">
                <?php

//include("post.html");
    $kanji = null;
    $desc = null;
    $username = null;
    $flag = false;
    if(isset($_POST["edit"])){
        $kanji = filter_input(INPUT_POST,"post_title");
        $desc = filter_input(INPUT_POST,"post_content",FILTER_SANITIZE_SPECIAL_CHARS);
        $username = $_SESSION["username"];
        $flag == true;
        $q = "UPDATE `posts` SET `kanji_char` = '$kanji', `kanji_desc` = '$desc' WHERE post_id = '$id'";
        $res = $conn->query($q);
        if($res != true){
           echo mysqli_error($conn);
       }else{ echo '<script type="text/javascript">
        window.location = "profile.php"
    </script>';}
   
    }
   

   
   if($flag == true){
       
       $flag = true;
   } 
   



?>
            </form>
        </div>
    </main>
    
    
</body>
</html>


<?php
   
?>