
<?php
class Cart {
    public function __construct() {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    public function addItem($item_id, $item_name, $price, $quantity = 1) {
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['item_id'] == $item_id) {
                $item['quantity'] += $quantity;
                return;
            }
        }

        $_SESSION['cart'][] = [
            'item_id' => $item_id,
            'item_name' => $item_name,
            'price' => $price,
            'quantity' => $quantity,
        ];
    }

    public function removeItem($item_id) {
        foreach ($_SESSION['cart'] as $key => &$item) {
            if ($item['item_id'] == $item_id) {
                $item['quantity'] -= 1;
                if ($item['quantity'] <= 0) {
                    unset($_SESSION['cart'][$key]);
                }
                break;
            }
        }
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    public function clearCart() {
        $_SESSION['cart'] = [];
    }

    public function getItems() {
        return $_SESSION['cart'];
    }

    public function getTotalPrice() {
        return array_reduce($_SESSION['cart'], function ($total, $item) {
            return $total + $item['price'] * $item['quantity'];
        }, 0);
    }
}
?>
