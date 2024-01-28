<?php
$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "QLSV";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$sql = "SELECT * FROM SINHVIEN";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Mã sinh viên</th><th>Tên sinh viên</th><th>Địa chỉ</th><th>Mã lớp</th><th>Chức Năng</th><th>Chức Năng</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["MASV"]. "</td>
                    <td>" . $row["TENSV"]. "</td>
                    <td>" . $row["DCSV"]. "</td>
                    <td>" . $row["MALP"]. "</td>";
                    echo "<td><a href='./delete/xoasv.php?masv=" . $row['MASV'] . "'><button name='click'>xóa</button></a></td>";
                    echo "<td><a href='./fix/suasv.php?masv=" . $row['MASV'] . "'><button >Sửa</button></a></td>";

    }
    echo "</table>";
} else {
    echo "0 results";
}
echo "</br>";
echo "<tr>";
echo "<form action='./exportfile/exportsv.php' method='POST' class='mb-2'</form>";
echo "<input type='submit' name='submit' class='btn-on' value='Xuất PDF'/>";
echo "</tr>";


$conn->close();
?>

