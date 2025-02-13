<?php
require 'db_connect.php';

// Define the word to update and the new scrambled version
$word_to_update = "apple";
$new_scrambled = "ppael";

$sql = "UPDATE words SET scrambled_word='$new_scrambled' WHERE word='$word_to_update'";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully!";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
