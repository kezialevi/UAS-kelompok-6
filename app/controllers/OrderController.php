<?php

session_start();

require_once '../models/Cart.php';
require_once '../models/Order.php';
require_once '../models/OrderDetail.php';
require_once '../models/Payment.php';

class OrderController
{
    private $cart;
    private $order;
    private $detail;
    private $payment;

    public function __construct()
    {
        $this->cart = new Cart();
        $this->order = new Order();
        $this->detail = new OrderDetail();
        $this->payment = new Payment();
    }

    public function checkout()
    {
        $user_id =
        $_SESSION['user']['id'];

        $cart =
        $this->cart->getCart(
            $user_id
        );

        $total = 0;

        foreach($cart as $item)
        {
            $total +=
            $item['subtotal'];
        }

        $order_id =
        $this->order->create(
            $user_id,
            $_POST['nama_penerima'],
            $_POST['no_hp'],
            $_POST['alamat'],
            $total,
            $_POST['metode']
        );

        foreach($cart as $item)
        {
            $this->detail->create(
                $order_id,
                $item['book_id'],
                $item['qty'],
                $item['harga'],
                $item['subtotal']
            );
        }

        $this->payment->create(
        $order_id,
        $_POST['metode']
        );

        $this->cart->clearCart(
            $user_id
        );

        header(
            "Location: ../../public/index.php?page=payment&id=".$order_id
        );
    }

    public function paid()
{
    header(
        "Location: ../../public/index.php?page=riwayat"
    );
    exit;
}
}

$controller =
new OrderController();

if(isset($_GET['action']))
{
    switch($_GET['action'])
    {
        case 'checkout':
            $controller->checkout();
            break;

        case 'paid':
            $controller->paid();
            break;
    }
}