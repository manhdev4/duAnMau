<div class="row">
    <div class="col-12 col-sm-12 col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h4 class="card-title">DANH SÁCH DANH MỤC</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="table table-striped table-bordered nowrap dataTable Manhdev-dataTable">
                        <thead>
                            <tr>
                                <th>Thao Tác</th>
                                <th>Tên</th>
                                <th>Trạng Thái</th>
                                <th>Thời Gian Tạo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($ManhDev->get_list("SELECT * FROM `category` ORDER BY `id` DESC ") as $row) { ?>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm mb-1" data-toggle="modal" data-target="#edit_<?= $row['id']; ?>"><i class="fas fa-edit"></i> Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm mb-1" onclick="xoa('<?= $row['id']; ?>', 'category')"><i class="fas fa-trash"></i> Delete</button>
                                    </td>
                                    <td><?= $row['name']; ?></td>
                                    <td><?= status($row['status']); ?></td>
                                    <td><?= date("H:i d-m-Y", $row['time']); ?></td>
                                </tr>
                                <div class="modal fade" id="edit_<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Chỉnh Sửa: <b><?= $row['name']; ?></b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="form" submit-ajax="true" action="/api/admin" method="POST" url_redirect="" swal="" time_load="1500">
                                                <div class="modal-body">
                                                    <input type="hidden" name="type" value="updateCategory">
                                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                                    <div id="notification"></div>
                                                    <div class="form-group">
                                                        <label for="">Tên Danh Mục <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="name" placeholder="Cập Nhật Tên Danh Mục" value="<?= $row['name']; ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Trạng Thái <span class="text-danger">*</span></label>
                                                        <select class="form-control" name="status" required>
                                                            <option value="1" <?php if ($row['status'] == "1") { echo "selected"; } ?>>Hiển Thị</option>
                                                            <option value="2" <?php if ($row['status'] == "2") { echo "selected"; } ?>>Không Hiện</option>
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
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a href="/administrators/addCategory" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm Danh Mục</a>
                <a href="/administrators/listProduct" class="btn btn-success"><i class="fas fa-list"></i> Sản Phẩm</a>
            </div>
        </div>
    </div>
</div>