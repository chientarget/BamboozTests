<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thanh toán</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style_ThanhToan.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h4 class="mb-3" style="color: white">Thanh toán</h4>
            <form class="needs-validation payment-form" novalidate>
                <!-- Thông tin thẻ thanh toán -->
                <h2>Thông tin thẻ thanh toán</h2>
                <div class="form-group">
                    <label for="cardName">Tên trên thẻ</label>
                    <input type="text" class="form-control" id="cardName" required>
                    <p class="error-message"></p>
                </div>
                <div class="form-group">
                    <label for="cardNumber">Số thẻ</label>
                    <input type="text" class="form-control" id="cardNumber" required>
                    <p class="error-message"></p>
                </div>
                <div class="form-group">
                    <label for="expiryDate">Ngày hết hạn</label>
                    <input type="text" class="form-control" id="expiryDate" placeholder="MM/YY" required>
                    <p class="error-message"></p>
                </div>
                <div class="form-group">
                    <label for="cvv">CVV</label>
                    <input type="text" class="form-control" id="cvv" required>
                    <p class="error-message"></p>
                </div>
                <label id="totalPriceLabel"></label>
                <button class="btn payment-btn" id="pay">Thanh toán</button>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
<script>

    $(document).ready(function () {
        $('.payment-form').submit(function (e) {
            e.preventDefault();

            // Get the values from the input fields
            var cardName = $('#cardName').val();
            var cardNumber = $('#cardNumber').val();
            var expiryDate = $('#expiryDate').val();
            var cvv = $('#cvv').val();

            // Check if any field is empty
            if (!cardName) {
                $('#cardName').next('.error-message').text('Vui lòng nhập tên trên thẻ.');
                return false;
            }
            if (!cardNumber) {
                $('#cardNumber').next('.error-message').text('Vui lòng nhập số thẻ.');
                return false;
            }
            if (!expiryDate) {
                $('#expiryDate').next('.error-message').text('Vui lòng nhập ngày hết hạn.');
                return false;
            }
            if (!cvv) {
                $('#cvv').next('.error-message').text('Vui lòng nhập CVV.');
                return false;
            }

            loadContent("#content", "Dat-Ve-Thanh-Cong");
        });
    });

    $(document).ready(function () {
        var tongTien = localStorage.getItem('tongTien');
        $('#totalPriceLabel').text('Tổng tiền: ' + tongTien);
    });
    $(document).ready(function () {
        $('#pay').click(function (e) {
            e.preventDefault();
            loadContent("#content", "Dat-Ve-Thanh-Cong");
        });
    });


</script>
</body>
</html>