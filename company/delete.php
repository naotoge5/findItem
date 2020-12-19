<?php
include('../assets/functions.php');
$id = isset($_POST['id']) ? $_POST['id'] : 0;

$id ? deleteObject() : alert('不正なアクセスです', "caution");

header('Location:management.php');

function deleteObject()
{
    global $id;
    try {
        $pdo = getPDO(); //pdo取得
        $stmt = $pdo->prepare("delete from objects where id = :id");
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        alert('落し物の削除が完了しました', 'success');
    } catch (PDOException $e) {
        alert('データベース接続エラー', "error");
    } finally {
        unset($pdo);
    }
}
