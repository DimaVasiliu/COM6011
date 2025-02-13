<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);

    if (!empty($username)) {
        // Delete from scores table first (to prevent foreign key issues)
        $deleteScore = $conn->prepare("DELETE FROM scores WHERE username = ?");
        $deleteScore->bind_param("s", $username);
        $deleteScore->execute();

        // Then delete from users table
        $deleteUser = $conn->prepare("DELETE FROM users WHERE username = ?");
        $deleteUser->bind_param("s", $username);
        $deleteUser->execute();

        echo json_encode(["status" => "success", "message" => "$username deleted successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid username"]);
    }
}

$conn->close();
?>
