<?php

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

    // Prepare the SQL statement to delete the book from the database
    $sql = "DELETE FROM books WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Execute the statement with the book ID
    $stmt->execute([$id]);

    // Output a success message
    echo "Book deleted successfully!";
    exit;
}
?>

