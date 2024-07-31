<?php
session_start();
include('./Dao/db_connection.php');  
include('./Dao/UserDAO.php');  

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
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
    <div class="recommendations-container">
        <h1>Dear <?php echo htmlspecialchars($username); ?>, based on your preferences, we have carefully selected this book for you. Have a great day!</h1>
        <div class="book-details">
            <div class="book-title"><?php echo htmlspecialchars($book['title']); ?></div>
            <div class="book-author"><?php echo htmlspecialchars($book['author']); ?></div>
            <div class="book-genre"><?php echo htmlspecialchars($book['genre']); ?></div>
            <div class="book-description"><?php echo htmlspecialchars($book['description']); ?></div>
        </div>
        <button id="get-book" onclick="fetchNewBook()">Get a New Book</button>
    </div>
    <?php include('./footer.php'); ?> 
</body>
</html>
