<?php
require_once 'config/config.php';
require_once 'models/User.php';

class AuthController
{
    private $db;
    private $user;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);

        // Kiểm tra cookie remember me khi khởi tạo
        $this->checkRememberMe();
    }

    // Kiểm tra cookie remember me
    private function checkRememberMe()
    {
        if (!isLoggedIn() && isset($_COOKIE['remember_me'])) {
            $token = $_COOKIE['remember_me'];
            $user_data = $this->user->getUserByRememberToken($token);

            if ($user_data) {
                $_SESSION['user_id'] = $user_data['id'];
                $_SESSION['username'] = $user_data['username'];
                $_SESSION['full_name'] = $user_data['full_name'];
            } else {
                // Token không hợp lệ, xóa cookie
                setcookie('remember_me', '', time() - 3600, '/');
            }
        }
    }

    public function showLogin()
    {
        if (isLoggedIn()) {
            redirect('');
        }
        include 'views/auth/login.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = sanitize($_POST['username']);
            $password = $_POST['password'];
            $remember_me = isset($_POST['remember_me']) ? true : false;

            if (empty($username) || empty($password)) {
                $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin!';
                include 'views/auth/login.php';
                return;
            }

            $user_data = $this->user->login($username, $password);

            if ($user_data) {
                $_SESSION['user_id'] = $user_data['id'];
                $_SESSION['username'] = $user_data['username'];
                $_SESSION['full_name'] = $user_data['full_name'];

                // Xử lý remember me
                if ($remember_me) {
                    $token = bin2hex(random_bytes(32)); // Tạo token ngẫu nhiên
                    $this->user->saveRememberToken($user_data['id'], $token);
                    setcookie('remember_me', $token, time() + (30 * 24 * 60 * 60), '/'); // 30 ngày
                }

                $_SESSION['success'] = 'Đăng nhập thành công!';
                redirect('');
            } else {
                $_SESSION['error'] = 'Tên đăng nhập hoặc mật khẩu không đúng!';
                include 'views/auth/login.php';
                return;
            }
        }
    }

    public function showRegister()
    {
        if (isLoggedIn()) {
            redirect('index.php');
        }
        include 'views/auth/register.php';
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = sanitize($_POST['username']);
            $email = sanitize($_POST['email']);
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $full_name = sanitize($_POST['full_name']);

            // Validation
            if (empty($username) || empty($email) || empty($password) || empty($full_name)) {
                $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin!';
                include 'views/auth/register.php';
                return;
            }

            if ($password !== $confirm_password) {
                $_SESSION['error'] = 'Mật khẩu xác nhận không khớp!';
                include 'views/auth/register.php';
                return;
            }

            if (strlen($password) < 6) {
                $_SESSION['error'] = 'Mật khẩu phải có ít nhất 6 ký tự!';
                include 'views/auth/register.php';
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = 'Email không hợp lệ!';
                include 'views/auth/register.php';
                return;
            }

            $user_id = $this->user->register($username, $email, $password, $full_name);

            if ($user_id) {
                $_SESSION['success'] = 'Đăng ký thành công!';
                redirect('');
            } else {
                $_SESSION['error'] = 'Tên đăng nhập hoặc email đã tồn tại!';
                include 'views/auth/register.php';
                return;
            }
        }
    }

    public function logout()
    {
        // Xóa remember token trong database
        if (isset($_SESSION['user_id'])) {
            $this->user->clearRememberToken($_SESSION['user_id']);
        }

        // Xóa cookie remember me
        setcookie('remember_me', '', time() - 3600, '/');

        session_destroy();
        redirect('');
    }
}
