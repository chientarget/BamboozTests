// ==== Điều hướng và tải nội dung từ trang HTML ====

// Function để tải nội dung từ trang HTML vào một phần tử được chỉ định
function loadContent(selector, pageName) {
    $(function () {
        $(selector).load(pageName + ".html");
    });
}

// Tải nội dung vào các phần tử cụ thể trên trang
loadContent("#navbar-placeholder", "navbar");
loadContent("#login", "login");
loadContent("#Home", "Home");
loadContent("#TraCuu", "Tra_Cuu");
loadContent("#Kham_pha", "Kham_pha");
loadContent("#Phan_hoi", "Phan_hoi");
loadContent("#Tim_Ve", "Tim_Ve");

// ==== Phần xử lý khi tải trang ====

// Tải nội dung của thanh điều hướng từ file navbar.html và xử lý sự kiện click
$(function () {
    $("#navbar-placeholder").load("navbar.html", function () {
        // Lắng nghe sự kiện click trên các nút có class 'nav-content'
        $(".nav-content").click(function (e) {
            e.preventDefault();
            // Lấy giá trị của thuộc tính 'data-content'
            var contentName = $(this).data("content");
            // Tải nội dung tương ứng và nhúng vào thẻ 'content'
            loadContent("#content", contentName);
        });
    });
});

// Function để tải nội dung từ trang HTML vào một phần tử được chỉ định
function loadContent(selector, pageName) {
    $(selector).load(pageName + ".html");
}




