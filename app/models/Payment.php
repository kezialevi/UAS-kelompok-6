<?php

require_once __DIR__ . '/../../config/Database.php';

class Payment
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function create($order_id, $metode)
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO payments
            (
                order_id,
                metode,
                verifikasi
            )
            VALUES
            (
                ?,?,
                'pending'
            )"
        );

        return $stmt->execute([
            $order_id,
            $metode
        ]);
    }

    public function getAll()
    {
        $stmt = $this->conn->prepare(
            "SELECT
                payments.*,
                orders.total
             FROM payments
             JOIN orders
             ON orders.id = payments.order_id
             ORDER BY payments.id DESC"
        );

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByOrderId($order_id)
    {
        $stmt = $this->conn->prepare(
            "SELECT *
             FROM payments
             WHERE order_id=?"
        );

        $stmt->execute([$order_id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function uploadBukti($order_id, $file)
    {
        $stmt = $this->conn->prepare(
            "UPDATE payments
             SET
             bukti_transfer=?,
             tanggal_upload=NOW()
             WHERE order_id=?"
        );

        return $stmt->execute([
            $file,
            $order_id
        ]);
    }

    public function updateStatus($order_id, $status)
    {
        $stmt = $this->conn->prepare(
            "UPDATE payments
             SET verifikasi=?
             WHERE order_id=?"
        );

        return $stmt->execute([
            $status,
            $order_id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare(
            "DELETE FROM payments
             WHERE id=?"
        );

        return $stmt->execute([$id]);
    }

    public function totalPembayaran()
    {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(*) as total
             FROM payments"
        );

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function totalPending()
    {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(*) as total
             FROM payments
             WHERE verifikasi='pending'"
        );

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function totalPaid()
    {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(*) as total
             FROM payments
             WHERE verifikasi='paid'"
        );

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function totalRejected()
    {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(*) as total
             FROM payments
             WHERE verifikasi='rejected'"
        );

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}