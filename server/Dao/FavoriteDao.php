<?php
require_once('AbstractDao.php');
class FavoriteDao extends AbstractDao {
    function __construct() {
        try{
            parent::__construct();
        } catch(mysqli_sql_exception $e){
            throw $e;
        }
    }



    public function addFavorite($bookId, $userId){
        $sql = "INSERT INTO favorites (book_id, user_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $bookId);
        $stmt->bindParam(2, $userId);
        if ($stmt->execute()) {
            return "Success";
        } else {
            return "Error";
        }
    }

    public function deleteFavorite($bookId, $userId)
    {
        $sql = "delete from favorites where book_id = :book_id and user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":book_id", $bookId);
        $stmt->bindParam(":user_id", $userId);
        if ($stmt->execute()) {
            return "Success";
        } else {
            return "Error";
        }
    }

    public function getFavorites($user_id)
    {
        $sql = $this->conn->prepare("SELECT b.* FROM favorites f join books b on f.book_id = b.id where f.user_id = :user_id");
        $sql->bindParam(':user_id', $user_id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}