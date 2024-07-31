<div class="row">
    <div class="col-12 col-sm-12 col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h4 class="card-title">DANH SÁCH SẢN PHẨM BỊ ẨN</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="table table-striped table-bordered nowrap dataTable Manhdev-dataTable">
                        <thead>
                            <tr>
                                <th>Thao Tác</th>
                                <th>Danh Mục</th>
                                <th>Nhãn</th>
                                <th>Hình</th>
                                <th>Tên</th>
                                <th>Giá Tiền</th>
                                <th>Đánh Giá</th>
                                <th>Trạng Thái</th>
                                <th>Thời Gian Tạo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ManhDev->get_list("SELECT * FROM `product` ORDER BY `id` DESC ") as $row) { ?>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm mb-1" data-toggle="modal" data-target="#edit_<?= $row['id']; ?>"><i class="fas fa-edit"></i> Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm mb-1" onclick="xoa('<?= $row['id']; ?>', 'product')"><i class="fas fa-trash"></i> Xóa</button>
                                        <button type="button" class="btn btn-warning text-light btn-sm mb-1" onclick="href('/administrators/comment?code=<?= $row['code']; ?>')"><i class="fas fa-comment"></i> Bình Luận</button>
                                    </td>
                                    <td><?= $ManhDev->get_row("SELECT * FROM `category` WHERE `code` = '".$row['codeCategory']."' ")['name']; ?></td>
                                    <td class="text-danger"><?= ($row['label'] ?? 'Không Có'); ?></td>
                                    <td><img src="<?= $row['image']; ?>" style="width: 50px; border-radius: 5px" alt=""></td>
                                    <td><?= $row['name']; ?></td>
                                    <td><?= numbers_format($row['price']); ?>đ (<b class="text-danger"><?= numbers_format($row['discount']); ?>%</b>)</td>
                                    <td><?= numbers_format($ManhDev->get_row("SELECT COUNT(*) FROM `evaluate` WHERE `codeProduct` = '" . $row['code'] . "' ")['COUNT(*)']); ?> Lượt</td>
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
                                            <form class="form" submit-ajax="true" action="/api/admin" method="POST" url_redirect="" swal="" time_load="0">
                                                <div class="modal-body">
                                                    <input type="hidden" name="type" value="updateProduct">
                                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                                    <div id="notification"></div>
                                                    <div class="form-group">
                                                        <label for="">Danh Mục <span class="text-danger">*</span></label>
                                                        <select class="form-control" name="category" required>
                                                            <?php foreach ($ManhDev->get_list("SELECT * FROM `category` WHERE `status` = '1' ") as $category) : ?>
                                                                <option value="<?= $category['code']; ?>" <?php if ($row['codeCategory'] == $category['code']) {
                                                                                                                echo 'selected';
                                                                                                            } ?>><?= $category['name']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Ảnh Thu Nhỏ</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" name="image">
                                                                <label class="custom-file-label">Chọn ảnh</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Tên Sản Phẩm <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="name" placeholder="Nhập Tên Sản Phẩm" value="<?= ($row['name'] ?? ''); ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Giá Tiền <span class="text-danger">*</span></label>
                                                        <input type="number" class="form-control" name="price" placeholder="Nhập Giá Tiền" value="<?= ($row['price'] ?? ''); ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Tăng Giá (%) <span class="text-danger">*</span></label>
                                                        <input type="number" class="form-control" name="discount" placeholder="Nhập Phần Trăm Tăng Giá" value="<?= ($row['discount'] ?? ''); ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Nhãn </label>
                                                        <select name="label" class="form-control">
                                                            <option value="" <?php if($row['label'] == "") { echo 'selected'; } ?>>-- Không Có --</option>
                                                            <option value="HOT" <?php if($row['label'] == "HOT") { echo 'selected'; } ?>>HOT</option>
                                                            <option value="SALE" <?php if($row['label'] == "SALE") { echo 'selected'; } ?>>SALE</option>
                                                            <option value="NEW" <?php if($row['label'] == "NEW") { echo 'selected'; } ?>>NEW</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Giới Thiệu <span class="text-danger">*</span></label>
                                                        <textarea type="text" class="form-control note-codable summernote" name="note" placeholder="Nhập Giới Thiệu" required><?= ($row['note'] ?? ''); ?></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Mô Tả <span class="text-danger">*</span></label>
                                                        <textarea type="text" class="form-control note-codable summernote" name="content" placeholder="Nhập Nội Dung" required><?= ($row['content'] ?? ''); ?></textarea>
                                                    </div>

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
                <a href="/administrators/addProduct" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm Sản Phẩm</a>
                <a href="/administrators/listProductHide" class="btn btn-info"><i class="fas fa-bars"></i> Sản Phẩm Bị Ẩn</a>
                <a href="/administrators/listCategory" class="btn btn-success"><i class="fas fa-list"></i> Danh Mục</a>
            </div>
        </div>
    </div>
</div>