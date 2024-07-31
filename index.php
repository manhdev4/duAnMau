<?php include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php"; 
include $_SERVER['DOCUMENT_ROOT'] . "/class/zalopay.php";
$website = [
    "home" => $ManhDev->site("nameWeb")." - Cửa hàng bán thiết bị điện tử, phụ kiện uy tín tại Việt Nam",
    "login" => $ManhDev->site("nameWeb")." - Đăng Nhập Hệ Thống",
    "register" => $ManhDev->site("nameWeb")." - Đăng Ký Tài Khoản",
    "profile" => $ManhDev->site("nameWeb")." - Tài Khoản & Đơn Hàng",
    "cart" => $ManhDev->site("nameWeb")." - Giỏ Hàng",
    "news" => $ManhDev->site("nameWeb")." - 24h Công Nghệ",
    "payment" => $ManhDev->site("nameWeb")." - Thanh Toán Giỏ Hàng",
    "refund" => $ManhDev->site("nameWeb")." - Hoàn Trả Đơn Hàng",
    "zalopay" => $ManhDev->site("nameWeb")." - Thanh Toán Zalo Pay",
];

include $_SERVER['DOCUMENT_ROOT'] . "/include/header.php";

if(explode("product/", $_GET['action'])[1]) {
    $code = explode("product/", $_GET['action'])[1];
    include $_SERVER['DOCUMENT_ROOT']."/resources/product.php";
} else if(explode("category/", $_GET['action'])[1]) {
    $code = explode("category/", $_GET['action'])[1];
    include $_SERVER['DOCUMENT_ROOT']."/resources/category.php";
} else if(explode("tin-tuc/", $_GET['action'])[1]) {
    $code = explode("tin-tuc/", $_GET['action'])[1];
    include $_SERVER['DOCUMENT_ROOT']."/resources/view-tin-tuc.php";
} else {
switch(($_GET['action'] ?? "home")) {
    case ($_GET['action'] ?? "home"):
        include $_SERVER['DOCUMENT_ROOT']."/resources/".($_GET['action'] ?? "home").".php";
        break;
}
}
include $_SERVER['DOCUMENT_ROOT'] . "/include/foot.php";