<?php
session_start();
require_once(__DIR__ . '/../../connect/Database.php');
require_once(__DIR__ . '/../../model/entity/Customer.php');

if (isset($_SESSION['user'])) {
    $username = $_SESSION['user'];
    $db = Database::Connect();
    $customer = new Customer($db);
    $customer->setUsername($username);
    $customer->readOne2();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tìm vé</title>
    <link rel="stylesheet" href="./assets/css/style_TimVe.css">
</head>
<body>
<div class="container">
    <div class="row">
        <!--        phần hạng ghế-->
        <div class="col-md-3 info-box">
            <form class="info_flight">
                <label for="name">Họ tên:</label><br>
                <input type="text" id="name" name="name"><br>
                <p class="error-message"></p>

                <label for="phone">Số điện thoại:</label><br>
                <input type="text" id="phone" name="phone"><br>
                <p class="error-message"></p>

                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email"><br>
                <p class="error-message"></p>
                <div style="display: flex;">
                    <label for="journey">Hành trình:</label><br>
                    <div style="display: flex">
                        <input type="radio" id="oneWay" name="journey" value="oneWay">
                        <label for="oneWay" id="oneWays">Một chiều</label><br>
                    </div>
                    <div style="display: flex">
                        <input type="radio" id="roundTrip" name="journey" value="roundTrip">
                        <label for="roundTrip" id="roundTrips">Khứ hồi</label><br>
                    </div>
                </div>
                <label for="departureDate">Ngày đi:</label><br>
                <input type="date" id="departureDate" name="departureDate"><br>
                <p class="error-message"></p>
                <label for="returnDate" id="returnDates">Ngày về:</label><br>
                <input type="date" id="returnDate" name="returnDate"><br>
                <p class="error-message"></p>
                <label for="numPeople">Số lượng người:</label><br>
                <input type="number" id="numPeople" name="numPeople"><br>
                <p class="error-message"></p>
                <label for="departurePoint">Điểm đi:</label><br>
                <input type="text" id="departurePoint" name="departurePoint"><br>
                <p class="error-message"></p>
                <label for="destination">Điểm đến:</label><br>
                <input type="text" id="destination" name="destination"><br>
                <p class="error-message"></p>
            </form>
        </div>
        <div class="col-md-8">
            <div class="row col-md Title-Tikm-Ve align-content-center">
                <b>TP.HCM
                    <svg width="57" height="55" viewBox="0 0 57 55" fill="none" xmlns="http://www.w3.org/2000/svg"
                         style="height: 100%;">
                        <path d="M8 18H41L45.8182 21H8V18Z" fill="#a55eea"></path>
                        <path d="M36.8835 21H48.5C39 16 40 17 33 11V18L36.8835 21Z" fill="#a55eea"></path>
                        <path d="M48 37L15 37L10.1818 34L48 34V37Z" fill="#D3D3D3"></path>
                        <path d="M19.1165 34L7.5 34C17 39 16 38 23 44V37L19.1165 34Z" fill="#D3D3D3"></path>
                    </svg>
                    TP. HÀ NỘI</b>
            </div>
            <div class="row content">
                <table class="table table1 table-success">
                    <thead>
                    <tr class="header-table">
                        <th scope="col">...</th>
                        <th scope="col" style="background-color: #AF8903">Business</th>
                        <th scope="col" style="background-color: #DA2128">SkyBoss</th>
                        <th scope="col" style="background-color: #F9A51A">Veluxe</th>
                        <th scope="col" style="background-color: #6AB72E">Eco</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">05:00-07:10</th>
                        <td>4.690.000VND</td>
                        <td>3.690.000VND</td>
                        <td>1.550.000VND</td>
                        <td>1.420.000VND</td>
                    </tr>
                    <tr>
                        <th scope="row">06:00-08:10</th>
                        <td>4.690.000VND</td>
                        <td>3.690.000VND</td>
                        <td>1.550.000VND</td>
                        <td>1.420.000VND</td>
                    </tr>
                    <tr>
                        <th scope="row">07:00-09:10</th>
                        <td>4.690.000VND</td>
                        <td>3.690.000VND</td>
                        <td>1.550.000VND</td>
                        <td>1.420.000VND</td>
                    </tr>
                    <tr>
                        <th scope="row">08:00-10:10</th>
                        <td>4.690.000VND</td>
                        <td>3.690.000VND</td>
                        <td>1.550.000VND</td>
                        <td>1.420.000VND</td>
                    </tr>
                    <tr>
                        <th scope="row">09:00-11:10</th>
                        <td>4.690.000VND</td>
                        <td>3.690.000VND</td>
                        <td>1.550.000VND</td>
                        <td>1.420.000VND</td>
                    </tr>
                    <tr>
                        <th scope="row">10:00-12:10</th>
                        <td>4.690.000VND</td>
                        <td>3.690.000VND</td>
                        <td>1.550.000VND</td>
                        <td>1.420.000VND</td>
                    </tr>
                    <tr>
                        <th scope="row">11:00-13:10</th>
                        <td>4.690.000VND</td>
                        <td>3.690.000VND</td>
                        <td>1.550.000VND</td>
                        <td>1.420.000VND</td>
                    </tr>
                    <tr>
                        <th scope="row">12:00-14:10</th>
                        <td>4.690.000VND</td>
                        <td>3.690.000VND</td>
                        <td>1.550.000VND</td>
                        <td>1.420.000VND</td>
                    </tr>
                    <tr>
                        <th scope="row">13:00-15:10</th>
                        <td>4.690.000VND</td>
                        <td>3.690.000VND</td>
                        <td>1.550.000VND</td>
                        <td>1.420.000VND</td>
                    </tr>
                    <tr>
                        <th scope="row">14:00-16:10</th>
                        <td>4.690.000VND</td>
                        <td>3.690.000VND</td>
                        <td>1.550.000VND</td>
                        <td>1.420.000VND</td>
                    </tr>
                    <tr>
                        <th scope="row">15:00-18:10</th>
                        <td>4.690.000VND</td>
                        <td>3.690.000VND</td>
                        <td>1.550.000VND</td>
                        <td>1.420.000VND</td>
                    </tr>
                    </tbody>
                </table>


            </div>

        </div>


        <div class="col-md-12">
            <!--            phần số ghế-->
            <h3 class="col-md-12 justify-content-center"
                style="color: whitesmoke;display: flex; justify-content: center;
                        align-items: center">
                Số ghế</h3>
            <table class="table table2 table-bordered">
                <tbody>
                <tr class="business">
                    <td colspan="5" class="text-center" style="pointer-events: none;">Business</td>
                </tr>
                <tr>
                    <td id="B01" class="seat business">B01</td>
                    <td id="B02" class="seat business">B02</td>
                    <td id="B03" class="seat business">B03</td>
                    <td id="B04" class="seat business">B04</td>
                    <td id="B05" class="seat business">B05</td>
                </tr>
                <tr>
                    <td id="B06" class="seat business">B06</td>
                    <td id="B07" class="seat business">B07</td>
                    <td id="B08" class="seat business">B08</td>
                    <td id="B09" class="seat business">B09</td>
                    <td id="B10" class="seat business">B10</td>
                </tr>

                <!-- SkyBoss Seats -->
                <tr class="skyboss">
                    <td colspan="5" class="text-center" style="pointer-events: none;">SkyBoss</td>
                </tr>
                <tr>
                    <td id="S01" class="seat skyboss">S01</td>
                    <td id="S02" class="seat skyboss">S02</td>
                    <td id="S03" class="seat skyboss">S03</td>
                    <td id="S04" class="seat skyboss">S04</td>
                    <td id="S05" class="seat skyboss">S05</td>
                </tr>
                <tr>
                    <td id="S06" class="seat skyboss">S06</td>
                    <td id="S07" class="seat skyboss">S07</td>
                    <td id="S08" class="seat skyboss">S08</td>
                    <td id="S09" class="seat skyboss">S09</td>
                    <td id="S10" class="seat skyboss">S10</td>
                </tr>

                <tr class="veluxe">
                    <td colspan="5" class="text-center" style="pointer-events: none;">Veluxe</td>
                </tr>
                <tr>
                    <td id="V01" class="seat veluxe">V01</td>
                    <td id="V02" class="seat veluxe">V02</td>
                    <td id="V03" class="seat veluxe">V03</td>
                    <td id="V04" class="seat veluxe">V04</td>
                    <td id="V05" class="seat veluxe">V05</td>
                </tr>
                <tr>
                    <td id="V06" class="seat veluxe">V06</td>
                    <td id="V07" class="seat veluxe">V07</td>
                    <td id="V08" class="seat veluxe">V08</td>
                    <td id="V09" class="seat veluxe">V09</td>
                    <td id="V10" class="seat veluxe">V10</td>
                </tr>

                <tr class="eco">
                    <td colspan="5" class="text-center" STYLE="pointer-events: none;">Eco</td>
                </tr>
                <tr>
                    <td id="E01" class="seat eco">E01</td>
                    <td id="E02" class="seat eco">E02</td>
                    <td id="E03" class="seat eco">E03</td>
                    <td id="E04" class="seat eco">E04</td>
                    <td id="E05" class="seat eco">E05</td>
                </tr>
                <tr>
                    <td id="E06" class="seat eco">E06</td>
                    <td id="E07" class="seat eco">E07</td>
                    <td id="E08" class="seat eco">E08</td>
                    <td id="E09" class="seat eco">E09</td>
                    <td id="E10" class="seat eco">E10</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>

</div>
<div class="footer-dock">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="col-md-2">
            <a class="nav-link nav-content" href="./index.php">
                <button class="btn back-btn" onclick="goBack()">Quay lại</button>
            </a>

        </div>
        <div class="col-md"></div>
        <div class="col-md-3 TongTien">
            <p>Tổng tiền: 4.500.000VNĐ</p>
        </div>
        <div class="col-md-2">
            <button class="btn payment-btn" id="bookNowButton">Đặt ngay</button>
        </div>
    </div>


</div>
<script>

    $(document).ready(function () {
        $(document).ready(function () {
            $('.info_flight').submit(function (e) {
                e.preventDefault();

                // Get the values from the input fields
                var name = $('#name').val();
                var phone = $('#phone').val();
                var email = $('#email').val();
                var journey = $('input[name="journey"]:checked').val();
                var departureDate = $('#departureDate').val();
                var returnDate = $('#returnDate').val();
                var numPeople = $('#numPeople').val();
                var departurePoint = $('#departurePoint').val();
                var destination = $('#destination').val();

                // Get current date
                var currentDate = new Date();
                currentDate.setHours(0, 0, 0, 0); // Set time to 00:00:00

                // Convert selected dates to Date objects
                var selectedDepartureDate = new Date(departureDate);
                var selectedReturnDate = new Date(returnDate);

                // Check if any field is empty or if selected dates are in the past
                if (!name || !phone || !email || !journey || !departureDate || !numPeople || !departurePoint || !destination || selectedDepartureDate < currentDate || (journey === 'roundTrip' && selectedReturnDate < currentDate)) {
                    // Display error message
                    $('.error-message').text('Vui lòng nhập đầy đủ thông tin và chọn ngày không phải trong quá khứ.');
                    return false;
                }

                // Save the values to localStorage
                localStorage.setItem('name', name);
                localStorage.setItem('phone', phone);
                localStorage.setItem('email', email);
                localStorage.setItem('journey', journey);
                localStorage.setItem('departureDate', departureDate);
                localStorage.setItem('returnDate', returnDate);
                localStorage.setItem('numPeople', numPeople);
                localStorage.setItem('departurePoint', departurePoint);
                localStorage.setItem('destination', destination);

                loadContent("#content", "Thanh-toan");
            });
        });
    });
    function goBack() {
        window.history.back();
    }

    function getRandomInt(min, max) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    $(document).ready(function () {

        var diemDi = localStorage.getItem('diemDi');
        var diemDen = localStorage.getItem('diemDen');
        var ngayDi = localStorage.getItem('ngayDi');
        var ngayVe = localStorage.getItem('ngayVe');
        var soLuong = localStorage.getItem('soLuong');
        var hanhTrinh = localStorage.getItem('hanhTrinh');

        $('#departurePoint').val(diemDi);
        $('#destination').val(diemDen);
        $('#departureDate').val(ngayDi);
        $('#returnDate').val(ngayVe);
        $('#numPeople').val(soLuong);

        if (hanhTrinh === 'on') {
            $('#oneWay').prop('checked', true);
            $('#roundTrip, #roundTrips, #returnDate, #returnDates, #oneWay').hide();
        } else {
            $('#roundTrip').prop('checked', true);
            $('#oneWay, #oneWays, #roundTrip').hide();
            $('#returnDate').show();
        }

        <?php if (isset($customer)): ?>
        $('#name').val('<?php echo $customer->getFullName(); ?>');
        $('#phone').val('<?php echo $customer->getPhone(); ?>');
        $('#email').val('<?php echo $customer->getEmail(); ?>');
        <?php endif; ?>


        $('.table1 tbody tr td').click(function () {
            $('.table1 tbody tr td').removeClass('cell-focused');
            $(this).addClass('cell-focused');
        });


        $('.table2 tbody tr td').click(function () {
            if ($(this).css('background-color') === 'rgb(128, 128, 128)') {
                showAlert('Xin lỗi, ghế này đã có người đặt !');
                return;
            }

            $('.table2 tbody tr td').removeClass('cell-focused');
            $(this).addClass('cell-focused');

            var soGhe = $(this).attr('id');
            localStorage.setItem('soGhe', soGhe);
            console.log(soGhe);
        });

        $('.table1 tbody tr td:not(:first-child)').click(function () {
            var price = parseInt($(this).text().replace(/\./g, '').replace('VND', ''));
            if ($('#roundTrip').prop('checked')) {
                price *= 2;
            }
            $('.TongTien p').text('Tổng tiền: ' + price.toLocaleString('it-IT') + 'VND');
            localStorage.setItem('tongTien', price.toLocaleString('it-IT') + 'VND');

            var cellIndex = $(this).index();
            var row = $(this).parent();

            var ticketType = $('.table1 thead tr th').eq(cellIndex).text();
            var Time_bay = row.find('th:first').text();

            localStorage.setItem('ticketType', ticketType);
            localStorage.setItem('Time_bay', Time_bay);
            console.log(Time_bay);
            console.log(ticketType);

        });

        $('#bookNowButton').click(function (e) {
            e.preventDefault();
            var name = $('#name').val();
            var phone = $('#phone').val();
            var email = $('#email').val();
            localStorage.setItem('name', name);
            localStorage.setItem('phone', phone);
            localStorage.setItem('email', email);
            loadContent("#content", "Thanh-toan");
        });

        $(document).ready(function () {
            // Ẩn tất cả các loại ghế khi trang tải
            $('.business, .skyboss, .veluxe, .eco').hide();

            // Xử lý sự kiện khi người dùng chọn một cell giá tiền
            $('.table1 tbody tr td:not(:first-child)').click(function () {
                // Lấy vị trí của cell giá tiền được chọn trong hàng
                var cellIndex = $(this).index();

                // Lấy văn bản của tiêu đề bảng tương ứng
                var seatType = $('.table1 thead tr th').eq(cellIndex).text().toLowerCase();

                // Ẩn tất cả các loại ghế
                $('.business, .skyboss, .veluxe, .eco').hide();

                // Hiển thị loại ghế tương ứng với cell giá tiền được chọn
                $('.' + seatType).show();
            });
        });

    });
    $(document).ready(function () {
        var seats = Array.from(document.querySelectorAll('.seat'));
        var numSeatsToChange = Math.floor(Math.random() * (8 - 3 + 1)) + 3;

        for (var i = 0; i < numSeatsToChange; i++) {
            var randomIndex = Math.floor(Math.random() * seats.length);
            seats[randomIndex].style.backgroundColor = 'gray';
            seats.splice(randomIndex, 1);
        }
    });


</script>
</body>
</html>