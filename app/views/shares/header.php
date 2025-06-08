<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Quản lý sản phẩm</title>
<link
href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<a class="navbar-brand" href="#">Quản lý sản phẩm</a>

<button class="navbar-toggler" type="button" data-toggle="collapse" data-
target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle

navigation">

<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav mr-auto">
<li class="nav-item">
<a class="nav-link" href="/webbanhang/Product/">Danh sách sản phẩm</a>
</li>
<?php if(isset($_SESSION['user']) && $_SESSION['user']->role === 'admin'): ?>
<li class="nav-item">
<a class="nav-link" href="/webbanhang/Product/add">Thêm sản phẩm</a>
</li>
<li class="nav-item">
<a class="nav-link" href="/webbanhang/Product/list">Quản lý sản phẩm</a>
</li>
<?php endif; ?>
</ul>
<ul class="navbar-nav">
<?php if(isset($_SESSION['user'])): ?>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<?php echo htmlspecialchars($_SESSION['user']->fullname); ?> 
<?php if($_SESSION['user']->role === 'admin'): ?>
<span class="badge badge-primary">Admin</span>
<?php endif; ?>
</a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
<a class="dropdown-item" href="/webbanhang/account/profile">Tài khoản của tôi</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="/webbanhang/account/logout">Đăng xuất</a>
</div>
</li>
<?php else: ?>
<li class="nav-item">
<a class="nav-link" href="/webbanhang/product">Đăng nhập</a>
</li>
<?php endif; ?>
</ul>
</div>
</nav>
<div class="container mt-4">
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script
src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script
src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>