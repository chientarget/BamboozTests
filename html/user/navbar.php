<link rel="stylesheet" href="./assets/css/style_navbar.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<?php
session_start();
?>
<script>
    $(function () {
        $("#login").load("login.php");
    });


</script>
<nav class="navbar navbar-expand-lg" style="background-color: #21344f">
    <div class="container-fluid">
        <!-- Logo -->
        <div class="navbar-brand nav-content" data-content="Home">
            <img alt="Logo" height="50px" src="./assets/img/logo.svg">
        </div>

        <!-- Toggle button for small screens -->
        <button aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler"
                data-bs-target="#navbarNav" data-bs-toggle="collapse" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu items -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link nav-content" data-content="Home">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-content" data-content="Tra_cuu">Tra cứu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-content" data-content="Kham_pha">Khám phá</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-content" data-content="Phan_hoi">Phản hồi</a>
                </li>

                <?php if (isset($_SESSION['user'])): ?>
                    <div class="nav-item dropdown" >
                         <span class="nav-link dropdown-toggle"
                               style="color: mediumspringgreen; cursor: pointer;  width: 150%;position: absolute "
                               id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                             <?php echo $_SESSION['user']; ?>
                             <i class="fas fa-user"></i>
                        </span>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="position: absolute; margin-top: -20%">
                            <li><a class="dropdown-item" href="./user_info.php">Thông tin</a></li>
                            <li><a class="dropdown-item" href="../service/logout.php">Đăng xuất</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <div class="nav-item">
                        <button class="btn btn-outline-light show-modal" data-target="#myModal"
                                data-toggle="modal"
                                type="button">Login/SignUp
                        </button>
                        <div id="login"></div>
                    </div>
                <?php endif; ?>

                <script>
                    $(document).ready(function () {
                        $('#myTabs a').click(function (e) {
                            e.preventDefault();
                            $(this).tab('show');
                        });

                        // Xử lý sự kiện khi nút trigger được nhấp
                        $('.show-modal').click(function () {
                            // Mở modal và chuyển đến tab đăng nhập
                            $('#myModal').modal('show');
                            $('#login-tab').tab('show');
                        });
                    });
                </script>


            </ul>
        </div>
    </div>
</nav>

<script>
    $(document).ready(function () {
        $('.nav-item').on('click', function () {
            $('.nav-item').removeClass('active');
            $(this).addClass('active');
        });
    });
</script>
