/* Set Input Password Class Event */
const EventResult = (resData)=>{
    if(resData.status === 404){
        Swal.fire({
          title: [resData.msg, resData.status],
          icon: "error",
          showConfirmButton: true,
        });
    }else if(resData.status === 200){
        let EventVoteId = resData.id
        let KeyEventVote = resData.key
        let TimeOff = resData.offTime
        let DateOff = resData.dateoff
          Swal.fire({
            icon: "success",
            title: resData.title,
            text: "รหัสผ่านถูกต้อง",
            confirmButtonText:`ตกลง`,
          }).then(fuckking =>{
              if(fuckking.isConfirmed){
                  window.location = `getEvent.php?IdVoteEvent=${EventVoteId}&KeyClassEvent=${KeyEventVote}&offTime=${TimeOff}&OffDate=${DateOff}`;
              }
          })
    }
} 
const ConfirmKeyEventVote =(GetIdVote,KeyEvent)=>{
    Swal.fire({
      title: "ป้อนรหัสผ่าน",
      html: `
            <input type="hidden" id="voteID" class="swal2-input" value=${GetIdVote}>
            <input type="text" id="Keys" class="swal2-input" placeholder="Password Class">
            `,
      inputAttributes: {
        autocapitalize: "off",
      },
      confirmButtonText: "กดยืนยัน",
      showLoaderOnConfirm: true,
      preConfirm: () => {
        const IdVote = Swal.getPopup().querySelector("#voteID").value;
        const PasswdClass = Swal.getPopup().querySelector("#Keys").value;
        if (!IdVote || !PasswdClass) {
          Swal.showValidationMessage(`กรุณาป้อน รหัสผ่านห้อง`);
        }
        return { GetIdVote: IdVote, GetKeyClass: PasswdClass };
      },
      allowOutsideClick: () => !Swal.isLoading(),
    }).then((getQuery) => {
      fetch("backend/check_keyClass.php", {
        method: "POST",
        body: JSON.stringify({
          ID: getQuery.value.GetIdVote,
          KEYS: getQuery.value.GetKeyClass,
          DATEON: getQuery.value.GetOnDate,
          DATEOFF:getQuery.value.GetOffDate
        }),
        headers: {
          "Content-Type": "application/json; charset=UTF-8",
        },
      })
        .then((res) => res.json())
        .then((resDatas) => EventResult(resDatas))
        .catch((ERRORS) => console.log(ERRORS));
    });
}//End Set


const ListNotifycation = ListData=>{
  let createNode = (elemant) => {
    return document.createElement(elemant);
  };
  let append = function (parent, el) {
    return parent.appendChild(el);
  };
  let setDate = (Datadate,DataOffTime,eventStatus,eventAbout)=>{
    let dates = new Date(),
      setTime = dates.toLocaleTimeString(),
      replaceDate = dates.toLocaleDateString('fr-ca') /* dates.toISOString().slice(0, 10).replace(/-/g, "-"); */
      
        if (replaceDate < Datadate) {
          eventStatus.className = "media-meta pull-left xx1";
          eventAbout.className = "xx1";
          eventStatus.innerHTML = "ยังไม่หมดเวลา";
          eventAbout.innerHTML = `มันยังไม่หมดเวลา อยากดเข้านะ ไม่งั้นจะโดนด่า เตือนแล้วนะ`;
          return [eventStatus, eventAbout];
        } else if (replaceDate > Datadate) {
          eventStatus.className = "media-meta pull-left xx2";
          eventAbout.className = "xx2";
          eventStatus.innerHTML = "หมดเวลาแล้ว";
          eventAbout.innerHTML = `เมื่อหมดเวลาแล้ว คุณสามารถเข้าไปดูรายการผลโหวตได้เลย`;
          return [eventAbout, eventStatus];
        } else if (replaceDate == Datadate) {
          if (setTime < DataOffTime) {
            eventStatus.className = "media-meta pull-left xx1";
            eventAbout.className = "xx1";
            eventStatus.innerHTML = "ยังไม่หมดเวลา";
            eventAbout.innerHTML = `มันยังไม่หมดเวลา อยากดเข้านะ ไม่งั้นจะโดนด่า เตือนแล้วนะ `;
            return [eventAbout, eventStatus];
          } else {
            eventStatus.className = "media-meta pull-left xx2";
            eventAbout.className = "xx2";
            eventStatus.innerHTML = "หมดเวลาแล้ว";
            eventAbout.innerHTML = `เมื่อหมดเวลาแล้ว คุณสามารถเข้าไปดูรายการผลโหวตได้เลย`
            return [eventStatus, eventAbout];
          }
        }
  }

  return ListData.map(_getDataAlert =>{

    let tr = createNode('tr'),td = createNode('tr'),Alink = createNode('a'),about = createNode('small'),
      media = createNode('div'),pullLeft = createNode('div'),image = createNode('img'),medaiBody = createNode('div'),status = createNode('span')
      spanDate = createNode('span'),h4 = createNode('h4'),spanTrue = createNode('span'),summary = createNode('p'),Felx = createNode('div')

  /* Add Style */
      Alink.className = "nav-link";
      media.className = "media";
      pullLeft.className = "pull-left";
      image.className = "media-photo";
      medaiBody.className = "media-body ml-4";
      spanDate.className = "media-meta pull-right";
      status.className = "media-meta pull-left xx2";
      h4.className = "title";
      spanTrue.className = "pull-right pagado";
      summary.className = "summary mb-0";
      Felx.className = "d-flex"

  /* get Data */
      image.src = `../config/data/image-vote/${_getDataAlert.image}`;
      spanDate.innerHTML = `จะแสดงผลโหวตเวลา : ${_getDataAlert.close_date} ${_getDataAlert.close_time}`
      h4.innerHTML = _getDataAlert.subtitle
      spanTrue.innerHTML = "(Pagado)";
      summary.innerHTML = `รายชื่อที่คุณโหวต ${_getDataAlert.fullname}`
      setDate(_getDataAlert.close_date,_getDataAlert.close_time,status,about)
      Alink.setAttribute('href',`notification.php?getidvote_collection=${_getDataAlert.get_id}&closeDate=${_getDataAlert.close_date}&closeTime=${_getDataAlert.close_time}&setIDvote=${_getDataAlert.id_vote}`)

  /* Append */
      append(tr,td)
      append(td,Alink)
      append(Alink,media)
       append(media,pullLeft)
        append(pullLeft,image)
       append(media,medaiBody)
        append(medaiBody,Felx)
        append(Felx,spanDate)
        append(Felx,status)
        append(medaiBody,h4)
         append(h4,spanTrue)
        append(medaiBody,summary)
        append(medaiBody,about)
      append(document.getElementById("datanotifycation"),tr);
          let dates = new Date(),
            setTime = dates.toLocaleTimeString(),
            replaceDate = dates.toISOString().slice(0, 10).replace(/-/g, "-");
          console.log(setTime)
  })
}

