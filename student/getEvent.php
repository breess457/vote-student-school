<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/scss/web/userFunction.css">
    <link rel="stylesheet" href="../assets/scss/web/user.getEvent.css">
    <title>Get Event Vote</title>
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
  /* Set Date Time */
  const showTime = () => {
    let date = new Date();
    document.getElementById("Sclock").innerHTML = date.toLocaleTimeString();
  };
  setInterval(showTime, 1000);// End Set
</script>
<?php
session_start();
 include('../config/connect.php');
  include('../public/link.php');
   include('../public/UserFunction.php');
    date_default_timezone_set("Asia/Bangkok");
     $currentDay = date("Y-m-d");
     $currentime = date("H:i:s");

    if(!isset($_SESSION['user_students'])){
        echo "<script type=\"text/javascript\">MySweetAlert('error','ไม่พบ ผู้ใช้งาน','กรุณา login','../index.php')</script>";
    } else if(!isset($_GET['IdVoteEvent']) || !isset($_GET['KeyClassEvent'])){
        echo "<script type=\"text/javascript\">MySweetAlert('warning','ไม่พบclass','ไม่อนุญาตเข้าแบบผิดกฏหมาย','index.php')</script>";
    }else if($currentDay > $_GET['OffDate']){
        echo "<script type=\"text/javascript\">MySweetAlert('info','เวลาหมดแล้ว ไอเวรร','หมดเวลาโหวตแล้วดูที่สถานะบ้าง','index.php')</script>";
    }else if($currentDay == $_GET['OffDate'] && $currentime > $_GET['offTime']){
        echo "<script type=\"text/javascript\">MySweetAlert('info','เวลาหมดแล้ว','หมดเวลาโหวตตั่งแต่ ".$_GET['offTime']." แล้ว','index.php')</script>";
    }else if($currentDay < $_GET['onDate']){
        echo "<script type=\"text/javascript\">MySweetAlert('info','ยังไม่เปิด','โหวตนี้ยังไม่ได้เปิด จะเปิดเวลา ".$_GET['onDate']." แล้ว','index.php')</script>";
    }else if($currentime < $_GET['onTime']){
        echo "<script type=\"text/javascript\">MySweetAlert('info','ยังไม่เปิด','โหวตนี้ยังไม่ได้เปิด จะเปิดเวลา ".$_GET['onTime']." แล้ว','index.php')</script>";
    } else{
      
        $sessionUser = $_SESSION['user_students']['fullname'];
        $sessionImage = $_SESSION['user_students']['profile_img'];
        $sessionId = $_SESSION['user_students']['user_id'];
        $getIDvote = $_GET['IdVoteEvent'];
          Navbar($sessionUser,$sessionImage,$sessionId,$conn);
            echo "<div class=\"col-md-12 mt-2 response mb-2\">";
              $showSql = mysqli_query($conn,"SELECT * FROM vote_all WHERE vote_id='$getIDvote'")or die(mysqli_error());
                foreach($showSql as $key){
                  getCardTitle($key['vote_id'],$key['subtitle'],$key['detail'],$key['open_date'],$key['close_date'],$key['open_time'],$key['close_time'],$key['image'],$key['class_key']);
                }
            echo "</div>"; 
            echo "<div class=\"col-md-12 d-flex response\">";
              $showCandidate = mysqli_query($conn,"SELECT * FROM candidate WHERE id_type_vote='$getIDvote'")or die(mysqli_error());
                foreach($showCandidate as $res => $ResPonse){
                    Ourtimes($ResPonse['candi_id'],$ResPonse['fullname'],$ResPonse['profile_img'],$ResPonse['title'],$ResPonse['subContent'],$ResPonse['department'],$ResPonse['number'],$ResPonse['id_type_vote'],$sessionId);
                }
            echo "</div>"; 
            echo "<main-view-candidate></main-view-candidate>";
    }
?>
<script src="../assets/js/web/user.create.event.js"></script>
</body>
</html>