<?php
session_start();
require_once('Dao/db_connection.php');

if (isset($_POST['book_id']) && isset($_SESSION['user_id'])) {
    $bookId = $_POST['book_id'];
    $userId = $_SESSION['user_id'];

    $database = new Database();
    $db = $database->getConnection();

    $sql = "INSERT INTO favorites (book_id, user_id) VALUES (?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(1, $bookId);
    $stmt->bindParam(2, $userId);

    if ($stmt->execute()) {
        echo "Success";
    } else {
        echo "Error";
    }
} else {
    echo "Invalid request";
}

