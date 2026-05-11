<?php
require_once "functions.php";

if (is_logged_in()) {
    require_once "config.php";
}

if (!isset($_SESSION["quiz_questions"])) {
    header("Location: index.php");
    exit();
}

$questions = $_SESSION["quiz_questions"];
$total = count($questions);
$score = $_SESSION["score"] ?? 0;
$percentage = ($total > 0) ? round(($score / $total) * 100, 2) : 0;
$timeout = isset($_GET["timeout"]);

if (is_logged_in() && empty($_SESSION["guest"]) && !isset($_SESSION["score_saved"])) {
    $stmt = $pdo->prepare("INSERT INTO scores (user_id, score, total_questions, percentage) VALUES (?, ?, ?, ?)");
    $stmt->execute([$_SESSION["user_id"], $score, $total, $percentage]);
    $_SESSION["score_saved"] = true;
}

include "header.php";
?>

<div class="card center">
    <h1>Quiz Results</h1>

    <?php if ($timeout): ?>
        <div class="error">Time is up. Your quiz was submitted automatically.</div>
    <?php endif; ?>

    <h2>You scored <?php echo $score; ?> out of <?php echo $total; ?></h2>
    <p class="badge"><?php echo $percentage; ?>%</p>

    <?php if (is_logged_in()): ?>
        <p class="subtitle">Your score has been saved to your profile.</p>
        <a class="btn btn-light" href="profile.php">View Profile</a>
        <a class="btn btn-secondary" href="leaderboard.php">View Leaderboard</a>
    <?php else: ?>
        <p class="subtitle">
            Guest scores are not saved. Create an account to save your history and view the leaderboard.
        </p>
        <a class="btn btn-light" href="signup.php">Create Account</a>
    <?php endif; ?>

    <form method="POST" action="index.php">
        <?php
        reset_quiz();
        unset($_SESSION["score_saved"]);
        ?>
        <input type="hidden" name="question_count" value="10">
        <button class="btn" type="submit">Play Again</button>
    </form>
</div>

<?php include "footer.php"; ?>
