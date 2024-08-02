<?php
session_start();

/*
    Author: SHOUJUN ZHAO
    File Name: edit_books.php
    Date: August 1, 2024
    Description: Assignment 2, Edit books in a Book Cataloging System
*/

// Include the database connection file
require_once './Dao/db_connection.php';

// Instantiate the Database class and get the database connection
$database = new Database();
$conn = $database->getConnection();

// Check if the request method is POST (form submission)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data from POST request
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id'];

    // Check if the user has permission to edit this book
    $sql = "SELECT * FROM book_shelf WHERE user_id = ? AND book_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id, $id]);
    $book_shelf = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($book_shelf) {
        // Prepare the SQL statement to update the book details in the database
        $sql = "UPDATE books SET title = ?, author = ?, genre = ?, description = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        // Execute the statement with the form data
        $stmt->execute([$title, $author, $genre, $description, $id]);

        // Output a success message
        echo "Book updated successfully!";
    } else {
        echo "You do not have permission to edit this book.";
    }
    exit;
} else {
    // Retrieve the book ID from the GET request
    $id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Check if the user has permission to edit this book
    $sql = "SELECT * FROM book_shelf WHERE user_id = ? AND book_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id, $id]);
    $book_shelf = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($book_shelf) {
        // Prepare the SQL statement to fetch the book details from the database
        $sql = "SELECT * FROM books WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        // Fetch the book details and store them in an associative array
        $book = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "You do not have permission to edit this book.";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
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
    <h1>Edit Book</h1>
    <!-- Form for editing a book -->
    <form id="editBookForm" method="post" action="edit_book.php">
        <!-- Hidden field to store the book ID -->
        <input type="hidden" id="id" name="id" value="<?php echo $book['id']; ?>" required>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo $book['title']; ?>" required><br>
        <label for="author">Author:</label>
        <input type="text" id="author" name="author" value="<?php echo $book['author']; ?>" required><br>
        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" value="<?php echo $book['genre']; ?>" required><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo $book['description']; ?></textarea><br>
        <button type="submit">Update Book</button>
        <button type="reset">Reset</button>
    </form>
    <a href="manage_books.php">Back to Book List</a>
    <script src="../Scripts/manage_books.js"></script>
    <?php include('footer.php'); ?>
</body>
</html>
