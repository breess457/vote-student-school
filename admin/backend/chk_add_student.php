<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include('../../config/connect.php');
include('../../public/link.php');

   $ext = pathinfo(basename($_FILES['image']['name']), PATHINFO_EXTENSION);
    if($ext !=''){
        $new_img_name = 'img_'.uniqid().".".$ext;
        $image_path = "../../config/data/student-profile/";
        $upload_path = $image_path.$new_img_name;
        move_uploaded_file($_FILES['image']['tmp_name'], $upload_path);
        $upImage = $new_img_name;
    }else{
        $upImage = "none";
    }

$fname = $_POST['fname'];
$department = $_POST['department'];
$stdCode = $_POST['stdCode'];
$pwd = $_POST['pwd'];
$sex = $_POST['sex'];
$age =  $_POST['age'];
$YofStd = $_POST['yearofStudy'];

/* Check CodeStudent */
  $ChkcodeStd = "SELECT * FROM user_students WHERE student_code='$stdCode'";
  $Query = mysqli_query($conn, $ChkcodeStd)or die(mysqli_error());
  $numRow = mysqli_num_rows($Query);
    if($numRow == 1){
       echo "
        <script> 
           Swal.fire({
               icon:\"error\",
               title:\"รหัส นักศึกษาซํ้ากัน\",
               text:\"ไม่อนุญาติให้มีรหัสนักศีกษาซํ้า\",
               confirmButtonText:\"OK\"
           }).then((result)=>{
                window.location ='../getStudent.php'
           })
        </script>
      ";
    }else{
        $insertSql = "INSERT INTO user_students(fullname,student_code,profile_img,department,year_of_study,passwd,sex,age)
            VALUES('$fname','$stdCode','$upImage','$department','$YofStd','$pwd','$sex','$age')";
        $queryInsert = mysqli_query($conn,$insertSql)or die(mysqli_error());
        if($queryInsert){
         echo "
              <script> 
                 Swal.fire({
                     icon:\"success\",
                     title:\"เพิ่ม ข้อมูลนักศึกษาเรียบร้อย\",
                     confirmButtonText:\"OK\"
                 }).then((result)=>{
                      window.location ='../getStudent.php'
                 })
              </script>
            ";
        }else{
            echo "
              <script> 
                 Swal.fire({
                     icon:\"error\",
                     title:\"ไม่สามารถเพิ่ม ข้อมูลนักศึกษาได้\",
                     text:\"ระบบผิดพลาด โปรดติดต่อเจ้าหน้าที่\"
                     confirmButtonText:\"OK\"
                 }).then((result)=>{
                      window.location ='../getStudent.php'
                 })
              </script>
            ";
        }
    }
?>
</body>
</html>
