<?php
session_start();

/*
    Author: SHOUJUN ZHAO
    File Name: delete_books.php
    Date: August 1, 2024
    Description: Assignment 2, Delete books in a Book Cataloging System
*/

// Include the database connection file
require_once './Dao/AbstractDao.php';
require_once './Dao/BookDao.php';
require_once './Dao/BookShelfDao.php';
// Check if the request method is POST (form submission)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the book ID from the POST request
    $id = $_POST['id'];
    $user_id = $_SESSION['user_id'];
    $bookShelfDao = new BookShelfDao();
    $bookDao = new BookDao();
    $book_shelf = $bookShelfDao->getShelf($user_id, $id);

    if ($book_shelf) {
        // Prepare the SQL statement to delete the book from the database
        $bookDao->deleteBook($id);
        // Also delete from book_shelf
        $bookShelfDao->deleteBookShelf($id);
        // Output a success message
        echo "Book deleted successfully!";
    } else {
        echo "You do not have permission to delete this book.";
    }
    exit;
}
?>
