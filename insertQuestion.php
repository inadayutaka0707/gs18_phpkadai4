<?php
    $name = $_POST["name"];
    $quiz = $_POST["quiz"];
    $answer = $_POST["answer"];
    $level = $_POST["level"];

    require_once("funcs.php");
    $pdo = db_conn();

    $stmt = $pdo->prepare("INSERT INTO gs_question_table(id,name,quiz,answer,level)VALUES(NULL,:name,:quiz,:answer,:level)");
    $stmt->bindValue(":name", h($name), PDO::PARAM_STR);
    $stmt->bindValue(":quiz", h($quiz), PDO::PARAM_STR);
    $stmt->bindValue(":answer", h($answer), PDO::PARAM_STR);
    $stmt->bindValue(":level", h($level), PDO::PARAM_STR);
    $status = $stmt->execute();

    if($status==false){
        echo 'エラー発生';
        echo '<a href="addQuestion.php">問題追加へ戻る</a>';
        exit;
    }else{
        redirect('top.php');
    }
?>