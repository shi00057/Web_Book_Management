<?php
require_once('AbstractDao.php');
class BookListDao extends AbstractDao {
    function __construct() {
        try{
            parent::__construct();
        } catch(mysqli_sql_exception $e){
            throw $e;
        }
    }

    function getAll($title, $author, $genre)
    {
        $sql = "SELECT * FROM books WHERE 1=1";
        $params = [];

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

        $stmt = $this->conn->prepare($sql);
        foreach ($params as $key => &$val) {
            $stmt->bindParam($key, $val);
        }
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}