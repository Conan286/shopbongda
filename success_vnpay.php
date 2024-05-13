<?php 
if ($_SERVER["REQUEST_METHOD"] == "GET")
{
    if ($_GET['vnp_ResponseCode'] == '00') 
    {

        header('Location: ' . 'http://localhost/shopthoitrang/success_result.php');
    }
    else {
        echo ('Lỗi giao dịch');
    }
    exit();
}

?>