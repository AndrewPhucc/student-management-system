<?php
$servername = "localhost";
$username = "root"; 
$password = "123456789"; 
$dbname = "QLSV"; 

// Tạo kết nối đến MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy dữ liệu từ form
$maMH = $_POST['maMH'];
$tenMH = $_POST['tenMH'];
$soTC = $_POST['soTC'];

// Chuẩn bị câu lệnh SQL để thêm dữ liệu vào bảng MONHOC
$sql = "INSERT INTO MONHOC (MAMH, TENMH, SOTC) VALUES ('$maMH', '$tenMH', '$soTC')";

if ($conn->query($sql) === TRUE) {
    echo "Dữ liệu đã được thêm thành công.";
} else {
    echo "Có lỗi xảy ra: " . $conn->error;
}

// Đóng kết nối đến MySQL
$conn->close();
?>
