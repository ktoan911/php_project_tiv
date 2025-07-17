<?php
require_once 'config/config.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/ArticleController.php';

// Lấy trang từ URL
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Khởi tạo controllers
$authController = new AuthController();
$articleController = new ArticleController();

// Routing
switch ($page) {
    case 'home':
    case '':
        $articleController->index();
        break;
        
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->login();
        } else {
            $authController->showLogin();
        }
        break;
        
    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->register();
        } else {
            $authController->showRegister();
        }
        break;
        
    case 'logout':
        $authController->logout();
        break;
        
    case 'show':
        if ($id > 0) {
            $articleController->show($id);
        } else {
            redirect('index.php');
        }
        break;
        
    case 'create':
        $articleController->create();
        break;
        
    case 'edit':
        if ($id > 0) {
            $articleController->edit($id);
        } else {
            redirect('index.php?page=manage');
        }
        break;
        
    case 'delete':
        if ($id > 0) {
            $articleController->delete($id);
        } else {
            redirect('index.php?page=manage');
        }
        break;
        
    case 'manage':
        $articleController->manage();
        break;
        
    default:
        // Trang không tồn tại
        $_SESSION['error'] = 'Trang không tồn tại!';
        redirect('index.php');
        break;
}
?> 