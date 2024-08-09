<?php
session_start();

/*
    Author: SHOUJUN ZHAO
    File Name: add_books.php
    Date: August 1, 2024
    Description: Assignment 2, Add books in a Book Cataloging System
*/

// Check if the request method is POST (form submission)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include the database connection file
    require_once('./Dao/BookDao.php');
    require_once('./Dao/BookShelfDao.php');
    $bookDao = new BookDao();
    // Retrieve form data from POST request
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id'];
    $book_id = $bookDao->addBook($title, $author, $genre, $description,$user_id);
    $bookShelfDao = new BookShelfDao();
    $bookShelfDao->addBookShelf($book_id, $user_id);
    // Output a success message
    echo "Book added successfully!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link rel="stylesheet" href="../CSS/manage_books.css">
</head>
<body>
    <?php include('header.php'); ?>
    <div class="nav-container">
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="recommendations.php">Recommendations</a></li>
                <li><a href="manage_books.php">Manage Books</a></li>
                <li><a href="favorite_list.php">Favorite List</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </div>
    <h1>Add Book</h1>
    <!-- Form for adding a new book -->
    <form id="addBookForm" method="post" action="add_book.php">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br>
        <label for="author">Author:</label>
        <input type="text" id="author" name="author" required><br>
        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" required><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br>
        <button type="submit">Add Book</button>
        <button type="reset">Reset</button>
    </form>
    <a href="manage_books.php">Back to Book List</a>
    <script src="../Scripts/manage_books.js"></script>
    <?php include('footer.php'); ?>
</body>
</html>
