<?php
session_start();
include('./Dao/db_connection.php');  

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

// Get a random book
$book = getRandomBook($db);

// Return book details as JSON
header('Content-Type: application/json');
echo json_encode($book);
?>
