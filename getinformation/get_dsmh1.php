<?php
$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "QLSV";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$sql = "SELECT * FROM MONHOC WHERE SOTC = 3"; 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Mã môn học</th><th>Tên môn học</th><th>Số tín chỉ</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["MAMH"]. "</td><td>" . $row["TENMH"]. "</td><td>" . $row["SOTC"]. "</td>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
echo "</br>";
echo "<tr>";
echo "<form action='./exportfile/exportdsmh1.php' method='POST' class='mb-2'</form>";
echo "<input type='submit' name='submit' class='btn-on' value='Xuất PDF'/>";
echo "</tr>";


$conn->close();
?>