<?php
require '../carbon/autoload.php';
include("../includes/db.php");

use Carbon\Carbon;

session_start();

if (isset($_POST['thoigian'])) {
    $thoigian = $_POST['thoigian'];
    $_SESSION['metric_date'] = $thoigian;
} else {
    $thoigian = '';
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
}

if ($thoigian == '7ngay') {
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
} elseif ($thoigian == '28ngay') {
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(28)->toDateString();
} elseif ($thoigian == '90ngay') {
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(90)->toDateString();
} elseif ($thoigian == '365ngay') {
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
}

$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

$sql = "SELECT order_date, SUM(due_amount) AS total_revenue, SUM(product_quantity) AS total_quantity , SUM(invoice_no) AS invoice_no FROM customer_orders WHERE order_date BETWEEN '$subdays' AND '$now' GROUP BY order_date ORDER BY order_date ASC";
$sql_query = mysqli_query($conn, $sql);

$data = [];
while ($row = mysqli_fetch_assoc($sql_query)) {
    $data[] = [
        'invoice_no' => $row['invoice_no'],
        'order_date' => $row['order_date'],
        'total_revenue' => number_format($row['total_revenue'], 0, '', ',') . 'đ',
        'total_quantity' => $row['total_quantity'],
    ];
}

echo json_encode($data);