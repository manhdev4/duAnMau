<title><?= $website['profile']; ?></title>
<?php if (empty($_SESSION['username'])) {
    die('<script>location.href="/g/dang-nhap"</script>');
}

if (isset($_GET['canceled'])) {

    $ManhDev->update("orders", [
        "status" => "canceled"
    ], " `id` = '" . $_GET['canceled'] . "' ");

    die(href('/g/thong-tin-tai-khoan'));
}
?>
<main class="main">
    <div class="page-header mb-3">
        <div class="container d-flex flex-column">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="demo4.html">Trang Chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tài Khoản</li>
                    </ol>
                </div>
            </nav>
        </div>
    </div>

    <div class="container account-container custom-account-container">
        <div class="row">
            <div class="sidebar widget widget-dashboard mb-lg-0 mb-3 col-lg-3 order-0">
                <h2 class="text-uppercase">Tài Khoản</h2>
                <ul class="nav nav-tabs list flex-column mb-0" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="true">Thông Tin Tài Khoản</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="order-tab" data-toggle="tab" href="#security" role="tab" aria-controls="security" aria-selected="true">Đổi Mật Khẩu</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="order-tab" data-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true">Địa Chỉ</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="order-tab" data-toggle="tab" href="#order" role="tab" aria-controls="order" aria-selected="true">Đơn Hàng</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="address-tab" data-toggle="tab" href="#cart" role="tab" aria-controls="cart" aria-selected="false">Giỏ Hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="/g/dang-xuat">Đăng Xuất</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-9 order-lg-last order-1 tab-content">
                <div class="tab-pane fade active show" id="dashboard" role="tabpanel">
                    <h3 class="account-sub-title d-none d-md-block mt-0 pt-1 ml-1"><i class="far fa-user align-middle mr-3 pr-1"></i> Thông Tin Tài Khoản</h3>
                    <div class="account-content">
                        <form class="form" submit-ajax="true" action="/api/client" method="POST" url_redirect="none" swal="none" time_load="0">
                            <input type="hidden" name="type" value="account">
                            <div id="notification"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="acc-name">Họ Tên <span class="required">*</span></label>
                                        <input type="text" class="form-control" placeholder="Cập Nhật Họ Và Tên" name="name" value="<?= ($ManhDev->users("name") ?? ""); ?>" required="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="acc-lastname">Tài Khoản</label>
                                        <input type="text" class="form-control" value="<?= ($ManhDev->users("username") ?? ""); ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="acc-lastname">Email</label>
                                        <input type="text" class="form-control" value="<?= ($ManhDev->users("email") ?? ""); ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="acc-lastname">Số Điện Thoại <span class="required">*</span></label>
                                        <input type="text" class="form-control" name="phone" placeholder="Cập Nhật Số Điện Thoại" value="<?= ($ManhDev->users("phone") ?? ""); ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-footer mt-3 mb-0">
                                <button type="submit" class="btn btn-dark mr-0">Lưu Thông Tin</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="tab-pane fade" id="security" role="tabpanel">
                    <h3 class="account-sub-title d-none d-md-block mt-0 pt-1 ml-1"><i class="far fa-shield-check"></i> Bảo Mật Tài Khoản</h3>
                    <div class="account-content">
                        <form class="form" submit-ajax="true" action="/api/client" method="POST" url_redirect="none" swal="none" time_load="0">
                            <input type="hidden" name="type" value="changePassword">
                            <div id="notificationPass"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="acc-name">Mật Khẩu Hiện Tại <span class="required">*</span></label>
                                        <input type="password" class="form-control" placeholder="******" name="password" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="acc-name">Mật Khẩu Mới <span class="required">*</span></label>
                                        <input type="password" class="form-control" placeholder="******" name="password1" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="acc-name">Nhập Lại Mật Khẩu Mới <span class="required">*</span></label>
                                        <input type="password" class="form-control" placeholder="******" name="password2" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-footer mt-3 mb-0">
                                <button type="submit" class="btn btn-dark mr-0"><i class="fas fa-repeat"></i> Thay Đổi</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="tab-pane fade" id="address" role="tabpanel">
                    <h3 class="account-sub-title d-none d-md-block mb-1"><i class="far fa-map-location-dot"></i> Địa Chỉ</h3>
                    <div class="addresses-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Địa Chỉ Của Bạn</h4>
                                    </div>
                                    <div class="card-body pt-0">
                                        <ul class="listAddress">
                                            <?php foreach ($ManhDev->get_list("SELECT * FROM `address` WHERE `username` = '" . $ManhDev->users('username') . "' ORDER BY `defaults` DESC ") as $address) : ?>
                                                <li>
                                                    <div class="name"><b><?= $address['name']; ?></b> <span>| <?= formatPhoneNumber($address['phone']); ?></span><?php if ($address['defaults'] == "1") { ?><a class="default">Mặc Định</a><?php } else { ?> <button class="btn btn-sm btn-primary" onclick="defaultAddress('<?= $address['id']; ?>')"><i class="fa-solid fa-plus"></i> Đặt Mặc Định</button><?php } ?> <button onclick="delAddress('<?= $address['id']; ?>')" class="btn btn-sm"><i class="far fa-trash"></i> Xóa</button></div>
                                                    <div class="address"><?= $address['address1']; ?><br><?= $address['address2']; ?></div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <button type="button" class="btn btn-outline-primary btn-md btn-block" data-toggle="modal" data-target="#addAddress"><i class="far fa-circle-plus"></i> Thêm Địa Chỉ</button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="addAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Thêm Địa Chỉ Mới</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form" submit-ajax="true" action="/api/client" method="POST" url_redirect="none" swal="none" time_load="0">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="order" role="tabpanel">
                    <div class="order-content">
                        <h3 class="account-sub-title d-none d-md-block"><i class="sicon-social-dropbox align-middle mr-3"></i>Orders</h3>
                        <div class="table-responsive p-0">
                            <table class="table table-striped table-bordered nowrap dataTable Manhdev-dataTable">
                                <thead>
                                    <tr>
                                        <th>Thao Tác</th>
                                        <th>Mã Giao Dịch</th>
                                        <th>Sản Phẩm</th>
                                        <th>Giá Tiền</th>
                                        <th>Số Lượng</th>
                                        <th>Tổng Tiền</th>
                                        <th>Địa Chỉ</th>
                                        <th>Trạng Thái</th>
                                        <th>Thời Gian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($ManhDev->get_row("SELECT * FROM `orders` WHERE `username` = '" . ($ManhDev->users('username') ?? getip()) . "' ")) {
                                        foreach ($ManhDev->get_list("SELECT * FROM `orders` WHERE `username` = '" . ($ManhDev->users('username') ?? getip()) . "' ORDER BY `id` DESC ") as $orders) : ?>
                                            <tr>
                                                <th>
                                                    <?php if ($orders['status'] == "pending") { ?>
                                                        <a href="/g/thong-tin-tai-khoan?canceled=<?= $orders['id']; ?>" class="btn btn-danger btn-xs text-light"><i class="fas fa-times"></i> Hủy Đơn</a>
                                                    <?php } ?>
                                                    <?php if ($orders['status'] == "canceled") { ?>
                                                        <a href="/g/product/<?= $orders['codeProduct']; ?>" class="btn btn-success btn-xs text-light"><i class="fas fa-cart-shopping"></i> Đặt Lại</a>
                                                    <?php } ?>
                                                    <?php if ($orders['status'] == "done") {
                                                        $tinhTime = strtotime('+7 day', $orders['time']);
                                                        if (time() <= $tinhTime) {
                                                    ?>
                                                            <a href="/g/hoan-hang?trading=<?= $orders['trading']; ?>" class="btn btn-danger btn-xs text-light"><i class="fas fa-rotate-left"></i> Hoàn Hàng</a>
                                                    <?php }
                                                    } ?>
                                                </th>
                                                <th>#<?= $orders['trading']; ?></th>
                                                <th><?= $ManhDev->get_row("SELECT * FROM `product` WHERE `code` = '" . $orders['codeProduct'] . "' ")['name']; ?></th>
                                                <th><?= numbers_format($orders['price']); ?></th>
                                                <th><?= numbers_format($orders['amount']); ?></th>
                                                <th><?= numbers_format($orders['total']); ?></th>
                                                <th><?= $orders['address']; ?></th>
                                                <th><?= statuOrders($orders['status']); ?></th>
                                                <th><?= tachTime($orders['time']); ?></th>
                                            </tr>
                                        <?php endforeach;
                                    } else { ?>
                                        <tr>
                                            <td class="text-center p-0" colspan="5">
                                                <p class="mb-5 mt-5">
                                                    Bạn Không Có Đơn Hàng Nào.
                                                </p>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>