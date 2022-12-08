<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
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
                window.location =`../profile.php`
           })   
    }
</script>
 <?php
   require_once('../../config/connect.php');
   require_once('../../public/link.php');
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        function setPathImage($methodImg){
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
        function setUpdateProfile($setMethodImage,$dbconfig){
            $meId = $_POST['meId'];
            $setImgDefault = $_POST['setImgDefault'];
            $setFullname = $_POST['setFullname'];
            $setCodeadmin = $_POST['setCodeadmin'];
            $setDepartment = $_POST['setDepartment'];
             if(!$setMethodImage){
                $setUpdateDataTeacher = "UPDATE admin_school SET fullname_admin='$setFullname',admin_code='$setCodeadmin',
                   department='$setDepartment' WHERE id='$meId'";
             }else{
                $setUpdateDataTeacher = "UPDATE admin_school SET fullname_admin='$setFullname',admin_code='$setCodeadmin',
                 profile_img='".setPathImage("UpdateProfileImg")."',department='$setDepartment' WHERE id='$meId'";
                  if($setImgDefault){
                      $unFileUpdateProfile = "../../config/data/admin-profile/".$setImgDefault;
                        unlink($unFileUpdateProfile);
                  }
             }
                $setQueryUpdate = mysqli_query($dbconfig,$setUpdateDataTeacher)or die(mysqli_error());
                 if($setQueryUpdate){
                     echo "<script>
                          AlertCandidate(\"success\",\"update success\",\"update data teacher name: $setFullname to success fully\")
                        </script>";
                 }else{
                     echo "<script>
                      AlertCandidate(\"error\",\"ไม่สำเร็จ\",\"เกิดข้อผิดพลาดไม่สามารถupdateข้อมูลดังกล่าวได้\")
                    </script>";
                 }
        }
        setUpdateProfile($_FILES['UpdateProfileImg']['tmp_name'],$conn);
    }
 ?>
</body>
</html>