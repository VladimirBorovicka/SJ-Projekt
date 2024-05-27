<?php
require_once 'connectDB.php';

class Cart extends Database{
    protected $conn;

    public function __construct() {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    public function getCartItems() {

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        $items = array();
        $total = 0;

        foreach ($_SESSION['cart'] as $product_id) {
            $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = :id");
            $stmt->execute([':id' => $product_id]);
            $product = $stmt->fetch();

            $items[] = array(
                'name' => $product['name'],
                'price' => $product['price']
            );

            $total += $product['price'];
        }

        return array('items' => $items, 'total' => $total);
    }

    function getCartItemsHtml($cartItems) {
        $output = '';

        foreach ($cartItems['items'] as $key => $item) {
            $output .= '<div class="order-col">';
            $output .= '<form action="checkout.php" method="post">';
            $output .= '<input type="hidden" name="item" value="' . $key . '">';
            $output .= '<button type="submit" class="text-black btn-remove-cart" name="remove"><i class="fa fa-trash"></i></button>';
            $output .= ' 1x ' . $item['name'];
            $output .= '</form>';
            $output .= '<div>$' . $item['price'] . '</div>';
            $output .= '</div>';
        }

        $output .= '<div class="order-col">';
        $output .= '<div><strong>TOTAL</strong></div>';
        $output .= '<div><strong class="order-total">$' . $cartItems['total'] . '</strong></div>';
        $output .= '</div>';

        return $output;
    }


    public function getCartItemsIds() {
        return $_SESSION['cart'];
    }

    public function getCartNumber() {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        echo count($_SESSION['cart']);
    }

    public function clearCart() {
        $_SESSION['cart'] = array();
    }

    function addToCart($product_id) {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
    
        if (!in_array($product_id, $_SESSION['cart'])) {
            $_SESSION['cart'][] = $product_id;
        }
    }

    function removeFromCart($item) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        if (isset($_SESSION['cart'][$item])) {
            unset($_SESSION['cart'][$item]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
    }
}
?>