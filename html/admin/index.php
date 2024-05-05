<?php
include_once '../../model/entity/Customer.php';
include_once '../../model/entity/Flight.php';
include_once '../../model/entity/Booking.php';
include_once '../../model/entity/Invoice.php';

$database = new Database();
$db = $database->Connect();

$customer = new Customer($db);
$totalCustomers = $customer->countAllCustomers();

$flight = new Flight($db);
$totalFlights = $flight->countAllFlights();

$booking = new Booking($db);
$totalBookings = $booking->countAllBookings();

$invoice = new Invoice($db);
$totalRevenue = $invoice->calculateTotalRevenue();
?>


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
    <title>BAMBOOZ AIRLINES-Admin</title>

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
                    <li class="active">
                        <a href="./index.php">Thống kê - Báo cáo</a>
                    </li>
                    <li >
                        <a href="./customer.php">Quản lý khách hàng</a>
                    </li>
                    <li>
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
                        

                        <div class="" id="navbarSupportedContent">
                        
                        <ul class="nav ml-auto">
                            <!-- thêm tren thanh nav vao day -->
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
                                        <a href="#">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        Báo cáo thống kê
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    
                    <!-- Main content -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="genrp-btn">
                                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                    class="fas fa-download fa-sm text-white-50"></i> Xuất báo cáo</a>
                            </div>
                            <div class="row">

                                <!-- Earnings (Monthly) Card Example -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        Số lượng khách hàng</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalCustomers; ?></div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fa-solid fa-users fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                                <!-- Earnings (Monthly) Card Example -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        Số lượng chuyến bay</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalFlights; ?></div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fa-solid fa-plane-circle-check fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                                <!-- Earnings (Monthly) Card Example -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Số lượng đặt vé
                                                    </div>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalBookings; ?></div>
                                                        </div>
                                                        <!-- <div class="col">
                                                            <div class="progress progress-sm mr-2">
                                                                <div class="progress-bar bg-info" role="progressbar"
                                                                    style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                                    aria-valuemax="100"></div>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                                <!-- Pending Requests Card Example -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-warning shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                        Tổng doanh thu</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($totalRevenue) . " VND"; ?></div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fa-solid fa-clipboard fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Doanh thu năm <span style="color: orange;">2023</span></h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="#">Doanh thu năm trước</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Doanh thu năm nay</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart" width="972" height="400" style="display: block; height: 320px; width: 778px;" class="chartjs-render-monitor"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Biểu đồ thống kê đánh giá</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Hài lòng
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-warning"></i> Chưa hài lòng
                                        </span>
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

    
    <!-- Custom scripts for all pages-->
    <script src="../../assets/js/custom-admin.min.js"></script>

     <!-- Page level plugins -->
     <script src="../../assets/vendor/chart.js/Chart.min.js"></script>

     <!-- Page level custom scripts -->
     <script src="../../assets/js/demo/chart-area-demo.js"></script>
     <script src="../../assets/js/demo/chart-pie-demo.js"></script>
</body>
</html>