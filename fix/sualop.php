<?php
$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "QLSV";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if(isset($_GET["malp"])){
     $malp = $_GET["malp"];
   
}
 // lấy dữ liệu trước khi sửa
$sql = "SELECT * FROM lop where MALP = '$malp'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);


// sửa dữ liệu từ bảng lop

if(isset($_POST['click'])){

    $tenlp=$_POST["tenlp"];
    $nk=$_POST["nk"];
    $sql = "UPDATE lop SET TENLP = '$tenlp', NK='$nk' WHERE MALP = '$malp' ";
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
            <label for="maMH">Mã lớp học:</label>
            <input type="text" id="maMH" name="maMH" value="<?= $row['MALP'] ?>" /> <br>

          <label for="TENLP">Tên lớp học:</label>
          <input type="text" id="tenlp" name="tenlp" value="<?= $row['TENLP'] ?>" /> <br>

          <label for="soTC">Niên khóa:</label>
          <input type="text" id="soTC" name="nk" value="<?= $row['NK'] ?>"/> <br>
          <button type="submit" name="click" >Sửa Lớp Học</button>
        
     
    </div>

</form>   
