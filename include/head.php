<?php include $_SERVER['DOCUMENT_ROOT'] . "/include/database.php"; ?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="ManhDev">
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <script src="<?= BASE_URL("js/webfont.js"); ?>" async=""></script>
    <script>
        WebFontConfig = {
            google: {
                families: ['Open+Sans:300,400,600,700,800', 'Poppins:300,400,500,600,700,800', 'Oswald:300,400,500,600,700,800']
            }
        };
        (function(d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = 'js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>
    <link rel="stylesheet" href="<?= BASE_URL("css/bootstrap.min.css?" . time()); ?>">
    <link rel="stylesheet" href="<?= BASE_URL("css/demo4.min.css?" . time()); ?>">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL("css/all.min.css?" . time()); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.14/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.14/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.10/dist/clipboard.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>
    <link rel="stylesheet" href="<?= BASE_URL("css/ManhDev.css?" . time()); ?>">
</head>

<body>
    <div class="page-wrapper">
        <div class="top-notice bg-primary text-white">
            <div class="container text-center">
                <h5 class="d-inline-block">Giảm giá <b>15%</b> cho đơn hàng từ 500.000 áp dụng từ </h5>
                <a class="category">26/7</a>
                <a class="category ml-2 mr-3">31/7</a>
                <small>* Thời gian có hạn.</small>
                <button title="Đóng thông báo ngắn" type="button" class="mfp-close">×</button>
            </div>
        </div>