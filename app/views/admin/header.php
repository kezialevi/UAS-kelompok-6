<?php

if(session_status() == PHP_SESSION_NONE)
{
    session_start();
}

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

if(!isset($_SESSION['user']))
{
    header(
        "Location: ../public/index.php?page=login"
    );
    exit;
}

if($_SESSION['user']['role'] != 'admin')
{
    header(
        "Location: ../public/index.php?page=books"
    );
    exit;
}

?>

<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>BookStore Admin</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        body{
            background:#f3f4f6;
        }

        .sidebar{
            min-height:100vh;
            background:#111827;
        }

        .logo{
            font-size:28px;
            font-weight:bold;
            color:white;
        }

        .admin-box{
            text-align:center;
            padding:20px;
            color:white;
            border-bottom:1px solid #374151;
        }

        .admin-avatar{
            width:70px;
            height:70px;
            border-radius:50%;
            background:#2563eb;
            margin:auto;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:30px;
        }

        .sidebar a{
            color:#d1d5db;
            text-decoration:none;
            display:block;
            padding:15px;
            transition:.3s;
        }

        .sidebar a:hover{
            background:#1f2937;
            color:white;
        }

        .card-stat{
            border:none;
            border-radius:20px;
            color:white;
            box-shadow:0 10px 20px rgba(0,0,0,.1);
        }

        .card-stat i{
            font-size:40px;
        }

        .topbar{
            background:white;
            border-radius:15px;
            padding:15px;
            margin-bottom:20px;
            box-shadow:0 5px 15px rgba(0,0,0,.08);
        }

    </style>

</head>

<body>

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-2 sidebar p-0">

                <div class="admin-box">

                    <div class="admin-avatar">

                        <i class="bi bi-person-fill"></i>

                    </div>

                    <h5 class="mt-3">

                        <?= $_SESSION['user']['nama']; ?>

                    </h5>

                    <small>

                        <?= $_SESSION['user']['role']; ?>

                    </small>

                </div>

                <a href="index.php?page=admin_dashboard">

                    <i class="bi bi-speedometer2"></i>

                    Dashboard

                </a>

                <a href="index.php?page=admin_books">

                    <i class="bi bi-book"></i>

                    Kelola Buku

                </a>

                <a href="index.php?page=admin_orders">

                    <i class="bi bi-bag"></i>

                    Pesanan

                </a>

                <a href="index.php?page=admin_payments">

                    <i class="bi bi-credit-card"></i>

                    Pembayaran

                </a>

                <a href="index.php?page=admin_users">

                    <i class="bi bi-people"></i>

                    User

                </a>

                <a
                    href="../app/controllers/AuthController.php?action=logout">

                    <i class="bi bi-box-arrow-right"></i>

                    Logout

                </a>

            </div>

            <div class="col-md-10 p-4">

                <div class="topbar">

                    <h3>

                        Dashboard Admin

                    </h3>

                </div>