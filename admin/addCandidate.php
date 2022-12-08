<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="../assets/scss/admin/adminDashbord.page.scss">
    <link rel="stylesheet" href="../assets/scss/admin/admin.addCandidate.css">
    <title>ADD CanDyDate</title>
</head>
<body>
<script type='text/javascript'>

 const mySweetCheckCookie=(showTXT,showCLS,showLCT,showIC)=>{
     Swal.fire({
        icon:showIC,
        title:showCLS,
        text:showTXT,
        confirmButtonText:"OK"
    }).then((result)=>{
       if (result.value) {
         window.location =`${showLCT}`
       }
    })
  }
</script>
<?php
session_start();
 include('../config/connect.php');
 include('../public/link.php');
 include('../public/AdminFunction.php');
  date_default_timezone_set("Asia/Bangkok");
   $Day = date("Y-m-d");
    $Time = date("H:i:s");

  if(!isset($_GET['getID']) && !isset($_GET['keys'])){

      echo "<script> mySweetCheckCookie('ไม่อนุญาตเข้าแบบผิดกฏหมาย','ไม่พบclass','getEvent.php','question'); </script>";
  }else if(!isset($_SESSION['admin_school'])){

     echo "<script> mySweetCheckCookie('กรุณา Login อีกครั้ง','ไม่พบ ผู้ใช้งาน','../index.php','warning'); </script>";
  }else{
      $getID = $_GET['getID'];
      //$getKey = $_GET['keys'];
      $fullName = $_SESSION['admin_school']['fullname_admin'];
      $image = $_SESSION['admin_school']['profile_img'];
      $status = $_SESSION['admin_school']['position'];
      $sessionIdAdmin = $_SESSION['admin_school']['id'];
      echo Navigation($fullName, $image, $status);
?>
      <div class="main-content">
            <!-- Top navbar -->
            <nav class="navbar navbar-tp navbar-expand-md navbar-dark bg-primary" id="navbar-main">
                <div class="container-fluid">
                    <!-- Brand -->
                    <a class="h3 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="getEvent.php">
                      / <i class="far fa-calendar-check"></i> Event / <i class="fas fa-users-cog"></i> candydate
                    </a>
                    <a href="logout.php" class="btn btn-success"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </nav>
            <div class="container">
                 
        <?php
          $showSql = mysqli_query($conn,"SELECT * FROM vote_all WHERE vote_id='$getID'")or die(mysqli_error());
            foreach($showSql as $key){
              getCardTitle($key['vote_id'],$key['subtitle'],$key['detail'],$key['open_date'],$key['close_date'],$key['open_time'],$key['close_time'],$key['image'],$key['class_key'],$key['id_admin_the_creater_vote'],$sessionIdAdmin,$status);
            }
            
          $showCandydate = mysqli_query($conn,"SELECT * FROM candidate WHERE id_type_vote='$getID'")or die(mysqli_error());
              echo "<div class=\"d-flex mt-4 col-md-12\">";  
                  foreach($showCandydate as $res => $result){
                      GetCandydate(($res+1),$result['profile_img'],$result['fullname'],$result['title'],$result['subContent'],$result['department'],$result['number'],$result['id_type_vote'],$result['candi_id']);
                  }
              echo "</div>";
        ?>
            </div>
            <main-add-candydate></main-add-candydate>
            <main-update-eventvote></main-update-eventvote>
            <modal-setupdate-candidate></modal-setupdate-candidate>
      </div> 
<?php
  }
?> 
    <script src="../assets/js/admin/get.candidate.js"></script>
    <script src="../assets/js/admin/get.event.js"></script>
</body>
</html>
 
