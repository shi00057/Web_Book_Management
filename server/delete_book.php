<?php
session_start();

/*
    Author: SHOUJUN ZHAO
    File Name: delete_books.php
    Date: August 1, 2024
    Description: Assignment 2, Delete books in a Book Cataloging System
*/

// Include the database connection file
require_once './Dao/db_connection.php';

// Instantiate the Database class and get the database connection
$database = new Database();
$conn = $database->getConnection();

// Check if the request method is POST (form submission)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the book ID from the POST request
    $id = $_POST['id'];
    $user_id = $_SESSION['user_id'];

    // Check if the user has permission to delete this book
    $sql = "SELECT * FROM book_shelf WHERE user_id = ? AND book_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id, $id]);
    $book_shelf = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($book_shelf) {
        // Prepare the SQL statement to delete the book from the database
        $sql = "DELETE FROM books WHERE id = ?";
        $stmt = $conn->prepare($sql);

        // Execute the statement with the book ID
        $stmt->execute([$id]);

        // Also delete from book_shelf
        $sql = "DELETE FROM book_shelf WHERE book_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        // Output a success message
        echo "Book deleted successfully!";
    } else {
        echo "You do not have permission to delete this book.";
    }
    exit;
}
?>
