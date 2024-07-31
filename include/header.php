<header class="header">
            <div class="header-top">
                <div class="container">
                    <div class="header-left d-none d-sm-block">
                        <p class="top-message text-uppercase">Miễn phí giao hàng toàn quốc</p>
                    </div>

                    <div class="header-right header-dropdowns ml-0 ml-sm-auto w-sm-100">
                        <span class="separator"></span>
                        <div class="header-dropdown">
                            <a><i class="flag-vn flag"></i> VN</a>
                            <div class="header-menu">
                                <ul>
                                    <li>
                                        <a onclick="changeFlag()"><i class="flag-us flag mr-2"></i> US</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <span class="separator"></span>
                        <div class="social-icons">
                            <a href="" class="social-icon social-facebook fab fa-facebook" target="_blank"></a>
                            <a href="" class="social-icon social-twitter fab fa-twitter" target="_blank"></a>
                            <a href="" class="social-icon social-instagram fab fa-instagram" target="_blank"></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header-middle sticky-header" data-sticky-options="{'mobile': true}">
                <div class="container">
                    <div class="header-left col-lg-2 w-auto pl-0">
                        <button class="mobile-menu-toggler text-primary mr-2" type="button">
							<i class="fas fa-bars"></i>
						</button>
                        <a href="/" class="logo">
                            <img src="/images/logo GHT.png" style="height: 30px; margin-top: 10px" alt="Logo">
                        </a>
                    </div>

                    <div class="header-right w-lg-max">
                        <div class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mt-0">
                            <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
                            <form action="/g/search/" method="GET">
                                <div class="header-search-wrapper">
                                    <input type="search" class="form-control" name="q" id="q" placeholder="Tìm kiếm danh mục, sản phẩm..." required="">
                                    <button class="btn fas fa-search" title="search" type="submit"></button>
                                </div>
                            </form>
                        </div>

                        <div class="header-contact d-none d-lg-flex pl-4 pr-4">
                            <img alt="IconPhone" src="/images/phone.png" width="30" height="30" class="pb-1">
                            <h6><span>Liên Hệ Hỗ Trợ</span><a href="tel:0333293290" class="text-dark font1">0333293290</a></h6>
                        </div>

                        <a href="/g/thong-tin-tai-khoan" class="header-icon" title="Tài Khoản"><i class="far fa-user" style="margin-top: 4px"></i></a>
                        <?php $total_cart = $ManhDev->get_row("SELECT COUNT(*) FROM `cart` WHERE `username` = '".($ManhDev->users('username') ?? getip())."' ")['COUNT(*)']; ?>
                        <div class="dropdown cart-dropdown">
                            <a href="#" title="Giỏ Hàng" class="dropdown-toggle cart-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                            <i class="far fa-basket-shopping"></i>
                                <span class="cart-count badge-circle"><?=numbers_format($total_cart);?></span>
                            </a>

                            <div class="cart-overlay"></div>

                            <div class="dropdown-menu mobile-cart">
                                <a href="#" title="Đóng Giỏ Hàng" class="btn-close">×</a>

                                <div class="dropdownmenu-wrapper custom-scrollbar">
                                    <div class="dropdown-cart-header">Giỏ Hàng</div>
                                    <div class="dropdown-cart-products">
                                        <?php $tongTien = 0;
                                        foreach($ManhDev->get_list("SELECT * FROM `cart` WHERE `username` = '".($ManhDev->users('username') ?? getip())."' ") as $cart):
                                        $productCart = $ManhDev->get_row("SELECT * FROM `product` WHERE `code` = '" . $cart['codeProduct'] . "' "); 
                                        $tinhTien = $cart['amount'] * $productCart['price'];
                                        $tongTien += $tinhTien;
                                        ?>
                                        <div class="product">
                                            <div class="product-details">
                                                <h4 class="product-title">
                                                    <a href="/g/product/<?=$productCart['code'];?>"><?=$productCart['name'];?></a>
                                                </h4>

                                                <span class="cart-product-info">
													<span class="cart-product-qty"><?=numbers_format($cart['amount']);?></span> × <?=numbers_format($productCart['price']);?>đ
                                                </span>
                                            </div>
                                            
                                            <figure class="product-image-container">
                                                <a href="/g/product/<?=$productCart['code'];?>" class="product-image">
                                                    <img src="<?=$productCart['image'];?>" alt="<?=$productCart['name'];?>" width="80" height="80">
                                                </a>

                                                <a onclick="delCart('<?=$cart['id'];?>')" class="btn-remove" title="Xóa Sản Phẩm Trong Giỏ"><span>×</span></a>
                                            </figure>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <div class="dropdown-cart-total">
                                        <span>Tổng Thanh Toán:</span>
                                        <span class="cart-total-price float-right"><?=numbers_format($tongTien);?>đ</span>
                                    </div>
                                    <div class="dropdown-cart-action">
                                        <a href="/g/gio-hang" class="btn btn-gray btn-block view-cart">Xem Giỏ Hàng</a>
                                        <a href="/g/thanh-toan" class="btn btn-dark btn-block">Thanh Toán</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header-bottom sticky-header d-none d-lg-block" data-sticky-options="{'mobile': false}">
                <div class="container">
                    <nav class="main-nav w-100">
                        <ul class="menu">
                            <?php foreach($ManhDev->get_list("SELECT * FROM `category` WHERE `status` = '1' ORDER BY `id` ASC LIMIT 10") as $category): ?>
                            <li><a href="/g/category/<?=$category['code'];?>"><?=$category['name'];?></a></li>
                            <?php endforeach; ?>
                            <li class="float-right"><a href="/g/hoi-dap" rel="noopener" class="pl-5" target="_blank">Hỏi Đáp</a></li>
                            <li class="float-right"><a href="/g/tin-tuc" class="pl-5">Tin Tức</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>