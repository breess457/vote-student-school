
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

if(isset($_POST["status"]) == "update"){
    function setImgStd($methodImg){
     $ext = pathinfo(basename($_FILES[$methodImg]['name']), PATHINFO_EXTENSION);
        if($ext !=''){
            $new_img_name = 'img_'.uniqid().".".$ext;
            $image_path = "../../config/data/student-profile/";
            $upload_path = $image_path.$new_img_name;
            move_uploaded_file($_FILES[$methodImg]['tmp_name'], $upload_path);
            $upImage = $new_img_name;
        }else{
            $upImage = $new_img_name;
        } 
        return $upImage; 
    }

    function setUpdateStudents($imgFile,$dbConfig)
    {
        $Id = $_POST["setIDstd"];
        $fullname = $_POST["setNameStd"];
        $department = $_POST["setDepartmaneStudent"];
        $codeStd = $_POST["setCodeStudent"];
        $sex = $_POST["setSexStudent"];
        $age = $_POST["setAgeStudent"];
        $yofStd = $_POST["yearofStudy"];
        $getImgDefault = $_POST['setImgStudent'];
        $setPasswordStudent = $_POST['setPasswordStudent'];
         if($imgFile == ""){
             $setUpdateSQL = "UPDATE user_students SET fullname='$fullname',student_code='$codeStd',
                department='$department',year_of_study='$yofStd',passwd='$setPasswordStudent',sex='$sex',age='$age'
             WHERE user_id='$Id'";
         }else{
             $setUpdateSQL = "UPDATE user_students SET fullname='$fullname',student_code='$codeStd',
                profile_img='".setImgStd("image")."', department='$department',year_of_study='$yofStd',passwd='$setPasswordStudent',sex='$sex',age='$age'
             WHERE user_id='$Id'";
             if($getImgDefault != ''){
                 $unFileStudentUpdate = '../../config/data/student-profile/'.$getImgDefault;
                 unlink($unFileStudentUpdate);
             }
         }
          $setUpdateQuery = mysqli_query($dbConfig,$setUpdateSQL)or die(mysqli_error());
           if($setUpdateQuery){
            echo "
                <script> 
                     Swal.fire({
                         icon:\"success\",
                         title:\"update ข้อมูลนักศึกษาเรียบร้อย\",
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
                         title:\"เกิดข้อผิดพลาด\",
                         text:\"ไม่สามารถ update ได้ ติดต่อเจ้าหน้าที่\",
                         confirmButtonText:\"OK\"
                     }).then((result)=>{
                          window.location ='../getStudent.php'
                     })
                </script>
              ";
           }
    }
    setUpdateStudents($_FILES['image']['tmp_name'],$conn);

/*     echo "id: ",$Id," &nbsp; name: ",$fullname," &nbsp; department: ",$department," &nbsp; codestd: ",$codeStd," &nbsp; sex: ",$sex,
        " &nbsp; age:",$age," &nbsp; yofstd:", $yofStd," &nbsp; img:",$getImgDefault," &nbsp; passwd: ",$setPasswordStudent;
 */

}elseif($_GET['status']=="delete"){
    // echo "Delete";
    $getIDstd = $_GET['std_id'];
    $getImgStd = $_GET['imageStudent'];
    $deleteSql = "DELETE FROM user_students WHERE user_id='$getIDstd'";
    $delQuery = mysqli_query($conn,$deleteSql)or die(mysqli_error());
      if($delQuery){
        $unFileStd = "../../config/data/student-profile/".$getImgStd;
        unlink($unFileStd);
          echo "
            <script> 
                 Swal.fire({
                     icon:\"success\",
                     title:\"ลบ ข้อมูลนักศึกษาเรียบร้อย\",
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
                     title:\"เกิดข้อผิดพลาด\",
                     text:\"ไม่สามารถลบได้ ติดต่อเจ้าหน้าที่\",
                     confirmButtonText:\"OK\"
                 }).then((result)=>{
                      window.location ='../getStudent.php'
                 })
            </script>`
          ";
      }
}

?>
</body>
</html> 