<?php

class AccountController {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
      public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            // Kiểm tra thông tin đăng nhập
            $query = "SELECT * FROM account WHERE username = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$username]);
            $account = $stmt->fetch(PDO::FETCH_OBJ);
            
            if ($account) {
                
                // Kiểm tra mật khẩu
                if (password_verify($password, $account->password)) {
                    $_SESSION['user'] = $account;
                    
                    // Chuyển hướng về trang chính
                    header('Location: /webbanhang/product');
                    exit;
                }
            }
            
            // Đăng nhập thất bại, ghi nhận lỗi
            $_SESSION['login_error'] = 'Tài khoản hoặc mật khẩu không chính xác';
            header('Location: /webbanhang/product');
            exit;
        }
        
        // Chuyển hướng về trang chính nếu truy cập trực tiếp
        header('Location: /webbanhang/product');
        exit;
    }      public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $fullname = $_POST['fullname'];
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            
            // Kiểm tra username đã tồn tại chưa
            $query = "SELECT * FROM account WHERE username = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$username]);
            $existingUser = $stmt->fetch(PDO::FETCH_OBJ);
            
            if ($existingUser) {
                $_SESSION['register_error'] = 'Tên đăng nhập đã tồn tại';
                header('Location: /webbanhang/product');
                exit;
            }
            
            // Kiểm tra email đã tồn tại chưa
            if (!empty($email)) {
                $query = "SELECT * FROM account WHERE email = ?";
                $stmt = $this->db->prepare($query);
                $stmt->execute([$email]);
                $existingEmail = $stmt->fetch(PDO::FETCH_OBJ);
                
                if ($existingEmail) {
                    $_SESSION['register_error'] = 'Email này đã được sử dụng';
                    header('Location: /webbanhang/product');
                    exit;
                }
            }
            
            // Xử lý avatar (nếu có)
            $avatar = 'uploads/avatars/default.png'; // Giá trị mặc định
            
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
                $uploadDir = 'uploads/avatars/';
                
                // Tạo thư mục nếu chưa tồn tại
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                
                $fileExt = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                $newFileName = $username . '_' . time() . '.' . $fileExt;
                $targetFile = $uploadDir . $newFileName;
                
                // Upload file
                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetFile)) {
                    $avatar = $targetFile;
                }
            }
            
            // Thêm tài khoản mới
            $query = "INSERT INTO account (username, password, fullname, email, phone, avatar, role) VALUES (?, ?, ?, ?, ?, ?, 'user')";
            $stmt = $this->db->prepare($query);
            if ($stmt->execute([$username, $password, $fullname, $email, $phone, $avatar])) {
                // Lấy thông tin tài khoản vừa tạo
                $id = $this->db->lastInsertId();
                $query = "SELECT * FROM account WHERE id = ?";
                $stmt = $this->db->prepare($query);
                $stmt->execute([$id]);
                $account = $stmt->fetch(PDO::FETCH_OBJ);
                
                // Lưu vào session
                $_SESSION['user'] = $account;
                $_SESSION['success_message'] = 'Đăng ký thành công!';
                header('Location: /webbanhang/product');
                exit;
            } else {
                $_SESSION['register_error'] = 'Đăng ký thất bại. Vui lòng thử lại.';
                header('Location: /webbanhang/product');
                exit;
            }
        }
        
        // Chuyển hướng về trang chính nếu truy cập trực tiếp
        header('Location: /webbanhang/product');
        exit;
    }
    
    public function logout() {
        // Xóa session
        unset($_SESSION['user']);
        session_destroy();
        
        // Chuyển hướng về trang chính
        header('Location: /webbanhang/product');
        exit;
    }
}
