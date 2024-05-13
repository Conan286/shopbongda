<?php
require('../tfpdf/tfpdf.php');
include("../includes/db.php");

date_default_timezone_set('Asia/Ho_Chi_Minh');
$ngay_gio_hien_tai = date('Y-m-d H:i:s');

$pdf = new tFPDF();

$pdf->AddPage("A3");

$pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
$pdf->SetFont('DejaVu', '', 13);

$pdf->SetFillColor(400, 400, 252);

$code_orders = $_GET['code_orders'];

// Sử dụng biến ràng buộc ?
$sql_info = "SELECT * FROM customer_orders WHERE invoice_no = ?";
$stmt = $conn->prepare($sql_info);
$stmt->bind_param("s", $code_orders);
$stmt->execute();
$result = $stmt->get_result();
$row_info = $result->fetch_assoc();

$sql_name_product = "SELECT co.product_quantity, co.product_id, p.product_title, p.product_price, p.product_sale
                     FROM customer_orders co
                     LEFT JOIN products p ON co.product_id = p.product_id WHERE invoice_no = '$code_orders'";

$result = mysqli_query($conn, $sql_name_product);

$get_name_pro = "SELECT customer_orders.customer_id,customers.customer_name FROM customer_orders INNER JOIN customers ON customer_orders.customer_id = customers.customer_id ";
$query_list_name = mysqli_query($conn, $get_name_pro);

if ($query_list_name->num_rows > 0) {
    while ($item = $query_list_name->fetch_assoc()) {
        $customer_id = $item["customer_id"];
        $customer_name = $item["customer_name"];
        $ordo_customer[$customer_id] = $customer_name;
    }
}

$customer_id = $row_info["customer_id"];
$customer_name = isset($ordo_customer[$customer_id]) ? $ordo_customer[$customer_id] : '';

$pdf->SetFont('DejaVu', '', 20);
$pdf->Cell(130, 5, 'SHOP THỜI TRANG', 0, 0);

$pdf->Cell(100, 5, '', 0, 1);
$pdf->Ln(5);

$pdf->SetFont('DejaVu', '', 12);

$pdf->Cell(130, 5, '60, P. Tam Phú, TP Thủ Đức', 0, 0);
$pdf->Ln(5);
$pdf->Cell(130, 5, 'info@shopthoitrang.com', 0, 0);
$pdf->Ln(5);
$pdf->Cell(130, 5, '0938 xxx xxx', 0, 0);

$pdf->SetX(30);
$pdf->Ln(5);
$pdf->SetFont('DejaVu', '', 25);
$pdf->Cell(0, 10, 'ĐƠN ĐẶT HÀNG', 0, 1, 'C');
$pdf->SetFont('DejaVu', '', 13);

$pdf->Ln(5);
$pdf->Cell(0, 10, "Ngày lập: " . $ngay_gio_hien_tai, 0, 1, 'C');
$pdf->Cell(0, 10, "Mã hóa đơn: " . $row_info['invoice_no'], 0, 1, 'C');
$pdf->Ln(5);

$currentX = $pdf->GetX();
$currentY = $pdf->GetY();
$pdf->SetFont('DejaVu', '', 13);
$pdf->SetX($currentX);

$pdf->Write(0, "Tên khách hàng: " . $customer_name . "");
$pdf->Ln(10);

$pdf->Cell(35, 10, 'Mã SP', 1, 0, 'C');
$pdf->Cell(130, 10, 'Tên Sản Phẩm', 1, 0, 'C');
$pdf->Cell(30, 10, 'Giá Bán', 1, 0, 'C');
$pdf->Cell(35, 10, 'Số Lượng', 1, 0, 'C');
$pdf->Cell(45, 10, 'Tổng Tiền', 1, 1, 'C');

$total_before_vat = 0;

foreach ($result as $order_item) {
    $product_price = $order_item['product_price'];
    $product_quantity = $order_item['product_quantity'];

    $tong_tien_truoc_vat = $product_price * $product_quantity;
    $total_before_vat += $tong_tien_truoc_vat;

    // Hiển thị thông tin sản phẩm
    $pdf->Cell(35, 10, $order_item['product_id'], 1);
    $pdf->Cell(130, 10, $order_item['product_title'], 1);
    $pdf->Cell(30, 10, number_format($product_price, 0, '', ',') . 'đ', 1);
    $pdf->Cell(35, 10, $product_quantity, 1);
    $pdf->Cell(45, 10, number_format($tong_tien_truoc_vat, 0, '', ',') . 'đ', 1);
    $pdf->Ln();
}

$pdf->Ln(10);

$pdf->Cell(0, 10, 'Tổng Tiền Hóa Đơn: ' . number_format($total_before_vat, 0, '', ',') . 'đ', 0, 1);

$pdf->Cell(0, 10, "Ngày ... tháng ... năm ...", 0, 1, 'R');
$pdf->Ln(5);

$pdf->Cell(120, 5, 'Người mua hàng', 0, 0);
$pdf->Cell(120, 5, 'Kế toán trưởng', 0, 0);
$pdf->Cell(120, 5, 'Giám đốc', 0, 1);
$pdf->Ln(5);
$pdf->Cell(123, 5, '(Ký, họ tên)', 0, 0);
$pdf->Cell(105, 5, '(Ký, họ tên)', 0, 0);
$pdf->Cell(100, 5, '(Ký, họ tên, đóng dấu)', 0, 1);
$pdf->Ln(10);


$pdf->Ln(10);

$pdf->Output();
