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
                    <i class="fas fa-user-graduate"></i> AllStudent
                </a>
                <a href="logout.php" class="btn btn-success"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </nav>
        <div class="container-fluid mb-0">
            <div class="d-flex mb-0">
                <button type="button" class="btn btn-outline-primary mt-4 font-thi" data-toggle="modal" data-target="#form">
                    <i class="fas fa-user-plus"></i> เพิ่ม นักศึกษา
                </button>
                <p class="ml-auto mt-4 text-info">
                   CurrentDate: <i id="clocks"></i>
                </p>
            </div>
            <hr>
        </div>
        <!-- Table Show Student -->
        <div class="card col-md-12 mt-2">
          <div class="container-xl">
              <div class="table-responsive">
                  <table class="table table-striped table-hover">
                      <thead id="t-head"></thead>
                      <tbody>

                    <?php
                        $GetDatabaseStudent = mysqli_query($conn,"SELECT * FROM user_students");
                        /* Loop Function get Student */
                        foreach($GetDatabaseStudent as $key => $result){
                            echo getTableStudent(($key+1),$result['profile_img'],$result['student_code'],$result['fullname'],$result['department'],$result['year_of_study'],$result['sex'],$result['age'],$result['user_id'],$result['passwd']);
                        }

                    ?>  

                      </tbody>
                  </table>
              </div>
          </div>     
        </div>
        <apps-modal-std></apps-modal-std>
        <modal-update-student></modal-update-student>
        
    </div>

 <?php
      }
 ?>
<script src="../assets/js/admin/get.student.js"></script>
</body>
</html>