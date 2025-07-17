<?php $page_title = 'Chỉnh sửa bài viết'; ?>
<?php include 'views/layouts/header.php'; ?>

<div class="content-wrapper">
    <div class="page-header">
        <h2>Chỉnh sửa bài viết</h2>
    </div>
    
    <form action="index.php?page=edit&id=<?php echo $article['id']; ?>" method="POST" class="article-form">
        <div class="form-group">
            <label for="title">Tiêu đề bài viết:</label>
            <input type="text" id="title" name="title" required 
                   value="<?php echo htmlspecialchars($article['title']); ?>" 
                   placeholder="Nhập tiêu đề bài viết...">
        </div>
        
        <div class="form-group">
            <label for="content">Nội dung bài viết:</label>
            <textarea id="content" name="content" required 
                      placeholder="Nhập nội dung bài viết..."><?php echo htmlspecialchars($article['content']); ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="status">Trạng thái:</label>
            <select id="status" name="status">
                <option value="draft" <?php echo $article['status'] == 'draft' ? 'selected' : ''; ?>>Bản nháp</option>
                <option value="published" <?php echo $article['status'] == 'published' ? 'selected' : ''; ?>>Xuất bản</option>
            </select>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Cập nhật bài viết</button>
            <a href="index.php?page=manage" class="btn btn-secondary">Hủy</a>
        </div>
    </form>
</div>

<?php include 'views/layouts/footer.php'; ?> 