<?php require("head.php");

if(isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    $ManhDev->xoa("categories", " `id` = '$id' ");
    echo '<script>location.href="/admin/categories.php";</script>';
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
                    if(empty($name)) {
                        echo '<div class="alert alert-danger">Vui Lòng Nhập Tên Danh Mục</div>';
                    } else {
                        $ManhDev->insert("categories", [
                            "code" => xoadau($name),
                            "name" => $name
                        ]);
                        echo '<script>location.href="";</script>';
                    }
                }
                ?>
                <form action="" method="POST">
                    <div class="form-group mb-3">
                        <label for="">Tên Danh Mục</label>
                        <input type="text" class="form-control" placeholder="Nhập tên danh mục" name="name">
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
                            <th>Tên</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($ManhDev->get_list("SELECT * FROM `categories` ORDER BY `id` DESC ") as $row): ?>
                        <tr>
                            <td>
                                <a href="?xoa=<?=$row['id'];?>" class="btn btn-danger"><i class="fas fa-trash"></i> Xóa</a>
                                <a href="/admin/editCate.php?id=<?=$row['id'];?>" class="btn btn-primary"><i class="fas fa-edit"></i> Sửa</a>
                            </td>
                            <td>
                                <?=$row['name'];?>
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