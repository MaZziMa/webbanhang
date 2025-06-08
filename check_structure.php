<?php
require 'app/config/database.php';

// Khởi tạo kết nối
$database = new Database();
$db = $database->getConnection();

// Kiểm tra cấu trúc bảng account
$stmt = $db->query('DESCRIBE account');
$columns = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Hiển thị kết quả
echo "=== Cấu trúc bảng account ===\n";
foreach ($columns as $column) {
    echo "{$column['Field']} - {$column['Type']} - {$column['Null']} - {$column['Default']}\n";
}

// Thêm các trường còn thiếu nếu cần
$alterStatements = [];

// Kiểm tra trường email
$hasEmail = false;
$hasPhone = false;
$hasAvatar = false;
$hasCreatedAt = false;

foreach ($columns as $column) {
    if ($column['Field'] === 'email') $hasEmail = true;
    if ($column['Field'] === 'phone') $hasPhone = true;
    if ($column['Field'] === 'avatar') $hasAvatar = true;
    if ($column['Field'] === 'created_at') $hasCreatedAt = true;
}

echo "\n=== Các trường còn thiếu ===\n";

if (!$hasEmail) {
    echo "- Thiếu trường email\n";
    $alterStatements[] = "ALTER TABLE account ADD COLUMN email VARCHAR(100) DEFAULT ''";
}

if (!$hasPhone) {
    echo "- Thiếu trường phone\n";
    $alterStatements[] = "ALTER TABLE account ADD COLUMN phone VARCHAR(20) DEFAULT ''";
}

if (!$hasAvatar) {
    echo "- Thiếu trường avatar\n";
    $alterStatements[] = "ALTER TABLE account ADD COLUMN avatar VARCHAR(255) DEFAULT 'uploads/avatars/default.png'";
}

if (!$hasCreatedAt) {
    echo "- Thiếu trường created_at\n";
    $alterStatements[] = "ALTER TABLE account ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP";
}

// Thực hiện các câu lệnh ALTER TABLE nếu cần
if (!empty($alterStatements)) {
    echo "\n=== Thực hiện các thay đổi ===\n";
    foreach ($alterStatements as $alterStmt) {
        try {
            echo "Thực hiện: $alterStmt\n";
            $db->exec($alterStmt);
            echo "- Thực hiện thành công\n";
        } catch (PDOException $e) {
            echo "- Lỗi: " . $e->getMessage() . "\n";
        }
    }
} else {
    echo "Không cần thay đổi cấu trúc bảng\n";
}

// Kiểm tra cấu trúc sau khi thay đổi
$stmt = $db->query('DESCRIBE account');
$columns = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "\n=== Cấu trúc bảng account sau khi cập nhật ===\n";
foreach ($columns as $column) {
    echo "{$column['Field']} - {$column['Type']} - {$column['Null']} - {$column['Default']}\n";
}
?>
