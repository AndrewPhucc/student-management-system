<?php
$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "QLSV";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$sql = "SELECT * FROM LOP";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Mã lớp học</th><th>Tên lớp học</th><th>Niên khóa</th><th>Chức Năng</th><th>Chức Năng</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["MALP"]. "</td><td>" . $row["TENLP"]. "</td><td>" . $row["NK"]. "</td>";
        echo "<td><a href='./delete/xoalophoc.php?malp=" . $row['MALP'] . "'><button name='click'>xóa</button></a></td>";
        echo "<td><a href='./fix/sualop.php?malp=" . $row['MALP'] . "'><button >Sửa</button></a></td>";
    }

    echo "</table>";
} else {
    echo "0 results";
}
echo "</br>";
echo "<tr>";
echo "<form action='./exportfile/exportlop.php' method='POST' class='mb-2'</form>";
echo "<input type='submit' name='submit' class='btn-on' value='Xuất PDF'/>";
echo "</tr>";


$conn->close();
?>
