<?php

require 'header.php';

require_once '../app/models/Book.php';
require_once '../app/models/User.php';
require_once '../app/models/Order.php';

$book = new Book();
$user = new User();
$order = new Order();

$totalBuku = $book->countBooks();
$totalUser = $user->countUsers();
$totalOrder = $order->totalPesanan();
$pendapatan = $order->totalPendapatan();

?>

<div class="container">

<h2 class="mb-4">

Dashboard Admin

</h2>

<div class="row">

<div class="col-md-3 mb-3">

<div class="card bg-primary text-white">

<div class="card-body text-center">

<h5>Total Buku</h5>

<h2>

<?= $totalBuku['total']; ?>

</h2>

</div>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card bg-success text-white">

<div class="card-body text-center">

<h5>Total User</h5>

<h2>

<?= $totalUser['total']; ?>

</h2>

</div>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card bg-warning text-dark">

<div class="card-body text-center">

<h5>Total Pesanan</h5>

<h2>

<?= $totalOrder['total']; ?>

</h2>

</div>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card bg-danger text-white">

<div class="card-body text-center">

<h5>Pendapatan</h5>

<h5>

Rp <?= number_format(
$pendapatan['pendapatan'] ?? 0
); ?>

</h5>

</div>

</div>

</div>

</div>

<hr>

<div class="row">

<div class="col-md-3">

<a
href="index.php?page=tambah_buku"
class="btn btn-success w-100">

Tambah Buku

</a>

</div>

<div class="col-md-3">

<a
href="index.php?page=buku_admin"
class="btn btn-primary w-100">

Kelola Buku

</a>

</div>

<div class="col-md-3">

<a
href="index.php?page=pesanan"
class="btn btn-warning w-100">

Kelola Pesanan

</a>

</div>

<div class="col-md-3">

<a
href="index.php?page=users"
class="btn btn-secondary w-100">

Data User

</a>

</div>

</div>

</div>

<?php require 'footer.php'; ?>
