<?php 
    
        session_start();
        include("database.php");
        if(@$_SESSION["username"]){
           include("./html/header.html");
            if(@$_GET["action"] == "logout"){
                session_destroy();
                header("Location: login.php");

            }

           include("./html/dash.html");


            //comment count
    


        $q = 'SELECT `post_id`,`username`,`kanji_char`,`kanji_desc`,`post-created-on`  FROM `posts` ';
      
        $result = $conn->query($q);
        
            
            // Display threads
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $count = "SELECT COUNT(`username`) as `usercount` from comments WHERE post_id = '{$row["post_id"]}'";
                $res = $conn->query($count);    
                $num = $res->fetch_assoc();

                echo " <div id=\"forum\"> ";
                echo "<div class=\"thread\">";
                echo "<div class=\"fr-post group\">";
                  echo "<div class=\"profile\">";
                   echo " <span style=\"text-align: center;\">By, {$row["username"]}</span>";
                   echo " <a href=\"post-page.php?id={$row["post_id"]}\" name=\"viewpost\"> <h1 style=\"color: black; text-align: center; margin-top: 20%;\">{$row["kanji_char"]}</h1></a>";
                 echo " </div>";
                 echo " <div class=\"post\">";
                   echo " <p> {$row["kanji_desc"]}</p>";
                 echo " </div>";
                 echo " <div class=\"opt-bar\">";
                  echo "  <hr>";
                  echo "  <span class=\"time\">{$row["post-created-on"]}";
                   
                   echo " <span class=\"time\" style=\"float: right;\">{$num["usercount"]} comments</span>";
                 echo " </div>";
                echo "</div> ";
            echo "</div> ";
            echo "</div>";

            }
        }
            
       
           include("./html/footer.html");
        }
        else{
            echo "User login not detected";
        }
    ?>
