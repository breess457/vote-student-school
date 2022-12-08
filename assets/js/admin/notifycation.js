const MyFunction = (
  nameCDD,
  dsce,
  imageCDD,
  numberCDD,
  CDDnumber,
  CDDtitle,
  groupCDD
) => {
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
};
