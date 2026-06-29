<?php

require_once __DIR__ . '/../../config/Database.php';

class OrderDetail
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function create(
        $order_id,
        $book_id,
        $qty,
        $harga,
        $subtotal
    )
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO order_details
            (
                order_id,
                book_id,
                qty,
                harga,
                subtotal
            )
            VALUES
            (
                ?,?,?,?,?
            )"
        );

        return $stmt->execute([
            $order_id,
            $book_id,
            $qty,
            $harga,
            $subtotal
        ]);
    }

    public function getByOrder($order_id)
    {
        $stmt = $this->conn->prepare(
            "SELECT
                order_details.*,
                books.judul
             FROM order_details
             JOIN books
             ON books.id=order_details.book_id
             WHERE order_id=?"
        );

        $stmt->execute([
            $order_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}