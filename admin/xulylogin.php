<?php
//truy xuất db
$servername = "localhost";
$username = "root";
$password = "123456789"; 
$dbname = "QLSV"; 

// Create a connection to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



session_start();

if (isset($_POST['btn'])) {
  // Tiếp nhận user, pass từ form
  $u = $_POST['u'];
  $p = $_POST['p'];

  // Validate dữ liệu tiếp nhận
  $u = trim(strip_tags($u));
  $p = trim(strip_tags($p));

  // Truy vấn dữ liệu
 
  $sql = "SELECT idUSERS, username, idgroup FROM users WHERE username='{$u}'";
  $result = $conn->query($sql);

  if ($result->num_rows == 0) {
    $_SESSION['thongbao'] = "Username không tồn tại";
    header("location: ../login.php");
    exit();
  }

  $sql = "SELECT idUSERS, username, idgroup FROM users WHERE username='{$u}' AND pass='{$p}'";
  $result = $conn->query($sql);
  if ($result->num_rows == 0) {
    // Sai pass
    $_SESSION['thongbao'] = "Mật khẩu không đúng";
    header("location: ../login.php");
    exit();
  }
  $row_user = $result->fetch_assoc();
  $idGroup = $row_user['idgroup'];
  
  if ($idGroup == 0) {
    // Không cho phép đăng nhập với idgroup = 0
    $_SESSION['thongbao'] = "Tài khoản không hợp lệ";
    header("location: ../login.php");
    exit();
  }

  $row_user = $result->fetch_assoc();
  $_SESSION['login_id'] = $row_user['idUSERS'];  // Tạo biến ghi nhận user đã login
  $_SESSION['login_user'] = $row_user['username'];  // Tạo biến ghi nhận user đã login 
  $_SESSION['login_group'] = $row_user['idgroup'];  // User trong nhóm nào 
  header("location: ../home.html");  // Chuyển đến trang chủ admin
}
?>



