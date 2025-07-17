<?php $page_title = htmlspecialchars($article['title']); ?>
<?php include 'views/layouts/header.php'; ?>

<div class="content-wrapper">
    <div class="article-detail">
        <div class="article-header">
            <h1><?php echo htmlspecialchars($article['title']); ?></h1>
            <div class="article-meta">
                <span class="author">Tác giả: <?php echo htmlspecialchars($article['author_name']); ?></span>
                <span class="date">Ngày đăng: <?php echo formatDate($article['created_at']); ?></span>
                <?php if ($article['updated_at'] != $article['created_at']): ?>
                    <span class="updated">Cập nhật: <?php echo formatDate($article['updated_at']); ?></span>
                <?php endif; ?>
                <span class="status status-<?php echo $article['status']; ?>">
                    <?php echo $article['status'] == 'published' ? 'Đã xuất bản' : 'Bản nháp'; ?>
                </span>
            </div>
        </div>
        
        <div class="article-content">
            <?php echo nl2br(htmlspecialchars($article['content'])); ?>
        </div>
        
        <?php if (isLoggedIn() && $article['author_id'] == $_SESSION['user_id']): ?>
            <div class="article-actions">
                <a href="index.php?page=edit&id=<?php echo $article['id']; ?>" class="btn btn-primary">Chỉnh sửa</a>
                <a href="index.php?page=delete&id=<?php echo $article['id']; ?>" 
                   class="btn btn-danger" 
                   onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">Xóa</a>
            </div>
        <?php endif; ?>
        
        <div class="article-navigation">
            <a href="index.php" class="btn btn-secondary">← Quay lại danh sách</a>
        </div>
    </div>
</div>

<?php include 'views/layouts/footer.php'; ?> 