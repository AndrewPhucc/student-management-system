<?php
 require_once('../tcpdf/tcpdf.php');

$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "QLSV";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

extract($_POST);

if (isset($submit)) {
    // Sử dụng thư viện TCPDF
    require_once('../tcpdf/tcpdf.php');

    // Khởi tạo đối tượng TCPDF
    $pdf = new TCPDF();

    // Thiết lập metadata cho tệp PDF (tùy chọn)
    $pdf->SetCreator('Your Name');
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Xuất file PDF Lớp Học');
    $pdf->SetSubject('Xuất file PDF Lớp Học');
    $pdf->SetKeywords('PDF, lớp học');

    // Thêm trang đầu tiên
    $pdf->AddPage();

    // Đặt font cho tiêu đề
    $pdf->SetFont('dejavusans', '', 14);

    // In tiêu đề
    $pdf->Cell(0, 10, 'Xuất file PDF Lớp Học', 0, 1, 'C');

    // Tạo bảng
    $pdf->SetFont('dejavusans', 'B', 12);
    $pdf->Cell(40, 10, 'Mã Lớp', 1);
    $pdf->Cell(60, 10, 'Tên Lớp', 1);
    $pdf->Cell(40, 10, 'Niên Khóa', 1);
    $pdf->Ln();

    // Truy vấn cơ sở dữ liệu và thêm dữ liệu vào bảng
    $sql = "select * from lop";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        while ($data = mysqli_fetch_assoc($query)) {
            $pdf->Cell(40, 10, $data["MALP"], 1);
            $pdf->Cell(60, 10, $data["TENLP"], 1);
            $pdf->Cell(40, 10, $data["NK"], 1);
            $pdf->Ln();
        }
    } else {
        $pdf->Cell(140, 10, 'Không có dữ liệu', 1);
    }

    // Tạo tệp PDF và tải về trình duyệt
    $pdf->Output('lop.pdf', 'D');

    exit;
}


?>