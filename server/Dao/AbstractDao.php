<?php
// Name: Guokai Shi
// File Name: AbstractDao.php
// Date Created: 2024-07-18
// Description: This PHP file establishes a connection to the MySQL database.
class AbstractDao {
    private $host = 'localhost';
    private $db_name = 'GroupTask';
    private $username = 'cst8285';
    private $password = 'password';
    public $conn;

    public function __construct() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
