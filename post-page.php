


<?php 
session_start();
    include("database.php");
    include("./html/header.html");
?>
<?php
    $id = $_GET["id"];
    $q = " ";

    $result = $conn->query($q);      
    // Display threads
    $getuser = $conn->prepare("SELECT `username`,`kanji_char`,`kanji_desc`,`post-created-on` FROM posts WHERE post_id =     ?");
    $getuser->bind_param('s', $id);
    $getuser->execute();
    $userdata = $getuser->get_result();
    $row = $userdata->fetch_array(MYSQLI_ASSOC);

    
    

   //for comenting
   $post_id = null ;
   $username = null ;
   $post_content = null ;
   
   if(@isset($_POST["submit"])&& $_GET["action"]=="comment"){
      $post_id = $_GET["id"];
      $username = $_SESSION["username"];
      $post_content = $_POST["comment"];
      
   }
   
   $cq = "INSERT INTO comments(`username`,`post_id`,`comment_content`) VALUES('$username','$post_id','$post_content')";
   $res = $conn->query($cq);
   if($res != true){
      //echo mysqli_errno($conn);
  }else{
      header("location: post-page.php?id={$post_id}");
      $flag = true;
  } 
  

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>

body {
    font-family: 'Times New Roman', Times, serif, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
}

header {
    background-color: #333;
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
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
}

.blog-post {
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;
}

.post-title {
    color: #333;
    text-align: center;
    font-size: 26px;
}

.post-meta {
    color: #888;
    font-size: 14px;
}

.post-image {
    width: 100%;
    max-height: 400px;
    object-fit: cover;
    margin-bottom: 20px;
}

.post-content {
    line-height: 1.6;
    font-size: 22px;;
}

.comment-content{
    line-height: 1.2;
    font-size: 14px;
}

footer {
    text-align: center;
    padding: 10px;
    background-color: #333;
    color: #fff;
}

textarea {
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

textarea {
    resize: vertical;
}

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
}

.comment-section {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
}

h2 {
    text-align: center;
}

.comment {
    border-bottom: 1px solid #ccc;
    margin-bottom: 10px;
    padding-bottom: 10px;
}

.comment-user {
    display: flex;
    align-items: center;
}

.comment-user img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
}


.comment-text {
    margin-top: 5px;
}

.comment-form input[type="text"],
.comment-form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.comment-form button {
    background-color: #0066cc;
    color: #fff;
    border: none;
    cursor: pointer;
    padding: 10px 20px;
    border-radius: 5px;
}

.comment-form button:hover {
    background-color: #0052a3;
}

/* Responsive styles */
@media (max-width: 600px) {
    .comment-section {
        padding: 10px;
    }
}

/* Responsive styles */
@media (max-width: 600px) {
    header h1 {
        font-size: 24px;
    }
}

    </style>
    <main>
        <article class="blog-post">
            <h2 class="post-title"><?php echo "{$row["kanji_char"]}" ?></h2>
            <p class="post-meta" style="text-align: center;"><?php 
            echo"Posted by <span><b>{$row["username"]}</b></span> on {$row["post-created-on"]}"
            ?>
            </p>
            <p class="post-content" style="white-space: pre-line">
                <?php echo "{$row["kanji_desc"]}"?>
            </p>
          
            <hr>
            <br>
            <br>

           
                

            <h2 class="" style="text-align: left;">Comments</h2>
            <article class="blog-post">
                <div class="comment-section">
 
                    <form action=<?php echo "post-page.php?id={$id}&action=comment"?> method="post">
                                <div class="comment-form">
                       
                                    <textarea name="comment" placeholder="Write your comment..." required ></textarea>
                                    <button type="submit" name="submit" >Post Comment</button>
                                </div>
                            </form>
                    </div>
       
<?php 

    $q = "SELECT `username`,`comment_content`,`comment-posted-on` from comments WHERE post_id = '$id'";
    $result = $conn->query($q);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<article class=\"blog-post\">";
            echo "  <h3>{$row["username"]}</h3>";
            echo "  <p class=\"post-meta\">Posted on {$row["comment-posted-on"]}</p>";
            echo "  <p class=\"comment-content\"> {$row["comment_content"]} </p>";
            echo " </article>";
        }
    }
   
?>
            </article>

        </article>
      
        
    </main>

</body>
</html>

<?php

include("./html/footer.html");
?>



