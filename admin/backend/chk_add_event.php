<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
<?php

include('../../config/connect.php');
include('../../public/link.php');
  
   $ext = pathinfo(basename($_FILES['up_img']['name']), PATHINFO_EXTENSION);
    if($ext !=''){
        $new_img_name = 'img_'.uniqid().".".$ext;
        $image_path = "../../config/data/image-vote/";
        $upload_path = $image_path.$new_img_name;
        move_uploaded_file($_FILES['up_img']['tmp_name'], $upload_path);
        $upImage = $new_img_name;
    }else{
        $upImage = "none";
    } 
    

  $eventSubject = $_POST['event_subject'];
  $openDate = $_POST['open_date'];
  $openTime = $_POST['open_time'];
  $closeDate = $_POST['close_date'];
  $closeTime = $_POST['close_time'];
  $contentEvent = $_POST['content_event'];
  $idadminCreate = $_POST['admincreatevote'];

    if($_POST['classKey'] == ""){
      $keyClass = "open";
    }else{
      $keyClass = $_POST['classKey'];
    }


   $getSQL = "SELECT * FROM vote_all WHERE subtitle='$eventSubject'";
   $Query = mysqli_query($conn,$getSQL);
   $Num = mysqli_num_rows($Query);
     if($Num == 1){
        echo "
        <script> 
           Swal.fire({
               icon:\"error\",
               title:\"ไม่สามารถสร้างได้\",
               text:\"หัวข้อนี้ ถูกสร้างไว้แล้ว กรุณาสร้างหัวข้ออิ่น\",
               confirmButtonText:\"OK\"
           }).then((result)=>{
                window.location ='../getEvent.php'
           })
        </script>
      ";
     }else{
       $InsertSQL = "INSERT INTO vote_all(vote_id,subtitle,detail,open_date,close_date,open_time,close_time,image,class_key,id_admin_the_creater_vote)
              VALUES(null,'$eventSubject','$contentEvent','$openDate','$closeDate','$openTime','$closeTime','$upImage','$keyClass','$idadminCreate')";
        $insertQuery = mysqli_query($conn,$InsertSQL)or die(mysqli_error());
        if($insertQuery){
            $getID = mysqli_insert_id($conn);
           echo "
              <script> 
                 Swal.fire({
                     icon:\"success\",
                     title:\"Create success fully\",
                     text:\"สร้างหัวข้อนี้เรียบร้อยแล้ว\",
                     showDenyButton: true,
                      showCancelButton: false,
                      confirmButtonText: `ไปหน้าต่อไป`,
                      denyButtonText: `ย้อนกลับ`,
                 }).then((result)=>{
                    if (result.isConfirmed) {
                      window.location='../addCandidate.php?getID=".$getID."&&keys=".$keyClass."'
                    }else if (result.isDenied){
                      window.location ='../getEvent.php'
                    }
                 })
              </script>
            ";
        }else{
          echo "
           Swal.fire({
               icon:\"error\",
               title:\"ไม่สามารถสร้างได้\",
               confirmButtonText:\"OK\"
           }).then((result)=>{
                window.location ='../getEvent.php'
           })
          ";
        }
     }

?>
</body>
</html>