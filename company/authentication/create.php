<?php
//サインアップから遷移
include('../../assets/functions.php');
//変数に格納
$name = $_POST['name_first'] . ' ' . $_POST['name_second'];
$tel = $_POST['tel'];
$postal = $_POST['postal'];
$prefecture = $_POST['prefecture'];
$city = $_POST['city'];
$town = $_POST['town'];
$mail = isset($_POST['mail']) ? $_POST['mail'] : null;
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$url = 'Location:login.php';
if (is_null($mail)) {
    alert('不正なアクセスです', "caution");
} else if (writeCompany()) {
    $url = 'Location:../management.php';
}
header($url);

function writeCompany()
{
    global $name;
    global $tel;
    global $postal;
    global $prefecture;
    global $city;
    global $town;
    global $mail;
    global $password;
    try {
        $pdo = getPDO();//pdo取得
        //insert文の発行
        $stmt = $pdo->prepare("insert into companies values(null, :name, :tel ,:postal, :prefecture, :city,:town, null, :mail, :password)");
        $stmt->execute(array(":name" => $name, ":tel" => $tel, ":postal" => $postal, ":prefecture" => $prefecture, ":city" => $city, ":town" => $town, ":mail" => $mail, ":password" => $password));
        $_SESSION['id'] = $pdo->lastInsertId();
        $stmt = $pdo->prepare("delete from pre_companies where mail = :mail");
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->execute();
        return 1;
    } catch (PDOException $e) {
        alert('データベース接続エラー', "error");
    } finally {
        unset($pdo);
    }
    return 0;
}
