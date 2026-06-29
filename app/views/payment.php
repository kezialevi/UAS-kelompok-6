<?php

require 'header.php';
require_once '../app/models/Order.php';

if (!isset($_GET['id'])) {
    die("ID Pesanan tidak ditemukan.");
}

$order = new Order();
$data = $order->getById($_GET['id']);

if (!$data) {
    die("Data pesanan tidak ditemukan.");
}

?>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow">

                <div class="card-header bg-primary text-white text-center">

                    <h3 class="mb-0">
                        Pembayaran Pesanan
                    </h3>

                </div>

                <div class="card-body">

                    <h5 class="text-center">

                        Sisa Waktu Pembayaran

                    </h5>

                    <div
                        id="timer"
                        class="alert alert-danger text-center fw-bold">

                        Loading...

                    </div>

                    <hr>

                    <h5 class="text-center">

                        Metode Pembayaran

                    </h5>

                    <h4 class="text-center text-primary">

                        <?= $data['metode_pembayaran']; ?>

                    </h4>

                    <hr>

                    <?php if ($data['metode_pembayaran'] == "QRIS") { ?>

                        <div class="text-center">

                            <img
                                src="assets/qris/qris.png"
                                class="img-fluid border rounded shadow"
                                style="width:250px;">

                            <p class="mt-3 text-muted">

                                Scan QR menggunakan aplikasi pembayaran Anda.

                            </p>

                        </div>

                    <?php } else { ?>

                        <div class="text-center">

                            <h5>

                                Nomor Virtual Account

                            </h5>

                            <h3
                                id="va"
                                class="text-primary">

                                <?= $data['va_number']; ?>

                            </h3>

                            <button
                                type="button"
                                class="btn btn-outline-primary btn-sm"
                                onclick="copyVA()">

                                Copy Virtual Account

                            </button>

                        </div>

                    <?php } ?>

                    <hr>

                    <h5 class="text-center">

                        Total Pembayaran

                    </h5>

                    <h2 class="text-success text-center">

                        Rp <?= number_format($data['total']); ?>

                    </h2>

                    <hr>
                    <h5 class="text-center">

Upload Bukti Pembayaran

</h5>

<form

action="../app/controllers/PaymentController.php?action=upload"

method="POST"

enctype="multipart/form-data">

<input

type="hidden"

name="order_id"

value="<?= $data['id']; ?>">

<div class="mb-3">

<input

type="file"

name="bukti"

id="bukti"

class="form-control"

accept="image/*"

required>

</div>

<div class="text-center mb-3">

<img

id="preview"

src=""

class="img-thumbnail"

style="display:none;max-width:300px;">

</div>

<div class="d-grid mb-2">

<button

type="submit"

class="btn btn-primary">

Upload Bukti Pembayaran

</button>

</div>

</form>

<div class="d-grid gap-2">

<a

href="../app/controllers/OrderController.php?action=paid&id=<?= $data['id']; ?>"

class="btn btn-success">

Saya Sudah Bayar

</a>

<a

href="index.php?page=riwayat"

class="btn btn-outline-primary">

Riwayat Pesanan

</a>

</div>

</div>

</div>

</div>

</div>

<script>

const expired = new Date("<?= $data['expired_at']; ?>").getTime();

const timer = document.getElementById("timer");

const hitung = setInterval(function(){

const now = new Date().getTime();

const distance = expired-now;

if(distance<=0){

clearInterval(hitung);

timer.innerHTML="Pembayaran Kadaluarsa";

timer.classList.remove("alert-danger");

timer.classList.add("alert-dark");

return;

}

const jam=Math.floor(distance/(1000*60*60));

const menit=Math.floor((distance%(1000*60*60))/(1000*60));

const detik=Math.floor((distance%(1000*60))/1000);

timer.innerHTML=

jam+" Jam "+

menit+" Menit "+

detik+" Detik";

},1000);

function copyVA(){

const va=document.getElementById("va");

if(va){

navigator.clipboard.writeText(va.innerText);

alert("Nomor Virtual Account berhasil disalin.");

}

}

const bukti=document.getElementById("bukti");

const preview=document.getElementById("preview");

bukti.onchange=function(e){

const file=e.target.files[0];

if(!file) return;

preview.src=URL.createObjectURL(file);

preview.style.display="block";

}

</script>

<style>

.card{

border-radius:12px;

}

.card-header{

font-size:22px;

font-weight:bold;

}

#timer{

font-size:22px;

}

img{

border-radius:10px;

}

.btn{

border-radius:8px;

}

</style>

<?php require 'footer.php'; ?>