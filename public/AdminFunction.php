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

  function chkImgAdmin($getImg){
      if(!$getImg){
          $imgValue = "<img src=\"https://image.ibb.co/f5Kehq/bio-image.jpg\" class=\"\">";
      }else{
          $imgValue = "<img src=\"../config/data/admin-profile/$getImg\" class=\"\">";
      }
      return $imgValue;
  } 
  function Status($getStatus){
      if($getStatus == "Zeroadmin"){
          $responseStatus = "
              <li class=\"nav-item \">
                  <a class=\"nav-link text-center\" href=\"getTeacher.php\">
                      <i class=\"fas fa-chalkboard-teacher text-primary\"></i> Teacher
                  </a>
              </li>
          ";
      }else{
          $responseStatus = "";
      }
      return $responseStatus;
  }
  function Navigation($fullname, $img, $status)
  {
      $el = "
          <nav class=\"navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-x\" id=\"sidenav-main\">
              <div class=\"container-fluid\">
                  <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#sidenav-collapse-main\" aria-controls=\"sidenav-main\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                      <span class=\"navbar-toggler-icon\"></span>
                  </button>
                  <a class=\"navbar-brand pt-0 text-primary\" target=\"_blank\">
                      Admin Page
                  </a>
   
                  <div class=\"collapse navbar-collapse\" id=\"sidenav-collapse-main\">
                      <div class=\"avartar\">
                          ".chkImgAdmin($img)."
                          <h3 class=\"txt text-center mt-2\">$fullname</h3>
                      </div>
                      <hr>
                      <ul class=\"navbar-nav\">
                          <li class=\"nav-item\">
                              <a class=\"nav-link text-center\" href=\"index.php\">
                                  <i class=\"ni ni-tv-2 text-primary\"></i> Dashboard(index)
                              </a>
                          </li>
                          <li class=\"nav-item\">
                              <a class=\"nav-link text-center\" href=\"getEvent.php\">
                                  <i class=\"far fa-calendar-check text-primary\"></i> GetAllEvent
                              </a>
                          </li>
                          <li class=\"nav-item\">
                              <a class=\"nav-link text-center\" href=\"getStudent.php\">
                                  <i class=\"fas fa-user-graduate text-primary\"></i> Student
                              </a>
                          </li>
                          ".Status($status)."
                          <li class=\"nav-item \">
                              <a class=\"nav-link text-center\" href=\"profile.php\">
                                  <i class=\"far fa-user-circle text-primary\"></i> Profile
                              </a>
                          </li>
                          <li class=\"nav-item \">
                              <a class=\"nav-link text-center\" href=\"#\">
                                  <i class=\"fas fa-info-circle text-primary\"></i> Help
                              </a>
                          </li>
                      </ul>
                  </div>
              </div>
          </nav>
      ";
      echo $el;
  };

  function CounterCard($getEvent,$getStudent,$getTeacher,$getEventAll)
  {
      $elCounter = "
  
      <div class=\"col-md-3\">
        <div class=\"card-counter purple\">
          <i class=\"fas fa-list-alt\"></i>
          <span class=\"count-numbers\">$getEventAll</span>
          <span class=\"count-name\">All Events</span>
        </div>
      </div>
  
      <div class=\"col-md-3\">
        <div class=\"card-counter danger\">
          <i class=\"fas fa-chalkboard-teacher\"></i>
          <span class=\"count-numbers\">$getTeacher</span>
          <span class=\"count-name\">Teacher</span>
        </div>
      </div>
  
      <div class=\"col-md-3\">
        <div class=\"card-counter success\">
          <i class=\"fas fa-chart-line\"></i>
          <span class=\"count-numbers\">$getEvent</span>
          <span class=\"count-name\">Event Me</span>
        </div>
      </div>
  
      <div class=\"col-md-3\">
        <div class=\"card-counter info\">
          <i class=\"fa fa-users\"></i>
          <span class=\"count-numbers\">$getStudent</span>
          <span class=\"count-name\">Students</span>
        </div>
      </div>
      
      ";
      echo $elCounter;
  }

  function CheckClassStatus($keyStatus,$Idvote){
      if($keyStatus == "open"){
          $setStatus = "
              <a href=\"addCandidate.php?getID=$Idvote&&keys=$keyStatus\" class=\"btn btn-sm btn-outline-success\">
                  <i class=\"fas fa-lock-open\"></i> enter views
              </a>
          ";
      }else{
          $setStatus = "
              <a onclick=\"ConfirmKeyLog($Idvote,$keyStatus)\" class=\"btn btn-sm btn-outline-danger\">
                  <i class=\"fas fa-lock\"></i> enter keys
              </a>
          ";
      }
      return $setStatus;
  }

  /* get counter vote event to dashbord page*/
  function EventCounter($getNumberCandydate,$getImgVote,$getheaderEvent,$getkeyStatus,$getIdvote,$setVoteNumber){
      $EvtCounter = "
          <div class=\"col-md-6 mt-2\">
              <div class=\"card xart-xounter\">
                  <div class=\"col-md-12 row d-img\">
                      <div class=\"col-md-3 col-img\">
                          <img class=\"img-vote mr-0\" height=\"110\" width=\"100%\" alt=\"Independence Day\" src=\"../config/data/image-vote/$getImgVote \" />
                      </div>
                      <div class=\"col-md-9\">
                        <h4 class=\"ml-3 mt-2\">หัวข้อ: $getheaderEvent</h4>
                          <div class=\"ml-3 row\">
                            <p class=\"mr-3 text-purple font-thi\">ตัวเลื่อก/ผู้สมัค: $getNumberCandydate คน</p>
                            <p class=\"ml-3 text-info font-thi\">โหวตแล้ว: $setVoteNumber คน</p>
                          </div>
                          <div class=\"ml-3 row\">
                              <div class=\"mr-4\">
                                  ".CheckClassStatus($getkeyStatus,$getIdvote)."
                              </div>
                              <div class=\"ml-auto\">
                                <a class=\"btn btn-sm btn-outline-primary\" href=\"notifycation.php?result_voteId=$getIdvote\">
                                   รายการ ผลโหวต
                                </a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      ";
      echo $EvtCounter;
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
                <a href=\"#\" class=\"text-dark d-inline-block align-middle\">ชื่อ: $NameCDD</a>
              </h5>
              <span class=\"text-muted font-weight-normal font-italic d-block\">แผนก: $titleCDD</span>
            </div>
          </div>
        </th>
        <td class=\"border-0 align-middle\"><strong>$TypenumberCDD</strong></td>
        <td class=\"border-0 align-middle\"><strong>$CDDnumberVOTE</strong></td>
        <td class=\"border-0 align-middle\">
            <button type=\"button\" onclick=\"MyFunction('$NameCDD','$desc','$ImageCDD','$TypenumberCDD','$CDDnumberVOTE','$titleCDD','$groupCDD')\" class=\"btnLimit\">detail</button>
        </td>
      </tr>
      <tr>
  ";
  echo $List;
}

  function CheckImg($img){
      if($img == "none"){
          $prop= "<img src=\"../config/data/image-vote/none.jpg\" height=\"180\" width=\"350\" class=\"img-responsive\" alt=\"a\" />";
      }else{
          $prop="<img src=\"../config/data/image-vote/$img\" height=\"180\" width=\"350\" class=\"img-responsive\" alt=\"a\" />";
      }
      return $prop;
  }
  function CheckStatus($onday,$ofday,$ontime,$offtime){
      date_default_timezone_set("Asia/Bangkok");
      $currenday = date("Y-m-d");
      $currentime = date("H:i");
      //Check Status date
        if($onday > $currenday){
           if($ontime > $currentime){
               $rabbit="<div class=\"ribbon\"><span class=\"off-span\">ยังไม่ได้เปิด1</span></div>";
           }else{
               $rabbit="<div class=\"ribbon\"><span class=\"off-span\">ยังไม่ได้เปิด2</span></div>";
           }
        }else if($ofday < $currenday){
            if($currentime > $ontime || $currentime < $ontime){
                $rabbit="<div class=\"ribbon\"><span class=\"off-span\">หมดเวลาแล้ว1</span></div>";
            }else{
                $rabbit="<div class=\"ribbon\"><span class=\"off-span\">หมดเวลาแล้ว2</span></div>";
            }
        }else if($ofday == $currenday){
          
              if($currentime > $ontime AND $currentime < $offtime){
                  $rabbit="<div class=\"ribbon\"><span class=\"on-span\">ยังไม่หมดเวลา1</span></div>";
              }else if($currentime > $offtime){
                  $rabbit="<div class=\"ribbon\"><span class=\"off-span\">หมดเวลาแล้ว3</span></div>";
              }else if( $currentime < $ontime){
                  $rabbit="<div class=\"ribbon\"><span class=\"off-span\">ยังไม่ได้เปิดxx</span></div>";
              }
        }else if($ofday == $currenday AND $currentime < $ontime){
            $rabbit="<div class=\"ribbon\"><span class=\"off-span\">ยังไม่ได้เปิด4</span></div>";
        }else if($ofday > $currenday){
            $rabbit="<div class=\"ribbon\"><span class=\"on-span\">ยังไม่หมดเวลา2</span></div>";
        }      
      return $rabbit;
  }
  function IconCheck($icon){
      if($icon == "open"){
          $getIcon = "<i class=\"ml-auto fas fa-lock-open text-success\"></i>";
      }else{
          $getIcon = "<i class=\"ml-auto fas fa-key text-danger\"></i>";
      }
      return $getIcon;
  } 
  
  /* check opent to class vote */
  function LinkCheckKey($key,$voteid){
      if($key == "open"){
          $getKey = "
               <i class=\"fas fa-coins\"></i>
               <a class=\"hidden-sm\" href=\"addCandidate.php?getID=$voteid&&keys=$key\">enter view</a>
              ";
      }else{
          $getKey = "
              <i class=\"fas fa-key\"></i>
              <a class=\"hidden-sm\" onclick=\"ConfirmKeyLog($voteid,$key)\">enter key view</a>
          ";
      }
      return $getKey;
  }
  /* function cart Event vote */
  function CartEvent($getID,$subTitle,$subContent,$dateOn,$dateOff,$timeOn,$timeOff,$image,$classKey){
      $ElEventCart = "
          <div class=\"col-md-4 mt-2\">
              <div class=\"col-item\">
                  <div class=\"photo\">
                    <div class=\"product-grid6\">
                      <div class=\"product-image6\">
                        <div class=\"preview-pic tab-content\">
  	  	    	        <div class=\"tab-pane active\" id=\"pic-1\">
                            <div class=\"product-image6\">
                              ".CheckImg($image)."
                            </div>
                          </div>
                          ".CheckStatus($dateOn,$dateOff,$timeOn,$timeOff)."
                        </div>
                      </div>  
                    </div>
                  </div>
                  <div class=\"info\">
                      <div class=\"row\">
                          <div class=\"price col-md-12\">
                              <div class=\"d-flex\">
                               <h5 class=\"mr-auto\">$subTitle</h5>
                               ".IconCheck($classKey)."
                              </div>
                              <div class=\"d-flex x-forex\">
                               <small class=\"mr-auto text-info\">วันเปิดโหวต:$dateOn</small>
                               <small class=\"ml-2 text-success\">$timeOn</small>
                              </div>
                              <div class=\"d-flex x-forex\">
                               <small class=\"mr-auto text-danger\">วันปิดโหวต:$dateOff</small>
                               <small class=\"ml-2 text-warning\">$timeOff</small>
                              </div>
                          </div>
                      </div>
                      <div class=\"separator clear-left mt-2\">
                         <p class=\"btn-add\">
                           ".LinkCheckKey($classKey,$getID)."
                         </p>
                      </div>
                      <div class=\"clearfix\">
                      </div>
                  </div>
              </div>
          </div>
      ";
      echo $ElEventCart;
  }

  /* Page AddCandidate */
  function theCreateBtnStatus($id_the_create_vote,$session_id_admin,$vote_id,$sub_ject,$sub_content,$on_date,$off_date,$on_time,$off_time,$vote_img,$kay_class,$admin_zero){
        if($id_the_create_vote == $session_id_admin || $admin_zero == "Zeroadmin"){
            $resultBtn = "
                <button id=\"modaladdcondyDate\" class=\"b-font btn btn-primary btn-sm mr-3\" data-id=\"$vote_id\" data-toggle=\"modal\" data-target=\"#exampleModal\">
                    <i class=\"fas fa-user-plus\"></i> Add Candydate
                 </button>
                 <button id=\"ModalUpdateVote\" class=\"b-font btn btn-warning btn-sm mr-2\" data-toggle=\"modal\" data-target=\"#exampleModalUpdate\"
                  data-id=\"$vote_id\" data-subject=\"$sub_ject\" data-content=\"$sub_content\" data-onday=\"$on_date\" data-ontime=\"$on_time\" data-offday=\"$off_date\" data-offtime=\"$off_time\" data-image=\"$vote_img\" data-key=\"$kay_class\">
                   <i class=\"fas fa-cogs\"></i> Update
                 </button>
                 <a href=\"backend/editGetEvent.php?idvoteEvent=".$vote_id."&imageVote=".$vote_img."&statusEvn=".'Delete'." \" class=\"btn btn-danger btn-sm\">
                   <i class=\"fas fa-trash-alt mt-2\"></i> Delete
                 </a>
            ";
        }else{
            $resultBtn = "
                <button class=\"b-font btn btn-outline-warning font-thi btn-sm mr-3\" disabled>
                    <span class='text-dark'>เจ้าของ event กับ admin สูงสุดเท่านั้น ที่สามารถแก้ไข event นี้ได้ อย่าสะเออะ</span>
                 </button>
            ";
        }
        return $resultBtn;
  }
  function showKey($chkKey){
     if($chkKey == "open"){
         $Echo = "ไม่มี(open) <i class=\"fas fa-lock-open text-success\"></i>";
     }else{
         $Echo = $chkKey ."&nbsp; <i class=\"fas fa-key text-danger\"></i>";
     }
     return $Echo;
  }
  
  function getCardTitle($Id,$subJect,$subContent,$onDate,$offDate,$onTime,$offTime,$Img,$keyClass,$theAdminCreateVote,$sessionIdAdminFn,$zeroAdmin){
      date_default_timezone_set("Asia/Bangkok");
      $currentDay = date("Y-m-d");
      $currentTime = date("H:i:s");  
      $ElTitle = "
          <div class=\"col-md-12 mt-2\">
  		    <div class=\"wizard-container\">
                  <div class=\"card Xcard wizard-card\" data-color=\"red\" id=\"wizard\">
                    <div class=\"d-flex\">
                      <div class=\"avartarx\">
                          ".CheckImg($Img)."
                      </div>
                      <div class=\"ml-2 col-md-9\">
                        <div class=\"d-flex\" style=\"margin:0 0 0 0;\">
                          <h3 class=\"txt mr-auto\">TiTle : $subJect</h3>
                          <p class=\"ml-auto t-txt\">
                             CurrentDate: $currentDay <i id=\"clock\"></i>
                          </p>
                        </div>
                          <textarea class=\"form-control mb-1\" rows=\"3\" cols=\"30\"  disabled>$subContent</textarea>
                        <div class=\"d-flex\">
                          <p class=\"text-success font-thi mr-auto\">วันที่เปิดโหวต: $onDate เวลา: $onTime</p>
                          <p class=\"text-danger font-thi ml-auto\">วันที่ปิดโหวต : $offDate เวลา: $offTime</p>
                        </div>
                        <div class=\"d-flex\">
                          <p class=\"text-dark font-thi\">รหัสห้อง: ".showKey($keyClass)."</p>
                          <div class=\"d-flex ml-auto\">
                             ".theCreateBtnStatus($theAdminCreateVote,$sessionIdAdminFn,$Id,$subJect,$subContent,$onDate,$offDate,$onTime,$offTime,$Img,$keyClass,$zeroAdmin)."
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
          </div>
      ";
      echo $ElTitle;
  }
  /* Function getCandydate */
  function GetCandydate($num,$ImageCandydate,$candydateFullname,$title,$subContents,$deparmentCandydate,$cnadydateNumber,$typeIdvote,$setcandidateId){
      $ElCandy = "
          <div class=\"col-xl-3 col-md-6 col-12 mb-4 ourteam\">
              <div class=\"card candyCard text-center rounded-0 border-0\">
                  <div class=\"hex-img mt-1 mb-4\">
                       <svg viewBox=\"0 0 100 100\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\">
                          <defs>
                              <pattern id=\"img-[$cnadydateNumber]\" patternUnits=\"userSpaceOnUse\" width=\"100\" height=\"100\">
                                  <image xlink:href=\"../config/data/candidate-profile/$ImageCandydate\" x=\"-25\" width=\"150\" height=\"100\" />
                              </pattern>
                          </defs>
                          <polygon points=\"50 1 95 25 95 75 50 99 5 75 5 25\" fill=\"url(#img-[$cnadydateNumber] )\" />
                      </svg> 
                  </div>
                  <h4 class=\"card-name\">$candydateFullname</h4>
                  <p class=\"position mb-0\">$title</p>
                  <div class=\"\">
                    <small class=\"number xnum mt-0 text-chartreuse\">แผนก:$deparmentCandydate</small>
                    <small class=\"number xnum mt-0 text-purple\">เบอร์:$cnadydateNumber</small>
                  </div>
                  <div class=\"d-flex mb-1 mt-3 justify-content-center\">
                      <div class=\"col-5\">
                          <a href=\"#myModalUpdateCandidate\" data-toggle=\"modal\" id=\"myUpdateCandi\" class=\"btn btn-sm btn-outline-warning\" data-candisetid=\"$setcandidateId\" data-typeidvote=\"$typeIdvote\"
                            data-imgcandi=\"$ImageCandydate\" data-fullname=\"$candydateFullname\" data-candititle=\"$title\" data-candicontent=\"$subContents\" data-departmentcandi=\"$deparmentCandydate\" data-candinameber=\"$cnadydateNumber\"
                           >
                              <i class=\"fas fa-edit\"></i>
                              <small>Update</small>
                          </a>
                      </div>
                      <div class=\"col-5\">
                          <a href=\"backend/editCandidate.php?CandidateId=".$setcandidateId."&Status=".'delete'."&typeIDvote=".$typeIdvote."&imgCandidate=".$ImageCandydate." \" class=\"btn btn-sm btn-outline-danger\">
                              <i class=\"far fa-trash-alt\"></i>
                              <small>Delete</small>
                          </a>
                      </div>
                  </div>
              </div>
          </div>
      ";
      echo $ElCandy;
  }

  /* Page GetStudent */
  function chkImgStd($ChkImg,$ChkSex){
      if($ChkImg == "no"){
          if($ChkSex == 1){
            $result ="
              <img src=\"../config/data/student-profile/man.jpg\" 
                class=\"avatar avtx\" alt=\"Avatar\"
              > 
            ";
          }elseif($ChkSex == 2){
            $result = "
              <img src=\"../config/data/student-profile/woman.jpg\" 
                class=\"avatar avtx\" alt=\"Avatar\"
              > 
            ";
          }
      }else{
          $result = "
              <img src=\"../config/data/student-profile/$ChkImg\" 
                class=\"avatar avtx\" alt=\"Avatar\"
              > 
          ";
      }
      return $result;
  }
  function chkDepartment($Rquement,$yfstd){
      switch($Rquement){
          case "it":
            $s= "เทคโนโลยีสารสนเทศ ($yfstd)";
            break;
          case "dataSci":
            $s = "วิทยาศาสตร์ข้อมูล ($yfstd)";
            break;
          case "accounting":
            $s ="บัญชี ($yfstd)";
            break;
          case "Food and nutrition":
            $s = "อาหารและโภชนาการ ($yfstd)";
            break;
          case "Business foreign languages":
            $s = "ภาษาต่างประเทศธุรกิจ ($yfstd)";
            break;
         case "Medical electronics":
            $s = "อิเล็กทรอนิกส์การแพทย์ ($yfstd)";
            break;
         case "Beauty business":
            $s = "ธุรกิจความงาม ($yfstd)";
            break;
         case "Fashion technology and appare":
            $s = "เทคโนโลยีแฟชั่นและเครื่องแต่งกาย ($yfstd)";
            break;
         case "Business computer":
            $s = "คอมพิวเตอร์ธุรกิจ ($yfstd)";
            break;
         case "Electronic technician":
            $s = "ช่างอิเล็กทรอนิกส์ ($yfstd)";
            break;
         case "Mechanic":
            $s = "ช่างยนต์ ($yfstd)";
            break;
         case "Factory mechanic":
            $s = "ช่างกลโรงงาน ($yfstd)";
            break;
         case "Electrician":
            $s = "ช่างไฟฟ้ากำลัง ($yfstd)";
            break;
          default:
            $s = $Rquement;
      }
      return $s;
  }
  function chkSex($prmt){
      if($prmt == 1){
          $r = "<span class='font-thi'><i class=\"fas fa-male text-info\"></i> เพศชาย</span>";
      }elseif($prmt == 2){
          $r = "<span class='font-thi'><i class=\"fas fa-female text-warning\"></i> เพศหญิง</span>";
      }
      return $r;
  }
  
  function getTableStudent($Keys,$sImg,$stdCode,$fullName,$department,$YearOfStudy,$Sex,$Age,$stdId,$passwdStd){
     
      $elTable = "
          <tr>
              <td>$Keys</td>
              <td>
                  <a href=\"#\" class=\"d-flex\">
                      ".chkImgStd($sImg,$Sex)."
                      <div class=\"d-block\" style=\"width:200px\">
                        <span class=\"txtstdname mt-2\">$fullName</span>
                      </div>
                  </a>
              </td>
              <td class=\"\">
                <div class=\"d-block\" style=\"width:200px\">
                    <span class=\"txtstdname-2 font-thi\">
                        ".chkDepartment($department,$YearOfStudy)."
                    </span>
                </div>
              </td>                        
              <td>$stdCode</td>
              <td> 
                  ".chkSex($Sex)."
              </td>
              <td>$Age ปี</td>
              <td>
                  <a href='backend/editStudents.php?std_id=".$stdId."&status=".'delete'."&imageStudent=".$sImg." ' class=\"delete\" title=\"Settings\" data-toggle=\"tooltip\">
                      <i class=\"far fa-trash-alt\">&#xE8B8;</i>
                  </a>
                  <a href=\"#formUpdateStudent\" role=\"button\" class=\"text-warning \" id=\"modalupdateStd\"
                   data-toggle=\"modal\" data-tyid=\"$stdId\" data-image=\"$sImg\" data-name=\"$fullName\" data-password=\"$passwdStd\"
                     data-code=\"$stdCode\" data-department=\"$department\" data-yfstd=\"$YearOfStudy\" data-sex=\"$Sex\" data-age=\"$Age\"
                  >
                      <i class=\"far fa-edit\">&#xE8B8;</i>
                  </a>
              </td>
          </tr>
      ";
      echo $elTable;
  }

  /* Table Show data Teacher */
  function GetTableTeacher($numbers,$teacherName,$imageTeacher,$codeTeacher,$departmentTeacher,$teacherPosition,$teacherId,$passwordTeacher){
      $tableTeacher = "
          <tr>
              <td>$numbers</td>
              <td>
                  <a href=\"#\">
                      <img src=\"../config/data/admin-profile/$imageTeacher\" 
                        class=\"avatar avtx\" alt=\"Avatar\"
                      >
                      $teacherName
                  </a>
              </td>
              <td>$departmentTeacher</td>                        
              <td>$codeTeacher</td>
              <td>$teacherPosition</td>
              <td>
                  <a href='backend/editTeacher.php?TeacherId=".$teacherId."&status=".'delete'."&imageTeacher=".$imageTeacher." ' class=\"delete\" title=\"delete\" data-toggle=\"tooltip\">
                      <i class=\"far fa-trash-alt\">&#xE8B8;</i>
                  </a>
                  <a href=\"#formUpdateDataTeacher\" role=\"button\" class=\"text-warning \" id=\"setUpdatedata\" data-toggle=\"modal\" type=\"click\" data-password=\"$passwordTeacher\"
                    data-id=\"$teacherId\" data-name=\"$teacherName\" data-image=\"$imageTeacher\" data-code=\"$codeTeacher\" data-department=\"$departmentTeacher\" data-position=\"$teacherPosition\"
                  >
                      <i class=\"far fa-edit\">&#xE8B8;</i>
                  </a>
              </td>
          </tr>
      ";
      echo $tableTeacher;
  }

