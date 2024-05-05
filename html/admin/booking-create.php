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
    <title>Đặt vé</title>

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
                                    Đặt vé
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
                                <a href="./booking.php" type="button" class="btn btn-default">
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
                                                    
                                                    // include database and object files
                                                    include("../../model/entity/Booking.php");
                                                    include("../../model/entity/SeatClass.php");
                                                    
                                                    // get database connection
                                                    $database = new Database();
                                                    $db = $database->Connect();
                                                    
                                                    // prepare objects
                                                    $booking = new Booking($db);
                                                    
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
                                                        if($booking->create()){
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
                                                    <form action="../service/add_booking.php" method="post">
                                                        <table class='table table-hover  table-bordered'>
                                                    
                                                            <tr>
                                                                <td>Mã vé</td>
                                                                <td><input disabled style="max-width: 250px;"  type='text' name='id'   class='form-control' /></td>
                                                            </tr>
                                                    
                                                            <tr>
                                                            <?php
                                                                ?>
                                                                <td>Mã khách hàng</td>
                                                                <td class="d-flex">
                                                                    <input type="text" style="max-width: 250px; margin-right:10px;"  class="form-control" name="customerId"/>
                                                                    <div class='input-group-append mr-3'><a href="./customer.php"><button type='button' class='btn btn-primary'><i class='fas fa-search'></i></button></a></div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Mã chuyến bay</td>
                                                                <td class="d-flex">
                                                                    <input type="text" style="max-width: 250px; margin-right:10px;"  class="form-control" name="flightId"/>
                                                                    <div class='input-group-append mr-3'><a href="./flight.php"><button type='button' class='btn btn-primary'><i class='fas fa-search'></i></button></a></div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                            <?php
                                                                // Khởi tạo kết nối đến cơ sở dữ liệu và import các class cần thiết
                                                                require_once "../../connect/Database.php";

                                                                // Kiểm tra nếu yêu cầu AJAX chứa tham số id
                                                                if(isset($_GET['id'])) {
                                                                    $seatClassId = $_GET['id'];

                                                                    // Thực hiện truy vấn để lấy giá tiền của hạng ghế từ cơ sở dữ liệu
                                                                    $query = "SELECT amount FROM SeatClass WHERE id = :id";
                                                                    $stmt = $conn->prepare($query);
                                                                    $stmt->bindParam(':id', $seatClassId);
                                                                    $stmt->execute();

                                                                    // Lấy giá tiền từ kết quả truy vấn
                                                                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                                                    $amount = $row['amount'];

                                                                    // Trả về giá tiền dưới dạng phản hồi AJAX
                                                                    echo $amount;
                                                                }
                                                                ?>
                                                                <td>Hạng ghế</td>
                                                                <td>
                                                                    <?php
                                                                    // Lấy danh sách tất cả các SeatClass từ cơ sở dữ liệu
                                                                    $allSeatClasses = SeatClass::getAllSeatClasses();
                                                                    ?>
                                                                    <select class="form-control" name="seatClassId" id="seatClassId">
                                                                        <?php
                                                                        // Lặp qua danh sách SeatClass để tạo các option
                                                                        foreach ($allSeatClasses as $seatClass) {
                                                                            echo "<option value='{$seatClass['id']}'>{$seatClass['seat_clazz']}</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Vị trí ghế</td>
                                                                <td><input type="text" class="form-control" value="<?php echo $booking->seatNumber; ?>" name="seatNumber" /></td>
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
                                                                <td>Ngày đặt</td>
                                                                <?php
                                                                    // Lấy ngày hiện tại và định dạng nó cho đúng định dạng datetime-local
                                                                    $currentDate = date('Y-m-d\TH:i');
                                                                ?>
                                                                <td><input readonly type="datetime-local" value="<?php echo $currentDate; ?>" class="form-control" name="bookingDate" /></td>    
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

<script src="https://cdn.jsdelivr.net/highlight.js/latest/highlight.min.js"></script>
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/popper.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
<script src="../../assets/js/main.js"></script>
<script src="../../admin-lte/dist/js/adminlte.js"></script>
<script src="../../admin-lte/plugins/select2/js/select2.full.min.js"></script>

<script>
    document.getElementById("yourFormId").addEventListener("submit", function(event) {
        // Ngăn chặn hành vi mặc định của form (không gửi form ngay lập tức)
        event.preventDefault();
        $('#message').html('<div class="alert alert-success">Đơn vé đã được tạo thành công.</div>');
    });

    document.getElementById("customerId").addEventListener("blur", function() {
        var customerId = this.value;
        
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../service/check_customer.php?customerId=" + customerId, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Xử lý phản hồi từ yêu cầu Ajax
                var response = JSON.parse(xhr.responseText);
                if (!response.exists) {
                    $('#message').html('<div class="alert alert-danger">Không tìm thấy mã khách hàng này trong cơ sở dữ liệu!</div>');
                    // Xóa giá trị của trường nhập mã khách hàng
                    document.getElementById("customerId").value = "";
                    // Đặt trỏ chuột vào trường nhập mã khách hàng
                    document.getElementById("customerId").focus();
                }
            }
        };
        xhr.send();
    });
</script>



</body>
</html>