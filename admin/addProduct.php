<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h4>Thêm Sản Phẩm</h4>
            </div>
            <div class="card-body">
                <form class="form" submit-ajax="true" action="/api/admin" method="POST" url_redirect="" swal="" time_load="1500" enctype="multipart/form-data">
                    <input type="hidden" name="type" value="addProduct">
                    <div id="notification"></div>
                    <div class="form-group">
                        <label for="">Danh Mục <span class="text-danger">*</span></label>
                        <select class="form-control" name="category" required>
                            <?php foreach ($ManhDev->get_list("SELECT * FROM `category` WHERE `status` = '1' ") as $category) : ?>
                                <option value="<?= $category['code']; ?>"><?= $category['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Ảnh Thu Nhỏ <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image" required>
                                <label class="custom-file-label">Chọn ảnh</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Ảnh Demo <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="demo[]" multiple required>
                                <label class="custom-file-label">Chọn ảnh</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Tên Sản Phẩm <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" placeholder="Nhập Tên Sản Phẩm" required>
                    </div>
                    <div class="form-group">
                        <label for="">Giá Tiền <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="price" placeholder="Nhập Giá Tiền" required>
                    </div>
                    <div class="form-group">
                        <label for="">Giảm Giá (%)</label>
                        <input type="number" class="form-control" name="discount" placeholder="Nhập % Giảm">
                    </div>

                    <div class="form-group">
                        <label for="">Giới Thiệu <span class="text-danger">*</span></label>
                        <textarea type="text" class="form-control summernote" name="note" placeholder="Nhập Nội Dung Giới Thiệu Ngắn" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Mô Tả <span class="text-danger">*</span></label>
                        <textarea type="text" class="form-control" id="summernote" name="content" placeholder="Nhập Nội Dung" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Nhãn </label>
                        <select name="label" class="form-control">
                            <option value="">-- Không Có --</option>
                            <option value="HOT">HOT</option>
                            <option value="SALE">SALE</option>
                            <option value="NEW">NEW</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Trạng Thái <span class="text-danger">*</span></label>
                        <select class="form-control" name="status" required>
                            <option value="1">Hiển Thị</option>
                            <option value="2">Không Hiện</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm Ngay</button>
                        <a href="/administrators/listProduct" class="btn btn-info"><i class="fas fa-list"></i> Sản Phẩm</a>
                        <a href="/administrators/listProductHide" class="btn btn-danger"><i class="fas fa-list"></i> Sản Phẩm Ẩn</a>
                        <a href="/administrators/listCategory" class="btn btn-success"><i class="fas fa-list"></i> Danh Mục</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>