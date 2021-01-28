<?php

    $name = $_POST["name"];

    require_once("funcs.php");
    $pdo = db_conn();

    $stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE name=:name");
    $stmt->bindValue(":name", h($name), PDO::PARAM_STR);
    $status = $stmt->execute();

    if($status==false){
        echo 'エラー発生';
        echo '<a href="index.php">ログイン画面へ戻る</a>';
        exit;
    }else{
        $row = $stmt->fetch();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar navbar-default">
            <a href="top.php" class="navbar-brand">TOP</a>
        </nav>
    </header>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <p class="navbar-brand">ようこそ<?=$row["name"]?>さん</p>
                </div>
            </div>
        </nav>
    </header>
    <form action="insertQuestion.php" method="post">
        <input type="hidden" name="name" value="<?=$row["name"]?>">
        <textarea name="quiz" cols="30" rows="5"></textarea><br>
        回答<select name="answer">
            <option value="YES">YES</option>
            <option value="NO">NO</option>
        </select><br>
        難易度<select name="level">
            <option value="level1">１</option>
            <option value="level2">２</option>
            <option value="level3">３</option>
            <option value="level4">４</option>
            <option value="level5">５</option>
        </select>
        <input type="submit" value="追加">
    </form>
</body>
</html>