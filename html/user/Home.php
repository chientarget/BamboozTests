<link rel="stylesheet" href="./assets/css/style_Home.css">

<div class="page-container">
    <div class="form-container">
        <form>
            <div class="form-group">
                <div class="title-form">
                    <label class="title-form-label">Bạn sẽ đi đâu ?</label><br><br>
                </div>
                <div class="col-md-6" style="display: flex;">
                    <div id="oneWayContainer" style="padding-right: 15%;cursor: pointer">
                        <input class="form-check-input" id="flexRadioDefault1" name="flexRadioDefault" type="radio">
                        <label class="form-check-label" for="flexRadioDefault1" style="cursor: pointer">Một
                            chiều</label>
                    </div>

                    <div id="roundTripContainer">
                        <input checked class="form-check-input" id="flexRadioDefault2" name="flexRadioDefault"
                               type="radio">
                        <label class="form-check-label" for="flexRadioDefault2" style="cursor: pointer">Khứ hồi</label>
                    </div>
                </div>
                <div class="row form-container-items mx-auto">
                    <h5 class="title-item">Hành trình</h5>
                    <div class="col-md">
                        <input class="form-control điemi" id="diemdi" placeholder="Điểm đi ...." type="text" name="diemdi" value="Hà Nội">
                        <p class="error-message"></p>
                    </div>
                    <div class="col-md">
                        <input class="form-control diemden" id="diemden" placeholder="Điểm đến ..." type="text" name="diemden" value="Nha Trang">
                        <p class="error-message"></p>
                    </div>
                </div>
                <div class="row form-container-items mx-auto">
                    <div class="col-md-6" id="ngayDiContainer">
                        <h5 class="title-item">Ngày đi</h5>
                        <input class="form-control" id="ngayDiInput" placeholder="16/12/2023" type="date"
                               name="ngayDiInput">
                        <p class="error-message"></p>
                    </div>

                    <div class="col-md-6" id="ngayVeContainer">
                        <h5 class="title-item">Ngày về</h5>
                        <input class="form-control" id="ngayVeInput" placeholder="31/12/2023" type="date"
                               name="ngayVeInput">
                        <p class="error-message"></p>
                    </div>

                </div>
                <div class="row form-container-items mx-auto">
                    <div class="col-md-6" id="ngayDiContainer">
                        <h5 class="title-item">Số lượng</h5>
                        <input class="col-md-5 form-control" placeholder="1 Người" type="number" name="numPeople"
                               id="numPeople">
                        <p class="error-message"></p>
                    </div>

                    <div class="col-md-6" id="ngayVeContainer">
                        <h5 class="title-item"></h5><br>
                        <a class="nav-link nav-content" data-content="Tim_Ve">
                            <button class="btn btn-dat-ngay " type="button">Tìm chuyến</button>
                        </a>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#searchForm').submit(function (e) {
        });

        $('#flexRadioDefault1').change(function () {
            $('#ngayVeContainer').hide();
        });

        $('#flexRadioDefault2').change(function () {
            // Xử lý sự kiện khi radio "Khứ hồi" được chọn
            $('#ngayVeContainer').show();
        });

        $('.btn-dat-ngay').click(function (e) {
            e.preventDefault();

            // Lấy giá trị từ các ô nhập
            var diemDi = $('#diemdi').val();
            var diemDen = $('#diemden').val();
            var ngayDi = $('#ngayDiInput').val();
            var ngayVe = $('#ngayVeInput').val();
            var soLuong = $('#numPeople').val();
            var hanhTrinh = $('input[id="flexRadioDefault1"]:checked').val();

            // Get current date
            var currentDate = new Date();
            currentDate.setHours(0, 0, 0, 0); // Set time to 00:00:00

            // Convert selected dates to Date objects
            var selectedNgayDi = new Date(ngayDi);
            var selectedNgayVe = new Date(ngayVe);

            // Check if any field is empty or if selected dates are in the past
            if (!diemDi || !diemDen || !ngayDi || !soLuong || (hanhTrinh && !ngayVe) || selectedNgayDi < currentDate || (hanhTrinh && selectedNgayVe < currentDate)) {
                // Display error message
                $('.error-message').text('Vui lòng nhập đầy đủ thông tin và chọn ngày không phải trong quá khứ.');
                return false;
            }

            // Lưu giá trị vào localStorage
            localStorage.setItem('diemDi', diemDi);
            localStorage.setItem('diemDen', diemDen);
            localStorage.setItem('ngayDi', ngayDi);
            localStorage.setItem('ngayVe', ngayVe);
            localStorage.setItem('soLuong', soLuong);
            localStorage.setItem('hanhTrinh', hanhTrinh);

            loadContent("#content", "Tim_Ve");
        });


    });

    // $(document).ready(function () {
    //     $('#diemdi, #diemden').on('focus', function () {
    //         $.ajax({
    //             url: './../service/get_addresses.php',
    //             type: 'GET',
    //             success: function (data) {
    //                 var cities = JSON.parse(data);
    //                 console.log(cities);
    //                 $('#diemdi, #diemden').autocomplete({
    //                     source: cities
    //                 });
    //             }
    //         });
    //     });
    // });

    $(document).ready(function () {
        $.ajax({
            url: './../service/get_addresses.php',
            type: 'GET',
            success: function (data) {
                var cities = JSON.parse(data);
                cities.forEach(function(city) {
                    $('#diemdi, #diemden').append(new Option(city, city));
                });
            }
        });
    });


</script>
