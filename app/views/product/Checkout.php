<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4"><i class="fas fa-credit-card"></i> Thanh toán</h1>
        
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h5>Thông tin khách hàng</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/webbanhang/product/processCheckout">
                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="customer_email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="customer_email" name="customer_email" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Hình thức thanh toán <span class="text-danger">*</span></label>
                                <select class="form-select" id="payment_method" name="payment_method" required>
                                    <option value="">Chọn hình thức thanh toán</option>
                                    <option value="cod">Thanh toán khi nhận hàng (COD)</option>
                                    <option value="bank">Chuyển khoản ngân hàng</option>
                                    <option value="momo">Ví MoMo</option>
                                    <option value="vnpay">VNPay</option>
                                </select>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fas fa-check"></i> Đặt hàng
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h5>Đơn hàng của bạn</h5>
                    </div>
                    <div class="card-body">
                        <?php foreach ($products as $product): ?>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <h6 class="mb-0"><?= htmlspecialchars($product->name) ?></h6>
                                    <small class="text-muted">Số lượng: <?= $product->quantity ?></small>
                                </div>
                                <span><?= number_format($product->subtotal, 0, ',', '.') ?>đ</span>
                            </div>
                        <?php endforeach; ?>
                        
                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong>Tổng cộng:</strong>
                            <strong class="text-success"><?= number_format($total, 0, ',', '.') ?>đ</strong>
                        </div>
                    </div>
                </div>
                
                <div class="mt-3">
                    <a href="/webbanhang/product/cart" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Quay lại giỏ hàng
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>