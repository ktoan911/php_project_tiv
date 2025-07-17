<?php $page_title = 'Tạo bài viết mới'; ?>
<?php include 'views/layouts/header.php'; ?>

<div class="content-wrapper">
    <div class="page-header">
        <h2>Tạo bài viết mới</h2>
    </div>
    
    <form action="index.php?page=create" method="POST" class="article-form">
        <div class="form-group">
            <label for="title">Tiêu đề bài viết:</label>
            <input type="text" id="title" name="title" required placeholder="Nhập tiêu đề bài viết...">
        </div>
        
        <div class="form-group">
            <label for="content">Nội dung bài viết:</label>
            <textarea id="content" name="content" required placeholder="Nhập nội dung bài viết..."></textarea>
        </div>
        
        <div class="form-group">
            <label for="status">Trạng thái:</label>
            <select id="status" name="status">
                <option value="draft">Bản nháp</option>
                <option value="published">Xuất bản</option>
            </select>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Tạo bài viết</button>
            <a href="index.php?page=manage" class="btn btn-secondary">Hủy</a>
        </div>
    </form>
</div>

<?php include 'views/layouts/footer.php'; ?> 