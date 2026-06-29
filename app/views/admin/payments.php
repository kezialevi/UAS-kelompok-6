<?php

require 'header.php';
require_once '../app/models/Payment.php';

$payment = new Payment();
$data = $payment->getAll();

?>

<div class="container-fluid py-4">

<div class="card shadow border-0">

<div class="card-header bg-primary text-white">

<div class="d-flex justify-content-between align-items-center">

<h3 class="mb-0">

<i class="bi bi-credit-card"></i>

Data Pembayaran

</h3>

<span class="badge bg-light text-dark">

<?= count($data); ?> Transaksi

</span>

</div>

</div>

<div class="card-body">

<div class="row mb-3">

<div class="col-md-4">

<input
type="text"
class="form-control"
id="search"
placeholder="Cari Order atau Metode...">

</div>

</div>

<div class="table-responsive">

<table class="table table-hover align-middle">

<thead class="table-dark">

<tr>


<th>Order</th>

<th>Total</th>

<th>Metode</th>

<th>Status</th>

<th>Bukti Transfer</th>

<th>Tanggal Upload</th>

<th width="220">

Aksi

</th>

</tr>

</thead>

<tbody id="paymentTable">

<?php foreach($data as $row): ?>

<tr>

<td>

#<?= $row['order_id']; ?>

</td>

<td>

Rp <?= number_format($row['total']); ?>

</td>

<td>

<?= $row['metode']; ?>

</td>

<td>

<?php

switch($row['verifikasi']){

case 'paid':

echo '<span class="badge bg-success">Paid</span>';

break;

case 'pending':

echo '<span class="badge bg-warning text-dark">Pending</span>';

break;

case 'rejected':

echo '<span class="badge bg-danger">Rejected</span>';

break;

default:

echo '<span class="badge bg-secondary">'.$row['verifikasi'].'</span>';

}

?>

</td>

<td>

<?php if($row['bukti_transfer']!=""){ ?>

<a

href="assets/bukti/<?= $row['bukti_transfer']; ?>"

target="_blank"

class="btn btn-primary btn-sm">

<i class="bi bi-image"></i>

Lihat

</a>

<?php }else{ ?>

<span class="text-muted">

Belum Upload

</span>

<?php } ?>

</td>

<td>

<?=

$row['tanggal_upload']

?

date(

'd-m-Y H:i',

strtotime($row['tanggal_upload'])

)

:

'-';

?>

</td>

<td>

<?php if($row['verifikasi']=="pending" && !empty($row['bukti_transfer'])){ ?>

<a

href="../app/controllers/PaymentController.php?action=accept&id=<?= $row['order_id']; ?>"

class="btn btn-success btn-sm">

ACC

</a>

<a

href="../app/controllers/PaymentController.php?action=reject&id=<?= $row['order_id']; ?>"

class="btn btn-danger btn-sm">

DENY

</a>

<?php }elseif($row['verifikasi']=="paid"){ ?>

<span class="badge bg-success">

Disetujui

</span>

<?php }elseif($row['verifikasi']=="rejected"){ ?>

<span class="badge bg-danger">

Ditolak

</span>

<?php } ?>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

</div>

</tbody>

</table>

</div>

</div>

</div>
<style>

.card{
    border-radius:12px;
}

.card-header{
    border-radius:12px 12px 0 0 !important;
}

.table tbody tr:hover{
    background:#f8f9fa;
}

.badge{
    font-size:13px;
}

.btn{
    border-radius:8px;
}

#search{
    border-radius:8px;
}

</style>

<script>

const search=document.getElementById("search");

search.addEventListener("keyup",function(){

    let value=this.value.toLowerCase();

    let rows=document.querySelectorAll("#paymentTable tr");

    rows.forEach(function(row){

        let text=row.innerText.toLowerCase();

        if(text.indexOf(value)>-1){

            row.style.display="";

        }else{

            row.style.display="none";

        }

    });

});

</script>

<?php require 'footer.php'; ?>