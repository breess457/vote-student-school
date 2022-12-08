
const showTime = () => {
  let date = new Date();
  document.getElementById("clocks").innerHTML = date.toLocaleTimeString();
};
setInterval(showTime, 1000);

const Thead = `
  <tr>
    <th>#</th>
    <th>User Name</th>
    <th>Department</th>
    <th>Student Code</th>
    <th>Sex</th>
    <th>Age</th>
    <th>Action</th>
  </tr>
`;
document.getElementById("t-head").innerHTML = Thead;

class ImagePriview extends HTMLElement {
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
          <input type="file" name="image" class="defultBtU" hidden>
          <p class="BtnCustom">Choose a file</p>
          
      </div>
    `;
  }
}
customElements.define("main-img-priview", ImagePriview);


class CreateStudent extends HTMLElement {
  connectedCallback() {
    this.apollo();
  }
  apollo() {
    this.innerHTML = `
      <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header border-bottom-0">
              <p class="modal-title" id="exampleModalLabel">Create Account</p>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="backend/chk_add_student.php" method="POST" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="row col-md-12">
                    <div class="col-md-6 mb-0 mt-0">
                        <div class="form-group col-md-12 mb-0">
                           <label for="fanem">Full Name</label>
                           <input type="text" class="form-control" id="fname" name="fname" aria-describedby="emailHelp" placeholder="ชื่อ ผู้ใช้งาน" required>
                        </div> 
                        <div class="form-group col-md-12 mb-0">
                          <label>Select loop:</label>
			                    <select class="form-control" name="department" id="selectloop" required>
			                    	<option disabed hidden>ระบุ แผนก ที่เรียน</option>
			                    </select>
                        </div>
                        <div class="form-group col-md-12 mb-0">
                           <label for="stdCode">Student Code</label>
                           <input type="text" class="form-control" name="stdCode" id="stdCode" aria-describedby="emailHelp" placeholder="รหัส นักศึกษา" required>
                        </div>
                        <div class="form-group col-md-12">
                          <label for="pwd">Password</label>
                          <input type="text" class="form-control" name="pwd" id="pwd" aria-describedby="emailHelp" placeholder="รหัส ผ่าน" required>
                        </div>
                    </div>
                    <div class="col-md-6 mt-0">
                        <div class="row mb-0">
                            <div class="form-group col-4">
                                <label>Sex</label>
			                    	    <select class="form-control" name="sex" id="" required>
			                    	    	<option disabed hidden>ระบุ เพศ</option>
			                    	    	<option value="1">man</option>
			                    	    	<option value="2">woman</option>
			                    	    </select>
                            </div>
                            <div class="form-group col-4">
                                <label>Age</label>
			                          <input type="text" class="input-ctr" name="age" placeholder="Age" required>
                            </div>
                            <div class="form-group col-4">
                                <label>YearStudy</label>
			                    	    <select class="form-control" name="yearofStudy" id="" required>
                                  <option disabed hidden>ระบุ ปี</option>
                                  <option value="ปวช 1">ปวช 1</option>
			                    	    	<option value="ปวช 2">ปวช 2</option>
			                    	    	<option value="ปวช 3">ปวช 3</option>
			                    	    	<option value="ปวส 1">ปวส 1</option>
			                    	    	<option value="ปวส 2">ปวส 2</option>
			                    	    </select>
                            </div>
                        </div>
                        <main-img-priview></main-img-priview>
                    </div>
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-center">
                  <button type="submit" class="btn btn-successx btn-block">
                    <i class="fas fa-user-graduate"></i> click add students
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
customElements.define("apps-modal-std", CreateStudent);

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
  console.log("click :")
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

const selectloop = document.getElementById("selectloop");
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


/* Zone Update */
class UpdateImgStd extends HTMLElement {
  connectedCallback() {
    this.renderImgUpdate();
  }
  renderImgUpdate() {
    this.innerHTML = `
      <div class="container">
          <div class="update-wrapper">
              <div class="update-image">
                 <img src="" alt="" class="update-priviewImg"> 
              </div>
              <div class="content">
                  <div class="icon">
                      <i class="fas fa-cloud-upload-alt"></i>
                  </div>
                  <div class="text">No file chosen , yet!</div>
              </div>
              <div class="update-btnCancle">
                  <i class="fas fa-times"></i>
              </div>
              <div class="update-file-name">File name hear</div>
          </div>
          <input type="file" name="image" class="update-defultBtU" hidden>
          <p class="update-BtnCustom">Choose a file</p>
          
      </div>
    `;
  }
}
customElements.define('update-image-student',UpdateImgStd)

class ModalUpdateStudents extends HTMLElement{
  connectedCallback(){
    this.renderUpdateStudent()
  }
  renderUpdateStudent(){
    this.innerHTML = `
        <div class="modal fade" id="formUpdateStudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header border-bottom-0">
                <p class="modal-title" id="exampleModalLabel">update account student</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="backend/editStudents.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                  <input type="hidden" name="setIDstd" id="setIDstd" />
                  <input type="hidden" id="setImgStudent" name="setImgStudent" />
                  <input type="hidden" name="status" value="update" />
                  <div class="row col-md-12">
                      <div class="col-md-6 mb-0 mt-0">
                          <div class="form-group col-md-12 mb-0">
                             <label for="setNameStd">Full Name</label>
                             <input type="text" class="form-control" id="setNameStd" name="setNameStd" aria-describedby="emailHelp" placeholder="ชื่อ ผู้ใช้งาน" required>
                          </div> 
                          <div class="form-group col-md-12 mb-0">
                            <label>Select loop:</label>
  			                    <select class="form-control" name="setDepartmaneStudent" id="selectUpdate" required>
                              <option id="setDepartmaneStudent" hidden></option>
  			                    </select>
                          </div>
                          <div class="form-group col-md-12 mb-0">
                             <label for="setCodeStudent">Student Code</label>
                             <input type="text" class="form-control" name="setCodeStudent" id="setCodeStudent" aria-describedby="emailHelp" placeholder="รหัส นักศึกษา" required>
                          </div>
                          <div class="form-group col-md-12">
                            <label for="setPasswordStudentx">Password</label>
                            <input type="password" class="form-control" name="setPasswordStudent" id="setPasswordStudentx" required>
                          </div>
                      </div>
                      <div class="col-md-6 mt-0">
                          <div class="row mb-0">
                              <div class="form-group col-4">
                                  <label>Sex</label>
  			                    	    <select class="form-control" name="setSexStudent" id="" required>
  			                    	    	<option id="setSexStudent" hidden>ระบุ เพศ</option>
  			                    	    	<option value="1">man</option>
  			                    	    	<option value="2">woman</option>
  			                    	    </select>
                              </div>
                              <div class="form-group col-4">
                                  <label>Age</label>
  			                          <input type="text" class="input-ctr" name="setAgeStudent" id="setAgeStudent" placeholder="Age" required>
                              </div>
                              <div class="form-group col-4">
                                  <label>YearStudy</label>
  			                    	    <select class="form-control" name="yearofStudy" id="" required>
                                    <option id="yearOFstudy" hidden></option>
                                    <option value="ปวช 1">ปวช 1</option>
			                    	    	  <option value="ปวช 2">ปวช 2</option>
			                    	    	  <option value="ปวช 3">ปวช 3</option>
			                    	    	  <option value="ปวส 1">ปวส 1</option>
			                    	    	  <option value="ปวส 2">ปวส 2</option>
  			                    	    </select>
                              </div>
                          </div>
                          <update-image-student></update-image-student>
                      </div>
                  </div>
                  <div class="modal-footer border-top-0 d-flex justify-content-center">
                    <button type="submit" class="btn btn-successx btn-block">
                      <i class="fas fa-user-graduate"></i> click add students
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
customElements.define('modal-update-student',ModalUpdateStudents)

/* Function Image Priview */
const Updatewrapper = document.querySelector(".update-wrapper");
const UpdatefileName = document.querySelector(".update-file-name");
const UpdatecancleBtn = document.querySelector(".update-btnCancle i");
const UpdatedefaulBtn = document.querySelector(".update-defultBtU");
const UpdatecustomBtn = document.querySelector(".update-BtnCustom");
const Updateimg = document.querySelector(".update-priviewImg");
let UpdateregExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;
UpdatecustomBtn.onclick = () => {
  UpdatedefaulBtn.click();
  console.log("click :")
};

UpdatedefaulBtn.addEventListener("change", function () {
  //console.log(this.files)
  const file = this.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function () {
      const result = reader.result;
      //console.log(reader.result)
      Updateimg.src = result;
      Updatewrapper.classList.add("active");
    };
    UpdatecancleBtn.addEventListener("click", () => {
      Updateimg.src = "";
      Updatewrapper.classList.remove("active");
    });
    reader.readAsDataURL(file);
  }
  if (this.value) {
    let valueStore = this.value.match(UpdateregExp);
    UpdatefileName.textContent = valueStore;
  }
});
/* End */

 function mysexmethod(setdatamethod){
     switch(setdatamethod){
      case 1:
        $("#setSexStudent").html("man")
        break;
      case 2:
        $("#setSexStudent").html("woman")
      break;
    } 

  }

$(document).on("click", "#modalupdateStd",function(setEVT){
  let setIDstd = $(this).data('tyid'),stdname = $(this).data('name'),imgStd = $(this).data('image'),
    codeStd = $(this).data('code'),departmentStd = $(this).data('department'),YearOfStudy = $(this).data('yfstd'),
    sexStd = $(this).data('sex'),ageStd = $(this).data('age'),passwordStd = $(this).data('password');

  $("#setIDstd").val(setIDstd)
  $('#setNameStd').val(stdname)
  $('#setCodeStudent').val(codeStd)
  $('#setDepartmaneStudent').html(departmentStd)
  $('#yearOFstudy').html(YearOfStudy)
  $("#yearOFstudy").val(YearOfStudy);
  $('#setSexStudent').val(sexStd)
  $('#setAgeStudent').val(ageStd)
  $('#setPasswordStudentx').val(passwordStd)
  $('.update-priviewImg').attr('src',`../config/data/student-profile/${imgStd}`)
  $(".update-file-name").html(imgStd);
  $(".update-wrapper").last().addClass("active")
  $('#setImgStudent').val(imgStd)

  mysexmethod(sexStd);

  setEVT.preventDefault()
});

const selectUpdate = document.getElementById("selectUpdate");
LoopDataarrays(getDepartment, selectUpdate, "none");

