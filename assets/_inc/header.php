<?php
$nav = getNav($_SERVER['PHP_SELF']);
$alert = isset($_SESSION['alert']) ? $_SESSION['alert'] : 0;
unset($_SESSION['alert']);
?>
<header class="fixed-top">
    <?php if ($nav) : ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <?php foreach ($nav as $item) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $item['link'] ?>"><?= $item['name'] ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </nav>
    <?php endif; ?>
    <?php if ($alert) : ?>
        <div class="<?= $alert['class'] ?> fade show text-center mb-0" role="alert">
            <strong><?= $alert['message'] ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
</header>
<?php if ($alert and !$alert['continue']) : ?>
    <main>
        <div class="my-4 py-4">&nbsp;</div>
        <div class="container">
            <div class="card my-4">
                <div class="card-header pb-0">
                    <h3 class="card-title">読み込みエラー</h3>
                </div>
                <div class="card-body">
                    <h4 class="card-subtitle">申し訳ございません、<br>しばらくしてからもう一度お試しください。</h4>
                </div>
            </div>
        </div>
    </main>
<?php exit;
endif; ?>