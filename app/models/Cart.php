<?php

require_once __DIR__ . '/../../config/Database.php';

class Cart
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function add($user_id,$book_id,$qty)
    {
        $cek = $this->conn->prepare(
            "SELECT *
             FROM carts
             WHERE user_id=?
             AND book_id=?"
        );

        $cek->execute([
            $user_id,
            $book_id
        ]);

        $cart = $cek->fetch(PDO::FETCH_ASSOC);

        if($cart)
        {
            $stmt = $this->conn->prepare(
                "UPDATE carts
                 SET qty = qty + ?
                 WHERE id=?"
            );

            return $stmt->execute([
                $qty,
                $cart['id']
            ]);
        }

        $stmt = $this->conn->prepare(
            "INSERT INTO carts
            (
                user_id,
                book_id,
                qty
            )
            VALUES
            (
                ?,?,?
            )"
        );

        return $stmt->execute([
            $user_id,
            $book_id,
            $qty
        ]);
    }

    public function getCart($user_id)
    {
        $stmt = $this->conn->prepare(
            "SELECT
                carts.*,
                books.judul,
                books.gambar,
                books.harga,
                (
                    books.harga*carts.qty
                ) as subtotal
             FROM carts
             JOIN books
             ON books.id=carts.book_id
             WHERE carts.user_id=?"
        );

        $stmt->execute([
            $user_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare(
            "DELETE FROM carts
             WHERE id=?"
        );

        return $stmt->execute([$id]);
    }

    public function clearCart($user_id)
    {
        $stmt = $this->conn->prepare(
            "DELETE FROM carts
             WHERE user_id=?"
        );

        return $stmt->execute([
            $user_id
        ]);
    }
}