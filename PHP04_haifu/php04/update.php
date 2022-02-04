<?php
//1. POSTデータ取得
$title   = $_POST['title'];
$author  = $_POST['author'];
$publisher = $_POST['publisher'];
$id     = $_POST['id'];

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare('UPDATE book_table SET title=:title,author=:author,publisher=:publisher WHERE id=:id;');
$stmt->bindValue('title',   $title,   PDO::PARAM_STR);
$stmt->bindValue(':author',  $author,  PDO::PARAM_STR);
$stmt->bindValue(':publisher',    $publisher,    PDO::PARAM_STR);
$stmt->bindValue(':id',     $id,     PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status === false) {
    sql_error($stmt);
} else {
    redirect('select.php');
}