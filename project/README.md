# Hệ thống Quản lý Bài viết

Đây là một hệ thống quản lý bài viết đơn giản được phát triển bằng PHP theo mô hình MVC, sử dụng MySQL làm cơ sở dữ liệu.

## Tính năng

- **Xác thực người dùng**: Đăng ký, đăng nhập, đăng xuất
- **Quản lý bài viết**: Tạo, sửa, xóa, xem bài viết (CRUD)
- **Tìm kiếm bài viết**: Tìm kiếm theo tiêu đề và nội dung
- **Phân quyền**: Người dùng chỉ có thể sửa/xóa bài viết của mình
- **Trạng thái bài viết**: Bản nháp và đã xuất bản
- **Giao diện responsive**: Tương thích với mobile

## Cấu trúc thư mục

```
project/
├── config/
│   ├── database.php        # Cấu hình database
│   └── config.php          # Cấu hình chung
├── controllers/
│   ├── AuthController.php  # Controller xác thực
│   └── ArticleController.php # Controller bài viết
├── models/
│   ├── User.php           # Model người dùng
│   └── Article.php        # Model bài viết
├── views/
│   ├── layouts/
│   │   ├── header.php     # Header chung
│   │   └── footer.php     # Footer chung
│   ├── auth/
│   │   ├── login.php      # Trang đăng nhập
│   │   └── register.php   # Trang đăng ký
│   └── articles/
│       ├── index.php      # Danh sách bài viết
│       ├── show.php       # Xem bài viết
│       ├── create.php     # Tạo bài viết
│       ├── edit.php       # Sửa bài viết
│       └── manage.php     # Quản lý bài viết
├── assets/
│   └── css/
│       └── style.css      # CSS chính
├── database/
│   └── schema.sql         # Cấu trúc database
├── index.php              # File chính
├── .htaccess              # Cấu hình Apache
└── README.md              # Tài liệu này
```

## Yêu cầu hệ thống

- PHP 7.4 trở lên
- MySQL 5.7 trở lên
- Apache server với mod_rewrite
- XAMPP/WAMP/LAMP (khuyến nghị cho môi trường development)

## Hướng dẫn cài đặt

### Bước 1: Chuẩn bị môi trường

1. Cài đặt XAMPP từ https://www.apachefriends.org/
2. Khởi động Apache và MySQL trong XAMPP Control Panel

### Bước 2: Copy project

1. Copy thư mục `project` vào thư mục `htdocs` của XAMPP
2. Đảm bảo đường dẫn: `C:\xampp\htdocs\project\`

### Bước 3: Tạo database

1. Mở phpMyAdmin: http://localhost/phpmyadmin
2. Tạo database mới tên `article_management`
3. Import file `database/schema.sql` vào database vừa tạo

### Bước 4: Cấu hình database

Mở file `config/database.php` và kiểm tra thông tin kết nối:

```php
private $host = 'localhost';
private $db_name = 'article_management';
private $username = 'root';
private $password = '';
```

### Bước 5: Truy cập website

Mở trình duyệt và truy cập: http://localhost/project/

## Tài khoản mặc định

Database đã có sẵn 2 tài khoản để test:

- **Tài khoản 1**: admin / password
- **Tài khoản 2**: user1 / password

## Sử dụng

### Đăng ký tài khoản mới

1. Truy cập trang đăng ký
2. Nhập đầy đủ thông tin
3. Sau khi đăng ký thành công, đăng nhập với tài khoản vừa tạo

### Quản lý bài viết

1. Đăng nhập vào hệ thống
2. Chọn "Viết bài" để tạo bài viết mới
3. Chọn "Quản lý bài viết" để xem/sửa/xóa bài viết của bạn
4. Bài viết có thể ở trạng thái "Bản nháp" hoặc "Đã xuất bản"

### Tìm kiếm bài viết

1. Sử dụng ô tìm kiếm ở trang chủ
2. Hệ thống sẽ tìm kiếm theo tiêu đề và nội dung bài viết

## Tính năng bảo mật

- Mã hóa mật khẩu bằng password_hash()
- Chống SQL Injection bằng Prepared Statements
- Bảo vệ XSS bằng htmlspecialchars()
- Kiểm tra quyền truy cập trước khi thực hiện thao tác
- Bảo vệ các thư mục nhạy cảm qua .htaccess

## Cấu trúc MVC

### Models
- `User.php`: Xử lý logic liên quan đến người dùng
- `Article.php`: Xử lý logic liên quan đến bài viết

### Views
- Các file template PHP hiển thị giao diện
- Sử dụng layout chung (header.php, footer.php)

### Controllers
- `AuthController.php`: Xử lý đăng nhập/đăng ký
- `ArticleController.php`: Xử lý CRUD bài viết

## Customization

### Thay đổi giao diện
- Chỉnh sửa file `assets/css/style.css`
- Sửa các file template trong thư mục `views/`

### Thay đổi cấu hình
- Database: `config/database.php`
- Cấu hình chung: `config/config.php`

## Troubleshooting

### Lỗi kết nối database
- Kiểm tra MySQL đã chạy chưa
- Xác nhận thông tin database trong `config/database.php`

### Lỗi 404
- Kiểm tra mod_rewrite đã enable chưa
- Đảm bảo file `.htaccess` tồn tại

### Lỗi session
- Kiểm tra quyền ghi của thư mục session
- Restart Apache server

## Liên hệ

Nếu có vấn đề gì cần hỗ trợ, vui lòng liên hệ qua email hoặc tạo issue trên GitHub.

## License

Project này được phát triển cho mục đích học tập và có thể sử dụng tự do. 