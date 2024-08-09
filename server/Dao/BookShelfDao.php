<?php
require_once('AbstractDao.php');

class BookShelfDao extends AbstractDao
{
    function __construct()
    {
        try {
            parent::__construct();
        } catch (mysqli_sql_exception $e) {
            throw $e;
        }
    }

    public function addBookShelf($book_id, $user_id)
    {
        $sql = "INSERT INTO book_shelf (user_id, book_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id, $book_id]);
    }

    public function getShelf($user_id, $id)
    {
        $sql = "SELECT * FROM book_shelf WHERE user_id = ? AND book_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id, $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteBookShelf($id)
    {
        $sql = "DELETE FROM book_shelf WHERE book_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
    }


}