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
    $pdf->SetTitle('Xuất file PDF Điểm');
    $pdf->SetSubject('Xuất file PDF Điểm');
    $pdf->SetKeywords('PDF, Điểm');

    // Thêm trang đầu tiên
    $pdf->AddPage();

    // Đặt font cho tiêu đề
    $pdf->SetFont('dejavusans', '', 14);

    // In tiêu đề và căn giữa
    $pdf->Cell(0, 10, 'Xuất file PDF Điểm', 0, 1, 'C');

    // Tạo bảng và căn giữa
    $pdf->SetFont('dejavusans', 'B', 12);
    $pdf->SetXY(30, 50); // Điều chỉnh vị trí xuất phát cho bảng
    $pdf->Cell(40, 10, 'Mã sinh viên', 1);
    $pdf->Cell(60, 10, 'Mã môn học', 1);
    $pdf->Cell(40, 10, 'Điểm', 1);
    $pdf->Ln();

    // Truy vấn cơ sở dữ liệu và thêm dữ liệu vào bảng
    $sql = "select * from diemsv";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        while ($data = mysqli_fetch_assoc($query)) {
            $pdf->SetX(30); // Điều chỉnh vị trí xuất phát cho dòng dữ liệu
            $pdf->Cell(40, 10, $data["MASV"], 1);
            $pdf->Cell(60, 10, $data["MAMH"], 1);
            $pdf->Cell(40, 10, $data["DIEM"], 1);
            $pdf->Ln();
        }
    } else {
        $pdf->SetX(15);
        $pdf->Cell(140, 10, 'Không có dữ liệu', 1);
    }

    // Tạo tệp PDF và tải về trình duyệt
    $pdf->Output('diem.pdf', 'D');
    exit;
}


?>