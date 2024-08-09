<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Favorite Books</title>
    <link rel="stylesheet" href="../CSS/favorite_list.css">
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
<div class="container" id="favoriteBookList"></div>
<?php include('footer.php'); ?>
</body>
</html>

<?php
session_start();
require_once('Dao/AbstractDao.php');
require_once('Dao/FavoriteDao.php');
// Get database connection

$favoriteDao = new FavoriteDao();
$results = $favoriteDao->getFavorites($_SESSION['user_id']);
$bookListContent = '';
foreach ($results as $book) {
    $bookListContent .= "<div id=\"favorite{$book['id']}\" class=\"box\"><div class=\"item\">Title: {$book['title']}</div><div class=\"item\">Author: {$book['author']}</div><div class=\"item\">Genre: {$book['genre']}</div><div class=\"item\">Description: {$book['description']}</div><button onclick=\"deleteFavorite({$book['id']})\">delete favorite</button></div>";
}
echo "<script>document.getElementById(\"favoriteBookList\").innerHTML = '$bookListContent';</script>";
?>
<script>
    function deleteFavorite(bookId) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "delete_favorite.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById('favorite' + bookId).style.color = 'red';
            }
        };
        xhr.send("book_id=" + bookId);
        document.getElementById("favorite" + bookId).style.display = "none";
    }
</script>
