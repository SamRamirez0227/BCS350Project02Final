<?php
require_once "config.php";
require_once "functions.php";
require_login();

$stmt = $pdo->prepare("SELECT score, total_questions, percentage, played_at FROM scores WHERE user_id = ? ORDER BY played_at DESC");
$stmt->execute([$_SESSION["user_id"]]);
$scores = $stmt->fetchAll();

include "header.php";
?>

<div class="card">
    <h1><?php echo htmlspecialchars(current_user_name()); ?>'s Profile</h1>
    <p class="subtitle">Here is your quiz play history.</p>

    <?php if (count($scores) === 0): ?>
        <div class="success">You have not completed any saved quizzes yet.</div>
    <?php else: ?>
        <table>
            <tr>
                <th>Date</th>
                <th>Score</th>
                <th>Percentage</th>
            </tr>
            <?php foreach ($scores as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row["played_at"]); ?></td>
                    <td><?php echo htmlspecialchars($row["score"]); ?> / <?php echo htmlspecialchars($row["total_questions"]); ?></td>
                    <td><?php echo htmlspecialchars($row["percentage"]); ?>%</td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>

<?php include "footer.php"; ?>
