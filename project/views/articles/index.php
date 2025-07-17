<?php $page_title = 'Trang chủ'; ?>
<?php include 'views/layouts/header.php'; ?>

<div class="content-wrapper">
    <div class="page-header">
        <h2>Danh sách bài viết</h2>
        
        <!-- Form tìm kiếm -->
        <form method="GET" class="search-form">
            <input type="text" name="search" placeholder="Tìm kiếm bài viết..." 
                   value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit" class="btn btn-secondary">Tìm kiếm</button>
        </form>
    </div>
    
    <?php if (empty($articles)): ?>
        <div class="empty-state">
            <p>Không có bài viết nào được tìm thấy.</p>
        </div>
    <?php else: ?>
        <div class="articles-grid">
            <?php foreach ($articles as $article): ?>
                <article class="article-card">
                    <div class="article-header">
                        <h3><a href="index.php?page=show&id=<?php echo $article['id']; ?>"><?php echo htmlspecialchars($article['title']); ?></a></h3>
                        <div class="article-meta">
                            <span class="author">Tác giả: <?php echo htmlspecialchars($article['author_name']); ?></span>
                            <span class="date"><?php echo formatDate($article['created_at']); ?></span>
                        </div>
                    </div>
                    <div class="article-content">
                        <p><?php echo htmlspecialchars(substr($article['content'], 0, 200)) . '...'; ?></p>
                    </div>
                    <div class="article-footer">
                        <a href="index.php?page=show&id=<?php echo $article['id']; ?>" class="btn btn-primary">Đọc thêm</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include 'views/layouts/footer.php'; ?> 