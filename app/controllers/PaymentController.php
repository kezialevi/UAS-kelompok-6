<?php

require_once '../models/Payment.php';
require_once '../models/Order.php';

$payment = new Payment();
$order = new Order();

$action = $_GET['action'] ?? '';

switch ($action) {

    case 'upload':

        if (!isset($_POST['order_id'])) {
            die("ID Pesanan tidak ditemukan.");
        }

        $order_id = $_POST['order_id'];

        if (!isset($_FILES['bukti']) || $_FILES['bukti']['error'] != 0) {
            die("Silakan pilih bukti pembayaran.");
        }

        $folder = "../../public/assets/bukti/";

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $namaFile = time() . "_" . basename($_FILES['bukti']['name']);

        $tujuan = $folder . $namaFile;

        if (move_uploaded_file($_FILES['bukti']['tmp_name'], $tujuan)) {

            $payment->uploadBukti(
                $order_id,
                $namaFile
            );

            header("Location: ../../public/index.php?page=payment&id=".$order_id);
            exit;

        } else {

            die("Upload bukti pembayaran gagal.");

        }

    break;



    case 'accept':

    if (!isset($_GET['id'])) {
        die("ID Order tidak ditemukan.");
    }

    $id = (int)$_GET['id'];

    $payment->updateStatus($id,'paid');

    $order->updateStatus($id,'Lunas');

    header("Location: ../../public/index.php?page=admin_payments");
    exit;

    break;
        case 'reject':

    if (!isset($_GET['id'])) {
        die("ID Order tidak ditemukan.");
    }

    $id = (int)$_GET['id'];

    $payment->updateStatus($id,'rejected');

    $order->updateStatus($id,'Pending');

    header("Location: ../../public/index.php?page=admin_payments");
    exit;

break;



    case 'delete':

        if (!isset($_GET['id'])) {
            die("ID Payment tidak ditemukan.");
        }

        $id = (int) $_GET['id'];

        if(!$payment->delete($id)){
            die("Gagal menghapus data pembayaran.");
        }

        header("Location: ../../public/index.php?page=admin_payments");
        exit;

    break;



    default:

        die("Action tidak ditemukan.");
}