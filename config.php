<?php
$host = "sql211.infinityfree.com";
$dbname = "if0_41841945_quiz_app";
$username = "if0_41841945";
$password = "e9ARCw5XPv";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );
} catch (PDOException $e) {
    die("ERROR: " . $e->getMessage());
}
?>