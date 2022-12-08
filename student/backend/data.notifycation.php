<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");	
header("Cache-Control: post-check=0, pre-check=0", false);	
header("Pragma: no-cache");
session_start();
 include('../../config/connect.php');

  if($_SERVER['REQUEST_METHOD'] == "GET"){
      $sessionId = $_SESSION['user_students']['user_id'];
      $setSQL = "SELECT * FROM colletion_id LEFT JOIN vote_all ON colletion_id.id_vote = vote_all.vote_id LEFT JOIN candidate ON colletion_id.id_candidate = candidate.candi_id WHERE id_user='$sessionId'";
       $setQuery = mysqli_query($conn,$setSQL)or die(mysqli_error());
        $setNum = mysqli_num_rows($setQuery);
         if($setNum){
            $dataArr = array();
             foreach($setQuery as $get_result){
                 $dataArr[] = $get_result;
             }
             echo json_encode($dataArr);
         }else{
             echo json_encode(null);
         }
  }

?>