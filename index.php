<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Scramble Game</title>
    <link rel="stylesheet" href="style.css">
    <script defer src="script.js"></script>
</head>
<body>
    <div class="container" id="start-screen">
        <h1>Word Scramble Game</h1>
        <p>Enter your name to start:</p>
        <input type="text" id="username" placeholder="Enter your name" required>
        <button onclick="startGame()" class="button">Start Game</button>
    </div>

    <div id="game-container" class="container" style="display: none;">
        <h1>Word Scramble Game</h1>
        <p>Unscramble as many words as you can in 15 seconds!</p>

        <div class="progress-container">
            <div id="progress-bar"></div>
        </div>
        <p id="timer">⏳ 15s</p>

        <h2 id="scrambled-word" class="scrambled-word"></h2>

        <input type="text" id="answer-input" placeholder="Enter answer">
        <button id="submit-button" class="button">Submit</button>

    </div>

    <div class="button-container">
        <a href="leaderboard.php" class="button">🏆 View Leaderboard 🏆</a>
        <a href="admin.php" class="button admin-button">🔧 Admin Panel 🔧</a>
    </div>

        <!-- Game Over Popup -->
    <div id="game-over-popup">
        <h1>✅ Game Over!</h1>
        <p id="final-score"></p>
        <div class="button-container">
            <a href="index.php" class="button">🔄 Play Again</a>
            <a href="leaderboard.php" class="button">🏆 View Leaderboard</a>
            <a href="admin.php" class="button admin-button">🔧 Admin Panel</a>
        </div>
    </div>
</body>
</html>