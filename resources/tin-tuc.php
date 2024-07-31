<title><?= $website['news']; ?></title>
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Tin Tức</li>
            </ol>
        </div>
    </nav>

    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <div class="blog-section row">
                    <div class="col-lg-12">
                        <h2 class="section-title">TIN TỨC</h2>
                    </div>
                    <?php foreach ($ManhDev->get_list("SELECT * FROM `news` ORDER BY `id` DESC ") as $news) : ?>
                        <div class="col-md-3 col-lg-3">
                            <article class="post">
                                <div class="post-media" style="overflow: hidden; height: 180px; border-top-right-radius: 5px; border-top-left-radius: 5px; background: white">
                                    <a href="/g/tin-tuc/<?= $news['code']; ?>">
                                        <img src="<?= $news['image']; ?>" alt="Post" width="225" height="280">
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
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</main>