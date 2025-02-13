<?php
require 'db_connect.php';

// Enable debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$sql = "SELECT word, scrambled_word FROM words ORDER BY RAND()";
$result = $conn->query($sql);

$words = [];

while ($row = $result->fetch_assoc()) {
    $words[] = [
        'word' => $row['word'],
        'scrambled_word' => $row['scrambled_word'] // Ensure correct field name
    ];
}

// Debugging: Print the output
header('Content-Type: application/json');
echo json_encode($words, JSON_PRETTY_PRINT);

$conn->close();
?>
