<?php
session_start();

// Include database và models
require_once 'app/config/database.php';
require_once 'app/models/ProductModel.php';
require_once 'app/models/CategoryModel.php';
require_once 'app/models/OrderModel.php';
require_once 'app/controllers/ProductController.php';
require_once 'app/controllers/CategoryController.php';

// Khởi tạo database connection
$database = new Database();
$db = $database->getConnection();

// Router logic
$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);

// Loại bỏ /webbanhang khỏi path
$path = str_replace('/webbanhang', '', $path);

// Parse path để lấy controller và action
$pathParts = explode('/', trim($path, '/'));
$controller = $pathParts[0] ?? 'product';
$action = $pathParts[1] ?? 'index';

switch ($controller) {
    case '':
    case 'product':
        $productController = new ProductController($db);
        switch ($action) {
            case '':
            case 'index':
                $productController->index();
                break;
            case 'add':
                $productController->add();
                break;
            case 'save':
                $productController->save();
                break;
            case 'edit':
                $id = $_GET['id'] ?? null;
                $productController->edit($id);
                break;
            case 'update':
                $productController->update();
                break;
            case 'delete':
                $id = $_GET['id'] ?? null;
                $productController->delete($id);
                break;
            case 'addToCart':
                $productController->addToCart();
                break;
            case 'cart':
                $productController->cart();
                break;
            case 'updateCart':
                $productController->updateCart();
                break;
            case 'removeFromCart':
                $productController->removeFromCart();
                break;
            case 'checkout':
                $productController->checkout();
                break;
            case 'processCheckout':
                $productController->processCheckout();
                break;
            case 'orderConfirmation':
                $productController->orderConfirmation();
                break;
            default:
                http_response_code(404);
                echo "Action not found: " . $action;
                break;
        }
        break;
        
    case 'Product': // Để tương thích với URL cũ
        $productController = new ProductController($db);
        switch ($action) {
            case '':
            case 'index':
                $productController->list(); // Hàm list cho admin
                break;
            case 'add':
                $productController->add();
                break;
            case 'save':
                $productController->save();
                break;
            case 'edit':
                $id = $_GET['id'] ?? null;
                $productController->edit($id);
                break;
            case 'update':
                $productController->update();
                break;
            case 'delete':
                $id = $_GET['id'] ?? null;
                $productController->delete($id);
                break;
            default:
                http_response_code(404);
                echo "Action not found: " . $action;
                break;
        }
        break;
        
    case 'category':
        $categoryController = new CategoryController();
        switch ($action) {
            case 'list':
                $categoryController->list();
                break;
            case 'add':
                $categoryController->add();
                break;
            case 'save':
                $categoryController->save();
                break;
            case 'edit':
                $id = $_GET['id'] ?? null;
                $categoryController->edit($id);
                break;
            case 'update':
                $categoryController->update();
                break;
            case 'delete':
                $id = $_GET['id'] ?? null;
                $categoryController->delete($id);
                break;
            default:
                http_response_code(404);
                echo "Action not found: " . $action;
                break;
        }
        break;
        
    default:
        http_response_code(404);
        echo "Page not found - Path: " . $path;
        break;
}
?>