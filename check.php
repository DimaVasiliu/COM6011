<?php
require 'db_connect.php';
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get user input
$username = isset($_POST['username']) ? trim($_POST['username']) : null;
$score = isset($_POST['score']) ? (int) $_POST['score'] : 0;

if (!$username) {
    die("Error: Username is missing.");
}

// Check if the user exists
$checkUser = $conn->prepare("SELECT * FROM users WHERE username = ?");
$checkUser->bind_param("s", $username);
$checkUser->execute();
$userResult = $checkUser->get_result();

if ($userResult->num_rows == 0) {
    // Insert user if they don't exist
    $insertUser = $conn->prepare("INSERT INTO users (username, email) VALUES (?, ?)");
    $email = $username . "@game.com";
    $insertUser->bind_param("ss", $username, $email);
    $insertUser->execute();
}

// Check if the user already has a score
$checkScore = $conn->prepare("SELECT score FROM scores WHERE username = ?");
$checkScore->bind_param("s", $username);
$checkScore->execute();
$scoreResult = $checkScore->get_result();

if ($scoreResult->num_rows > 0) {
    // Update the score only if the new one is higher
    $row = $scoreResult->fetch_assoc();
    if ($score > $row["score"]) {
        $updateScore = $conn->prepare("UPDATE scores SET score = ? WHERE username = ?");
        $updateScore->bind_param("is", $score, $username);
        $updateScore->execute();
    }
} else {
    // Insert new score for new users
    $insertScore = $conn->prepare("INSERT INTO scores (username, score) VALUES (?, ?)");
    $insertScore->bind_param("si", $username, $score);
    $insertScore->execute();
}

echo json_encode(["status" => "success", "message" => "Score saved successfully!"]);
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Over</title>
    <link rel="stylesheet" href="style.css">
    <script defer src="script.js"></script>
</head>
<body class="game-over">

    <div class="game-over-container">
        <h1>✅ Game Over!</h1>
        <h2>You scored <span class="score-highlight"><?php echo $final_score; ?></span> points!</h2>
        
        <div class="button-container">
            <a href="index.php" class="button">🔄 Play Again</a>
            <a href="leaderboard.php" class="button">🏆 View Leaderboard</a>
            <a href="admin.php" class="button admin-button">🔧 Admin Panel</a>
        </div>
    </div>

</body>
</html>
