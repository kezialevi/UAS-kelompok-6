<?php

require_once '../app/models/Book.php';

$book = new Book();

$data = $book->getById($_GET['id']);

?>

<!DOCTYPE html>
<html>
<head>

<title><?= $data['judul']; ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

<div class="row">

<div class="col-md-4">

<img
src="assets/uploads/<?= $data['gambar']; ?>"
class="img-fluid rounded">

</div>

<div class="col-md-8">

<h2>
<?= $data['judul']; ?>
</h2>

<hr>

<p>
<strong>Penulis :</strong>
<?= $data['penulis']; ?>
</p>

<p>
<strong>Penerbit :</strong>
<?= $data['penerbit']; ?>
</p>

<p>
<strong>Tahun Terbit :</strong>
<?= $data['tahun_terbit']; ?>
</p>

<p>
<strong>Stok :</strong>
<?= $data['stok']; ?>
</p>

<h3 class="text-success">
Rp <?= number_format($data['harga']); ?>
</h3>

<p>
<?= $data['deskripsi']; ?>
</p>

<form
action="../app/controllers/CartController.php?action=add"
method="POST">

<input
type="hidden"
name="book_id"
value="<?= $data['id']; ?>">

<input
type="number"
name="qty"
value="1"
min="1"
class="form-control mb-3">

<button
type="submit"
class="btn btn-success">

Tambah Keranjang

</button>

</form>

<a
href="index.php?page=books"
class="btn btn-secondary mt-3">

Kembali

</a>

</div>

</div>

</div>

</body>
</html>