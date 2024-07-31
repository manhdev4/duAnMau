<?php $checkNew = $ManhDev->get_row("SELECT * FROM `news` WHERE `code` = '" . $code . "' ");
if (!$checkNew) {
    die(href("/"));
}

$ManhDev->update("news", [
    "view" => $checkNew['view'] + 1
], " `id` = '" . $checkNew['id'] . "' ");
?>
<title><?= $ManhDev->site("nameWeb"); ?> - <?= $checkNew['title']; ?></title>
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="/g/tin-tuc">Tin Tức</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $checkNew['title']; ?></li>
            </ol>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <article class="single">
                    <div class="post-title">
                        <?= $checkNew['title']; ?>
                    </div>

                    <div class="post-media">
                        <img src="<?= $checkNew['image']; ?>" alt="Post">
                    </div>

                    <div class="post-body">
                        <div class="post-ManhDev">
                            <?= $checkNew['content']; ?>
                        </div>

                        <div class="post-share">
                            <h3 class="d-flex align-items-center">
                                <i class="fas fa-share"></i>
                                Chia Sẻ Bài Viết
                            </h3>

                            <div class="social-icons">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $base_url; ?>g/tin-tuc/<?= $checkNew['code']; ?>" class="social-icon social-facebook" target="_blank" title="Facebook">
                                    <i class="fab fa-facebook"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url=<?= $base_url; ?>g/tin-tuc/<?= $checkNew['code']; ?>" class="social-icon social-twitter" target="_blank" title="Twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://www.instagram.com/?url=<?= $base_url; ?>g/tin-tuc/<?= $checkNew['code']; ?>" class="social-icon social-linkedin" target="_blank" title="Linkedin">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>

                <hr class="mt-2 mb-1">

                <div class="related-posts">
                    <h4>Bài Viết <strong>Khác</strong></h4>

                    <div class="owl-carousel owl-theme related-posts-carousel owl-loaded owl-drag" data-owl-options="{
								'dots': false
							}">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                                <?php foreach ($ManhDev->get_list("SELECT * FROM `news` WHERE `status` = '1' AND `code` != '" . $checkNew['code'] . "' ORDER BY `id` DESC LIMIT 3 ") as $news) : ?>
                                    <div class="owl-item active" style="width: 211.5px; margin-right: 30px;">
                                        <article class="post">
                                            <div class="post-media zoom-effect">
                                                <a href="/g/tin-tuc/<?= $news['code']; ?>">
                                                    <img src="<?= $news['image']; ?>" alt="<?= $news['title']; ?>">
                                                </a>
                                            </div>
                                            <div class="post-bd">
                                                <h2 class="post-title">
                                                    <a href="/g/tin-tuc/<?= $news['code']; ?>"><?= $news['title']; ?></a>
                                                </h2>

                                                <div class="post-button">
                                                    <a href="/g/tin-tuc/<?= $news['code']; ?>" class="read-more">Xem Ngay <i class="fas fa-angle-right"></i></a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="owl-dots disabled"></div>
                    </div>
                </div>
            </div>
            <div class="sidebar-overlay"></div>
            <aside class="sidebar mobile-sidebar col-lg-3">
                <div class="sidebar-wrapper" data-sticky-sidebar-options="{&quot;offsetTop&quot;: 72}">
                    <div class="widget">
                        <h4 class="widget-title">Bài Viết Truy Cập Nhiều Nhất</h4>

                        <ul class="simple-post-list">
                            <?php foreach ($ManhDev->get_list("SELECT * FROM `news` WHERE `status` = '1' AND `code` != '" . $checkNew['code'] . "' ORDER BY `view` ASC LIMIT 10 ") as $newsView) : ?>
                                <li>
                                    <div class="post-media">
                                        <a href="/g/tin-tuc/<?= $newsView['code']; ?>">
                                            <img src="<?= $newsView['image']; ?>" alt="<?= $newsView['title']; ?>">
                                        </a>
                                    </div>
                                    <div class="post-info">
                                        <a href="/g/tin-tuc/<?= $newsView['code']; ?>" class="gioihan-1" style="text-decoration: none;"><?= $newsView['title']; ?></a>
                                        <div class="post-meta">
                                            <?= tachTime($newsView['time']); ?>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</main>