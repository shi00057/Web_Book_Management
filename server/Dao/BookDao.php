<?php
require_once('AbstractDao.php');

class BookDao extends AbstractDao
{
    function __construct()
    {
        try {
            parent::__construct();
        } catch (mysqli_sql_exception $e) {
            throw $e;
        }
    }

    /**
     * @return mixed
     */
    public function getBooks()
    {
        $stmt = $this->conn->prepare("SELECT distinct genre FROM books");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    public function addBookRate($bookId, $userId, $rating, $comment)
    {
        $sql = "INSERT INTO reviews (book_id, user_id, rating, comment) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $bookId);
        $stmt->bindParam(2, $userId);
        $stmt->bindParam(3, $rating);
        $stmt->bindParam(4, $comment);
        if ($stmt->execute()) {
            return "Success";
        } else {
            return "Error";
        }
    }

    public function getOneBook($book_id)
    {
        $sql1 = $this->conn->prepare("SELECT b.id, b.title, b.author, b.genre, b.description FROM books b where b.id = :book_id");
        $sql1->bindParam(':book_id', $book_id);
        $sql1->execute();
        if ($sql1->rowCount() > 0) {
            return $sql1->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    public function getBooksFromShelf($user_id)
    {
        // Prepare the SQL statement to fetch all books from the database that the user has added
        $sql = "SELECT b.* FROM books b JOIN book_shelf bs ON b.id = bs.book_id WHERE bs.user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addBook($title, $author, $genre, $description, $user_id)
    {
        $sql = "INSERT INTO books (title, author, genre, description) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        // Execute the statement with the form data
        $stmt->execute([$title, $author, $genre, $description]);
        return $this->conn->lastInsertId();
    }

    public function updateBook($title, $author, $genre, $description, $id)
    {
        $sql = "UPDATE books SET title = ?, author = ?, genre = ?, description = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        // Execute the statement with the form data
        $stmt->execute([$title, $author, $genre, $description, $id]);
    }

    public function deleteBook($id)
    {
        $sql = "DELETE FROM books WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
    }

    public function getRandomBook()
    {
        $query = "SELECT * FROM books ORDER BY RAND() LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }


}