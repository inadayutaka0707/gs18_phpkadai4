<?php
session_start();
require_once('funcs.php');

$quizRow = $_SESSION["quizRow"];
$userID = $_POST["userID"];

$pdo = db_conn();

$view = "";
for ($i = 1; $i <= $quizRow; $i++) {
    $answer[$i] = $_POST["answer$i"];
    $id[$i] = $_POST["id$i"];

    $stmt[$i] = $pdo->prepare('SELECT * FROM gs_question_table WHERE id=:id');
    $stmt[$i]->bindValue(':id', $id[$i], PDO::PARAM_INT);
    $status[$i] = $stmt[$i]->execute();

    if ($status[$i] == false) {
        sql_error($stmt[$i]);
        exit();
    } else {
        $row = $stmt[$i]->fetch();
    }
    if ($id[$i] == $row["id"]) {
        if ($answer[$i] == $row["answer"]) {
            $view .= $row["quiz"] . '回答：';
            $view .= 'あってる<br>';
            $view .= '<input type="hidden" name="id' . $i . '" value="' . $row["id"] . '">';
            $view .= '<input type="hidden" name="answer' . $i . '" value="' . $answer[$i] . '">';
            $view .= '<input type="hidden" name="level' . $i . '" value="' . $row["level"] . '">';
        } else {
            $view .= $row["quiz"] . '回答：';
            $view .= '間違ってる<br>';
            $view .= '<input type="hidden" name="id' . $i . '" value="' . $row["id"] . '">';
            $view .= '<input type="hidden" name="answer' . $i . '" value="' . $answer[$i] . '">';
            $view .= '<input type="hidden" name="level' . $i . '" value="' . $row["level"] . '">';
        }
    }
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
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="top.php">TOP</a></div>
                <div class="navbar-header"><a class="navbar-brand" href="logout.php">logout</a></div>
            </div>
        </nav>
    </header>
    <form action="answerSave.php" method="post">
        <input type="hidden" name="userID" value="<?= $userID ?>">
        <?= $view ?>
        <input type="submit" value="登録" class="btn btn-primary">
    </form>
    <a href="top.php">戻る</a>
</body>

</html>