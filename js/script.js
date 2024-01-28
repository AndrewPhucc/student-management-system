document.getElementById("monHocForm").addEventListener("submit", function (event) {
    event.preventDefault();

    const maMH = document.getElementById("maMH").value;
    const tenMH = document.getElementById("tenMH").value;
    const soTC = document.getElementById("soTC").value;

    // Kiểm tra tính hợp lệ của dữ liệu 
    saveMonHoc(maMH, tenMH, soTC);
  });

function saveMonHoc(maMH, tenMH, soTC) {
  // Check if soTC is a non-negative number
  if (isNaN(soTC) || parseInt(soTC) < 0) {
    alert("Số tín chỉ phải là số không âm.");
    return;
  }
  // Tạo XMLHttpRequest object để gửi dữ liệu lên server
  const xhr = new XMLHttpRequest();

  // Xác định phương thức và URL để gửi dữ liệu
  xhr.open("POST", "./saveinformation/save_monhoc.php", true);

  // Xử lý khi nhận được phản hồi từ server
  xhr.onload = function () {
    if (xhr.status === 200) {
      alert("Thông tin môn học đã được thêm.");
    } else {
      alert("Có lỗi xảy ra. Vui lòng thử lại sau.");
    }
  };

  // Đặt header cho request
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  // Gửi dữ liệu môn học lên server
  const data = `maMH=${maMH}&tenMH=${tenMH}&soTC=${soTC}`;
  xhr.send(data);
}

document.getElementById("lopForm").addEventListener("submit", function (event) {
  event.preventDefault();

  const maLP = document.getElementById("maLP").value;
  const tenLP = document.getElementById("tenLP").value;
  const niemKhoa = document.getElementById("niemKhoa").value;

  // Kiểm tra tính hợp lệ của dữ liệu 
  saveLop(maLP, tenLP, niemKhoa);
});

function saveLop(maLP, tenLP, niemKhoa) {
  // Tạo XMLHttpRequest object để gửi dữ liệu lên server
  const xhr = new XMLHttpRequest();

  // Xác định phương thức và URL để gửi dữ liệu
  xhr.open("POST", "./saveinformation/save_lop.php", true);

  // Xử lý khi nhận được phản hồi từ server
  xhr.onload = function () {
    if (xhr.status === 200) {
      alert("Thông tin lớp học đã được thêm.");
    } else {
      alert("Có lỗi xảy ra. Vui lòng thử lại sau.");
    }
  };

  // Đặt header cho request
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  // Gửi dữ liệu mã lớp lên server
  const data = `maLP=${maLP}&tenLP=${tenLP}&niemKhoa=${niemKhoa}`;
  xhr.send(data);
}

document.getElementById("sinhVienForm").addEventListener("submit", function (event) {
    event.preventDefault();

    const maSV = document.getElementById("maSV").value;
    const tenSV = document.getElementById("tenSV").value;
    const diaChi = document.getElementById("diaChi").value;
    const maLP_SV = document.getElementById("maLP_SV").value;

    // Kiểm tra tính hợp lệ của dữ liệu 
    saveSinhVien(maSV, tenSV, diaChi, maLP_SV);
  });

function saveSinhVien(maSV, tenSV, diaChi, maLP_SV) {
  // Check if the class ID exists in the "lop" table
  const xhrCheckClass = new XMLHttpRequest();
  xhrCheckClass.open("POST", "./admin/check_class.php", true);
  xhrCheckClass.setRequestHeader(
    "Content-type",
    "application/x-www-form-urlencoded"
  );
  xhrCheckClass.onload = function () {
    if (xhrCheckClass.status === 200) {
      const response = JSON.parse(xhrCheckClass.responseText);
      if (response.classExists) {
        // Class exists, proceed to save the student
        saveStudentToDatabase(maSV, tenSV, diaChi, maLP_SV);
      } else {
        // Class does not exist, prompt the user to enter a valid class ID
        alert("Mã lớp không tồn tại. Vui lòng nhập mã lớp khác.");
      }
    } else {
      alert("Có lỗi xảy ra. Vui lòng thử lại sau.");
    }
  };
  const dataCheckClass = `maLP=${maLP_SV}`;
  xhrCheckClass.send(dataCheckClass);
}

function saveStudentToDatabase(maSV, tenSV, diaChi, maLP_SV) {
  // Tạo XMLHttpRequest object để gửi dữ liệu lên server
  const xhr = new XMLHttpRequest();

  // Xác định phương thức và URL để gửi dữ liệu
  xhr.open("POST", "./saveinformation/save_sinhvien.php", true);

  // Xử lý khi nhận được phản hồi từ server
  xhr.onload = function () {
    if (xhr.status === 200) {
      alert("Thông tin sinh viên đã được thêm.");
    } else {
      alert("Có lỗi xảy ra. Vui lòng thử lại sau.");
    }
  };

  // Đặt header cho request
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  // Gửi dữ liệu sinh viên lên server
  const data = `maSV=${maSV}&tenSV=${tenSV}&diaChi=${diaChi}&maLP_SV=${maLP_SV}`;
  xhr.send(data);
}

