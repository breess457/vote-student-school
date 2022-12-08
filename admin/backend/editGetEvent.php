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
    const AlertGetEvents = (GetIcons,GetTitle,GetText,linkLocation)=>{
         Swal.fire({
               icon: GetIcons,
               title:GetTitle,
               text:GetText,
               confirmButtonText:"OK"
           }).then((result)=>{
                window.location = linkLocation
           })   
    }
</script>
<?php
 include('../../config/connect.php');
  include('../../public/link.php');
   if(isset($_GET['statusEvn']) == "Delete"){
       $status = $_GET['statusEvn'];
       $idEventvote = $_GET['idvoteEvent'];
       $ImageVote = $_GET['imageVote'];

       $Delete = "DELETE FROM vote_all WHERE vote_id='$idEventvote'";
       $QueryDelete = mysqli_query($conn,$Delete)or die(mysqli_error());
        if($QueryDelete){
            /* Delete Image of Class Image Vote */
            $unfileVote = "../../config/data/image-vote/".$ImageVote;
            unlink($unfileVote);

            $getGetdateCandidate = "SELECT * FROM candidate WHERE id_type_vote='$idEventvote'";
            $QueryDatacandidate = mysqli_query($conn,$getGetdateCandidate)or die(mysqli_error());
            
                foreach($QueryDatacandidate as $getKey => $resData){
                   $getIdTypeVote = $resData['id_type_vote'];
                   /* Delete Image of ProfileCandidate */
                    $deleteDataCandidate = mysqli_query($conn,"DELETE FROM candidate WHERE id_type_vote='$getIdTypeVote'")or die(mysqli_error());
                       if($deleteDataCandidate){
                           $getImgCandidate = $resData['profile_img'];
                           $unFileCandidate = "../../config/data/candidate-profile/".$getImgCandidate;
                            unlink($unFileCandidate);
                            
                       }else{
                           echo "none Delete";
                       }
                }

            $getCollectionId = mysqli_query($conn,"SELECT * FROM colletion_id WHERE id_vote='$idEventvote'")or die(mysqli_error());
              $coll_nums = mysqli_num_rows($getCollectionId);
                if($coll_nums > 0){
                    foreach($getCollectionId as $collectionKey){
                        $setCollection_id = $collectionKey['id_vote'];
                        $deleteCollectionId = mysqli_query($conn,"DELETE FROM colletion_id WHERE id_vote='$setCollection_id'")or die(mysqli_error());
                         if(!$deleteCollectionId){
                             echo "none delete collection";
                         }
                    }
                }

            $ok = "DeleteAllData Success";
            echo "<script>
                AlertGetEvents(\"success\",\"$status\",\"$ok\",\"../getEvent.php\")
            </script>";
            
        }else{
            echo "normal none";
        }
       
   }else if($_SERVER['REQUEST_METHOD'] == "POST"){

       function setImgPath($fileName)
       {
          $ext = pathinfo(basename($_FILES[$fileName]['name']), PATHINFO_EXTENSION);
            if($ext !=""){
                $new_img_name = 'img_'.uniqid().".".$ext;
                $image_path = "../../config/data/image-vote/";
                $upload_path = $image_path.$new_img_name;
                move_uploaded_file($_FILES['imageEvent']['tmp_name'], $upload_path);
                $EventImg = $new_img_name;
            }else{
                $EventImg ="";
            }
         return $EventImg;
       }

       function setUpdateEvent($params,$db)
       {
          $id = $_POST['getId'];
          //$getKey = $_POST['getKey'];
          $defultImg = $_POST['getImgdefault'];
          $subject = $_POST['event_subject'];
          $onDay = $_POST['open_date'];
          $onTime = $_POST['open_time'];
          $offDay = $_POST['off_date'];
          $offTime = $_POST['off_time'];
          $content = $_POST['content_event'];
            if($_POST['classKey'] == ""){
              $keyClass = "open";
            }else{
              $keyClass = $_POST['classKey'];
            }
           if($params == ""){
               $setEvent = "UPDATE vote_all SET subtitle='$subject',detail='$content',open_date='$onDay',
                   close_date='$offDay',open_time='$onTime',close_time='$offTime',class_key='$keyClass' WHERE vote_id='$id'";
           }else{
               $setEvent = "UPDATE vote_all SET subtitle='$subject',detail='$content',open_date='$onDay',
                   close_date='$offDay',open_time='$onTime',close_time='$offTime',image='".setImgPath("imageEvent")."',class_key='$keyClass' WHERE vote_id='$id'";
                if($defultImg !=''){
                   $unFileEvent = "../../config/data/image-vote/".$defultImg;
                   unlink($unFileEvent);
                } 
           }
            $setQueryEvent = mysqli_query($db,$setEvent)or die(mysqli_error());
             if($setQueryEvent){
                 echo "<script>
                        AlertGetEvents(\"success\",\"update success\",\"update $subject to success\",\"../addCandidate.php?getID=$id&keys=$keyClass\")
                      </script>";
             }else{
                 echo "<script>
                        AlertGetEvents(\"error\",\"update error\",\"update $subject to error\",\"../addCandidate.php?getID=$id&keys=$keyClass\")
                      </script>";
             }


       }

       setUpdateEvent($_FILES['imageEvent']['tmp_name'],$conn);
       
   }
   
?>
</body>
</html>