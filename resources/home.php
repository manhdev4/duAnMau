<title><?= $website['home']; ?></title>
<main class="main">
    <div class="home-slider slide-animate owl-carousel owl-theme show-nav-hover nav-big mb-2 text-uppercase" data-owl-options="{
				'loop': false
			}">
        <div class="home-slide banner">
            <img class="slide-bg" src="https://img4.thuthuatphanmem.vn/uploads/2020/06/26/hinh-anh-banner-dien-may-thong-minh_033705387.png" style="width: 1903px; height: 499px" alt="slider image">
        </div>
        <div class="home-slide banner">
            <img class="slide-bg" src="https://didongvang.com/files/assets/banner01.jpg" style="width: 1903px; height: 499px" alt="slider image">
        </div>
    </div>

    <div class="container">
        <div class="info-boxes-slider owl-carousel owl-theme mb-2" data-owl-options="{
					'dots': false,
					'loop': false,
					'responsive': {
						'576': {
							'items': 2
						},
						'992': {
							'items': 3
						}
					}
				}">
            <div class="info-box info-box-icon-left">
                <i class="fas fa-truck-fast"></i>

                <div class="info-box-content">
                    <h4>MIỄN PHÍ GIAO HÀNG</h4>
                    <p class="text-body">Miễn phí giao hàng trên toàn quốc.</p>
                </div>
            </div>

            <div class="info-box info-box-icon-left">
                <i class="fas fa-rotate-left"></i>

                <div class="info-box-content">
                    <h4>HOÀN TRẢ ĐƠN HÀNG</h4>
                    <p class="text-body">Hoàn lại 100% số tiền đơn hàng.</p>
                </div>
            </div>

            <div class="info-box info-box-icon-left">
                <i class="fas fa-headset"></i>

                <div class="info-box-content">
                    <h4>HỖ TRỢ 24/7</h4>
                    <p class="text-body">Chúng tôi làm việc 24/7.</p>
                </div>
            </div>
        </div>
    </div>

    <section class="featured-products-section">
        <div class="container">
            <h2 class="section-title">Sản Phẩm Giảm Giá</h2>

            <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center" data-owl-options="{
						'dots': false,
						'nav': true
					}">
                <?php foreach ($ManhDev->get_list("SELECT * FROM `product` WHERE `codeCategory` != 'thiet-bi-dj' AND `label` = 'SALE' ORDER BY `id` DESC ") as $productNew) : ?>
                    <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                        <figure>
                            <a href="/g/product/<?= $productNew['code']; ?>">
                                <img src="<?= $productNew['image']; ?>" width="280" height="280" alt="product">
                                <img src="<?= $ManhDev->get_row("SELECT * FROM `images` WHERE `code` = '" . $productNew['code'] . "' ORDER BY `id` ASC LIMIT 1 ")['path']; ?>" width="280" height="280" alt="product">
                            </a>
                            <div class="label-group">
                                <?php if ($productNew['label']) { ?>
                                    <div class="product-label label-sale"><?= strtoupper($productNew['label']); ?></div>
                                <?php } ?>
                                <?php if ($productNew['discount'] > 0) { ?>
                                    <div class="product-label label-sale">-<?= numbers_format($productNew['discount']); ?>%</div>
                                <?php } ?>
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="/g/category/<?= $ManhDev->get_row("SELECT * FROM `category` WHERE `code` = '" . $productNew['codeCategory'] . "' ")['code']; ?>" class="product-category"><?= $ManhDev->get_row("SELECT * FROM `category` WHERE `code` = '" . $productNew['codeCategory'] . "' ")['name']; ?></a>
                            </div>
                            <h3 class="product-title">
                                <a href="/g/product/<?= $productNew['code']; ?>"><?= $productNew['name']; ?></a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                            </div>
                            <?php
                            if (strlen($productNew['discount']) == 1) {
                                $lai = "0.00" . $productNew['discount'];
                            } else {
                                $lai = "0.0" . $productNew['discount'];
                            }
                            $tinhLai = $productNew['price'] * $lai;
                            $tongTien = $productNew['price'] + $tinhLai; ?>
                            <div class="price-box">
                                <?php if ($productNew['discount'] > 0) { ?>
                                    <del class="old-price"><?= numbers_format($tongTien); ?>đ</del>
                                <?php } ?>
                                <span class="product-price"><?= numbers_format($productNew['price']); ?>đ</span>
                            </div>

                            <div class="product-action">
                                <a onclick="addCart('<?= $productNew['id']; ?>')" class="btn-icon btn-add-cart"><i class="fa fa-arrow-right"></i><span> Thêm Vào Giỏ</span></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="featured-products-section">
        <div class="container">
            <h2 class="section-title">Sản Phẩm Giảm Giá</h2>

            <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center" data-owl-options="{
						'dots': false,
						'nav': true
					}">
                <?php foreach ($ManhDev->get_list("SELECT * FROM `product` WHERE `codeCategory` != 'thiet-bi-dj' AND `label` = 'SALE' ORDER BY `id` ASC ") as $productNew) : ?>
                    <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                        <figure>
                            <a href="/g/product/<?= $productNew['code']; ?>">
                                <img src="<?= $productNew['image']; ?>" width="280" height="280" alt="product">
                                <img src="<?= $ManhDev->get_row("SELECT * FROM `images` WHERE `code` = '" . $productNew['code'] . "' ORDER BY `id` ASC LIMIT 1 ")['path']; ?>" width="280" height="280" alt="product">
                            </a>
                            <div class="label-group">
                                <?php if ($productNew['label']) { ?>
                                    <div class="product-label label-hot"><?= strtoupper($productNew['label']); ?></div>
                                <?php } ?>
                                <?php if ($productNew['discount'] > 0) { ?>
                                    <div class="product-label label-sale">-<?= numbers_format($productNew['discount']); ?>%</div>
                                <?php } ?>
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="/g/category/<?= $ManhDev->get_row("SELECT * FROM `category` WHERE `code` = '" . $productNew['codeCategory'] . "' ")['code']; ?>" class="product-category"><?= $ManhDev->get_row("SELECT * FROM `category` WHERE `code` = '" . $productNew['codeCategory'] . "' ")['name']; ?></a>
                            </div>
                            <h3 class="product-title">
                                <a href="/g/product/<?= $productNew['code']; ?>"><?= $productNew['name']; ?></a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                            </div>
                            <?php
                            if (strlen($productNew['discount']) == 1) {
                                $lai = "0.00" . $productNew['discount'];
                            } else {
                                $lai = "0.0" . $productNew['discount'];
                            }
                            $tinhLai = $productNew['price'] * $lai;
                            $tongTien = $productNew['price'] + $tinhLai; ?>
                            <div class="price-box">
                                <?php if ($productNew['discount'] > 0) { ?>
                                    <del class="old-price"><?= numbers_format($tongTien); ?>đ</del>
                                <?php } ?>
                                <span class="product-price"><?= numbers_format($productNew['price']); ?>đ</span>
                            </div>

                            <div class="product-action">
                                <a onclick="addCart('<?= $productNew['id']; ?>')" class="btn-icon btn-add-cart"><i class="fa fa-arrow-right"></i><span> Thêm Vào Giỏ</span></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="featured-products-section">
        <div class="container">
            <h2 class="section-title">Danh Sách Sản Phẩm</h2>

            <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center" data-owl-options="{
						'dots': false,
						'nav': true
					}">
                <?php foreach ($ManhDev->get_list("SELECT * FROM `product` WHERE `codeCategory` != 'thiet-bi-dj' ORDER BY `id` ASC LIMIT 1000 ") as $productNew) : ?>
                    <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                        <figure>
                            <a href="/g/product/<?= $productNew['code']; ?>">
                                <img src="<?= $productNew['image']; ?>" width="280" height="280" alt="product">
                                <img src="<?= $ManhDev->get_row("SELECT * FROM `images` WHERE `code` = '" . $productNew['code'] . "' ORDER BY `id` ASC LIMIT 1 ")['path']; ?>" width="280" height="280" alt="product">
                            </a>
                            <div class="label-group">
                                <?php if ($productNew['label']) { ?>
                                    <div class="product-label label-hot"><?= strtoupper($productNew['label']); ?></div>
                                <?php } ?>
                                <?php if ($productNew['discount'] > 0) { ?>
                                    <div class="product-label label-sale">-<?= numbers_format($productNew['discount']); ?>%</div>
                                <?php } ?>
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="/g/category/<?= $ManhDev->get_row("SELECT * FROM `category` WHERE `code` = '" . $productNew['codeCategory'] . "' ")['code']; ?>" class="product-category"><?= $ManhDev->get_row("SELECT * FROM `category` WHERE `code` = '" . $productNew['codeCategory'] . "' ")['name']; ?></a>
                            </div>
                            <h3 class="product-title">
                                <a href="/g/product/<?= $productNew['code']; ?>"><?= $productNew['name']; ?></a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                            </div>
                            <?php
                            if (strlen($productNew['discount']) == 1) {
                                $lai = "0.00" . $productNew['discount'];
                            } else {
                                $lai = "0.0" . $productNew['discount'];
                            }
                            $tinhLai = $productNew['price'] * $lai;
                            $tongTien = $productNew['price'] + $tinhLai; ?>
                            <div class="price-box">
                                <?php if ($productNew['discount'] > 0) { ?>
                                    <del class="old-price"><?= numbers_format($tongTien); ?>đ</del>
                                <?php } ?>
                                <span class="product-price"><?= numbers_format($productNew['price']); ?>đ</span>
                            </div>

                            <div class="product-action">
                                <a onclick="addCart('<?= $productNew['id']; ?>')" class="btn-icon btn-add-cart"><i class="fa fa-arrow-right"></i><span> Thêm Vào Giỏ</span></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="feature-boxes-container">
        <div class="container appear-animate" data-animation-name="fadeInUpShorter">
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-box px-sm-5 feature-box-simple text-center">
                        <div class="feature-box-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div class="feature-box-content p-0">
                            <h3>Đội Ngũ Hỗ Trợ</h3>
                            <p>Chúng tôi thực sự quan tâm đến khách hàng khi mua hàng hoặc bất kỳ chủ đề nào khác từ chúng tôi, bạn nhận được hỗ trợ miễn phí 100%.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-box px-sm-5 feature-box-simple text-center">
                        <div class="feature-box-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>

                        <div class="feature-box-content p-0">
                            <h3>Thanh toán</h3>
                            <p>Chúng tôi chấp nhận tất cả các phương thức thanh toán mà bạn có khi bạn mua hàng tại website và tại cửa hàng.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-box px-sm-5 feature-box-simple text-center">
                        <div class="feature-box-icon">
                            <i class="fas fa-arrow-rotate-left"></i>
                        </div>
                        <div class="feature-box-content p-0">
                            <h3>HOÀN ĐƠN</h3>
                            <p>Với các đơn hàng đã mua, bạn có thể hoàn đơn lại sau 7 ngày tính từ ngày nhận hàng và nhận lại 100% giá trị của sản phẩm.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="promo-section bg-dark" data-parallax="{'speed': 2, 'enableOnMobile': true}" data-image-src="assets/images/demoes/demo4/banners/banner-5.jpg">
        <div class="promo-banner banner container text-uppercase">
            <div class="banner-content row align-items-center text-center">
                <div class="col-md-4 ml-xl-auto text-md-right appear-animate" data-animation-name="fadeInRightShorter" data-animation-delay="600">
                    <h2 class="mb-md-0 text-white">SẢN PHẨM ĐẠT TOP<br>GIẢM GIÁ</h2>
                </div>
                <div class="col-md-4 col-xl-3 pb-4 pb-md-0 appear-animate" data-animation-name="fadeIn" data-animation-delay="300">
                    <a href="category.html" class="btn btn-dark btn-black ls-10">Xem Ngay</a>
                </div>
                <div class="col-md-4 mr-xl-auto text-md-left appear-animate" data-animation-name="fadeInLeftShorter" data-animation-delay="600">
                    <h4 class="mb-1 mt-1 font1 coupon-sale-text p-0 d-block ls-n-10 text-transform-none">
                        <b>Mã Giảm Giá</b>
                    </h4>
                    <h5 class="mb-1 coupon-sale-text text-white ls-10 p-0"><i class="ls-0">UP TO</i><b class="text-white bg-secondary ls-n-10">500.000đ</b></h5>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-section pb-0">
        <div class="container">
            <h2 class="section-title heading-border border-0 appear-animate" data-animation-name="fadeInUp">TIN TỨC</h2>

            <div class="owl-carousel owl-theme appear-animate" data-animation-name="fadeIn" data-owl-options="{
						'loop': false,
						'margin': 20,
						'autoHeight': true,
						'autoplay': false,
						'dots': false,
						'items': 2,
						'responsive': {
							'0': {
								'items': 1
							},
							'480': {
								'items': 2
							},
							'576': {
								'items': 3
							},
							'768': {
								'items': 4
							}
						}
					}">
                <?php foreach ($ManhDev->get_list("SELECT * FROM `news` WHERE `status` = '1' ORDER BY `id` DESC LIMIT 4 ") as $news) : ?>
                    <article class="post mb-3">
                        <div class="post-media" style="overflow: hidden; height: 180px; border-top-right-radius: 5px; border-top-left-radius: 5px; background: white">
                            <a href="/g/tin-tuc/<?= $news['code']; ?>">
                                <img src="<?= $news['image']; ?>" alt="<?= $news['name']; ?>">
                            </a>
                        </div>
                        <div class="post-bd">
                            <a href="/g/tin-tuc/<?= $news['code']; ?>" class="title-post"><?= $news['title']; ?></a>
                        </div>
                        <div class="post-date">
                            <div><i class="fas fa-eye"></i> <?= numbers_format($news['view']); ?></div>
                            <div><i class="fas fa-clock"></i> <?= tachTime($news['time']); ?></div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <hr class="mt-0 m-b-5">

            <div class="brands-slider owl-carousel owl-theme images-center appear-animate" data-animation-name="fadeIn" data-animation-duration="500" data-owl-options="{
					'margin': 0}">
                <img src="/images/dienmayxanh.jpg" style="width: 130px; height: 70px; border-radius: 5px;" alt="Điện Máy Xanh">
                <img src="/images/thegioididong.png" style="width: 130px; height: 70px; border-radius: 5px;" alt="Thế Giới Di Động">
                <img src="/images/cellphoneS.jpg" style="width: 130px; height: 70px; border-radius: 5px;" alt="Cell Phone S">
                <img src="/images/hoanghamobile.jpg" style="width: 130px; height: 70px; border-radius: 5px;" alt="Hoàng Hà Mobile">
                <img src="/images/phongVu.png" style="width: 130px; height: 70px; border-radius: 5px;" alt="Hoàng Hà Mobile">
                <img src="/images/viettelstore.png" style="width: 130px; height: 70px; border-radius: 5px;" alt="Viettel Store">
            </div>

            <hr class="mt-4 m-b-5">
        </div>
    </section>
