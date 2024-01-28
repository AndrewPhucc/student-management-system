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

$maLP = $_POST['maLP'];

// Prepare SQL statement to check if the class ID exists
$sql_check_class = "SELECT COUNT(*) AS count FROM LOP WHERE MALP = '$maLP'";
$result = $conn->query($sql_check_class);

if ($result) {
    $row = $result->fetch_assoc();
    $classExists = $row['count'] > 0;
    echo json_encode(array('classExists' => $classExists));
} else {
    echo "Error: " . $conn->error;
}

// Close the connection to MySQL
$conn->close();
?>
