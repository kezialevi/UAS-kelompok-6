<?php

require 'koneksi.php';

$data = json_decode(
    file_get_contents("php://input"),
    true
);

$stmt = $conn->prepare(
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
        ?, ?, ?, ?, ?, ?, ?, ?, ?
    )"
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
    $data['deskripsi']
]);

echo json_encode([
    "status"  => $hasil,
    "message" => $hasil
        ? "Data berhasil ditambahkan"
        : "Data gagal ditambahkan"
]);