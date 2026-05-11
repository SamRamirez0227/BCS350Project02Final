<?php
require_once "functions.php";

if (!isset($_SESSION["quiz_questions"])) {
    start_new_quiz(10);
}

$question_count = $_SESSION["quiz_question_count"] ?? 10;
$time_limit = 300 + (($question_count - 10) / 5) * 300;
$elapsed = time() - ($_SESSION["quiz_start_time"] ?? time());
$remaining = $time_limit - $elapsed;

if ($remaining <= 0) {
    header("Location: results.php?timeout=1");
    exit();
}

$questions = $_SESSION["quiz_questions"];
$current = $_SESSION["current_question"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $selected_answer = $_POST["answer"] ?? "";
    $correct_answer = $questions[$current]["answer"];

    $_SESSION["answers"][$current] = $selected_answer;

    if ($selected_answer === $correct_answer) {
        $_SESSION["score"]++;
    }

    $_SESSION["current_question"]++;

    if ($_SESSION["current_question"] >= count($questions)) {
        header("Location: results.php");
        exit();
    }

    header("Location: quiz.php");
    exit();
}

$question = $questions[$current];
include "header.php";
?>

<div class="card">
    <div class="quiz-top">
        <div>
            <strong>Question <?php echo $current + 1; ?> of <?php echo count($questions); ?></strong>
        </div>
        <div id="timer" class="timer" data-remaining="<?php echo $remaining; ?>">Time left: 5:00</div>
    </div>

    <form method="POST" id="quizForm">
        <div class="question-box">
            <h2><?php echo htmlspecialchars($question["question"]); ?></h2>

            <label class="option">
                <input type="radio" name="answer" value="A" required>
                A. <?php echo htmlspecialchars($question["A"]); ?>
            </label>

            <label class="option">
                <input type="radio" name="answer" value="B" required>
                B. <?php echo htmlspecialchars($question["B"]); ?>
            </label>

            <label class="option">
                <input type="radio" name="answer" value="C" required>
                C. <?php echo htmlspecialchars($question["C"]); ?>
            </label>

            <label class="option">
                <input type="radio" name="answer" value="D" required>
                D. <?php echo htmlspecialchars($question["D"]); ?>
            </label>

            <button class="btn" type="submit">
                <?php echo ($current + 1 === count($questions)) ? "Finish Quiz" : "Next Question"; ?>
            </button>
        </div>
    </form>
</div>

<script src="assets/timer.js"></script>
<?php include "footer.php"; ?>
