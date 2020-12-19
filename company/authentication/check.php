<?php
//遷移ページのチェック　ログイン可否
include('../../assets/functions.php');
$mail = isset($_POST['mail']) ? $_POST['mail'] : 0;
$password = $_POST['password'];
$url = 'Location:login.php';
if ($mail) {
    if (login_check()) $url = 'Location:../management.php';
} else if (login_check()) {
    alert('不正なアクセスです', "caution");
}
header($url);

function login_check()
{
    global $mail;
    global $password;
    try {
        $pdo = getPDO();
        $stmt = $pdo->prepare("select * from companies where mail=:mail limit 1");
        $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();//結果の取り出し
        if (password_verify($password, $result['password'])) {// 可否を判断する
            $_SESSION['id'] = $result['id'];
            alert('ログインしました', "success");
            return 1;
        }
        alert('メールアドレス、またはパスワードが違います', "caution");
    } catch (PDOException $e) {
        alert('データーベース接続エラー', "error");
    } finally {
        unset($pdo);
    }
    return 0;
}
