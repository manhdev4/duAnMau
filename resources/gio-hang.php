<title><?= $website['cart']; ?></title>
<main class="main">
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="">Giỏ Hàng</a></li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-8">
                <div class="cart-table-container">
                    <form submit-ajax="true" action="/api/client" method="POST" url_redirect="" swal="none" time_load="0">
                        <input type="hidden" name="type" value="updateCart">
                        <div id="notification"></div>
                        <table class="table table-cart">
                            <thead>
                                <tr>
                                    <th class="thumbnail-col"></th>
                                    <th class="product-col">San Phẩm</th>
                                    <th class="price-col">Giá Tiền</th>
                                    <th class="qty-col">Số Lượng</th>
                                    <th class="text-right">Tổng Tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ManhDev->get_list("SELECT * FROM `cart` WHERE `username` = '" . ($ManhDev->users('username') ?? getip()) . "' ") as $cart) :
                                    $productCart = $ManhDev->get_row("SELECT * FROM `product` WHERE `code` = '" . $cart['codeProduct'] . "' ");
                                    $tinhTien = $cart['amount'] * $productCart['price'];
                                    $tongTien += $tinhTien;
                                    $tongTienBenNgoai = $tongTien;
                                ?>

                                    <tr class="product-row">
                                        <td>
                                            <figure class="product-image-container">
                                                <a href="/g/product/<?= $productCart['code']; ?>" class="product-image">
                                                    <img src="<?= $productCart['image']; ?>" alt="<?= $productCart['name']; ?>" style="width: 100px">
                                                </a>

                                                <a onclick="delCart('<?= $cart['id']; ?>')" class="btn-delete icon-cancel" title="Xóa Sản Phẩm"></a>
                                            </figure>
                                            <input type="hidden" name="idCart[]" value="<?= $cart['id']; ?>">
                                        </td>
                                        <td class="product-col">
                                            <h5 class="product-title">
                                                <a href="/g/product/<?= $productCart['code']; ?>"><?= $productCart['name']; ?></a>
                                            </h5>
                                        </td>
                                        <td><?= numbers_format($productCart['price']); ?>đ</td>
                                        <td>
                                            <div class="product-single-qty">
                                                <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                    <input class="horizontal-quantity form-control" name="amount[]" value="<?= $cart['amount']; ?>" type="text">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-right"><span class="subtotal-price"><?= numbers_format($tinhTien); ?>đ</span></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="clearfix">
                                        <div class="float-left">
                                        </div>

                                        <div class="float-right">
                                            <button type="submit" class="btn btn-shop btn-update-cart">Cập Nhật Giỏ Hàng</button>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="cart-summary">
                    <h3>THỐNG KÊ GIỎ HÀNG</h3>
                    <?php
                    $total_amountCart = $ManhDev->get_row("SELECT SUM(`amount`) FROM `cart` WHERE `username` = '" . ($ManhDev->users('username') ?? getip()) . "'  ")['SUM(`amount`)'];
                    $ketQuaCuoi = 0;
                    foreach ($ManhDev->get_list("SELECT p.price, c.amount FROM `product` p INNER JOIN `cart` c ON p.code = c.codeProduct WHERE `username` = '" . ($ManhDev->users('username') ?? getip()) . "' ") as $row) {
                        $ketQuaCuoi += $row["price"] * $row["amount"];
                    }
                    ?>
                    <table class="table table-totals">
                        <tbody>
                            <tr>
                                <td>Số Lượng</td>
                                <td><?= numbers_format($total_amountCart); ?></td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td>Tổng Tiền</td>
                                <td><?= numbers_format($ketQuaCuoi); ?>đ</td>
                            </tr>
                        </tbody>
                        <?php $tinhTienVat = $ketQuaCuoi * 0.0012;
                        $tongThanhToan = $tinhTienVat + $ketQuaCuoi; ?>
                        <tbody>
                            <tr>
                                <td>Vat</td>
                                <td><?= numbers_format($tinhTienVat); ?>đ</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Tổng Thanh Toán</td>
                                <td><?= numbers_format($tongThanhToan); ?>đ</td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="checkout-methods">
                        <a href="/g/thanh-toan" class="btn btn-block btn-dark">Tiếp Tục Thanh Toán
                            <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-6"></div>
</main>