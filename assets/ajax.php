<?php
include('functions.php');

$url = isset($_GET['request_url']) ? $_GET['request_url'] : 0;
$details = isset($_POST['details']) ? $_POST['details'] : 0;
$category = isset($_GET['category']) ? $_GET['category'] : 0;

if (isset($_POST['logout'])) { // logoutに値は存在しない
    alert('ログアウトしました', "success");
} else if ($url) {
    echo file_get_contents($url);
} else if ($details) {
    if ($details === 'none') $details = '';
    updateDetails($details, $_SESSION['id']);
} else if ($category) {
    echo json_encode(readObjectListFromCategory($category), JSON_UNESCAPED_UNICODE);
} else {
    alert('不正なアクセスです', "caution");
    header('Location:../public/top.php');
}
