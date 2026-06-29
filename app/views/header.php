<?php

if(session_status() == PHP_SESSION_NONE)
{
    session_start();
}

$nama = $_SESSION['user']['nama'] ?? 'Guest';

$page = $_GET['page'] ?? 'login';

?>

<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>

        BookStore

    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        body{
            background:#f8f9fa;
        }

        .navbar-brand{
            font-size:1.5rem;
            font-weight:700;
        }

        .card{
            transition:.3s;
        }

        .card:hover{
            transform:translateY(-5px);
            box-shadow:
            0 0 20px rgba(0,0,0,.15);
        }

        .dropdown-menu{
            border:none;
            box-shadow:
            0 5px 20px rgba(0,0,0,.1);
        }

    </style>

</head>

<body>

    <nav
        class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">

        <div class="container">

            <a
                class="navbar-brand"
                href="index.php?page=books">

                <i class="bi bi-book-half"></i>

                BookStore

            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

                <span
                    class="navbar-toggler-icon">
                </span>

            </button>

            <div
                class="collapse navbar-collapse"
                id="navbarNav">

                <?php if(isset($_SESSION['user'])): ?>

                    <div
                        class="ms-auto d-flex align-items-center">

                        <form
                            method="GET"
                            action="index.php"
                            class="d-flex me-3">

                            <input
                                type="hidden"
                                name="page"
                                value="books">

                            <input
                                type="search"
                                name="keyword"
                                class="form-control me-2"
                                placeholder="Cari judul, penulis, kategori...">

                            <button
                                class="btn btn-light">

                                Cari

                            </button>

                        </form>

                        <a
                            href="index.php?page=cart"
                            class="btn btn-warning me-2">

                            <i class="bi bi-cart-fill"></i>

                        </a>

                        <div class="dropdown">

                            <button
                                class="btn btn-light dropdown-toggle"
                                type="button"
                                data-bs-toggle="dropdown">

                                <?= $nama ?>

                            </button>

                            <ul
                                class="dropdown-menu dropdown-menu-end">

                                <li>

                                    <a
                                        class="dropdown-item"
                                        href="index.php?page=riwayat">

                                        <i class="bi bi-clock-history"></i>

                                        Riwayat Pesanan

                                    </a>

                                </li>

                                <li>

                                    <hr
                                        class="dropdown-divider">

                                </li>

                                <li>

                                    <a
                                        class="dropdown-item"
                                        href="../app/controllers/AuthController.php?action=logout">

                                        <i class="bi bi-box-arrow-right"></i>

                                        Logout

                                    </a>

                                </li>

                            </ul>

                        </div>

                    </div>

                <?php else: ?>

                    <div class="ms-auto">

                        <?php if($page != 'login'): ?>

                            <a
                                href="index.php?page=login"
                                class="btn btn-light me-2">

                                Login

                            </a>

                        <?php endif; ?>

                        <?php if($page != 'register'): ?>

                            <a
                                href="index.php?page=register"
                                class="btn btn-warning">

                                Register

                            </a>

                        <?php endif; ?>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </nav>

    <div class="container mt-4">