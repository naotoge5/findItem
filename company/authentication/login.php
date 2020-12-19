<?php
include('../../assets/functions.php');
unset($_SESSION['id']);
if (isset($_POST['logout'])) alert('ログアウトしました', "success");
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>ログイン ／ ご新規</title>

    <!-- css読み込み -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- 外部js読み込み -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <!-- script -->
    <script src="../../assets/js/company.js"></script>
</head>

<body>
    <?php include('../../assets/_inc/header.php') ?>
    <div class="my-4 py-4">&nbsp;</div>
    <main>
        <div class="container">
            <div class="card my-4">
                <h3 class="card-header">ログイン ／ ご新規</h3>
                <div class="card-body d-none d-sm-block">
                    <form id="login" action="check.php" method="post">
                        <div class="form-group">
                            <label>メールアドレス</label>
                            <input type="email" class="form-control" name="mail" required>
                            <small class="form-text text-warning">新規の企業様はメールアドレスを入力後、<br>送信ボタンをクリックしてください。確認のメールが送信されます。</small>
                        </div>
                        <div class="form-group">
                            <label>パスワード</label>
                            <input type="password" class="form-control" name="password">
                            <small class="form-text text-muted">パスワードを忘れた<a href="">場合</a></small>
                        </div>
                        <input type="submit" class="btn btn-success">
                        <small class="text-muted">st071959@m03.kyoto-kcg.ac.jp kittypro0201</small>
                        <small class="text-muted">10naotoge5.ykputi@gmail.com kittypro02</small>
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
    <?php include('../../assets/_inc/footer.php') ?>
</body>

</html>