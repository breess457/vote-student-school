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
    const AlertCandidate = (GetIcons,GetTitle,GetText)=>{
         Swal.fire({
               icon: GetIcons,
               title:GetTitle,
               text:GetText,
               confirmButtonText:"OK"
           }).then((result)=>{
                window.location =`../getTeacher.php`
           })   
    }
</script>
<?php
include('../../config/connect.php');
 include('../../public/link.php');
    if(isset($_GET['status']) == "delete"){
        $TeacherId = $_GET['TeacherId'];
        $imageTeacher = $_GET['imageTeacher'];
        $DeleteSql = "DELETE FROM admin_school WHERE id='$TeacherId'";
        $QueryDelete = mysqli_query($conn,$DeleteSql)or die(mysqli_error());
          if($QueryDelete){
            $unFileTeacher = "../../config/data/admin-profile/".$imageTeacher;
            unlink($unFileTeacher);
              echo "<script>
                AlertCandidate(\"success\",\"deletesuccess\",\"ลบ ข้อมูลรียบร้อย\") 
              </script>";
          }else{
              echo "<script>
                AlertCandidate(\"error\",\"ไม่สำเร็จ\",\"เกิดข้อผิดพลาดไม่สามารถลบข้อมูลดังกล่าวได้\")
              </script>";
          }
        
    }else if($_SERVER['REQUEST_METHOD'] == "POST"){

      function setImgTeacher($methodImg){
       $ext = pathinfo(basename($_FILES[$methodImg]['name']), PATHINFO_EXTENSION);
          if($ext !=''){
              $new_img_name = 'img_'.uniqid().".".$ext;
              $image_path = "../../config/data/admin-profile/";
              $upload_path = $image_path.$new_img_name;
              move_uploaded_file($_FILES[$methodImg]['tmp_name'], $upload_path);
              $upImageTeacher = $new_img_name;
          }else{
              $upImageTeacher = $new_img_name;
          } 
          return $upImageTeacher; 
      }

      function setUpdateDataTeacher($methodFile,$dbconfig){
        $setIdTeacher = $_POST['setIdTeacher'];
        $setImageDefault = $_POST['setImageDefault'];
        $setNameTeacher = $_POST['setNameTeacher'];
        $setCodeTeacher = $_POST['setCodeTeacher'];
        $setDepartmentTeacher = $_POST['setDepartmentTeacher'];
        $setPositonTeacher = $_POST['setPositonTeacher'];
        $setPasswordTeacher = $_POST['setPasswordTeacher'];
         if($methodFile == ""){
           $setUpdateDataTeacher = "UPDATE admin_school SET fullname_admin='$setNameTeacher',admin_code='$setCodeTeacher',
              department='$setDepartmentTeacher',position='$setPositonTeacher',passwd='$setPasswordTeacher' WHERE id='$setIdTeacher'";
         }else{
           $setUpdateDataTeacher = "UPDATE admin_school SET fullname_admin='$setNameTeacher',admin_code='$setCodeTeacher',profile_img='".setImgTeacher("TeacherImageUpdate")."',
              department='$setDepartmentTeacher',position='$setPositonTeacher',passwd='$setPasswordTeacher' WHERE id='$setIdTeacher'";
            
            if($setImageDefault != ''){
              $unFileUpdateTeacher = "../../config/data/admin-profile/".$setImageDefault;
              unlink($unFileUpdateTeacher);
            }
         }
           $QueryUpdateDataTeacher = mysqli_query($dbconfig,$setUpdateDataTeacher)or die(mysqli_error());
              if($QueryUpdateDataTeacher){
                echo "<script>
                  AlertCandidate(\"success\",\"update success\",\"update data teacher name: $setNameTeacher to success fully\")
                </script>";
              }else{
                echo "<script>
                  AlertCandidate(\"error\",\"ไม่สำเร็จ\",\"เกิดข้อผิดพลาดไม่สามารถupdateข้อมูลดังกล่าวได้\")
                </script>";
              }

      }

      setUpdateDataTeacher($_FILES['TeacherImageUpdate']['tmp_name'],$conn);
    }
?>
</body>
</html>