const FetchDataNotifycation = (getApiUrl,EventNotifycation)=>{
  try{
    fetch(getApiUrl, {
      method: "GET",
      headers: {
        "Content-Type": "application/json; charset=UTF-8",
      },
    })
     .then(res => res.json())
     .then(dataFetch => EventNotifycation(dataFetch))
     .catch(err => console.log("error :" + err))
  }catch(e){
    console.log("try :" + e)
  }
}
FetchDataNotifycation(`backend/data.notifycation.php`,ListNotifycation)

/* '$ImgCandi','$CandiName','$Count','$Numberx','$Dpartment','$Titlex' */
const myCandidateLimited = (ImgCandi,CandiName,CountSet,CandiNumber,Departments,Titlex)=>{
  Swal.fire({
    title: CandiName,
    width: 600,
    padding: "3em", 
    background: "#fff url(https://sweetalert2.github.io/images/trees.png)",
    backdrop: `
      rgba(0,0,123,0.4)
      url("https://sweetalert2.github.io/images/nyan-cat.gif")
      left top
      no-repeat
    `,
    html: `
      <div class="d-block">
        <img src="../config/data/candidate-profile/${ImgCandi}" class="image-alert" /><br><br>
        <small class="text-info">แผนก : ${Departments}</small>
        <small class="text-danger">เบอร์ : ${CandiNumber}</small>
        <small class="text-success">อันดับ : 1</small>
        <br><small class="text-primary">จำนวนคนโหวต : ${CountSet} คน</small><br>
        <h6 class="text-secondary">กลุ่ม/พรรค์ : ${Titlex}</h6>
      </div>`,
  });
}

const MyFunction = (nameCDD,dsce,imageCDD,numberCDD,CDDnumber,CDDtitle,groupCDD)=>{
  Swal.fire({
    title: `name: ${nameCDD}`,
    html: `
      <div class="d-block">
        <img src="../config/data/candidate-profile/${imageCDD}" class="image-alert" /><br><br>
        <small class="text-info">แผนก : ${CDDtitle}</small>
        <small class="text-danger">เบอร์ : ${numberCDD}</small>
        <small class="text-success">อันดับ : ${dsce}</small>
        <br><small class="text-primary">จำนวนคนโหวต : ${CDDnumber} คน</small><br>
        <h6 class="text-secondary">กลุ่ม/พรรค์ : ${groupCDD}</h6>
      </div>`,
  });
} 

class ModalViews extends HTMLElement {
  connectedCallback() {
    this.renDerView();
  }
  renDerView(){
    this.innerHTML = `
      <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <p class="modal-title">Profile Candidate</p>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="row col-md-12">
                      <div class="col-md-4">
                        <div class="wrapper">
                          <div class="image">
                             <img src="" alt="" class="getpriviewImgCandi"> 
                          </div>
                        </div>
                      </div>
                      <div class="col-md-8">
                       <div class="row">
                        <h4 class="text-center txt-purper">Fullname : <span id="nameCandi"></span></h4>
                        <p class="text-info ml-auto mt-1">เบอร์ : <span id="numberCandi"></span></p>
                       </div>
                       <div class="row">
                        <small class="text-success">group : <span id="titleCandi"></span></small>
                        <small class="text-warning ml-4">department : <span id="departmentCandi"></span></small>
                       </div>
                       <div class="d-slicd mt-2">
                          <p class="t-txt mb-0">วิสัยทัศน์ :</p>
                          <small class="mt-0 txt-geen" id="contentCandi"></small>
                       </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  </div>
              </div>
          </div>
      </div>
    `;
  }
}
customElements.define('main-view-candidate',ModalViews)

$(document).on('click','#maxOurtime', function(evt){
    let names = $(this).data('name'),images = $(this).data('img'),titles = $(this).data('title'),
      contents = $(this).data('content'),departments = $(this).data('department'),numbers = $(this).data('number');

    $('#nameCandi').html(names)
    $('#titleCandi').html(titles)
    $('#contentCandi').html(contents)
    $('#departmentCandi').html(departments)
    $('#numberCandi').html(numbers)
    $(".getpriviewImgCandi").attr('src',`../config/data/candidate-profile/${images}`)

  evt.preventDefault()
})