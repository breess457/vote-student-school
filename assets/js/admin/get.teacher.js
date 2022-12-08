const showTime = () => {
  let date = new Date();
  document.getElementById("clock").innerHTML = date.toLocaleTimeString();
};
setInterval(showTime, 1000);

class getImagePriview extends HTMLElement {
  connectedCallback() {
    this.renderImg();
  }
  renderImg() {
    this.innerHTML = `
      <div class="container">
          <div class="wrapper">
              <div class="image">
                 <img src="" alt="" class="getpriviewImg"> 
              </div>
              <div class="content">
                  <div class="icon">
                      <i class="fas fa-cloud-upload-alt"></i>
                  </div>
                  <div class="text">No file chosen , yet!</div>
              </div>
              <div class="btnCancle">
                  <i class="fas fa-times"></i>
              </div>
              <div class="file-name">File name hear</div>
          </div>
          <input type="file" name="TeacherImage" class="defultBtU" hidden>
          <p class="BtnCustom">Choose a file</p>
          
      </div>
    `;
  }
}
customElements.define("main-img-priview", getImagePriview);

class createEventTeacher extends HTMLElement {
  connectedCallback() {
    this.RenderEvent();
  }
  RenderEvent() {
    this.innerHTML = `
        <div class="modal fade" id="formCreateTeacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                      <p class="modal-title" id="exampleModalLabel">Create Account Teacher</p>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="backend/chk_add_teacher.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row col-md-12">
                                <div class="col-md-6">
                                    <main-img-priview></main-img-priview>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="fas fa-user-circle"></i>
                                        </span>
                                      </div>
                                      <input type="text" name="teacherName" class="form-control" placeholder="Full Name" required>
                                    </div>
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="fas fa-id-card"></i>
                                        </span>
                                      </div>
                                      <input type="text" name="TeacherCode" class="form-control" placeholder="Code Teacher" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="input-group mb-3">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                  <i class="fas fa-book"></i>
                                                </span>
                                              </div>
                                              <select class="custom-select clsdpartment" id="selectloop" name="department" required>
			                                          <option disabed hidden>แผนก</option>
			                                  </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="custom-select clsdpartment" name="position" required>
			                                    <option disabed hidden>ตำแหน่ง</option>
                                                <option value="teacher">อาจารย์/ผู้สอน</option>
                                                <option value="president">ประธานนักเรียน</option>
                                                <option value="activity">ฝ่ายกิจกรรม</option>
			                                </select>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="fas fa-key"></i>
                                        </span>
                                      </div>
                                      <input type="password" name="password" class="form-control" placeholder="Create Password" required>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-setUpdate">
                              <i class="fas fa-chalkboard-teacher">&#xE8B8;</i>  Get Submit Teacher
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      `;
  }
}
customElements.define("main-create-teacher", createEventTeacher);

/* Function Image Priview */
const wrapper = document.querySelector(".wrapper");
const fileName = document.querySelector(".file-name");
const cancleBtn = document.querySelector(".btnCancle i");
const defaulBtn = document.querySelector(".defultBtU");
const customBtn = document.querySelector(".BtnCustom");
const img = document.querySelector(".getpriviewImg");
let regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;
customBtn.onclick = () => {
  defaulBtn.click();
  //console.log("click :")
};

defaulBtn.addEventListener("change", function () {
  //console.log(this.files)
  const file = this.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function () {
      const result = reader.result;
      //console.log(reader.result)
      img.src = result;
      wrapper.classList.add("active");
    };
    cancleBtn.addEventListener("click", () => {
      img.src = "";
      wrapper.classList.remove("active");
    });
    reader.readAsDataURL(file);
  }
  if (this.value) {
    let valueStore = this.value.match(regExp);
    fileName.textContent = valueStore;
  }
});
/* End */

/* Zone Update */
class setUpdateImgTeacher extends HTMLElement{
  connectedCallback(){
    this.renderSetImg()
  }
  renderSetImg(){
    this.innerHTML = `
      <div class="container">
          <div class="wrapper x-wrap">
              <div class="image">
                 <img src="" alt="" class="x-img"> 
              </div>
              <div class="content">
                  <div class="icon">
                      <i class="fas fa-cloud-upload-alt"></i>
                  </div>
                  <div class="text">No file chosen , yet! update</div>
              </div>
              <div class="btnCancle x-cancle">
                  <i class="fas fa-times"></i>
              </div>
              <div class="ximgname file-name">File name hear</div>
          </div>
          <input type="file" name="TeacherImageUpdate" class="updatedefultBtn" hidden>
          <p class="BtnCustom x-btnCustom">Choose a file</p> 
      </div>       
    `;
  }
}
customElements.define('mian-set-img',setUpdateImgTeacher)

