<?php
// Require SessionHelper and other necessary files
require_once('app/config/database.php');
require_once('app/models/CategoryModel.php');

class CategoryController
{
    private $categoryModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
    }

    // Kiểm tra người dùng có quyền admin không
    private function isAdmin() {
        if (!isset($_SESSION['user']) || $_SESSION['user']->role !== 'admin') {
            // Chuyển hướng về trang chính nếu không phải admin
            header('Location: /webbanhang/product');
            exit;
        }
        return true;
    }    public function list()
    {
        $this->isAdmin(); // Kiểm tra quyền admin
        $categories = $this->categoryModel->getCategoriesWithProductCount();
        include 'app/views/category/list.php';
    }

    public function add()
    {
        $this->isAdmin(); // Kiểm tra quyền admin
        $errors = [];
        include 'app/views/category/add.php';
    }

    public function save()
    {
        $this->isAdmin(); // Kiểm tra quyền admin
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            
            // Validate
            $errors = [];
            if (empty($name)) {
                $errors[] = 'Tên danh mục không được để trống';
            }
            
            if (empty($errors)) {
                $result = $this->categoryModel->addCategory($name);
                if ($result) {
                    header('Location: /webbanhang/category/list');
                    exit();
                } else {
                    $errors[] = 'Có lỗi xảy ra khi thêm danh mục';
                }
            }
            
            include 'app/views/category/add.php';
        }
    }    public function edit($id)
    {
        $this->isAdmin(); // Kiểm tra quyền admin
        
        if (!$id) {
            header('Location: /webbanhang/category/list');
            exit();
        }

        $category = $this->categoryModel->getCategoryById($id);
        $errors = [];
        
        if (!$category) {
            header('Location: /webbanhang/category/list');
            exit();
        }

        include 'app/views/category/edit.php';
    }    public function update()
    {
        $this->isAdmin(); // Kiểm tra quyền admin
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = trim($_POST['name'] ?? '');
            
            // Validate
            $errors = [];
            if (empty($name)) {
                $errors[] = 'Tên danh mục không được để trống';
            }
            
            if (empty($errors)) {
                $result = $this->categoryModel->updateCategory($id, $name);
                if ($result) {
                    header('Location: /webbanhang/category/list');
                    exit();
                } else {
                    $errors[] = 'Có lỗi xảy ra khi cập nhật danh mục';
                }
            }
            
            $category = $this->categoryModel->getCategoryById($id);
            include 'app/views/category/edit.php';
        }
    }    public function delete($id)
    {
        $this->isAdmin(); // Kiểm tra quyền admin
        
        if (!$id) {
            header('Location: /webbanhang/category/list');
            exit();
        }

        // Kiểm tra xem có sản phẩm nào đang sử dụng danh mục này không
        if ($this->categoryModel->hasProducts($id)) {
            $_SESSION['error'] = 'Không thể xóa danh mục này vì còn sản phẩm đang sử dụng';
        } else {
            $result = $this->categoryModel->deleteCategory($id);
            if ($result) {
                $_SESSION['success'] = 'Xóa danh mục thành công';
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra khi xóa danh mục';
            }
        }
        
        header('Location: /webbanhang/category/list');
        exit();
    }
}
?>