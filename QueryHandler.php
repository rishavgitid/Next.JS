<?php
class QueryHandler
{
    private $conn;

    public function __construct()
    {
        $this->connectDatabase();
        $this->createTable();
    }

    private function connectDatabase()
    {
        $host = 'sql208.infinityfree.com';
        $db = 'if0_37861611_helping_hands';
        $user = 'if0_37861611';
        $pass = 'Rishav3738';

        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    private function createTable()
    {
        $sql = "
        CREATE TABLE IF NOT EXISTS queries (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            phone VARCHAR(15) NOT NULL,
            message TEXT NOT NULL,
            status ENUM('Pending', 'Solved') DEFAULT 'Pending',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $this->conn->exec($sql);
    }

    public function saveQuery($name, $email, $phone, $message)
    {
        $sql = "INSERT INTO queries (name, email, phone, message) VALUES (:name, :email, :phone, :message)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':message', $message);

        return $stmt->execute();
    }

    public function getTotalQueryCount()
    {
        $sql = "SELECT COUNT(*) as count FROM queries";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['count'] ?? 0;
    }
}
