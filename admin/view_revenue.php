<?php 
    
    if (!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {

?>

<div class="row">
    <div class="col">
        <div class="header__list d-flex space-between align-center">
            <h4 class="card-title" style="margin: 10px;">Thống kê đơn hàng</h4>
            <div class="action_group">
                <a href="../admin/view_export.php" id="btnExport" class="btn btn-primary">Export</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- ... Các phần khác của giao diện của bạn -->
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="main-pane-top d-flex space-between align-center" style="padding-inline: 10px;">
                <div class="option-date d-flex space-between">
                        <select id="select-date" class="select-date-tk">
                            <option value="">Chọn thời gian</option>
                            <option value="7ngay">7 ngày qua</option>
                            <option value="28ngay">28 ngày qua</option>
                            <option value="90ngay">90 ngày qua</option>
                            <option value="365ngay">365 ngày qua</option>
                        </select>
                    </div>
                    <h4 class="card-title" style="margin: 0;">Thống kê đơn hàng theo <span id="text-date"></span></h4>
                </div>
                <div class="metrics d-flex space-between">
                <div>Tổng số doanh thu: <span id="total-revenue"></span></div>
                </div>
                <div class="table-responsive">
                    <table class="table" id="statistical-table">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $('#select-date').change(function() {
    
    var thoigian = $(this).val();
    if (thoigian == '7ngay') {
        var text = '7 ngày qua';
    } else if (thoigian == '28ngay') {
        var text = '28 ngày qua';
    } else if (thoigian == '90ngay') {
        var text = '90 ngày qua';
    } else {
        var text = '365 ngày qua';
    }
    
    $('#text-date').text(text);
    
    $.ajax({
        url: "../admin/view_statistical.php",
        method: "POST",
        data: { thoigian: thoigian },
        success: function(data) {
            var jsonData = JSON.parse(data);
            var tableHtml = '<tr><th>Mã đơn hàng</th><th>Ngày đặt hàng</th><th>Tổng số doanh thu</th><th>Tổng số lượng sản phẩm</th></tr>';

            jsonData.forEach(function(item) {
                tableHtml += '<tr>';
                tableHtml += '<td>' + item.invoice_no + '</td>';
                tableHtml += '<td>' + item.order_date + '</td>';
                tableHtml += '<td>' + item.total_revenue + '</td>';
                tableHtml += '<td>' + item.total_quantity + '</td>';
                tableHtml += '</tr>';
            });

            $('#statistical-table').html(tableHtml);
        }
    });
        $.ajax({
                url: "../admin/view_export.php",
                method: "POST",
                data: {
                    thoigian: thoigian
                },
                success: function(reponse) {
                    let data = JSON.parse(reponse);
                    if(data.length > 0) document.getElementById("export_excel").disabled = false;
                    let dataDraw =  data.length >0 ? data : [];
                    chart.setData(dataDraw)
                    $('#text-date').text(text);

                    let totalOrder = 0;
                    let totalSales = 0;
                    let totalQuantity = 0;
                    for (let i = 0; i < data.length; i++) {
                        totalOrder += parseInt(data[i].order);
                        totalSales += parseInt(data[i].sales);
                    }
                    let formattedAmount = parseInt(totalSales).toLocaleString('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    });

                    $('.metric__order').text(totalOrder);
                    $('.metric__sales').text(formattedAmount);
                }
            })
});
</script>

<script>
    var selectDate = document.querySelector(".select-date-tk");
    var btnExport = document.getElementById("btnExport");
    selectDate.addEventListener("change", function() {
        btnExport.href = "../admin/view_export.php"
    });
</script>

<style>
.col {
    width: 100%;
    float: left;
}

.card {
    background: #fff;
    border-radius: 4px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-bottom: 20px;
}

.card-title {
    margin: 10px 0;
    font-size: 24px;
}

.btn-primary {
    display: inline-block;
    width: 200px;
    padding: 8px 16px;
    margin: 10px 0;
    font-size: 16px;
    font-weight: bold;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.select-date-tk {
    padding: 8px 16px;
    font-size: 16px;
    border-radius: 4px;
    border: 1px solid #ccc;
    outline: none;
}

.select-date-tk option {
    font-size: 16px;
}

.metric__item {
    margin-right: 20px;
    font-size: 16px;
}

#linechart {
    height: 350px;
    width: 100%;
    margin-top: 20px;
}

</style>

<?php } ?>