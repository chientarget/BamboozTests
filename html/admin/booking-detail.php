<!DOCTYPE html>
<html lang="en" xmlns:th="https://www.thymeleaf.org">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../assets/img/favicon.png" rel="icon">
    <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
          rel="stylesheet">
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../admin-lte/dist/css/adminlte.min.css"/>
    <link rel="stylesheet" href="../../admin-lte/plugins/select2/css/select2.min.css"/>

    <link rel="stylesheet" href="../../admin-lte/dist/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
          integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Thêm mới độc giả</title>

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
                    <li>
                        <a href="./customer.php">Quản lý khách hàng</a>
                    </li>
                    <li>
                        <a href="./flight.php">Quản lý chuyến bay</a>
                    </li>
                    <li>
                        <a href="./address.php">Quản lý địa điểm bay</a>
                    </li>
                    <li class="active">
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
                                    Chi tiết vé
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row py-2">
                            <div class="col-12">
                                <a href="./booking.php" type="button" class="btn btn-default">
                                    <i class="fas fa-chevron-left"></i> Quay lại
                                </a>
                                <button style="float: right; margin-right: 20px;" type="button" class="btn btn-warning px-3" id="btn-export">
                                    <i class="fa-solid fa-print"></i> Hóa đơn
                                </button>
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
                                                    include_once("../../model/entity/Customer.php");
                                                    include_once("../../model/entity/SeatClass.php");
                                                    include_once("../../model/entity/Booking.php");
                                                    
                                                    // get database connection
                                                    $database = new Database();
                                                    $db = $database->Connect();
                                                    
                                                    // prepare objects
                                                    $flight = new Flight($db);
                                                    $booking = new Booking($db);
                                                    $customer = new Customer($db);
                                                    $address = new Address($db);
                                                    $seatClass = new SeatClass($db);
                                                    
                                                    // set ID property of product to be edited
                                                    $booking->id = $id;
                                                    
                                                    // read the details of product to be edited
                                                    $booking->readOne();
                                                    // if the form was submitted
                                                    if($_POST){
                                                    
                                                        // set product property values
                                                        $booking->customerId = $_POST['customerId'];
                                                        $booking->flightId = $_POST['flightId'];
                                                        $booking->bookingDate = $_POST['bookingDate'];
                                                        $booking->seatNumber = $_POST['seatNumber'];
                                                        $booking->roundTrip = $_POST['roundTrip'];
                                                        $booking->seatClassId = $_POST['seatClassId'];

                                                    
                                                        // update the product
                                                        if($booking->update()){
                                                            echo "<div class='alert alert-success alert-dismissable'>";
                                                                echo "Cập nhật đơn đặt vé thành công.";
                                                            echo "</div>";
                                                        }
                                                    
                                                        // if unable to update the product, tell the user
                                                        else{
                                                            echo "<div class='alert alert-danger alert-dismissable'>";
                                                                echo "Cập nhật đơn đặt vé Thất bại.";
                                                            echo "</div>";
                                                        }
                                                    }
                                                    ?>

                                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
                                                        <table class='table table-hover  table-bordered'>
                                                    
                                                            <tr>
                                                                <td>Mã vé</td>
                                                                <td><input disabled style="max-width: 250px;"  type='text' name='id'  value="<?php echo $booking->id; ?>" class='form-control' /></td>
                                                            </tr>
                                                    
                                                            <tr>
                                                                <td>Mã khách hàng</td>
                                                                <td class="d-flex">
                                                                    <input type="text" style="max-width: 250px; margin-right:10px;" value="<?php echo $booking->customerId; ?>" class="form-control" name="customerId"/>
                                                                    <div class='input-group-append mr-3'><a href="./customer.php"><button type='button' class='btn btn-primary'><i class='fas fa-search'></i></button></a></div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Mã chuyến bay</td>
                                                                <td class="d-flex">
                                                                    <input type="text" style="max-width: 250px; margin-right:10px;" value="<?php echo $booking->flightId; ?>" class="form-control" name="flightId"/>
                                                                    <div class='input-group-append mr-3'><a href="./flight.php"><button type='button' class='btn btn-primary'><i class='fas fa-search'></i></button></a></div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Họ tên khách hàng</td>
                                                                <?php
                                                                   $customer = Customer::getCustomerById($booking->customerId)->fetch(PDO::FETCH_ASSOC);
                                                                ?>
                                                                <td><input disabled type="text" value="<?php echo $customer['fullName'] ?>" class="form-control" name="customer_fullName"/></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Hạng ghế</td>
                                                                
                                                                <td>
                                                                    <?php
                                                                    
                                                                        $selectedSeatClassId = $booking->seatClassId; // Id của SeatClass đã chọn từ Booking

                                                                        // Lấy danh sách tất cả các SeatClass
                                                                        $allSeatClasses = SeatClass::getAllSeatClasses()->fetchAll(PDO::FETCH_ASSOC);
                                                                    ?>

                                                                <select class="form-control" name="seatClassId">
                                                                    <?php
                                                                        // Lặp qua danh sách SeatClass để tạo các option
                                                                        foreach ($allSeatClasses as $seatClass) {
                                                                            $selected = ($seatClass['id'] == $selectedSeatClassId) ? 'selected' : '';
                                                                            echo "<option value='{$seatClass['id']}' $selected>{$seatClass['seat_clazz']}</option>";
                                                                        }
                                                                    ?>
                                                                </select>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Vị trí ghế</td>
                                                                <td><input readonly type="text" class="form-control" value="<?php echo $booking->seatNumber; ?>" name="seatNumber" /></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Khứ hồi</td>
                                                                <td>
                                                                    <select class="form-control" name="roundTrip">
                                                                        <option value="1" <?php echo $booking->roundTrip ? 'selected' : ''; ?> >Có khứ hồi</option>
                                                                        <option value="0" <?php echo !$booking->roundTrip ? 'selected' : ''; ?>>Không khứ hồi</option>
                                                                    </select>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Giá tiền</td>
                                                                <td><input readonly type="text" class="form-control" value="<?php echo $seatClass['amount'] ?>" name="amount" /></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Ngày đặt</td>
                                                                <?php
                                                                    // Giả sử $flight->departureTime chứa giá trị datetime từ cơ sở dữ liệu
                                                                    $bookingDate = $booking->bookingDate;

                                                                    // Chuyển đổi định dạng từ datetime thành giờ và ngày cho input kiểu datetime-local
                                                                    $bookingDateFormated = date('Y-m-d\TH:i', strtotime($bookingDate));
                                                                ?>
                                                                <td><input readonly type="datetime-local" value="<?php echo $bookingDateFormated; ?>" class="form-control" name="bookingDate" /></td>    
                                                            </tr>
                                                    
                                                            <tr>
                                                                
                                                            <?php
                                                            // Import các class và kết nối database

                                                            $database = new Database();
                                                            $conn = $database->Connect();

                                                            $flight = Flight::getFlightById($conn, $booking->flightId);

                                                            if ($flight) {
                                                                // Lấy thông tin từ $flight và sử dụng
                                                                $flightInfo = $flight->fetch(PDO::FETCH_ASSOC);
                                                                $flightTime = $flightInfo['flightTime'];
                                                                $departureTime = $flightInfo['departureTime'];
                                                                $arrivalTime = $flightInfo['arrivalTime'];
                                                                // ... và các thông tin khác
                                                                $departureAddressInfoStmt = Flight::getAddressById($conn, $flightInfo['departureAddressID']);
                                                                $arrivalAddressInfoStmt = Flight::getAddressById($conn, $flightInfo['arrivalAddressID']);
                                                                if ($departureAddressInfoStmt && $arrivalAddressInfoStmt) {
                                                                    // Sử dụng fetchObject để lấy ra đối tượng Address
                                                                    $departureAddressInfo = $departureAddressInfoStmt->fetchObject('Address', array(Database::Connect()));
                                                                    $arrivalAddressInfo = $arrivalAddressInfoStmt->fetchObject('Address', array(Database::Connect()));
                                                                
                                                                    // Kiểm tra xem có đối tượng Address không
                                                                    if ($departureAddressInfo && $arrivalAddressInfo) {
                                                                        // Truy cập thuộc tính của đối tượng Address
                                                                        $departureCity = $departureAddressInfo->city;
                                                                        $arrivalCity = $arrivalAddressInfo->city;
                                                                } else {
                                                                        echo "Không tìm thấy thông tin địa chỉ.";
                                                                    }
                                                                } else {
                                                                    echo "Không tìm thấy thông tin địa chỉ.";
                                                                }
                                                                } else {
                                                                echo "Không tìm thấy chuyến bay có ID là $flightId";
                                                            }
                                                            ?>
                                                                <td>Thời gian khởi hành</td>
                                                                <?php
                                                                    // Giả sử $flight->departureTime chứa giá trị datetime từ cơ sở dữ liệu
                                                                    $departureTimeFromDB = $departureTime;

                                                                    // Chuyển đổi định dạng từ datetime thành giờ và ngày cho input kiểu datetime-local
                                                                    $departureTimeFormatted = date('Y-m-d\TH:i', strtotime($departureTimeFromDB));
                                                                ?>

                                                                <!-- Sử dụng giá trị đã chuyển đổi trong input kiểu datetime-local -->
                                                                <td><input disabled type="datetime-local" value="<?php echo $departureTimeFormatted; ?>" class="form-control" name="departureTime" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Thời gian hạ cánh</td>
                                                                <?php
                                                                    // Giả sử $flight->arrivalTime chứa giá trị datetime từ cơ sở dữ liệu
                                                                    $arrivalTimeFromDB = $arrivalTime;

                                                                    // Chuyển đổi định dạng từ datetime thành giờ và ngày cho input kiểu datetime-local
                                                                    $arrivalTimeFormatted = date('Y-m-d\TH:i', strtotime($arrivalTimeFromDB));
                                                                ?>

                                                                <!-- Sử dụng giá trị đã chuyển đổi trong input kiểu datetime-local -->
                                                                <td><input disabled type="datetime-local" value="<?php echo $arrivalTimeFormatted; ?>" class="form-control" name="arrivalTime" /></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Điểm xuất phát -> Điểm hạ cánh</td>
                                                                <td>
                                                                    <div class="d-flex justify-content-between" style="align-items:center;">
                                                                        <?php
                                                                            echo "<input disabled type='text' class='form-control col-md-5' id='departureAddress' name='departureAddress' value='{$departureCity}' readonly />";

                                                                            echo "<div><i class='fa-solid fa-arrow-right-long fa-solid text-gray-300'></i></div>";
        
                                                                            // Hiển thị input cho Arrival Address
                                                                            echo "<input disabled type='text' class='form-control col-md-5' id='arrivalAddress' name='arrivalAddress' value='{$arrivalCity}' readonly />";
                                                                            
                                                                        ?>
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

<script src="https://cdn.jsdelivr.net/highlight.js/latest/highlight.min.js"></script>
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/popper.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
<script src="../../assets/js/main.js"></script>
<script src="../../admin-lte/dist/js/adminlte.js"></script>
<script src="../../admin-lte/plugins/select2/js/select2.full.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>
</html>