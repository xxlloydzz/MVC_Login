<?php
require_once 'models/UserModel.php';

class LoginController {
    public function handleRequest() {
        session_start();

        // Logout
        if (isset($_GET['logout'])) {
            session_destroy();
            header("Location: index.php");
            exit;
        }

        // Sudah login -> dashboard
        if (isset($_SESSION['user'])) {
            include 'views/dashboard.php';
            return;
        }

        // Proses form login
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $userModel = new UserModel();
            $user = $userModel->checkLogin($username, $password);

            if ($user) {
                $_SESSION['user'] = $user['username'];
                include 'views/dashboard.php';
            } else {
                $error = "Username atau password salah!";
                include 'views/login.php';
            }
        } else {
            include 'views/login.php';
        }
    }
}
?>