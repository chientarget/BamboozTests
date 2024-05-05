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
    <title>Thêm mới khách hàng</title>
    <style>
        /* Mặc định màu sắc cho select và option */
        select, option {
        color: black; /* Màu sắc mặc định */
        }

        /* Thiết lập màu sắc khi có chuyến */
        select[name="visaCreated"] option[value="true"] {
            color: green;
        }

        /* Thiết lập màu sắc khi chưa có chuyến */
        select[name="visaCreated"] option[value="false"] {
            color: red;
        }
</style>
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
                    <li  class="active">
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
                                        Thêm mới khách hàng
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
                                    <a href="./customer.php" type="button" class="btn btn-default">
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
                                                    include("../../model/entity/Customer.php");

                                                    // get database connection
                                                    $database = new Database();
                                                    $db = $database->Connect();

                                                    // prepare objects
                                                    $customer = new Customer($db);

                                                    // if the form was submitted
                                                    if($_POST){
                                                        // set product property values
                                                        $customer->fullName = $_POST['fullName'];
                                                        $customer->address = $_POST['address'];
                                                        $customer->phone = $_POST['phone'];
                                                        $customer->birthDate = $_POST['birth_date'];
                                                        $customer->email = $_POST['email'];
                                                        $customer->CMND = $_POST['CMND'];
                                                        $customer->username = $_POST['username'];
                                                        $customer->password = $_POST['password'];
                                                        if ($_POST['visaCreated'] == 'true') {
                                                            $customer->visaCreated = true;
                                                        } else {
                                                            $customer->visaCreated = false;
                                                        }

                                                        // update the product
                                                        if($customer->create()){
                                                            echo "<div class='alert alert-success alert-dismissable'>";
                                                                echo "Customer was created.";
                                                            echo "</div>";
                                                            exit();
                                                        }

                                                        // if unable to update the product, tell the user
                                                        else{
                                                            echo "<div class='alert alert-danger alert-dismissable'>";
                                                                echo "Unable to create Customer.";
                                                            echo "</div>";
                                                        }
                                                    }
                                                    ?>
                                                    <div id="message"></div>
                                                    <form >
                                                        <table class='table table-hover  table-bordered'>

                                                            <tr>
                                                                <td>Mã khách hàng</td>
                                                                <td><input style="max-width: 200px;" disabled type='text' name='customer_id'  value="Tự động tạo" class='form-control' /></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Trạng thái</td>
                                                                <td>
                                                                    <select style="max-width: 200px;" class="form-control" name='visaCreated'>
                                                                        <option value="false">Chưa có chuyến</option>
                                                                        <option value="true" >Có chuyến</option>
                                                                    </select>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Họ tên</td>
                                                                <td><input required type="text"  class="form-control" name="fullName"/></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Tên đăng nhập</td>
                                                                <td><input required type="text" class="form-control" name="username" /></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Mật khẩu</td>
                                                                <td><input required type="text" class="form-control" name="password" /></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Ngày sinh</td>
                                                                <td><input required type="date" class="form-control" name="birth_date"/></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Số điện thoại</td>
                                                                <td><input required type="text " class="form-control" name="phone" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Email</td>
                                                                <td><input required type="text"  class="form-control" name="email"/></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Địa chỉ</td>
                                                                <td><input required type="text" class="form-control" name="address" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Căn cước công dân</td>
                                                                <td><input required type="text" class="form-control"  name="CMND" /></td>
                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                    <div id="show-err" style=" display: none; color: red">Đây là lỗi!</div>
                                                                </td>
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
    <script >
        document.querySelector("form").addEventListener("submit", function(event){
            event.preventDefault();

            var formData = new FormData(this);

            fetch('../service/add_customer.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(response => {
                if (response.trim() === "Khách hàng đã được tạo.") {
                    $('#message').html('<div class="alert alert-success">Khách hàng đã được tạo.</div>');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
    
</body>
</html>