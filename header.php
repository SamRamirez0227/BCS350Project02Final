<?php
require_once "functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="assets/logo.webp">
    <title>BrainByte</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<nav class="navbar">
    <a class="logo" href="index.php">BrainByte</a>
    <div class="nav-links">
        <a href="index.php">Home</a>
        <?php if (is_logged_in()): ?>
            <a href="profile.php">Profile</a>
            <a href="leaderboard.php">Leaderboard</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="signup.php">Signup</a>
        <?php endif; ?>
    </div>
</nav>
<div class="container">
