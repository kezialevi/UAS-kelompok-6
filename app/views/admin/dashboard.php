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

$pending = $order->countByStatus('pending');
$paid = $order->countByStatus('paid');
$expired = $order->countByStatus('expired');

$monthly = $order->getMonthlyOrders();

$dataChart = array_fill(0,12,0);

foreach($monthly as $m)
{
    $dataChart[$m['bulan'] - 1] = $m['total'];
}

$orders = $order->getAllOrders();

?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="row">

    <div class="col-md-3 mb-3">

        <div class="card bg-primary text-white shadow border-0">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <h6>Total Buku</h6>

                        <h3>
                            <?= $totalBuku['total']; ?>
                        </h3>

                    </div>

                    <i class="bi bi-book fs-1"></i>

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-3">

        <div class="card bg-success text-white shadow border-0">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <h6>Total User</h6>

                        <h3>
                            <?= $totalUser['total']; ?>
                        </h3>

                    </div>

                    <i class="bi bi-people fs-1"></i>

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-3">

        <div class="card bg-warning text-dark shadow border-0">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <h6>Total Pesanan</h6>

                        <h3>
                            <?= $totalOrder['total']; ?>
                        </h3>

                    </div>

                    <i class="bi bi-cart fs-1"></i>

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-3">

        <div class="card bg-danger text-white shadow border-0">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <h6>Pendapatan</h6>

                        <h5>

                            Rp <?= number_format(
                                $pendapatan['pendapatan'] ?? 0
                            ); ?>

                        </h5>

                    </div>

                    <i class="bi bi-cash-stack fs-1"></i>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-md-8">

        <div class="card shadow border-0">

            <div class="card-body">

                <h5 class="mb-3">

                    Grafik Pesanan Bulanan

                </h5>

                <canvas
                    id="orderChart"
                    height="100">
                </canvas>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card shadow border-0">

            <div class="card-body">

                <h5 class="mb-3">

                    Status Pembayaran

                </h5>

                <canvas
                    id="statusChart"
                    height="220">
                </canvas>

            </div>

        </div>

    </div>

</div>

<div class="card shadow border-0 mt-4">

    <div class="card-body">

        <h5 class="mb-3">

            Pesanan Terbaru

        </h5>

        <table class="table table-sm table-hover">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>User</th>
                    <th>Total</th>
                    <th>Metode</th>
                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

                <?php

                foreach(
                    array_slice(
                        $orders,
                        0,
                        5
                    )
                    as $row
                ):

                ?>

                <tr>

                    <td>

                        #<?= $row['id']; ?>

                    </td>

                    <td>

                        <?= $row['nama']; ?>

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
                            == 'paid'
                        )
                        {
                            echo "<span class='badge bg-success'>Paid</span>";
                        }
                        elseif(
                            $row['payment_status']
                            == 'pending'
                        )
                        {
                            echo "<span class='badge bg-warning'>Pending</span>";
                        }
                        else
                        {
                            echo "<span class='badge bg-danger'>Expired</span>";
                        }

                        ?>

                    </td>

                </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>

<script>

new Chart(
document.getElementById(
'orderChart'
),
{
type:'bar',
data:{
labels:[
'Jan',
'Feb',
'Mar',
'Apr',
'Mei',
'Jun',
'Jul',
'Agu',
'Sep',
'Okt',
'Nov',
'Des'
],
datasets:[
{
label:'Jumlah Pesanan',
data:[
<?= implode(
',',
$dataChart
); ?>
]
}
]
}
}
);

new Chart(
document.getElementById(
'statusChart'
),
{
type:'doughnut',
data:{
labels:[
'Pending',
'Paid',
'Expired'
],
datasets:[
{
data:[
<?= $pending['total']; ?>,
<?= $paid['total']; ?>,
<?= $expired['total']; ?>
]
}
]
}
}
);

</script>

<?php require 'footer.php'; ?>