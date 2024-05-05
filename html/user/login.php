<meta charset="UTF-8">
<link href="./assets/css/style_Sign_in_up.css" rel="stylesheet">
<script src="./assets/js/SignIn.js"></script>

<div class="container container-login flex justify-content-center align-items-center ">
    <div aria-labelledby="myModalLabel col-md-8" class="modal fade" id="myModal" role="dialog"
         tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content clearfix">
                <div class="modal-body ">
                    <div class=" form-group ">
                        <!-- Tabs -->
                        <div class="row">
                            <div class="col-md-2"></div>
                            <ul class="col-md nav nav-tabs pr-5" id="myTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-toggle="tab" href="#login-content" id="login-tab"
                                       aria-selected="true" role="tab">Đăng nhập</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-toggle="tab" href="#register-content" id="register-tab"
                                       aria-selected="false" role="tab" tabindex="-1">Đăng ký</a>
                                </li>
                            </ul>
                            <div class="col-md-3 close-form-icon">
                            </div>
                        </div>

                        <!-- Tab Contents -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="login-content">
                                <form id="login-form" method="post" action="../service/checklog.php">
                                    <div class="form-group ">

                                        <!-- Login Form -->
                                        <div class="row form-container-items mx-auto">
                                            <div class="col-md">
                                                <h5 class="title-item">Tên đăng nhập</h5>
                                                <input class="form-control" placeholder="UserName"
                                                       type="text" name="username">
                                            </div>
                                        </div>

                                        <div class="row form-container-items mx-auto">
                                            <div class="col-md">
                                                <h5 class="title-item">Mật khẩu</h5>
                                                <input class="form-control" placeholder="******"
                                                       type="text" name="password">
                                            </div>
                                        </div>

                                        <div class="row form-container-items mx-auto">
                                            <div class="col-md-6">
                                                <div class="form-check mb-5">
                                                    <input class="form-check-input"
                                                           id="chk_savePass"
                                                           type="checkbox" value="">
                                                    <label class="form-check-label"
                                                           for="chk_savePass"
                                                           style="">
                                                        Nhớ cho lần sau
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md"></div>
                                            <div class="col-md-4">
                                                <button type="submit" class="btn btn-dang-nhap">
                                                    Đăng nhập
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="register-content">

                                <!-- Register -->
                                <form id="registerForm" method="post" action="../service/addCustomer.php">
                                    <div class="row form-container-items mx-auto">
                                        <div class="col-md">
                                            <h5 class="title-item">Tên đăng nhập</h5>
                                            <input class="form-control" id="username"
                                                   placeholder="UserName" type="text" name="username">
                                            <p class="error-message"></p>

                                        </div>

                                        <div class="col-md">
                                            <h5 class="title-item">Email</h5>
                                            <input class="form-control" id="Email"
                                                   placeholder="abc@gmail.com" type="text" name="email">
                                            <p class="error-message"></p>
                                        </div>
                                    </div>

                                    <div class="row form-container-items mx-auto">

                                        <div class="col-md-6">
                                            <h5 class="title-item">Mật khẩu</h5>
                                            <input class="form-control"
                                                   placeholder="********"
                                                   type="text" name="password">
                                            <p class="error-message"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="title-item">Nhập lại mật khẩu</h5>
                                            <input class="form-control"
                                                   placeholder="********"
                                                   type="text" name="ConfirmPassword">
                                            <p class="error-message"></p>
                                        </div>
                                    </div>

                                    <div class="row form-container-items mx-auto">
                                        <div class="col-md-6">
                                            <h5 class="title-item">Họ tên đệm</h5>
                                            <input class="form-control"
                                                   placeholder="Nguyễn Văn"
                                                   type="text" name="lastName">
                                            <p class="error-message"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="title-item">Tên </h5>
                                            <input class="form-control" placeholder="An"
                                                   type="text" name="firstName">
                                            <p class="error-message"></p>
                                        </div>
                                    </div>

                                    <div class="row form-container-items mx-auto">
                                        <div class="col-md-6">
                                            <h5 class="title-item">Số điện thoại </h5>
                                            <input class="form-control"
                                                   placeholder="0777 777 777"
                                                   type="text" name="phone">
                                            <p class="error-message"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="title-item">Số CMND/ CCCD </h5>
                                            <input class="form-control"
                                                   placeholder="0312030001234"
                                                   type="text" name="CMND">
                                            <p class="error-message"></p>
                                        </div>
                                    </div>

                                    <div class="row form-container-items mx-auto">
                                        <div class="col-md-12">
                                            <h5 class="title-item">Địa chỉ</h5>
                                            <input class="form-control"
                                                   placeholder="Địa chỉ"
                                                   type="text" name="address">
                                            <p class="error-message"></p>
                                        </div>
                                    </div>

                                    <div class="row form-container-items mx-auto">
                                        <div class="col-md-6">
                                            <div class="form-check pt-3">
                                                <input class="form-check-input"
                                                       id="flexCheckDefault"
                                                       type="checkbox" value="">
                                                <label class="form-check-label"
                                                       for="flexCheckDefault"
                                                       style="font-size: 15px ;">
                                                    Tôi đã đọc và đồng ý với
                                                    <span style="color: #00d76c;"> Điều khoản</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md"></div>
                                        <div class="col-md-4">
                                            <button class="btn btn-dang-ky" id="registerButton"
                                                    type="submit">Đăng ký
                                            </button>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
