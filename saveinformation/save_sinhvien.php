<?php
$servername = "localhost";
$username = "root"; // Thay your_username bằng tên người dùng MySQL của bạn
$password = "123456789"; // Thay your_password bằng mật khẩu MySQL của bạn
$dbname = "QLSV"; // Thay QLSV bằng tên cơ sở dữ liệu của bạn

// Tạo kết nối đến MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$maSV = $_POST['maSV'];
$tenSV = $_POST['tenSV'];
$diaChi = $_POST['diaChi'];
$maLP_SV = $_POST['maLP_SV'];

// Chuẩn bị câu lệnh SQL để thêm dữ liệu vào bảng SINHVIEN
$sql = "INSERT INTO SINHVIEN (MASV, TENSV, DCSV, MALP) VALUES ('$maSV', '$tenSV', '$diaChi', '$maLP_SV')";

if ($conn->query($sql) === TRUE) {
    echo "Dữ liệu đã được thêm thành công.";
} else {
    echo "Có lỗi xảy ra: " . $conn->error;
}

// Đóng kết nối đến MySQL
$conn->close();
?>
