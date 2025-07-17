<?php
class Article {
    private $conn;
    private $table_name = "articles";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllArticles($status = null) {
        if ($status) {
            $query = "SELECT a.*, u.full_name as author_name FROM " . $this->table_name . " a 
                     LEFT JOIN users u ON a.author_id = u.id 
                     WHERE a.status = ? 
                     ORDER BY a.created_at DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $status);
        } else {
            $query = "SELECT a.*, u.full_name as author_name FROM " . $this->table_name . " a 
                     LEFT JOIN users u ON a.author_id = u.id 
                     ORDER BY a.created_at DESC";
            $stmt = $this->conn->prepare($query);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArticleById($id) {
        $query = "SELECT a.*, u.full_name as author_name FROM " . $this->table_name . " a 
                 LEFT JOIN users u ON a.author_id = u.id 
                 WHERE a.id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function getArticlesByAuthor($author_id) {
        $query = "SELECT a.*, u.full_name as author_name FROM " . $this->table_name . " a 
                 LEFT JOIN users u ON a.author_id = u.id 
                 WHERE a.author_id = ? 
                 ORDER BY a.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $author_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createArticle($title, $content, $author_id, $status = 'draft') {
        $query = "INSERT INTO " . $this->table_name . " (title, content, author_id, status) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(1, $title);
        $stmt->bindParam(2, $content);
        $stmt->bindParam(3, $author_id);
        $stmt->bindParam(4, $status);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function updateArticle($id, $title, $content, $status) {
        $query = "UPDATE " . $this->table_name . " SET title = ?, content = ?, status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(1, $title);
        $stmt->bindParam(2, $content);
        $stmt->bindParam(3, $status);
        $stmt->bindParam(4, $id);

        return $stmt->execute();
    }

    public function deleteArticle($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        return $stmt->execute();
    }

    public function searchArticles($keyword) {
        $query = "SELECT a.*, u.full_name as author_name FROM " . $this->table_name . " a 
                 LEFT JOIN users u ON a.author_id = u.id 
                 WHERE a.title LIKE ? OR a.content LIKE ? 
                 ORDER BY a.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $search_term = "%" . $keyword . "%";
        $stmt->bindParam(1, $search_term);
        $stmt->bindParam(2, $search_term);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?> 