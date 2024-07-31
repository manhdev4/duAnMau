$("form[submit-ajax=true]").submit(async function (e) {
    e.preventDefault(); // Giữ nguyên

    let url = $(this).attr("action"); // Đường dẫn
    let url_redirect = $(this).attr("url_redirect"); // Chuyển hướng
    let button = $(this).find('button[type=submit]'); // Info nút
    let oldTextButton = button.html(); // Văn bản nút
    let swal = $(this).attr("swal"); // Thông báo
    let time_load = $(this).attr("time_load"); // Thời gian load

    $(button).html('<i class="fad fa-solid fa-loader fa-spin"></i> Đang Xử Lý...').prop('disabled', true);

    // Sử dụng FormData để hỗ trợ upload file
    let formData = new FormData(this);

    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        processData: false, // Không xử lý dữ liệu theo cách truyền thống
        contentType: false, // Không đặt tiêu đề content-type
        dataType: 'json', // Định dạng dữ liệu trả về
        success: function (data) {
            if (data.status == 'error') {
                $("#notification").html(notification(data.msg, data.status));
                $("#notificationPass").html(notification(data.msg, data.status));
                $("#notificationAddress").html(notification(data.msg, data.status));
                $(button).html(oldTextButton).prop('disabled', false);
            } else if (data.status == 'info') {
                $("#notification").html(notification(data.msg, data.status));
                $(button).html(oldTextButton).prop('disabled', false);
            } else {
                if (url_redirect !== "none") {
                    setTimeout(function () { location.href = url_redirect }, time_load);
                }

                if (swal !== "none") {
                    $("#notification").html(notification(data.msg, data.status));
                    $("#notificationPass").html(notification(data.msg, data.status));
                    $("#notificationAddress").html(notification(data.msg, data.status));
                } else {
                    $("#notification").html(" ");
                    $("#notificationPass").html(notification(data.msg, data.status));
                    $("#notificationAddress").html(notification(data.msg, data.status));
                }

                $(button).html(oldTextButton).prop('disabled', false);
            }
        },
        error: function () {
            $("#notification").html(notification("Dữ Liệu Quá Tải", "error"));
            $(button).html(oldTextButton).prop('disabled', false);
        }
    });
});

function notification(msg, type) {
    var type;
    if (type == "success") {
        type = "success";
    } else if (type == "error") {
        type = "danger";
    } else if (type == "warning") {
        type = "warning";
    } else if (type == "info") {
        type = "primary";
    }
    return `<div class="alert alert-${type}">${msg}</div>`;
}

function delAddress(id) {
    var dataPost = {
        type: "delAddress",
        id: id
    };
    $.post("/api/client", dataPost, function (data) {
        if (data.status == 'error') {
            Swal.fire("Thông Báo", data.msg, data.status);
        } else {
            setTimeout(function () { location.href = "" }, 0);
        }
    }, "json");
}

function defaultAddress(id) {
    var dataPost = {
        type: "defaultAddress",
        id: id
    };
    $.post("/api/client", dataPost, function (data) {
        if (data.status == 'error') {
            Swal.fire("Thông Báo", data.msg, data.status);
        } else {
            setTimeout(function () { location.href = "" }, 0);
        }
    }, "json");
}

function xoaUsers(id) {
    var dataPost = {
        type: "delUser",
        id: id
    };
    $.post("/api/admin", dataPost, function (data) {
        if (data.status == 'error') {
            Swal.fire("Thông Báo", data.msg, data.status);
        } else {
            setTimeout(function () { location.href = "" }, 0);
        }
    }, "json");
}

function xoa(id, table) {
    var dataPost = {
        type: "deleteOne",
        table: table,
        id: id
    };
    $.post("/api/admin", dataPost, function (data) {
        if (data.status == 'error') {
            Swal.fire("Thông Báo", data.msg, data.status);
        } else {
            setTimeout(function () { location.href = "" }, 0);
        }
    }, "json");
}

function addCart(id) {
    var dataPost = {
        type: "addCart",
        id: id
    };
    $.post("/api/client", dataPost, function (data) {
        if (data.status == 'error') {
            Swal.fire("Thông Báo", data.msg, data.status);
        } else {
            location.href = "";
        }
    }, "json");
}

function star(star) {
    document.getElementById("starInput").value = star;
}

function delCart(id) {
    var dataPost = {
        type: "delCart",
        id: id
    };
    $.post("/api/client", dataPost, function (data) {
        if (data.status == 'error') {
            Swal.fire("Thông Báo", data.msg, data.status);
        } else {
            location.href = ""
        }
    }, "json");
}

function delComment(id) {
    var dataPost = {
        type: "delComment",
        id: id
    };
    $.post("/api/admin", dataPost, function (data) {
        if (data.status == 'error') {
            Swal.fire("Thông Báo", data.msg, data.status);
        } else {
            location.href = ""
        }
    }, "json");
}

function href(link) {
    location.href = link;
}

function payment(users) {
    $("#buttonPayment").html('<i class="fad fa-solid fa-loader fa-spin"></i> Đang Xử Lý...').prop('disabled', true);
    var dataPost;
    if (users == "login") {
        dataPost = {
            type: "payment",
            paymentMethod: $("[name=PaymentMothod]").val(),
            name: $("#name").val(),
            phone: $("#phone").val(),
            email: $("#email").val(),
            address: $("#address1").val()
        };
    } else {
        dataPost = {
            type: "payment",
            paymentMethod: $("[name=PaymentMothod]:checked").val()
        };
    }
    $.post("/api/client", dataPost, function (data) {
        if (data.status == 'success') {
            location.href = data.link
        } else {
            $("#buttonPayment").html('Thanh Toán').prop('disabled', false);
            $("#notification").html(notification(data.msg, data.status));
        }
    }, "json");
}

function refund(trading) {
    $("#buttonPayment").html('<i class="fad fa-solid fa-loader fa-spin"></i> Đang Xử Lý...').prop('disabled', true);
    dataPost = {
        type: "refund",
        trading: trading
    };
    $.post("/api/client", dataPost, function (data) {
        if (data.status == 'success') {
            location.href = "/g/thong-tin-tai-khoan";
            $("#buttonPayment").html('Xác Nhận Hoàn Đơn').prop('disabled', false);
        } else {
            $("#buttonPayment").html('Xác Nhận Hoàn Đơn').prop('disabled', false);
            $("#notification").html(notification(data.msg, data.status));
        }
    }, "json");
}