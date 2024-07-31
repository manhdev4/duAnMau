<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h4>Thêm Danh Mục Mới</h4>
            </div>
            <div class="card-body">
                <form class="form" submit-ajax="true" action="/api/admin" method="POST" url_redirect="" swal="" time_load="1500">
                    <input type="hidden" name="type" value="addCategory">
                    <div id="notification"></div>
                    <div class="form-group">
                        <label for="">Tên Danh Mục <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" placeholder="Nhập Tên Danh Mục" required>
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
                        <a href="/administrators/listCategory" class="btn btn-info"><i class="fas fa-list"></i> Danh Mục</a>
                        <a href="/administrators/listProduct" class="btn btn-success"><i class="fas fa-list"></i> Sản Phẩm</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>