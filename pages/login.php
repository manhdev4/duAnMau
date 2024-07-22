<?php require("../include/head.php"); ?>
<?php require("../include/nav.php"); ?>

<div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="index.html">home</a></li>
                            <li>My account</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="login_page_bg">
        <div class="container">
            <div class="customer_login">
                <div class="row">
                    <!--login area start-->
                    <div class="col-lg-6 col-md-6">
                        <div class="account_form login">
                            <h2>login</h2>
                            <form action="#">
                                <p>
                                    <label>Tài Khoản & Email <span>*</span></label>
                                    <input type="text">
                                </p>
                                <p>
                                    <label>Passwords <span>*</span></label>
                                    <input type="password">
                                </p>
                                <div class="login_submit">
                                    <a href="#">Lost your password?</a>
                                    <label for="remember">
                                        <input id="remember" type="checkbox">
                                        Remember me
                                    </label>
                                    <button type="submit">login</button>

                                </div>

                            </form>
                        </div>
                    </div>
                    <!--login area start-->

                    <!--register area start-->
                    <div class="col-lg-6 col-md-6">
                        <div class="account_form register">
                            <h2>Register</h2>
                            <form action="#">
                                <p>
                                    <label>Email address <span>*</span></label>
                                    <input type="text">
                                </p>
                                <p>
                                    <label>Passwords <span>*</span></label>
                                    <input type="password">
                                </p>
                                <div class="login_submit">
                                    <button type="submit">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--register area end-->
                </div>
            </div>
        </div>
    </div>
<?php require("../include/foot.php"); ?>