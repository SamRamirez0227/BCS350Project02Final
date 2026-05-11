<?php
require_once "functions.php";

$mode = $_POST["mode"] ?? "guest";

if ($mode === "guest") {
    reset_quiz();
    start_new_quiz(10);
    $_SESSION["guest"] = true;
} else {
    if (!is_logged_in()) {
        header("Location: login.php");
        exit();
    }

    $question_count = $_POST["question_count"] ?? 10;

    reset_quiz();
    start_new_quiz($question_count);
    unset($_SESSION["guest"]);
}

header("Location: quiz.php");
exit();