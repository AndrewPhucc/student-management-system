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

$maLP = $_POST['maLP'];
$tenLP = $_POST['tenLP'];
$niemKhoa = $_POST['niemKhoa'];

// Chuẩn bị câu lệnh SQL để thêm dữ liệu vào bảng LOP
$sql = "INSERT INTO LOP (MALP, TENLP, NK) VALUES ('$maLP', '$tenLP', $niemKhoa)";

if ($conn->query($sql) === TRUE) {
    echo "Dữ liệu đã được thêm thành công.";
} else {
    echo "Có lỗi xảy ra: " . $conn->error;
}

// Đóng kết nối đến MySQL
$conn->close();
?>
