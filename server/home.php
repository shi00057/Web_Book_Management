<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
// Include necessary files
include('../server/Dao/db_connection.php');
include('../server/Dao/UserDAO.php');

// Get database connection
$database = new Database();
$db = $database->getConnection();

// Initialize UserDAO
$userDAO = new UserDAO($db);

// Get the user ID from the session
$userId = $_SESSION['user_id'];

// Fetch user information
$user_name = $userDAO->getUserNameById($userId);

// If user name is not found, set it to "Guest"
$user_name = $user_name ? $user_name : "Guest";
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../CSS/home.css">
</head>
<body>
    <?php include('header.php'); ?>
    <div class="home-content">
        <h1>Welcome to the Book Cataloging System</h1>
        <p>Welcome back, <?php echo htmlspecialchars($user_name); ?>!</p>
        
        <nav>
            <ul>
                <li><a href="search_book.php">Search Books</a></li>
                <li><a href="recommendations.php">Recommendations</a></li>
                <li><a href="list_books.php">Manage Books</a></li>
                <li><a href="favorite_list.php">Favorite List</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>

        <div class="container">
            <div class="box red">
                <h2>Search Books</h2>
                <p>Explore our vast collection of books and find your next favorite read.</p>
                <a href="search_book.php">Explore Now</a>
            </div>
            <div class="box blue">
                <h2>Recommendations</h2>
                <p>Get personalized book recommendations based on your reading history.</p>
                <a href="recommendations.php">Get Recommendations</a>
            </div>
            <div class="box green">
                <h2>Manage Books</h2>
                <p>Add, edit, or remove books from your personal library collection.</p>
                <a href="list_books.php">Manage Library</a>
            </div>
            <div class="box yellow">
                <h2>Favorite List</h2>
                <p>Keep track of all the books you love in one convenient list.</p>
                <a href="favorite_list.php">View Favorites</a>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>
