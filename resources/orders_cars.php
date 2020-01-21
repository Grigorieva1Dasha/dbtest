<?php
if (isset($_GET['action'])){
  switch ($_GET['action']){
    case 'add':
      $clients = $this->pdo->query('SELECT * FROM `clients`');
      $cars = $this->pdo->query('SELECT * FROM `cars`');
      $brands = $this->pdo->query('SELECT * FROM `brand`');
      $workers = $this->pdo->query('SELECT * FROM `workers`');
      $orders_cars = $this->pdo->query('SELECT * FROM `orders_cars`');
      $url = '/index.php?function=orders_cars&action=create';
      include 'forms/order_car.php';
    break;

    case 'create':
      
      $sql = $this->pdo->prepare('INSERT INTO `orders_cars` (`id_client`, ` id_car`, `id_worker`, `status` ) VALUES (:id_client, :id_car, :id_worker, :status)');
      $sql->execute([
        ':id_client' => $_POST['id_client'], 
        ':id_car' => $_POST['id_car'],
        ':id_worker' => $_POST['id_worker'],
        ':status' => $_POST['status']
        ]);
        $clients = $this->pdo->query('SELECT * FROM `clients`');
      $cars = $this->pdo->query('SELECT * FROM `cars`');
      $brands = $this->pdo->query('SELECT * FROM `brand`');
      $workers = $this->pdo->query('SELECT * FROM `workers`');
      $orders_cars = $this->pdo->query('SELECT * FROM `orders_cars`');
      echo 'Новый заказ на втомобиль добавлен успешно!<br><br><a href="/index.php?function=orders_cars" class="btn btn-primary">Назад</a>';
    break;
    
    case 'edit':
      //$orders_cars = $this->pdo->query('SELECT * FROM `orders_cars`');
      $sql = $this->pdo->prepare('SELECT * FROM `orders_cars` WHERE `id_order_car` = :id_order_car');
      $sql->execute([':id_order_car' => $_GET['id_order_car']]);
      $orders_cars = $sql->fetch();
      $clients = $this->pdo->query('SELECT * FROM `clients`');
      $cars = $this->pdo->query('SELECT * FROM `cars`');
      $brands = $this->pdo->query('SELECT * FROM `brand`');
      $workers = $this->pdo->query('SELECT * FROM `workers`');
      $url = '/index.php?function=orders_cars&action=update&id_order_car=' . $_GET['id_order_car'];
      include 'forms/order_car.php';
    break;
    
    case 'update':
      
      $sql = $this->pdo->prepare('UPDATE `orders_cars` SET `id_order_car` = :id_order_car, `id_client` = :id_client, `id_car` = :id_car, `id_worker` = :id_worker, `status` = :status WHERE `id_order_car` = :id_order_car LIMIT 1');
      $sql->execute([
        ':id_order_car' => $_GET['id_order_car'],
        ':id_client' => $_POST['id_client'], 
        ':id_car' => $_POST['id_car'],
        ':id_worker' => $_POST['id_worker'],
        ':status' => $_POST['status']
      ]);
      $clients = $this->pdo->query('SELECT * FROM `clients`');
      echo 'Данные о заказе на автомобиль успешно обновлены!<br><br><a href="/index.php?function=orders_cars" class="btn btn-primary">Назад</a>';
    break;

    case 'delete':
      $sql = $this->pdo->prepare('DELETE FROM `orders_cars` WHERE `id_order_car` = :id_order_car LIMIT 1');
      $sql->execute([':id_order_car' => $_GET['id_order_car']]);
      echo 'Данные о заказе на автомобиль удалены!<br><br><a href="/index.php?function=orders_cars" class="btn btn-primary">Назад</a>';
    break;
  }
}
else{
    $orders_cars = $this->pdo->query('SELECT * FROM `orders_cars`');
    $orders_cars1 = $this->pdo->query('select `orders_cars`.`id_order_car` as `id_order_car`, 
    CONCAT_WS(" ", `clients`.`surname`, `clients`.`name`, `clients`.`patronymic`) as `client_name`, 
    `brand`.name as `brand_name`,
    `cars`.price as `car_price`,
		CONCAT_WS(" ", `workers`.`surname`, `workers`.`name`, `workers`.`patronymic`) as `worker_name`, 
    `orders_cars`.status as `order_status`
	  FROM `orders_cars`,`clients`,`workers`,`brand`, `cars`
    WHERE `clients`.id_client = `orders_cars`.id_client and `brand`.id_brand = `cars`.id_brand and `cars`.id_car = `orders_cars`.id_car
    and `workers`.id_worker = `orders_cars`.id_worker ORDER BY id_order_car;');
    echo '<table border="1" cellspacing="0" class="table table-striped" class="table table-striped">';

    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>ФИО клиента</th>';
    echo '<th>Бренд</th>';
    echo '<th>Цена</th>';
    echo '<th>ФИО работника</th>';
    echo '<th>Статус</th>';
    echo '<th>&nbsp;</th>';
    echo '<th>&nbsp;</th>';
    echo '</tr>';

    foreach ($orders_cars1 as $order)
    {
      echo '<tr>';
      echo '<td>' . $order['id_order_car'] . '</td> ' 
      . '<td>' . $order['client_name'] . '</td> '
      . '<td>' . $order['brand_name'] . '</td> ' 
      . '<td>' . $order['car_price'] . '</td> '
      . '<td>' . $order['worker_name'] . '</td> '
      . '<td>' . $order['order_status'] . '</td> '
      . '<td><a class="badge badge-info" href="/index.php?function=orders_cars&action=edit&id_order_car=' . $order['id_order_car'] . '">ред.</td>'
      . '<td></a> <a class="badge badge-danger" href="/index.php?function=orders_cars&action=delete&id_order_car=' . $order['id_order_car'] . '">уд.</a></td>';
      echo '</tr>';

    }
    echo '</table>';
    echo '<a href="/index.php?function=orders_cars&action=add" class="btn btn-primary" style="margin-bottom:1%; padding:1%;">Добавить</a><br>';
    echo '<a href="/" class="btn btn-primary" style="margin-top:1%; margin-top; padding:1%;">Вернуться на главную</a>';
}
