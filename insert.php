<?php
//1. POSTデータ取得
$name     = $_POST["name"];
$email    = $_POST["email"];
$password = $_POST["password"];
$age      = $_POST["age"]; //追加されています

//2. DB接続します
require_once("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_user_table(id,name,email,age,password)VALUES(NULL,:name,:email,:age,:password)");
$stmt->bindValue(':name', h($name), PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', h($email), PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':age', h($age), PDO::PARAM_INT);        //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':password', h($password), PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
}

$stmt2 = $pdo->prepare('INSERT INTO gs_total_table(userID,level1,level2,level3,level4,level5)VALUES(NULL,:level1,:level2,:level3,:level4,:level5)');
$stmt2->bindValue(':level1', 0, PDO::PARAM_INT);
$stmt2->bindValue(':level2', 0, PDO::PARAM_INT);
$stmt2->bindValue(':level3', 0, PDO::PARAM_INT);
$stmt2->bindValue(':level4', 0, PDO::PARAM_INT);
$stmt2->bindValue(':level5', 0, PDO::PARAM_INT);
$status2 = $stmt2->execute();

if ($status2 == false) {
    sql_error($stmt2);
} else {
    redirect("index.php");
}
