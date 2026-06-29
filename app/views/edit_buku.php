<?php

require 'header.php';

require_once '../app/models/Book.php';
require_once '../app/models/Category.php';

$book = new Book();
$category = new Category();

$data = $book->getById($_GET['id']);

$kategori = $category->getAll();

?>

<div class="container mt-4">

<div class="card">

<div class="card-header bg-warning">

<h4>Edit Buku</h4>

</div>

<div class="card-body">

<form
action="../app/controllers/BookController.php?action=update"
method="POST"
enctype="multipart/form-data">

<input
type="hidden"
name="id"
value="<?= $data['id']; ?>">

<input
type="hidden"
name="gambar_lama"
value="<?= $data['gambar']; ?>">

<div class="mb-3">

<label class="form-label">
Judul Buku
</label>

<input
type="text"
name="judul"
class="form-control"
value="<?= $data['judul']; ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">
Kategori
</label>

<select
name="category_id"
class="form-control"
required>

<?php foreach($kategori as $k): ?>

<option
value="<?= $k['id']; ?>"

<?= $k['id'] == $data['category_id']
? 'selected'
: ''; ?>>

<?= $k['nama_kategori']; ?>

</option>

<?php endforeach; ?>

</select>

</div>

<div class="mb-3">

<label class="form-label">
Penulis
</label>

<input
type="text"
name="penulis"
class="form-control"
value="<?= $data['penulis']; ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">
Penerbit
</label>

<input
type="text"
name="penerbit"
class="form-control"
value="<?= $data['penerbit']; ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">
Tahun Terbit
</label>

<input
type="number"
name="tahun_terbit"
class="form-control"
value="<?= $data['tahun_terbit']; ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">
Harga
</label>

<input
type="number"
name="harga"
class="form-control"
value="<?= $data['harga']; ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">
Stok
</label>

<input
type="number"
name="stok"
class="form-control"
value="<?= $data['stok']; ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">
Cover Saat Ini
</label>

<br>

<img
src="assets/uploads/<?= $data['gambar']; ?>"
width="150"
class="img-thumbnail">

</div>

<div class="mb-3">

<label class="form-label">
Ganti Cover Buku
</label>

<input
type="file"
name="gambar"
class="form-control">

</div>

<div class="mb-3">

<label class="form-label">
Deskripsi
</label>

<textarea
name="deskripsi"
class="form-control"
rows="5"
required><?= $data['deskripsi']; ?></textarea>

</div>

<button
type="submit"
class="btn btn-warning">

Update Buku

</button>

<a
href="index.php?page=dashboard"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

<?php require 'footer.php'; ?>
