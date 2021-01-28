<?php
session_start();
require_once('funcs.php');

$quizRow = $_SESSION["quizRow"];
$userID = $_POST["userID"];

$pdo = db_conn();

for ($i = 1; $i <= $quizRow; $i++) {
    $answer[$i] = $_POST["answer$i"];
    $id[$i] = $_POST["id$i"];
    $level[$i] = $_POST["level$i"];

    $stmt[$i] = $pdo->prepare('SELECT * FROM gs_question_table WHERE id=:id');
    $stmt[$i]->bindValue(':id', $id[$i], PDO::PARAM_INT);
    $status[$i] = $stmt[$i]->execute();

    if ($status[$i] == false) {
        sql_error($stmt[$i]);
        echo '<a href="top.php">戻る</a>';
    } else {
        $row = $stmt[$i]->fetch();
    }

    $stmtB[$i] = $pdo->prepare('SELECT * FROM gs_total_table WHERE id=:id');
    $stmtB[$i]->bindValue(':id', $id[$i], PDO::PARAM_INT);
    $statusB[$i] = $stmt[$i]->execute();

    if ($statusB[$i] == false) {
        sql_error($stmtB[$i]);
        echo '<a href="top.php">戻る</a>';
    } else {
        $row2 = $stmtB[$i]->fetch();
    }

    if ($id[$i] == $row["id"]) {
        //あっているときの処理
        if ($answer[$i] == $row["answer"]) {

            switch ($level[$i]) {
                case 'level1':
                    $stmtA[$i] = $pdo->prepare('UPDATE gs_total_table SET level1=level1 + 1');
                    $statusA[$i] = $stmtA[$i]->execute();
                    break;
                case 'level2':
                    $stmtA[$i] = $pdo->prepare('UPDATE gs_total_table SET level2=level2 + 1');
                    $statusA[$i] = $stmtA[$i]->execute();
                    break;
                case 'level3':
                    $stmtA[$i] = $pdo->prepare('UPDATE gs_total_table SET level3=level3 + 1');
                    $statusA[$i] = $stmtA[$i]->execute();
                    break;
                case 'level4':
                    $stmtA[$i] = $pdo->prepare('UPDATE gs_total_table SET level4=level4 + 1');
                    $statusA[$i] = $stmtA[$i]->execute();
                    break;
                case 'level5':
                    $stmtA[$i] = $pdo->prepare('UPDATE gs_total_table SET level5=level5 + 1');
                    $statusA[$i] = $stmtA[$i]->execute();
                    break;
                default:
                    echo 'ちゃうな';
            }

            if ($statusA[$i] == false) {
                echo 'ミスってる';
                echo '<a href="top.php">戻る</a>';
            }
        } else {
            //違っているときの処理
            switch ($level[$i]) {
                case 'level1':
                    $stmtA[$i] = $pdo->prepare('UPDATE gs_total_table SET level1=level1 - 1');
                    $statusA[$i] = $stmtA[$i]->execute();
                    break;
                case 'level2':
                    $stmtA[$i] = $pdo->prepare('UPDATE gs_total_table SET level2=level2 - 1');
                    $statusA[$i] = $stmtA[$i]->execute();
                    break;
                case 'level3':
                    $stmtA[$i] = $pdo->prepare('UPDATE gs_total_table SET level3=level3 - 1');
                    $statusA[$i] = $stmtA[$i]->execute();
                    break;
                case 'level4':
                    $stmtA[$i] = $pdo->prepare('UPDATE gs_total_table SET level4=level4 - 1');
                    $statusA[$i] = $stmtA[$i]->execute();
                    break;
                case 'level5':
                    $stmtA[$i] = $pdo->prepare('UPDATE gs_total_table SET level5=level5 - 1');
                    $statusA[$i] = $stmtA[$i]->execute();
                    break;
                default:
                    echo 'ちゃうな';
            }

            if ($statusA[$i] == false) {
                echo 'ミスってる';
                echo '<a href="top.php">戻る</a>';
            }
        }
    }
}

redirect('top.php');
