<title><?= $website['payment']; ?></title>

<?php
if (!isset($_GET['trading'])) {
    die(href("/"));
} else {
    $trading = check_string($_GET['trading']);
}

$checkOrder = $ManhDev->get_row("SELECT * FROM `orders` WHERE `username` = '" . ($_SESSION['username'] ?? getip()) . "' AND `trading` = '$trading' LIMIT 1 ");

if(!$checkOrder) {
    die(href("/"));
}
?>
<main class="main">
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="">Thanh Toán</a></li>
                <li class="breadcrumb-item"><a href="">Đơn Hàng</a></li>
                <li class="breadcrumb-item"><a href="">#<?= $trading; ?></a></li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-lg-12">
                <div class="order-summary">
                    <div class="ticker-ManhDev"><i class="fas fa-check"></i></div>
                    <h4 class="text-center">TẠO ĐƠN HÀNG THÀNH CÔNG</h4>
                    <div class="container text-center">Bạn Đã Đặt Hàng Thành Công, Vui Lòng Kiểm Tra Email Để Biết Thêm Thông Tin!</div>
                    <center><a href="/" class="btn btn-primary btn-sm mt-2">Quay Về Trang Chủ</a></center>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-6"></div>
</main>