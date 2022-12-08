<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="../assets/scss/admin/adminDashbord.page.scss">
    <link rel="stylesheet" href="../assets/scss/admin/admin.profile.css">
    <title>Profile Page</title>
</head>
<body> 
<?php
    session_start();
    include('../config/connect.php');
    include('../public/link.php');
    include('../public/AdminFunction.php');
    if(!isset($_SESSION['admin_school'])){
        
        echo "
          <script> 
             Swal.fire({
                 icon:\"error\",
                 title:\"ไม่อนุญาตเข้าแบบผิดวิธี\",
                 text:'กรุณา login',
                 confirmButtonText:\"OK\"
             }).then((result)=>{
                if (result.value) {
                  window.location ='../index.php'
                }
             })
          </script>
        ";

    }else{
        $fullName = $_SESSION['admin_school']['fullname_admin'];
        $image = $_SESSION['admin_school']['profile_img'];
        $codeAdmin = $_SESSION['admin_school']['admin_code'];
        $status = $_SESSION['admin_school']['position'];
        echo Navigation($fullName, $image, $status);
?>
        <div class="main-content">
            <!-- Top navbar -->
            <nav class="navbar navbar-tp navbar-expand-md navbar-dark bg-primary" id="navbar-main">
                <div class="container-fluid">
                    <!-- Brand -->
                    <a class="h3 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
                        <i class="fas fa-user-shield"></i>  Profile
                    </a>
                    <a href="logout.php" class="btn btn-success"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </nav>
            <div class="container-fluid text-center mt-2">
                <?php 
                    $GetProfileAdmin = mysqli_query($conn,"SELECT * FROM admin_school WHERE admin_code='$codeAdmin'")or die(mysqli_error());
                    foreach($GetProfileAdmin as $Numbar => $value){
                        PortProfile($value['id'],$value['profile_img'],$value['fullname_admin'],$value['admin_code'],$value['department'],$value['position'],$value['passwd']);
                    }
                ?>
            </div>
            <main-update-profile></main-update-profile>
        </div>
<?php
    }
?>
<script src="../assets/js/admin/get.profile.js"></script>
</body>
</html>