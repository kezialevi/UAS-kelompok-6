<?php

require 'header.php';

require_once '../app/models/Order.php';

$order = new Order();

$stmt = $order->getAllOrders();

?>

<div class="card">

<div class="card-body">

<h3 class="mb-4">

Data Pesanan

</h3>

<table class="table table-bordered">

<thead>

<tr>

<th>ID</th>
<th>Penerima</th>
<th>Total</th>
<th>Pembayaran</th>
<th>Status</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php foreach($stmt as $row): ?>

<tr>

<td>
<?= $row['id']; ?>
</td>

<td>
<?= $row['nama_penerima']; ?>
</td>

<td>

Rp <?= number_format(
$row['total']
); ?>

</td>

<td>

<?= $row['metode_pembayaran']; ?>

</td>

<td>

<?php

if(
$row['payment_status']
== 'pending'
)
{
echo
"<span class='badge bg-warning'>
Pending
</span>";
}

elseif(
$row['payment_status']
== 'paid'
)
{
echo
"<span class='badge bg-success'>
Paid
</span>";
}

else
{
echo
"<span class='badge bg-danger'>
Expired
</span>";
}

?>

</td>

<td>

<a
href="index.php?page=order_detail&id=<?= $row['id']; ?>"
class="btn btn-primary btn-sm">

Detail

</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

<?php require 'footer.php'; ?>