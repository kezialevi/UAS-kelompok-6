<?php

require_once __DIR__ . '/../../config/Database.php';

class Order
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function create(
        $user_id,
        $nama_penerima,
        $no_hp,
        $alamat,
        $total,
        $metode
    )
    {
        $va = rand(
            1000000000000000,
            9999999999999999
        );

        $expired = date(
            'Y-m-d H:i:s',
            time() + 3600
        );

        $stmt = $this->conn->prepare(
            "INSERT INTO orders
            (
                user_id,
                nama_penerima,
                no_hp,
                alamat,
                total,
                metode_pembayaran,
                va_number,
                expired_at,
                payment_status,
                status
            )
            VALUES
            (
                ?,?,?,?,?,?,?,?,?,?
            )"
        );

        $stmt->execute([
            $user_id,
            $nama_penerima,
            $no_hp,
            $alamat,
            $total,
            $metode,
            $va,
            $expired,
            'pending',
            'Pending'
        ]);

        return $this->conn->lastInsertId();
    }

    public function getById($id)
    {
        $stmt = $this->conn->prepare(
            "SELECT *
             FROM orders
             WHERE id=?"
        );

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getOrderUser($user_id)
    {
        $stmt = $this->conn->prepare(
            "SELECT *
             FROM orders
             WHERE user_id=?
             ORDER BY id DESC"
        );

        $stmt->execute([$user_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllOrders()
    {
        $stmt = $this->conn->prepare(
            "SELECT
                orders.*,
                users.nama
             FROM orders
             JOIN users
             ON users.id=orders.user_id
             ORDER BY orders.id DESC"
        );

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $status)
{
    $stmt = $this->conn->prepare(
        "UPDATE orders
         SET status = ?,
             payment_status = ?
         WHERE id = ?"
    );

    if($status == 'Lunas'){
        $payment = 'paid';
    }else{
        $payment = 'pending';
    }

    return $stmt->execute([
        $status,
        $payment,
        $id
    ]);
}

    public function updatePaymentStatus(
        $id,
        $status
    )
    {
        $stmt = $this->conn->prepare(
            "UPDATE orders
             SET payment_status=?
             WHERE id=?"
        );

        return $stmt->execute([
            $status,
            $id
        ]);
    }
        public function totalPesanan()
    {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(*) as total
             FROM orders"
        );

        $stmt->execute();

        return $stmt->fetch(
            PDO::FETCH_ASSOC
        );
    }

    public function totalPendapatan()
    {
        $stmt = $this->conn->prepare(
            "SELECT
                COALESCE(
                    SUM(total),
                    0
                ) as pendapatan
             FROM orders
             WHERE payment_status='paid'"
        );

        $stmt->execute();

        return $stmt->fetch(
            PDO::FETCH_ASSOC
        );
    }

    public function countByStatus(
        $status
    )
    {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(*) as total
             FROM orders
             WHERE payment_status=?"
        );

        $stmt->execute([
            $status
        ]);

        return $stmt->fetch(
            PDO::FETCH_ASSOC
        );
    }

    public function getMonthlyOrders()
    {
        $stmt = $this->conn->prepare(
            "SELECT
                MONTH(created_at) as bulan,
                COUNT(*) as total
             FROM orders
             GROUP BY MONTH(created_at)
             ORDER BY bulan"
        );

        $stmt->execute();

        return $stmt->fetchAll(
            PDO::FETCH_ASSOC
        );
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare(
            "DELETE FROM orders
             WHERE id=?"
        );

        return $stmt->execute([
            $id
        ]);
    }
}