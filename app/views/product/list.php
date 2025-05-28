<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cửa hàng Mua sắm trực tuyến</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --accent-color: #f59e0b;
            --success-color: #10b981;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
            --border-color: #e5e7eb;
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)) !important;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 1rem 0;
            position: relative;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }

        .navbar-nav .nav-link {
            color: white !important;
            font-weight: 500;
            margin: 0 0.5rem;
            padding: 0.5rem 1rem !important;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-2px);
        }

        .cart-badge {
            background: var(--accent-color) !important;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        /* Banner Styles */
        .banner-section {
            position: relative;
            height: 400px;
            margin-bottom: 3rem;
            overflow: hidden;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        }

        .banner-carousel {
            height: 100%;
            border-radius: 20px;
        }

        .banner-carousel .carousel-item {
            height: 400px;
            position: relative;
        }

        .banner-carousel .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 20px;
        }

        .banner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(
                45deg, 
                rgba(37, 99, 235, 0.8) 0%, 
                rgba(30, 64, 175, 0.6) 50%, 
                rgba(245, 158, 11, 0.4) 100%
            );
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
        }

        .banner-content {
            text-align: center;
            color: white;
            z-index: 10;
            max-width: 600px;
            padding: 2rem;
        }

        .banner-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            animation: fadeInUp 1s ease-out;
        }

        .banner-subtitle {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0.95;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
            animation: fadeInUp 1s ease-out 0.3s both;
        }

        .banner-btn {
            background: linear-gradient(135deg, var(--accent-color), #ea580c);
            border: none;
            border-radius: 50px;
            padding: 1rem 2.5rem;
            font-weight: 600;
            font-size: 1.1rem;
            color: white;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            animation: fadeInUp 1s ease-out 0.6s both;
            box-shadow: 0 10px 30px rgba(245, 158, 11, 0.3);
        }

        .banner-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(245, 158, 11, 0.4);
            color: white;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
            opacity: 0.8;
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            opacity: 1;
        }

        .carousel-indicators [data-bs-target] {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            border: 2px solid white;
            opacity: 0.7;
        }

        .carousel-indicators .active {
            opacity: 1;
            background-color: var(--accent-color);
        }

        .main-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            margin: 2rem 0;
            padding: 2rem;
        }

        .page-title {
            color: var(--dark-color);
            font-weight: 700;
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }

        .page-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            border-radius: 2px;
        }

        .filter-section {
            background: var(--light-color);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid var(--border-color);
        }

        .product-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: none;
            overflow: hidden;
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }

        .product-image {
            position: relative;
            overflow: hidden;
            height: 250px;
            background: linear-gradient(45deg, #f0f0f0, #e0e0e0);
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.1);
        }

        .category-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: var(--primary-color);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            z-index: 2;
        }

        .card-body {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            height: calc(100% - 250px);
        }

        .product-title {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
            line-height: 1.4;
        }

        .product-description {
            color: #6b7280;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 1rem;
            flex-grow: 1;
        }

        .product-price {
            font-weight: 700;
            color: var(--success-color);
            font-size: 1.4rem;
            margin-bottom: 1rem;
        }

        .btn-add-cart {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 25px;
            padding: 0.8rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            color: white;
        }

        .btn-add-cart:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.3);
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #6b7280;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: #d1d5db;
        }

        .search-box {
            border-radius: 25px;
            border: 2px solid var(--border-color);
            padding: 0.8rem 1.5rem;
            transition: all 0.3s ease;
        }

        .search-box:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
        }

        .category-filter {
            border-radius: 25px;
            border: 2px solid var(--border-color);
            padding: 0.8rem 1.5rem;
        }

        .category-filter:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
        }

        .loading {
            display: none;
            text-align: center;
            padding: 2rem;
        }

        .spinner {
            border: 4px solid #f3f4f6;
            border-top: 4px solid var(--primary-color);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .stats-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            text-align: center;
        }

        .stats-item {
            display: inline-block;
            margin: 0 2rem;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            display: block;
        }

        .stats-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        @media (max-width: 768px) {
            .banner-title {
                font-size: 2rem;
            }
            
            .banner-subtitle {
                font-size: 1rem;
            }
            
            .banner-section {
                height: 300px;
            }
            
            .banner-carousel .carousel-item {
                height: 300px;
            }
            
            .page-title {
                font-size: 2rem;
            }
            
            .stats-item {
                margin: 0 1rem;
            }
            
            .main-container {
                margin: 1rem 0;
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/webbanhang/product">
                <i class="fas fa-store"></i> Cửa hàng thịt Capache
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="/webbanhang/Product" target="_blank">
                        <i class="fas fa-cog"></i> Quản lý
                    </a>
                    <a class="nav-link" href="/webbanhang/product/cart">
                        <i class="fas fa-shopping-cart"></i> 
                        Giỏ hàng 
                        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                            <span class="badge cart-badge"><?= array_sum($_SESSION['cart']) ?></span>
                        <?php endif; ?>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Banner Section -->
    <div class="container mt-4">
        <div class="banner-section">
            <div id="bannerCarousel" class="carousel slide banner-carousel" data-bs-ride="carousel" data-bs-interval="5000">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="2"></button>
                </div>
                
                <div class="carousel-inner">
                    <!-- Banner 1 -->
                    <div class="carousel-item active">
                        <img src="/webbanhang/uploads/products/Banner-BST-12-scaled.jpg" alt="Banner 1">
                        <div class="banner-overlay">
                            <div class="banner-content">
                                <h1 class="banner-title">Chào mừng đến với Capache</h1>
                                <p class="banner-subtitle">Thịt tươi ngon - Chất lượng cao - Giá cả hợp lý</p>
                                <a href="#productsContainer" class="banner-btn">
                                    <i class="fas fa-shopping-bag"></i> Mua sắm ngay
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Banner 2 -->
                    <div class="carousel-item">
                        <img src="https://images.unsplash.com/photo-1607623814075-e51df1bdc82f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" alt="Banner 2">
                        <div class="banner-overlay">
                            <div class="banner-content">
                                <h1 class="banner-title">Khuyến mãi đặc biệt</h1>
                                <p class="banner-subtitle">Giảm giá lên đến 30% cho tất cả sản phẩm</p>
                                <a href="#productsContainer" class="banner-btn">
                                    <i class="fas fa-tags"></i> Xem ưu đãi
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Banner 3 -->
                    <div class="carousel-item">
                        <img src="https://images.unsplash.com/photo-1588168333986-5078d3ae3976?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" alt="Banner 3">
                        <div class="banner-overlay">
                            <div class="banner-content">
                                <h1 class="banner-title">Giao hàng tận nơi</h1>
                                <p class="banner-subtitle">Miễn phí vận chuyển cho đơn hàng từ 500.000đ</p>
                                <a href="/webbanhang/product/cart" class="banner-btn">
                                    <i class="fas fa-truck"></i> Đặt hàng ngay
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="main-container">
            <!-- Page Title -->
            <h1 class="page-title">Sản phẩm nổi bật</h1>
            
            <!-- Stats Section -->
            <div class="stats-section">
                <div class="stats-item">
                    <span class="stats-number"><?= count($products) ?></span>
                    <span class="stats-label">Sản phẩm</span>
                </div>
                <div class="stats-item">
                    <span class="stats-number"><?= count($categories) ?></span>
                    <span class="stats-label">Danh mục</span>
                </div>
                <div class="stats-item">
                    <span class="stats-number">
                        <?php 
                        $cartCount = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;
                        echo $cartCount;
                        ?>
                    </span>
                    <span class="stats-label">Trong giỏ</span>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="filter-section">
                <div class="row g-3">
                    <div class="col-md-6">
                        <input type="text" class="form-control search-box" id="searchProduct" placeholder="🔍 Tìm kiếm sản phẩm...">
                    </div>
                    <div class="col-md-4">
                        <select class="form-select category-filter" id="categoryFilter">
                            <option value="">📂 Tất cả danh mục</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= htmlspecialchars($category->name) ?>">
                                    <?= htmlspecialchars($category->name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select category-filter" id="sortFilter">
                            <option value="">💰 Sắp xếp</option>
                            <option value="price-asc">Giá tăng dần</option>
                            <option value="price-desc">Giá giảm dần</option>
                            <option value="name-asc">Tên A-Z</option>
                            <option value="name-desc">Tên Z-A</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Loading Spinner -->
            <div class="loading" id="loadingSpinner">
                <div class="spinner"></div>
                <p>Đang tải sản phẩm...</p>
            </div>

            <!-- Products Grid -->
            <div class="row g-4" id="productsContainer">
                <?php if (empty($products)): ?>
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="fas fa-box-open"></i>
                            <h3>Chưa có sản phẩm nào</h3>
                            <p>Vui lòng quay lại sau hoặc liên hệ với chúng tôi để biết thêm thông tin.</p>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($products as $product): ?>
                        <div class="col-lg-4 col-md-6 product-item" 
                             data-name="<?= htmlspecialchars(strtolower($product->name)) ?>" 
                             data-category="<?= htmlspecialchars($product->category_name ?? '') ?>" 
                             data-price="<?= $product->price ?>">
                            <div class="card product-card">
                                <div class="product-image">
                                    <img src="/webbanhang/<?= htmlspecialchars($product->image) ?>" 
                                         alt="<?= htmlspecialchars($product->name) ?>"
                                         onerror="this.src='/webbanhang/uploads/products/Banner-BST-12-scaled.jpg'">
                                    <?php if ($product->category_name): ?>
                                        <span class="category-badge">
                                            <i class="fas fa-tag"></i> <?= htmlspecialchars($product->category_name) ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="card-body">
                                    <h5 class="product-title"><?= htmlspecialchars($product->name) ?></h5>
                                    <p class="product-description">
                                        <?= htmlspecialchars(substr($product->description, 0, 100)) ?><?= strlen($product->description) > 100 ? '...' : '' ?>
                                    </p>
                                    <div class="mt-auto">
                                        <div class="product-price mb-3">
                                            <?= number_format($product->price, 0, ',', '.') ?>đ
                                        </div>
                                        <form method="POST" action="/webbanhang/product/addToCart" class="add-to-cart-form">
                                            <input type="hidden" name="product_id" value="<?= $product->id ?>">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn btn-add-cart w-100">
                                                <i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- No Results -->
            <div class="empty-state d-none" id="noResults">
                <i class="fas fa-search"></i>
                <h3>Không tìm thấy sản phẩm</h3>
                <p>Hãy thử tìm kiếm với từ khóa khác hoặc chọn danh mục khác.</p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Search and Filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchProduct');
            const categoryFilter = document.getElementById('categoryFilter');
            const sortFilter = document.getElementById('sortFilter');
            const productsContainer = document.getElementById('productsContainer');
            const noResults = document.getElementById('noResults');
            const loadingSpinner = document.getElementById('loadingSpinner');

            function showLoading() {
                loadingSpinner.style.display = 'block';
                productsContainer.style.display = 'none';
                noResults.classList.add('d-none');
            }

            function hideLoading() {
                loadingSpinner.style.display = 'none';
                productsContainer.style.display = 'flex';
            }

            function filterProducts() {
                showLoading();
                
                setTimeout(() => {
                    const searchTerm = searchInput.value.toLowerCase();
                    const selectedCategory = categoryFilter.value.toLowerCase();
                    const sortOption = sortFilter.value;
                    
                    let products = Array.from(document.querySelectorAll('.product-item'));
                    let visibleCount = 0;

                    // Filter products
                    products.forEach(product => {
                        const name = product.dataset.name;
                        const category = product.dataset.category.toLowerCase();
                        
                        const matchesSearch = name.includes(searchTerm);
                        const matchesCategory = !selectedCategory || category.includes(selectedCategory);
                        
                        if (matchesSearch && matchesCategory) {
                            product.style.display = 'block';
                            visibleCount++;
                        } else {
                            product.style.display = 'none';
                        }
                    });

                    // Sort products
                    if (sortOption) {
                        const visibleProducts = products.filter(p => p.style.display !== 'none');
                        
                        visibleProducts.sort((a, b) => {
                            switch(sortOption) {
                                case 'price-asc':
                                    return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                                case 'price-desc':
                                    return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
                                case 'name-asc':
                                    return a.dataset.name.localeCompare(b.dataset.name);
                                case 'name-desc':
                                    return b.dataset.name.localeCompare(a.dataset.name);
                                default:
                                    return 0;
                            }
                        });

                        // Reorder DOM elements
                        visibleProducts.forEach(product => {
                            productsContainer.appendChild(product);
                        });
                    }

                    // Show/hide no results message
                    if (visibleCount === 0) {
                        productsContainer.style.display = 'none';
                        noResults.classList.remove('d-none');
                    } else {
                        noResults.classList.add('d-none');
                    }

                    hideLoading();
                }, 300);
            }

            // Event listeners
            searchInput.addEventListener('input', filterProducts);
            categoryFilter.addEventListener('change', filterProducts);
            sortFilter.addEventListener('change', filterProducts);

            // Add to cart animation
            document.querySelectorAll('.add-to-cart-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    const button = this.querySelector('.btn-add-cart');
                    const originalText = button.innerHTML;
                    
                    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang thêm...';
                    button.disabled = true;
                    
                    // Re-enable after form submission
                    setTimeout(() => {
                        button.innerHTML = originalText;
                        button.disabled = false;
                    }, 2000);
                });
            });

            // Smooth scroll for banner buttons
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Auto-play carousel with pause on hover
            const carousel = document.getElementById('bannerCarousel');
            let carouselInterval;

            function startCarousel() {
                carouselInterval = setInterval(() => {
                    const nextButton = carousel.querySelector('.carousel-control-next');
                    nextButton.click();
                }, 5000);
            }

            function stopCarousel() {
                clearInterval(carouselInterval);
            }

            carousel.addEventListener('mouseenter', stopCarousel);
            carousel.addEventListener('mouseleave', startCarousel);

            startCarousel();
        });
    </script>
</body>
</html>