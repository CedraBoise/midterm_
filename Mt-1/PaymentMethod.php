<?php
abstract class PaymentMethod {
    /**
     
     * @param float 
     */
    abstract public function processTransaction($amount);
}


class CreditCard extends PaymentMethod {
    /**
     * Process a credit card payment.
     * @param float 
     */
    public function processTransaction($amount) {
        echo "Processing a credit card payment of $" . number_format($amount, 2) . ".<br>";
    }
}


class CashOnDelivery extends PaymentMethod {
    /**
     * Process a cash-on-delivery payment.
     * @param float 
     */
    public function processTransaction($amount) {
        echo "Processing a cash-on-delivery payment of $" . number_format($amount, 2) . ".<br>";
       
    }
}
?>
