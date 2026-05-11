<?php
   ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    
require_once "config.php";
require_once "functions.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");
    $confirm_password = trim($_POST["confirm_password"] ?? "");

    // Basic validation
    if (
        empty($username) ||
        empty($email) ||
        empty($password) ||
        empty($confirm_password)
    ) {

        $error = "Please fill in all fields.";

    } elseif ($password !== $confirm_password) {

        $error = "Passwords do not match.";

    } else {

        // Check if username or email already exists
        $stmt = $pdo->prepare(
            "SELECT * FROM users WHERE username = ? OR email = ?"
        );

        $stmt->execute([$username, $email]);

        $existing_user = $stmt->fetch();

        if ($existing_user) {

            $error = "That username or email is already being used.";

        } else {

            // Hash password
            $hashed_password = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            // Insert new user
            $stmt = $pdo->prepare(
                "INSERT INTO users (username, email, password)
                 VALUES (?, ?, ?)"
            );

            $stmt->execute([
                $username,
                $email,
                $hashed_password
            ]);

            // Redirect to login page
            header("Location: login.php");
            exit();
        }
    }
}

include "header.php";
?>

<div class="card">
    <h1>Create Account</h1>

    <?php if (!empty($error)): ?>
        <div class="alert">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <label>Username</label>
        <input
            type="text"
            name="username"
            required
        >

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

        <label>Confirm Password</label>
        <input
            type="password"
            name="confirm_password"
            required
        >

        <button class="btn" type="submit">
            Create Account
        </button>

    </form>
</div>

<?php include "footer.php"; ?>