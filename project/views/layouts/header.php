<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' . SITE_NAME : SITE_NAME; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="nav-brand">
                <h1><a href="index.php"><?php echo SITE_NAME; ?></a></h1>
            </div>
            <nav class="nav-menu">
                <ul>
                    <li><a href="index.php">Trang chủ</a></li>
                    <?php if (isLoggedIn()): ?>
                        <li><a href="index.php?page=create">Viết bài</a></li>
                        <li><a href="index.php?page=manage">Quản lý bài viết</a></li>
                        <li class="user-menu">
                            <span>Xin chào, <?php echo $_SESSION['full_name']; ?></span>
                            <a href="index.php?page=logout" class="logout-btn">Đăng xuất</a>
                        </li>
                    <?php else: ?>
                        <li><a href="index.php?page=login">Đăng nhập</a></li>
                        <li><a href="index.php?page=register">Đăng ký</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    
    <main class="main-content">
        <div class="container">
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?> 