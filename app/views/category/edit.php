<?php include 'app/views/shares/header.php'; ?>

<h1>Sửa danh mục</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="/webbanhang/category/update">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($category->id) ?>">
                    
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Tên danh mục:</label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               class="form-control" 
                               value="<?= htmlspecialchars($category->name ?? '') ?>" 
                               required
                               placeholder="Nhập tên danh mục">
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Lưu thay đổi
                        </button>
                        <a href="/webbanhang/category/list" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>