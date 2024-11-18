<?php
$host = 'localhost';
$dbname = 'online_ordering_system';
$user = 'root';
$pass = '';
$connection = new PDO("mysql:host=$host;dbname=$dbname;charset=UTF8",$user,$pass);

try {
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}


?>
