
<?php 

include('connection.php'); 

class OrderProcess {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function createOrder($customer_name, $customer_address, $delivery_type, $payment_method, $total_price) {
        $query = "INSERT INTO online_order (customer_name, customer_address, delivery_type, payment_method, total_price) 
                  VALUES (:customer_name, :customer_address, :delivery_type, :payment_method, :total_price)";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':customer_name', $customer_name);
        $stmt->bindParam(':customer_address', $customer_address);
        $stmt->bindParam(':delivery_type', $delivery_type);
        $stmt->bindParam(':payment_method', $payment_method);
        $stmt->bindParam(':total_price', $total_price);
        $stmt->execute();
        
    }

}

class Order {
    private $connection;

    function __construct($connection) {
        $this->connection = $connection;
    }

    public function orderData() {
        $data = $this->connection->query('SELECT * FROM online_order');
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
