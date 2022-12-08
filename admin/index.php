<?php
session_start();
include('../config/connect.php');
include('../public/link.php');
include('../public/AdminFunction.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="../assets/scss/admin/adminDashbord.page.scss">
    <link rel="stylesheet" href="../assets/scss/admin/admin.index.css">
    <title>Home Page</title>
</head>

<body>
    <?php
    function swalFunction()
    {
      echo "
        <script> 
           Swal.fire({
               icon:\"error\",
               title:\"ไม่อนุญาตเข้าแบบผิดวิธี\",
               text:'กรุณา login',
               confirmButtonText:\"OK\"
           }).then((result)=>{
              
                window.location ='../index.php'
            
           })
        </script>
      ";
    }
    if (!isset($_SESSION['admin_school'])) {
        echo swalFunction();
    } else {
        $fullName = $_SESSION['admin_school']['fullname_admin'];
        $image = $_SESSION['admin_school']['profile_img'];
        $idAdmin = $_SESSION['admin_school']['id'];
        $status = $_SESSION['admin_school']['position'];
        echo Navigation($fullName, $image, $status);
    ?>
        <div class="main-content">
            <!-- Top navbar -->
            <nav class="navbar navbar-tp navbar-expand-md navbar-dark bg-primary" id="navbar-main">
                <div class="container-fluid">
                    <!-- Brand -->
                    <a class="h3 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
                        <i class="fas fa-desktop"></i> Dashboard
                    </a>
                    <a href="logout.php" class="btn btn-success"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </nav>
            <div class="container-fluid text-center mt-2">
                <div class="d-flex justify-content-center">
                    <?php
                        
                    /* Get Number All Event */
                    $sqlAllevent = mysqli_query($conn,"SELECT * FROM vote_all")or die(mysqli_error());
                     $numAllEvent = mysqli_num_rows($sqlAllevent);
                    $sqlevent = mysqli_query($conn,"SELECT * FROM vote_all WHERE id_admin_the_creater_vote='$idAdmin'")or die(mysqli_error());
                     $numEvent = mysqli_num_rows($sqlevent);
                    /* End */
                    $sqlTeacher = mysqli_query($conn,"SELECT * FROM admin_school")or die(mysqli_error());
                     $numTeacher = mysqli_num_rows($sqlTeacher);
                    /* Get Number Students */
                     $sqlStudate = mysqli_query($conn,"SELECT * FROM user_students")or die(mysqli_error());
                      $numStudents = mysqli_num_rows($sqlStudate);
                      /* End */
                      echo CounterCard($numEvent,$numStudents,$numTeacher,$numAllEvent);
                    ?>
                    
                </div>
            </div>
            <hr class="color-primary col-11 text-center">
            <div class="col-md-11 ml-4 mt-1 d-flex">
                <h3 class="mt-2 mb-0"><i class="fas fa-chart-bar"></i>  List Vote Event</h3>
                <h3 class="ml-auto">All : <?php echo $numEvent; ?> Event</h3>
            </div>
            <footer class="footer mb-0">
                <div class="row mt-0 col-md-12">
        <?php
            foreach($sqlevent as $get => $getEvent){
                $votetId = $getEvent['vote_id'];
                 $getCandidate = mysqli_query($conn,"SELECT * FROM candidate WHERE id_type_vote='$votetId'")or die(mysqli_error());
                  $result_vote = mysqli_query($conn,"SELECT id_vote FROM colletion_id WHERE id_vote='$votetId'")or die(mysqli_error());
                   $res_number_vote = mysqli_num_rows($result_vote);
                   $numCandidate = mysqli_num_rows($getCandidate);
                    EventCounter($numCandidate,$getEvent['image'],$getEvent['subtitle'],$getEvent['class_key'],$votetId,$res_number_vote);
            }
        ?>    
                </div>
            </footer>
        </div>

    <?php
    }

    ?>
<script src="../assets/js/admin/event.key.js"></script>
</body>

</html>