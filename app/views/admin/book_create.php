<?php

require 'header.php';

require_once '../app/models/Category.php';

$category = new Category();

$kategori = $category->getAll();

?>

<div class="card shadow border-0">

<div class="card-body">

<h3 class="mb-4">

Tambah Buku

</h3>

<form
action="../app/controllers/BookController.php?action=create"
method="POST"
enctype="multipart/form-data">

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
value="<?= $k['id']; ?>">

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
class="form-control"
required>

</div>

</div>

</div>

<div class="mb-3">

<label class="form-label">

Cover Buku

</label>

<input
type="file"
name="gambar"
class="form-control"
accept="image/*"
required
onchange="previewImage(event)">

</div>

<div class="mb-3">

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

<div class="mb-3">

<label class="form-label">

Deskripsi

</label>

<textarea
name="deskripsi"
rows="5"
class="form-control"></textarea>

</div>

<button
type="submit"
class="btn btn-success">

<i class="bi bi-save"></i>

Simpan

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