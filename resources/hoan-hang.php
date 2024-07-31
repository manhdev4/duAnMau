<title><?= $website['refund']; ?></title>
<?php if (!isset($_GET['trading'])) {
    die(href("/g/thong-tin-tai-khoan"));
}

$viewOrders = $ManhDev->get_row("SELECT * FROM `orders` WHERE `trading` = '" . $_GET['trading'] . "' ");
if (!$viewOrders) {
    die(href("/g/thong-tin-tai-khoan"));
}

if ($viewOrders['status'] == "refund") {
    die(href("/g/thong-tin-tai-khoan"));
}
?>
<main class="main">
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="">Hoàn Trả Đơn Hàng</a></li>
                <li class="breadcrumb-item"><a href="">#<?= $_GET['trading']; ?></a></li>

            </ol>
        </nav>
        <div class="row">
            <div class="col-lg-6">
                <div class="order-summary">
                    <h3>Thông Tin Đơn Hàng</h3>
                    <div class="alert alert-rounded alert-warning">
                        <span><strong>Lưu Ý: </strong> Vui Lòng Đảm Bảo Hàng Còn Nguyên Vẹn, Nhận Như Nào Thì Trả Như Thế Bao Gồm Cả Thẻ Bảo Hành.</span>
                    </div>
                    <table class="table table-mini-cart">
                        <thead style="border-bottom: 1px solid #e7e7e7">
                            <tr>
                                <th colspan="2" style="color: black;">Sản Phẩm</th>
                            </tr>
                        </thead>
                        <tbody border="0">
                            <?php foreach ($ManhDev->get_list("SELECT * FROM `orders` WHERE `username` = '" . ($ManhDev->users('username') ?? getip()) . "' AND `trading` = '" . $_GET['trading'] . "' ") as $orders) :
                                $productCart = $ManhDev->get_row("SELECT * FROM `product` WHERE `code` = '" . $orders['codeProduct'] . "' ");
                            ?>
                                <tr>
                                    <td class="product-col">
                                        <h3 class="product-title">
                                            <?= $productCart['name']; ?> ×
                                            <span class="product-qty"><?= numbers_format($orders['amount']); ?></span>
                                        </h3>
                                    </td>

                                    <td class="price-col">
                                        <span><?= numbers_format($orders['total']); ?>đ</span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <div class="payment-methods">
                        <h5 class="">Phương thức hoàn trả: <b class="text-primary">Chuyển Khoản Ngân Hàng</b></h5>
                    </div>
                    <div class="payment-methods">
                        <h5 class="">Lý do: </h5>
                        <div class="form-group form-group-custom-control mb-2">
                            <div class="custom-control custom-radio d-flex mb-0">
                                <input type="radio" name="reason" id="banking" class="custom-control-input" value="banking">
                                <label for="banking" class="custom-control-label">Tôi Không Có Nhu Cầu Sử Dụng</label>
                            </div>
                        </div>
                        <div class="form-group form-group-custom-control mb-2">
                            <div class="custom-control custom-radio d-flex mb-0">
                                <input type="radio" name="reason" id="saimota" class="custom-control-input" value="Sản Phẩm Không Đúng Mô Tả">
                                <label for="saimota" class="custom-control-label">Sản Phẩm Không Đúng Mô Tả</label>
                            </div>
                        </div>
                        <div class="form-group form-group-custom-control mb-2">
                            <div class="custom-control custom-radio d-flex mb-0">
                                <input type="radio" name="reason" id="voNut" class="custom-control-input" value="Sản Phẩm Bị Vỡ, Nứt, Không Còn Nguyên Vẹn">
                                <label for="voNut" class="custom-control-label">Sản Phẩm Bị Vỡ, Nứt, Không Còn Nguyên Vẹn</label>
                            </div>
                        </div>
                        <div class="form-group form-group-custom-control mb-2">
                            <div class="custom-control custom-radio d-flex mb-0">
                                <input type="radio" name="reason" id="fake" class="custom-control-input" value="Sản Phẩm Giả, Fake">
                                <label for="fake" class="custom-control-label">Sản Phẩm Giả, Fake</label>
                            </div>
                        </div>
                        <div class="form-group form-group-custom-control mb-2">
                            <div class="custom-control custom-radio d-flex mb-0">
                                <input type="radio" name="reason" id="khac" class="custom-control-input" value="Khác">
                                <label for="khac" class="custom-control-label">Khác</label>
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <h5>Mô Tả Thêm:</h5>
                            <textarea class="form-control" name="note" id="note" placeholder="Nhập mô tả thêm"></textarea>
                        </div>
                    </div>

                    <div id="notification"></div>
                    <div class="text-right">
                        <button type="button" id="buttonPayment" onclick="refund('<?= $_GET['trading']; ?>')" class="btn btn-dark btn-place-order">
                            Xác Nhận Hoàn Đơn
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-6"></div>
</main>