

class upLoadImgCandy extends HTMLElement{
  connectedCallback(){
    this.innerHTML = ` 
        <div class="container">
          <div class="wrapperC">
              <div class="image">
                 <img src="" alt="" class="getpriviewImgC"> 
              </div>
              <div class="content">
                  <div class="icon">
                      <i class="fas fa-cloud-upload-alt"></i>
                  </div>
                  <div class="text">โปรดใส่ รูปภาพ</div>
              </div>
              <div class="btnCancleC">
                  <i class="fas fa-times"></i>
              </div>
              <div class="file-nameC">File name hear</div>
          </div>
          <input type="file" name="imageCandy" required class="defultBtUC" hidden>
          <p id="BtnCustomC">Choose a file</p>  
        </div>
    `;
  }
}
customElements.define('main-up-candy',upLoadImgCandy);

class addModalcandyDate extends HTMLElement {
  connectedCallback() {
    this.renderX();
  }
  renderX() {
    this.innerHTML = `
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="backend/chkCreate_candidate.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="idTypeVote" name="id-type-vote" />
              <div class="row col-md-12">
                <div class="col-md-5 mb-0 mt-0">
                    <main-up-candy></main-up-candy>
                </div>
                <div class="col-md-7 mb-0 mt-0">
                    <div class="form-group col-md-12 mb-0">
                       <label for="nameCandy" clss="mb-0 mt-2">ชื่อผู้สมัค :</label>
                       <input type="text" class="form-control" id="nameCandy" name="nameCandy" placeholder="เพิ่มชื่อ ผู้สมัค" required>
                    </div> 
                    <div class="form-group col-md-12 mb-0">
                       <label for="departmentCandy" clss="mb-0 mt-2">แผนก</label>
                       <select class="form-control" name="departmentCandy" id="departmentCandy" required>
			              <option disabed hidden>ระบุ แผนกของผู้สมัค</option>
                          <option value="accountting">accountting</option>
                          <option value="CyberSecurity">CyberSecurity</option>
                          <option value="MedicalElectronics">Medical electronics</option>
                          <option value="ComputerBusiness">computer business</option>
                          <option value="Other">อื่นๆที่ไม่ใช้บุคคล</option>
			                 </select>
                    </div>
                    <div class="row mt-2">
                      <div class="form-group col-md-8 mb-0">
                         <label for="titleCandy" clss="mb-0 mt-2">หัวข้อสังกัด</label>
                         <input type="text" class="form-control" id="titleCandy" name="titleCandy" placeholder="พรรค์ หรื่อ ตำแหน่ง" required>
                      </div>
                      <div class="form-group col-md-4 mb-0">
                         <label for="number" clss="mb-0 mt-2">หมายเลข</label>
                         <input type="text" class="form-control" id="number" name="number" placeholder="หมายเลข" required>
                      </div>
                    </div>
                </div>
              </div>
                <label class="ml-2 mb-1 font-weight-bold text-success" for="subContent">คำอธิบายนโยบาย</label>
                <div class="form-group">
                  <textarea class="form-control" name="subContent" id="subContent" rows="5" cols="30"  required>เขียนนคำอธิบายโยบายเกียวกับตัวผู้สมัค</textarea>
                </div>

              <button type="submit" class="btn btn-primary">Save changes</button>
            </form> 
          </div>
          
        </div>
      </div>
    </div>
    `;
  }
}
customElements.define('main-add-candydate',addModalcandyDate);

/* Function Image Priview */
const Cwrapper = document.querySelector(".wrapperC");
const CfileName = document.querySelector(".file-nameC");
const cancleBtnC = document.querySelector(".btnCancleC i");
const CandydefaulBtn = document.querySelector(".defultBtUC");
const imgC = document.querySelector(".getpriviewImgC");
let regExpC = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;

document.getElementById("BtnCustomC").onclick=()=>{
  CandydefaulBtn.click()
}

CandydefaulBtn.addEventListener("change", function () {
  //console.log(this.files)
  const file = this.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function () {
      const result = reader.result;
      //console.log(reader.result)
      imgC.src = result;
      Cwrapper.classList.add("active");
    };
    cancleBtnC.addEventListener("click", () => {
      imgC.src = "";
      Cwrapper.classList.remove("active");
    });
    reader.readAsDataURL(file);
  }
  if (this.value) {
    let valueStore = this.value.match(regExpC);
    CfileName.textContent = valueStore;
  }
});
$(document).on("click", "#modaladdcondyDate",function(evts){
  let getIdvote = $(this).data('id');
   $("#idTypeVote").val(getIdvote)
});
/* End */



/* Zone Update */
class ImgUpdateCandidate extends HTMLElement {
  connectedCallback() {
    this.innerHTML = ` 
        <div class="container">
          <div class="update-wrapper">
              <div class="image">
                 <img src="" alt="" class="update-priviewImg"> 
              </div>
              <div class="content">
                  <div class="icon">
                      <i class="fas fa-cloud-upload-alt"></i>
                  </div>
                  <div class="text">โปรดใส่ รูปภาพ</div>
              </div>
              <div class="update-btnCancle">
                  <i class="fas fa-times"></i>
              </div>
              <div class="file-name-update">File name hear</div>
          </div>
          <input type="file" name="setImageCandy" class="defultBtU-update" hidden>
          <p id="updateBtnCustom">Choose a file</p>  
        </div>
    `;
  }
}
customElements.define("main-update-vote", ImgUpdateCandidate);

