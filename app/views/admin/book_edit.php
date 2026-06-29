<?php

require 'header.php';

require_once '../app/models/Book.php';
require_once '../app/models/Category.php';

$book = new Book();
$category = new Category();

$data = $book->getById(
    $_GET['id']
);

$kategori =
$category->getAll();

?>

<div class="card shadow border-0">

<div class="card-body">

<h3 class="mb-4">

Edit Buku

</h3>

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

<div class="row">

<div class="col-md-6">

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

<?= $k['id'] ==
$data['category_id']
? 'selected'
: '' ?>>

<?= $k['nama_kategori']; ?>

</option>

<?php endforeach; ?>

</select>

</div>

</div>

<div class="col-md-6">

<div class="mb-3">

<label class="form-label">

Judul

</label>

<input
type="text"
name="judul"
value="<?= $data['judul']; ?>"
class="form-control"
required>

</div>

</div>

</div>

<div class="row">

<div class="col-md-6">

<div class="mb-3">

<label class="form-label">

Penulis

</label>

<input
type="text"
name="penulis"
value="<?= $data['penulis']; ?>"
class="form-control"
required>

</div>

</div>

<div class="col-md-6">

<div class="mb-3">

<label class="form-label">

Penerbit

</label>

<input
type="text"
name="penerbit"
value="<?= $data['penerbit']; ?>"
class="form-control"
required>

</div>

</div>

</div>

<div class="row">

<div class="col-md-4">

<div class="mb-3">

<label class="form-label">

Tahun Terbit

</label>

<input
type="number"
name="tahun_terbit"
value="<?= $data['tahun_terbit']; ?>"
class="form-control"
required>

</div>

</div>

<div class="col-md-4">

<div class="mb-3">

<label class="form-label">

Harga

</label>

<input
type="number"
name="harga"
value="<?= $data['harga']; ?>"
class="form-control"
required>

</div>

</div>

<div class="col-md-4">

<div class="mb-3">

<label class="form-label">

Stok

</label>

<input
type="number"
name="stok"
value="<?= $data['stok']; ?>"
class="form-control"
required>

</div>

</div>

</div>

<div class="row">

<div class="col-md-6">

<label class="form-label">

Cover Saat Ini

</label>

<br>

<img
src="assets/uploads/<?= $data['gambar']; ?>"
class="img-thumbnail"
style="
width:180px;
height:250px;
object-fit:cover;
">

</div>

<div class="col-md-6">

<div class="mb-3">

<label class="form-label">

Ganti Cover

</label>

<input
type="file"
name="gambar"
class="form-control"
accept="image/*"
onchange="previewImage(event)">

</div>

<img
id="preview"
class="img-thumbnail"
style="
display:none;
width:180px;
height:250px;
object-fit:cover;
">

</div>

</div>

<div class="mb-3 mt-4">

<label class="form-label">

Deskripsi

</label>

<textarea
name="deskripsi"
rows="5"
class="form-control"><?= $data['deskripsi']; ?></textarea>

</div>

<button
type="submit"
class="btn btn-warning">

<i class="bi bi-pencil-square"></i>

Update

</button>

<a
href="index.php?page=admin_books"
class="btn btn-secondary">

<i class="bi bi-arrow-left"></i>

Kembali

</a>

</form>

</div>

</div>

<script>

function previewImage(event)
{
    let preview =
    document.getElementById(
        'preview'
    );

    preview.src =
    URL.createObjectURL(
        event.target.files[0]
    );

    preview.style.display =
    'block';
}

</script>

<?php require 'footer.php'; ?>