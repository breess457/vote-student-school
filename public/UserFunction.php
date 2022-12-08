<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
<?php
//include('link.php');


 function Navbar($sessionFullname,$sessionImage,$sessionId,$db){
    $el = "
    <nav class=\"navbar fixed-top navbar-expand-md custom-navbar navbar-dark\">
    <a class=\"navbar-brand logo\">
        <img src=\"../assets/image/logo_school.png\" class=\"logo_custom\" width=\"10%\"  alt=\"logo\"> 
        <b class=\"text-secondary\">vote system of pattani education college </b>
    </a>  
        
        <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
          <i class=\"fas fa-list text-dark\"></i>
        </button>
          <div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">
              <ul class=\"navbar-nav ml-auto mr-4\">
                <li class=\"nav-item\">
                  <a class=\"nav-link\" href=\"index.php\">
                    <b><i class=\"fas fa-home\"></i> HomePage</b>
                  </a>
                </li>
                <li class=\"nav-item mr-4 dropdown x-22\">
                  <a class=\"nav-link dropdown-toggle\" type=\"button\"  data-toggle=\"dropdown\">
                    <b><span class=\"far fa-bell\" ></span>&nbsp;notifications</b>
                  </a>
                  <div class=\"dropdown-menu mega-menu\">
                    <p class=\"text-center text-info\">รายการโหวต</p>
                    <div class=\"table-container\">
                      <table class=\"table table-filter\">
                        <tbody id=\"datanotifycation\" class=\"bordered\">
 
                        </tbody>
                      </table>
                    </div>
                  </div>
                </li>
                <li class=\"nav-item dropdown\">
                  <div class=\"d-flex\">
                    <img src=\"../config/data/student-profile/$sessionImage\" class=\"avatar-image-student\" alt=\"img\">
                    <div class=\"dropdown\">
                      <a type=\"button\" class=\"nav-links mt-2 dropdown-toggle\" data-toggle=\"dropdown\">
                        <b class=\"fulltext\">Profile</b>
                      </a>
                      <div class=\"dropdown-menu\">
                        <a href=\"profile.php\" class=\"dropdown-item d-block\">$sessionFullname <i class=\"ml-auto fas fa-user-circle\"></i></a>
                        <a class=\"dropdown-item\" href=\"logout.php\">Logout <i class=\"ml-auto fas fa-sign-out-alt\"></i></a>
                      </div>
                    </div>
                  </div>
                </li>  
              </ul>
          </div>  
    </nav>
    <br><br><br><br>
    ";
    echo $el;
 }

 function FormatDates($date,$time){
   $DateStr = ". $date $time .";
   $newDate = new \Datetime($DateStr);
   return $newDate->format('d/M/Y H:i');
 }
 function DateStatus($onday,$ofday,$ontime,$offtime){
   date_default_timezone_set("Asia/Bangkok");
    $currenday = date("Y-m-d");
    $currentime = date("H:i:s");
      //Check Status date
        if($onday > $currenday){
           if($ontime > $currentime){
               $Userabbit="<div class=\"ribbon\"><span class=\"off-span\">ยังไม่ได้เปิด1</span></div>";
           }else{
               $Userabbit="<div class=\"ribbon\"><span class=\"off-span\">ยังไม่ได้เปิด2</span></div>";
           }
        }else if($ofday < $currenday){
            if($currentime > $ontime || $currentime < $ontime){
                $Userabbit="<div class=\"ribbon\"><span class=\"off-span\">หมดเวลาแล้ว1</span></div>";
            }else{
                $Userabbit="<div class=\"ribbon\"><span class=\"off-span\">หมดเวลาแล้ว2</span></div>";
            }
        }else if($ofday == $currenday){
          
              if($currentime > $ontime AND $currentime < $offtime){
                  $Userabbit="<div class=\"ribbon\"><span class=\"on-span\">ยังไม่หมดเวลา1</span></div>";
              }else if($currentime > $offtime){
                  $Userabbit="<div class=\"ribbon\"><span class=\"off-span\">หมดเวลาแล้ว3</span></div>";
              }else if( $currentime < $ontime){
                  $Userabbit="<div class=\"ribbon\"><span class=\"off-span\">ยังไม่ได้เปิดxx</span></div>";
              }
        }else if($ofday == $currenday AND $currentime < $ontime){
            $Userabbit="<div class=\"ribbon\"><span class=\"off-span\">ยังไม่ได้เปิด4</span></div>";
        }else if($ofday > $currenday){
            $Userabbit="<div class=\"ribbon\"><span class=\"on-span\">ยังไม่หมดเวลา2</span></div>";
        }
    return $Userabbit;
 } 
 function CheckClass($getVoteId,$getKeyClass,$DateOff,$offTimes,$on_date,$on_time){
    if($getKeyClass == "open"){
      $btn = "<a class=\"btn btn-outline-primary btn-sm mb-0 ml-auto\" role=\"button\" href=\"getEvent.php?IdVoteEvent=".$getVoteId."&KeyClassEvent=".$getKeyClass."&offTime=".$offTimes."&OffDate=".$DateOff."&onDate=".$on_date."&onTime=".$on_time." \">
                <i class=\"fas fa-lock-open\"></i>  กดเข้าร่วม Event Vote
              </a>";
    }else{ 
      $btn = "<a onclick=\"ConfirmKeyEventVote($getVoteId,$getKeyClass)\" class=\"btn btn-outline-danger btn-sm mb-0 ml-auto\" role=\"button\">
                <i class=\"fas fa-lock\"></i>  ใส่รหัสผ่านก่อนเข้าร่วม Event
              </a>";
    }
    return $btn;
 }
 function CardVote($numBer,$subtitle,$detail,$dateOn,$dateOff,$timeOn,$timeOff,$imageVote,$keyClass,$teacherName,$teacherImage,$voteID){

     $cardEl ="
        <div class=\"col-md-6\">
          ".DateStatus($dateOn,$dateOff,$timeOn,$timeOff)."
            <div class=\"card flex-md-row mb-4 shadow-sm h-md-250\">
               <img class=\"card-img-right flex-auto d-lg-block\" alt=\"Thumbnail [200x250]\" src=\"../config/data/image-vote/$imageVote\">
               <div class=\"card-body d-flex flex-column align-items-start\">
                   <strong class=\"d-inline-block mb-1 text-primary\">$subtitle</strong>
                 <div class=\"dis-date mb-1\">
                   <small class=\"text-success mr-4\">เปิด:".FormatDates($dateOn,$timeOn)."</small>
                   <small class=\"text-danger ml-4\">ปิด :".FormatDates($dateOff,$timeOff)."</small>
                 </div>
                 <textarea class=\"form-control mb-1\" rows=\"3\" cols=\"30\"  disabled>$detail</textarea>
                 <div class=\"d-flex\">
                     <small class=\"text-success mt-2\">สร้างโดย:</small>
                     <h4 class=\"text-info mt-1 mr-2\">$teacherName</h4>
                     <img src=\"../config/data/admin-profile/$teacherImage\" class=\"avatar-image-teacher\" alt=\"img\">
                 </div>
                   
                   ".CheckClass($voteID,$keyClass,$dateOff,$timeOff,$dateOn,$timeOn)." 
               </div>
            </div>
        </div>
     ";
    echo $cardEl;
 }
 
 function CheckImg($img){ //function
    if($img == "none"){
        $prop= "<img src=\"../config/data/image-vote/none.jpg\" height=\"180\" width=\"350\" class=\"img-responsive\" alt=\"a\" />";
    }else{
        $prop="<img src=\"../config/data/image-vote/$img\" height=\"180\" width=\"350\" class=\"img-responsive\" alt=\"a\" />";
    }
    return $prop;
  }
  
  /* Get Title Vote Event */
 function getCardTitle($Id,$subJect,$subContent,$onDate,$offDate,$onTime,$offTime,$Img,$keyClass){
    date_default_timezone_set("Asia/Bangkok");
    $currentDay = date("Y-m-d");
    $currentTime = date("H:i:s");  
    $ElTitle = "
		    <div class=\"wizard-container\">
            <div class=\"card Xcard wizard-card\" data-color=\"red\" id=\"wizard\">
                <div class=\"d-flex\">
                    <div class=\"avartarx\">
                        ".CheckImg($Img)."
                    </div>
                    <div class=\"ml-2 col-md-10\">
                      <div class=\"d-flex\" style=\"margin:0 0 0 0;\">
                        <h3 class=\"txt mr-auto\">TiTle : $subJect</h3>
                        <p class=\"ml-auto t-txt\">
                           เวลาปัจจุบัน: $currentDay <i id=\"Sclock\"></i>
                        </p>
                      </div>
                        <textarea class=\"form-control mb-1\" rows=\"3\" cols=\"30\"  disabled>$subContent</textarea>
                      <div class=\"d-flex\">
                        <p class=\"text-success\">วันที่เปิดโหวต: ".FormatDates($onDate,$onTime)."</p>
                        <p class=\"text-danger ml-4\">วันที่ปิดโหวต : ".FormatDates($offDate,$offTime)."</p>
                        
                      </div>
                      <div class=\"d-flex\">
                        <p class=\"text-dark font-weight-bold\">สถานะ :ยังไม่หมดเวลา <i class=\"text-success fas fa-lightbulb\"></i></p>
                        <div class=\"d-flex ml-auto\">
                          <p class=\"text-warning font-weight-bold\">!warning! : </p>
                           <p class=\"text-secondary\">สามารถโหวตได้เพียง 1 คนเท่านั้น ถ้าโหวตแล้วไม่สามารถยกเลิกได้ กรุณาทบทวนให้ดีก่อนโหวตนัจจร้าๅ</p>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>  
    ";
    echo $ElTitle;
}
function BtnlinkVote(){

}
function Ourtimes($id,$Name,$Image,$title,$subContents,$department,$numbers,$idTypeVote,$sessionuserID){
  $Ourt = "
    <div class=\"col-md-2 mt-2\">
      <div class=\"card wizard-card\">
       <div class=\"img-avatar\">
        <img src=\"../config/data/candidate-profile/$Image\" />
       </div>
       <div class=\"d-flex bg-gray\">
          <small class=\"ml-1  mt-1 mb-1\">$Name</small>
          <small class=\"ml-auto mr-1 mb-1 mt-1 font-weight-bold text-purple\">เบอร์ : $numbers</small>
       </div>
       <div class=\"d-flex\">
          <a class=\"btx-outline btxpurple ml-3\" href=\"#myModal\" data-toggle=\"modal\" id=\"maxOurtime\"
            data-name=\"$Name\" data-img=\"$Image\" data-title=\"$title\" data-content=\"$subContents\" data-department=\"$department\" data-number=\"$numbers\"
          >views</a>
          <a href=\"backend/add_vote.php?candy_id=".$id."&idtypeVote=".$idTypeVote."&sessionidUser=".$sessionuserID."&userCandi=".$Name." \" class=\"btx-outline btxVote ml-1\">vote</a>
       </div>
      </div>
    </div>
  ";
  echo $Ourt;
}
function CardLimitedVote($Limittitle,$LimitDetail,$openDay,$closeDay,$openTime,$closeTime,$LimitImg,$profileCandi,$nameCandi,$groupCandi,$policyCandi,$departmentCandi,$typeNumber,$LimitTeacherName,$LimitTeacherImg,$numberPeplevote){
  $Limited = "
      <div class=\"card gedf-card\">
          <div class=\"card-header\">
              <div class=\"d-flex justify-content-between align-items-center\">
                  <div class=\"d-flex justify-content-between align-items-center\">
                      <div class=\"mr-2\">
                          <img class=\"rounded-circle\" width=\"45\" src=\"../config/data/admin-profile/$LimitTeacherImg\">
                      </div>
                      <div class=\"ml-2\">
                          <div class=\"h5 m-0\">$Limittitle</div>
                          <div class=\"h7 text-muted\">ผู้สร้างโหวต: $LimitTeacherName</div>
                      </div>
                  </div>
              </div>
          </div>
          <div class=\"card-body\">
              
              <div class=\"avt\">
                  <img src=\"../config/data/image-vote/$LimitImg\" class=\"image-vote\"/>
              </div>
              <div class=\"text-muted h7 mb-1 mt-1\">
                <span class=\"badge badge-primary\">dateon: $openDay</span>
                <span class=\"badge badge-danger\">dateoff: $closeDay $closeTime</span>
              </div>
              <a class=\"card-link\">
                  <textarea class=\"form-control mb-1 mt-1\" rows=\"5\" cols=\"30\"  disabled>$LimitDetail</textarea>
              </a>
              <div class=\"col-md-12\">
                <small class=\"text-center font-thi\">จำนวนคนโหวตทั้งหมด $numberPeplevote คน</small>
              </div>
          </div>
            <div class=\"border-right border-left border-top col-12\"><small class=\"text-center\">คนที่คุณเลื่อก</small></div>
          <div class=\"card-footer\">
            <div class=\"d-flex\">
              <div class=\"mr-2\">
                  <img class=\"rounded-circle\" width=\"40\" src=\"../config/data/candidate-profile/$profileCandi\">
              </div>
              <div class=\"ml-2\">
                <div class=\"h6 mt-2\">ชื่อ: $nameCandi</div>
              </div>
              <div class=\"ml-auto\">
                <div class=\"h7 text-info mt-2\">เบอร์: $typeNumber</div>
              </div>
            </div>
          </div>
      </div>
  ";
  echo $Limited;
}

