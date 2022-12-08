<?php
 session_start();
 include('../config/connect.php');
 include('../public/link.php');
 include('../public/UserFunction.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/scss/web/userFunction.css">
  <title>Student Page</title>
</head>
<body>
<?php

  if(!isset($_SESSION['user_students'])){
    echo "
            <script>
                alert('pless your login');
                window.location = '../index.php';
            </script>
        ";
  }else{
    $sessionUser = $_SESSION['user_students']['fullname'];
    $sessionImage = $_SESSION['user_students']['profile_img'];
    $sessionId = $_SESSION['user_students']['user_id'];

    Navbar($sessionUser,$sessionImage,$sessionId,$conn);
      echo "
        <div class=\"alert d-alert alert-primary container\" role=\"alert\">
          รายการโหวต online ของวิทยาลัยการอาชีพปัตตานี
        </div>
        ";
    $getSql = "SELECT * FROM vote_all V LEFT JOIN admin_school T ON V.id_admin_the_creater_vote = T.id";
     $Queryvote = mysqli_query($conn,$getSql)or die(mysqli_error());
      echo "<div class='row d-row col-md-12'>";
        foreach($Queryvote as $res => $response){
          echo CardVote(($res+1),$response['subtitle'],$response['detail'],$response['open_date'],$response['close_date'],$response['open_time'],$response['close_time'],$response['image'],$response['class_key'],$response['fullname_admin'],$response['profile_img'],$response['vote_id']);
        }
       
      echo "</div>";
  }
?>
<script src="../assets/js/web/user.create.event.js"></script>
</body> 
</html>