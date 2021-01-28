<?php

session_start();
if ($_POST["name"] != "") {
    $_SESSION["name"] = $_POST["name"];
}

$name = $_SESSION["name"];

require_once("funcs.php");
$pdo = db_conn();

$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE name=:name");
$stmt->bindValue(":name", h($name), PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    echo 'エラー発生';
    echo '<a href="index.php">ログイン画面へ戻る</a>';
    exit;
} else {
    $row = $stmt->fetch();
}

$stmt2 = $pdo->prepare("SELECT * FROM gs_total_table WHERE userID=:id");
$stmt2->bindValue(':id', $row["id"], PDO::PARAM_INT);
$status2 = $stmt2->execute();

if ($status2 == false) {
    echo 'エラー発生';
    echo '<a href="index.php">ログイン画面へ戻る</a>';
    exit;
} else {
    $row2 = $stmt2->fetch();
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
    <style>
        th {
            width: 50px;
        }

        td {
            width: 15px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="top.php">TOP</a></div>
                <div class="navbar-header"><a class="navbar-brand" href="logout.php">logout</a></div>
            </div>
        </nav>
    </header>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <p class="navbar-brand">ようこそ<?= $row["name"] ?>さん</p>
                </div>
            </div>
        </nav>
    </header>
    <form action="question.php" method="post">
        <input type="hidden" name="name" value="<?= $row["name"] ?>">
        <input type="hidden" name="id" value="<?= $row["id"] ?>">
        <input type="submit" class="btn btn-outline-primary" value="出題画面へ">
        出題数:<select name="quizRow">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </form><br>
    <form action="addQuestion.php" method="post">
        <input type="hidden" name="name" value="<?= $row["name"] ?>">
        <input type="submit" class="btn btn-outline-success" value="問題追加へ">
    </form>
    <table>
        <tr>
            <th>難易度</th>
            <?php
            for ($i = 1; $i <= 10; $i++) {
                echo '<td class="tdright">' . $i . '</td>';
            }
            ?>
        </tr>
        <tr>
            <th>level1</th>
            <?php
            for ($i = 0; $i < $row2["level1"]; $i++) {
                echo '<td>☆</td>';
            }
            ?>
        </tr>
        <tr>
            <th>level2</th>
            <?php
            for ($i = 0; $i < $row2["level2"]; $i++) {
                echo '<td>☆</td>';
            }
            ?>
        </tr>
        <tr>
            <th>level3</th>
            <?php
            for ($i = 0; $i < $row2["level3"]; $i++) {
                echo '<td>☆</td>';
            }
            ?>
        </tr>
        <tr>
            <th>level4</th>
            <?php
            for ($i = 0; $i < $row2["level4"]; $i++) {
                echo '<td>☆</td>';
            }
            ?>
        </tr>
        <tr>
            <th>level5</th>
            <?php
            for ($i = 0; $i < $row2["level5"]; $i++) {
                echo '<td>☆</td>';
            }
            ?>
        </tr>
    </table>
</body>

</html>