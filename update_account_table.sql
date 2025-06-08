-- Thêm các cột mới với giá trị mặc định nếu chưa tồn tại
ALTER TABLE account 
ADD COLUMN IF NOT EXISTS email VARCHAR(100) DEFAULT '',
ADD COLUMN IF NOT EXISTS phone VARCHAR(20) DEFAULT '',  
ADD COLUMN IF NOT EXISTS avatar VARCHAR(255) DEFAULT 'uploads/avatars/default.png',
ADD COLUMN IF NOT EXISTS created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;

-- Nếu câu lệnh trên không hoạt động (MySQL phiên bản cũ), sử dụng cách này
-- Cập nhật từng cột riêng lẻ
ALTER TABLE account ADD COLUMN email VARCHAR(100) DEFAULT '';
ALTER TABLE account ADD COLUMN phone VARCHAR(20) DEFAULT '';
ALTER TABLE account ADD COLUMN avatar VARCHAR(255) DEFAULT 'uploads/avatars/default.png';
ALTER TABLE account ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;
