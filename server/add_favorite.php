<?php
session_start();
require_once('Dao/AbstractDao.php');
require_once ('Dao/FavoriteDao.php');
if (isset($_POST['book_id']) && isset($_SESSION['user_id'])) {
    $bookId = $_POST['book_id'];
    $userId = $_SESSION['user_id'];
    $favoriteDao = new FavoriteDao();
    echo $favoriteDao->addFavorite($bookId, $userId);
} else {
    echo "Invalid request";
}

