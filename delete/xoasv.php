<?php
$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "QLSV";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if(isset($_GET["masv"])){
    echo $masv = $_GET["masv"];
   
}



$sql = "DELETE FROM sinhvien WHERE MASV = '$masv'";
if (mysqli_query($conn, $sql)) {
    echo "<script>alert('xóa dữ liệu thành công');</script>";
    header("location:../home.html");
} 
else {
    echo "alert('Lỗi xóa dữ liệu:')" . mysqli_error($conn);
}


mysqli_close($conn);
?>