class ModalCandidateUpdate extends HTMLElement{
  connectedCallback(){
    this.renderSetCandidateUpdate()
  }
  renderSetCandidateUpdate(){
    this.innerHTML = `
        <div class="modal fade" id="myModalUpdateCandidate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="backend/editCandidate.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="setidCandidate" name="setidCandidate" />
                    <input type="hidden" id="setImgnames" name="setImgnames" />
                    <input type="hidden" id="settypeidvote" name="settypeidvote" />
                  <div class="row col-md-12">
                    <div class="col-md-5 mb-0 mt-0">
                        <main-update-vote></main-update-vote>
                    </div>
                    <div class="col-md-7 mb-0 mt-0">
                        <div class="form-group col-md-12 mb-0">
                           <label for="setFullname" clss="mb-0 mt-2">ชื่อผู้สมัค :</label>
                           <input type="text" class="form-control" id="setFullname" name="setFullname" placeholder="เพิ่มชื่อ ผู้สมัค" required>
                        </div> 
                        <div class="form-group col-md-12 mb-0">
                           <label for="departmentCandy" clss="mb-0 mt-2">แผนก</label>
                           <select class="form-control" name="setdepartmentCandy" id="editdepartmentCandy" required>
    			                    <option id="setCandidateDepartment" selected></option>
    			                 </select>
                        </div>
                        <div class="row mt-2">
                          <div class="form-group col-md-8 mb-0">
                             <label for="setCandidateTitle" clss="mb-0 mt-2">หัวข้อสังกัด</label>
                             <input type="text" class="form-control" id="setCandidateTitle" name="setCandidateTitle" placeholder="พรรค์ หรื่อ ตำแหน่ง" required>
                          </div>
                          <div class="form-group col-md-4 mb-0">
                             <label for="setCandidateNumber" clss="mb-0 mt-2">หมายเลข</label>
                             <input type="text" class="form-control" id="setCandidateNumber" name="setCandidateNumber" placeholder="หมายเลข" required>
                          </div>
                        </div>
                    </div>
                  </div>
                    <label class="ml-2 mb-1 font-weight-bold text-success" for="setCandidateContent">คำอธิบายนโยบาย</label>
                    <div class="form-group">
                      <textarea class="form-control" name="setCandidateContent" id="setCandidateContent" rows="5" cols="30"  required>เขียนนคำอธิบายโยบายเกียวกับตัวผู้สมัค</textarea>
                    </div>
                    <div class="d-flex justify-content-center">
                      <button type="submit" class="btn my-btn-update">
                          <i class="fas fa-chart-bar"></i> Update Candidate
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
customElements.define('modal-setupdate-candidate',ModalCandidateUpdate)

/* Function Image Priview */
const updateWrapper = document.querySelector(".update-wrapper");
const updateFileName = document.querySelector(".file-name-update");
const cancleBtnUpdate = document.querySelector(".update-btnCancle i");
const CandydefaulBtnUpdate = document.querySelector(".defultBtU-update");
const imgUpdate = document.querySelector(".update-priviewImg");
let regExpUpdate = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;

document.getElementById("updateBtnCustom").onclick=()=>{
  CandydefaulBtnUpdate.click()
}

CandydefaulBtnUpdate.addEventListener("change", function () {
  //console.log(this.files)
  const file = this.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function () {
      const result = reader.result;
      //console.log(reader.result)
      imgUpdate.src = result;
      updateWrapper.classList.add("active");
    };
    cancleBtnUpdate.addEventListener("click", () => {
      imgUpdate.src = "";
      updateWrapper.classList.remove("active");
    });
    reader.readAsDataURL(file);
  }
  if (this.value) {
    let valueStore = this.value.match(regExpUpdate);
    updateFileName.textContent = valueStore;
  }
});
/* End */

$(document).on("click", "#myUpdateCandi", function (e) {
  let IDtypeCandidate = $(this).data('candisetid'),imgcandi = $(this).data('imgcandi'),fullname= $(this).data('fullname'),
    candititle = $(this).data('candititle'),candicontent = $(this).data('candicontent'),departmentcandi = $(this).data('departmentcandi'),
    candinameber = $(this).data('candinameber'),typeidvote = $(this).data('typeidvote');

  $("#setidCandidate").val(IDtypeCandidate);
  $("#setFullname").val(fullname);
  $("#setCandidateTitle").val(candititle);
  $("#setCandidateContent").val(candicontent);
  $("#setCandidateDepartment").val(departmentcandi);
  $("#setCandidateDepartment").html(departmentcandi);
  $("#setCandidateNumber").val(candinameber)
  $("#settypeidvote").val(typeidvote)
  $(".update-priviewImg").attr('src',`../config/data/candidate-profile/${imgcandi}`)
  $("#setImgnames").val(imgcandi)
  e.preventDefault();
});

const departmentCandy = document.getElementById("departmentCandy")
const editdepartmentCandy = document.getElementById("editdepartmentCandy")
var getDepartmentCady = [
  "it",
  "accounting",
  "dataSci",
  "comSci",
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
  "อื่นๆที่ไม่ใช้บุคคล",
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

LoopDataarrays(getDepartmentCady,departmentCandy,'none');
LoopDataarrays(getDepartmentCady,editdepartmentCandy,'none')