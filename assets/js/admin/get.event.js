

class ModalCreateEvent extends HTMLElement {
  connectedCallback() {
    this.render();
  }
  render() {
    this.innerHTML = `
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-login" role="document">
            <div class="modal-content">
              <div class="modal-header mb-0">
                <h3 class="modal-title" id="exampleModalLabel">Create Event Vote</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="container" action="backend/chk_add_event.php" method="POST" enctype="multipart/form-data">
                    <main-add-img></main-add-img>
                    <input type="hidden" id="adminCreateVote" name="admincreatevote" />
                  <div>
                    <label class="ml-2 mb-1 font-weight-bold text-primary">ชื่อหัวข้อรายการโหวต</label>
                    <div class="form-group">
					          	<i class="fas fa-award m-fa-award"></i>
					          	<input type="text" name="event_subject" class="form-control" placeholder="subject event vote" required>
                    </div>
                  </div>
                  <div class="d-flex">
                    <div class="form-group col-md-6">
                    <label class="ml-0 mb-1 font-weight-bold text-info">เวลาเปิด</label>
                      <div class="row">
                        <input id= "date" name="open_date" class="form-control input-group-sm col-6" type ="date" placeholder="What do you need done today?"  required>
                        <input type = "time" name="open_time" class="ml-2 form-control input-group-sm col-4" value="08:00" id="time" placeholder="What do you need done today?">
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                    <label class="ml-0 mb-1 font-weight-bold text-danger">เวลาปิด</label>
                      <div class="row">
                        <input id = "date" name="close_date" class="form-control col-6" type ="date"placeholder = "What do you need done today?" required>
                        <input type = "time" name="close_time" class=" ml-2 form-control col-4" value="08:00" id = "time" placeholder = "What do you need done today?">
                      </div>
                    </div>
                  </div>
                  <label class="ml-2 mb-1 font-weight-bold text-success">เนื้อหารายการโหวต</label>
                  <div class="form-group">
                    <textarea class="form-control" name="content_event" rows="15" cols="30"  required></textarea>
                  </div>
                  <div class="d-flex justify-content-center">
                    <label class="control-label" for="email">ประเภทสถานะ :</label> 
				            <div class="ml-2 d-flex">
				            	<div class="form-check">
				            	    <input class="form-check-input" type="radio" id="radio1" name="r2" onchange="show(this.value)" checked="checked">
				            	    <label class="form-check-label" for="radio1"><i class="fa fa-exchange" aria-hidden="true"></i>open(ไม่มีรหัส)</label>
				            	</div>
				            	<div class="form-check ml-3">
				            	    <input class="form-check-input" type="radio" id="radio2" name="r2" onchange="show2()">
				            	    <label class="form-check-label" for="radio2"> กำหนดรหัสผ่าน</label>
				            	</div>
                    </div>
                    <div id="sh2" style="display:none; margin-top:4px; padding:0 0 0 0;" class="col-md-3 mt-0">
                      <div class="input-group input-group-sm">
                        :&nbsp;<input type="text" name="classKey" class="form-control" placeholder="แนะนำเป็นตัวเลข">
					          	</div>
					          </div>
                  </div> 
                  <div class="d-flex justify-content-center">
                    <button type="submit" class="btn my-btn">
                        <i class="fas fa-chart-bar"></i> Create Event
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
    `;
  }
}
customElements.define("main-create-event", ModalCreateEvent);

$(document).on("click", "#modalCreateEvent", function (Evt) {
  let IdAdminCreateVote = $(this).data("admincreate");
  $("#adminCreateVote").val(IdAdminCreateVote);

  Evt.preventDefault();
});

/* Radio Check */
function show2(sign) {
  document.getElementById("sh2").style.display = "block";
}
function show(str) {
  document.getElementById("sh2").style.display = "none";
}

const showTime = () => {
  let date = new Date();
  document.getElementById("clock").innerHTML = date.toLocaleTimeString();
};
setInterval(showTime, 1000);

const ClassImage = document.getElementById("AddImage");

