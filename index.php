<?php
require_once "functions.php";
include "header.php";
?>

<div class="card center">
    <h1>BrainByte</h1>
    <p class="subtitle">Choose how you want to play:</p>

    <?php if (is_logged_in()): ?>
        <p class="subtitle">
            Welcome back, <?php echo htmlspecialchars(current_user_name()); ?>!
        </p>

        <form method="POST" action="start_quiz.php">
            <input type="hidden" name="mode" value="user">

            <label for="question_count">Select number of questions:</label>
            <select name="question_count" id="question_count">
                <option value="10">10 Questions (5 min)</option>
                <option value="15">15 Questions (10 min)</option>
                <option value="20">20 Questions (15 min)</option>
                <option value="25">25 Questions (20 min)</option>
            </select>

            <button class="btn">Start Quiz</button>
        </form>

    <?php else: ?>
        <!-- Guest user -->
        <form method="POST" action="start_quiz.php">
            <input type="hidden" name="mode" value="guest">
            <button class="btn">Play as Guest (10 Questions)</button>
        </form>

        <a class="btn btn-light" href="login.php">Sign In</a>
        <a class="btn btn-secondary" href="signup.php">Create Account</a>
    <?php endif; ?>
</div>

<?php include "footer.php"; ?>