document.getElementById("diemSVForm").addEventListener("submit", function (event) {
    event.preventDefault();

    const maSV_Diem = document.getElementById("maSV_Diem").value;
    const maMH_Diem = document.getElementById("maMH_Diem").value;
    const diem = document.getElementById("diem").value;

    // Kiểm tra tính hợp lệ của dữ liệu 
    saveDiemSV(maSV_Diem, maMH_Diem, diem);
  });

function saveDiemSV(maSV_Diem, maMH_Diem, diem) {
  // Check if the student ID and subject ID exist
  const xhrCheckStudentAndSubject = new XMLHttpRequest();
  xhrCheckStudentAndSubject.open("POST", "./admin/check_student_subject.php", true);
  xhrCheckStudentAndSubject.setRequestHeader(
    "Content-type",
    "application/x-www-form-urlencoded"
  );
  xhrCheckStudentAndSubject.onload = function () {
    if (xhrCheckStudentAndSubject.status === 200) {
      const response = JSON.parse(xhrCheckStudentAndSubject.responseText);
      if (response.studentExists && response.subjectExists) {
        // Student and subject exist, proceed to save the grade
        saveGradeToDatabase(maSV_Diem, maMH_Diem, diem);
      } else {
        let errorMessage = "Có lỗi xảy ra:";
        if (!response.studentExists) {
          errorMessage += " Mã sinh viên không tồn tại.";
        }
        if (!response.subjectExists) {
          errorMessage += " Mã môn học không tồn tại.";
        }
        alert(errorMessage);
      }
    } else {
      alert("Có lỗi xảy ra. Vui lòng thử lại sau.");
    }
  };
  const dataCheckStudentAndSubject = `maSV_Diem=${maSV_Diem}&maMH_Diem=${maMH_Diem}`;
  xhrCheckStudentAndSubject.send(dataCheckStudentAndSubject);
}

function saveGradeToDatabase(maSV_Diem, maMH_Diem, diem) {
  //  Tạo XMLHttpRequest object để gửi dữ liệu lên server
  const xhr = new XMLHttpRequest();

  // Xác định phương thức và URL để gửi dữ liệu
  xhr.open("POST", "./saveinformation/save_diemsv.php", true);

  // Xử lý khi nhận được phản hồi từ server
  xhr.onload = function () {
    if (xhr.status === 200) {
      alert("Đã cập nhật điểm sinh viên.");
    } else {
      alert("Có lỗi xảy ra. Vui lòng thử lại sau.");
    }
  };

  // Đặt header cho request
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  // Gửi dữ liệu mã điểm lên server
  const data = `maSV_Diem=${maSV_Diem}&maMH_Diem=${maMH_Diem}&diem=${diem}`;
  xhr.send(data);
}


