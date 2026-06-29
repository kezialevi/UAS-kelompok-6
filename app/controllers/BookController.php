<?php

session_start();

require_once '../models/Book.php';

class BookController
{
    private $bookModel;

    public function __construct()
    {
        $this->bookModel = new Book();
    }

    public function create()
    {
        $gambar = '';

        if(
            isset($_FILES['gambar']) &&
            $_FILES['gambar']['error'] == 0
        )
        {
            $gambar =
            time() .
            '_' .
            basename(
                $_FILES['gambar']['name']
            );

            move_uploaded_file(
                $_FILES['gambar']['tmp_name'],
                '../../public/assets/uploads/' .
                $gambar
            );
        }

        $this->bookModel->create(
            $_POST['category_id'],
            $_POST['judul'],
            $_POST['penulis'],
            $_POST['penerbit'],
            $_POST['tahun_terbit'],
            $_POST['harga'],
            $_POST['stok'],
            $gambar,
            $_POST['deskripsi']
        );

        header(
            "Location: ../../public/index.php?page=admin_books"
        );

        exit;
    }

    public function update()
    {
        $gambar =
        $_POST['gambar_lama'];

        if(
            isset($_FILES['gambar']) &&
            $_FILES['gambar']['error'] == 0
        )
        {
            $gambar =
            time() .
            '_' .
            basename(
                $_FILES['gambar']['name']
            );

            move_uploaded_file(
                $_FILES['gambar']['tmp_name'],
                '../../public/assets/uploads/' .
                $gambar
            );

            $fileLama =
            '../../public/assets/uploads/' .
            $_POST['gambar_lama'];

            if(
                file_exists($fileLama) &&
                $_POST['gambar_lama'] != ''
            )
            {
                unlink($fileLama);
            }
        }

        $this->bookModel->update(
            $_POST['id'],
            $_POST['category_id'],
            $_POST['judul'],
            $_POST['penulis'],
            $_POST['penerbit'],
            $_POST['tahun_terbit'],
            $_POST['harga'],
            $_POST['stok'],
            $gambar,
            $_POST['deskripsi']
        );

        header(
            "Location: ../../public/index.php?page=admin_books"
        );

        exit;
    }

    public function delete()
    {
        $book =
        $this->bookModel->getById(
            $_GET['id']
        );

        if(
            $book &&
            $book['gambar'] != ''
        )
        {
            $file =
            '../../public/assets/uploads/' .
            $book['gambar'];

            if(file_exists($file))
            {
                unlink($file);
            }
        }

        $this->bookModel->delete(
            $_GET['id']
        );

        header(
            "Location: ../../public/index.php?page=admin_books"
        );

        exit;
    }
}

$controller =
new BookController();

if(isset($_GET['action']))
{
    switch($_GET['action'])
    {
        case 'create':
            $controller->create();
            break;

        case 'update':
            $controller->update();
            break;

        case 'delete':
            $controller->delete();
            break;
    }
}