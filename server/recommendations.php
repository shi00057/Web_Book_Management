<?php
session_start();
include('./Dao/db_connection.php');  
include('./Dao/UserDAO.php');  

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

// Get database connection
$database = new Database();
$db = $database->getConnection();

// Function to get a random book from the database
function getRandomBook($db) {
    $query = "SELECT * FROM books ORDER BY RAND() LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    return null;
}

// Function to get the username by user ID
function getUsernameById($db, $user_id) {
    $query = "SELECT username FROM users WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bindParam(1, $user_id);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['username'];
    }
    return 'Guest';
}

// Get the username and a random book
$user_id = $_SESSION['user_id'];
$username = getUsernameById($db, $user_id);
$book = getRandomBook($db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Recommendations</title>
    <link rel="stylesheet" href="../CSS/recommendations.css"> 
    <script src="../Scripts/recommendations.js" defer></script> 
</head>
<body>
    <?php include('./header.php'); ?> 
    <nav class="main-nav">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="recommendations.php">Recommendations</a></li>
            <li><a href="manage_books.php">Manage Books</a></li>
            <li><a href="favorite_list.php">Favorite List</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <div class="recommendations-container">
        <h1>Dear <?php echo htmlspecialchars($username); ?>,<br> based on your preferences, we have carefully selected this book for you. Have a great day!</h1>
        <div class="book-details">
            <div class="book-attribute"><strong>Title:</strong> <span id="book-title"><?php echo htmlspecialchars($book['title']); ?></span></div>
            <div class="book-attribute"><strong>Author:</strong> <span id="book-author"><?php echo htmlspecialchars($book['author']); ?></span></div>
            <div class="book-attribute"><strong>Genre:</strong> <span id="book-genre"><?php echo htmlspecialchars($book['genre']); ?></span></div>
            <div class="book-attribute"><strong>Description:</strong> <span id="book-description"><?php echo htmlspecialchars($book['description']); ?></span></div>
        </div>
        <div class="buttons">
            <a href="javascript:void(0);" class="detail-button" id="get-book" onclick="fetchNewBook()">Get a New Book</a>
            <a href="detail.php?book_id=<?php echo htmlspecialchars($book['id']); ?>" class="detail-button" id="view-details">View Details</a>
        </div>
    </div>
    <?php include('./footer.php'); ?> 
</body>
</html>
