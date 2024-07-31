<?php $checkCategory = $ManhDev->get_row("SELECT * FROM `category` WHERE `code` = '" . $code . "' ");
if (!$checkCategory) {
    die(href("/"));
}
?>
<title><?= $ManhDev->site("nameWeb"); ?> - <?= $checkCategory['name']; ?></title>
<main class="main">
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="/">Danh Mục</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $checkCategory['name']; ?></li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-lg-9 main-content">
                <div class="sticky-wrapper">
                    <form action="" method="POST">
                        <nav class="toolbox sticky-header" data-sticky-options="{'mobile': true}">
                            <div class="toolbox-left">
                                <div class="toolbox-item toolbox-sort">
                                    <label>Sắp Xếp Theo:</label>
                                    <div class="select-custom">
                                        <select name="orderby" class="form-control">
                                            <option value="default" selected>Mặc Định</option>
                                            <option value="price" <?php if($_POST['orderby'] == "price") { echo 'selected'; } ?>>Từ Thấp Đến Cao</option>
                                            <option value="price-desc" <?php if($_POST['orderby'] == "price-desc") { echo 'selected'; } ?>>Từ Cao Đến Thấp</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="toolbox-item toolbox-show" style="margin-left: 5px">
                                    <label>Hiển Thị:</label>
                                    <div class="select-custom">
                                        <select name="count" class="form-control">
                                            <option value="12" selected>12</option>
                                            <option value="24" <?php if($_POST['count'] == "24") { echo 'selected'; } ?>>24</option>
                                            <option value="36" <?php if($_POST['count'] == "36") { echo 'selected'; } ?>>36</option>
                                            <option value="48" <?php if($_POST['count'] == "48") { echo 'selected'; } ?>>48</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            

                            <div class="toolbox-right">
                                <button type="submit" class="btn btn-primary btn-sm">Lọc</button>
                            </div>

                        </nav>
                    </form>
                </div>
                <div class="row">
                    <?php
                    if (isset($_POST['count'])) {
                        $limit = check_string($_POST['count']);
                    } else {
                        $limit = 12;
                    }

                    if (isset($_POST['orderby'])) {
                        $checkOrderby = check_string($_POST['orderby']);
                        if($checkOrderby == "price") {
                            $orderby = "ORDER BY `price` ASC";
                        } else if($checkOrderby == "price-desc") {
                            $orderby = "ORDER BY `price` DESC";
                        } else {
                            echo href('');
                        }
                    } else {
                        $orderby = "ORDER BY `id` ASC";
                    }

                    foreach ($ManhDev->get_list("SELECT * FROM `product` WHERE `codeCategory` = '" . $checkCategory['code'] . "' ".$orderby." LIMIT " . $limit) as $product) :

                        $total_danhGia = $ManhDev->get_row("SELECT COUNT(*) FROM `evaluate` WHERE `codeProduct` = '" . $product['code'] . "' ")['COUNT(*)']; #tổng đánh giá
                        foreach ($ManhDev->get_list("SELECT * FROM `evaluate` WHERE `codeProduct` = '" . $product['code'] . "' ORDER BY `id` DESC ") as $star) {
                            $totaStar = $star['star']; #lấy số sao của 1 đánh giá
                            $congStar += $totaStar;
                            $tinhTong = $congStar / $total_danhGia; #lấy số sao chia tổng đánh giá
                        }

                        $tongSao = $tinhTong * 20;
                    ?>
                        <div class="col-6 col-sm-4">
                            <div class="product-default">
                                <figure>
                                    <a href="/g/product/<?= $product['code']; ?>">
                                        <img src="<?= $product['image']; ?>" width="280" height="280" alt="<?= $product['name']; ?>">

                                        <img src="<?= $ManhDev->get_row("SELECT * FROM `images` WHERE `code` = '" . $product['code'] . "' ORDER BY `id` ASC LIMIT 1 ")['path']; ?>" width="280" height="280" alt="<?= $product['name']; ?>">

                                    </a>

                                    <div class="label-group">
                                        <div class="product-label label-hot"><?= $product['label']; ?></div>
                                        <div class="product-label label-sale">-<?= numbers_format($product['discount']); ?>%</div>
                                    </div>
                                </figure>

                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                            <a href="/g/category/<?= $ManhDev->get_row("SELECT * FROM `category` WHERE `code` = '" . $product['codeCategory'] . "' ")['code']; ?>" class="product-category"><?= $ManhDev->get_row("SELECT * FROM `category` WHERE `code` = '" . $product['codeCategory'] . "' ")['name']; ?></a>
                                        </div>
                                    </div>

                                    <h3 class="product-title"> <a href="/g/product/<?= $product['code']; ?>"><?= $product['name']; ?></a> </h3>

                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            <span class="ratings" style="width:<?= $tongSao; ?>%"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                    </div>
                                    <?php
                                    if (strlen($product['discount']) == 1) {
                                        $lai = "0.00" . $product['discount'];
                                    } else {
                                        $lai = "0.0" . $product['discount'];
                                    }
                                    $tinhLai = $product['price'] * $lai;
                                    $tongTien = $product['price'] + $tinhLai; ?>
                                    <div class="price-box">
                                        <?php if ($product['discount'] > 0) { ?>
                                            <span class="old-price"><?= numbers_format($tongTien); ?>đ</span>
                                        <?php } ?>
                                        <span class="product-price"><?= numbers_format($product['price']); ?>đ</span>
                                    </div>

                                    <div class="product-action">
                                        <a onclick="addCart('<?= $product['id']; ?>')" class="btn-icon btn-add-cart"><i class="fas fa-arrow-right"></i><span>THÊM VÀO GIỎ</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="sidebar-overlay"></div>
            <aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
                <div class="sidebar-wrapper">
                    <div class="widget">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true" aria-controls="widget-body-2">TỔNG DANH MỤC</a>
                        </h3>

                        <div class="collapse show" id="widget-body-2">
                            <div class="widget-body">
                                <ul class="cat-list">
                                    <?php foreach ($ManhDev->get_list("SELECT * FROM `category` WHERE `status` = '1' ORDER BY `id` ASC ") as $category) :
                                        $total_product = $ManhDev->get_row("SELECT COUNT(*) FROM `product` WHERE `codeCategory` = '" . $category['code'] . "' ")['COUNT(*)'];
                                    ?>
                                        <li><a href="/g/category/<?= $category['code']; ?>"><?= $category['name']; ?><span class="products-count">(<?= numbers_format($total_product); ?>)</span></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="widget widget-featured">
                        <h3 class="widget-title">Nổi Bật</h3>

                        <div class="widget-body">
                            <div class="owl-carousel widget-featured-products owl-loaded owl-drag">

                                <div class="owl-stage-outer owl-height">
                                    <div class="owl-stage">
                                        <div class="owl-item cloned">
                                            <div class="featured-col">
                                                <?php foreach ($ManhDev->get_list("SELECT * FROM `product` WHERE `label` = 'HOT' ORDER BY `id` ASC LIMIT 6") as $productLabel) :
                                                     $total_danhGia = $ManhDev->get_row("SELECT COUNT(*) FROM `evaluate` WHERE `codeProduct` = '" . $productLabel['code'] . "' ")['COUNT(*)']; #tổng đánh giá
                                                     foreach ($ManhDev->get_list("SELECT * FROM `evaluate` WHERE `codeProduct` = '" . $productLabel['code'] . "' ORDER BY `id` DESC ") as $star) {
                                                         $totaStar = $star['star']; #lấy số sao của 1 đánh giá
                                                         $congStar += $totaStar;
                                                         $tinhTong = $congStar / $total_danhGia; #lấy số sao chia tổng đánh giá
                                                     }
                             
                                                     $tongSao = $tinhTong * 20;
                                                ?>
                                                    <div class="product-default left-details product-widget">
                                                        <figure>
                                                            <a href="/g/product/<?= $productLabel['code']; ?>">
                                                                <img src="<?= $productLabel['image']; ?>" width="75" height="75" alt="<?= $productLabel['name']; ?></a>">
                                                                <img src="<?= $ManhDev->get_row("SELECT * FROM `images` WHERE `code` = '" . $productLabel['code'] . "' ORDER BY `id` ASC LIMIT 1 ")['path']; ?>" width="75" height="75" alt="<?= $productLabel['name']; ?></a>">
                                                            </a>
                                                        </figure>
                                                        <div class="product-details">
                                                            <h3 class="product-title"> <a href="/g/product/<?= $productLabel['code']; ?>"><?= $productLabel['name']; ?></a> </h3>
                                                            <div class="ratings-container">
                                                                <div class="product-ratings">
                                                                    <span class="ratings" style="width:<?= $tongSao; ?>%"></span>
                                                                    <span class="tooltiptext tooltip-top"></span>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            if (strlen($productLabel['discount']) == 1) {
                                                                $lai = "0.00" . $productLabel['discount'];
                                                            } else {
                                                                $lai = "0.0" . $productLabel['discount'];
                                                            }
                                                            $tinhLai = $productLabel['price'] * $lai;
                                                            $tongTien = $productLabel['price'] + $tinhLai; ?>
                                                            <div class="price-box">
                                                                <?php if ($productLabel['discount'] > 0) { ?>
                                                                    <span class="old-price"><?= numbers_format($tongTien); ?>đ</span>
                                                                <?php } ?>
                                                                <span class="product-price"><?= numbers_format($productLabel['price']); ?>đ</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="owl-dots disabled"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
    <div class="mb-4"></div>
</main>