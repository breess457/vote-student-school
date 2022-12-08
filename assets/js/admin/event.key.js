const eventKey = (pornhub) => {
  if (pornhub.status === 404) {
    Swal.fire({
      title: [pornhub.msg, pornhub.status],
      icon: "error",
      showConfirmButton: true,
    });
  } else if (pornhub.status === 200) {
    const ElKey = pornhub.key;
    const ElId = pornhub.id;
    Swal.fire({
      title: "Key Success",
      text: "รหัสผ่านถูกต้อง",
      icon: "success",
      confirmButtonText: `ตกลง`,
    }).then((Grap) => {
      if (Grap.isConfirmed) {
        window.location = `addCandidate.php?getID=${ElId}&&keys=${ElKey}`;
      }
    });
  }
};
const ConfirmKeyLog = (voteID, keyClass) => {
  Swal.fire({
    title: "ป้อนรหัสผ่าน",
    text: "ห้องนี้ถูกกำหนดรหัสผ่าน",
    html: `
                    <input type="hidden" id="login" class="swal2-input" value=${voteID}>
                    <input type="text" id="password" class="swal2-input" placeholder="Password">
                `,
    inputAttributes: {
      autocapitalize: "off",
    },
    confirmButtonText: "Confirm",
    showLoaderOnConfirm: true,
    preConfirm: () => {
      const login = Swal.getPopup().querySelector("#login").value;
      const password = Swal.getPopup().querySelector("#password").value;
      if (!login || !password) {
        Swal.showValidationMessage(`กรุณาป้อน รหัสผ่านห้อง`);
      }
      return { login: login, password: password };
    },
    allowOutsideClick: () => !Swal.isLoading(),
  }).then((result) => {
    fetch("backend/chk_logkey.php", {
      method: "POST",
      body: JSON.stringify({
        id: result.value.login,
        key: result.value.password,
      }),
      headers: {
        "Content-Type": "application/json; charset=UTF-8",
      },
    })
      .then((res) => res.json())
      .then((data) => {
        eventKey(data);
        // console.log(data)
      })
      .catch((err) => console.log(err));
    //console.log([result.value.login,result.value.password])
  });
};
