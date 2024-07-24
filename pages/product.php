<?php require("../include/head.php");
if (isset($_GET['code'])) {
    $code = $_GET['code'];
} else {
    echo '<script>location.href="/"</script>';
    die();
}

$checkPro = $ManhDev->get_row("SELECT * FROM `product` WHERE `code` = '$code' ");
if (!$checkPro) {
    echo '<script>location.href="/"</script>';
    die();
}
?>
<?php require("../include/nav.php"); ?>

<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="/">Trang Chủ</a></li>
                        <li><?= $checkPro['name']; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product_page_bg">
    <div class="container">
        <div class="product_details_wrapper mb-55">
            <!--product details start-->
            <div class="product_details">
                <div class="row">
                    <div class="col-lg-5 col-md-6">
                        <div class="product-details-tab">
                            <div id="img-1" class="zoomWrapper single-zoom">
                                <a href="#">
                                    <img id="zoom1" src="<?= $checkPro['image']; ?>" data-zoom-image="<?= $checkPro['image']; ?>" alt="big-1">
                                </a>
                            </div>
                            <div class="single-zoom-thumb">
                                <ul class="s-tab-zoom owl-carousel single-product-active owl-loaded owl-drag" id="gallery_01">
                                    <?php $m = 1;
                                    foreach ($ManhDev->get_list("SELECT * FROM `images` WHERE `code` = '$code' ") as $image) : ?>
                                        <li>
                                            <a href="#" class="elevatezoom-gallery active" data-update="" data-image="<?= $image['path']; ?>" data-zoom-image="<?= $image['path']; ?>">
                                                <img src="<?= $image['path']; ?>" alt="zo-th-1">
                                            </a>

                                        </li>
                                    <?php endforeach; ?>
                                    <div class="owl-dots disabled"></div>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6">
                        <div class="product_d_right">
                            <form action="#">

                                <h3><a href=""><?= $checkPro['name']; ?></a></h3>
                                <div class="product_nav">
                                    <ul>
                                        <li class="prev"><a href="product-details.html"><i class="fa fa-angle-left"></i></a></li>
                                        <li class="next"><a href="variable-product.html"><i class="fa fa-angle-right"></i></a></li>
                                    </ul>
                                </div>
                                <?php $tienGoc = $checkPro['money'];
                                if (strlen($checkPro['ratio']) == 2) {
                                    $lai = "0.0" . $checkPro['ratio'];
                                } else {
                                    $lai = "0.00" . $checkPro['ratio'];
                                }
                                $laii = $tienGoc * $lai;
                                $tinhLai = $tienGoc + $laii;
                                ?>
                                <div class="price_box">
                                    <span class="old_price"><?= tien($tinhLai); ?>đ</span>
                                    <span class="current_price"><?= tien($tienGoc); ?></span>
                                </div>
                                <div class="product_des">
                                    <p></p>
                                </div>
                                <div class="product_variant quantity">
                                    <label>Số Lượng</label>
                                    <input min="1" max="100" value="1" type="number">
                                    <button class="button" type="button" onclick="addCart(<?=$checkPro['id'];?>)">Thêm Vào Giỏ</button>
                                </div>
                                <div class="product_meta">
                                    <span>Danh Mục: <a href="#"><?= $ManhDev->get_row("SELECT * FROM `categories` WHERE `code` = '" . $checkPro['codeCate'] . "' ")['name'] ?></a></span>
                                </div>

                            </form>
                            <div class="priduct_social">
                                <ul>
                                    <li><a class="facebook" href="#" title="facebook"><i class="fab fa-facebook"></i> Like</a></li>
                                    <li><a class="twitter" href="#" title="twitter"><i class="fab fa-twitter"></i> tweet</a></li>
                                    <li><a class="pinterest" href="#" title="pinterest"><i class="fab fa-pinterest"></i> save</a></li>
                                    <li><a class="google-plus" href="#" title="google +"><i class="fab fa-google-plus"></i> share</a></li>
                                    <li><a class="linkedin" href="#" title="linkedin"><i class="fab fa-linkedin"></i> linked</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--product details end-->

            <!--product info start-->
            <div class="product_d_info">
                <div class="row">
                    <div class="col-12">
                        <div class="product_d_inner">
                            <div class="product_info_button">
                                <ul class="nav" role="tablist" id="nav-tab">
                                    <li>
                                        <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Mô Tả</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="info" role="tabpanel">
                                    <div class="product_info_content">
                                        <?= $checkPro['content']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--product info end-->
        </div>

        <!--product area start-->
        <section class="product_area related_products">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2>Sản Phẩm Tương Tự</h2>
                    </div>
                </div>
            </div>
            <div class="product_carousel product_style product_column5 owl-carousel owl-loaded owl-drag">
            <?php foreach($ManhDev->get_list("SELECT * FROM `product` WHERE `codeCate` = '".$checkPro['codeCate']."' AND `code` != '$code' ORDER BY `id` DESC ") as $product): ?>
                <article class="single_product">
                    <figure>
                        <div class="product_thumb">
                            <a class="primary_img" href="/pages/product.php?code=<?=$product['code'];?>"><img src="<?=$product['image'];?>" alt=""></a>
                            <div class="label_product">
                                <span class="label_sale">Sale</span>
                            </div>
                            <div class="action_links">
                                <ul>
                                    <li class="wishlist"><a href="wishlist.html" data-tippy-placement="top" data-tippy-arrow="true" data-tippy-inertia="true" data-tippy="Add to Wishlist"><i class="ion-android-favorite-outline"></i></a></li>
                                    <li class="compare"><a href="#" data-tippy-placement="top" data-tippy-arrow="true" data-tippy-inertia="true" data-tippy="Add to Compare"><i class="ion-ios-settings-strong"></i></a></li>
                                    <li class="quick_button"><a href="#" data-tippy-placement="top" data-tippy-arrow="true" data-tippy-inertia="true" data-bs-toggle="modal" data-bs-target="#modal_box" data-tippy="quick view"><i class="ion-ios-search-strong"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product_content">
                            <div class="product_content_inner">
                                <h4 class="product_name"><?=$product['name'];?></h4>
                                <?php $tienGoc = $product['money'];
                                if (strlen($product['ratio']) == 2) {
                                    $lai = "0.0" . $product['ratio'];
                                } else {
                                    $lai = "0.00" . $product['ratio'];
                                }
                                $laii = $tienGoc * $lai;
                                $tinhLai = $tienGoc + $laii;
                                ?>
                                <div class="price_box">
                                    <span class="old_price"><?=tien($tinhLai);?>đ</span>
                                    <span class="current_price"><?=tien($tienGoc);?>đ</span>
                                </div>
                            </div>
                            <div class="add_to_cart">
                                <a onclick="addCart(<?=$product['id'];?>)" title="Add to cart">Thêm Vào Giỏ</a>
                            </div>

                        </div>
                    </figure>
                </article>
            <?php endforeach; ?>
                <div class="owl-dots disabled"></div>
            </div>

        </section>
    </div>
</div>
<?php require("../include/foot.php"); ?>