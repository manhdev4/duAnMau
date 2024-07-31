<div class="row">
    <div class="col-12 col-sm-12 col-md-12">
        <div class="card card-danger">
            <div class="card-header">
                <h4 class="card-title">DANH SÁCH SẢN PHẨM BỊ ẨN</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="table table-striped table-bordered nowrap dataTable Manhdev-dataTable">
                        <thead>
                            <tr>
                                <th>Thao Tác</th>
                                <th>Hình</th>
                                <th>Tên</th>
                                <th>Giá Tiền</th>
                                <th>Trạng Thái</th>
                                <th>Thời Gian Tạo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($ManhDev->get_list("SELECT * FROM `product` WHERE `status` = '2' ORDER BY `id` DESC ") as $row) { ?>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm mb-1" data-toggle="modal" data-target="#edit_<?= $row['id']; ?>"><i class="fas fa-edit"></i> Edit</button>
                                    </td>
                                    <td><img src="<?= $row['image']; ?>" style="width: 50px; border-radius: 5px" alt=""></td>
                                    <td><?= $row['name']; ?></td>
                                    <td><?= numbers_format($row['price']); ?>đ (<b class="text-danger">+<?= numbers_format($row['discount']); ?>%</b>)</td>
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
                                                    <input type="hidden" name="type" value="updateProductHide">
                                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                                    <div id="notification"></div>
                                                    <div class="form-group">
                                                        <label for="">Trạng Thái <span class="text-danger">*</span></label>
                                                        <select class="form-control" name="status" required>
                                                            <option value="1" <?php if ($row['status'] == "1") {
                                                                                    echo "selected";
                                                                                } ?>>Hiển Thị</option>
                                                            <option value="2" <?php if ($row['status'] == "2") {
                                                                                    echo "selected";
                                                                                } ?>>Không Hiện</option>
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
                <a href="/administrators/addProduct" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm Danh Mục</a>
                <a href="/administrators/listProduct" class="btn btn-success"><i class="fas fa-bars"></i> Tất Cả Danh Mục</a>
            </div>
        </div>
    </div>
</div>