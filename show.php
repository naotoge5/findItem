<?php
include("assets/functions.php");
$id = isset($_GET['id']) ? $_GET['id'] : 0;
if ($id) {
    $company = readCompanyData($id);
    $objects = readObjectList($id);
} else {
    header('Location:index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>落とし物検索システム-企業情報</title>

    <!-- style -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <!-- script -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/public.js"></script>
</head>

<body>
    <?php include("assets/_inc/header.php") ?>
    <div class="my-4 py-4">&nbsp;</div>
    <main id="show">
        <div class="container">
            <div class="card">
                <h3 class="card-header"><?= h($company['name']) ?></h3>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <h5 class="mb-0 card-title">住所</h5>
                            <p class="card-text mb-0">〒&nbsp;<?= h($company['postal']) . "<br>" . h($company['prefecture']) . h($company['city']) . h($company['town']) ?>
                            </p>
                            <h5 class="mb-0 card-title">電話番号</h5>
                            <p class="card-text">TEL：<a href="tel:<?= str_replace('-', '', h($company['tel'])) ?>" class="card-link"><?= h($company['tel']) ?></a>
                            </p>
                        </div>
                        <div class="col-12 col-md-6">
                            <h5 class="mb-0 card-title ">営業時間等</h5>
                            <textarea name="details" class="w-100 form-control h-75" placeholder="営業時間、電話受付可能時間等" readonly><?= h($company['details']); ?></textarea>
                        </div>
                    </div>
                    <iframe class="mt-2 " width="100%" height="100%" src=" https://maps.google.co.jp/maps?output=embed&q=<?= h($company['name']) ?>"></iframe>
                </div>
            </div>
            <div class="card my-4">
                <div class="card-header">
                    <h4 class="card-title mb-0 d-inline">拾得物一覧</h4>
                </div>
                <div class="card-body">
                    <?php if ($objects) : ?>
                        <table id="objects_table" class="table w-100">
                            <thead>
                                <tr>
                                    <th>名前</th>
                                    <th>発見日時</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($objects as $object) : ?>
                                    <tr class="list-group-item-action">
                                        <td><?= h($object['name']) ?></td>
                                        <td><?= date('Y年m月d日 H時i分', strtotime(h($object['datetime']))) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <p class="mb-0">落とし物が登録されていません。</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
    <?php include('assets/_inc/footer.php') ?>
</body>

</html>