<?php
session_start();
require_once('Dao/db_connection.php');

if (isset($_POST['book_id']) && isset($_SESSION['user_id'])) {
    $bookId = $_POST['book_id'];
    $userId = $_SESSION['user_id'];

    $database = new Database();
    $db = $database->getConnection();

    $sql = "delete from favorites where book_id = :book_id and user_id = :user_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":book_id", $bookId);
    $stmt->bindParam(":user_id", $userId);

    if ($stmt->execute()) {
        echo "Success";
    } else {
        echo "Error";
    }
} else {
    echo "Invalid request";
}

