<?php
session_start();
$_SESSION["quizRow"] = $_POST["quizRow"];
$id = $_POST["id"];
$quizRow = $_SESSION["quizRow"];

//問題の最後のIDを取得する
require_once('funcs.php');
$pdo = db_conn();
$stmt = $pdo->prepare('SELECT * FROM gs_question_table ;');
$status = $stmt->execute();

if ($status == false) {
    sql_error($stmt);
    exit();
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $row = $result["id"];
    }

    $view = "";
    $quiz_num = range(1, $row["id"]);
    shuffle($quiz_num);
    for ($i = 1; $i <= $quizRow; $i++) {
        $stmt2 = $pdo->prepare('SELECT * FROM gs_question_table WHERE id=:id ;');
        $stmt2->bindValue(':id', $quiz_num[$i], PDO::PARAM_INT);
        $status2 = $stmt2->execute();

        if ($status2 == false) {
            sql_error($stmt2);
            exit();
        } else {
            $row2 = $stmt2->fetch();
        }
        $view .= '<p>' . $i . '問目</p>';
        $view .= '<div class="quiz">' . $row2["quiz"] . '</div>' . '<br>';
        $view .= 'YES<input type="radio" name="answer' . $i . '" value="YES">';
        $view .= 'NO<input type="radio" name="answer' . $i . '" value="NO">' . '<br>';
        $view .= '<input type="hidden" name="id' . $i . '" value="' . $row2["id"] . '">';
        $view .= '<br>';
        if ($i == $quizRow) {
            $view .= '<input type="submit">';
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
    <style>
        .quiz {
            border: 1px solid gray;
            width: 300px;
            height: 200px;
        }

        body {
            text-align: center;
        }

        .main {
            width: 500px;
            margin: 50px auto;
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
    <form action="answerCheck.php" method="post">
        <div class="main">
            <?= $view ?>
        </div>
        <input type="hidden" name="userID" value="<?= $id ?>">
    </form>
</body>

</html>