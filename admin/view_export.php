<?php
ob_start();

include("../includes/db.php");
require '../carbon/autoload.php';
require("../vendor/autoload.php");

use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

session_start();

if (!isset($_SESSION['metric_date'])) {
    exit('Session metric_date is not set.');
}

$thoigian = $_SESSION['metric_date'];
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'Ngày');
$sheet->setCellValue('B1', 'Số đơn');
$sheet->setCellValue('C1', 'Số lượng');
$sheet->setCellValue('D1', 'Doanh thu');

$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

$subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(intval($thoigian))->toDateString();

$sql = "SELECT * FROM customer_orders WHERE order_date BETWEEN '$subdays' AND '$now' ORDER BY order_date ASC";
$sql_query = mysqli_query($conn, $sql);
$rowIndex = 2;

while ($row = mysqli_fetch_array($sql_query)) {
    $sheet->setCellValue('A' . $rowIndex, $row['order_date']);
    $sheet->setCellValue('B' . $rowIndex, $row['order_id']); 
    $sheet->setCellValue('C' . $rowIndex, $row['product_quantity']); 
    $sheet->setCellValue('D' . $rowIndex, $row['due_amount']);
    $rowIndex++;
}

$writer = new Xlsx($spreadsheet);
$fileName = 'thongke_' . date('Y-m-d') . '.xlsx'; // Sử dụng .xlsx cho định dạng Excel mới
$writer->save($fileName);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $fileName . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output');

header('index.php?view_revenue&message=success');

exit();
?>
