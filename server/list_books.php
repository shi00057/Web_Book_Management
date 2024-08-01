 <?php

/*
    Author: SHOUJUN ZHAO
    File Name: list_books.php
    Date: August 1, 2024
    Description: Assignment 2, List books in a Book Cataloging System
*/

// Include the database connection file
require_once './Dao/db_connection.php';

// Instantiate the Database class and get the database connection
$database = new Database();
$conn = $database->getConnection();

// Prepare the SQL statement to fetch all books from the database
$sql = "SELECT * FROM books";
$stmt = $conn->prepare($sql);
$stmt->execute();

// Fetch all books and store them in an associative array
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
    <link rel="stylesheet" href="../CSS/manage_books.css">
</head>
<body>
    <h1>Book List</h1>
    <!-- Table to display the list of books -->
    <table id="bookTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Genre</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop through each book and display its details in a table row -->
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?php echo $book['id']; ?></td>
                    <td><?php echo $book['title']; ?></td>
                    <td><?php echo $book['author']; ?></td>
                    <td><?php echo $book['genre']; ?></td>
                    <td><?php echo $book['description']; ?></td>
                    <td>
                        <a href="edit_book.php?id=<?php echo $book['id']; ?>">Edit</a>
                        <!-- Form to delete a book -->
                        <form method="post" action="delete_book.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="add_book.php">Add New Book</a>
    <a href="home.php" class="home-link">Home</a>
    <script src="../Scripts/manage_books.js"></script>
</body>
</html>

