<title><?= $website['login']; ?></title>
<?php if(isset($_SESSION['username'])) { die('<script>location.href="/g"</script>'); } ?>
<main class="main">
    <div class="page-header">
        <div class="container d-flex flex-column">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Trang Chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Đăng Nhập</li>
                    </ol>
                </div>
            </nav>
        </div>
    </div>

    <div class="container login-container mt-3">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading mb-1">
                            <h2 class="title text-center">Đăng Nhập Tài Khoản</h2>
                        </div>

                        <form class="form" submit-ajax="true" action="/api/client" method="POST" url_redirect="/" swal="none" time_load="0">
                            <input type="hidden" name="type" value="login">
                            <div id="notification"></div>
                            <div class="form-group">
                                <label for="login-email">
                                    Tài khoản hoặc Email
                                    <span class="required">*</span>
                                </label>
                                <input type="text" class="form-input form-wide" name="username" placeholder="Nhập tài khoản hoặc email" required="">
                            </div>
                            <div class="form-group">
                                <label for="login-password">
                                    Password
                                    <span class="required">*</span>
                                </label>
                                <input type="password" class="form-input form-wide" name="password" required="">
                            </div>
                            <div class="manhdev-footer">
                                <a href="/g/forgot-password" class="forget-password text-right text-dark form-footer-right">Quên mật khẩu?</a>
                            </div>
                            <button type="submit" class="btn btn-dark btn-md w-100">Đăng Nhập</button>
                            <br>
                            <p class="mt-3 text-center">Bạn chưa có tài khoản? <a href="/g/dang-ky">Đăng Ký Ngay</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>