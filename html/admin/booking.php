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
    <title>Danh sách đặt vé</title>
    <?php
            include_once '../config/core.php'; 
        ?>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="../../assets/css/adminStyle.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

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
                                        Danh sách vé đã đặt
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    
                    <!-- Main content -->
                    <section class="content">
                        <div class="container-fluid">

                            <div class="row py-2">
                                <div class="col-12 d-flex justify-content-between">
                                    <div>
                                        <a href="./booking-create.php" type="button" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Đặt vé
                                        </a>
                                        <a href="./booking.php" type="button" class="btn btn-info">
                                            <i class="fas fa-redo"></i> Refresh
                                        </a>
                                    </div>
                                    <div class="d-flex mb-3">
                                    <?php
                                        echo "<form role='search' action='../service/search_booking.php'>";
                                        $search_value = isset($search_term) ? "value='{$search_term}'" : "";
                                        echo "<input type='text' class='form-control' placeholder='Tìm kiếm vé đặt...' style='position: relative;' name='search_name' id='srch-term' required {$search_value} > ";
                                        echo "<div class='input-group-append mr-3' style='position: absolute; right: 0;top: 0;'><button type='submit' class='btn btn-primary'><i class='fas fa-search'></i></button></div>";

                                        echo "</form>";
                                        ?>        
                                </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                        <div id="message"></div>
     
                                        <?php

                                            include_once("../../model/entity/Booking.php");
                                                // instantiate database and objects
                                                $database = new Database();
                                                $db = $database->Connect();
                                                
                                                $booking = new Booking($db);
                                                
                                                // query products
                                                $stmt = $booking->readAll($from_record_num, $records_per_page);
                                                $num = $stmt->rowCount();
                                                
                                            if($num>0){
                                                echo "<table class='table table-hover table-bordered'>";
                                                    echo "<tr>";
                                                        echo "<th>Mã vé</th>";
                                                        echo "<th>Mã khách hàng</th>";
                                                        echo "<th>Mã chuyến bay</th>";
                                                        echo "<th>Họ tên khách hàng</th>";
                                                        echo "<th>Thời gian khởi hành</th>";
                                                        echo "<th>Hạng ghế</th>";
                                                        echo "<th>Chi tiết</th>";
                                                    echo "</tr>";
                                            
                                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                            
                                                        $booking_id = $row['id'];
                                                        $customer_id = $row['customer_id'];
                                                        $flight_id = $row['flight_id'];
                                                        $customer_fullName = $row['customerFullName'];
                                                        $departureTime = date('H:i || d-m-Y', strtotime($row['flightDepartureTime']));
                                                        $seat_class = $row['seatClass'];
                                            
                                                        echo "<tr>";
                                                            echo "<td>{$booking_id}</td>";
                                                            echo "<td>{$customer_id}</td>";
                                                            echo "<td>{$flight_id}</td>";
                                                            echo "<td class='text-warning'>{$customer_fullName}</td>";
                                                            echo "<td class='text-info'>{$departureTime}</td>";
                                                            echo "<td>{$seat_class}</td>";
                                                            echo "<td>";
                                                                // read, edit and delete buttons
                                                                echo "
                                                                <a href='booking-detail.php?id={$booking_id}' class='btn btn-info left-margin'>
                                                                <span class='glyphicon glyphicon-edit'></span> Edit
                                                                </a>

                                                                <a delete-id='{$booking_id}' name='delete-object' id='delete-object' class='btn btn-danger delete-object'>
                                                                <span class='glyphicon glyphicon-remove'></span> Delete
                                                                </a>";
                                                            echo "</td>";
                                            
                                                        echo "</tr>";
                                            
                                                    }
                                            
                                                echo "</table>";
                                            // the page where this paging is used
                                                $page_url = "booking.php?";
                                                
                                                // count all products in the database to calculate total pages
                                                $total_rows = $booking->countAll();
                                                
                                                // paging buttons here
                                                include_once 'paging.php';

                                            }
                                            
                                            // tell the user there are no products
                                            else{
                                                echo "<div class='alert alert-info'>No products found.</div>";
                                            }
                                            ?>
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
        <script src="https://cdn.jsdelivr.net/npm/bootbox@5.5.2/dist/bootbox.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


        <script>
            // JavaScript for deleting product
            $(document).on('click', '.delete-object', function(){
            
                var id = $(this).attr('delete-id');
            
                bootbox.confirm({
                    message: "<h4>Are you sure?</h4>",
                    buttons: {
                        confirm: {
                            label: '<span class="glyphicon glyphicon-ok"></span> Yes',
                            className: 'btn-danger'
                        },
                        cancel: {
                            label: '<span class="glyphicon glyphicon-remove"></span> No',
                            className: 'btn-primary'
                        }
                    },
                    callback: function (result) {
            
                        if(result==true){
                            $.post('../service/delete_booking.php', {
                                booking_id: id
                            }, function(data){
                                console.log(data);
                                $('#message').html('<div class="alert alert-success">Xóa thành công.</div>');

                            }).fail(function(error) {
                                console.error(error.responseText);
                                alert('Lỗi j đó ròi.');
                            });
                        }
                    }
                });
            
                return false;
            });
        </script>
</body>
</html>