<?php

require 'koneksi.php';

if (isset($_GET['id']))
{
    $stmt = $conn->prepare(
        "SELECT
            books.*,
            categories.nama_kategori
         FROM books
         LEFT JOIN categories
         ON books.category_id = categories.id
         WHERE books.id = ?"
    );

    $stmt->execute([
        $_GET['id']
    ]);

    echo json_encode(
        $stmt->fetch(PDO::FETCH_ASSOC),
        JSON_PRETTY_PRINT
    );
}
else
{
    $stmt = $conn->prepare(
        "SELECT
            books.*,
            categories.nama_kategori
         FROM books
         LEFT JOIN categories
         ON books.category_id = categories.id
         ORDER BY books.id DESC"
    );

    $stmt->execute();

    echo json_encode(
        $stmt->fetchAll(PDO::FETCH_ASSOC),
        JSON_PRETTY_PRINT
    );
}