<?php $page_title = 'Quản lý bài viết'; ?>
<?php include 'views/layouts/header.php'; ?>

<div class="content-wrapper">
    <div class="page-header">
        <h2>Quản lý bài viết của bạn</h2>
        <a href="index.php?page=create" class="btn btn-primary">Tạo bài viết mới</a>
    </div>
    
    <?php if (empty($articles)): ?>
        <div class="empty-state">
            <p>Bạn chưa có bài viết nào.</p>
            <a href="index.php?page=create" class="btn btn-primary">Tạo bài viết đầu tiên</a>
        </div>
    <?php else: ?>
        <div class="manage-table">
            <table class="table">
                <thead>
                    <tr>
                        <th>Tiêu đề</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Ngày cập nhật</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($articles as $article): ?>
                        <tr>
                            <td>
                                <a href="index.php?page=show&id=<?php echo $article['id']; ?>" class="article-title">
                                    <?php echo htmlspecialchars($article['title']); ?>
                                </a>
                            </td>
                            <td>
                                <span class="status status-<?php echo $article['status']; ?>">
                                    <?php echo $article['status'] == 'published' ? 'Đã xuất bản' : 'Bản nháp'; ?>
                                </span>
                            </td>
                            <td><?php echo formatDate($article['created_at']); ?></td>
                            <td><?php echo formatDate($article['updated_at']); ?></td>
                            <td class="actions">
                                <a href="index.php?page=edit&id=<?php echo $article['id']; ?>" 
                                   class="btn btn-sm btn-primary">Sửa</a>
                                <a href="index.php?page=delete&id=<?php echo $article['id']; ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php include 'views/layouts/footer.php'; ?> 