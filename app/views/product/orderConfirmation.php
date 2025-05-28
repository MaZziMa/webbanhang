<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-check-circle text-success fa-5x mb-4"></i>
                        <h1 class="text-success mb-4">Đặt hàng thành công!</h1>
                        <p class="lead">Cảm ơn bạn đã đặt hàng. Đơn hàng của bạn đã được ghi nhận.</p>
                        
                        <div class="card mt-4">
                            <div class="card-header">
                                <h5>Thông tin đơn hàng #<?= $order->id ?></h5>
                            </div>
                            <div class="card-body text-start">
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Khách hàng:</strong></div>
                                    <div class="col-sm-8"><?= htmlspecialchars($order->customer_name) ?></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Email:</strong></div>
                                    <div class="col-sm-8"><?= htmlspecialchars($order->customer_email) ?></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Hình thức thanh toán:</strong></div>
                                    <div class="col-sm-8">
                                        <?php
                                        switch($order->payment_method) {
                                            case 'cod': echo 'Thanh toán khi nhận hàng'; break;
                                            case 'bank': echo 'Chuyển khoản ngân hàng'; break;
                                            case 'momo': echo 'Ví MoMo'; break;
                                            case 'vnpay': echo 'VNPay'; break;
                                            default: echo $order->payment_method;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Tổng tiền:</strong></div>
                                    <div class="col-sm-8 text-success"><strong><?= number_format($order->total_price, 0, ',', '.') ?>đ</strong></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4"><strong>Ngày đặt:</strong></div>
                                    <div class="col-sm-8"><?= date('d/m/Y H:i', strtotime($order->created_at)) ?></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mt-4">
                            <div class="card-header">
                                <h5>Chi tiết sản phẩm</h5>
                            </div>
                            <div class="card-body">
                                <?php foreach ($orderDetails as $detail): ?>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-2">
                                            <img src="<?= htmlspecialchars($detail->image) ?>" class="img-fluid rounded" alt="<?= htmlspecialchars($detail->product_name) ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <h6><?= htmlspecialchars($detail->product_name) ?></h6>
                                        </div>
                                        <div class="col-md-2">
                                            <span>x<?= $detail->quantity ?></span>
                                        </div>
                                        <div class="col-md-2">
                                            <span><?= number_format($detail->price * $detail->quantity, 0, ',', '.') ?>đ</span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <a href="/webbanhang/product" class="btn btn-primary btn-lg">
                                <i class="fas fa-home"></i> Tiếp tục mua sắm
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>