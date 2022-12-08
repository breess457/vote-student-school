
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status</title>
</head>
<body>
<script type="text/javascript">
 const SweetAlert = function(Icons,Titles,Texts){
    Swal.fire({
        icon : Icons,
        title : Titles,
        text: Texts,
        confirmButtonText:"OK"
    }).then(result =>{
        window.history.back()
    })
 }
</script>
 <?php

  include('../../config/connect.php');
  require_once('../../public/link.php');

    if($_SERVER['REQUEST_METHOD'] == "GET"){
      $idCandydate = $_GET['candy_id'];
      $idTypeVote = $_GET['idtypeVote'];
      $sessionidUser = $_GET['sessionidUser'];
      $userCandi = $_GET['userCandi'];

      $setVote = mysqli_query($conn,"SELECT * FROM colletion_id WHERE id_vote='$idTypeVote' AND id_user='$sessionidUser'")or die(mysqli_error());
       $setNums = mysqli_num_rows($setVote);
        if($setNums == 1){
            echo "<script>SweetAlert(\"warning\",\"มืงโหวตแล้ว ไอเวร\",\"ไม่สามารถโหวตได้ เนื่องจากมืงโหวตแล้ว ไม่เห็นคำเตือนรึไง\")</script>";
        }else{
            $insert = "INSERT INTO colletion_id(id_vote,id_candidate,id_user)VALUES('$idTypeVote','$idCandydate','$sessionidUser')";
             $setQuery = mysqli_query($conn,$insert)or die(mysqli_error());
              if($setQuery){
                  echo "<script>SweetAlert(\"success\",\"vote success\",\"ตุณโหวต ".$userCandi." เรียบร้อย\")</script>";
              }else{
                  echo "<script>SweetAlert(\"error\",\"ไม่สำเร็จ\",\"ไอสัส ตอนเทศไม่errorตอนนี้เสื่อกerror\")</script>";
              }
        }
    }
 
 ?>  
</body>
</html>