function displaySelectedOption() {
  var selectedOption = document.getElementById("select1").value;

  if (selectedOption === "option1") {
    // Send an AJAX request to fetch monhoc data
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        // Display the data in the monhocTable div
        document.getElementById("monhocTable").innerHTML = xhr.responseText;
        document.getElementById("view-port").style.display = "block";
        document.getElementById("monhocTable").style.display = "block";
        document.getElementById("lophocTable").style.display = "none";
        document.getElementById("diemsvTable").style.display = "none";
        document.getElementById("sinhvienTable").style.display = "none";
        document.getElementById("dssvTable").style.display = "none";
        document.getElementById("dsmhTable").style.display = "none";
      }
    };
    xhr.open("GET", "./getinformation/get_monhoc.php", true);
    xhr.send();
  }

  if (selectedOption === "option2") {
    // Send an AJAX request to fetch monhoc data
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        // Display the data in the monhocTable div
        document.getElementById("lophocTable").innerHTML = xhr.responseText;
        document.getElementById("view-port").style.display = "block";
        document.getElementById("lophocTable").style.display = "block";
        document.getElementById("monhocTable").style.display = "none";
        document.getElementById("diemsvTable").style.display = "none";
        document.getElementById("sinhvienTable").style.display = "none";
        document.getElementById("dssvTable").style.display = "none";
        document.getElementById("dsmhTable").style.display = "none";
      }
    };
    xhr.open("GET", "./getinformation/get_lophoc.php", true);
    xhr.send();
  }

  if (selectedOption === "option3") {
    // Send an AJAX request to fetch monhoc data
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        // Display the data in the monhocTable div
        document.getElementById("diemsvTable").innerHTML = xhr.responseText;
        document.getElementById("view-port").style.display = "block";
        document.getElementById("diemsvTable").style.display = "block";
        document.getElementById("lophocTable").style.display = "none";
        document.getElementById("monhocTable").style.display = "none";
        document.getElementById("sinhvienTable").style.display = "none";
        document.getElementById("dssvTable").style.display = "none";
        document.getElementById("dsmhTable").style.display = "none";
      }
    };
    xhr.open("GET", "./getinformation/get_diemsv.php", true);
    xhr.send();
  }

  if (selectedOption === "option4") {
    // Send an AJAX request to fetch monhoc data
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        // Display the data in the monhocTable div
        document.getElementById("sinhvienTable").innerHTML = xhr.responseText;
        document.getElementById("view-port").style.display = "block";
        document.getElementById("sinhvienTable").style.display = "block";
        document.getElementById("lophocTable").style.display = "none";
        document.getElementById("monhocTable").style.display = "none";
        document.getElementById("diemsvTable").style.display = "none";
        document.getElementById("dssvTable").style.display = "none";
        document.getElementById("dsmhTable").style.display = "none";
      }
    };
    xhr.open("GET", "./getinformation/get_sinhvien.php", true);
    xhr.send();
  }

  if (selectedOption === "option5") {
    // Send an AJAX request to fetch monhoc data
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        // Display the data in the monhocTable div
        document.getElementById("dssvTable").innerHTML = xhr.responseText;
        document.getElementById("view-port").style.display = "block";
        document.getElementById("dssvTable").style.display = "block";
        document.getElementById("sinhvienTable").style.display = "none";
        document.getElementById("lophocTable").style.display = "none";
        document.getElementById("monhocTable").style.display = "none";
        document.getElementById("diemsvTable").style.display = "none";
        document.getElementById("sinhvienTable").style.display = "none";
        document.getElementById("dsmhTable").style.display = "none";
      }
    };
    xhr.open("GET", "./getinformation/get_dssv.php", true);
    xhr.send();
  }

  if (selectedOption === "option7") {
    // Send an AJAX request to fetch monhoc data
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        // Display the data in the monhocTable div
        document.getElementById("dsmhTable").innerHTML = xhr.responseText;
        document.getElementById("view-port").style.display = "block";
        document.getElementById("dsmhTable").style.display = "block";
        document.getElementById("lophocTable").style.display = "none";
        document.getElementById("monhocTable").style.display = "none";
        document.getElementById("diemsvTable").style.display = "none";
        document.getElementById("dssvTable").style.display = "none";
        document.getElementById("sinhvienTable").style.display = "none";
      }
    };
    xhr.open("GET", "./getinformation/get_dsmh.php", true);
    xhr.send();
  }

  if (selectedOption === "option8") {
    // Send an AJAX request to fetch monhoc data
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        // Display the data in the monhocTable div
        document.getElementById("dsmhTable").innerHTML = xhr.responseText;
        document.getElementById("view-port").style.display = "block";
        document.getElementById("dsmhTable").style.display = "block";
        document.getElementById("lophocTable").style.display = "none";
        document.getElementById("monhocTable").style.display = "none";
        document.getElementById("diemsvTable").style.display = "none";
        document.getElementById("dssvTable").style.display = "none";
        document.getElementById("sinhvienTable").style.display = "none";
      }
    };
    xhr.open("GET", "./getinformation/get_dsmh1.php", true);
    xhr.send();
  }

  if (selectedOption === "option6") {
    // Send an AJAX request to fetch monhoc data
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        // Display the data in the monhocTable div
        document.getElementById("dssvTable").innerHTML = xhr.responseText;
        document.getElementById("view-port").style.display = "block";
        document.getElementById("dssvTable").style.display = "block";
        document.getElementById("sinhvienTable").style.display = "none";
        document.getElementById("lophocTable").style.display = "none";
        document.getElementById("monhocTable").style.display = "none";
        document.getElementById("diemsvTable").style.display = "none";
        document.getElementById("sinhvienTable").style.display = "none";
        document.getElementById("dsmhTable").style.display = "none";
      }
    };
    xhr.open("GET", "./getinformation/get_dssv1.php", true);
    xhr.send();
  }
}

function toggleViewPort() {
  var viewPort = document.getElementById('view-port');
  var monhoctable = document.getElementById('monhocTable');
  var lophoctable = document.getElementById('lophocTable');
  var diemsvtable = document.getElementById('diemsvTable');
  var sinhvientable = document.getElementById('sinhvienTable');
  var dssvtable = document.getElementById('dssvTable');
  var dsmhtable = document.getElementById('dsmhTable');

  viewPort.style.display = "none";
  monhoctable.style.display = "none";
  diemsvtable.style.display = "none";
  lophoctable.style.display = "none";
  sinhvientable.style.display = "none";
  dssvtable.style.display = "none";
  dsmhtable.style.display = "none";
}



