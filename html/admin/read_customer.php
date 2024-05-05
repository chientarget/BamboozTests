<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../assets/img/favicon.png" rel="icon">
        <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
       
        <?php
            include_once '../config/core.php';
            
        ?>
        <title>Danh sách khách hàng</title>

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
            <a href="#" class="img logo rounded-circle" style="background-image: url(../../assets//img/beluga.jpg);"></a>
            <h4 class="logo-name"><a href="#">Admin-BamBooz</a></h4>
                <ul class="list-unstyled components mb-5">
                    <li>
                        <a href="./index.php">Thống kê - Báo cáo</a>
                    </li>
                    <li class="active">
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
                                            Danh sách khách hàng
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
                                            <a href="./customer-add.php" type="button" class="btn btn-primary">
                                                <i class="fas fa-plus"></i> Khách hàng
                                            </a>
                                            <a href="./customer.php" type="button" class="btn btn-info">
                                                <i class="fas fa-redo"></i> Refresh
                                            </a>
                                        </div>
                                        <div class="d-flex mb-3">
                                            <?php
                                                echo "<form role='search' action='../service/search_customer.php'>";
                                                $search_value=isset($search_term) ? "value='{$search_term}'" : "";
                                                    echo "<input type='text' class='form-control' placeholder='Tìm kiếm theo CMND...' style='position: relative;' name='s' id='srch-term' required {$search_value} > ";
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
                                                                echo "<th>Mã KH</th>";
                                                                echo "<th>Họ tên</th>";
                                                                echo "<th>Ngày sinh</th>";
                                                                echo "<th>Email</th>";
                                                                echo "<th>Số điện thoại</th>";
                                                                echo "<th>Trạng thái</th>";
                                                                echo "<th>Chi tiết</th>";
                                                            echo "</tr>";
                                                      
                                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                                      
                                                                    $customer_id = $row['id'];
                                                                    $fullName = $row['fullName'];
                                                                    $birthDate = $row['birth_date'];
                                                                    $email = $row['email'];
                                                                    $phone = $row['phone'];
                                                                    $visaCreated = $row['visaCreated'];
                                                      
                                                                echo "<tr>";
                                                                    echo "<td>{$customer_id}</td>";
                                                                    echo "<td>{$fullName}</td>";
                                                                    echo "<td>{$birthDate}</td>";
                                                                    echo "<td>{$email}</td>";
                                                                    echo "<td>{$phone}</td>";
                                                                    echo "<td style='color: " . ($visaCreated ? 'green' : 'red') . "'>" . ($visaCreated ? 'Có chuyến' : 'Không có chuyến') . "</td>";
                                                                    echo "<td>";
                                                                        // read, edit and delete buttons
                                                                        echo "
                                                                        <a href='customer-detail.php?id={$customer_id}' class='btn btn-info left-margin'>
                                                                        <span class='glyphicon glyphicon-edit'></span> Edit
                                                                        </a>

                                                                        <a delete-id='{$customer_id}' name='delete-object' id='delete-object' class='btn btn-danger delete-object'>
                                                                        <span class='glyphicon glyphicon-remove'></span> Delete
                                                                        </a>";
                                                                    echo "</td>";
                                                      
                                                                echo "</tr>";
                                                      
                                                            }
                                                      
                                                        echo "</table>";
                                                      // the page where this paging is used
                                                        $page_url = "customer.php?";
                                                        
                                                        // count all products in the database to calculate total pages
                                                        $total_rows = $customer->countAll();
                                                        
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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
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
                            $.post('../service/delete_customer.php', {
                                customer_id: id
                            }, function(data){
                                console.log(data);
                                toastr.info("Thao tác xong");
                                // Chờ trước khi chuyển hướng
                                setTimeout(function(){
                                    // Chuyển hướng đến trang mới
                                    window.location.href = '../admin/customer.php';
                                }, 500);
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </body>
</html>