<?php
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

$maSV_Diem = $_POST['maSV_Diem'];
$maMH_Diem = $_POST['maMH_Diem'];

// Check if the student exists
$sql_check_student = "SELECT COUNT(*) AS count FROM SINHVIEN WHERE MASV = '$maSV_Diem'";
$result_student = $conn->query($sql_check_student);
$row_student = $result_student->fetch_assoc();
$studentExists = $row_student['count'] > 0;

// Check if the subject exists
$sql_check_subject = "SELECT COUNT(*) AS count FROM MONHOC WHERE MAMH = '$maMH_Diem'";
$result_subject = $conn->query($sql_check_subject);
$row_subject = $result_subject->fetch_assoc();
$subjectExists = $row_subject['count'] > 0;

// Return the response as JSON
$response = array('studentExists' => $studentExists, 'subjectExists' => $subjectExists);
echo json_encode($response);

// Close the connection to MySQL
$conn->close();
?>
