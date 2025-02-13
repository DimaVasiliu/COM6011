<?php
$servername = "localhost";
$username = "qvs4900_word_scramble_user";
$password = "Indigochild13@";
$dbname = "qvs4900_word_scramble_game";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>