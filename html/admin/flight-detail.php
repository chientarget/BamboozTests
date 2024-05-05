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
    <title>Chi tiết chuyến bay</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../../assets/css/adminStyle.css" rel="stylesheet">
</head>
<body>
    
    <div id="container">

        <!-- sidebar -->
        <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="p-4 pt-5">
            <a href="#" class="img logo rounded-circle" style="background-image: url(../../assets/img/beluga.jpg);"></a>
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
                                        Danh sách chuyến bay
                                    </li>
                                    <li class="breadcrumb-item active">
                                        Thông tin chi tiết chuyến bay
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <!-- Main content -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row py-2">
                                <div class="col-10">
                                    <a href="./flight.php" type="button" class="btn btn-default">
                                        <i class="fas fa-chevron-left"></i> Quay lại
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">

                                            <?php 
                                                    // get ID of the product to be edited
                                                    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
                                                    
                                                    // include database and object files
                                                    include_once("../../model/entity/Flight.php");
                                                    include_once("../../model/entity/Address.php");
                                                    
                                                    // get database connection
                                                    $database = new Database();
                                                    $db = $database->Connect();
                                                    
                                                    // prepare objects
                                                    $flight = new Flight($db);
                                                    $address = new Address($db);
                                                    
                                                    // set ID property of product to be edited
                                                    $flight->id = $id;
                                                    
                                                    // read the details of product to be edited
                                                    $flight->readOne();
                                                    // if the form was submitted
                                                    if($_POST){
                                                    
                                                        // set product property values
                                                        $flight->flightTime = $_POST['flightTime'];
                                                        $flight->departureTime = $_POST['departureTime'];
                                                        $flight->arrivalTime = $_POST['arrivalTime'];
                                                        $flight->totalSeats = $_POST['totalSeats'];
                                                        $flight->availableSeats = $_POST['availableSeats'];
                                                        $flight->departureAddressId = $_POST['departureAddress'];
                                                        $flight->arrivalAddressId = $_POST['arrivalAddress'];

                                                    
                                                        // update the product
                                                        if($flight->update()){
                                                            echo "<div class='alert alert-success alert-dismissable'>";
                                                                echo "Customer was updated.";
                                                            echo "</div>";
                                                        }
                                                    
                                                        // if unable to update the product, tell the user
                                                        else{
                                                            echo "<div class='alert alert-danger alert-dismissable'>";
                                                                echo "Unable to update Customer.";
                                                            echo "</div>";
                                                        }
                                                    }
                                                    ?>
                                                    

                                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
                                                        <table class='table table-hover  table-bordered'>
                                                    
                                                            <tr>
                                                                <td>Mã chuyến bay</td>
                                                                <td><input style="max-width: 200px;" disabled type='text' name='id'  value="<?php echo $flight->id; ?>" class='form-control' /></td>
                                                            </tr>
                                                        </tr>
                                                    
                                                            <tr>
                                                                <td>Số giờ bay</td>
                                                                <td><input type="text" value="<?php echo $flight->flightTime; ?>" class="form-control" name="flightTime"/></td>
                                                            </tr>
                                                    
                                                            <tr>
                                                                <td>Thời gian khởi hành</td>
                                                                <?php
                                                                    // Giả sử $flight->departureTime chứa giá trị datetime từ cơ sở dữ liệu
                                                                    $departureTimeFromDB = $flight->departureTime;

                                                                    // Chuyển đổi định dạng từ datetime thành giờ và ngày cho input kiểu datetime-local
                                                                    $departureTimeFormatted = date('Y-m-d\TH:i', strtotime($departureTimeFromDB));
                                                                ?>

                                                                <!-- Sử dụng giá trị đã chuyển đổi trong input kiểu datetime-local -->
                                                                <td><input type="datetime-local" value="<?php echo $departureTimeFormatted; ?>" class="form-control" name="departureTime" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Thời gian hạ cánh</td>
                                                                <?php
                                                                    // Giả sử $flight->arrivalTime chứa giá trị datetime từ cơ sở dữ liệu
                                                                    $arrivalTimeFromDB = $flight->arrivalTime;

                                                                    // Chuyển đổi định dạng từ datetime thành giờ và ngày cho input kiểu datetime-local
                                                                    $arrivalTimeFormatted = date('Y-m-d\TH:i', strtotime($arrivalTimeFromDB));
                                                                ?>

                                                                <!-- Sử dụng giá trị đã chuyển đổi trong input kiểu datetime-local -->
                                                                <td><input type="datetime-local" value="<?php echo $arrivalTimeFormatted; ?>" class="form-control" name="arrivalTime" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Tổng số ghế</td>
                                                                <td><input type="text" value="<?php echo $flight->totalSeats; ?>" class="form-control" name="totalSeats"/></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Số ghế còn trống</td>
                                                                <td><input type="text" class="form-control" value="<?php echo $flight->availableSeats; ?>" name="availableSeats" /></td>
                                                            </tr>
                                                

                                                            <tr>
                                                                <td>Điểm xuất phát -> Điểm hạ cánh</td>
                                                                <td>
                                                                    
                                                                    <div class="d-flex justify-content-between" style="align-items:center;">
                                                                        <?php
                                                                            $conn= Database::Connect();
                                                                            $queryCity = "SELECT id, city FROM Address WHERE id = :arrivalAddressId";
                                                                            $stmtCity = $conn->prepare($queryCity);
                                                                            $stmtCity->bindParam(':arrivalAddressId', $arrivalAddressId, PDO::PARAM_INT);

                                                                            // Giả sử $arrivalAddressId là arrivalAddressId của chuyến bay cụ thể
                                                                            $arrivalAddressId = $flight->arrivalAddressId;

                                                                            // Thực hiện truy vấn
                                                                            $stmtCity->execute();

                                                                            // Lấy kết quả
                                                                            $cityInfo = $stmtCity->fetch(PDO::FETCH_ASSOC);

                                                                            // Lấy ra thành phố từ kết quả
                                                                            $arrivalCityId = $cityInfo['id'];
                                                                            $arrivalCity = $cityInfo['city'];

                                                                            // Lấy danh sách tất cả các thành phố
                                                                            $queryAllCities = "SELECT id, city FROM Address";
                                                                            $stmtAllCities = $conn->prepare($queryAllCities);
                                                                            $stmtAllCities->execute();

                                                                            // Lấy kết quả vào mảng
                                                                            $cities = $stmtAllCities->fetchAll(PDO::FETCH_ASSOC);
                                                                            
                                                                            

                                                                            $queryCies = "SELECT id , city FROM Address WHERE id = :departureAddressId";
                                                                            $stmtCities = $conn->prepare($queryCies);
                                                                            $stmtCities->bindParam(':departureAddressId', $departureAddressId, PDO::PARAM_INT);

                                                                            // Giả sử $arrivalAddressId là arrivalAddressId của chuyến bay cụ thể
                                                                            $departureAddressId = $flight->departureAddressId;

                                                                            // Thực hiện truy vấn
                                                                            $stmtCities->execute();

                                                                            // Lấy kết quả
                                                                            $citiesInfo = $stmtCities->fetch(PDO::FETCH_ASSOC);

                                                                            // Lấy ra thành phố từ kết quả
                                                                            $departureCityId = $citiesInfo['id'];
                                                                            $departureCity = $citiesInfo['city'];

                                                                            
                                                                            // Bắt đầu thẻ select
                                                                            echo "<select class='select2 form-control col-md-5' id='departureAddress' name='departureAddress'>";
                                                                            
                                                                            // Lặp qua mảng thành phố và tạo các option
                                                                            foreach ($cities as $city) {
                                                                                $selected = ($city['id'] == $departureCityId) ? 'selected' : '';
                                                                                echo "<option value='{$city['id']}' $selected>{$city['city']}</option>";
                                                                            }
                                                                            
                                                                            // Kết thúc thẻ select
                                                                            echo "</select>";

                                                                            
                                                                            echo "<div><i class='fa-solid fa-arrow-right-long fa-solid text-gray-300'></i></div>";

                                                                            // Bắt đầu thẻ select
                                                                            echo "<select class='select2 form-control col-md-5' id='arrivalAddress' name='arrivalAddress'>";
                                                                            
                                                                            // Lặp qua mảng thành phố và tạo các option
                                                                            foreach ($cities as $city) {
                                                                                $selected = ($city['id'] == $arrivalCityId) ? 'selected' : '';
                                                                                echo "<option value='{$city['id']}' $selected>{$city['city']}</option>";
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
                                                                    <button type="submit" class="btn btn-primary">Update</button>
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
            $('#departureAddress').change(function () {
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

            $('#arrivalAddress').change(function () {
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
    </script>
    
</body>
</html>