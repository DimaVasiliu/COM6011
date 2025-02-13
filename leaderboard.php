<?php
require 'db_connect.php';

// Fetch top 10 leaderboard scores
$result = $conn->query("SELECT username, score FROM scores ORDER BY score DESC LIMIT 10");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="style.css">
    <script defer src="script.js"></script> <!-- Ensure this JS handles delete -->
</head>
<body>
    <div class="container">
        <h1>🏆 Leaderboard 🏆</h1>
        <table>
            <tr><th>Rank</th><th>Username</th><th>Score</th><th>Action</th></tr>
            <?php
            if ($result->num_rows > 0) {
                $rank = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr id='user-{$row['username']}'>
                            <td>{$rank}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['score']}</td>
                            <td><button class='delete-btn' data-username='{$row['username']}'>🗑️ Delete</button></td>
                          </tr>";
                    $rank++;
                }
            } else {
                echo "<tr><td colspan='4'>No scores yet!</td></tr>";
            }
            ?>
        </table>
        <br>
        <a href="index.php" class="button">🔄 Play Again</a>
    </div>
</body>
</html>

<?php $conn->close(); ?>
