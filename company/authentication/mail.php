<?php
//メール設定 接続
include '../../assets/functions.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// PHPMailer のソースファイルの読み込み
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = isset($_POST['mail']) ? $_POST['mail'] : 0;
$token = hash('sha256', uniqid(rand(), 1));
$url = str_replace('/mail.php', '/signup.php?token=' . $token, (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
if ($mail) {
    if (check_mail() and write_preCompany()) send_mail();
} else {
    alert('不正なアクセスです', "caution");
}
header('Location:login.php');

function write_preCompany()
{
    global $token;
    global $mail;
    try {
        $pdo = getPDO();
        $stmt = $pdo->prepare("insert into pre_companies values(null, :token, :mail, now())");
        $stmt->execute(array(":token" => $token, ":mail" => $mail));
        return 1;
    } catch (PDOException $e) {
        alert('データベース接続エラー', "error");
    } finally {
        unset($pdo);
    }
    return 0;
}

function check_mail()
{
    global $mail;
    try {
        $pdo = getPDO();
        $stmt = $pdo->prepare('SELECT mail FROM companies WHERE mail = :mail limit 1');
        $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
        $stmt->execute();
        if (!$stmt->fetch()) return 1;
        alert('"' . $mail . '"はすでに利用されています', 'CAUTION');
    } catch (PDOException $e) {
        alert('データベース接続エラー', "error");
    } finally {
        unset($pdo);
    }
    return 0;
}

function send_mail()
{
    global $mail;
    global $url;
    try {
        $mailer = new PHPMailer(true); //インスタンスを生成（true指定で例外を有効化）
        /*
        なくても動く!?
        //文字エンコードを指定
        //mb_language('uni');
        //mb_internal_encoding('UTF-8');
        */
        $mailer->CharSet = 'utf-8';
        // SMTPサーバの設定
        $mailer->isSMTP();                          // SMTPの使用宣言
        $mailer->Host = 'smtp.kcg.ac.jp';   // SMTPサーバーを指定
        $mailer->SMTPAuth = true;                 // SMTP authenticationを有効化
        $mailer->Username = 'st071959';   // SMTPサーバーのユーザ名
        $mailer->Password = '10ikoanNita05Kcg';           // SMTPサーバーのパスワード
        $mailer->SMTPSecure = 'tls';  // 暗号化を有効（tls or ssl）無効の場合はfalse
        $mailer->Port = 587; // TCPポートを指定（tlsの場合は465や587）

        // 送受信先設定（第二引数は省略可）
        $mailer->setFrom('st071959@m03.kyoto-kcg.ac.jp', '落とし物管理システム'); // 送信者
        $mailer->addAddress($mail);   // 宛先

        // 送信内容設定
        $mailer->Subject = '仮登録が完了しました。';
        $mailer->Body = "登録は完了していません。\n\n【登録ページ】\nURL\n" . $url . "\n\n24時間以内に登録を完了させてください。";

        // 送信
        $mailer->send();
        alert('メールアドレスに新規登録のURLを送信しました', "success");
        return 1;
    } catch (Exception $e) {
        alert('メールの送信に失敗しました', "caution");
    } finally {
        unset($mailer);
    }
    return 0;
}
