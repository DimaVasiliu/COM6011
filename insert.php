<?php
require 'db_connect.php';

// Define words and their scrambled versions
$words = [
    ["apple", "lpaep"],
    ["banana", "aanbna"],
    ["cherry", "chryre"],
    ["grape", "grpae"],
    ["orange", "rnogae"],
    ["peach", "pcahe"]
];

// Prepare and insert words into the database
foreach ($words as $word) {
    $sql = "INSERT INTO words (word, scrambled_word) VALUES ('{$word[0]}', '{$word[1]}')";

    if ($conn->query($sql) === TRUE) {
        echo "Inserted: " . $word[0] . "<br>";
    } else {
        echo "Error inserting " . $word[0] . ": " . $conn->error . "<br>";
    }
}

$conn->close();
?>
