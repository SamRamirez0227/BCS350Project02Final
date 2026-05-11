<?php
require_once "config.php";
require_once "functions.php";

$leaders = $pdo->query("
    SELECT 
        users.username,
        scores.score,
        scores.total_questions,
        scores.percentage
    FROM scores
    JOIN users 
        ON scores.user_id = users.id
    ORDER BY scores.percentage DESC
    LIMIT 10
")->fetchAll();

include "header.php";
?>

<div class="card">
    <h1>Leaderboard 🏆</h1>

    <?php if (empty($leaders)): ?>

        <p>No scores yet.</p>

    <?php else: ?>

        <table>
            <tr>
                <th>Rank</th>
                <th>User</th>
                <th>Score</th>
                <th>Percentage</th>
            </tr>

            <?php foreach ($leaders as $index => $leader): ?>

                <tr>
                    <td><?php echo $index + 1; ?></td>

                    <td>
                        <?php echo htmlspecialchars($leader["username"]); ?>
                    </td>

                    <td>
                        <?php echo $leader["score"]; ?> /
                        <?php echo $leader["total_questions"]; ?>
                    </td>

                    <td>
                        <?php echo round($leader["percentage"], 2); ?>%
                    </td>
                </tr>

            <?php endforeach; ?>

        </table>

    <?php endif; ?>
</div>

<?php include "footer.php"; ?>