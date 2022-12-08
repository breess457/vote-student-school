<?php
session_start();
include('../config/connect.php');
include('../public/link.php');
include('../public/AdminFunction.php');
    date_default_timezone_set("Asia/Bangkok");
    $Day = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="../assets/scss/admin/adminDashbord.page.scss">
    <link rel="stylesheet" href="../assets/scss/admin/admin.getevent.css">
    <title>GetEvent Page</title>
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
              if (result.value) {
                window.location ='../index.php'
              }
           })
        </script>
      ";
    }
    if (!isset($_SESSION['admin_school'])) {
        echo swalFunction();
    } else {
        $fullName = $_SESSION['admin_school']['fullname_admin'];
        $image = $_SESSION['admin_school']['profile_img'];
        $status = $_SESSION['admin_school']['position'];
        $sessionId = $_SESSION['admin_school']['id'];
        echo Navigation($fullName, $image, $status);
    ?>
        <div class="main-content">
            <!-- Top navbar -->
            <nav class="navbar navbar-tp navbar-expand-md navbar-dark bg-primary" id="navbar-main">
                <div class="container-fluid">
                    <!-- Brand -->
                    <a class="h3 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
                        <i class="far fa-calendar-check"></i> Event
                    </a>
                    <a href="logout.php" class="btn btn-success"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </nav>
            <div class="container-fluid mb-0">
                <div class="d-flex mb-0">
                    <button type="button" class="btn btn-outline-info font-thi mt-4" id="modalCreateEvent" data-admincreate="<?php echo $_SESSION['admin_school']['id']; ?>" data-toggle="modal" data-target="#exampleModal">
                        <i class="far fa-list-alt"></i> สร้างรายการ
                    </button>
                    <p class="ml-auto mt-4 text-info">
                       CurrentDate: <?php echo $Day,"&nbsp;:&nbsp;<i id=\"clock\"></i>"; ?>
                    </p>
                </div>
                <hr>
            </div>
            <footer class="footer mb-0">
                <div class="row col-md-12">
                    <?php 
                        $getEvent = mysqli_query($conn,"SELECT * FROM vote_all");
                        foreach($getEvent as $res){
                            echo CartEvent($res['vote_id'],$res['subtitle'],$res['detail'],$res['open_date'],$res['close_date'],$res['open_time'],$res['close_time'],$res['image'],$res['class_key']);
                        }
                    ?>
                </div>
            </footer>
            <!-- getData Modal ID exampleModal -->
            <main-create-event></main-create-event>
        </div>

    <?php
    }

    ?>
    <script src="../assets/js/admin/get.event.js"></script>
    <script src="../assets/js/admin/event.key.js"></script>
</body>
</html>