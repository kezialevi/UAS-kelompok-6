<?php

require 'koneksi.php';

$data = json_decode(
    file_get_contents("php://input"),
    true
);

$stmt = $conn->prepare(
    "DELETE FROM books
     WHERE id = ?"
);

$hasil = $stmt->execute([
    $data['id']
]);

echo json_encode([
    "status"  => $hasil,
    "message" => $hasil
        ? "Data berhasil dihapus"
        : "Data gagal dihapus"
]);