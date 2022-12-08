<?php
 session_start();
 include('../config/connect.php');
 include('../public/link.php');
 include('../public/UserFunction.php');
   date_default_timezone_set("Asia/Bangkok");
    $currentDay = date("Y-m-d");
    $currentime = date("H:i:s");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/scss/web/userFunction.css">
    <link rel="stylesheet" href="../assets/scss/web/user.notification.css">
    <title>Notifycation</title>
</head>
<body>
<script type="text/javascript">
  const MySweetAlert =(Icons,Titles,Texts,Locations)=>{
      Swal.fire({
          icon: Icons,
          title: Titles,
          text:Texts,
          confirmButtonText:"OK"
      }).then((result)=>{
           window.location = Locations
      })
  }

</script>
<?php
  if(!isset($_SESSION['user_students'])){
      echo "<script type=\"text/javascript\">MySweetAlert('error','ไม่พบ ผู้ใช้งาน','กรุณา login','../index.php')</script>";
  }else if(!isset($_GET['getidvote_collection'])){
      echo "<script type=\"text/javascript\">MySweetAlert('error','มืงเข้าผิด วิธี','กุวไม่อนุญาติให้เข้าผิดวิธี','index.php')</script>";
  }else if($currentDay < $_GET['closeDate']){
      echo "<script type=\"text/javascript\">MySweetAlert('error','ยังไม่หมดเวลา','รายการโหวตยังเปิดอยู่ ยังไม่รู้ผลเลย','index.php')</script>";
  }else if($currentDay == $_GET['closeDate'] && $currentime < $_GET['closeTime']){
      echo "<script type=\"text/javascript\">MySweetAlert('error','ยังไม่หมดเวลา','รายการโหวตยังเปิดอยู่ ยังไม่รู้ผลเลย','index.php')</script>";
  }else{
      $sessionUser = $_SESSION['user_students']['fullname'];
      $sessionImage = $_SESSION['user_students']['profile_img'];
      $sessionId = $_SESSION['user_students']['user_id'];
      $getIDvoteLimited = $_GET['getidvote_collection'];
        Navbar($sessionUser,$sessionImage,$sessionId,$conn);
        echo "<div class=\"d-flex col-md-12 mb-4 mt-2\">";
          echo"<div class=\"col-md-4\">";
            $setVoteLimited = "SELECT * FROM colletion_id LEFT JOIN vote_all ON colletion_id.id_vote = vote_all.vote_id LEFT JOIN candidate ON colletion_id.id_candidate = candidate.candi_id WHERE get_id='$getIDvoteLimited'";
              $setQueryVoteLimited = mysqli_query($conn,$setVoteLimited)or die(mysqli_error());
               foreach($setQueryVoteLimited as $result){
                 $res = $result['id_vote'];
                 $typeidadmin = $result['id_admin_the_creater_vote'];
                 $getAdminCreate = mysqli_query($conn,"SELECT * FROM admin_school WHERE id='$typeidadmin'")or die(mysqli_error());
                 $getNumber = mysqli_query($conn,"SELECT id_vote FROM colletion_id WHERE id_vote='$res'")or die(mysqli_error());
                 $setNum = mysqli_num_rows($getNumber);
                  foreach($getAdminCreate as $key){
                    CardLimitedVote($result['subtitle'],$result['detail'],$result['open_date'],$result['close_date'],$result['open_time'],$result['close_time'],$result['image'],
                        $result['profile_img'],$result['fullname'],$result['title'],$result['subContent'],$result['department'],$result['number'],$key['fullname_admin'],$key['profile_img'],$setNum);
                  }
               }
          echo "</div>";
          echo "<div class=\"col-md-8\">";
            echo "<h4 class=\"text-center text-success mb-0\">Number One</h4>";
              $setIDvote = $_GET['setIDvote'];
               $setCandidateWin = "SELECT *, COUNT(*) setcount FROM colletion_id LEFT JOIN candidate ON colletion_id.id_candidate = candidate.candi_id WHERE id_vote='$setIDvote' GROUP BY id_candidate ORDER BY setcount DESC LIMIT 1";
                $setQueryLimitedCandi = mysqli_query($conn,$setCandidateWin)or die(mysqli_error());
                  foreach($setQueryLimitedCandi as $limitedKeys){
                     WinUserVote($limitedKeys['profile_img'],$limitedKeys['fullname'],$limitedKeys['setcount'],$limitedKeys['number'],$limitedKeys['department'],$limitedKeys['title']);
                  }
            echo "<div class=\"table-responsive mt-2\">
                    <h4 class=\"text-center\">Data Tables</h4>
                    <table class=\"table mb-0\">";
                    echo "
                      <thead>
                        <tr>
                          <th scope=\"\" class=\"border-0 bg-light\">
                            <div class=\"py-2 text-uppercase\">ลำดับ</div>
                          </th>
                          <th scope=\"col\" class=\"border-0 bg-light\">
                            <div class=\"py-2 text-uppercase\">รายชื่อ ผู้สมัค</div>
                          </th>
                          <th scope=\"col\" class=\"border-0 bg-light\">
                            <div class=\"py-2 text-uppercase\">หมายเลข</div>
                          </th>
                          <th scope=\"col\" class=\"border-0 bg-light\">
                            <div class=\"py-2 text-uppercase\">จำนวนคนโหวต</div>
                          </th>
                          <th scope=\"col\" class=\"border-0 bg-light\">
                            <div class=\"py-2 text-uppercase\">รายละเอียด</div>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                    ";
                    $setCandidateWinTwo = "SELECT *, COUNT(*) setcount FROM colletion_id LEFT JOIN candidate ON colletion_id.id_candidate = candidate.candi_id WHERE id_vote='$setIDvote' GROUP BY id_candidate ORDER BY setcount DESC";
                      $setQueryLimitedCandiTwo = mysqli_query($conn,$setCandidateWinTwo)or die(mysqli_error());
                        foreach($setQueryLimitedCandiTwo as $fuck => $limitedRes){
                           ListCandidateLimit(($fuck+1),$limitedRes['profile_img'],$limitedRes['fullname'],$limitedRes['number'],$limitedRes['setcount'],$limitedRes['department'],$limitedRes['title']);
                            
                        }
            echo "    </tbody>
                    </table>
                    <h6 class=\"text-right text-danger font-thi mt-0\">หมายเหตุ : จะเเสดงเฉพาะคนที่ถูกโหวตเท่านั้น ส่วนcandidateที่ไม่มีใครโหวตเลยจะไม่แสดง</h6>
                 </div>
                 ";
          echo "</div>";
        echo "</div>";

  }
?>
<script src="../assets/js/web/user.create.event.js"></script>
</body>
</html>