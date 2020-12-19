<?php
include('../assets/functions.php');

$name = isset($_POST['name']) ? $_POST['name'] : 0;
$details = $_POST['details'];
$category = $_POST['category'];
$datetime = $_POST['date'] . ' ' . $_POST['time'];
$object_id = $_POST['id'];

if ($name) {
    $object_id ? updateObject($object_id) : updateObject($_SESSION['id'], false);
} else {
    alert('不正なアクセスです', "caution");
}

header('Location:management.php');


/**
 * @param int $id edit => object_id, new => company_id
 * @param boolean $type edit => true, new => false
 */
function updateObject(int $id, $type = true)
{
    global $name;
    global $details;
    global $category;
    global $datetime;
    global $company_id;
    $query = $type ? "update objects set name = :name, details = :details, category = :category, datetime = :datetime where id = :id" : "insert into objects values(null, :name, :details, :category, :datetime, :id)";
    try {
        $pdo = getPDO(); //pdo取得
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(":name" => $name, ":details" => $details, ":category" => $category, ":datetime" => $datetime, ":id" => $id));
        /* bootstrapによる日時の入力ができるようになればcompanies->object_updateはカラムから削除
        $stmt = $pdo->prepare("update companies set object_update = now() where id = :id");
        $stmt->bindValue(":id", $company_id, PDO::PARAM_INT);
        $stmt->execute();
        */
        $type ? alert('落とし物の編集が完了しました', "success") : alert('落とし物の新規登録が完了しました', "success");
    } catch (PDOException $e) {
        alert('データベース接続エラー', "error");
    } finally {
        unset($pdo);
    }
}
