<?php

session_start();

require_once '../models/Cart.php';

class CartController
{
    private $cartModel;

    public function __construct()
    {
        $this->cartModel = new Cart();
    }

    public function add()
    {
        $this->cartModel->add(
            $_SESSION['user']['id'],
            $_POST['book_id'],
            $_POST['qty'] ?? 1
        );

        header(
            "Location: ../../public/index.php?page=cart"
        );
        exit;
    }

    public function remove()
    {
        $this->cartModel->delete(
            $_GET['id']
        );

        header(
            "Location: ../../public/index.php?page=cart"
        );
        exit;
    }
}

$controller = new CartController();

if(isset($_GET['action']))
{
    switch($_GET['action'])
    {
        case 'add':
            $controller->add();
            break;

        case 'remove':
            $controller->remove();
            break;
    }
}