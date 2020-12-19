<?php
include("assets/functions.php");
include("search.php");
/*
$companies = isset($_SESSION['data']['results']) ? $_SESSION['data']['results'] : 0;
if (!isset($_SESSION['data']['keywords'])) {
}
//unset($_SESSION['data']['results']);
//include 'assets/_inc/header.php';
$keywords = '';
foreach ($_SESSION['data']['keywords'] as $index => $keyword) {
    if ($index == count(['keywords']) + 1) {
        $keywords .= '"' . $keyword . '"';
    } else {
        $keywords .= '"' . $keyword . '"' . ' ';
    }
}
$keywords .= "に該当するデータは" . (count($companies)) . "件ありました。";
*/
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>落とし物検索システム-検索結果</title>

    <!-- style -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- script -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/public.js"></script>
</head>

<body>
    <?php include("assets/_inc/header.php") ?>
    <div class="my-4 py-4">&nbsp;</div>
    <main>
        <div class="container">
            <div class="row">
                <?php if ($companies) : ?>
                    <?php foreach ($companies as $company) : ?>
                        <div class="col-12 col-sm-6 my-2">
                            <div class="card">
                                <div class="card-header">
                                    <a href="show.php?id=<?= h($company['id']) ?>" class="card-link">
                                        <?= h($company['name']) ?>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?= h($company['details']) ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text">該当するデータがありませんでした</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <a href="index.php">検索画面に戻る</a>
        </div>
    </main>
    <?php include 'assets/_inc/footer.php' ?>
</body>

</html>