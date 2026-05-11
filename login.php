<?php
require_once "config.php";
require_once "functions.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");

    if (empty($email) || empty($password)) {

        $error = "Please fill in all fields.";

    } else {

        // Find user by email
        $stmt = $pdo->prepare(
            "SELECT * FROM users WHERE email = ?"
        );

        $stmt->execute([$email]);

        $user = $stmt->fetch();

        // Verify password
        if ($user && password_verify($password, $user["password"])) {

            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];

            header("Location: index.php");
            exit();

        } else {

            $error = "Email or password does not match.";
        }
    }
}

include "header.php";
?>

<div class="card">
    <h1>Login</h1>

    <?php if (!empty($error)): ?>
        <div class="alert">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <label>Email</label>
        <input
            type="email"
            name="email"
            required
        >

        <label>Password</label>
        <input
            type="password"
            name="password"
            required
        >

        <button class="btn" type="submit">
            Login
        </button>

    </form>
</div>

<?php include "footer.php"; ?>