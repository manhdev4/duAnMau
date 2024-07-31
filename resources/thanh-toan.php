<title><?= $website['payment']; ?></title>
<?php if ($total_cart <= 0) {
    die(href("/g/gio-hang"));
} ?>
<main class="main">
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="">Giỏ Hàng</a></li>
                <li class="breadcrumb-item"><a href="">Thủ Tục Thanh Toán</a></li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-lg-7">
                <div class="order-summary">
                    <h5>Địa Chỉ Nhận Hàng</h5>
                    <?php if (!isset($_SESSION['username'])) { ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Họ Tên <span class="required">*</span></label>
                                    <input type="text" class="form-control" id="name" placeholder="Nhập họ tên của bạn" required="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Số Điện Thoại <span class="required">*</span></label>
                                    <input type="number" class="form-control" id="phone" placeholder="Nhập số điện thoại" required="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email <span class="required">*</span></label>
                                    <input type="email" class="form-control" id="email" placeholder="Nhập Email của bạn" required="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Địa Chỉ </label>
                                    <input type="text" class="form-control" id="address1" placeholder="Bao Gồm Tỉnh, Huyện, Xã,...">
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <ul class="listAddress">
                            <?php foreach ($ManhDev->get_list("SELECT * FROM `address` WHERE `username` = '" . $ManhDev->users('username') . "' ORDER BY `defaults` DESC ") as $address) : ?>
                                <li>
                                    <div class="name"><b><?= $address['name']; ?></b> <span>| <?= formatPhoneNumber($address['phone']); ?></span><?php if ($address['defaults'] == "1") { ?><a class="default"><i class="fa-solid fa-check"></i></a><?php } else { ?> <button class="btn btn-sm btn-primary" onclick="defaultAddress('<?= $address['id']; ?>')"><i class="fa-solid fa-plus"></i> Chọn</button><?php } ?></div>
                                    <div class="address"><?= $address['address1']; ?><br><?= $address['address2']; ?></div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <a class="btn btn-outline-primary btn-md btn-block collapsed" href="#" data-toggle="collapse" data-target="#addAddress" aria-expanded="false" aria-controls="addAddress"><i class="far fa-circle-plus"></i> Thêm Địa Chỉ Khác</a>
                        <div id="addAddress" class="collapse" data-parent="#addAddress">
                            <center>
                                <h5 class="mt-2" style="font-size: 18px">THÊM ĐỊA CHỈ NHẬN/TRẢ HÀNG</h5>
                            </center>
                            <form class="form" submit-ajax="true" action="/api/client" method="POST" url_redirect="" swal="none" time_load="0">
                                <input type="hidden" name="type" value="addAddress">
                                <div id="notificationAddress"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Họ Tên <span class="required">*</span></label>
                                            <input type="text" class="form-control" name="name" placeholder="Nhập họ tên của bạn" required="">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Số Điện Thoại <span class="required">*</span></label>
                                            <input type="number" class="form-control" name="phone" placeholder="Nhập số điện thoại" required="">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Địa Chỉ 1 <span class="required">*</span></label>
                                            <input type="text" class="form-control" name="address1" placeholder="Nhập Xã/Phường, Huyện/Thị Trấn, Tỉnh/Thành Phố" required="">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Địa Chỉ 2 </label>
                                            <input type="text" class="form-control" name="address2" placeholder="Nhập số nhà, đường, ngõ...">
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-dark mb-3"><i class="fas fa-plus"></i> Thêm Ngay</button>
                                </div>
                            </form>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="order-summary">
                    <h3>Thông Tin Thanh Toán</h3>

                    <table class="table table-mini-cart">
                        <thead style="border-bottom: 1px solid #e7e7e7">
                            <tr>
                                <th colspan="2" style="color: black;">Sản Phẩm</th>
                            </tr>
                        </thead>
                        <tbody border="0">
                            <?php foreach ($ManhDev->get_list("SELECT * FROM `cart` WHERE `username` = '" . ($ManhDev->users('username') ?? getip()) . "' ") as $cartPayment) :
                                $productCart = $ManhDev->get_row("SELECT * FROM `product` WHERE `code` = '" . $cartPayment['codeProduct'] . "' ");
                                $tinhTien = $cartPayment['amount'] * $productCart['price'];
                                $tongTien += $tinhTien;
                            ?>
                                <tr>
                                    <td class="product-col">
                                        <h3 class="product-title">
                                            <?= $productCart['name']; ?> ×
                                            <span class="product-qty"><?= numbers_format($cartPayment['amount']); ?></span>
                                        </h3>
                                    </td>

                                    <td class="price-col">
                                        <span><?= numbers_format($tinhTien); ?>đ</span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <?php
                        $total_amountCart = $ManhDev->get_row("SELECT SUM(`amount`) FROM `cart` WHERE `username` = '" . ($ManhDev->users('username') ?? getip()) . "'  ")['SUM(`amount`)'];
                        $ketQuaCuoi = 0;
                        foreach ($ManhDev->get_list("SELECT p.price, c.amount FROM `product` p INNER JOIN `cart` c ON p.code = c.codeProduct WHERE `username` = '" . ($ManhDev->users('username') ?? getip()) . "' ") as $row) {
                            $ketQuaCuoi += $row["price"] * $row["amount"];
                        }
                        $tinhTienVat = $ketQuaCuoi * 0.0012;
                        $tongThanhToan = $tinhTienVat + $ketQuaCuoi;
                        ?>
                        <tfoot>
                            <tr class="cart-subtotal">
                                <td>
                                    <h5>Tạm Tính</h5>
                                </td>

                                <td class="price-col">
                                    <span><?= numbers_format($ketQuaCuoi); ?>đ</span>
                                </td>
                            </tr>

                            <tr class="order-total">
                                <td>
                                    <h5>VAT</h5>
                                </td>
                                <td>
                                    <b class="total-price"><span><?= numbers_format($tinhTienVat); ?>đ</span></b>
                                </td>
                            </tr>

                            <tr class="order-total">
                                <td>
                                    <h5>Tổng Tiền</h5>
                                </td>
                                <td>
                                    <b class="total-price"><span><?= numbers_format($tongThanhToan); ?>đ</span></b>
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="payment-methods">
                        <h5 class="">Phương thức thanh toán</h5>
                        <div class="form-group form-group-custom-control mb-2">
                            <div class="custom-control custom-radio d-flex mb-0">
                                <input type="radio" name="PaymentMothod" id="banking" class="custom-control-input" value="banking" checked>
                                <label for="banking" class="custom-control-label ManhDev-Label-Payment"><img src="/images/icon/card.png?<?= time(); ?>" alt=""> <span>Chuyển Khoản Ngân Hàng</span></label>
                            </div>
                        </div>
                        <div class="form-group form-group-custom-control mb-2">
                            <div class="custom-control custom-radio d-flex mb-0">
                                <input type="radio" name="PaymentMothod" id="vnpay" class="custom-control-input" value="vnpay">
                                <label for="vnpay" class="custom-control-label ManhDev-Label-Payment"><img src="/images/icon/vnPay.jpg" alt=""> <span>QR Code VNPay</span></label>
                            </div>
                        </div>
                        <!-- <div class="form-group form-group-custom-control mb-2">
                            <div class="custom-control custom-radio d-flex mb-0">
                                <input type="radio" name="PaymentMothod" id="momo" class="custom-control-input" value="momo">
                                <label for="momo" class="custom-control-label ManhDev-Label-Payment"><img src="/images/icon/momo.png" alt=""> <span>Momo</span></label>
                            </div>
                        </div> -->
                        <div class="form-group form-group-custom-control mb-2">
                            <div class="custom-control custom-radio d-flex mb-0">
                                <input type="radio" name="PaymentMothod" id="zalopay" class="custom-control-input" value="zalopay">
                                <label for="zalopay" class="custom-control-label ManhDev-Label-Payment"><img src="/images/icon/zaloPay.png" alt=""> <span>ZaloPay</span></label>
                            </div>
                        </div>
                        <div class="form-group form-group-custom-control mb-2">
                            <div class="custom-control custom-radio d-flex mb-0">
                                <input type="radio" name="PaymentMothod" id="vanphong" class="custom-control-input" value="vanphong">
                                <label for="vanphong" class="custom-control-label ManhDev-Label-Payment"><img src="/images/icon/vanPhong.png" alt=""> <span>Tại Văn Phòng</span></label>
                            </div>
                        </div>
                    </div>
                    <div id="notification"></div>
                    <div class="text-right">
                        <button type="button" id="buttonPayment" onclick="payment('<?=($_SESSION['username'] ?? 'login');?>')" class="btn btn-dark btn-place-order" form="checkout-form">
                            Thanh Toán
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-6"></div>
</main>