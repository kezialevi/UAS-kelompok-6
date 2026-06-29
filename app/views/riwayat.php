<?php

require 'header.php';

require_once '../app/models/Order.php';

$order = new Order();

$data = $order->getOrderUser(
    $_SESSION['user']['id']
);

?>

<div class="row">

<h2 class="mb-4">
Riwayat Pesanan
</h2>

<?php if(empty($data)): ?>

<div class="alert alert-warning">

Belum ada pesanan.

</div>

<?php else: ?>

<table class="table table-bordered">

<thead>

<tr>
    <th>ID Pesanan</th>
    <th>Total</th>
    <th>Metode Pembayaran</th>
    <th>Status</th>
    <th>Tanggal</th>
</tr>

</thead>

<tbody>

<?php foreach($data as $row): ?>

<tr>

<td>
#<?= $row['id']; ?>
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

$status = $row['status'];

if($status == 'Pending')
{
    echo '<span class="badge bg-warning">Pending</span>';
}
elseif($status == 'Lunas')
{
    echo '<span class="badge bg-success">Lunas</span>';
}
elseif($status == 'Diproses')
{
    echo '<span class="badge bg-info">Diproses</span>';
}
elseif($status == 'Dikirim')
{
    echo '<span class="badge bg-primary">Dikirim</span>';
}
elseif($status == 'Selesai')
{
    echo '<span class="badge bg-success">Selesai</span>';
}
else
{
    echo '<span class="badge bg-secondary">'
         .$status.
         '</span>';
}

?>

</td>

<td>
<?= $row['created_at']; ?>
</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

<?php endif; ?>

<a
href="index.php?page=books"
class="btn btn-primary">

Kembali Belanja

</a>

</div>

</div>

<?php require 'footer.php'; ?>