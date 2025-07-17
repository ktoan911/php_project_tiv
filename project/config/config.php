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
    header("Location: " . BASE_URL . $url);
    exit();
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        redirect('index.php?page=login');
    }
}

function sanitize($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

function formatDate($date) {
    return date('d/m/Y H:i', strtotime($date));
}
?> 