class myCreateImg extends HTMLElement {
  connectedCallback() {
    this.renDers();
  }
  renDers() {
    this.innerHTML = `
          <main class="main_full mb-0">
          			<div class="button_outer button-3d text-center">
          				<div class="btn_upload">
          					<input type="file" id="upload_file" name="up_img" class="getfile">
          					Upload Image
          				</div>
                  <div class="processing_bar"></div>
                  <div class="success_box"></div>
          			</div>
          		<div class="error_msg"></div>
          		<div class="uploaded_file_view" id="uploaded_view">
          			<span class="file_remove">X</span>
              </div>
          </main>
        `;
  }
}
customElements.define("main-add-img", myCreateImg);

/* jQuery function upload image */
var btnUpload = $("#upload_file"),
  btnOuter = $(".button_outer");
btnUpload.on("change", function (e) {
  var ext = btnUpload.val().split(".").pop().toLowerCase();
  if ($.inArray(ext, ["gif", "png", "jpg", "jpeg"]) == -1) {
    $(".error_msg").text("Not an Image...");
  } else {
    $(".error_msg").text("");
    btnOuter.addClass("file_uploading");
    setTimeout(function () {
      btnOuter.addClass("file_uploaded");
    }, 3000);
    var uploadedFile = URL.createObjectURL(e.target.files[0]);
    setTimeout(function () {
      $("#uploaded_view")
        .append('<img class="upload-app" src="' + uploadedFile + '" />')
        .addClass("show");
      btnOuter.hide();
    }, 3500);
  }
});
$(".file_remove").on("click", function (e) {
  $("#uploaded_view").removeClass("show");
  $("#uploaded_view").find("img").remove();
  btnOuter.show();
  btnOuter.removeClass("file_uploading");
  btnOuter.removeClass("file_uploaded");
});

/* Zone Update */

class ImgUpdateEventVote extends HTMLElement {
  connectedCallback() {
    this.innerHTML = ` 
        <div class="container">
          <div class="wrapperEvent">
              <div class="image">
                 <img src="" alt="" class="getpriviewImgEvent"> 
              </div>
              <div class="content">
                  <div class="icon">
                      <i class="fas fa-cloud-upload-alt"></i>
                  </div>
                  <div class="text">โปรดใส่ รูปภาพ</div>
              </div>
              <div class="btnCancleEvent">
                  <i class="fas fa-times"></i>
              </div>
              <div class="file-name-vote">File name hear</div>
          </div>
          <input type="file" name="imageEvent" class="defultBtnEvent" hidden>
          <p id="BtnCustomVote">Choose a file</p>  
        </div>
    `;
  }
}
customElements.define("main-update-voteimage", ImgUpdateEventVote);

