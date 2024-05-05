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
    <title>Danh sách địa điểm bay</title>
    <?php
            include_once '../config/core.php'; 
    ?>
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
                    <li>
                        <a href="./flight.php">Quản lý chuyến bay</a>
                    </li>
                    <li class="active">
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
                                       Danh sách địa điểm bay
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
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default" class="btn btn-primary">
                                            <i class="fas fa-plus"></i>  Địa điểm
                                            </button>
                                            <a href="./address.php" type="button" class="btn btn-info">
                                                <i class="fas fa-redo"></i> Refresh
                                            </a>
                                        </div>
                                        <div class="d-flex mb-3">
                                            <?php
                                                echo "<form role='search' action='../service/search_address.php'>";
                                                $search_value=isset($search_term) ? "value='{$search_term}'" : "";
                                                    echo "<input type='text' class='form-control' placeholder='Tìm kiếm theo tên...' style='position: relative;' name='search_id' id='srch-term' required {$search_value} > ";
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

                                        <?php

                                            if($total_rows>0){
                                                echo "<table class='table table-hover table-bordered'>";
                                                    echo "<tr>";
                                                        echo "<th>ID</th>";
                                                        echo "<th>Sân bay</th>";
                                                        echo "<th>Thành Phố</th>";
                                                        echo "<th>Quốc Gia</th>";
                                                        echo "<th>Chi tiết</th>";
                                                    echo "</tr>";
                                            
                                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                                                        $address_id = $row['id'];
                                                        $city = $row['city'];
                                                        $country = $row['country'];
                                                        $airfield = $row['airfield'];

                                            
                                                        echo "<tr>";
                                                            echo "<td>{$address_id}</td>";
                                                            echo "<td>{$airfield}</td>";
                                                            echo "<td>{$city}</td>";
                                                            echo "<td>{$country}</td>";
                                                            echo "<td>";
                                                                // read, edit and delete buttons
                                                            echo "
                                                            <button type='button' class='btn btn-primary update-btn' name='update-btn' data-toggle='modal' data-target='#modal-update'>
                                                            Chỉnh sửa
                                                            </button>";
                                                            echo "</td>";
                                            
                                                        echo "</tr>";
                                            
                                                    }
                                            
                                                echo "</table>";
                                            // the page where this paging is used
                                                $page_url = "address.php?";
                                                
                                                // count all products in the database to calculate total pages
                                                $total_rows = $address->countAll();
                                                
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
                        

                        <div class="modal fade" id="modal-default">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Thêm địa điểm</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    
                                    <form action="add_address.php" method="post">
                                        <div class="form-group">
                                            <label for="airfield">Tên sân bay</label>
                                            <input type="text" class="form-control" placeholder="Enter name ..." id="airfield" name="airfield">
                                        </div>
                                        <div class="form-group">
                                            <label for="city">Tên thành phố</label>
                                            <input type="text" class="form-control" placeholder="Enter name ..." id="city" name="city">
                                        </div>
                                        <div class="form-group">
                                            <label for="country">Tên quốc gia</label>
                                            <input type="text"  class="form-control" placeholder="Enter name ..." id="country" name="country">
                                        </div>
                                        <div class="modal-footer justify-content-end">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                            <button type="submit" class="btn btn-primary" name="submit">Lưu</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                    
                        </div>

                        <!-- update_address_form.php -->
                        <div class="modal fade" id="modal-update">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Cập nhật địa điểm</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="update_address.php" method="post" id="update_form">
                                            <div class="form-group " style="max-width:100px;">
                                                <label>Mã địa điểm</label>
                                                <input disabled type="text" class="form-control" name="update_address_id" id="update_address_id">
                                            </div>
                                            <div class="form-group">
                                                <label for="update_airfield">Tên sân bay</label>
                                                <input type="text" class="form-control" id="update_airfield" name="update_airfield">
                                            </div>
                                            <div class="form-group">
                                                <label for="update_city">Tên thành phố</label>
                                                <input type="text"  class="form-control" id="update_city" name="update_city">
                                            </div>
                                            <div class="form-group">
                                                <label for="update_country">Tên quốc gia</label>
                                                <input type="text" class="form-control" id="update_country" name="update_country">
                                            </div>
                                            <div class="modal-footer justify-content-end">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                <button type="submit" class="btn btn-primary update-btn" name="update_submit" id="update_submit">Cập nhật</button>
                                            </div>
                                        </form>
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


    <script>
        document.addEventListener('DOMContentLoaded', function () {
        var updateBtns = document.querySelectorAll('.update-btn');

        updateBtns.forEach(function (updateBtn) {
            updateBtn.addEventListener('click', function () {
                // Lấy thông tin hiện tại từ hàng trong bảng
                var currentRow = this.closest('tr');
                var address_id = currentRow.querySelector('td:first-child').textContent;
                var airfield = currentRow.querySelector('td:nth-child(2)').textContent;
                var city = currentRow.querySelector('td:nth-child(3)').textContent;
                var country = currentRow.querySelector('td:nth-child(4)').textContent;

                // Gán giá trị cho các ô input trong form
                document.getElementById('update_address_id').value = address_id;
                document.getElementById('update_airfield').value = airfield;
                document.getElementById('update_city').value = city;
                document.getElementById('update_country').value = country;

                // Hiển thị modal cập nhật
                document.getElementById('modal-update').style.display = 'block';
            });
        });
    });

    $(document).on('click', '#update_submit', function (e) {
        e.preventDefault();

        var address_id = $('#update_address_id').val();
        var address_airfield = $('#update_airfield').val();
        var address_city = $('#update_city').val();
        var address_country = $('#update_country').val();

        console.log("address_id:", address_id);
console.log("address_airfield:", address_airfield);
console.log("address_city:", address_city);
console.log("address_country:", address_country);
        // Sử dụng Ajax để gửi dữ liệu đến trang update_address.php
        $.ajax({
            url: '../service/update_address.php',
            type: 'POST',
            data: {
                update_submit: 1,
                address_id: address_id,
                airfield: address_airfield,
                city: address_city,
                country: address_country
            },
            success: function(response) {
                // Xử lý kết quả từ trang update_address.php (nếu cần)
                console.log("response :",response);
                
                // Đóng modal sau khi cập nhật thành công
                $('#modal-update').modal('hide');
                
                // Reload trang để hiển thị dữ liệu đã cập nhật
                location.reload();
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
    </script>

</body>
</html>