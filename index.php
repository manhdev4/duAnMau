<?php require("include/head.php"); ?>
<?php require("include/nav.php"); ?>

<section class="slider_section slider_s_two mb-60 mt-20">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 offset-lg-3 col-md-12">
                <div class="swiper-container gallery-top">
                    <div class="slider_area swiper-wrapper">
                        <div class="single_slider swiper-slide d-flex align-items-center" data-bgimg="/images/slider5.jpg"></div>
                        <div class="single_slider swiper-slide d-flex align-items-center" data-bgimg="/images/slider6.jpg"></div>
                        <div class="single_slider swiper-slide d-flex align-items-center" data-bgimg="/images/slider7.jpg"></div>
                        <div class="single_slider swiper-slide d-flex align-items-center" data-bgimg="/images/slider8.jpg"></div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <div class="swiper-container gallery-thumbs"></div>
            </div>
        </div>
    </div>
</section>

<div class="shipping_area mb-60">
    <div class="container">
        <div class="shipping_inner">
            <div class="single_shipping">
                <div class="shipping_icone">
                    <img src="images/shipping1.png" alt="">
                </div>
                <div class="shipping_content">
                    <h4>Miễn phí giao hàng</h4>
                    <p>Miễn phí giao hàng trong nước</p>
                </div>
            </div>
            <div class="single_shipping">
                <div class="shipping_icone">
                    <img src="images/shipping2.png" alt="">
                </div>
                <div class="shipping_content">
                    <h4>Thanh toán</h4>
                    <p>Chấp nhận tất cả phương thức</p>
                </div>
            </div>
            <div class="single_shipping">
                <div class="shipping_icone">
                    <img src="images/shipping3.png" alt="">
                </div>
                <div class="shipping_content">
                    <h4>Trả góp</h4>
                    <p>Hỗ trợ mua trả góp 0đ</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="home_section_bg">
    <div class="banner_area mb-55">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <figure class="single_banner">
                        <div class="banner_thumb">
                            <a href="shop.html"><img src="images/banner1.jpg" alt=""></a>
                        </div>
                    </figure>
                </div>
                <div class="col-lg-6 col-md-6">
                    <figure class="single_banner">
                        <div class="banner_thumb">
                            <a href="shop.html"><img src="images/banner2.jpg" alt=""></a>
                        </div>
                    </figure>
                </div>
            </div>
        </div>
    </div>

    <?php foreach($ManhDev->get_list("SELECT * FROM `categories` ORDER BY `id` DESC ") as $categorie): ?>
    <div class="product_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product_header">
                        <div class="section_title">
                            <h2><?=$categorie['name'];?></h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product_carousel product_style product_column5 owl-carousel">
            <?php foreach($ManhDev->get_list("SELECT * FROM `product` WHERE `codeCate` = '".$categorie['code']."' ORDER BY `id` DESC ") as $product): ?>
                <article class="single_product">
                    <figure onclick="href('/pages/product.php?code=<?=$product['code'];?>')">
                        <div class="product_thumb">
                            <a class="primary_img"><img src="<?=$product['image'];?>" alt=""></a>
                            <?php foreach($ManhDev->get_list("SELECT * FROM `images` WHERE `code` = '".$product['code']."' ORDER BY `id` DESC ") as $images): ?>
                            <a class="secondary_img"><img src="<?=$images['path'];?>" alt="<?=$product['name'];?>"></a>
                            <?php endforeach; ?>
                            <div class="label_product">
                                <span class="label_new">New</span>
                            </div>
                        </div>
                        <div class="product_content">
                            <div class="product_content_inner">
                                <h4 class="product_name"><a><?=$product['name'];?></a></h4>
                                <div class="price_box">
                                    <span class="old_price"><?=tien($product['money']);?>đ</span>
                                    <span class="current_price"><?=tien($product['money']);?>đ</span>
                                </div>
                            </div>
                            <div class="add_to_cart">
                                <button type="button" onclick="addCart();" title="Thêm Vào Giỏ">Thêm Vào Giỏ</button>
                            </div>
                        </div>
                    </figure>
                </article>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    
    <!--banner area start-->
    <div class="banner_area banner_style2 mb-55">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <figure class="single_banner">
                        <div class="banner_thumb">
                            <a href="shop.html"><img src="/images/banner3.jpg" alt=""></a>
                        </div>
                    </figure>
                </div>
                <div class="col-lg-6 col-md-6">
                    <figure class="single_banner">
                        <div class="banner_thumb">
                            <a href="shop.html"><img src="/images/banner3.jpg" alt=""></a>
                        </div>
                    </figure>
                </div>
                <div class="col-lg-3 col-md-3">
                    <figure class="single_banner">
                        <div class="banner_thumb">
                            <a href="shop.html"><img src="images/banner8.jpg" alt=""></a>
                        </div>
                    </figure>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require("include/foot.php"); ?>