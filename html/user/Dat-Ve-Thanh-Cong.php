<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Đặt vé thành công</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/Dat-Ve-Thanh-Cong.css">
</head>
<body>
<div class="container">
    <form class="row info" action="../service/add-chuyenbay.php" method="post">
        <div class="col-md-2">
            <!-- QR Code -->
            <img src="./assets/img/qr.svg" alt="QR Code" class="img-fluid">
        </div>

        <div class="col-md-8">
            <input type="hidden" name="customer_id" value="">
            <input type="hidden" name="Time_bay" value="">
            <div class="user-info">
                <h5>Mã vé</h5>
                <input type="hidden" name="flightId" value="">
                <span id="ma-ve"></span>
            </div>
            <div class="user-info">
                <p>Họ tên:</p>
                <input type="hidden" name="fullName" value="">
                <span id="fullName"></span>
            </div>
            <div class="user-info">
                <p>Số điện thoại:</p>
                <input type="hidden" name="phoneNumber" value="">
                <span id="phoneNumber"></span>
            </div>
            <div class="user-info">
                <p>Ngày đặt:</p>
                <input type="hidden" name="bookingDate" value="">
                <span id="bookingDate"></span>
            </div>
            <div class="user-info">
                <p>Điểm đi:</p>
                <input type="hidden" name="diemdi" value="">
                <span id"diemdi"></span>
            </div>
            <div class="user-info">
                <p>Điểm đến:</p>
                <input type="hidden" name="diemden" value="">
                <span id="diemden"></span>
            </div>
            <div class="user-info">
                <p>Ngày đi:</p>
                <input type="hidden" name="ngaydi" value="">
                <span id="ngaydi"></span>
            </div>
            <div class="user-info">
                <p>Ngày về:</p>
                <input type="hidden" name="ngayve" value="">
                <span id="ngayve"></span>
            </div>
            <div class="user-info">
                <p>Số lượng:</p>
                <input type="hidden" name="soluong" value="">
                <span id="soluong"></span>
            </div>
            <div class="user-info">
                <p>Hành trình:</p>
                <input type="hidden" name="hanhtrinh" value="">
                <span id="hanhtrinh"></span>
            </div>
            <div class="user-info">
                <p>Loại vé:</p>
                <input type="hidden" name="ticketType" value="">
                <span id="ticketType"></span>
            </div>
            <div class="user-info">
                <p>Email:</p>
                <input type="hidden" name="email" value="">
                <span id="email"></span>
            </div>
            <div class="user-info" style="border-bottom:solid 1px #000000">
                <p>Số ghế:</p>
                <input type="hidden" name="soGhe" value="">
                <span id="soGhe"></span>
            </div>
            <div class="user-info pt-2">
                <h5>Tổng tiền:</h5>
                <input type="hidden" name="totalPrice" value="">
                <span id="totalPrice"></span>
            </div>
            <button type="submit" class="btn btn-primary">Xác nhận</button>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        $.ajax({
            url: '../service/getCustomerId.php',
            type: 'GET',
            success: function(customer_id) {
                // Hiển thị customer_id vào thẻ input có name="customer_id"
                $('input[name="customer_id"]').val(customer_id);
            }
        });
    });
    $(document).ready(function () {
        var ticketCode = "BB" + Math.floor(Math.random() * 100000);
        $('#ma-ve').text(ticketCode);

        var fullName = localStorage.getItem('name');
        var phoneNumber = localStorage.getItem('phone');
        var email = localStorage.getItem('email');
        var bookingDate = new Date().toLocaleDateString();
        var totalPrice = localStorage.getItem('tongTien');
        var diemdi = localStorage.getItem('diemDi');
        var diemden = localStorage.getItem('diemDen');
        var ngaydi = localStorage.getItem('ngayDi');
        var ngayve = localStorage.getItem('ngayVe');
        var soluong = localStorage.getItem('soLuong');
        var hanhtrinh = localStorage.getItem('hanhTrinh');
        var ticketType = localStorage.getItem('ticketType');
        var soGhe = localStorage.getItem('soGhe');
        var Time_bay = localStorage.getItem('Time_bay');

        $('#fullName').text(fullName);
        $('#phoneNumber').text(phoneNumber);
        $('#bookingDate').text(bookingDate);
        $('#totalPrice').text(totalPrice);
        $('#email').text(email);
        $('#diemdi').text(diemdi);
        $('#diemden').text(diemden);
        $('#ngaydi').text(ngaydi);
        $('#ngayve').text(ngayve);
        $('#soluong').text(soluong);
        $('#soGhe').text(soGhe);
        $('#Time_bay').text(Time_bay);

        $('input[name="flightId"]').val(ticketCode);
        $('input[name="fullName"]').val(fullName);
        $('input[name="phoneNumber"]').val(phoneNumber);
        $('input[name="email"]').val(email);
        $('input[name="bookingDate"]').val(bookingDate);
        $('input[name="totalPrice"]').val(totalPrice);
        $('input[name="diemdi"]').val(diemdi);
        $('input[name="diemden"]').val(diemden);
        $('input[name="ngaydi"]').val(ngaydi);
        $('input[name="ngayve"]').val(ngayve);
        $('input[name="soluong"]').val(soluong);
        $('input[name="hanhtrinh"]').val(hanhtrinh);
        $('input[name="ticketType"]').val(ticketType);
        $('input[name="soGhe"]').val(soGhe);
        $('input[name="Time_bay"]').val(Time_bay);

        if (hanhtrinh === 'oneway') {
            $('#hanhtrinh').text('Một chiều');
        } else {
            $('#hanhtrinh').text('Khứ hồi');
        }
        $('#ticketType').text(ticketType);
    });
</script>
</body>
</html>