/* Profile Page */
  function PortProfile($meId,$image, $fullname, $adminCode, $department, $position, $password){
      $ProfileEl = "
          <div class=\"container portfolio\">
          	<div class=\"bio-info\">
          		<div class=\"row\">
          			<div class=\"col-md-6\">
          				<div class=\"row\">
          					<div class=\"col-md-12\">
          						<div class=\"bio-image\">
                                      ".chkImgAdmin($image)."
          						</div>			
          					</div>
          				</div>	
          			</div>
          			<div class=\"col-md-6\">
          				<div class=\"bio-content mt-4\">
          					<h3 class=\"text-purple \">Full Name : $fullname</h3>
                              <h4 class=\"text-secondary mt-2\">TeacherCode : $adminCode</h4>
                              <h4 class=\"text-warning mt-2\">Department : $department</h4>
                              <h4 class=\"text-warning mt-2\">Position : $position</h4>
                              <a onclick=\"mypasswordReset('$password','$meId')\" class=\"text-primary mt-2\">Reset PassWord <i class=\"fas fa-key\"></i></a>
                              <div class='col-12 mt-2'></div>
                              <button class=\"btn btn-outline-info\" id=\"setUpdateProfileMe\" data-toggle=\"modal\" data-target=\"#updateModalProfile\"
                                data-id=\"$meId\" data-name=\"$fullname\" data-code=\"$adminCode\" data-image=\"$image\" data-department=\"$department\" data-position=\"$position\"
                              >
                                  <i class=\"fas fa-users-cog\"></i> update profile
                              </button>
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