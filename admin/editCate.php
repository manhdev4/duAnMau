<?php require("head.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo '<script>location.href="/admin/categories.php";</script>';
}

$get = $ManhDev->get_row("SELECT * FROM `categories` WHERE `id` = '$id' ");
?>
<?php require("nav.php"); ?>
<h1 class="h3 mb-3">Quản Lý Danh Mục</h1>

<div class="row">
<div class="col-md-6 mb-3"><a href="/admin/categories.php" class="btn btn-sm btn-danger">Quay Lại</a></div>
<div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Thêm Danh Mục</h4>
        </div>
            <div class="card-body">
                <?php
                if(isset($_POST['submit'])) {
                    $name = check_string($_POST['name']);
                    if(empty($name)) {
                        echo '<div class="alert alert-danger">Vui Lòng Nhập Tên Danh Mục</div>';
                    } else {
                        $ManhDev->update("categories", [
                            "name" => $name
                        ], " `id` = '$id' ");
                        echo '<script>location.href="";</script>';
                    }
                }
                ?>
                <form action="" method="POST">
                    <div class="form-group mb-3">
                        <label for="">Tên Danh Mục</label>
                        <input type="text" class="form-control" placeholder="Nhập tên danh mục" name="name" value="<?=($get['name'] ?? '');?>">
                    </div>

                    <div class="form-group text-center">
                        <button class="btn btn-primary" type="sumit" name="submit">Lưu Ngay</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require("foot.php"); ?>