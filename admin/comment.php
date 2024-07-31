<?php $checkProduct = $ManhDev->get_row("SELECT * FROM `product` WHERE `code` = '".$_GET['code']."' ") ?>

<div class="row">
    <div class="col-12 col-sm-12 col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h4 class="card-title">DANH SÁCH ĐÁNH GIÁ SẢN PHẨM: <b><?=$checkProduct['name'];?></b></h4>
            </div>
            <div class="card-body">
            <?php foreach ($ManhDev->get_list("SELECT * FROM `evaluate` WHERE `codeProduct` = '".$checkProduct['code']."' ORDER BY `id` DESC ") as $row): ?>
            <div style="padding-bottom: 10px; border-bottom: 1px solid #e5e5e5; margin-bottom: 10px">
                <div class="text-danger"><?=$row['username'];?>: <small class="text-warning">(<?=$row['star'];?> sao) - <small class="text-dark"><?=tachTime($row['time']);?></small></div>
                <div class="text-light"><?=$row['content'];?> <span class="btn-sm btn btn-danger btn-xs ml-2" onclick="delComment('<?=$row['id'];?>')"><i class="fas fa-trash"></i> Xóa</span></div>
            </div>
            <?php endforeach; ?>
            </div>
            <div class="card-footer">
                <a href="/administrators/listProduct" class="btn btn-success"><i class="fas fa-list"></i> Sản Phẩm</a>
            </div>
        </div>
    </div>
</div>