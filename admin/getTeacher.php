<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="../assets/scss/admin/adminDashbord.page.scss">
    <link rel="stylesheet" href="../assets/scss/admin/admin.getStudent.scss">
    <title>Document</title>
</head>
<body>
 <?php
      session_start();
      include('../config/connect.php');
      include('../public/link.php');
      include('../public/AdminFunction.php');
      if(!$_SESSION['admin_school']){
        
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
        $status = $_SESSION['admin_school']['position'];
        echo Navigation($fullName, $image, $status);
 ?>

    <div class="main-content">
      <!-- Top navbar -->
        <nav class="navbar navbar-tp navbar-expand-md navbar-dark bg-primary" id="navbar-main">
            <div class="container-fluid">
                <!-- Brand -->
                <a class="h3 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
                    <i class="fas fa-chalkboard-teacher"></i> Teacher All
                </a>
                <a href="logout.php" class="btn btn-success"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </nav>
        <div class="container-fluid mb-0">
            <div class="d-flex mb-0">
                <button type="button" class="btn btn-outline-primary font-thi mt-4" data-toggle="modal" data-target="#formCreateTeacher">
                    <i class="fas fa-chalkboard-teacher"></i> เพิ่ม ผู้สอน/ครู
                </button>
                <p class="ml-auto mt-4 text-info">
                   CurrentDate: <i id="clock"></i>
                </p>
            </div>
            <hr>
        </div>
        <!-- Table Show Student -->
        <div class="card col-md-11 mt-2 ml-4">
          <div class="container-xl">
              <div class="table-responsive">
                  <table class="table table-striped table-hover">
                      
                      <tbody>

                    <?php
                        $GetDatabaseTeacher = mysqli_query($conn,"SELECT * FROM admin_school")or die(mysqli_error());
                        /* Loop Function get Student */
                        foreach($GetDatabaseTeacher as $key => $result){
                          if($result['position'] != "Zeroadmin"){
                            echo GetTableTeacher(($key+1),$result['fullname_admin'],$result['profile_img'],$result['admin_code'],$result['department'],$result['position'],$result['id'],$result['passwd']);
                          }
                        }

                    ?>  

                      </tbody>
                  </table>
              </div>
          </div>     
        </div>
        <main-create-teacher></main-create-teacher>
        <mian-modalupdate-datateacher></mian-modalupdate-datateacher>
    </div>

 <?php
      }
 ?>
<script type='text/javascript' src="../assets/js/admin/get.teacher.js"></script>

</body>
</html>