</main>
<?php $checkNewsletterEmail = $ManhDev->get_row("SELECT * FROM `newsletterEmail` WHERE `username` = '".($_SESSION['username'] ?? getip())."' "); 
if(!$checkNewsletterEmail) { ?>
?>
<div class="newsletter-popup mfp-hide bg-img" id="newsletter-popup-form" style="background: #f1f1f1 no-repeat center/cover url(images/newsletter_popup_bg.jpg)">
    <div class="newsletter-popup-content">
        <img src="/images/logo GHT.png" width="111" height="44" alt="Logo" class="logo-newsletter">
        <h2>Đăng Ký Nhận Thông Báo</h2>

        <p id="notification">Đăng ký Email để nhận các tin tức và ưu đãi mới nhất từ chúng tôi</p>

        <form class="form" submit-ajax="true" action="/api/client" method="POST" url_redirect="" swal="" time_load="1500">
            <input type="hidden" name="type" value="subscribe">
            <div class="input-group">
                <input type="email" class="form-control" name="newsletter-email" placeholder="Nhập email của bạn" required="">
                <input type="submit" class="btn btn-primary" value="Đăng Ký">
            </div>
        </form>
        <div class="newsletter-subscribe">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" value="0" id="show-again">
                <label for="show-again" class="custom-control-label">Không Hiển Thị Lại</label>
            </div>
        </div>
    </div>

    <button title="Đóng Modal" type="button" class="mfp-close">
        ×
    </button>
</div>
<?php } ?>