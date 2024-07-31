<?php include $_SERVER['DOCUMENT_ROOT'] . "/include/database.php";

if (empty($_SESSION['username'])) {
    die(json_encode([
        "status" => "error",
        "msg" => "Vui Lòng Đăng Nhập Để Sử Dụng"
    ]));
} else {
    if ($ManhDev->users("level") !== "99") {
        die(json_encode([
            "status" => "error",
            "msg" => "Bạn Định Bug?"
        ]));
    }
}


if ($_POST['type'] == "updateUsers") {
    $name = check_string($_POST['name']);
    $phone = check_string($_POST['phone']);
    $status = check_string($_POST['status']);
    $id = check_string($_POST['id']);

    $checkUser = $ManhDev->get_row("SELECT * FROM `users` WHERE `id` = '$id' ");

    if (empty($name) || empty($phone) || empty($status)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Vui Lòng Nhập Đầy Đủ Thông Tin"
        ]));
    } else if (!$checkUser) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Sai?"
        ]));
    } else if (strlen($phone) < 10) {
        die(json_encode([
            "status" => "error",
            "msg" => "Số Điện Thoại Không Đúng Định Dạng"
        ]));
    } else {
        $ManhDev->update("users", [
            "name" => $name,
            "phone" => $phone,
            "status" => $status
        ], " `id` = '$id' ");

        die(json_encode([
            "status" => "success",
            "msg" => "Cập Nhật Thành Công"
        ]));
    }
} else if ($_POST['type'] == "delUser") {
    $id = check_string($_POST['id']);

    $checkUser = $ManhDev->get_row("SELECT * FROM `users` WHERE `id` = '$id' ");

    if (empty($id)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Vui Lòng Nhập Đầy Đủ Thông Tin"
        ]));
    } else if (!$checkUser) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Sai?"
        ]));
    } else if (!is_numeric($id)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Sai?"
        ]));
    } else {
        $ManhDev->xoa("users", " `id` = '" . $checkUser['id'] . "' ");

        die(json_encode([
            "status" => "success",
            "msg" => "Xóa Thành Công Username: " . $checkUser['username']
        ]));
    }
} else if ($_POST['type'] == "addCategory") {
    $name = check_string($_POST['name']);
    $status = check_string($_POST['status']);

    $checkCategory = $ManhDev->get_row("SELECT * FROM `category` WHERE `code` = '" . xoadau($name) . "' ");

    if (empty($name) || empty($status)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Vui Lòng Nhập Đầy Đủ Thông Tin"
        ]));
    } else if ($checkCategory) {
        die(json_encode([
            "status" => "error",
            "msg" => "Đã Tồn Tại Danh Mục Này"
        ]));
    } else {
        $ManhDev->insert("category", [
            "code"   => xoadau($name),
            "name"   => $name,
            "status" => $status,
            "time"   => time()
        ]);

        die(json_encode([
            "status" => "success",
            "msg" => "Thêm Danh Mục Thành Công"
        ]));
    }
} else if ($_POST['type'] == "updateCategory") {
    $name = check_string($_POST['name']);
    $status = check_string($_POST['status']);
    $id = check_string($_POST['id']);

    $checkCategory = $ManhDev->get_row("SELECT * FROM `category` WHERE `id` = '$id' ");

    if (empty($name) || empty($status) || empty($id)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Vui Lòng Nhập Đầy Đủ Thông Tin"
        ]));
    } else if (!$checkCategory) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Sai?"
        ]));
    } else if (!is_numeric($id)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Sai"
        ]));
    } else if (!is_numeric($status)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Sai"
        ]));
    } else {
        $ManhDev->update("category", [
            "name" => $name,
            "status" => $status
        ], " `id` = '$id' ");

        die(json_encode([
            "status" => "success",
            "msg" => "Cập Nhật Thành Công"
        ]));
    }
} else if ($_POST['type'] == "addProduct") {
    $image = $_FILES['image'];
    $demo = $_FILES['demo'];
    $category = check_string($_POST['category']);
    $name = check_string($_POST['name']);
    $price = check_string($_POST['price']);
    $discount = check_string($_POST['discount']) ?? "0";
    $content = $_POST['content'];
    $note = $_POST['note'];
    $label = check_string($_POST['label']);
    $status = check_string($_POST['status']);

    $checkCategory = $ManhDev->get_row("SELECT * FROM `product` WHERE `code` = '" . xoadau($name) . "' ");

    if (empty($category) || empty($name) || empty($price) || empty($content) || empty($status) || empty($note)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Vui Lòng Nhập Đầy Đủ Thông Tin"
        ]));
    } else if ($checkCategory) {
        die(json_encode([
            "status" => "error",
            "msg" => "Đã Tồn Tại Sản Phẩm Này"
        ]));
    } else {
        #upload ảnh thu nhỏ
        $randName = rand(1000, 9999999);
        move_uploaded_file($image['tmp_name'], "../images/imageTN_" . $randName . ".png");

        #upload nhiều ảnh demo
        for ($i = 0; $i < count($demo['name']); $i++) {
            move_uploaded_file($demo['tmp_name'][$i], "../images/" . $demo['name'][$i]);

            if (!$ManhDev->get_row("SELECT * FROM `images` WHERE `path` = '/images/" . $demo['name'][$i] . "' ")) {
                $ManhDev->insert("images", [
                    "code"   => xoadau($name),
                    "path"  => "/images/" . $demo['name'][$i]
                ]);
            }
        }

        $ManhDev->insert("product", [
            "codeCategory" => $category,
            "code"   => xoadau($name),
            "image"  => "/images/imageTN_" . $randName . ".png",
            "name"   => $name,
            "price"  => $price,
            "discount" => $discount,
            "content" => $content,
            "label" => $label,
            "note" => $note,
            "status" => $status,
            "time"   => time()
        ]);

        die(json_encode([
            "status" => "success",
            "msg" => "Thêm Sản Phẩm Thành Công"
        ]));
    }
} else if ($_POST['type'] == "updateProductHide") {
    $status = check_string($_POST['status']);
    $id = check_string($_POST['id']);

    $checkProduct = $ManhDev->get_row("SELECT * FROM `product` WHERE `id` = '$id' ");

    if (empty($status) || empty($id)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Vui Lòng Nhập Đầy Đủ Thông Tin"
        ]));
    } else if (!$checkProduct) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Sai?"
        ]));
    } else if (!is_numeric($id)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Sai"
        ]));
    } else if (!is_numeric($status)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Sai"
        ]));
    } else {
        $ManhDev->update("product", [
            "status" => $status
        ], " `id` = '$id' ");

        die(json_encode([
            "status" => "success",
            "msg" => "Cập Nhật Thành Công"
        ]));
    }
} else if ($_POST['type'] == "updateProduct") {
    $image = $_FILES['image'];

    $codeCategory = check_string($_POST['category']);
    $name = check_string($_POST['name']);
    $price = check_string($_POST['price']);
    $discount = check_string($_POST['discount']);
    $label = check_string($_POST['label']);
    $note = $_POST['note'];
    $content = $_POST['content'];
    $status = check_string($_POST['status']);
    $id = check_string($_POST['id']);

    $checkProduct = $ManhDev->get_row("SELECT * FROM `product` WHERE `id` = '$id' ");

    if (empty($codeCategory) || empty($name) || empty($price) || empty($discount) || empty($content) || empty($status) || empty($id)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Vui Lòng Nhập Đầy Đủ Thông Tin"
        ]));
    } else if (!$checkProduct) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Sai?"
        ]));
    } else if (!is_numeric($id)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Sai"
        ]));
    } else if (!is_numeric($status)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Sai"
        ]));
    } else {
        #upload ảnh thu nhỏ
        $randName = rand(1000, 9999999);
        if($image['error'] !== 0) {
            $path_image = $checkProduct['image'];
        } else {
            move_uploaded_file($image['tmp_name'], "../images/imageTN_" . $randName . ".png");
            $path_image = "/images/imageTN_".$randName.".png";
        }

        $ManhDev->update("product", [
            "codeCategory" => $codeCategory,
            "image" => $path_image,
            "name" => $name,
            "price" => $price,
            "discount" => $discount,
            "content" => $content,
            "label" => $label,
            "note" => $note,
            "status" => $status
        ], " `id` = '$id' ");

        die(json_encode([
            "status" => "success",
            "msg" => "Cập Nhật Thành Công"
        ]));
    }
} else if ($_POST['type'] == "deleteOne") {
    $id = check_string($_POST['id']);
    $table = check_string($_POST['table']);

    $checkTable = $ManhDev->get_row("SELECT * FROM `".$table."` WHERE `id` = '$id' ");

    if (empty($id)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Vui Lòng Nhập Đầy Đủ Thông Tin"
        ]));
    } else if (!$checkTable) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Sai?"
        ]));
    } else if (!is_numeric($id)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Sai?"
        ]));
    } else {
        $ManhDev->xoa($table, " `id` = '" . $checkTable['id'] . "' ");

        die(json_encode([
            "status" => "success",
            "msg" => "Xóa Thành Công"
        ]));
    }
} else if ($_POST['type'] == "addNew") {
    $image = $_FILES['image'];
    $name = check_string($_POST['name']);
    $content = $_POST['content'];
    $status = check_string($_POST['status']);

    $checkCategory = $ManhDev->get_row("SELECT * FROM `news` WHERE `code` = '" . xoadau($name) . "' ");

    if (empty($name) || empty($content) || empty($status)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Vui Lòng Nhập Đầy Đủ Thông Tin"
        ]));
    } else if ($checkCategory) {
        die(json_encode([
            "status" => "error",
            "msg" => "Đã Tồn Tại Sản Phẩm Này"
        ]));
    } else {
        #upload ảnh thu nhỏ
        $randName = rand(1000, 9999999);
        move_uploaded_file($image['tmp_name'], "../images/imageNew_" . $randName . ".png");

        $ManhDev->insert("news", [
            "code"    => xoadau($name),
            "image"   => "/images/imageNew_" . $randName . ".png",
            "title"   => $name,
            "content" => $content,
            "status"  => $status,
            "view"    => "0",
            "time"    => time()
        ]);

        die(json_encode([
            "status" => "success",
            "msg" => "Thêm Bài Viết Thành Công"
        ]));
    }
} else if ($_POST['type'] == "updateNew") {
    $image = $_FILES['image'];
    $name = check_string($_POST['name']);
    $content = $_POST['content'];
    $status = check_string($_POST['status']);
    $id = check_string($_POST['id']);

    $checkProduct = $ManhDev->get_row("SELECT * FROM `news` WHERE `id` = '$id' ");

    if (empty($name) || empty($content) || empty($status) || empty($id)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Vui Lòng Nhập Đầy Đủ Thông Tin"
        ]));
    } else if (!$checkProduct) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Sai?"
        ]));
    } else if (!is_numeric($id)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Sai"
        ]));
    } else if (!is_numeric($status)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Sai"
        ]));
    } else {
        #upload ảnh thu nhỏ
        $randName = rand(1000, 9999999);
        if($image['error'] !== 0) {
            $path_image = $checkProduct['image'];
        } else {
            move_uploaded_file($image['tmp_name'], "../images/imageNew_" . $randName . ".png");
            $path_image = "/images/imageNew_".$randName.".png";
        }

        $ManhDev->update("news", [
            "image" => $path_image,
            "title" => $name,
            "content" => $content,
            "status" => $status
        ], " `id` = '$id' ");

        die(json_encode([
            "status" => "success",
            "msg" => "Cập Nhật Thành Công"
        ]));
    }
} else if ($_POST['type'] == "delComment") {
    $id = check_string($_POST['id']);

    $checkEvaluate = $ManhDev->get_row("SELECT * FROM `evaluate` WHERE `id` = '$id' ");

    if (empty($id)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Vui Lòng Nhập Đầy Đủ Thông Tin"
        ]));
    } else if (!$checkEvaluate) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Sai?"
        ]));
    } else if (!is_numeric($id)) {
        die(json_encode([
            "status" => "error",
            "msg" => "Dữ Liệu Sai?"
        ]));
    } else {
        $ManhDev->xoa("evaluate", " `id` = '" . $checkEvaluate['id'] . "' ");

        die(json_encode([
            "status" => "success",
            "msg" => "Xóa Thành Công"
        ]));
    }
} else {
    die(json_encode([
        "status" => "error",
        "msg" => "Website Được Xây Dựng Bởi " . $ManhDev->site('nameWeb')
    ]));
}
