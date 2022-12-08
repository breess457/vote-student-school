<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<script type="text/javascript">
    const SweetAlert = (Icons,Texts,Titles)=>{
        Swal.fire({
            icon : Icons,
            title : Titles,
            text: Texts,
            confirmButtonText:"OK"
        }).then(result =>{
            window.location = `../getTeacher.php`
        })
    }
</script>
<?php
include('../../config/connect.php');
 include('../../public/link.php');
    $fullname = $_POST['teacherName'];
    $TeacherCode = $_POST['TeacherCode'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $password = $_POST['password'];
     $ext = pathinfo(basename($_FILES['TeacherImage']['name']), PATHINFO_EXTENSION);
      if($ext !=''){
          $new_img_name = 'img_'.uniqid().".".$ext;
          $image_path = "../../config/data/admin-profile/";
          $upload_path = $image_path.$new_img_name;
          move_uploaded_file($_FILES['TeacherImage']['tmp_name'], $upload_path);
          $addImgTeacher = $new_img_name;
      }else{
          $addImgTeacher = "";
      }

    $selectSql = mysqli_query($conn,"SELECT * FROM admin_school WHERE admin_code='$TeacherCode'")or die(mysqli_error());
     $numSql = mysqli_num_rows($selectSql);
       if($numSql == 1){
           echo "<script>SweetAlert(\"error\",\"ไม่สำเร็จ\",\"มีรหัสประจำตัวนี้อยู่แล้ว/code name ซํ้ากัน\")</script>";
       }else{
           $insertData = "INSERT INTO admin_school(fullname_admin,admin_code,profile_img,department,position,passwd)
            VALUES('$fullname','$TeacherCode','$addImgTeacher','$department','$position','$password')";
             $QueryInsert = mysqli_query($conn,$insertData)or die(mysqli_error());
               if($QueryInsert){
                   echo "<script>SweetAlert(\"success\",\"สำเร็จ\",\"เพิ่มข้อมูลเรียบร้อย\")</script>";
               }else{
                   echo "<srcipt>SweetAlert(\"error\",\"เกิดข้อผิดพลาด\",\"มีข้อผิดพลาดไม่สามารถเพิ่มข้อมูลได้ ติดต่อเจ้าหน้าที่\")</srcipt>";
               }
       }

    //echo $fullname,"<br>",$TeacherCode,"<br>",$department,"<br>",$position,"<br>",$password,"<br>",$TeacherImage;

?>
</body>
</html>