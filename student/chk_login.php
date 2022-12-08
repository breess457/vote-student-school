<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Step login true</title>
</head>

<body>
  <?php
  session_start();
  include('../config/connect.php');
  include('../public/link.php');

  $codeStd = $_POST['codestd'];
  $passwd = $_POST['passwd'];

  $sql = "SELECT * FROM user_students WHERE student_code='$codeStd' && passwd='$passwd'";
  $que = mysqli_query($conn, $sql) or die(mysqli_error());
  $num = mysqli_fetch_assoc($que);
  if (!$num) {
    $adminSql = "SELECT * FROM admin_school WHERE admin_code='$codeStd' && passwd='$passwd'";
    $adminQuery = mysqli_query($conn, $adminSql) or die(mysqli_error());
    $adminFetch = mysqli_fetch_assoc($adminQuery);
    if (!$adminFetch) {
      echo "
        <script> 
           Swal.fire({
               icon:\"error\",
               title:\"ไม่มี Username นี้ในแผนกนี้\",
               confirmButtonText:\"OK\"
           }).then((result)=>{
                window.location ='../index.php'
             
           })
        </script>
      ";
    } else {
      $_SESSION['admin_school'] = $adminFetch;
      echo "
        <script> 
           Swal.fire({
               icon:\"success\",
               title:\"สวัดดี คุณ Admin\",
               confirmButtonText:\"OK\"
           }).then((result)=>{
                window.location ='../admin'
           })
        </script>
      ";
    }
  } else {
    $_SESSION['user_students'] = $num;
    echo "
        <script> 
           Swal.fire({
               icon:\"success\",
               title:\"สวัดดี คุณ User\",
               confirmButtonText:\"OK\"
           }).then((result)=>{
                window.location ='index.php'
           })
        </script>
      ";
  }

  ?>
</body>

</html>