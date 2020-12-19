<?php
//新規登録
include('../../assets/functions.php');

$token = isset($_GET['token']) ? $_GET['token'] : '';
$mail = readPreCompanyData($token);
if (!$mail) {
    header("Location:login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>サインアップ</title>

    <!-- style -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- script -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/company.js"></script>
</head>

<body>
    <?php include('../../assets/_inc/header.php') ?>
    <div class="my-4 py-4">&nbsp;</div>
    <main>
        <div class="container">
            <div class="card my-4">
                <h3 class="card-header">サインアップ</h3>
                <div class="card-body">
                    <div class="ml-3">
                        <form id="signup" action="create.php" method="post">
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label>企業名</label>
                                    <input type="text" name="name_first" class="form-control" placeholder="会社名,チェーン名" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>&nbsp;</label>
                                    <input type="text" name="name_second" class="form-control" placeholder="支店名,店舗名" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>電話番号</label>
                                <input type="text" name="tel" class="form-control" pattern="\d{3,4}-\d{3,4}-\d{3,4}" maxlength="13" minlength="12" placeholder="ハイフン有り,半角" required>
                            </div>
                            <div class="form-group">
                                <label>郵便番号</label>
                                <input type="text" class="form-control" pattern="\d{3}-\d{4}" maxlength="8" minlength="8" name="postal" placeholder="ハイフン有り,半角" required>
                                <input type="button" class="form-control" id="auto" value="住所自動入力">
                            </div>
                            <div class="form-group">
                                <label>住所</label>
                                <input type="text" name="prefecture" class="form-control" placeholder="都道府県" required>
                                <input type="text" name="city" class="form-control" placeholder="市区町村" required>
                                <input type="text" name="town" class="form-control" placeholder="町名番地" required>
                            </div>
                            <div class="form-group">
                                <label>メールアドレス</label>
                                <input type="email" name="mail" readonly class="form-control" value="<?= $mail ?>" required>
                            </div>
                            <div class="form-group">
                                <label>パスワード</label>
                                <input type="password" name="password" class="form-control" placeholder="半角英数" pattern="^(?=.*?[a-zA-Z])(?=.*?\d)[a-zA-Z\d]{8,20}$" required>
                                <small class="form-text text-muted">パスワードは半角英数字をそれぞれ1種類以上含む8文字以上</small>
                            </div>
                            <div class="form-group">
                                <label>パスワード（確認）</label>
                                <input type="password" name="password_check" class="form-control" placeholder="半角英数" required>
                            </div>
                            <input type="submit" class="btn btn-success">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include('../../assets/_inc/footer.php') ?>
</body>

</html>