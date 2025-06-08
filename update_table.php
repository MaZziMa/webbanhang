<?php
require 'app/config/database.php';

// Khởi tạo kết nối
$database = new Database();
$db = $database->getConnection();

try {
    // Thử thêm các cột riêng lẻ
    $db->exec("ALTER TABLE account ADD COLUMN IF NOT EXISTS email VARCHAR(100) DEFAULT ''");
    echo "Đã thêm cột email.<br>";
} catch (PDOException $e) {
    try {
        // Thử lại với cú pháp khác nếu 'IF NOT EXISTS' không được hỗ trợ
        $db->exec("ALTER TABLE account ADD COLUMN email VARCHAR(100) DEFAULT ''");
        echo "Đã thêm cột email (cú pháp 2).<br>";
    } catch (PDOException $e1) {
        echo "Không thể thêm cột email: " . $e1->getMessage() . "<br>";
    }
}

try {
    $db->exec("ALTER TABLE account ADD COLUMN IF NOT EXISTS phone VARCHAR(20) DEFAULT ''");
    echo "Đã thêm cột phone.<br>";
} catch (PDOException $e) {
    try {
        $db->exec("ALTER TABLE account ADD COLUMN phone VARCHAR(20) DEFAULT ''");
        echo "Đã thêm cột phone (cú pháp 2).<br>";
    } catch (PDOException $e1) {
        echo "Không thể thêm cột phone: " . $e1->getMessage() . "<br>";
    }
}

try {
    $db->exec("ALTER TABLE account ADD COLUMN IF NOT EXISTS avatar VARCHAR(255) DEFAULT 'uploads/avatars/default.png'");
    echo "Đã thêm cột avatar.<br>";
} catch (PDOException $e) {
    try {
        $db->exec("ALTER TABLE account ADD COLUMN avatar VARCHAR(255) DEFAULT 'uploads/avatars/default.png'");
        echo "Đã thêm cột avatar (cú pháp 2).<br>";
    } catch (PDOException $e1) {
        echo "Không thể thêm cột avatar: " . $e1->getMessage() . "<br>";
    }
}

try {
    $db->exec("ALTER TABLE account ADD COLUMN IF NOT EXISTS created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
    echo "Đã thêm cột created_at.<br>";
} catch (PDOException $e) {
    try {
        $db->exec("ALTER TABLE account ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
        echo "Đã thêm cột created_at (cú pháp 2).<br>";
    } catch (PDOException $e1) {
        echo "Không thể thêm cột created_at: " . $e1->getMessage() . "<br>";
    }
}

echo "<h2>Hoàn tất cập nhật cấu trúc bảng!</h2>";
?>
