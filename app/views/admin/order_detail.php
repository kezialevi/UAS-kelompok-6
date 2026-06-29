<?php

require 'header.php';

require_once '../app/models/OrderDetail.php';

$detail = new OrderDetail();

$data =
$detail->getByOrder(
$_GET['id']
);

?>

<div class="card">

<div class="card-body">

<h3>

Detail Pesanan

</h3>

<table class="table table-bordered">

<tr>

<th>Buku</th>
<th>Qty</th>
<th>Harga</th>
<th>Subtotal</th>

</tr>

<?php foreach($data as $row): ?>

<tr>

<td>

<?= $row['judul']; ?>

</td>

<td>

<?= $row['qty']; ?>

</td>

<td>

Rp <?= number_format(
$row['harga']
); ?>

</td>

<td>

Rp <?= number_format(
$row['subtotal']
); ?>

</td>

</tr>

<?php endforeach; ?>

</table>

</div>

</div>

<?php require 'footer.php'; ?>