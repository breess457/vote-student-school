
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
    const SweetAlertCandydate = (iconGet,titleGet,textGet,typeIDvote)=>{
         Swal.fire({
               icon: iconGet,
               title:titleGet,
               text:textGet,
               confirmButtonText:"OK"
           }).then((result)=>{
                window.location =`../addCandidate.php?getID=${typeIDvote}`
           })
    }
</script>
<?php
include('../../config/connect.php');
include('../../public/link.php');

$nameCandy = $_POST['nameCandy'];
$departmentCandy = $_POST['departmentCandy'];
$titleCandy = $_POST['titleCandy'];
$number = $_POST['number'];
$subContent = $_POST['subContent'];
$idtypevote = $_POST['id-type-vote'];

$ext = pathinfo(basename($_FILES['imageCandy']['name']), PATHINFO_EXTENSION);
 if($ext !=''){
     $new_img_name = 'img_'.uniqid().".".$ext;
     $image_path = "../../config/data/candidate-profile/";
     $upload_path = $image_path.$new_img_name;
     move_uploaded_file($_FILES['imageCandy']['tmp_name'], $upload_path);
     $upImage = $new_img_name;
 }else{
     $upImage = "";
 }

 $Sql = "SELECT * FROM candidate WHERE id_type_vote='$idtypevote'&&number='$number'";
  $QuerySql = mysqli_query($conn, $Sql)or die(mysqli_error());
   $NumRows = mysqli_num_rows($QuerySql);
    if($NumRows == 1){
        echo "<script>
                SweetAlertCandydate(\"error\",\"หมายเลขซํ้า\",\"มีผู้สมัคอื่นๆใช้หมายเลขอยู่แล้ว โปรดใช้หมายเลขอื่น\",\"$idtypevote\")
            </script>";
    }else{
        $Insert = "INSERT INTO candidate(profile_img,fullname,title,subContent,department,number,id_type_vote)VALUES('$upImage','$nameCandy','$titleCandy','$subContent','$departmentCandy','$number',$idtypevote)";
         $QueryInsert = mysqli_query($conn,$Insert)or die(mysqli_error());
          if($QueryInsert){
              echo "<script>
                        SweetAlertCandydate(\"success\",\"เรียบร้อย\",\"เพิ่มผู้สมัคเรียบร้อยแล้ว\",\"$idtypevote\")
                    </script>";
          }else{
              echo "<script>
                        SweetAlertCandydate(\"error\",\"ไม่สำเร็จ\",\"เกิดข้อผิดพลาด ไม่สมารถเพิ่มผู้สมัคได้ ติดต่อเจ้าหน้าที่\",\"$idtypevote\")
                    </script>";
          }
    }

?>

</body>
</html>