<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search Books</title>
    <link rel="stylesheet" href="../CSS/search_book.css">
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

<div>
    <form action="search_book.php" method="get">
        <div class="nav">
            <span>Title:<input type="text" name="title"/></span>
            <span>Author:<input type="text" name="author"></span>
            <span>Genre:<select id="genre" name="genre"></select></span>
            <button type="submit">Search</button>
        </div>
    </form>
    <div class="container" id="bookList">

    </div>
</div>
<?php include('footer.php'); ?>
</body>
</html>

<?php
require_once('Dao/db_connection.php');
$title = isset($_GET['title']) ? $_GET['title'] : '';
$author = isset($_GET['author']) ? $_GET['author'] : '';
$genre = isset($_GET['genre']) ? $_GET['genre'] : '';
$database = new Database();
$db = $database->getConnection();
// 初始化 SQL 查询和条件数组
$sql = "SELECT * FROM books WHERE 1=1";
$params = [];

// 动态添加条件
if (!empty($title)) {
    $sql .= " AND title LIKE :title";
    $params[':title'] = "%$title%";
}

if (!empty($author)) {
    $sql .= " AND author LIKE :author";
    $params[':author'] = "%$author%";
}

if (!empty($genre)) {
    $sql .= " AND genre = :genre";
    $params[':genre'] = $genre;
}

$stmt = $db->prepare($sql);
foreach ($params as $key => &$val) {
    $stmt->bindParam($key, $val);
}
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$bookListContent = '';
// 输出查询结果
foreach ($results as $book) {
    $bookListContent .= "<div class=\"box\"><div class=\"item\">Title: {$book['title']}</div><div class=\"item\">Author: {$book['author']}</div><div class=\"item\">Genre: {$book['genre']}</div><div class=\"item\">Description: {$book['description']}</div><button type=\"button\" onclick=\"detail({$book['id']})\">Detail</button><button id=\"favorite{$book['id']}\" onclick=\"favorite({$book['id']})\">favorite</button></div>";
}
echo "<script>document.getElementById(\"bookList\").innerHTML = '$bookListContent';</script>";
?>

<?php
require_once('./Dao/db_connection.php');

// Get database connection
$database = new Database();
$db = $database->getConnection();
$sql = $db->prepare("SELECT distinct genre FROM books");
$sql->execute();
if ($sql->rowCount() > 0) {
    $books = $sql->fetchAll(PDO::FETCH_ASSOC);

    $genreOptions = '<option value="">All</option>';
    foreach ($books as $book) {
        $genreOptions .= "<option value=\"{$book['genre']}\">{$book['genre']}</option>";

    }
    echo "<script>document.getElementById('genre').innerHTML='$genreOptions';</script>";
}
?>
<script>
    function favorite(bookId) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "add_favorite.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById('favorite' + bookId).style.color = 'red';
            }
        };
        xhr.send("book_id=" + bookId);
    }

    function detail(bookId) {
        window.open('detail.php?book_id='+bookId, '_blank');
    }

</script>

