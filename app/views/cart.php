<?php

require 'header.php';

require_once '../app/models/Cart.php';

$cart = new Cart();

$data = $cart->getCart(
    $_SESSION['user']['id']
);

$total = 0;

?>

<div class="row">

<div class="col-12">

<h2 class="mb-4">
Keranjang Belanja
</h2>

<table class="table table-bordered">

<thead>

<tr>
    <th>Judul Buku</th>
    <th>Harga</th>
    <th>Qty</th>
    <th>Subtotal</th>
    <th>Aksi</th>
</tr>

</thead>

<tbody>

<?php foreach($data as $item): ?>

<?php

$subtotal =
    $item['harga'] *
    $item['qty'];

$total += $subtotal;

?>

<tr>

<td>
<?= $item['judul']; ?>
</td>

<td>
Rp <?= number_format(
    $item['harga']
); ?>
</td>

<td>
<?= $item['qty']; ?>
</td>

<td>
Rp <?= number_format(
    $subtotal
); ?>
</td>

<td>

<a
href="../app/controllers/CartController.php?action=remove&id=<?= $item['id']; ?>"
class="btn btn-danger btn-sm">

Hapus

</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

<div class="text-end">

<h3>
Total :
Rp <?= number_format(
    $total
); ?>
</h3>

</div>

<div class="mt-4">

<a
href="index.php?page=books"
class="btn btn-secondary">

Lanjut Belanja

</a>

<a
href="index.php?page=checkout"
class="btn btn-success">

Checkout

</a>

</div>

</div>

</div>

<?php require 'footer.php'; ?>