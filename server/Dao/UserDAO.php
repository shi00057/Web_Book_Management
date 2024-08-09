<?php
//Name: Guokai Shi
// File Name: UserDAO.php
// Date Created: 2024-07-18
// Description: This PHP file contains data access object (DAO) methods for user-related database operations.
class UserDAO extends AbstractDao {
    private $table_name = "users";

    function __construct()
    {
        try {
            parent::__construct();
        } catch (mysqli_sql_exception $e) {
            throw $e;
        }
    }

    public function login($email, $password) {
        $query = "SELECT id, password FROM " . $this->table_name . " WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($password === $row['password']) {
                return $row['id'];
            }
        }
        return false;
    }

    
    public function getUserNameById($userId) {
        $query = "SELECT username FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $userId);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['username'];
        }
        return 'Guest';
    }

    public function getUserByEmail($email) {
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return [];
    }

    public function addUser($username, $email, $password)
    {
        $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$username, $email, $password]);
        return $this->conn->lastInsertId();
    }
}
?>