function WinUserVote($ImgCandi,$CandiName,$Count,$Numberx,$Dpartment,$Titlex){
  $win = "
    <div class=\"card wizard-card Xcard\">
      <div class=\"d-flex justify-content-between align-items-center pr-2 pl-2\">
        <div class=\"mr-2\">
        <strong class=\"text-primary\">number one :</strong>
        </div>
        <div class=\"mr-2\">
            <img class=\"rounded-circle\" width=\"50\" src=\"../config/data/candidate-profile/$ImgCandi\">
        </div>
        <div class=\"mr-4\">
          <div class=\"h6 mt-2\">ชื่อ: $CandiName</div>
        </div>
        <div class=\"mr-4\">
          <div class=\"h6 text-info mt-2\">เบอร์: $Numberx</div>
        </div>
        <div class=\"mr-4\">
          <div class=\"h6 mt-2\">จำนวนคนโหวต: $Count คน</div>
        </div>
        <div class=\"mr-4\">
          <button type=\"button\" onclick=\"myCandidateLimited('$ImgCandi','$CandiName','$Count','$Numberx','$Dpartment','$Titlex')\" class=\"btnLimit\">detail</button>
        </div>
      </div>
    </div>
  ";
  echo $win;
}
function ListCandidateLimit($desc,$ImageCDD,$NameCDD,$TypenumberCDD,$CDDnumberVOTE,$titleCDD,$groupCDD){
  $List = "
      <tr>
        <td class=\"border-0 align-middle\"><strong>$desc</strong></td>
        <th scope=\"row\" class=\"border-0\">
          <div class=\"p-2\">
            <img src=\"../config/data/candidate-profile/$ImageCDD\" alt=\"\" width=\"45\" class=\"img-fluid rounded shadow-sm\">
            <div class=\"ml-3 d-inline-block align-middle\">
              <h5 class=\"mb-0\">
                <a href=\"#\" class=\"text-dark d-inline-block align-middle\">Name: $NameCDD</a>
              </h5>
              <span class=\"text-muted font-weight-normal font-italic d-block\">Category: $titleCDD</span>
            </div>
          </div>
        </th>
        <td class=\"border-0 align-middle\"><strong>$TypenumberCDD</strong></td>
        <td class=\"border-0 align-middle\"><strong>$CDDnumberVOTE</strong></td>
        <td class=\"border-0 align-middle\">
            <button type=\"button\" onclick=\"MyFunction('$NameCDD','$desc','$ImageCDD','$TypenumberCDD','$CDDnumberVOTE','$titleCDD','$groupCDD')\" class=\"btn btnLimited\">detail</button>
        </td>
      </tr>
      <tr>
  ";
  echo $List;
}

