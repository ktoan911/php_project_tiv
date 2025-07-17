<?php
require_once 'config/config.php';
require_once 'models/User.php';

class AuthController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function showLogin() {
        if (isLoggedIn()) {
            redirect('');
        }
        include 'views/auth/login.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = sanitize($_POST['username']);
            $password = $_POST['password'];
            
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
                $_SESSION['success'] = 'Đăng nhập thành công!';
                redirect('');
            } else {
                $_SESSION['error'] = 'Tên đăng nhập hoặc mật khẩu không đúng!';
                include 'views/auth/login.php';
                return;
            }
        }
    }

    public function showRegister() {
        if (isLoggedIn()) {
            redirect('index.php');
        }
        include 'views/auth/register.php';
    }

    public function register() {
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

    public function logout() {
        session_destroy();
        redirect('');
    }
}
?> 