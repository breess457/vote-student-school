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
    const AlertCandidate = (GetIcons,GetTitle,GetText,GetIdTypeVote)=>{
         Swal.fire({
               icon: GetIcons,
               title:GetTitle,
               text:GetText,
               confirmButtonText:"OK"
           }).then((result)=>{
                window.location =`../addCandidate.php?getID=${GetIdTypeVote}`
           })   
    }
</script>
<?php
include('../../config/connect.php');
 include('../../public/link.php');
    if(isset($_GET['Status']) == "delete"){
        $typeIDvote = $_GET['typeIDvote'];
        $candidateId = $_GET['CandidateId'];
        $imageCandidate = $_GET['imgCandidate'];
        $DeleteSql = "DELETE FROM candidate WHERE candi_id='$candidateId'";
        $QueryDelete = mysqli_query($conn,$DeleteSql)or die(mysqli_error());
          if($QueryDelete){

            $getCollection_id = mysqli_query($conn,"SELECT * FROM colletion_id WHERE id_candidate='$candidateId'")or die(mysqli_error());
             $setNum_collection_id = mysqli_num_rows($getCollection_id);
              if($setNum_collection_id > 0){
                foreach($getCollection_id as $key_id){
                  $set_keyID = $key_id['id_candidate'];
                  $delete_connectiob_id = mysqli_query($conn,"DELETE FROM colletion_id WHERE id_candidate='$set_keyID'")or die(mysqli_error());
                    if(!$delete_connectiob_id){
                      echo "not delete id_candi"; 
                    }
                }
              }

            $unFileCandidate = "../../config/data/candidate-profile/".$imageCandidate;
            unlink($unFileCandidate);
              echo "<script>
                AlertCandidate(\"success\",\"deletesuccess\",\"ลบ ข้อมูลผู้สมัคเรียบร้อย\",\"$typeIDvote\") 
              </script>";
          }else{
              echo "<script>
                AlertCandidate(\"error\",\"ไม่สำเร็จ\",\"เกิดข้อผิดพลาดไม่สามารถลบข้อมูลดังกล่าวได้\",\"$typeIDvote\")
              </script>";
          }
        
    }else if($_SERVER['REQUEST_METHOD'] == "POST"){
      function setImgPath($fileName)
       {
          $ext = pathinfo(basename($_FILES[$fileName]['name']), PATHINFO_EXTENSION);
            if($ext !=""){
                $new_img_name = 'img_'.uniqid().".".$ext;
                $image_path = "../../config/data/cadidate-profile/";
                $upload_path = $image_path.$new_img_name;
                move_uploaded_file($_FILES[$fileName]['tmp_name'], $upload_path);
                $setImgCandi = $new_img_name;
            }else{
                $setImgCandi ="";
            }
         return $setImgCandi;
       }
      function setUpdateDataCandidate($setImgparams,$configdb)
       {
         $setidCandidate = $_POST['setidCandidate'];
         $setImgnames = $_POST['setImgnames'];
         $setFullname = $_POST['setFullname'];
         $setdepartmentCandy = $_POST['setdepartmentCandy'];
         $setCandidateTitle = $_POST['setCandidateTitle'];
         $setCandidateNumber = $_POST['setCandidateNumber'];
         $setCandidateContent = $_POST['setCandidateContent'];
         $settypeidvote = $_POST['settypeidvote'];
          if($setImgparams == ""){
            $setDataCandidate = "UPDATE candidate SET fullname='$setFullname',title='$setCandidateTitle',
              subContent='$setCandidateContent',department='$setdepartmentCandy',number='$setCandidateNumber'
            WHERE candi_id='$setidCandidate'";
          }else{
            $setDataCandidate = "UPDATE candidate SET fullname='$setFullname',title='$setCandidateTitle',
              subContent='$setCandidateContent',department='$setdepartmentCandy',number='$setCandidateNumber',
            profile_img='".setImgPath("setImageCandy")."' WHERE candi_id='$setidCandidate'";
            if($setImgnames !=''){
              $unFileCandiUpdate = '../../config/data/cadidate-profile/'.$setImgnames;
              unlink($unFileCandiUpdate);
            }
          }
          $setQueryDataCandi = mysqli_query($configdb,$setDataCandidate)or die(mysqli_error());
           if($setQueryDataCandi){
             echo "<script>
                AlertCandidate(\"success\",\"update success\",\"update ข้อมูลผู้สมัคเรียบร้อย\",\"$settypeidvote\") 
              </script>";
           }else{
             echo "<script>
                AlertCandidate(\"error\",\"update error\",\"ไม่สำเร็จ เกิดข้อผิดพลาดไม่สามารถลบข้อมูลดังกล่าวได้\",\"$settypeidvote\") 
              </script>";
           }
       }
       setUpdateDataCandidate($_FILES['setImageCandy']['tmp_name'],$conn);
    }
?>
</body>
</html>