<?php
class Database
{
    private $host = 'localhost';
    private $db = 'book_inventory';
    private $user = 'root';
    private $pass = '';
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getPdo()
    {
        return $this->pdo;
    }
}
