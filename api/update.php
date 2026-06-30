<?php

require 'koneksi.php';

$data = json_decode(
    file_get_contents("php://input"),
    true
);

$stmt = $conn->prepare(
    "UPDATE books SET
        category_id = ?,
        judul = ?,
        penulis = ?,
        penerbit = ?,
        tahun_terbit = ?,
        harga = ?,
        stok = ?,
        gambar = ?,
        deskripsi = ?
     WHERE id = ?"
);

$hasil = $stmt->execute([
    $data['category_id'],
    $data['judul'],
    $data['penulis'],
    $data['penerbit'],
    $data['tahun_terbit'],
    $data['harga'],
    $data['stok'],
    $data['gambar'],
    $data['deskripsi'],
    $data['id']
]);

echo json_encode([
    "status"  => $hasil,
    "message" => $hasil
        ? "Data berhasil diupdate"
        : "Data gagal diupdate"
]);