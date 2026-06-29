<?php

require_once __DIR__ . '/../../config/Database.php';

class Category
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAll()
    {
        $stmt = $this->conn->prepare(
            "SELECT *
             FROM categories
             ORDER BY nama_kategori"
        );

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}