<title><?= $website['payment']; ?></title>
<?php
if (!isset($_GET['trading'])) {
    die(href("/"));
} else {
    $trading = check_string($_GET['trading']);
}

$checkOrder = $ManhDev->get_row("SELECT * FROM `orders` WHERE `username` = '" . ($_SESSION['username'] ?? getip()) . "' AND `trading` = '$trading' LIMIT 1 ");

if (!$checkOrder) {
    //die(href("/"));
}

$qr = json_decode($ZaloPay->getQR($checkOrder['total'], $trading), true); #get mã qr
$qrcode = "data:image/png;base64," . $qr['qrcode']; #link ảnh
$bank_name = $qr['bank_name']; #ngân hàng
$bank_number = $qr['bank_number']; #stk
$display_name = $qr['display_name']; #ctk
?>
<main class="main">
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="">Thanh Toán</a></li>
                <li class="breadcrumb-item"><a href="/g/thanh-toan">Đơn Hàng</a></li>
                <li class="breadcrumb-item"><a href="">Thanh Toán Zalo Pay</a></li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-lg-12">
                <div class="order-summary">
                    <div class="alert-ManhDev"><i class="fa-solid fa-triangle-exclamation"></i></div>
                    <h4 class="text-center">THANH TOÁN ZALO PAY</h4>
                    <div class="container-ManhDev-60">
                        <div class="alert alert-info alert-rounded text-center"><?=$display_name ? 'Vui Lòng Quét Mã Để Hoàn Tất Đơn Hàng!' : 'Số Tiền Giao Dịch Quá Hạn Mức Nhận, Vui Lòng Thanh Toán Đơn Hàng Có Số Tiền Nhỏ Hơn '.numbers_format($checkOrder['total']).'đ, Chúng Tôi Xin Lỗi Vì Sự Cố Này.';?></div>
                        <div class="qrZaloPay">
                            <center><img src="/images/icon/zalopayfont.png" alt="" style="border: none; width: 100px"></center>
                            <?php if($display_name) { ?>
                            <center><img src="<?= $qrcode; ?>" alt=""></center>
                            <?php } ?>
                            <center>
                                <h4 class="mt-1 nameBank"><?=($display_name ?? 'Số Tiền Giao Dịch Quá Hạn Mức Nhận');?> <span><?=numbers_format($checkOrder['total']);?>đ</span></h4>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-6"></div>
</main>