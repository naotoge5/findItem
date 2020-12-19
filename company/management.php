<?php
include('../assets/functions.php');
include('../assets/table.php');
$company = new CompanyTable();
$company->id = $_SESSION['id'];
$company->getOne();
if ($company) {
    $objects = ObjectTable::readObjectList($company);
} else {
    header('Location:authentication/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>管理画面</title>

    <!-- style -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <!-- script -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/company.js"></script>
</head>

<body>
    <?php include("../assets/_inc/header.php") ?>
    <div class="my-4 py-4">&nbsp;</div>
    <main id="management">
        <div class="container">
            <div class="card">
                <h3 class="card-header"><?= h($company->name) ?></h3>
                <div class="card-body d-none d-sm-block">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="mb-0 card-title">住所</h5>
                            <p class="card-text">〒&nbsp;<?= h($company['postal']) . "<br>" . h($company['prefecture']) . h($company['city']) . h($company['town']) ?>
                            </p>
                            <h5 class="mb-0 card-title">電話番号</h5>
                            <p class="card-text">TEL：<a href="tel:<?= str_replace('-', '', h($company['tel'])) ?>"><?= h($company['tel']) ?></a>
                            </p>
                        </div>
                        <div class="col-6">
                            <h5 class="mb-0 card-title ">営業時間等</h5>
                            <textarea name="details" class="w-100 form-control" placeholder="営業時間、電話受付可能時間等"><?= h($company['details']); ?></textarea>
                            <button id="update" type="button" class="btn btn-success btn-sm mt-2">更新</button>
                        </div>
                    </div>
                    <iframe class="mt-2 " width="100%" height="100%" src=" https://maps.google.co.jp/maps?output=embed&q=<?= h($company['name']) ?>"></iframe>
                </div>
                <div class="card-body d-block d-sm-none">
                    <p class="card-text">
                        この画面ではご利用になれません
                    </p>
                </div>
            </div>
            <div class="card my-4 d-none d-sm-block">
                <div class="card-header">
                    <h4 class="card-title mb-0 d-inline"> 拾得物一覧 ／ </h4>
                    <h4 class="d-inline"><a href="register.php" class="text-decoration-none text-primary">新規追加</a>
                    </h4>
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
                                    <tr class="edit list-group-item-action" data-href="register.php?id=<?= h($object['id']) ?>">
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
    <?php include('../assets/_inc/footer.php') ?>
</body>

</html>