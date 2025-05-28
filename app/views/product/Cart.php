<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4"><i class="fas fa-shopping-cart"></i> Giỏ hàng của bạn</h1>
        
        <?php if (empty($products)): ?>
            <div class="alert alert-info text-center">
                <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                <h4>Giỏ hàng trống</h4>
                <p>Bạn chưa có sản phẩm nào trong giỏ hàng.</p>
                <a href="/webbanhang/product" class="btn btn-primary">Tiếp tục mua sắm</a>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <?php foreach ($products as $product): ?>
                                <div class="row align-items-center border-bottom py-3">
                                    <div class="col-md-2">
                                        <img src="<?= htmlspecialchars($product->image) ?>" class="img-fluid rounded" alt="<?= htmlspecialchars($product->name) ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <h5><?= htmlspecialchars($product->name) ?></h5>
                                        <p class="text-muted"><?= htmlspecialchars($product->description) ?></p>
                                    </div>
                                    <div class="col-md-2">
                                        <span class="fw-bold"><?= number_format($product->price, 0, ',', '.') ?>đ</span>
                                    </div>
                                    <div class="col-md-3">
                                        <form method="POST" action="/webbanhang/product/updateCart" class="d-inline">
                                            <div class="input-group">
                                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="decreaseQuantity(<?= $product->id ?>)">-</button>
                                                <input type="number" name="quantity" id="quantity_<?= $product->id ?>" value="<?= $product->quantity ?>" min="1" class="form-control text-center" style="max-width: 70px;">
                                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="increaseQuantity(<?= $product->id ?>)">+</button>
                                                <input type="hidden" name="product_id" value="<?= $product->id ?>">
                                                <button type="submit" class="btn btn-primary btn-sm ms-2">Cập nhật</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-1">
                                        <form method="POST" action="/webbanhang/product/removeFromCart" class="d-inline">
                                            <input type="hidden" name="product_id" value="<?= $product->id ?>">
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Tóm tắt đơn hàng</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <span>Tổng tiền:</span>
                                <strong><?= number_format($total, 0, ',', '.') ?>đ</strong>
                            </div>
                            <div class="d-grid gap-2">
                                <a href="/webbanhang/product/checkout" class="btn btn-success btn-lg">
                                    <i class="fas fa-credit-card"></i> Thanh toán
                                </a>
                                <a href="/webbanhang/product" class="btn btn-outline-primary">Tiếp tục mua sắm</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function increaseQuantity(productId) {
            const input = document.getElementById('quantity_' + productId);
            input.value = parseInt(input.value) + 1;
        }

        function decreaseQuantity(productId) {
            const input = document.getElementById('quantity_' + productId);
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }
    </script>
</body>
</html>