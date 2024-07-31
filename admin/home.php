<?php
$total_members = $ManhDev->get_row("SELECT COUNT(*) FROM `users` WHERE `status` = 'active' ") ['COUNT(*)'];
$total_orders = $ManhDev->get_row("SELECT COUNT(*) FROM `orders` ") ['COUNT(*)'];
$total_orders_delivery = $ManhDev->get_row("SELECT COUNT(*) FROM `orders` WHERE `status` = 'delivery' ") ['COUNT(*)'];
$total_orders_refund = $ManhDev->get_row("SELECT COUNT(*) FROM `orders` WHERE `status` = 'refund' ") ['COUNT(*)'];
?>
<div class="row">
    <div class="col-12 col-sm-12 col-md-12">
        <h5>Thống Kê</h5>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Tổng Thành Viên</span>
                <span class="info-box-number">
                    <?=numbers_format($total_members);?>
                </span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-file"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Tổng Đơn Hàng</span>
                <span class="info-box-number"><?=numbers_format($total_orders);?></span>
            </div>
        </div>
    </div>

    <div class="clearfix hidden-md-up"></div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Đơn Hàng Đang Giao</span>
                <span class="info-box-number"><?=numbers_format($total_orders_delivery);?></span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Đơn Hàng Hoàn Trả</span>
                <span class="info-box-number"><?=numbers_format($total_orders_refund);?></span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-12 col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h4 class="card-title">NHẬT KÝ HOẠT ĐỘNG</h4>
            </div>
            <div class="card-body">
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-bordered nowrap dataTable Manhdev-dataTable">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Tài Khoản</th>
                                <th>Nội Dung</th>
                                <th>Ip</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($ManhDev->get_list("SELECT * FROM `log_site` ORDER BY `id` DESC ") as $log_site) { ?>
                                <tr>
                                    <td class="text-center"><?= $i++; ?></td>
                                    <td class="text-center"><?= $log_site['username']; ?></td>
                                    <td><?= $log_site['content']; ?></td>
                                    <td><?= $log_site['ip']; ?></td>
                                    <td class="text-center"><?= date("H:i d-m-Y", $log_site['time']); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>