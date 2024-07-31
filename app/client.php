<?php include $_SERVER['DOCUMENT_ROOT'] . "/include/database.php";
include $_SERVER['DOCUMENT_ROOT'] . "/class/vnpay.php";

if ($_POST['type'] == "login") {
    $username = check_string($_POST['username']);
    $password = check_string($_POST['password']);

    $checkUser = $ManhDev->get_row("SELECT * FROM `users` WHERE `username` = '$username' ");

    if (empty($username) || empty($password)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Vui Lòng Nhập Đầy Đủ Thông Tin"
        ]));
    } else if (!$checkUser) {
        die(json_encode([
            "status" => "error",
            "msg" => "Tài Khoản Không Tồn Tại"
        ]));
    } else if (md5($password) !== $checkUser['password']) {
        die(json_encode([
            "status" => "error",
            "msg" => "Mật Khẩu Không Chính Xác"
        ]));
    } else {
        $ManhDev->insert("log_site", [
            "username"  => $ManhDev->users('username'),
            "type"      => "profile",
            "content"   => "Đăng Nhập Vào Website",
            "ip"        => getip(),
            "useragent" => userAgent(),
            "time"      => time()
        ]);

        $_SESSION['username'] = $username;

        die(json_encode([
            "status" => "success",
            "msg" => "Đăng Nhập Thành Công"
        ]));
    }
} else if ($_POST['type'] == "register") {
    $email    = check_string($_POST['email']);
    $username = check_string($_POST['username']);
    $password = check_string($_POST['password']);

    $checkUser = $ManhDev->get_row("SELECT * FROM `users` WHERE `username` = '$username' ");

    $checkEmail = $ManhDev->get_row("SELECT * FROM `users` WHERE `email` = '$email' ");

    if (empty($username) || empty($password)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Vui Lòng Nhập Đầy Đủ Thông Tin"
        ]));
    } else if ($checkUser) {
        die(json_encode([
            "status" => "error",
            "msg" => "Tài Khoản Đã Tồn Tại Trên Hệ Thống"
        ]));
    } else if ($checkEmail) {
        die(json_encode([
            "status" => "error",
            "msg" => "Email Đã Tồn Tại Trên Hệ Thống"
        ]));
    } else if (strlen($password) < 8) {
        die(json_encode([
            "status" => "error",
            "msg" => "Mật Khẩu Tối Thiểu Từ 8 Ký Tự"
        ]));
    } else {
        $ManhDev->insert("log_site", [
            "username"  => $ManhDev->users('username'),
            "type"      => "profile",
            "content"   => "Tạo Tài Khoản Website",
            "ip"        => getip(),
            "useragent" => userAgent(),
            "time"      => time()
        ]);

        $ManhDev->insert("users", [
            "username" => $username,
            "password" => md5($password),
            "level"    => "0",
            "email"    => $email,
            "status"   => "active",
            "ip"       => getip(),
            "time"     => time()
        ]);
        $_SESSION['username'] = $username;

        die(json_encode([
            "status" => "success",
            "msg" => "Tạo Tài Khoản Thành Công"
        ]));
    }
} else if ($_POST['type'] == "account") {
    $name     = check_string($_POST['name']);
    $phone    = check_string($_POST['phone']);

    if (empty($_SESSION['username'])) {
        die(json_encode([
            "status" => "error",
            "msg" => "Vui Lòng Đăng Nhập Để Sử Dụng"
        ]));
    } else if (empty($name) || empty($phone)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Vui Lòng Nhập Đầy Đủ Thông Tin"
        ]));
    } else if (strlen($phone) < 10) {
        die(json_encode([
            "status" => "error",
            "msg" => "Số Điện Thoại Không Hợp Lệ"
        ]));
    } else {
        $ManhDev->insert("log_site", [
            "username"  => $ManhDev->users('username'),
            "type"      => "address",
            "content"   => "Thay Đổi Thông Tin Tài Khoản",
            "ip"        => getip(),
            "useragent" => userAgent(),
            "time"      => time()
        ]);

        $ManhDev->update("users", [
            "name"     => $name,
            "phone"    => $phone
        ], " `username` = '" . $ManhDev->users('username') . "' ");

        die(json_encode([
            "status" => "success",
            "msg" => "Cập Nhật Thành Công"
        ]));
    }
} else if ($_POST['type'] == "changePassword") {
    $password     = check_string($_POST['password']);
    $password1    = check_string($_POST['password1']);
    $password2    = check_string($_POST['password2']);

    if (empty($_SESSION['username'])) {
        die(json_encode([
            "status" => "error",
            "msg" => "Vui Lòng Đăng Nhập Để Sử Dụng"
        ]));
    } else if (empty($password) || empty($password1) || empty($password2)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Vui Lòng Nhập Đầy Đủ Thông Tin"
        ]));
    } else if (strlen($password) < 8 || strlen($password1) < 8 || strlen($password2) < 8) {
        die(json_encode([
            "status" => "error",
            "msg" => "Mật Khẩu Tối Thiểu Từ 8 Ký Tự"
        ]));
    } else if (md5($password) !== $ManhDev->users('password')) {
        die(json_encode([
            "status" => "error",
            "msg" => "Mật Khẩu Cũ Không Chính Xác"
        ]));
    } else if ($password1 !== $password2) {
        die(json_encode([
            "status" => "error",
            "msg" => "Mật Khẩu Nhập Lại Không Giống Nhau"
        ]));
    } else if (md5($password1) == $ManhDev->users('password') || md5($password2) == $ManhDev->users('password')) {
        die(json_encode([
            "status" => "error",
            "msg" => "Mật Khẩu Mới Phải Khác Mật Khẩu Cũ"
        ]));
    } else {
        $ManhDev->insert("log_site", [
            "username"  => $ManhDev->users('username'),
            "type"      => "profile",
            "content"   => "Thay Đổi Mật Khẩu Tài Khoản",
            "ip"        => getip(),
            "useragent" => userAgent(),
            "time"      => time()
        ]);

        $ManhDev->update("users", [
            "password"     => md5($password2)
        ], " `username` = '" . $ManhDev->users('username') . "' ");

        die(json_encode([
            "status" => "success",
            "msg" => "Đổi Mật Khẩu Thành Công"
        ]));
    }
} else if ($_POST['type'] == "addAddress") {
    $name     = check_string($_POST['name']);
    $phone    = check_string($_POST['phone']);
    $address1 = check_string($_POST['address1']);
    $address2 = check_string($_POST['address2']);

    if (empty($_SESSION['username'])) {
        die(json_encode([
            "status" => "error",
            "msg" => "Vui Lòng Đăng Nhập Để Sử Dụng"
        ]));
    } else if (empty($name) || empty($phone) || empty($address1)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Vui Lòng Nhập Đầy Đủ Thông Tin"
        ]));
    } else if (strlen($phone) < 10) {
        die(json_encode([
            "status" => "error",
            "msg" => "Số Điện Thoại Không Đúng Định dạng"
        ]));
    } else {
        $ManhDev->insert("log_site", [
            "username"  => $ManhDev->users('username'),
            "type"      => "address",
            "content"   => "Thêm Địa Chỉ Mới",
            "ip"        => getip(),
            "useragent" => userAgent(),
            "time"      => time()
        ]);

        $ManhDev->insert("address", [
            "username" => $ManhDev->users('username'),
            "name"     => $name,
            "phone"    => $phone,
            "address1" => $address1,
            "address2" => $address2,
            "defaults" => "0",
            "time"     => time()
        ]);

        die(json_encode([
            "status" => "success",
            "msg" => "Đã Thêm Địa Chỉ Mới"
        ]));
    }
} else if ($_POST['type'] == "delAddress") {
    $id     = check_string($_POST['id']);

    $checkAddress = $ManhDev->get_row("SELECT * FROM `address` WHERE `username` = '" . $ManhDev->users('username') . "' AND `id` = '$id' ");

    if (empty($_SESSION['username'])) {
        die(json_encode([
            "status" => "error",
            "msg" => "Vui Lòng Đăng Nhập Để Sử Dụng"
        ]));
    } else if (empty($id)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Thiếu"
        ]));
    } else if (!$checkAddress) {
        die(json_encode([
            "status" => "error",
            "msg" => "Địa Chỉ Không Tồn Tại"
        ]));
    } else {
        $ManhDev->xoa("address", " `username` = '" . $ManhDev->users('username') . "' AND `id` = '$id' ");

        die(json_encode([
            "status" => "success",
            "msg" => "Xóa Thành Công"
        ]));
    }
} else if ($_POST['type'] == "defaultAddress") {
    $id     = check_string($_POST['id']);

    $checkAddress = $ManhDev->get_row("SELECT * FROM `address` WHERE `username` = '" . $ManhDev->users('username') . "' AND `id` = '$id' ");

    if (empty($_SESSION['username'])) {
        die(json_encode([
            "status" => "error",
            "msg" => "Vui Lòng Đăng Nhập Để Sử Dụng"
        ]));
    } else if (empty($id)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Thiếu"
        ]));
    } else if (!$checkAddress) {
        die(json_encode([
            "status" => "error",
            "msg" => "Địa Chỉ Không Tồn Tại"
        ]));
    } else {
        $ManhDev->update("address", [
            "defaults" => "0"
        ], " `username` = '" . $ManhDev->users('username') . "' ");

        $ManhDev->update("address", [
            "defaults" => "1"
        ], " `username` = '" . $ManhDev->users('username') . "' AND `id` = '$id' ");

        die(json_encode([
            "status" => "success",
            "msg" => "Đã Đặt Địa Chỉ Mặc Định"
        ]));
    }
} else if ($_POST['type'] == "addCart") {
    $id     = check_string($_POST['id']);

    $checkProduct = $ManhDev->get_row("SELECT * FROM `product` WHERE `id` = '$id' ");

    if (empty($id)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Sai"
        ]));
    } else if (!is_numeric($id)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Không Đúng Định Dạng"
        ]));
    } else {
        $ManhDev->insert("log_site", [
            "username"  => $ManhDev->users('username'),
            "type"      => "cart",
            "content"   => "Thêm Sản Phầm Vào Giỏ Hàng",
            "ip"        => getip(),
            "useragent" => userAgent(),
            "time"      => time()
        ]);

        $checkCart = $ManhDev->get_row("SELECT * FROM `cart` WHERE `username` = '" . ($_SESSION['username'] ?? getip()) . "' AND `codeProduct` = '" . $checkProduct['code'] . "' ");
        if ($checkCart) {
            $ManhDev->update("cart", [
                "amount"       => $checkCart['amount'] + 1
            ], " `id` = '" . $checkCart['id'] . "' ");
        } else {
            $ManhDev->insert("cart", [
                "username"     => ($_SESSION['username'] ?? getip()),
                "codeProduct"  => $checkProduct['code'],
                "amount"       => "1",
                "time"         => time()
            ]);
        }

        die(json_encode([
            "status" => "success",
            "msg" => "Đã Thêm Vào Giỏ Hàng"
        ]));
    }
} else if ($_POST['type'] == "addCartNumber") {
    $id     = check_string($_POST['idPro']);
    $amount = check_string($_POST['amount']);

    $checkProduct = $ManhDev->get_row("SELECT * FROM `product` WHERE `id` = '$id' ");

    if (empty($id) || empty($amount)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Sai"
        ]));
    } else if (!is_numeric($id) || !is_numeric($amount)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Không Đúng Định Dạng"
        ]));
    } else {
        $ManhDev->insert("log_site", [
            "username"  => $ManhDev->users('username'),
            "type"      => "cart",
            "content"   => "Thêm " . numbers_format($amount) . " Sản Phẩm Vào Giỏ Hàng",
            "ip"        => getip(),
            "useragent" => userAgent(),
            "time"      => time()
        ]);

        $checkCart = $ManhDev->get_row("SELECT * FROM `cart` WHERE `username` = '" . ($_SESSION['username'] ?? getip()) . "' AND `codeProduct` = '" . $checkProduct['code'] . "' ");
        if ($checkCart) {
            $ManhDev->update("cart", [
                "amount"       => $checkCart['amount'] + $amount
            ], " `id` = '" . $checkCart['id'] . "' ");
        } else {
            $ManhDev->insert("cart", [
                "username"     => ($_SESSION['username'] ?? getip()),
                "codeProduct"  => $checkProduct['code'],
                "amount"       => $amount,
                "time"         => time()
            ]);
        }

        die(json_encode([
            "status" => "success",
            "msg" => "Đã Thêm Vào Giỏ Hàng"
        ]));
    }
} else if ($_POST['type'] == "evaluate") {
    $id      = check_string($_POST['idProduct']);
    $name    = check_string($_POST['name']);
    $content = check_string($_POST['content']);
    $star    = check_string($_POST['star']);

    $checkProduct = $ManhDev->get_row("SELECT * FROM `product` WHERE `id` = '$id' ");

    if (empty($id) || empty($name) || empty($content) || empty($star)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Vui Lòng Nhập Đầy Đủ Thông Tin"
        ]));
    } else if (!is_numeric($id)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Không Đúng Định Dạng"
        ]));
    } else if (!$checkProduct) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Không Chính Xác"
        ]));
    } else {
        $ManhDev->insert("log_site", [
            "username"  => $ManhDev->users('username'),
            "type"      => "product",
            "content"   => "Đánh Giá Sản Phẩm " . $checkProduct['name'],
            "ip"        => getip(),
            "useragent" => userAgent(),
            "time"      => time()
        ]);

        $ManhDev->insert("evaluate", [
            "codeProduct" => $checkProduct['code'],
            "username"  => ($ManhDev->users('username') ?? getip()),
            "name"      => $name,
            "star"      => $star,
            "content"   => $content,
            "time"      => time()
        ]);

        die(json_encode([
            "status" => "success",
            "msg" => "Đánh Giá Thành Công"
        ]));
    }
} else if ($_POST['type'] == "delCart") {
    $id      = check_string($_POST['id']);

    $checkCart = $ManhDev->get_row("SELECT * FROM `cart` WHERE `username` = '" . ($_SESSION['username'] ?? getip()) . "' AND `id` = '$id' ");

    if (empty($id)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Vui Lòng Nhập Đầy Đủ Thông Tin"
        ]));
    } else if (!is_numeric($id)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Không Đúng Định Dạng"
        ]));
    } else if (!$checkCart) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Không Chính Xác"
        ]));
    } else {

        $ManhDev->xoa("cart", " `id` = '$id' ");

        die(json_encode([
            "status" => "success",
            "msg" => "Xóa Sản Phẩm Giỏ Hàng Thành Công"
        ]));
    }
} else if ($_POST['type'] == "updateCart") {
    $amount = $_POST['amount'];
    $idCart = $_POST['idCart'];

    if (empty($amount) || empty($idCart)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Không Tồn Tại Sản Phẩm Trong Giỏ"
        ]));
    } else {
        $i = 0;

        foreach ($idCart as $uid) {
            $checkCart = $ManhDev->get_row("SELECT * FROM `cart` WHERE `id` = '$uid' ");

            $ManhDev->update("cart", [
                "amount" => $amount[$i++]
            ], " `id` = '" . $checkCart['id'] . "' ");
        }

        die(json_encode([
            "status" => "success",
            "msg" => "Cập Nhật Giỏ Hàng Thành Công"
        ]));
    }
} else if ($_POST['type'] == "subscribe") {
    $email  = check_string($_POST['newsletter-email']);

    $checkNewsletterEmail = $ManhDev->get_row("SELECT * FROM `newsletterEmail` WHERE `email` = '$email' ");

    if (empty($email)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Vui Lòng Nhập Email Của Bạn"
        ]));
    } else {

        $ManhDev->insert("log_site", [
            "username"  => ($ManhDev->users('username') ?? getip()),
            "type"      => "newsletterEmail",
            "content"   => "Đăng Ký Nhận Thông Báo Từ Website",
            "ip"        => getip(),
            "useragent" => userAgent(),
            "time"      => time()
        ]);
        
        if(!$checkNewsletterEmail) {
            $ManhDev->insert("newsletterEmail", [
                "username"           => ($_SESSION['username'] ?? getip()),
                "email"              => $email,
                "time"               => time()
            ]);
        }

        die(json_encode([
            "status" => "success",
            "msg" => "Cảm Ơn Bạn Đã Đăng Ký Nhận Thông Báo Từ Chúng Tôi, Chờ 1 Giây"
        ]));
    }
} else if ($_POST['type'] == "payment") {
    $paymentMethod = check_string($_POST['paymentMethod']);
    $name = check_string($_POST['name']);
    $phone = check_string($_POST['phone']);
    $email = check_string($_POST['email']);
    $address = check_string($_POST['address']);

    if (empty($paymentMethod)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Sai?"
        ]));
    } else {

        if (!isset($_SESSION['username'])) {
            if (empty($name) || empty($phone) || empty($email) || empty($address)) {
                die(json_encode([
                    "status" => "error",
                    "msg" => "Vui Lòng Nhập Đầy Đủ Thông Tin"
                ]));
            } else {
                $checkDiaChiIp = $ManhDev->get_row("SELECT * FROM `address` WHERE `username` = '" . ($ManhDev->users('username') ?? getip()) . "' AND `address1` = '$address' ");
                if (!$checkDiaChiIp) {
                    $ManhDev->insert("address", [
                        "username" => ($ManhDev->users('username') ?? getip()),
                        "name"     => $name,
                        "phone"    => $phone,
                        "address1" => $address,
                        "defaults" => "0",
                        "time"     => time()
                    ]);
                }

                $diaChiGop = $name . " ($phone) | " . $email . " | " . $address;
            }
        } else {
            $getDiaChi = $ManhDev->get_row("SELECT * FROM `address` WHERE `username` = '" . ($_SESSION['username'] ?? getip()) . "' AND `defaults` = '1' ");
            $diaChiGop = $getDiaChi['name'] . " (" . $getDiaChi['phone'] . ") | " . $getDiaChi['email'] . " | " . $getDiaChi['address1'];
        }

        $ManhDev->insert("log_site", [
            "username"  => ($ManhDev->users('username') ?? getip()),
            "type"      => "address",
            "content"   => "Khởi Tạo Đơn Hàng (Pending)",
            "ip"        => getip(),
            "useragent" => userAgent(),
            "time"      => time()
        ]);

        $total_amountCart = $ManhDev->get_row("SELECT SUM(`amount`) FROM `cart` WHERE `username` = '" . ($_SESSION['username'] ?? getip()) . "'  ")['SUM(`amount`)'];
        $ketQuaCuoi = 0;

        foreach ($ManhDev->get_list("SELECT p.price, c.amount FROM `product` p INNER JOIN `cart` c ON p.code = c.codeProduct WHERE `username` = '" . ($_SESSION['username'] ?? getip()) . "' ") as $row) {
            $ketQuaCuoi += $row["price"] * $row["amount"];
        }
        $tinhTienVat = $ketQuaCuoi * 0.0012;
        $tongThanhToan = $tinhTienVat + $ketQuaCuoi;

        $trading = random("ABCDEFGHIKZXC1234567890", 12);
        $trans_id = rand(1000, 999999);

        if ($paymentMethod == "vnpay") {
            $link = $VNPay->createPay($trans_id, $tongThanhToan, "");
        } else if ($paymentMethod == "zalopay") {
            $link = "/g/zalopay?trading=" . $trading;
        } else {
            $link = "/g/success?trading=" . $trading;
        }

        foreach ($ManhDev->get_list("SELECT * FROM `cart` WHERE `username` = '" . ($_SESSION['username'] ?? getip()) . "' ") as $cartOrders) :
            $ManhDev->insert("orders", [
                "trans_id"     => $trans_id,
                "username"     => ($ManhDev->users('username') ?? getip()),
                "trading"      => $trading,
                "paymentMethod" => $paymentMethod,
                "codeProduct"  => $cartOrders['codeProduct'],
                "price"        => $ketQuaCuoi,
                "amount"       => $cartOrders['amount'],
                "total"        => $tongThanhToan,
                "address"      => $diaChiGop,
                "status"       => "pending",
                "time"         => time()
            ]);
        endforeach;

        $ManhDev->xoa("cart", " `username` = '" . ($_SESSION['username'] ?? getip()) . "' AND `amount` >= '1' ");

        die(json_encode([
            "status" => "success",
            "msg" => "Thành Công, Đang Chuyển Hướng!",
            "link" => $link
        ]));
    }
} else {
    die(json_encode([
        "status" => "info",
        "msg" => "Website Được Thiết Kế Bởi " . $ManhDev->site('nameWeb')
    ]));
}
