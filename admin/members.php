<div class="row">
    <div class="col-12 col-sm-12 col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h4 class="card-title">DANH SÁCH THÀNH VIÊN</h4>
            </div>
            <div class="card-body">
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-bordered nowrap dataTable Manhdev-dataTable">
                        <thead>
                            <tr>
                                <th>Thao Tác</th>
                                <th>Tài Khoản</th>
                                <th>Email</th>
                                <th>Trạng Thái</th>
                                <th>IP</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($ManhDev->get_list("SELECT * FROM `users` ORDER BY `id` DESC ") as $users) { ?>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm mb-1" data-toggle="modal" data-target="#edit_<?= $users['id']; ?>"><i class="fas fa-edit"></i> Edit</button>
                                        <button type="button" class="btn btn-success btn-sm mb-1" data-toggle="modal" data-target="#address_<?= $users['id']; ?>"><i class="fas fa-location-dot"></i> Address</button>
                                        <button type="button" class="btn btn-danger btn-sm mb-1" onclick="xoaUsers('<?= $users['id']; ?>')"><i class="fas fa-trash"></i> Delete</button>
                                    </td>
                                    <td><?= $users['username']; ?></td>
                                    <td><?= $users['email']; ?></td>
                                    <td><?= statusUser($users['status']); ?></td>
                                    <td><?= $users['ip']; ?></td>
                                    <td><?= date("H:i d-m-Y", $users['time']); ?></td>
                                </tr>
                                <div class="modal fade" id="edit_<?= $users['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Chỉnh Sửa: <b><?= $users['username']; ?></b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="form" submit-ajax="true" action="/api/admin" method="POST" url_redirect="" swal="" time_load="1500">
                                                <div class="modal-body">
                                                    <input type="hidden" name="type" value="updateUsers">
                                                    <input type="hidden" name="id" value="<?= $users['id']; ?>">
                                                    <div id="notification"></div>
                                                    <div class="form-group">
                                                        <label for="">Tài Khoản</label>
                                                        <input type="text" class="form-control" value="<?= $users['username']; ?>" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Email</label>
                                                        <input type="text" class="form-control" value="<?= $users['email']; ?>" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Họ Tên <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="name" placeholder="Cập Nhật Tên Thành Viên" value="<?= $users['username']; ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Số Điện Thoại <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="phone" placeholder="Cập Nhật Số Điện Thoại" value="<?= $users['phone']; ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Trạng Thái <span class="text-danger">*</span></label>
                                                        <select class="form-control" name="status" required>
                                                            <option value="active" <?php if ($users['status'] == "active") {
                                                                                        echo "selected";
                                                                                    } ?>>Hoạt Động</option>
                                                            <option value="bannd" <?php if ($users['status'] == "bannd") {
                                                                                        echo "selected";
                                                                                    } ?>>Khóa</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="address_<?= $users['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Địa Chỉ: <b><?= $users['username']; ?></b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                                <div class="modal-body">
                                                <?php foreach ($ManhDev->get_list("SELECT * FROM `address` WHERE `username` = '".$users['username']."' ORDER BY `id` DESC ") as $address) : ?>
                                                    <ul style="margin: 10px 0px; padding: 0px; list-style: none">
                                                        <li><b class="text-primary">Họ Tên: <?=$address['name'];?></b></li>
                                                        <li><b class="text-danger">Số Điện Thoại: <?=$address['phone'];?></b></li>
                                                        <li><b class="text-light">Địa Chỉ 1: <?=$address['address1'];?></b></li>
                                                        <li><b class="text-light">Địa Chỉ 2: <?=($address['address2'] ?? "...");?></b></li>
                                                        <li><b class="text-info">Thời Gian Thêm: <?=tachTime($address['time']);?></b></li>
                                                    </ul>
                                                    <?php endforeach; ?>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>