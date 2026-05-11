<?php
// functions.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function is_logged_in() {
    return isset($_SESSION["user_id"]);
}

function require_login() {
    if (!is_logged_in()) {
        header("Location: login.php");
        exit();
    }
}

function current_user_name() {
    return $_SESSION["username"] ?? "Guest";
}

function load_questions() {
    $file = __DIR__ . "/data/questions.json";

    if (!file_exists($file)) {
        die("Question file not found.");
    }

    $json = file_get_contents($file);
    $questions = json_decode($json, true);

    if (!is_array($questions)) {
        die("Question file is not valid JSON.");
    }

    return $questions;
}

function clean_question($q) {
    return [
        "question" => trim($q["question"]),
        "A" => trim($q["A"]),
        "B" => trim($q["B"]),
        "C" => trim($q["C"]),
        "D" => trim($q["D"]),
        "answer" => trim($q["answer"])
    ];
}

function start_new_quiz($question_count = 10) {
    $questions = load_questions();
    shuffle($questions);

    $question_count = (int)$question_count;

    if ($question_count < 5) {
        $question_count = 5;
    }

    if ($question_count > 25) {
        $question_count = 25;
    }

    if (!is_logged_in()) {
        $question_count = 10;
    }

    $selected = array_slice($questions, 0, $question_count);
    $selected = array_map("clean_question", $selected);

    $_SESSION["quiz_questions"] = $selected;
    $_SESSION["current_question"] = 0;
    $_SESSION["score"] = 0;
    $_SESSION["answers"] = [];
    $_SESSION["quiz_start_time"] = time();
    $_SESSION["quiz_question_count"] = $question_count;
}

function reset_quiz() {
    unset(
        $_SESSION["quiz_questions"],
        $_SESSION["current_question"],
        $_SESSION["score"],
        $_SESSION["answers"],
        $_SESSION["quiz_start_time"],
        $_SESSION["quiz_question_count"]
    );
}
?>
