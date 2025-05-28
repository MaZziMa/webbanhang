<?php include 'app/views/shares/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Quản lý danh mục</h1>
    <a href="/webbanhang/category/add" class="btn btn-primary">
        <i class="fas fa-plus"></i> Thêm danh mục mới
    </a>
</div>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($_SESSION['success']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($_SESSION['error']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên danh mục</th>
                                <th>Số sản phẩm</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($categories)): ?>
                                <tr>
                                    <td colspan="4" class="text-center">Chưa có danh mục nào</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($categories as $category): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($category->id) ?></td>
                                        <td><?= htmlspecialchars($category->name) ?></td>
                                        <td><?= $category->product_count ?></td>
                                        <td>
                                            <a href="/webbanhang/category/edit?id=<?= $category->id ?>" 
                                               class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i> Sửa
                                            </a>
                                            <a href="/webbanhang/category/delete?id=<?= $category->id ?>" 
                                               class="btn btn-sm btn-danger"
                                               onclick="return confirm('Bạn có chắc muốn xóa danh mục này? Nếu có sản phẩm trong danh mục, bạn sẽ không thể xóa.')">
                                                <i class="fas fa-trash"></i> Xóa
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="/webbanhang/Product" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Quay lại quản lý sản phẩm
    </a>
</div>

<?php include 'app/views/shares/footer.php'; ?>