function chkImgUser($getImg){
    if(!$getImg){
        $imgValue = "<img src=\"https://image.ibb.co/f5Kehq/bio-image.jpg\" class=\"\">";
    }else{
        $imgValue = "<img src=\"../config/data/student-profile/$getImg\" class=\"\">";
    }
    return $imgValue;
}
function PortProfile($image, $fullname, $studentCode, $department, $password, $year_of_study, $sex, $age){
    $ProfileEl = "
        <div class=\"container portfolio\">
        	<div class=\"row\">
        		<div class=\"col-md-12\">
        			<div class=\"heading\">				
        				<img src=\"https://image.ibb.co/cbCMvA/logo.png\" />
        			</div>
        		</div>	
        	</div>
        	<div class=\"bio-info\">
        		<div class=\"row\">
        			<div class=\"col-md-4 mt-0\">
        				<div class=\"row\">
        					<div class=\"col-md-12 mt-0\">
        						<div class=\"bio-image mt-0\">
        							<img src=\"../config/data/student-profile/$image\" width=\"280\" height=\"280\" alt=\"image\" class='mt-0' />
        						</div>			
        					</div>
        				</div>	
        			</div>
        			<div class=\"col-md-8\">
        				<div class=\"bio-content mt-4\">
        					<h2>Name: $fullname</h2>
        					<h6 class=\"text-primary\">Student code : $studentCode</h6>
                  <h6 class=\"text-secondary\">department : $department</h6>
                  <h6 class=\"text-secondary\">ปีการศึกษา : $year_of_study</h6>
                  <h6 class='text-info'> เพศ : $sex อายุ : $age ปี</h6>
        					<p class=\"font-thi\">ระบบ นี้ ถูกออกแบบไว้สำหรับ ใช้ใน วิทยาลัยการอาชีพ ปัตตานี เท่านั้น</p>
        				</div>
        			</div>
        		</div>	
        	</div>
        </div>
    ";
    echo $ProfileEl;
}

?>

</body>
</html>