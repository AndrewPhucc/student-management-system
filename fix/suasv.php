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
     $masv = $_GET["masv"];
   
}
 // lấy dữ liệu trước khi sửa
$sql = "SELECT * FROM sinhvien where MASV = '$masv'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);


// sửa dữ liệu từ bảng sinhvien

if(isset($_POST['click'])){

    $tensv=$_POST["tensv"];
    $dcsv=$_POST["dcsv"];
    $malp=$_POST["malp"];
    $sql = "UPDATE sinhvien SET TENSV = '$tensv', DCSV='$dcsv', MALP='$malp' WHERE MASV = '$masv' ";
    $query = mysqli_query($conn, $sql);
    header("location:../home.html");
}

// Đóng kết nối
mysqli_close($conn);
?>

<style>
    body{
        background-image: url("../background.png");
        background-size:cover;
        background-repeat:none;
    }
form{
    width:500px;
    height:400px;
    background-image:  linear-gradient(rgb(159, 232, 231), rgb(243, 243, 232));
    border:1px solid;
    margin:0 auto;
    padding: 5px;
    text-align:center;
    border-radius:10px

}
.main{
    margin-top: 60px;
}

.main label {
        display: inline-block;
        width: 120px;
        margin-right: 10px;
    }
.main input {
        display: inline-block;
        width: 200px;
        padding: 5px;
        margin-bottom: 10px;
  
}

.main button {
        margin-top: 10px;
        background-color: blue;
        color: white;
        border: none;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
        border-radius: 4px;
    }

    .main button:hover {
        background-color: #45a049;
    }



</style>

<form action="" method="POST">
    <div class="main"> 
        <p>Sửa Thông Tin</p>
            <label for="maMH">Mã sinh viên:</label>
            <input type="text" id="masv" name="masv" value="<?= $row['MASV'] ?>" /> <br>

          <label for="tenMH">Tên sinh viên:</label>
          <input type="text" id="tensv" name="tensv" value="<?= $row['TENSV'] ?>" /> <br>

          <label for="dcsv">Địa chỉ sinh viên:</label>
          <input type="text" id="dcsv" name="dcsv" value="<?= $row['DCSV'] ?>" /> <br>


          <label for="soTC">Mã lớp:</label>
          <input type="text" id="malp" name="malp" value="<?= $row['MALP'] ?>"/> <br>
          <button type="submit" name="click" >Sửa Sinh Viên</button>
        
     
    </div>

</form>   
