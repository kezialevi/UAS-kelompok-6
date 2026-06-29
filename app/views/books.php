<?php

require 'header.php';

require_once '../app/models/Book.php';

$book = new Book();

$keyword = trim(
    $_GET['keyword'] ?? ''
);

if($keyword != '')
{
    $data = $book->search(
        $keyword
    );
}
else
{
    $data = $book->getAll();
}

?>

<div class="container mt-4">

<h2 class="mb-4">

📚 Katalog Buku

</h2>

<?php if(count($data) == 0): ?>

<div class="alert alert-warning">

Buku yang dicari tidak ditemukan.

</div>

<?php endif; ?>

<div class="row">

<?php foreach($data as $row): ?>

<div class="col-lg-3 col-md-4 col-sm-6 mb-4">

<a
href="index.php?page=detail&id=<?= $row['id']; ?>"
class="text-decoration-none text-dark">

<div class="card h-100 shadow-sm border-0 book-card">

<img
src="assets/uploads/<?= $row['gambar']; ?>"
class="card-img-top"
style="
height:320px;
object-fit:cover;
">

<div class="card-body">

<?php if(isset($row['nama_kategori'])): ?>

<span
class="badge bg-primary mb-2">

<?= $row['nama_kategori']; ?>

</span>

<?php endif; ?>

<h6 class="fw-bold">

<?= $row['judul']; ?>

</h6>

<p class="text-muted mb-2">

✍️ <?= $row['penulis']; ?>

</p>

<h5 class="text-success fw-bold">

Rp <?= number_format(
$row['harga']
); ?>

</h5>

</div>

</div>

</a>

</div>

<?php endforeach; ?>

</div>

</div>

<style>

.book-card{
    transition:.3s;
    border-radius:15px;
    overflow:hidden;
}

.book-card:hover{
    transform:translateY(-6px);
    box-shadow:
    0 10px 25px
    rgba(0,0,0,.15);
}

.book-card img{
    border-bottom:
    1px solid #eee;
}

.card-body{
    min-height:180px;
}

</style>

<?php require 'footer.php'; ?>