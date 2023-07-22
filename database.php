<?php 
  $conn = "";

  try{
  $conn = mysqli_connect("localhost:3307","root","","kanji")  ;
  }
  catch(mysqli_sql_exception){
    echo "Problem connecting to DB";
  }

      if($conn){
       // echo "Connected";
      }
   
    ?>
