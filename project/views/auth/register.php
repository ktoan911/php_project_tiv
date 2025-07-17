<?php $page_title = 'Đăng ký'; ?>
<?php include 'views/layouts/header.php'; ?>

<div class="auth-container">
    <div class="auth-form">
        <h2>Đăng ký tài khoản</h2>
        <form action="index.php?page=register" method="POST">
            <div class="form-group">
                <label for="username">Tên đăng nhập:</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="full_name">Họ và tên:</label>
                <input type="text" id="full_name" name="full_name" required>
            </div>
            
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password" required minlength="6">
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Xác nhận mật khẩu:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Đăng ký</button>
            </div>
        </form>
        
        <div class="auth-links">
            <p>Đã có tài khoản? <a href="index.php?page=login">Đăng nhập ngay</a></p>
        </div>
    </div>
</div>

<?php include 'views/layouts/footer.php'; ?> 