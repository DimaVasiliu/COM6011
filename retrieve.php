<?php
require 'db_connect.php';

$sql = "SELECT id, word, scrambled_word FROM words";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " | Word: " . $row["word"] . " | Scrambled: " . $row["scrambled_word"] . "<br>";
    }
} else {
    echo "No words found!";
}

$conn->close();
?>
