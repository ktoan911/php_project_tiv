<?php
require_once 'config/config.php';
require_once 'models/Article.php';

class ArticleController {
    private $db;
    private $article;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->article = new Article($this->db);
    }

    public function index() {
        $search = isset($_GET['search']) ? sanitize($_GET['search']) : '';
        
        if ($search) {
            $articles = $this->article->searchArticles($search);
        } else {
            $articles = $this->article->getAllArticles('published');
        }
        
        include 'views/articles/index.php';
    }

    public function show($id) {
        $article = $this->article->getArticleById($id);
        
        if (!$article) {
            $_SESSION['error'] = 'Bài viết không tồn tại!';
            redirect('index.php');
        }
        
        include 'views/articles/show.php';
    }

    public function create() {
        requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = sanitize($_POST['title']);
            $content = sanitize($_POST['content']);
            $status = sanitize($_POST['status']);
            
            if (empty($title) || empty($content)) {
                $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin!';
                redirect('index.php?page=create');
            }
            
            $article_id = $this->article->createArticle($title, $content, $_SESSION['user_id'], $status);
            
            if ($article_id) {
                $_SESSION['success'] = 'Tạo bài viết thành công!';
                redirect('index.php?page=manage');
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra khi tạo bài viết!';
                redirect('index.php?page=create');
            }
        } else {
            include 'views/articles/create.php';
        }
    }

    public function edit($id) {
        requireLogin();
        
        $article = $this->article->getArticleById($id);
        
        if (!$article) {
            $_SESSION['error'] = 'Bài viết không tồn tại!';
            redirect('index.php?page=manage');
        }
        
        // Chỉ cho phép tác giả chỉnh sửa bài viết của mình
        if ($article['author_id'] != $_SESSION['user_id']) {
            $_SESSION['error'] = 'Bạn không có quyền chỉnh sửa bài viết này!';
            redirect('index.php?page=manage');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = sanitize($_POST['title']);
            $content = sanitize($_POST['content']);
            $status = sanitize($_POST['status']);
            
            if (empty($title) || empty($content)) {
                $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin!';
                redirect('index.php?page=edit&id=' . $id);
            }
            
            $result = $this->article->updateArticle($id, $title, $content, $status);
            
            if ($result) {
                $_SESSION['success'] = 'Cập nhật bài viết thành công!';
                redirect('index.php?page=manage');
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra khi cập nhật bài viết!';
                redirect('index.php?page=edit&id=' . $id);
            }
        } else {
            include 'views/articles/edit.php';
        }
    }

    public function delete($id) {
        requireLogin();
        
        $article = $this->article->getArticleById($id);
        
        if (!$article) {
            $_SESSION['error'] = 'Bài viết không tồn tại!';
            redirect('index.php?page=manage');
        }
        
        // Chỉ cho phép tác giả xóa bài viết của mình
        if ($article['author_id'] != $_SESSION['user_id']) {
            $_SESSION['error'] = 'Bạn không có quyền xóa bài viết này!';
            redirect('index.php?page=manage');
        }
        
        $result = $this->article->deleteArticle($id);
        
        if ($result) {
            $_SESSION['success'] = 'Xóa bài viết thành công!';
        } else {
            $_SESSION['error'] = 'Có lỗi xảy ra khi xóa bài viết!';
        }
        
        redirect('index.php?page=manage');
    }

    public function manage() {
        requireLogin();
        
        $articles = $this->article->getArticlesByAuthor($_SESSION['user_id']);
        include 'views/articles/manage.php';
    }
}
?> 