class ModalUpdateEventVote extends HTMLElement{
  connectedCallback(){
    this.renderUpdateVote()
  }
  renderUpdateVote(){ 
    this.innerHTML = `
      <div class="modal fade" id="exampleModalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-update" role="document">
          <div class="modal-content">

              <div class="modal-header mb-0">
                <h4 class="modal-title" id="exampleModalLabel">Update Event Vote</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <form action="backend/editGetEvent.php" method="POST" enctype="multipart/form-data">
                  <input type="hidden" id="namegetImg" name="getImgdefault" />
                  <input type="hidden" id="ID" name="getId" />
                  <div class="modal-body">
                    <div class="col-md-12 row">
                      <div class="col-md-4">
                        <main-update-voteimage></main-update-voteimage>
                      </div>
                      <div class="col-md-8">
                        <div class="mb-0">
                          <label class="ml-2 mb-0 font-weight-bold text-primary">ชื่อหัวข้อรายการโหวต</label>
                          <div class="form-group mb-0 mt-0">
					                	<i class="fas fa-award m-fa-award"></i>
					                	<input type="text" name="event_subject" class="form-control" id="subjectEvent" required>
                          </div>
                        </div>
                        <div class="mt-0 mb-0 col-md-12">
                          <label class="ml-1 mt-0 mb-0 font-weight-bold text-info">เวลาเปิด</label>
                          <div class="row form-group mb-0 mt-0">
                            <input id= "ondateEvent" name="open_date" class="form-control input-group-sm col-7" type ="date" placeholder="What do you need done today?"  required>
                            <input type = "time" name="open_time" class="ml-2 form-control input-group-sm col-4" id="ontimeEvent" placeholder="What do you need done today?">
                          </div>
                        </div>
                        <div class="mt-0 mb-0 col-md-12">
                          <label class="ml-1 mb-0 mt-0 font-weight-bold text-danger">เวลาปิด</label>
                          <div class="row form-group mb-0 mt-0">
                            <input id="offdate" name="off_date" class="form-control input-group-sm col-7" type ="date" placeholder="What do you need done today?"  required>
                            <input type="time" name="off_time" class="ml-2 form-control input-group-sm col-4" value="08:00" id="offtime" placeholder="What do you need done today?">
                          </div>
                        </div>
                        <div class="row col-md-12">
                          <label class="control-label" for="email">ประเภทสถานะ :</label> 
				                  <div class="ml-2 d-flex">
				                  	<div class="form-check">
				                  	    <input class="form-check-input" type="radio" id="radio1" name="r2" onchange="show(this.value)" checked="checked">
				                  	    <label class="form-check-label" for="radio1"><i class="fa fa-exchange" aria-hidden="true"></i>open(ไม่มีรหัส)</label>
				                  	</div>
				                  	<div class="form-check ml-3">
				                  	    <input class="form-check-input" type="radio" id="radio2" name="r2" onchange="show2()">
				                  	    <label class="form-check-label" for="radio2"> กำหนดรหัสผ่าน</label>
				                  	</div>
                          </div>
                          <div id="sh2" style="display:none; margin-top:4px; padding:0 0 0 0;" class="col-md-12 mt-0">
                            <div class="input-group input-group-sm">
                              :&nbsp;<input type="text" name="classKey" id="getKey" class="form-control" placeholder="แนะนำเป็นตัวเลข">
					                	</div>
					                </div>
                        </div> 
                      </div>
                    </div>
                    <div class="col-md-12">
                      <label class="ml-2 mb-1 font-weight-bold text-success">เนื้อหารายการโหวต</label>
                      <div class="form-group">
                        <textarea class="form-control" id="contentEvent" name="content_event" rows="15" cols="30"  required></textarea>
                      </div>
                    </div>
                    <div class="d-flex justify-content-center">
                      <button type="submit" class="btn my-btn-update">
                          <i class="fas fa-chart-bar"></i> Update Event
                      </button>
                    </div>
                  </div>
                </form>

          </div>
        </div>
      </div>
    `;
  }
}
customElements.define('main-update-eventvote',ModalUpdateEventVote)

/* Function Image Priview */
const Eventwrapper = document.querySelector(".wrapperEvent");
const fileNameVote = document.querySelector(".file-name-vote");
const cancleBtnEvent = document.querySelector(".btnCancleEvent i");
const VotedefaulBtn = document.querySelector(".defultBtnEvent");
const imgEvent = document.querySelector(".getpriviewImgEvent");
let regExpVote = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;

document.getElementById("BtnCustomVote").onclick=()=>{
  VotedefaulBtn.click()
}

VotedefaulBtn.addEventListener("change", function () {
  //console.log(this.files)
  const file = this.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function () {
      const result = reader.result;
      //console.log(reader.result)
      imgEvent.src = result;
      Eventwrapper.classList.add("active");
    };
    cancleBtnEvent.addEventListener("click", () => {
      imgEvent.src = "";
      Eventwrapper.classList.remove("active");
    });
    reader.readAsDataURL(file);
  }
  if (this.value) {
    let valueStore = this.value.match(regExpVote);
    fileNameVote.textContent = valueStore;
  }
});
/* End */

$(document).on("click", "#ModalUpdateVote", function (e) {
  let id = $(this).data('id'), image = $(this).data('image'),subject = $(this).data('subject'),
    content = $(this).data('content'),onday = $(this).data('onday'), ontime = $(this).data('ontime'),
    offday = $(this).data('offday'),offtime = $(this).data('offtime'),key = $(this).data('key');

    $('#ID').val(id)
    $('#subjectEvent').val(subject)
    $('#ondateEvent').val(onday)
    $('#ontimeEvent').val(ontime)
    $('#offdate').val(offday)
    $('#offtime').val(offtime)
    $('#contentEvent').val(content)
    $('.getpriviewImgEvent').attr('src',`../config/data/image-vote/${image}`)
    $('.file-name-vote').html(image)
    $('#namegetImg').val(image)
    $('#getKey').val(key)
  e.preventDefault();
});
/* +++ End +++ */