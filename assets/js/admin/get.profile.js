const resultStatus = (getDatas)=>{
    if(getDatas.status === 200){
        Swal.fire({
          title: getDatas.title,
          icon: getDatas.icons,
          text: getDatas.text,
          showConfirmButton: true,
        });
    }else{
        Swal.fire({
          title: getDatas.title,
          icon: getDatas.icons,
          text: getDatas.text,
          showConfirmButton: true,
        });
    }
}

const mypasswordReset =(datapass,databyid)=>{
    Swal.fire({
      title: "ป้อน รหัสผ่าน เดิม",
      html: `<input type="text" id="password" class="swal2-input" placeholder="Password">`,
      inputAttributes: {
        autocapitalize: "off",
      },
      confirmButtonText: "Confirm",
      showLoaderOnConfirm: true,
      preConfirm: () => {
        const password = Swal.getPopup().querySelector("#password").value;
        if (!password) {
          Swal.showValidationMessage(`กรุณาป้อน รหัสผ่านห้อง`);
        }
        return { password: password };
      }, 
      allowOutsideClick: () => !Swal.isLoading(),
    }).then((bydata) =>{
        if (bydata.value.password === datapass){
          Swal.fire({
            title: "ป้อน รหัสผ่าน ใหม่",
            html: `<input type="text" id="newpassword" class="swal2-input" placeholder="Password">`,
            inputAttributes: {
              autocapitalize: "off",
            },
            confirmButtonText: "ตกลง",
            showLoaderOnConfirm: true,
            preConfirm: () => {
              const newpassword = Swal.getPopup().querySelector("#newpassword").value;
              if (!newpassword) {
                Swal.showValidationMessage(`กรุณาป้อน รหัสผ่าน`);
              }
              return { newpassword: newpassword };
            },
          }).then((newdatapass)=>{
             let newpass= newdatapass.value.newpassword;
            fetch(`backend/confirmpass.php?setId=${databyid}&&newpass=${newpass}`, {
              method: "GET",
              headers: {
                "Content-Type": "application/json; charset=UTF-8",
              },
            })
              .then((resx) => resx.json())
              .then((setmethods)=>{
                  resultStatus(setmethods);
                  console.log(setmethods)
                })
              .catch((errs) => console.log(errs));
          })
        }else{
            Swal.fire({
              title: "รหัสผ่านไม่ถูกต้อง",
              icon: "error",
              showConfirmButton: true,
            });
        }
    })
}

class setUpdateImgTeacher extends HTMLElement {
  connectedCallback() {
    this.renderSetImg();
  }
  renderSetImg() {
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
          <input type="file" name="UpdateProfileImg" class="updatedefultBtn" hidden>
          <p class="BtnCustom x-btnCustom">Choose a file</p> 
      </div>       
    `;
  }
}
customElements.define("mian-set-image", setUpdateImgTeacher);

class ModalUpdateProfile extends HTMLElement {
  connectedCallback() {
    this.renderProfile();
  }
  renderProfile() {
    this.innerHTML = `
        <div class="modal fade" id="updateModalProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                      <p class="modal-title" id="exampleModalLabel">update Account Teacher</p>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="backend/editProfile.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" id="meId" name="meId" />
                        <input type="hidden" id="setImgDefault" name="setImgDefault" />
                        <div class="modal-body">
                            <div class="row col-md-12">
                                <div class="col-md-6">
                                    <mian-set-image></mian-set-image>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="fas fa-user-circle"></i>
                                        </span>
                                      </div>
                                      <input type="text" id="setFullname" name="setFullname" class="form-control" placeholder="Full Name" required>
                                    </div>
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="fas fa-id-card"></i>
                                        </span>
                                      </div>
                                      <input type="text" id="setCodeadmin" name="setCodeadmin" class="form-control" placeholder="Code Teacher" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group mb-3">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                  <i class="fas fa-book"></i>
                                                </span>
                                              </div>
                                              <select class="custom-select clsdpartment" name="setDepartment" required>
			                                          <option id="setDepartment" hidden></option>
                                                <option value="it">it</option>
                                                <option value="accounting">accounting</option>
                                                <option value="Electronic">Electronic</option>
                                                <option value="computerbusiness">computerbusiness</option>
                                                <option value="Electric">Electric</option>
			                                        </select>
                                            </div>
                                        </div>
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
customElements.define("main-update-profile", ModalUpdateProfile);

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

$(document).on("click", "#setUpdateProfileMe",function(evtmethod){

    let meId = $(this).data('id'),fullname = $(this).data('name'),admincode = $(this).data('code'),
        image = $(this).data('image'),department = $(this).data('department'),position = $(this).data('position')
    
    $('#meId').val(meId)
    $('#setFullname').val(fullname)
    $('#setCodeadmin').val(admincode)
    $('#setImgDefault').val(image)
    $('#setDepartment').html(department)
    $('#setPosition').html(position)
    $('.x-img').attr('src','../config/data/admin-profile/' + image)
    $('.x-wrap').last().addClass('active')

    evtmethod.preventDefault();
});
