<?php

require 'header.php';

require_once '../app/models/Book.php';

$book = new Book();

$data = $book->getAll();

?>

<div class="d-flex justify-content-between mb-3">

<h3>Kelola Buku</h3>

<a
href="index.php?page=book_create"
class="btn btn-success">

Tambah Buku

</a>

</div>

<div class="card">

<div class="card-body">

<table class="table table-bordered table-striped">

<thead>

<tr>

<th>ID</th>
<th>Cover</th>
<th>Judul</th>
<th>Penulis</th>
<th>Harga</th>
<th>Stok</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php foreach($data as $row): ?>

<tr>

<td>

<?= $row['id']; ?>

</td>

<td>

<img
src="assets/uploads/<?= $row['gambar']; ?>"
width="60">

</td>

<td>

<?= $row['judul']; ?>

</td>

<td>

<?= $row['penulis']; ?>

</td>

<td>

Rp <?= number_format(
$row['harga']
); ?>

</td>

<td>

<?= $row['stok']; ?>

</td>

<td>

<a
href="index.php?page=book_edit&id=<?= $row['id']; ?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a
href="../app/controllers/BookController.php?action=delete&id=<?= $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus buku?')">

Hapus

</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

<?php require 'footer.php'; ?>