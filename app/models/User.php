<?php

require_once __DIR__ . '/../../config/Database.php';

class User
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function register(
        $nama,
        $email,
        $password
    )
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO users
            (
                nama,
                email,
                password
            )
            VALUES
            (
                ?,?,?
            )"
        );

        return $stmt->execute([
            $nama,
            $email,
            password_hash(
                $password,
                PASSWORD_DEFAULT
            )
        ]);
    }

    public function login(
        $email
    )
    {
        $stmt = $this->conn->prepare(
            "SELECT *
             FROM users
             WHERE email=?"
        );

        $stmt->execute([
            $email
        ]);

        return $stmt->fetch(
            PDO::FETCH_ASSOC
        );
    }

    public function saveRememberToken(
    $id,
    $token
)
{
    $stmt = $this->conn->prepare(
        "UPDATE users
         SET remember_token=?
         WHERE id=?"
    );

    return $stmt->execute([
        $token,
        $id
    ]);
}

public function getByRememberToken(
    $token
)
{
    $stmt = $this->conn->prepare(
        "SELECT *
         FROM users
         WHERE remember_token=?"
    );

    $stmt->execute([
        $token
    ]);

    return $stmt->fetch(
        PDO::FETCH_ASSOC
    );
}

    public function clearRememberToken(
        $id
    )
    {
        $stmt = $this->conn->prepare(
            "UPDATE users
            SET remember_token=NULL
            WHERE id=?"
        );

        return $stmt->execute([
            $id
        ]);
    }

    public function getById(
        $id
    )
    {
        $stmt = $this->conn->prepare(
            "SELECT *
             FROM users
             WHERE id=?"
        );

        $stmt->execute([
            $id
        ]);

        return $stmt->fetch(
            PDO::FETCH_ASSOC
        );
    }

    public function getAll()
    {
        $stmt = $this->conn->prepare(
            "SELECT *
             FROM users
             ORDER BY id DESC"
        );

        $stmt->execute();

        return $stmt->fetchAll(
            PDO::FETCH_ASSOC
        );
    }

    public function countUsers()
    {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(*) as total
             FROM users"
        );

        $stmt->execute();

        return $stmt->fetch(
            PDO::FETCH_ASSOC
        );
    }

    public function updateRole(
        $id,
        $role
    )
    {
        $stmt = $this->conn->prepare(
            "UPDATE users
             SET role=?
             WHERE id=?"
        );

        return $stmt->execute([
            $role,
            $id
        ]);
    }

    public function delete(
        $id
    )
    {
        $stmt = $this->conn->prepare(
            "DELETE FROM users
             WHERE id=?"
        );

        return $stmt->execute([
            $id
        ]);
    }
}