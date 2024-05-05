// ==== Điều hướng và tải nội dung từ trang HTML ====

loadContent("#navbar-placeholder", "navbar");
loadContent("#login", "login");
loadContent("#Home", "Home");
loadContent("#TraCuu", "Tra_Cuu");
loadContent("#Kham_pha", "Kham_pha");
loadContent("#Phan_hoi", "Phan_hoi");
loadContent("#Tim_Ve", "Tim_Ve");
loadContent("#user_info", "user_info");

// ==== Phần xử lý khi tải trang ====

//  laod file navbar.php
$(function () {
    $("#navbar-placeholder").load("./navbar.php", function () {
        $(".nav-content").click(function (e) {
            e.preventDefault();
            var contentName = $(this).data("content");
            loadContent("#content", contentName);
        });

        // Tự động tải nội dung trang Home khi trang web được tải
        loadContent("#content", "Home");
    });
});

// laod content HTML vào index.php
function loadContent(selector, pageName) {
    $(selector).load(pageName + ".php");
}
var locations = [
    "Hà Nội",
    "TP.HCM",
    "Đà Nẵng",
    "Hải Phòng",
    "Cần Thơ",
    "Nha Trang",
    "Đà Lạt",
    "Vũng Tàu",
    "Phú Quốc",
    "Quảng Ninh"
];

$(function() {
    $("#diemdi, #diemden").autocomplete({
        source: locations
    });
});

function showAlert(message) {
    // Set the text of the alert box
    $('#customAlert p').text(message);

    // Display the alert box
    $('#customAlert').css('display', 'block');
}
$(document).ready(function () {
    var alertBox = document.getElementById('customAlert');
    var closeBtn = document.getElementsByClassName('close-btn')[0];

    closeBtn.onclick = function() {
        alertBox.style.display = 'none';
    }
});

$(document).ready(function() {
    var urlParams = new URLSearchParams(window.location.search);
    var message = urlParams.get('message');
    if (message) {
        showAlert(decodeURIComponent(message));
    }
});
