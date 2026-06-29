<?php

require 'header.php';

require_once '../app/models/Cart.php';

$cart = new Cart();

$user_id = $_SESSION['user']['id'];

$data = $cart->getCart($user_id);

$total = 0;

foreach($data as $row)
{
    $total += $row['subtotal'];
}

$ongkir = 15000;

$grandtotal = $total + $ongkir;

?>

<div class="container">

<div class="row">

<div class="col-lg-8">

<div class="card shadow-sm border-0 mb-4">

<div class="card-body">

<h4 class="fw-bold mb-4">

<i class="bi bi-geo-alt-fill text-danger"></i>

Alamat Pengiriman

</h4>

<div class="mb-3">

<label class="form-label">

Nama Penerima

</label>

<input
type="text"
name="nama_penerima"
form="checkoutForm"
class="form-control"
required>

</div>

<div class="row">

<div class="col-md-6">

<div class="mb-3">

<label class="form-label">

Nomor HP

</label>

<input
type="text"
name="no_hp"
form="checkoutForm"
class="form-control"
required>

</div>

</div>

<div class="col-md-6">

<div class="mb-3">

<label class="form-label">

Provinsi

</label>

<select
class="form-select">

<option>Jawa Tengah</option>

<option>Jawa Barat</option>

<option>DKI Jakarta</option>

<option>DI Yogyakarta</option>

<option>Jawa Timur</option>

</select>

</div>

</div>

</div>

<div class="mb-3">

<label class="form-label">

Alamat Lengkap

</label>

<textarea
name="alamat"
form="checkoutForm"
class="form-control"
rows="4"
required></textarea>

</div>

</div>

</div>

<div class="card shadow-sm border-0 mb-4">

<div class="card-body">

<h4 class="fw-bold mb-4">

<i class="bi bi-truck text-primary"></i>

Pengiriman

</h4>

<div class="row">

<div class="col-md-6">

<label class="form-label">

Kurir

</label>

<select
class="form-select">

<option>JNE REG</option>

<option>J&T Express</option>

<option>SiCepat REG</option>

<option>POS Indonesia</option>

</select>

</div>

<div class="col-md-6">

<label class="form-label">

Estimasi

</label>

<input
type="text"
class="form-control"
value="2 - 4 Hari"
readonly>

</div>

</div>

</div>

</div>

<div class="card shadow-sm border-0">

<div class="card-body">

<h4 class="fw-bold mb-4">

<i class="bi bi-credit-card-fill text-success"></i>

Metode Pembayaran

</h4>

<form
id="checkoutForm"
action="../app/controllers/OrderController.php?action=checkout"
method="POST">

<div class="form-check mb-3">

<input
class="form-check-input"
type="radio"
name="metode"
value="BCA Virtual Account"
checked>

<label class="form-check-label">

BCA Virtual Account

</label>

</div>

<div class="form-check mb-3">

<input
class="form-check-input"
type="radio"
name="metode"
value="BRI Virtual Account">

<label class="form-check-label">

BRI Virtual Account

</label>

</div>

<div class="form-check mb-3">

<input
class="form-check-input"
type="radio"
name="metode"
value="BNI Virtual Account">

<label class="form-check-label">

BNI Virtual Account

</label>

</div>

<div class="form-check mb-3">

<input
class="form-check-input"
type="radio"
name="metode"
value="Mandiri Virtual Account">

<label class="form-check-label">

Mandiri Virtual Account

</label>

</div>

<div class="form-check mb-3">

<input
class="form-check-input"
type="radio"
name="metode"
value="Debit / Credit Card">

<label class="form-check-label">

Debit / Credit Card

</label>

</div>

<div class="form-check">

<input
class="form-check-input"
type="radio"
name="metode"
value="QRIS">

<label class="form-check-label">

QRIS

</label>

</div>

</div>

</div>

</div>
<div class="col-lg-4">

<div class="card shadow-sm border-0 sticky-top" style="top:20px;">

<div class="card-body">

<h4 class="fw-bold mb-4">

Ringkasan Belanja

</h4>

<?php foreach($data as $row): ?>

<div class="d-flex mb-3">

<img
src="assets/uploads/<?= $row['gambar']; ?>"
style="
width:70px;
height:90px;
object-fit:cover;
border-radius:8px;
">

<div class="ms-3 flex-grow-1">

<h6 class="mb-1">

<?= $row['judul']; ?>

</h6>

<small class="text-muted">

<?= $row['qty']; ?>

x

Rp <?= number_format($row['harga']); ?>

</small>

<div class="fw-bold mt-1">

Rp <?= number_format($row['subtotal']); ?>

</div>

</div>

</div>

<hr>

<?php endforeach; ?>

<div class="mb-3">

<label class="form-label">

Voucher

</label>

<div class="input-group">

<input
type="text"
class="form-control"
placeholder="Masukkan kode voucher">

<button
class="btn btn-outline-success"
type="button">

Pakai

</button>

</div>

</div>

<div class="d-flex justify-content-between mb-2">

<span>

Subtotal

</span>

<span>

Rp <?= number_format($total); ?>

</span>

</div>

<div class="d-flex justify-content-between mb-2">

<span>

Ongkir

</span>

<span>

Rp <?= number_format($ongkir); ?>

</span>

</div>

<hr>

<div class="d-flex justify-content-between mb-4">

<h5>

Total

</h5>

<h4 class="text-success fw-bold">

Rp <?= number_format($grandtotal); ?>

</h4>

</div>

<button
type="submit"
form="checkoutForm"
class="btn btn-success w-100 py-3">

<i class="bi bi-credit-card-fill"></i>

Buat Pesanan

</button>

<a
href="index.php?page=cart"
class="btn btn-outline-secondary w-100 mt-3">

Kembali ke Keranjang

</a>

</div>

</div>

</div>

</div>

</div>

<?php require 'footer.php'; ?>