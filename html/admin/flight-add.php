<!DOCTYPE html>
<html lang="en"  xmlns:th="https://www.thymeleaf.org">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../assets/img/favicon.png" rel="icon">
    <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Thêm mới chuyến bay</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../../assets/css/adminStyle.css" rel="stylesheet">
</head>
<body>
    
    <div id="container">

        <!-- sidebar -->
        <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="p-4 pt-5">
            <a href="#" class="img logo rounded-circle" style="background-image: url(../../assets//img/beluga.jpg);"></a>
            <h4 class="logo-name"><a href="#">Admin-BamBooz</a></h4>
                <ul class="list-unstyled components mb-5">
                    <li>
                        <a href="./index.php">Thống kê - Báo cáo</a>
                    </li>
                    <li >
                        <a href="./customer.php">Quản lý khách hàng</a>
                    </li>
                    <li class="active">
                        <a href="./flight.php">Quản lý chuyến bay</a>
                    </li>
                    <li>
                        <a href="./address.php">Quản lý địa điểm bay</a>
                    </li>
                    <li>
                        <a href="./booking.php">Quản lý đặt vé</a>
                    </li>
                </ul>
            </div>
        </nav>
            <!-- content  -->
            <div id="content">
                <!-- navbar -->
                <nav class="content-navbar navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">

                        <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fa fa-bars"></i>
                        <span class="sr-only">Toggle Menu</span>
                        </button>
                        <!-- <button class="btn d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fa-solid fa-gear"></i>
                        </button> -->

                        <div class="" id="navbarSupportedContent">
                        
                        <ul class="nav ml-auto">
                            <li class="nav-item" style="margin-top: 4px; margin-right: 10px;">
                                <!-- Rounded switch -->
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider round"></span>
                                </label>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../user/index.php">Log out</a>
                            </li>
                        </ul>
                        </div>
                    </div>
                </nav>
                <!-- noi dung chinh -->
                <div class="content-header">
                    <!-- header-content -->
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="./index.php">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        Thêm mới chuyến bay
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <!-- Main content -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row py-2">
                                <div class="col-6">
                                    <button type="button" class="btn btn-info px-4" id="btn-update">
                                        <i class="fas fa-plus"></i> Tạo
                                    </button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">


                                            <?php 
                                                    
                                                    // include database and object files
                                                    include("../../model/entity/Flight.php");
                                                    
                                                    // get database connection
                                                    $database = new Database();
                                                    $db = $database->Connect();
                                                    
                                                    // prepare objects
                                                    $flight = new Flight($db);
                                                    
                                                    // if the form was submitted
                                                    if($_POST){
                                                        // set product property values
                                                        $flight->flightTime = $_POST['flightTime'];
                                                        $flight->departureTime = $_POST['departureTime'];
                                                        $flight->arrivalTime = $_POST['arrivalTime'];
                                                        $flight->departureAddressId = $_POST['departureAddressId'];
                                                        $flight->arrivalAddressId = $_POST['arrivalAddressId'];
                                                        $flight->totalSeats = $_POST['totalSeats'];
                                                        $flight->availableSeats = $_POST['availableSeats'];
                                                        
                                                    
                                                        // update the product
                                                        if($flight->create()){
                                                            echo "<div class='alert alert-success alert-dismissable'>";
                                                                echo "Flight was created.";
                                                            echo "</div>";
                                                            exit();
                                                        }
                                                    
                                                        // if unable to update the product, tell the user
                                                        else{
                                                            echo "<div class='alert alert-danger alert-dismissable'>";
                                                                echo "Unable to create Flight.";
                                                            echo "</div>";
                                                        }
                                                    }
                                                    ?>
                                                    <div id="message"></div>

                                                    <form >
                                                        <table class='table table-hover  table-bordered'>
                                                    
                                                            <tr>
                                                                <td>Mã chuyến bay</td>
                                                                <td><input disabled style="max-width: 200px;" type='text' name='id'  value="Tự động tạo" class='form-control' /></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Số giờ bay</td>
                                                                <td><input required type="text"  class="form-control" name="flightTime"/></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Thời gian khởi hành</td>
                                                                <?php

                                                                    // Chuyển đổi định dạng từ datetime thành giờ và ngày cho input kiểu datetime-local
                                                                    $departureTimeFormatted = date('Y-m-d\TH:i', strtotime('0000-00-00 00:00:00'));
                                                                ?>

                                                                <!-- Sử dụng giá trị đã chuyển đổi trong input kiểu datetime-local -->
                                                                <td><input type="datetime-local" value="<?php echo $departureTimeFormatted; ?>" class="form-control" name="departureTime" /></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Thời gian hạ cánh</td>
                                                                <?php

                                                                    // Chuyển đổi định dạng từ datetime thành giờ và ngày cho input kiểu datetime-local
                                                                    $arrivalTimeFormatted = date('Y-m-d\TH:i', strtotime('0000-00-00 00:00:00'));
                                                                ?>

                                                                <!-- Sử dụng giá trị đã chuyển đổi trong input kiểu datetime-local -->
                                                                <td><input type="datetime-local" value="<?php echo $arrivalTimeFormatted; ?>" class="form-control" name="arrivalTime" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Tổng số ghế</td>
                                                                <td><input required type="text " class="form-control" name="totalSeats" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Số ghế còn trống</td>
                                                                <td><input required type="text"  class="form-control" name="availableSeats"/></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Điểm xuất phát -> Điểm hạ cánh</td>
                                                                <td>
                                                                    
                                                                    <div class="d-flex justify-content-between" style="align-items:center;">
                                                                        <?php
                                                                            $conn= Database::Connect();
                                                                            

                                                                            // Lấy danh sách tất cả các thành phố
                                                                            $queryAllCities = "SELECT id, city FROM Address";
                                                                            $stmtAllCities = $conn->prepare($queryAllCities);
                                                                            $stmtAllCities->execute();
                                                                            $cities = $stmtAllCities->fetchAll(PDO::FETCH_ASSOC);

                                                                            
                                                                            // Bắt đầu thẻ select
                                                                            echo "<select class='select2 form-control col-md-5' id='departureAddressId' name='departureAddressId'>";
                                                                            
                                                                            // Lặp qua mảng thành phố và tạo các option
                                                                            foreach ($cities as $city) {
                                                                                echo "<option value='{$city['id']}' >{$city['city']}</option>";
                                                                            }
                                                                            
                                                                            // Kết thúc thẻ select
                                                                            echo "</select>";

                                                                            
                                                                            echo "<div><i class='fa-solid fa-arrow-right-long fa-solid text-gray-300'></i></div>";

                                                                            // Bắt đầu thẻ select
                                                                            echo "<select class='select2 form-control col-md-5' id='arrivalAddressId' name='arrivalAddressId'>";
                                                                            
                                                                            // Lặp qua mảng thành phố và tạo các option
                                                                            foreach ($cities as $city) {
                                                                                echo "<option value='{$city['id']}' >{$city['city']}</option>";
                                                                            }
                                                                            
                                                                            // Kết thúc thẻ select
                                                                            echo "</select>";
                                                                            
                                                                        ?>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Sân bay xuất phát -> Sân bay hạ cánh</td>
                                                                <td>
                                                                    <div class="d-flex justify-content-between" style="align-items:center;">
                                                                    <?php
                                                                        $conn = Database::Connect();

                                                                        // Lấy thông tin cho departureAddress
                                                                        $departureAddressId = $flight->departureAddressId;
                                                                        $departureAirfield = getAirfieldById($conn, $departureAddressId);

                                                                        // Lấy thông tin cho arrivalAddress
                                                                        $arrivalAddressId = $flight->arrivalAddressId;
                                                                        $arrivalAirfield = getAirfieldById($conn, $arrivalAddressId);
                                                                        ?>

                                                                        <?php
                                                                        function getAirfieldById($conn, $addressId) {
                                                                            $queryAirfield = "SELECT airfield FROM Address WHERE id = :addressId";
                                                                            $stmtAirfield = $conn->prepare($queryAirfield);
                                                                            $stmtAirfield->bindParam(':addressId', $addressId, PDO::PARAM_INT);
                                                                            $stmtAirfield->execute();
                                                                            
                                                                            $airfieldInfo = $stmtAirfield->fetch(PDO::FETCH_ASSOC);

                                                                            return $airfieldInfo ? $airfieldInfo['airfield'] : '';
                                                                        }
                                                                        ?>

                                                                        <input disabled value="<?php echo $departureAirfield; ?>" type="text" class="form-control col-md-5" id="airField1"/>
                                                                        <div><i class="fa-solid fa-arrow-right-long fa-solid text-gray-300"></i></div>
                                                                        <input disabled value="<?php echo $arrivalAirfield; ?>" type="text" class="form-control col-md-5" id="airField2"/>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                    
                                                            <tr>
                                                                <td></td>
                                                                <td>
                                                                    <button type="submit" class="btn btn-primary">Add</button>
                                                                </td>
                                                            </tr>
                                                    
                                                        </table>
                                                    </form>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>

    </div>
    

    <!-- Thêm Bootstrap JS và jQuery (cần cho Bootstrap) -->
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../../assets/vendor/php-email-form/validate.js"></script>

    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/popper.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Đoạn mã JavaScript -->
    <script>
        // Lắng nghe sự kiện thay đổi trên các thẻ select
        $(document).ready(function () {
            $('#departureAddressId').change(function () {
                // Lấy giá trị id từ option đã chọn
                var departureAddressId = $(this).val();
                console.log(departureAddressId); 

                // Gửi yêu cầu Ajax để lấy airfield dựa trên id
                $.ajax({
                    url: 'get_airfield.php', // Đổi thành đường dẫn của file xử lý yêu cầu
                    type: 'POST',
                    data: { addressId: departureAddressId },
                    success: function (response) {
                        // Cập nhật giá trị của ô nhập liệu
                        $('#airField1').val(response);
                    }
                });
            });

            $('#arrivalAddressId').change(function () {
                // Lấy giá trị id từ option đã chọn
                var arrivalAddressId = $(this).val();

                // Gửi yêu cầu Ajax để lấy airfield dựa trên id
                $.ajax({
                    url: 'get_airfield.php', // Đổi thành đường dẫn của file xử lý yêu cầu
                    type: 'POST',
                    data: { addressId: arrivalAddressId },
                    success: function (response) {
                        // Cập nhật giá trị của ô nhập liệu
                        console.log(response)
                        $('#airField2').val(response);
                    }
                });
            });
        });


        document.querySelector("form").addEventListener("submit", function(event){
            event.preventDefault();

            var formData = new FormData(this);

            fetch('../service/add_flight.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(response => {
                console.log(response.trim());
                if (response.trim() === "Đã thêm chuyến bay thành công") {
                    $('#message').html('<div class="alert alert-success">Đã thêm chuyến bay thành công.</div>');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>

    
</body>
</html>