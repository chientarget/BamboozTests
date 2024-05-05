$(document).ready(function () {
    $('#myTabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    // Xử lý sự kiện khi nút trigger được nhấp
    $('.show-modal').click(function () {
        $('#myModal').modal('show');
        $('#login-tab').tab('show');
    });

    // Xử lý sự kiện khi icon đóng form được nhấp
    $('.close-form-icon').click(function () {
        $('#myModal').modal('hide');
    });
});

$(document).ready(function () {

    // Xử lý sự kiện khi form đăng ký được submit
    $('#registerForm').submit(function (e) {
        // Reset tất cả các thông báo lỗi
        resetErrorMessages();

        // Lấy giá trị từ form
        var username = $('#registerForm input[name="username"]').val();
        var email = $('#registerForm input[name="email"]').val();
        var password = $('#registerForm input[name="password"]').val();
        var confirmPassword = $('#registerForm input[name="ConfirmPassword"]').val();
        var phone = $('#registerForm input[name="phone"]').val();
        var CMND = $('#registerForm input[name="CMND"]').val();

        // Kiểm tra dữ liệu
        if (
            !checkRequiredFields(username, email, password, confirmPassword, phone, CMND) ||
            !checkEmailFormat(email) ||
            !checkPasswordRequirements(password) ||
            !checkMatchingPasswords(password, confirmPassword) ||
            !checkUsernameFormat(username) ||
            !checkPhoneFormat(phone) ||
            !checkCMNDFormat(CMND)
        ) {
            e.preventDefault(); // Ngăn chặn form submit nếu có lỗi
        }
    });

    // Kiểm tra dữ liệu khi người dùng nhập vào ô email
    $('#registerForm input[name="email"]').on('input', function () {
        var email = $(this).val();
        var emailField = $(this);

        // Kiểm tra email đúng định dạng
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            showErrorMessage(emailField, 'Email không đúng định dạng.');
        } else {
            hideErrorMessage(emailField);
        }
    });

    // Kiểm tra dữ liệu khi người dùng nhập vào ô password
    $('#registerForm input[name="password"]').on('input', function () {
        var password = $(this).val();
        var passwordField = $(this);

        // Kiểm tra mật khẩu có đủ 8 ký tự và ít nhất một ký tự viết hoa
        if (password.length < 8 || !/[A-Z]/.test(password)) {
            showErrorMessage(passwordField, 'Mật khẩu phải có ít nhất 8 ký tự và chứa ít nhất một ký tự viết hoa.');
        } else {
            hideErrorMessage(passwordField);
        }
    });

    // Kiểm tra dữ liệu khi người dùng nhập vào ô ConfirmPassword
    $('#registerForm input[name="ConfirmPassword"]').on('input', function () {
        var confirmPassword = $(this).val();
        var confirmPasswordField = $(this);

        // Kiểm tra mật khẩu và xác nhận mật khẩu có khớp nhau
        var password = $('#registerForm input[name="password"]').val();
        if (password !== confirmPassword) {
            showErrorMessage(confirmPasswordField, 'Mật khẩu và xác nhận mật khẩu không khớp.');
        } else {
            hideErrorMessage(confirmPasswordField);
        }
    });

    // Kiểm tra dữ liệu khi người dùng nhập vào ô username
    $('#registerForm input[name="username"]').on('input', function () {
        var username = $(this).val();
        var usernameField = $(this);

        // Kiểm tra tên đăng nhập không chứa khoảng trắng và ký tự đặc biệt
        var usernameRegex = /^[^\s!@#$%^&*()_+{}\[\]:;<>,.?~\\/`'"\|]+$/;
        if (!usernameRegex.test(username)) {
            showErrorMessage(usernameField, 'Tên đăng nhập không được chứa khoảng trắng và ký tự đặc biệt.');
        } else {
            hideErrorMessage(usernameField);
        }
    });

    // Kiểm tra dữ liệu khi người dùng nhập vào ô phone
    $('#registerForm input[name="phone"]').on('input', function () {
        var phone = $(this).val();
        var phoneField = $(this);

        // Kiểm tra số điện thoại đủ 10 số
        var phoneRegex = /^\d{10}$/;
        if (!phoneRegex.test(phone)) {
            showErrorMessage(phoneField, 'Số điện thoại phải có đủ 10 số.');
        } else {
            hideErrorMessage(phoneField);
        }
    });

    // Kiểm tra dữ liệu khi người dùng nhập vào ô CMND
    $('#registerForm input[name="CMND"]').on('input', function () {
        var CMND = $(this).val();
        var CMNDField = $(this);

        // Kiểm tra số CMND phải có 12 số
        var cmndRegex = /^\d{12}$/;
        if (!cmndRegex.test(CMND)) {
            showErrorMessage(CMNDField, 'Số CMND phải có đủ 12 số.');
        } else {
            hideErrorMessage(CMNDField);
        }
    });

    // Hàm hiển thị thông báo lỗi
    function showErrorMessage(element, message) {
        // Tìm hoặc tạo thẻ p chứa thông báo lỗi
        var errorMessage = element.next('.error-message');
        if (!errorMessage.length) {
            errorMessage = $('<p class="error-message"></p>');
            element.after(errorMessage);
        }

        // Đặt nội dung và hiển thị thông báo lỗi
        errorMessage.text(message).show();
    }

    // Hàm ẩn thông báo lỗi
    function hideErrorMessage(element) {
        element.next('.error-message').hide();
    }

    function resetErrorMessages() {
        $('.error-message').hide();
    }
});


