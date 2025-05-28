<?php
class OrderModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createOrder($customerName, $customerEmail, $totalPrice, $paymentMethod)
    {
        $query = "INSERT INTO orders (customer_name, customer_email, total_price, payment_method) 
                  VALUES (:customer_name, :customer_email, :total_price, :payment_method)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':customer_name', $customerName);
        $stmt->bindParam(':customer_email', $customerEmail);
        $stmt->bindParam(':total_price', $totalPrice);
        $stmt->bindParam(':payment_method', $paymentMethod);
        
        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function addOrderDetail($orderId, $productId, $quantity, $price)
    {
        $query = "INSERT INTO order_details (order_id, product_id, quantity, price) 
                  VALUES (:order_id, :product_id, :quantity, :price)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $orderId);
        $stmt->bindParam(':product_id', $productId);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':price', $price);
        
        return $stmt->execute();
    }

    public function getOrderById($orderId)
    {
        $query = "SELECT * FROM orders WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $orderId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getOrderDetails($orderId)
    {
        $query = "SELECT od.*, p.name as product_name, p.image 
                  FROM order_details od 
                  JOIN product p ON od.product_id = p.id 
                  WHERE od.order_id = :order_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $orderId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
?>