<?php session_start();
require_once('Dao/db_connection.php');
require_once('Dao/UserDAO.php');
$database = new Database();
$db = $database->getConnection();
$userDAO = new UserDAO($db);

// Get the user ID from the session
$userId = $_SESSION['user_id'];

// Fetch user information
$user_name = $userDAO->getUserNameById($userId);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book Detail</title>
    <link rel="stylesheet" href="../CSS/detail.css">
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
    <div id="bookInformation">
        <div>Title:<span id="title"></div>
        <div>Author:<span id="author"></div>
        <div>Genre:<span id="genre"></div>
        <div>Description:<span id="description"></div>
    </div>
    <div id="ratingDiv">
        <div id="rating" class="rating">
            <span data-value="5">&#9733;</span>
            <span data-value="4">&#9733;</span>
            <span data-value="3">&#9733;</span>
            <span data-value="2">&#9733;</span>
            <span data-value="1">&#9733;</span>
        </div>
        <div>
            Comment:
            <textarea id="comment"></textarea>
        </div>
        <button type="button" id="submitComment" onclick="rate(<?php echo htmlspecialchars($_GET['book_id']);?>,<?php echo htmlspecialchars($_SESSION['user_id']);?>)">Submit
        </button>
    </div>
    <hr>
    <div id="reviews">

    </div>
</div>
<?php include('footer.php'); ?>
</body>
</html>
<script>
    function rate(bookId, userId) {

        var rating = document.querySelector('.rating span.selected').getAttribute("data-value");
        let comment = document.getElementById("comment").value;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "rate.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var params = "book_id=" + encodeURIComponent(bookId)  + "&userId=" + encodeURIComponent(userId) + "&rating=" + encodeURIComponent(rating) + "&comment=" + encodeURIComponent(comment);

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) { // Request is complete
                if (xhr.status === 200) { // Success
                    if (xhr.responseText === "Success") {
                        let parentDiv = document.getElementById("reviews");
                        const newChildDiv = document.createElement('div');
                        var ratingCount = '';
                        for (i = 0; i < rating; i++) {
                            ratingCount += '<span style="color: #ffcc00;">&#9733;</span>';
                        }
                        newChildDiv.innerHTML = '<div class="box"><div class="item"><?php echo htmlspecialchars($user_name);?></div><div class="item">'+ratingCount+'</div><div class="item">'+comment+'</div></div>';
                        parentDiv.insertBefore(newChildDiv, parentDiv.firstChild);
                        document.getElementById("comment").value = '';
                        var selectedSpans = document.querySelectorAll('#rating .selected');
                        selectedSpans.forEach(function(span) {
                            span.classList.remove('selected');
                            span.classList.remove('hover');
                        });
                    }
                } else {
                    console.error('Error: ' + xhr.status); // Handle error case
                }
            }
        };
        xhr.send(params);
    }

    // script.js
    document.addEventListener('DOMContentLoaded', () => {
        const stars = document.querySelectorAll('.rating span');
        const ratingValue = document.getElementById('ratingValue');

        stars.forEach(star => {
            star.addEventListener('mouseover', () => {
                const value = star.getAttribute('data-value');
                updateStars(value);
            });

            star.addEventListener('mouseout', () => {
                updateStars(getSelectedValue());
            });

            star.addEventListener('click', () => {
                const value = star.getAttribute('data-value');
                setSelectedValue(value);
            });
        });

        function updateStars(max) {
            stars.forEach(star => {
                if (parseInt(star.getAttribute('data-value')) <= max) {
                    star.classList.add('hover');
                } else {
                    star.classList.remove('hover');
                }
            });
        }

        function setSelectedValue(value) {
            stars.forEach(star => {
                if (parseInt(star.getAttribute('data-value')) <= value) {
                    star.classList.add('selected');
                } else {
                    star.classList.remove('selected');
                }
            });
        }

        function getSelectedValue() {
            const selected = document.querySelector('.rating span.selected');
            return selected ? selected.getAttribute('data-value') : 0;
        }
    });

</script>

<?php
require_once('Dao/db_connection.php');
// Get database connection
$database = new Database();
$db = $database->getConnection();
$sql1 = $db->prepare("SELECT b.id, b.title, b.author, b.genre, b.description FROM books b where b.id = :book_id");
$sql1->bindParam(':book_id', $_GET['book_id']);
$sql1->execute();
if ($sql1->rowCount() > 0) {
    $results = $sql1->fetchAll(PDO::FETCH_ASSOC);
    $bookInformation = '';
// 输出查询结果
    foreach ($results as $book) {
        echo "<script>document.getElementById(\"title\").innerHTML = '{$book['title']}';
document.getElementById(\"author\").innerHTML = '{$book['author']}';
document.getElementById(\"genre\").innerHTML = '{$book['genre']}';
document.getElementById(\"description\").innerHTML = '{$book['description']}';
</script>";
    }
}

$sql2 = $db->prepare("SELECT u.username, r.rating, r.comment FROM reviews r join users u on r.user_id = u.id where r.book_id = :book_id");
$sql2->bindParam(':book_id', $_GET['book_id']);
$sql2->execute();
if ($sql2->rowCount() > 0) {
    $results = $sql2->fetchAll(PDO::FETCH_ASSOC);
    $reviewContent = '';
// 输出查询结果
    foreach ($results as $review) {
        $rating = $review['rating'];
        $comment = $review['comment'];
        $username = $review['username'];
        $ratingCount = '';
        for ($i = 0; $i < $rating; $i++) {
            $ratingCount .= "<span style=\"color: yellow;\">&#9733;</span>";
        }
        $reviewContent .= "<div class=\"box\"><div class=\"item\">$username</div><div class=\"item\">$ratingCount</div><div class=\"item\">$comment</div></div>";
    }
    echo "<script>document.getElementById(\"reviews\").innerHTML = '$reviewContent';</script>";

}
?>