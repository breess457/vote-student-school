<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");	
header("Cache-Control: post-check=0, pre-check=0", false);	
header("Pragma: no-cache");
 include('../../config/connect.php');
if($_SERVER['REQUEST_METHOD']=="GET"){
       $id = $_GET['setId'];
       $newpass = $_GET['newpass'];

       $setConfirm = "UPDATE admin_school SET passwd='$newpass' WHERE id='$id'";
       $setQuery = mysqli_query($conn,$setConfirm)or die(mysqli_error());
        if($setQuery){
             echo json_encode(array(
                'status'=>200,
                'title'=>'update success',
                'icons'=>'success',
                'text'=>'update password to success'
            ));
            
        }else{
            echo json_encode(array(
                'status'=>404,
                'title'=>'update error',
                'icons'=>'error',
                'text'=>'update password to error'
            ));
        }
       
    }

?>