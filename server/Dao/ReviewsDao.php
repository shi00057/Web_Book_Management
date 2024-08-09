<?php
require_once('AbstractDao.php');
class ReviewsDao extends AbstractDao {
    function __construct() {
        try{
            parent::__construct();
        } catch(mysqli_sql_exception $e){
            throw $e;
        }
    }

    public function getReviews($bookId){
        $sql2 = $this->conn->prepare("SELECT u.username, r.rating, r.comment FROM reviews r join users u on r.user_id = u.id where r.book_id = :book_id");
        $sql2->bindParam(':book_id', $bookId);
        $sql2->execute();
        if ($sql2->rowCount() > 0) {
            return $sql2->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }
}