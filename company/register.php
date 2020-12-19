<?php
include('../assets/functions.php');
if (!isset($_SESSION['id'])) {
    header('Location:authentication/login.php');
    exit;
}
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$object = $id ? readObjectData($id) : 0;
$datetime = $object ? explode(' ', $object['datetime']) : 0;

$title = $id ? '編集' : '新規登録';
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title><?= $title ?></title>
    <!-- style -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css">
    <!-- script -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/ja.js"></script>
    <script src="../assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="../assets/js/company.js"></script>
</head>

<body>
    <?php include("../assets/_inc/header.php") ?>
    <div class="my-4 py-4">&nbsp;</div>
    <main id="register">
        <div class="container">
            <div class="card my-4">
                <h3 class="card-header"><?= $title ?></h3>
                <div class="card-body d-none d-sm-block">
                    <form action="update.php" method="POST">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <div class="form-group">
                            <label>名前</label>
                            <input type="text" name="name" class="form-control" placeholder="落とし物名を入力してください" size="25" maxlength="100" value="<?php if ($object) echo h($object['name']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label>詳細</label>
                            <textarea name="details" class="form-control" placeholder="落し物の詳細を入力してください" rows="4" cols="60"><?php if ($object) echo h($object['details']); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>カテゴリー</label>
                            <select name="category" class="form-control" required>
                                <?php if (!$object) : ?>
                                    <option disabled selected value>未選択</option>
                                <?php endif; ?>
                                <?php foreach ($categories as $category) : ?>
                                    <?php if ($category == $object['category']) : ?>
                                        <option selected="selected" value="<?= $category ?>"><?= $category ?></option>
                                    <?php else : ?>
                                        <option value="<?= $category; ?>"><?= $category; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label>発見時刻</label>
                                <div class="input-group date" id="date">
                                    <label for="date" class="pr-2 pt-1">日付</label>
                                    <input type="text" name="date" class="form-control rounded-left" value="<?php if ($object) echo h($datetime[0]); ?>" required />
                                    <span class="input-group-append ">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>&nbsp;</label>
                                <div class="input-group date" id="time">
                                    <label for="time" class="pr-2 pt-1">時間</label>
                                    <input type="text" name="time" class="form-control rounded-left" value="<?php if ($object) echo h($datetime[1]); ?>" required />
                                    <span class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="<?php if ($id) echo '更新';
                                                                                else echo '登録' ?>">
                            <?php if ($id) : ?>
                                <input type="button" id="delete" class="btn btn-danger" value="削除">
                            <?php endif; ?>
                        </div>
                    </form>
                    <form method="POST" name="delete" action="delete.php" class="mb-0">
                        <input type="hidden" name="id" value="<?= $id ?>">
                    </form>
                </div>
                <div class="card-body d-block d-sm-none">
                    <p class="card-text">
                        この画面ではご利用になれません
                    </p>
                </div>
            </div>
        </div>
    </main>
    <?php include('../assets/_inc/footer.php') ?>
</body>

</html>