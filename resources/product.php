<?php $checkProduct = $ManhDev->get_row("SELECT * FROM `product` WHERE `code` = '" . $code . "' ");
if (!$checkProduct) {
    die(href("/"));
}

$total_review = $ManhDev->get_row("SELECT COUNT(*) FROM `evaluate` WHERE `codeProduct` = '" . $checkProduct['code'] . "' ")['COUNT(*)'];
?>
<title><?= $ManhDev->site("nameWeb"); ?> - <?= $checkProduct['name']; ?></title>
<main class="main">
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="/">Sản Phẩm</a></li>
                <li class="breadcrumb-item"><a href=""><?= $checkProduct['name']; ?></a></li>
            </ol>
        </nav>

        <div class="product-single-container product-single-default">
            <div class="row">
                <div class="col-lg-5 col-md-6 product-single-gallery">
                    <div class="product-slider-container">
                        <div class="label-group">
                            <?php if ($checkProduct['label']) { ?>
                                <div class="product-label label-hot"><?= strtoupper($checkProduct['label']); ?></div>
                            <?php } ?>
                            <?php if ($checkProduct['discount'] > 0) { ?>
                                <div class="product-label label-sale">
                                    -<?= numbers_format($checkProduct['discount']); ?>%
                                </div>
                            <?php } ?>
                        </div>

                        <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                            <div class="product-item">
                                <img class="product-single-image" src="<?= $checkProduct['image']; ?>" data-zoom-image="<?= $checkProduct['image']; ?>" width="468" height="468" alt="<?= $checkProduct['name']; ?>">
                            </div>
                            <?php foreach ($ManhDev->get_list("SELECT * FROM `images` WHERE `code` = '" . $checkProduct['code'] . "' ") as $image) : ?>
                                <div class="product-item">
                                    <img class="product-single-image" src="<?= $image['path']; ?>" data-zoom-image="<?= $image['path']; ?>" width="468" height="468" alt="<?= $checkProduct['name']; ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <span class="prod-full-screen">
                            <i class="fa-solid fa-expand"></i>
                        </span>
                    </div>

                    <div class="prod-thumbnail owl-dots">
                        <div class="owl-dot">
                            <img src="<?= $checkProduct['image']; ?>" width="110" height="110" alt="<?= $checkProduct['name']; ?>">
                        </div>
                        <?php foreach ($ManhDev->get_list("SELECT * FROM `images` WHERE `code` = '" . $checkProduct['code'] . "' ") as $image) : ?>
                            <div class="owl-dot">
                                <img src="<?= $image['path']; ?>" width="110" height="110" alt="<?= $checkProduct['name']; ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="col-lg-7 col-md-6 product-single-details">
                    <h1 class="product-title"><?= $checkProduct['name']; ?></h1>
                    <div class="ratings-container">
                        <div class="product-ratings">
                            <span class="ratings" style="width:100%"></span>
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <a href="#" class="rating-link">( <?= numbers_format($total_review); ?> Reviews )</a>
                    </div>

                    <hr class="short-divider">
                    <?php
                    if (strlen($checkProduct['discount']) == 1) {
                        $lai = "0.00" . $checkProduct['discount'];
                    } else {
                        $lai = "0.0" . $checkProduct['discount'];
                    }
                    $tinhLai = $checkProduct['price'] * $lai;
                    $tongTien = $checkProduct['price'] + $tinhLai; ?>
                    <div class="price-box">
                        <?php if ($checkProduct['discount'] > 0) { ?>
                            <span class="old-price"><?= numbers_format($tongTien); ?><sup>₫</sup></span>
                        <?php } ?>
                        <span class="new-price"><?= numbers_format($checkProduct['price']); ?><sup>₫</sup></span>
                    </div>
                    <div class="product-desc">
                        <?= $checkProduct['note']; ?>
                    </div>
                    <ul class="single-info-list">
                        <li>
                            Danh Mục: <strong><a href="/g/category/<?= $ManhDev->get_row("SELECT * FROM `category` WHERE `code` = '" . $checkProduct['codeCategory'] . "' ")['code']; ?>" class="product-category"><?= $ManhDev->get_row("SELECT * FROM `category` WHERE `code` = '" . $checkProduct['codeCategory'] . "' ")['name']; ?></a></strong>
                        </li>
                    </ul>

                    <div class="product-action">
                        <form submit-ajax="true" action="/api/client" method="POST" url_redirect="" swal="none" time_load="0">
                            <input type="hidden" name="type" value="addCartNumber">
                            <input type="hidden" name="idPro" value="<?= $checkProduct['id']; ?>">
                            <div id="notification"></div>
                            <div class="product-single-qty">
                                <input class="horizontal-quantity form-control" name="amount" type="text">
                            </div>
                            <button type="submit" class="btn btn-dark text-light mr-2" title="Thêm Vào Giỏ">Thêm Vào Giỏ</button>
                        </form>
                        <a href="/g/gio-hang" class="btn btn-gray view-cart d-none">Xem Giỏ Hàng</a>
                    </div>
                    <hr class="divider mb-0 mt-0">

                    <div class="product-single-share mb-3">
                        <label class="sr-only">Chia Sẻ:</label>

                        <div class="social-icons mr-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $base_url; ?>g/product/<?= $checkProduct['code']; ?>" class="social-icon social-facebook fab fa-facebook" target="_blank" title="Facebook"></a>
                            <a href="https://twitter.com/intent/tweet?url=<?= $base_url; ?>g/product/<?= $checkProduct['code']; ?>" class="social-icon social-twitter fab fa-twitter" target="_blank" title="Twitter"></a>
                            <a href="https://www.instagram.com/?url=<?= $base_url; ?>g/product/<?= $checkProduct['code']; ?>" class="social-icon social-twitter fab fa-instagram" target="_blank" title="Instagram"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="product-single-tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab" aria-controls="product-desc-content" aria-selected="true">Mô Tả</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content" role="tab" aria-controls="product-reviews-content" aria-selected="false">Đánh Giá (<?= numbers_format($total_review); ?>)</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel" aria-labelledby="product-tab-desc">
                    <div class="product-desc-content">
                        <?= $checkProduct['content']; ?>
                    </div>
                </div>

                <div class="tab-pane fade" id="product-reviews-content" role="tabpanel" aria-labelledby="product-tab-reviews">
                    <div class="product-reviews-content">

                        <div class="comment-list">
                            <?php foreach ($ManhDev->get_list("SELECT * FROM `evaluate` WHERE `codeProduct` = '" . $checkProduct['code'] . "' ORDER BY `id` DESC LIMIT 10 ") as $evaluate) :
                                $tinhSao = $evaluate['star'] * 20;
                            ?>
                                <div class="comments mb-2">
                                    <figure class="img-thumbnail">
                                        <img src="/images/iconUser.png" alt="<?= $evaluate['name']; ?>" width="80" height="80">
                                    </figure>

                                    <div class="comment-block">
                                        <div class="comment-header">
                                            <div class="comment-arrow"></div>
                                            <div class="ratings-container float-sm-right">
                                                <div class="product-ratings">
                                                    <span class="ratings" style="width:<?= $tinhSao; ?>%"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                            </div>

                                            <span class="comment-by">
                                                <strong><?= $evaluate['name']; ?></strong> – <?= tachTime($evaluate['time']); ?>
                                            </span>
                                        </div>

                                        <div class="comment-content">
                                            <?= $evaluate['content']; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="divider"></div>

                        <div class="add-product-review">
                            <h3 class="review-title">Đánh Giá Của Bạn</h3>

                            <form class="comment-form m-0" submit-ajax="true" action="/api/client" method="POST" url_redirect="" swal="" time_load="1500">
                                <input type="hidden" name="type" value="evaluate">
                                <div id="notification"></div>
                                <div class="row">
                                    <div class="col-md-6 col-xl-12">
                                        <div class="rating-form">
                                            <span class="rating-stars">
                                                <input type="hidden" name="star" id="starInput">
                                                <input type="hidden" name="idProduct" value="<?= $checkProduct['id']; ?>">
                                                <a class="star-1" onclick="star(1)">1</a>
                                                <a class="star-2" onclick="star(2);">2</a>
                                                <a class="star-3" onclick="star(3);">3</a>
                                                <a class="star-4" onclick="star(4);">4</a>
                                                <a class="star-5" onclick="star(5);">5</a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-12">
                                        <div class="form-group">
                                            <label>Tên Của Bạn <span class="required">*</span></label>
                                            <input type="text" class="form-control form-control-sm" name="name" placeholder="Nhập Tên Của Bạn" value="<?= ($ManhDev->users('name') ?? ''); ?>" required="">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nội Dung <span class="required">*</span></label>
                                            <textarea cols="5" rows="6" class="form-control form-control-sm" name="content" placeholder="Nội Dung Đánh Giá" required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Đánh Giá Ngay</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="products-section pt-0 mb-5">
            <h2 class="section-title" style="font-family: Arial, Helvetica, sans-serif">SẢN PHẨM LIÊN QUAN</h2>

            <div class="products-slider owl-carousel owl-theme dots-top dots-small">
                <?php foreach ($ManhDev->get_list("SELECT * FROM `product` WHERE `codeCategory` = '" . $checkProduct['codeCategory'] . "' AND `code` != '" . $checkProduct['code'] . "' ORDER BY `id` ASC LIMIT 1000 ") as $productNew) : ?>
                    <div class="product-default">
                        <figure>
                            <a href="product.html">
                                <img src="images/product-1.jpg" width="280" height="280" alt="product">
                                <img src="images/product-1-2.jpg" width="280" height="280" alt="product">
                            </a>
                            <div class="label-group">
                                <div class="product-label label-hot">HOT</div>
                                <div class="product-label label-sale">-20%</div>
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="category.html" class="product-category">Category</a>
                            </div>
                            <h3 class="product-title">
                                <a href="product.html">Ultimate 3D Bluetooth Speaker</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->
                            <div class="price-box">
                                <del class="old-price">$59.00</del>
                                <span class="product-price">$49.00</span>
                            </div>
                            <!-- End .price-box -->
                            <div class="product-action">
                                <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                <a href="product.html" class="btn-icon btn-add-cart"><i class="fa fa-arrow-right"></i><span>SELECT
                                        OPTIONS</span></a>
                                <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                            </div>
                        </div>
                        <!-- End .product-details -->
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>