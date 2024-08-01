<?php
session_start();
require_once('Dao/db_connection.php');

if (isset($_POST['book_id']) && isset($_POST['rating']) && isset($_SESSION['user_id'])) {
    $bookId = $_POST['book_id'];
    $userId = $_SESSION['user_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    $database = new Database();
    $db = $database->getConnection();

    $sql = "INSERT INTO reviews (book_id, user_id, rating, comment) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(1, $bookId);
    $stmt->bindParam(2, $userId);
    $stmt->bindParam(3, $rating);
    $stmt->bindParam(4, $comment);

    if ($stmt->execute()) {
        echo "Success";
    } else {
        echo "Error";
    }
} else {
    echo "Invalid request";
}