class ModalUpdateDataTeacher extends HTMLElement{
  connectedCallback(){
    this.setRenderUpdateDataTeacher()
  }
  setRenderUpdateDataTeacher(){
    this.innerHTML = `
        <div class="modal fade" id="formUpdateDataTeacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                      <p class="modal-title" id="exampleModalLabel">update Account Teacher</p>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="backend/editTeacher.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" id="setIdTeacher" name="setIdTeacher" />
                        <input type="hidden" id="setImageDefault" name="setImageDefault" />
                        <div class="modal-body">
                            <div class="row col-md-12">
                                <div class="col-md-6">
                                    <mian-set-img></mian-set-img>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="fas fa-user-circle"></i>
                                        </span>
                                      </div>
                                      <input type="text" id="setNameTeacher" name="setNameTeacher" class="form-control" placeholder="Full Name" required>
                                    </div>
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="fas fa-id-card"></i>
                                        </span>
                                      </div>
                                      <input type="text" id="setCodeTeacher" name="setCodeTeacher" class="form-control" placeholder="Code Teacher" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="input-group mb-3">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                  <i class="fas fa-book"></i>
                                                </span>
                                              </div>
                                              <select class="custom-select clsdpartment" name="setDepartmentTeacher" id="selectUpdate" required>
			                                          <option id="setDepartmentTeacher" hidden></option>
			                                        </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                          <select class="custom-select clsdpartment" name="setPositonTeacher" required>
			                                          <option id="setPositonTeacher" hidden></option>
                                                <option value="teacher">อาจารย์/ผู้สอน</option>
                                                <option value="president">ประธานนักเรียน</option>
                                                <option value="activity">ฝ่ายกิจกรรม</option>
			                                    </select>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="fas fa-key"></i>
                                        </span>
                                      </div>
                                      <input type="password" id="setPasswordTeacher" name="setPasswordTeacher" class="form-control" placeholder="Create Password" required>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-setUpdate">
                              <i class="fas fa-chalkboard-teacher">&#xE8B8;</i>  Get Submit Teacher
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    `;
  }
}
customElements.define('mian-modalupdate-datateacher',ModalUpdateDataTeacher)

/* Function Image Priview */
const setwrap = document.querySelector(".x-wrap");
const setImgName = document.querySelector(".ximgname");
const setBtncancle = document.querySelector(".x-cancle i");
const setdefaulbtn = document.querySelector(".updatedefultBtn");
const setcustomBtn = document.querySelector(".x-btnCustom");
const setimg = document.querySelector(".x-img");
let setExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;
setcustomBtn.onclick = () => {
  setdefaulbtn.click();
  //console.log("click :")
};

setdefaulbtn.addEventListener("change", function () {
  //console.log(this.files)
  const file = this.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function () {
      const result = reader.result;
      //console.log(reader.result)
      setimg.src = result;
      setwrap.classList.add("active");
    };
   setBtncancle.addEventListener("click", () => {
      setimg.src = "";
      setwrap.classList.remove("active");
    });
    reader.readAsDataURL(file);
  }
  if (this.value) {
    let valueStore = this.value.match(setExp);
    setImgName.textContent = valueStore;
  }
});
/* End */

$(document).on("click", "#setUpdatedata",function(methodEvent){
  let setId = $(this).data('id'),setName = $(this).data('name'),setImage = $(this).data('image'),setPassword = $(this).data('password'),
    setCodeTeacher = $(this).data('code'),setDepartment = $(this).data('department'),setPostion = $(this).data('position')

    $('#setIdTeacher').val(setId)
    $('#setNameTeacher').val(setName)
    $('#setPasswordTeacher').val(setPassword)
    $('#setCodeTeacher').val(setCodeTeacher)
    $('#setDepartmentTeacher').html(setDepartment)
    $('#setPositonTeacher').html(setPostion)
    $('#setImageDefault').val(setImage)
    $('.x-img').attr('src',`../config/data/admin-profile/${setImage}`)
    $('.ximagename').html(setImage)
    $('.x-wrap').last().addClass('active')

  methodEvent.preventDefault()
});

const selectloop = document.getElementById("selectloop");
const selectUpdate = document.getElementById("selectUpdate");
var getDepartment = [
  "it",
  "accounting",
  "Electric",
  "Medical electronics",
  "Mechanic",
  "Factory mechanic",
  "Metal welder",
  "Electronic technician",
  "Business computer",
  "Fashion technology and appare",
  "Beauty business",
  "Business foreign languages",
  "Food and nutrition",
];

const LoopDataarrays = (dataArr, _idSelect, moment) => {
  let x;
  for (x = 0; x < dataArr.length; x++) {
    let option = document.createElement("option");
    if (moment == dataArr[x]) {
      console.log("mentxx :" + dataArr[x]);
    } else {
      option.innerHTML = dataArr[x];
      option.value = dataArr[x];
      _idSelect.appendChild(option);
    }
  }
};
LoopDataarrays(getDepartment, selectloop, "none");

LoopDataarrays(getDepartment, selectUpdate, "none");