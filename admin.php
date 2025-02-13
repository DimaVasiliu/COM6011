<?php
require 'db_connect.php';

// Handle Adding New Words
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_word'])) {
    $word = trim($_POST['word']);
    $scrambled = trim($_POST['scrambled']);

    if ($word && $scrambled) {
        mysqli_query($conn, "INSERT INTO words (word, scrambled_word) VALUES ('$word', '$scrambled')");
    }
}

// Handle Username Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_user'])) {
    $old_username = trim($_POST['old_username']);
    $new_username = trim($_POST['new_username']);

    if ($old_username && $new_username) {
        mysqli_query($conn, "UPDATE users SET username = '$new_username' WHERE username = '$old_username'");
        mysqli_query($conn, "UPDATE scores SET username = '$new_username' WHERE username = '$old_username'");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
    <script defer src="script.js"></script>
</head>
<body>

    <div class="container">
        <h1>🔧 Admin Panel 🔧</h1>

        <h2>Add New Word</h2>
        <form method="post">
            <input type="text" name="word" placeholder="Correct Word" required>
            <input type="text" name="scrambled" placeholder="Scrambled Word" required>
            <button type="submit" name="add_word" class="button">Add Word</button>
        </form>

        <h2>Update Username</h2>
        <form method="post">
            <input type="text" name="old_username" placeholder="Current Username" required>
            <input type="text" name="new_username" placeholder="New Username" required>
            <button type="submit" name="update_user" class="button">Update Username</button>
        </form>

        <br>
        <a href="index.php" class="button">⬅ Back to Game</a>
    </div>

</body>
</html>
