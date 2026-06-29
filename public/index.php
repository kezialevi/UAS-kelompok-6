<?php

session_start();

require_once '../app/models/User.php';

if(
    !isset($_SESSION['user']) &&
    isset($_COOKIE['remember_token'])
)
{
    $userModel = new User();

    $user = $userModel->getByRememberToken(
        $_COOKIE['remember_token']
    );

    if($user)
    {
        $_SESSION['user'] = [
            'id'    => $user['id'],
            'nama'  => $user['nama'],
            'email' => $user['email'],
            'role'  => $user['role']
        ];
    }
}

if(isset($_SESSION['user']))
{
    if($_SESSION['user']['role'] == 'admin')
    {
        $page = $_GET['page'] ?? 'admin_dashboard';
    }
    else
    {
        $page = $_GET['page'] ?? 'books';
    }
}
else
{
    $page = $_GET['page'] ?? 'login';
}

switch($page)
{
    case 'login':

    if(isset($_SESSION['user']))
    {
        if($_SESSION['user']['role'] == 'admin')
        {
            header("Location:index.php?page=admin_dashboard");
        }
        else
        {
            header("Location:index.php?page=books");
        }

        exit;
    }

    require '../app/views/login.php';
    break;

    case 'register':
        require '../app/views/register.php';
        break;

    default:

        if(!isset($_SESSION['user']))
        {
            header(
                "Location:index.php?page=login"
            );
            exit;
        }

        switch($page)
        {
            // USER

            case 'books':
                require '../app/views/books.php';
                break;

            case 'detail':
                require '../app/views/detail.php';
                break;

            case 'cart':
                require '../app/views/cart.php';
                break;

            case 'checkout':
                require '../app/views/checkout.php';
                break;

            case 'payment':
                require '../app/views/payment.php';
                break;

            case 'riwayat':
                require '../app/views/riwayat.php';
                break;

            // ADMIN

            case 'admin_dashboard':
                require '../app/views/admin/dashboard.php';
                break;

            case 'admin_books':
                require '../app/views/admin/books.php';
                break;

            case 'book_create':
                require '../app/views/admin/book_create.php';
                break;

            case 'book_edit':
                require '../app/views/admin/book_edit.php';
                break;

            case 'admin_orders':
                require '../app/views/admin/orders.php';
                break;

            case 'order_detail':
                require '../app/views/admin/order_detail.php';
                break;

            case 'admin_payments':
                require '../app/views/admin/payments.php';
                break;

            case 'admin_users':
                require '../app/views/admin/users.php';
                break;

            default:
                require '../app/views/books.php';
                break;
        }

        break;
}