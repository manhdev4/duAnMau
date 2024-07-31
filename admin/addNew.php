<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h4>Thêm Bài Viết</h4>
            </div>
            <div class="card-body">
                <form class="form" submit-ajax="true" action="/api/admin" method="POST" url_redirect="" swal="" time_load="1500" enctype="multipart/form-data">
                    <input type="hidden" name="type" value="addNew">
                    <div id="notification"></div>
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
                        <label for="">Tiêu Đề <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" placeholder="Nhập Tiêu Đề" required>
                    </div>
                    <div class="form-group">
                        <label for="">Mô Tả <span class="text-danger">*</span></label>
                        <textarea type="text" class="form-control" id="summernote" name="content" placeholder="Nhập Nội Dung" required></textarea>
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
                        <a href="/administrators/news" class="btn btn-info"><i class="fas fa-list"></i> Bài Viết</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>