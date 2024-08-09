<?php
session_start();
require_once('Dao/AbstractDao.php');
require_once ('Dao/BookDao.php');

if (isset($_POST['book_id']) && isset($_POST['rating']) && isset($_SESSION['user_id'])) {
    $bookId = $_POST['book_id'];
    $userId = $_SESSION['user_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    $bookDao = new BookDao();
    echo $bookDao->addBookRate($bookId, $userId, $rating, $comment);
} else {
    echo "Invalid request";
}

