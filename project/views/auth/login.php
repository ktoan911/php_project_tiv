<?php $page_title = 'Đăng nhập'; ?>
<?php include 'views/layouts/header.php'; ?>

<div class="auth-container">
    <div class="auth-form">
        <h2>Đăng nhập</h2>
        <form action="index.php?page=login" method="POST">
            <div class="form-group">
                <label for="username">Tên đăng nhập hoặc Email:</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="form-group">
                <label class="checkbox-container">
                    <input type="checkbox" name="remember_me" value="1">
                    <span class="checkmark"></span>
                    Ghi nhớ đăng nhập
                </label>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Đăng nhập</button>
            </div>
        </form>
        
        <div class="auth-links">
            <p>Chưa có tài khoản? <a href="index.php?page=register">Đăng ký ngay</a></p>
        </div>
    </div>
</div>

<?php include 'views/layouts/footer.php'; ?> 