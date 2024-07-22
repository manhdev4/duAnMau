<?php require("head.php");

if(isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    $ManhDev->xoa("product", " `id` = '$id' ");
    echo '<script>location.href="/admin/products.php";</script>';
}
?>
<?php require("nav.php"); ?>
<h1 class="h3 mb-3">Quản Lý Danh Mục</h1>

<div class="row">
<div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Thêm Danh Mục</h4>
        </div>
            <div class="card-body">
                <?php
                if(isset($_POST['submit'])) {
                    $name = check_string($_POST['name']);
                    $money = check_string($_POST['money']);
                    $ratio = check_string($_POST['ratio']);
                    $content = check_string($_POST['content']);

                    if(empty($name) || empty($money) || empty($ratio) || empty($content)) {
                        echo '<div class="alert alert-danger">Vui Lòng Nhập Đầy Đủ Thông Tin</div>';
                    } else {
                        $nameAvt = $_FILES['avatar'];
                        move_uploaded_file($nameAvt['tmp_name'], "../images/".$nameAvt['name']);

                        #get tên
                        for($i = 0; $i < count($_FILES['demo']['name']); $i++) {
                            move_uploaded_file($_FILES['demo']['tmp_name'][$i], "../images/".$_FILES['demo']['name'][$i]);
                            $ManhDev->insert("images", [
                                "code" => xoadau($name),
                                "path" => "/images/".$_FILES['demo']['name'][$i],
                            ]);
                        }

                        $ManhDev->insert("product", [
                            "code" => xoadau($name),
                            "image" => "/images/".$nameAvt['name'],
                            "name" => $name,
                            "money" => $money,
                            "ratio" => $ratio,
                            "content" => $content,
                            "status" => "show",
                            "time" => time()
                        ]);
                        echo '<script>location.href="";</script>';
                    }
                }
                ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="">Ảnh Đại Diện</label>
                        <input type="file" class="form-control" name="avatar">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Ảnh Demo</label>
                        <input type="file" class="form-control" multiple name="demo[]">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Tên Sản Phẩm</label>
                        <input type="text" class="form-control" placeholder="Nhập tên" name="name" value="<?=($_POST['name'] ?? '');?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Giá Tiền</label>
                        <input type="number" class="form-control" placeholder="Nhập giá tiền" name="money" min="1" value="<?=($_POST['money'] ?? '');?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Giảm %</label>
                        <input type="number" class="form-control" placeholder="Nhập số % giảm" name="ratio" min="1" max="100" value="<?=($_POST['ratio'] ?? '');?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Mô Tả</label>
                        <textarea type="text" class="form-control" placeholder="Nhập mô tả" name="content" rows="4"><?=($_POST['content'] ?? '');?></textarea>
                    </div>

                    <div class="form-group text-center">
                        <button class="btn btn-primary" type="sumit" name="submit">Thêm Ngay</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Danh Sách Danh Mục</h4>
        </div>
            <div class="card-body">
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>Thao Tác</th>
                            <th>Hình</th>
                            <th>Tên</th>
                            <th>Giá</th>
                            <th>Thời Gian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($ManhDev->get_list("SELECT * FROM `product` ORDER BY `id` DESC ") as $row): ?>
                        <tr>
                            <td>
                                <a href="?xoa=<?=$row['id'];?>" class="btn btn-danger"><i class="fas fa-trash"></i> Xóa</a>
                                <a href="/admin/editCate.php?id=<?=$row['id'];?>" class="btn btn-primary"><i class="fas fa-edit"></i> Sửa</a>
                            </td>
                            <td>
                                <img src="<?=$row['image'];?>" width="50px" alt="">
                            </td>
                            <td>
                                <?=$row['name'];?>
                            </td>
                            <td>
                                <?=tien($row['money']);?>đ
                            </td>
                            <td>
                                <?=date("H:i d/m/Y", $row['time']);?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require("foot.php"); ?>