<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'article_management';
    private $username = 'root';
    private $password = '123456';
    private $conn;
    //PDO (PHP Data Objects) là một interface trong PHP để làm việc với nhiều loại cơ sở dữ liệu
    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            // ATTR_ERRMODE được sử dụng để thiết lập chế độ báo lỗi cho PDO. Khi được đặt thành PDO::ERRMODE_EXCEPTION, nó sẽ ném ra ngoại lệ (exception) khi có lỗi xảy ra trong quá trình thực thi câu lệnh SQL
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Lỗi kết nối: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?> 