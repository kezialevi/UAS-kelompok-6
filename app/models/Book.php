<?php

require_once __DIR__ . '/../../config/Database.php';

class Book
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
            "SELECT books.*,
                    categories.nama_kategori
             FROM books
             LEFT JOIN categories
             ON books.category_id=categories.id
             ORDER BY books.id DESC"
        );

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->conn->prepare(
            "SELECT *
             FROM books
             WHERE id=?"
        );

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function search($keyword)
    {
        $stmt = $this->conn->prepare(
            "SELECT *
             FROM books
             WHERE judul LIKE ?
             OR penulis LIKE ?"
        );

        $search = "%".$keyword."%";

        $stmt->execute([
            $search,
            $search
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(
        $category_id,
        $judul,
        $penulis,
        $penerbit,
        $tahun_terbit,
        $harga,
        $stok,
        $gambar,
        $deskripsi
    )
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO books
            (
                category_id,
                judul,
                penulis,
                penerbit,
                tahun_terbit,
                harga,
                stok,
                gambar,
                deskripsi
            )
            VALUES
            (
                ?,?,?,?,?,?,?,?,?
            )"
        );

        return $stmt->execute([
            $category_id,
            $judul,
            $penulis,
            $penerbit,
            $tahun_terbit,
            $harga,
            $stok,
            $gambar,
            $deskripsi
        ]);
    }

    public function update(
        $id,
        $category_id,
        $judul,
        $penulis,
        $penerbit,
        $tahun_terbit,
        $harga,
        $stok,
        $gambar,
        $deskripsi
    )
    {
        $stmt = $this->conn->prepare(
            "UPDATE books
             SET
             category_id=?,
             judul=?,
             penulis=?,
             penerbit=?,
             tahun_terbit=?,
             harga=?,
             stok=?,
             gambar=?,
             deskripsi=?
             WHERE id=?"
        );

        return $stmt->execute([
            $category_id,
            $judul,
            $penulis,
            $penerbit,
            $tahun_terbit,
            $harga,
            $stok,
            $gambar,
            $deskripsi,
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare(
            "DELETE FROM books
             WHERE id=?"
        );

        return $stmt->execute([$id]);
    }

    public function countBooks()
    {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(*) as total
             FROM books"
        );

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}