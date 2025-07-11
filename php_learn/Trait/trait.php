<?php
// Hàm trong trait sẽ được ưu tiên dùng hơn hàm trong class cha: current class > trait > parent class
trait Logger {
    public $name = "LoggerTrait";
    public function log($message) {
        echo "Log: $message<br>";
    }
    public function getName() {
        return $this->name;
    }
}
trait ErrorHandler {
    use Logger; // Trait có thể sử dụng trait khác
    public $name = "error";
    public function handleError($error) {
        echo "Error: $error<br>";
    }
    public function getName() {
        return $this->name;
    }
}
class Application {
    use Logger, ErrorHandler{
        ErrorHandler :: getNAme insteadOf Logger; // Sử dụng getName từ ErrorHandler thay vì Logger (đánh độ ưu tiên cao hơn)
        Logger :: log as logMessage; // Đổi tên hàm log thành logMessage từ Logger
    }

    public function run() {
        $this->log("Application started");
        // Simulate an error
        $this->handleError("An unexpected error occurred");
        $this->log("Application finished");
    }
}
?>