<?php

session_start();

require_once '../models/User.php';

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function register()
    {
        $nama = trim(
            $_POST['nama']
        );

        $email = trim(
            $_POST['email']
        );

        $password =
        $_POST['password'];

        $this->userModel->register(
            $nama,
            $email,
            $password
        );

        header(
            "Location: ../../public/index.php?page=login"
        );

        exit;
    }

    public function login()
    {
        $email = trim(
            $_POST['email']
        );

        $password =
        $_POST['password'];

        $user =
        $this->userModel->login(
            $email
        );

        if(
            $user &&
            password_verify(
                $password,
                $user['password']
            )
        )
        {
            $_SESSION['user'] = [
                'id'    => $user['id'],
                'nama'  => $user['nama'],
                'email' => $user['email'],
                'role'  => $user['role']
            ];

            if(isset($_POST['remember']))
            {
                $token = bin2hex(
                    random_bytes(32)
                );

                $this->userModel->saveRememberToken(
                    $user['id'],
                    $token
                );

                setcookie(
                    "remember_token",
                    $token,
                    time() + 3600,
                    "/"
                );
            }

            if(
                $user['role']
                == 'admin'
            )
            {
                header(
                    "Location: ../../public/index.php?page=admin_dashboard"
                );
            }
            else
            {
                header(
                    "Location: ../../public/index.php?page=books"
                );
            }

            exit;
        }

        $_SESSION['error'] =
        "Email atau Password salah";

        header(
            "Location: ../../public/index.php?page=login"
        );

        exit;
    }

    public function logout()
    {
        if(isset($_SESSION['user']))
        {
            $this->userModel->clearRememberToken(
                $_SESSION['user']['id']
            );
        }

        setcookie(
            "remember_token",
            "",
            time() - 3600,
            "/"
        );

        session_unset();

        session_destroy();

        header(
            "Location: ../../public/index.php?page=login"
        );

        exit;
    }
}

$controller =
new AuthController();

if(
    isset($_GET['action'])
)
{
    switch(
        $_GET['action']
    )
    {
        case 'register':

            $controller
            ->register();

            break;

        case 'login':

            $controller
            ->login();

            break;

        case 'logout':

            $controller
            ->logout();

            break;
    }
}