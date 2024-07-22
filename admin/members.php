<?php require("head.php"); ?>
<?php require("nav.php"); ?>
<h1 class="h3 mb-3">Quản Lý Thành Viên</h1>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><h4>Danh Sách Thành Viên</h4></div>
            <div class="card-body">
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>Thao Tác</th>
                            <th>Tài Khoản</th>
                            <th>Họ Tên</th>
                            <th>Email</th>
                            <th>Thời Gian Tham Gia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($ManhDev->get_list("SELECT * FROM `users` ORDER BY `id` DESC ") as $row): ?>
                        <tr>
                            <td>
                                <a class="btn btn-danger"><i class="fas fa-trash"></i> Xóa</a>
                                <a href="/admin/editUser.php?id=<?=$row['id'];?>" class="btn btn-primary"><i class="fas fa-edit"></i> Sửa</a>
                                <a class="btn btn-info"><i class="fas fa-map"></i> Địa Chỉ</a>
                            </td>
                            <td>
                                <?=$row['username'];?>
                            </td>
                            <td>
                                <?=$row['name'];?>
                            </td>
                            <td>
                                <?=$row['email'];?>
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