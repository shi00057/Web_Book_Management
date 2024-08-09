<?php
session_start();
include('./Dao/BookDao.php');
$bookDao = new BookDao();
// Get a random book
$book = $bookDao->getRandomBook();
// Return book details as JSON
header('Content-Type: application/json');
echo json_encode($book);
?>
