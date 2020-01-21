<?php
class Functions {
    var $pdo;
    public function __construct(){
        $this->pdo = new PDO('mysql:host=localhost;dbname=cars', 'root', '');  
        $this->pdo->exec("set names utf8");
    }
    public function show_brands_list(){
        include 'brands.php';
    }
    public function show_cars_list(){
        include 'cars.php';
    }
    public function show_clients_list(){
        include 'clients.php';
    }
    public function show_workers_list(){
        include 'workers.php';
    }
    public function show_orders_cars_list(){
        include 'orders_cars.php';
    }
    public function show_main_list(){
    	include 'autoload.php';
    }
}
$Functions = new Functions();
?>