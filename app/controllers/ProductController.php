<?php
class ProductController
{
    private $productModel;
    private $categoryModel;
    private $orderModel;

    public function __construct($db)
    {
        $this->productModel = new ProductModel($db);
        $this->categoryModel = new CategoryModel($db);
        $this->orderModel = new OrderModel($db);
    }

    // Kiểm tra người dùng có quyền admin không
    private function isAdmin() {
        if (!isset($_SESSION['user']) || $_SESSION['user']->role !== 'admin') {
            // Chuyển hướng về trang chính nếu không phải admin
            header('Location: /webbanhang/product');
            exit;
        }
        return true;
    }

    // Shopping functions
    public function index()
    {
        $products = $this->productModel->getProducts();
        $categories = $this->categoryModel->getCategories();
        include_once 'app/views/product/list.php';
    }    // Admin CRUD functions
    public function list()
    {
        $this->isAdmin(); // Kiểm tra quyền admin
        $products = $this->productModel->getProducts();
        include_once 'app/views/product/admin_list.php';
    }

    public function add()
    {
        $this->isAdmin(); // Kiểm tra quyền admin
        $categories = $this->categoryModel->getCategories();
        $errors = [];
        include_once 'app/views/product/add.php';
    }    public function save()
    {
        $this->isAdmin(); // Kiểm tra quyền admin
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];
            $imageFile = $_FILES['image'];

            $result = $this->productModel->addProduct($name, $description, $price, $category_id, $imageFile);

            if ($result === true) {
                header('Location: /webbanhang/Product');
                exit();
            } else {
                $errors = $result;
                $categories = $this->categoryModel->getCategories();
                include_once 'app/views/product/add.php';
            }
        }
    }    public function edit($id)
    {
        $this->isAdmin(); // Kiểm tra quyền admin
        
        if (!$id) {
            header('Location: /webbanhang/Product');
            exit();
        }

        $product = $this->productModel->getProductById($id);
        $categories = $this->categoryModel->getCategories();
        $errors = [];
        
        if (!$product) {
            header('Location: /webbanhang/Product');
            exit();
        }

        include_once 'app/views/product/edit.php';
    }    public function update()
    {
        $this->isAdmin(); // Kiểm tra quyền admin
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];
            $imageFile = $_FILES['image'];

            $result = $this->productModel->updateProduct($id, $name, $description, $price, $category_id, $imageFile);

            if ($result === true) {
                header('Location: /webbanhang/Product');
                exit();
            } else {
                $errors = is_array($result) ? $result : ['Có lỗi xảy ra khi cập nhật sản phẩm'];
                $product = $this->productModel->getProductById($id);
                $categories = $this->categoryModel->getCategories();
                include_once 'app/views/product/edit.php';
            }
        }
    }    public function delete($id)
    {
        $this->isAdmin(); // Kiểm tra quyền admin
        
        if (!$id) {
            header('Location: /webbanhang/Product');
            exit();
        }

        $result = $this->productModel->deleteProduct($id);
        header('Location: /webbanhang/Product');
        exit();
    }

    // Shopping Cart functions
    public function addToCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'];
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
            
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            if (isset($_SESSION['cart'][$productId])) {
                $_SESSION['cart'][$productId] += $quantity;
            } else {
                $_SESSION['cart'][$productId] = $quantity;
            }
            
            header('Location: /webbanhang/product/cart');
            exit();
        }
    }

    public function cart()
    {
        $cart = $_SESSION['cart'] ?? [];
        $products = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = $this->productModel->getProductById($productId);
            if ($product) {
                $product->quantity = $quantity;
                $product->subtotal = $product->price * $quantity;
                $total += $product->subtotal;
                $products[] = $product;
            }
        }

        include_once 'app/views/product/Cart.php';
    }

    public function updateCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'];
            $quantity = (int)$_POST['quantity'];
            
            if ($quantity > 0) {
                $_SESSION['cart'][$productId] = $quantity;
            } else {
                unset($_SESSION['cart'][$productId]);
            }
            
            header('Location: /webbanhang/product/cart');
            exit();
        }
    }

    public function removeFromCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'];
            unset($_SESSION['cart'][$productId]);
            
            header('Location: /webbanhang/product/cart');
            exit();
        }
    }

    public function checkout()
    {
        $cart = $_SESSION['cart'] ?? [];
        if (empty($cart)) {
            header('Location: /webbanhang/product/cart');
            exit();
        }

        $products = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = $this->productModel->getProductById($productId);
            if ($product) {
                $product->quantity = $quantity;
                $product->subtotal = $product->price * $quantity;
                $total += $product->subtotal;
                $products[] = $product;
            }
        }

        include_once 'app/views/product/Checkout.php';
    }

    public function processCheckout()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customerName = $_POST['customer_name'];
            $customerEmail = $_POST['customer_email'];
            $paymentMethod = $_POST['payment_method'];
            
            $cart = $_SESSION['cart'] ?? [];
            if (empty($cart)) {
                header('Location: /webbanhang/product/cart');
                exit();
            }

            $totalPrice = 0;
            foreach ($cart as $productId => $quantity) {
                $product = $this->productModel->getProductById($productId);
                $totalPrice += $product->price * $quantity;
            }

            $orderId = $this->orderModel->createOrder($customerName, $customerEmail, $totalPrice, $paymentMethod);

            if ($orderId) {
                foreach ($cart as $productId => $quantity) {
                    $product = $this->productModel->getProductById($productId);
                    $this->orderModel->addOrderDetail($orderId, $productId, $quantity, $product->price);
                }

                unset($_SESSION['cart']);
                header('Location: /webbanhang/product/orderConfirmation?order_id=' . $orderId);
                exit();
            }
        }
    }

    public function orderConfirmation()
    {
        $orderId = $_GET['order_id'] ?? null;
        if (!$orderId) {
            header('Location: /webbanhang/product');
            exit();
        }

        $order = $this->orderModel->getOrderById($orderId);
        $orderDetails = $this->orderModel->getOrderDetails($orderId);
        
        include_once 'app/views/product/orderConfirmation.php';
    }
}
?>