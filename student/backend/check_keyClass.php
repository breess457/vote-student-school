<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");	
header("Cache-Control: post-check=0, pre-check=0", false);	
header("Pragma: no-cache");
 include('../../config/connect.php');

   $jsonData = array();
      if($_SERVER['REQUEST_METHOD'] == "GET"){
        echo json_encode($jsonData);
      }elseif($_SERVER['REQUEST_METHOD'] == "OPTIONS"){
        echo json_encode($jsonData);
      }elseif($_SERVER['REQUEST_METHOD'] == "POST"){
        $json = file_get_contents('php://input');
        $postData = json_decode($json,TRUE);

         $id = $postData['ID'];
         $key = $postData['KEYS'];
            $selectKey = "SELECT * FROM vote_all WHERE vote_id='$id' && class_key='$key'";
            $Query = mysqli_query($conn,$selectKey)or die(mysqli_error());
            $fetchKey = mysqli_fetch_array($Query);
            if(!$fetchKey){
                $msgArr = array(
                    'status'=>404,
                    'msg'=>'รหัส ไม่ถูกต้อง'
                );
                echo json_encode($msgArr);
            }else{
                $msgArr = array(
                    'status'=>200,
                    'id'=>$fetchKey['vote_id'],
                    'key'=>$fetchKey['class_key'],
                    'offTime'=>$fetchKey['close_time'],
                    'dateoff'=>$fetchKey['close_date'],
                    'icon'=>'success',
                    'title'=>'Key Success'
                );
                echo json_encode($msgArr);
            }
        
      }else{
          echo json_encode($jsonData);
      }

?>