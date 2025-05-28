<?php include 'app/views/shares/header.php'; ?>
<h1>Sửa sản phẩm</h1>
<?php if (!empty($errors)): ?>
<div class="alert alert-danger">
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>
<form method="POST" action="/webbanhang/Product/update" onsubmit="return validateForm();" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($product->id, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="form-group">
        <label for="name">Tên sản phẩm:</label>
        <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($product->name ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
    </div>
    <div class="form-group">
        <label for="description">Mô tả:</label>
        <textarea id="description" name="description" class="form-control" required><?php echo htmlspecialchars($product->description ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
    </div>
    <div class="form-group">
        <label for="price">Giá:</label>
        <input type="number" id="price" name="price" class="form-control" step="0.01" value="<?php echo htmlspecialchars($product->price ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
    </div>
    <div class="form-group">
        <label for="category_id">Danh mục:</label>
        <select id="category_id" name="category_id" class="form-control" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo htmlspecialchars($category->id, ENT_QUOTES, 'UTF-8'); ?>" <?php echo ($product->category_id ?? '') == $category->id ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="image">Hình ảnh sản phẩm:</label>
        <input type="file" id="image" name="image" class="form-control" accept="image/*">
        <small class="form-text text-muted">Chọn file mới để thay đổi ảnh. Để trống để giữ ảnh hiện tại.</small>
        
        <?php if (!empty($product->image)): ?>
            <div class="current-image mt-2">
                <label>Ảnh hiện tại:</label><br>
                <img src="/webbanhang/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" 
                     alt="Ảnh hiện tại" style="max-width: 200px; max-height: 200px; object-fit: cover;">
            </div>
        <?php endif; ?>
        
        <div id="image-preview" class="mt-2"></div>
    </div>
    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
</form>
<a href="/webbanhang/Product" class="btn btn-secondary mt-2">Quay lại danh sách sản phẩm</a>

<script>
function validateForm() {
    const imageInput = document.getElementById('image');
    const file = imageInput.files[0];
    
    if (file) {
        // Kiểm tra loại file
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (!allowedTypes.includes(file.type)) {
            alert('Chỉ hỗ trợ file JPG, JPEG, PNG, GIF.');
            return false;
        }
        
        // Kiểm tra kích thước file (5MB = 5 * 1024 * 1024 bytes)
        if (file.size > 5 * 1024 * 1024) {
            alert('Kích thước file không được vượt quá 5MB.');
            return false;
        }
    }
    
    return true;
}

// Preview ảnh khi chọn file
document.getElementById('image').addEventListener('change', function() {
    const file = this.files[0];
    const previewContainer = document.getElementById('image-preview');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewContainer.innerHTML = '<label>Ảnh mới:</label><br><img src="' + e.target.result + '" alt="Preview" style="max-width: 200px; max-height: 200px; object-fit: cover;">';
        }
        reader.readAsDataURL(file);
    } else {
        previewContainer.innerHTML = '';
    }
});
</script>

<?php include 'app/views/shares/footer.php'; ?>