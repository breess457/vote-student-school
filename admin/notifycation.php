<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="../assets/scss/admin/adminDashbord.page.scss">
    <link rel="stylesheet" href="../assets/scss/admin/admin.notifycation.css">
    <title>notifycation</title>
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
  if(!isset($_GET['result_voteId'])){
      echo "<script> mySweetCheckCookie('ไม่อนุญาตเข้าแบบผิดกฏหมาย','ไม่พบclass','index.php','question'); </script>";
  }else if(!isset($_SESSION['admin_school'])){
      echo "<script> mySweetCheckCookie('กรุณา Login อีกครั้ง','ไม่พบ ผู้ใช้งาน','../index.php','warning'); </script>";
  }else{
      $getID_vote = $_GET['result_voteId'];
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
                      / <i class="far fa-calendar-check"></i> index / <i class="fas fa-users-cog"></i> ผลโหวต
                    </a>
                    <a href="logout.php" class="btn btn-success"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </nav>
            <div class="container">
                <div class="table-responsive mt-2">
                    <h4 class="text-center">รายการ ผลโหวต</h4>
                    <table class="table">
<?php
                    echo "
                      <thead>
                        <tr>
                          <th scope=\"\" class=\"border-0 bg-light\">
                            <div class=\"py-2 text-uppercase\">ลำดับ</div>
                          </th>
                          <th scope=\"col\" class=\"border-0 bg-light\">
                            <div class=\"py-2 text-uppercase\">รายชื่อ ผู้สมัค</div>
                          </th>
                          <th scope=\"col\" class=\"border-0 bg-light\">
                            <div class=\"py-2 text-uppercase\">หมายเลข</div>
                          </th>
                          <th scope=\"col\" class=\"border-0 bg-light\">
                            <div class=\"py-2 text-uppercase\">จำนวนคนโหวต</div>
                          </th>
                          <th scope=\"col\" class=\"border-0 bg-light\">
                            <div class=\"py-2 text-uppercase\">รายละเอียด</div>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                    ";
                    $setCandidateWin = "SELECT *, COUNT(*) setcount FROM colletion_id LEFT JOIN candidate ON colletion_id.id_candidate = candidate.candi_id WHERE id_vote='$getID_vote' GROUP BY id_candidate ORDER BY setcount DESC";
                      $setQueryLimitedCandiTwo = mysqli_query($conn,$setCandidateWin)or die(mysqli_error());
                       foreach($setQueryLimitedCandiTwo as $fuck => $limitedRes){
                           ListCandidateLimit(($fuck+1),$limitedRes['profile_img'],$limitedRes['fullname'],$limitedRes['number'],$limitedRes['setcount'],$limitedRes['department'],$limitedRes['title']);
                            
                        }
?>
                      </tbody>
                    </table>
                    <h6 class="text-right text-danger font-thi mt-0">หมายเหตุ : จะเเสดงเฉพาะคนที่ถูกโหวตเท่านั้น ส่วนcandidateที่ไม่มีใครโหวตเลยจะไม่แสดง</h6>
                </div>
            </div>
      </div>  
<?php
  }
?>
<script src="../assets/js/admin/notifycation.js"></script>
</body>
</html>