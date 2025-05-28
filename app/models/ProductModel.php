<?php
class ProductModel
{
    private $conn;
    private $table_name = "product";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getProducts()
    {
        $query = "SELECT p.id, p.name, p.description, p.price, p.image, c.name as category_name 
                  FROM " . $this->table_name . " p 
                  LEFT JOIN category c ON p.category_id = c.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function getProductById($id)
    {
        $query = "SELECT id, name, description, price, image, category_id 
                  FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function uploadImage($imageFile)
    {
        $errors = [];
        $targetDir = "uploads/products/";
        
        // Tạo thư mục nếu chưa tồn tại
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileName = $imageFile["name"];
        $fileSize = $imageFile["size"];
        $fileTmpName = $imageFile["tmp_name"];
        $fileType = $imageFile["type"];
        $fileError = $imageFile["error"];

        // Kiểm tra lỗi upload
        if ($fileError !== UPLOAD_ERR_OK) {
            $errors[] = "Có lỗi xảy ra khi upload file.";
            return $errors;
        }

        // Kiểm tra loại file
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (!in_array($fileType, $allowedTypes)) {
            $errors[] = "Chỉ hỗ trợ file JPG, JPEG, PNG, GIF.";
            return $errors;
        }

        // Kiểm tra kích thước file (5MB)
        if ($fileSize > 5 * 1024 * 1024) {
            $errors[] = "Kích thước file không được vượt quá 5MB.";
            return $errors;
        }

        // Tạo tên file unique
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $newFileName = uniqid() . '_' . time() . '.' . $fileExtension;
        $targetFilePath = $targetDir . $newFileName;

        // Di chuyển file
        if (move_uploaded_file($fileTmpName, $targetFilePath)) {
            return $targetFilePath; // Trả về đường dẫn file
        } else {
            $errors[] = "Không thể lưu file.";
            return $errors;
        }
    }

    public function addProduct($name, $description, $price, $category_id, $imageFile)
    {
        $errors = [];
        
        // Validate dữ liệu
        if (empty($name)) {
            $errors[] = 'Tên sản phẩm không được để trống';
        }
        if (empty($description)) {
            $errors[] = 'Mô tả không được để trống';
        }
        if (!is_numeric($price) || $price < 0) {
            $errors[] = 'Giá sản phẩm không hợp lệ';
        }
        if (empty($category_id)) {
            $errors[] = 'Vui lòng chọn danh mục';
        }
        
        // Upload ảnh
        if (empty($imageFile['name'])) {
            $errors[] = 'Vui lòng chọn hình ảnh';
        } else {
            $uploadResult = $this->uploadImage($imageFile);
            if (is_array($uploadResult)) {
                $errors = array_merge($errors, $uploadResult);
            } else {
                $imagePath = $uploadResult;
            }
        }

        if (!empty($errors)) {
            return $errors;
        }

        // Lưu vào database
        $query = "INSERT INTO " . $this->table_name . " (name, description, price, category_id, image) 
                  VALUES (:name, :description, :price, :category_id, :image)";
        $stmt = $this->conn->prepare($query);
        
        $name = htmlspecialchars(strip_tags($name));
        $description = htmlspecialchars(strip_tags($description));
        $price = htmlspecialchars(strip_tags($price));
        $category_id = htmlspecialchars(strip_tags($category_id));
        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':image', $imagePath);

        if ($stmt->execute()) {
            return true;
        } else {
            // Xóa file đã upload nếu lưu database thất bại
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            return ['Có lỗi xảy ra khi lưu sản phẩm'];
        }
    }

    public function updateProduct($id, $name, $description, $price, $category_id, $imageFile = null)
    {
        // Lấy thông tin sản phẩm hiện tại
        $currentProduct = $this->getProductById($id);
        $imagePath = $currentProduct->image; // Giữ ảnh cũ

        $errors = [];

        // Nếu có file ảnh mới
        if (!empty($imageFile['name'])) {
            $uploadResult = $this->uploadImage($imageFile);
            if (is_array($uploadResult)) {
                return $uploadResult; // Trả về lỗi
            } else {
                // Xóa ảnh cũ
                if (!empty($currentProduct->image) && file_exists($currentProduct->image)) {
                    unlink($currentProduct->image);
                }
                $imagePath = $uploadResult;
            }
        }

        // Cập nhật database
        $query = "UPDATE " . $this->table_name . " 
                  SET name=:name, description=:description, price=:price, category_id=:category_id, image=:image 
                  WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        
        $name = htmlspecialchars(strip_tags($name));
        $description = htmlspecialchars(strip_tags($description));
        $price = htmlspecialchars(strip_tags($price));
        $category_id = htmlspecialchars(strip_tags($category_id));
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':image', $imagePath);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function deleteProduct($id)
    {
        // Lấy thông tin sản phẩm để xóa ảnh
        $product = $this->getProductById($id);
        
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        
        if ($stmt->execute()) {
            // Xóa file ảnh
            if (!empty($product->image) && file_exists($product->image)) {
                unlink($product->image);
            }
            return true;
        }
        return false;
    }
}
?>