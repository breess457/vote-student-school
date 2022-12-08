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
  <link rel="stylesheet" href="../assets/scss/web/user.profile.css">
  <title>Student Page</title>
</head>
<body>
<script type="text/javascript">
  const MySweetAlert =(Icons,Titles,Texts,Locations)=>{
      Swal.fire({
          icon: Icons,
          title: Titles,
          text:Texts,
          confirmButtonText:"OK"
      }).then((result)=>{
           window.location = Locations
      })
  }
  /* Set Date Time */
  const showTime = () => {
    let date = new Date();
    document.getElementById("Sclock").innerHTML = date.toLocaleTimeString();
  };
  setInterval(showTime, 1000);// End Set
</script>
<?php

  if(!isset($_SESSION['user_students'])){
        echo "<script type=\"text/javascript\">MySweetAlert('error','ไม่พบ ผู้ใช้งาน','กรุณา login','../index.php')</script>";
  }else{
    $sessionUser = $_SESSION['user_students']['fullname'];
    $sessionImage = $_SESSION['user_students']['profile_img'];
    $sessionId = $_SESSION['user_students']['user_id'];

    Navbar($sessionUser,$sessionImage,$sessionId,$conn);
      $GetProfileStudent = mysqli_query($conn,"SELECT * FROM user_students WHERE user_id='$sessionId'")or die(mysqli_error());
        foreach($GetProfileStudent as $Numbar => $value){
            PortProfile($value['profile_img'],$value['fullname'],$value['student_code'],$value['department'],$value['passwd'],$value['year_of_study'],$value['sex'],$value['age']);
        } 
  }
?>

<script src="../assets/js/web/user.create.event.js"></script>
</body>
</html>