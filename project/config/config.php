<?php
session_start();

// Định nghĩa các hằng số
define('BASE_URL', 'http://localhost:8000');
define('SITE_NAME', 'Quản lý bài viết');

// Timezone
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Include database
require_once 'database.php';

// Helper functions
function redirect($url) {
    //Gửi lệnh HTTP để trình duyệt chuyển sang URL mới
    header("Location: " . BASE_URL . $url);
    exit();
}

// isset kiểm tra null
//$_SESSION chứa tất cả dữ liệu phiên đăng nhập
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        redirect('index.php?page=login');
    }
}

// chuyển kí tự đầu vào thành dạng chuỗi an toàn tránh lỗi XSS
function sanitize($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

//2025-07-22 19:40:00 → 22/07/2025 19:40
function formatDate($date) {
    return date('d/m/Y H:i', strtotime($date));
}
?> 