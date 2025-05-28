<?php include 'app/views/shares/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Danh sách sản phẩm</h1>
    <div>
        <a href="/webbanhang/category/list" class="btn btn-info me-2">
            <i class="fas fa-tags"></i> Quản lý danh mục
        </a>
        <a href="/webbanhang/Product/add" class="btn btn-primary">
            <i class="fas fa-plus"></i> Thêm sản phẩm mới
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Giá</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?= htmlspecialchars($product->id) ?></td>
                                    <td>
                                        <?php if ($product->image): ?>
                                            <img src="/webbanhang/<?= htmlspecialchars($product->image) ?>" 
                                                 alt="<?= htmlspecialchars($product->name) ?>" 
                                                 style="width: 50px; height: 50px; object-fit: cover;">
                                        <?php else: ?>
                                            <span class="text-muted">Không có hình</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($product->name) ?></td>
                                    <td><?= htmlspecialchars($product->category_name ?? 'Chưa phân loại') ?></td>
                                    <td><?= number_format($product->price, 0, ',', '.') ?>đ</td>
                                    <td>
                                        <a href="/webbanhang/Product/edit?id=<?= $product->id ?>" 
                                           class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Sửa
                                        </a>
                                        <a href="/webbanhang/Product/delete?id=<?= $product->id ?>" 
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                            <i class="fas fa-trash"></i> Xóa
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="/webbanhang/product" class="btn btn-info">
        <i class="fas fa-store"></i> Xem giao diện khách hàng
    </a>
</div>

<?php include 'app/views/shares/footer.php'; ?>