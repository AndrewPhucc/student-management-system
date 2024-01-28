<?php 
$u=$_POST['username'];
$pass =  $_POST['pass'];
$repass = $_POST['repass'];
$email = $_POST['email'];
$phai = $_POST['phai'];
$idgroup = $_POST["idgroup"];


//validate dữ liệu $u = trim(strip_tags($u)); 
$pass = trim(strip_tags ($pass));
$repass = trim(strip_tags($repass));
$email = trim(strip_tags($email));
settype($phai, "int");
settype($idgroup, "int");
//Kiểm tra và báo lỗi
$loi="";

if ($phai!=0 && $phai!=1) $loi = "Chọn phái đi nha bạn<br>";
if (filter_var($email,FILTER_VALIDATE_EMAIL)==false) $loi .= "Email không đúng<br>";
if ($pass!=$repass) $loi = "Hai mật khẩu không giống nhau<br>";

?>
<?php 
if ($loi!="" ){ ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" rel= "stylesheet">
    <div class="col-8 m-auto">
        <div class="alert alert-danger mt-5 text-center "> 
            <?=$loi?> 
            <button class="btn btn-primary" onclick="history.back()">Trở lại</button>
        </div>
    </div>
<?php } else { 
          
          // ket noi sql
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

            //truy van 
 $sql = "INSERT INTO users (username, pass, email, idgroup) VALUES ('$u', '$pass', '$email' , '$idgroup')";
 $kq = $conn->query($sql);
 if ($kq) {
     header("location:../login.html");
     // Gửi mail
 } else {
     echo "Cập nhật không thành công";
 }
} ?>
